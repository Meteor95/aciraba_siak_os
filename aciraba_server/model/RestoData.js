require('dotenv').config()
const { query } = require('express');
const util = require('../config/utils');
const moment = require('moment');
const resto = {}
let pesanbalik = {}
resto.ajaxpanggillantai = async function (req, data, con) {
    pesanbalik = [];
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT LANTAI FROM 01_tms_resto_daftarmeja WHERE OUTLET = ? AND KODEUNIKMEMBER = ? AND KODEMEJA != ? GROUP BY LANTAI', [
        data[0], data[1], '0'], con)
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
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
resto.ajaxdetailpesanan = async function (req, data, con) {
    pesanbalik = [];
    let dataquery;
    if (data[3] == "kasir"){
        dataquery = await util.eksekusiQueryPromise(req, 'SELECT *,B.AI_TRANSAKSIKELUAR as AI_TRANSAKSIKELUAR, COUNT(*) as ADADATA, MAX(STATUSBARANGPROSES) as MAXPROSES, MIN(STATUSBARANGPROSES) as MINPROSES FROM 01_tms_resto_pesanmeja as A JOIN 01_trs_barangkeluar as B ON A.KODEMENUPESANAN = B.PK_NOTAPENJUALAN JOIN 01_trs_barangkeluar_detail as C ON A.KODEMENUPESANAN = C.PK_NOTAPENJUALAN WHERE (A.TANGGAL BETWEEN ? AND ?) AND KODEMEJA LIKE ? AND A.OUTLET = ? AND A.KODEUNIKMEMBER = ?', [data[4],data[5],'%'+data[0]+'%', data[1], data[2]], con)
    }else{
        dataquery = await util.eksekusiQueryPromise(req, 'SELECT *,B.AI_TRANSAKSIKELUAR as AI_TRANSAKSIKELUAR, COUNT(*) as ADADATA, MAX(STATUSBARANGPROSES) as MAXPROSES, MIN(STATUSBARANGPROSES) as MINPROSES FROM 01_tms_resto_pesanmeja as A JOIN 01_trs_barangkeluar_detail as B ON A.KODEMENUPESANAN = B.PK_NOTAPENJUALAN WHERE KODEMEJA = ? AND A.OUTLET = ? AND A.KODEUNIKMEMBER = ?', [data[0], data[1], data[2]], con)
    }
    if (dataquery[0].ADADATA > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
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
resto.updatestatuspemesanan = async function (req, data, con) {
    pesanbalik = [];
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM `01_tms_resto_pesanmeja` WHERE `KODEMENUPESANAN` = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?', [data[1], data[2], data[3]], con)
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_barangkeluar WHERE PK_NOTAPENJUALAN = ? AND LOKASI = ? AND KODEUNIKMEMBER = ?', [data[1], data[2], data[3]], con)
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = ? AND KODEUNIKMEMBER = ?', [data[1], data[3]], con)
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
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
resto.hapusinformasimeja = async function (req, data, con) {
    pesanbalik = [];
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT COUNT(*) as ADADATA FROM 01_tms_resto_pesanmeja WHERE `KODEMEJA` = ? AND OUTLET = ? AND KODEUNIKMEMBER = ? AND STATUSPESAN > 0', [data[0], data[1], data[2]], con)
    if (dataquery[0].ADADATA > 0) {
        data = {
            success: 'false',
            rc: "FAILED01",
            msg: "Mohon maaf, masih ada informasi yang menggunakan KODE MEJA "+data[0]+" untuk dipesan. Silahkan batalkan terlebih dahulu sebelum menghapus data meja ini",
        }
    }else{
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM `01_tms_resto_daftarmeja` WHERE `KODEMEJA` = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?', [data[0], data[1], data[2]], con)
        if (dataquery.affectedRows > 0) {
            data = {
                success: "true",
                rc: "200",
                totaldata: dataquery.length,
                dataquery: dataquery,
            }
        } else {
            data = {
                success: 'false',
                rc: dataquery.code,
                msg: dataquery.sqlMessage,
            }
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
resto.simpaninformasimeja = async function (req, data, con) {
    pesanbalik = [];
    let dataquery;
    if (data[9] == "0"){
        dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_tms_resto_daftarmeja` SET `NAMAMEJA` = ?, `GAMBAR` = ?, `KETERANGAN` = ?, `LANTAI` = ?, `JAMBUKA` = ?, `JAMTUTUP` = ? WHERE `KODEMEJA` = ?', [data[1], data[2], data[3], data[4], data[7], data[8], data[0]], con)
    }else{
        dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_resto_daftarmeja`(`AI`,`KODEMEJA`, `NAMAMEJA`, `GAMBAR`, `KETERANGAN`, `LANTAI`, `OUTLET`, `KODEUNIKMEMBER`, `JAMBUKA`, `JAMTUTUP`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', ['0', data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8]], con)
    }
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
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
resto.loadkds = async function (req, data, con) {
    pesanbalik = [];
    let dataquery, tanggalawal, tanggalakhir, querykategori = "";
    tanggalawal = data[1]
    tanggalakhir = data[2]
    if (data[6] == "onload"){
        tanggalawal = moment().format('YYYY-MM-DD'), tanggalakhir = moment().format('YYYY-MM-DD');
    }
    if (data[6] == "kategori"){
        querykategori = " AND D.KATEGORI_ID = '"+data[7]+"'"
    }
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT *, B.AI_TRANSAKSIKELUAR as KODEAI, B.KETERANGAN as KETERANGANITEM FROM 01_trs_barangkeluar_detail as A JOIN 01_trs_barangkeluar as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN JOIN 01_tms_member as C ON B.FK_MEMBER = C.MEMBER_ID JOIN 01_tms_barangkharisma as D ON A.FK_BARANG = D.BARANG_ID WHERE (B.TIPETRANSAKSI BETWEEN 1 AND 100) AND (A.TANGGALPROSES BETWEEN ? AND ?) AND A.PK_NOTAPENJUALAN LIKE ? AND B.LOKASI = ? AND STATUSBARANGPROSES >= -1 AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? '+querykategori+' GROUP BY FK_BARANG,A.PK_NOTAPENJUALAN ORDER BY A.TANGGALPROSES ASC, A.WAKTUPROSES ASC', [tanggalawal, tanggalakhir, '%'+data[0]+'%', data[4], data[5],data[5],data[5],data[5]], con)
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
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
resto.sundulpesanan = async function (req, data, con) {
    pesanbalik = [];
    let dataquery;
    const minWaktuProsesResult = await util.eksekusiQueryPromise(req, `SELECT SUBTIME(MIN(WAKTUPROSES), ?) AS min_waktuproses FROM 01_trs_barangkeluar_detail WHERE TANGGALPROSES = CURDATE() AND KODEUNIKMEMBER = ?`, ['00:01:00', data[2]], con);
    dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_trs_barangkeluar_detail` SET `WAKTUPROSES` = ? WHERE `PK_NOTAPENJUALAN` = ? AND TANGGALPROSES = CURDATE() AND KODEUNIKMEMBER = ?', [minWaktuProsesResult[0].min_waktuproses, data[0], data[2]], con)
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
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
resto.ubahstatuspesanan = async function (req, data, con) {
    pesanbalik = [];
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_trs_barangkeluar_detail` SET `STATUSBARANGPROSES` = ? WHERE `PK_NOTAPENJUALAN` = ? AND FK_BARANG = ? AND KODEUNIKMEMBER = ?', [data[1], data[2], data[0], data[4]], con)
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
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
resto.tandaisemuaselesai = async function (req, data, con) {
    pesanbalik = [];
    let dataquery,statusubah = '-2';
    if (data[3] != "") statusubah = '-3'
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT COUNT(*) as ADAYANGPROSES FROM 01_trs_barangkeluar_detail WHERE (STATUSBARANGPROSES = 0 OR STATUSBARANGPROSES = 1) AND PK_NOTAPENJUALAN = ? AND KODEUNIKMEMBER = ?', [data[0], data[2]], con)
    if (dataquery[0].ADAYANGPROSES > 0) {
        data = {
            success: 'false',
            errorcode: '404',
            msg: "Proses tidak bisa dilanjutkan karena masih ada menu yang belum selesai di proses ",
        }
    }else{
        dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_trs_barangkeluar_detail` SET `STATUSBARANGPROSES` = ? WHERE `PK_NOTAPENJUALAN` = ? AND KODEUNIKMEMBER = ?', [statusubah, data[0], data[2]], con)
        if (dataquery.affectedRows > 0) {
            data = {
                success: "true",
                rc: "200",
                totaldata: dataquery.length,
                dataquery: dataquery,
            }
        } else {
            data = {
                success: 'false',
                rc: dataquery.code,
                msg: dataquery.sqlMessage,
            }
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
resto.filterbystatuspesanan = async function (req, data, con) {
    pesanbalik = [];
    let dataquery, stringhavingsql = "", statusproses = "";
    if (data[0] == "0" || data[0] == "-2" || data[0] == "-3") stringhavingsql = "HAVING TOTALDATA = DATATERPROSES";
    if (data[0] == "1") { stringhavingsql = "HAVING TOTALDATA <> DATATERPROSES"; statusproses = " AND STATUSBARANGPROSES > '-2'" };
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT *, B.AI_TRANSAKSIKELUAR as KODEAI, B.KETERANGAN as KETERANGANITEM, (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN AND KODEUNIKMEMBER = ?) as TOTALDATA, (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN AND STATUSBARANGPROSES = ? AND KODEUNIKMEMBER = ?) as DATATERPROSES FROM 01_trs_barangkeluar_detail as A JOIN 01_trs_barangkeluar as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN JOIN 01_tms_member as C ON B.FK_MEMBER = C.MEMBER_ID WHERE TANGGALPROSES = CURDATE() AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND (B.TIPETRANSAKSI BETWEEN 1 AND 100) '+statusproses+' '+stringhavingsql+' ORDER BY WAKTUPROSES ASC ', [data[2],data[0],data[2],data[2],data[2],data[2]], con)
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
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
module.exports = resto;