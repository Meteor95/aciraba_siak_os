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
                        <button id="" data-toggle="modal" data-target="#tambahkategorimember" class="btn btn-primary"> <i class="fas fa-box-open"></i> Tambah Kategori Member</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                    <div class="form-row">
                            <div class="col-md-5">
                                <label for="katakuncipencarian">Nama / Kode Kategori</label>
                                <input type="text" class="form-control" id="katakuncipencarian" placeholder="Masukan untuk melakukan penyaringan data tersedia">
                            </div>
                            <div class="col-md-7">
                            <p align="justify">Status Membership adalah status member pengguna Acipay yang diperoleh melalui transaksi. Semakin sering pengguna bertransaksi atau semakin tinggi transaksi pengguna maka semakin tinggi Status Membership yang diperoleh. Berikut adalah informasi daftarnya.</p><hr>
                            </div>
                        </div>
                        <!-- BEGIN Datatable -->
                        <table id="tabelkategorimember" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Kat. Member</th>
                                    <th>Jenis Kat. Member</th>
                                    <th>Nama Kat. Member</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Kat. Member</th>
                                    <th>Jenis Kat. Member</th>
                                    <th>Nama Kat. Member</th>
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
<div class="modal fade" id="tambahkategorimember">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h5 class="modal-title">Tambah Kategori Member</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- BEGIN Input Group -->
                <div class="form-group row">
                    <label for="kodememberkategori" class="col-sm-3 col-form-label">Kode Kategori</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input value="" type="text" id="kodememberkategori" class="form-control"
                                placeholder="Tentukan Kode Kategori Member">
                            <div class="input-group-prepend">
                                <span id="generateiditem"
                                    class="input-group-text btn-warning btn">Generate ID</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jeniskategorimember" class="col-sm-3 col-form-label">Jenis Kategori</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input value="" type="text" id="jeniskategorimember" class="form-control"
                                placeholder="Tentukan Jenis Kategori Member">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namakategorimember" class="col-sm-3 col-form-label">Nama Kategori</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input value="" type="text" id="namakategorimember" class="form-control"
                                placeholder="Tentukan Nama Kategori Member">
                        </div>
                    </div>
                </div>
                <!-- END Input Group -->
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="simpankategorimember" class="btn btn-primary mr-2">Tambah Kategori Member</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    getCsrfTokenCallback(function() {
    $("#tabelkategorimember").DataTable({
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
            "url": baseurljavascript + 'masterdata/jsondaftarkategorianggota',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.KATAKUNCIPENCARIAN = $('#katakuncipencarian').val();
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        }
    });
    });
});
$('#katakuncipencarian').on('input', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#tabelkategorimember').DataTable().ajax.reload();
    });
}, 500))
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
            $('#hapuskategorimember'+kodekategori).prop("disabled",true);
            $('#hapuskategorimember'+kodekategori).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsonhapuskategorianggota',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KODEKATEGORI: kodekategori,
                    KODEUNIKMEMBER: session_kodeunikmember,
                },
                complete:function(){
                    $('#hapuskategorimember'+kodekategori).prop("disabled",false);
                    $('#hapuskategorimember'+kodekategori).html('<i class="fa fa-trash"></i> Hapus');
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    if (obj.status == "true") {
                        getCsrfTokenCallback(function() {
                            $('#tabelkategorimember').DataTable().ajax.reload();
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
$("#simpankategorimember").click(function() {
    if ($("#kodememberkategori").val() == "" || $("#jeniskategorimember").val() == "" || $("#namakategorimember").val() == ""){
        return Swal.fire({
            icon: 'warning',
            html: 'Silahkan lengkapi informasi KODE KATEGORI MEMBER, <br>JENIS KATEGORI MEMBER, NAMA KATEGORI MEMBER',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menambahkan KATEGORI MEMBER : "+$("#tambahnamakategorimember").val()+" dengan KODE "+$("#tambahkodekategorimember").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#simpankategorimember').prop("disabled",true);
            $('#simpankategorimember').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsontambahkategorianggota',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KODEGRUP : $("#kodememberkategori").val(),
                    JENIS : $("#jeniskategorimember").val().toUpperCase(),
                    GRUP : $("#namakategorimember").val(),
                    KODEUNIKMEMBER : session_kodeunikmember
                },
                complete:function(){
                    $('#simpankategorimember').prop("disabled",false);
                    $('#simpankategorimember').html('Tambah Kategori Member');
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    getCsrfTokenCallback(function() {
                        $('#tabelkategorimember').DataTable().ajax.reload();
                    });
                    if (obj.status == "true"){
                        Swal.fire(
                            'Berhasil.. Horee!',
                            obj.msg,
                            'success'
                        )
                        $("#kodememberkategori").val("");
                        $("#jeniskategorimember").val("");
                        $("#namakategorimember").val("");
                        $('#tambahkategorimember').modal('hide');
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
$("#generateiditem").on("click", function () {
    $('#kodememberkategori').val("KM" + session_kodeunikmember +Math.floor(Date.now() / 1000));
});
</script>
<?= $this->endSection(); ?>