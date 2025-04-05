require('dotenv').config()
const util = require('../config/utils');
const _ = require('lodash');
const acipaymodel = {}
var pesanbalik = []
let dataquery =""
acipaymodel.ajaxoperatordt = async function (req, data, con) {
  pesanbalik = []
  dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_principal as A JOIN 01_acipay_operator as B ON A.PRINCIPAL_ID = B.PRINCIPAL_ID WHERE A.NAMA_PRINCIPAL LIKE ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ?', ['%' + data[0] + '%',data[1],data[1]], con);
  if (dataquery.length > 0) {
    data = {
      success: true,
      rc: 200,
      message: "Informasi operator ditemukan",
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
acipaymodel.bacaserver = async function (req, data, con) {
  pesanbalik = []
  if (data[0] == "select2"){
    dataquery = await util.eksekusiQueryPromise(req, "SELECT * FROM 01_acipay_vendor WHERE (ID_SERVER LIKE ? OR NAMA_SERVER LIKE ?) AND KODEUNIKMEMBER = ?", ['%' + data[2] + '%','%' + data[2] + '%',data[1]], con);
  
  }else{
    dataquery = await util.eksekusiQueryPromise(req, "SELECT * FROM 01_acipay_vendor as A JOIN 01_acipay_vendor_"+data[0]+" as B ON A.ID_SERVER = B.ID_SERVER WHERE (A.ID_SERVER LIKE ? OR A.NAMA_SERVER LIKE ?) AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ?", ['%' + data[2] + '%','%' + data[2] + '%',data[1],data[1]], con);
  }
  if (dataquery.length > 0) {
    data = {
      success: true,
      rc: 200,
      message: "Informasi server ditemukan",
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
acipaymodel.simpanoperator = async function (req, data, con) {
  pesanbalik = []
  let dataquery
  if (data[6] == "true"){
    await util.eksekusiQueryPromise(req, "UPDATE `01_tms_principal` SET `NAMA_PRINCIPAL` = ? WHERE `PRINCIPAL_ID` = ? AND KODEUNIKMEMBER = ?", [data[1],data[0],data[5]], con);
    dataquery = await util.eksekusiQueryPromise(req, "UPDATE `01_acipay_operator` SET `URL_CITRA` = ?, `STATUS` = ?, `PREFIX` = ? WHERE `PRINCIPAL_ID` = ? AND KODEUNIKMEMBER = ?", [data[2],data[3],data[4],data[0],data[5]], con);
  }else{
    await util.eksekusiQueryPromise(req, "INSERT INTO `01_tms_principal`(`AI`, `PRINCIPAL_ID`, `NAMA_PRINCIPAL`, `KODEUNIKMEMBER`) VALUES (0, ?, ?, ?)", [data[0],data[1],data[5]], con);
    dataquery = await util.eksekusiQueryPromise(req, "INSERT INTO `01_acipay_operator`(`AI`, `PRINCIPAL_ID`, `URL_CITRA`, `STATUS`, `PREFIX`, `KODEUNIKMEMBER`) VALUES (0, ?, ?, ?, ?, ?)", [data[0],data[2],data[3],data[4],data[5]], con);
  }
  if (dataquery.affectedRows > 0) {
    data = {
      success: true,
      rc: 200,
      msg: "Informasi operator berhasil disimpan",
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}
acipaymodel.hapusoperator = async function (req, data, con) {
  pesanbalik = []
  let dataquery = await util.eksekusiQueryPromise(req, "DELETE FROM 01_tms_principal WHERE PRINCIPAL_ID = ? AND KODEUNIKMEMBER = ?", [data[0],data[1]], con);
  if (dataquery.affectedRows > 0) {
    data = {
      success: true,
      rc: 200,
      msg: "Informasi operator berhasil dihapus",
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}
acipaymodel.daftarkategori = async function (req, data, con) {
  pesanbalik = []
  let dataquery = await util.eksekusiQueryPromise(req, "SELECT * FROM 01_tms_kategori as A JOIN 01_acipay_kategori as B ON A.KATEGORIPARENT_ID = B.KATEGORI_ID JOIN 01_tms_principal as C ON B.OPERATOR_ID = C.PRINCIPAL_ID JOIN 01_acipay_vendor as D ON B.VENDOR_ID = D.KODE_SERVER WHERE (A.KATEGORIPARENT_ID LIKE ? OR A.NAMAKATEGORI LIKE ?) AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? ORDER BY A.AI DESC", ['%' + data[0] + '%','%' + data[0] + '%',data[1],data[1],data[1],data[1]], con);
  if (dataquery.length > 0) {
    data = {
      success: true,
      rc: 200,
      message: "Informasi kategori ditemukan",
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
acipaymodel.simpankategori = async function (req, data, con) {
  pesanbalik = []
  let dataquery
  if (data[10] == "true"){
    await util.eksekusiQueryPromise(req, "UPDATE `01_tms_kategori` SET `NAMAKATEGORI` = ?, `LOGOKATEGORI` = ? WHERE `KATEGORIPARENT_ID` = ? AND KODEUNIKMEMBER = ?", [data[1],data[2],data[0],data[9]], con);
    dataquery = await util.eksekusiQueryPromise(req, "UPDATE `01_acipay_kategori` SET `URL_CITRA` = ?, `STATUS` = ?, `FORMAT` = ?, `PLACEHOLDER` = ?, `KETERANGAN` = ?, `SLUG_URL` = ?, `OPERATOR_ID` = ? ,VENDOR_ID = ? WHERE `KATEGORI_ID` = ? AND KODEUNIKMEMBER = ?", [data[2],data[3],data[4],data[5],data[6],data[8],data[11],data[12],data[0],data[9]], con);
  }else{
    await util.eksekusiQueryPromise(req, "INSERT INTO `01_tms_kategori`(`AI`, `KATEGORIPARENT_ID`, `NAMAKATEGORI`, `LOGOKATEGORI`, `KODEUNIKMEMBER`, `BEBANGAJI`, `BEBANPACKING`, `BEBANPROMO`, `BEBANTRANSPORT`) VALUES (0, ?, ?, ?, ?, 0, 0, 0, 0)", [data[0],data[1],"",data[9]], con);
    dataquery = await util.eksekusiQueryPromise(req, "INSERT INTO `01_acipay_kategori`(`AI`, `KATEGORI_ID`, `URL_CITRA`, `STATUS`, `FORMAT`, `PLACEHOLDER`, `KETERANGAN`, `KODEUNIKMEMBER`, `URUTAN`, `SLUG_URL`,`OPERATOR_ID`,`VENDOR_ID`) VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [data[0],data[2],data[3],data[4],data[5],data[6],data[9],data[7],data[8],data[11],data[12]], con);
  }
  if (dataquery.affectedRows > 0) {
    data = {
      success: true,
      rc: 200,
      msg: "Informasi operator berhasil disimpan",
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}
acipaymodel.hapuskategori = async function (req, data, con) {
  pesanbalik = []
  let dataquery = await util.eksekusiQueryPromise(req, "DELETE FROM 01_tms_kategori WHERE KATEGORIPARENT_ID = ? AND KODEUNIKMEMBER = ?", [data[0],data[1]], con);
  if (dataquery.affectedRows > 0) {
    data = {
      success: true,
      rc: 200,
      msg: "Informasi kategori produk berhasil dihapus",
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}

acipaymodel.sinkronproduk = async function (req, data, con) {
  pesanbalik = []
  informasidata = []
  const dataArray = data.data
  _.forEach(dataArray, async (dataEntry,index) => {
    dataquery = await util.eksekusiQueryPromise(req, `UPDATE 01_acipay_produk as A JOIN 01_tms_barangkharisma as B ON A.BARANG_ID = B.BARANG_ID SET B.HARGABELI = ?, MULTI = ?, START_CUT_OFF = ?, END_CUT_OFF = ?, ADMIN = ?, KOMISI = ? WHERE A.PRODUK_ID_VENDOR = ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ?`, [dataEntry.price,dataEntry.multi, dataEntry.start_cut_off, dataEntry.end_cut_off, (req.body.JENISPRODUK == "pasca" ? dataEntry.admin : "0" ),(req.body.JENISPRODUK == "pasca" ? dataEntry.commission : "0"),dataEntry.buyer_sku_code,req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER], con);
    if (dataquery.affectedRows == 0) {
      let pareto = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_acipay_kategori WHERE KATEGORI_ID = ? AND KODEUNIKMEMBER = ?',[req.body.KATEGORI_ID,req.body.KODEUNIKMEMBER], con);
      aa = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_acipay_produk`(`AI`, `BARANG_ID`, `PRODUK_ID_VENDOR`, `HARGA_1`, `HARGA_2`, `HARGA_3`, `MULTI`, `START_CUT_OFF`, `END_CUT_OFF`,`ADMIN`,`KOMISI`,`POIN`,`KODEUNIKMEMBER`) VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
        "ACI"+dataEntry.buyer_sku_code,dataEntry.buyer_sku_code,(req.body.JENISPRODUK == "pasca" ? 0 : dataEntry.price),(req.body.JENISPRODUK == "pasca" ? 0 : dataEntry.price),(req.body.JENISPRODUK == "pasca" ? 0 : dataEntry.price),(req.body.JENISPRODUK == "pasca" ? true : dataEntry.multi),(req.body.JENISPRODUK == "pasca" ? "00:00:00" : dataEntry.start_cut_off),(req.body.JENISPRODUK == "pasca" ? "00:00:00" : dataEntry.end_cut_off),(req.body.JENISPRODUK == "pasca" ? dataEntry.admin : "0" ),(req.body.JENISPRODUK == "pasca" ? dataEntry.commission : "0"),1,req.body.KODEUNIKMEMBER], con);
      await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_barangkharisma (BARANG_ID, QRCODE_ID, NAMABARANG, BERAT_BARANG, PARETO_ID, SUPPLER_ID, KATEGORI_ID, BRAND_ID, KETERANGANBARANG, HARGABELI, HARGAJUAL, SATUAN, AKTIF, KODEUNIKMEMBER, APAKAHGROSIR, STOKDAPATMINUS, JENISBARANG, PEMILIK, APAKAHBONUS,FILECITRA,URUTAN) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)`, ["ACI"+dataEntry.buyer_sku_code,"ACI"+dataEntry.buyer_sku_code,dataEntry.product_name,0,pareto[0].OPERATOR_ID,pareto[0].VENDOR_ID,req.body.KATEGORI_ID,0,dataEntry.desc,(req.body.JENISPRODUK == "pasca" ? 0 : dataEntry.price),(req.body.JENISPRODUK == "pasca" ? 0 : dataEntry.price),"PCS",1,req.body.KODEUNIKMEMBER,"TIDAK AKTIF","DAPAT MINUS","DIGITAL",0,"TIDAK AKTIF","not_found",index], con);
    }
  });
  data = {
    success: true,
    rc: 200,
    msg: "Informasi dengan KATEGORI "+req.body.SKU_FILTER+" pada VENDOR "+req.body.SERVERID+" [DIGIFLAZZ GATEWAY] berhasil disinkron sebanyak "+dataArray.length+" DATA pada PROSES BACKGROUND",
  };
  pesanbalik.push(data)
  return pesanbalik;
}

acipaymodel.daftarproduk = async function (req, data, con) {
  pesanbalik = []
  let jenisproduk;
  switch (req.body.JENISPRODUK) {
    case "REGULER":
      jenisproduk = "AND (FORMAT = 'REGULER' OR FORMAT = 'TOKEN')"
      break;
    case "TAGIHAN":
      jenisproduk = "AND (FORMAT = 'TAGIHAN')"
      break;
    case "GAME":
      jenisproduk = "AND (FORMAT = 'GAME / VOUCHER GAME')"
      break;
    default:
      jenisproduk = ""
      break;
  }
  let dataquery = await util.eksekusiQueryPromise(req, "SELECT *, A.AI as BARIS FROM 01_tms_barangkharisma as A JOIN 01_acipay_produk as B ON A.BARANG_ID = B.BARANG_ID JOIN 01_acipay_kategori as C ON A.KATEGORI_ID = C.KATEGORI_ID WHERE A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND A.JENISBARANG = 'DIGITAL' AND (A.BARANG_ID LIKE ? OR A.NAMABARANG LIKE ?) AND AKTIF = ? AND A.KATEGORI_ID LIKE ? AND A.PARETO_ID LIKE ? "+jenisproduk+" ORDER BY A.URUTAN ASC, NAMABARANG ASC", [req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER,'%' + req.body.KATAKUNCI + '%','%' + req.body.KATAKUNCI + '%',req.body.STATUS,'%' + req.body.KUNCIKATEGORI + '%','%' + req.body.KUNCIOPERATOR + '%'], con);
  if (dataquery.length > 0) {
    data = {
      success: true,
      rc: 200,
      msg: "Informasi daftar produk ACIPAY - DOMPET DATA berhasil terbaca",
      totaldata: dataquery.length,
      data: dataquery,
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}
acipaymodel.getformat = async function (req, data, con) {
  pesanbalik = [],resultdata = []
  if (req.body.KONDISI == "detailproduk"){
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_barangkharisma as A JOIN 01_acipay_produk as B ON A.BARANG_ID = B.BARANG_ID JOIN 01_acipay_vendor as C ON A.SUPPLER_ID = C.ID_SERVER JOIN 01_tms_kategori as D ON A.KATEGORI_ID = D.KATEGORIPARENT_ID JOIN 01_tms_principal as E ON A.PARETO_ID = E.PRINCIPAL_ID JOIN 01_acipay_kategori as F ON A.KATEGORI_ID = F.KATEGORI_ID WHERE A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? AND F.KODEUNIKMEMBER = ? AND A.BARANG_ID = ?', [req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER,req.body.KODEUNIKMEMBER,req.body.PRODUK_ID], con);
    resultdata = dataquery
  }else{
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT FORMAT FROM 01_acipay_kategori WHERE KATEGORI_ID = ? AND KODEUNIKMEMBER = ?', [req.body.KATEGORI_ID,req.body.KODEUNIKMEMBER], con);
    resultdata = dataquery[0].FORMAT
  }
  if (dataquery.length > 0) {
    data = {
      success: true,
      rc: 200,
      data: resultdata,
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}
acipaymodel.hapusperproduk = async function (req, data, con) {
  pesanbalik = []
  dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_tms_barangkharisma WHERE AI = ?', [req.body.BARISKE], con);
  if (dataquery.affectedRows > 0) {
    data = {
      success: true,
      rc: 200,
      msg: "Informasi barang berhasil dihapus",
      data: dataquery,
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}
acipaymodel.tambahprodukproses = async function (req, data, con) {
  pesanbalik = []
  if (req.body.ISEDIT == "true"){
    await util.eksekusiQueryPromise(req, 'UPDATE `01_tms_barangkharisma` SET `NAMABARANG` = ?, `PARETO_ID` = ?, `SUPPLER_ID` = ?, `KATEGORI_ID` = ?, `KETERANGANBARANG` = ?, `HARGABELI` = ?, `HARGAJUAL` = ?, `AKTIF` = ?, `FILECITRA` = ? WHERE `BARANG_ID` = ? AND KODEUNIKMEMBER = ?', [req.body.NAMABARANG,req.body.PARETO_ID,req.body.SUPPLER_ID,req.body.KATEGORI_ID,req.body.KETERANGANBARANG,req.body.HARGABELI,req.body.HARGAJUAL,req.body.AKTIF,req.body.FILECITRA,req.body.PRODUK_ID,req.body.KODEUNIKMEMBER], con);
    dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_acipay_produk` as A JOIN 01_tms_barangkharisma as B ON A.BARANG_ID = B.BARANG_ID SET `PRODUK_ID_VENDOR` = ?, `HARGA_1` = ?, `HARGA_2` = ?, `HARGA_3` = ?, `MULTI` = ?, `START_CUT_OFF` = ?, `END_CUT_OFF` = ?, `ADMIN` = ?, `KOMISI` = ?, `POIN` = ? WHERE A.`BARANG_ID` = ? AND B.KODEUNIKMEMBER = ?', [req.body.PRODUK_SERVER,req.body.HARGA_1,req.body.HARGA_2,"0",req.body.MULTI,"00:00:00","00:00:00",req.body.ADMIN,req.body.KOMISI,req.body.POIN,req.body.PRODUK_ID,req.body.KODEUNIKMEMBER], con);
  }else{
    await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_barangkharisma (BARANG_ID, QRCODE_ID, NAMABARANG, BERAT_BARANG, PARETO_ID, SUPPLER_ID, KATEGORI_ID, BRAND_ID, KETERANGANBARANG, HARGABELI, HARGAJUAL, SATUAN, AKTIF, KODEUNIKMEMBER, APAKAHGROSIR, STOKDAPATMINUS, JENISBARANG, PEMILIK, APAKAHBONUS,FILECITRA,URUTAN) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)`, [req.body.PRODUK_ID,req.body.QRCODE_ID,req.body.NAMABARANG,req.body.BERAT_BARANG,req.body.PARETO_ID,req.body.SUPPLER_ID,req.body.KATEGORI_ID,req.body.BRAND_ID,req.body.KETERANGANBARANG,req.body.HARGABELI,req.body.HARGAJUAL,req.body.SATUAN,req.body.AKTIF,req.body.KODEUNIKMEMBER,req.body.APAKAHGROSIR,req.body.STOKDAPATMINUS,req.body.JENISBARANG,req.body.PEMILIK,req.body.APAKAHBONUS,req.body.FILECITRA,req.body.URUTAN], con);
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_acipay_produk`(`AI`, `BARANG_ID`, `PRODUK_ID_VENDOR`, `HARGA_1`, `HARGA_2`, `HARGA_3`, `MULTI`, `START_CUT_OFF`, `END_CUT_OFF`,`ADMIN`,`KOMISI`,`POIN`,`KODEUNIKMEMBER`) VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [req.body.PRODUK_ID,req.body.PRODUK_SERVER,(req.body.KATEGORI_ID == "TAGIHAN" ? 0 : req.body.HARGA_1),(req.body.KATEGORI_ID == "TAGIHAN"  ? 0 : req.body.HARGA_2),(req.body.KATEGORI_ID == "TAGIHAN"  ? 0 : req.body.HARGA_3),(req.body.KATEGORI_ID == "TAGIHAN"  ? true : req.body.MULTI),"00:00:00","00:00:00", (req.body.KATEGORI_ID == "TAGIHAN"  ? req.body.ADMIN : "0" ),(req.body.KATEGORI_ID == "TAGIHAN"  ? req.body.KOMISI : "0"),req.body.POIN, req.body.KODEUNIKMEMBER], con);
  } 
  if (dataquery.affectedRows > 0) {
    data = {
      success: true,
      rc: 200,
      msg: "Informasi daftar produk ACIPAY - DOMPET DATA berhasil terbaca",
      totaldata: dataquery.length,
      data: dataquery,
    };
  } else {
    data = {
      success: false,
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    };
  }
  pesanbalik.push(data)
  return pesanbalik;
}
module.exports = acipaymodel;