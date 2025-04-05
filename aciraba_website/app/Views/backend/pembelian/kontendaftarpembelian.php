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
                        <a href="<?= base_url() ;?>pembelian/formpembelian"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Tambah Pembelian</button></a>
                            <button id="prosescarifilter" class="btn btn-success float-right"> <i class="fas fa-search"></i> Proses Filter</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="parameterpencarian">Parameter Pencarian</label>
                                <select id="parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option value="notrx">No Transakasi</option>
                                    <option value="kodeitem">Kode Item</option>
                                    <option value="namabarang">Nama Barang</option>
                                    <option value="namapetugas">Nama Petugas</option>
                                    <option value="namasuplier">Nama Suplier</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="katakuncipencarian">Kata Kunci</label>
                                <input type="text" class="form-control" id="katakuncipencarian" placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input type="text" class="form-control" id="tanggalawal" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="tanggalakhir" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="daftarpembelian" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Tranaksi</th>
                                    <th>Nama Suplier</th>
                                    <th>Nama Petugas</th>
                                    <th>Total Pembelian</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>TOP</th>
                                    <th>Total Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>No Tranaksi</th>
                                    <th>Nama Suplier</th>
                                    <th>Nama Petugas</th>
                                    <th>Total Pembelian</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>TOP</th>
                                    <th>Total Barang</th>
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
<script type="text/javascript" src="<?=base_url();?>scripts/globalfn.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#tanggalawal').val(moment().startOf('month').format('DD-MM-YYYY'));
    $("#tanggalawal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#tanggalakhir').val(moment().format('DD-MM-YYYY'));
    $("#tanggalakhir").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    getCsrfTokenCallback(function() {
        $("#daftarpembelian").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            scrollX: true,
            scrollCollapse: true,
            searching: false,
            columnDefs: [
                {className: "text-right",targets: [4,7]},
            ],
            ajax: {
                "url": baseurljavascript + 'pembelian/daftarpembeliantabel',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KATAKUNCIPENCARIAN = $("#katakuncipencarian").val();
                    d.TANGGALAWAL = $("#tanggalawal").val().split("-").reverse().join("-");
                    d.TANGGALAKHIR = $("#tanggalakhir").val().split("-").reverse().join("-");
                    d.KONDISIPENCARIAN = $("#parameterpencarian").val();
                }
            },
        }); 
    }); 
});
$("#katakuncipencarian, #parameterpencarian").on('input change', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#daftarpembelian').DataTable().ajax.reload();
    });
}, 500));
$("#prosescarifilter").on("click", function () {
    getCsrfTokenCallback(function() {
        $('#daftarpembelian').DataTable().ajax.reload();
    });
});
function onclickhapustranskasipembelian(notapembelian,namasuplier,kodesuplier){
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Apakah anda ingin menghapus TRANSAKSI '+notapembelian+' dari NAMA SUPLIER '+namasuplier+' ['+kodesuplier+']. Informasi yang terhubung dengan '+notapembelian+' akan dihapus termasuk HUTANG TOKO hingga JURNAL TRANSAKSI. Stok akan diretur dikurangi dan dicatat di KARTU STOK tanpa mutasi',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Siap!!'
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'pembelian/hapuspembelian',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        NOTA : notapembelian,
                        KODESUPLIER : kodesuplier,
                    },
                    success: function (response) {
                        var obj = $.parseJSON(response);
                        if (obj.status == "true"){
                            Swal.fire(
                                'Berhasil.. Horee!',
                                obj.msg,
                                'success'
                            );
                            getCsrfTokenCallback(function() {
                                $('#daftarpembelian').DataTable().ajax.reload();
                            });
                        }else{
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                obj.msg,
                                'warning'
                            )
                        }
                    }
                });
            });
        }
    })
}
</script>
<?= $this->endSection(); ?>