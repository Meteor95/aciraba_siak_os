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
                        <a href="<?= base_url() ;?>penyesuaian/formpenyesuianstok"><button id="" class="btn btn-primary"> <i class="fas fa-box"></i> Tambah Penyesuaian Stok</button></a>
                            <button id="prosespencarian" class="btn btn-primary float-right"> <i class="fas fa-search"></i> Proses Pencarian</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                        <p align="justify" class="m-2">Pada saat pelaksanaan stock opname atau penghitungan barang secara fisik, kadang terjadi selisih/perbedaan antara stok actual/fisik dan stok pada sistem kartustok. Petugas bagian gudang kadang mengalami kesalahan pencatatan data, baik salah menuliskan angka atau terlewat mencatat. Kondisi ini dapat mengakibatkan kerugian apabila tidak segera diperbaiki sesegera mungkin. <br>Selain itu penyesuaian stok juga dapat digunakan bagi Anda sebagai pengguna baru Kartustok yang telah memiliki catatan transaksi gudang terlebih dahulu. Sehingga Anda dapat memasukan data sesuai catatan saat ini.</p>
                            <div class="col-md-2 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="parameterpencarian">Parameter Pencarian</label>
                                <select onchange="refreshgrid()" id="parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option value="notrx"> No Transakasi</option>
                                    <option value="kodeitem"> Kode Item</option>
                                    <option value="namaitem"> Nama Barang</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-2 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="lokasibarang">Lokasi Barang Pencarian</label>
                                <select onchange="refreshgrid()" id="lokasibarang" class="selectpicker" data-live-search="true">
                                    <option value=""> Semua</option>
                                    <option value="D"> Display</option>
                                    <option value="G"> Gudang</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="katakuncipencarian">Kata Kunci</label>
                                <input type="text" class="form-control" id="katakuncipencarian" placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input id="tanggalawal" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="tanggalakhir" type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="daftaropname" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Opanme</th>
                                    <th>Σ Barang</th>
                                    <th>Σ Minus</th>
                                    <th>Σ Surplus</th>
                                    <th>Σ Nominal</th>
                                    <th>Tanggal Trx</th>
                                    <th>Outlet</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Opanme</th>
                                    <th>Σ Barang</th>
                                    <th>Σ Minus</th>
                                    <th>Σ Surplus</th>
                                    <th>Σ Nominal</th>
                                    <th>Tanggal Trx</th>
                                    <th>Outlet</th>
                                    <th>Keterangan</th>
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
<div class="modal fade" id="modaldetailopname">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Penyesuaian Item NOTA : <span id="notaopnameterpilih"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <input id="daftaropnamelist_katakunci" type="hidden" class="form-control mb-2 mt-2"  placeholder="Masukan kata kunci yang anda inginkan">
                <!-- BEGIN Datatable -->
                <table id="daftaropnamelist" class="dataTable table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Lokasi Item / Kondisi</th>
                            <th>Stok Komputer</th>
                            <th>Stok Digital</th>
                            <th>HPP Saat OP</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Lokasi Item / Kondisi</th>
                            <th>Stok Komputer</th>
                            <th>Stok Digital</th>
                            <th>HPP Saat OP</th>
                            <th>Keterangan</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- END Datatable -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#tanggalawal').val(moment().startOf('month').format('DD-MM-YYYY'));
    $("#tanggalawal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
    $('#tanggalakhir').val(moment().format('DD-MM-YYYY'));
    $("#tanggalakhir").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
    getCsrfTokenCallback(function() {
        $("#daftaropname").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            scrollX: true,
            scrollCollapse: true,
            searching: false,
            //columnDefs: [
            //    {className: "text-right",targets: [4,7]},
            //],
            ajax: {
                "url": baseurljavascript + 'penyesuaian/daftarpenyesuaianstok',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.DIMANA1 = $("#parameterpencarian").val();
                    d.DIMANA2 = $("#katakuncipencarian").val();
                    d.DIMANA3 = $("#lokasibarang").val();
                    d.DIMANA4 = $("#tanggalawal").val().split("-").reverse().join("-");
                    d.DIMANA5 = $("#tanggalakhir").val().split("-").reverse().join("-");
                }
            },
        }); 
    }); 
});
function refreshgrid(){
    getCsrfTokenCallback(function() {
        $('#daftaropname').DataTable().ajax.reload();
    });
}
$("#katakuncipencarian, #prosespencarian").on('input change click', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#daftaropname').DataTable().ajax.reload();
    });
}, 500));
function daftardetailopname(notaopnema){
    $('#notaopnameterpilih').html(notaopnema);
    getCsrfTokenCallback(function() {
        $("#daftaropnamelist").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            scrollX: true,
            scrollCollapse: true,
            searching: true,
            //columnDefs: [
            //    {className: "text-right",targets: [4,7]},
            //],
            stateSave: true,
            bDestroy: true,
            ajax: {
                "url": baseurljavascript + 'penyesuaian/daftardetailopname',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.DIMANA1 = notaopnema;
                    d.DIMANA2 = $("#daftaropnamelist_katakunci").val();
                }
            },
        });
    }); 
    $('#modaldetailopname').modal('show');
}
</script>
<?= $this->endSection(); ?>