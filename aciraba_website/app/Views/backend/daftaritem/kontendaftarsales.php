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
                            <a href="<?= base_url();?>masterdata/detailsales"><button id="" class="btn btn-primary"> <i class="fas fa-box-open"></i> Tambah Data Suplier</button></a>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <div class="form-row">
                            <div class="col-md-5">
                                <label for="kodesales">Nama / Kode Sales Terdaftar</label>
                                <input type="text" class="form-control" id="kodesales" placeholder="Masukan untuk melakukan penyaringan data tersedia">
                            </div>
                            <div class="col-md-7">
                                <p align="justify">Pekerjaan utama seorang salesperson adalah melakukan penjualan produk barang atau jasa pada pihak pembeli. Mereka akan menggunakan berbagai teknik penjualan untuk mengetahui barang apa yang akan mereka beli. Dalam hal ini, mereka akan menyarankan suatu produk atau layanan yang sesuai dengan keperluannya.</p>
                            </div>
                        </div>
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabeldaftarsales" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Sales</th>
                                    <th>Nama Sales</th>
                                    <th>Provinsi</th>
                                    <th>Kota / Kab</th>
                                    <th>Alamat</th>
                                    <th>No Telpn</th>
                                    <th>Email</th>
                                    <th>Bank</th>
                                    <th>No Rekening</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Sales</th>
                                    <th>Nama Sales</th>
                                    <th>Provinsi</th>
                                    <th>Kota / Kab</th>
                                    <th>Alamat</th>
                                    <th>No Telpn</th>
                                    <th>Email</th>
                                    <th>Bank</th>
                                    <th>No Rekening</th>
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
<script src="<?= base_url();?>scripts/masterdata/sales.js"></script>

<?= $this->endSection(); ?>