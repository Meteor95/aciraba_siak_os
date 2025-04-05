const http = require('http');
const dotenv = require('dotenv');
const express = require('express');
const cors = require("cors");
const printer = require("./routes/escprinter");
const socketIOClient = require('socket.io-client');
const USB = require('@node-escpos/usb-adapter');
const Printer = require('@node-escpos/core').Printer;
const util = require('./helper/utils');

dotenv.config();
const app = express()
const server = http.Server(app)
const nDate = new Date().toLocaleString('id-ID', { timeZone: 'Asia/Jakarta'});
app.disable('x-powered-by');
app.use(cors());
app.use(express.json())
app.use(express.urlencoded({ extended: true }));
app.use(function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  next();
});
app.use("/printer", printer)
const device = new USB(process.env.WSS_PORT_USB);
let externalSocket = socketIOClient(process.env.SOCKETURL);
global.externalSocketIo = externalSocket;
externalSocket.on("connect", () => {
  console.log("Connected to "+process.env.SOCKETURL+" Socket.IO server ");
  externalSocket.on(process.env.SOCKETID, (arg) => {
    device.open(async function(err){
    if(err){
        return
    }
    const options = { encoding: "GB18030" }
    let printer = new Printer(device, options);
    printer
        .size(1.5, 1.5)
        .align("ct")
        .text(process.env.BARIS1)
        .text(process.env.BARIS2)
        .text(process.env.BARIS3)
        .text(process.env.BARIS4)
        .text(process.env.BARIS5)
        .size(1, 1)
        .align("lt")
        .text("WAKTU TRX: "+arg.datatransaksi.TGLKELUAR+" "+arg.datatransaksi.WAKTU)
        .text("NAMA KASIR: "+arg.datatransaksi.NAMAPENGGUNA)
        .text("NAMA MEMBER: "+arg.datatransaksi.NAMAMEMBER)
        .text("FAKTUR: "+arg.datatransaksi.NOTAPENJUALAN)
        .align("ct")
        .text("DAFTAR BELANJAAN ANDA [Rp]")
        .text(process.env.BARIS5)
        .align("lt")
        const informasib_barang = JSON.parse(arg.datatransaksi.INFORMASIBARANG);
        for (let i = 0; i < informasib_barang.length; i++) {
            const datanya = informasib_barang[i];
            if (datanya.length === 8) {
                printer.text(datanya[1])
                .tableCustom(
                    [
                        { text: util.numberFormatJs(datanya[3]), align: "LEFT", width: 0.15 },
                        { text: util.numberFormatJs(datanya[2]), align: "LEFT", width: 0.25 },
                        { text: util.numberFormatJs(datanya[5]), align: "LEFT", width: 0.25 },
                    ]
                );
            } else {
                printer.text(datanya[0])
                .tableCustom(
                    [
                        { text: util.numberFormatJs(datanya[6]), align: "LEFT", width: 0.15 },
                        { text: util.numberFormatJs(datanya[1]), align: "LEFT", width: 0.25 },
                        { text: util.numberFormatJs(datanya[2]), align: "RIGHT", width: 0.25 },
                    ]
                );
            }
        }
        printer
        .align("ct")
        .text(process.env.BARIS5)
        .align("rt")
        .text("TOTAL BELANJA: "+util.numberFormatJs(arg.datatransaksi.TOTALBELANJA))
        .text("TOTAL BAYAR: "+util.numberFormatJs(arg.datatransaksi.NOMINALBAYAR))
        .text("KEMBALIAN: "+util.numberFormatJs(arg.datatransaksi.KEMBALIAN))
        .text("")
        .align("ct")
        .text(process.env.KAKI1)
        .text(process.env.KAKI2)
        .text(process.env.KAKI3)
        .text(process.env.KAKI4)
    printer.cut().close()
    });
  });
  externalSocket.on("KDS_"+process.env.SOCKETID, (arg) => {
    device.open(async function(err){
    if(err){
        return
    }
    const options = { encoding: "GB18030" }
    let printer = new Printer(device, options);
    printer
        .size(1, 1)
        .align("lt")
        .text("UNTUK: "+arg.datatransaksi.KETERANGAN)
        .text("WAKTU TRX: "+arg.datatransaksi.TGLKELUAR+" "+arg.datatransaksi.WAKTU)
        .text("NAMA MEMBER: "+arg.datatransaksi.NAMAMEMBER)
        .text("FAKTUR: "+arg.datatransaksi.NOTAPENJUALAN)
        .align("ct")
        .text("DAFTAR PESANAN PELANGGAN")
        .text(process.env.BARIS5)
        .align("lt")
        const informasib_barang = JSON.parse(arg.datatransaksi.INFORMASIBARANG);
        for (let i = 0; i < informasib_barang.length; i++) {
            const datanya = informasib_barang[i];
            if (datanya.length === 8) {
                printer.text("QTY : "+datanya[3]+" "+datanya[1])
            } else {
                printer.text("QTY : "+datanya[6]+" "+datanya[0])
            }
        }
    printer.cut().close()
    });
  });
});
externalSocket.on("disconnect", () => {
  console.log("Disconnected from "+process.env.SOCKETURL+" Socket.IO server");
});
console.log('Print client berjalan pada port '+process.env.WSS_PORT_SOCKET+". Tanggal "+nDate)
server.listen(process.env.WSS_PORT_SOCKET)
