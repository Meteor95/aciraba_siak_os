require('dotenv').config()
const { isEmpty } = require('lodash');
const moment = require('moment');  
const penjualanController = {}
const SPModel = require("../model/SPMysql")
const penjualandata = require("../model/PenjualanData")

let hasiljson,resultgroupby
penjualanController.notamenupenjualan = async function (req, res) {  
    var data = []
    data.push(req.body.AWALANOTA)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEKUMPUTERLOKAL)
    data.push(req.body.TANGGALSEKARANG)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await penjualandata.notamenupenjualan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.ambiltrxjual = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(isEmpty(req.body.DIMANA4))
    data.push(isEmpty(req.body.DIMANA5))
    data.push(isEmpty(req.body.DIMANA6))
    data.push(isEmpty(req.body.DIMANA7))
    data.push(isEmpty(req.body.DIMANA8))
    data.push(isEmpty(req.body.DIMANA9))
    data.push(isEmpty(req.body.DIMANA10))
    data.push(isEmpty(req.body.DIMANA11))
    data.push(isEmpty(req.body.DIMANA12))
    data.push(isEmpty(req.body.DIMANA13))
    data.push(isEmpty(req.body.DIMANA14))
    data.push(isEmpty(req.body.DIMANA15))
    data.push(isEmpty(req.body.DIMANA16))
    data.push(isEmpty(req.body.DIMANA17))
    data.push(isEmpty(req.body.DIMANA18))
    data.push(isEmpty(req.body.DIMANA19))
    data.push(isEmpty(req.body.DIMANA20))
    data.push(isEmpty(req.body.DATAKE))
    data.push(isEmpty(req.body.LIMIT))
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.cekpotongpiutang = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(isEmpty(req.body.DIMANA3))
    data.push(isEmpty(req.body.DIMANA4))
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(isEmpty(req.body.DIMANA7))
    data.push(isEmpty(req.body.DIMANA8))
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(isEmpty(req.body.DATAKE))
    data.push(isEmpty(req.body.LIMIT))
    hasiljson = await SPModel.dataquery_controller_kasir(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.daftarpesanan = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1 == "Semua Status Transaksi" ? "" : req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4.split("-").reverse().join("-"))
    data.push(req.body.DIMANA5.split("-").reverse().join("-"))
    data.push(isEmpty(req.body.DIMANA6))
    data.push(isEmpty(req.body.DIMANA7))
    data.push(isEmpty(req.body.DIMANA8))
    data.push(isEmpty(req.body.DIMANA9))
    data.push(isEmpty(req.body.DIMANA10))
    data.push(isEmpty(req.body.DIMANA11))
    data.push(isEmpty(req.body.DIMANA12))
    data.push(isEmpty(req.body.DIMANA13))
    data.push(isEmpty(req.body.DIMANA14))
    data.push(isEmpty(req.body.DIMANA15))
    data.push(isEmpty(req.body.DIMANA16))
    data.push(isEmpty(req.body.DIMANA17))
    data.push(isEmpty(req.body.DIMANA18))
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.daftarpesanandetail = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(isEmpty(req.body.DIMANA2))
    data.push(isEmpty(req.body.DIMANA3))
    data.push(isEmpty(req.body.DIMANA4))
    data.push(isEmpty(req.body.DIMANA5))
    data.push(req.body.DIMANA6)
    data.push(isEmpty(req.body.DIMANA7))
    data.push(isEmpty(req.body.DIMANA8))
    data.push(isEmpty(req.body.DIMANA9))
    data.push(isEmpty(req.body.DIMANA10))
    data.push(isEmpty(req.body.DIMANA11))
    data.push(isEmpty(req.body.DIMANA12))
    data.push(isEmpty(req.body.DIMANA13))
    data.push(isEmpty(req.body.DIMANA14))
    data.push(isEmpty(req.body.DIMANA15))
    data.push(isEmpty(req.body.DIMANA16))
    data.push(isEmpty(req.body.DIMANA17))
    data.push(isEmpty(req.body.DIMANA18))
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.daftarpesananmodedapur = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(isEmpty(req.body.DIMANA2))
    data.push(isEmpty(req.body.DIMANA3) == true ? "" : req.body.DIMANA3.split("-").reverse().join("-"))
    data.push(isEmpty(req.body.DIMANA4) == true ? "" : req.body.DIMANA4.split("-").reverse().join("-"))
    data.push(isEmpty(req.body.DIMANA5) == true ? "" : req.body.DIMANA5)
    data.push(isEmpty(req.body.DIMANA6) == true ? "" : req.body.DIMANA6)
    data.push(isEmpty(req.body.DIMANA7) == true ? "" : req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(isEmpty(req.body.DIMANA9))
    data.push(isEmpty(req.body.DIMANA10))
    data.push(isEmpty(req.body.DIMANA11))
    data.push(isEmpty(req.body.DIMANA12))
    data.push(isEmpty(req.body.DIMANA13))
    data.push(isEmpty(req.body.DIMANA14))
    data.push(isEmpty(req.body.DIMANA15))
    data.push(isEmpty(req.body.DIMANA16))
    data.push(isEmpty(req.body.DIMANA17))
    data.push(isEmpty(req.body.DIMANA18))
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    if (hasiljson[0].dataquery.length == 0){
        resultgroupby = []
    }else if (req.body.DIMANA1 == "updrnon" || req.body.DIMANA1 == "all"){
        resultgroupby = hasiljson
    }else{
        resultgroupby = Object.entries(hasiljson[0].dataquery.reduce((acc, { PK_NOTAPENJUALAN,JENISTRANSAKSI,MEJA,ANMANUAL,NAMABARANG,STOKBARANGKELUAR,TGLKELUAR,WAKTU }) => {
            acc[PK_NOTAPENJUALAN] = (acc[PK_NOTAPENJUALAN] || []);
            acc[PK_NOTAPENJUALAN].push({ JENISTRANSAKSI, MEJA, ANMANUAL, NAMABARANG, STOKBARANGKELUAR,TGLKELUAR,WAKTU });
            return acc;
        }, {})).map(([key, value]) => ({ nomota: key, statuspesanan:value[0].JENISTRANSAKSI, meja: value[0].MEJA ,namapemesan: value[0].ANMANUAL, waktupesan:value[0].TGLKELUAR+" "+value[0].WAKTU, children: value }));
    }
    res.json({
        success: hasiljson[0].success,
        hasilgroupby: resultgroupby,
    });
}
penjualanController.daftarreturpenjualan = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DIMANA11)
    data.push(req.body.DIMANA12)
    data.push(req.body.DIMANA13)
    data.push(req.body.DIMANA14)
    data.push(req.body.DIMANA15)
    data.push(req.body.DIMANA16)
    data.push(req.body.DIMANA17)
    data.push(req.body.DIMANA18)
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.tambahreturpenjualan = async function (req, res) {  
    var data = []
    data.push(req.body.ARRAYRETURBELI)
    data.push(req.body.ARRAYPOTONGPIUTANG)
    data.push(req.body.POTONGPIUTANGAKTIF)
    data.push(req.body.APAKAHEDIT)
    data.push(req.body.NOTRXRETUR)
    data.push(req.body.PETUGAS)
    data.push(req.body.IDPELANGGAN)
    data.push(req.body.TANGGALRETUR)
    data.push(req.body.NOMORNOTA)
    data.push(req.body.TOTALBARANG)
    data.push(req.body.TOTALRETUR)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.ISEDIT)
    hasiljson = await penjualandata.tambahreturpenjualan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.hapusreturpenjualan = async function (req, res) {  
    var data = []
    data.push(req.body.NOTARETURPENJUALAN)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await penjualandata.hapusreturpenjualan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.formreturpenjualan = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
/* penjualan */
penjualanController.daftarpenjualan = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_admin(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.daftarpenjualandikasir = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DIMANA11)
    data.push(req.body.DIMANA12)
    data.push(req.body.DIMANA13)
    data.push(req.body.DIMANA14)
    data.push(req.body.DIMANA15)
    data.push(req.body.DIMANA16)
    data.push(req.body.DIMANA17)
    data.push(req.body.DIMANA18)
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.hapuspenjualan = async function (req, res) {  
    var data = []
    data.push(req.body.PK_NOTAPENJUALAN)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.LOKASI)
    hasiljson = await penjualandata.hapuspenjualan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.daftarhispenjualan = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3.split("-").reverse().join("-"))
    data.push(req.body.DIMANA4.split("-").reverse().join("-"))
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_admin(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.daftarbarangkasir = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DIMANA11)
    data.push(req.body.DIMANA12)
    data.push(req.body.DIMANA13)
    data.push(req.body.DIMANA14)
    data.push(req.body.DIMANA15)
    data.push(req.body.DIMANA16)
    data.push(req.body.DIMANA17)
    data.push(req.body.DIMANA18)
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}

