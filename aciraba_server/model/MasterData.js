require('dotenv').config()
const util = require('../config/utils');
const xss = require('xss');
const masterdata = {}
var pesanbalik = {}

masterdata.daftarbarang = async function (req, data, con) {
    pesanbalik = [];
    let datadaftarbarang = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12], ], con);
    if (datadaftarbarang[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: datadaftarbarang[0].length,
            daftarbarang: datadaftarbarang[0]
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}

masterdata.daftarbarangdetail = async function (req, data, con) {
    pesanbalik = [];
    let querygrosir = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[7], data[2], data[3], data[4], '', '', '', '', '', '', '0', '0'], con);
    let querytambahan = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_tms_bestbuybarangtambahan WHERE BARANG_ID = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?`, [data[2], data[3], data[4]], con);
    let hasilquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12] ], con);
    data = {
        success: "true",
        rc: "200",
        totaldata: hasilquery[0].length,
        daftarbarang: hasilquery[0],
        totaldatabestbuygrosir: querygrosir[0].length,
        bestbuygrosir: querygrosir[0],
        totaldatabarangtambahan: querytambahan.length,
        bestbuytambahbarang: querytambahan,
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftarsuplierselect = async function (req, data, con) {
    pesanbalik = [];
    let daftarsuplier = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12], ], con);
    if (daftarsuplier[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
            totaldata: 0,
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: daftarsuplier[0].length,
            daftarsuplier: daftarsuplier[0]
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftakategoriselect = async function (req, data, con) {
    pesanbalik = [];
    let daftarkategori = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12], ], con);
    if (daftarkategori[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: daftarkategori[0].length,
            daftarkategori: daftarkategori[0]
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftakategoriselectkasir = async function (req, data, con) {
    pesanbalik = [];
    let daftarkategori = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_tms_kategori WHERE NAMAKATEGORI LIKE ? AND KODEUNIKMEMBER = ?`, ['%' + data[0] + '%', data[1]], con);
    if (daftarkategori.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: daftarkategori.length,
            daftarkategori: daftarkategori
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftarsatuanselect = async function (req, data, con) {
    pesanbalik = [];
    let daftarsatuan = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12], ], con);
    if (daftarsatuan[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: daftarsatuan[0].length,
            daftarsatuan: daftarsatuan[0]
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftarperusahaan = async function (req, data, con) {
    pesanbalik = [];
    let daftarperusahaan = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_tms_perusahaan WHERE NAMAPERUSAHAAN LIKE ? AND KODEUNIKMEMBER = ?`, ['%' + data[0] + '%',data[1] ], con);
    if (daftarperusahaan.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
            totaldata: 0,
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: daftarperusahaan.length,
            daftarperusahaan: daftarperusahaan
        }
    }
    
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftarprincipal = async function (req, data, con) {
    pesanbalik = [];
    let daftarprincipal = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_tms_principal WHERE NAMA_PRINCIPAL LIKE ? AND KODEUNIKMEMBER = ?`, ['%' + data[0] + '%',data[1] ], con);
    if (daftarprincipal.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: daftarprincipal.length,
            daftarprincipal: daftarprincipal
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.jenispembayarantransaksi = async function (req, data, con) {
    pesanbalik = [];
    let jenispembayarantransaksi = await util.eksekusiQueryPromise(req, 'SELECT BANK_ID,NAMABANK FROM 01_tms_pembayaranbank WHERE (JENISNONTUNAI = ? OR JENISNONTUNAI = ?) AND KODEUNIKMEMBER = ?', ['B','E',req.body.KODEUNIKMEMBER], con);
    if (jenispembayarantransaksi.length == 0) {
        data = {
            success: "false",
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
            totaldata: 0,
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: jenispembayarantransaksi.length,
            jenispembayarantransaksi: jenispembayarantransaksi
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftarbrand = async function (req, data, con) {
    pesanbalik = [];
    let daftarbrand = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_tms_brand WHERE NAMA_BRAND LIKE ? AND KODEUNIKMEMBER = ?`, ['%' + data[0] + '%',data[1] ], con);
    if (daftarbrand.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: daftarbrand.length,
            daftarbrand: daftarbrand
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.rebuildstok = async function (req, data, con) {
    pesanbalik = [];
    let hasilquery = "",
        pesan = "";
    hasilquery = await util.eksekusiQueryPromise(req, 'UPDATE 01_tms_barangkharisma as A JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID SET AKTIF = ? WHERE A.BARANG_ID = ? AND B.OUTLET = ? AND B.KODEUNIKMEMBER = ?',
            [data[0] == "1" ? "0" : "1", data[1], data[2], data[3]], con);
    if (!hasilquery) {
        pesan = 'Gagal mengubah status item ' + data[1] + ' [' + data[4] + ']'
        data = {
            success: 'false',
            rc: '404',
            msg: pesan,
        }
    } else {
        pesan = '[200] Gagal mengubah status item ' + data[1] + ' [' + data[4] + ']'
        data = {
            success: "true",
            rc: "200",
            msg: pesan,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahitem = async function (req, data, con) {
    pesanbalik = [];
    let hasildata = await util.eksekusiQueryPromise(req, 'SELECT COUNT(*) as ADADATA FROM 01_tms_barangkharisma WHERE BARANG_ID = ? AND KODEUNIKMEMBER = ? LIMIT 1', [data[1], data[14]], con);
    if (hasildata[0].ADADATA > 0 && data[0] == "true") {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Terjadi duplikasi data pada NAMA : '+data[3]+' dengan KODE ITEM : '+data[1]+'. Silahkan masukan dengan KODE ITEM yang berbeda'
        }
    }else{
        /* insert fitur master item harga grosir */
        if (data[19] == "true") {
            const batchinsert = [];
            for (let i = 0; i < data[20].length; i++) {
                let strarray = data[20][i].split(',')
                var obj = {
                    AI_GROSIR: "",
                    BARANG_ID: strarray[0],
                    JIKABELI: strarray[1],
                    HARGABELIGROSIR: strarray[2],
                    HARGADASAR: data[10],
                    SATUAN: data[12],
                    KODEUNIKMEMBER: data[14],
                    OUTLET: data[21],
                };
                batchinsert.push(obj);
            }
            if (data[20].length > 0) {
                let temp = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_bestbuybaranggrosir WHERE BARANG_ID = ? AND KODEUNIKMEMBER = ? AND OUTLET = ?`, [
                    data[1],data[14],data[21]
                ], con);
                temp = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_bestbuybaranggrosir(AI_GROSIR,BARANG_ID,JIKABELI,HARGABELIGROSIR,HARGADASAR,SATUAN,KODEUNIKMEMBER,OUTLET) VALUES ?`,
                    [batchinsert.map(item => [item.AI_GROSIR, item.BARANG_ID, item.JIKABELI, item.HARGABELIGROSIR, item.HARGADASAR, item.SATUAN, item.KODEUNIKMEMBER, item.OUTLET])], con);
            }
        }
        /* insert fitur master item harga tambahan*/
        if (data[22] == "true") {
            const batchinsert = [];
            for (let i = 0; i < data[23].length; i++) {
                let strarray = data[23][i].split(',')
                var obj = {
                    AI_TAMBAHAN: "",
                    BARANG_ID: data[1],
                    NAMATAMBAHAN: strarray[0],
                    HARGA: strarray[1],
                    OUTLET: data[21],
                    KODEUNIKMEMBER: data[14],
                };
                batchinsert.push(obj);
            }
            if (data[23].length > 0) {
                let temp = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_bestbuybarangtambahan WHERE BARANG_ID = ? AND KODEUNIKMEMBER = ? AND OUTLET = ?`, [
                    data[1],data[14],data[21]
                ], con);
                temp = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_bestbuybarangtambahan(AI_TAMBAHAN,BARANG_ID,NAMATAMBAHAN,HARGA,OUTLET,KODEUNIKMEMBER) VALUES ?`,
                    [batchinsert.map(item => [item.AI_TAMBAHAN, item.BARANG_ID, item.NAMATAMBAHAN, item.HARGA, item.OUTLET, item.KODEUNIKMEMBER])], con);
            }
        }
        let daftarsatuan
        if (data[0] == "true") {
            daftarsatuan = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_barangkharisma(BARANG_ID, QRCODE_ID, NAMABARANG, BERAT_BARANG, PARETO_ID, SUPPLER_ID, KATEGORI_ID, BRAND_ID, KETERANGANBARANG, HARGABELI, HARGAJUAL, SATUAN, AKTIF, KODEUNIKMEMBER, APAKAHGROSIR, STOKDAPATMINUS, JENISBARANG, PEMILIK, APAKAHBONUS,FILECITRA,URUTAN) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)`, [
                data[1],data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12],data[13],data[14],data[15] == 'true' ? 'AKTIF' : 'TIDAK AKTIF',data[16] == 'true' ? 'DAPAT MINUS' : 'TIDAK DAPAT MINUS' ,data[17] == '1' ? 'JASA' : 'BUKAN JASA',data[18],data[22] == 'true' ? 'AKTIF' : 'TIDAK AKTIF','not_found','0'
            ], con);
            daftarsatuan = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_stok(BARANG_ID, DISPLAY, GUDANG, RETUR, OUTLET, KODEUNIKMEMBER) VALUES (?, ?, ?, ?, ?, ?)`, [
                data[1],0,0,0,data[21],data[14]
            ], con);
        } else {
            daftarsatuan = await util.eksekusiQueryPromise(req, `UPDATE 01_tms_barangkharisma SET BARANG_ID = ?, QRCODE_ID = ?, NAMABARANG = ?, BERAT_BARANG = ?, PARETO_ID = ?, SUPPLER_ID = ?, KATEGORI_ID = ?, BRAND_ID = ?, KETERANGANBARANG = ?, HARGABELI = ?, HARGAJUAL = ?, SATUAN = ?, AKTIF = ?, KODEUNIKMEMBER = ?, APAKAHGROSIR = ?, STOKDAPATMINUS = ?, JENISBARANG = ?, PEMILIK = ?, APAKAHBONUS = ? WHERE BARANG_ID = ? AND KODEUNIKMEMBER = ?`, [
                data[1],data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12],data[13],data[14],data[15] == 'true' ? 'AKTIF' : 'TIDAK AKTIF',data[16] == 'true' ? 'DAPAT MINUS' : 'TIDAK DAPAT MINUS' ,data[17] == '1' ? 'JASA' : 'BUKAN JASA',data[18],data[22] == 'true' ? 'AKTIF' : 'TIDAK AKTIF', data[1], data[14]
            ], con);
        }
        if (daftarsatuan.affectedRows > 0) {
            data = {
                success: "true",
                rc: "200",
                msg: "Informasi data anda berhasil tersimpan di database",
            }
        } else {
            data = {
                success: 'false',
                rc: daftarsatuan.code,
                msg: daftarsatuan.sqlMessage,
            }
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahitemajaxbulk = async function (req, data, con) {
    pesanbalik = [], batchinsert = [],batchinsertstok = []
    for (let i = 0; i < data[0].length; i++) {
        var obj = {
            BARANG_ID: data[0][i][0],
            QRCODE_ID: data[0][i][1],
            NAMABARANG: data[0][i][2],
            BERAT_BARANG: data[0][i][3],
            PARETO_ID: data[0][i][4],
            SUPPLER_ID: data[0][i][5],
            KATEGORI_ID: data[0][i][6],
            BRAND_ID: data[0][i][7],
            KETERANGANBARANG: data[0][i][8],
            HARGABELI: data[0][i][9],
            HARGAJUAL: data[0][i][10],
            SATUAN: data[0][i][11],
            AKTIF: data[0][i][12],
            KODEUNIKMEMBER: data[0][i][13],
            APAKAHGROSIR: data[0][i][14],
            STOKDAPATMINUS: data[0][i][15],
            JENISBARANG: data[0][i][16],
            PEMILIK: data[0][i][17],
            APAKAHBONUS: "TIDAK AKTIF",
            FILECITRA: "not_found",
        };
        batchinsert.push(obj);
    }
    for (let i = 0; i < data[0].length; i++) {
        var obj = {
            BARANG_ID: data[0][i][0],
            DISPLAY: '0',
            GUDANG: '0',
            RETUR: '0',
            OUTLET: data[2],
            KODEUNIKMEMBER: data[0][i][13],
        };
        batchinsertstok.push(obj);
    }
    dataquery = await util.eksekusiQueryPromise(req, `INSERT IGNORE INTO 01_tms_barangkharisma(AI,BARANG_ID, QRCODE_ID, NAMABARANG, BERAT_BARANG, PARETO_ID, SUPPLER_ID, KATEGORI_ID, BRAND_ID, KETERANGANBARANG, HARGABELI, HARGAJUAL, SATUAN, AKTIF, KODEUNIKMEMBER, APAKAHGROSIR, STOKDAPATMINUS, JENISBARANG, PEMILIK, APAKAHBONUS, FILECITRA) VALUES ?`, [batchinsert.map(item => ['0',item.BARANG_ID, item.QRCODE_ID, item.NAMABARANG, item.BERAT_BARANG, item.PARETO_ID, item.SUPPLER_ID, item.KATEGORI_ID, item.BRAND_ID, item.KETERANGANBARANG, item.HARGABELI, item.HARGAJUAL, item.SATUAN, item.AKTIF, item.KODEUNIKMEMBER, item.APAKAHGROSIR, item.STOKDAPATMINUS, item.JENISBARANG, item.PEMILIK, item.APAKAHBONUS, item.FILECITRA])], con);
    dataquery = await util.eksekusiQueryPromise(req, `INSERT IGNORE INTO 01_tms_stok(DISPLAY_AI,BARANG_ID, DISPLAY, GUDANG, RETUR, OUTLET, KODEUNIKMEMBER) VALUES ?`, [batchinsertstok.map(item => ['0',item.BARANG_ID, item.DISPLAY, item.GUDANG, item.RETUR, item.OUTLET, item.KODEUNIKMEMBER])], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: "Informasi data anda berhasil tersimpan di database",
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.pecahsatuan = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tmp_pecahsatuan (AI,IDBARANGASAL,IDBARANGBARU,ASALPECAH,MENJADI,HARGAJUAL,HARGABELI,OUTLET,KODEUNIKMEMBER,KASIR) VALUES (?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1],data[2],data[3], data[4],data[5],data[6], data[7],data[8],data[9] ], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Informasi barang '+data[10]+' sebesar '+data[3]+' berhasil dipecah ke barang '+data[11]+' sebesar '+data[4],
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftarvoucherbarang = async function (req, data, con) {
    pesanbalik = [];
    let hasildata = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_voucherbarang WHERE BARANGID = ? AND NAMAVOUCHER LIKE ? AND KODEUNIKMEMBER = ? LIMIT ' + data[4] + ',' + data[5] + '',
        [data[1], '%' + data[2] + '%', data[3]], con);
    if (hasildata.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: hasildata.length,
            datadaftarvoucherbarang: hasildata
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahbarangvoucher = async function (req, data, con) {
    pesanbalik = [];
    let daftarsatuan = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_voucherbarang(VOUCHER_ID,BARANGID,NAMAVOUCHER,AWALAKTIF,AKHIRAKTIF,TIPEVOUCHER,NOMINALRUPIAH,NOMINALDISKON,BATASTRANSAKSI,MINIMALPEMBELIAN,KODEUNIKMEMBER,OUTLET) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)`, [
        data[0], data[1], data[2], data[3].split("-").reverse().join("-"), data[4].split("-").reverse().join("-"), data[5], data[6], data[7], data[8], data[9], data[10], data[11]
    ], con);
    if (!daftarsatuan) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Sistem gagal dalam menyimpan data ke database. Silahkan hubungi administrator untuk masalah ini'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            msg: "Informasi data voucher anda berhasil tersimpan di database",
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.hapusvoucherbarang = async function (req, data, con) {
    pesanbalik = [];
    let daftarsatuan = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_voucherbarang WHERE NAMAVOUCHER = ? AND KODEUNIKMEMBER = ?`, [
        data[2], data[3]
    ], con);
    if (!daftarsatuan) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Sistem gagal dalam menyimpan data ke database. Silahkan hubungi administrator untuk masalah ini'
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            msg: "Informasi data voucher anda berhasil tersimpan di database",
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.manajemencitraitem = async function (req, data, con) {
    pesanbalik = [];
    let daftarsatuan;
    if (data[0] == "hapus"){
        daftarsatuan = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_barangitemcitra WHERE KODEITEM = ? AND KODEUNIKMEMBER = ? AND FILENAME = ?`, [data[2], data[5], data[3]], con);
    }else if(data[0] == "list"){
        daftarsatuan = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_tms_barangitemcitra WHERE KODEITEM = ? AND KODEUNIKMEMBER = ?`, [data[2], data[5]], con);
    }else if (data[0] == "update"){
        daftarsatuan = await util.eksekusiQueryPromise(req, `UPDATE 01_tms_barangkharisma SET FILECITRA = ? WHERE BARANG_ID = ? AND KODEUNIKMEMBER = ?`, [data[1], data[2], data[5]], con);
    }else{
        daftarsatuan = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_barangitemcitra(AI,KODEITEM,FILENAME,GAMBARUTAMA,KODEUNIKMEMBER) VALUES (?,?,?,?,?)`, [
            "", data[2], data[3], data[4], data[5]
        ], con);
    }
    if (!daftarsatuan) {
        data = {
            success: 'false',
            rc: '500',
            msg: 'Sistem gagal dalam menyimpan data ke database. Silahkan hubungi administrator untuk masalah ini'
        }
    } else {
        if(data[0] == "list"){
            data = {
                success: "true",
                rc: "200",
                totalcitraitem: daftarsatuan.length,
                datadaftarsatuan: daftarsatuan,
            }
        }else{
            data = {
                success: "true",
                rc: "200",
                msg: "Informasi data voucher anda berhasil tersimpan di database",
            }
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.kartustok = async function (req, data, con) {
    pesanbalik = [];
    let dataquery, tanggalawal, tanggalakhir;
    if (data[5] == "1"){
        tanggalawal = data[6].split("-").reverse().join("-")+" 00:00:00";
        tanggalakhir = data[7].split("-").reverse().join("-")+" 23:59:59";
    }
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], tanggalawal, tanggalakhir, data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.diskonpenjualan = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.hapusdiskonpenjualan = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_diskon WHERE BARANG_ID = ? AND KODEUNIKMEMBER = ? AND OUTLET = ?`, [data[0], data[1], data[2]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Diskon belanja atas barang '+data[3]+' telah berhasil dihapus dari aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahdiskonpenjualan = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_diskon(DISKON_ID,BARANG_ID,MINBELITINGKAT1,DISCNONMEMBER1,DISCMEMBER1,MINBELITINGKAT2,DISCNONMEMBER2,DISCMEMBER2,KATEGORI,KODEUNIKMEMBER,OUTLET) VALUES (?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],data[3], data[4], data[5],data[6], data[7], data[8], data[9], data[10]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Diskon belanja atas barang '+data[3]+' telah berhasil ditambahkan ke aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.kuponbelanja = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],data[3], data[4], data[5],data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahkuponbelanja = async function (req, data, con) {
    pesanbalik = [];
    let tanggalawal, tanggalakhir;
    tanggalawal = data[2];
    tanggalakhir =data[3];
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_voucher(VOUCHER_ID,NAMAVOUCHER,AWALAKTIF,AKHIRAKTIF,TIPEVOUCHER,NOMINALRUPIAH,NOMINALDISKON,BATASTRANSAKSI,MINIMALPEMBELIAN,KODEUNIKMEMBER,OUTLET) VALUES (?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], tanggalawal, tanggalakhir, data[4], data[5],data[6], data[7], data[8], data[9], data[10]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: 'Yeyyy... Voucher belanja  '+data[1]+' telah berhasil ditambahkan ke aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.hapuskuponbelanja = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_voucher WHERE NAMAVOUCHER = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?`, [data[0], data[1],data[2] ], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: 'Yeyyy... Voucher belanja '+data[0]+' telah berhasil dihapus dari aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.mastersuplier = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],data[3], data[4], data[5],data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.hapusmastersuplier = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_supplier WHERE KODESUPPLIER = ? AND KODEUNIKMEMBER = ?`, [data[0], data[2]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Informasi SUPLIER : '+data[1]+' ['+data[0]+'] telah berhasil dihapus dari aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahmastersuplier = async function (req, data, con) {
    pesanbalik = [];
    if (data[14] == "false"){
        dataquery = await util.eksekusiQueryPromise(req, 'UPDATE `01_tms_supplier` SET `NAMASUPPLIER` = ?, `NEGARA` = ?, `PROVINSI` = ?, `KOTAKAB` = ?, `KECAMATAN` = ?, `ALAMAT` = ?, `NOTELP` = ?, `NAMABANK` = ?, `NOREK` = ?, `ATASNAMA` = ?, `EMAIL` = ? WHERE `KODESUPPLIER` = ? AND KODEUNIKMEMBER = ?', [data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12],data[1],data[13]], con);
    }else{
        dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_supplier`(`SUPPLIER_AI`, `KODESUPPLIER`, `NAMASUPPLIER`, `NEGARA`, `PROVINSI`, `KOTAKAB`, `KECAMATAN`, `ALAMAT`, `NOTELP`, `NAMABANK`, `NOREK`, `ATASNAMA`, `EMAIL`, `KODEUNIKMEMBER`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [data[0], data[1],data[2], data[3],data[4], data[5],data[6], data[7],data[8], data[9],data[10], data[11],data[12],data[13]], con);
    }
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: data[14] == "false" ? '[200] Yeyyy... Informasi SUPLIER : '+data[2]+' ['+data[1]+'] telah berhasil DIUBAH sesuai informasi terbaru' : '[200] Yeyyy... Informasi SUPLIER : '+data[2]+' ['+data[1]+'] telah berhasil ditambahkan ke aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.mastersales = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],data[3], data[4], data[5],data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.hapussales = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_sales WHERE KODESALES = ? AND KODEUNIKMEMBER = ?`, [data[0], data[2]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Informasi SALES : '+data[1]+' ['+data[0]+'] telah berhasil dihapus dari aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahmastersales = async function (req, data, con) {
    pesanbalik = [];
    if (data[15] == "false"){
        dataquery = await util.eksekusiQueryPromise(req, `UPDATE 01_tms_sales SET NAMA=?, ALAMAT=?, KOTA=?, PROVINSI=?, NEGARA=?, KODEPOS=?, TELEPON=?, FAX=?, EMAIL=?, NOREK=?, PEMILIKREK=?, BANK=?, KETERANGAN=? WHERE KODESALES= ? AND KODEUNIKMEMBER = ?;`, [data[1], data[2],data[3], data[4],data[5], data[6],data[7], data[8],data[9], data[10],data[11], data[12], data[13], data[0],data[14]], con);
    }else{
        dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_sales(KODESALES,NAMA,ALAMAT,KOTA,PROVINSI,NEGARA,KODEPOS,TELEPON,FAX,EMAIL,NOREK,PEMILIKREK,BANK,KETERANGAN,KODEUNIKMEMBER) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);
        `, [data[0], data[1],data[2], data[3],data[4], data[5],data[6], data[7],data[8], data[9],data[10], data[11],data[12],data[13],data[14]], con);
    }
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: data[14] == "false" ? '[200] Yeyyy... Informasi SALES : '+data[1]+' ['+data[0]+'] telah berhasil DIUBAH sesuai informasi terbaru' : '[200] Yeyyy... Informasi SALES : '+data[1]+' ['+data[0]+'] telah berhasil ditambahkan ke aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.mastermember = async function (req, data, con) {
    pesanbalik = [];
    let tanggalawal,tanggalakhir;
    if (data[10] == "true"){
        tanggalawal = data[5];
        tanggalakhir = data[6];
    }
    dataquerykategori = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],'', '', '','', '', '', data[9], '', data[11], data[12]], con);
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],data[3], data[4], tanggalawal,tanggalakhir, data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
            totaldataquerykategori: dataquerykategori[0].length,
            dataquerykategori: dataquerykategori[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.jsonmemberselect = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT MEMBER_ID, NAMA FROM 01_tms_member WHERE (MEMBER_ID LIKE ? OR NAMA LIKE ?) AND KODEUNIKMEMBER = ?',
    ['%' + data[0] + '%','%' + data[0] + '%',data[1]], con);
    if (dataquery.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.mastermemberkasir = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_member WHERE (MEMBER_ID LIKE ? OR NAMA LIKE ?) AND KODEUNIKMEMBER = ? LIMIT '+data[2]+','+data[3]+'',
    ['%' + data[0] + '%','%' + data[0] + '%',data[1]], con);
    if (dataquery.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery.length,
            dataquery: dataquery,
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.mastersalesmankasir = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_sales WHERE (KODESALES LIKE ? OR NAMA LIKE ?) AND KODEUNIKMEMBER = ? LIMIT '+data[2]+','+data[3]+'',
    ['%' + data[0] + '%','%' + data[0] + '%',data[1]], con);
    if (dataquery.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery.length,
            dataquery: dataquery,
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.statusmember = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'UPDATE 01_tms_member SET STATUSAKTIF = ? WHERE MEMBER_ID = ? AND KODEUNIKMEMBER = ?',
    [data[0] == "1" ? "0" : "1", data[1], data[2]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: data[0] == "1" ? '[200] Yeyyy... Informasi MEMBER : '+data[3]+' ['+data[1]+'] telah berhasil DIUBAH sesuai menjadi TIDAK AKTIF' : '[200] Yeyyy... Informasi MEMBER : '+data[3]+' ['+data[1]+'] telah berhasil DIUBAH sesuai menjadi AKTIF KEMBALI',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahmember = async function (req, data, con) {
    pesanbalik = [];
    if (data[39] == "false"){
        dataquery = await util.eksekusiQueryPromise(req, 'UPDATE 01_tms_member SET NAMA = ?, ALAMAT = ?, KOTA = ?, PROVINSI = ?, NEGARA = ?, KODEPOS = ?, JK = ?, EMAIL = ?, TELEPON = ?, FAX = ?, AKHIRAKTIF = ?, STATUSAKTIF = ?, POINT = ?, NOREK = ?, PEMILIKREK = ?, BANK = ?, NPWP = ?, KETERANGAN = ?, LIMITJUMLAHPIUTANG = ?, JENIS = ?, GRUP = ?, MINIMALPOIN = ?, BATASTAMBAHKREDIT = ?, KEJARTARGET = ?, NAMAFILE = ?, USERNAME = ?, PASSWORD = ?, CATATAN = ?, LIMITBARANGONLINE = ?, LOGO = ?, LIMIT_BRG = ?, NISBACKUP = ?, KODEUNIKMEMBER = ?, OUTLET = ?, NOMOR = ?, TOTALDEPOSIT = ?, ISRESELLER = ?, ANGKAKESUKAAN = ?, KECAMATAN = ? WHERE MEMBER_ID = ? AND KODEUNIKMEMBER = ?', [data[1],data[2], data[3],data[4], data[5],data[6], data[7],data[8], data[9],data[10], data[11],data[12],data[13],data[14],data[15], data[16],data[17], data[18],data[19], data[20],data[21], data[22],data[23], data[24],data[25], data[26],data[27],data[28],data[29],data[30],data[31],data[32],data[33],data[34],data[35],data[36],data[37],data[38],data[43],data[0],data[33]], con);
    }else{
        dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_member`(`MEMBER_ID`, `NAMA`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`, `JK`, `EMAIL`, `TELEPON`, `FAX`, `AKHIRAKTIF`, `STATUSAKTIF`, `POINT`, `NOREK`, `PEMILIKREK`, `BANK`, `NPWP`, `KETERANGAN`, `LIMITJUMLAHPIUTANG`, `JENIS`, `GRUP`, `MINIMALPOIN`, `BATASTAMBAHKREDIT`, `KEJARTARGET`, `NAMAFILE`, `USERNAME`, `PASSWORD`, `CATATAN`, `LIMITBARANGONLINE`, `LOGO`, `LIMIT_BRG`, `NISBACKUP`, `KODEUNIKMEMBER`, `OUTLET`, `NOMOR`, `TOTALDEPOSIT`, `ISRESELLER`, `ANGKAKESUKAAN`,`KECAMATAN`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [data[0], data[1],data[2], data[3],data[4], data[5],data[6], data[7],data[8], data[9],data[10], data[11],data[12],data[13],data[14],data[15], data[16],data[17], data[18],data[19], data[20],data[21], data[22],data[23], data[24],data[25], data[26],data[27],data[28],data[29],data[30],data[31],data[32],data[33],data[34],data[35],data[36],data[37],data[38],data[43]], con);
    }
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg:'Yeyyy... Informasi MEMBER : '+data[1]+' ['+data[0]+'] telah berhasil disimpan ke database kami',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.detailmember = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.datasatuan = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.hapussatuan = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_barangsatuan WHERE NAMASATUAN = ? AND KODEUNIKMEMBER = ?`, [data[0], data[1]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Informasi SATUAN : '+data[1]+' ['+data[0]+'] telah berhasil dihapus dari aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahsatuan = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_barangsatuan(NAMASATUAN,KETERANGAN, KODEUNIKMEMBER) VALUES (?,?,?)`, [data[0], data[1],data[2]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Informasi SATUAN : '+data[1]+' ['+data[0]+'] telah berhasil ditambah ke aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.datakategori = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.hapuskategori = async function (req, data, con) {
    pesanbalik = [];
    pesan = "";
    if (data[6] == 1){
        pesan = 'Informasi beban manufaktur '+data[7]+' berhasil diubah'
        dataquery = await util.eksekusiQueryPromise(req, `UPDATE 01_tms_kategori SET BEBANGAJI = ?, BEBANPACKING = ?, BEBANPROMO = ?, BEBANTRANSPORT = ? WHERE KATEGORIPARENT_ID = ? AND KODEUNIKMEMBER = ?`, [data[2],data[3],data[4],data[5],data[0], data[1]], con);
    }else{
        pesan = '[200] Yeyyy... Informasi KATEGORI : '+data[1]+' ['+data[0]+'] telah berhasil dihapus dari aplikasi'
        dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_kategori WHERE KATEGORIPARENT_ID = ? AND KODEUNIKMEMBER = ?`, [data[0], data[1]], con);
    }
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: pesan,
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahkategori = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_kategori(KATEGORIPARENT_ID, NAMAKATEGORI, LOGOKATEGORI, KODEUNIKMEMBER, BEBANGAJI, BEBANPACKING, BEBANPROMO, BEBANTRANSPORT) VALUES (?, ?, ?, ?, ?, ?, ?, ?)`, [data[0], data[1],data[2],data[3],0,0,0,0], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Informasi KATEGORI : '+data[1]+' ['+data[0]+'] telah berhasil ditambah ke aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.datakategorianggota = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `CALL proc_Controller_Admin(?,?,?,?,?,?,?,?,?,?,?,?,?)`, [data[0], data[1], data[2],data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12]], con);
    if (dataquery[0].length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery[0].length,
            dataquery: dataquery[0],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.hapuskategorianggota = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_member_grup WHERE KODEGRUP = ? AND KODEUNIKMEMBER = ?`, [data[0], data[1]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Informasi KATEGORI MEMBER : '+data[1]+' ['+data[0]+'] telah berhasil dihapus dari aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.tambahkategorianggota = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_member_grup(KODEGRUP, JENIS, GRUP, KODEUNIKMEMBER) VALUES (?, ?, ?, ?)`, [data[0], data[1],data[2],data[3]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: '[200] Yeyyy... Informasi KATEGORI MEMBER : '+data[2]+' ['+data[0]+'] telah berhasil ditambah ke aplikasi',
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.daftarpembayarannontunai = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_pembayaranbank WHERE KODEUNIKMEMBER = ? AND JENISNONTUNAI = ?',
    [data[0],data[1]], con);
    if (dataquery.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldatadataquery: dataquery.length,
            dataquery: dataquery,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.jasondaftarbrand = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_brand WHERE NAMA_BRAND LIKE ? AND KODEUNIKMEMBER = ?',
    ['%' + data[0] + '%',data[1]], con);
    if (dataquery.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.jsonhapusbrand = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_tms_brand WHERE BRAND_ID = ? AND KODEUNIKMEMBER = ?',
    [data[0],data[1]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    } else {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.jsontambahbrand = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_brand`(`AI`, `BRAND_ID`, `NAMA_BRAND`, `KODEUNIKMEMBER`) VALUES (?,?,?,?)',
    ['0',data[0],data[1],data[2]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    } else {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.jasondaftarprincipal = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_principal WHERE NAMA_PRINCIPAL LIKE ? AND KODEUNIKMEMBER = ?',
    ['%' + data[0] + '%',data[1]], con);
    if (dataquery.length == 0) {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.jsontambahprincipal = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_principal`(`AI`, `PRINCIPAL_ID`, `NAMA_PRINCIPAL`, `KODEUNIKMEMBER`) VALUES (?, ?, ?, ?)',
    ['0',data[0],data[1],data[2]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    } else {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.jsonhapusprincipal = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_tms_principal WHERE PRINCIPAL_ID = ? AND KODEUNIKMEMBER = ?',
    [data[0],data[1]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    } else {
        data = {
            success: 'false',
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.prosesoutlet = async function (req, data, con) {
    pesanbalik = [];
    await util.eksekusiQueryPromise(req,"SET autocommit = 0", [], con);
    await util.eksekusiQueryPromise(req,"START TRANSACTION", [], con);
    await util.eksekusiQueryPromise(req,"INSERT INTO `01_tms_member`(`AI`, `MEMBER_ID`, `NAMA`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`, `JK`, `EMAIL`, `TELEPON`, `FAX`, `AKHIRAKTIF`, `STATUSAKTIF`, `POINT`, `NOREK`, `PEMILIKREK`, `BANK`, `NPWP`, `KETERANGAN`, `LIMITJUMLAHPIUTANG`, `JENIS`, `GRUP`, `MINIMALPOIN`, `BATASTAMBAHKREDIT`, `KEJARTARGET`, `NAMAFILE`, `USERNAME`, `PASSWORD`, `CATATAN`, `LIMITBARANGONLINE`, `LOGO`, `LIMIT_BRG`, `NISBACKUP`, `KODEUNIKMEMBER`, `OUTLET`, `NOMOR`, `TOTALDEPOSIT`, `ISRESELLER`, `ANGKAKESUKAAN`, `KECAMATAN`) VALUES (0, '1001', 'Member::Umum', '-', 'Malang', 'Jawa Timur', 'INDONESIA', '0', 'P', '-', '-', '', '9999-12-31', 0, 0, '', '', '', '', 'Informasi tidak tersedia untuk saat ini atau agan ini masih malu malu untuk menceritakan dirinya', 0.00, 'Newbie Member', 'UMUM', 100000.00, 7, 0.00, '', '1001', '', '', 0, '', 0, '', '"+data[0]+"', '"+data[1]+"', 0, 0.00, 0, 5, '-')", [], con);
    await util.eksekusiQueryPromise(req," INSERT INTO `01_tms_stok`(`DISPLAY_AI`, `BARANG_ID`, `DISPLAY`, `GUDANG`, `RETUR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (0, 'ACI100000100000001', 0.00, 0.00, 0.00, '"+data[1]+"', '"+data[0]+"')", [], con);
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_set_outlet`(`AI`, `KODEUNIKMEMBER`, `KODEOUTLET`, `NAMAOUTLET`, `ALAMAT`, `LAT`, `LONG`, `NOTELP`, `APAKAHPUSAT`, `PAJAKNEGARA`, `PAJAKTOKO`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `KODEUNIKMEMBER` = VALUES (`KODEUNIKMEMBER`), `NAMAOUTLET` = VALUES(`NAMAOUTLET`), `ALAMAT` = VALUES(`ALAMAT`), `LAT` = VALUES(`LAT`), `LONG` = VALUES(`LONG`), `NOTELP` = VALUES(`NOTELP`), `APAKAHPUSAT` = VALUES(`APAKAHPUSAT`), `PAJAKNEGARA` = VALUES(`PAJAKNEGARA`),`PAJAKTOKO` = VALUES(`PAJAKTOKO`)',[null,data[0],data[1],data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9]], con);
    await util.eksekusiQueryPromise(req,"COMMIT", [], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: "Informasi outlet pada TENANT ID "+data[0]+" dengan nama "+data[2]+" ["+data[1]+"] berhasil ditambahkan. Silahkan tambahkan berberapa produk agar anda mendapatkan CUAN",
            dataquery: dataquery,
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
            dataquery: null,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.kategoridompetdata = async function (req, data, con) {
    pesanbalik = [];
    let querywhere = " AND KATEGORIPARENT_ID = ?"
    if (req.body.KONDISI == "ROOT_DIGITAL"){
        querywhere = " AND KATEGORIROOT = ?"
    }
    let hasildata = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_kategori WHERE KODEUNIKMEMBER = ? '+querywhere+' ORDER BY URUTAN ASC, NAMAKATEGORI ASC',[req.body.KODEUNIKMEMBER, req.body.KATAKUNCI], con);
    if (hasildata.length == 0) {
        data = {
            success: false,
            rc: '404',
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
        }
    } else {
        data = {
            success: true,
            rc: "200",
            totaldata: hasildata.length,
            data: hasildata
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
masterdata.jasondaftarbankpencatatanlokal = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_pembayaranbank WHERE (BANK_ID LIKE ? OR NAMABANK LIKE ?) AND KODEUNIKMEMBER = ?',
    ['%' + data[0] + '%','%' + data[0] + '%',data[1]], con);
    if (dataquery.length == 0) {
        data = {
            success: false,
            rc: 404,
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: true,
            rc: 200,
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.jsonhapusmetodepembayaran = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_tms_pembayaranbank WHERE BANK_ID = ? AND KODEUNIKMEMBER = ?',
    [data[0],data[1]], con);
    if (dataquery.length == 0) {
        data = {
            success: false,
            rc: 404,
            msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi',
        }
    } else {
        data = {
            success: true,
            rc: 200,
            totaldata: dataquery.length,
            dataquery: dataquery,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
masterdata.nodesimpaninformasimetodepembayaran = async function (req, data, con) {
    pesanbalik = [];
    if (data[6] == 0){
        dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_tms_pembayaranbank`(`AI`,`BANK_ID`, `NAMABANK`, `PAJAKDEBIT`, `PAJAKKREDIT`, `KODEUNIKMEMBER`, `URLLOGO`, `JENISNONTUNAI`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',[0,data[0],data[1],data[2],data[3],data[7],data[4],data[5]], con);
    }else{
        dataquery = await util.eksekusiQueryPromise(req, 'UPDATE 01_tms_pembayaranbank SET `NAMABANK` = ?, `PAJAKDEBIT` = ?, `PAJAKKREDIT` = ?, `URLLOGO` = ?, `JENISNONTUNAI` = ? WHERE `BANK_ID` = ? AND KODEUNIKMEMBER = ?',[data[1],data[2],data[3],data[4],data[5],data[0],data[7]], con);
    }
    if (dataquery.length == 0 || dataquery.affectedRows == 0) {
        data = {
            success: false,
            rc: 404,
            msg: 'Tidak ada proses yang terjadi baik tambah atau perubahan data. Silahkan hubungi administrator',
        }
    } else {
        data = {
            success: true,
            rc: 200,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;   
}
module.exports = masterdata;