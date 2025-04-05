require('dotenv').config()
const crypto = require('crypto')
const duitkulib = require('../../config/api/duitku')
const paymentgateway = {}

paymentgateway.callback = async function(req,res){
    const apiKey = process.env.DUITKU_API_KEY;
    const { merchantCode, amount, merchantOrderId, signature, resultCode, reference } = req.body;
    if (!merchantCode || !amount || !merchantOrderId || !signature) {
        return res.status(400).send('Bad Parameter');
    }
    const params = `${merchantCode}${amount}${merchantOrderId}${apiKey}`;
    const calcSignature = crypto.createHash('md5').update(params).digest('hex');
    if (signature !== calcSignature) {
        return res.status(400).send('Bad Signature');
    }
    global.io.sockets.emit("callbackduitku", {
        response_code: resultCode,
        no_transaksi: merchantOrderId.replace('-','#'),
        no_refrensi: reference,
    });
    res.json({
        callback: req.body,
    });
}

paymentgateway.nodeduitkugetmethodpayment = async function(req,res){
    const daftarchanel = await duitkulib.daftarchanelpembayaran(req)
    res.json({
        daftarchanelpembayaran: daftarchanel,
    });
}
module.exports = paymentgateway