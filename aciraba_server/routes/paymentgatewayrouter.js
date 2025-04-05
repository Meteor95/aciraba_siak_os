const express = require("express")
const authorize = require('../middleware/authorize')
const router = express.Router()
const paymentgateway = require("../controller/paymentgatewayController")
const tripay = require("../controller/paymentgateway/tripay")
const duitku = require("../controller/paymentgateway/duitku")
/* dashboard */
router.post("/reqtrx",paymentgateway.reqtrx)
router.post("/detailtransaksi",paymentgateway.detailtransaksi)
/* TRIPAY */
router.post("/daftarchannel",tripay.daftarchannel)
/* DUITKU */
router.post("/nodeduitkugetmethodpayment",duitku.nodeduitkugetmethodpayment)

module.exports = router