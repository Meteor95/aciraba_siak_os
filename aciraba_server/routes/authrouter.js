const express = require("express")
const router = express.Router()
const authController = require("../controller/authController")
const { tokenAPIMiddleware } = require('../middleware/authorize');

router.post("/pendaftaranmember",authController.pendaftaranmember)
router.post("/simpanhakakses",authController.simpanhakakses)
router.post("/daftarhakakses",authController.daftarhakakses)
router.post("/loginapps",tokenAPIMiddleware, authController.loginapps)
router.post("/simpanpegawai",authController.simpanpegawai)
router.post("/outlet",authController.outlet)
router.post("/hapusoutlet",authController.hapusoutlet)
router.post("/detailinformasioutlet",authController.detailinformasioutlet)
router.post("/daftarpegawai",authController.daftarpegawai)
router.post("/statuspegawai",authController.statuspegawai)
router.post("/ubahpasswordproses",authController.ubahpasswordproses)
router.post("/mintaotp",authController.mintaotp)
router.post("/nodeverifikasikodeotp",authController.validasiotp)

module.exports = router