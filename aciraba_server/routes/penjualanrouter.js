const express = require("express")
const authorize = require('../middleware/authorize')
const router = express.Router()
const penjualanController = require("../controller/penjualanController")
/*transaksi kasir*/
router.post("/simpantransaksi",penjualanController.simpantransaksi)
router.post("/daftarpenjualan",penjualanController.daftarpenjualan)
router.post("/detailbarangkeranjang",penjualanController.detailbarangkeranjang)
router.post("/daftarpenjualandikasir",penjualanController.daftarpenjualandikasir)
router.post("/validasistok",penjualanController.validasistok)
/*daftar pesanan controller */
router.post("/daftarpesanan",penjualanController.daftarpesanan)
router.post("/daftarpesanandetail",penjualanController.daftarpesanandetail)
router.post("/daftarpesananmodedapur",penjualanController.daftarpesananmodedapur)
/*daftar retur penjualan*/
router.post("/notamenupenjualan",penjualanController.notamenupenjualan)
router.post("/ambiltrxjual",penjualanController.ambiltrxjual)
router.post("/cekpotongpiutang",penjualanController.cekpotongpiutang)
router.post("/daftarreturpenjualan",penjualanController.daftarreturpenjualan)
router.post("/tambahreturpenjualan",penjualanController.tambahreturpenjualan)
router.post("/hapusreturpenjualan",penjualanController.hapusreturpenjualan)
router.post("/formreturpenjualan",penjualanController.formreturpenjualan)
/*daftar piutang*/
router.post("/daftarpiutangterpilih",penjualanController.daftarpiutangterpilih)
router.post("/filtermaubayarpiutang",penjualanController.filtermaubayarpiutang)
router.post("/transaksipiutang",penjualanController.transaksipiutang)
router.post("/ajaxdaftarpembayaranpiutang",penjualanController.ajaxdaftarpembayaranpiutang)
router.post("/detailtransaksipiutang",penjualanController.detailtransaksipiutang)
/*daftar penjualan*/
router.post("/daftarpenjualanadmin",penjualanController.daftarpenjualanadmin)
router.post("/detailkasirpenjualan",penjualanController.detailkasirpenjualan)
router.post("/hapuspenjualan",penjualanController.hapuspenjualan)
router.post("/daftarbarangkasir",penjualanController.daftarbarangkasir)
router.post("/tambahkeranjangbestbuy",penjualanController.tambahkeranjangbestbuy)
router.post("/updatestokpenjualandetail",penjualanController.updatestokpenjualandetail)
router.post("/hishargajual",penjualanController.hishargajual)
router.post("/ajaxdaftarpiutang",penjualanController.ajaxdaftarpiutang)
router.post("/ajaxdaftarpiutang",penjualanController.ajaxdaftarpiutang)
/*daftar history harga penjualan ,authorize() */
router.post("/hapustransaksipiutang",penjualanController.hapustransaksipiutang)
/* penjualan dashboard */
router.post("/dashboard_penjualan",penjualanController.dashboard_penjualan)
/* printer */
router.post("/escprinter",penjualanController.escprinter)
router.post("/escprinterpesanan",penjualanController.escprinterpesanan)
module.exports = router