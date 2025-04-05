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
                        <a href="<?= base_url() ;?>pembelian/formreturpembelian"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Tambah Retur Pembelian</button></a>
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
                                    <option value="kodesuplier">Kode Suplier</option>
                                    <option value="namasuplier">Nama Suplier</option>
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
                        <table id="tabelreturpembelian" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Transaksi</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal Retur</th>
                                    <th>Total Barang</th>
                                    <th>Total Nominal</th>
                                    <th>Total Potongan</th>
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
                                    <th>Total Potongan</th>
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
<script type="text/javascript">
$(document).ready(function () {
$("#daritanggal").val(moment().format('DD-MM-YYYY'));
$("#daritanggal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
$("#sampaitanggal").val(moment().format('DD-MM-YYYY'));
$("#sampaitanggal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
getCsrfTokenCallback(function() {
    $("#tabelreturpembelian").DataTable({
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
                "url": baseurljavascript + 'pembelian/jsondaftarreturpembelian',
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
        $('#tabelreturpembelian').DataTable().ajax.reload();
    });
});
$("#katakunci, #daritanggal, #sampaitanggal").on('keyup input propertychange paste click', debounce(function(e) {
    getCsrfTokenCallback(function() {
        $('#tabelreturpembelian').DataTable().ajax.reload();
    });
}, 500))
function hapusreturpembelian(notransaksi,nominal){
    swal.fire({
        title: "Hapus Transaksi Retur Pembelian ?",
        text: "Apakah anda ingin menghapus TRANSAKSI RETUR dengan NOTA : "+notransaksi+" dengan besaran nominal "+nominal,
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Hapus Ini!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'pembelian/hapusreturpembelian',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        NOTARETUR: notransaksi,
                    },
                    success: function (response) {
                        if (response[0].success == "true"){
                            Swal.fire({
                                title: "Hapus Transkasi Retur Pembelian",
                                text: "Hapus transaksi retur penjualan dengan NOTA : "+notransaksi+" dengan besaran nominal "+nominal+" berhasil di hapus. Stok akan dikurangi dan dicatat pada KARTU STOK",
                                icon: "success",
                            });
                            $('#tabelreturpembelian').DataTable().ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Gagal... Cek Log Kesalahan",
                                text: response[0].msg,
                                icon: 'warning',
                            });
                        }
                    }
                });
            });
        }
    })
}
</script>
<?= $this->endSection(); ?>