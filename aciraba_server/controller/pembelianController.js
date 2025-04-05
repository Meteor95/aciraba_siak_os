require('dotenv').config()
const { isEmpty } = require('lodash');
const moment = require('moment');  
const pembelianController = {}
const SPModel = require("../model/SPMysql")
const pembeliandata = require("../model/PembelianData")

let hasiljson,resultgroupby
pembelianController.modaldaftarsuplier = async function (req, res) {  
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
pembelianController.pilihbarangpembelian = async function (req, res) {  
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
pembelianController.simpanpembelian = async function (req, res) {  
    var data = []
    data.push(req.body.DETAILPEMBELIAN)
    data.push(req.body.NOTA)
    data.push(req.body.FK_SUPPLIER)
    data.push(req.body.TANGGALTRS)
    data.push(req.body.KETERANGAN)
    data.push(req.body.TOP)
    data.push(req.body.JATUHTEMPO)
    data.push(req.body.PETUGAS)
    data.push(req.body.TOTALPEMBELIAN)
    data.push(req.body.TOTALPEMBELIANBEBAN)
    data.push(req.body.TOTALHUTANG)
    data.push(req.body.BIAYALAINLAIN)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.DARISUBPERUSAHAAN)
    data.push(req.body.NOMOR)
    data.push(req.body.TOTALPPNMASUKAN)
    data.push(req.body.NAMATOP)
    data.push(req.body.ISEDIT)
    hasiljson = await pembeliandata.simpanpembelian(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.daftarpembeliantabel = async function (req, res) {  
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
pembelianController.hapuspembelian = async function (req, res) {  
    var data = []
    data.push(req.body.NOTA)
    data.push(req.body.LOKASI)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.KODESUPLIER)
    data.push(req.body.PENGGUNAID)
    hasiljson = await pembeliandata.hapuspembelian(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.detailpembelian = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.hishargabeli = async function (req, res) {  
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
pembelianController.filtermaubayarhutang = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.daftarhutangterpilih = async function (req, res) {  
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
pembelianController.transaksihutang = async function (req, res) {  
    var data = []
    data.push(req.body.INFORMASIPIUTANG)
    data.push(req.body.NOTRANSAKSI)
    data.push(req.body.SUPPLIER_ID)
    data.push(req.body.TANGGALTRS)
    data.push(req.body.WAKTU)
    data.push(req.body.PETUGAS)
    data.push(req.body.KETERANGAN)
    data.push(req.body.LOKASI)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.NOMOR)
    hasiljson = await pembeliandata.transaksihutang(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.ajaxdaftarhutang = async function (req, res) {  
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
pembelianController.ajaxdaftarpembayaranhutang = async function (req, res) {  
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
pembelianController.hapustransaksibhutang = async function (req, res) {  
    var data = []
    data.push(req.body.NOTAPEMBAYARANHUTANG)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.LOKASI)
    hasiljson = await pembeliandata.hapustransaksibhutang(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.detailpembayaranhutang = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.hapustransaksihutang = async function(req,res){
    let data = []
    data.push(req.body.NOTRANSAKSI)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.LOKASI)
    data.push(req.body.SUBNOTA)
    data.push(req.body.BAYAR)
    hasiljson = await pembeliandata.hapustransaksihutang(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.ubahhargajualsetelahbeli = async function (req, res) {  
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
pembelianController.ubahhargajualafb = async function (req, res) {  
    var data = []
    data.push(req.body.KODEITEM)
    data.push(req.body.HARGAJUAL)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await pembeliandata.ubahhargajualafb(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.jsontrxbeli = async function (req, res) {  
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
pembelianController.cekpotonghutang = async function (req, res) {  
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
pembelianController.tambahreturpembelian = async function (req, res) {  
    var data = []
    data.push(req.body.ARRAYRETURBELI)
    data.push(req.body.ARRAYPOTONGHUTANG)
    data.push(req.body.POTONGHUTANGAKTIF)
    data.push(req.body.NOTRXRETURBELI)
    data.push(req.body.PETUGAS)
    data.push(req.body.SUPPLIERID)
    data.push(req.body.TANGGALTRS)
    data.push(req.body.NOMORNOTA)
    data.push(req.body.TOTALBARANG)
    data.push(req.body.TOTALNOMINAL)
    data.push(req.body.TOTALPOTONGAN)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.ISEDIT)
    hasiljson = await pembeliandata.tambahreturpembelian(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
pembelianController.jsondaftarreturpembelian = async function (req, res) {  
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
pembelianController.hapusreturpembelian = async function (req, res) {  
    var data = []
    data.push(req.body.NOTARETUR)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await pembeliandata.hapusreturpembelian(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
module.exports = pembelianController