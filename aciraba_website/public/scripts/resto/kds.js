
function detailevent(info){
    let htmlnya = "",namavariannya = "";
    $("#penjelasan").html(info.event.id)
    $("#namapemesan").html(info.event.title)
    var mySubString = info.event.title.substring(
        info.event.title.indexOf("[") + 1, 
        info.event.title.lastIndexOf("]")
    );
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'resto/panggildetailmakanan',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KODEPESANAN : mySubString,
            },
            success: function (response) {
                if (response.success == "true"){
                    $("#namapemesan").html(info.event.title);
                    $("#kodeai").html(response.dataquery[0].KODEAI)
                    htmlnya = "";
                    for (let i = 0; i < response.totaldata; i++) {
                    let objjsonStrjenisvarian = JSON.parse(atob(response.dataquery[i].JSONTAMBAHAN));
                    Object.entries(objjsonStrjenisvarian).forEach(([key, value]) => {
                        value.forEach((variandetail) => {
                            namavariannya += variandetail.namavarian+" ("+variandetail.qty+"x) , "
                        })
                    })
                    htmlnya += ""
                        +"<div class=\"portlet mb-2 ml-2 mr-2\">"
                            +"<div class=\"portlet-body\">"
                                +"<div class=\"widget5\">"
                                    +"<h4 style=\"font-size:150%;color:red\" class=\"widget5-title\">Nama Item : "+response.dataquery[i].NAMABARANG+"</h4>"
                                    +"<div class=\"widget5-group\">"
                                        +"<div class=\"widget5-item\">"
                                            +"<span class=\"widget5-info\">VARIAN : "+namavariannya+"</span>"
                                        +"</div>"
                                    +"</div>"
                                    +"<div class=\"widget5-group\">"
                                        +"<div class=\"widget5-item\">"
                                            +"<span class=\"widget5-info\">KETERANGAN : "+response.dataquery[i].CATATANPERBARANG+"</span>"
                                        +"</div>"
                                    +"</div>"
                                +" </div>"
                            +"</div>"
                        +"</div>"
                    }    
                    $("#detailitemfullcalendar").html("");
                    $("#detailitemfullcalendar").append(htmlnya);
                    $('#modaldetailcalendar').modal('show'); 
                }else{
                    Swal.fire({
                        title: "Gagal Menggambil Galat ",
                        text: response.msg,
                        icon: 'error',
                    });
                }
            }
        });
    });
}
function panggillantai(){
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'resto/ajaxpanggillantai',
        method: 'POST',
        dataType: 'json',
        data: {
            [csrfName]:csrfTokenGlobal,
        },
        success: function (response) {
            if (response.success == "true"){
                let htmlnya = "";
                htmlnya = "<div class=\"nav nav-lines portlet-nav\" id=\"portlet1-tab\">";
                for (let i = 0; i < response.totaldata; i++) {
                    if (i == 0){
                        panggilmeja(response.dataquery[i].LANTAI,$("#kontendaftarmeja").attr('id'),'reserv')
                    }
                    htmlnya += "<a class=\"nav-item nav-link\" onclick=\"panggilmeja('"+response.dataquery[i].LANTAI+"',"+$("#kontendaftarmeja").attr('id')+",'reserv')\" id=\"portlet1-home-tab\" data-toggle=\"tab\" href=\"javascript:void(0)\">"+response.dataquery[i].LANTAI+"</a>";
                }    
                htmlnya += "</div>";
                $('#daftarlantaitersedia').html("");
                $('#daftarlantaitersedia').html(htmlnya);
            }else{
                Swal.fire({
                    title: "Gagal... Membaca Database",
                    text: "Silahkan cek log database anda. Kali aja ada yang typo dalam penulisan QUERY",
                    icon: 'error',
                });
            }
        },
        error: function(xhr, status, error) {
            toastr["error"](xhr.responseJSON.message);
        }
    });
});
}
function detailmeja(){
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'penyesuaian/hapusperbarang',
        method: 'POST',
        dataType: 'json',
        data: {
            [csrfName]:csrfTokenGlobal,
            KODEBARANG: kodebarang,
        },
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.status == "true"){
                $('#keranjangopname').DataTable().ajax.reload();
            }else{
                Swal.fire({
                    title: "Gagal... Cek Koneksi Local DB Kasir",
                    text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
                    icon: 'warning',
                });
            }
        },
        error: function(xhr, status, error) {
            toastr["error"](xhr.responseJSON.message);
        }
    });
});
}
function hapusinformasimeja(kodemeja,namameja, lantai){
    swal.fire({
        title: "Apakah Yakin ?",
        text: "Apakah yakin ingin menghapus informasi MEJA dengan KODE "+namameja+" ["+kodemeja+"], jika iya informasi mengenai meja ini akan dihapus seperti jadwal BOOKING dll.",
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Hapus Ini!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'resto/hapusinformasimeja',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        KODEMEJA: kodemeja,
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            panggilmeja(lantai)
                        }else{
                            Swal.fire({
                                title: "Oopss. Tunggu Sebenatar",
                                text: "Informasi data tidak ditemukan atau terhapus",
                                icon: 'warning',
                            });
                        }
                    }
                });
            });
        }
    })
}
function detailpesanan(kodemeja,prosesdari){
getCsrfTokenCallback(function() {
    $("#tabel_pesanananmeja").DataTable({
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
        },
        scrollCollapse: true,
        scrollY: "100vh",
        scrollX: true,
        bFilter: true,
        destroy: true,
        ajax: {
            "url": baseurljavascript + 'resto/ajaxdetailpesanan',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.KODEMEJA = kodemeja;
                d.PROSESDARI = prosesdari;
            },
        }
    });
});
$('#modaldetailmeja').modal('show'); 
}
function batalkanpesanantempat(prosesdari,kodepesanantempat,pemesan,tanggal){
    swal.fire({
        title: "Hmmm.. Pembatalan Kode Pesan : "+kodepesanantempat+" ?",
        text: "Yahh.. yakin nih mau dibatalkan pemesanan tempatnya TANGGAL "+tanggal+". Tidak diarahkan telebih dahulu gitu customernya dengan NAMA : "+pemesan+" ?",
        icon:"question",
        showCancelButton:true,
        confirmButtonText: "Ok.. Saya Yakin",
        cancelButtonText: "Ooops.. Gak Jadi!!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'resto/updatestatuspemesanan',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        PROSESDARI : prosesdari,
                        KODEMEJA : kodepesanantempat,
                    },
                    success: function (response) {
                        $('#tabel_pesanananmeja').DataTable().ajax.reload();
                        Swal.fire({
                            title: "Pembatalan Berhasil",
                            text: "Pemesan dengan NAMA : "+pemesan+" telah dibatalkan oleh SISTEM. Batas waktu kursi pada TANGGAL "+tanggal+" telah berkurang dan dapat digunakan disi oleh pemesan lain",
                            icon: 'success',
                        });
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
        }
    })
}

