<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<!-- BEGIN Page Content -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
<link href="<?= base_url() ;?>styles/cssseira/styleprofile.css" rel="stylesheet">
<div class="content">
    <div class="container-fluid">
        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">INFORMASI PEGAWAI 
                    <a href="<?= base_url().'auth/hakakses';?>"><button id="hakakseskontrol" class="btn btn-danger float-right"> <i class="fas fa-cogs"></i> Kelompok Hak Akses</button></a>
                </h3>
            </div>
            <div class="portlet-body">
                <div class="col-md-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet mb-md-0">
                        <div class="portlet-body">
                            <div class="mb-3">
                                <!-- BEGIN Nav -->
                                <div class="nav nav-lines" id="nav1-tab">
                                    <a class="nav-item nav-link tabmenupengguna active" id="nav1-home-tab" data-toggle="tab" href="#nav1-home">Daftar Pegawai / Rekanan</a>
                                    <a class="nav-item nav-link tabmenupengguna" id="nav1-profile-tab" data-toggle="tab" href="#nav1-profile"><div id="keterangantabpengguna">Tambah Pegawai / Rekanan</div></a>
                                </div>
                                <!-- END Nav -->
                            </div>
                            <!-- BEGIN Tab -->
                            <div class="tab-content" id="nav1-tabContent">
                                <div class="tab-pane fade show active" id="nav1-home"> 
                                    <input id="pencarianpenggunaha" type="text" class="mb-2 form-control" placeholder="Filter ? Silahkan ketikan namapengguna, username atau idpengguna"> 
                                    <div id="daftarpegawai"></div>  
                                </div>
                                <div class="tab-pane fade" id="nav1-profile">
                                <!-- BEGIN Form -->
                                    <h5 class="mb-4">INFOR PEGAWAI</h5>
                                    <!-- BEGIN Form Group -->
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">ID / Pengguna Pegawai </label>
                                        <div class="col-sm-10">
                                            <!-- BEGIN Input Group -->
                                            <div class="input-group">
                                                <input readonly id="idpegawai" type="text" class="form-control">
                                                <input id="urlfoto" type="text" class="form-control" placeholder="Masukkan url citra [Rekomendasi 128px x 128px]">
                                            </div>
                                            <!-- END Input Group -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <!-- BEGIN Input Group -->
                                            <div class="input-group">
                                                <input id="namadepan" type="text" class="form-control" placeholder="Nama depan">
                                                <input id="namabelakang" type="text" class="form-control" placeholder="Nama belakang">
                                            </div>
                                            <!-- END Input Group -->
                                        </div>
                                    </div>
                                    <!-- END Form Group -->
                                    <!-- BEGIN Form Group -->
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <!-- BEGIN Input Group -->
                                            <div class="input-group-icon">
                                                <input type="text" class="form-control" id="alamat" placeholder="Isikan alamat real outlet anda">
                                                <div class="input-group-append">
                                                    <i class="fa fa-map-marker-alt"></i>
                                                </div>
                                            </div>
                                            <!-- END Input Group -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rekening" class="col-sm-2 col-form-label">No Telepon Aktif</label>
                                        <div class="col-sm-10">
                                            <!-- BEGIN Input Group -->
                                            <div class="input-group-icon">
                                                <input type="text" class="form-control" id="notelp" placeholder="Ketikan nomor telpn aktif">
                                                <div class="input-group-append">
                                                    <i class="fa fa-phone-square"></i>
                                                </div>
                                            </div>
                                            <!-- END Input Group -->
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rekening" class="col-sm-2 col-form-label">Kodeunikmember</label>
                                        <div class="col-sm-10">
                                            <!-- BEGIN Input Group -->
                                            <div class="input-group-icon">
                                                <input readonly type="text" value="<?= session('kodeunikmember') ;?>" class="form-control" id="kodeunikmember" placeholder="Buatkan kode unik member">
                                                <div class="input-group-append">
                                                    <i class="fa fa-id-card-alt"></i>
                                                </div>
                                            </div>
                                            <!-- END Input Group -->
                                        </div>
                                    </div>
                                    <!-- END Form Group -->
                                    <h5 class="my-4">AKUN PEGAWAI</h5>
                                    <!-- BEGIN Form Group -->
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-2 col-form-label">Nama Pengguna</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="username" placeholder="Buatkan nama pengguna [username] yang kece">
                                        </div>
                                    </div>
                                    <!-- END Form Group -->
                                    <!-- BEGIN Form Group -->
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">Sandi n PIN</label>
                                        <div class="col-sm-10 input-group">
                                            <input type="password" class="form-control" id="password" placeholder="Buatkan password yang unik dan keren">
                                            <input type="pintrx" class="form-control" id="pintrx" placeholder="Buat PIN TRX anda 4 - 12 Digits">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="emailaktif" class="col-sm-2 col-form-label">E-Mail Aktif</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="emailaktif" placeholder="EX: acipay@gmail.com">
                                            <small class="text-muted">Usahakan EMAIL yang anda daftarkan sudah <strong>terverifikasi 2 langkah dan nomor telepon</strong> karena digunakan untuk menerima OTP Login dan mereset password</small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="latlong" class="col-sm-2 col-form-label">Lat Long</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input readonly type="text" class="form-control" id="latlong" placeholder="Contoh : -7.983908 :: 112.621391">
                                                <button id="buttonlatlong" onclick="getLocation()" class="btn btn-outline-danger" type="button">Dapatkan Lat Long</button>
                                            </div>
                                            <small class="text-muted">Gunakan Aplikasi <strong>GPS Coordinates</strong> atau aplikasi lainnya agar akurat. Digunakan untuk pengumpulan informasi client <strong> ACIRABA </strong></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="statuspegawai" class="col-sm-2 col-form-label">Status Pegawai</label>
                                        <div class="col-sm-10">                                          
                                            <select class="form-control" name="statuspegawai" id="statuspegawai">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" rows="3"></textarea>
                                    </div>
                                    <button id="simpanpenggunamerchant" class="mt-2 btn btn-primary">Simpan Informasi</button>
                                    <button id="bersihkan" class="mt-2 btn btn-primary">Bersihkan Formulir</button>
                                <!-- END Form -->
                                </div>
                            </div>
                            <!-- END Tab -->
                        </div>
                    </div>
                    <!-- END Portlet -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ubahpassword">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Informasi Password Pengguna<br>NAMA : <span id="spannamapengguna"></span><br>ID PENGGUNA : [<span id="idpengguna"></span>]</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div style="font-size:1.5em;font-family: 'Irish Grover', cursive;"> Untuk saat ini mengubah katasandi kamu atau pegawai lain tidak membuat pengguna tersebut KELUAR / LOGOUT secara otomatis, katasandi akan berefek jika dia sudah KELUAR / LOGOUT dari sistem.</div>
                <div class="form-group mt-3">
                    <div class="input-group mb-3">
                        <input id="sandikamu" type="password" placeholder="" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <span style="cursor:pointer" class="input-group-text" id="sandikamu"><i class="fas fa-eye toggle-passworda"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input id="sandipegawai" type="password" placeholder="" class="form-control form-control-lg">
                        <div class="input-group-append">
                            <span style="cursor:pointer" class="input-group-text" id="sandipegawai"><i class="fas fa-eye toggle-passwordb"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
				<button onclick="ubahpasswordproses()" id="prosessimpaninformasi" class="btn btn-outline-primary">Simpan Informasi</button>
			</div>
        </div>
    </div>
</div>
<!-- END Page Content -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>scripts/masterdata/pengguna.js"></script>
<script src="<?= base_url();?>scripts/profilejs.js"></script>
<script>
let colorCSS;
$(document).ready(function () {
    getCsrfTokenCallback(function() {loaddaftarpewagawai()}); 
    getCsrfTokenCallback(function() {loadidmember();}); 
    $('#statuspegawai').select2({
        allowClear: true,
        placeholder: 'Tentukan Hak Akses Untuk Pengguna Ini',
        ajax: {
            url: baseurljavascript + 'auth/pilihstatuspegawai',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function(params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KATAKUNCI: (typeof params.term === "undefined" ? "" : params.term),
                };
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.kodeai + "] HAK AKSES : " + item.namahakases,
                            id: item.kodeai,
                        }
                    })
                }
            },
            error: function(xhr, status, error) {
                getCsrfTokenCallback(function() {});
                toastr["error"](xhr.responseJSON.message);
            }
        },
    });
});
$(document).on('click', '.toggle-passworda', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#sandikamu");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).on('click', '.toggle-passwordb', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#sandipegawai");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
</script>
<?= $this->endSection(); ?>