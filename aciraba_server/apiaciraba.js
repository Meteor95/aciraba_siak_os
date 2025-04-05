require('dotenv').config()
const express = require('express')
const rateLimit = require('express-rate-limit');
const http = require('http')
const fileUpload = require('express-fileupload');
const con = require("./config/db.js")
const app = express()
const server = http.Server(app)
const cors = require("cors");
options = { cors: true, origins: ["https://acirabanode.erayadigital.co.id"], transports: ['websocket', 'polling'], forceNew: true, upgrade: false }
const io = require('socket.io')(server, options);
const nDate = new Date().toLocaleString('id-ID', { timeZone: 'Asia/Jakarta' });
const limiter = rateLimit({
    windowMs: 1 * 60 * 1000,
    max: 100,
    message: 'Terlalu banyak permintaan, coba lagi nanti.',
    trustProxy: true 
});
global.io = io;
app.disable('x-powered-by');
app.set('trust proxy', 1);
/* Global middleware */
app.use(limiter);
app.use(cors());
app.use(express.json())
app.use(express.urlencoded({ extended: true}));
app.use(function(req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});
app.use(function (req, res, next) {
    req.con = con.konekdatabase
    next()
})
app.use(fileUpload());
const auth = require("./routes/authrouter")
const google = require("./routes/googlerouter")
const masterdata = require("./routes/masterdatarouter")
const penjualan = require("./routes/penjualanrouter");
const pembelian = require("./routes/pembelianrouter");
const penyesuaian = require("./routes/penyesuaianrouter");
const siak = require("./routes/siakrouter");
const resto = require("./routes/restorouter");
const laporan = require("./routes/laporanrouter");
const paymentgateway = require("./routes/paymentgatewayrouter")
const acipay = require("./routes/acipayrouter");
const callback = require("./routes/callbackrouter");
// routing
app.use("/auth", auth)
app.use("/google", google)
app.use("/masterdata", masterdata)
app.use("/penjualan", penjualan)
app.use("/pembelian", pembelian)
app.use("/penyesuaian", penyesuaian)
app.use("/siak", siak)
app.use("/resto", resto)
app.use("/laporan", laporan)
app.use("/paymentgateway", paymentgateway)
app.use("/acipay", acipay)
app.use("/callback", callback)
app.use("/",function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/html'});
  res.end('DIAM ADALAH EMAS<br>REST API ACIRABA SUDAH BERJALAN. GAS TRANSAKSI!');
})
console.log('Aciraba Server Berjalan '+nDate)
server.listen(1111)