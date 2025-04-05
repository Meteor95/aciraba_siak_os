require('dotenv').config()
const axios = require('axios')
const wasender = {}
wasender.wasendereraya = async function (req,data,con) {
    const configHeader = {
        headers: {}
    };
    const params = {
        'appkey': process.env.WAERAYA_APPKEY,
        'authkey': process.env.WAERAYA_AUTHKEY,
        'to': req.body.NOTELP,
        'message': 'Hallo, Saya Aciraba dari ERAYA DIGITAL. Hai '+req.body.NAMAASLI+' dengan nama pengguna '+req.body.NAMAPENGGUNA+' Kami menerima permintaan untuk membuat OTP untuk akun aktivasi Anda. OTP Anda: '+tokenUser+'. Masa aktif token 30 Detik. Abaikan jika bukan anda yang melakukan permintaan OTP. Jangan berikan KODE OTP kepada siapaun meskipun itu adalah TIM ERAYA DIGITAL. Kalau ada yang mengaku dari TIM ERAYA DIGITAL meminta OTP ke kamu? ajak berantem aja dia olok olok sampai PUAS'
    };
    const url = process.env.WAERAYA_ENDPOINT+'create-message'
    const options = {
        method: 'POST',
        url: url,
        headers: configHeader,
        data: params
    };
    try {
        const response = await axios(options);
        respondata = response.data;
    } catch (error) {
        respondata = false;
    }
};
wasender.wasenderfonnte_text = async function (req,data) {
    const configHeader = {
        'Authorization': process.env.FONNTE_APPKEY,
        'Content-Type': 'application/json'
    };
    const params = {
        'target': req.body.NOTELP,
        'message': data[0],
        'countryCode': "62",
    };
    const url = process.env.FONNTE_ENDPOINT+'send'
    const options = {
        method: 'POST',
        mode: "cors",
        url: url,
        headers: configHeader,
        data: params
    };
    try {
        const response = await axios(options);
        return response.data
    } catch (error) {
        respondata = false;
    }
}
module.exports = wasender;