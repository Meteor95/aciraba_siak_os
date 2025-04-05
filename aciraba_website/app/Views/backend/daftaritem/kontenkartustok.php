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
                            <button id="" class="btn btn-primary" data-toggle="modal" data-target="#modal6" > <i class="fas fa-box-open"></i> Pilih Barang</button>
                            <button id="" class="btn btn-primary"><i class="fas fa-shopping-basket"></i> Buka Transkasi</button>
                            <button id="proseskartustok" class="btn btn-success float-right"> <i class="fas fa-cog"></i> Proses Cek</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="kodebarangkartustok">Kodebarang</label>
                                <input type="text" class="form-control" id="kodebarangkartustok" placeholder="Masukan kodebarang untuk dicek kartu stoknya">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="inputSelect1">Jenis Transkasi</label>
                                <select class="custom-select" id="jenistranskasikartustok">
                                    <option value="">Semua</option>
                                    <option value="TRSKSR">Transaksi Penjualan</option>
                                    <option value="TRSPMB">Transaksi Pembelian</option>
                                    <option value="MTS">Mutasi</option>
                                    <option value="PECAHSATUAN">Pecah Satuan</option>
                                    <option value="OPM">Penyesuaian Stok</option>
                                    <option value="RTRPJ">Retur Penjualan</option>
                                    <option value="TRSKSRB">Retur Pembelian</option>
                                </select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" checked class="custom-control-input" id="filterberdasarkantanggal">
                                    <label class="custom-control-label" for="filterberdasarkantanggal">Filter Berdasarkan Tanggal</label>
                                </div>
                                <div class="input-group input-daterange">
                                    <input id="filterawalkartustok" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="filteraakhirkartustok" type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <p align="justify">Kartu persediaan barang atau dikelan Bin Card atau Stock Card, adalah ringkasan pergerakan persediaan dan sisa saldo. Laporan ini berisi informasi dari pergerakan yang mencakup saldo awal, penerimaan stok, penerbitan stok, dan kuantitas akhir</p>
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabelkartustok" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>No Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Masuk</th>
                                    <th>Mutasi</th>
                                    <th>Opname</th>
                                    <th>Keluar</th>
                                    <th>Saldo</th>
                                    <th>Saldo Semua</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>No Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Masuk</th>
                                    <th>Mutasi</th>
                                    <th>Opname</th>
                                    <th>Keluar</th>
                                    <th>Saldo</th>
                                    <th>Saldo Semua</th>
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
<script src="<?= base_url();?>scripts/masterdata/kartustok.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".input-daterange").datepicker({ todayHighlight: true,format: 'dd-mm-yyyy',
            orientation: "bottom left", });
    });
</script>
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->endSection(); ?>