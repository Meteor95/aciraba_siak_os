<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
    <link href="<?= base_url() ;?>styles/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet">
	<link href="<?= base_url() ;?>styles/ltr-core.css" rel="stylesheet">
	<link href="<?= base_url() ;?>styles/ltr-vendor.css" rel="stylesheet">
	<link href="<?= base_url() ;?>styles/ltr-dashboard3.css" rel="stylesheet">
	<link href="<?= base_url() ;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon">
	<title>Laporan Detail Member</title>
    <style>
        .stakheader {
            position: fixed;
            top: 0;
            left: 44.5rem;
            width: calc(100% - 44.5rem);
            z-index: 1000;
            overflow-x: auto;
            white-space: nowrap;
        }
        .header-container {
            position: relative;
        }
        .nav-container {
            display: inline-block;
            min-width: 100%;
        }
        .nav-pills.flex-nowrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
        white-space: nowrap;
        }
        .nav-pills.flex-nowrap .nav-link {
            display: inline-block;
        }
        .aside-content{
            bottom:0px;
        }
    </style>
</head>

<body class="theme-light preload-active aside-active">
	<!-- BEGIN Preload -->
	<div class="preload">
		<div class="preload-message">
			<!-- BEGIN Spinner -->
			<div class="spinner-border text-primary"></div>
			<!-- END Spinner -->
			<span class="preload-text">Please wait...</span>
		</div>
	</div>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Aside -->
		<div class="aside">
			<div class="aside-menu">
				<div class="aside-menu-body">
					<a href="<?= base_url() ;?>laporan/mastermember" class="btn btn-icon btn-label-light btn-lg mb-2"><i class="fa-solid fa-circle-arrow-left"></i></a>
                    <a href="<?= base_url() ;?>penjualan/kasir/" class="btn btn-icon btn-label-light btn-lg mb-2"><i class="fas fa-cash-register"></i></a>
                    <a href="<?= base_url() ;?>" class="btn btn-icon btn-label-light btn-lg mb-2"><i class="fa fa-desktop"></i></a>
				</div>
                
				<button class="btn btn-flat-primary btn-icon mb-2" id="theme-toggle" data-toggle="tooltip" data-placement="right" title="Ubah Tema">
                    <i class="fa fa-moon"></i>
                </button>
			</div>
			<div class="aside-content" data-simplebar="data-simplebar">
				<!-- BEGIN Widget -->
				<!-- BEGIN Portlet -->
                <div class="portlet widget1">
                <div style="background-image: url(<?= $BANNER;?>);background-position: center center;background-repeat: no-repeat;background-size: cover;" class="widget1-display widget1-display-top widget1-display-sm justify-content-between bg-primary text-white">
                        <div class="widget1-group">
                            <div class="widget1-addon">
                                <button class="btn btn-label-light">EST 2023</button>
                            </div>
                        </div>
                        <div class="widget1-group">
                            <h3 class="widget1-title" <?= ($STATUSAKTIF == "0" ? "style='color:red'" : "");?>><?= ($STATUSAKTIF == "0" ?  "AKUN ANDA TIDAK AKTIF" : "DETAIL INFORMASI");?></h3>
                        </div>
                    </div>
                    <div class="widget1-body">
                        <!-- BEGIN Rich List -->
                        <div class="rich-list-item p-0 mb-3">
                            <div class="rich-list-prepend">
                                <!-- BEGIN Avatar -->
                                <div class="avatar">
                                    <div class="avatar-display">
                                        <img src="https://sm.ign.com/ign_ap/cover/a/avatar-gen/avatar-generations_hugw.jpg" alt="Avatar image">
                                    </div>
                                </div>
                                <!-- END Avatar -->
                            </div>
                            <div class="rich-list-content">
                                <h4 class="rich-list-title"><?= str_replace("::"," ",$NAMA)." [".$MEMBER_ID."]" ;?></h4>
                                <span class="rich-list-subtitle"><?= "Jenis : ".$JENIS." GROUP : ".$GRUP;?></span>
                            </div>
                        </div>
                        <!-- END Rich List -->
                        <p class="text-level-1 text-justify"><?= $KETERANGAN ;?></p>
                    </div>
                </div>
                <!-- END Portlet -->
				<!-- END Widget -->
				<!-- BEGIN Portlet -->
				<div class="portlet portlet-bordered">
					<div class="portlet-header portlet-header-bordered">
						<div class="portlet-icon">
							<i class="fa fa-tasks"></i>
						</div>
						<h3 class="portlet-title">BIODATA</h3>
					</div>
					<div class="portlet-body">
                        <div class="rich-list rich-list-action">
                            <a href="#" class="rich-list-item">
                                <div class="rich-list-prepend">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-info">
                                        <div class="avatar-display">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                                <div class="rich-list-content">
                                    <h4 class="rich-list-title">ALAMAT</h4>
                                    <span class="rich-list-subtitle"><?= $ALAMAT ;?></span>
                                </div>
                                <div class="rich-list-append">
                                <?= ($ALAMAT == "" ? '<i class="fa-solid fa-triangle-exclamation fa-beat fa-lg" style="color: #ff0000;"></i>' : '<i class="fa-solid fa-circle-check fa-fade fa-lg" style="color: #0000ff;"></i>' ) ;?>
                                </div>
                            </a>
                            <a href="#" class="rich-list-item">
                                <div class="rich-list-prepend">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-success">
                                        <div class="avatar-display">
                                            <i class="fa-solid fa-file-invoice"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                                <div class="rich-list-content">
                                    <h4 class="rich-list-title">INFORMASI PERBANKAN</h4>
                                    <span class="rich-list-subtitle"><?= $INFORMASIPEMBAYARAN ;?></span>
                                </div>
                                <div class="rich-list-append">
                                    <?= ($STATUSINFORMASIPEMBAYARAN == "" ? '<i class="fa-solid fa-triangle-exclamation fa-beat fa-lg" style="color: #ff0000;"></i>' : '<i class="fa-solid fa-circle-check fa-fade fa-lg" style="color: #0000ff;"></i>' ) ;?>
                                </div>
                            </a>
                            <a href="#" class="rich-list-item">
                                <div class="rich-list-prepend">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-danger">
                                        <div class="avatar-display">
                                            <i class="fa-solid fa-wallet"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                                <div class="rich-list-content">
                                    <h4 class="rich-list-title">SALDO / POIN DOMPET DATA</h4>
                                    <span class="rich-list-subtitle">SALDO : <?= $SALDODOMPETDATA ."<br>POIN : ".$POINTRX ." Pts <br>MIN TRX / POIN : ".$MINIMALPOIN;?></span>
                                </div>
                            </a>
                            <a href="#" class="rich-list-item">
                                <div class="rich-list-prepend">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-warning">
                                        <div class="avatar-display">
                                            <i class="fa fa-paper-plane"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                                <div class="rich-list-content">
                                    <h4 class="rich-list-title">LIMIT PIUTANG</h4>
                                    <span class="rich-list-subtitle">LIMIT : <?= $LIMITJUMLAHPIUTANG."<br>BATAS MAX PIUTANG : ".$BATASTAMBAHKREDIT." Hari";?></span>
                                </div>
                            </a>
                            <a href="#" class="rich-list-item">
                                <div class="rich-list-prepend">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-primary">
                                        <div class="avatar-display">
                                            <i class="fa fa-download"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                                <div class="rich-list-content">
                                    <h4 class="rich-list-title">AKTIF SAMPAI DENGAN</h4>
                                    <span class="rich-list-subtitle"><?= ($AKHIRAKTIF == "0000-00-00" ? "AKTIF SELAMANYA" : $AKHIRAKTIF ) ;?></span>
                                </div>
                            </a>
                        </div>
					</div>
				</div>
				<!-- END Portlet -->
			</div>
		</div>
		<!-- END Aside -->
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper">
			<!-- BEGIN Header -->
			<div class="header">
				<!-- BEGIN Header Holder -->
                <div class="stakheader">
				<div class="header-holder header-holder-desktop">
					<div class="header-container container-fluid">
						<div class="header-wrap header-wrap-block justify-content-start">
                            <div class="nav-container">
                                <nav class="nav nav-pills flex-nowrap" id="nav2-tab">
                                    <a data-toggle="tab" href="#penjualansemua" onclick="panggillogmember('')" class="nav-link mr-2">Log Penjualan</a>
                                    <a data-toggle="tab" href="#penjualansemua" onclick="panggillogmember('TUNAI')" class="nav-link mr-2">Log Penjualan Tunai</a>
                                    <a data-toggle="tab" href="#penjualansemua" onclick="panggillogmember('KREDIT')" class="nav-link mr-2">Log Penjualan Piutang</a>
                                    <a data-toggle="tab" href="#penjualansemua" onclick="panggillogmember('KARTU')" class="nav-link mr-2">Log Penjualan Kartu</a>
                                    <a data-toggle="tab" href="#penjualansemua" onclick="panggillogmember('SPLITCASH')" class="nav-link mr-2">Log Penjualan Split Cash</a>
                                    <a data-toggle="tab" href="#penjualanbayarpiutang" onclick="panggillogmember('penjualanbayarpiutang')" class="nav-link mr-2">Log Bayar Piutang</a>
                                </nav>
                            </div>
						</div>
					</div>
				</div>
                </div>
				<div class="header-holder header-holder-mobile">
					<div class="header-container container-fluid">
						<div class="header-wrap">
							<button class="btn btn-flat-primary btn-icon mr-3" data-toggle="sidemenu" data-target="#sidemenu-navigation">
								<i class="fa fa-bars"></i>
							</button>
						</div>
						<div class="header-wrap header-wrap-block justify-content-start">
							<h4 class="header-brand">ACIRABA - DETAIL ANGGOTA</h4>
						</div>
						<div class="header-wrap">
							<button class="btn btn-flat-primary btn-icon ml-2" data-toggle="aside" data-target="content">
								<i class="far fa-list-alt"></i>
							</button>
							<button class="btn btn-flat-primary btn-icon ml-2" data-toggle="aside" data-target="menu">
								<i class="far fa-paper-plane"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="content">
                <div id="welcome_arrow" style="padding-top:22%">
                    <div class="d-flex flex-column align-items-center justify-content-center"><i class="fa-solid fa-arrow-up-from-bracket fa-bounce" style="font-size:15em"></i><hr><h1 style="text-align:center;">SILAHKAN PILIH LOG LAPORAN YANG DI INGINKAN UNTUK DI CEK</h1></div>
                </div>
                <div class="tab-content" id="nav2-tabContent" style="padding-top:5%;padding-left:2%;padding-right:2%">
                    <div class="tab-pane fade" id="penjualansemua">
                        <table id="tabel_laporan_penjualan" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th style="vertical-align : middle;text-align:center;">No Transkasi</th>
                                    <th style="vertical-align : middle;text-align:center;">Tanggal Trx</th>
                                    <th style="vertical-align : middle;text-align:center;">Nama Item</th>
                                    <th style="vertical-align : middle;text-align:center;">QTY Item</th>
                                    <th style="vertical-align : middle;text-align:center;">Harga</th>
                                    <th style="vertical-align : middle;text-align:center;">Lokasi</th>
                                    <th style="vertical-align : middle;text-align:center;">Jenis Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="penjualanbayarpiutang">
                        <p class="mb-0">penjualanbayarpiutang Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containLorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                    </div>
                </div>
			</div>
			<!-- END Page Content -->
			<!-- BEGIN Footer -->
			<div class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<p class="text-left mb-0">Copyright <i class="far fa-copyright"></i>
                                2021 - <?= date('Y') ;?> PT. Eraya Digital Solusindo. All rights reserved [IP ANDA : <span id="ipaddresspublic"></span>]
							</p>
						</div>
						<div class="col-md-6 d-none d-md-block">
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
	<!-- END Scroll To Top -->
