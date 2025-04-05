require('dotenv').config()
const laporanController = {}
const SPModel = require("../model/SPMysql")
const laporan = require("../model/LaporanData")

let hasiljson;
laporanController.formatlaporanmaster = async function (req, res) {
	var data = []
    data.push(req.body.KODENAMABARANG)
    data.push(req.body.KODEPERUSAHAAN)
    data.push(req.body.KODEPINCIPAL)
    data.push(req.body.KODEUSUPLIER)
    data.push(req.body.KODEKATEGORI)
    data.push(req.body.KODEBRAND)
    data.push(req.body.KODEOUTLET)
    data.push(req.body.STOKAWAL)
    data.push(req.body.STOKAKHIR)
    data.push(req.body.LOKASISTOK)
    data.push(req.body.STATUSBARANG)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporanmaster(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanmastersup = async function (req, res) {
	var data = []
    data.push(req.body.KODESUPLIER)
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.OUTLET)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporanmastersup(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanmastersup = async function (req, res) {
	var data = []
    data.push(req.body.KODESUPLIER)
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.OUTLET)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporanmastersup(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanmastermember = async function (req, res) {
	var data = []
    data.push(req.body.KODEMEMBER)
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.STATUSTRANSAKSI)
    data.push(req.body.OUTLET)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporanmastermember(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporandetaimembertabel = async function (req, res) {
	var data = []
    data.push(req.body.KODEMEMBER)
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.STATUSTRANSAKSI)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporandetaimembertabel(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanpenjualan = async function (req, res) {
	var data = []
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.CARABAYAR)
    data.push(req.body.OUTLET)
    data.push(req.body.IDPELANGGAN)
    data.push(req.body.KODEBARANG)
    data.push(req.body.KODESUPLIER)
    data.push(req.body.GROUPELANGGAN)
    data.push(req.body.KODEKATEGORI)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporanpenjualan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanreturpenjualan = async function (req, res) {
	var data = []
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.CARABAYAR)
    data.push(req.body.OUTLET)
    data.push(req.body.IDPELANGGAN)
    data.push(req.body.KODEBARANG)
    data.push(req.body.KODEKATEGORI)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporanreturpenjualan(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanpembelian = async function (req, res) {
	var data = []
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.CARABAYAR)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEBARANG)
    data.push(req.body.KODESUPLIER)
    data.push(req.body.KODEKATEGORI)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporanpembelian(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanreturpembelian = async function (req, res) {
	var data = []
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.CARABAYAR)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEBARANG)
    data.push(req.body.KODESUPLIER)
    data.push(req.body.KODEKATEGORI)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await laporan.formatlaporanreturpembelian(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanhutang = async function (req, res) {
	var data = []
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.CARABAYAR)
    data.push(req.body.OUTLET)
    data.push(req.body.KODESUPLIER)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.KONDISIHUTANG)
    hasiljson = await laporan.formatlaporanhutang(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
laporanController.formatlaporanpiutang = async function (req, res) {
	var data = []
    data.push(req.body.PERIODEAWAL)
    data.push(req.body.PERIODEAKHIR)
    data.push(req.body.CARABAYAR)
    data.push(req.body.OUTLET)
    data.push(req.body.IDPELANGGAN)
    data.push(req.body.GROUPELANGGAN)
    data.push(req.body.KONDISI)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.KONDISIPIUTANG)
    hasiljson = await laporan.formatlaporanpiutang(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
module.exports = laporanController