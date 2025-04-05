require('dotenv').config()
const util = require('../config/utils');
const _ = require('lodash');
const moment = require('moment');
const utils = require('../config/utils');
const siakmodel = {}
var pesanbalik = []
let dataquery = ""
function buildTree(data, parentId) {
  let tree = [];
  data.forEach(item => {
      if (item.PARENT_ID === parentId) {
          let children = buildTree(data, item.ID);
          if (children.length > 0) {
              item.children = children;
          }
          tree.push(item);
      }
  });
  return tree;
}
siakmodel.kodecoa = async function (req, data, con) {
  pesanbalik = []
  dataquery = await util.eksekusiQueryPromise(req, 'WITH RECURSIVE AccountHierarchy AS (SELECT ID, KODE_COA_GROUP, PARENT_ID, NAMA_COA_GROUP, DEFAULTINPUT, JENISAKUN, 0 AS SALDOAWAL, SALDOAWALDC, ISDELETE, 0 AS LEVEL, KASBANK, NAMAPERUSAHAAN, KODEPERUSAHAAN FROM 01_siak_coa AS AA JOIN 01_tms_perusahaan AS BB ON AA.AIPERUSAHAAN = BB.KODEPERUSAHAAN WHERE PARENT_ID = 0 AND BB.KODEPERUSAHAAN = ? AND BB.KODEUNIKMEMBER = ? UNION ALL SELECT a.ID, a.KODE_COA_GROUP, a.PARENT_ID, a.NAMA_COA_GROUP, a.DEFAULTINPUT, a.JENISAKUN, a.SALDOAWAL, a.SALDOAWALDC, a.ISDELETE, ah.level + 1, a.KASBANK, b.NAMAPERUSAHAAN, b.KODEPERUSAHAAN FROM 01_siak_coa AS a JOIN 01_tms_perusahaan AS b ON a.AIPERUSAHAAN = b.KODEPERUSAHAAN INNER JOIN AccountHierarchy AS ah ON a.PARENT_ID = ah.id WHERE b.KODEPERUSAHAAN = ?) SELECT * FROM AccountHierarchy ORDER BY KODE_COA_GROUP ASC', [data[1],data[0],data[1]], con);
  if (dataquery.length > 0) {
    const tree = buildTree(dataquery, 0);
    data = {
      success: true,
      rc: 200,
      message: "Informasi akun grup ditemukan",
      totaldata: dataquery.length,
      data: tree,
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
      totaldata: 0,
      data: [],
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}
siakmodel.openingBalance = async function (req, data, con) {
  let tanggaltidakkosong = "", dr_total = 0, cr_total = 0;
  const coaid = req.body.COAID;
  const awaltanggal = req.body.AWALTANGGAL.split("-").reverse().join("-");
  
  const infocoa = await util.eksekusiQueryPromise(req, 'SELECT SALDOAWAL, DEFAULTINPUT, SALDOAWALDC FROM 01_siak_coa WHERE ID = ?', [coaid], con);
  if (infocoa.length == 0) return { dc: "", amount: 0 };
  
  let op_total = infocoa[0].SALDOAWAL;
  let op_total_dc = infocoa[0].SALDOAWALDC;

  const parameterList = [req.body.KODEUNIKMEMBER, req.body.SUBPERUSAHAAN, coaid];
  if (awaltanggal) {
    tanggaltidakkosong = ' AND DATE(WAKTUTRX) < ?';
    parameterList.push(awaltanggal);
  } else {
    return { dc: op_total_dc, amount: op_total };
  }

  // Total debit
  const debitQuery = `SELECT SUM(NOMINAL_JURNAL) AS TOTALNOMINALJURNAL FROM 01_siak_entrijurnalitem AS A LEFT JOIN 01_siak_entrijurnal AS B ON A.ENTRIJURNALID = B.ID WHERE B.KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ? AND A.LEDGER_ID = ? AND DEBITKREDIT = "D" AND STATUSJURNAL = 1 ${tanggaltidakkosong}`;
  const debitResult = await util.eksekusiQueryPromise(req, debitQuery, parameterList, con);
  dr_total = debitResult[0].TOTALNOMINALJURNAL || 0;

  // Total kredit
  const kreditQuery = `SELECT SUM(NOMINAL_JURNAL) AS TOTALNOMINALJURNAL FROM 01_siak_entrijurnalitem AS A LEFT JOIN 01_siak_entrijurnal AS B ON A.ENTRIJURNALID = B.ID WHERE B.KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ? AND A.LEDGER_ID = ? AND DEBITKREDIT = "K" AND STATUSJURNAL = 1 ${tanggaltidakkosong}`;
  const kreditResult = await util.eksekusiQueryPromise(req, kreditQuery, parameterList, con);
  cr_total = kreditResult[0].TOTALNOMINALJURNAL || 0;

  // Add opening balance
  let dr_total_final, cr_total_final;
  if (op_total_dc === 'D') {
    dr_total_final = util.calculate(op_total, dr_total, '+');
    cr_total_final = cr_total;
  } else {
    dr_total_final = dr_total;
    cr_total_final = util.calculate(op_total, cr_total, '+');
  }

  // Calculate final opening balance
  let final_op_total, final_op_total_dc;
  if (util.calculate(dr_total_final, cr_total_final, '>')) {
    final_op_total = util.calculate(dr_total_final, cr_total_final, '-');
    final_op_total_dc = 'D';
  } else if (util.calculate(dr_total_final, cr_total_final, '==')) {
    final_op_total = 0;
    final_op_total_dc = op_total_dc;
  } else {
    final_op_total = util.calculate(cr_total_final, dr_total_final, '-');
    final_op_total_dc = 'K';
  }

  return {
    dc: final_op_total_dc,
    amount: final_op_total,
    di: infocoa[0].DEFAULTINPUT
  };
};

async function closingBalances(req, con, coaid, start_date, end_date, kodeunikmember, subperusahaan) {
  const formatTanggal = 'YYYY-MM-DD';
  let inputTanggalAwal = start_date;
  let inputTanggalAkhir = end_date;
  let apakahneraca = false;

  const tanggalAwal = moment(inputTanggalAwal, 'MM-YYYY', true).format(formatTanggal);
  const tanggalAkhir = moment(inputTanggalAkhir, 'MM-YYYY', true).format(formatTanggal);

  if (!moment(tanggalAwal, formatTanggal, true).isValid() || !moment(tanggalAkhir, formatTanggal, true).isValid()) {
    inputTanggalAwal = moment(inputTanggalAwal, 'YYYY-MM').startOf('month').format('YYYY-MM-DD');
    inputTanggalAkhir = moment(inputTanggalAkhir, 'YYYY-MM').endOf('month').format('YYYY-MM-DD');
    apakahneraca = true;
  }

  let op_total_dc, op_total, dr_total, cr_total;
  dr_total = cr_total = 0;

  const infocoa = await util.eksekusiQueryPromise(req, 'SELECT SALDOAWAL, DEFAULTINPUT, SALDOAWALDC FROM 01_siak_coa WHERE ID = ?', [coaid], con);
  if (infocoa.length == 0) return { dc: "", amount: 0, dr_total: 0, cr_total: 0 };

  op_total = infocoa[0].SALDOAWAL || 0;
  op_total_dc = infocoa[0].SALDOAWALDC;

  const parameterListD = [kodeunikmember, subperusahaan, coaid];
  const parameterListC = [kodeunikmember, subperusahaan, coaid];
  let tanggaltidakkosong = "";

  if (inputTanggalAwal && inputTanggalAkhir) {
    if (apakahneraca) {
      tanggaltidakkosong = ' AND (DATE(B.WAKTUTRX) BETWEEN ? AND ?)';
      parameterListD.push(inputTanggalAwal, inputTanggalAkhir);
      parameterListC.push(inputTanggalAwal, inputTanggalAkhir);
    } else {
      tanggaltidakkosong = ' AND (DATE(B.WAKTUTRX) <= ?)';
      parameterListD.push(inputTanggalAkhir);
      parameterListC.push(inputTanggalAkhir);
    }
  }
  const query = 'SELECT SUM(NOMINAL_JURNAL) AS TOTALNOMINALJURNAL FROM 01_siak_entrijurnalitem as A LEFT JOIN 01_siak_entrijurnal as B ON A.ENTRIJURNALID = B.ID WHERE B.KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ? AND A.LEDGER_ID = ? AND STATUSJURNAL = 1 '
  const debitQuery = query+' AND DEBITKREDIT = "D" ' + tanggaltidakkosong;
  const kreditQuery = query+' AND DEBITKREDIT = "K" ' + tanggaltidakkosong;

  const debitResult = await util.eksekusiQueryPromise(req, debitQuery, parameterListD, con);
  const kreditResult = await util.eksekusiQueryPromise(req, kreditQuery, parameterListC, con);

  dr_total = debitResult[0].TOTALNOMINALJURNAL || 0;
  cr_total = kreditResult[0].TOTALNOMINALJURNAL || 0;

  let cl, cl_dc;
  let dr_total_dc = op_total_dc === 'D' ? util.calculate(op_total, dr_total, '+') : dr_total;
  let cr_total_dc = op_total_dc === 'K' ? util.calculate(op_total, cr_total, '+') : cr_total;

  if (util.calculate(dr_total_dc, cr_total_dc, '>')) {
    cl = util.calculate(dr_total_dc, cr_total_dc, '-');
    cl_dc = 'D';
  } else if (util.calculate(cr_total_dc, dr_total_dc, '==')) {
    cl = 0;
    cl_dc = op_total_dc;
  } else {
    cl = util.calculate(cr_total_dc, dr_total_dc, '-');
    cl_dc = 'K';
  }

  return { dc: cl_dc, amount: cl, dr_total, cr_total, di: infocoa[0].DEFAULTINPUT };
}

siakmodel.closingBalance = async function (req, data, con) {
  let coaid = req.body.COAID
  let start_date = req.body.AWALTANGGAL.split("-").reverse().join("-")
  let end_date = req.body.AKHIRTANGGAL.split("-").reverse().join("-")
  let kodeunikmember = req.body.KODEUNIKMEMBER
  let subperusahaan = req.body.SUBPERUSAHAAN
  return closingBalances(req,con,coaid,start_date,end_date,kodeunikmember,subperusahaan);
}
siakmodel.detailjurnaljurnalumum = async function (req, data, con) {
  pesanbalik = []
  let coaid = req.body.COAID;
  dataquery = await util.eksekusiQueryPromise(req, 'SELECT WAKTUTRX,NOTRX,NARASIITEM,JENISJURNAL,NOMINAL_JURNAL,DEBITKREDIT,DEFAULTINPUT FROM `01_siak_entrijurnal` as A LEFT JOIN `01_siak_entrijurnalitem` as B ON A.`ID` =  B.`ENTRIJURNALID`  JOIN 01_siak_coa as C ON B.LEDGER_ID = C.ID  WHERE `B`.`LEDGER_ID` = ? AND (DATE(WAKTUTRX) BETWEEN ? AND ?) AND A.KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ? AND STATUSJURNAL = 1 ORDER BY A.`ID` ASC', [coaid, req.body.AWALTANGGAL.split("-").reverse().join("-"), req.body.AKHIRTANGGAL.split("-").reverse().join("-"),req.body.KODEUNIKMEMBER,req.body.SUBPERUSAHAAN], con);
  if (dataquery.length > 0) {
    data = {
      success: true,
      rc: 200,
      totaldata: dataquery.length,
      data: dataquery,
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
      totaldata: 0,
      data: [],
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}

siakmodel.nodeajaxhapuskodecoa = async function (req, data, con) {
  pesanbalik = []
  let memilikichild = await util.eksekusiQueryPromise(req, `SELECT COUNT(*) as ADADATA FROM 01_siak_coa WHERE PARENT_ID = ? AND KODEUNIKMEMBER = ?`, [req.body.IDCOA,req.body.KODEUNIKMEMBER], con);
  if (memilikichild[0].ADADATA > 0){
    data = {
      success: false,
      rc: 500,
      msg: "Kode COA "+req.body.KODECOA+" dengan Nama Akun "+req.body.NAMACOA+" tidak bisa dihapus dikarenakan memiliki CHILD atau ANAK AKUN. Silahkan hapus terlebih dahulu semua CHILD atau ANAK AKUN.",
    };
  }else{
    let adadata = await util.eksekusiQueryPromise(req, `SELECT COUNT(*) as ADADATA FROM 01_siak_entrijurnalitem as A JOIN 01_siak_entrijurnal as B ON A.ENTRIJURNALID = B.ID WHERE LEDGER_ID = ? AND B.KODEUNIKMEMBER = ?`, [req.body.IDCOA,req.body.KODEUNIKMEMBER], con);
    if (adadata[0].ADADATA > 0){
      data = {
        success: false,
        rc: 500,
        msg: "Kode COA "+req.body.KODECOA+" dengan Nama Akun "+req.body.NAMACOA+" tidak bisa dihapus dikarenakan memiliki 1 Entri Jurnal atau lebih dari 1 Entri Jurnal. Silahkan hapus entri jurnal terlebih dahulu.",
      };
    }else{
      let hapusdata = await util.eksekusiQueryPromise(req, `DELETE FROM 01_siak_coa WHERE ID = ? AND KODEUNIKMEMBER = ?`, [req.body.IDCOA,req.body.KODEUNIKMEMBER], con);
      if (hapusdata.affectedRows > 0) {
        data = {
          success: true,
          rc: 500,
          msg: "Kode COA "+req.body.KODECOA+" dengan Nama Akun "+req.body.NAMACOA+" berhasil dihapus. Silahkan buat group atau ledger baru jika dibutuhkan. Terima Kasih.",
        };
      }else{
        data = {
          success: false,
          rc: 404,
          msg: "Kode COA "+req.body.KODECOA+" dengan Nama Akun "+req.body.NAMACOA+" tidak bisa dihapus dikarenakan informasi tersebut tidak tersedia di database kami.",
        };
      }
    }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
siakmodel.formatkodeakun = async function (req, data, con) {
  pesanbalik = []
  let kodecoabaru = ""
  getcoagroup = await util.eksekusiQueryPromise(req, `SELECT KODE_COA_GROUP FROM 01_siak_coa WHERE ID = ? AND JENISAKUN = 'GRUP' AND KODEUNIKMEMBER = ?`, [data[0],data[1]], con);
  if (data[0] == ""){ kodeCoaGroup = "0" } else { kodeCoaGroup = getcoagroup[0].KODE_COA_GROUP }
  dataquery = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_siak_coa WHERE ID != ? AND PARENT_ID = ? AND JENISAKUN = ? AND KODE_COA_GROUP LIKE ? AND KODEUNIKMEMBER LIKE ?`, [data[0], data[0], data[2],'%' +kodeCoaGroup +'%' ,'%' + data[1] + '%'], con);
  if (dataquery.length > 0) {
    if (data[2] == "GRUP"){
      let last = dataquery[dataquery.length - 1].KODE_COA_GROUP;
      let lArray = last.split('-');
      let new_index = parseInt(lArray[lArray.length - 1]) + 1;
      new_index = String(new_index).padStart(2, '0');
      kodecoabaru = kodeCoaGroup + '-' + new_index;
    }else{
      let last = dataquery[dataquery.length - 1];
      let lastCode = last.KODE_COA_GROUP;
      let lArray = lastCode.split('-');
      let new_index = parseInt(lArray[lArray.length - 1]) + 1;
      new_index = new_index.toString().padStart(6, '0');
      kodecoabaru = kodeCoaGroup + '-' + new_index;
    }
  } else {
    if (data[1] == "GRUP"){
      kodecoabaru = kodeCoaGroup + '-01';
    }else{
      kodecoabaru = kodeCoaGroup + '-000001';
    }
  }
  data = {
    success: true,
    rc: 200,
    message: "Informasi kode akun terbentuk "+kodecoabaru,
    totaldata: 1,
    data: kodecoabaru,
  };
  pesanbalik.push(data)
  return pesanbalik;
}
siakmodel.simpankodeakungrup = async function (req, data, con) {
  pesanbalik = []
  if (data[11] == "true"){
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO 01_siak_coa(`ID`, `PARENT_ID`, `KODE_COA_GROUP`, `NAMA_COA_GROUP`, `DEFAULTINPUT`, `JENISAKUN`, `SALDOAWAL`, `SALDOAWALDC`, `KASBANK`, `KETERANGAN`,`ISDELETE`,`KODEUNIKMEMBER`,`AIPERUSAHAAN`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [data[0], data[1], data[2], data[3], data[4], data[5], data[6], "" , data[7], data[8], data[9], data[10], data[14]], con);
    if (dataquery.affectedRows > 0) {
      data = {
          success: true,
          rc: 200,
          msg:"Informasi kode akun tersebut berhasil disimpan pada tabel COA SIAK Aciraba"
      }
    }else{
      data = {
          success: false,
          rc: dataquery.code,
          msg: dataquery.sqlMessage,
      }
    }
  }else{
    const queryParameters = (data[13] === "false")
      ? [data[1], data[2], data[3], data[0], data[10]]
      : [data[1], data[2], data[3], data[6], data[12], data[7], data[0], data[10]];
    const additionalConditionEditLedger = (data[13] === "true") ? ' ,`SALDOAWAL` = ?, `SALDOAWALDC` = ?, `KASBANK` = ?' : '';
    const sqlQuery = "UPDATE `01_siak_coa` SET `PARENT_ID` = ?, `KODE_COA_GROUP` = ?, `NAMA_COA_GROUP` = ? "+additionalConditionEditLedger+" WHERE `ID` = ? AND `KODEUNIKMEMBER` = ?";
    dataquery = await util.eksekusiQueryPromise(req, sqlQuery, queryParameters, con);
  }
  if (dataquery.affectedRows > 0) {
    data = {
        success: true,
        rc: 200,
        msg:"Informasi kode akun tersebut berhasil disimpan pada tabel COA SIAK Aciraba"
    }
  }else{
    data = {
        success: false,
        rc: dataquery.code,
        msg: dataquery.sqlMessage,
    }
  }
  pesanbalik.push(data)
  return pesanbalik;   
}
siakmodel.entrijurnalumum = async function (req, data, con) {
  pesanbalik = []
  const batchValuesEntriJurnal = [];
  req.body.INFORMASIENTRIJURNAL.dataentrijurnal.forEach(entry => {
    const { kodecoa, narasiakun, debit, kredit } = entry;
    batchValuesEntriJurnal.push([0, req.body.INFORMASIENTRIJURNAL.notransaksi ,kodecoa, (debit == 0 ? kredit : debit ), (debit == 0 ? "K" : "D"), narasiakun ]);
  });
  try {
    await util.eksekusiQueryPromise(req, 'BEGIN', [], con);
    let dieditoleh = req.body.DIENTRIOLEH
    let dientrioleh = req.body.DIENTRIOLEH
    if (req.body.NOTRXEDIT != ""){
      let getid = await util.eksekusiQueryPromise(req, "SELECT ID, DIENTRIOLEH FROM 01_siak_entrijurnal WHERE NOTRX = ? AND KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ? LIMIT 1", [req.body.INFORMASIENTRIJURNAL.notransaksi, req.body.INFORMASIENTRIJURNAL.kodeunikmember, req.body.INFORMASIENTRIJURNAL.perusahaan], con);
      await util.eksekusiQueryPromise(req, "DELETE FROM 01_siak_entrijurnalitem WHERE ENTRIJURNALID = ?", [getid[0].ID], con);
      await util.eksekusiQueryPromise(req, "DELETE FROM 01_siak_entrijurnal WHERE NOTRX = ? AND KODEUNIKMEMBER = ?", [req.body.INFORMASIENTRIJURNAL.notransaksi, req.body.INFORMASIENTRIJURNAL.kodeunikmember], con);
      dientrioleh = getid[0].DIENTRIOLEH
    }
    await util.eksekusiQueryPromise(req, "INSERT INTO `01_siak_entrijurnal`(`ID`, `NOTRX`, WAKTUTRX, `DEBIT_TOTAL`, `KREDIT_TOTAL`, `NARASI`, `OUTLET`, `KODEUNIKMEMBER`, `SUBPERUSAHAAN`,`DIENTRIOLEH`,`DIUBAHOLEH`,`STATUSJURNAL`,`DIVERIFIKASIOLEH`,`JENISJURNAL`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [0, req.body.INFORMASIENTRIJURNAL.notransaksi, req.body.INFORMASIENTRIJURNAL.tanggaltrx+" "+moment(new Date()).format("HH:mm:ss"), req.body.INFORMASIENTRIJURNAL.totaldebit, req.body.INFORMASIENTRIJURNAL.totalkredit, data[0], req.body.INFORMASIENTRIJURNAL.outlet, req.body.INFORMASIENTRIJURNAL.kodeunikmember, req.body.INFORMASIENTRIJURNAL.perusahaan, dientrioleh, dieditoleh, req.body.STATUSJURNAL, "",req.body.JENISJURNAL], con);
    let getid = await util.eksekusiQueryPromise(req, "SELECT ID FROM 01_siak_entrijurnal WHERE NOTRX = ? AND KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ? LIMIT 1", [req.body.INFORMASIENTRIJURNAL.notransaksi, req.body.INFORMASIENTRIJURNAL.kodeunikmember, req.body.INFORMASIENTRIJURNAL.perusahaan], con);
    batchValuesEntriJurnal.forEach(row => { if (row[1] === req.body.INFORMASIENTRIJURNAL.notransaksi) { row[1] = getid[0].ID; } });
    await util.eksekusiQueryPromise(req, "INSERT INTO `01_siak_entrijurnalitem`(`ID`, `ENTRIJURNALID`, `LEDGER_ID`, `NOMINAL_JURNAL`, `DEBITKREDIT`, `NARASIITEM`) VALUES ?", [batchValuesEntriJurnal], con);
    await util.eksekusiQueryPromise(req, 'COMMIT', [], con);
    queryok = true;
    pesan = "Transaksi dengan kode entri jurnal : "+req.body.INFORMASIENTRIJURNAL.notransaksi+" dengan waktu TRX : "+req.body.INFORMASIENTRIJURNAL.tanggaltrx.split("-").reverse().join("-")+" berhasil disimpan pada "+moment(new Date()).format("DD-MM-YYYY HH:mm:ss")+". Terima Kasih"
  } catch (error) {
      await util.eksekusiQueryPromise(req, 'ROLLBACK', [], con);
      queryok = false;
      pesan = "Transaksi dengan kode entri jurnal : "+req.body.INFORMASIENTRIJURNAL.notransaksi+" dirollback karena terjadi kesalahan: "+error.message;
  } 
  if (queryok) {
    data = {
        success: true,
        rc: 200,
        msg:pesan
    }
  }else{
    data = {
        success: false,
        rc: 500,
        msg: pesan,
    }
  }
  pesanbalik.push(data)
  return pesanbalik; 
}
siakmodel.daftarentrijurnal = async function (req, data, con) {
  pesanbalik = [];
  let informasientrijurnal = await util.eksekusiQueryPromise(req, `SELECT NOTRX, WAKTUTRX, DEBIT_TOTAL, KREDIT_TOTAL, NARASI, SUBPERUSAHAAN, STATUSJURNAL FROM 01_siak_entrijurnal WHERE (DATE(WAKTUTRX) BETWEEN ? AND ?) AND NOTRX LIKE ? AND NARASI LIKE ? AND SUBPERUSAHAAN = ? AND OUTLET = ? AND KODEUNIKMEMBER = ? AND JENISJURNAL LIKE ? ORDER BY WAKTUTRX DESC LIMIT ?,?`, [req.body.WAKTUAWAL.split("-").reverse().join("-"),req.body.WAKTUAKHIR.split("-").reverse().join("-"),'%'+req.body.NOTRANSAKI+'%','%'+req.body.NARASI+'%',req.body.SUBPERUSAHAAN,req.body.OUTLET,req.body.KODEUNIKMEMBER,'%'+(req.body.JENISJURNALTRANSAKSI == "ALL" ? "" : req.body.JENISJURNALTRANSAKSI)+'%',parseInt(req.body.BARISKE),parseInt(req.body.LIMIT)], con);
  if (informasientrijurnal.length == 0) {
      data = {
          success: false,
          rc: 404,
          msg: 'Informasi terkait kata kunci yang anda berikan tidak terdapat pada data entri jurnal kami. Silahkan cek kembali kata kunci anda'
      }
  } else {
      data = {
          success: true,
          rc: 200,
          totaldata: informasientrijurnal.length,
          daftarentrijurnal: informasientrijurnal
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
siakmodel.nodeviewjurnal = async function (req, data, con) {
  pesanbalik = [];
  let informasientrijurnal = await util.eksekusiQueryPromise(req, `SELECT WAKTUTRX, DEBIT_TOTAL, KREDIT_TOTAL, NARASI, DIENTRIOLEH, DIUBAHOLEH, STATUSJURNAL, KODE_COA_GROUP, LEDGER_ID,NAMA_COA_GROUP, NOMINAL_JURNAL, DEBITKREDIT, NARASIITEM, SUBPERUSAHAAN, D.NAMAPERUSAHAAN FROM 01_siak_entrijurnal as A JOIN 01_siak_entrijurnalitem as B ON A.ID = B.ENTRIJURNALID JOIN 01_siak_coa as C ON B.LEDGER_ID = C.ID JOIN 01_tms_perusahaan as D ON A.SUBPERUSAHAAN = D.KODEPERUSAHAAN WHERE NOTRX = ? AND A.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? ORDER BY B.ID ASC`, [req.body.NOTRANSAKI,req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER], con);
  if (informasientrijurnal.length == 0) {
      data = {
          success: false,
          rc: 404,
          msg: 'Informasi terkait kata kunci yang anda berikan tidak terdapat pada data entri jurnal kami. Silahkan cek kembali kata kunci anda'
      }
  } else {
      data = {
          success: true,
          rc: 200,
          totaldata: informasientrijurnal.length,
          daftarentrijurnal: informasientrijurnal,
          wakturansaksi: informasientrijurnal[0].WAKTUTRX,
          total_debit: informasientrijurnal[0].DEBIT_TOTAL,
          total_kredit: informasientrijurnal[0].KREDIT_TOTAL,
          narasi: informasientrijurnal[0].NARASI,
          dientrioleh: informasientrijurnal[0].DIENTRIOLEH,
          diubaholeh: informasientrijurnal[0].DIUBAHOLEH,
          statusjurnal: informasientrijurnal[0].STATUSJURNAL,
          subperusahaan: informasientrijurnal[0].SUBPERUSAHAAN,
          namasubperusahaan: informasientrijurnal[0].NAMAPERUSAHAAN,
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
siakmodel.nodeviewjurnalitem = async function (req, data, con) {
  pesanbalik = [];
  let getid = await util.eksekusiQueryPromise(req, "SELECT ID FROM 01_siak_entrijurnal WHERE NOTRX = ? AND KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ? LIMIT 1", [req.body.NOTRX, req.body.KODEUNIKMEMBER, req.body.SUBPERUSAHAAN], con);
  let informasientrijurnal = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_siak_entrijurnalitem as A JOIN 01_siak_coa as B ON A.LEDGER_ID = B.ID WHERE ENTRIJURNALID = ?`, [getid[0].ID], con);
  if (informasientrijurnal.length == 0) {
      data = {
          success: false,
          rc: 404,
          msg: 'Informasi terkait kata kunci yang anda berikan tidak terdapat pada data entri jurnal kami. Silahkan cek kembali kata kunci anda'
      }
  } else {
      data = {
          success: true,
          rc: 200,
          totaldata: informasientrijurnal.length,
          daftarentrijurnal: informasientrijurnal,
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
siakmodel.nodehapusjurnal = async function (req, data, con) {
  pesanbalik = [];
  try {
    await util.eksekusiQueryPromise(req, 'BEGIN', [], con);
    let getid = await util.eksekusiQueryPromise(req, "SELECT ID FROM 01_siak_entrijurnal WHERE NOTRX = ? AND KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ? LIMIT 1", [req.body.NOMORTRX, req.body.KODEUNIKMEMBER, req.body.SUBPERUSAHAAN], con);
    await util.eksekusiQueryPromise(req, "DELETE FROM 01_siak_entrijurnalitem WHERE ENTRIJURNALID = ?", [getid[0].ID], con);
    await util.eksekusiQueryPromise(req, "DELETE FROM 01_siak_entrijurnal WHERE NOTRX = ? AND KODEUNIKMEMBER = ?", [req.body.NOMORTRX,req.body.KODEUNIKMEMBER], con);
    await util.eksekusiQueryPromise(req, 'COMMIT', [], con);
    queryok = true;
    pesan = "Transaksi dengan kode entri jurnal : "+req.body.NOMORTRX+" berhasil dihapus pada "+moment(new Date()).format("DD-MM-YYYY HH:mm:ss")+". Terima Kasih"
  } catch (error) {
      await util.eksekusiQueryPromise(req, 'ROLLBACK', [], con);
      queryok = false;
      pesan = "Transaksi dengan kode entri jurnal : "+req.body.NOMORTRX+" dirollback karena terjadi kesalahan: "+error.message;
  } 
  if (queryok) {
    data = {
        success: true,
        rc: 200,
        msg:pesan
    }
  }else{
    data = {
        success: false,
        rc: dataquery.code,
        msg: pesan,
    }
  }
  pesanbalik.push(data)
  return pesanbalik; 
}
siakmodel.detailjurnal = async function (req, data, con) {
  pesanbalik = [];
  let informasientrijurnal = await util.eksekusiQueryPromise(req, `SELECT NOTRX, WAKTUTRX, DEBIT_TOTAL, KREDIT_TOTAL, NARASI, SUBPERUSAHAAN, STATUSJURNAL FROM 01_siak_entrijurnal WHERE (DATE(WAKTUTRX) BETWEEN ? AND ?) AND NOTRX LIKE ? AND NARASI LIKE ? AND SUBPERUSAHAAN = ? AND OUTLET = ? AND KODEUNIKMEMBER = ? ORDER BY WAKTUTRX DESC LIMIT ?,?`, [req.body.WAKTUAWAL.split("-").reverse().join("-"),req.body.WAKTUAKHIR.split("-").reverse().join("-"),'%'+req.body.NOTRANSAKI+'%','%'+req.body.NARASI+'%',req.body.SUBPERUSAHAAN,req.body.OUTLET,req.body.KODEUNIKMEMBER,parseInt(req.body.BARISKE),parseInt(req.body.LIMIT)], con);
  if (informasientrijurnal.length == 0) {
      data = {
          success: false,
          rc: 404,
          msg: 'Informasi terkait kata kunci yang anda berikan tidak terdapat pada data entri jurnal kami. Silahkan cek kembali kata kunci anda'
      }
  } else {
      data = {
          success: true,
          rc: 200,
          totaldata: informasientrijurnal.length,
          daftarentrijurnal: informasientrijurnal
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}

siakmodel.nodeverifentrijurnal = async function (req, data, con) {
  pesanbalik = [];
  let intubah = 1;
  if (req.body.STATUSUBAH == 0){
    intubah = 0;
  }
  let informasientrijurnal = await util.eksekusiQueryPromise(req, `UPDATE 01_siak_entrijurnal SET DIVERIFIKASIOLEH = ?,STATUSJURNAL = ? WHERE NOTRX = ? AND KODEUNIKMEMBER = ? AND SUBPERUSAHAAN = ?`, [req.body.DIVERIFOLEH,intubah,req.body.NOTRXEDIT,req.body.KODEUNIKMEMBER,req.body.SUBPERUSAHAAN], con);
  if (informasientrijurnal.affectedRows > 0) {
    data = {
        success: true,
        rc: 200,
        msg:"Informasi jurnal dengan NOMOR : "+req.body.NOTRXEDIT+" telah diverifikasi oleh "+req.body.DIVERIFOLEH+". Jika ada kesalahan silahkan batalkan verifikasi sebelum TUTUP BUKU"
    }
  }else{
    data = {
        success: false,
        rc: dataquery.code,
        msg: dataquery.sqlMessage,
    }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
siakmodel.kasbanktotal = async function (req, data, con) {
  let pesanbalik = [], query = "", parameter = [];
  if (data == 0) {
    query = `SELECT COALESCE(SUM(CASE WHEN DEBITKREDIT = 'D' THEN NOMINAL_JURNAL ELSE -NOMINAL_JURNAL END), 0) AS NOMINAL_JURNAL  FROM 01_siak_coa AS A JOIN 01_siak_entrijurnalitem AS B ON A.ID = B.LEDGER_ID JOIN 01_siak_entrijurnal AS C ON C.ID = B.ENTRIJURNALID WHERE KASBANK = true AND SUBPERUSAHAAN = ?  AND A.KODEUNIKMEMBER = ?`;
    parameter = [req.body.SUBPERUSAHAAN, req.body.KODEUNIKMEMBER];
  } else {
    let debitkredit = (data == 1) ? "'D'" : "'K'";
    query = `SELECT COALESCE(SUM(NOMINAL_JURNAL),0) AS NOMINAL_JURNAL FROM 01_siak_coa AS A JOIN 01_siak_entrijurnalitem AS B ON A.ID = B.LEDGER_ID JOIN 01_siak_entrijurnal AS C ON C.ID = B.ENTRIJURNALID WHERE KASBANK = true AND DEBITKREDIT = ${debitkredit} AND (DATE(WAKTUTRX) BETWEEN ? AND ?) AND SUBPERUSAHAAN = ?  AND A.KODEUNIKMEMBER = ?`;
    parameter = [req.body.AWALTANGGAL,req.body.AKHIRTANGGAL,req.body.SUBPERUSAHAAN,req.body.KODEUNIKMEMBER];
  }
  let informasientrijurnal = await util.eksekusiQueryPromise(req, query, parameter, con);
  if (informasientrijurnal.length > 0) {
    data = {
        success: true,
        rc: 200,
        msg:"Informasi Kas Bank Ditemukan",
        informasientrijurnal: informasientrijurnal,
    }
  }else{
    data = {
        success: false,
        rc: dataquery.code,
        msg: dataquery.sqlMessage,
    }
  }
  pesanbalik.push(data)
  return pesanbalik;
}

siakmodel.ambilperiode = async function (req, data, con) {
  pesanbalik = [];
  let informasiperiode = await util.eksekusiQueryPromise(req, `SELECT PERIODEAWAL,PERIODEAKHIR FROM 01_siak_periodeakuntansi as A JOIN 01_tms_perusahaan as B ON A.PERUSAHANID = B.KODEPERUSAHAAN WHERE KODEUNIKMEMBER = ? AND PERUSAHANID = ? AND AKTIF = true LIMIT 1`, [req.body.KODEUNIKMEMBER,req.body.SUBPERUSAHAAN], con);
  if (informasiperiode.length == 0) {
      data = {
          success: false,
          rc: 404,
          msg: 'Informasi terkait kata kunci yang anda berikan tidak terdapat pada data entri jurnal kami. Silahkan cek kembali kata kunci anda'
      }
  } else {
      data = {
          success: true,
          rc: 200,
          totaldata: informasiperiode.length,
          informasiperiode: informasiperiode
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
siakmodel.nodejurnalumumajax = async function (req, data, con) {
  pesanbalik = [];
  const queryParameters = (req.body.COAID === "ALL")
      ? [req.body.AWALTANGGAL.split("-").reverse().join("-"),req.body.AKHIRTANGGAL.split("-").reverse().join("-"),req.body.KODEUNIKMEMBER,req.body.SUBPERUSAHAAN,req.body.KODEUNIKMEMBER,req.body.SUBPERUSAHAAN]
      : [req.body.AWALTANGGAL.split("-").reverse().join("-"),req.body.AKHIRTANGGAL.split("-").reverse().join("-"),req.body.KODEUNIKMEMBER,req.body.SUBPERUSAHAAN,req.body.KODEUNIKMEMBER,req.body.SUBPERUSAHAAN,req.body.COAID];
  const querytambahan = (req.body.COAID === "ALL") ? '' : ' AND `LEDGER_ID` = ?';
  let informasijurnalumum = await util.eksekusiQueryPromise(req, 'SELECT WAKTUTRX, NOTRX, KODE_COA_GROUP, NAMA_COA_GROUP, JENISAKUN, JENISJURNAL, NOMINAL_JURNAL, DEBITKREDIT FROM 01_siak_entrijurnal as A JOIN 01_siak_entrijurnalitem as B ON A.ID = B.ENTRIJURNALID JOIN 01_siak_coa as C ON B.LEDGER_ID = C.ID WHERE STATUSJURNAL = 1 AND (DATE(WAKTUTRX) BETWEEN ? AND ?) AND A.KODEUNIKMEMBER = ? AND A.SUBPERUSAHAAN = ? AND C.KODEUNIKMEMBER = ? AND C.AIPERUSAHAAN = ? '+querytambahan+' ORDER BY WAKTUTRX DESC', queryParameters, con);
  if (informasijurnalumum.length == 0) {
      data = {
          success: false,
          rc: 404,
          msg: 'Informasi terkait kata kunci yang anda berikan tidak terdapat pada data entri jurnal kami. Silahkan cek kembali kata kunci anda'
      }
  } else {
      data = {
          success: true,
          rc: 200,
          totaldata: informasijurnalumum.length,
          informasijurnalumum: informasijurnalumum
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
/* NERACA*/
async function mulai(req,id,kodeunikmember,subperusahaan,con){
  let informasientrijurnal
  if (id == 0){
    informasientrijurnal = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_siak_coa as A JOIN 01_tms_perusahaan as B ON A.AIPERUSAHAAN = B.KODEPERUSAHAAN WHERE PARENT_ID = ? AND A.KODEUNIKMEMBER = ? AND A.AIPERUSAHAAN = ? AND B.KODEUNIKMEMBER = ? AND B.KODEPERUSAHAAN = ?`, [id,kodeunikmember,subperusahaan,kodeunikmember,subperusahaan], con);
  } else {
    informasientrijurnal = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_siak_coa as A JOIN 01_tms_perusahaan as B ON A.AIPERUSAHAAN = B.KODEPERUSAHAAN WHERE ID = ? AND A.KODEUNIKMEMBER = ? AND A.AIPERUSAHAAN = ? AND B.KODEUNIKMEMBER = ? AND B.KODEPERUSAHAAN = ?`, [id,kodeunikmember,subperusahaan,kodeunikmember,subperusahaan], con);
  }
  return informasientrijurnal;
}
siakmodel.nodeneracasaldo = async function (req, data, con) {
  pesanbalik = [];
  id = req.body.ID;
  kodeunikmember = req.body.KODEUNIKMEMBER;
  subperusahaan = req.body.SUBPERUSAHAAN;
  let informasientrijurnal = await mulai(req,id,kodeunikmember,subperusahaan,con);
  let idcoa = informasientrijurnal[0].ID;
  let namacoa = informasientrijurnal[0].NAMA_COA_GROUP;
  let code = informasientrijurnal[0].KODE_COA_GROUP;
  let g_parent_id = informasientrijurnal[0].PARENT_ID;
  subgrup(req,id,kodeunikmember,subperusahaan,con)
}
async function subgrup(req,id,kodeunikmember,subperusahaan,con){
  
  /* Calculating closing balance total for all the child groups 
  $temp2 =utils.calculate_withdc(
    cl_total,
    cl_total_dc,
    children_groups[$counter]->cl_total,
    children_groups[$counter]->cl_total_dc
  );
  cl_total = $temp2['amount'];
  cl_total_dc = $temp2['dc'];*/

  /* Calculate Dr and Cr total 
  dr_total =utils.calculate(dr_total, children_groups[$counter]->dr_total, '+');
  cr_total =utils.calculate(cr_total, children_groups[$counter]->cr_total, '+');
  dr_sum =utils.calculate(cl_total, children_groups[$counter]->cl_total, '+');
  cr_sum =utils.calculate(cl_total, children_groups[$counter]->cl_total, '+');*/
}

module.exports = siakmodel;