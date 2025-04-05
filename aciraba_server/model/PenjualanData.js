require('dotenv').config()
const util = require('../config/utils');
const con = require("../config/db.js")
const moment = require('moment');
const bcrypt = require('bcrypt');
const { join } = require('lodash');
const penjualan = {}
let pesanbalik = {}
let batchinsert = {};

penjualan.cekpintrx = async function (req, data, con) {
    let tabel,kolom,kolompin;
    if (data[0] == "01_tms_penggunaaplikasi"){tabel = "01_tms_penggunaaplikasi";kolom = "NAMAPENGGUNA";kolompin="PIN";}else if (data[0] == "01_tms_member"){tabel == "01_tms_member";kolom = "USERNAME";kolompin="PINTRX";}
    let dataquery = await util.eksekusiQueryPromise(req, 'SELECT COUNT(*) as ADADATA,'+kolompin+' as PINNYA FROM '+tabel+' WHERE '+kolom+' = ?', [data[1]], con);
    if (dataquery[0].ADADATA == 0) {
        return false;
    }
    passplain = await bcrypt.compare(data[1], dataquery[0].PINNYA);
    if (passplain == true) {
        return true;    
    }else{
        return false;
    }
}
/*penjualan acipay */
penjualan.transaksimasuk = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO 01_acipay_transaksi (AI, APISERVER_ID, TRANSKASI_ID, ANTRIAN_ID, TAGIHAN, PRODUK_ID_SERVER, NAMA_PRODUK, HARGA_BELI, HARGA_KEAGEN, HARGA_JUALKEPELANGGAN, KOMISI, TUJUAN, NOMORPELANGGAN, KETERANGAN, PENGIRIM, STATUSTRX, AGEN, VIA, PEMBAYARAN, JENIS_TRANSAKSI, PERULANGAN, SALDO_SEBELUM, SALDO_SESUDAH, NOMORNOTA, LOKASI, KODEUNIKMEMBER, SN, TANGGALTRX, TANGGALUPDATE, RESPONSEJSON) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', ["",data[1],data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12],data[13],data[14],data[15],data[16],data[17],data[18],data[19],data[20],data[21],data[22],data[23],data[24],data[25],data[26],data[27],data[30],data[28]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: 'Transaksi sudah dalam antraian, sekarang sedang diproses oleh PROVIDER tujuan. Silahkan cek pada menu TRX PENJUALAN untuk mendapatkan update mengenai STATUS TRX anda',
        }
    } else {
        data = {
            success: 'false',
            rc: (typeof dataquery.code === "undefined" ? "ERR0000" : dataquery.code),
            msg: (typeof dataquery.sqlMessage === "undefined" ? "Terjadi kesalahan dalam menambahkan data. Silahkan berikan FEEDBACK kepada ADMIN agar segera diberi tindakan" : dataquery.sqlMessage),
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.hapustransaksi = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_acipay_transaksi WHERE TRANSKASI_ID = ? AND LOKASI = ? AND KODEUNIKMEMBER = ?', [data[0],data[1],data[2]], con);
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: 'Transaksi penjualan dengan nama PRODUK '+data[3]+' berhasil di HAPUS dari daftar',
        }
    } else {
        data = {
            success: 'false',
            rc: (typeof dataquery.code === "undefined" ? "ERR0000" : dataquery.code),
            msg: (typeof dataquery.sqlMessage === "undefined" ? "Terjadi kesalahan dalam mengoperasikan QUERY data. Silahkan berikan FEEDBACK kepada ADMIN agar segera diberi tindakan" : dataquery.sqlMessage),
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.dafartranskasi = async function (req, data, con) {
    pesanbalik = [];
    let cekdataseluruhageb = "AND AGEN = ?", tabelhis = "01_acipay_transaksi_his"
    if (data[12] == "1"){
        tabelhis = "01_acipay_transaksi"
    }
    if (data[9] == "OW"){
        cekdataseluruhageb = "AND 1 != ?"
    }
    let field = "*", join = "", wherenya = "",kolomparameter = "", valuearray = [];
    if (data[0] == "TABEL"){
        field="*, DATE_FORMAT(`TANGGALTRX`,'%d-%m-%Y %h:%m:%i') as TANGGALTRXF, DATE_FORMAT(`TANGGALUPDATE`,'%d-%m-%Y %h:%m:%i') as TANGGALUPDATEF"
        join=""
        if (data[5] == "notrx"){
            kolomparameter = "TRANSKASI_ID"
        }else if (data[5] == "kodeproduk"){
            kolomparameter = "PRODUK_ID_SERVER"
        }else if (data[5] == "member"){
            kolomparameter = "AGEN"
        }else if (data[5] == "notujuan"){
            kolomparameter = "TUJUAN"
        }
        wherenya = "(DATE(TANGGALTRX) BETWEEN ? AND ? ) AND KODEUNIKMEMBER = ? "+cekdataseluruhageb+" AND LOKASI = ? AND "+kolomparameter+" LIKE ? AND STATUSTRX LIKE ? ORDER BY TANGGALTRX DESC LIMIT "+data[7]+","+data[8]+"";
        valuearray = [data[10], data[11], data[1],data[2],data[3],'%'+data[4]+'%','%'+data[6]+'%']
    }
    let dataquery = await util.eksekusiQueryPromise(req, 'SELECT '+field+' FROM '+tabelhis+' as A '+join+' WHERE '+wherenya, valuearray, con);
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            data:dataquery,
            totaldata: dataquery.length,
            msg: 'Informasi Data Transaksi ACIPAY',
        }
    } else {
        data = {
            success: 'false',
            rc: (typeof dataquery.code === "undefined" ? "ERR0000" : dataquery.code),
            data:[],
            totaldata: 0,
            msg: (typeof dataquery.sqlMessage === "undefined" ? "Terjadi kesalahan dalam membaca data dari database ERRDAFTARTRXACIPAY" : dataquery.sqlMessage),
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}


/* ambil format nota penjualan, nota pembelan dan lain sebagainya */
penjualan.notamenupenjualan = async function (req, data, con) {
    pesanbalik = [];
    let nomornota;
    if (data[0] == "RT"){
        nomornota = "NOMORNOTA";
        tabel = "01_trs_returpenjualan";
        notayangdicari = "NOTRXRETUR";
        kolomoutlet = "AND OUTLET = ?";
        kodeunikmember = 'AND KODEUNIKMEMBER = "'+data[4]+'"';
    }else if (data[0] == "PJ"){
        nomornota = "NOMORNOTA";
        tabel = "01_trs_barangkeluar";
        notayangdicari = "PK_NOTAPENJUALAN";
        kolomoutlet = "AND LOKASI = ?";
        kodeunikmember = 'AND KODEUNIKMEMBER = "'+data[4]+'"';
    }else if (data[0] == "AC"){
        nomornota = "NOMORNOTA";
        tabel = "01_acipay_transaksi";
        notayangdicari = "TRANSKASI_ID";
        kolomoutlet = "AND LOKASI = ?";
        kodeunikmember = 'AND KODEUNIKMEMBER = "'+data[4]+'"';
    }else if (data[0] == "MBM"){
        nomornota = "NOMOR";
        tabel = "01_tms_penggunaaplikasi";
        notayangdicari = "PENGGUNA_ID";
        kolomoutlet = "";
        kodeunikmember = 'AND KODEUNIKMEMBER = "'+data[4]+'"';
    }else if (data[0] == "BP"){
        nomornota = "NOMOR";
        tabel = "01_tms_piutangkredit_detail";
        notayangdicari = "NOTRANSAKSI";
        kolomoutlet = "AND LOKASI = ?";
        kodeunikmember = '';
    }else if (data[0] == "BH"){
        nomornota = "NOMOR";
        tabel = "01_tms_hutangtoko_detail";
        notayangdicari = "NOTRANSAKSI";
        kolomoutlet = "AND LOKASI = ?";
        kodeunikmember = '';
    }else if (data[0] == "PB"){
        nomornota = "NOMOR";
        tabel = "01_trs_barangmasuk";
        notayangdicari = "NOTA";
        kolomoutlet = "AND OUTLET = ?";
        kodeunikmember = '';
    }else if (data[0] == "OP"){
        nomornota = "NOMOR";
        tabel = "01_trs_opname";
        notayangdicari = "NOTAOPNAME";
        kolomoutlet = "AND OUTLET = ?";
        kodeunikmember = '';
    }else if (data[0] == "MT"){
        nomornota = "NOMOR";
        tabel = "01_trs_mutasibarang";
        notayangdicari = "NOMORMUTASI";
        kolomoutlet = "AND OUTLET = ?";
        kodeunikmember = '';
    }else if (data[0] == "RB"){
        nomornota = "NOMOR";
        tabel = "01_trs_returpembelian";
        notayangdicari = "NOTRXRETURBELI";
        kolomoutlet = "AND OUTLET = ?";
        kodeunikmember = '';
    }else if (data[0] == "MJ"){
        nomornota = "NOMOR";
        tabel = "01_tms_resto_pesanmeja";
        notayangdicari = "KODEPESAN";
        kolomoutlet = "AND OUTLET = ?";
        kodeunikmember = '';
    }
    let dataquery = await util.eksekusiQueryPromise(req, 'SELECT ('+nomornota+'+1) as NONOTA FROM '+tabel+' WHERE '+notayangdicari+' LIKE ? '+kodeunikmember+' '+kolomoutlet+' ORDER BY '+nomornota+' DESC LIMIT 1', ['%'+data[0]+data[1]+data[2]+data[3]+'#%', data[1]], con);
    if (dataquery.length > 0) {
        data = {
            success: 'true',
            rc: "200",
            msg: 'Format nota berhasil dibuat dengan format KODEAWALAN/OUTLET/KODEKOMPUTER/TANGGALSEKARANG#URUTANKE',
            nomornota: data[0]+data[1]+data[2]+data[3]+'#'+dataquery[0].NONOTA,
        }
    } else {
        data = {
            success: 'false',
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
            nomornota: data[0]+data[1]+data[2]+data[3]+'#1'
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.validasistok = async function (req, data, con) {
    pesanbalik = [];
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT COUNT(*) as ADADATA, DISPLAY FROM 01_tms_stok as A JOIN 01_tms_barangkharisma as B ON A.BARANG_ID = B.BARANG_ID WHERE A.BARANG_ID = ? AND A.OUTLET = ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND STOKDAPATMINUS = ?', [data[0],data[2],data[3],data[3],"TIDAK DAPAT MINUS"], con);
    if (dataquery[0].ADADATA > 0 && dataquery[0].DISPLAY < data[1]){
        data = {
            success: false,
            rc: "500",
            data: [],
            msg: "Stok tidak mencukupi. Item ini tidak dapat ditransaksi ketika stok tidak mencukupi. Silahkan lakukan MUTASI, PENYESUAIAN STOK atau HUBUNGI ADMIN BARANG ?"
        }
    }else{
        data = {
            success: true,
            rc: 200,
            data:[],
            msg: "Stok mencukupi, silahkan lanjutkan transaksi penjualan terhadap pelanggan terkait",
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.tambahreturpenjualan = async function (req, data, con) {
    pesanbalik = [], batchinsertretur = [],batchinsertpotong = [];
    let dataquery, pesan = "";  
    if (data[13] == "1"){
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_returpenjualan_detail WHERE NOTRXRETUR = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[4],data[11],data[12]], con)
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_returpenjualan WHERE NOTRXRETUR = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[4],data[11],data[12]], con)
    }
    dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_returpenjualan`(`AI`, `NOTRXRETUR`, `PETUGAS`, `IDPELANGGAN`, `TANGGALRETUR`, `NOMORNOTA`, `TOTALBARANG`, `TOTALRETUR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', ['0',data[4],data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12]], con)
    if (dataquery.affectedRows > 0) {
        if (data[2] == "true"){
            for (let i = 0; i < data[1].length; i++) {
                var obj = {
                    AI: data[1][i][0],
                    NOTRANSAKSI: data[1][i][1],
                    TRANSAKSI_ID: data[1][i][2],
                    TANGGALBAYAR: data[1][i][3],
                    WAKTU: data[1][i][4],
                    KASIR_ID: data[1][i][5],
                    BAYAR: data[1][i][6],
                    POTONGAN: data[1][i][7],
                    KETERANGAN: data[1][i][8],
                    KODEUNIKMEMBER: data[1][i][9],
                    NOTARETUR: data[1][i][10],
                    NOMOR: data[1][i][11],
                    LOKASI: data[1][i][12],
                };
                batchinsertpotong.push(obj);
            }
            dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_piutangkredit_detail(AI, NOTRANSAKSI, TRANSAKSI_ID, TANGGALBAYAR, WAKTU, KASIR_ID, BAYAR, POTONGAN, KETERANGAN, KODEUNIKMEMBER,NOTARETUR, NOMOR, LOKASI) VALUES ?`, [batchinsertpotong.map(item => [item.AI, item.NOTRANSAKSI, item.TRANSAKSI_ID, item.TANGGALBAYAR, item.WAKTU, item.KASIR_ID, item.BAYAR, item.POTONGAN, item.KETERANGAN, item.KODEUNIKMEMBER,item.NOTARETUR, item.NOMOR, item.LOKASI])], con);
        }
        for (let i = 0; i < data[0].length; i++) {
            var obj = {
                AI: data[0][i][0],
                NOTRXRETUR: data[0][i][1],
                NOTRXPENJUALAN: data[0][i][2],
                KODEBARANG: data[0][i][3],
                NAMABARANG: data[0][i][4],
                JUMLAHBELI: data[0][i][5],
                JUMLAHRETUR: data[0][i][6],
                HARGABELI: data[0][i][7],
                HARGAJUAL: data[0][i][8],
                PPN: data[0][i][9],
                TUJUANOUTLET: data[0][i][10],
                TUJUANLOKASISSTOK: data[0][i][11],
                KETERANGAN: data[0][i][12],
                JENISTRX: data[0][i][13],
                OUTLET: data[0][i][14],
                KODEUNIKMEMBER: data[0][i][15],
            };
            batchinsertretur.push(obj);
        }
        dataquery = await util.eksekusiQueryPromise(req, 'INSERT INTO `01_trs_returpenjualan_detail`(`AI`, `NOTRXRETUR`, `NOTRXPENJUALAN`, `KODEBARANG`, `NAMABARANG`, `JUMLAHBELI`, `JUMLAHRETUR`, `HARGABELI`, `HARGAJUAL`, `PPN`, `TUJUANOUTLET`, `TUJUANLOKASISSTOK`, `KETERANGAN`, `JENISTRX`, `OUTLET`, `KODEUNIKMEMBER`) VALUES ?', [batchinsertretur.map(item => [item.AI, item.NOTRXRETUR, item.NOTRXPENJUALAN, item.KODEBARANG, item.NAMABARANG, item.JUMLAHBELI, item.JUMLAHRETUR, item.HARGABELI, item.HARGAJUAL, item.PPN, item.TUJUANOUTLET, item.TUJUANLOKASISSTOK, item.KETERANGAN, item.JENISTRX, item.OUTLET, item.KODEUNIKMEMBER])], con);
        data = {
            success: "true",
            rc: "200",
            msg: 'Informasi retur penjualan '+pesan+' berhasil ditranskasi. Silahkan cek laporan jika ingin melakukan analisa secara detail',
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
penjualan.detailreturpenjualan = async function (req, data, con) {
    pesanbalik = [];
    let queryretur = await util.eksekusiQueryPromise(req, "SELECT `NOTRANSAKSI`,`PETUGAS`,A.`OUTLET`, C.`NAMAOUTLET`, `NAMAPELANGGAN`,DATE_FORMAT(`TANGGALRETUR`,'%d-%m-%Y') as `TANGGALRETUR`,`KODEBARANGRETUR`,D.`NAMABARANG`,`NOFAKTUR`,`JUMLAHBARANGASAL`,`JUMLAHBARANGRETUR`,`HARGABARANG`,D.`HARGABELI` as HBBARANG,A.`KETERANGAN`,`KESTOK`,`NOMORNOTA`,A.`KODEUNIKMEMBER`,A.`JENIS`,`DISKON`,`TUNAI`,`NOTRXPENJUALAN`, B.`ALAMAT`,`NAMA` FROM 01_trs_returpenjualan as A JOIN 01_tms_member as B ON A.`NAMAPELANGGAN` = B.`MEMBER_ID` JOIN 01_set_outlet as C ON A.`OUTLET` = C.`KODEOUTLET` JOIN 01_tms_barangkharisma as D ON A.`KODEBARANGRETUR` = D.`BARANG_ID` WHERE `NOTRANSAKSI` = ? AND A.`OUTLET` = ? AND A.`KODEUNIKMEMBER` = ? ", [data[0], data[1], data[2]], con);
    let querypotongpiutang = await util.eksekusiQueryPromise(req, "SELECT *,DATE_FORMAT(`JATUHTEMPO`,'%d-%m-%Y') as `JATUHTEMPO`,`TOTALKREDIT` - SUM(`POTONGAN`) - SUM(`BAYAR`) as SISAHUTANG FROM 01_tms_piutangkredit WHERE `NOTRANSAKSI` = ? AND `LOKASI` = ? AND `KODEUNIKMEMBER` = ? GROUP BY `AI`", [data[0], data[1], data[2]], con);
    if (queryretur.length > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: "DATA DITEMUKAN",
            totalqueryretur: queryretur.length,
            totalquerypotongpiutang: querypotongpiutang.length,
            queryretur: queryretur,
            querypotongpiutang: querypotongpiutang,
        }
    } else {
        data = {
            success: "false",
            rc: (typeof dataquery.code === "undefined" ? "ERR0000" : dataquery.code),
            msg: (typeof dataquery.sqlMessage === "undefined" ? "Informasi pembaruan data tidak ada yang berubah atau GAGAL. Silahkan tunggu berbera saat lagi" : dataquery.sqlMessage),
            totalqueryretur: 0,
            totalquerypotongpiutang: 0,
            queryretur: [],
            querypotongpiutang: [],
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.hapusreturpenjualan = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = []
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_returpenjualan_detail WHERE NOTRXRETUR = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[0],data[1],data[2]], con)
    if (dataquery.affectedRows > 0) {
        dataquery = await util.eksekusiQueryPromise(req, 'DELETE FROM 01_trs_returpenjualan WHERE NOTRXRETUR = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[0],data[1],data[2]], con)
        if (dataquery.affectedRows > 0) {
            data = {
                success: "true",
                rc: "200",
                msg: "Hapus transaksi retur penjualan dengan NOTA "+data[0]+" berhasil. Stok akan dikurangi kenbali dan dicatat pada KARTU STOK",
            }
        } else {
            data = {
                success: 'false',
                rc: dataquery.code,
                msg: dataquery.sqlMessage,
            }
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
penjualan.hapuspenjualan = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = ? AND KODEUNIKMEMBER = ?`, [data[0], data[1]], con);
    if (dataquery.affectedRows > 0) {
        dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_trs_barangkeluar WHERE PK_NOTAPENJUALAN = ? AND KODEUNIKMEMBER = ? AND LOKASI = ?`, [data[0], data[1], data[2]], con);
        if (dataquery.affectedRows > 0) {
            dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_piutangkredit WHERE TRANSAKSI_ID = ? AND KODEUNIKMEMBER = ?`, [data[0], data[1]], con);
            dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_piutangkredit_detail WHERE TRANSAKSI_ID = ? AND KODEUNIKMEMBER = ?`, [data[0], data[1]], con);
            data = {
                success: "true",
                rc: "200",
                msg: 'Informasi penjualan berhasil dihapus. Stok dikurangi tiap item serta informasi PIUTANG KREDIT hingga AKUN JURNAL berhasil dihapus',
            }
            global.io.sockets.emit("NOTIFDASHBOARD"+req.body.LOKASI+req.body.KODEUNIKMEMBER, {});
        }else{
            data = {
                success: "false",
                rc: dataquery.code,
                msg: dataquery.sqlMessage,
            }
        }
    } else {
        data = {
            success: "false",
            rc: dataquery.code,
            msg: dataquery.sqlMessage,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.tambahkeranjangbestbuy = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = await util.eksekusiQueryPromise(req, `SELECT * FROM 01_tms_bestbuybaranggrosir WHERE JIKABELI <= ? AND BARANG_ID = ? AND OUTLET = ? AND KODEUNIKMEMBER = ? ORDER BY AI_GROSIR DESC LIMIT 1`, [data[1], data[0], data[2], data[3]], con);
    if (dataquery.length == 0) {
        dataquery = await util.eksekusiQueryPromise(req, `SELECT HARGAJUAL FROM 01_tms_barangkharisma as A JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID  WHERE A.BARANG_ID = ? AND OUTLET = ? AND A.KODEUNIKMEMBER = ? LIMIT 1`, [data[0], data[2], data[3]], con);
        if (dataquery.length == 0) {
            data = {
                success: 'false',
                rc: '404',
                msg: 'Informasi kata kunci tidak ada yang terkait atau tidak ditemukan. Silahkan cek lagi'
            }
        }else{
            data = {
                success: "truedasar",
                rc: "200",
                dataquery: dataquery
            }
        }
    } else {
        data = {
            success: "true",
            rc: "200",
            dataquery: dataquery
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.simpantransaksi = async function (req, data, con) {
    pesanbalik = []
    batchinsert = []
    let pesan = "", dataquery = "", informasibarangdetail = JSON.parse(data[0]), statustersajikan = "";
    for (let i = 0; i < data[1]; i++) {
        statustersajikan = informasibarangdetail[i][14];
        var obj = {
            AI_TRANSAKSIKELUAR: 0,
            PK_NOTAPENJUALAN: data[2],
            FK_BARANG: informasibarangdetail[i][4].split(',')[0],
            NAMABARANG: informasibarangdetail[i][0].split(',')[0],
            HARGAJUAL: informasibarangdetail[i][1].split(',')[0],
            HARGABELI: informasibarangdetail[i][5].split(',')[0],
            STOKBARANGKELUAR: informasibarangdetail[i][6].split(',')[0],
            DARIPERUSAHAAN: informasibarangdetail[i][3].split(',')[0],
            PPN:0,
            KODEUNIKMEMBER:data[13],
            BRAND_ID: informasibarangdetail[i][7].split(',')[0],
            PRINCIPAL_ID: informasibarangdetail[i][8].split(',')[0],
            STOKDAPATMINUS: informasibarangdetail[i][9].split(',')[0],
            JSONTAMBAHAN: informasibarangdetail[i][10].split(',')[0],
            CATATANPERBARANG: informasibarangdetail[i][11].split(',')[0],
            APAKAHVARIAN: informasibarangdetail[i][12].split(',')[0],
            HARGAJUALSEMENTARA: informasibarangdetail[i][13],
            STATUSBARANGPROSES: informasibarangdetail[i][14],
            TANGGALPROSES:data[41],
            WAKTUPROSES:data[42],
        };
        batchinsert.push(obj);
    }
    let queryok = false
    if (data[28] == 'true'){
        try {
            await util.eksekusiQueryPromise(req, 'BEGIN', [], con);
            await util.eksekusiQueryPromise(req, `DELETE FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = ? AND KODEUNIKMEMBER = ?`, [data[2], data[13]], con);
            await util.eksekusiQueryPromise(req, `INSERT INTO 01_trs_barangkeluar_detail (AI_TRANSAKSIKELUAR, PK_NOTAPENJUALAN, FK_BARANG, NAMABARANG, HARGAJUAL, HARGABELI, STOKBARANGKELUAR, DARIPERUSAHAAN, PPN, KODEUNIKMEMBER, BRAND_ID, PRINCIPAL_ID, STOKDAPATMINUS, JSONTAMBAHAN, CATATANPERBARANG, APAKAHVARIAN, HARGAJUALSEMENTARA, STATUSBARANGPROSES, TANGGALPROSES, WAKTUPROSES) VALUES ?`,[batchinsert.map(item => [item.AI_TRANSAKSIKELUAR, item.PK_NOTAPENJUALAN,item.FK_BARANG, item.NAMABARANG,item.HARGAJUAL, item.HARGABELI,item.STOKBARANGKELUAR, item.DARIPERUSAHAAN, item.PPN, item.KODEUNIKMEMBER, item.BRAND_ID, item.PRINCIPAL_ID, item.STOKDAPATMINUS, item.JSONTAMBAHAN, item.CATATANPERBARANG, item.APAKAHVARIAN, item.HARGAJUALSEMENTARA, item.STATUSBARANGPROSES, item.TANGGALPROSES, item.WAKTUPROSES])], con);
            await util.eksekusiQueryPromise(req, `UPDATE 01_trs_barangkeluar SET FK_MEMBER = ?, FK_SALESMAN = ?, ENUM_JENISTRANSAKSI = ?, JATUHTEMPO = ?, TGLKELUAR = ?,  KETERANGAN = ?, NOMINALTUNAI = ?, NOMINALKREDIT = ?, NOMINALKARTUDEBIT = ?, NOMORKARTUDEBIT = ?, BANKDEBIT = ?, NOMINALKARTUKREDIT = ?, NOMORKARTUKREDIT = ?, BANKKREDIT = ?, NOMINALEMONEY = ?, NAMAEMONEY = ?, NOMINALPOTONGAN = ?, NOMINALPAJAKKELUAR = ?, KEMBALIAN = ?, TOTALBELANJA = ?, PAJAKTOKO = ?, PAJAKNEGARA = ?, POTONGANGLOBAL = ?, TIPETRANSAKSI = ? WHERE PK_NOTAPENJUALAN = ?`, [data[3],data[4],data[5],data[6],data[8],/*data[9]*/data[12],data[14],data[15],data[16],data[17],data[18],data[19],data[20],data[21],data[22],data[23],data[24],data[25],data[26],data[27],data[29],data[30],data[31],data[32],data[2]], con);
            if (data[32] == "1"){
                await util.eksekusiQueryPromise(req, 'UPDATE `01_tms_resto_pesanmeja` SET `KODEMENUPESANAN` = ?, `KODEMEJA` = ?, `PEMESAN` = ?, `NOTELEPON` = ?, `UNTUKBERAPAORANG` = ?, `TOTALBELANJA` = ?, `DP` = ?, `TANGGAL` = ?, `WAKTU` = ?, `TANGGALAKHIR` = ?, `WAKTUAKHIR` = ?, `NOMOR` = ?, `WARNAMEMO` = ? WHERE `KODEPESAN` = ? AND OUTLET = ? AND KODEUNIKMEMBER = ?',[data[34],data[35],data[36],data[37],data[38],data[39],data[40],data[41],data[42],data[43],data[44],data[45],data[46].replaceAll('#', ''),data[33],data[7],data[13]],con);
            }
            await util.eksekusiQueryPromise(req, 'COMMIT', [], con);
            queryok = true;
            pesan = 'NO TRANSAKSI '+data[2]+' telah berhasil diubah sesuai data terbaru. Silahkan cek kartu stok untuk melihat detail arus perubahan transaksi tadi'
        } catch (error) {
            await util.eksekusiQueryPromise(req, 'ROLLBACK', [], con);
            queryok = false;
            pesan = "Transaksi dengan kode "+data[2]+" dirollback karena terjadi kesalahan: "+error.message;
        }   
    }else{
        try {
            await util.eksekusiQueryPromise(req, 'BEGIN', [], con);
            await util.eksekusiQueryPromise(req, `INSERT INTO 01_trs_barangkeluar (AI_TRANSAKSIKELUAR, PK_NOTAPENJUALAN, FK_MEMBER, FK_SALESMAN, ENUM_JENISTRANSAKSI, JATUHTEMPO, LOKASI, TGLKELUAR, WAKTU, KASIR, NOMORNOTA, KETERANGAN, KODEUNIKMEMBER, NOMINALTUNAI, NOMINALKREDIT, NOMINALKARTUDEBIT, NOMORKARTUDEBIT, BANKDEBIT, NOMINALKARTUKREDIT, NOMORKARTUKREDIT, BANKKREDIT, NOMINALEMONEY, NAMAEMONEY, NOMINALPOTONGAN, NOMINALPAJAKKELUAR, KEMBALIAN, TOTALBELANJA, PAJAKTOKO, PAJAKNEGARA, POTONGANGLOBAL, TIPETRANSAKSI) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,['0',data[2],data[3],data[4],data[5],data[6],data[7],data[8],data[9],data[10],data[11],data[12],data[13],data[14],data[15],data[16],data[17],data[18],data[19],data[20],data[21],data[22],data[23],data[24],data[25],data[26],data[27],data[29],data[30],data[31],data[32]],con);
            dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_trs_barangkeluar_detail (AI_TRANSAKSIKELUAR, PK_NOTAPENJUALAN, FK_BARANG, NAMABARANG, HARGAJUAL, HARGABELI, STOKBARANGKELUAR, DARIPERUSAHAAN, PPN, KODEUNIKMEMBER, BRAND_ID, PRINCIPAL_ID, STOKDAPATMINUS, JSONTAMBAHAN, CATATANPERBARANG, APAKAHVARIAN, HARGAJUALSEMENTARA, STATUSBARANGPROSES, TANGGALPROSES, WAKTUPROSES) VALUES ?`,[batchinsert.map(item => [item.AI_TRANSAKSIKELUAR, item.PK_NOTAPENJUALAN,item.FK_BARANG, item.NAMABARANG,item.HARGAJUAL, item.HARGABELI,item.STOKBARANGKELUAR, item.DARIPERUSAHAAN, item.PPN, item.KODEUNIKMEMBER, item.BRAND_ID, item.PRINCIPAL_ID, item.STOKDAPATMINUS, item.JSONTAMBAHAN, item.CATATANPERBARANG, item.APAKAHVARIAN, item.HARGAJUALSEMENTARA, item.STATUSBARANGPROSES, item.TANGGALPROSES, item.WAKTUPROSES])], con);
            if (data[32] == "1") {
                await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_resto_pesanmeja (AI, KODEPESAN, KODEMENUPESANAN, KODEMEJA, PEMESAN, NOTELEPON, UNTUKBERAPAORANG, TOTALBELANJA, DP, TANGGAL, WAKTU, TANGGALAKHIR, WAKTUAKHIR, NOMOR, WARNAMEMO, OUTLET, KODEUNIKMEMBER, STATUSPESAN) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,['0',data[33],data[34],data[35],data[36],data[37],data[38],data[39],data[40],data[41],data[42],data[43],data[44],data[45],data[46].replaceAll('#', ''),data[7],data[13],data[47]],con);
                }
            await util.eksekusiQueryPromise(req, 'COMMIT', [], con);
            queryok = true;
            pesan = "Transaksi dengan kode "+data[2]+" berhasil disimpan pada "+data[9]+" "+data[10].replaceAll('.', ':')+". Apakah anda ingin menceta bukti transaksi ?"
        } catch (error) {
            await util.eksekusiQueryPromise(req, 'ROLLBACK', [], con);
            queryok = false;
            pesan = "Transaksi dengan kode "+data[2]+" dirollback karena terjadi kesalahan: "+error.message;
        }        
    }
    batchinsert = [];
    if (queryok) {
        if (data[28] == 'false'){
            if (data[32] == "2" || data[32] == "3"){
                global.io.sockets.emit("NOTIFDINEINTAKEAWAY"+req.body.LOKASI+req.body.KODEUNIKMEMBER, {
                    response_code: data[32],
                    from_controller: "INSERT",
                    statustersajikan: statustersajikan,
                });
            }
        }else{
            if (data[32] == "2" || data[32] == "3"){
                global.io.sockets.emit("NOTIFDINEINTAKEAWAY"+req.body.LOKASI+req.body.KODEUNIKMEMBER, {
                    response_code: data[32],
                    from_controller: "UPDATE",
                    statustersajikan: statustersajikan,
                });
            }
        }
        global.io.sockets.emit("NOTIFDASHBOARD"+req.body.LOKASI+req.body.KODEUNIKMEMBER, {});
        data = {
            success: "true",
            rc: "200",
            msg: pesan,
        }
    } else {
        data = {
            success: false,
            rc: 500,
            msg: pesan,
        }
    }
    pesanbalik.push(data)
    return pesanbalik;
}
penjualan.transaksipiutang = async function (req, data, con) {
    pesanbalik = [];
    batchinsert = []
    let dataquery, pesan = "";
    for (let i = 0; i < data[0].length; i++) {
        var obj = {
            NOTRANSAKSI: data[1],
            TRANSAKSI_ID: data[0][i][0],
            TANGGALBAYAR: data[2],
            WAKTU: data[9],
            KASIR_ID: data[3],
            BAYAR: data[0][i][1],
            POTONGAN: data[0][i][2],
            KETERANGAN: data[4],
            KODEUNIKMEMBER: data[5],
            NOTARETUR: data[6],
            NOMOR: data[7],
            LOKASI: data[8],
        };
        batchinsert.push(obj);
    }
    dataquery = await util.eksekusiQueryPromise(req, `INSERT INTO 01_tms_piutangkredit_detail(NOTRANSAKSI, TRANSAKSI_ID, TANGGALBAYAR, WAKTU, KASIR_ID, BAYAR, POTONGAN, KETERANGAN, KODEUNIKMEMBER, NOTARETUR, NOMOR, LOKASI) VALUES  ?`, [batchinsert.map(item => [item.NOTRANSAKSI, item.TRANSAKSI_ID, item.TANGGALBAYAR, item.WAKTU, item.KASIR_ID, item.BAYAR, item.POTONGAN, item.KETERANGAN, item.KODEUNIKMEMBER, item.NOTARETUR, item.NOMOR, item.LOKASI])], con)
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: 'Informasi pembayaran piutang dengan NOTA '+data[1]+" berhasil disimpan",
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
penjualan.hapustransaksipiutang = async function (req, data, con) {
    pesanbalik = [];
    let dataquery = "";
    if (data[3] == 'true'){
        dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_piutangkredit_detail WHERE AI = ?`, [data[0]], con);
    }else if (data[3] == 'edit'){
        dataquery = await util.eksekusiQueryPromise(req, `UPDATE 01_tms_piutangkredit_detail SET BAYAR = ? WHERE AI = ?`, [data[4], data[0]], con);
    }else{
        dataquery = await util.eksekusiQueryPromise(req, `DELETE FROM 01_tms_piutangkredit_detail WHERE NOTRANSAKSI = ? AND KODEUNIKMEMBER = ? AND LOKASI = ?`, [data[0], data[1], data[2]], con);
    }
    if (dataquery.affectedRows > 0) {
        data = {
            success: "true",
            rc: "200",
            msg: data[3] == 'edit' ? 'Informasi pembayaran piutang dengan SUB NOTA '+data[0]+' berhasil diubah' : 'Informasi pembayaran piutang dengan NOTA '+data[0]+' berhasil dihapus. Saldo piutang akan dikembalikan ke pengguna terkait',
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
penjualan.pencocokannotadaripaymentgateway = async function (req, merchantOrderId, con) {
    dataquery = await util.eksekusiQueryPromise(req, `SELECT PK_NOTAPENJUALAN FROM 01_trs_barangkeluar WHERE PK_NOTAPENJUALAN = ? LIMIT 1`, [merchantOrderId], con);
    if (dataquery.affectedRows > 0) {
        return 1
    } else {
        return 0
    }
}
module.exports = penjualan;