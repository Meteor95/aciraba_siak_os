<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="<?= base_url() ;?>styles/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet"/>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet"> 
	<link href="<?= base_url() ;?>styles/cssseira/style.css" rel="stylesheet">
	<link href="https://erayadigital.co.id/wp-content/uploads/2024/03/cropped-Logo-512-Eraya-Digital.png" rel="shortcut icon" type="image/x-icon">
	<link href="<?= base_url() ;?>styles/ltr-core.css" rel="stylesheet">
	<link href="<?= base_url() ;?>styles/ltr-vendor.css" rel="stylesheet">
	<link href="<?= base_url() ;?>styles/ltr-dashboard1.css" rel="stylesheet">
	<link href="<?= base_url() ;?>styles/core-default.css" rel="stylesheet">
	<?php if (isset($usedropzone)){ echo '<link rel="stylesheet" type="text/css" href="'.base_url().'scripts/dropzone-5.7.0/min/dropzone.min.css"/><link href="'.base_url().'styles/flexbin.css" type="text/css" rel="stylesheet" media="all" />';};?>
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdn.socket.io/4.1.2/socket.io.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.11/index.global.min.js'></script>
	<script src="<?=base_url();?>scripts/globalfn.js" type="text/javascript" ></script>
	<script type="text/javascript">
	var baseurljavascript = '<?= DYBASESEURL;?>';
	var baseurlsocket = '<?= BASEURLAPI;?>';
	var session_kodeunikmember='<?= session('kodeunikmember');?>';
	var session_pengguna_id='<?= session('pengguna_id');?>';
	var session_namapengguna='<?= session('namapengguna');?>';
	var session_outlet='<?= session('outlet');?>';
	var session_statusmember='<?= session('jenismerchant');?>';
	var statusbarang = 1;
	var csrfName = '<?= csrf_token() ?>';
	var jsonMenu = '<?= session('jsonmenu');?>';
	</script>
	<title>Panel Administrator System</title>
</head>

