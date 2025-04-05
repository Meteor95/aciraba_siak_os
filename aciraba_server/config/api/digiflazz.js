require('dotenv').config()
const axios = require('axios')
const utils = {}
utils.digiflazzjson = async function (url, bodyparam) {
    try {
        const response = await axios.post(process.env.DIGIFLAZZ_ENDPOINT+url, JSON.parse(bodyparam), {
            headers: { 'Content-Type': 'application/json' }
        });
        data = {
            "success": true,
            "rc": 200,
            "messages": "Data ditemukan",
            "data": response.data.data,
        }
        return data;
    } catch (error) {
        data = {
            "success": false,
            "rc": error.response.status,
            "code": error.code,
            "rc_server":error.response.data.data.rc,
            "host": error.request.host,
            "messages": error.response.data.data.message,
            "data": [],
        }
        return data;
    }
};
utils.digiflazzjsonwebhook = async function (req,hmac) {
    let digiwebhooks;
    if(req.headers['x-hub-signature'] === hmac) {
        digiwebhooks = {
            event: req.headers['x-digiflazz-event'],
            delivery: req.headers['x-digiflazz-delivery'],
            data: req.body.data
        }
    }
    return digiwebhooks;
}
module.exports = utils;