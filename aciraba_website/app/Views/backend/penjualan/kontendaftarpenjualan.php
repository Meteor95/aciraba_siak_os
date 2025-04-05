<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div class="dropdown-col border-left">
                            <!-- BEGIN Select -->
                            <select id="jenistransaksipenjualan" class="selectpicker" data-live-search="true">
                                <option value="" data-icon="fa-cash-register">Semua Jenis Transaksi</option>
                                <option value="TUNAI" data-icon="fa-money-bill-wave">Transaksi TUNAI</option>
                                <option value="KREDIT" data-icon="fa-vote-yea">Transaksi KREDIT</option>
                            </select>
                            <!-- END Select -->
                        </div>
                        <button id="prosesdata" class="btn btn-success float-right"> <i class="fab fa-searchengin"></i> Proses Data</button>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="parameterpencarian">Parameter Pencarian</label>
                                <select id="parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option value="nota">Nota Penjualan</option>
                                    <option value="barang">Nama Barang</option>
                                    <option value="member">Nama Member</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="katakunci">Kata Kunci</label>
                                <input type="text" class="form-control" id="katakunci"
                                    placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input id="daritanggal" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="sampaitanggal" type="text" class="form-control" placeholder="Sampai Tanggal">
                                    <div style="cursor:pointer;" id="pencariantanggal" class="input-group-prepend input-group-append">
                                        <span class="input-group-text btn-warning btn">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="daftarpenjualan" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Tanggal TRX</th>
                                    <th>Nota Penjualan</th>
                                    <th>Kode Member</th>
                                    <th>Nama Member</th>
                                    <th>Σ Nominal</th>
                                    <th>Σ Keluar</th>
                                    <th>Jenis TRX</th>
                                    <th>Outlet</th>
                                    <th>Kasir</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Tanggal TRX</th>
                                    <th>Nota Penjualan</th>
                                    <th>Kode Member</th>
                                    <th>Nama Member</th>
                                    <th>Σ Nominal</th>
                                    <th>Σ Keluar</th>
                                    <th>Jenis TRX</th>
                                    <th>Outlet</th>
                                    <th>Kasir</th>
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
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->include('backend/panggildaftarmember') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>scripts/penjualan/trxpenjualan.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        let firstDay = moment().startOf('month').format('DD-MM-YYYY');
        let lastDay = moment().endOf('month').format('DD-MM-YYYY');
        $('#daritanggal').val(firstDay);
        $('#sampaitanggal').val(lastDay);
        $(".input-daterange").datepicker({
            todayHighlight: true,
            format:'dd-mm-yyyy',
            orientation: "bottom left",
        });
    });
</script>
<?= $this->endSection(); ?>