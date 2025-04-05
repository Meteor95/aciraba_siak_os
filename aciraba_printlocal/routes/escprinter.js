const express = require("express")
const router = express.Router()
const printer = require("../controller/escprintercontroller")

router.post("/escprint",printer.printerfn)

module.exports = router