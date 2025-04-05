const USB = require('@node-escpos/usb-adapter');
const Printer = require('@node-escpos/core').Printer;
const util = require('../helper/utils');
const printerController = {}

printerController.printerfn = async function (req, res) {
    const device = new USB('USB002');
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
        .text("WAKTU TRX: "+req.body.TGLKELUAR+" "+req.body.WAKTU)
        .text("NAMA KASIR: "+req.body.NAMAPENGGUNA)
        .text("NAMA MEMBER: "+req.body.NAMAMEMBER)
        .text("NO FAKTUR: "+req.body.NOTAPENJUALAN)
        .align("ct")
        .text(process.env.BARIS5)
        .text("DAFTAR BELANJAAN ANDA [Rp]");
        printer.align("lt");
        const informasib_barang = JSON.parse(req.body.INFORMASIBARANG);
        for (let i = 0; i < informasib_barang.length; i++) {
            const datanya = informasib_barang[i];
            if (datanya.length === 8) {
                printer
                .text(`${datanya[1]}`)
                .tableCustom(
                    [
                        { text: util.numberFormatJs(datanya[3]), align: "LEFT", width: 0.33 },
                        { text: util.numberFormatJs(datanya[2]), align: "LEFT", width: 0.33 },
                        { text: util.numberFormatJs(datanya[5]), align: "LEFT", width: 0.33 },
                    ],
                    { encoding: "cp857", size: [1, 1] },
                );
            } else {
                printer.text(`${datanya[0]}`)
                .tableCustom(
                    [
                        { text: util.numberFormatJs(datanya[6]), align: "LEFT", width: 0.33 },
                        { text: util.numberFormatJs(datanya[1]), align: "LEFT", width: 0.33 },
                        { text: util.numberFormatJs(datanya[2]), align: "LEFT", width: 0.33 },
                    ],
                    { encoding: "cp857", size: [1, 1] },
                );
            }
        }
        printer
        .align("ct")
        .text(process.env.BARIS5)
        .align("rt")
        .text("TOTAL BELANJA: "+util.numberFormatJs(req.body.TOTALBELANJA))
        .text("TOTAL BAYAR: "+util.numberFormatJs(req.body.NOMINALBAYAR))
        .text("KEMBALIAN: "+util.numberFormatJs(req.body.KEMBALIAN))
        .text("")
        .align("ct")
        .text(process.env.KAKI1)
        .text(process.env.KAKI2)
        .text(process.env.KAKI3)
        .text(process.env.KAKI4)
    printer.cut().close()
    });
}

module.exports = printerController