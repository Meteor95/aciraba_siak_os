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
                            <a href="<?= base_url();?>masterdata/detailsuplier"><button id="" class="btn btn-primary"> <i class="fas fa-box-open"></i> Tambah Data Suplier</button></a>
                        </h3>
                    </div>
                    <div class="portlet-body">
                       <!-- BEGIN Form Row -->
                       <div class="form-row">
                            <div class="col-md-5 mb-0">
                                <label for="kodesuplier">Nama / Kode Suplier Terdaftar</label>
                                <input type="text" class="form-control" id="kodesuplier" placeholder="Masukan untuk melakukan penyaringan data tersedia">
                            </div>
                            <div class="col-md-7 mb-0">
                            <p align="justify">supplier atau pemasok secara umum adalah pihak perorangan atau perusahaan yang memasok atau menjual bahan mentah ke pihak lain, baik itu ke perorangan atau perusahaan agar bisa dijadikan produk barang atau jasa yang matang.</p>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabelmastersuplier" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Suplier</th>
                                    <th>Nama Suplier</th>
                                    <th>Provinsi</th>
                                    <th>Kota / Kab</th>
                                    <th>Alamat</th>
                                    <th>No Telpn</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Suplier</th>
                                    <th>Nama Suplier</th>
                                    <th>Provinsi</th>
                                    <th>Kota / Kab</th>
                                    <th>Alamat</th>
                                    <th>No Telpn</th>
                                    <th>Email</th>
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
<script src="<?= base_url();?>scripts/masterdata/suplier.js"></script>
<?= $this->endSection(); ?>