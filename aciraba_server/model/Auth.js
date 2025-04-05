require('dotenv').config()
const jwt = require('jsonwebtoken');
const bcrypt = require('bcrypt');
const util = require('../config/utils');
const auth = {}
let pesanbalik = {}

auth.pendaftaranmember = async function (req, data, con) {
  pesanbalik = [];
  const tokenjwt = jwt.sign({ username: req.body.NAMAPENGGUNA, kodeunikmember: req.body.KODEUNIKMEMBER }, process.env.ACCESS_TOKEN_RHS, { expiresIn: '1y'  });
  let hashedPassword = await bcrypt.hash(req.body.PASSWORD, 10)
  let adadata = await util.eksekusiQueryPromise(req, 'SELECT COUNT(*) as ADADATA, `EMAIL`, `KODEUNIKMEMBER` FROM 01_tms_penggunaaplikasi WHERE EMAIL = ? OR KODEUNIKMEMBER = ? LIMIT 1', [req.body.EMAIL,req.body.KODEUNIKMEMBER], con);
  if (adadata[0].EMAIL === req.body.EMAIL) {
    data = {
      success: false,
      rc: 1000,
      msg: 'Sistem kami mendeteksi bahwa terdapat duplikasi. Email sudah terdaftar pada sistem kami',
      data: []
    };
  } else if (adadata[0].KODEUNIKMEMBER === req.body.KODEUNIKMEMBER) {
    data = {
      success: false,
      rc: 1000,
      msg: 'Sistem kami mendeteksi bahwa terdapat duplikasi. Silahkan generate ulang TENANT ID OUTLET anda',
      data: []
    };
  } else {
    try{
      await util.eksekusiQueryPromise(req,"SET autocommit = 0", [], con);
      await util.eksekusiQueryPromise(req,"START TRANSACTION", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_barangkharisma`(`AI`, `BARANG_ID`, `QRCODE_ID`, `NAMABARANG`, `BERAT_BARANG`, `PARETO_ID`, `SUPPLER_ID`, `KATEGORI_ID`, `BRAND_ID`, `KETERANGANBARANG`, `HARGABELI`, `HARGAJUAL`, `SATUAN`, `AKTIF`, `KODEUNIKMEMBER`, `APAKAHGROSIR`, `STOKDAPATMINUS`, `JENISBARANG`, `PEMILIK`, `APAKAHBONUS`, `FILECITRA`) VALUES (0, 'ACI100000100000001', 'ACI100000100000001', 'TIKET PEMESANAN', 0.00, '0', 'UNKWNSUP', 'UNKWNKAT', '0', '<p>Tidak ada informasi mengenai barang ini</p>', 0.00, 0.00, 'PCS', 1, '"+req.body.KODEUNIKMEMBER+"', 'TIDAK AKTIF', 'TIDAK DAPAT MINUS', 'JASA', '0', 'TIDAK AKTIF', 'not_found')", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_member_grup`(`AI`, `KODEGRUP`, `JENIS`, `GRUP`, `KODEUNIKMEMBER`) VALUES (0, 'UMUM', 'UMUM', 'UMUM', '"+req.body.KODEUNIKMEMBER+"')", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_principal`(`AI`, `PRINCIPAL_ID`, `NAMA_PRINCIPAL`, `KODEUNIKMEMBER`) VALUES (0, '0', 'PRINCIPAL TIDAK DIKETAHUI','"+req.body.KODEUNIKMEMBER+"')", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_supplier`(`SUPPLIER_AI`, `KODESUPPLIER`, `NAMASUPPLIER`, `NEGARA`, `PROVINSI`, `KOTAKAB`, `KECAMATAN`, `ALAMAT`, `NOTELP`, `NAMABANK`, `NOREK`, `ATASNAMA`, `EMAIL`, `KODEUNIKMEMBER`) VALUES (0, 'UNKWNSUP', 'Suplier Tidak Terdeteksi', '', '-', '-', '', '-', '-', '', '-', '-', '-', '"+req.body.KODEUNIKMEMBER+"')", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_kategori`(`AI`, `KATEGORIPARENT_ID`, `NAMAKATEGORI`, `LOGOKATEGORI`, `KODEUNIKMEMBER`, `BEBANGAJI`, `BEBANPACKING`, `BEBANPROMO`, `BEBANTRANSPORT`) VALUES (0, 'UNKWNKAT', 'TIDAK ADA KATEGORI', 'https://www.pngmart.com/files/17/Task-PNG-Photos.png', '"+req.body.KODEUNIKMEMBER+"', 0.00, 0.00, 0.00, 0.00)", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_barangsatuan`(`AI`, `NAMASATUAN`, `KETERANGAN`, `KODEUNIKMEMBER`) VALUES (0, 'PCS', 'Pieces','"+req.body.KODEUNIKMEMBER+"')", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_perusahaan`(`AI`, `KODEPERUSAHAAN`, `NAMAPERUSAHAAN`, `NAMAPEMILIK`, `NPWP`, `ALAMAT`, `NOTELEPON`, `KODEUNIKMEMBER`) VALUES (0, '0', 'Perusahaan Induk', 'Perusahaan Induk', '-', '-', '-', '"+req.body.KODEUNIKMEMBER+"')", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_brand`(`AI`, `BRAND_ID`, `NAMA_BRAND`, `KODEUNIKMEMBER`) VALUES (0, '0', 'BRAND TIDAK DIKETAHUI', '"+req.body.KODEUNIKMEMBER+"')", [], con);
      await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_sales`(`AI`, `KODESALES`, `NAMA`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`, `TELEPON`, `FAX`, `EMAIL`, `NOREK`, `PEMILIKREK`, `BANK`, `KETERANGAN`, `KODEUNIKMEMBER`) VALUES (0, 'SLSUMUM', 'Salesman Umum', 'Alamat salesman ini belum diset', 'Kota tidak diketahui', 'Provinsi tidak diketahui', 'INDONESIA', '', '', '', '', '', '', '', '', '"+req.body.KODEUNIKMEMBER+"')", [], con);
      await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_penggunaaplikasi`(`PENGGUNA_ID`, `NAMA`, `NAMAOUTLET`, `NAMAPENGGUNA`, `PASSWORD`, `KODEUNIKMEMBER`, `URLFOTO`, `HAKAKSESID`, `ALAMAT`, `NOTELP`, `NOREKENING`, `KETERANGAN`, `TOTALDEPOSIT`, `IDHAKAKSES`, `PIN`, `LATLONG`, `EMAIL`, `TOKENKEY`,`STATUSAKTIF`,`NOMOR`,`VERIF_WA`,`VERIF_EMAIL`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [0,req.body.NAMA,req.body.NAMAOUTLET,req.body.NAMAPENGGUNA,hashedPassword,req.body.KODEUNIKMEMBER,'','OWNER','',req.body.WHATSAPP,'','','0','1','','',req.body.EMAIL,tokenjwt,'1',Math.random() * (9 - 1), "", ""], con)
      await util.eksekusiQueryPromise(req,"COMMIT", [], con);
      queryok = true;
      pesan = 'Pendaftaran akun anda berhasil, SILAHKAN MASUK menggunakan NAMAPENGGUNA dan KATASANDI yang sudah anda buat.Mari bekerjasama memberikan pelayan terbaik untuk perusahaan ini. Semoga menjadi rekan yang saling menguntungkan'
    }catch(error){
      await util.eksekusiQueryPromise(req, 'ROLLBACK', [], con);
      queryok = false;
      pesan = "Terjadi kesalahan dalam bergabung ke keluarga ACIPAY, Pendaftaran dirollback karena terjadi kesalahan: "+error.message;
    }
    if (queryok) {
      data = {
        success: true,
        rc: 200,
        msg: pesan,
        data: []
      };
    }else{
      data = {
        success: false,
        rc: 500,
        msg: pesan,
        data: []
      };
    }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.simpanpegawai = async function (req, data, con) {
  pesanbalik = [];
  let queryproses;
  let hashedPIN = await bcrypt.hash(data[14], 10)
  let hashedPassword = await bcrypt.hash(data[4], 10)
  let tokenjwt = jwt.sign({ username: data[3], kodeunikmember: data[5] }, process.env.ACCESS_TOKEN_RHS, { expiresIn: '1y'  });
  let adadata = await util.eksekusiQueryPromise(req, `SELECT COALESCE(COUNT(*),0) as ADADATA FROM 01_tms_penggunaaplikasi where EMAIL = ? AND KODEUNIKMEMBER = ?`, [data[16], data[5]], con);
  if (adadata[0].ADADATA > 0 && data[20] == 0) {
    data = {
      success: false,
      rc: 404,
      msg: 'Informasi email atau username yang didaftarkan pada Sistem sudah terdaftar, silahkan daftarkan dengan akun lain',
      data: []
    };
  } else {
    if (data[20] == 1){
      queryproses= await util.eksekusiQueryPromise(req, 'UPDATE `01_tms_penggunaaplikasi` SET `NAMA` = ?, `NAMAOUTLET` = ?, `NAMAPENGGUNA` = ?, `URLFOTO` = ?, `ALAMAT` = ?, `NOTELP` = ?, `NOREKENING` = ?, `KETERANGAN` = ?, `IDHAKAKSES` = ?, `LATLONG` = ?, `EMAIL` = ? WHERE `PENGGUNA_ID` = ? AND KODEUNIKMEMBER = ?', [data[1],data[2],data[3],data[6],data[7],data[9],data[10],data[11],data[13],data[15],data[16],data[0],data[5]], con)
    }else{
      queryproses= await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_penggunaaplikasi`(`AI_PENGGUNA`,`PENGGUNA_ID`, `NAMA`, `NAMAOUTLET`, `NAMAPENGGUNA`, `PASSWORD`, `KODEUNIKMEMBER`, `URLFOTO`, `HAKAKSESID`, `ALAMAT`, `NOTELP`, `NOREKENING`, `KETERANGAN`, `TOTALDEPOSIT`, `IDHAKAKSES`, `PIN`, `LATLONG`, `EMAIL`, `TOKENKEY`, `STATUSAKTIF`, `NOMOR`) VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [data[0],data[1],data[2],data[3],hashedPassword,data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12],data[13],hashedPIN,data[15],data[16],tokenjwt,data[18],data[19]], con)
    }
    if (queryproses.affectedRows > 0) {
      data = {
        success: 'true',
        rc: 'S01',
        msg: (data[20] == 1 ? "Informasi NAMA : "+data[1]+" berhasil diubah dengan MEMBER ID : "+data[0]:"'Pendaftaran akun anda berhasil, mari bekerjasama memberikan pelayan terbaik untuk perusahaan ini. Semoga menjadi rekan yang saling menguntungkan'")
      };
    } else {
      data = {
        success: 'false',
        rc: queryproses.code,
        msg: queryproses.sqlMessage
      };
    }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.loginapps = async function (req, data, con) {
  pesanbalik = [];
  cekHash = await util.eksekusiQueryPromise(req, 'SELECT COUNT(*) as ADADATA, A.TOKENKEY, A.KODEUNIKMEMBER,A.PENGGUNA_ID,A.NAMAPENGGUNA,A.TOTALDEPOSIT,A.NAMA,A.HAKAKSESID,A.URLFOTO,B.JSONMENU,C.PAJAKNEGARA,C.PAJAKTOKO ,A.PASSWORD, COALESCE(SUM(C.AI),0) as PUNYAOUTLET, KODEOUTLET, A.EMAIL, A.VERIF_WA, A.NOTELP FROM 01_tms_penggunaaplikasi as A JOIN 01_tms_penggunaaplikasiha as B ON A.IDHAKAKSES = B.AI LEFT JOIN 01_set_outlet as C ON A.KODEUNIKMEMBER = C.KODEUNIKMEMBER WHERE NAMAPENGGUNA = ? AND STATUSAKTIF = 1 LIMIT 1', [req.body.NAMAPENGGUNA], con);
  if (cekHash[0].ADADATA == 0) {
    data = {
      success: false,
      rc: 404,
      msg: 'Pastikan informasi yang anda masukkan valid, tidak terblokir dan terdaftar pada sistem kami',
      data: []
    };
  }else{
    passplain = await bcrypt.compare(req.body.PASSWORDWEB, (typeof cekHash[0].PASSWORD === "undefined" ? "" : cekHash[0].PASSWORD));
    if (passplain == true) {
      data = {
        success: true,
        rc: 200,
        msg: "Informasi dengan NAMA PENGGUNA "+req.body.NAMAPENGGUNA+" ditemukan.",
        data: cekHash
      };
    }else{
      data = {
        success: false,
        rc: 404,
        msg: 'Pastikan informasi yang anda masukkan valid, tidak terblokir dan terdaftar pada sistem kami',
        data: []
      };
    }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.outlet = async function (req, data, con) {
  pesanbalik = [];
  let dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_set_outlet WHERE (KODEOUTLET LIKE ? OR NAMAOUTLET LIKE ?) AND KODEUNIKMEMBER = ?', ['%' + data[0] + '%','%' + data[0] + '%', data[1]], con);
  if (dataquery.length > 0) {
      data = {
          success: "true",
          totaldataquery:dataquery.length,
          dataquery:dataquery,
          msg: "Informasi outlet terdaftar sudah tersajikan. Silahkan kelola outlet anda yang keren keren itu",
      }
  } else {
      data = {
          success: 'false',
          totaldataquery:0,
          msg: "Mohon maaf anda tidak memiliki cabang outlet untuk dikelola",
          dataquery:[],
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.hapusoutlet = async function (req, data, con) {
  pesanbalik = [];
  let dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_set_outlet WHERE KODEOUTLET = ? AND KODEUNIKMEMBER = ?', [data[0], data[1]], con);
  if (dataquery.affectedRows > 0) {
      data = {
          success: "true",
          rc: "200",
          msg: "Outlet berhasil dihapus. Tapi ingat informasi seperti TRANSAKSI, MASTER ITEM, JURNAL masih tetap ada didalam DATABASE",
      }
  } else {
      data = {
          success: 'false',
          rc: dataquery.code,
          msg: dataquery.sqlMessage,
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.detailinformasioutlet = async function (req, data, con) {
  pesanbalik = [];
  let dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_set_outlet WHERE KODEOUTLET = ? AND KODEUNIKMEMBER = ?', [data[0], data[1]], con);
  if (dataquery.length > 0) {
      data = {
          success: "true",
          rc: "200",
          data:dataquery,
      }
  } else {
      data = {
          success: 'false',
          rc: dataquery.code,
          msg: dataquery.sqlMessage,
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.daftarpegawai = async function (req, data, con) {
  pesanbalik = [];
  let dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_penggunaaplikasi as A JOIN 01_tms_penggunaaplikasiha as B ON A.IDHAKAKSES = B.AI WHERE A.KODEUNIKMEMBER = ? AND (PENGGUNA_ID LIKE ? OR NAMA LIKE ? OR NAMAPENGGUNA LIKE ?)', [data[1],'%' + data[0] + '%','%' + data[0] + '%','%' + data[0] + '%'], con);
  if (dataquery.length > 0) {
      data = {
          success: "true",
          rc: "200",
          data:dataquery,
          jumlahdata:dataquery.length,
      }
  } else {
      data = {
          success: 'false',
          rc: dataquery.code,
          msg: dataquery.sqlMessage,
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.statuspegawai = async function (req, data, con) {
  pesanbalik = [];
  let dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_tms_penggunaaplikasi` SET `STATUSAKTIF` = ? WHERE `PENGGUNA_ID` = ? AND KODEUNIKMEMBER = ?', [data[3],data[0],data[4]], con);
  if (dataquery.affectedRows > 0) {
      data = {
          success: "true",
          rc: "200",
          msg: "Yeah.. informasi status pegawai berubah menjadi "+(data[3] == "1" ? "AKTIF" : "TIDAK AKTIF")+"."
      }
  } else {
      data = {
          success: 'false',
          rc: dataquery.code,
          msg: dataquery.sqlMessage,
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.simpanhakakses = async function (req, data, con) {
  pesanbalik = [];
  let dataquery;
  if (data[3] == 'true'){
    dataquery = await util.eksekusiQueryPromise(req, "UPDATE 01_tms_penggunaaplikasiha SET NAMAHAKAKSES = ?, JSONMENU = ? WHERE AI = ? AND KODEUNIKMEMBER = ?", [data[1],data[2],data[4],data[0]], con);
  }else{
    dataquery = await util.eksekusiQueryPromise(req, "INSERT INTO `01_tms_penggunaaplikasiha`(`AI`, `KODEUNIKMEMBER`, `NAMAHAKAKSES`, `JSONMENU`) VALUES (0, ?, ?, ?)", [data[0],data[1],data[2]], con);
  }
  if (dataquery.affectedRows > 0) {
      data = {
          success: "true",
          rc: "200",
          msg: "Hak akses berhasil ditambahkan dengan NAMA : "+data[1]+" pada TENNAT ID : "+data[0]
      }
  } else {
      data = {
          success: 'false',
          rc: dataquery.code,
          msg: dataquery.sqlMessage,
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.daftarhakakses = async function (req, data, con) {
  pesanbalik = [];
  let dataquery = await util.eksekusiQueryPromise(req, "SELECT * FROM 01_tms_penggunaaplikasiha WHERE KODEUNIKMEMBER = ? AND NAMAHAKAKSES LIKE ? AND AI > 1", [data[0],'%'+data[1]+'%'], con);
  if (dataquery.length > 0) {
    data = {
        success: "true",
        rc: "200",
        msg: "Data ditemukan.",
        data:dataquery,
        totaldata:dataquery.length,
    }
  } else {
      data = {
          success: 'false',
          rc: dataquery.code,
          msg: dataquery.sqlMessage,
          data:null,
          totaldata:0,
      }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.ubahpasswordproses = async function (req, data, con) {
  pesanbalik = [];
  let dataquery = await util.eksekusiQueryPromise(req, 'SELECT PASSWORD FROM 01_tms_penggunaaplikasi WHERE PENGGUNA_ID = ? AND KODEUNIKMEMBER = ?', [data[4],data[3]], con);
  if (dataquery.length > 0) {
    passplain = await bcrypt.compare(data[1], (typeof dataquery[0].PASSWORD === "undefined" ? "" : dataquery[0].PASSWORD));
    if (passplain == true) {
      let hashedPassword = await bcrypt.hash(data[2], 10)
      dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_tms_penggunaaplikasi` SET `PASSWORD` = ? WHERE `PENGGUNA_ID` = ? AND KODEUNIKMEMBER = ?', [hashedPassword,data[0],data[3]], con);
      if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: "Katasandi sudah diubah. Silahkan pengguna yang bersangkutan agar diarahkan untuk RE-LOG."
        }
      }else{
        data = {
          success: 'false',
          rc: dataquery.code,
          msg: dataquery.sqlMessage,
        }
      }
    }else{
      data = {
        success: 'false',
        rc: 404,
        msg: "Katasandi yang kamu masukan tidak cocok. Silahkan ulangi lagi jika ingin melanjutkan",
      }
    }
  }else{
    data = {
      success: 'false',
      rc: dataquery.code,
      msg: dataquery.sqlMessage,
    }
  }
  pesanbalik.push(data)
  return pesanbalik;
}
auth.verifikasiuser = async function (req, con) {
  let kolomverif = "VERIF_WA";
  if (req.body.JENISOTP == "email"){
    kolomverif = "VERIF_EMAIL"
  }
  let dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_tms_penggunaaplikasi` SET '+kolomverif+' = ? WHERE `NAMAPENGGUNA` = ? AND KODEUNIKMEMBER = ?', [Buffer.from(req.body.KODEUNIKMEMBER+req.body.NAMAPENGGUNA).toString('base64'),req.body.NAMAPENGGUNA,req.body.KODEUNIKMEMBER], con);
  if (dataquery.affectedRows > 0) {
    return true
  }else{
    return false
  }
}
module.exports = auth;