<body class="theme-light preload-active aside-active aside-mobile-minimized aside-desktop-maximized" id="fullscreen">
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
		<!-- BEGIN Aside -->
		<div class="aside">
			<div class="aside-header">
				<h3 class="aside-title"><img class="img-fluid mb-2" src="/images/login/logonya.png" alt=""></h3>
				<div class="aside-addon">
					<button class="btn btn-label-primary btn-icon btn-lg" data-toggle="aside">
						<i class="fa fa-times aside-icon-minimize"></i>
						<i class="fa fa-thumbtack aside-icon-maximize"></i>
					</button>
				</div>
			</div>
			<div class="aside-body" data-simplebar="data-simplebar">
				<!-- BEGIN Menu -->
				<div class="menu">
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Outlet Sekarang [<?= session('outlet');?>]</h2>
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle">
							<div class="menu-item-icon">
								<i class="fa fa-warehouse"></i>
							</div>
							<select class="form-control" id="cmblokasioutlet"></select>
						</button>
					</div>
					<div class="menu-item">
						<a href="<?= base_url() ;?>" data-menu-path="<?= base_url() ;?>" class="menu-item-link <?= $menuaktif == "0" ? "active" : "" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-desktop"></i>
							</div>
							<span class="menu-item-text ">Dashboard</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="<?= base_url().'akuntansi' ;?>" data-menu-path="<?= base_url() ;?>" class="menu-item-link <?= $menuaktif == "AK1" ? "active" : "" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-book"></i>
							</div>
							<span class="menu-item-text ">SIAK Aciraba</span>
						</a>
					</div>
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Master Data</h2>
					</div>
					<!-- END Menu Section -->
					<div id="menu_daftaritem" class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 1 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-pallet"></i>
							</div>
							<span class="menu-item-text">Daftar Item</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftaritem" class="menu-item-link <?= $submenuaktif == 1 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Item</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarkartustok" class="menu-item-link <?= $submenuaktif == 2 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Kartu Stok</span>
								</a>
							</div>
							<!--<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftardiskonitem" class="menu-item-link <?= $submenuaktif == 3 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Diskon Barang</span>
								</a>
							</div>-->
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarkuponbelanja" class="menu-item-link <?= $submenuaktif == 4 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Kupon Belanja</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 2 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-id-card-alt"></i>
							</div>
							<span class="menu-item-text">Data Personal</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarsuplier" class="menu-item-link <?= $submenuaktif == 5 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Suplier</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarmember" 
									class="menu-item-link <?= $submenuaktif == 6 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Member</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarsales" class="menu-item-link <?= $submenuaktif == 7 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Sales</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 3 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-info-circle"></i>
							</div>
							<span class="menu-item-text">Data Pendukung</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarsatuan" class="menu-item-link <?= $submenuaktif == 8 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Data Satuan</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarkategoribarang" class="menu-item-link <?= $submenuaktif == 9 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Data Kategori</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarkategorimember" class="menu-item-link <?= $submenuaktif == 11 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Data Kategori Anggota</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/daftarmetodepembayaran" class="menu-item-link <?= $submenuaktif == 10 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Data Metode Pembayaran</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/brand" class="menu-item-link <?= $submenuaktif == 15 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Data Brand</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>masterdata/principal" class="menu-item-link <?= $submenuaktif == 16 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Data Principal</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<!-- BEGIN Menu Section -->
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Penjualan</h2>
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 4 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-boxes"></i>
							</div>
							<span class="menu-item-text">Pesanan dan Retur</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url() ;?>penjualan/daftarreturpenjualan" class="menu-item-link <?= $submenuaktif == 13 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Retur Penjualan</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 5 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-cash-register"></i>
							</div>
							<span class="menu-item-text">Data Penjualan</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url() ;?>penjualan/daftarpenjualan" class="menu-item-link <?= $submenuaktif == 14 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Penjualan</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>penjualan/daftarhistoryhargajual" class="menu-item-link <?= $submenuaktif == 15 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">History Harga Jual</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>penjualan/daftarpiutang" class="menu-item-link <?= $submenuaktif == 16 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Piutang Anggota</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<a href="<?= base_url() ;?>resto/daftarmeja" class="menu-item-link <?= $submenuaktif == 20 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa-solid fa-book-bookmark"></i>
							</div>
							<span class="menu-item-text">Daftar Pesanan</span>
						</a>
					</div>
					<!-- END Menu Section -->
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Pembelian</h2>
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 6 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-boxes"></i>
							</div>
							<span class="menu-item-text">Faktur Pesan dan Retur</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url() ;?>pembelian/daftarreturpembelian" class="menu-item-link <?= $submenuaktif == 16 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Retur Pembelian</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 7 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-truck-loading"></i>
							</div>
							<span class="menu-item-text">Data Pembelian</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url() ;?>pembelian/daftarpembelian" class="menu-item-link <?= $submenuaktif == 17 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Pembelian</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>pembelian/daftarhistoryhargabeli" class="menu-item-link <?= $submenuaktif == 18 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">History Harga Beli</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url() ;?>pembelian/daftarhutangsuplier" class="menu-item-link <?= $submenuaktif == 19 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Daftar Hutang Suplier</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Penyesuaian</h2>
					</div>
					<div class="menu-item">
						<a href="<?= base_url() ;?>penyesuaian/stokopname" class="menu-item-link <?= $menuaktif == 8 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-people-carry"></i>
							</div>
							<span class="menu-item-text">Trx Opname Barang</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="<?= base_url() ;?>penyesuaian/mutasibarang" class="menu-item-link <?= $menuaktif == 9 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-archive"></i>
							</div>
							<span class="menu-item-text">Mutasi Stok Barang</span>
						</a>
					</div>
					<div class="menu-section">
						<div class="menu-section-icon">
							<i class="fa fa-ellipsis-h"></i>
						</div>
						<h2 class="menu-section-text">Laporan</h2>
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 10 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-atlas"></i>
							</div>
							<span class="menu-item-text">Laporan Master</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url().'laporan/masteritem' ;?>" class="menu-item-link <?= $submenuaktif == 21 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Laporan Master Item</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url().'laporan/mastersup' ;?>" class="menu-item-link <?= $submenuaktif == 22 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Laporan Master Suplier</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url().'laporan/mastermember' ;?>" class="menu-item-link <?= $submenuaktif == 23 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Laporan Master Member</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<button class="menu-item-link menu-item-toggle <?= $menuaktif == 11 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-atlas"></i>
							</div>
							<span class="menu-item-text">Laporan Penjualan</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url().'laporan/penjualan' ;?>" class="menu-item-link <?= $submenuaktif == 24 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Laporan Penjualan</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url().'laporan/returpenjualan' ;?>" class="menu-item-link <?= $submenuaktif == 25 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Laporan Return Penjualan</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
					<button class="menu-item-link menu-item-toggle <?= $menuaktif == 12 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-atlas"></i>
							</div>
							<span class="menu-item-text">Laporan Pembelian</span>
							<div class="menu-item-addon">
								<i class="menu-item-caret caret"></i>
							</div>
						</button>
						<!-- BEGIN Menu Submenu -->
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="<?= base_url().'laporan/pembelian' ;?>" class="menu-item-link <?= $submenuaktif == 26 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Laporan Pembelian</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="<?= base_url().'laporan/returpembelian' ;?>" class="menu-item-link <?= $submenuaktif == 27 ? "active" : "nonactive" ;?>">
									<i class="menu-item-bullet"></i>
									<span class="menu-item-text">Laporan Return Pembelian</span>
								</a>
							</div>
						</div>
						<!-- END Menu Submenu -->
					</div>
					<div class="menu-item">
						<a href="<?= base_url() ;?>laporan/hutang" class="menu-item-link <?= $menuaktif == 13 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-atlas"></i>
							</div>
							<span class="menu-item-text">Laporan Hutang</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="<?= base_url() ;?>laporan/piutang" class="menu-item-link <?= $menuaktif == 14 ? "active" : "nonactive" ;?>">
							<div class="menu-item-icon">
								<i class="fa fa-atlas"></i>
							</div>
							<span class="menu-item-text">Laporan Piutang</span>
						</a>
					</div>
				</div>
				<!-- END Menu -->
			</div>
		</div>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper">
			<!-- BEGIN Page Content -->
			<?= $this->renderSection('kontenutama'); ?>
			<!-- END Page Content -->
			<!-- BEGIN Footer -->
			<div class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-9">
							<p class="text-left mb-0">Copyright <i class="far fa-copyright"></i>
								2021 - <?= date('Y') ;?> PT. Eraya Digital Solusindo. All rights reserved [IP ANDA : <span id="ipaddresspublic"></span>]
							</p>
						</div>
						<div class="col-md-3 d-none d-md-block">
							<p class="text-right mb-0">Hand-crafted and made with <i
									class="fa fa-heart text-danger"></i></p>
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
	<!-- END Scroll To Top -->
	<!-- BEGIN Sidemenu -->
	<div class="sidemenu sidemenu-right sidemenu-wider" id="sidemenu-todo">
		<div class="sidemenu-header">
			<h3 class="sidemenu-title">PENGATURAN APLIKASI</h3>
			<div class="sidemenu-addon">
				<button class="btn btn-label-danger btn-icon" data-dismiss="sidemenu">
					<i class="fa fa-times"></i>
				</button>
			</div>
		</div>
		<div class="sidemenu-body" data-simplebar="data-simplebar">
			<!-- BEGIN Portlet -->
			<div class="portlet portlet-bordered mb-0">
				<div class="portlet-header portlet-header-bordered">
					<div class="portlet-icon">
						<i class="fa fa-users"></i>
					</div>
					<h3 class="portlet-title">PEGAWAI</h3>
					<div class="portlet-addon">
					<a href="<?= base_url() ;?>masterdata/informasimerchant"><button class="btn btn-label-primary btn-icon">
							<i class="fa fa-plus"></i>
						</button></a>
					</div>
				</div>
				<div class="portlet-header portlet-header-bordered">
					<div class="portlet-icon">
						<i class="fa fa-building"></i>
					</div>
					<h3 class="portlet-title">OUTLET</h3>
					<div class="portlet-addon">
					<a href="<?= base_url() ;?>masterdata/outlet"><button class="btn btn-label-primary btn-icon">
							<i class="fa fa-plus"></i>
						</button></a>
					</div>
				</div>
				<div class="portlet-body p-0">
					<!-- BEGIN Rich List -->
					<div class="rich-list rich-list-flush rich-list-action">
						<a href="#" class="rich-list-item">
							<div class="rich-list-prepend">
								<!-- BEGIN Avatar -->
								<div class="avatar">
									<div class="avatar-addon avatar-addon-top">
									<div class="avatar-icon avatar-icon-info">
											<i class="fa fa-thumbtack"></i>
										</div>
									</div>
									<div class="avatar-display">
										<img src="<?= base_url() ;?>images/avatar/blank.webp" alt="Avatar image">
									</div>
									<div class="avatar-addon avatar-addon-bottom">
										<i class="marker text-secondary"></i>
									</div>
								</div>
								<!-- END Avatar -->
							</div>
							<div class="rich-list-content">
								<h4 class="rich-list-title">Hak Akses Apliaksi</h4>
								<span class="rich-list-subtitle"><?= session('hakakses') ;?></span>
							</div>
						</a>
					</div>
					<!-- END Rich List -->
				</div>
			</div>
			<!-- END Portlet -->
		</div>
	</div>
	<!-- END Sidemenu 
	<div class="float-btn float-btn-right">
		<button class="btn btn-flat-primary btn-icon mb-2" id="theme-toggle" data-toggle="tooltip"
			data-placement="right" title="Ubah Tema">
			<i class="fa fa-moon"></i>
		</button>
		<a href="penjualan/kasir/"><button class="btn btn-flat-danger btn-icon mb-2" data-toggle="tooltip" data-placement="right" title="Transaksi Kasir">
			<i class="fas fa-cash-register"></i>
		</button></a>
		<button onclick="launchCalc()" class="btn btn-flat-warning btn-icon mb-2" title="Panggil Kalkulator">
			<i class="fa fa-calculator"></i>
		</button>
	</div>
	END Float Button -->
