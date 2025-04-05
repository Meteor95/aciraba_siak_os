<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
.centered-content {
    vertical-align: middle;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
<div class="col-12">
    <div class="portlet">
        <div class="portlet-header">
            <div class="portlet-icon">
                <i class="fa fa-funnel-dollar"></i>
            </div>
            <h3 class="portlet-title">Pencatatan Transaksi Local</h3>
        </div>
        <!-- BEGIN Carousel -->
        <!-- END Carousel -->
        <div class="portlet-body">
            <div style="background-image: url('/images/login/logonya.png');background-size: contain;background-repeat: no-repeat;background-position: center;" class="widget1-display widget1-display-top widget1-display-sm justify-content-between text-white">
                <div class="widget1-group">
                    <div class="widget1-addon">
                        <button class="btn btn-label-light">2024</button>
                    </div>
                </div>
                <div class="widget1-group">
                    <h3 class="widget1-title" style="color:black">Pencatatan Transaksi Pada Kasir</h3>
                </div>
            </div>
            <div class="widget1-body">
                <!-- BEGIN Rich List -->
                <div class="rich-list-item p-0 mb-3">
                    <div class="rich-list-prepend">
                        <!-- BEGIN Avatar -->
                        <div class="avatar">
                            <div class="avatar-display">
                                <img src="https://erayadigital.co.id/wp-content/uploads/2024/03/cropped-Logo-512-Eraya-Digital.png" alt="Logo Duitku">
                            </div>
                        </div>
                        <!-- END Avatar -->
                    </div>
                    <div class="rich-list-content">
                        <h4 class="rich-list-title">2021 - <?= date("Y");?> Eraya Digital Solusindo. All rights reserved.</h4>
                        <span class="rich-list-subtitle">Gedung Graha Krama Yudha Lt. 4 Unit B Jl. Hj. Tutty Alawiyah No. 43, Duren Tiga, Pancoran, Kota Jakarta Selatan DKI JAKARTA 12760 </span>
                    </div>
                    <div class="rich-list-append rich-list-append d-flex flex-column">
                        <h3 class="fw-bolder mb-0">0</h3>
                        <small class="text-muted">Kategori PG</small>
                    </div>
                </div>
                <!-- END Rich List -->
                <p class="text-level-1 text-justify">"Membawa UMKM ke Pasar Global dengan Teknologi dan Tools Retail Terbaik" mencerminkan komitmen kami untuk mendukung UMKM dalam mengembangkan bisnis mereka secara global melalui solusi teknologi retail yang inovatif. Kami memadukan teknologi canggih dengan strategi pemasaran yang efektif untuk membantu UMKM dan NON UMKM memperluas jangkauan mereka dan mencapai kesuksesan di pasar global. Dengan pendekatan ini, kami bertekad untuk menjadi mitra terpercaya bagi UMKM dan NON UMKAM dalam perjalanan mereka menuju pertumbuhan dan keberhasilan yang berkelanjutan.</p>
            </div>
        </div>
    </div>
</div>           
        </div>
        <div class="row">
<div class="col-12">
    <div class="portlet">
        <div class="portlet-header">
            <div class="portlet-icon">
                <i class="fa fa-book"></i>
            </div>
            <h3 class="portlet-title">Daftar Metode Pembayaran Pencatatan Lokal</h3>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-10 mb-3">
                    <label for="katakuncipencarian">Nama / Kode Pencatatan Transaksi</label>
                    <input type="text" class="form-control" id="katakuncipencarian" placeholder="Masukan untuk melakukan penyaringan data tersedia">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="katakuncipencarian">Aksi</label>
                    <button id="tambahinformasi" class="btn btn-success btn-block"> Tambah Informasi </button>
                </div>
            </div>
            <table id="tabeldaftarbankpencatatanlokal" class="table table-bordered table-striped table-hover nowrap">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Logo Pencatatan</th>
                        <th>Nama Pencatatan</th>
                        <th>Pajak Debit</th>
                        <th>Pajak Kredit</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Aksi</th>
                        <th>Logo Pencatatan</th>
                        <th>Informasi Pencatatan</th>
                        <th>Pajak Debit</th>
                        <th>Pajak Kredit</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>            
        </div>
    </div>
</div>
<div class="modal fade" id="ubahinformasimetodepembayaran">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h5 id="titlemodal" class="modal-title">Simpan Informasi Metode Pembayaran</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="kodebank" class="col-sm-3 col-form-label">Kode Bank</label>
                    <div class="col-sm-9"><input id="kodebank" type="text" class="form-control" placeholder="ACIBANK"></div>
                </div>
                <div class="form-group row">
                    <label for="namabank" class="col-sm-3 col-form-label">Nama Bank</label>
                    <div class="col-sm-9"><input id="namabank" type="text" class="form-control" placeholder="Aciraba Bank"></div>
                </div>
                <div class="form-group row">
                    <label for="pajakdebit" class="col-sm-3 col-form-label">Pajak Debit</label>
                    <div class="col-sm-9"><input id="pajakdebit" type="text" class="form-control" placeholder="Jika < 99 & > 0 Maka Status Presentase"></div>
                </div>
                <div class="form-group row">
                    <label for="pajakkredit" class="col-sm-3 col-form-label">Pajak Kredit</label>
                    <div class="col-sm-9"><input id="pajakkredit" type="text" class="form-control" placeholder="Jika < 99 & > 0 Maka Status Presentase"></div>
                </div>
                <div class="form-group row">
                    <label for="urllogo" class="col-sm-3 col-form-label">Url Logo</label>
                    <div class="col-sm-9">
                    <img id="logometodepembayaran" src="/images/login/logonya.png" style="width:250px" class="mb-1">
                    </div>
                </div>
                <div class="form-group row">
                    <input id="urllogo" type="text" class="form-control" placeholder="https://cdn.aciraba.id/contohgambar.webp">
                </div>
                <div class="form-group row">
                    <label for="jenisbank" class="col-sm-3 col-form-label">Jenis Bank</label>
                    <div class="col-sm-9">
                        <select id="jenisbank" class="form-control">
                            <option value="B">Bank Transfer</option>
                            <option value="E">E-Money</option>
                        </select>
                    </div>
                </div>
                <input id="jenismethod" type="hidden" class="form-control" placeholder="" text="0">
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="buttonpengaturan" class="btn btn-primary mr-2">Simpan Informasi</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    getCsrfTokenCallback(function() {
        $("#tabeldaftarbankpencatatanlokal").DataTable({
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
                "url": baseurljavascript + 'masterdata/jasondaftarbankpencatatanlokal',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.NAMA_PENCATATAN = $('#katakuncipencarian').val();
                    d.DATAKE = 0;
                    d.LIMIT = 500;
                },
            }
        });
    });
});
$("#katakuncipencarian").on('input focus keypress keydown', debounce(function(e) {
    getCsrfTokenCallback(function() {
        $('#tabeldaftarbankpencatatanlokal').DataTable().ajax.reload();
    });
}, 500))
$("#tambahinformasi").on("click", function() {
    $('#ubahinformasimetodepembayaran').modal('show');
});
$("#buttonpengaturan").on("click", function() {
    Swal.fire({
        title: $('#jenismethod').val() == 1 ? "Ubah Informasi "+$('#namabank').val()+" ["+ $('#kodebank').val()+"]" : "Simpan Informasi "+$('#namabank').val()+" ["+ $('#kodebank').val()+"]",
        text: $('#jenismethod').val() == 1 ? "Apakah anda yakin ingin mengubah informasi "+$('#namabank').val()+". Perubahan informasi akan berdampak pada transaksi berikutnya setelah sistem sukses menyimpan pengaturan tanpa merubah informasi data yang lama" : "Apakah anda ingin menambahkan metode pembayaran baru ini agar bisa dicatat pada transaksi pengeluaran ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Simpan Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#buttonpengaturan').prop("disabled",true);
            $('#buttonpengaturan').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/simpaninformasimetodepembayaran',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KODE_BANK: $('#kodebank').val(),
                    NAMA_BANK: $('#namabank').val(),
                    PAJAKDEBIT:  $('#pajakdebit').val(),
                    PAJAKKREDIT: $('#pajakkredit').val(),
                    URLLOGO: $('#urllogo').val(),
                    JENISMETHOD: $('#jenisbank').val(),
                    JENISISMPAN: $('#jenismethod').val(),
                },
                complete:function(){
                    $('#buttonpengaturan').prop("disabled",false);
                    $('#buttonpengaturan').html('<i class="fa fa-trash"></i> Simpan Informasi');
                },
                success: function (response) {
                    if (response.success == true){
                        getCsrfTokenCallback(function() {
                            $('#tabeldaftarbankpencatatanlokal').DataTable().ajax.reload();
                        });
                        Swal.fire(
                            'Berhasil.. Horee!',
                            "Informasi Metode Pembayaran: "+$('#namabank').val()+" berhasil disimpan. Anda dapat menggunakan metode pembayaran ini untuk tranaksi",
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
});
function ubahinformasi(kodebank,namabank,pajakdebit,pajakkredit,urllogo,jenispembayaran){
    $('#titlemodal').html("Ubah Informasi Metode Pembayaran");
    $('#buttonpengaturan').html("Ubah Informasi");
    $('#kodebank').val(kodebank);
    $('#kodebank').attr('readonly', true)
    $('#namabank').val(namabank);
    $('#pajakdebit').val(pajakdebit);
    $('#pajakkredit').val(pajakkredit);
    $('#urllogo').val(urllogo);
    $('#jenismethod').val(1)
    $("#logometodepembayaran").attr("src",urllogo);
    $("#jenisbank").val(jenispembayaran).change();
    $('#ubahinformasimetodepembayaran').modal('show');
}
function hapusbankpencatatan(metodepembayaranid,namametodepembayaran){
    Swal.fire({
        title: "Hapus Metode Pembayaran Terpilih",
        text: "Anda akan menghapus  Metode Pembayaran : " + namametodepembayaran + " [" + metodepembayaranid + "] pada aplikasi. Jika terhapus maka informasi mengenai  Metode Pembayaran ini tidak muncul pada laporan, tetapi data atas Metode Pembayaran ini tidak hilang",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#hapusbankpencatatan'+metodepembayaranid).prop("disabled",true);
            $('#hapusbankpencatatan'+metodepembayaranid).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsonhapusmetodepembayaran',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]: csrfTokenGlobal,
                    KODE_PENCATATAN: metodepembayaranid,
                },
                complete:function(){
                    $('#hapusprincipal'+metodepembayaranid).prop("disabled",false);
                    $('#hapusprincipal'+metodepembayaranid).html('<i class="fa fa-trash"></i> Hapus');
                },
                success: function (response) {
                    if (response.success == true){
                        getCsrfTokenCallback(function() {
                            $('#tabeldaftarbankpencatatanlokal').DataTable().ajax.reload();
                        });
                        Swal.fire(
                            'Berhasil.. Horee!',
                            "Informasi Metode Pembayaran: "+namametodepembayaran+" berhasil dihapus. Informasi mengenai brand ini tidak ditampilkan lagi pada sistem",
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
</script>
<?= $this->endSection(); ?>