require('dotenv').config()
const crypto = require('crypto')
const axios = require('axios')
const utils = {}
const optionsheader = {
    Authorization: 'Bearer '+process.env.TRIPAY_APIKEY,
};
const privateKey    = process.env.TRIPAY_PRIVATE_KEY;
const merchant_code = process.env.TRIPAY_MERCHANT_ID;
utils.signaturetripay = function(merchant_ref,amount){
    const signature = crypto.createHmac('sha256', privateKey).update(merchant_code + merchant_ref + amount).digest('hex');
    return signature;
}
utils.reqtrx = async function(requestbody){
    const url = process.env.TRIPAY_END_POINT+'transaction/create'
    const options = {
        method: 'POST',
        url: url,
        headers: optionsheader,
        data: requestbody
      };
    try {
        const response = await axios(options);
        return response.data;
    } catch (error) {
        return error;
    }
}
utils.detailtransaksi = async function(requestbody){
    const url = process.env.TRIPAY_END_POINT+'merchant/transactions'
    const options = {
        method: 'GET',
        url: url,
        headers: optionsheader,
        data: requestbody
      };
    try {
        const response = await axios(options);
        return response.data;
    } catch (error) {
        return error;
    }
}
utils.daftarchanelpembayaran = async function (namachannel){
    const url = process.env.TRIPAY_END_POINT+'merchant/payment-channel'
    const options = {
        method: 'GET',
        url: url,
        headers: optionsheader,
      };
    try {
        const response = await axios(options);
        return response.data;
    } catch (error) {
        return error;
    }
}
module.exports = utils;