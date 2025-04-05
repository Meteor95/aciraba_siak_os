require('dotenv').config()
const { isEmpty } = require('lodash');
const moment = require('moment');  
const penyesuaianController = {}
const SPModel = require("../model/SPMysql")
const penyesuaian = require("../model/PenyesuaianData")

let hasiljson,resultgroupby
penyesuaianController.simpantransaksiopname = async function (req, res) {  
    var data = []
    data.push(req.body.DETAILOPNAME)
    data.push(req.body.NOTAOPNAME)
    data.push(req.body.TOTALBARANG)
    data.push(req.body.TOTALSURPLUS)
    data.push(req.body.TOTALMINUS)
    data.push(req.body.TOTALOPANAME)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.NOMOR)
    data.push(req.body.KETERANGAN)
    data.push(req.body.PETUGAS)
    data.push(req.body.TANGGALTRS)
    hasiljson = await penyesuaian.simpantransaksiopname(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penyesuaianController.daftarpenyesuaianstok = async function (req, res) {  
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
penyesuaianController.daftardetailopname = async function (req, res) {  
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
penyesuaianController.simpanmutasi = async function (req, res) {  
    var data = []
    data.push(req.body.DETAILMUTASI)
    data.push(req.body.NOMORMUTASI)
    data.push(req.body.PETUGAS)
    data.push(req.body.TANGGALTRS)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.NOMOR)
    data.push(req.body.KETERANGAN)
    hasiljson = await penyesuaian.simpanmutasi(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
penyesuaianController.ajaxdaftarmutasi = async function (req, res) {  
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
penyesuaianController.daftardetailmutasi = async function (req, res) {  
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
module.exports = penyesuaianController