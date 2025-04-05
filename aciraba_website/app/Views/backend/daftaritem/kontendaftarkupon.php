<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title"> 
                            <a href="<?= base_url();?>masterdata/tambahkuponbelanja"><button id="" class="btn btn-primary"> <i class="fas fa-box-open"></i> Tambah Kupon Belanja</button></a>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-4 mb-0">
                                <label for="kodevoucherbelanja">Kode Voucher Belanja</label>
                                <input type="text" class="form-control" id="kodevoucherbelanja" placeholder="Masukan kode voucher untuk melihat statusnya">
                            </div>
                            <div class="col-md-8 mb-0">
                            <p align="justify">Secara umum voucher dapat diartikan jenis alat transaksi penukaran yang bernilai tertentu dengan jangka waktu tertentu. Bisa digunakan untuk alasan tertentu. Dalam beberapa hal berbelanja dengan menggunakan voucher merupakan cara yang paling dirasa praktis.</p>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table class="tabelvoucherbelanja table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Kupon</th>
                                    <th>Awal Aktif</th>
                                    <th>Akhir Aktif</th>
                                    <th>Tipe Voucher</th>
                                    <th>Nominal Rupiah</th>
                                    <th>Nominal Presentase</th>
                                    <th>Batas Pakai</th>
                                    <th>Minimal Pembelian</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Kupon</th>
                                    <th>Awal Aktif</th>
                                    <th>Akhir Aktif</th>
                                    <th>Tipe Voucher</th>
                                    <th>Nominal Rupiah</th>
                                    <th>Nominal Presentase</th>
                                    <th>Batas Pakai</th>
                                    <th>Minimal Pembelian</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>scripts/masterdata/voucherbelanja.js"></script>
<?= $this->endSection(); ?>