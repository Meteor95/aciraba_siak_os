<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="https://fonts.cdnfonts.com/css/calculator" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
<link href="<?= base_url() ;?>styles/ltr-core.css" rel="stylesheet">
<link href="<?= base_url() ;?>styles/ltr-vendor.css" rel="stylesheet">
<link href="<?= base_url() ;?>styles/ltr-chatting.css" rel="stylesheet">
<link href="<?= base_url() ;?>styles/core-default.css" rel="stylesheet">
<?php if (isset($usedropzone)){
echo '<link rel="stylesheet" type="text/css" href="'.base_url().'scripts/dropzone-5.7.0/min/dropzone.min.css"/>
<link href="'.base_url().'styles/flexbin.css" type="text/css" rel="stylesheet" media="all" />
';};?>
<link href="<?= base_url() ;?>styles/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet">
<link href="<?= base_url() ;?>styles/fontawesome-free-5.15.3/css/all.css" rel="stylesheet">
<link href="<?= base_url() ;?>styles/cssseira/style.css" rel="stylesheet">
<link href="https://erayadigital.co.id/wp-content/uploads/2024/03/cropped-Logo-512-Eraya-Digital.png" rel="shortcut icon" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
<link href="<?= base_url() ;?>styles/cssseira/styleprofile.css" rel="stylesheet">
<style>
.image-container {
    width: 100%; 
    height: 200px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

.image-container img {
    height: 100%;
    object-fit: cover;
}
.btn-flat-success:focus {
  box-shadow: 0 0 0 2px #ffffff, 0 0 3px 5px #3a97f9;
  outline: 2px dotted transparent;
  outline-offset: 2px;
}

@font-face {
  font-family: digital-clock-font;
  src: url('/fonts/digital-7.regular.ttf');
}

.radio {
  background: #454857;
  padding: 4px;
  border-radius: 3px;
  box-shadow: inset 0 0 0 3px rgba(35, 33, 45, .3), 0 0 0 3px rgba(185, 185, 185, .3);
  position: relative;
}

.radio input {
  width: auto;
  height: 100%;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  outline: 0;
  cursor: pointer;
  border-radius: 2px;
  padding: 4px 8px;
  background: #454857;
  color: #bdbdbdbd;
  font-size: 14px;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  transition: .1s linear;
}

.radio input:checked {
  background-image: linear-gradient(180deg, #95d891, #74bbad);
  color: #fff;
  box-shadow: 0 1px 1px #0000002e;
  text-shadow: 0 1px 0 #79485f7a;
}

.radio input:before {
  content: attr(label);
  display: inline-block;
  text-align: center;
  width: 100%;
}

.card-sl {
    border-radius: 8px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .19)
}

.card-image img {
    max-height: 100%;
    max-width: 100%;
    border-radius: 8px 8px 0 0;
    display: block;
    margin-left: auto;
    margin-right: auto
}

.card-heading {
    font-size: 12px;
    font-weight: 700;
    background: #fff;
    padding: 10px 15px;
    text-align: center
}

.card-button {
    display: flex;
    justify-content: center;
    padding: 10px 0;
    width: 100%;
    background-color: #1f487e;
    color: #fff;
    border-radius: 0 0 8px 8px
}

.card-button:hover {
    text-decoration: none;
    background-color: #1d3461;
    color: #fff
}

@-webkit-keyframes pulse {
    0% {
        -moz-transform: scale(.9);
        -ms-transform: scale(.9);
        -webkit-transform: scale(.9);
        transform: scale(.9)
    }
    70% {
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        -webkit-transform: scale(1);
        transform: scale(1);
        box-shadow: 0 0 0 50px rgba(90, 153, 212, 0)
    }
    100% {
        -moz-transform: scale(.9);
        -ms-transform: scale(.9);
        -webkit-transform: scale(.9);
        transform: scale(.9);
        box-shadow: 0 0 0 0 rgba(90, 153, 212, 0)
    }
}
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.1.2/socket.io.min.js"
        integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?=$_ENV['MIDTRANS_CLIENT_KEY'];?>"></script>
    <script type="text/javascript" src="<?= base_url() ;?>scripts/globalfn.js"></script>
    <script type="text/javascript">
        var baseurljavascript = '<?= DYBASESEURL;?>';
        var baseurlsocket = '<?= BASEURLAPI;?>';
        var session_kodeunikmember='<?= session('kodeunikmember');?>';
        var session_pengguna_id='<?= session('pengguna_id');?>';
        var session_namapengguna='<?= session('namapengguna');?>';
        var session_outlet='<?= session('outlet');?>';
        var statusbarang = 1;
    </script>
    <title>Kasir Aciraba POS</title>
</head>

<body class="theme-light preload-hide chat-info-desktop-show"> <!--theme-light chat-contact-desktop-show chat-info-desktop-show preload-active-->
    <!-- BEGIN Preload -->
    <div class="preload">
        <div class="preload-message">
            <span class="preload-text">Mohon Tunggu Ya...</span>
        </div>
    </div>
    <!-- END Preload -->
    <!-- BEGIN Page Holder -->
    <div class="holder">
        <!-- BEGIN Page Wrapper -->
        <div class="wrapper">
            <!-- BEGIN Header -->
            <div class="header">
                <!-- BEGIN Header Holder -->
                <div class="header-holder">
                    <div class="header-container">
                        <div class="header-wrap header-wrap-block justify-content-start">
                            <div id="buttonkiri" class="btn btn-flat-primary btn-icon mr-3" data-toggle="chat" data-target="contact">
                                <i class="fa fa-bars"></i>
                            </div>
                            <div class="header-brand">
                                <a href="<?= base_url().'penjualan/kasir/';?>"><span id="titlekasir" class="<?= ($isedit == "true" ? "text-danger" : "text-primary" )?>"><?= $titleheader ?></span></a>
                            </div>
                        </div>
                        <div class="header-wrap">
                            <button onclick="transaksibaru()" class="btn btn-label-primary mr-2">
                                <div class="widget13-text"><i class="fa-solid fa-cash-register"></i> TRANSAKSI BARU</strong>
                                </div>
                            </button>
                            <!-- BEGIN Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-label-primary btn-icon" data-toggle="dropdown">
                                    <i class="far fa-bell"></i>
                                    <div class="btn-marker">
                                        <i class="marker marker-dot text-success"></i>
                                    </div>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-wide dropdown-menu-animated overflow-hidden py-0">
                                    <!-- BEGIN Portlet -->
                                    <div class="portlet border-0 portlet-scroll">
                                        <div class="portlet-header bg-primary rounded-0">
                                            <div class="portlet-icon text-white">
                                                <i class="far fa-bell"></i>
                                            </div>
                                            <h3 class="portlet-title text-white">Notification</h3>
                                            <div class="portlet-addon">
                                                <span class="badge badge-warning badge-square badge-lg">9+</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body p-0 rounded-0" data-toggle="simplebar">
                                            <!-- BEGIN Rich List -->
                                            <div class="rich-list rich-list-action">
                                                <a href="#" class="rich-list-item">
                                                    <div class="rich-list-prepend">
                                                        <!-- BEGIN Avatar -->
                                                        <div class="avatar avatar-label-info">
                                                            <div class="avatar-display">
                                                                <i class="fa fa-file-invoice"></i>
                                                            </div>
                                                        </div>
                                                        <!-- END Avatar -->
                                                    </div>
                                                    <div class="rich-list-content">
                                                        <h4 class="rich-list-title">New report has been received</h4>
                                                        <span class="rich-list-subtitle">2 min ago</span>
                                                    </div>
                                                    <div class="rich-list-append">
                                                        <i class="caret mx-2"></i>
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- END Rich List -->
                                        </div>
                                    </div>
                                    <!-- END Portlet -->
                                </div>
                            </div>
                            <!-- END Dropdown -->
                            <?php if (session('hakakses') != "KASIR") {?>
                                <a href="<?= base_url() ;?>"><button class="btn btn-label-primary btn-icon ml-2" data-toggle="tooltip" data-placement="bottom" title="Kelola Administrasi Toko">
                                <i class="fas fa-list"></i>
                            </button></a>
                            <?php } ?>
                            <button class="btn btn-label-primary btn-icon ml-2" id="theme-toggle" data-toggle="tooltip" data-placement="bottom" title="Ubah Tema">
                                <i class="fa fa-moon"></i>
                            </button>
                            <!-- BEGIN Dropdown -->
                            <div class="dropdown ml-2">
                                <button class="btn btn-flat-primary widget13" data-toggle="dropdown">
                                    <div class="widget13-text"> Hi <strong><?= strtoupper(session('namapengguna')) ;?></strong>
                                    </div>
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-info widget13-avatar">
                                        <div class="avatar-display">A</div>
                                    </div>
                                    <!-- END Avatar -->
                                </button>
                                <div class="dropdown-menu dropdown-menu-wide dropdown-menu-right dropdown-menu-animated overflow-hidden py-0">
                                    <!-- BEGIN Portlet -->
                                    <div class="portlet border-0">
                                        <div class="portlet-header bg-primary rounded-0">
                                            <!-- BEGIN Rich List Item -->
                                            <div class="rich-list-item w-100 p-0">
                                                <div class="rich-list-prepend">
                                                    <!-- BEGIN Avatar -->
                                                    <div class="avatar">
                                                        <div class="avatar-display">
                                                            <img src="<?= session('fotourl') == "" ? "https://sm.ign.com/ign_ap/cover/a/avatar-gen/avatar-generations_hugw.jpg" : session('fotourl') ;?>" alt="Avatar image">
                                                        </div>
                                                    </div>
                                                    <!-- END Avatar -->
                                                </div>
                                                <div class="rich-list-content">
                                                    <h3 class="rich-list-title text-white"><?= session('namaasli');?></h3>
                                                    <span class="rich-list-subtitle text-white"><?= session('hakakses');?></span>
                                                </div>
                                                <div class="rich-list-append">
                                                    <span class="badge badge-warning badge-square badge-lg">9+</span>
                                                </div>
                                            </div>
                                            <!-- END Rich List Item -->
                                        </div>
                                        <div class="portlet-body p-0">
                                            <!-- BEGIN Grid Nav -->
                                            <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                                <div class="grid-nav-row">
                                                    <a href="#" class="grid-nav-item">
                                                        <div class="grid-nav-icon">
                                                            <i class="far fa-address-card"></i>
                                                        </div>
                                                        <span class="grid-nav-content">Profile</span>
                                                    </a>
                                                    <a href="#" class="grid-nav-item">
                                                        <div class="grid-nav-icon">
                                                            <i class="far fa-comments"></i>
                                                        </div>
                                                        <span class="grid-nav-content">Messages</span>
                                                    </a>
                                                    <a href="#" class="grid-nav-item">
                                                        <div class="grid-nav-icon">
                                                            <i class="far fa-clone"></i>
                                                        </div>
                                                        <span class="grid-nav-content">Activities</span>
                                                    </a>
                                                </div>
                                                <div class="grid-nav-row">
                                                    <a href="#" class="grid-nav-item">
                                                        <div class="grid-nav-icon">
                                                            <i class="far fa-calendar-check"></i>
                                                        </div>
                                                        <span class="grid-nav-content">Tasks</span>
                                                    </a>
                                                    <a href="#" class="grid-nav-item">
                                                        <div class="grid-nav-icon">
                                                            <i class="far fa-sticky-note"></i>
                                                        </div>
                                                        <span class="grid-nav-content">Notes</span>
                                                    </a>
                                                    <a href="#" class="grid-nav-item">
                                                        <div class="grid-nav-icon">
                                                            <i class="far fa-bell"></i>
                                                        </div>
                                                        <span class="grid-nav-content">Notification</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- END Grid Nav -->
                                        </div>
                                        <div class="portlet-footer portlet-footer-bordered rounded-0">
                                            <button onclick="verifikasikeluar()" class="btn btn-label-danger">Keluar</button>
                                        </div>
                                    </div>
                                    <!-- END Portlet -->
                                </div>
                            </div>
                            <!-- END Dropdown -->
                        </div>
                    </div>
                </div>
                <!-- END Header Holder -->
            </div>
            <!-- END Header -->
            <!-- BEGIN Page Content -->
            <div class="content">
                <div class="chat-row">
                    <div class="chat-contact-col">
                        <!-- BEGIN Portlet -->
                        <div class="portlet chat-portlet">
                            <div class="portlet-body overflow-auto pb-0" data-simplebar="data-simplebar">
                                <div style="text-align:center"><small class="text-muted"><strong> Informasi OUTLET : <?= session('outlet');?></strong></small></div>
                                <div id="sessionoutletsekarang"></div>    
                                <select class="form-control" id="cmblokasioutlet"></select>
                                <div class="portlet portlet-body mt-2">
                                    <!-- BEGIN Widget -->
                                    <div class="widget16">
                                        <div class="widget16-display">
                                            <div class="widget16-content">
                                                <div class="widget16-title"><span id="notakasirpenjualan"><?= $notapenjualan ?></span></div>
                                                <div class="widget16-subtitle"><span id="tanggaltrx"></span></div>
                                                Salesman : <div class="widget16-subtitle"><span id="namasalesman"><?= $namasalesman;?></span> [<span id="idsalesman"><?= $kodesalesman;?></span>]</div>
                                            </div>
                                            <div class="widget16-addon">
                                                <button  data-toggle="modal" data-target="#modaltutorial" class="btn btn-label-primary btn-icon btn-lg">
                                                    <i class="fa fa-info"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="widget16-list">
                                            <div class="widget16-list-item">
                                                <span class="widget16-list-data">Kas Masuk</span>
                                                <span class="widget16-list-value">
                                                    <strong><span id="kasirkasmasuk">0</span></strong> IDR
                                                </span>
                                            </div>
                                            <div class="widget16-list-item">
                                                <span class="widget16-list-data">Kas Keluar</span>
                                                <span class="widget16-list-value">
                                                    <strong><span id="kasirkaskeluar">0</span></strong> IDR
                                                </span>
                                            </div>
                                        </div>
                                        <div class="widget16-action">
                                            <button onclick="daftarnotapending()" class="btn btn-primary btn-widest mr-2">Nota Pending</button>
                                            <button onclick="alert('Masih dalam pengembangan')" class="btn btn-outline-secondary btn-widest">Arus Kas</button>
                                        </div>
                                    </div>
                                    <!-- END Widget -->
                                </div>
                                <!-- BEGIN Portlet -->
                                <div class="portlet mb-0">
                                    <div class="portlet-header portlet-header-bordered">
                                        <div class="input-group input-daterange">
                                            <input id="tanggaltrxfield" type="text" class="form-control" placeholder="Ubah Tanggal TRX">
                                            <div class="input-group-prepend input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet-body p-0">
                                        <!-- BEGIN Rich List -->
                                        <div class="rich-list rich-list-flush rich-list-action">
                                            <a onclick="panggildompetdata()" data-toggle="modal" data-target="#panggildompetdata" href="javascript:void(0)" class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-label-success avatar-circle"><span class="avatar-display">DG</span></div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title">Dompet Digital</h4>
                                                    <span class="rich-list-subtitle">Transaksi Dompet Data seperti PULSA, TOKEN, VOUCHER GAME, TAGIHAN</span>
                                                </div>
                                            </a>
                                            <a onclick="panggilmemberkasir()" data-toggle="modal" data-target="#memberdikasir" href="javascript:void(0)" class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-label-success avatar-circle"><span class="avatar-display">DA</span></div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title">Daftar Anggota</h4>
                                                    <span class="rich-list-subtitle">Menampilkan semua daftar anggota yang terdaftar pada sistem anda</span>
                                                </div>
                                            </a>
                                            <a onclick="panggilsalesman()" data-toggle="modal" data-target="#salesmandikasir" href="javascript:void(0)" class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-label-success avatar-circle"><span class="avatar-display">DS</span></div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title">Daftar Salesman</h4>
                                                    <span class="rich-list-subtitle">Menampilan daftar salesman yang bekerja sama dengan toko anda</span>
                                                </div>
                                            </a>
                                            <a onclick="daftarpenjualan()" data-toggle="modal" data-target="#daftarpenjualan" href="javascript:void(0)" class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-label-success avatar-circle"><span class="avatar-display">PH</span></div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title">Penjualan Hari Ini</h4>
                                                    <span class="rich-list-subtitle">Digunakan untuk melihat laporan penjualan khusus hari ini per kasir</span>
                                                </div>
                                            </a>
                                            <a onclick="daftartempatdisewakan()" href="javascript:void(0)" class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-label-success avatar-circle"><span class="avatar-display">PT</span></div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title">Pemesanan Tempat</h4>
                                                    <span class="rich-list-subtitle">Digunakan untuk melihat daftar tempat pada outlet anda untuk disewakan</span>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- END Rich List -->
                                    </div>
                                </div>
                                <!-- END Portlet -->
                            </div>
                            <div class="portlet-footer d-flex">
                                <a href="<?= base_url().'kds/';?>" class="btn btn-label-primary btn-lg btn-block mr-2">Lihat Status Pesanan</a>
                                <!-- BEGIN Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-flat-primary btn-icon btn-lg" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                                        <a class="dropdown-item" href="#">
                                            <div class="dropdown-icon">
                                                <i class="fa fa-list-alt"></i>
                                            </div>
                                            <span class="dropdown-content">Mode Tabel</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- END Dropdown -->
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                    <div class="chat-conversation-col">
                        <!-- BEGIN Portlet -->
                        <div class="portlet chat-portlet">
                            <div class="portlet-header portlet-header-bordered">
                                <!-- BEGIN Rich List -->
								<div class="rich-list-item w-100 p-0">
									<div class="rich-list-prepend" style="width: 100px;">
										<!-- BEGIN Input Group -->
                                        <div class="input-group-icon input-group-lg">
                                            <div class="input-group-prepend">
                                                <i class="fa fa-cart-plus text-primary"></i>
                                            </div>
                                            <input id="qtykeluarkasir" type="text" class="form-control" value="1" placeholder="QTY">
                                        </div>
                                        <!-- END Input Group -->
									</div>
									<div class="rich-list-content">
										<!-- BEGIN Input Group -->
                                        <div class="input-group-icon input-group-lg">
                                            <div class="input-group-prepend ml-1">
                                                <i class="fa fa-search text-primary"></i>
                                            </div>
                                            <input id="katakuncipencariankasir" type="text" class="form-control"
                                                placeholder="Ketikkan Kode item / Nama item">
                                            <input id="katakuncikategori" type="hidden" class="form-control">
                                        </div>
                                        <!-- END Input Group -->
									</div>
									<div class="rich-list-append">
										<button id="bersihkanform" class="btn btn-flat-info btn-icon mr-2 btn-lg">
											<i class="fa fa-redo-alt"></i>
										</button>
										<button onclick="panggilkategorikasir();" data-toggle="modal" data-target="#filterbycategori" class="btn btn-flat-info btn-icon mr-2 btn-lg">
											<i class="fa fa-boxes"></i>
										</button>
									</div>
								</div>
								<!-- END Rich List -->
                            </div>
                            <div class="portlet-body chat-wrapper" data-simplebar="data-simplebar">
                                <!-- BEGIN Chat -->
                                <div id="kontenbarang" class="chat">
                                    <div id="daftaritemkasir"></div>
                                </div>
                                <!-- END Chat -->
                            </div>
                            <div class="portlet-footer portlet-footer-bordered d-flex" style="height:100px">
                                <div class="mr-3" style="cursor:pointer"><i id="iconresrvasi" onclick="tipeorder('1','')" class="icon-reservation-completed-icon" style="font-size:5em"></i></div>
                                <div class="mr-3" style="cursor:pointer"><i id="icondinein" onclick="tipeorder('2','')" class="icon-dine-in" style="font-size:5em"></i></div>
                                <div><span onclick="tipeorder('3','')" class="icon-takeaway-icon" style="color:blue;cursor:pointer;font-size:5em"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span></div>
                                <input value="<?= $keterangantransaksi;?>" id="keterangantransaksi" type="text" style="font-size:2.6em" class="form-control form-control-lg mx-3" placeholder="Ketikkan keterangan untuk TRX ini ?">
                                <i style="cursor:pointer;font-size:5em" class="fa fa-cart-arrow-down" id="buttonkanan" data-toggle="chat" data-target="info"></i>
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                    <div class="chat-info-col">
						<!-- BEGIN Portlet -->
						<div class="portlet chat-portlet">
                            <!-- BEGIN Portlet -->
                            <div>
                                <div class="portlet-body p-0">
                                    <!-- BEGIN Rich List -->
                                    <div class="rich-list rich-list-flush rich-list-action" >
                                        <a onclick="detailinformasimember()" href="javascript:void(0)" class="rich-list-item">
                                            <div class="rich-list-prepend">
                                                <!-- BEGIN Avatar -->
                                                <div class="avatar btn-flat-primary btn-icon">
                                                    <div class="avatar-display">
                                                        <i class="fa fa-bars"></i>
                                                    </div>
                                                </div>
                                                <!-- END Avatar -->
                                            </div>
                                            <div class="rich-list-content">
                                                <span class="rich-list-title">Nama Pelanggan Terpilih</span>
                                                <span class="rich-list-subtitle"><span id="namamember"><?= $namamember;?></span> [<span id="idmember"><?= $kodemember;?></span>]</span>
                                                <span style="display:none" id="lamajatuhtempo">0</span>
                                                <span style="display:none" id="emailpelanggan">noemail@erayadigital.co.id</span>
                                                <span style="display:none" id="nokontakpelanggan">0</span>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- END Rich List -->
                                    <div class="float-right" id="totalbelanjaatas" style="color:red;font-size: 400%;font-family:'digital-clock-font'">Rp 0,00</div>
                                </div>
                            </div>
                            <!-- END Portlet -->
							<div class="portlet-body overflow-auto" data-simplebar="data-simplebar">
                                <div id="keranjangkosong"></div>
                                <?php if ($isedit == "true"){ ?>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="edithargagrosiraktif">
                                        <label style="font-size: 100%;" class="custom-control-label" for="edithargagrosiraktif">Aktifkan Best Buy</label>
                                    </div>
                                <?php } ;?>
								<div id="keranjangbelanja"></div>
							</div>
                            <div class="portlet-footer portlet-footer-bordered d-flex">
                                <div class="row">
                                    <div class="col-md-4 mt-2">Potongan:</div>
                                    <div class="col-md-8 mb-2"><input id="nominalpotongan" value="<?= $nominalpotongan ;?>"  placeholder="Rp 0,00" style="text-align: right;"  type="text" class="form-control"></div>
                                <br>
                                    <div class="col-md-4 mt-2">Pajak Toko:</div>
                                    <div class="col-md-8 mb-2">
                                        <div class="input-group">
                                            <input id="pajaktoko" placeholder="Rp 0,00" style="text-align: right;"  type="text" class="form-control" value="">
                                            <div class="input-group-prepend"><span id="btnhitungpajaktoko" style="cursor:pointer" class="input-group-text btn-warning btn"><i class="fa-solid fa-calculator"></i>&nbsp;HITUNG</span></div>
                                        </div>       
                                    </div>
                                <br>
                                    <div class="col-md-4 mt-2">Pajak Negara:</div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input id="pajaknegara"  placeholder="Rp 0,00" style="text-align: right;"  type="text" class="form-control" value="">
                                            <div class="input-group-prepend"><span id="btnhitungpajaknegara" style="cursor:pointer" class="input-group-text btn-warning btn"><i class="fa-solid fa-calculator"></i>&nbsp;HITUNG</span></div>
                                        </div>    
                                    </div>
                                <br>
                                <div class="col mt-2"><button id="btnhitungpajak" class="btn btn-block btn-danger mt-2 ml-2"><i class="fa-solid fa-calculator"></i>&nbsp;HITUNG PAJAK</button></div>
                                <div class="col mt-2"><button id="btnbatalpajak" class="btn btn-block btn-success mt-2 mr-2"><i class="fa-solid fa-close"></i>&nbsp;BATAL HITUNG</button></div>
                                </div>
                            </div>
                            <div class="portlet-footer portlet-footer-bordered d-flex">
                                <?php if ($isedit == "false") {?>
                                <button onclick="simpantransaksipending()" class="btn btn-warning mr-2"> <i class="fas fa-box"></i> PENDING</button>
                                <?php }?>
                                <button onclick="cekkeranjang()" class="btn btn-block btn-success"> <i class="fa fa-cash-register"></i><span style="font-size:1.2em"> <?= $textbuttonbayar;?> : <span id="grandtotal">0</span></span></button>
                            </div>
						</div>
						<!-- END Portlet -->
					</div>
                </div>
            </div>
            <!-- END Page Content -->
        </div>
        <!-- END Page Wrapper -->
    </div>
    <!-- END Page Holder -->
<!-- BEGIN Modal -->
<div class="modal fade konfirmasipembayaran"  id="modalkonfirmasipembayaran" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembayaran <span id="titlekonfirmasipembayaran"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col"><div style="color:red;font-size: 400%;">Total: </div></div>
                    <div class="col"><div class="float-right" id="totalbelanjakonfirmasi" style="color:red;font-size: 400%;font-family:'digital-clock-font'">Rp 0,00</div></div>
                </div>
                <div class="row" id="kolomuangmukarspv">
                    <div class="col"><div onclick="toastinformasidpkonfirmasi()" class="float-left" style="font-size: 200%;cursor:pointer">Uang Muka Rsrv: <i class="fa-solid fa-circle-info fa-beat" style="color: #ff0000;"></i> </div></div>
                    <div class="col"><input readonly id="nominaluangmukares"  placeholder="Rp 0,00" type="text" class="form-control" style="text-align: right; font-size: 25px" value="<?= $uangmuka_psn ;?>"></div>
                </div>
                <div class="row mt-2">
                    <div class="col"><div class="float-left" style="font-size: 200%;">Jenis Transaksi: </div></div>
                    <div class="col">
                    <div class="radio" id="jenistransaksi">
                        <input label="F1-TUNAI" type="radio" onchange="pilihjenistranskasi(this);" id="tunai" name="jenistrx" value="tunai" checked>
                        <input label="F2-KREDIT" type="radio" onchange="pilihjenistranskasi(this);" id="kredit" name="jenistrx" value="kredit">
                        <input label="F3-KARTU" type="radio" onchange="pilihjenistranskasi(this);" id="kartu" name="jenistrx" value="kartu">
                        <input label="F4-SPLITCASH" type="radio" onchange="pilihjenistranskasi(this);" id="splitcash" name="jenistrx" value="splitcash">
                    </div>
                    </div>
                </div>
                <div class="row mt-2" id="kolomtunai">
                    <div class="col"><div class="float-left" style="font-size: 200%;">Tunai: </div></div>
                    <div class="col"><input id="nominaltunai"  placeholder="Rp 0,00" type="text" class="form-control" style="text-align: right; font-size: 25px" value="<?= $nominaltunai ;?>"></div>
                </div>
                <div class="row mt-2" id="kolomkredit">
                    <div class="col"><div style="font-size: 200%;">Uang Muka: </div></div>
                    <div class="col"><input id="nominalkredit"  placeholder="Rp 0,00" type="text" class="form-control" style="text-align: right; font-size: 25px" value="<?= $nominalkredit;?>"></div>
                </div>
                <div class="row mt-2" id="kolomkartudebit">
                    <div class="col"><div style="font-size: 200%;">Kartu Debit: </div><br><span style="display:none" id="idkartudebit"></span></div>
                    <div class="col"><div class="mt-1"><input id="nomorkartudebit"  style="text-align: right; font-size: 25px" value="<?= $nominalkdebit ;?>" placeholder="Rp 0,00" type="text" class="form-control mb-1"><div class="input-group"><div class="input-group-prepend"><span style="cursor: pointer" class="input-group-text accordion" id="pilihbankdebit" onclick="pilihbankdebit()">Pilih Bank</span></div><input id="nomorkartudebitdantrx" type="text" value="<?= $nomorkartudebit;?>" class="form-control" placeholder="Nomor Kartu Pelanggan dan TRX ID" aria-label="Username" aria-describedby="basic-addon1"></div></div></div>
                </div>
                <div id="daftarbankdebit"></div>
                <div class="row mt-2" id="kolomkartukredit">
                    <div class="col"><div style="font-size: 200%;">Kartu Kredit: </div><br><span style="display:none" id="idkartukredit"></span></div>
                    <div class="col"><div class="mt-1"><input id="nomorkartukredit"  style="text-align: right; font-size: 25px" value="<?= $nominalkkredit;?>" placeholder="Rp 0,00" type="text" class="form-control mb-1"><div class="input-group"><div class="input-group-prepend"><span style="cursor: pointer"class="input-group-text" id="pilihbankkredit" onclick="pilihbankkredit()">Pilih Bank</span></div><input id="nomorkartukreditdantrx" value="<?= $nomorkartukredit;?>" type="text" class="form-control" placeholder="Nomor Kartu Pelanggan dan TRX ID" aria-label="Username" aria-describedby="basic-addon1"></div></div></div>
                </div>
                <div id="daftarbankkredit"></div>
                <div class="row mt-2" id="kolomemoney">
                    <div class="col"><div style="font-size: 200%;">E-Money: </div><br><span style="display:none" id="idemoney"></span></div>
                    <div class="col"><input id="nominalemoney" placeholder="Rp 0,00" style="text-align: right;font-size: 25px"  type="text" class="form-control" value="<?= $nominalemoney;?>"><button onclick="pilihemoney()" class="mt-1 btn btn-secondary btn-block">Pilih Vendor E-Money</button></div>
                </div>
                <div id="daftaremoney"></div>
                <div class="row mt-2">
                    <div class="col"><div class="float-left" style="font-size: 200%;color:blue">Total Bayar: </div></div>
                    <div class="col"><input readonly id="nominaltotalbayar"  placeholder="Rp 0,00" style="text-align: right;font-size: 25px; background-color: #FFD4D4;"  type="text" class="form-control" value=""></div>
                </div>
                <div class="row mt-2">
                    <div class="col"><div class="float-left" style="font-size: 200%;color:blue">Kembalian: </div></div>
                    <div class="col"><input id="nominalkembalian"  placeholder="Rp 0,00" style="text-align: right; font-size: 25px;  background-color: #AACB73"  type="text" class="form-control" value=""></div>
                </div>
                <div class="row mt-2">
                    <div class="col"><div id="labelscanqris" class="float-left" style="display:none;font-size: 200%;color:blue">Scan QRIS: </div></div>
                    <div class="col"><div id="qrcodeclosepayment" style="text-align: center;"></div>
                    <div id="durasiscanqris" style="text-align: center;display:none;color:red"></div>
                    <button id="btncektransaksipayment" style="display:none;" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-vote-yea ms-2"></i> Cek Transaksi </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnsimpanpaygateway" class="btn btn-flat-danger btn-lg mr-2"> [F6] Buat Trx QRIS</button>
                <button class="btn btn-flat-warning btn-lg mr-2"> [F7] Pakai Voucher</button>
                <button id="btnsimpantransaksi" class="btn btn-flat-success btn-lg"> <i class="fa fa-print ms-2"></i> [End] Simpan Transaksi</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="salesmandikasir" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Pilih Sales Yang Tersedia</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <input id="textpencariansuplierkasir" type="text" class="form-control mt-2" placeholder="Masukkan nama / kode pelanggan"><hr>
            <table id="kasir_daftarsalesman" class="table table-bordered table-striped table-hover nowrap">
                <thead>
                    <tr>
                        <th style="text-align:center">Kode Sales</th>
                        <th style="text-align:center">Nama Sales</th>
                        <th style="text-align:center">Alamat</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align:center">Kode Sales</th>
                        <th style="text-align:center">Nama Sales</th>
                        <th style="text-align:center">Alamat</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </tfoot>
            </table>
            </div>
            <div class="modal-footer">
            <p class="mb-0">Sales akan ditampilakn pada semua status baik aktif maupun tidak aktif, gunakan pencarian beradasarkan KODE atau NAMA sales guna mencari informasi sales yang spesifik. Data ditampilkan per pencarian maximal 50 Data</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="memberdikasir" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Pilih Member Yang Tersedia</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <input id="textpencarianmemberkasir" type="text" class="form-control mt-2" placeholder="Masukkan nama / kode pelanggan"><hr>
            <table id="kasir_daftarmember" class="table table-bordered table-striped table-hover nowrap">
                <thead>
                    <tr>
                        <th style="text-align:center">Kode Member</th>
                        <th style="text-align:center">Nama Member</th>
                        <th style="text-align:center">Alamat</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align:center">Kode Member</th>
                        <th style="text-align:center">Nama Member</th>
                        <th style="text-align:center">Alamat</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </tfoot>
            </table>
            </div>
            <div class="modal-footer">
            <p class="mb-0">Member akan ditampilakn pada semua status baik aktif maupun tidak aktif, gunakan pencarian beradasarkan KODE atau NAMA pelanggan guna mencari informasi member yang spesifik. Data ditampilkan per pencarian maximal 50 Data</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterbycategori">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Pilih Barang Berdasarkan Kategori</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <div class="container">
            <input id="textpencariankategori" type="text" class="form-control mt-2" placeholder="Filter nama kategori"><hr>
                <div id="tampilankategori"></div>
            </div>  
            </div>
            <div class="modal-footer">
                <h5>Barang berdasarkan kategori tidak ditemukan, silahkan cek informasi barang tersebut pada MASTER ITEM di backpanel. Silahkan hubungi ADMIN / Petugas wewenang untuk melaporkan hal tersebut </h5>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="daftarnotapending" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Nota Pending Transaksi</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <div class="container">
                <input id="txtpencariannotapending" type="text" class="form-control mt-2" placeholder="Masukkan Keterangan Nota Pending">
                <hr>
                <table id="kasir_daftarnotapending" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th style="text-align:center">Keterangan Pending</th>
                            <th style="text-align:center">Jumlah Barang</th>
                            <th style="text-align:center">Total Belanja</th>
                            <th style="text-align:center">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="text-align:center">Keterangan Pending</th>
                            <th style="text-align:center">Jumlah Barang</th>
                            <th style="text-align:center">Total Belanja</th>
                            <th style="text-align:center">Aksir</th>
                        </tr>
                    </tfoot>
                </table>
            </div>  
            </div>
            <div class="modal-footer">
                <h5>Informasi yang didalam tabel tidak berpengaruh terhadap stok toko. Silahkan hapus atau kosongkan jika tidak diperlukan</h5>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="daftarpenjualan" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Penjualan Hari Ini</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <div class="container">
                <input id="txtpencariannota" type="text" class="form-control mt-2" placeholder="Masukkan No Transaksi">
                <div class="input-group input-daterange mb-2 mt-2">
                    <input id="tanggalawalnota" type="text" class="form-control" placeholder="Masukkan Tanggal Awal Trx">
                    <div class="input-group-prepend input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                    </div>
                    <input id="tanggalakhirnota" type="text" class="form-control" placeholder="Masukkan Tanggal Akhir Trx">
                </div>
                <hr>
                <table id="kasir_daftarpenjualan" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th style="text-align:center">AI</th>
                            <th style="text-align:center">No Transaksi</th>
                            <th style="text-align:center">Total Belanja</th>
                            <th style="text-align:center">Waktu Transaksi</th>
                            <th style="text-align:center">Waktu Pembayaran</th>
                            <th style="text-align:center">Keterangan Trx</th>
                            <th style="text-align:center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align:center">AI</th>
                            <th style="text-align:center">No Transaksi</th>
                            <th style="text-align:center">Total Belanja</th>
                            <th style="text-align:center">Waktu Transaksi</th>
                            <th style="text-align:center">Waktu Pembayaran</th>
                            <th style="text-align:center">Keterangan Trx</th>
                            <th style="text-align:center">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>  
            </div>
            <div class="modal-footer">
                <h5>Pada informasi ini anda hanya dapat melihat transaksi yang di pilih. Jika terdapat kesalahan atau membutuhkan perubahan informasi mengenai transaksi terkait, silahkan hubungi ADMIN yang bertugas. Terima kasih</h5>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="informasimember">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Detail Dari Member</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet widget1">
                    <div style="background-image: url('https://nl.edu/media/nledu/content-assets/documents/identity/LinkedIn-banner-NLUemployees-520x260.jpg');background-size:100% 100%;" class="widget1-display widget1-display-top widget1-display-sm justify-content-between bg-primary text-white">
                        <div class="widget1-group">
                            <div class="widget1-addon">
                                <button class="btn btn-label-light">2019</button>
                            </div>
                        </div>
                        <div class="widget1-group">
                            <h3 class="widget1-title">Personal profile</h3>
                        </div>
                    </div>
                    <div class="widget1-body">
                        <!-- BEGIN Rich List -->
                        <div class="rich-list-item p-0 mb-3">
                            <div class="rich-list-prepend">
                                <!-- BEGIN Avatar -->
                                <div class="avatar">
                                    <div class="avatar-display"><img src="https://sm.ign.com/ign_ap/cover/a/avatar-gen/avatar-generations_hugw.jpg" alt="Avatar image"></div>
                                </div>
                                <!-- END Avatar -->
                            </div>
                            <div class="rich-list-content">
                                <h4 class="rich-list-title" id="namapelanggandetail">Nama Pelanggan</h4>
                                <span class="rich-list-subtitle" id="alamatpelanggandetail">Alamat Pelanggan</span>
                            </div>
                            <div class="rich-list-append rich-list-append d-flex flex-column">
                                <h3 class="font-weight-bolder mb-0"  style="color:red">32</h3>
                                <small class="text-muted">Poin Belanja</small>
                            </div>
                        </div>
                        <!-- END Rich List -->
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-sm-6 col-form-label"> <h4 class="rich-list-title"> Limit Batas Piutang :</h4></label>
                            <div class="col-sm-6"><span class="rich-list-subtitle"  id="limitbataspiutangdetail"> Rp. 0</span></div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-sm-6 col-form-label">  <h4 class="rich-list-title"> Member Id Terpilih :</h4> </label>
                            <div class="col-sm-6"><span class="rich-list-subtitle"  id="memberiddetail">1000001</span></div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-sm-6 col-form-label">  <h4 class="rich-list-title"> Nomor Telepon :</h4> </label>
                            <div class="col-sm-6"><span class="rich-list-subtitle"  id="nomortelepondetail">Telepon tidak dapat ditampilkan</span></div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-sm-6 col-form-label"> <h4 class="rich-list-title"> Alamat Email :</h4></label>
                            <div class="col-sm-6"><span class="rich-list-subtitle"  id="alamatemaildetail">Alamat tidak dapat ditampilkan</span></div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-sm-6 col-form-label"> <h4 class="rich-list-title"> Sisa Saldo Deposit :</h4></label>
                            <div class="col-sm-6"><span class="rich-list-subtitle"  id="totaldeposit">Rp. 0</span></div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-sm-6 col-form-label"> <h4 class="rich-list-title"> Kota Asal :</h4></label>
                            <div class="col-sm-6"><span class="rich-list-subtitle"  id="kotamemberdetail">Kota Malang</span></div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-sm-6 col-form-label"> <h4 class="rich-list-title"> Besaran Limit Piutang :</h4></label>
                            <div class="col-sm-6"><span class="rich-list-subtitle"  id="limitbataspiutangdetail">Rp. 0</span></div>
                        </div>
                        <hr><a href="javascript:void(0)" class="btn btn-label-primary btn-block mb-1">Lihat Transaksi Penjualan</a>
                        <h5>Informasi yang ditampilkan adalah informasi yang benar. Jikalau terdapat kesalahan dalam penampilan informasi, silahakan hubungi Administrator / SPV dari toko anda</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaldetailbarang" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Varian Barang <span id="juduldetailbarang"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="kodebarangv" class="col-sm-3 col-form-label">Kode Barang</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input style="font-size: 15px" readonly value="" type="text" id="kodebarangv" class="form-control">
                        </div>
                    </div>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="namabarangv" class="col-sm-3 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input style="font-size: 15px" readonly value="" type="text" id="namabarangv" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label style="font-size: 120%;" for="hargajualv" class="col-sm-3 col-form-label">Harga Jual Dasar</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input readonly style="font-size: 15px" value="" type="text" id="hargajualvstak" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label style="font-size: 120%;" for="hargajualv" class="col-sm-3 col-form-label">Harga Jual Dasar Sementara</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input readonly style="font-size: 15px" value="" type="text" id="hargajualasliv" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label style="font-size: 120%;" for="hargajualv" class="col-sm-3 col-form-label">Harga Jual Barang<br>
                        <div class="custom-control custom-checkbox">
                            <input checked type="checkbox" class="custom-control-input" id="paksaubah">
                            <label style="font-size: 80%;" class="custom-control-label" for="paksaubah">Paksa Ubah Harga Jual</label>
                        </div>
                    </label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input style="font-size: 15px" value="" type="text" id="hargajualv" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-1"><label style="font-size: 120%;" for="qtyv" class="col-sm-3 col-form-label">QTY</label></div>
                    <div class="col-sm-2"><input style="font-size: 15px" readonly type="text" id="qtyv" class="form-control"></div>
                </div>
                <div class="row"><div class="col"><p> Untuk ubah harga jual pastikan di akhir transaksi, karena harga yang anda set akan berubah jika memenuhi syarat HARGA GROSIR. Gunakan fitur paksa ubah harga secara manual jika anda ingin bersikeras untuk merubah</p></div></div>
                <div class="row"><div class="col"><textarea id="catatanperbarang" class="form-control" rows="5" placeholder="Berikan catatan jika ada yang ingin dibedakan mengenai produk ini... Contoh: Tolong sendirikan untuk dibungkus dengan kado / tolong dimasak setengah matang"></textarea></div></div>
                <div class="row"><div class="col"><hr/></div><div class="col-auto">PILIHAN VARIAN</div><div class="col"><hr/></div></div>
                <div class="row"><div class="col">SEBELUMNYA : <span id="pilihanvariansebelumnya"></span></div></div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="detailvarianbarang"></div>
                    </div>
                    <div class="col-md-6">
                    TOTAL HARGA JUAL<br>
                    <span style="font-size: 24px;color:red;" id="hargajualbarudetail">Rp. 0,00</span>
                    <button  data-dismiss="modal" style="font-size: 120%;" class="btn btn-block btn-success"> Oke.. Tutup Halaman</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalreservation" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Isi Formulir Pendaftaran Dengan Benar</h5>
                <button class="btn btn-label-success btn-block mr-2" onclick="konfirmasipesananmeja()"><i class="fas fa-add"></i> Oke.. Formulir Sudah Benar</button>
                <button class="btn btn-label-danger" onclick="batalkanmodal()"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="kodepesan_rev" class="col-sm-3 col-form-label">Kode Pesan</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input style="font-size: 15px" readonly value="<?= $kodepesan_psn;?>" type="text" id="kodepesan_rev" class="form-control">
                        </div>
                    </div>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="kodemenupesan_rev" class="col-sm-3 col-form-label">Kode Menu Pesanan</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input style="font-size: 15px" readonly value="<?= $kodemenupesanan_psn ;?>" type="text" id="kodemenupesan_rev" class="form-control">
                        </div>
                    </div>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="berapaorang_rev" class="col-sm-3 col-form-label">Untuk Berapa Orang</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <input style="font-size: 15px" value="<?= $untukberapaorang_psn;?>" placeholder="Masukkan berapa banyak orang yang hadir" type="text" id="berapaorang_rev" class="form-control">
                        </div>
                    </div>
                    <label for="berapaorang_rev" class="col-sm-2 col-form-label">Orang</label>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="namapemesan_rev" class="col-sm-3 col-form-label">Nama Pemesan</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input style="font-size: 15px" value="<?= $pemesan_psn;?>" type="text" id="namapemesan_rev" class="form-control">
                        </div>
                    </div>
                    <label for="notelp_rev" class="col-sm-2 col-form-label">No Telp</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input style="font-size: 15px" value="<?= $notelpn_psn;?>" type="text" id="notelp_rev" class="form-control">
                        </div>
                    </div>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="tanggalawal_rev" class="col-sm-3 col-form-label">Tanggal Pesan</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input readonly style="font-size: 15px" value="" type="text" id="tanggalawal_rev" class="form-control">
                        </div>
                    </div>
                    <label for="waktuawal_rev" class="col-sm-2 col-form-label">Waktu Pesan</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input readonly style="font-size: 15px" value="" type="text" id="waktuawal_rev" class="form-control">
                        </div>
                    </div>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="tanggalakhir_rev" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input readonly style="font-size: 15px" value="" type="text" id="tanggalakhir_rev" class="form-control">
                        </div>
                    </div>
                    <label for="waktuselesai_rev" class="col-sm-2 col-form-label">Waktu Selesai</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input readonly style="font-size: 15px" value="" type="text" id="waktuselesai_rev" class="form-control">
                        </div>
                    </div>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="warnamemo_rev" class="col-sm-3 col-form-label">Warna Untuk Penanda</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input style="font-size: 15px" value="<?= "#".$warnamemo_psn;?>" type="color" id="warnamemo_rev" class="form-control">
                        </div>
                    </div>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="warnamemo_rev" class="col-sm-3 col-form-label">DP Reservasi</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input style="font-size: 15px" value="<?= $uangmuka_psn ;?>" type="text" id="dp_rev" class="form-control">
                        </div>
                        <strong>CATATAN : </strong><span style="color:red">Usahakan untuk DP jangan gunakan PEMBAYARAN SPLIT. Contoh : DP 100K. 30K KARTU DEBIT 30K KARTU KREDIT 40K TUNAI. Usahakan pilih salah satu saja seperti TUNAI atau KREDIT atau E-MONEY<span>
                    </div>
                </div>
                <div style="font-size: 120%;" class="form-group row mt-2">
                    <label for="kodemejaterpilih_rev" class="col-sm-3 col-form-label">Meja Yang Dipilih</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input style="font-size: 15px" placeholder="Silahkan Tekan PILIH MEJA untuk melihat meja yang tersedia" readonly value="<?= $kodemeja_psn ;?>" type="text" id="kodemejaterpilih_rev" class="form-control">
                        </div>
                    </div>
                </div>
                <button data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="font-size: 120%;" class="btn btn-block btn-primary mt-2"> PILIH MEJA </button>
                <div class="collapse" id="collapseExample">
                    <div class="portlet mb-md-0">
                        <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title">Lokasi Meja Berdasarkan Lokasi</h3>
                            <div class="portlet-addon">
                                <div id="daftarlantaitersedia"></div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN Tab -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="portlet1-home">
                                    <div id="kontendaftarmeja"></div>                          
                                </div>
                            </div>
                            <!-- END Tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="daftartempatdisewakan" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Tempat Yang Dapat Anda Sewakan</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="portlet mb-md-0">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">Tabel Informasi Penyewaan Tempat</h3>
                        <div class="portlet-addon">
                            <div id="daftarlantaitersediad"></div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="input-group input-daterange mb-2">
                            <input id="filtertanggalreservasiawal" type="text" class="form-control" placeholder="Dari Tanggal">
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text"><i class="fa fa-ellipsis-h"></i></span>
                            </div>
                            <input id="filtertanggalreservasiakhir" type="text" class="form-control" placeholder="Sampai Tanggal">
                        </div>
                        <table id="tabel_pesanananmeja_kasir" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Waktu Transaksi</th>
                                    <th>Kode</th>
                                    <th>Pemesan</th>
                                    <th>No Telepon</th>
                                    <th>Untuk</th>
                                    <th>Uang Muka</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="portlet mb-md-0">
                    <div class="portlet-body">
                        <!-- BEGIN Tab -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="portlet1-home">
                                <div id="kontendaftarmejad"></div>                          
                            </div>
                        </div>
                        <!-- END Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaldetailmeja" data-backdrop="static" data-keyboard="true" tabindex="9999">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulir Penambahan Barang Bersamaan</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <hr>
            <table id="tabel_pesanananmeja" class="table table-bordered table-striped table-hover nowrap">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Tanggal Pesan</th>
                        <th>Kode</th>
                        <th>Pemesan</th>
                        <th>No Telepon</th>
                        <th>Untuk</th>
                        <th>Total Belanja</th>
                        <th>Uang Muka</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalmodeeditaktif" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MODE EDIT PENJUALAN AKTIF</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                ANDA DALAM MODE AKTIF
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_session_almost_logout" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Zzz..... Ngroook.... Hallo Apa Ada Orang. Tok Tok!!!!</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet widget1">
                    <div style="background-image: url(https://cdn.kibrispdr.org/data/1779/gif-sleepy-0.gif);background-position: center center;background-repeat: no-repeat;background-size: cover;" class="widget1-display widget1-display-top widget1-display-sm justify-content-between bg-primary text-white">
                        <div class="widget1-group">
                            <div class="widget1-addon">
                                <button class="btn btn-label-light"><?= date('Y');?></button>
                            </div>
                        </div>
                        <div class="widget1-group">
                            <h3 class="widget1-title">Tok.. Tok..</h3>
                        </div>
                    </div>
                    <div class="widget1-body">
                        <blockquote class="blockquote">
                        <div class="col"><hr style="border: 2px solid green;border-radius: 5px;"/></div><div class="col-auto"><h3 class="text-center">Anda telah melamun selama 10 menit. Sistem akan mengeluarkan akun anda secara paksa dalam 1 jam dari awal anda melamun.</h3></div><div class="col"><hr style="border: 2px solid green;border-radius: 5px;"/></div>
                            <p id="QuoteText" class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <footer class="blockquote-footer">Someone famous in <cite id="author" title="Source Title">Source Title</cite>
                            </footer>
                        </blockquote>
                        <a href="<?= base_url().'auth/logout';?>" class="btn btn-label-danger btn-block btn-wide">Logout Kah ?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="panggildompetdata" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaksi Acipay - Dompet Data<br><div style="font-size:1.5em;font-family: 'Irish Grover', cursive;">SALDO ANDA SEKARANG : Rp. <span id="saldosekarang">0</span></div></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="portlet widget1">
                    <div id="tampilankategori_acipay"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.11/index.min.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js" integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>

<script type="text/javascript" src="<?= base_url();?>scripts/mandatory.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/chatting.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/core.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/vendor.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/penjualan/kasir.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/resto/daftarmeja.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/timepickerseira.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/easyqrcodejs/easy.qrcode.min.js"></script>

<script type="text/javascript">
let menukiri = 1, menukanan = 0;
var pajaktoko = "<?=$pajaktoko;?>";
var vnominalpotongan = "<?=$nominalpotongan;?>";
var pajaknegara = "<?=$pajaknegara;?>";
var vpajaktoko = "<?=$vpajaktoko;?>";
var vpajaknegara = "<?=$vpajaknegara;?>";
var jenistransaksienum = "TUNAI";
var iseditkasir = "<?=$isedit?>";
var baseurljavascript = "<?=DYBASESEURL;?>";
var jenistransaksi = "<?=$jenistransaksi;?>";
var tipeordernya = (iseditkasir == "true" ? <?= $tipetransaksi;?> : 0);
var kodepesanmeja = "<?= $kodemeja_psn;?>";
var hargajualv = new AutoNumeric("#hargajualv", {decimalCharacter : ',',digitGroupSeparator : '.',})
var hargajualasliv = new AutoNumeric("#hargajualasliv", {decimalCharacter : ',',digitGroupSeparator : '.',})
var qtyv = new AutoNumeric("#qtyv", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominaluangmukares = new AutoNumeric("#nominaluangmukares", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominaltunai = new AutoNumeric("#nominaltunai", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominalkredit = new AutoNumeric("#nominalkredit", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nomorkartudebit = new AutoNumeric("#nomorkartudebit", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nomorkartukredit = new AutoNumeric("#nomorkartukredit", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominalemoney = new AutoNumeric("#nominalemoney", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominaltotalbayar = new AutoNumeric("#nominaltotalbayar", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominalkembalian = new AutoNumeric("#nominalkembalian", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominalpotongan = new AutoNumeric("#nominalpotongan", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominalpajaktoko = new AutoNumeric("#pajaktoko", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominalpajaknegara = new AutoNumeric("#pajaknegara", {decimalCharacter : ',',digitGroupSeparator : '.',})
var nominalhargajualvstak = new AutoNumeric("#hargajualvstak", {decimalCharacter : ',',digitGroupSeparator : '.',})
var dp_rev = new AutoNumeric("#dp_rev", {decimalCharacter : ',',digitGroupSeparator : '.',})
var berapaorang_rev = new AutoNumeric("#berapaorang_rev", {decimalCharacter : ',',digitGroupSeparator : '.',})
var jsonStrjenisvarian = '{"jenisvarian":[]}';
let informasikasir = '{"keranjangbelanjaarray":[]}';
var csrfName = '<?= csrf_token() ?>';

$(document).ready(async function() {
    idleInterval;
    loadAllData();
    $('#katakuncipencariankasir').focus();
    $('#keranjangkosong').html('<div style="position: absolute;top: 8%; bottom: 0; left: 0; right: 0;margin: auto;" class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Keranjang Belanja Anda Masih Kosong Lo... Silahkan Pilih Item Untuk di Transkasi</h4><!-- BEGIN Avatar --><div class="avatar avatar-label-primary avatar-circle widget12 mb-4"><div class="avatar-display"><i class="fas fa-cart-arrow-down"></i></div></div><!-- END Avatar --><a href="javascript:void(0)" class="btn btn-primary btn-wider">Pilih Barang</a></div>');
    $("#kolomkredit").hide();
    $("#kolomkartudebit").hide();
    $("#kolomkartukredit").hide();
    $("#kolomemoney").hide();
    $('#tanggaltrxfield').val((iseditkasir == "false" ? moment().format('DD-MM-YYYY') : moment("<?= $tanggaltransaksi;?>").format('DD-MM-YYYY') ));
    $("#tanggaltrxfield").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#tanggalawalnota').val(moment().format('DD-MM-YYYY'));
    $("#tanggalawalnota").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#tanggalakhirnota').val(moment().format('DD-MM-YYYY'));
    $("#tanggalakhirnota").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#filtertanggalreservasiawal').val(moment().format('DD-MM-YYYY'));
    $("#filtertanggalreservasiawal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#filtertanggalreservasiakhir').val(moment().endOf('month').format('DD-MM-YYYY'));
    $("#filtertanggalreservasiakhir").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    /*untuk pesan tempat*/
    $('#tanggalawal_rev').val((iseditkasir == "false" ? moment().format('DD-MM-YYYY') : ('<?=$tanggal_psn ;?>' == '' ? moment().format('DD-MM-YYYY') : moment("<?= $tanggal_psn;?>").format('DD-MM-YYYY'))));
    $("#tanggalawal_rev").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#tanggalakhir_rev').val((iseditkasir == "false" ? moment().format('DD-MM-YYYY') : ('<?=$tanggal_psn ;?>' == '' ? moment().format('DD-MM-YYYY') : moment("<?= $tanggala_psn;?>").format('DD-MM-YYYY') )));
    $("#tanggalakhir_rev").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#waktuawal_rev').clockTimePicker();
    $('#waktuselesai_rev').clockTimePicker();
    $('#waktuawal_rev').clockTimePicker('value', (iseditkasir == "false" ? moment().format('HH:mm') : ("<?= $waktu_psn;?>" == "" ? moment().format('HH:mm') : moment("<?= $waktu_psn;?>", 'HH:mm:ss').format('HH:mm'))));
    $('#waktuselesai_rev').clockTimePicker('value', (iseditkasir == "false" ? moment().add(3, 'hours').format('HH:mm') : ("<?= $waktua_psn;?>" == "" ? moment().add(2, 'hours').format('HH:mm') : moment("<?= $waktua_psn;?>", 'HH:mm:ss').format('HH:mm') )));
    $("#tanggalawal_rev").on("change", function() {
        $("#tanggalakhir_rev").val($("#tanggalawal_rev").val())
    });
    $("#waktuawal_rev").on("change", function() {
        $("#waktuselesai_rev").val(moment($("#waktuawal_rev").val(),'HH:mm:ss').add(3, 'hours').format('HH:mm'))
    });
    getCsrfTokenCallback(function() {
        $('#cmblokasioutlet').select2({
            allowClear: true,
            placeholder: 'Mau Pindah Outlet ?',
            ajax: {
                url: baseurljavascript + 'auth/outlet',
                method: 'POST',
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return {
                        [csrfName]:csrfTokenGlobal,
                        KATAKUNCIPENCARIAN: "",
                        KODEUNIKMEMBER: session_kodeunikmember,
                    }
                },
                processResults: function (data) {
                    parseJSON = JSON.parse(data);
                    return {
                        results: $.map(parseJSON, function (item) {
                            return {
                                text: "OUTLET : " + item.group+" ["+item.namaoutlet+"] ",
                                id: item.group,
                            }
                        })
                    }
                }
            },
        });
    });
    if (iseditkasir == "true"){
        //$("#modalmodeeditaktif").modal('show');  
        tipeorder('<?= $tipetransaksi;?>','onload')
    }
});
async function loadAllData() {
    try {
        // Panggil semua fungsi secara asynchronous
        const promise1 = initializeDataTables();
        const promise2 = date_time();
        const promise3 = loadnotakasir();
        const promise4 = loadkeranjangsementara();
        const promise5 = loaddaftarbarang();
        const promise6 = GenerateQuote();
        await Promise.all([promise1, promise2, promise3, promise4, promise5, promise6]);
    } catch (error) {
        console.error("Terjadi kesalahan saat memuat data:", error);
    }
}
function date_time() {
    now = moment().format('DD-MM-YYYY HH:mm:ss');
    document.getElementById('tanggaltrx').innerHTML = now;
    setTimeout(function () { date_time(); }, 1000);
}
const GenerateQuote = async () =>{
    var url="https://type.fit/api/quotes";
    const response=await fetch(url);
    const Quote_list = await response.json();
    const randomIdx = Math.floor(Math.random()*Quote_list.length);
    const quoteText=Quote_list[randomIdx].text;
    const auth=Quote_list[randomIdx].author;
    
    if(!auth) author = "Anonymous";
    document.getElementById("QuoteText").innerHTML=quoteText;
    document.getElementById("author").innerHTML="~ "+auth;
}
function pilihjenistranskasi(pilih){
    function clear(){
        nominaltunai.set(0);
        nominalkredit.set(0);
        nomorkartudebit.set(0);
        nomorkartukredit.set(0);
        nominalemoney.set(0);
        nominaltotalbayar.set((nominaltunai.getNumber() + nominalkredit.getNumber() + nomorkartudebit.getNumber() + nomorkartukredit.getNumber() + nominalemoney.getNumber()));
        nominalkembalian.set(Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()) * -1);
        $("#pilihbankkreditdaftar").hide();
        $("#pilihemoneyaftar").hide();
        $("#pilihbankdebitdaftar").hide();
    }
    if(pilih.value == "tunai") {
        jenistransaksienum = "TUNAI";
        $("#kolomtunai").show();
        $("#kolomkredit").hide();
        $("#kolomkartudebit").hide();
        $("#kolomkartukredit").hide();
        $("#kolomemoney").hide();
        $("#nominaltunai").focus();
        $("#nominaltunai").select()
    }else if(pilih.value == "kredit"){
        jenistransaksienum = "KREDIT";
        $("#kolomtunai").hide();
        $("#kolomkredit").show();
        $("#kolomkartudebit").hide();
        $("#kolomkartukredit").hide();
        $("#kolomemoney").hide();
        $("#nominalkredit").focus();
        $("#nominalkredit").select()
    }else if(pilih.value == "kartu") {
        jenistransaksienum = "KARTU";
        $("#kolomkartudebit").show();
        $("#kolomtunai").hide();
        $("#kolomkredit").hide();
        $("#kolomkartukredit").show();
        $("#kolomemoney").show();
        $("#nomorkartudebit").focus();
        $("#nomorkartudebit").select()
    }else if(pilih.value == "splitcash") {
        jenistransaksienum = "SPLITCASH";
        $("#kolomtunai").show();
        $("#kolomkredit").hide();
        $("#kolomkartudebit").show();
        $("#kolomkartukredit").show();
        $("#kolomemoney").show();
        $("#nominaltunai").focus();
        $("#nominaltunai").select()
    }
    if (iseditkasir == "false"){
        nominaltunai.set(0);
        nominalkredit.set(0);
        nomorkartudebit.set(0);
        nomorkartukredit.set(0);
        nominalemoney.set(0);
        nominaltotalbayar.set(0);
        nominalkembalian.set(Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()) * -1);
        $("#pilihbankkreditdaftar").hide();
        $("#pilihemoneyaftar").hide();
        $("#pilihbankdebitdaftar").hide();
    }else{
        nominaltotalbayar.set((nominaltunai.getNumber() + nominalkredit.getNumber() + nomorkartudebit.getNumber() + nomorkartukredit.getNumber() + nominalemoney.getNumber()));
        nominalkembalian.set(nominaltotalbayar.getNumber() - Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()));
        if (jenistransaksienum === "SPLITCASH" || jenistransaksienum === "KARTU"){
            if (nomorkartudebit.getNumber() > 0){pilihbankdebit()}
            if (nomorkartukredit.getNumber() > 0){pilihbankkredit()}
            if (nominalemoney.getNumber() > 0){pilihemoney()}
            setTimeout(function() {
                if (nomorkartudebit.getNumber() > 0){pilihbankterpilih("D","<?= $bankdebit;?>")}
                if (nomorkartukredit.getNumber() > 0){pilihbankterpilih("K","<?= $bankkredit;?>")}
                if (nominalemoney.getNumber() > 0){pilihbankterpilih("E","<?= $vendoremoney;?>")}
            }, 1000);
        }else{
            if (jenistransaksi === "TUNAI" || jenistransaksi === "KREDIT"){}else{clear();}
        }
        if (nominaltotalbayar.getNumber() > 0){
            swal.fire({
                title: "Jenis Transaksi",
                text: "Apakah anda ingin mereset JENIS TRANSAKSI pada TRANSAKSI ini ?",
                icon:"warning",
                showCancelButton:true,
                confirmButtonText: "Oke, 0 Kan Semua!",
                cancelButtonText: "Biarin Aja!",
            }).then(function(result){
                if(result.isConfirmed){
                    clear();
                }
            })
        }
    }
    proseskonfirmasipembelian();
}
function verifikasikeluar(){
	Swal.fire({
		title: 'Keluar Dari Sistem?',
		html: "Apakah anda yakin ingin keluar dari sistem ACIRABA POS. Kami tunggu kedatangan anda kembali. <strong>SEMOGA HARIMU MENYENANGKAN</strong>",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Oke, Byee!!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.replace('<?= base_url().'auth/logout';?>');
		}
	})
}
$("#cmblokasioutlet").change(function () {
    Swal.fire({
        title: "Apakah anda ingin beralih KE OUTLET : " + $("#cmblokasioutlet").val(),
        text: "Informasi saat ini akan diubah dengan informasi yang berkaitan dengan KODE OUTLET "+$("#cmblokasioutlet").val()+". Anda dapat kembali ke outlet sebelumnya dengan cara yang sama",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Teleport!!'
    }).then((result) => {
        if (result.isConfirmed) {
            session_outlet = $("#cmblokasioutlet").val();
            window.location = baseurljavascript+"auth/ubahoutlet/"+$("#cmblokasioutlet").val();
        }
    })
});
/* alert idle */
var idleMax = 60;
var idleTime = 0;
var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval   
    $(window).on('keydown keyup', function(e) { idleTime = 0; });
    $(document).mousemove(function(event){ idleTime = 0; });
function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 20) {
        $("#modal_session_almost_logout").modal('show');
        const audio = new Audio(baseurljavascript+"sound/mixkit-electric-fence-alert-2969.wav");
        audio.play();
    }
    if (idleTime > idleMax) { 
        window.location.replace('<?= base_url().'auth/logout';?>');
    }
} 
/* key bind kasir */
$('#qtykeluarkasir').keypress(function (e) {let key = e.which; if(key == 13){$('#katakuncipencariankasir').focus();return false;}});
$('#katakuncipencariankasir').keypress(function (e) {let key = e.which; if(key == 13 && $('#katakuncipencariankasir').val() == ""){$('#qtykeluarkasir').focus();return false;}});
$('#nominaltunai, #nominalkredit, #nomorkartudebit, #nomorkartukredit, #nominalemoney').keypress(function (e) {let key = e.which; if(key == 13){ keybindenterkonfirmasipembayaran($(this).attr('id')) }});
function tipeorder(jenis,onload){
    $("#iconresrvasi").css({'color':'black'});
    $("#icondinein").css({'color':'black'});
    if (jenis == "1"){
        tipeordernya = 1;
        loadnotareservasi()
        $('#titlekasir').html("ACIRABA [RESERVATION]");
        $('#titlekonfirmasipembayaran').html("[RESERVATION]");
        $('#kodemenupesan_rev').val($('#notakasirpenjualan').html());
        $("#keterangantransaksi").attr("placeholder", "Ketikkan keterangan untuk TRX ini ?").val("").focus().blur();
        $("#iconresrvasi").css({'color':'red'});
        $("#icondinein").css({'color':'black'});
        if (onload !== "onload"){
            $("#modalreservation").modal('show');   
        }
    }else if (jenis == "2"){
        if (tipeordernya == 0){
            tipeordernya = 2;
            $('#titlekasir').html("ACIRABA [DINE IN]");
            $('#titlekonfirmasipembayaran').html("[DINE IN]");
            $("#keterangantransaksi").attr("placeholder", "Informasi DINE-IN. Ex: Nomor Antrian").val("").focus().blur();
            $("#icondinein").css({'color':'red'});
            $("#iconresrvasi").css({'color':'black'});
        }else{
            if (onload == "onload"){
                tipeordernya = 2;
                $('#titlekasir').html("ACIRABA [DINE IN]");
                $('#titlekonfirmasipembayaran').html("[DINE IN]");
                $("#icondinein").css({'color':'red'});
                $("#iconresrvasi").css({'color':'black'});
            }else{
                tipeordernya = 0;
                $('#titlekasir').html("ACIRABA");
                $('#titlekonfirmasipembayaran').html("");
                $("#keterangantransaksi").attr("placeholder", "Ketikkan keterangan untuk TRX ini ?").val("").focus().blur();
                $("#icondinein").css({'color':'black'});
            }
        }
    }else if (jenis == "3"){
        $("#keterangantransaksi").attr("placeholder", "Ketikkan keterangan untuk TRX ini ?").val("").focus().blur();
        if (tipeordernya == 0){
            tipeordernya = 3;
            panggilsalesman();
            $('#titlekasir').html("ACIRABA [TAKE AWAY]");
            $('#titlekonfirmasipembayaran').html("[TAKE AWAY]");
        }else{
            tipeordernya = 0;
            $('#titlekasir').html("ACIRABA");
            $('#titlekonfirmasipembayaran').html("");
            $('#namasalesman').html("Salesman Umum");
            $('#idsalesman').html("SLS1");
        }
    }
}
$('#nominalpotongan').on('keypress', debounce(function (e) {
    hitungpotongan()
}, 500));
$('#pajaktoko').on('keypress', debounce(function (e) {
    hitungpajak("manualtoko");
}, 500));
$('#pajaknegara').on('keypress', debounce(function (e) {
    hitungpajak("manualnegara");
}, 500));
$("#btnhitungpajaktoko").click(function() {
    hitungpajak("toko");
});
$("#btnhitungpajaknegara").click(function() {
    hitungpajak("negara");
});
$("#btnhitungpajak").click(function() {
    hitungpajak("toko");
    hitungpajak("negara");
});
$("#btnbatalpajak").click(function() {
    let totalbelanjaatas = Number($("#totalbelanjaatas").html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim())
    nominalpajaktoko.set(0)
    nominalpajaknegara.set(0)
    $("#grandtotal").html(formatuang(totalbelanjaatas - nominalpotongan.getNumber(),'id-ID','IDR'))
});
</script>
</body>
</html>