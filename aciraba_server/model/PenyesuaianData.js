require('dotenv').config()
const util = require('../config/utils');
const con = require("../config/db.js")
const moment = require('moment');
const bcrypt = require('bcrypt');
const { join } = require('lodash');
const penjualan = {}
let pesanbalik = {}
let batchinsert = {};

penjualan.simpantransaksiopname = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = []
    let dataquery, pesan = "";
    for (let i = 0; i < data[0].length; i++) {
        var obj = {
            NOTAOPNAME: data[1],
            KODEBARANG: data[0][i][0],
            NAMABARANG: data[0][i][1],
            LOKASIOPNAME: data[0][i][2],
            STOKKOMPUTER: data[0][i][3],
            STOKOPNAME: data[0][i][4],
            KONDISIOPNAME: data[0][i][5],
            OUTLET: data[0][i][6],
            KODEUNIKMEMBER: data[0][i][7],
            HPP: data[0][i][8],
            INFORMASI: data[0][i][9],
        };
        batchinsert.push(obj);
    }
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO 01_trs_opname(AI, NOTAOPNAME, TOTALBARANG, TOTALSURPLUS, TOTALMINUS, TOTALOPANAME, OUTLET, KODEUNIKMEMBER, NOMOR, KETERANGAN, PETUGAS,TANGGALTRS) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)', [
        '0', data[1], data[2], data[3], data[4] , data[5] , data[6] , data[7] , data[8] , data[9] , data[10], data[11]], con)
    if (dataquery.affectedRows > 0) {
        dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_trs_opname_detail(AI, NOTAOPNAME, KODEBARANG, NAMABARANG, LOKASIOPNAME, STOKKOMPUTER, STOKOPNAME, KONDISIOPNAME, OUTLET, KODEUNIKMEMBER, HPP, INFORMASI) VALUES ?`, [batchinsert.map(item => ['0',item.NOTAOPNAME, item.KODEBARANG, item.NAMABARANG, item.LOKASIOPNAME, item.STOKKOMPUTER, item.STOKOPNAME, item.KONDISIOPNAME, item.OUTLET, item.KODEUNIKMEMBER, item.HPP, item.INFORMASI])], con)
        data = {
            success: "true",
            rc: "200",
            msg: 'Informasi tranaksi penyesuaian STOK dengan NOTA '+data[1]+" berhasil disimpan.... Mudah mudahan yang minus bisa tergantikan.",
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
penjualan.simpanmutasi = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = [];
    let dataquery;
    for (let i = 0; i < data[0].length; i++) {
        var obj = {
            AI: data[0][i][0],
            NOMORMUTASI: data[0][i][1],
            KODEBARANG: data[0][i][2],
            NAMABARANG: data[0][i][3],
            UNIT: data[0][i][4],
            STOKAWAL: data[0][i][5],
            STOKMUTASI: data[0][i][6],
            NOMINAL: data[0][i][7],
            ASALOUTLET: data[0][i][8],
            TUJUANOUTLET: data[0][i][9],
            ASALLOKASIITEM: data[0][i][10],
            TUJUANLOKASIITEM: data[0][i][11],
            OUTLET: data[0][i][12],
            KODEUNIKMEMBER: data[0][i][13],
        };
        batchinsert.push(obj);
    }
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_mutasibarang`(`AI`, `NOMORMUTASI`, `PETUGAS`, `TANGGALTRS`, `OUTLET`, `KODEUNIKMEMBER`, `NOMOR`, `KETERANGAN`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', ['0', data[1], data[2], data[3], data[4] , data[5] , data[6] , data[7]], con)
    if (dataquery.affectedRows > 0) {
        dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_mutasibarang_detail`(`AI`, `NOMORMUTASI`, `KODEBARANG`, `NAMABARANG`, `UNIT`, `STOKAWAL`, `STOKMUTASI`, `NOMINAL`, `ASALOUTLET`, `TUJUANOUTLET`, `ASALLOKASIITEM`, `TUJUANLOKASIITEM`, `OUTLET`, `KODEUNIKMEMBER`) VALUES ?', [batchinsert.map(item => ['0',item.NOMORMUTASI, item.KODEBARANG, item.NAMABARANG, item.UNIT, item.STOKAWAL, item.STOKMUTASI, item.NOMINAL, item.ASALOUTLET, item.TUJUANOUTLET, item.ASALLOKASIITEM, item.TUJUANLOKASIITEM, item.OUTLET, item.KODEUNIKMEMBER])], con)
        data = {
            success: "true",
            rc: "200",
            msg: 'Informasi tranaksi mutasi item dengan NOTA '+data[1]+" berhasil disimpan.... Silahkan cek di kartu stok.",
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