penjualanController.tambahkeranjangbestbuy = async function (req, res) {  
    var data = []
    data.push(req.body.BARANG_ID)
    data.push(req.body.QTY)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await penjualandata.tambahkeranjangbestbuy(req, data, req.con)
    res.json({
        tambahkeranjangbestbuy: hasiljson,
    });
}
/* kasir*/
penjualanController.simpantransaksi = async function(req,res){
    let data = []
    data.push(req.body.INFORMASIBARANG)
    data.push(req.body.ADADATA)
    data.push(req.body.PK_NOTAPENJUALAN)
    data.push(req.body.FK_MEMBER)
    data.push(req.body.FK_SALESMAN)
    data.push(req.body.ENUM_JENISTRANSAKSI)
    data.push(req.body.JATUHTEMPO)
    data.push(req.body.LOKASI) //7
    data.push(req.body.TGLKELUAR+" "+moment(new Date()).format("HH:mm:ss"))
    data.push(req.body.WAKTU)
    data.push(req.body.KASIR)
    data.push(req.body.NOMORNOTA)
    data.push(req.body.KETERANGAN)
    data.push(req.body.KODEUNIKMEMBER) //13
    data.push(req.body.NOMINALTUNAI)
    data.push(req.body.NOMINALKREDIT)
    data.push(req.body.NOMINALKARTUDEBIT)
    data.push(req.body.NOMORKARTUDEBIT)
    data.push(req.body.BANKDEBIT)
    data.push(req.body.NOMINALKARTUKREDIT)
    data.push(req.body.NOMORKARTUKREDIT)
    data.push(req.body.BANKKREDIT)
    data.push(req.body.NOMINALEMONEY)
    data.push(req.body.NAMAEMONEY)
    data.push(req.body.NOMINALPOTONGAN)
    data.push(req.body.NOMINALPAJAKKELUAR)
    data.push(req.body.KEMBALIAN)
    data.push(req.body.TOTALBELANJA)
    data.push(req.body.ISEDITKASIR)
    data.push(req.body.PAJAKTOKO) //29
    data.push(req.body.PAJAKNEGARA)
    data.push(req.body.POTONGANGLOBAL)
    data.push(req.body.TIPETRANSAKSI)
    /* PESAN TEMPAT API */
    data.push(req.body.KODEPESAN) //33
    data.push(req.body.KODEMENUPESANAN)
    data.push(req.body.KODEMEJA)
    data.push(req.body.PEMESAN)
    data.push(req.body.NOTELEPON)//37
    data.push(req.body.UNTUKBERAPAORANG)//38
    data.push(req.body.TOTALBELANJA) //39
    data.push(req.body.DP)//40
    data.push(req.body.TANGGAL)//41
    data.push(req.body.WAKTUAWAL)//42
    data.push(req.body.TANGGALAKHIR)//43
    data.push(req.body.WAKTUAKHIR)//44
    data.push(req.body.NOMOR)//45
    data.push(req.body.WARNAMEMO)//46
    data.push(req.body.STATUSPESAN)//47
    hasiljson = await penjualandata.simpantransaksi(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.validasistok = async function(req,res){
    let data = []
    data.push(req.body.BARANG_ID)
    data.push(req.body.QTY)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await penjualandata.validasistok(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.daftarpenjualanadmin = async function(req,res){
    let data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DIMANA11)
    data.push(req.body.DIMANA12)
    data.push(req.body.DIMANA13)
    data.push(req.body.DIMANA14)
    data.push(req.body.DIMANA15)
    data.push(req.body.DIMANA16)
    data.push(req.body.DIMANA17)
    data.push(req.body.DIMANA18)
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.detailkasirpenjualan = async function(req,res){
    let data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.detailbarangkeranjang = async function(req,res){
    let data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.updatestokpenjualandetail = async function(req,res){
    let data = []
    data.push(req.body.BARANG_ID)
    data.push(req.body.QTY)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.ISEDITKASIR)
    hasiljson = await penjualandata.updatestokpenjualandetail(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
/* daftar history harga jual */
penjualanController.hishargajual = async function(req,res){
    let data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DIMANA11)
    data.push(req.body.DIMANA12)
    data.push(req.body.DIMANA13)
    data.push(req.body.DIMANA14)
    data.push(req.body.DIMANA15)
    data.push(req.body.DIMANA16)
    data.push(req.body.DIMANA17)
    data.push(req.body.DIMANA18)
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.ajaxdaftarpiutang = async function(req,res){
    let data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DIMANA11)
    data.push(req.body.DIMANA12)
    data.push(req.body.DIMANA13)
    data.push(req.body.DIMANA14)
    data.push(req.body.DIMANA15)
    data.push(req.body.DIMANA16)
    data.push(req.body.DIMANA17)
    data.push(req.body.DIMANA18)
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.daftarpiutangterpilih = async function(req,res){
    let data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.filtermaubayarpiutang = async function(req,res){
    let data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.transaksipiutang = async function (req, res) {  
    var data = []
    data.push(req.body.INFORMASIPIUTANG)
    data.push(req.body.TRANSAKSIID)
    data.push(req.body.TANGGALBAYAR)
    data.push(req.body.KASIR_ID)
    data.push(req.body.KETERANGAN)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.NOTARETUR)
    data.push(req.body.NOMOR)
    data.push(req.body.LOKASI)
    data.push(req.body.WAKTU)
    hasiljson = await penjualandata.transaksipiutang(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.ajaxdaftarpembayaranpiutang = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DIMANA11)
    data.push(req.body.DIMANA12)
    data.push(req.body.DIMANA13)
    data.push(req.body.DIMANA14)
    data.push(req.body.DIMANA15)
    data.push(req.body.DIMANA16)
    data.push(req.body.DIMANA17)
    data.push(req.body.DIMANA18)
    data.push(req.body.DIMANA19)
    data.push(req.body.DIMANA20)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.hapustransaksipiutang = async function(req,res){
    let data = []
    data.push(req.body.NOTRANSAKSI)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.LOKASI)
    data.push(req.body.SUBNOTA)
    data.push(req.body.BAYAR)
    hasiljson = await penjualandata.hapustransaksipiutang(req, data, req.con)
    res.json({hasiljson: hasiljson,});
}
penjualanController.detailtransaksipiutang = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.dashboard_penjualan = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penjualanController.webhookapi = async function (req,responsejson) {
    let hasilwebhook = await penjualandata.updatewebhooktransaksiacipay(responsejson)
    global.io.sockets.emit(hasilwebhook[0].data[0].KODEUNIKMEMBER+"#"+hasilwebhook[0].data[0].LOKASI, {
        message: hasilwebhook[0].data[0].KETERANGAN,
    });
}
penjualanController.escprinter = async function (req,responsejson) {
    global.io.sockets.emit(req.body.KODESOCKETPRINT,  { datatransaksi: req.body });
    responsejson.json({
        status: "TERKIRIM",
    });
}
penjualanController.escprinterpesanan = async function (req,responsejson) {
    global.io.sockets.emit(req.body.KODESOCKETPRINT,  { datatransaksi: req.body });
    responsejson.json({
        status: "TERKIRIM",
    });
}

/* soket io penjualan */
global.io.on('connect', function (socket) {
    socket.on("notifikasi_realtime_penjualan", function (data) {
        global.io.sockets.emit(data.outlet + "#" + data.kodeunikmember, {
            title: Math.random(),
            message: data.title,
        });

    });
});
module.exports = penjualanController