<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div class="form-row">
                            <div class="col">
                                <p align="justify">History harga jual berfungsi untuk melihat aktivitas/history
                                    transaksi Penjualan kepada pelanggan/konsumen. Sehingga anda dapat menentukan harga
                                    jual yang cocok agar penjualan lebih statbil dengan margin yang flexible. Dalam
                                    acipay anda tidak perlu mencari nota penjualan untuk melakukan hal tersebut.
                                    Silahkan anda masukkan kode atau namabarangnya maka semua log akan muncul dari
                                    terbaru hingga terlama</p>
                            </div>
                            <div class="col-md-1 col-sm-12 mb-0">
                                <button id="prosescari" class="btn btn-success float-right"> <i class="fab fa-searchengin"></i>
                                    Proses Data</button>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="kodeitemdiskon">Parameter Pencarian</label>
                                <select id="parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option value="barang"> Kode Barang</option>
                                    <option value="namabarang"> Nama Barang</option>
                                    <option value="namamember"> Dijual Ke</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="kodeitemdiskon">Kata Kunci</label>
                                <input id="katakunci" type="text" class="form-control"
                                    placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input id="tanggalawalhis" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="tanggalakhirhis" type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabelhistoryhj" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Di Jual</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nota Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Di Jual</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nota Transaksi</th>
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#tanggalawalhis').val(moment().format('DD-MM-YYYY'));
        $("#tanggalawalhis").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
        $('#tanggalakhirhis').val(moment().format('DD-MM-YYYY'));
        $("#tanggalakhirhis").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
        getCsrfTokenCallback(function() {
            $("#tabelhistoryhj").DataTable({
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        text: '<i class="far fa-copy"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i> Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="far fa-file-pdf"></i> PDF',
                        titleAttr: 'PDF'
                    }
                ],
                scrollCollapse: true,
                scrollY: "50vh",
                scrollX: true,
                bFilter: false,
                ajax: {
                    "url": baseurljavascript + 'penjualan/hishargajual',
                    "method": 'POST',
                    "data": function (d) {
                        d.csrf_aciraba = csrfTokenGlobal;
                        d.BERDASARKAN = $('#parameterpencarian').val();
                        d.KATAKUNCI = $('#katakunci').val();
                        d.TANGGALAWAL = $('#tanggalawalhis').val().split("-").reverse().join("-");;
                        d.TANGGALAKHIR = $('#tanggalakhirhis').val().split("-").reverse().join("-");;
                    },
                }
            });
        });
});
$("#prosescari").click(function() {
    $('#tabelhistoryhj').DataTable().ajax.reload();
});
$("#parameterpencarian, #katakunci, #tanggalawalhis, #tanggalakhirhis").on('keyup input propertychange paste', debounce(function (e) {
    $('#tabelhistoryhj').DataTable().ajax.reload();
}, 500));
</script>
<?= $this->endSection(); ?>