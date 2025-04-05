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
                            <button id="" data-toggle="modal" data-target="#tambahprincipal" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah Informasi Principal</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="daftaritem_katakunci">Kata Kunci</label>
                                <input name="txtnamaprincipal" type="text" class="form-control" id="txtnamaprincipal"
                                    placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-8 mt-3 col-sm-12">
                                <p align="justify">Principal atau produsen merupakan hal yang kurang diketahui oleh masyarakat pada umumnya, kecuali mereka yang telah berkecimpung di dalam dunia bisnis distribusi. Principal merupakan pemilik brand yang memproduksi barang untuk didistibusikan/dijual oleh distributor. Principal juga mengembangkan strategi pemasaran untuk membantu penjualan para distributornya.</p>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <!-- BEGIN Datatable -->
                        <table id="masteritem_daftarprincipal" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th align="center">Aksi</th>
                                    <th>Kode Principal</th>
                                    <th>Nama Principal</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th align="center">Aksi</th>
                                    <th>Kode Principal</th>
                                    <th>Nama Principal</th>
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
<div class="modal fade" id="tambahprincipal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h5 class="modal-title">Tambah Principal</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Principal Baru</label>
                    <div class="col-sm-9">
                        <!-- BEGIN Input Group -->
                        <div class="input-group">
                            <input id="tambahkodeprincipal" type="text" class="form-control" placeholder="Kode Principal [ACR]">
                            <input id="tambahnamaprincipal" type="text" class="form-control" placeholder="Nama Principal [Aciraba]">
                        </div>
                        <!-- END Input Group -->
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="simpanprincipal" class="btn btn-primary mr-2">Tambah Principal Baru</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>scripts/masterdata/masteritem.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    getCsrfTokenCallback(function() {
        $("#masteritem_daftarprincipal").DataTable({
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
                "url": baseurljavascript + 'masterdata/jasondaftarprincipal',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.NAMA_PRINCIPAL = $('#txtnamaprincipal').val();
                    d.DATAKE = 0;
                    d.LIMIT = 500;
                },
            }
        });
    });
});
$('#txtnamaprincipal').on('input', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#masteritem_daftarprincipal').DataTable().ajax.reload();
    });
}, 500));
function hapusprincipal(principaldid,namaprincipal){
    Swal.fire({
        title: "Hapus Principal Terpilih",
        text: "Anda akan menghapus Principal : " + namaprincipal + " [" + principaldid + "] pada aplikasi. Jika terhapus maka informasi mengenai PRINCIPAL ini tidak muncul pada laporan, tetapi data atas PRINCIPAL ini tidak hilang",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#hapusprincipal'+principaldid).prop("disabled",true);
            $('#hapusprincipal'+principaldid).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsonhapusprincipal',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    PRINCIPAL_ID: principaldid,
                },
                complete:function(){
                    $('#hapusprincipal'+principaldid).prop("disabled",false);
                    $('#hapusprincipal'+principaldid).html('<i class="fa fa-trash"></i> Hapus');
                },
                success: function (response) {
                    if (response.success == "true"){
                        getCsrfTokenCallback(function() {
                            $('#masteritem_daftarprincipal').DataTable().ajax.reload();
                        });
                        Swal.fire(
                            'Berhasil.. Horee!',
                            "Informasi PRINCIPAL: "+namaprincipal+" berhasil dihapus. Informasi mengenai brand ini tidak ditampilkan lagi pada sistem",
                            'success'
                        )
                    } else {
                        Swal.fire(
                            'Gagal.. Uhhhhh!',
                            response.msg,
                            'warning'
                        )
                    }
                },
                error: function(xhr, status, error) {
                    toastr["error"](xhr.responseJSON.message);
                }
            });
            });
        }
    });
}
$("#simpanprincipal").click(function() {
    if ($("#tambahkodeprincipal").val() == "" || $("#tambahnamaprincipal").val() == ""){
        return Swal.fire({
            icon: 'warning',
            html: 'Silahkan lengkapi informasi KODE PRINCIPAL, NAMA PRINCIPAL',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menambahkan PRINCIPAL PRODUK: "+$("#tambahnamaprincipal").val()+" dengan KODE "+$("#tambahkodeprincipal").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#simpanprincipal').prop("disabled",true);
            $('#simpanprincipal').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsontambahprincipal',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    PRINCIPAL_ID: $("#tambahkodeprincipal").val(),
                    NAMA_PRINCIPAL: $("#tambahnamaprincipal").val(),
                },
                complete:function(){
                    $('#simpanprincipal').prop("disabled",false);
                    $('#simpanprincipal').html('Tambah Principal Baru');
                },
                success: function (response) {
                    getCsrfTokenCallback(function() {
                        $('#masteritem_daftarprincipal').DataTable().ajax.reload();
                    });
                    if (response.success == "true"){
                        Swal.fire(
                            'Berhasil.. Horee!',
                            "Informasi dari PRINCIPAL PRODUK: "+$("#tambahnamaprincipal").val()+" berhasil ditambahkan pada sistem. Silahkan gunakan principal ini agar ditambahkan pada informasi barang anda",
                            'success'
                        )
                        $("#tambahkodeprincipal").val(''),
                        $("#tambahnamaprincipal").val(''),
                        $('#tambahprincipal').modal('hide');
                    }else{
                        Swal.fire(
                            'Gagal.. Uhhhhh!',
                            response.msg,
                            'warning'
                        )
                    }
                },
                error: function(xhr, status, error) {
                    toastr["error"](xhr.responseJSON.message);
                }
            });
            });
        }
    });
});
</script>
<?= $this->endSection(); ?>