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
                                <p align="justify">History harga beli berfungsi untuk melihat aktivitas atau history pembelian item dari supplier. Dengan melihat harga beli anda dapat melihat perkembangan HPP dasar anda atas suplier langganan anda apakah layak diteruskan atau tidak, serta berapa kali anda pesan terhadap suplier langganan anda. Silahkan anda masukkan kode atau namabarangnya maka semua log akan muncul dari terbaru hingga terlama</p>
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
                                <label for="parameterpencarian">Parameter Pencarian</label>
                                <select id="parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option value="barang"> Kode Barang</option>
                                    <option value="namabarang"> Nama Barang</option>
                                    <option value="namasuplier"> Nama Suplier</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="katakunci">Kata Kunci</label>
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
                        <table id="tabelhistoryhb" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Nama Suplier</th>
                                    <th>Total Beli</th>
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
                                    <th>Nama Suplier</th>
                                    <th>Total Beli</th>
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
    $('#tanggalawalhis').val(moment().startOf('month').format('DD-MM-YYYY'));
    $("#tanggalawalhis").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#tanggalakhirhis').val(moment().format('DD-MM-YYYY'));
    $("#tanggalakhirhis").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    getCsrfTokenCallback(function() {
        $("#tabelhistoryhb").DataTable({
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
                "url": baseurljavascript + 'pembelian/hishargabeli',
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
    getCsrfTokenCallback(function() {
        $('#tabelhistoryhb').DataTable().ajax.reload();
    });
});
$("#katakunci, #tanggalawalhis, #tanggalakhirhis").on('keyup input propertychange paste',  debounce(function(e) {
    getCsrfTokenCallback(function() {
        $('#tabelhistoryhb').DataTable().ajax.reload();
    });
}, 500))
</script>
<?= $this->endSection(); ?>