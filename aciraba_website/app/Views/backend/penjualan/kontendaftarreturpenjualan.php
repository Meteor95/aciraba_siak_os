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
                            <a href="<?= base_url() ;?>penjualan/tambahreturpenjualan"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Tambah Retur Penjualan</button></a>
                            <button id="prosesreload" class="btn btn-success float-right"> <i class="fas fa-cog"></i> Proses Cek</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="parameterpencarian">Parameter Pencarian</label>
                                <select id="parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option value="notrx">No Transaksi</option>
                                    <option value="kodeitem">Kode Item</option>
                                    <option value="namaitem">Nama Barang</option>
                                    <option value="kodemember">Kode Member</option>
                                    <option value="namamember">Nama Member</option>
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
                        <table id="tabelreturpenjualan" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Retur</th>
                                    <th>Total Barang</th>
                                    <th>Total Nominal</th>
                                    <th>Petugas</th>
                                    <th>Outlet</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Retur</th>
                                    <th>Total Barang</th>
                                    <th>Total Nominal</th>
                                    <th>Petugas</th>
                                    <th>Outlet</th>   
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
<script src="<?= base_url();?>scripts/penjualan/returpenjualan.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#daritanggal").val(moment().format('DD-MM-YYYY'));
    $("#daritanggal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
    $("#sampaitanggal").val(moment().format('DD-MM-YYYY'));
    $("#sampaitanggal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
    getCsrfTokenCallback(function() {
        $("#tabelreturpenjualan").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            keys: true,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: false,
            columnDefs : [
                //{ 'visible': false, 'targets': [1,2] }
            ],
            ajax: {
                "url": baseurljavascript + 'penjualan/jsondaftarreturpenjualan',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.parameterpencarian = $('#parameterpencarian').val()
                    d.katakunci = $('#katakunci').val()
                    d.tanggalawal = $('#daritanggal').val().split("-").reverse().join("-");
                    d.tanggalakhir = $('#sampaitanggal').val().split("-").reverse().join("-");
                },
            },
        })
    });
});
$("#prosesreload").on("click", function () {
    getCsrfTokenCallback(function() {
        $('#tabelreturpenjualan').DataTable().ajax.reload();
    });
});
$("#parameterpencarian, #katakunci, #daritanggal, #sampaitanggal").on('keyup input propertychange paste click', debounce(function(e) {
    getCsrfTokenCallback(function() {
        $('#tabelreturpenjualan').DataTable().ajax.reload();
    });
}, 500))
</script>
<?= $this->endSection(); ?>