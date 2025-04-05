let statusmember = 1,jsonStrMenuAkses, ha = [], statusupdate = 0;
function getLocation(){
    $("#latlong").val("Mohon tunggu, sedang mencoba mendapatkan lokasi")
    navigator.geolocation.getCurrentPosition(function(data){
        $("#latlong").val(data.coords.latitude+","+data.coords.longitude)
        $("#buttonlatlong").hide();
    })
}
function loadidmember(){
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'penjualan/notamenupenjualan',
        method: 'POST',
        dataType: 'json',
        data: {
            [csrfName]:csrfTokenGlobal,
            AWALANOTA : "MBM",
            OUTLET: session_outlet,
            KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
            TANGGALSEKARANG: moment().format('YYYYMMDD'),
            KODEUNIKMEMBER: session_kodeunikmember,
        },
        success: function (response) {
            $('#idpegawai').val(response.nomornota)
        },
        error: function(xhr, status, error) {
            toastr["error"](xhr.responseJSON.message);
        }
    });
});
}
$("#bersihkan").on("click", function(){
    bersihkanform()
});
$("#simpanpenggunamerchant").on("click", function(){
    if ($("#idpegawai").val() == "" || $("#namadepan").val() == "" || $("#namabelakang").val() == "" || $("#alamat").val() == "" || $("#notelp").val() == "" || $("#username").val() == "" || $("#password").val() == "" || $("#pintrx").val() == "" || $("#latlong").val() == "" || $("#keterangan").val() == "" || $("#emailaktif").val() == "" || $("#kodeunikmember").val() == "" || $("#statuspegawai").val() == ""){
        if (statusupdate == 0){
            return Swal.fire({
                icon: 'error',
                html: 'Silahkan lengkapi semua formulir <br>yang disajikan secara <strong>AKURAT dan TEPAT</strong><br>karena dibutuhkan untuk verifikasi MERCHANT',
                toast: true,
                showConfirmButton: false,
                timer: 1500,
                position: 'top-end',
            });
        }
    }
    Swal.fire({
        title: "Simpam Informasi",
        text: "Apakah anda ingin menyimpan INFORMASI "+$("#namadepan").val()+" "+$("#namabelakang").val()+" dengan ID "+$("#idpegawai").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke.. Kirim Informasi'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#simpanpenggunamerchant').prop("disabled",true);
            $('#simpanpenggunamerchant').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'masterdata/simpanpegawai',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        PENGGUNA_ID : $('#idpegawai').val(),
                        NAMA: $('#namadepan').val()+"::"+$('#namabelakang').val(),
                        NAMAPENGGUNA: $('#username').val(),
                        PASSWORD: $('#password').val(),
                        KODEUNIKMEMBER: $('#kodeunikmember').val(),
                        URLFOTO : $('#urlfoto').val(),
                        ALAMAT : $('#alamat').val(),
                        NOTELP: $('#notelp').val(),
                        NOREKENING: "",
                        KETERANGAN: $('#keterangan').val(),
                        TOTALDEPOSIT: "0",
                        IDHAKAKSES : $('#statuspegawai').val(),
                        PIN: $('#pintrx').val(),
                        LATLONG: $('#latlong').val(),
                        NAMAOUTLET: $('#namaoutlet').val(),
                        EMAIL: $('#emailaktif').val(),
                        TOKENKEY:Math.random(),
                        STATUSAKTIF:0,
                        NOMOR: $('#idpegawai').val().split('#')[1],
                        STATUSUPDATE: statusupdate,
                    },
                    complete:function(){
                        $('#simpanpenggunamerchant').prop("disabled",false);
                        $('#simpanpenggunamerchant').html('Simpan Informasi');
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            Swal.fire({
                                title: "Berhasil Horeee!!!",
                                html: response.msg,
                                icon: 'success',
                            });
                            bersihkanform()
                            loaddaftarpewagawai() 
                        }else{
                            Swal.fire({
                                title: "Gagal... Uhhh",
                                html: response.msg,
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
    });
});
function bersihkanform(){
    statusupdate = 0
    $('#idpegawai').val("")
    $('#namadepan').val("")
    $('#namabelakang').val("")
    $('#username').val("")
    $('#password').val("")
    $('#urlfoto').val("")
    $('#alamat').val("")
    $('#notelp').val("")
    $('#keterangan').val("")
    $('#statuspegawai').val("")
    $('#pintrx').val("")
    $('#latlong').val("")
    $('#namaoutlet').val("")
    $('#emailaktif').val("")
    $('#statuspegawai').val(null).trigger('change');
    $("#password").prop('readonly', false)
    $("#pintrx").prop('readonly', false)
    $("#keterangantabpengguna").html("Tambah Pegawai / Rekanan")
    loadidmember()
}
$("#pencarianpenggunaha").on('input keypress keydown', debounce(function(e) {
    $("#daftarpegawai").html("")
    loaddaftarpewagawai()
}, 500))
function loaddaftarpewagawai(){
    $("#daftarpegawai").html(loadingAnimation());
    let daftarpegawai = "";
    getCsrfTokenCallback(function() {
        $.ajax({
            url:baseurljavascript+'auth/daftarpegawai',
            type:'POST',
            dataType:'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                PENCARIAN: $("#pencarianpenggunaha").val(),
            },
            success:function(response){
                if (response.jumlahdata > 0){
                    daftarpegawai = "<section class=\"container\"><div class=\"row active-with-click\">";
                    for (let i = 0; i < response.jumlahdata; i++) {
                    if (response.data[i].STATUSAKTIF == 1) colorCSS = "Blue"
                    if (response.data[i].STATUSAKTIF == 0) colorCSS = "Red"
                    daftarpegawai +=
                        "<div class=\"col-md-4 col-sm-6 col-xs-12\">" +
                        "<article id=\"artikelid"+response.data[i].AI_PENGGUNA+"\" class=\"material-card "+colorCSS+"\">" +
                        "<h2><span>NAMA PENGGUNA : " + response.data[i].NAMAPENGGUNA + "</span><strong><i class=\"fa fa-fw fa-star\"></i> STATUS JABATAN : " + response.data[i].HAKAKSESID +" ["+ response.data[i].NAMAHAKAKSES+ "]</strong></h2>" +
                        "<div class=\"mc-content\">" +
                        "<div class=\"img-container \">" +
                        (response.data[i].URLFOTO == "" ? "<img class=\"img-responsive img-thumbnail\" src=\"https://sm.ign.com/ign_ap/cover/a/avatar-gen/avatar-generations_hugw.jpg\">" : "<div class=\"image-container\"><img class=\"img-responsive img-thumbnail\" src=\"" + response.data[i].URLFOTO + "\" style=\"width: 100%; height: 100%; object-fit: cover;\"></div>") +
                        "</div>" +
                        "<div style=\"font-family: 'Irish Grover', cursive;\" class=\"mc-description\">" +
                        "<h4>NAMA : "+response.data[i].NAMA+"</h4>" +
                        "<h4>DARI TOKO : "+response.data[i].NAMAOUTLET+"</h4>" +
                        "<h4>NAMA PENGGUNA : "+response.data[i].NAMAPENGGUNA+"</h4>" +
                        "<h4>TENANT ID : "+response.data[i].KODEUNIKMEMBER+"</h4>" +
                        "<h4>KONTAK PERSON : "+response.data[i].ALAMAT+" ["+response.data[i].NOTELP+"]</h4>" +
                        "<h4>E-MAIL : "+response.data[i].EMAIL+"</h4>" +
                        "<h4>NO REKEING : "+response.data[i].NOREKENING+"</h4>" +
                        "<h4>KETERANGAN : "+response.data[i].KETERANGAN+"</h4>" +
                        "</div>" +
                        "</div>" +
                        "<a class=\"mc-btn-action\"><i class=\"fa fa-bars\" style=\"color:white\"></i></a>" +
                        "<div class=\"mc-footer\">" +
                        "<div class=\"btn-group btn-group-lg mb-2\">" +
                        "<button onclick=\"statuspengguna('0','"+response.data[i].PENGGUNA_ID+"','"+response.data[i].NAMA+"','"+response.data[i].NAMAOUTLET+"','"+response.data[i].AI_PENGGUNA+"')\" class=\"btn btn-danger\"> Block </button>" +
                        "<button onclick=\"statuspengguna('1','"+response.data[i].PENGGUNA_ID+"','"+response.data[i].NAMA+"','"+response.data[i].NAMAOUTLET+"','"+response.data[i].AI_PENGGUNA+"')\" class=\"btn btn-success\"> Aktifkan </button>" +
                        "<button onclick=\"ubahinformasipenggunaaplikasi('"+response.data[i].PENGGUNA_ID+"','"+response.data[i].NAMA+"')\" class=\"btn btn-primary\"> Ubah Informasi </button>" +
                        "<button onclick=\"ubahpassword('"+response.data[i].PENGGUNA_ID+"','"+response.data[i].NAMA+"','"+response.data[i].NAMAOUTLET+"')\" class=\"btn btn-secondary\"> Ubah Kata Sandi </button>" +
                        "</div>" +
                        "</div>" +
                        "</article>" +
                        "</div>";
                    }
                    daftarpegawai += "</div></div></section>";
                }
                $("#daftarpegawai").html(daftarpegawai)
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}
function ubahinformasipenggunaaplikasi(idpengguna, namapengguna){
    Swal.fire({
        title:"Ubah Informasi",
        text:"Apakah anda ingin mengubah informasi "+namapengguna.replace('::', ' ')+" dengan ID "+idpengguna+" ?",
        icon:"question",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:"Oke. Lihat Informasi",
        cancelButtonText:"Tidak Jadi"
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url:baseurljavascript+'auth/daftarpegawai',
                    type:'POST',
                    dataType:'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        PENCARIAN: idpengguna,
                    },
                    success:function(response){
                        statusupdate = 1
                        $("#keterangantabpengguna").html("Ubah Informasi "+response.data[0].NAMA.split("::")[0])
                        $('.tabmenupengguna.active').removeClass('active')
                        $('.tab-pane.show.active').removeClass('show active')
                        $('#nav1-profile-tab').addClass('active')
                        $('#nav1-profile').addClass('show active');
                        $("#idpegawai").val(response.data[0].PENGGUNA_ID)
                        $("#urlfoto").val(response.data[0].URLFOTO)
                        $("#namadepan").val(response.data[0].NAMA.split("::")[0])
                        $("#namabelakang").val(response.data[0].NAMA.split("::")[1])
                        $("#alamat").val(response.data[0].ALAMAT)
                        $("#notelp").val(response.data[0].NOTELP)
                        $("#kodeunikmember").val(response.data[0].KODEUNIKMEMBER)
                        $("#username").val(response.data[0].NAMAPENGGUNA)
                        $("#password").val("")
                        $("#pintrx").val("")
                        $("#emailaktif").val(response.data[0].EMAIL)
                        $("#latlong").val(response.data[0].LATLONG)
                        $("#keterangan").val(response.data[0].KETERANGAN)
                        $("#password").prop('readonly', true)
                        $("#pintrx").prop('readonly', true)
                        var data = { id: response.data[0].IDHAKAKSES, text: "["+response.data[0].IDHAKAKSES+"] "+response.data[0].NAMAHAKAKSES};
                        var newOption = new Option(data.text, data.id, false, false)
                        $('#statuspegawai').append(newOption).trigger('change')
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });  
        }
    });
}
function statuspengguna(kondisiaksi, penggunaid, namapengguna, namaoutlet,aipengguna){
    let title,text,icon,txtbuttonconfirm,txtbuttoncancel;
    if (kondisiaksi == 0){
        title = "Non Aktif Pengguna"
        text = "Apakah anda yakin ingin menonaktifkan pengguna  "+namapengguna+" dengan ID Pengguna "+penggunaid+". Informasi mengenai TRANSAKSI ID ini masih ada dan tidak dihapus."
        icon="warning"
        txtbuttonconfirm = "Oke. Nontaktifkan"
        txtbuttoncancel = "Tidak Jadi"
    }else if (kondisiaksi == 1){
        title = "Aktifkan Pengguna"
        text = "Apakah anda yakin ingin mengaktifkan pengguna "+namapengguna+" dengan ID Pengguna "+penggunaid+". Jika sudah aktif jangan lupa tentukan HAK AKSES mengenai pengguna ini ya?"
        icon="question"
        txtbuttonconfirm = "Yosh.. Aktifkan"
        txtbuttoncancel = "Tidak Jadi"
    }
    Swal.fire({
        title:title,
        text:text,
        icon:icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:txtbuttonconfirm,
        cancelButtonText:txtbuttoncancel
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url:baseurljavascript+'auth/statuspegawai',
                    type:'POST',
                    dataType:'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        IDPENGGUNA:penggunaid,
                        NAMAPENGGUNA:namapengguna,
                        NAMAOUTLET:namaoutlet,
                        STATUSPENGGUNA:kondisiaksi,
                    },
                    success:function(response){
                        $("#artikelid"+aipengguna).removeClass()
                        $("#artikelid"+aipengguna).addClass("material-card "+(kondisiaksi == 1 ? "Blue" : "Red" ))
                        toastr[kondisiaksi == 1 ? "info" : "error"](response.msg);
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });  
        }
    });
}
function ubahpassword(penggunaid, namapengguna, namaoutlet){
    $("#idpengguna").html(penggunaid)
    $("#spannamapengguna").html(namapengguna)
    $('#sandikamu').attr("placeholder", "Ketikan sandi kamu terlebih dahulu");
    $('#sandipegawai').attr("placeholder", "Ubah katasandi dari pegawai "+namapengguna);
    $('#ubahpassword').modal('show');
}
function ubahpasswordproses(){
    $('#prosessimpaninformasi').prop("disabled",true);
    $('#prosessimpaninformasi').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
    getCsrfTokenCallback(function() {
        $.ajax({
            url:baseurljavascript+'auth/ubahpasswordproses',
            type:'POST',
            dataType:'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                IDPENGGUNABARU:$("#idpengguna").html(),
                PASSWORDKAMU:$('#sandikamu').val(),
                PASSWORDBARU:$('#sandipegawai').val(),
            },
            complete:function(){
                $('#prosessimpaninformasi').prop("disabled",false);
                $('#prosessimpaninformasi').html('Simpan Informasi');
            },
            success:function(response){
                if (response.success == 'false'){
                    return toastr["error"](response.msg);
                }
                $('#sandikamu').val(""),
                $('#sandipegawai').val(""),
                $('#ubahpassword').modal('hide');
                Swal.fire(
                    'Perubahan Katasandi!',
                    response.msg,
                    'success'
                )
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });  
}