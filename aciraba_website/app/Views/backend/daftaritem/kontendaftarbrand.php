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
                            <button id="" data-toggle="modal" data-target="#tambahbrand" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah Informasi Brand</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="daftaritem_katakunci">Kata Kunci</label>
                                <input name="txtnamabrand" type="text" class="form-control" id="txtnamabrand"
                                    placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-8 mt-4 col-sm-12">
                                <p align="justify">Merek atau jenama adalah tanda yang dikenakan oleh pengusaha pada barang yang dihasilkan sebagai tanda pengenal. Berikut adalah daftar bran yang terdaftar pada aplikasi anda. Anda dapat menganalisa mengenai dampak brand terhadap toko anda di MENU LAPORAN. Brand dalam pengisian informasi barang wajib diisi</p>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <!-- BEGIN Datatable -->
                        <table id="masteritem_daftarbrand" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th align="center">Aksi</th>
                                    <th>Kode Brand Item</th>
                                    <th>Nama Item</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th align="center">Aksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
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
<div class="modal fade" id="tambahbrand">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h5 class="modal-title">Tambah Brand</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Brand Baru</label>
                    <div class="col-sm-9">
                        <!-- BEGIN Input Group -->
                        <div class="input-group">
                            <input id="tambahkodebrand" type="text" class="form-control" placeholder="Kode Brand [ACR]">
                            <input id="tambahnamabrand" type="text" class="form-control" placeholder="Nama Brand [Aciraba]">
                        </div>
                        <!-- END Input Group -->
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="simpanbrand" class="btn btn-primary mr-2">Tambah Brand Baru</button>
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
        $("#masteritem_daftarbrand").DataTable({
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
                "url": baseurljavascript + 'masterdata/jasondaftarbrand',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.NAMABRAND = $('#txtnamabrand').val();
                    d.DATAKE = 0;
                    d.LIMIT = 500;
                },
            }
        });
    });
});
$('#txtnamabrand').on('input', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#masteritem_daftarbrand').DataTable().ajax.reload();
    });
}, 500));
function hapusbrand(brandid,namabrand){
    Swal.fire({
        title: "Hapus Brand Terpilih",
        text: "Anda akan menghapus Brand : " + namabrand + " [" + brandid + "] pada aplikasi. Jika terhapus maka informasi mengenai BRAND ini tidak muncul pada laporan, tetapi data atas brand ini tidak hilang",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#hapusid'+brandid).prop("disabled",true);
            $('#hapusid'+brandid).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsonhapusbrand',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    BRAND_ID: brandid,
                },
                complete:function(){
                    $('#hapusid'+brandid).prop("disabled",true);
                    $('#hapusid'+brandid).html('<i class="fa fa-trash"></i> Hapus');
                },
                success: function (response) {
                    if (response.success == "true") {
                        getCsrfTokenCallback(function() {
                            $('#masteritem_daftarbrand').DataTable().ajax.reload();
                        });
                        Swal.fire(
                            'Berhasil.. Horee!',
                            "Informasi BRAND: "+namabrand+" berhasil dihapus. Informasi mengenai brand ini tidak ditampilkan lagi pada sistem",
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
$("#simpanbrand").click(function() {
    if ($("#tambahkodebrand").val() == "" || $("#tambahnamabrand").val() == ""){
        return Swal.fire({
            icon: 'warning',
            html: 'Silahkan lengkapi informasi KODE BRAND, NAMA NAMA BRAND',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menambahkan BRAND : "+$("#tambahnamabrand").val()+" dengan KODE "+$("#tambahkodebrand").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#simpanbrand').prop("disabled",true);
            $('#simpanbrand').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsontambahbrand',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    BRAND_ID: $("#tambahkodebrand").val(),
                    NAMA_BRAND: $("#tambahnamabrand").val(),
                },
                complete:function(){
                    $('#simpanbrand').prop("disabled",false);
                    $('#simpanbrand').html('Tambah Brand Baru');
                },
                success: function (response) {
                    getCsrfTokenCallback(function() {
                        $('#masteritem_daftarbrand').DataTable().ajax.reload();
                    });
                    if (response.success == "true"){
                        Swal.fire(
                            'Berhasil.. Horee!',
                            "Informasi dari BRAND: "+$("#tambahnamabrand").val()+" berhasil ditambahkan pada sistem. Silahkan gunakan brand ini agar ditambahkan pada informasi barang anda",
                            'success'
                        )
                        $("#tambahkodebrand").val(''),
                        $("#tambahnamabrand").val(''),
                        $('#tambahbrand').modal('hide');
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