<script type="text/javascript" src="<?= base_url() ;?>scripts/mandatory.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/dashboard1.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/core.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/vendor.js"></script>
<script src="<?=base_url();?>scripts/globalfn.js" type="text/javascript" ></script>
<script>
var baseurljavascript = '<?= DYBASESEURL;?>';
var baseurlsocket = '<?= BASEURLAPI;?>';
var session_kodeunikmember='<?= session('kodeunikmember');?>';
var session_pengguna_id='<?= session('pengguna_id');?>';
var session_namapengguna='<?= session('namapengguna');?>';
var session_outlet='<?= session('outlet');?>';
var session_statusmember='<?= session('jenismerchant');?>';
$(document).ready(function () {
    if ('<?= $STATUSAKTIF ;?>' == "1") $('.theme-light .aside-menu').css('background', '#2196f3');
    if ('<?= $STATUSAKTIF ;?>' == "0") $('.theme-light .aside-menu').css('background', 'red');
})
let headerHolder = document.querySelector('.stakheader');
let lastScrollPos = window.pageYOffset;
window.addEventListener('scroll', function() {
  var currentScrollPos = window.pageYOffset;
  if (lastScrollPos > currentScrollPos) {
    headerHolder.classList.remove('stacked');
  } else {
    headerHolder.classList.add('stacked');
  }
  lastScrollPos = currentScrollPos;
});
function panggillogmember(kondisi){
    tabeldata = "penjualan";
    $("#welcome_arrow").hide();
    getCsrfTokenCallback(function() {
        $("#tabel_laporan_"+tabeldata).DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollCollapse: true,
            scrollY: "100%",
            scrollX: true,
            ordering: false,
            bFilter: true,
            destroy: true,
            pageLength: -1,
            lengthMenu: [[10, 50, 100 , 500, -1], [10, 50, 100, 500, "All"]],
            ajax: {
                "url": baseurljavascript + 'laporan/formatlaporandetaimembertabel',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KODEMEMBER = "<?= $DATAPOST["KODEMEMBER"] ;?>";
                    d.PERIODEAWAL = "<?= $DATAPOST["PERIODEAWAL"] ;?>";
                    d.PERIODEAKHIR =  "<?= $DATAPOST["PERIODEAKHIR"] ;?>";
                    d.STATUSTRANSAKSI = kondisi;
                    d.OUTLET = "<?= $DATAPOST["OUTLET"] ;?>";
                }
            },
            footerCallback: function( tfoot, data, start, end, display ) {   
                let response = this.api().ajax.json();
                let $td = $(tfoot).find('th'); 
                var rowCount = $(tfoot).find('tr').length;
                if(response){}
            }
        });
    });
}
</script>
</body>

</html>
