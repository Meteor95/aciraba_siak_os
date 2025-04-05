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
                            <button id="" data-toggle="modal" data-target="#tambahsatuan" class="btn btn-primary"> <i
                                    class="fas fa-box-open"></i> Tambah Satuan Barang</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <div class="form-row">
                            <div class="col-md-5">
                                <label for="kodesatuan">Nama / Kode Satuan</label>
                                <input type="text" class="form-control" id="kodesatuan"
                                    placeholder="Masukan untuk melakukan penyaringan data tersedia">
                            </div>
                            <div class="col-md-7">
                                <p align="justify">Satuan ukuran jumlah barang berguna dalam kehidupan sehari-hari. Ada
                                    lusin, gross, rim, dan kodi. Semuanya bermanfaat untuk penghitungan jumlah barang
                                    atau komoditas. Masing-masing memiliki fungsi yang berbeda. Begitupun juga nilainya,
                                    tentunya berbeda pula.</p>
                            </div>
                        </div>
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabelsatuan" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Satuan</th>
                                    <th>Nama Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Satuan</th>
                                    <th>Nama Satuan</th>
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
<div class="modal fade" id="tambahsatuan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h5 class="modal-title">Tambah Satuan</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Satuan Baru</label>
                    <div class="col-sm-9">
                        <!-- BEGIN Input Group -->
                        <div class="input-group">
                            <input id="kodesatuanisi" type="text" class="form-control" placeholder="Kode Satuan [PCS]">
                            <input id="namasatuan" type="text" class="form-control" placeholder="Nama Satuan [Pieces]">
                        </div>
                        <!-- END Input Group -->
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="simpansatuan" class="btn btn-primary mr-2">Tambah Satuan Baru</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    getCsrfTokenCallback(function() {
        $("#tabelsatuan").DataTable({
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
                "url": baseurljavascript + 'masterdata/jsondaftarsatuan',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KATAKUNCIPENCARIAN = $('#kodesatuan').val() == null ? "" : $('#kodesatuan').val();
                    d.DATAKE = 0;
                    d.LIMIT = 500;
                },
            }
        });
    });
});
function onclickdeletesatuan(kodesatuan, namasatuan) {
    Swal.fire({
        title: "Hapus Kategori Item",
        text: "Anda akan menghapus SATUAN: " + namasatuan + " [" + kodesatuan + "] pada aplikasi",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#onclickdeletesatuan'+kodesatuan.trim()).prop("disabled",true);
            $('#onclickdeletesatuan'+kodesatuan.trim()).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsonhapussatuan',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KODESATUAN: kodesatuan,
                    KODEUNIKMEMBER: session_kodeunikmember,
                },
                success: function (response) {
                    if (response.success == "true"){
                        getCsrfTokenCallback(function() {
                            $('#tabelsatuan').DataTable().ajax.reload();
                        });
                        Swal.fire(
                            'Berhasil.. Horee!',
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
                }
            });
            });
        }
    });
}
$('#kodesatuan').on('input', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#tabelsatuan').DataTable().ajax.reload();
    });
}, 500));
$("#simpansatuan").click(function() {
    if ($("#kodesatuanisi").val() == "" || $("#namasatuan").val() == ""){
        return Swal.fire({
            icon: 'warning',
            html: 'Silahkan lengkapi informasi KODE SATUAN, NAMA SATUAN',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menambahkan SATUAN : "+$("#namasatuan").val()+" dengan KODE "+$("#kodesatuanisi").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#simpansatuan').prop("disabled",true);
            $('#simpansatuan').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsontambahsatuan',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KODESATUAN : $("#kodesatuanisi").val(),
                    NAMASATUAN : $("#namasatuan").val(),
                    KODEUNIKMEMBER : session_kodeunikmember,
                },
                complete:function(){
                    $('#simpansatuan').prop("disabled",false);
                    $('#simpansatuan').html('Tambah Satuan Baru');
                },
                success: function (response) {
                    getCsrfTokenCallback(function() {
                        $('#tabelsatuan').DataTable().ajax.reload();
                    });
                    if (response.success == "true"){
                        Swal.fire(
                            'Berhasil.. Horee!',
                            response.msg,
                            'success'
                        )
                        $("#kodesatuanisi").val(""),
                        $("#namasatuan").val(""),
                        $('#tambahsatuan').modal('hide');
                    }else{
                        Swal.fire(
                            'Gagal.. Uhhhhh!',
                            response.msg,
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