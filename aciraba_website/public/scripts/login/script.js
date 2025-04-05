$("#simpanpengaturan").click(function() {
    localStorage.setItem("KODEKASA", $("#kodekasa").val());
    localStorage.setItem("KODESOCKETPRINTER", $("#kodesocketprinter").val());
    localStorage.setItem("PORTSOCKETPRINTER", $("#portsocketprinter").val());
    $("#pengaturanlocalnya").modal('hide');
    return toastr["success"]("ID KASA sudah tersimpan di peranda [Browser] ini. Silahkan masuk sesuai namapengguna serta katasandi yang sudah tersedia");
});
function proseslogin(){
    if (localStorage.getItem("KODEKASA") == "" || localStorage.getItem("KODEKASA") == null){ localStorage.setItem("KODEKASA", $("#kodekasa").val()); }
    let login_username = $("#login_username").val().trim();
    let login_password = $("#login_password").val().trim();
    if (login_username == "" || login_password == "") return toastr["info"]("Maaf, NAMA PENGGUNA dan KATASANDI tidak boleh kosong dong ? coba deh isi dengan benar");
    $('#login_prosesmasuk').prop("disabled",true);
    $('#login_prosesmasuk').html('<i class="fa fa-spin fa-spinner"></i> Proses Masuk');
    getCsrfTokenCallback(function() { 
        $.ajax({
            url:baseurljavascript+'auth/proseslogin',
            type:'POST',
            dataType:'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                login_username:login_username,
                login_password:login_password,
                kodekomputer:$("#kodekasa").val(),
            },
            complete:function(){
                $('#login_prosesmasuk').prop("disabled",false);
                $('#login_prosesmasuk').html('Masuk');
            },
            success:function(response){
                if (response.success == false) return toastr["error"](response.msg)
                window.location = baseurljavascript;
            }
        });
    });
}
function getInternationalPhoneNumber() {
    const dialCode = iti.getSelectedCountryData().dialCode;
    const nomorTelepon = iti.getNumber(intlTelInputUtils.numberFormat.E164);
    return nomorTelepon;
}
function prosesdaftar(){
    if ($("#namaoutlet").val() == "" || $("#namapemilik").val() == "" || $("#username_daftar").val() == "" || $("#password_daftar").val() == "" || $("#kodetenant").val() == "" || $("#email_daftar").val() == "" || $("#wa_daftar").val() == ""){
        return toastr["info"]("Semua formulir pada pendaftaran OUTLET harus diisi semua secara benar dan akurat");
    }
    $('#daftarkanoutlet').prop("disabled",true);
    $('#daftarkanoutlet').html('<i class="fa fa-spin fa-spinner"></i> Proses Daftar');
    getCsrfTokenCallback(function() {  
        $.ajax({
            url:baseurljavascript+'auth/pendaftaranmember',
            type:'POST',
            dataType:'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                NAMAOUTLET: $("#namaoutlet").val(),
                NAMA: $("#namapemilik").val(),
                NAMAPENGGUNA: $("#username_daftar").val(),
                PASSWORD: $("#password_daftar").val(),
                KODEUNIKMEMBER: $("#kodetenant").val(),
                EMAIL: $("#email_daftar").val(),
                WHATSAPP: hilangkanKodeNegara(getInternationalPhoneNumber()),
            },
            complete:function(){
                $('#daftarkanoutlet').prop("disabled",false);
                $('#daftarkanoutlet').html('Oke, Aku Join Nih');
            },
            success:function(response){
                if (response.success == false){
                    return toastr["error"](response.msg);
                }else{
                    toastr["info"](response.msg);
                    $('#pendaftaranownernya').modal('toggle');
                }
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.msg);
            }
        });
    });
}
$('#login_username').keypress(function (e) {let key = e.which; if(key == 13){ $('#login_password').focus() }});
$('#login_password').keypress(function (e) {let key = e.which; if(key == 13){ proseslogin(); }});
$("#login_prosesmasuk").on("click", function(){ proseslogin(); });
$("#daftarkanoutlet").on("click", function () { prosesdaftar(); });