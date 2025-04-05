let formatter = new Intl.NumberFormat('id-ID', {style: 'currency',currency: 'IDR',});
let detail="",skategori_id="",sdarimenu = "",sprefix ="",spencarian="",jenisprodukterpilih ="";
$(function () {
    panggilnotareturpenjualan();
    loadtokenpascabayar();
    loadduniagame();
    loadpascabayar();
    $('#katakunciprodukatas').prop('readonly', true);
});
function panggilnotareturpenjualan(){
    $.ajax({
        url: baseurljavascript + 'penjualan/notamenupenjualan',
        method: 'POST',
        dataType: 'json',
        data: {
            AWALANOTA : "AC",
            OUTLET: session_outlet,
            KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
            TANGGALSEKARANG: moment().format('YYYYMMDD'),
            KODEUNIKMEMBER: session_kodeunikmember,
        },
        success: function (response) {
            let obj = $.parseJSON(response);
            if (obj.status == "false"){
                Swal.fire(
                    'Pembuatan Nota Error!',
                    obj.msg,
                    'warning'
                ) 
            }
            $('#notabaruacipay').html(obj.nomornota);
        }
    });
}
function ondetailproduk(darimenu,kategori_id,namakategori){
    let pencarianproduknya="";
    detail="yes";
    if (darimenu == "TOKENPRABAYAR"){
        $('#kategorikatakuncitokenprabayar').html(kategori_id);
        $('#filterproduktokenpasca').html('<i class="fas fa-arrow-circle-left"></i> Kembali');
        pencarianproduknya =  $('#katakuncitokenprabayar').val();
        $('#katakuncitokenprabayar').attr("placeholder", "Saring pilihan denom untuk PRODUK "+namakategori+" ini");
    }else if (darimenu == "KATEGORIGAME"){
        $('#kategorikatakunciduniagame').html(kategori_id);
        $('#filterprodukgame').html('<i class="fas fa-arrow-circle-left"></i> Kembali');
        pencarianproduknya =  $('#katakunciduniagame').val();
        $('#katakunciduniagame').attr("placeholder", "Saring pilihan denom untuk PRODUK "+namakategori+" ini");
    }else if (darimenu == "KATEGORIPASCA"){
        $('#kategoripascabayar').html(kategori_id);
        $('#filterkategoripasca').show();
        $('#filterkategoripasca').html('<i class="fas fa-arrow-circle-left"></i> Kembali');
        pencarianproduknya =  $('#katakuncikategoripascabayar').val();
        $('#katakuncikategoripascabayar').attr("placeholder", "Saring pilihan denom untuk PRODUK "+namakategori+" ini");
        $('#katakuncikategoripascabayar').show();
    }
    $.ajax({
        url: baseurljavascript + 'acipay/transaksikedealer',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI : "PRODUK",
            PREFIX : "",
            IDPRODUK : kategori_id,
            PENCARIANPRODUK : pencarianproduknya,
        },
        success: function (response) {
            if (response[0].success == "true"){
                let produk = "";
                for(let a=0;a<response[0].totaldata;a++){
                    produk += "<div class=\"col-md-4 col-sm-12\"><div class=\"rich-list-item flex-column align-items-stretch\"><!-- BEGIN Rich List --><div class=\"rich-list-item p-0\"><div class=\"rich-list-prepend\"><!-- BEGIN Avatar --><div class=\"avatar\"><div class=\"avatar-display\"><img src=\""+(response[0].data[a].IMGURL == "" ? "https://img.icons8.com/ios/452/no-image.png" : response[0].data[a].IMGURL)+"\" alt=\"Avatar image\"></div></div><!-- END Avatar --></div><div class=\"rich-list-content\"><h4 class=\"rich-list-title\">"+response[0].data[a].NAMA_PRODUK+"</h4><span class=\"rich-list-subtitle\">HARGA JUAL "+formatter.format(response[0].data[a].HARGA_UMUM)+"</span></div><div class=\"rich-list-append\"><button onclick=\"transaksiproduk('"+response[0].data[a].NAMA_PRODUK+"','"+response[0].data[a].PRODUK_ID_SERVER+"','"+response[0].data[a].HARGA_UMUM+"','"+response[0].data[a].KETERANGAN+"','"+response[0].data[a].JENISPRODUK+"','"+response[0].data[a].APISERVER_ID+"','"+response[0].data[a].IMGURL+"')\" class=\"btn btn-success\"><i class=\"fas fa-cash-register\"></i>"+(response[0].data[a].JENISPRODUK == "prepaid" ? " Beli Ini" : " Cek" )+"</button></div></div></div></div>";
                }
                if (darimenu == "TOKENPRABAYAR"){
                    $('#kontenprabyartoken').html(produk).addClass("row");
                }else if (darimenu == "KATEGORIGAME"){
                    $('#kontengame').html(produk).addClass("row");
                }else if (darimenu == "KATEGORIPASCA"){
                    $('#kontenpasca').html(produk).addClass("row");
                }
            }
        }
    });
}
function panggilkategori(){
    $('#informasikategoritersedia').html("");
    if ($('#cariproduktransaksi').val().length > 3){
        $.ajax({
            url: baseurljavascript + 'acipay/transaksikedealer',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]: csrfHash,
                KONDISI : "KATEGORI",
                PREFIX : $('#cariproduktransaksi').val(),
            },
            success: function (response) {
                if (response[0].success == "true"){
                    let kategori = "",produk = "";
                    for(let barisawal=0;barisawal<response[0].totaldata;barisawal++){
                        kategori += "<div class=\"col-md-4 col-sm-12 pt-3\"><div class=\"rich-list-item flex-column align-items-stretch\"><!-- BEGIN Rich List --><div class=\"rich-list-item p-0\"><div class=\"rich-list-prepend\"><!-- BEGIN Avatar --><div class=\"avatar\"><div class=\"avatar-display\"><img src=\""+response[0].data[barisawal].urlkategori+"\" alt=\"Avatar image\"></div></div><!-- END Avatar --></div><div class=\"rich-list-content\"><h4 class=\"rich-list-title\">"+response[0].data[barisawal].namakategori+" ["+response[0].data[barisawal].idkategori+"]</h4><span class=\"rich-list-subtitle\">"+response[0].data[barisawal].namaoperator+"</span></div><div class=\"rich-list-append\"><button onclick=\"filterproduk('"+response[0].data[barisawal].idkategori+"')\" class=\"btn btn-label-primary\">Pilih</button></div></div></div></div>";
                        if (barisawal == 0){
                            $('#kategoriidnya').html(response[0].data[barisawal].idkategori);
                            for(let a=0;a<response[0].data[barisawal].totalprodukoperator;a++){
                                produk += "<div class=\"col-md-4 col-sm-12\"><div class=\"rich-list-item flex-column align-items-stretch\"><!-- BEGIN Rich List --><div class=\"rich-list-item p-0\"><div class=\"rich-list-prepend\"><!-- BEGIN Avatar --><div class=\"avatar\"><div class=\"avatar-display\"><img src=\""+(response[0].data[barisawal].produkoperator[a].IMGURL == "" ? "https://img.icons8.com/ios/452/no-image.png" : response[0].data[barisawal].produkoperator[a].IMGURL)+"\" alt=\"Avatar image\"></div></div><!-- END Avatar --></div><div class=\"rich-list-content\"><h4 class=\"rich-list-title\">"+response[0].data[barisawal].produkoperator[a].NAMA_PRODUK+"</h4><span class=\"rich-list-subtitle\">HARGA JUAL "+formatter.format(response[0].data[barisawal].produkoperator[a].HARGA_UMUM)+"</span></div><div class=\"rich-list-append\"><button onclick=\"transaksiproduk('"+response[0].data[barisawal].produkoperator[a].NAMA_PRODUK+"','"+response[0].data[barisawal].produkoperator[a].PRODUK_ID_SERVER+"','"+response[0].data[barisawal].produkoperator[a].HARGA_UMUM+"','"+response[0].data[barisawal].produkoperator[a].KETERANGAN+"','"+response[0].data[barisawal].produkoperator[a].JENISPRODUK+"','"+response[0].data[barisawal].produkoperator[a].APISERVER_ID+"','"+response[0].data[barisawal].produkoperator[a].IMGURL+"')\" class=\"btn btn-success\"><i class=\"fas fa-cash-register\"></i>"+(response[0].data[barisawal].produkoperator[a].JENISPRODUK == "prepaid" ? " Beli Ini" : " Cek" )+"</button></div></div></div></div>";
                            }  
                        }  
                    }
                    $('#informasikategoritersedia').html(kategori).addClass("scrolling-wrapper row flex-row flex-nowrap");
                    $('#informasiproduktersedia').html(produk).addClass("portlet-body row");
                    
                }
            }
        });
    }
}
function panggilproduk(){
    if (sdarimenu == "PRABYARPULSA"){
        $('#informasiproduktersedia').html("");
    }else if (sdarimenu == "PRABYARPULSA"){
        $('#kontenprabyartoken').html("");
    }else if (sdarimenu == "KATEGORIGAME"){
        $('#kontengame').html("");
    }else if (sdarimenu == "KATEGORIPASCA"){
        $('#kontenpasca').html("");
    }
    $.ajax({
        url: baseurljavascript + 'acipay/transaksikedealer',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI : "PRODUK",
            PREFIX : sprefix,
            IDPRODUK : skategori_id,
            PENCARIANPRODUK : spencarian,
        },
        success: function (response) {
            if (response[0].success == "true"){
                let produk = "";
                for(let a=0;a<response[0].totaldata;a++){
                    produk += "<div class=\"col-md-4 col-sm-12\"><div class=\"rich-list-item flex-column align-items-stretch\"><!-- BEGIN Rich List --><div class=\"rich-list-item p-0\"><div class=\"rich-list-prepend\"><!-- BEGIN Avatar --><div class=\"avatar\"><div class=\"avatar-display\"><img src=\""+(response[0].data[a].IMGURL == "" ? "https://img.icons8.com/ios/452/no-image.png" : response[0].data[a].IMGURL)+"\" alt=\"Avatar image\"></div></div><!-- END Avatar --></div><div class=\"rich-list-content\"><h4 class=\"rich-list-title\">"+response[0].data[a].NAMA_PRODUK+"</h4><span class=\"rich-list-subtitle\">HARGA JUAL "+formatter.format(response[0].data[a].HARGA_UMUM)+"</span></div><div class=\"rich-list-append\"><button onclick=\"transaksiproduk('"+response[0].data[a].NAMA_PRODUK+"','"+response[0].data[a].PRODUK_ID_SERVER+"','"+response[0].data[a].HARGA_UMUM+"','"+response[0].data[a].KETERANGAN+"','"+response[0].data[a].JENISPRODUK+"','"+response[0].data[a].APISERVER_ID+"','"+response[0].data[a].JENISPRODUK+"','"+response[0].data[a].IMGURL+"')\" class=\"btn btn-success\"><i class=\"fas fa-cash-register\"></i>"+(response[0].data[a].JENISPRODUK == "prepaid" ? " Beli Ini" : " Cek" )+"</button></div></div></div></div>";
                }
                if (sdarimenu == "PRABYARPULSA"){
                    $('#informasiproduktersedia').html(produk).addClass("portlet-body row");
                }else if (sdarimenu == "TOKENPRABAYAR"){
                    $('#kontenprabyartoken').html(produk).addClass("row");
                }else if (sdarimenu == "KATEGORIGAME"){
                    $('#kontengame').html(produk).addClass("row");
                }else if (sdarimenu == "KATEGORIPASCA"){
                    $('#kontenpasca').html(produk).addClass("row");
                }
            }
        }
    });
}
function loadtokenpascabayar(){
    $('#kontenprabyartoken').html("");
    $.ajax({
        url: baseurljavascript + 'acipay/transaksikedealer',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI : "TOKENPRABAYAR",
            PREFIX : "",
            IDPRODUK : "",
            PENCARIANPRODUK : $('#katakuncitokenprabayar').val()
        },
        success: function (response) {
            if (response[0].success == "true"){
                let produk = "";
                for(let a=0;a<response[0].totaldata;a++){
                    produk += "<div class=\"col-md-4 mb-1 col-sm-12 card-deck\"><!-- BEGIN Card --><div class=\"card\"><img style=\"max-height: 150px\" src=\""+response[0].data[a].IMGURL+"\" class=\"card-img-top\"  alt=\""+response[0].data[a].KATEGORI_NAMA+"\"><div class=\"card-body\"><h5 class=\"card-title\">"+response[0].data[a].KATEGORI_NAMA+"</h5><p class=\"card-text\">"+response[0].data[a].SEODESC+"....</p><button onclick=\"ondetailproduk('TOKENPRABAYAR','"+response[0].data[a].KATEGORI_ID+"','"+response[0].data[a].KATEGORI_NAMA+"')\" class=\"btn float-right btn-primary\">Pilih Denom</button=></div></div></div>";
                }
                $('#kontenprabyartoken').html(produk).addClass("row");
            }
        }
    });
}
function loadduniagame(){
    $('#kontengame').html("");
    $.ajax({
        url: baseurljavascript + 'acipay/transaksikedealer',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI : "KATEGORIGAME",
            PREFIX : "",
            IDPRODUK : $('#kategorigame').html(),
            PENCARIANPRODUK : $('#katakunciduniagame').val(),
        },
        success: function (response) {
            if (response[0].success == "true"){
                let produk = "";
                for(let a=0;a<response[0].totaldata;a++){
                    produk += "<div onclick=\"ondetailproduk('KATEGORIGAME','"+response[0].data[a].KATEGORI_ID+"','"+response[0].data[a].KATEGORI_NAMA+"')\" class=\"card3drgb rgb\"><div class=\"card2\"><img class=\"card3drgb-image\" src=\""+response[0].data[a].IMGURL+"\"></div><div class=\"card3drgb-text card2\"><h5>"+response[0].data[a].KATEGORI_NAMA+"</h5><p>"+response[0].data[a].SEODESC+"</p></div></div>";
                }
                $('#kontengame').html(produk).addClass("row justify-content-center");
                VanillaTilt.init(document.querySelectorAll(".card3drgb"),{glare: true,reverse: true,"max-glare": 0.15});
            }
        }
    });
}
function loadpascabayar(){
    $('#kontenpasca').html("");
    $.ajax({
        url: baseurljavascript + 'acipay/transaksikedealer',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI : "KATEGORIPASCA",
            PREFIX : "",
            IDPRODUK : "",
            PENCARIANPRODUK : "",
        },
        success: function (response) {
            if (response[0].success == "true"){
                let produk = "";
                for(let a=0;a<response[0].totaldata;a++){
                    produk += "<div class=\"row col-md-4 mb-1 col-sm-12 card-deck align-items-start\"><!-- BEGIN Card --><div class=\"card\"><img style=\"max-height: 150px\" src=\""+response[0].data[a].IMGURL+"\" class=\"card-img-top\"  alt=\""+response[0].data[a].KATEGORI_NAMA+"\"><div class=\"card-body\"><h5 class=\"card-title\">"+response[0].data[a].KATEGORI_NAMA+"</h5><p class=\"card-text\">"+response[0].data[a].SEODESC+"....</p><button onclick=\"ondetailproduk('KATEGORIPASCA','"+response[0].data[a].KATEGORI_ID+"','"+response[0].data[a].KATEGORI_NAMA+"')\" class=\"btn float-right btn-primary\">Bayar Tagihan</button></div></div></div>";
                }
                $('#kontenpasca').html(produk).addClass("row justify-content-center");
            }
        }
    });
}
function filterproduk(kategoriid){
    $('#kategoriidnya').html(kategoriid);
    sdarimenu = "PRABYARPULSA";
    skategori_id = $('#kategoriidnya').html();
    panggilproduk();
}
function cektagihanproduk(idserver,idproduk,namaproduk,imgurl){
    if ($('#nomorkontrakpasca').val() == ""){
        return Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'Pastikan NOMOR TUJUAN tidak boleh kosong atau harus sudah diisi untuk disimpan,<br>karena diwajibkan oleh sistem untuk agar dapat dilakukan pengecekan tagihan',
            showConfirmButton: false,
            toast:true,
            timer: 2000
        });
    }
    $.blockUI({message:"Sedang mengecek tagihan "+namaproduk+" slur. Tunggu yaa..."});
    $.ajax({
        [csrfName]: csrfHash,
        url: baseurljavascript + 'acipay/transaksikedealer',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI:"CEKTAGIHAN",
            IDSERVER: idserver,
            SKUKODE: idproduk,
            TUJUAN:$('#nomorkontrakpasca').val(),
            REFID:$('#notabaruacipay').html(),
        },
        success: function (response) {
            if (response[0].data.status.toLowerCase() == "gagal"){
                $.unblockUI();
                return Swal.fire(
                    "Informasi Tidak Ditemukan",
                    "Data tidak ditemukan pada server kami. NO TUJUAN "+$("#notujuan").val()+" pastikan benar. <strong>Ada kemungkinan jika NO TUJUAN benar, mungkin tagihan tersebut SUDAH TERBAYARKAN pada sistem lain</strong>. Silahkan konfirmasi kepada BILLER tujuan anda. TERIMA KASIH",
                    "error"
                )
            }
            $("#logobayarpasca").attr("src",imgurl);
            $('#nomorcustomer').html($('#nomorkontrakpasca').val());
            $('#atasnamapasca').html(response[0].data.customer_name);
            $('.totaltagihanpasca').html(formatuang(response[0].data.selling_price,'id-ID','IDR'));
            $('#adminbankpasca').html(formatuang(response[0].data.admin,'id-ID','IDR'));
            $('#kodeproduk').html(idproduk);
            $('#namaprodukpasca').html(namaproduk);
            $('#muncultagihannya').modal({backdrop: 'static', keyboard: false});
            $.unblockUI();
        }
    });
}
function transaksiproduk(namaproduk, idproduk, hargaproduk,keterangan,jenisproduk,idserver,imgurl){
    if (idproduk.substring(0, 4) == "PLND"){
        $('#ceknomortujuan').show();
    }else{
        $('#ceknomortujuan').hide();
    }
    $('#notujuan').val($('#cariproduktransaksi').val());
    $('#judulmodal').html(namaproduk);
    $('#idservertujuan').html(idserver);
    $('#kodeproduknya').html(idproduk);
    $('#keteranganproduk').html(keterangan);
    $('#jenisproduknya').html(jenisproduk);
    jenisprodukterpilih = jenisproduk;
    if (jenisproduk == "prepaid"){
        $('#hargajualkepelanggan').prop('readonly', false);
        $('#hargabeli').html(formatter.format(hargaproduk));
        $("#modaltransaksi").modal('show');
    }else{
        $('#hargajualkepelanggan').prop('readonly', true);
        $('#hargabeli').html(formatter.format(0));
        cektagihanproduk(idserver,idproduk,namaproduk,imgurl)
    }
}
$('#cariproduktransaksi').on('input', debounce(function (e) {
    if ($('#cariproduktransaksi').val().length > 3){
        $('#katakunciprodukatas').prop('readonly', false);
    }else{
        $('#katakunciprodukatas').prop('readonly', true);
        $('#informasikategoritersedia').html("");
        $('#informasiproduktersedia').html("");
    }
    panggilkategori();
}, 500));
$('#katakunciprodukatas').on('input', debounce(function (e) {
    sdarimenu = "PRABYARPULSA";
    skategori_id = $('#kategoriidnya').html();
    sprefix = $('#cariproduktransaksi').val();
    spencarian = $('#katakunciprodukatas').val();
    panggilproduk();
}, 500));
$('#katakuncitokenprabayar').on('input', debounce(function (e) {
    if (detail == "yes"){
        sdarimenu = "TOKENPRABAYAR";
        skategori_id = $('#kategorikatakuncitokenprabayar').html();
        sprefix = "";
        spencarian = $('#katakuncitokenprabayar').val();
        panggilproduk();
    }else{
        loadtokenpascabayar();
    }
}, 500));
$('#katakunciduniagame').on('input', debounce(function (e) {
    if (detail == "yes"){
        sdarimenu = "KATEGORIGAME";
        skategori_id = $('#kategorikatakunciduniagame').html();
        sprefix = "";
        spencarian = $('#katakunciduniagame').val();
        panggilproduk();
    }else{
        loadduniagame();
    }
}, 500));
$('#katakuncikategoripascabayar').on('input', debounce(function (e) {
    if (detail == "yes"){
        sdarimenu = "KATEGORIPASCA";
        skategori_id = $('#kategoripascabayar').html();
        sprefix = "";
        spencarian = $('#katakuncikategoripascabayar').val();
        panggilproduk();
    }
}, 500));
$("#transaksiacipaybro").click(function () {
    if ($("#notujuan").val() == "" || $("#pintrx").val() == ""){
        return Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'Pastikan NOMOR TUJUAN DAN PIN TRX tidak boleh kosong atau <br>harus sudah diisi untuk disimpan, karena diwajibkan oleh sistem',
            showConfirmButton: false,
            toast:true,
            timer: 1500
        });
    }
    $('#modaltransaksi').block();
    $.ajax({
        [csrfName]: csrfHash,
        url: baseurljavascript + 'acipay/transaksikedealer',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI:"FIXTRX",
            IDSERVER:$('#idservertujuan').html(),
            TRANSKASI_ID:$('#notabaruacipay').html(),
            ANTRIAN_ID:"",
            TAGIHAN:"",
            KODEPRODUK:$('#kodeproduknya').html(),
            NAMA_PRODUK:$('#judulmodal').html(),
            HARGA_BELI:"",/*dari callback baacken */
            HARGA_KEAGEN:(Number($('#hargabeli').html().replace(/\D/g, '')) / 100),
            HARGA_JUALKEPELANGGAN:$('#hargajualkepelanggan').val(),
            KOMISI:"",
            TUJUAN:$('#notujuan').val(),
            NOMORPELANGGAN:"", /* digunakan untuk notifkenomor sms gateway atau whatsaap gateway*/
            KETERANGAN:"Tidak ada keterangan",
            PENGIRIM:$('#ipaddresspublic').html(),
            STATUSTRX:0,
            AGEN:session_namapengguna,
            VIA:"DIRECT",
            PEMBAYARAN:"SALDO",
            JENIS_TRANSAKSI:jenisprodukterpilih,
            PERULANGAN:1,
            SALDO_SEBELUM:(Number($('#saldomembersekarang').html().replace(/\D/g, '')) / 100),
            SALDO_SESUDAH:(Number($('#saldomembersekarang').html().replace(/\D/g, '')) / 100) - (Number($('#hargabeli').html().replace(/\D/g, '')) / 100),
            NOMORNOTA:$('#notabaruacipay').html().split('#')[1],
            LOKASI:session_outlet,
            KODEUNIKMEMBER:session_kodeunikmember,
            SESSIONKODE:$('#sessionkode').html(),
            SATPAMTRX:$('#pintrx').val(),
        },
        success: function (response) {
            let pesan = "";
            if (response[0].success == "false"){
                pesan ='<h5>Haduh.. Transaksi gagal dilakukan.'+"Transaksi dengan TUJUAN : "+$('#notujuan').val()+"<br>STATUS : "+response[0].msg
            }else{
                pesan ='<h5>Yeyy.. Transaksi berhasil dilakukan.'+"Transaksi dengan TUJUAN : "+$('#notujuan').val()+"<br>STATUS : "+response[0].msg
            }
            Swal.fire({
                title: 'INFROMASI TRANSKASI!!',
                icon: response[0].success == "true" ? 'info' : 'error',
                html: pesan+'</h5><button type="button" class="btn btn-info btn-yes btn-yes-sbmt-rqst">CEK STATUS TRX</button> <button type="button" class="btn btn-info btn-no swl-cstm-btn-no-jst-prceed">TRANSAKSI LAGI</button> <button type="button" class="btn btn-warning btn-cancel swl-cstm-btn-cancel">BERIKAN ULASAN</button>',
                showCancelButton: false,
                showConfirmButton: false,
                showCloseButton: true,
                onBeforeOpen: () => {
                    const yes = document.querySelector('.btn-yes')
                    const no = document.querySelector('.btn-no')
                    const cancel = document.querySelector('.btn-cancel')
                        yes.addEventListener('click', () => {
                            
                        })
                        no.addEventListener('click', () => {
                            Swal.close();
                            $('#modaltransaksi').modal('toggle');
                        })
                        cancel.addEventListener('click', () => {
                            
                        })
                    }
                })
            $('#modaltransaksi').unblock();
            panggilnotareturpenjualan();
        }
    });
});
$("#ceknomortujuan").click(function () {
    if ($("#notujuan").val() == "" || $("#pintrx").val() == ""){
        return Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'Pastikan NOMOR TUJUAN DAN PIN TRX tidak boleh kosong atau <br>harus sudah diisi untuk disimpan, karena diwajibkan oleh sistem',
            showConfirmButton: false,
            toast:true,
            timer: 1500
        });
    }
    $('#modaltransaksi').block();
    $.ajax({
        [csrfName]: csrfHash,
        url: baseurljavascript + 'acipay/transaksikedealer',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI:"CEKID",
            CMD: "pln-subscribe",
            TUJUAN: $("#notujuan").val(),
            IDSERVER: $('#idservertujuan').html(),
        },
        success: function (response) {
            if (response[0].data.meter_no == ""){
                Swal.fire(
                    "Informasi Tidak Ditemukan",
                    "Data tidak ditemukan pada server kami. NO TUJUAN "+$("#notujuan").val()+" pastikan benar. Jika anda merasa benar mungkin data tersebut belum tercatat pada sistem kami atau silahkan hubungi CS kami jika memerlukan informasi tambahan. TERIMA KASIH",
                    "error"
                );
            }else{
                let pesantambahan = "";
                if ($("#notujuan").val() != response[0].data.meter_no){
                    pesantambahan = "Ehh.. sebentardeh, data ditemukan sih, tapi apa gak typo sedikit anda ?. Mungkin maksud anda <strong>"+response[0].data.meter_no+"</strong>";
                }
                Swal.fire({
                    icon: 'success',
                    html: '<h2>INFORMASI TOKEN PLN ANDA DITEMUKAN</h2>'+pesantambahan+'. Nama Pelanggan : <strong>'+response[0].data.name+"</strong> dengan SEGEMENT POWER <strong>"+response[0].data.segment_power+"</strong><br>Nomor Meter :<strong>"+response[0].data.meter_no+"</strong><br>ID Pelanggan :<strong>"+response[0].data.subscriber_id+"</strong>",
                    showConfirmButton: true,
                });
            }
            $('#modaltransaksi').unblock();
        }
    });
});
$("#filterproduktokenpasca").click(function () {
    if (detail == "yes"){
        $('#kategorikatakuncitokenprabayar').html('');
        $('#katakuncitokenprabayar').val('');
        $('#filterproduktokenpasca').html('<i class="fas fa-search"></i> Cari');
        $('#katakuncitokenprabayar').attr("placeholder", "Masukan nama TOKEN / E-MONEY yang ada inginkan");
        detail == "no";
        loadtokenpascabayar();
    }
});
$("#filterprodukgame").click(function () {
    if (detail == "yes"){
        $('#kategorikatakunciduniagame').html('');
        $('#katakunciduniagame').val('');
        $('#filterprodukgame').html('<i class="fas fa-search"></i> Cari');
        $('#katakunciduniagame').attr("placeholder", "Masukkan nama permainan yang anda inginkan");
        detail == "no";
        loadduniagame();
    }
});
$("#filterkategoripasca").click(function () {
    if (detail == "yes"){
        $('#kategoripascabayar').html('');
        $('#katakuncikategoripascabayar').val('');
        $('#filterkategoripasca').hide();
        $('#katakuncikategoripascabayar').hide();
        detail == "no";
        loadpascabayar();
    }
});