function modalubahdatameja(namameja, kodemeja, keterangan, namalantai, waktuawal, waktuakhir, urlgambar){
    if (kodemeja == "new"){$("#kodemeja").attr("readonly", false);$('#photoexample').attr('src','https://i.ibb.co/d6FsfBx/arti-reservasi-jenis-jenis-manfaat-leng-867483.jpg');}
    else{$("#kodemeja").attr("readonly", true);$('#photoexample').attr('src',urlgambar);}
    $('#namamejaspan').html(namameja); 
    $('#kodemejaspan').html((kodemeja == "new" ? "BARU" : kodemeja)); 
    $("#kodemeja").val((kodemeja == "new" ? "" : kodemeja)); 
    $("#namameja").val(namameja);
    $("#urlgambar").val(urlgambar);
    $("#keteranganmeja").val(keterangan);
    $("#lokasilantai").val(namalantai);
    $("#waktuaktif").val(moment(waktuawal, 'HH:mm:ss').format('HH:mm'));
    $("#waktuakhir").val(moment(waktuakhir, 'HH:mm:ss').format('HH:mm'));
    $('#modalinformasimeja').modal('show'); 
}
function simpaninformasimeja(){
    kondisi = 1;
    if ( $('input').is('[readonly]') ) { 
        kondisi = 0;
    }
    swal.fire({
        title: (kondisi == 1 ? "Apakah anda ingin menambah INFORMASI MEJA" : "Ubah informasi meja terpilih"  ),
        text: (kondisi == 1 ? "Informasi meja akan ditambahkan sesuai formulir. Anda dapat mengubahnya nanti pada fitur ubah INFORMASI MEJA" : "Apakah anda merubah informasi meja " +$("#namameja").val()+" pada lantai "+$("#lokasilantai").val()+", dengan keterangan "+$("#keteranganmeja").val()),
        icon:"question",
        showCancelButton:true,
        confirmButtonText: (kondisi == 1 ? "Tambahkan Informasi" : "Ubah Informasi"),
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'resto/simpaninformasimeja',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        KODEMEJA: $("#kodemeja").val(),
                        NAMAMEJA: $("#namameja").val(),
                        GAMBAR: $("#urlgambar").val(),
                        KETERANGAN: $("#keteranganmeja").val(),
                        LANTAI: $("#lokasilantai").val(),
                        JAMBUKA: $("#waktuaktif").val(),
                        JAMTUTUP: $("#waktuakhir").val(),
                        ISEDIT: kondisi,
                    },
                    success: function (response) {
                        if (response.success == "true"){    
                            panggilmeja($("#lokasilantai").val())                    
                            swal.fire({
                                title: "Informasi Meja Berhasil Disimpan",
                                text: "Hore... informasi meja sudah siap dipesankan oleh pelanggan tercinta. Apakah anda ingin menambahkan informasi meja lagi ? ",
                                icon: "success",
                                showCancelButton:true,
                                confirmButtonText: "Oke, Tambah Lagi!",
                                cancelButtonText: "Gak Jadi Ah!",
                            }).then(function(result){
                                bersihkanmodalinformasimeja()
                                if(result.isConfirmed){}else{$('#modalinformasimeja').modal('hide'); }
                            })
                        }else{
                            Swal.fire({
                                title: "Oopss. Tunggu Sebenatar",
                                text: response.msg,
                                icon: 'error',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
        }
    })
}
function cetakulangnota(){
    let kodeai = $("#kodeai").html()
    let nomortransaksi = $("#namapemesan").html().substring(
        $("#namapemesan").html().indexOf("[") + 1, 
        $("#namapemesan").html().lastIndexOf("]")
    );
    let keranjangarray = [],inforkartubarang = []
    swal.fire({
        title: "Wow... Cetak Nota Pesanan ?",
        icon: 'question',
        text: "Apakah anda ingin mencatak ulang nota dengan KODEPESAN "+nomortransaksi+" ini ?",
        showCancelButton:true,
        confirmButtonText: "Cetak Nota ini",
        cancelButtonText: "Skip. Tidak cetak nota!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/cetakulangtransaksikasir',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        KODEAI : kodeai,
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            let namavariannya = "";
                            for (let i = 0; i < response.totaldata; i++) {
                                Object.keys(response.dataquery[i]).forEach(function(k){
                                    if (k == "NAMABARANG" || k == "HARGAJUAL") inforkartubarang.push(response.dataquery[i][k])
                                    if (k == "PRINCIPAL_ID") inforkartubarang.push((response.dataquery[i]["HARGAJUAL"] * response.dataquery[i]["STOKBARANGKELUAR"]))
                                    if (k == "DARIPERUSAHAAN" || k == "FK_BARANG" || k == "STOKBARANGKELUAR") inforkartubarang.push(response.dataquery[i][k])
                                    if (k == "CATATANPERBARANG") inforkartubarang.push(response.dataquery[i][k])
                                    if (k == "JSONTAMBAHAN"){
                                        let objjsonStrjenisvarian = JSON.parse(atob(response.dataquery[i].JSONTAMBAHAN));
                                        Object.entries(objjsonStrjenisvarian).forEach(([key, value]) => {
                                            value.forEach((variandetail) => {
                                                namavariannya += variandetail.namavarian+" ("+variandetail.qty+"x) , "
                                            })
                                        })
                                        inforkartubarang.push(namavariannya)
                                    }
                                    
                                });
                                keranjangarray.push(inforkartubarang)
                                inforkartubarang = []
                            }
                            getCsrfTokenCallback(function() {
                                $.ajax({
                                    url: baseurljavascript + 'penjualan/cetaknotapesanan',
                                    method: 'POST',
                                    dataType: 'json',
                                    data: {
                                        [csrfName]:csrfTokenGlobal,
                                        INFORMASIBARANG : JSON.stringify(keranjangarray),
                                        NOTAPENJUALAN : response.dataquery[0].PK_NOTAPENJUALAN,
                                        NAMAMEMBER : response.dataquery[0].NAMAMEMBER,
                                        NAMASALESMAN : response.dataquery[0].NAMASALESMAN,
                                        TGLKELUAR : moment(response.dataquery[0].TGLKELUAR).format('DD-MM-YYYY'),
                                        WAKTU : response.dataquery[0].WAKTU,
                                        KETERANGAN : response.dataquery[0].KETERANGANTRX,
                                        NOMINALTUNAI : response.dataquery[0].NOMINALTUNAI,
                                        NOMINALKREDIT : response.dataquery[0].NOMINALKREDIT,
                                        NOMINALKARTUDEBIT : response.dataquery[0].NOMINALKARTUDEBIT,
                                        NOMORKARTUDEBIT :  response.dataquery[0].NOMORKARTUDEBIT,
                                        BANKDEBIT :  response.dataquery[0].BANKDEBIT,
                                        NOMINALKARTUKREDIT :  response.dataquery[0].NOMINALKARTUKREDIT,
                                        NOMORKARTUKREDIT :  response.dataquery[0].NOMORKARTUKREDIT,
                                        BANKKREDIT :  response.dataquery[0].BANKKREDIT,
                                        NOMINALEMONEY :  response.dataquery[0].NOMINALEMONEY,
                                        NAMAEMONEY :  response.dataquery[0].NAMAEMONEY,
                                        NOMINALPOTONGAN :  response.dataquery[0].NOMINALPOTONGAN,
                                        NOMINALPAJAKKELUAR :  response.dataquery[0].NOMINALPAJAKKELUAR,
                                        KEMBALIAN:  response.dataquery[0].KEMBALIAN,
                                        TOTALBELANJA:  response.dataquery[0].TOTALBELANJA,
                                        PAJAKTOKO :  response.dataquery[0].PAJAKTOKO,
                                        PAJAKNEGARA :  response.dataquery[0].PAJAKNEGARA,
                                        POTONGANGLOBAL :  response.dataquery[0].POTONGANGLOBAL,
                                        NOMINALBAYAR:  response.dataquery[0].TOTALBELANJA + response.dataquery[0].KEMBALIAN,
                                        NAMAPENGGUNA :  response.dataquery[0].USERNAMELOGIN,
                                    },
                                    success: function (response) {},
                                    error: function(xhr, status, error) {
                                        toastr["error"](xhr.responseJSON.message);
                                    }
                                });
                            });
                            }
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
        }
    })   
}
$("#cetakpesanan").on("click", function() {
    cetakulangnota();
});