<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style type="text/css">
    .main-part{
		font-family: 'Inter', sans-serif;
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
	.cpanel h1,p{
		font-family: 'Inter', sans-serif;
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
			<div class="cpanel cpanel-abuabu col-md-4">
				<div class="icon-part">
					<i class="fa-solid fa-users-gear"></i><br />
					<h1>Anggota</h1>
					<p><span id="jumlahanggota_dashboard"></span> Terdaftar</p>
				</div>
				<a target="_blank" style="text-decoration: none;color: #FFFFFF;" href="<?= base_url().'masterdata/daftarmember';?>"><div class="card-content-part">Lebih Rinci</div></a>
			</div>
			<div class="cpanel cpanel-green col-md-4">
				<div class="icon-part">
					<i class="fa-solid fa-box-open"></i><br />
					<h1>Item Aktif</h1>
					<p><span id="jumlahbarangaktif_dashboard"></span> Jenis</p>
				</div>
				<a target="_blank" style="text-decoration: none;color: #FFFFFF;" href="<?= base_url().'masterdata/daftaritem';?>"><div class="card-content-part">Lebih Rinci</div></a>
			</div>
			<div class="cpanel cpanel-orange col-md-4">
				<div class="icon-part">
					<i class="fa-solid fa-boxes-stacked"></i><br />
					<h1>Item Kuantiti</h1>
					<p><span id="jumlahbarangtidakaktif_dashboard"></span> Kuantiti</p>
				</div>
				<a target="_blank" style="text-decoration: none;color: #FFFFFF;" href="<?= base_url().'masterdata/daftaritem';?>"><div class="card-content-part">Lebih Rinci</div></a>
			</div>
			</div>
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
				<table id="realtime_database_penjualan" class="table table-bordered table-striped table-hover nowrap">
					<thead>
						<tr>
							<th>No Tranaksi</th>
							<th>Waktu</th>
							<th>Total Barang</th>
							<th>Total Nominal</th>
							<th>Lokasi</th>
							<th>Kasir</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
						<tr>
							<th>No Tranaksi</th>
							<th>Waktu</th>
							<th>Total Barang</th>
							<th>Total Nominal</th>
							<th>Lokasi</th>
							<th>Kasir</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
    </div>
</div>
<script>
$(document).ready(function () {
	informasirow1dashboard()
	informasirow2dashboard()
	$("#realtime_database_penjualan").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        scrollY: "100vh",
        scrollX: true,
        scrollCollapse: true,
		ordering: false,
		columnDefs: [{className: "text-right",targets: [3]},],
        ajax: {
            "url": baseurljavascript + 'penjualan/dashboard_penjualan',
            "type": "POST",
            "data": function (d) {
                d.NODATA = "";
            }
        },
    }); 
});
function informasirow1dashboard(){
	$.ajax({
		url: baseurljavascript + 'masterdata/informasirow1dashboard',
		method: 'POST',
		dataType: 'json',
		success: function (response) {
			$("#jumlahanggota_dashboard").html(response.dataquery[0].TOTALMEMBER.toLocaleString())
			$("#jumlahbarangaktif_dashboard").html(response.dataquery[0].ITEMAKTIF.toLocaleString())
			$("#jumlahbarangtidakaktif_dashboard").html(response.dataquery[0].ITEMAKTIFKUANTITI.toLocaleString())
		}
	});
}
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