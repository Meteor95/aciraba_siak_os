<?= $this->extend('backend/main_acipay'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style type="text/css">
    .main-part{
		width:100%;
		margin:0 auto;
		text-align: center;
		padding: 0px 5px;
    }
    .cpanel{
		display: inline-block;
		color:#fff;
		margin-top: 50px;
    }
    .icon-part i{
		font-size: 35px;
		padding:10px;
		border:1px solid #fff;
		border-radius:50%;
		margin-top:-25px;
		margin-bottom: 10px;
		background-color:#34495E;
    }
    .icon-part p{
		margin:0px;
		font-size: 2em;
		padding-bottom: 10px;
    }
		.card-content-part{
		background-color: #2F4254;
		padding: 5px 0px;
    }
    .cpanel .card-content-part:hover{
		background-color: #5a5a5a;
		cursor: pointer;
    }
    .card-content-part a{
		color:#fff;
		text-decoration: none;
    }
	.cpanel-abuabu .icon-part,.cpanel-abuabu .icon-part i{
    	background-color: #34495E;
    }
    .cpanel-abuabu .card-content-part{
    	background-color: #2F4254;
    }
    .cpanel-green .icon-part,.cpanel-green .icon-part i{
    	background-color: #16A085;
    }
    .cpanel-green .card-content-part{
    	background-color: #149077;
    }
    .cpanel-orange .icon-part,.cpanel-orange .icon-part i{
    	background-color: #F39C12;
    }
    .cpanel-orange .card-content-part{
    	background-color: #DA8C10;
    }
    .cpanel-blue .icon-part,.cpanel-blue .icon-part i{
    background-color: #2980B9;
    }
    .cpanel-blue .card-content-part{
    	background-color:#2573A6;
    }
    .cpanel-red .icon-part,.cpanel-red .icon-part i{
    	background-color:#E74C3C;
    }
    .cpanel-red .card-content-part{
    	background-color:#CF4436;
    }
    .cpanel-skyblue .icon-part,.cpanel-skyblue .icon-part i{
    	background-color:#8E44AD;
    }
    .cpanel-skyblue .card-content-part{
    	background-color:#803D9B;
    }
    </style>
<div class="content">
    <div class="container-fluid">
		<div class="main-part">
			<div class="row">
			<div class="cpanel cpanel-blue col-md-6">
				<div class="icon-part">
					<i class="fa fa-tasks" aria-hidden="true"></i><br />
					<h1>Transaksi Hari Ini</h1>
					<p><span id="trxhariini_dashboard"></span> Trx</p>
				</div>
				<a target="_blank" style="text-decoration: none;color: #FFFFFF;" href="<?= base_url().'penjualan/daftarpenjualan';?>"><div class="card-content-part">Lebih Rinci</div></a>
			</div>
			<div class="cpanel cpanel-skyblue col-md-6">
				<div class="icon-part">
					<i class="fa-solid fa-cash-register"></i><br />
					<h1>Pendapatan Hari Ini</h1>
					<p><span id="pendapatanahriini_dashboard"></span> </p>
				</div>
				<a target="_blank" style="text-decoration: none;color: #FFFFFF;" href="<?= base_url().'penjualan/daftarpenjualan';?>"><div class="card-content-part">Lebih Rinci</div></a>
			</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col">
				<div class="container">  
					<div class="row mt-3">
						<div class="col"><hr style="border: 2px solid green;border-radius: 5px;"/></div><div class="col-auto"><h3>DAFTAR PENJUALAN HARI INI</h3></div><div class="col"><hr style="border: 2px solid green;border-radius: 5px;"/></div>
					</div> 
				</div>
				<table id="realtime_database_penjualan_acipay" class="table table-bordered table-striped table-hover nowrap">
					<thead>
						<tr>
							<th>ID / No Tranaksi</th>
							<th>Pengguna</th>
							<th>Server</th>
							<th>Nama Produk</th>
							<th>No Tujuan</th>
							<th>Informasi Harga</th>
							<th>Laba Kotor</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th>ID / No Tranaksi</th>
							<th>Pengguna</th>
							<th>Server</th>
							<th>Nama Produk</th>
							<th>No Tujuan</th>
							<th>Informasi Harga</th>
							<th>Laba Kotor</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
    </div>
</div>
<script>
$(document).ready(function () {
	informasirow2dashboard()
	$("#realtime_database_penjualan_acipay").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        scrollY: "100vh",
        scrollX: true,
        scrollCollapse: true,
		ordering: false,
		pageLength: 50,
    	lengthMenu: [[10, 20, 50 , 100, -1], [10, 20, 50, 100, "All"]],
        ajax: {
            "url": baseurljavascript + 'penjualan/dashboard_penjualan_acipay',
            "type": "POST",
            "data": function (d) {
                d.NODATA = "";
            }
        },
    }); 
});
function informasirow2dashboard(){
	$.ajax({
		url: baseurljavascript + 'masterdata/informasirow2dashboard',
		method: 'POST',
		dataType: 'json',
		success: function (response) {
			$("#trxhariini_dashboard").html(response.dataquery[0].BANYAKTRX.toLocaleString())
			$("#pendapatanahriini_dashboard").html(formatuang(Number(response.dataquery[0].TOTALBELANJA),'id-ID','IDR'))
		}
	});
}
</script>
<script>
const socketIo = io(baseurlsocket);
socketIo.on("connect", () => {
  console.log(socketIo.id);
});
socketIo.on("NOTIFDASHBOARD"+session_outlet+session_kodeunikmember, function (data) {
    informasirow2dashboard()
	$('#realtime_database_penjualan').DataTable().ajax.reload();
});
</script>
<?= $this->endSection(); ?>