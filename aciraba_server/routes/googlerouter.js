const express = require("express")
const router = express.Router()
const googleController = require("../controller/googleController")

router.get("/auth",googleController.auth)
router.get("/redirect",googleController.redirect)
router.get("/dir",googleController.directory)

module.exports = router