<script type="text/javascript" src="<?= base_url() ;?>scripts/mandatory.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/dashboard1.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/core.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/vendor.js"></script>
<script type="text/javascript">
function launchCalc(){
	window.open('Calculator:///');
	window.close();
}
$(document).ready(function() {
	$.get('https://www.cloudflare.com/cdn-cgi/trace', function(data) {data = data.trim().split('\n').reduce(function(obj, pair) {pair = pair.split('=');return obj[pair[0]] = pair[1], obj;}, {})
	$('#ipaddresspublic').html(data.ip)
	getCsrfTokenCallback(function() {});
	/*console.log(window.screen.availHeight)
	console.log(window.screen.availWidth)
	document.body.style.zoom = "10%";*/ 
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
					csrf_aciraba: csrfTokenGlobal,
					KATAKUNCIPENCARIAN: "",
					KODEUNIKMEMBER: session_kodeunikmember,
				}
			},
			processResults: function (data) {
				parseJSON = JSON.parse(data);
				getCsrfTokenCallback(function() {});
				return {
					results: $.map(parseJSON, function (item) {
						return {
							text: "OUTLET : " + item.group+" ["+item.namaoutlet+"] ",
							id: item.group,
						}
					})
				}
			},
			error: function(xhr, status, error) {
				getCsrfTokenCallback(function() {});
				toastr["error"](xhr.responseJSON.message);
			}
		},
	});
});
$('.cmblokasioutlet').select2({
	allowClear: true,
	placeholder: 'Pilih Asal Outlet!!',
	ajax: {
		url: baseurljavascript + 'auth/outlet',
		method: 'POST',
		dataType: 'json',
		delay: 500,
		data: function (params) {
			return {
				csrf_aciraba: csrfTokenGlobal,
				KATAKUNCIPENCARIAN: "",
				KODEUNIKMEMBER: session_kodeunikmember,
			}
		},
		processResults: function (data) {
			parseJSON = JSON.parse(data);
			getCsrfTokenCallback(function() {});
			return {
				results: $.map(parseJSON, function (item) {
					return {
						text: "OUTLET : " + item.group+" ["+item.namaoutlet+"] ",
						id: item.group,
					}
				})
			}
		},
		error: function(xhr, status, error) {
			getCsrfTokenCallback(function() {});
			toastr["error"](xhr.responseJSON.error_description);
		}
	},
});
$("#cmblokasioutlet").change(function () {
	pindahoutlet($("#cmblokasioutlet").val());
});
});	
function pindahoutlet(kodeoutlet){
	Swal.fire({
		title: "Apakah anda ingin beralih KE OUTLET : " + kodeoutlet,
		text: "Informasi saat ini akan diubah dengan informasi yang berkaitan dengan KODE OUTLET "+kodeoutlet+". Anda dapat kembali ke outlet sebelumnya dengan cara yang sama",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Oke, Teleport!!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location = baseurljavascript+"auth/ubahoutlet/"+kodeoutlet;
		}
	})
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
</script>
</body>
</html>