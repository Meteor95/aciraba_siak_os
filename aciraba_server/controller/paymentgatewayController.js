require('dotenv').config()
const tripaylib = require('../config/api/tripay');
const duitkulib = require('../config/api/duitku');
const util = require('../config/utils');
const paymentgateway = {}

paymentgateway.reqtrx = async function(req,res){
  let responsecektransaksi = {}
  if (req.body.VENDOR == "duitku"){
    /*const updatedItemDetails = req.body.ITEMS.map(item => ({
      ...item,
      'name': item.name,
      'price': parseInt(item.price) * parseInt(item.quantity),
      'quantity': parseInt(item.quantity)
    }));*/
    requestbody = {
      "merchantCode":process.env.DUITKU_KODE_MERCHANT,
      "paymentAmount":parseInt(req.body.TOTALBELANJA),
      "paymentMethod":req.body.METHOD,
      "merchantOrderId":util.replaceNonAlphanumericWithDash(req.body.ORDERID),
      "productDetails": "Transaksi Menggunakan "+req.body.METHOD+" Pada TRX "+req.body.ORDERID,
      "customerVaName":req.body.NAMAMEMBER,
      "email":req.body.EMAIL,
      "phoneNumber":req.body.NOKONTAK,
      /*"itemDetails":updatedItemDetails,*/
      "callbackUrl":process.env.DUITKU_CALL_BACK_URL,
      "returnUrl":process.env.BASE_URL,
      "signature":duitkulib.signatureduitku(process.env.DUITKU_KODE_MERCHANT, req.body.TOTALBELANJA, "", process.env.DUITKU_API_KEY, 1, util.replaceNonAlphanumericWithDash(req.body.ORDERID)),
      "expiryPeriod":50
    };
    responsecektransaksi = await duitkulib.reqtrx(requestbody)
  }
  res.json({
    hasilresponsecektransaksi: responsecektransaksi,
  });
}
paymentgateway.detailtransaksi = async function(req,res){
  if (req.body.VENDOR == "duitku"){
    
  }
}

module.exports = paymentgateway