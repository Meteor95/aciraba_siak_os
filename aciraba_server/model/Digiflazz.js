require('dotenv').config()
const util = require('../config/utils');

const auth = {}

auth.updateproduk = async function (req, data, con) {
    pesanbalik = [];
    const jsonfromcontroller = data[0];
    batchinsert = []
    for(var attributename in jsonfromcontroller){
        var obj = {
            PRODUK_ID: "ACIPAY"+jsonfromcontroller[attributename].buyer_sku_code,
            PRODUK_ID_SERVER: jsonfromcontroller[attributename].buyer_sku_code,
            APISERVER_ID: 1,
            PRODUK_OPERATOR_ID: data[1],
            PRODUK_KATEGORI_ID: data[2],
            NAMA_PRODUK: jsonfromcontroller[attributename].product_name,
            KETERANGAN: jsonfromcontroller[attributename].desc,
            HARGA_SERVER: jsonfromcontroller[attributename].price,
            MARKUP: "0",
            HARGA_UMUM: jsonfromcontroller[attributename].price,
            HARGA_AGEN: jsonfromcontroller[attributename].price,
            HARGA_MEGAAGEN: jsonfromcontroller[attributename].price,
            HARGA_LAINLAIN: "0",
            STATUS: jsonfromcontroller[attributename].seller_product_status,
            POIN: 1,
            IMGURL: data[4],
            JAM_MULAI: jsonfromcontroller[attributename].start_cut_off,
            JAM_TUTUP: jsonfromcontroller[attributename].end_cut_off,
            MULTI: jsonfromcontroller[attributename].multi,
            STOK: jsonfromcontroller[attributename].stock,
            URUTAN: attributename,
            JENISPRODUK: data[3],
        };
        batchinsert.push(obj)
    }
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_acipay_produknonppob(PRODUK_ID, PRODUK_ID_SERVER,APISERVER_ID,PRODUK_OPERATOR_ID,PRODUK_KATEGORI_ID,NAMA_PRODUK,KETERANGAN,HARGA_SERVER,MARKUP,HARGA_UMUM,HARGA_AGEN,HARGA_MEGAAGEN,HARGA_LAINLAIN,STATUS,POIN,IMGURL,JAM_MULAI,JAM_TUTUP,MULTI,STOK,URUTAN,JENISPRODUK) VALUES ? ON DUPLICATE KEY UPDATE KETERANGAN=VALUES(KETERANGAN),HARGA_SERVER=VALUES(HARGA_SERVER),JAM_MULAI=VALUES(JAM_MULAI),JAM_TUTUP=VALUES(JAM_TUTUP),MULTI=VALUES(MULTI),STOK=VALUES(STOK),STATUS=VALUES(STATUS)`, [batchinsert.map(item => [item.PRODUK_ID, item.PRODUK_ID_SERVER, item.APISERVER_ID, item.PRODUK_OPERATOR_ID, item.PRODUK_KATEGORI_ID, item.NAMA_PRODUK, item.KETERANGAN, item.HARGA_SERVER, item.MARKUP, item.HARGA_UMUM, item.HARGA_AGEN, item.HARGA_MEGAAGEN, item.HARGA_LAINLAIN, item.STATUS, item.POIN, item.IMGURL, item.JAM_MULAI, item.JAM_TUTUP, item.MULTI, item.STOK, item.URUTAN, item.JENISPRODUK])], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: 'Sinkronisasi terhadap server berhasil. Silahkan tentukan harga jual pada masing masing level pelanggan',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.affectedRows == 0 ? "00x000" : dataquery.code,
            msg: dataquery.affectedRows == 0 ? "Query berhasil di eksekusi, tetapi tidak terjadi perubahan apapun, cek kondisi seleksi data anda" : dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    batchinsert = [];
    return pesanbalik;
}
module.exports = auth;