require('dotenv').config()
const axios = require('axios')
const utils = {}
const optionsheader = {
    accept: 'application/json',
    'content-type': 'application/json',
    authorization: 'Basic '+Buffer.from(process.env.MIDTRANS_SERVER_KEY+":"+process.env.MIDTRANS_CLIENT_KEY).toString('base64')
};
utils.requesttrxcharge = async function (requestbody) {
    const url = process.env.MIDTRANS_END_POINT+'charge'
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
};
module.exports = utils;