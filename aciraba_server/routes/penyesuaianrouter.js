const express = require("express")
const authorize = require('../middleware/authorize')
const router = express.Router()
const penyesuaianController = require("../controller/penyesuaianController")
/*transaksi kasir*/
router.post("/simpantransaksiopname",penyesuaianController.simpantransaksiopname)
router.post("/daftarpenyesuaianstok",penyesuaianController.daftarpenyesuaianstok)
router.post("/daftardetailopname",penyesuaianController.daftardetailopname)
router.post("/simpanmutasi",penyesuaianController.simpanmutasi)
router.post("/ajaxdaftarmutasi",penyesuaianController.ajaxdaftarmutasi)
router.post("/daftardetailmutasi",penyesuaianController.daftardetailmutasi)

module.exports = router
