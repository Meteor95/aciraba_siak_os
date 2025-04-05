require('dotenv').config()
const siakController = {}
const sanitizeHtml = require('sanitize-html');
const SPModel = require("../model/SPMysql")
const siak = require("../model/SiakData")
const AccountList = require('../model/AccountList');

let hasiljson;
let data = []
siakController.kodecoa = async function (req, res) {  
    data = []
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.KODESUBPERUSAHAAN)
    hasiljson = await siak.kodecoa(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
siakController.nodeajaxhapuskodecoa = async function (req, res) {  
    data = []
    hasiljson = await siak.nodeajaxhapuskodecoa(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
siakController.formatkodeakun = async function (req, res) {  
    data = []
    data.push(req.body.ID)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.JENISAKUN)
    hasiljson = await siak.formatkodeakun(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
siakController.simpankodeakungrup = async function (req, res) {  
    data = []
    data.push(req.body.ID)
    data.push(req.body.PARENT_ID)
    data.push(req.body.KODE_COA_GROUP)
    data.push(req.body.NAMA_COA_GROUP)
    data.push(req.body.DEFAULTINPUT)
    data.push(req.body.JENISAKUN)
    data.push(req.body.SALDOAWAL)
    data.push(req.body.KASBANK)
    data.push(req.body.KETERANGAN)
    data.push(req.body.ISDELETE)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.ISEDIT)
    data.push(req.body.SAWALDEFAULTINPUT)
    data.push(req.body.EDITLEDGER)
    data.push(req.body.SUBPERUSAHAAN)
    data.push(req.body.NAMASUBPERUSAHAAN)
    hasiljson = await siak.simpankodeakungrup(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
siakController.entrijurnalumum = async function (req, res) { 
    data = []
    data.push(sanitizeHtml(req.body.INFORMASIENTRIJURNAL.narasientrijurnal)) 
    hasiljson = await siak.entrijurnalumum(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
siakController.daftarentrijurnal = async function (req, res) { 
    data = []
    hasiljson = await siak.daftarentrijurnal(req, data, req.con)
    res.json({
        daftarentrijurnal: hasiljson,
    });
}
siakController.nodeviewjurnal = async function (req, res) { 
    data = []
    hasiljson = await siak.nodeviewjurnal(req, data, req.con)
    res.json({
        daftarentrijurnal: hasiljson,
    });
}
siakController.nodeviewjurnalitem = async function (req, res) { 
    data = []
    hasiljson = await siak.nodeviewjurnalitem(req, data, req.con)
    res.json({
        daftarentrijurnal: hasiljson,
    });
}
siakController.nodehapusjurnal = async function (req, res) { 
    data = []
    hasiljson = await siak.nodehapusjurnal(req, data, req.con)
    res.json({
        daftarentrijurnal: hasiljson,
    });
}
siakController.nodeverifentrijurnal = async function (req, res) { 
    data = []
    hasiljson = await siak.nodeverifentrijurnal(req, data, req.con)
    res.json({
        nodeverifentrijurnal: hasiljson,
    });
}
siakController.nodebukubesarajax = async function (req, res) { 
    data = []
    openingBalance = await siak.openingBalance(req, data, req.con)
    closingBalance = await siak.closingBalance(req, data, req.con)
    detailjurnal = await siak.detailjurnaljurnalumum(req, data, req.con)
    res.json({
        detailjurnal: detailjurnal,
        openingBalance: openingBalance,
        closingBalance: closingBalance,
    });
}
siakController.kasbanktotal = async function (req, res) { 
    totalkasbulanini = await siak.kasbanktotal(req, 0, req.con)
    kasmasukbulanini = await siak.kasbanktotal(req, 1, req.con)
    kaskeluarbulanini = await siak.kasbanktotal(req, 2, req.con)
    res.json({
        kasmasukbulanini: kasmasukbulanini,
        kaskeluarbulanini: kaskeluarbulanini,
        totalkasbulanini: totalkasbulanini,
    });
}
siakController.ambilperiode = async function (req, res) { 
    data = []
    hasiljson = await siak.ambilperiode(req, data, req.con)
    res.json({
        ambilperiode: hasiljson,
    });
}
siakController.nodejurnalumumajax = async function (req, res) { 
    data = []
    hasiljson = await siak.nodejurnalumumajax(req, data, req.con)
    res.json({
        jurnalumum: hasiljson,
    });
}
siakController.nodeneracasaldo = async function (req, res) { 
    let data = [];
    const accountList = new AccountList(req, data, req.con);
    const result = await accountList.mulai(0);
    res.json({
        neracasaldo: result.children_groups,
    });
}
siakController.nodeneracakeuangan = async function (req, res) { 
    let data = [];
    const accountList = new AccountList(req, data, req.con);
    const assets = await accountList.mulai(1);
    const kewajiban = await accountList.mulai(2);
    const ekuitas = await accountList.mulai(3);
    const labaditahan = await accountList.mulai(4);
    res.json({
        neracaasset: assets,
        neracakewajiban: kewajiban,
        neracaekuitas: ekuitas,
        neracalabaditahan: labaditahan,
    });
}
siakController.nodelabarugi = async function (req, res) { 
    let data = [];
    const accountList = new AccountList(req, data, req.con);
    const pendapatan = await accountList.mulai(5);
    const beban = await accountList.mulai(6);
    res.json({
        pendapatan:pendapatan,
        beban: beban,
    });
}
module.exports = siakController