const express = require("express")
const authorize = require('../middleware/authorize')
const router = express.Router()
const duitkuController = require("../controller/paymentgateway/duitku")

router.post("/duitku",duitkuController.callback)

module.exports = router
