<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap"
        rel="stylesheet">
    <link href="<?= base_url() ;?>styles/ltr-core.css" rel="stylesheet">
    <link href="<?= base_url() ;?>styles/ltr-vendor.css" rel="stylesheet">
    <link href="<?= base_url() ;?>styles/ltr-dashboard2.css" rel="stylesheet">
    <link href="<?= base_url() ;?>styles/core-default.css" rel="stylesheet">
    <?php
		if (isset($usedropzone)){
	echo '<link rel="stylesheet" type="text/css" href="'.base_url().'scripts/dropzone-5.7.0/min/dropzone.min.css"/>
	<link href="'.base_url().'styles/flexbin.css" type="text/css" rel="stylesheet" media="all" />
	';
	};?>
    <link href="<?= base_url() ;?>styles/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url() ;?>styles/fontawesome-free-5.15.3/css/all.css" rel="stylesheet">
    <link href="<?= base_url() ;?>styles/cssseira/style.css" rel="stylesheet">
    <link href="<?= base_url() ;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/flexmasonry/dist/flexmasonry.css">
    <style>
    .btn-flat-success:focus {box-shadow: 0 0 0 2px #ffffff, 0 0 3px 5px #3a97f9;outline: 2px dotted transparent;outline-offset: 2px;}.card,.cardharga{background-color:#fff}.card,.wishlist{box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19)}.swal2-cancel:focus,.swal2-confirm:focus{box-shadow:0 0 0 2px #fff,0 0 3px 5px #3a97f9;outline:transparent dotted 2px;outline-offset:2px}.form-group{margin-bottom:0}.form-control:focus{border-color:red;box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(255,0,0,.6)}
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js"
        integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="<?= base_url() ;?>scripts/globalfn.js"></script>
    <script type="text/javascript">
    var baseurljavascript = '<?= DYBASESEURL;?>';
    var baseurlsocket = '<?= BASEURLAPI;?>';
    var session_kodeunikmember='<?= session('kodeunikmember');?>';
    var session_pengguna_id='<?= session('pengguna_id');?>';
    var session_namapengguna='<?= session('namapengguna');?>';
    var session_outlet='<?= session('outlet');?>';
    var statusbarang = 1;
    var csrfName = '<?= csrf_token() ?>';
    </script>
    <title>Halaman KDS</title>
</head>

<body class="theme-light preload-active">
	<!-- BEGIN Preload -->
	<div class="preload">
            <div class="preload-dialog">
                <!-- BEGIN Spinner -->
                <div class="spinner-border text-primary preload-spinner"></div>
                <!-- END Spinner -->
            </div>
        </div>
        <!-- END Preload -->
        <!-- BEGIN Page Holder -->
        <div class="holder">
            <!-- BEGIN Page Wrapper -->
            <div class="wrapper">
                <!-- BEGIN Header -->
                <div class="header">
                    <!-- BEGIN Desktop Sticky Header -->
                    <div class="sticky-header" id="sticky-header-desktop">
                        <!-- BEGIN Header Holder -->
                        <div class="header-holder header-holder-desktop header-holder-main">
                            <div class="header-container container">
                                <div class="header-wrap">
                                    <h1 class="header-brand">KDS (Kitchen Display System)</h1>
                                </div>
                                <div class="header-wrap header-wrap-block justify-content-start">
                                    <!-- BEGIN Nav -->
                                    <div class="nav nav-tabs nav-lg header-nav" id="header-tab">
                                        <a class="nav-item nav-link active" data-toggle="tab" href="#header-tab-home">Beranda</a>
                                        <a class="nav-item nav-link" data-toggle="tab" href="#header-tab-apps">Status</a>
                                    </div>
                                    <!-- END Nav -->
                                </div>
                                <div class="header-wrap">
                                    <h1 class="header-brand">Total : <span id="totalpesanannya">0</span> Pesanan</h1>
                                    <a href="<?= base_url().'kds/jadwalkds/' ;?>"><button class="btn btn-label-light btn-icon ml-2" data-toggle="sidemenu" data-target="#sidemenu-todo"><i class="far fa-calendar-alt mr-2"></i></button></a>
                                    <!-- BEGIN Dropdown -->
                                </div>
                            </div>
                        </div>
                        <!-- END Header Holder -->
                        <!-- BEGIN Header Holder -->
                        <div class="header-holder header-holder-desktop">
                            <div class="header-container container">
                                <div class="header-wrap header-wrap-block justify-content-start">
                                    <!-- BEGIN Tab -->
                                    <div class="tab-content" id="header-tab-content">
                                        <div class="tab-pane fade show active" id="header-tab-home">
                                            <!-- BEGIN Nav -->
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a href="<?= base_url().'kds' ;?>" class="nav-link active">Dashboard</a></li>
                                                <li class="nav-item">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <input id="katakuncipencariankds" type="text" class="form-control" placeholder="No Penjualan" />
                                                                <div class="input-group-append" id="button-addon4">
                                                                    <button class="btn btn-outline-danger" type="button">Cari Data</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item"><a onclick="panggilkategorikasirkds();" data-toggle="modal" data-target="#filterbycategori" href="javascript:void(0)" class="btn btn-label-primary btn-wide mr-2"><i class="fa-solid fa-box"></i> Kategori</a></li>
                                            </ul>
                                            <!-- END Nav -->
                                        </div>
                                        <div class="tab-pane fade" id="header-tab-apps">
                                            <a id="terkirim_status_kds" href="javascript:void(0)" class="btn btn-label-primary btn-wide mr-2"><i class="fa-solid fa-thumbs-up"></i> Terikirm Ke Pelanggan</a>
                                            <a id="siapsaji_status_kds" href="javascript:void(0)" class="btn btn-label-danger btn-wide mr-2"><i class="fa fa-check mr-2"></i> Status Siap Saji </a>
                                            <a id="proses_status_kds" href="javascript:void(0)" class="btn btn-label-info btn-wide mr-2"><i class="fa-solid fa-hourglass-half mr-2"></i></i> Status Proses </a>
                                            <a id="statusbaru_status_kds" href="javascript:void(0)" class="btn btn-label-success btn-wide"><i class="fa-solid fa-square-arrow-up-right mr-2"></i> Status Baru </a>
                                        </div>
                                    </div>
                                    <!-- END Tab -->
                                </div>
                                <div class="header-wrap">
                                    <button class="btn btn-label-info" onclick="modalpengaturan()"><i class="fa fa-cog mr-2"></i>Pengaturan</button>
                                    <!-- BEGIN Dropdown -->
                                    <div class="dropdown ml-2">
                                        <button class="btn btn-label-primary btn-icon" data-toggle="dropdown">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
											<a href="<?= base_url().'penjualan/kasir/';?>"><div class="dropdown-item"><div class="dropdown-icon"><i class="fa fa-boxes"></i></div><span class="dropdown-content">New order</span></div></a>
                                        </div>
                                    </div>
                                    <!-- END Dropdown -->
                                </div>
                            </div>
                        </div>
                        <!-- END Header Holder -->
                    </div>
                    <!-- END Desktop Sticky Header -->
                    <!-- BEGIN Mobile Sticky Header -->
                    <div class="sticky-header" id="sticky-header-mobile">
                        <div class="header-holder header-holder-mobile header-holder-main">
                            <div class="header-container container">
                                <div class="header-wrap header-wrap-block justify-content-start">
                                    <h4 class="header-brand">KDS (Kitchen Display System)</h4>
                                </div>
                                <div class="header-wrap">
                                    <button class="btn btn-label-light btn-icon" data-toggle="sidemenu" data-target="#sidemenu-todo">
                                        <i class="far fa-calendar-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Header -->
                <?= $this->renderSection('kontenutama'); ?>
                <!-- END Page Content -->
                <!-- BEGIN Footer -->
                <div class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-9">
                                2021 - <?= date('Y') ;?> PT. Eraya Digital Solusindo. All rights reserved [IP ANDA : <span id="ipaddresspublic"></span>]
                            </div>
                            <div class="col-md-3 d-none d-md-block">
                                <p class="text-right mb-0">Hand-crafted and made with <i class="fa fa-heart text-danger"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Footer -->
            </div>
            <!-- END Page Wrapper -->
        </div>
        <!-- END Page Holder -->
        <!-- BEGIN Scroll To Top -->
        <div class="scrolltop">
            <button class="btn btn-info btn-icon btn-lg">
                <i class="fa fa-angle-up"></i>
            </button>
        </div>
<script type="text/javascript" src="https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
<script src="https://cdn.socket.io/4.6.0/socket.io.min.js" integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/mandatory.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/chatting.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/core.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/vendor.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/resto/daftarmeja.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/penjualan/kasir.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/timepickerseira.js"></script>
<script>
var timernya = [];
$('#tanggalawal_kds').val(moment().format('DD-MM-YYYY'));
$("#tanggalawal_kds").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
$('#tanggalakhir_kds').val(moment().format('DD-MM-YYYY'));
$("#tanggalakhir_kds").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
$(document).ready(function() {
	$("#namaprintershare").val(localStorage.getItem("NAMASHAREPRINTERJDS"));
    loadkdsproduct("onload","",moment().format('YYYY-MM-DD'),moment().format('YYYY-MM-DD'),"");
});
$('#textpencariankategorikds').on('input', debounce(function (e) {
    panggilkategorikasirkds()
}, 500));
function panggilkategorikasirkds(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'masterdata/daftakategoriselectkasir',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                NAMAKATEGORI: $("#textpencariankategorikds").val(),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                let obj = JSON.parse(response);
                let htmljoin = "";
                if (obj.success == "false"){
                    $('#tampilankategori').html('<div class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Kategori Yang Anda Cari Tidak Ditemukan, Silahkan Periksa Katakunci Yang Anda Masukkan</h4><!-- BEGIN Avatar --><div class="avatar avatar-label-primary avatar-circle widget12 mb-4"><div class="avatar-display"><i class="fas fa-box-open"></i></div></div></div>');
                }else{
                    htmljoin += '<div class="row">';
                    for (datake = 0; datake < obj.totaldata; datake++) {
                        htmljoin += ""
                        +"<div class=\"col-md-4 col-sm-4 mb-2\">"
                            +"<button onclick=\"filterbycategorikds('"+obj.daftarkategori[datake].idkategori+"','"+obj.daftarkategori[datake].namakategori+"')\" class=\"btn btn-block btn-lg btn-warning\">"+obj.daftarkategori[datake].namakategori+"</button>"
                        +"</div>"
                    }
                    htmljoin += '</div>';
                    $("#tampilankategori").html(htmljoin);
                }
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}
function loadkdsproduct(kondisi, kodepesanan,tanggalawal,tanggalakhir,kategoriid){
    let counttanggalwal,counttanggalkhir;
    let appendHTML = "",appendHTMLDetail = "";
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'kds/loadkds',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KODEPESANAN : kodepesanan,
                TANGGALAWAL : tanggalawal,
                TANGGALAKHIR : tanggalakhir,
                KONDISI : kondisi,
                KATEGORIID : kategoriid,
            },
            success: function (response) {
                if (response.success == "true"){
                    let  result = _(response.dataquery)
                        .groupBy(item => item.PK_NOTAPENJUALAN)
                        .sortBy(group => response.dataquery.indexOf(group["WAKTUPROSES"]))
                        .value()
                    $("#totalpesanannya").html(result.length);
                    appendHTML = "<div id=\"\"><div class=\"row \">";
                    for (let i = 0; i < result.length; i++) {
                        appendHTMLDetail = ""
                        for (let a = 0; a < result[i].length; a++) {
                            let namavariannya = "";classstatus = "avatar-label-danger";
                            let objjsonStrjenisvarian = JSON.parse(atob(result[i][a].JSONTAMBAHAN));
                            Object.entries(objjsonStrjenisvarian).forEach(([key, value]) => {
                                value.forEach((variandetail) => {
                                    namavariannya += variandetail.namavarian+" ("+variandetail.qty+"x) , "
                                })
                            })
                            switch(result[i][a].STATUSBARANGPROSES) {
                                case 0:
                                    classstatus = "avatar-label-danger";
                                    break;
                                case 1:
                                    classstatus = "avatar-label-primary";
                                    break;
                                case -1:
                                    classstatus = "avatar-label-success";
                                    break;
                            } 
                            appendHTMLDetail += ""
                            +"<div class=\"portlet mb-2\">"
                                +"<div class=\"rich-list rich-list-bordered rich-list-action\">"
                                    +"<div class=\"rich-list-item\">"
                                        +"<div class=\"rich-list-prepend\">"
                                            +"<div id=\"statusmasakan"+i+result[i][a].FK_BARANG+"\" class=\"avatar "+classstatus+" avatar-rounded\"><span class=\"avatar-display\">"+result[i][a].STOKBARANGKELUAR+"</span></div>"
                                        +"</div>"
                                        +"<div class=\"rich-list-content\">"
                                            +"<h4 class=\"rich-list-title\" style=\"color: red; font-size: 150%;\">"+result[i][a].NAMABARANG+"</h4>"
                                            +"<span class=\"rich-list-subtitle\">VARIAN : "+namavariannya+" </span>"
                                            +"<span class=\"rich-list-subtitle\">KETERANGAN : "+result[i][a].CATATANPERBARANG+"</span>"
                                        +"</div>"
                                        +"<div style=\""+(status == '-3' ? "display:none" : "" )+"\" class=\"rich-list-append\">"
                                            +"<div class=\"dropdown\">"
                                                +"<button class=\"btn btn-text-secondary btn-icon\" data-toggle=\"dropdown\">"
                                                    +"<i class=\"fas fa-sliders-h\"></i>"
                                                +"</button>"
                                                +"<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-animated\">"
                                                    +"<a onclick=\"ubahstatuspesanan('-1','"+result[i][a].NAMABARANG+"','"+result[i][a].FK_BARANG+"','"+result[i][a].STOKBARANGKELUAR+"','"+result[i][a].PK_NOTAPENJUALAN+"','"+i+"')\" class=\"dropdown-item\" href=\"javascript:void(0)\">"
                                                        +"<div class=\"dropdown-icon\">"
                                                            +"<i class=\"fa fa-check\"></i>"
                                                        +"</div>"
                                                        +"<span class=\"dropdown-content\"> Selesai</span>"
                                                    +"</a>"
                                                    +"<a onclick=\"ubahstatuspesanan('1','"+result[i][a].NAMABARANG+"','"+result[i][a].FK_BARANG+"','"+result[i][a].STOKBARANGKELUAR+"','"+result[i][a].PK_NOTAPENJUALAN+"','"+i+"')\" class=\"dropdown-item\" href=\"javascript:void(0)\">"
                                                        +"<div class=\"dropdown-icon\">"
                                                            +"<i class=\"fa-solid fa-hourglass-half\"></i>"
                                                        +"</div>"
                                                        +"<span class=\"dropdown-content\"> Proses</span>"
                                                    +"</a>"
                                                    +"<a onclick=\"ubahstatuspesanan('0','"+result[i][a].NAMABARANG+"','"+result[i][a].FK_BARANG+"','"+result[i][a].STOKBARANGKELUAR+"','"+result[i][a].PK_NOTAPENJUALAN+"','"+i+"')\" class=\"dropdown-item\" href=\"javascript:void(0)\">"
                                                        +"<div class=\"dropdown-icon\">"
                                                            +"<i class=\"fas fa-hourglass-start\"></i>"
                                                        +"</div>"
                                                        +"<span class=\"dropdown-content\"> Idle</span>"
                                                    +"</a>"
                                                +"</div>"
                                            +"</div>"
                                        +"</div>"
                                    +"</div>"
                                +"</div>"
                            +"</div>"
                        }
                    appendHTML += ""
                    +"<div class=\"col-md-6 col-xl-4\">"
                        +"<div class=\"portlet portlet-primary\">"
                            +"<div class=\"portlet-header\">"
                                +"<div class=\"portlet-icon\">"
                                    +"<i class=\"fa fa-chalkboard\"></i>"
                                +"</div>"
                                +"<h3 class=\"portlet-title\">Berjalan : <span class=\"waktuberjalan\" id=\"waktuberjalan"+i+"\">Mengkalkulasi Waktu</span></h3>"
                                +"<div class=\"portlet-addon\">"
                                    +"<div class=\"dropdown\">"
                                        +"<button class=\"btn btn-label-light dropdown-toggle\" data-toggle=\"dropdown\">#"+result[i][0].PK_NOTAPENJUALAN.split('#')[1]+"</button>"
                                        +"<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-animated\">"
                                            +"<a onclick=\"cetakulangnotakds('"+result[i][0].PK_NOTAPENJUALAN+"','"+result[i][0].KODEAI+"')\" class=\"dropdown-item\" href=\"javascript:void(0)\">"
                                                +"<div class=\"dropdown-icon\">"
                                                    +"<i class=\"fa fa-print\"></i>"
                                                +"</div>"
                                                +"<span class=\"dropdown-content\">Cetak Nota Dapur</span>"
                                            +"</a>"
                                        +"</div>"
                                    +"</div>"
                                +"</div>"
                            +"</div>"
                            +"<div class=\"portlet-body\">"+appendHTMLDetail+"</div>"
                            +"<div class=\"portlet-footer portlet-header-bordered\">NAMA MEMBER : "+result[i][0].NAMA+"<br>KETERANGAN TRX : "+result[i][0].KETERANGANITEM+"<br>TRX ID : "+result[i][0].PK_NOTAPENJUALAN+"<hr>"
                                +"<h3 class=\"portlet-title\>"
                                    +"<button class=\"btn btn-label-light\"></button>"
                                    +"<button onclick=\"sundulpesanan('"+result.length+"','"+result[i][0].PK_NOTAPENJUALAN+"')\" class=\"btn btn-label-light\"><i class=\"fa-solid fa-arrow-up\"></i> Sundul Pesanan</button>"
                                    +"<button onclick=\"tandaisemuaselesai('"+result.length+"','"+result[i][0].PK_NOTAPENJUALAN+"','')\" class=\"btn btn-success float-right\"><i class=\"fa fa-check\"></i> Siap Sajikan</button>"
                                +"</h3>"
                            +"</div>"
                        +"</div>"
                    +"</div>"
                    function updateClock() {
                        counttanggalwal = moment(new Date());
                        counttanggalkhir = moment((moment(result[i][0].TANGGALPROSES).format('YYYY-MM-DD'))+'T'+result[i][0].WAKTUPROSES);
                        $("#waktuberjalan"+i).html(counttanggalwal.diff(counttanggalkhir, 'hours')+" Jam, "+ Math.floor(counttanggalwal.diff(counttanggalkhir, 'minutes') % 60)+" Menit, "+ Math.floor(counttanggalwal.diff(counttanggalkhir, 'seconds') % 60)+" Detik")
                    }
                    timernya[i] = setInterval(updateClock, 1000);
                    }
                    appendHTML += "</div></div>";
                    $('#detailkds').empty().append(appendHTML);
                }else{
                    $('#detailkds').html('<div class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Pencarian Berdasarkan Katakunci Yang Anda Cari Tidak Ditemukan, Silahkan Periksa Katakunci Yang Anda Tentukan</h4><!-- BEGIN Avatar --><img src="'+baseurljavascript+'images/avatar/output-onlinepngtools.png">');
                }
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}
function cetakulangnotakds(nomortransaksi,kodeai){
    let keranjangarray = [],inforkartubarang = []
    swal.fire({
        title: "Cetak Nota Pesanan KDS?",
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
                                        NAMAPENGGUNA :  response.dataquery[0].USERNAMELOGIN,
                                        KODESOCKETPRINT : "KDS_"+localStorage.getItem("KODESOCKETPRINTER"),
                                    },
                                    success: function (response) {}
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

function modalpengaturan(){
	$('#modalpengaturan').modal('show');
}
function hariinipengaturana(){
	$('#tanggalawal_kds').val(moment().format('DD-MM-YYYY'));
}
function hariinipengaturanb(){
	$('#tanggalakhir_kds').val(moment().format('DD-MM-YYYY'));
}
$("#simpanpengaturan").click(function() {
    localStorage.setItem("NAMASHAREPRINTERJDS", $("#namaprintershare").val());
    for (let i = 0; i < Number($("#totalpesanannya").html()); i++) {
        clearInterval(timernya[i]);
    }  
    loadkdsproduct("",$("#katakuncipencariankds").val(),$("#tanggalawal_kds").val().split("-").reverse().join("-"),$("#tanggalakhir_kds").val().split("-").reverse().join("-"),"");
	Swal.fire({
		title: "Pengaturan Disimpan",
		text: "Pengaturan berhasil disimpan di penyimpanan peramban. Jika anda membersihkan cache maka harus melakukan simpan ulang",
		icon: 'success',
	});
});
function sundulpesanan(totalkelompokpesanan, notapenjualan){
    swal.fire({
        title: "BUMP Transaksi "+notapenjualan+" ?",
        icon: 'question',
        text: "Apakah anda ingin menaikan transaksi ini ? Waktu akan dikurangi 1 menit dari waktu terlama guna mengingatkan pesanan terlama yang terlewat ?",
        showCancelButton:true,
        confirmButtonText: "Oke. Sundul Gan",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'kds/sundulpesanan',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        NOTRANSKASI : notapenjualan,
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            for (let i = 0; i < totalkelompokpesanan; i++) {
                                clearInterval(timernya[i]);
                            }  
                            loadkdsproduct("onload","",moment().format('YYYY-MM-DD'),moment().format('YYYY-MM-DD'),"");
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
function tandaisemuaselesai(totalkelompokpesanan, notapenjualan, status){
    swal.fire({
        title: (Number(status) == -2 ? "Kirim Ke Pelanggan" : "Oke. Pesanan Siap Semua ?" ),
        icon: 'question',
        text: "Apakah semua pesanan sudah diproses semua pada transaksi "+notapenjualan+". Jadi jika masih ada yang belum maka proses ini tidak bisa dilanjutkan !",
        showCancelButton:true,
        confirmButtonText: (Number(status) == -2 ? "Sip.. Antarkan" : "Oke. Sudah Selesai" ),
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'kds/tandaisemuaselesai',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        NOTAPESANAN : notapenjualan,
                        STATUS : status,
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            for (let i = 0; i < totalkelompokpesanan; i++) {
                                clearInterval(timernya[i]);
                            }  
                            loadkdsproduct("onload","",moment().format('YYYY-MM-DD'),moment().format('YYYY-MM-DD'),"");
                        }else{
                            Swal.fire({
                                title: "Terjadi Kesalahan",
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
function ubahstatuspesanan(statuspesan, namabarang, barangid, qty, notapesanan, bariske, statuspesanan){
    let pesantitle="";text="";
    if (statuspesan == '0'){
        pesantitle = "Mengubah Status Menjadi IDLE ?"
        text = "Apakah anda yaking ingin mengubah status pesanan "+namabarang+" ["+qty+"] mejadi status IDLE ?"
    }else if (statuspesan == '1'){
        pesantitle = "Mengubah Status Menjadi PROSES ?"
        text = "Apakah anda yaking ingin mengubah status pesanan "+namabarang+" ["+qty+"] mejadi status PROSES ?"
    }else if (statuspesan == '-1'){ 
        pesantitle = "Mengubah Status Menjadi SELESAI ?"
        text = "Apakah anda yaking ingin mengubah status pesanan "+namabarang+" ["+qty+"] mejadi status SELESAI ?"
    }
    swal.fire({
        title: pesantitle,
        icon: 'question',
        text: text,
        showCancelButton:true,
        confirmButtonText: "Oke. Ubah Status",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'kds/ubahstatuspesanan',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        BARANGID : barangid,
                        STATUSPESAN : statuspesan,
                        NOTAPESANAN : notapesanan,
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            let classstatus ="",classremove = "";
                            switch(statuspesan) {
                                case "0":
                                    classstatus = "avatar-label-danger";
                                    classremove = "avatar-label-success avatar-label-primary";
                                    break;
                                case "1":
                                    classstatus = "avatar-label-primary";
                                    classremove = "avatar-label-success avatar-label-danger";
                                    break;
                                case "-1":
                                    classstatus = "avatar-label-success";
                                    classremove = "avatar-label-primary avatar-label-danger";
                                    break;
                            } 
                            $("#statusmasakan"+bariske+barangid).removeClass(classremove).addClass(classstatus); 
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
$('#katakuncipencariankds').on('input', debounce(function (e) {
    loadkdsproduct("",$("#katakuncipencariankds").val(),$("#tanggalawal_kds").val().split("-").reverse().join("-"),$("#tanggalakhir_kds").val().split("-").reverse().join("-"),"");
}, 500));
function filterbycategorikds(kategoriid,namakategori){
    for (let i = 0; i < Number($("#totalpesanannya").html()); i++) {
        clearInterval(timernya[i]);
    } 
    $("#namakategori_kds").html(namakategori)
    $("#idkategori_kds").html(kategoriid)
    loadkdsproduct("kategori",$("#katakuncipencariankds").val(),$("#tanggalawal_kds").val().split("-").reverse().join("-"),$("#tanggalakhir_kds").val().split("-").reverse().join("-"),kategoriid);
    $("#filterbycategori").modal("hide")
}
$("#terkirim_status_kds, #siapsaji_status_kds, #proses_status_kds, #statusbaru_status_kds").on("click", function () { 
    let id = $(this).attr('id');
    for (let i = 0; i < Number($("#totalpesanannya").html()); i++) {
        clearInterval(timernya[i]);
    }  
    filterbystatuspesanan(id)
    
});
function filterbystatuspesanan(idElement){
    let status = "";
    if (idElement == "terkirim_status_kds") status = '-3';
    if (idElement == "siapsaji_status_kds") status = '-2';
    if (idElement == "proses_status_kds") status = '1';
    if (idElement == "statusbaru_status_kds") status = '0';
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'kds/filterbystatuspesanan',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                STATUSPROSES: status,
            },
            success: function (response) {
                if (response.success == "true"){
                    let  result = _(response.dataquery)
                        .groupBy(item => item.PK_NOTAPENJUALAN)
                        .sortBy(group => response.dataquery.indexOf(group["WAKTUPROSES"]))
                        .value()
                    $("#totalpesanannya").html(result.length);
                    appendHTML = "<div id=\"\"><div class=\"row \">";
                    for (let i = 0; i < result.length; i++) {
                        appendHTMLDetail = "",appendHTMLButtonFotter = ""
                        for (let a = 0; a < result[i].length; a++) {
                            let namavariannya = "";classstatus = "avatar-label-danger";
                            let objjsonStrjenisvarian = JSON.parse(atob(result[i][a].JSONTAMBAHAN));
                            Object.entries(objjsonStrjenisvarian).forEach(([key, value]) => {
                                value.forEach((variandetail) => {
                                    namavariannya += variandetail.namavarian+" ("+variandetail.qty+"x) , "
                                })
                            })
                            switch(result[i][a].STATUSBARANGPROSES) {
                                case 0:
                                    classstatus = "avatar-label-danger";
                                    break;
                                case 1:
                                    classstatus = "avatar-label-primary";
                                    break;
                                case -1:
                                    classstatus = "avatar-label-success";
                                    break;
                                case -2:
                                    classstatus = "avatar-label-success";
                                    break;
                            } 
                            appendHTMLDetail += ""
                            +"<div class=\"portlet mb-2\">"
                                +"<div class=\"rich-list rich-list-bordered rich-list-action\">"
                                    +"<div class=\"rich-list-item\">"
                                        +"<div class=\"rich-list-prepend\">"
                                            +"<div id=\"statusmasakan"+i+result[i][a].FK_BARANG+"\" class=\"avatar "+classstatus+" avatar-rounded\"><span class=\"avatar-display\">"+result[i][a].STOKBARANGKELUAR+"</span></div>"
                                        +"</div>"
                                        +"<div class=\"rich-list-content\">"
                                            +"<h4 class=\"rich-list-title\" style=\"color: red; font-size: 150%;\">"+result[i][a].NAMABARANG+"</h4>"
                                            +"<span class=\"rich-list-subtitle\">VARIAN : "+namavariannya+" </span>"
                                            +"<span class=\"rich-list-subtitle\">KETERANGAN : "+result[i][a].CATATANPERBARANG+"</span>"
                                        +"</div>"
                                        +"<div class=\"rich-list-append\">"
                                            +"<div class=\"dropdown\">"
                                                +"<button class=\"btn btn-text-secondary btn-icon\" data-toggle=\"dropdown\">"
                                                    +"<i class=\"fas fa-sliders-h\"></i>"
                                                +"</button>"
                                                +"<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-animated\">"
                                                    +"<a onclick=\"ubahstatuspesanan('-1','"+result[i][a].NAMABARANG+"','"+result[i][a].FK_BARANG+"','"+result[i][a].STOKBARANGKELUAR+"','"+result[i][a].PK_NOTAPENJUALAN+"','"+i+"')\" class=\"dropdown-item\" href=\"javascript:void(0)\">"
                                                        +"<div class=\"dropdown-icon\">"
                                                            +"<i class=\"fa fa-check\"></i>"
                                                        +"</div>"
                                                        +"<span class=\"dropdown-content\"> Selesai</span>"
                                                    +"</a>"
                                                    +"<a onclick=\"ubahstatuspesanan('1','"+result[i][a].NAMABARANG+"','"+result[i][a].FK_BARANG+"','"+result[i][a].STOKBARANGKELUAR+"','"+result[i][a].PK_NOTAPENJUALAN+"','"+i+"')\" class=\"dropdown-item\" href=\"javascript:void(0)\">"
                                                        +"<div class=\"dropdown-icon\">"
                                                            +"<i class=\"fa-solid fa-hourglass-half\"></i>"
                                                        +"</div>"
                                                        +"<span class=\"dropdown-content\"> Proses</span>"
                                                    +"</a>"
                                                    +"<a onclick=\"ubahstatuspesanan('0','"+result[i][a].NAMABARANG+"','"+result[i][a].FK_BARANG+"','"+result[i][a].STOKBARANGKELUAR+"','"+result[i][a].PK_NOTAPENJUALAN+"','"+i+"')\" class=\"dropdown-item\" href=\"javascript:void(0)\">"
                                                        +"<div class=\"dropdown-icon\">"
                                                            +"<i class=\"fas fa-hourglass-start\"></i>"
                                                        +"</div>"
                                                        +"<span class=\"dropdown-content\"> Idle</span>"
                                                    +"</a>"
                                                +"</div>"
                                            +"</div>"
                                        +"</div>"
                                    +"</div>"
                                +"</div>"
                            +"</div>"
                        }
                    if (Number(status) > -3){
                        appendHTMLButtonFotter = ""
                        +"<button onclick=\"sundulpesanan('"+result.length+"','"+result[i][0].PK_NOTAPENJUALAN+"')\" class=\"btn btn-label-light\"><i class=\"fa-solid fa-arrow-up\"></i> Sundul Pesanan</button>"
                        +"<button onclick=\"tandaisemuaselesai('"+result.length+"','"+result[i][0].PK_NOTAPENJUALAN+"','"+status+"')\" class=\"btn btn-success float-right\"><i class=\"fa fa-check\"></i> "+(status == "-2" ? "Kirim Ke Pelanggan" : "Siap Sajikan" )+"</button>"
                    }else{
                        appendHTMLButtonFotter = "<button onclick=\"cetakulangnotakds('"+result[i][0].PK_NOTAPENJUALAN+"','"+result[i][0].KODEAI+"')\" class=\"btn btn-block btn-warning\"><i class=\"fas fa-print\"></i> Cetak Nota Ini</button>"
                    }
                    appendHTML += ""
                    +"<div class=\"col-md-6 col-xl-4\">"
                        +"<div class=\"portlet "+(status == '-3' ? "portlet-success" : "portlet-primary" )+"\">"
                            +"<div class=\"portlet-header\">"
                                +"<div class=\"portlet-icon\">"
                                    +"<i class=\"fa fa-chalkboard\"></i>"
                                +"</div>"
                                +"<h3 class=\"portlet-title\">Berjalan : <span class=\"waktuberjalan\" id=\"waktuberjalan"+i+"\">"+(Number(status) > -2 ? "Mengkalkulasi Waktu" : "Huftt.. Pesanan Selesai" )+"</span></h3>"
                                +"<div class=\"portlet-addon\">"
                                    +"<div class=\"dropdown\">"
                                        +"<button class=\"btn btn-label-light dropdown-toggle\" data-toggle=\"dropdown\">#"+result[i][0].PK_NOTAPENJUALAN.split('#')[1]+"</button>"
                                        +"<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-animated\">"
                                            +"<a onclick=\"cetakulangnotakds('"+result[i][0].PK_NOTAPENJUALAN+"','"+result[i][0].KODEAI+"')\" class=\"dropdown-item\" href=\"javascript:void(0)\">"
                                                +"<div class=\"dropdown-icon\">"
                                                    +"<i class=\"fa fa-print\"></i>"
                                                +"</div>"
                                                +"<span class=\"dropdown-content\">Cetak Nota Dapur</span>"
                                            +"</a>"
                                        +"</div>"
                                    +"</div>"
                                +"</div>"
                            +"</div>"
                            +"<div class=\"portlet-body\">"+appendHTMLDetail+"</div>"
                            +"<div class=\"portlet-footer portlet-header-bordered\">NAMA MEMBER : "+result[i][0].NAMA+"<br>KETERANGAN TRX : "+result[i][0].KETERANGANITEM+"<br>TRX ID : "+result[i][0].PK_NOTAPENJUALAN+"<hr>"
                                +"<h3 class=\"portlet-title\>"
                                    +"<button class=\"btn btn-label-light\"></button>"+appendHTMLButtonFotter+"</h3>"
                            +"</div>"
                        +"</div>"
                    +"</div>" 
                        if (Number(status) > -1){
                            function updateClock() {
                                counttanggalwal = moment(new Date());
                                counttanggalkhir = moment((moment(result[i][0].TANGGALPROSES).format('YYYY-MM-DD'))+'T'+result[i][0].WAKTUPROSES);
                                $("#waktuberjalan"+i).html(counttanggalwal.diff(counttanggalkhir, 'hours')+" Jam, "+ Math.floor(counttanggalwal.diff(counttanggalkhir, 'minutes') % 60)+" Menit, "+ Math.floor(counttanggalwal.diff(counttanggalkhir, 'seconds') % 60)+" Detik")
                            }
                            timernya[i] = setInterval(updateClock, 1000);
                        }
                    }
                    appendHTML += "</div></div>";
                    $('#detailkds').empty().append(appendHTML);
                }else{
                    $('#detailkds').html('<div class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Pencarian Berdasarkan Katakunci Yang Anda Cari Tidak Ditemukan, Silahkan Periksa Katakunci Yang Anda Tentukan</h4><!-- BEGIN Avatar --><img src="'+baseurljavascript+'images/avatar/output-onlinepngtools.png">');
                }
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}
let socketIoo = io(baseurlsocket);
socketIoo.on("connect", () => { console.log(socketIoo.id); });
socketIoo.on("NOTIFDINEINTAKEAWAY"+session_outlet+session_kodeunikmember, function (data) {
    let audio;
    for (let i = 0; i < Number($("#totalpesanannya").html()); i++) {
        clearInterval(timernya[i]);
    }  
    if ($("#idkategori_kds").html() == "-"){
        loadkdsproduct("onload","",moment().format('YYYY-MM-DD'),moment().format('YYYY-MM-DD'),"");
    }else{
        loadkdsproduct("kategori",$("#katakuncipencariankds").val(),$("#tanggalawal_kds").val().split("-").reverse().join("-"),$("#tanggalakhir_kds").val().split("-").reverse().join("-"),$("#idkategori_kds").html());
    }
    toastr.options = {newestOnTop: true,};
    if (Number(data.statustersajikan) != -3){
        if ((data.response_code == "2" || data.response_code == "3") && data.from_controller == "INSERT"){
            toastr["info"]("Hallo bagian dapur, ada PESANAN baru nih. Mohon untuk dibuatkan sesuai pesanan ya.... TERIMA KASIH" );
            audio = new Audio(baseurljavascript+"sound/orderan_gofodd.mp3");
        }else if ((data.response_code == "2" || data.response_code == "3") && data.from_controller == "UPDATE"){
            toastr["error"]("Hallo bagian dapur, ada PESANAN yang berubah ini. Mohon cek lagi ya sebelum melakukan aktivitas memasak. MOHON MAAF");
            audio = new Audio(baseurljavascript+"sound/mixkit-electric-fence-alert-2969.wav");
        }
        audio.play();
    }
});
</script>
</body>
</html>