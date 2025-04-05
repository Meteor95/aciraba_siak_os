require('dotenv').config()
const { query } = require('express');
const util = require('../config/utils');
const moment = require('moment');
const laporan = {}
let pesanbalik = {}
laporan.formatlaporanmaster = async function (req, data, con) {
    let KODENAMABARANG = data[0],KODEPERUSAHAAN = data[1],KODEPINCIPAL = data[2],KODEUSUPLIER = data[3],KODEKATEGORI = data[4],KODEBRAND = data[5],KODEOUTLET = data[6], STOKAWAL = data[7], STOKAKHIR = data[8], LOKASISTOK = data[9], STATUSBARANG = data[10], KONDISI = data[11], KODEUNIKMEMBER = data[12];
    pesanbalik = [];
    /* jika tidak kosong maka parameter dari laporan dipakai, jika kosong maka paramter diabaikan. SQL akan di joinkan tetapi tidak pakai predefined */
    let dataquery,querykondisi,kondisigroubby,where1,where2 = "";
    if (KONDISI == "masteritem_informasibarang" || KONDISI == "masteritem_stokopname" || KONDISI == "masteritem_daftaritem"){
        if (LOKASISTOK == "") {
            if (KONDISI == "masteritem_daftaritem"){
                where1 = ", NAMA_PRINCIPAL, NAMAKATEGORI, NAMA_BRAND, B.DISPLAY, B.GUDANG, B.RETUR, (B.DISPLAY +B.GUDANG + B.RETUR) as SUBTOTALSTOK";
            }else{
                where1 = ", B.DISPLAY, B.GUDANG, B.RETUR, (B.DISPLAY +B.GUDANG + B.RETUR) as SUBTOTALSTOK";
            }
        }
        if (LOKASISTOK == "D") {
            if (KONDISI == "masteritem_daftaritem"){
                where1 = ", NAMA_PRINCIPAL, NAMAKATEGORI, NAMA_BRAND, B.DISPLAY, 0 as GUDANG, 0 as RETUR, (B.DISPLAY) as SUBTOTALSTOK";
            }else{
                where1 = ", B.DISPLAY, 0 as GUDANG, 0 as RETUR, (B.DISPLAY) as SUBTOTALSTOK";
            }
            if (STOKAWAL != "" && STOKAKHIR != "")  where2 = " AND (B.DISPLAY BETWEEN "+STOKAWAL+" AND "+STOKAKHIR+")";   
        }
        if (LOKASISTOK == "G") {
            if (KONDISI == "masteritem_daftaritem"){
                where1 = ", NAMA_PRINCIPAL, NAMAKATEGORI, NAMA_BRAND, 0 as DISPLAY, B.GUDANG, 0 as RETUR, (B.GUDANG) as SUBTOTALSTOK";
            }else{
                where1 = ", 0 as DISPLAY, B.GUDANG, 0 as RETUR, (B.GUDANG) as SUBTOTALSTOK";
            }
            if (STOKAWAL != "" && STOKAKHIR != "") where2 = " AND (B.GUDANG BETWEEN "+STOKAWAL+" AND "+STOKAKHIR+")";
        }
        if (LOKASISTOK == "R") {
            if (KONDISI == "masteritem_daftaritem"){
                where1 = ", NAMAPRINCIPAL, NAMAKATEGORI, NAMA_BRAND, 0 as DISPLAY, 0 as GUDANG, B.RETUR, (B.RETUR) as SUBTOTALSTOK"; 
            }else{
                where1 = ", 0 as DISPLAY, 0 as GUDANG, B.RETUR, (B.RETUR) as SUBTOTALSTOK";  
            }
            if (STOKAWAL != "" && STOKAKHIR != "") where2 = " AND (B.RETUR BETWEEN "+STOKAWAL+" AND "+STOKAKHIR+")"; 
        }
        querykondisi = "SELECT A.BARANG_ID, QRCODE_ID, NAMABARANG, SATUAN, NAMASUPPLIER, A.HARGABELI, A.HARGAJUAL "+where1
        kondisigroubby = ""
    }
    dataquery = await util.eksekusiQueryPromise(req, querykondisi+' FROM 01_tms_barangkharisma as A JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID JOIN 01_tms_perusahaan as C ON A.PEMILIK = C.KODEPERUSAHAAN JOIN 01_tms_principal as D ON A.PARETO_ID = D.PRINCIPAL_ID JOIN 01_tms_supplier as E ON A.SUPPLER_ID = E.KODESUPPLIER JOIN 01_tms_kategori as F ON A.KATEGORI_ID = F.KATEGORIPARENT_ID JOIN 01_tms_brand as G ON A.BRAND_ID = G.BRAND_ID WHERE A.PEMILIK LIKE ? AND A.PARETO_ID LIKE ? AND A.SUPPLER_ID LIKE ? AND A.KATEGORI_ID LIKE ? AND A.BRAND_ID LIKE ? AND (A.BARANG_ID LIKE ? OR A.NAMABARANG LIKE ?) AND B.OUTLET = ? AND AKTIF LIKE ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? AND F.KODEUNIKMEMBER = ? AND G.KODEUNIKMEMBER = ? '+where2+kondisigroubby, ['%' + KODEPERUSAHAAN+ '%', '%' + KODEPINCIPAL+ '%', '%' + KODEUSUPLIER+ '%', '%' + KODEKATEGORI+ '%', '%' + KODEBRAND+ '%', '%' + KODENAMABARANG + '%', '%' + KODENAMABARANG + '%', KODEOUTLET, '%' + STATUSBARANG + '%',KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER], con) 
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200_LM",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporanmastersup = async function (req, data, con) {
    let KODESUPLIER = data[0],PERIODEAWAL = data[1],PERIODEAKHIR = data[2],OUTLET = data[3],KONDISI = data[4],KODEUNIKMEMBER = data[5];
    pesanbalik = [];
    let dataquery, pilihkolomapa = "*", jointable = "", wherejointable = "", groupbyjoin = "";
    if (KONDISI == "master_aktiviassuplier"){
        pilihkolomapa = 'B.FK_SUPPLIER, A.NAMASUPPLIER, B.NOTA, B.NAMATOP, B.TANGGALTRS, B.TOTALPEMBELIAN ';
        jointable = " JOIN 01_trs_barangmasuk as B ON A.KODESUPPLIER = B.FK_SUPPLIER ";
        wherejointable = " AND (B.TANGGALTRS BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"')";
        groupbyjoin = " ORDER BY B.TANGGALTRS DESC";
    }else if (KONDISI == "master_logsuplier"){
        pilihkolomapa = 'B.KODESUPPLIER, A.NAMASUPPLIER, B.NOTRANSAKSI, B.TGLTRANSAKSI, B.PROSESAPA, B.KETERANGAN ';
        jointable = " JOIN 01_trs_kartulog_suplier as B ON A.KODESUPPLIER = B.KODESUPPLIER ";
        wherejointable = " AND (B.TGLTRANSAKSI BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"')";
        groupbyjoin = " ORDER BY B.TGLTRANSAKSI DESC";
    }
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT '+pilihkolomapa+' FROM 01_tms_supplier as A '+jointable+' WHERE A.KODESUPPLIER LIKE ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? '+wherejointable+groupbyjoin, ['%' + KODESUPLIER+ '%',KODEUNIKMEMBER,KODEUNIKMEMBER], con) 
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200_LM",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporanmastermember = async function (req, data, con) {
    let KODEMEMBER = data[0],PERIODEAWAL = data[1],PERIODEAKHIR = data[2],STATUSTRANSAKSI = data[3],OUTLET = data[4],KONDISI = data[5],KODEUNIKMEMBER = data[6];
    pesanbalik = [];
    let dataquery;
    if (KONDISI == "master_informasimember" || KONDISI == "master_detailmember"){
        dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_tms_member as A WHERE A.MEMBER_ID LIKE ? AND A.KODEUNIKMEMBER = ?',['%' + KODEMEMBER+ '%',KODEUNIKMEMBER], con) 
    }else if (KONDISI == "master_aktiviasmemebr"){
        dataquery = await util.eksekusiQueryPromise(req, "SELECT FK_MEMBER, POINT, NAMA, SUM(TOTALBELANJA) AS TOTALBELANJA, SUM(TUNAI) AS JUMLAH_TUNAI, SUM(KARTU) AS JUMLAH_KARTU, SUM(KREDIT) AS JUMLAH_KREDIT, SUM(SPLITCASH) AS JUMLAH_SPLITCASH FROM (SELECT A.FK_MEMBER, B.POINT, B.NAMA, SUM(A.TOTALBELANJA) AS TOTALBELANJA, SUM(IF(A.ENUM_JENISTRANSAKSI = 'TUNAI', 1, 0)) AS TUNAI, SUM(IF(A.ENUM_JENISTRANSAKSI = 'KARTU', 1, 0)) AS KARTU, SUM(IF(A.ENUM_JENISTRANSAKSI = 'KREDIT', 1, 0)) AS KREDIT, SUM(IF(A.ENUM_JENISTRANSAKSI = 'SPLITCASH', 1, 0)) AS SPLITCASH FROM 01_trs_barangkeluar AS A JOIN  01_tms_member AS B ON A.FK_MEMBER = B.MEMBER_ID WHERE (TGLKELUAR BETWEEN ? AND ?) AND LOKASI LIKE ? AND A.KODEUNIKMEMBER = ? GROUP BY A.FK_MEMBER, B.NAMA, B.POINT) AS subquery GROUP BY FK_MEMBER, NAMA, POINT",[PERIODEAWAL, PERIODEAKHIR, '%'+OUTLET+'%', KODEUNIKMEMBER], con) 
    }
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200_LM",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporandetaimembertabel = async function (req, data, con) {
    let KODEMEMBER = data[0],PERIODEAWAL = data[1],PERIODEAKHIR = data[2],STATUSTRANSAKSI = data[3],OUTLET = data[4],KODEUNIKMEMBER = data[5];
    pesanbalik = [];
    let dataquery;
    dataquery = await util.eksekusiQueryPromise(req, 'SELECT * FROM 01_trs_barangkeluar as A JOIN 01_trs_barangkeluar_detail as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN JOIN 01_tms_member as C ON A.FK_MEMBER = C.MEMBER_ID WHERE A.FK_MEMBER = ? AND (TGLKELUAR BETWEEN ? AND ?) AND ENUM_JENISTRANSAKSI LIKE ? AND A.LOKASI LIKE ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ?', [KODEMEMBER,PERIODEAWAL,PERIODEAKHIR,'%'+STATUSTRANSAKSI+'%','%'+OUTLET+'%',KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER], con)
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200_LM",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporanpenjualan = async function (req, data, con) {
    let PERIODEAWAL = data[0],PERIODEAKHIR = data[1],CARABAYAR = data[2],OUTLET = data[3],IDPELANGGAN = data[4],KODEBARANG = data[5],KODESUPLIER = data[6],GROUPELANGGAN = data[7],KODEKATEGORI = data[8],KONDISI = data[9],KODEUNIKMEMBER = data[10];
    pesanbalik = [];
    /* jika tidak kosong maka parameter dari laporan dipakai, jika kosong maka paramter diabaikan. SQL akan di joinkan tetapi tidak pakai predefined */
    let dataquery,querykondisi,kondisigroubby,jointambahan = "";
    if (KONDISI == "penjualanperfaktur"){
        querykondisi = " DATE_FORMAT(A.TGLKELUAR,'%d-%m-%Y') AS TGLKELUAR, A.WAKTU, C.NAMA, A.PK_NOTAPENJUALAN, SUM(B.STOKBARANGKELUAR) as JUMLAHITEM, SUM(B.HARGAJUAL * STOKBARANGKELUAR) as SUBTOTAL, PAJAKTOKO, PAJAKNEGARA ,POTONGANGLOBAL, SUM(PAJAKTOKO / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as PAJAKTOKOC, SUM(PAJAKNEGARA / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as PAJAKNEGARAC, SUM(POTONGANGLOBAL / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as POTONGANGLOBALC "
        kondisigroubby = " GROUP BY A.PK_NOTAPENJUALAN ORDER BY A.TGLKELUAR DESC,A.WAKTU DESC"
    }
    if (KONDISI == "penjualanperbarang"){
        querykondisi = " SUM(B.STOKBARANGKELUAR) as JUMLAHITEM, FK_BARANG, B.NAMABARANG, NAMAKATEGORI, STOKBARANGKELUAR, B.HARGAJUAL, B.HARGABELI,(SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN) as JENISBARANG, FK_BARANG, STOKBARANGKELUAR, SUM(PAJAKTOKO / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as PAJAKTOKO, SUM(PAJAKNEGARA / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as PAJAKNEGARA, SUM(POTONGANGLOBAL / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as POTONGANGLOBAL "
        kondisigroubby = " GROUP BY B.FK_BARANG ORDER BY JUMLAHITEM DESC"
    }
    if (KONDISI == "penjualandetailnota"){
        querykondisi = " A.PK_NOTAPENJUALAN,A.FK_MEMBER,C.NAMA, C.ALAMAT, CONCAT(DATE_FORMAT(A.TGLKELUAR,'%d-%m-%Y'),' ',A.WAKTU) as FULLWAKTU, DATE_FORMAT(A.TGLKELUAR,'%d-%m-%Y') as TGLKELUAR, A.WAKTU, B.FK_BARANG, B.NAMABARANG, B.HARGAJUAL, B.HARGABELI, B.STOKBARANGKELUAR ,D.SATUAN ,CONCAT(STOKBARANGKELUAR,' ',D.SATUAN) as TOTALKELUAR, (PAJAKTOKO / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as PAJAKTOKO, (PAJAKNEGARA / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as PAJAKNEGARA, (POTONGANGLOBAL / (SELECT COUNT(*) FROM 01_trs_barangkeluar_detail WHERE PK_NOTAPENJUALAN = A.PK_NOTAPENJUALAN)) as POTONGANGLOBAL, NAMAKATEGORI, H. NAMAPENGGUNA "
        kondisigroubby = " ORDER BY A.TGLKELUAR DESC, A.WAKTU DESC"
    }
    if (KONDISI == "penjualanperjenistransaksi"){
        dataquery = await util.eksekusiQueryPromise(req,
        "SELECT 'TRANSAKSI UANG MUKA RESERVASI' as JENIS, SUM(COALESCE(DP,0)) as NOMINAL FROM 01_trs_barangkeluar as A LEFT JOIN 01_tms_resto_pesanmeja as B ON A.PK_NOTAPENJUALAN = B.KODEMENUPESANAN WHERE (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND (B.KODEUNIKMEMBER IS NULL OR B.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' )"
        +"UNION "
        +"SELECT 'TRANSAKSI TUNAI' AS JENIS, COALESCE(SUM(NOMINALTUNAI - KEMBALIAN),0) as NOMINAL FROM 01_trs_barangkeluar WHERE NOMINALTUNAI != 0 AND (ENUM_JENISTRANSAKSI = 'TUNAI') AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' "
        +"UNION "
        +"SELECT 'TRANSAKSI TUNAI DARI SPLIT CASH' AS JENIS, COALESCE(SUM(NOMINALTUNAI - KEMBALIAN),0) as NOMINAL FROM 01_trs_barangkeluar WHERE NOMINALTUNAI != 0 AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' "
        +"UNION "
        +"SELECT 'TOTAL TRANSAKSI TUNAI' as JENIS, 0 as NOMINAL "
        +"UNION "
        +"SELECT 'TRANSAKSI UANG MUKA' AS JENIS, COALESCE(SUM(NOMINALKREDIT),0) AS TOTAL FROM `01_trs_barangkeluar` AS A WHERE ENUM_JENISTRANSAKSI = 'KREDIT' AND (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' "
        +"UNION "
        +"SELECT 'TOTAL TRANSAKSI PIUTANG' AS JENIS, COALESCE(IF(SUM(KEMBALIAN) < 0, SUM(KEMBALIAN) * -1, SUM(KEMBALIAN)),0) AS TOTAL FROM `01_trs_barangkeluar` AS A WHERE ENUM_JENISTRANSAKSI = 'KREDIT' AND (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' "
        +"UNION "
        +"SELECT CONCAT('TRANSAKSI KARTU DEBIT',' ',BANKDEBIT) AS JENIS, COALESCE(SUM(NOMINALKARTUDEBIT - KEMBALIAN),0)  AS TOTAL FROM `01_trs_barangkeluar` AS A WHERE NOMINALKARTUDEBIT != 0 AND (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' GROUP BY BANKDEBIT "
        +"UNION "
        +"SELECT 'TOTAL TRANSAKSI KARTU DEBIT' AS JENIS, COALESCE(SUM(NOMINALKARTUDEBIT - KEMBALIAN),0) AS TOTAL FROM `01_trs_barangkeluar` AS A WHERE NOMINALKARTUDEBIT != 0 AND (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' "
        +"UNION "
        +"SELECT CONCAT('TRANSAKSI KARTU KREDIT',' ',BANKKREDIT) AS JENIS, COALESCE(SUM(NOMINALKARTUKREDIT - KEMBALIAN),0) AS TOTAL FROM `01_trs_barangkeluar` AS A WHERE NOMINALKARTUKREDIT != 0 AND (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' GROUP BY BANKKREDIT  "
        +"UNION  "
        +"SELECT 'TOTAL TRANSKASI KARTU KREDIT' AS JENIS, COALESCE(SUM(NOMINALKARTUKREDIT - KEMBALIAN),0) AS TOTAL FROM `01_trs_barangkeluar` AS A WHERE NOMINALKARTUKREDIT != 0 AND (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"'  "
        +"UNION  "
        +"SELECT CONCAT('TRANSAKSI EMONEY',' ',NAMAEMONEY) AS JENIS, COALESCE(SUM(NOMINALEMONEY - KEMBALIAN),0) AS TOTAL FROM `01_trs_barangkeluar` AS A WHERE NOMINALEMONEY != 0 AND (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' GROUP BY NAMAEMONEY  "
        +"UNION  "
        +"SELECT 'TOTAL TRANSAKSI EMONEY' AS JENIS, COALESCE(SUM(NOMINALEMONEY - KEMBALIAN),0) AS TOTAL FROM `01_trs_barangkeluar` AS A WHERE NOMINALEMONEY != 0 AND (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' "
        , [], con) 
    }else if (KONDISI == "penjualanperpelanggan" || KONDISI == "penjualanperkasir"){
        if (KONDISI == "penjualanperpelanggan") { kolomwhere = "FK_MEMBER"; kondisigroubby = "MEMBER_ID";}
        if (KONDISI == "penjualanperkasir") { kolomwhere = "KASIR"; kondisigroubby = "KASIR";}
        dataquery = await util.eksekusiQueryPromise(req, 
        "SELECT "+kondisigroubby+" as "+kolomwhere+", NAMA, ALAMAT, KASIR, NAMAPENGGUNA, SUM(DPPESANTEMPAT) AS DPPESANTEMPAT, ENUM_JENISTRANSAKSI, "
        +"(SELECT COALESCE(SUM(NOMINALTUNAI - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE "+kolomwhere+" = "+kondisigroubby+" AND (ENUM_JENISTRANSAKSI = 'TUNAI') AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALTUNAI, "
        +"(SELECT COALESCE(SUM(NOMINALTUNAI - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE "+kolomwhere+" = "+kondisigroubby+" AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALTUNAISPLIT, "
        +"(SELECT COALESCE(SUM(NOMINALKREDIT),0) FROM 01_trs_barangkeluar WHERE "+kolomwhere+" = "+kondisigroubby+" AND ENUM_JENISTRANSAKSI = 'KREDIT' AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as UANGMUKA, "
        +"(SELECT COALESCE(IF(SUM(KEMBALIAN) < 0, SUM(KEMBALIAN) * -1, SUM(KEMBALIAN)),0) FROM 01_trs_barangkeluar WHERE "+kolomwhere+" = "+kondisigroubby+" AND ENUM_JENISTRANSAKSI = 'KREDIT' AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKREDIT, "
        +"(SELECT COALESCE(SUM(NOMINALKARTUDEBIT - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALKARTUDEBIT != 0 AND (ENUM_JENISTRANSAKSI = 'KARTU') AND "+kolomwhere+" = "+kondisigroubby+" AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKDEBIT, "
        +"(SELECT COALESCE(SUM(NOMINALKARTUDEBIT - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALKARTUDEBIT != 0 AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND "+kolomwhere+" = "+kondisigroubby+" AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKDEBITSPLIT, "
        +"(SELECT COALESCE(SUM(NOMINALKARTUKREDIT - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALKARTUKREDIT != 0 AND (ENUM_JENISTRANSAKSI = 'KARTU') AND "+kolomwhere+" = "+kondisigroubby+" AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKARTUKREDIT, "
        +"(SELECT COALESCE(SUM(NOMINALKARTUKREDIT - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALKARTUKREDIT != 0 AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND "+kolomwhere+" = "+kondisigroubby+" AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKARTUKREDITSPLIT, "
        +"(SELECT COALESCE(SUM(NOMINALEMONEY - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALEMONEY != 0 AND (ENUM_JENISTRANSAKSI = 'KARTU') AND "+kolomwhere+" = "+kondisigroubby+" AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALEMONEY, "
        +"(SELECT COALESCE(SUM(NOMINALEMONEY - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALEMONEY != 0 AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND "+kolomwhere+" = "+kondisigroubby+" AND (TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALEMONEYSPLIT "
        +"FROM ( SELECT DISTINCT A.FK_MEMBER as MEMBER_ID, C.NAMA, C.ALAMAT, A.KASIR as KASIR, H.NAMAPENGGUNA as NAMAPENGGUNA, ENUM_JENISTRANSAKSI, A.PK_NOTAPENJUALAN, COALESCE(I.DP, 0) AS DPPESANTEMPAT, A.TGLKELUAR, A.WAKTU FROM 01_trs_barangkeluar AS A JOIN 01_trs_barangkeluar_detail AS B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN JOIN 01_tms_member AS C ON A.FK_MEMBER = C.MEMBER_ID JOIN 01_tms_barangkharisma AS D ON D.BARANG_ID = B.FK_BARANG JOIN 01_tms_supplier AS E ON E.KODESUPPLIER = D.SUPPLER_ID JOIN 01_tms_kategori AS F ON F.KATEGORIPARENT_ID = D.KATEGORI_ID JOIN 01_tms_member_grup AS G ON G.KODEGRUP = C.GRUP JOIN 01_tms_penggunaaplikasi AS H ON H.PENGGUNA_ID = A.KASIR LEFT JOIN 01_tms_resto_pesanmeja AS I ON A.PK_NOTAPENJUALAN = I.KODEMENUPESANAN "
        +"WHERE (A.TGLKELUAR BETWEEN ? AND ?) "
        +"AND A.LOKASI = ? "
        +"AND A.KODEUNIKMEMBER = ? "
        +"AND ENUM_JENISTRANSAKSI LIKE ? "
        +"AND FK_MEMBER LIKE ? "
        +"AND FK_BARANG LIKE ? "
        +"AND KODESUPPLIER LIKE ? "
        +"AND KODEGRUP LIKE ? "
        +"AND KATEGORI_ID LIKE ? "
        +"AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? AND F.KODEUNIKMEMBER = ? AND G.KODEUNIKMEMBER = ? AND H.KODEUNIKMEMBER = ? AND (I.KODEUNIKMEMBER IS NULL OR I.KODEUNIKMEMBER = ?)) AS T "
        +"GROUP BY "+kondisigroubby+"", [PERIODEAWAL, PERIODEAKHIR, OUTLET, KODEUNIKMEMBER, '%' + CARABAYAR + '%', '%' + IDPELANGGAN + '%', '%' + KODEBARANG + '%', '%' + KODESUPLIER + '%', '%' + GROUPELANGGAN + '%', '%' + KODEKATEGORI + '%',KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER], con)
    }else if (KONDISI == "penjualanpertanggal"){
        dataquery = await util.eksekusiQueryPromise(req, 
        "SELECT TGLKELUARTRX as TGLKELUARTRX, SUM(JUMLAHITEM) as STOKBARANGKELUAR, SUM(DPPESANTEMPAT) AS DPPESANTEMPAT, "
        +"(SELECT SUM(PAJAKTOKO) FROM 01_trs_barangkeluar WHERE DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as PAJAKTOKO , "
        +"(SELECT SUM(PAJAKNEGARA) FROM 01_trs_barangkeluar WHERE DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as PAJAKNEGARA , "
        +"(SELECT SUM(POTONGANGLOBAL) FROM 01_trs_barangkeluar WHERE DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as POTONGANGLOBAL ,"
        +"(SELECT COALESCE(SUM(NOMINALTUNAI - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE DATE(TGLKELUAR) = TGLKELUARTRX AND (ENUM_JENISTRANSAKSI = 'TUNAI') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALTUNAI, "
        +"(SELECT COALESCE(SUM(NOMINALTUNAI - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE DATE(TGLKELUAR) = TGLKELUARTRX AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALTUNAISPLIT, "
        +"(SELECT COALESCE(SUM(NOMINALKREDIT),0) FROM 01_trs_barangkeluar WHERE DATE(TGLKELUAR) = TGLKELUARTRX AND ENUM_JENISTRANSAKSI = 'KREDIT' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as UANGMUKA, "
        +"(SELECT COALESCE(IF(SUM(KEMBALIAN) < 0, SUM(KEMBALIAN) * -1, SUM(KEMBALIAN)),0) FROM 01_trs_barangkeluar WHERE DATE(TGLKELUAR) = TGLKELUARTRX AND ENUM_JENISTRANSAKSI = 'KREDIT' AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKREDIT, "
        +"(SELECT COALESCE(SUM(NOMINALKARTUDEBIT - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALKARTUDEBIT != 0 AND (ENUM_JENISTRANSAKSI = 'KARTU') AND DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKDEBIT, "
        +"(SELECT COALESCE(SUM(NOMINALKARTUDEBIT - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALKARTUDEBIT != 0 AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKDEBITSPLIT,"
        +"(SELECT COALESCE(SUM(NOMINALKARTUKREDIT - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALKARTUKREDIT != 0 AND (ENUM_JENISTRANSAKSI = 'KARTU') AND DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKARTUKREDIT, "
        +"(SELECT COALESCE(SUM(NOMINALKARTUKREDIT - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALKARTUKREDIT != 0 AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALKARTUKREDITSPLIT, "
        +"(SELECT COALESCE(SUM(NOMINALEMONEY - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALEMONEY != 0 AND (ENUM_JENISTRANSAKSI = 'KARTU') AND DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALEMONEY, "
        +"(SELECT COALESCE(SUM(NOMINALEMONEY - KEMBALIAN),0) FROM 01_trs_barangkeluar WHERE NOMINALEMONEY != 0 AND (ENUM_JENISTRANSAKSI = 'SPLITCASH') AND DATE(TGLKELUAR) = TGLKELUARTRX AND LOKASI = '"+OUTLET+"' AND KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as NOMINALEMONEYSPLIT "
        +"FROM (SELECT DISTINCT DATE(A.TGLKELUAR) as TGLKELUARTRX, B.STOKBARANGKELUAR as JUMLAHITEM, ENUM_JENISTRANSAKSI, A.PK_NOTAPENJUALAN, COALESCE(I.DP, 0) AS DPPESANTEMPAT, A.WAKTU FROM 01_trs_barangkeluar AS A JOIN 01_trs_barangkeluar_detail AS B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN JOIN 01_tms_member AS C ON A.FK_MEMBER = C.MEMBER_ID JOIN 01_tms_barangkharisma AS D ON D.BARANG_ID = B.FK_BARANG JOIN 01_tms_supplier AS E ON E.KODESUPPLIER = D.SUPPLER_ID JOIN 01_tms_kategori AS F ON F.KATEGORIPARENT_ID = D.KATEGORI_ID JOIN 01_tms_member_grup AS G ON G.KODEGRUP = C.GRUP JOIN 01_tms_penggunaaplikasi AS H ON H.PENGGUNA_ID = A.KASIR LEFT JOIN 01_tms_resto_pesanmeja AS I ON A.PK_NOTAPENJUALAN = I.KODEMENUPESANAN WHERE (A.TGLKELUAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') AND A.LOKASI = '"+OUTLET+"' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND ENUM_JENISTRANSAKSI LIKE '%%' AND FK_MEMBER LIKE '%%' AND FK_BARANG LIKE '%%' AND KODESUPPLIER LIKE '%%' AND KODEGRUP LIKE '%%' AND KATEGORI_ID LIKE '%%' AND B.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND C.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND D.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND E.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND F.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND G.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND H.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND (I.KODEUNIKMEMBER IS NULL OR I.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"')) AS ALIASPENJUALAN GROUP BY TGLKELUARTRX ORDER BY  TGLKELUARTRX DESC "
        , [PERIODEAWAL, PERIODEAKHIR, OUTLET, KODEUNIKMEMBER, '%' + CARABAYAR + '%', '%' + IDPELANGGAN + '%', '%' + KODEBARANG + '%', '%' + KODESUPLIER + '%', '%' + GROUPELANGGAN + '%', '%' + KODEKATEGORI + '%'], con) 
    }else{
        dataquery = await util.eksekusiQueryPromise(req, "SELECT "+querykondisi+' FROM 01_trs_barangkeluar as A JOIN 01_trs_barangkeluar_detail as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN JOIN 01_tms_member as C ON A.FK_MEMBER = C.MEMBER_ID JOIN 01_tms_barangkharisma as D ON D.BARANG_ID = B.FK_BARANG JOIN 01_tms_supplier as E ON E.KODESUPPLIER = D.SUPPLER_ID JOIN 01_tms_kategori as F ON F.KATEGORIPARENT_ID = D.KATEGORI_ID JOIN 01_tms_member_grup as G ON G.KODEGRUP = C.GRUP JOIN 01_tms_penggunaaplikasi as H ON H.PENGGUNA_ID = A.KASIR '+jointambahan+' WHERE (A.TGLKELUAR BETWEEN ? AND ?) AND A.LOKASI = ? AND A.KODEUNIKMEMBER = ? AND ENUM_JENISTRANSAKSI LIKE ? AND FK_MEMBER LIKE ? AND FK_BARANG LIKE ? AND KODESUPPLIER LIKE ? AND KODEGRUP LIKE ? AND KATEGORI_ID LIKE ?  AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? AND F.KODEUNIKMEMBER = ? AND G.KODEUNIKMEMBER = ?'+kondisigroubby, [PERIODEAWAL, PERIODEAKHIR, OUTLET, KODEUNIKMEMBER, '%' + CARABAYAR + '%', '%' + IDPELANGGAN + '%', '%' + KODEBARANG + '%', '%' + KODESUPLIER + '%', '%' + GROUPELANGGAN + '%', '%' + KODEKATEGORI + '%', KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER], con) 
    }
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporanreturpenjualan = async function (req, data, con) {
    let PERIODEAWAL = data[0],PERIODEAKHIR = data[1],CARABAYAR = data[2],OUTLET = data[3],IDPELANGGAN = data[4],KODEBARANG = data[5],KODEKATEGORI = data[6],KONDISI = data[7],KODEUNIKMEMBER = data[8];
    pesanbalik = [];
    let dataquery,querykondisi,kondisigroubby;
    if (KONDISI == "returpenjualanperfaktur"){
        querykondisi = " B.NOTRXRETUR, TANGGALRETUR, A.IDPELANGGAN, C.NAMA, SUM(JUMLAHRETUR) as TOTALSTOKRETUR, PPN as TOTALPPN, SUM(B.HARGABELI * JUMLAHRETUR) as TOTALHPPRETUR, SUM((B.HARGAJUAL * JUMLAHRETUR) + PPN) as TOTALJUALRETUR "
        kondisigroubby = " GROUP BY B.NOTRXRETUR ORDER BY A.TANGGALRETUR DESC "
    }else if (KONDISI == "returpenjualanperfakturdetail"){
        querykondisi = " A.NOTRXRETUR, NAMAPENGGUNA, A.TANGGALRETUR, C.NAMA, KODEBARANG, D.NAMABARANG, B.JUMLAHRETUR, B.PPN, B.HARGABELI, B.HARGAJUAL, (CASE WHEN (B.HARGAJUAL - B.HARGABELI) < 0 THEN ((B.HARGAJUAL - B.HARGABELI) * -1) ELSE (B.HARGAJUAL - B.HARGABELI) END) AS SELISIH  "
        kondisigroubby = " ORDER BY A.NOTRXRETUR DESC"
    }
    dataquery = await util.eksekusiQueryPromise(req, "SELECT "+querykondisi+" FROM 01_trs_returpenjualan as A "
    +"JOIN 01_trs_returpenjualan_detail as B ON A.NOTRXRETUR = B.NOTRXRETUR "
    +"JOIN 01_tms_member as C ON A.IDPELANGGAN = C.MEMBER_ID "
    +"JOIN 01_tms_barangkharisma as D ON B.KODEBARANG = D.BARANG_ID "
    +"JOIN 01_tms_kategori as E ON D.KATEGORI_ID = E.KATEGORIPARENT_ID "
    +"JOIN 01_tms_penggunaaplikasi as F ON F.PENGGUNA_ID = A.PETUGAS "
    +"WHERE (TANGGALRETUR BETWEEN ? AND ?) AND JENISTRX LIKE ? AND A.IDPELANGGAN LIKE ? AND B.KODEBARANG LIKE ? AND D.KATEGORI_ID LIKE ? AND A.OUTLET = ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? AND F.KODEUNIKMEMBER = ? " + kondisigroubby, [PERIODEAWAL, PERIODEAKHIR, '%' + CARABAYAR + '%', '%' + IDPELANGGAN + '%', '%'+KODEBARANG + '%', '%' + KODEKATEGORI + '%', OUTLET, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER], con)
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporanpembelian = async function (req, data, con) {
    let PERIODEAWAL = data[0],PERIODEAKHIR = data[1],CARABAYAR = data[2],OUTLET = data[3],KODEBARANG = data[4],KODESUPLIER = data[5],KODEKATEGORI = data[6],KONDISI = data[7],KODEUNIKMEMBER = data[8];
    pesanbalik = [];
    let dataquery,querykondisi,kondisigroubby;
    if (KONDISI == "pembelianperfaktur"){
        querykondisi = " A.NOTA, A.TANGGALTRS, NAMASUPPLIER, NAMAPENGGUNA,SUM(JUMLAHBELI) as TOTALBELI, TOP, NAMATOP, SUM(DISKON1) as DISKON1, SUM(DISKON2) as DISKON2 , TOTALPPNMASUKAN, SUM(AFTERDISKON1) as ADISKON1, SUM(AFTERDISKON2) as ADISKON2, TOTALPEMBELIAN, TOTALPEMBELIANBEBAN ,TOTALHUTANG "
        kondisigroubby = " GROUP BY B.NOTA ORDER BY A.TANGGALTRS DESC "
    }else if (KONDISI == "pembelianperbarang" || KONDISI == "pembelianpertanggal"){
        if (KONDISI == "pembelianperbarang") {
            querykondisi = " B.KODEBARANG, B.NAMABARANG, E.NAMAKATEGORI, SUM(JUMLAHBELI) as TOTALBELI, SUM(DISKON1) as DISKON1, SUM(DISKON2) as DISKON2 , SUM(PPN) as TOTALPPNMASUKAN, SUM(AFTERDISKON1) as ADISKON1, SUM(AFTERDISKON2) as ADISKON2, SUM((JUMLAHBELI * B.HARGABELI) - DISKON1 - DISKON2 + PPN - AFTERDISKON1 - AFTERDISKON2) as TOTALPEMBELIAN "
            kondisigroubby = " GROUP BY B.KODEBARANG ORDER BY SUM(JUMLAHBELI) DESC "
        }else if (KONDISI == "pembelianpertanggal"){
            querykondisi = " A.TANGGALTRS, SUM(JUMLAHBELI) as TOTALBELI, SUM(DISKON1) as DISKON1, SUM(DISKON2) as DISKON2 , SUM(PPN) as TOTALPPNMASUKAN, SUM(AFTERDISKON1) as ADISKON1, SUM(AFTERDISKON2) as ADISKON2, SUM((JUMLAHBELI * B.HARGABELI) - DISKON1 - DISKON2 + PPN - AFTERDISKON1 - AFTERDISKON2) as TOTALPEMBELIAN "
            kondisigroubby = " GROUP BY DATE(A.TANGGALTRS) ORDER BY A.TANGGALTRS DESC "
        }
    }else if (KONDISI == "pembeliandetail"){
        querykondisi = " B.JUMLAHBELI, B.HARGABELI, B.DISPLAY, B.GUDANG, B.DISKON1, B.DISKON2, B.PPN, B.AFTERDISKON1, B.AFTERDISKON2, ((B.JUMLAHBELI * B.HARGABELI) - B.DISKON1 - B.DISKON2 + B.PPN - B.AFTERDISKON1 - B.AFTERDISKON2) as SUBTOTALPEMBELIAN, B.HPP, B.BEBANGAJI, B.BEBANPROMO, B.BEBANPACKING, B.BEBANTRANSPORT, (B.HPPBEBAN * B.JUMLAHBELI) as HPPBEBAN, A.NOTA, C.NAMASUPPLIER, A.TANGGALTRS, F.NAMAPENGGUNA, B.KODEBARANG, B.NAMABARANG "
        kondisigroubby = " ORDER BY A.TANGGALTRS DESC "
    }
    dataquery = await util.eksekusiQueryPromise(req, "SELECT "+querykondisi+" FROM `01_trs_barangmasuk` as A "
    +"JOIN 01_trs_barangmasuk_detail as B ON A.NOTA = B.NOTA "
    +"JOIN 01_tms_supplier as C ON A.FK_SUPPLIER = C.KODESUPPLIER "
    +"JOIN 01_tms_barangkharisma as D ON B.KODEBARANG = D.BARANG_ID "
    +"JOIN 01_tms_kategori as E ON D.KATEGORI_ID = E.KATEGORIPARENT_ID "
    +"JOIN 01_tms_penggunaaplikasi as F ON A.PETUGAS = F.PENGGUNA_ID "
    +"WHERE (DATE(TANGGALTRS) BETWEEN ? AND ?) AND A.TOP LIKE ? AND A.FK_SUPPLIER LIKE ? AND B.KODEBARANG LIKE ? AND E.NAMAKATEGORI LIKE ? AND A.OUTLET = ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? AND F.KODEUNIKMEMBER = ?" + kondisigroubby, [PERIODEAWAL, PERIODEAKHIR, '%'+CARABAYAR+'%','%' + KODESUPLIER + '%', '%' + KODEBARANG + '%', '%' + KODEKATEGORI + '%', OUTLET, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER], con)
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporanreturpembelian = async function (req, data, con) {
    let PERIODEAWAL = data[0],PERIODEAKHIR = data[1],CARABAYAR = data[2],OUTLET = data[3],KODEBARANG = data[4],KODESUPLIER = data[5],KODEKATEGORI = data[6],KONDISI = data[7],KODEUNIKMEMBER = data[8];
    pesanbalik = [];
    let dataquery,querykondisi,kondisigroubby;
    if (KONDISI == "returpembelianperfaktur"){
        querykondisi = " A.NOTRXRETURBELI, A.TANGGALTRS, C.NAMASUPPLIER, A.TOTALBARANG, A.TOTALPOTONGAN, A.TOTALNOMINAL, F.NAMAPENGGUNA "
        kondisigroubby = " GROUP BY A.NOTRXRETURBELI ORDER BY A.TANGGALTRS DESC"
    }else if (KONDISI == "returpembelianperfakturdetail"){
        querykondisi = " B.NOTRXRETURBELI, B.KODEBARANG, D.NAMABARANG, B.JUMLAHRETUR, B.HARGABELI, B.POTONGAN, B.PPN, B.ASALLOKASI, B.KETERANGAN, F.NAMAPENGGUNA, C.NAMASUPPLIER "
        kondisigroubby = " ORDER BY A.TANGGALTRS DESC"
    }
    dataquery = await util.eksekusiQueryPromise(req, "SELECT "+querykondisi+" FROM 01_trs_returpembelian as A "
    +"JOIN 01_trs_returpembelian_detail as B ON A. NOTRXRETURBELI = B.NOTRXRETURBELI "
    +"JOIN 01_tms_supplier as C ON A.SUPPLIERID = C.KODESUPPLIER "
    +"JOIN 01_tms_barangkharisma as D ON B.KODEBARANG = D.BARANG_ID "
    +"JOIN 01_tms_kategori as E ON D.KATEGORI_ID = E.KATEGORIPARENT_ID "
    +"JOIN 01_tms_penggunaaplikasi as F ON A.PETUGAS = F.PENGGUNA_ID "
    +"WHERE (DATE(TANGGALTRS) BETWEEN ? AND ?)  AND A.SUPPLIERID LIKE ? AND B.KODEBARANG LIKE ? AND E.NAMAKATEGORI LIKE ? AND A.OUTLET = ? AND A.KODEUNIKMEMBER = ? AND B.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? AND F.KODEUNIKMEMBER = ?" + kondisigroubby, [PERIODEAWAL, PERIODEAKHIR,'%' + KODESUPLIER + '%', '%' + KODEBARANG + '%', '%' + KODEKATEGORI + '%', OUTLET, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER, KODEUNIKMEMBER], con)
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporanhutang = async function (req, data, con) {
    let PERIODEAWAL = data[0],PERIODEAKHIR = data[1],CARABAYAR = data[2],OUTLET = data[3],KODESUPLIER = data[4],KONDISI = data[5],KODEUNIKMEMBER = data[6],KONDISIHUTANG = data[7];
    pesanbalik = [];
    let dataquery,querykondisi = "",kondisigroubby = "",kondisihaving="",kondisiwhere = "", kondisijoin = "";
    if (KONDISI == "hutangberedar"){
        kondisijoin = " CROSS JOIN (SELECT @sisa_hutang := 0) AS init "
        if (KONDISIHUTANG == "0") kondisihaving = "";
        if (KONDISIHUTANG == "1") kondisihaving = " HAVING RENTANGWAKTU < 0 ";
        if (KONDISIHUTANG == "2") kondisihaving = " HAVING RENTANGWAKTU >= 0 ";
        //querykondisi = "C.FK_SUPPLIER, E.NAMASUPPLIER, D.NAMAPENGGUNA, A.NOTRANSAKSI, DATE(A.JATUHTEMPO) as JATUHTEMPOHUTANG ,B.TANGGALTRS as TANGGALBAYARHUTANG, IF(DATE(A.JATUHTEMPO) = CURDATE(), 0, DATEDIFF(DATE(A.JATUHTEMPO), CURDATE())) AS RENTANGWAKTU, A.TOTALKREDIT, A.SISAKREDIT, @sisa_hutang := (A.TOTALKREDIT - BAYAR) AS SALDO_HUTANG,  @sisa_hutang AS SISA_HUTANG "
        querykondisi = "C.FK_SUPPLIER, E.NAMASUPPLIER, D.NAMAPENGGUNA, A.NOTRANSAKSI, DATE(A.JATUHTEMPO) as JATUHTEMPOHUTANG , C.TANGGALTRS as TANGGALBELI, IF(DATE(A.JATUHTEMPO) = CURDATE(), 0, DATEDIFF(DATE(A.JATUHTEMPO), CURDATE())) AS RENTANGWAKTU, A.TOTALKREDIT, A.SISAKREDIT "
        kondisiwhere = " AND SISAKREDIT > 0 "
        kondisigroubby = kondisiwhere+" "+kondisihaving+" ORDER BY FK_SUPPLIER ASC, C.TANGGALTRS DESC";
    }else if (KONDISI == "pembayaranhutang"){
        querykondisi = "B.TANGGALTRS, B.WAKTU, B.NOTRANSAKSI, B.TRANSAKSI_ID, B.BAYAR, D.NAMAPENGGUNA, E.NAMASUPPLIER, B.NOTARETURBELI "
        kondisiwhere = " AND (B.TANGGALTRS BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') "
        kondisigroubby = kondisiwhere+ " ORDER BY B.TANGGALTRS DESC, B.WAKTU DESC "+kondisihaving;
        kondisijoin = " LEFT JOIN 01_tms_hutangtoko_detail as B ON A.NOTRANSAKSI = B.TRANSAKSI_ID CROSS JOIN (SELECT @sisa_hutang := 0) AS init "
    }else if (KONDISI == "hutangpersuplier"){
        querykondisi = "A.SUPPLIER_ID, E.NAMASUPPLIER, E.ALAMAT, E.NOTELP,  SUM(A.TOTALKREDIT) as TOTALKREDIT, SUM(A.SISAKREDIT) as TOTALSISAKREDIT, SUM(A.TOTALKREDIT - A.SISAKREDIT) as TOTALTERBAYARKAN"
        kondisiwhere = " "
        kondisigroubby = kondisiwhere+ " GROUP BY A.SUPPLIER_ID "+kondisihaving;
    }
    if (KONDISI == "bukubantuhutang"){
        dataquery = await util.eksekusiQueryPromise(req, "SELECT * FROM "
        +"(SELECT A.FK_SUPPLIER, B.NAMASUPPLIER, NOTA, TANGGALTRS, KETERANGAN, 0 as DEBET, TOTALHUTANG as KREDIT, 'PENAMBAHAN HUTANG' as KONDISI FROM 01_trs_barangmasuk as A JOIN 01_tms_supplier as B ON A.FK_SUPPLIER = B.KODESUPPLIER WHERE TOP = 'KREDIT' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND B.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"'"
        +"UNION ALL "
        +"SELECT A.SUPPLIER_ID, B.NAMASUPPLIER, NOTRANSAKSI, CONCAT(TANGGALTRS,' ',WAKTU), KETERANGAN, BAYAR as DEBIT, 0 as KREDIT, IF(NOTARETURBELI != 'Bukan Potong Hutang', CONCAT('PEMBAYARAN POTONG HUTANG ',NOTARETURBELI),'PEMBAYARAN') as KONDISI FROM 01_tms_hutangtoko_detail  as A JOIN 01_tms_supplier as B ON A.SUPPLIER_ID = B.KODESUPPLIER WHERE A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND B.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"') as ALIAS ORDER BY ALIAS.FK_SUPPLIER" , [], con)
    }else{
        dataquery = await util.eksekusiQueryPromise(req, "SELECT "+querykondisi+" FROM 01_tms_hutangtoko as A "
        +"JOIN 01_trs_barangmasuk as C ON A.NOTRANSAKSI = C.NOTA "
        +"JOIN 01_tms_penggunaaplikasi as D ON A.KASIR_ID = D.PENGGUNA_ID "
        +"JOIN 01_tms_supplier as E ON A.SUPPLIER_ID = E.KODESUPPLIER "
        +kondisijoin
        +"WHERE A.SUPPLIER_ID LIKE ? AND C.TOP LIKE ? AND C.OUTLET = ? AND (B.KODEUNIKMEMBER IS NULL OR B.KODEUNIKMEMBER  = ?) A.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? "+kondisigroubby, ['%'+KODESUPLIER+'%', '%'+CARABAYAR+'%',OUTLET,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER], con)
    }
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            data: dataquery,
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
laporan.formatlaporanpiutang = async function (req, data, con) {
    let PERIODEAWAL = data[0],PERIODEAKHIR = data[1],CARABAYAR = data[2],OUTLET = data[3],IDPELANGGAN = data[4],GROUPELANGGAN = data[5],KONDISI = data[6],KODEUNIKMEMBER = data[7], KONDISIPIUTANG = data[8];
    pesanbalik = [];
    let dataquery,querykondisi = "",kondisigroubby = "",kondisihaving="",kondisiwhere = "", kondisijoin = "";
    if (KONDISI == "piutangberedar"){
        if (KONDISIPIUTANG == "0") kondisihaving = "";
        if (KONDISIPIUTANG == "1") kondisihaving = " HAVING RENTANGWAKTU < 0 ";
        if (KONDISIPIUTANG == "2") kondisihaving = " HAVING RENTANGWAKTU >= 0 ";
        querykondisi = "A.FK_MEMBER, C.NAMA, D.NAMA as NAMAMEMBER, A.PK_NOTAPENJUALAN, CONCAT(DATE(A.TGLKELUAR),' ',A.WAKTU) as TRXKELUAR,F.JATUHTEMPO , (DATEDIFF(DATE(F.JATUHTEMPO), CURDATE())) AS RENTANGWAKTU, C.NAMAPENGGUNA, F.TOTALKREDIT, F.SISAKREDIT "
        kondisiwhere = " AND SISAKREDIT > 0 "
        kondisigroubby = kondisiwhere+" "+kondisihaving+" ORDER BY FK_MEMBER ASC, DATE(A.TGLKELUAR) DESC, A.WAKTU DESC ";
    }else if (KONDISI == "pembayaranpiutang"){
        querykondisi = "CONCAT(B.TANGGALBAYAR,' ',B.WAKTU) as TANGGALTRX, B.NOTRANSAKSI, B.TRANSAKSI_ID, C.NAMAPENGGUNA, D.NAMA as NAMAMEMBER, B.NOTARETUR, B.BAYAR, B.KETERANGAN as KETERANGANRETUR "
        kondisiwhere = " AND (B.TANGGALBAYAR BETWEEN '"+PERIODEAWAL+"' AND '"+PERIODEAKHIR+"') "
        kondisigroubby = kondisiwhere+ " ORDER BY B.TANGGALBAYAR DESC, B.WAKTU DESC "+kondisihaving;
        kondisijoin = " LEFT JOIN 01_tms_piutangkredit_detail as B ON F.TRANSAKSI_ID = B.TRANSAKSI_ID "
    }else if (KONDISI == "piutangmember"){
        querykondisi = "A.FK_MEMBER, D.NAMA as NAMAMEMBER, D.ALAMAT, D.TELEPON, SUM(F.TOTALKREDIT) as TOTALKREDIT, SUM(F.SISAKREDIT) as TOTALSISAKREDIT, SUM(F.TOTALKREDIT - F.SISAKREDIT) as TOTALTERBAYARKAN"
        kondisiwhere = " "
        kondisigroubby = kondisiwhere+ " GROUP BY A.FK_MEMBER "+kondisihaving;
    }
    if (KONDISI == "bukubantupiutang"){
        dataquery = await util.eksekusiQueryPromise(req, "SELECT * FROM ("
        +"SELECT PK_NOTAPENJUALAN as NOTATRANSAKSI, B.MEMBER_ID as KODEMEMBER, B.NAMA as NAMAPELANGGAN, CONCAT(DATE(A.TGLKELUAR),' ',A.WAKTU) as WAKTUTRANSAKSI, A.KETERANGAN as KETERANGAN, 'PENAMBAHAN PIUTANG' as KONDISI, TOTALBELANJA as DEBET, 0 as KREDIT FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B ON A.FK_MEMBER = B.MEMBER_ID WHERE A.ENUM_JENISTRANSAKSI = 'KREDIT' AND A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND B.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' "
        +"UNION ALL "
        +"SELECT NOTRANSAKSI as NOTATRANSAKSI, B.FK_MEMBER as KODEMEMBER, C.NAMA as NAMAPELANGGAN, CONCAT(A.TANGGALBAYAR,' ',A.WAKTU) as WAKTUTRANSAKSI, A.KETERANGAN as KETERANGAN, IF(NOTARETUR != '', CONCAT('PEMBAYARAN PIUTANG HUTANG ',NOTARETUR),'PEMBAYARAN') as KONDISI, 0 as DEBIT, BAYAR as KREDIT FROM 01_tms_piutangkredit_detail as A JOIN 01_trs_barangkeluar as B ON A.TRANSAKSI_ID = B.PK_NOTAPENJUALAN JOIN 01_tms_member as C ON B.FK_MEMBER = C.MEMBER_ID WHERE A.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND B.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' AND C.KODEUNIKMEMBER = '"+KODEUNIKMEMBER+"' ) as ALIAS ORDER BY NAMAPELANGGAN ASC " , [], con)
    }else{
        dataquery = await util.eksekusiQueryPromise(req, "SELECT "+querykondisi+" FROM 01_trs_barangkeluar as A "
        +"JOIN 01_tms_penggunaaplikasi as C ON A.KASIR = C.PENGGUNA_ID "
        +"JOIN 01_tms_member as D ON A.FK_MEMBER = D.MEMBER_ID "
        +"JOIN 01_tms_member_grup as E ON D.GRUP = E.KODEGRUP "
        +"JOIN 01_tms_piutangkredit as F ON A.PK_NOTAPENJUALAN = F.TRANSAKSI_ID "+kondisijoin
        +"WHERE D.GRUP LIKE ? AND F.MEMBER_ID LIKE ? AND ENUM_JENISTRANSAKSI LIKE ? AND A.LOKASI = ? AND A.KODEUNIKMEMBER = ? AND C.KODEUNIKMEMBER = ? AND D.KODEUNIKMEMBER = ? AND E.KODEUNIKMEMBER = ? AND F.KODEUNIKMEMBER = ? "
        +kondisigroubby, ['%'+GROUPELANGGAN+'%', '%'+IDPELANGGAN+'%', '%'+CARABAYAR+'%',OUTLET,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER,KODEUNIKMEMBER], con)
    }
    if (dataquery.length > 0) {
        data = {
            success: "true",
            rc: "200",
            totaldata: dataquery.length,
            data: dataquery,
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
module.exports = laporan;