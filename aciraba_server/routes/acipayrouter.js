const express = require("express")
const authorize = require('../middleware/authorize')
const router = express.Router()
const acipay = require("../controller/acipayController")

router.post("/webhookdigiflazz",acipay.webhookdigiflazz)

router.post("/ceksaldo",acipay.ceksaldo)
router.post("/cektokenpln",acipay.cektokenpln)
router.post("/deposit",acipay.deposit)
router.post("/transaksi",acipay.transaksi)
router.post("/tagihan",acipay.tagihan)

router.post("/bacaserver",acipay.bacaserver)
router.post("/sinkronproduk",acipay.sinkronproduk)
router.post("/kirimotp",acipay.kirimotp)

router.post("/ajaxoperatordt",acipay.ajaxoperatordt)
router.post("/simpanoperator",acipay.simpanoperator)
router.post("/hapusoperator",acipay.hapusoperator)

router.post("/daftarkategori",acipay.daftarkategori)
router.post("/simpankategori",acipay.simpankategori)
router.post("/hapuskategori",acipay.hapuskategori)

router.post("/daftarproduk",acipay.daftarproduk)
router.post("/tambahprodukproses",acipay.tambahprodukproses)
router.post("/hapusperproduk",acipay.hapusperproduk)
router.post("/getformat",acipay.getformat)


module.exports = router