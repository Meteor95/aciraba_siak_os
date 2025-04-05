<?= $this->extend('backend/main_acipay'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
<link href="<?= base_url() ;?>styles/cssseira/styleprofile.css" rel="stylesheet">
<style>
/*General Styling*/
.et_pb_text ol{
text-align:justify;
}

.et_pb_text ol {
position: relative;
padding-left: 60px;
margin-bottom: 20px;
list-style: none !important;
}
 
.et_pb_text ol li {
position: relative;
margin-top: 0em;
margin-bottom: 20px;
}

/*number styling - note that you will need to physically add in a span class*/
.et_pb_text ol li .number_divider {
position: absolute;
font-weight: 800;
font-size: 2em;
left: -60px;
top: -5px;
}

/*line styling*/
.et_pb_text ol li:before {
content: "";
background: #8dbeb2;
position: absolute;
width: 2px;
top: 1px;
bottom: -21px;
left: -24px;
}

/*dot styling*/
.et_pb_text ol li:after {
content: "";
background: #8dbeb2;
position: absolute;
width: 15px;
height: 15px;
border-radius: 100%;
top: 1px;
left: -31px;
}

/*removes line from last number*/
.et_pb_text ol li:last-child:before {
content: "";
background: #ffffff;
}

</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header">
                        <div class="portlet-icon">
                            <i class="fa fa-funnel-dollar"></i>
                        </div>
                        <h3 class="portlet-title">Daftar Provider Biller Tersedia</h3>
                    </div>
                    <!-- BEGIN Carousel -->
                    <div class="carousel carousel-center my-3" id="widget-carousel-nav">
                        <div class="carousel-item">
                            <!-- BEGIN Widget -->
                            <div class="widget6">
                                <h5 class="widget6-title">Digiflazz</h5>
                                <img src="<?= base_url().'images/vendor/digiflazz.png';?>" style="max-height: 128px;" class="rounded mx-auto d-block">
                                <span class="widget6-subtitle">Marketplace Host to Host Platform yang Menghubungkan antara pembeli dan penjual dalam melakukan Transaksi Produk Digital agar lebih Aman dan Nyaman, dalam hal ini adalah pemilik Server/Website Pulsa. Pembeli dapat memilih sendiri penjual sesuai kebutuhan pembeli.</span>
                            </div>
                            <!-- END Widget -->
                        </div>
                        <div class="carousel-item">
                            <!-- BEGIN Widget -->
                            <div class="widget6">
                                <h5 class="widget6-title">Otomax</h5>
                                <img src="<?= base_url().'images/vendor/otomax.png';?>" height="128px" style="max-height: 128px;" class="rounded mx-auto d-block">
                                <span class="widget6-subtitle">Software Pulsa Otomax sendiri merupakan singkatan dari Orisinil Topup Machine. Mengapa banyak orang lebih memilih menggunakan server pulsa ini dikarenakan otomax memang dibuat untuk pengguna yang ingin hasil maksimal. Hasil yang maksimal akan membuat pendapatan bisa semakin banyak dan terkendali tentunya.</span>
                            </div>
                            <!-- END Widget -->
                        </div>
                        <div class="carousel-item">
                            <!-- BEGIN Widget -->
                            <div class="widget6">
                                <h5 class="widget6-title">W38S</h5>
                                <img src="<?= base_url().'images/vendor/w38s.png';?>" style="max-height: 128px;" class="rounded mx-auto d-block">
                                <span class="widget6-subtitle">W38S atau Cloud Server Pulsa W38S atau Script Pulsa W38S atau yang biasa disebut juga Script Pulsa Online W38S merupakan software berbasis   PHP yang dibuat oleh Samsul Bahri pada tahun 2015. W38S dibuat dengan tujuan mempermudah serta mengembangkan usaha dari para pelaku usaha pulsa. </span>
                            </div>
                            <!-- END Widget -->
                        </div>
                    </div>
                    <!-- END Carousel -->
                    <div class="portlet-body">
                        <!-- BEGIN Carousel -->
                        <div class="carousel" id="widget-carousel">
                            <div class="carousel-item">
                                <div class="et_pb_text">
                                    <ol>
                                        <li><span class="number_divider">1</span><h5>Pastikan anda sudah bergabung kedalam MEMBER Digiflazz. Jika belum daftar dulu DONG...</h5></li>
                                        <li><span class="number_divider">2</span><h5>Kunjungi pengaturan API Buyer di sini : <a href="https://member.digiflazz.com/buyer-area/connection/api"> PENGATURAN API</a></p></h5></li>
                                        <li><span class="number_divider">3</span><h5>Jangan lupa setting webhook juga agar status transaksi bisa REAL TIME</p></h5></li>
                                        <li><span class="number_divider">4</span><h5>Jika sudah semua jangan lupa lengkapi FORM dibawah ini ya agar dapat berkomunikasi dengan Digiflazz</p></h5></li>
                                    </ol>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="idserver" class="col-sm-2 col-form-label">ID Server </label>
                                    <div class="col-sm-10"><div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">digiflazz_</span>
                                        </div>
                                        <input type="text" id="idserver" class="form-control" placeholder="Ex: dompet-data">
                                    </div></div>
                                </div>
                                <div class="form-group row">
                                    <label for="namaserver" class="col-sm-2 col-form-label">Nama Server </label>
                                    <div class="col-sm-10"><input value="" type="text" id="namaserver" class="form-control" placeholder="Ex: Acipay. Nama profil anda di Digiflazz"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="urlcitra" class="col-sm-2 col-form-label">Url Citra / Logo</label>
                                    <div class="col-sm-10"><input value="" type="text" id="urlcitra" class="form-control" placeholder="Pastekan url citra pada form ini. Ex : https://digiflazz.com/images/logo/main.png"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="kodemember" class="col-sm-2 col-form-label">API Username</label>
                                    <div class="col-sm-10"><input value="" type="text" id="api_username" class="form-control" placeholder="Ex: 98JkuRWe4"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="kodemember" class="col-sm-2 col-form-label">API Key</label>
                                    <div class="col-sm-10"><input value="" type="text" id="api_key" class="form-control" placeholder="Jangan sampai orang lain tau tentang API KEY mu"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="kodemember" class="col-sm-2 col-form-label">Webhook ID</label>
                                    <div class="col-sm-10"><input value="" type="text" id="webhook_id" class="form-control" placeholder="Cek di pengaturan API Provider"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="kodemember" class="col-sm-2 col-form-label">Webhook Secret</label>
                                    <div class="col-sm-10"><input value="" type="text" id="webhook_secret" class="form-control" placeholder="Cek di pengaturan API Provider"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="kodemember" class="col-sm-2 col-form-label">End Point URL</label>
                                    <div class="col-sm-10"><input type="text" id="url_endpoint" class="form-control" placeholder="ex: https://domain.com/v1/" value="https://api.digiflazz.com/v1/"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="kodemember" class="col-sm-2 col-form-label">Status Webservice</label>
                                    <div class="col-sm-10">
                                    <select id="statusoperator" class="selectpicker" data-live-search="true">
                                    <option value="PROD">Mode Transaksi Real</option>
                                    <option value="DEV">Mode Coba Coba</option>
                                    <option value="NON AKTIF">Tidak Aktif</option>
                                    </select></div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-3"><button class="btn btn-block btn-danger"><i class="fas fa-retweet"></i> Test PING Webhook</button></div>
                                    <div class="col-sm-9"><button class="btn btn-block btn-success"><i class="fas fa-edit"></i> Simpan Informasi Webservice Digiflazz</button></div>
                                </div>
                               <hr>
                               <table id="tabel_informasi_digiflazz" class="table table-bordered table-striped table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>Aksi</th>
                                            <th>Nama Server</th>
                                            <th>Saldo Server</th>
                                            <th>Parameter Info</th>
                                            <th>Informasi Key</th>
                                            <th>WebHook Key</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="carousel-item">
                                <img src="https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExbm1sN29sNzJqb2VvNmQxa2xjcWE5N3kwaHJ5eDVmZWZtcTllYzNmdCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/UYpelo7WbjZQg0dDQY/giphy.gif" style="max-height: 128px;" class="rounded mx-auto d-block">
                            </div>
                            <div class="carousel-item">
                                <img src="https://media0.giphy.com/media/v1.Y2lkPTc5MGI3NjExbm1sN29sNzJqb2VvNmQxa2xjcWE5N3kwaHJ5eDVmZWZtcTllYzNmdCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/UYpelo7WbjZQg0dDQY/giphy.gif" style="max-height: 128px;" class="rounded mx-auto d-block">
                            </div>
                        </div>
                        <!-- END Carousel -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detailinformasi">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eits.... Tunggu Dulu Brey...</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="font-size:1.5em;font-family: 'Irish Grover', cursive;"> Demi keamanan kita bersama. Kami ingin menverifikasi anda terlebih dahulu sebelum anda ingin merubah INFORMASI SENSITIF dari JALUR TRANSAKSI. Cukup masukkan NAMA PENGGUNA, KATASANDI dan OTP yang kami kirimkan ke mail terdaftar</div>
                <div class="form-group mt-3">
                    <div class="input-group mb-3">
                        <input id="username" type="text" placeholder="Masukkan nama pengguna kamu" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input id="password" type="password" placeholder="*********" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <span style="cursor:pointer" class="input-group-text" id="sandipegawai"><i class="fas fa-eye toggle-passwordb"></i></span>
                        </div>
                    </div>
                </div>
                <!--
                <div class="form-group mt-3">
                    <div class="input-group mb-3">
                        <input id="otp" type="text" placeholder="Masukan OTP 6 Digit dari e-mail" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <span onclick="kirimotp()" id="buttonkirimotp" style="cursor:pointer" class="input-group-text"><i class="fas fa-envelope mr-2"></i> Kirim OTP</span>
                        </div>
                    </div>
                    <pre>OTP kami kirimkan ke alamat email : <?= $email;?></pre>
                </div>
                -->
            </div>
            <div class="modal-footer modal-footer-bordered">
				<button onclick="tampilkaninformasi()" id="tampilkaninformasi" class="btn btn-outline-primary">Tampilkan Informasi</button>
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="detailtopup">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Top Up Ke Vendor <span id="namavendor"></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="kodemember" class="col-sm-4 col-form-label"><div class="float-left" style="font-size: 150%;">Username API KEY</div></label>
                    <div class="col-sm-8"><input id="topup_username" type="text" readonly class="form-control form-control-lg"></div>
                </div>
                <div class="form-group row">
                    <label for="kodemember" class="col-sm-4 col-form-label"><div class="float-left" style="font-size: 150%;">Besaran Deposit. Min : 200.000 IDR</div></label>
                    <div class="col-sm-8"><input id="topup_amount" placeholder="Min. Deposit Biasanya 200.000 IDR" type="text" class="form-control form-control-lg"></div>
                </div>
                <div class="form-group row">
                    <label for="kodemember" class="col-sm-4 col-form-label"><div class="float-left" style="font-size: 150%;">Pilih Bank</div></label>
                    <div class="col-sm-8">
                        <select id="topup_bank" class="selectpicker form-control-lg" data-live-search="true">
                            <option value="BCA">BCA - Bank Central Asia</option>
                            <option value="BRI">BRI - Bank Rakyat Indonesia</option>
                            <option value="BNI">BNI - Bank Negara Indonesia</option>
                        </select></div>
                </div>
                <div class="form-group row">
                    <label for="kodemember" class="col-sm-4 col-form-label"><div class="float-left" style="font-size: 150%;">Atas Nama Rekening</div></label>
                    <div class="col-sm-8"><input id="topup_atasnama" placeholder="Ex: Superman Gak Keren" type="text" class="form-control form-control-lg"></div>
                </div>
                <hr>
                <table id="tabel_informasi_tiket" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>ID Server</th>
                            <th>Nama Server</th>
                            <th>Besaran Tiket</th>
                            <th>BANK Tujuan</th>
                            <th>No Rekemimg Tujuan</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer modal-footer-bordered">
				<button onclick="depositsaldo()" id="requesttiket" class="btn btn-outline-primary">Tarik Tiket</button>
			</div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
let nominaldeposit = new AutoNumeric('#topup_amount', {decimalCharacter : ',',digitGroupSeparator : '.',});
$(function () {
    bacaserverhub()
    $("#widget-carousel").slick({ 
        rtl: $("html").attr("dir") === "rtl", 
        asNavFor: "#widget-carousel-nav", 
        slidesToShow: 1, 
        slidesToScroll: 1, 
        arrows: false,
    });
    $("#widget-carousel-nav").slick({ 
        rtl: $("html").attr("dir") === "rtl", 
        asNavFor: "#widget-carousel", 
        slidesToShow: 1, 
        slidesToScroll: 1, 
        arrows: true,
        prevArrow:"<button class=\"btn btn-danger slick-prev pull-left\"><i class=\"fa-solid fa-arrow-left fa-xl\" style=\"color: #ffffff;\"></i></button>",
        nextArrow:"<button class=\"btn btn-danger slick-next pull-right\"><i class=\"fa-solid fa-arrow-right fa-xl\" style=\"color: #ffffff;\"></i></button>",
        centerMode: true 
    });
});
function bacaserverhub(){
    getCsrfTokenCallback(function() {
        $("#tabel_informasi_digiflazz").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollCollapse: true,
            scrollY: "100vh",
            scrollX: true,
            bFilter: false,
            ajax: {
                "url": baseurljavascript + 'acipay/bacaserver',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.TIPE = "hub";
                },
            }
        });
    });
}
function bacalisttopup(idserver){
    getCsrfTokenCallback(function() {
        $("#tabel_informasi_tiket").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollCollapse: true,
            scrollY: "100vh",
            scrollX: true,
            bFilter: false,
            ajax: {
                "url": baseurljavascript + 'acipay/bacaserver',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.IDSERVER = idserver;
                },
            }
        });
    });
}
function detailinformasi(){
    $('#detailinformasi').modal('show');
}
function detailtopup(idserver,namaserver,username){
    $("#namavendor").html(namaserver)
    $("#topup_username").val(username)
    $('#detailtopup').modal('show');
}
function kirimotp(){
$('#buttonkirimotp').prop("disabled",true);
$('#buttonkirimotp').html('<i class="fa fa-spin fa-spinner"></i> Request OTP');
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'acipay/kirimotp',
        method: 'POST',
        dataType: 'json',
        data: {
            csrf_aciraba: csrfTokenGlobal,
        },
        complete:function(){
            $('#buttonkirimotp').prop("disabled",false);
            $('#buttonkirimotp').html('<i class="fas fa-envelope mr-2"></i> Kirim OTP');
        },
        success: function (response) {
        }
    });
});
}
function tampilkaninformasi(){
    $('#tampilkaninformasi').prop("disabled",true);
    $('#tampilkaninformasi').html('<i class="fa fa-spin fa-spinner"></i> Proses Varifikasi');
    getCsrfTokenCallback(function() {
        $.ajax({
            url:baseurljavascript+'auth/proseslogin',
            type:'POST',
            dataType:'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                login_username:$("#username").val(),
                login_password:$("#password").val(),
                otp:$("#otp").val(),
                kodeunikmember:session_kodeunikmember,
            },
            complete:function(){
                $('#tampilkaninformasi').prop("disabled",false);
                $('#tampilkaninformasi').html('Tampilkan Informasi');
            },
            success:function(response){
                
            }
        });
    });
}
function depositsaldo(){
    $('#requesttiket').prop("disabled",true);
    $('#requesttiket').html('<i class="fa fa-spin fa-spinner"></i> Tunggu Lagi Tarik Tiket');
    getCsrfTokenCallback(function() {
        $.ajax({
            url:baseurljavascript+'auth/depositsaldo',
            type:'POST',
            dataType:'json',
            data: {
                [csrfName]: csrfTokenGlobal,
            },
            complete:function(){
                $('#requesttiket').prop("disabled",false);
                $('#requesttiket').html('Tarik Tiket');
            },
            success:function(response){
                
            }
        });
    });
}
</script>
<?= $this->endSection(); ?>