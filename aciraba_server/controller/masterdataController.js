require('dotenv').config()

const masterdataController = {}
const masterdatamodel = require("../model/MasterData")
const SPModel = require("../model/SPMysql")
let hasiljson

masterdataController.daftarbarang = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.daftarbarang(req, data, req.con)
    res.json({
        databarang: hasiljson,
    });
}
masterdataController.daftarbarangdetail = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.daftarbarangdetail(req, data, req.con)
    res.json({
        databarang: hasiljson,
    });
}
masterdataController.rebuildstok = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.KODEITEM)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.NAMAITEM)
    hasiljson = await masterdatamodel.rebuildstok(req, data, req.con)
    res.json({
        datajson: hasiljson,
    });
}
masterdataController.daftarsuplierselect = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.daftarsuplierselect(req, data, req.con)
    res.json({
        datasuplier: hasiljson,
    });
}
masterdataController.daftakategoriselect = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.daftakategoriselect(req, data, req.con)
    res.json({
        daftakategoriselect: hasiljson,
    });
}
masterdataController.kategoridompetdata = async function (req, res) {
    var data = []
    hasiljson = await masterdatamodel.kategoridompetdata(req, data, req.con)
    res.json({
        respon: hasiljson,
    });
}
masterdataController.daftakategoriselectkasir = async function (req, res) {
    var data = []
    data.push(req.body.NAMAKATEGORI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.daftakategoriselectkasir(req, data, req.con)
    res.json({
        daftakategoriselectkasir: hasiljson,
    });
}
masterdataController.daftarsatuanselect = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.daftarsatuanselect(req, data, req.con)
    res.json({
        daftarsatuanselect: hasiljson,
    });
}
masterdataController.daftarprincipal = async function (req, res) {
    var data = []
    data.push(req.body.NAMAPRINCIPAL)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.daftarprincipal(req, data, req.con)
    res.json({
        daftarprincipal: hasiljson,
    });
}
masterdataController.jenispembayarantransaksi = async function (req, res) {
    var data = []
    data.push(req.body.NAMAPARAMETER)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.DBAKUNAKTIF)
    data.push(req.body.PREFIX)
    hasiljson = await masterdatamodel.jenispembayarantransaksi(req, data, req.con)
    res.json({
        jenispembayarantransaksi: hasiljson,
    });
}
masterdataController.daftarbrand = async function (req, res) {
    var data = []
    data.push(req.body.NAMABRAND)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.daftarbrand(req, data, req.con)
    res.json({
        daftarbrand: hasiljson,
    });
}
masterdataController.daftarperusahaan = async function (req, res) {
    var data = []
    data.push(req.body.NAMAPERUSAHAAN)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.daftarperusahaan(req, data, req.con)
    res.json({
        daftarperusahaan: hasiljson,
    });
}
masterdataController.daftarvoucherbarang = async function (req, res) {
    var data = []
    data.push(req.body.KONDISIAKSI)
    data.push(req.body.BARANGID)
    data.push(req.body.NAMAVOUCHER)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    if (req.body.KONDISIAKSI == "select"){
        hasiljson = await masterdatamodel.daftarvoucherbarang(req, data, req.con)
    }else{
        hasiljson = await masterdatamodel.hapusvoucherbarang(req, data, req.con)
    }
    res.json({
        daftarvoucherbarang: hasiljson,
    });
}
masterdataController.tambahbarangitem = async function (req, res) {
    var data = []
    data.push(req.body.ISINSERT)
    data.push(req.body.BARANG_ID)
    data.push(req.body.QRCODE_ID)
    data.push(req.body.NAMABARANG)
    data.push(req.body.BERAT_BARANG)
    data.push(req.body.PARETO_ID)
    data.push(req.body.SUPPLER_ID)
    data.push(req.body.KATEGORI_ID)
    data.push(req.body.BRAND_ID)
    data.push(req.body.KETERANGANBARANG)
    data.push(req.body.HARGABELI)
    data.push(req.body.HARGAJUAL)
    data.push(req.body.SATUAN)
    data.push(req.body.AKTIF)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.APAKAHGROSIR)
    data.push(req.body.STOKDAPATMINUS)
    data.push(req.body.JENISBARANG)
    data.push(req.body.PEMILIK)
    /* data push harga grosir */
    data.push(req.body.ISHARGAGROSIRAKTIF)
    data.push(typeof req.body.JSONHARGAGROSIR !== "undefined" ? req.body.JSONHARGAGROSIR : [] )
    data.push(req.body.OUTLETSESSION)
    /* data push harga tambahan */
    data.push(req.body.ISBARANGTAMBAHAN)
    data.push(typeof req.body.JSONBARANGTAMBAHAN !== "undefined" ? req.body.JSONBARANGTAMBAHAN : [] )
    hasiljson = await masterdatamodel.tambahitem(req, data, req.con)
    res.json({
        hasilinserttambahitem: hasiljson,
    });
}
masterdataController.tambahitemajaxbulk = async function (req, res) {
    var data = []
    data.push(req.body.INFORMASIBARANG)
    data.push(req.body.JUMLAHDATA)
    data.push(req.body.OUTLET)
    hasiljson = await masterdatamodel.tambahitemajaxbulk(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
masterdataController.tambahbarangvoucher = async function (req, res) {
    var data = []
    data.push(req.body.VOUCHER_ID)
    data.push(req.body.BARANGID)
    data.push(req.body.NAMAVOUCHER)
    data.push(req.body.AWALAKTIF)
    data.push(req.body.AKHIRAKTIF)
    data.push(req.body.TIPEVOUCHER)
    data.push(req.body.NOMINALRUPIAH)
    data.push(req.body.NOMINALDISKON)
    data.push(req.body.BATASTRANSAKSI)
    data.push(req.body.MINIMALPEMBELIAN)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.OUTLET)
    hasiljson = await masterdatamodel.tambahbarangvoucher(req, data, req.con)
    res.json({
        hasilinserttambahitem: hasiljson,
    });
}
masterdataController.manajemencitraitem = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.AI)
    data.push(req.body.KODEITEM)
    data.push(req.body.FILENAME)
    data.push(req.body.GAMBARUTAMA)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.manajemencitraitem(req, data, req.con)
    res.json({
        manajemencitraitem: hasiljson,
    });
}
masterdataController.pecahsatuan = async function (req, res) {
    var data = []
    data.push(req.body.AI)
    data.push(req.body.IDBARANGASAL)
    data.push(req.body.IDBARANGBARU)
    data.push(req.body.ASALPECAH)
    data.push(req.body.MENJADI)
    data.push(req.body.HARGAJUAL)
    data.push(req.body.HARGABELI)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.KASIR)
    data.push(req.body.NAMABARANGSEBELUM)
    data.push(req.body.NAMABARANGSESUDAH)
    hasiljson = await masterdatamodel.pecahsatuan(req, data, req.con)
    res.json({
        pecahsatuan: hasiljson,
    });
}
/* kartustok route area */
masterdataController.kartustok = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.kartustok(req, data, req.con)
    res.json({
        kartustok: hasiljson,
    });
}
/* diskon penjualan barang */
masterdataController.diskonpenjualan = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.diskonpenjualan(req, data, req.con)
    res.json({
        diskonpenjualan: hasiljson,
    });
}
masterdataController.tambahdiskonpenjualan = async function (req, res) {
    var data = []
    data.push(req.body.DISKONID)
    data.push(req.body.BARANGID)
    data.push(req.body.MINBELITINGKAT1)
    data.push(req.body.DISCNONMEMBER1)
    data.push(req.body.DISCMEMBER1)
    data.push(req.body.MINBELITINGKAT2)
    data.push(req.body.DISCNONMEMBER2)
    data.push(req.body.DISCMEMBER2)
    data.push(req.body.KATEGORI)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.OUTLET)
    hasiljson = await masterdatamodel.tambahdiskonpenjualan(req, data, req.con)
    res.json({
        tambahdiskonpenjualan: hasiljson,
    });
}
masterdataController.hapusdiskonpenjualan = async function (req, res) {
    var data = []
    data.push(req.body.KODEITEM)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.OUTLET)
    data.push(req.body.NAMABARANG)
    hasiljson = await masterdatamodel.hapusdiskonpenjualan(req, data, req.con)
    res.json({
        hapusdiskonpenjualan: hasiljson,
    });
}
/* diskon kupon belanja */
masterdataController.kuponbelanja = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.kuponbelanja(req, data, req.con)
    res.json({
        kuponbelanja: hasiljson,
    });
}
masterdataController.tambahkuponbelanja = async function (req, res) {
    var data = []
    data.push(req.body.VOUCHER_ID)
    data.push(req.body.NAMAVOUCHER)
    data.push(req.body.AWALAKTIF)
    data.push(req.body.AKHIRAKTIF)
    data.push(req.body.TIPEVOUCHER)
    data.push(req.body.NOMINALRUPIAH)
    data.push(req.body.NOMINALDISKON)
    data.push(req.body.BATASTRANSAKSI)
    data.push(req.body.MINIMALPEMBELIAN)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.OUTLET)
    hasiljson = await masterdatamodel.tambahkuponbelanja(req, data, req.con)
    res.json({
        tambahkuponbelanja: hasiljson,
    });
}
masterdataController.hapuskuponbelanja = async function (req, res) {
    var data = []
    data.push(req.body.NAMAVOUCHER)
    data.push(req.body.OUTLET)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.hapuskuponbelanja(req, data, req.con)
    res.json({
        hapuskuponbelanja: hasiljson,
    });
}
/* master member */
masterdataController.mastermember = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.mastermember(req, data, req.con)
    res.json({
        mastermember: hasiljson,
    });
}
masterdataController.mastermemberkasir = async function (req, res) {
    var data = []
    data.push(req.body.KATAKUNCI)
    data.push(req.body.KODEUNIKMEMBER)   
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.mastermemberkasir(req, data, req.con)
    res.json({
        mastermemberkasir: hasiljson,
    });
}
masterdataController.jsonmemberselect = async function (req, res) {
    var data = []
    data.push(req.body.KODENAMAMEMBER)
    data.push(req.body.KODEUNIKMEMBER)   
    hasiljson = await masterdatamodel.jsonmemberselect(req, data, req.con)
    res.json({
        selectmember: hasiljson,
    });
}
masterdataController.statusmember = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.KODEMEMBER)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.NAMAMEMBER)
    hasiljson = await masterdatamodel.statusmember(req, data, req.con)
    res.json({
        statusmember: hasiljson,
    });
}
masterdataController.tambahmember = async function (req, res) {
    var data = []
    data.push(req.body.MEMBER_ID)
    data.push(req.body.NAMA)
    data.push(req.body.ALAMAT)
    data.push(req.body.KOTA)
    data.push(req.body.PROVINSI)
    data.push(req.body.NEGARA)
    data.push(req.body.KODEPOS)
    data.push(req.body.JK)
    data.push(req.body.EMAIL)
    data.push(req.body.TELEPON)
    data.push(req.body.FAX)
    data.push(req.body.AKHIRAKTIF)
    data.push(req.body.STATUSAKTIF)
    data.push(req.body.POINT)
    data.push(req.body.NOREK)
    data.push(req.body.PEMILIKREK)
    data.push(req.body.BANK)
    data.push(req.body.NPWP)
    data.push(req.body.KETERANGAN)
    data.push(req.body.LIMITJUMLAHPIUTANG)
    data.push(req.body.JENIS)
    data.push(req.body.GRUP)
    data.push(req.body.MINIMALPOIN)
    data.push(req.body.BATASTAMBAHKREDIT)
    data.push(req.body.KEJARTARGET)
    data.push(req.body.NAMAFILE)
    data.push(req.body.USERNAME)
    data.push(req.body.PASSWORD)
    data.push(req.body.CATATAN)
    data.push(req.body.LIMITBARANGONLINE)
    data.push(req.body.LOGO)
    data.push(req.body.LIMIT_BRG)
    data.push(req.body.NISBACKUP)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.OUTLET)
    data.push(req.body.NOMOR)
    data.push(req.body.TOTALDEPOSIT)
    data.push(req.body.ISRESELLER)
    data.push(req.body.ANGKAKESUKAAN)
    data.push(req.body.ISINSERT)
    data.push(req.body.PINTRX)
    data.push(req.body.APIKEY)
    data.push(req.body.MARKUP)
    data.push(req.body.KECAMATAN)
    hasiljson = await masterdatamodel.tambahmember(req, data, req.con)
    res.json({
        tambahmember: hasiljson,
    });
}
masterdataController.detailmember = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.detailmember(req, data, req.con)
    res.json({
        detailmember: hasiljson,
    });
}
/* master sales area */
masterdataController.mastersuplier = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.mastersuplier(req, data, req.con)
    res.json({
        mastersuplier: hasiljson,
    });
}
masterdataController.tambahmastersuplier = async function (req, res) {
    var data = []
    data.push(req.body.SUPPLIER_AI)
    data.push(req.body.KODESUPPLIER)
    data.push(req.body.NAMASUPPLIER)
    data.push(req.body.NEGARA)
    data.push(req.body.PROVINSI)
    data.push(req.body.KOTAKAB)
    data.push(req.body.KECAMATAN)
    data.push(req.body.ALAMAT)
    data.push(req.body.NOTELP)
    data.push(req.body.NAMABANK)
    data.push(req.body.NOREK)
    data.push(req.body.ATASNAMA)
    data.push(req.body.EMAIL)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.ISINSERT)
    hasiljson = await masterdatamodel.tambahmastersuplier(req, data, req.con)
    res.json({
        tambahmastersuplier: hasiljson,
    });
}
masterdataController.hapusmastersuplier = async function (req, res) {
    var data = []
    data.push(req.body.KODESUPLIER)
    data.push(req.body.NAMASUPLIER)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.hapusmastersuplier(req, data, req.con)
    res.json({
        hapusmastersuplier: hasiljson,
    });
}
masterdataController.mastersalesmankasir = async function (req, res) {
    var data = []
    data.push(req.body.KATAKUNCI)
    data.push(req.body.KODEUNIKMEMBER)   
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.mastersalesmankasir(req, data, req.con)
    res.json({
        mastersalesmankasir: hasiljson,
    });
}
/* master suplier area */
masterdataController.mastersales = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.mastersales(req, data, req.con)
    res.json({
        mastersales: hasiljson,
    });
}
masterdataController.hapussales = async function (req, res) {
    var data = []
    data.push(req.body.KODESALES)
    data.push(req.body.NAMASALES)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.hapussales(req, data, req.con)
    res.json({
        hapussales: hasiljson,
    });
}
masterdataController.tambahmastersales = async function (req, res) {
    var data = []
    data.push(req.body.KODESALES)
    data.push(req.body.NAMA)
    data.push(req.body.ALAMAT)
    data.push(req.body.KOTA)
    data.push(req.body.PROVINSI)
    data.push(req.body.NEGARA)
    data.push(req.body.KODEPOS)
    data.push(req.body.TELEPON)
    data.push(req.body.FAX)
    data.push(req.body.EMAIL)
    data.push(req.body.NOREK)
    data.push(req.body.PEMILIKREK)
    data.push(req.body.BANK)
    data.push(req.body.KETERANGAN)
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.ISINSERT)
    hasiljson = await masterdatamodel.tambahmastersales(req, data, req.con)
    res.json({
        tambahmastersales: hasiljson,
    });
}
/* master data pendukung */
masterdataController.datasatuan = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.datasatuan(req, data, req.con)
    res.json({
        datasatuan: hasiljson,
    });
}
masterdataController.hapussatuan = async function (req, res) {
    var data = []
    data.push(req.body.KODESATUAN)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.hapussatuan(req, data, req.con)
    res.json({
        hapussatuan: hasiljson,
    });
}
masterdataController.tambahsatuan = async function (req, res) {
    var data = []
    data.push(req.body.KODESATUAN)
    data.push(req.body.NAMASATUAN)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.tambahsatuan(req, data, req.con)
    res.json({
        tambahsatuan: hasiljson,
    });
}
masterdataController.masteraktegorimember = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.masteraktegorimember(req, data, req.con)
    res.json({
        masteraktegorimember: hasiljson,
    });
}
masterdataController.datakategori = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.datakategori(req, data, req.con)
    res.json({
        datakategori: hasiljson,
    });
}
masterdataController.hapuskategori = async function (req, res) {
    var data = []
    data.push(req.body.KODEKATEGORI)
    data.push(req.body.KODEUNIKMEMBER)
    /*untuk update beban */
    data.push(req.body.BEBANGAJI)
    data.push(req.body.BEBANPACKING)
    data.push(req.body.BEBANPROMO)
    data.push(req.body.BEBANTRANSPORT)
    data.push(req.body.UPDATEBEBAN)
    data.push(req.body.NAMAKATEGORI)
    hasiljson = await masterdatamodel.hapuskategori(req, data, req.con)
    res.json({
        hapuskategori: hasiljson,
    });
}
masterdataController.tambahkategori = async function (req, res) {
    var data = []
    data.push(req.body.KATEGORIPARENT_ID)
    data.push(req.body.NAMAKATEGORI)
    data.push(req.body.LOGOKATEGORI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.tambahkategori(req, data, req.con)
    res.json({
        tambahkategori: hasiljson,
    });
}
masterdataController.datakategorianggota = async function (req, res) {
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    data.push(req.body.DIMANA3)
    data.push(req.body.DIMANA4)
    data.push(req.body.DIMANA5)
    data.push(req.body.DIMANA6)
    data.push(req.body.DIMANA7)
    data.push(req.body.DIMANA8)
    data.push(req.body.DIMANA9)
    data.push(req.body.DIMANA10)
    data.push(req.body.DATAKE)
    data.push(req.body.LIMIT)
    hasiljson = await masterdatamodel.datakategorianggota(req, data, req.con)
    res.json({
        datakategorianggota: hasiljson,
    });
}
masterdataController.hapuskategorianggota = async function (req, res) {
    var data = []
    data.push(req.body.KODEKATEGORI)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.hapuskategorianggota(req, data, req.con)
    res.json({
        hapuskategorianggota: hasiljson,
    });
}
masterdataController.tambahkategorianggota = async function (req, res) {
    var data = []
    data.push(req.body.KODEGRUP)
    data.push(req.body.JENIS)
    data.push(req.body.GRUP)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.tambahkategorianggota(req, data, req.con)
    res.json({
        tambahkategorianggota: hasiljson,
    });
}
masterdataController.daftarpembayarannontunai = async function (req, res) {
    var data = []
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.JENISNONTUNAI)
    hasiljson = await masterdatamodel.daftarpembayarannontunai(req, data, req.con)
    res.json({
        daftarpembayarannontunai: hasiljson,
    });
}
masterdataController.jasondaftarbrand = async function (req, res) {
    var data = []
    data.push(req.body.NAMABRAND)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.jasondaftarbrand(req, data, req.con)
    res.json({
        jasondaftarbrand: hasiljson,
    });
}
masterdataController.jsonhapusbrand = async function (req, res) {
    var data = []
    data.push(req.body.BRAND_ID)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.jsonhapusbrand(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
masterdataController.jsontambahbrand = async function (req, res) {
    var data = []
    data.push(req.body.BRAND_ID)
    data.push(req.body.NAMA_BRAND)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.jsontambahbrand(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
masterdataController.jasondaftarprincipal = async function (req, res) {
    var data = []
    data.push(req.body.NAMA_PRINCIPAL)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.jasondaftarprincipal(req, data, req.con)
    res.json({
        jasondaftarprincipal: hasiljson,
    });
}
masterdataController.jsontambahprincipal = async function (req, res) {
    var data = []
    data.push(req.body.PRINCIPAL_ID)
    data.push(req.body.NAMA_PRINCIPAL)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.jsontambahprincipal(req, data, req.con)
    res.json({
        jsontambahprincipal: hasiljson,
    });
}
masterdataController.jsonhapusprincipal = async function (req, res) {
    var data = []
    data.push(req.body.PRINCIPAL_ID)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.jsonhapusprincipal(req, data, req.con)
    res.json({
        jsonhapusprincipal: hasiljson,
    });
}
masterdataController.informasirow1dashboard = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
masterdataController.informasirow2dashboard = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
masterdataController.selectvaluereport = async function (req, res) {  
    var data = []
    data.push(req.body.KONDISI)
    data.push(req.body.DIMANA1)
    data.push(req.body.DIMANA2)
    hasiljson = await SPModel.dataquery_controller_website(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
masterdataController.prosesoutlet = async function (req, res) {
    var data = []
    data.push(req.body.KODEUNIKMEMBER)
    data.push(req.body.KODEOUTLET)
    data.push(req.body.NAMAOUTLET)
    data.push(req.body.ALAMAT)
    data.push(req.body.LAT)
    data.push(req.body.LONG)
    data.push(req.body.NOTELP)
    data.push(req.body.APAKAHPUSAT)
    data.push(req.body.PAJAKNEGARA)
    data.push(req.body.PAJAKTOKO)
    hasiljson = await masterdatamodel.prosesoutlet(req, data, req.con)
    res.json({
        hasiljson: hasiljson,
    });
}
masterdataController.jasondaftarbankpencatatanlokal = async function (req, res) {
    var data = []
    data.push(req.body.NAMA_PENCATATAN)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.jasondaftarbankpencatatanlokal(req, data, req.con)
    res.json({
        jasondaftarbankpencatatanlokal: hasiljson,
    });
}
masterdataController.jsonhapusmetodepembayaran = async function (req, res) {
    var data = []
    data.push(req.body.KODE_PENCATATAN)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.jsonhapusmetodepembayaran(req, data, req.con)
    res.json({
        jsonhapusmetodepembayaran: hasiljson,
    });
}
masterdataController.nodesimpaninformasimetodepembayaran = async function (req, res) {
    var data = []
    data.push(req.body.KODE_BANK)
    data.push(req.body.NAMA_BANK)
    data.push(req.body.PAJAKDEBIT)
    data.push(req.body.PAJAKKREDIT)
    data.push(req.body.URLLOGO)
    data.push(req.body.JENISMETHOD)
    data.push(req.body.JENISISMPAN)
    data.push(req.body.KODEUNIKMEMBER)
    hasiljson = await masterdatamodel.nodesimpaninformasimetodepembayaran(req, data, req.con)
    res.json({
        simpaninformasimetodepembayaran: hasiljson,
    });
}
module.exports = masterdataController