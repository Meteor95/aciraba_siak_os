require('dotenv').config()
const digiflazzcallback = {}
const mdf = require("../model/Digiflazz")
const penjualandata = require("../controller/penjualanController")
const crypto = require('crypto');
const _ = require('lodash');
const digiflazz = require('../config/api/digiflazz');

function signature(kondisi){
    return crypto.createHash('md5').update(process.env.DIGIFLAZZ_USERNAME+process.env.DIGIFLAZZ_KEY+kondisi).digest('hex')
}
digiflazzcallback.apidigiflazz = async function(req,res){
	if (req.body.CMD == "ceksaldo"){
        const responsejson = await digiflazz.digiflazzjson('cek-saldo',JSON.stringify({ cmd:"deposit", username:process.env.DIGIFLAZZ_USERNAME, sign:signature("depo")}))
        return responsejson
    }else if (req.body.CMD == "produk"){
        //untuk pulsa, voucher game gunakan JENISPRODUK = prepaid kalau tagihan gunakan JENISPRODUK = pasca
        const responsejson = await digiflazz.digiflazzjson('price-list', JSON.stringify({ cmd: req.body.JENISPRODUK, username: process.env.DIGIFLAZZ_USERNAME, code: req.body.SKU_EXACT, sign: signature("pricelist") }))
        if (req.body.SKU_FILTER !== "") {
            const hasilfilter = responsejson.data.filter(item => item.buyer_sku_code.toLowerCase().includes(req.body.SKU_FILTER.toLowerCase())).sort((a, b) => a.price - b.price)
            data = {
                "success": true,
                "rc": 200,
                "messages": "Hasil informasi sinkron yang tersedia berdasarkan kata masukan",
                "data": hasilfilter,
            }
            return data
        }
        return responsejson
    }else if (req.body.CMD == "deposit"){
        //Nama bank tujuan yang akan menjadi tujuan transfer Anda, Pilihan bank: BCA / MANDIRI / BRI
        const responsejson = await digiflazz.digiflazzjson('price-list',JSON.stringify({"username": process.env.DIGIFLAZZ_USERNAME,"amount": req.body.NOMINALTOPUP,"Bank": req.body.KODEBANK,"owner_name": req.body.ATASNAMA,"sign": signature("deposit")}))
        return responsejson
    }else if (req.body.CMD == "transaksi"){
        const responsejson = await digiflazz.digiflazzjson('transaction',JSON.stringify({"username": process.env.DIGIFLAZZ_USERNAME,"buyer_sku_code": req.body.KODEPRODUKSERVER,"customer_no": req.body.TUJUAN,"ref_id": req.body.TRANSKASI_ID,"sign": signature(req.body.TRANSKASI_ID),"testing":process.env.DIGIFLAZZ_TESTING}))
        return responsejson
    }else if (req.body.CMD == "tagihan"){
        //inq-pasca untuk cek tagihan sedangkan pay-pasca untuk membayar tagihan stelah di cek
        const responsejson = await digiflazz.digiflazzjson('transaction',JSON.stringify({"commands": req.body.TIPETRX,"username": process.env.DIGIFLAZZ_USERNAME,"buyer_sku_code": req.body.KODEPRODUKSERVERPPOB,"customer_no":req.body.TUJUAN,"ref_id": req.body.TRANSKASI_ID,"sign": signature(req.body.TRANSKASI_ID),"testing":process.env.DIGIFLAZZ_TESTING}))
        return responsejson
    }else if (req.body.CMD == "cektokenpln"){
        const responsejson = await digiflazz.digiflazzjson('transaction',JSON.stringify({"commands": "pln-subscribe","customer_no": req.body.TUJUAN}))
        return responsejson
    }
}
digiflazzcallback.webhook = async function(req,res){
    const hmac = 'sha1=' + crypto.createHmac('sha1', process.env.DIGIFLAZZ_SECRET_KEY).update(JSON.stringify(req.body)).digest('hex');
    const responsejson = await digiflazz.digiflazzjsonwebhook(req,hmac)
    return responsejson
}
digiflazzcallback.updateproduk = async function(req,res){
    data = [];
    const jenisproduk = req.body.JENISPRODUK
    const kategoriproduk = req.body.KATPRODUK
    const pemisah = req.body.PEMISAH
    const batasjumlahhuruf = req.body.BATASJUMLAH
    const responsejson = await digiflazz.digiflazzjson('price-list',JSON.stringify({ cmd:jenisproduk, username:process.env.DIGIFLAZZ_USERNAME, sign:signature("pricelist"), code:kategoriproduk}))
    data.push(_.filter(responsejson.data, function(o) { return o.buyer_sku_code.substring(0, batasjumlahhuruf) == pemisah}))
    data.push(req.body.PRODUK_OPERATOR_ID.substr(0, req.body.PRODUK_OPERATOR_ID.indexOf('-')).replace(/\s/g, ''))
    data.push(req.body.PRODUK_KATEGORI_ID)
    data.push(req.body.JENISPRODUK)
    data.push(req.body.IKONPRODUK)
    hasiljson = await mdf.updateproduk(req,data,req.con)
    res.json({
        hasiljson: hasiljson,
    });
}

module.exports = digiflazzcallback