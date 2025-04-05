<?= $this->extend('resto/kds'); ?>
<?= $this->section('kontenutama'); ?>
<div class="content" style="background-image: url('https://static.vecteezy.com/system/resources/previews/003/127/955/original/abstract-white-and-grey-background-with-dynamic-waves-shape-free-vector.jpg');background-repeat: no-repeat;background-attachment: fixed;background-position: center; ;">
    <div class="container">  
    <?php if (session('kodeunikmember') == ""){ ?>
        <button  class="btn btn-block btn-success btn-lg"><i class="fas fa-users"></i> Login Sebagai Dapur</button>
    <?php }else{ ?>
        <div class="row">
            <div class="col"><hr style="border: 2px solid green;border-radius: 5px;"/></div><div class="col-auto"><h3>KATEGORI : <span id="namakategori_kds">SEMUA</span>[<span id="idkategori_kds">-</span>]</h3></div><div class="col"><hr style="border: 2px solid green;border-radius: 5px;"/></div>
        </div> 
        <div id="detailkds"></div>
    <?php } ?>
    </div>
</div>
<div class="modal fade" id="modalpengaturan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h5 class="modal-title">Pengaturan KDS</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
				<div class="input-group mb-2">
					<label for="tanggalawal_kds" class="col-sm-3 col-form-label">Tanggal Awal</label>
					<input readonly type="text" id="tanggalawal_kds" class="form-control">
						<div class="input-group-append"><button onclick="hariinipengaturana()" class="btn btn-outline-success" type="button"><i class="fa-solid fa-calendar-days"></i> Hari Ini</button></div>
				</div>
				<div class="input-group mb-2">
					<label for="tanggalakhir_kds" class="col-sm-3 col-form-label">Tanggal Akhir</label>
					<input readonly type="text" id="tanggalakhir_kds" class="form-control">
						<div class="input-group-append"><button onclick="hariinipengaturanb()" class="btn btn-outline-success" type="button"><i class="fa-solid fa-calendar-days"></i> Hari Ini</button></div>
				</div>
				<div class="input-group">
					<label for="namaprintershare" class="col-sm-3 col-form-label">Print Share Name</label>
					<input type="text" id="namaprintershare" class="form-control">
				</div>
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="simpanpengaturan" class="btn btn-primary mr-2"><i class="fas fa-cogs"></i> Simpan Pengaturan</button>
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
            <input id="textpencariankategorikds" type="text" class="form-control mt-2" placeholder="Filter nama kategori"><hr>
                <div id="tampilankategori"></div>
            </div>  
            </div>
            <div class="modal-footer">
                <h5>Barang berdasarkan kategori tidak ditemukan, silahkan cek informasi barang tersebut pada MASTER ITEM di backpanel. Silahkan hubungi ADMIN / Petugas wewenang untuk melaporkan hal tersebut </h5>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>