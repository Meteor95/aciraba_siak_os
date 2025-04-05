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
                            <button id="" data-toggle="modal" data-target="#tambahkategori" class="btn btn-primary"> <i class="fas fa-box-open"></i> Tambah Kategori Barang</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <div class="form-row">
                            <div class="col-md-5">
                                <label for="katakuncipencarian">Nama / Kode Kategori</label>
                                <input type="text" class="form-control" id="katakuncipencarian"
                                    placeholder="Masukan untuk melakukan penyaringan data tersedia">
                            </div>
                            <div class="col-md-7">
                                <p align="justify">Kategori barang adalah fitur yang digunakan untuk mengelompokkan
                                    barang yang tersedia agar mudah dimanajemen lokasi, stok, dan arus barangnya. Anda
                                    dapat menentukan sendiri katgori yang ingin anda gunakan kepada barang anda, tidak
                                    batasan dalam membuat dan menentukan kategori.</p>
                            </div>
                        </div>

                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabelkategori" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Kategori</th>
                                    <th>Nama Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Kategori</th>
                                    <th>Nama Kategori</th>
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
<!-- BEGIN Modal -->
<div class="modal fade" id="tambahkategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kategori Baru</label>
                    <div class="col-sm-9">
                        <!-- BEGIN Input Group -->
                        <div class="input-group">
                            <input id="tambahkodekategori" type="text" class="form-control" placeholder="Kode Kategori [SBK]">
                            <input id="tambahnamakategori" type="text" class="form-control" placeholder="Nama Kategori [SEMBAKO]">
                        </div>
                        <!-- END Input Group -->
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="simpankategori" class="btn btn-primary mr-2">Tambah Kategori Baru</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bebanmanufaktur" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tentukan Beban Manufaktur Berdasarkan Kategori [<span id="idkategori"></span>] <span id="namakategori"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mt-3">Tentukan Beban HPP untuk GAJI</div>
                    <div class="col"><input id="bebangaji" type="text" class="form-control mt-2" placeholder="Beban Gaji"><hr></div>
                </div>
                <div class="row">
                    <div class="col mt-3">Tentukan Beban HPP untuk PACKING</div>
                    <div class="col"><input id="bebanpacking" type="text" class="form-control mt-2" placeholder="Beban Packing"><hr></div>
                </div>
                <div class="row">
                    <div class="col mt-3">Tentukan Beban HPP untuk PROMO</div>
                    <div class="col"><input id="bebanpromo" type="text" class="form-control mt-2" placeholder="Beban Promo"><hr></div>
                </div>
                <div class="row">
                    <div class="col mt-3">Tentukan Beban HPP untuk TRANSPORT</div>
                    <div class="col"><input id="bebantransport" type="text" class="form-control mt-2" placeholder="Beban Transport"><hr></div>
                </div><hr>
                <button onclick="ubahbebanmanufaktur()" class="btn btn-primary btn-block"> Simpan Informasi </button>
            </div>
            <div class="modal-footer">
            <p class="mb-0">Berikan informasi beban pada kategori terpilih. Beban akan di sarankan pada PEMBELIAN BARANG, jadi ini hanya bersifat saran bukan acuan mutlak</p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    getCsrfTokenCallback(function() {
    $("#tabelkategori").DataTable({
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
            "url": baseurljavascript + 'masterdata/jsondaftarkategori',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.KATAKUNCIPENCARIAN = $('#katakuncipencarian').val() == null ? "" : $('#katakuncipencarian').val();
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        }
    });
    });
});
function ubahbebanmanufaktur(){
    Swal.fire({
        title: "Ubah Informasi Beban Manufaktur",
        text: "Apkaha anda ingin mengubah besaran beban manufaktur pada KATEGORI : "+$('#namakategori').html()+"",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Ubah Informasi Beban!'
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/ubahbebanmanufaktur',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KODEKATEGORI: $('#idkategori').html(),
                    BEBANGAJI: $('#bebangaji').val(),
                    BEBANPACKING:  $('#bebanpacking').val(),
                    BEBANPROMO:  $('#bebanpromo').val(),
                    BEBANTRANSPORT:  $('#bebantransport').val(),
                    KODEUNIKMEMBER: session_kodeunikmember,
                    NAMAKATEGORI: $('#namakategori').html(),
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    if (obj.status == "true") {
                        Swal.fire(
                            'Berhasil.. Horee!',
                            obj.msg,
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Gagal.. Uhhhhh!',
                            obj.msg,
                            'warning'
                        )
                    }
                    $('#bebanmanufaktur').modal('toggle');
                    getCsrfTokenCallback(function() {
                        $('#tabelkategori').DataTable().ajax.reload();
                    });
                }
            });
            });
        }
    });
}
function panggilformbebanmanufaktur(idkategori,namakategori,bebangaji,bebanpacking,bebanpromo,bebantransport){
    $('#bebangaji').val(bebangaji);
    $('#bebantransport').val(bebantransport);
    $('#bebanpromo').val(bebanpromo);
    $('#bebanpacking').val(bebanpacking);
    $('#namakategori').html(namakategori);
    $('#idkategori').html(idkategori);
    $('#bebanmanufaktur').modal('toggle');
}
function onclickdeletekategori(kodekategori, namakategori) {
    Swal.fire({
        title: "Hapus Kateogir Item",
        text: "Anda akan menghapus KATEGORI : " + namakategori + " [" + kodekategori + "] pada aplikasi",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#hapuskategori'+kodekategori).prop("disabled",true);
            $('#hapuskategori'+kodekategori).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsonhapuskategori',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KODEKATEGORI: kodekategori,
                    KODEUNIKMEMBER: session_kodeunikmember,
                },
                complete:function(){
                    $('#hapuskategori'+kodekategori).prop("disabled",false);
                    $('#hapuskategori'+kodekategori).html('<i class="fa fa-trash"></i> Hapus');
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    if (obj.status == "true") {
                        getCsrfTokenCallback(function() {
                            $('#tabelkategori').DataTable().ajax.reload();
                        });
                        Swal.fire(
                            'Berhasil.. Horee!',
                            obj.msg,
                            'success'
                        )
                    } else {
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
    });
}
$('#katakuncipencarian').on('input', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#tabelkategori').DataTable().ajax.reload();
    });
}, 500))
$("#simpankategori").click(function() {
    if ($("#tambahkodekategori").val() == "" || $("#tambahnamakategori").val() == ""){
        return Swal.fire({
            icon: 'warning',
            html: 'Silahkan lengkapi informasi KODE KATEGORI, NAMA KATEGORI',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menambahkan KATEGORI : "+$("#tambahnamakategori").val()+" dengan KODE "+$("#tambahkodekategori").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#simpankategori').prop("disabled",true);
            $('#simpankategori').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsontambahkategori',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KATEGORIPARENT_ID : $("#tambahkodekategori").val(),
                    NAMAKATEGORI : $("#tambahnamakategori").val(),
                    LOGOKATEGORI : "-",
                    KODEUNIKMEMBER : session_kodeunikmember
                },
                complete:function(){
                    $('#simpankategori').prop("disabled",false);
                    $('#simpankategori').html('Tambah Kategori Baru');
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    $('#tabelsatuan').DataTable().ajax.reload();
                    if (obj.status == "true"){
                        Swal.fire(
                            'Berhasil.. Horee!',
                            obj.msg,
                            'success'
                        )
                        getCsrfTokenCallback(function() {
                            $('#tabelkategori').DataTable().ajax.reload();
                        });
                        $('#tambahkategori').modal('hide');
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
    });
});
</script>
<?= $this->endSection(); ?>