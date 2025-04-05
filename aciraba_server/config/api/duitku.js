require('dotenv').config()
const crypto = require('crypto')
const axios = require('axios')
const utils = {}
const merchantCode = process.env.DUITKU_KODE_MERCHANT; 
const apiKey = process.env.DUITKU_API_KEY;
const paymentAmount = 0;
const configHeader = {
    headers: {
        'Content-Type': 'application/json'
    }
};
utils.signatureduitku = function(merchantCode, amount, datetime, apiKey, jenis, merchantOrderId){
    /*
    0 = Signature Non Transaksi
    1 = Signature Transaksi Hash MD5
    */
    let signature = ""
    if (jenis == 0){
        signature = crypto.createHash('sha256').update(merchantCode + amount + datetime + apiKey).digest('hex');
    }else if (jenis == 1){
        signature = crypto.createHash('md5').update(merchantCode + merchantOrderId + amount + apiKey).digest('hex');
    }
    return signature;
}
utils.daftarchanelpembayaran = async function(){
    const datetime = new Date().toISOString().slice(0, 19).replace('T', ' ');  
    const params = {
        merchantcode: merchantCode,
        amount: paymentAmount,
        datetime: datetime,
        signature: utils.signatureduitku(merchantCode,paymentAmount,datetime,apiKey,0,"")
    };
    const url = process.env.DUITKU_END_POIT+'paymentmethod/getpaymentmethod'
    const options = {
        method: 'POST',
        url: url,
        headers: configHeader,
        data: params
      };
    try {
        const response = await axios(options);
        return response.data;
    } catch (error) {
        return error;
    }
}
utils.reqtrx = async function(requestbody){
    const url = process.env.DUITKU_END_POIT+'v2/inquiry'
    const options = {
        method: 'POST',
        url: url,
        headers: configHeader,
        data: requestbody
      };
    try {
        const response = await axios(options);
        return response.data;
    } catch (error) {
        return error;
    }
}
module.exports = utils;