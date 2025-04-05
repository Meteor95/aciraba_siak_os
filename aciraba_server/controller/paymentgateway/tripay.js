require('dotenv').config()
const tripaylib = require('../../config/api/tripay');
const util = require('../../config/utils');
const paymentgateway = {}

paymentgateway.daftarchannel = async function(req,res){
    const responsecektransaksi = await tripaylib.daftarchanelpembayaran(req)
    console.log(responsecektransaksi)
}
module.exports = paymentgateway