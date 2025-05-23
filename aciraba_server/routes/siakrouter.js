const express = require("express")
const router = express.Router()
const siak = require("../controller/siakController")

router.post("/kodecoa",siak.kodecoa)
router.post("/nodeajaxhapuskodecoa",siak.nodeajaxhapuskodecoa)
router.post("/formatkodeakun",siak.formatkodeakun)
router.post("/simpankodeakungrup",siak.simpankodeakungrup)
router.post("/entrijurnalumum",siak.entrijurnalumum)
router.post("/daftarentrijurnal",siak.daftarentrijurnal)
router.post("/nodeviewjurnal",siak.nodeviewjurnal)
router.post("/nodeviewjurnalitem",siak.nodeviewjurnalitem)
router.post("/nodehapusjurnal",siak.nodehapusjurnal)
router.post("/nodeverifentrijurnal",siak.nodeverifentrijurnal)
router.post("/nodebukubesarajax",siak.nodebukubesarajax)
router.post("/kasbanktotal",siak.kasbanktotal)
router.post("/ambilperiode",siak.ambilperiode)
router.post("/nodejurnalumumajax",siak.nodejurnalumumajax)
router.post("/nodeneracasaldo",siak.nodeneracasaldo)
router.post("/nodeneracakeuangan",siak.nodeneracakeuangan)
router.post("/nodelabarugi",siak.nodelabarugi)
module.exports = router
