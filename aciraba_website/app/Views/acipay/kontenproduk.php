<?= $this->extend('backend/main_acipay'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <a class="mr-2" href="<?= base_url() ;?>acipay/tambahproduk"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Tambah Produk</button></a>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-9 mb-1 col-sm-12">
                                <label for="katakunciproduk">Kata Kunci Nama Produk</label>
                                <input type="text" class="form-control" id="katakunciproduk" placeholder="Masukan nama produk yang anda inginkan">
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label for="statusbarang">Status Produk Ditampilkan</label><br>
                                <div id="statusbarang" class="btn-block btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-flat-success active">
                                        <input type="radio" name="rb_statusbarang" value="1" id="rb_barangaktif" checked="checked"> Produk Aktif </label>
                                    <label class="btn btn-flat-danger">
                                        <input type="radio" name="rb_statusbarang" value="0" id="rb_barangtidakaktif"> Produk Gangguan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="kuncikategori">Filter Berdasarkan Kategori</label>
                                <select class="form-control" id="kuncikategori"></select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="kuncioperator">Filter Berdasarkan Operator</label>
                                <select class="form-control" id="kuncioperator"></select>
                            </div>
                            <div class="col-md-2 mb-3 mt-2">
                                <br>
                                <button id="prosescaricmb" class="btn btn-block btn-primary"> <i class="fas fa-search"></i> Proses Data</button>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="daftarprodukacipay" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Produk ID</th>
                                    <th>Server Produk ID</th>
                                    <th>Nama Produk</th>
                                    <?php 
                                    if ($jenisproduk == "TAGIHAN"){
                                        echo "<th>Admin</th>
                                        <th>Komisi</th>";
                                    }else{
                                        echo "<th>Harga Server</th>
                                        <th>Harga Umum</th>
                                        <th>Harga Agen</th>
                                        <th>Harga Spesial</th>";
                                    }
                                    ;?>
                                    <th>Status Trx</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Produk ID</th>
                                    <th>Server Produk ID</th>
                                    <th>Nama Produk</th>
                                    <?php 
                                    if ($jenisproduk == "TAGIHAN"){
                                        echo "<th>Admin</th>
                                        <th>Komisi</th>";
                                    }else{
                                        echo "<th>Harga Server</th>
                                        <th>Harga Umum</th>
                                        <th>Harga Agen</th>
                                        <th>Harga Spesial</th>";
                                    }
                                    ;?>
                                    <th>Status Trx</th>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">

$(document).ready(function () {
loaddatakategori()
$('#kuncikategori').select2({
    allowClear: true,
    placeholder: 'Tentukan kategori produk',
    ajax: {
        url: baseurljavascript + 'acipay/kategoriselect2',
        method: 'POST',
        dataType: 'json',
        delay: 500,
        data: function (params) {
            return {
                csrf_aciraba: csrfTokenGlobal,
                KATAKUNCI: (typeof params.term === "undefined" ? "" : params.term),
            }
        },
        processResults: function (data) {
            parseJSON = JSON.parse(data);
            getCsrfTokenCallback(function() {});
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "[" + item.idkategori + "] " + item.namakategori,
                        id: item.idkategori,
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            getCsrfTokenCallback(function() {});
            toastr["error"]("Kesalahan dalam request payload. Silahkan cek konsol LOG pada server");
        }
    },
});
$('#kuncioperator').select2({
    allowClear: true,
    placeholder: 'Tentukan operator produk',
    ajax: {
        url: baseurljavascript + 'acipay/pilihoperator',
        method: 'POST',
        dataType: 'json',
        delay: 500,
        data: function (params) {
            return {
                csrf_aciraba: csrfTokenGlobal,
                KATAKUNCI: (typeof params.term === "undefined" ? "" : params.term),
            }
        },
        processResults: function (data) {
            parseJSON = JSON.parse(data);
            getCsrfTokenCallback(function() {});
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "[" + item.idoperator + "] " + item.namaoperator,
                        id: item.idoperator,
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            getCsrfTokenCallback(function() {});
            toastr["error"]("Kesalahan dalam request payload. Silahkan cek konsol LOG pada server");
        }
    },
});
});
function loaddatakategori(){
getCsrfTokenCallback(function() {
$("#daftarprodukacipay").DataTable({
    language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
    scrollCollapse: true,
    scrollY: "100vh",
    scrollX: true,
    bFilter: false,
    pageLength: 100,
    lengthMenu: [[10, 50, 100 , 500, -1], [10, 50, 100, 500, "All"]],
    ajax: {
        "url": baseurljavascript + 'acipay/daftarproduk',
        "method": 'POST',
        "data": function (d) {
            d.csrf_aciraba= csrfTokenGlobal,
            d.KATAKUNCI = $('#katakunciproduk').val();
            d.STATUS = statusbarang;
            d.JENISPRODUK = '<?= $jenisproduk;?>';
            d.KUNCIKATEGORI = $('#kuncikategori').val();
            d.KUNCIOPERATOR = $('#kuncioperator').val();
        },
    }
});
});
}
$("#statusbarang").click(function () {
    if ($('input[name="rb_statusbarang"]:checked').val() == 1) {
        statusbarang = 0;
    } else {
        statusbarang = 1;
    }
    $('#daftarprodukacipay').DataTable().ajax.reload();
});
$("#prosescaricmb").click(function () {
    $('#daftarprodukacipay').DataTable().ajax.reload();
});
$('#katakunciproduk').on('input', debounce(function (e) {
    $('#daftarprodukacipay').DataTable().ajax.reload();
}, 500));
$("#jenisproduk").change(function () {
    $('#daftarprodukacipay').DataTable().ajax.reload();
});
$("#kuncikategori, #kuncioperator").on("input", function () { $('#daftarprodukacipay').DataTable().ajax.reload(); });

function sinkronperbarang(serverid,jenisproduk,filter,kategoriid,namaproduk,barangid){
    Swal.fire({
        title: "Ingin melakukan SINKRONISASI produk",
        text: "Apakah anda ingin melakukan sinkronisasi terhadap barang "+namaproduk+" dengan kode server "+serverid+" ?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke.. Sinkron Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#btnsinkron'+barangid).prop("disabled",true);
            $('#btnsinkron'+barangid).html('<i class="fa fa-spin fa-spinner"></i> Sinkron Data');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'acipay/sinkronproduk',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        csrf_aciraba: csrfTokenGlobal,
                        SERVERID:serverid,
                        JENISPRODUK:jenisproduk,
                        SKU_EXACT:filter,
                        SKU_FILTER:"",
                        KATEGORI_ID:kategoriid,
                    },
                    complete:function(){
                        $('#btnsinkron'+barangid).prop("disabled",false);
                        $('#btnsinkron'+barangid).html("<i class=\"fas fa-sync\"></i>");
                    },
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire(
                                'Sinkron Sukses. Horee!!',
                                response.msg,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                response.msg,
                                'warning'
                            )
                        }
                        $('#modalsinkronproduk').unblock();
                    }
                });
            });
        }
    })
}
function hapusperproduk(produk_id,nama_produk,server_id,baris) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Informasi mengenai produk dengan ID : '+produk_id+' dengan NAMA : '+nama_produk+' dari VENDOR SERVER '+server_id+' ini akan tetap tercatat pada sistem.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus Gan Produk Ini!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#btnhapus'+produk_id).prop("disabled",true);
            $('#btnhapus'+produk_id).html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'acipay/hapusperproduk',
                method: 'POST',
                dataType: 'json',
                data: {
                    csrf_aciraba: csrfTokenGlobal,
                    'BARISKE' : baris,
                },
                complete:function(){
                    $('#btnhapus'+produk_id).prop("disabled",false);
                    $('#btnhapus'+produk_id).html("<i class=\"fas fa-trash\"></i>");
                },
                success: function (response) {
                    if (response.success == true){
                        Swal.fire(
                            'Informasi Produk Berhasil Dihapus!!!',
                            'Informasi mengenai produk dengan ID : '+produk_id+' dengan NAMA : '+nama_produk+' dari VENDOR SERVER '+server_id+' berhasil dihapus',
                            'success'
                        )
                        $('#daftarprodukacipay').DataTable().ajax.reload();
                    }else{
                        Swal.fire(
                            'Wadidaw Terjadi Kegagalan!',
                            response.msg,
                            'error'
                        )
                    }
                },
                error: function(xhr, status, error) {
                    getCsrfTokenCallback(function() {});
                    toastr["error"](xhr.responseJSON.message);
                }
            });
            });
        }
    })
};
</script>
<?= $this->endSection(); ?>