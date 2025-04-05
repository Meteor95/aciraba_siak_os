require('dotenv').config()
const util = require('../config/utils');
const con = require("../config/db.js")
const moment = require('moment');
const bcrypt = require('bcrypt');
const { join } = require('lodash');
const penjualan = {}
let pesanbalik = {}
let batchinsert = {};

penjualan.cekpintrx = async function (req, data, con) {
    let tabel,kolom,kolompin;
    if (data[0] == "01_tms_penggunaaplikasi"){tabel = "01_tms_penggunaaplikasi";kolom = "NAMAPENGGUNA";kolompin="PIN";}else if (data[0] == "01_tms_member"){tabel == "01_tms_member";kolom = "USERNAME";kolompin="PINTRX";}
    let dataquery = await util.eksekusiQueryPromise(req, 'SELECT COUNT(*) as ADADATA,'+kolompin+' as PINNYA FROM '+tabel+' WHERE '+kolom+' = ?', [data[1]], con);
    if (dataquery[0].ADADATA == 0) {
        return false;
    }
    passplain = await bcrypt.compare(data[1], dataquery[0].PINNYA);
    if (passplain == true) {
        return true;    
    }else{
        return false;
    }
}
penjualan.simpanpembelian = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = []
    let dataquery, pesan = "", waktu = moment().format('HH:mm:ss');
    for (let i = 0; i < data[0].length; i++) {
        var obj = {
            PK_BARANGMASUK: '0',
            NOTA: data[1],
            KODEBARANG: data[0][i][0],
            HARGABELI: data[0][i][1],
            JUMLAHBELI: data[0][i][2],
            DISPLAY: data[0][i][3],
            GUDANG: data[0][i][4],
            EXP: data[0][i][5],
            DISKON1: data[0][i][6],
            DISKON2: data[0][i][7],
            PPN: data[0][i][8],
            AFTERDISKON1: data[0][i][9],
            AFTERDISKON2: data[0][i][10],
            HPP: data[0][i][11],
            BEBANGAJI: data[0][i][12],
            BEBANPROMO: data[0][i][13],
            BEBANPACKING: data[0][i][14],
            BEBANTRANSPORT: data[0][i][15],
            HPPBEBAN: data[0][i][16],
            OUTLET: data[12],
            KODEUNIKMEMBER: data[13],
            DARISUBPERUSAHAAN: data[14],
            NAMABARANG:data[0][i][17],
        };
        batchinsert.push(obj);
    }
    if (data[18] == "true"){
        let dataquery = await util.eksekusiQueryPromise(req, "SELECT DATE_FORMAT(TANGGALTRS,'%H:%i:%s') as WAKTUPEMBELIAN FROM 01_trs_barangmasuk WHERE NOTA = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?",[data[1],data[12],data[13]], con)
        if (dataquery.length > 0){
            waktu = dataquery[0].WAKTUPEMBELIAN;
        }
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_barangmasuk_detail WHERE NOTA = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[1],data[12],data[13]], con)
        if (dataquery.affectedRows > 0) {
            dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_barangmasuk WHERE NOTA = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[1],data[12],data[13]], con)
        }else{
            data = {
                success: 'false',
                rc: dataquery.code,
                msg: dataquery.sqlMessage,
            }
        }
    }
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_barangmasuk`(`PK_BARANGMASUK`, `NOTA`, `FK_SUPPLIER`, `TANGGALTRS`, `KETERANGAN`, `TOP`, `NAMATOP`, `JATUHTEMPO`, `PETUGAS`, `TOTALPEMBELIAN`, `TOTALPEMBELIANBEBAN`, `TOTALHUTANG`, `TOTALPPNMASUKAN`,`BIAYALAINLAIN`, `OUTLET`, `KODEUNIKMEMBER`, `DARISUBPERUSAHAAN`, `NOMOR`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            '0', data[1], data[2], data[3]+" "+waktu, data[4] , data[5] , data[17], data[6] , data[7] , data[8] , data[9] , data[10] , data[16], data[11] , data[12] , data[13] , data[14] , data[15] ], con)
    if (dataquery.affectedRows > 0){
        dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO 01_trs_barangmasuk_detail(`PK_BARANGMASUK`, `NOTA`, `KODEBARANG`, `HARGABELI`, `JUMLAHBELI`, `DISPLAY`, `GUDANG`, `EXP`, `DISKON1`, `DISKON2`, `PPN`, `AFTERDISKON1`, `AFTERDISKON2`, `HPP`, `BEBANGAJI`, `BEBANPROMO`, `BEBANPACKING`, `BEBANTRANSPORT`, `HPPBEBAN`, `OUTLET`, `KODEUNIKMEMBER`, `DARISUBPERUSAHAAN`,`NAMABARANG`) VALUES   ?', [batchinsert.map(item => [item.PK_BARANGMASUK, item.NOTA, item.KODEBARANG, item.HARGABELI, item.JUMLAHBELI, item.DISPLAY, item.GUDANG, item.EXP, item.DISKON1, item.DISKON2, item.PPN, item.AFTERDISKON1, item.AFTERDISKON2, item.HPP, item.BEBANGAJI, item.BEBANPROMO, item.BEBANPACKING, item.BEBANTRANSPORT, item.HPPBEBAN, item.OUTLET, item.KODEUNIKMEMBER, item.DARISUBPERUSAHAAN, item.NAMABARANG])], con)
        if (dataquery.affectedRows > 0) {
            if (data[18] == "true"){
                dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_kartulog_suplier`(`KARTUSUP_AI`, `KODESUPPLIER`, `NOTRANSAKSI`, `TGLTRANSAKSI`, `PROSESAPA`, `KETERANGAN`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
                    '0',data[2], data[1], data[3]+" "+moment().format('HH:mm:ss'), "PEMBELIAN UBAH" , "PERUBAHAN INFORMASI TRASNAKSI PEMBELIAN PADA OUTLET "+data[12] , data[12], data[13]], con)
            }else{
                dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_kartulog_suplier`(`KARTUSUP_AI`, `KODESUPPLIER`, `NOTRANSAKSI`, `TGLTRANSAKSI`, `PROSESAPA`, `KETERANGAN`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
                    '0',data[2], data[1], data[3]+" "+moment().format('HH:mm:ss'), "PEMBELIAN MASUK" , "TRANSKASI SUPLIER MEMASUKKAN BARANG KE OUTLET "+data[12] , data[12], data[13]], con)
            }
            data = {
                success: "true",
                rc: "200",
                msg: "Transaksi pembelian berhasil",
            }
        } else {
            data = {
                success: 'false',
                rc: dataquery.code,
                msg: dataquery.sqlMessage,
            }
        }
    }else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.hapuspembelian = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = []
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_barangmasuk_detail WHERE NOTA = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[0],data[1],data[2]], con)
    if (dataquery.affectedRows > 0) {
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_barangmasuk WHERE NOTA = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[0],data[1],data[2]], con)
        if (dataquery.affectedRows > 0) {
            dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_kartulog_suplier`(`KARTUSUP_AI`, `KODESUPPLIER`, `NOTRANSAKSI`, `TGLTRANSAKSI`, `PROSESAPA`, `KETERANGAN`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [
                '0',data[3], data[0], moment().format('YYYY-MM-DD HH:mm:ss'), "PEMBELIAN HAPUS" , "PENGHAPUSAN INFORMASI TRASNAKSI PEMBELIAN PADA OUTLET "+data[1],data[1],data[2]], con)
            data = {
                success: "true",
                rc: "200",
                msg: "Hapus transaksi dengan NOTA "+data[0]+" berhasil. Stok akan dikurangi dan dicatat pada KARTU STOK",
            }
        } else {
            data = {
                success: 'false',
                rc: dataquery.code,
                msg: dataquery.sqlMessage,
            }
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
penjualan.transaksihutang = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = []
    let dataquery, pesan = "";
    for (let i = 0; i < data[0].length; i++) {
        var obj = {
            NOTRANSAKSI: data[1],
            TRANSAKSI_ID: data[0][i][0],
            SUPPLIER_ID: data[2],
            TANGGALTRS: data[3],
            WAKTU: data[4],
            PETUGAS: data[5],
            BAYAR: data[0][i][1],
            KETERANGAN: data[6],
            LOKASI: data[7],
            KODEUNIKMEMBER: data[8],
            NOMOR: data[9],
            NOTARETURBELI: "",
        };
        batchinsert.push(obj);
    }
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_hutangtoko_detail(NOTRANSAKSI, TRANSAKSI_ID, SUPPLIER_ID, TANGGALTRS, WAKTU, PETUGAS, BAYAR, KETERANGAN, LOKASI, KODEUNIKMEMBER, NOMOR) VALUES ?`, [batchinsert.map(item => [item.NOTRANSAKSI, item.TRANSAKSI_ID, item.SUPPLIER_ID, item.TANGGALTRS, item.WAKTU, item.PETUGAS, item.BAYAR, item.KETERANGAN, item.LOKASI, item.KODEUNIKMEMBER, item.NOMOR])], con)
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: 'Informasi pembayaran hutang dengan NOTA '+data[1]+" berhasil disimpan. Semoga lekas lunas brey...",
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
penjualan.hapustransaksibhutang = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = []
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_tms_hutangtoko_detail WHERE NOTRANSAKSI = ? AND LOKASI = ? AND KODEUNIKMEMBER = ?',[data[0],data[2],data[1]], con)
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: "Hapus transaksi pembayaran hutang dengan NOTA "+data[0]+" berhasil. Tagihan akan ditambahkan lagi pada NOTA "+data[0]+" sesuai nominal hapus",
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
penjualan.hapustransaksihutang = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = "";
    if (data[3] == 'true'){
        dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_hutangtoko_detail WHERE AI = ?`, [data[0]], con);
    }else if (data[3] == 'edit'){
        dataquery = await util.eksekusiQueryPromise(req, `UPDATE 01_tms_hutangtoko_detail SET BAYAR = ? WHERE AI = ?`, [data[4], data[0]], con);
    }
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: data[3] == 'edit' ? 'Informasi pembayaran hutang dengan SUB NOTA '+data[0]+' berhasil diubah' : 'Informasi pembayaran hutang dengan NOTA '+data[0]+' berhasil dihapus. Saldo hutang akan dikembalikan ke suplier terkait',
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
penjualan.ubahhargajualafb = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = "";
    dataquery = await util.eksekusiQueryPromise(req, `UPDATE 01_tms_barangkharisma SET HARGAJUAL = ? WHERE BARANG_ID = ? AND KODEUNIKMEMBER = ?`, [data[1], data[0], data[3]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: 'Harga Jual Berhasil Diubah',
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
penjualan.tambahreturpembelian = async function (req, data, con) {
    pesanbalik = [], batchinsertretur = [],batchinsertpotong = [];
    let dataquery, pesan = "",waktu = moment().format('HH:mm:ss');
    if (data[13] == "1"){
        let dataquery = await util.eksekusiQueryPromise(req, "SELECT DATE_FORMAT(TANGGALTRS,'%H:%i:%s') as WAKTUPEMBELIAN FROM 01_trs_returpembelian WHERE NOTRXRETURBELI = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?",[data[3],data[11],data[12]], con)
        if (dataquery.length > 0){
            waktu = dataquery[0].WAKTUPEMBELIAN;
        }
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_returpembelian_detail WHERE NOTRXRETURBELI = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[3],data[11],data[12]], con)
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_returpembelian WHERE NOTRXRETURBELI = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[3],data[11],data[12]], con)
    }
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_returpembelian`(`AI`, `NOTRXRETURBELI`, `PETUGAS`, `SUPPLIERID`, `TANGGALTRS`, `NOMOR`, `TOTALBARANG`, `TOTALNOMINAL`, `TOTALPOTONGAN`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', ['0',data[3],data[4],data[5],data[6]+" "+waktu,data[7],data[8],data[9],data[10],data[11],data[12]], con)
    if (dataquery.affectedRows > 0) {
        if (data[2] == "true"){
            for (let i = 0; i < data[1].length; i++) {
                var obj = {
                    AI: data[1][i][0],
                    NOTRANSAKSI: data[1][i][1],
                    TRANSAKSI_ID: data[1][i][2],
                    SUPPLIER_ID: data[1][i][3],
                    TANGGALTRS: data[1][i][4],
                    WAKTU: data[1][i][5],
                    PETUGAS: data[1][i][6],
                    BAYAR: data[1][i][7],
                    KETERANGAN: data[1][i][8],
                    LOKASI: data[1][i][9],
                    KODEUNIKMEMBER: data[1][i][10],
                    NOMOR: data[1][i][11],
                    NOTARETURBELI: data[1][i][12],
                };
                batchinsertpotong.push(obj);
            }
            dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_hutangtoko_detail`(`AI`, `NOTRANSAKSI`, `TRANSAKSI_ID`, `SUPPLIER_ID`, `TANGGALTRS`, `WAKTU`, `PETUGAS`, `BAYAR`, `KETERANGAN`, `LOKASI`, `KODEUNIKMEMBER`, `NOMOR`, `NOTARETURBELI`) VALUES ?', [batchinsertpotong.map(item => [item.AI, item.NOTRANSAKSI, item.TRANSAKSI_ID, item.SUPPLIER_ID, item.TANGGALTRS, item.WAKTU, item.PETUGAS, item.BAYAR, item.KETERANGAN, item.LOKASI,item.KODEUNIKMEMBER, item.NOMOR, item.NOTARETURBELI])], con);
        }
        for (let i = 0; i < data[0].length; i++) {
            var obj = {
                AI: data[0][i][0],
                NOTRXRETURBELI: data[0][i][1],
                NOTRXPEMBELIAN: data[0][i][2],
                KODEBARANG: data[0][i][3],
                NAMABARANG: data[0][i][4],
                JUMLAHBELI: data[0][i][5],
                JUMLAHRETUR: data[0][i][6],
                HARGABELI: data[0][i][7],
                POTONGAN: data[0][i][8],
                PPN: data[0][i][9],
                ASALOUTLET: data[0][i][10],
                ASALLOKASI: data[0][i][11],
                KETERANGAN: data[0][i][12],
                JENISTRX: data[0][i][13],
                OUTLET: data[0][i][14],
                KODEUNIKMEMBER: data[0][i][15],
            };
            batchinsertretur.push(obj);
        }
        dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_returpembelian_detail`(`AI`, `NOTRXRETURBELI`, `NOTRXPEMBELIAN`, `KODEBARANG`, `NAMABARANG`, `JUMLAHBELI`, `JUMLAHRETUR`, `HARGABELI`, `POTONGAN`, `PPN`, `ASALOUTLET`, `ASALLOKASI`, `KETERANGAN`, `JENISTRX`, `OUTLET`,`KODEUNIKMEMBER`)  VALUES ?', [batchinsertretur.map(item => [item.AI, item.NOTRXRETURBELI, item.NOTRXPEMBELIAN, item.KODEBARANG, item.NAMABARANG, item.JUMLAHBELI, item.JUMLAHRETUR, item.HARGABELI, item.POTONGAN, item.PPN, item.ASALOUTLET, item.ASALLOKASI, item.KETERANGAN, item.JENISTRX, item.OUTLET, item.KODEUNIKMEMBER])], con);
        data = {
            success: "true",
            rc: "200",
            msg: 'Informasi retur penjualan '+pesan+' berhasil ditranskasi. Silahkan cek laporan jika ingin melakukan analisa secara detail',
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
penjualan.hapusreturpembelian = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = []
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_returpembelian_detail WHERE NOTRXRETURBELI = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[0],data[1],data[2]], con)
    if (dataquery.affectedRows > 0) {
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_returpembelian WHERE NOTRXRETURBELI = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[0],data[1],data[2]], con)
        if (dataquery.affectedRows > 0) {
            data = {
                success: "true",
                rc: "200",
                msg: "Hapus transaksi retur pembelian dengan NOTA "+data[0]+" berhasil. Stok akan dikurangi kenbali dan dicatat pada KARTU STOK",
            }
        } else {
            data = {
                success: 'false',
                rc: dataquery.code,
                msg: dataquery.sqlMessage,
            }
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
module.exports = penjualan;