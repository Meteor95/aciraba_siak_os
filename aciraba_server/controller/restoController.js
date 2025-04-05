require('dotenv').config()
const restoController = {}
const SPModel = require("../model/SPMysql")
const resto = require("../model/RestoData")

let hasiljson;
restoController.ajaxpanggilmeja = async function (req, res) {  
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
restoController.ajaxpanggillantai = async function (req, res) {  
    var data = []
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await resto.ajaxpanggillantai(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.ajaxdetailpesanan = async function (req, res) {  
    var data = []
    data.push(req.body.KODEMEJA)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.PROSESDARI)
    data.push(req.body.TANGGALAWAL)
    data.push(req.body.TANGGALAKHIR)
    hasiljson = await resto.ajaxdetailpesanan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.ajaxfullcalendarevent = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.updatestatuspemesanan = async function (req, res) {  
    var data = []
    data.push(req.body.PROSESDARI)
    data.push(req.body.KODEMEJA)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await resto.updatestatuspemesanan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.simpaninformasimeja = async function (req, res) {  
    var data = []
    data.push(req.body.KODEMEJA)
    data.push(req.body.NAMAMEJA)
    data.push(req.body.GAMBAR)
    data.push(req.body.KETERANGAN)
    data.push(req.body.LANTAI)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.JAMBUKA)
    data.push(req.body.JAMTUTUP)
    data.push(req.body.ISEDIT)
    hasiljson = await resto.simpaninformasimeja(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.hapusinformasimeja = async function (req, res) {  
    var data = []
    data.push(req.body.KODEMEJA)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await resto.hapusinformasimeja(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.panggildetailmakanan = async function (req, res) {  
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
restoController.loadkds = async function (req, res) {  
    var data = []
    data.push(req.body.KODEPESANAN)
    data.push(req.body.TANGGALAWAL)
    data.push(req.body.TANGGALAKHIR)
    data.push(req.body.KETERANGAN)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.KONDISI)
    data.push(req.body.KATEGORIID)
    hasiljson = await resto.loadkds(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.sundulpesanan = async function (req, res) {  
    var data = []
    data.push(req.body.NOTRANSKASI)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await resto.sundulpesanan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.ubahstatuspesanan = async function (req, res) {  
    var data = []
    data.push(req.body.BARANGID)
    data.push(req.body.STATUSPESAN)
    data.push(req.body.NOTAPESANAN)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await resto.ubahstatuspesanan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.tandaisemuaselesai = async function (req, res) {  
    var data = []
    data.push(req.body.NOTAPESANAN)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.STATUS)
    hasiljson = await resto.tandaisemuaselesai(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
restoController.filterbystatuspesanan = async function (req, res) {  
    var data = []
    data.push(req.body.STATUSPROSES)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await resto.filterbystatuspesanan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
module.exports = restoController