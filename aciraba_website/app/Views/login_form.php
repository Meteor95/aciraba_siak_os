<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Selamat Datang Di Dashboard | Aciraba Website</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
	<link href="https://erayadigital.co.id/wp-content/uploads/2024/03/cropped-Logo-512-Eraya-Digital.png" rel="shortcut icon" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap"> 
    <link href="/styles/fontawesome-free-6.4.0/css/all.min.css" rel="stylesheet">
	<link href="/styles/ltr-core.css" rel="stylesheet">
	<link href="/styles/ltr-vendor.css" rel="stylesheet">
	<link href="/styles/ltr-dashboard1.css" rel="stylesheet">
    <link href="/styles/intltelinput/intlTelInput.css" rel="stylesheet">
</head>

<body class="theme-light preload-active" id="fullscreen" style="background-image: url(images/login/login_frame.png);background-size:100% 100%;">
	<!-- BEGIN Preload -->
	<div class="preload">
		<div class="preload-dialog">
			<!-- BEGIN Spinner -->
			<div class="spinner-border text-primary preload-spinner"></div>
			<!-- END Spinner -->
		</div>
	</div>
	<!-- END Preload -->
	<!-- BEGIN Page Holder -->
	<div class="holder">
		<!-- BEGIN Page Wrapper -->
		<div class="wrapper">
			<!-- BEGIN Page Content -->
			<div class="content ">
				<div class="container-fluid">
					<div class="row no-gutters align-items-center justify-content-center h-100">
						<div class="col-lg-8 col-xl-6">
							<!-- BEGIN Portlet -->
							<div class="portlet overflow-hidden">
								<div class="row no-gutters">
									<div class="col-md-6">
										<div class="portlet-body d-flex flex-column justify-content-center align-items-start h-100 bg-primary text-white">
											<h2>Yuk Kelola Bisnis Anda!</h2>
											<p>Dengan Akun Aciraba, Anda tidak hanya mendapatkan listingan bisnis. Profil Bisnis Anda yang super kece ini memungkinkan Anda secara mudah menjangkau pelanggan di seluruh dunia.</p><hr>
											<a data-toggle="modal" data-target="#pengaturanlocalnya" id="pengaturanlocal" style="cursor:pointer;" href="javascript:void(0)" class="btn btn-outline-light btn-lg btn-widest btn-pill">Pengaturan</a>
										</div>
									</div>
									<div class="col-md-6">
										<div class="portlet-body h-100">
                                            <img class="img-fluid mb-2" src="images/login/logonya.png" alt="">
											<!-- BEGIN Form Group -->
                                            <div class="form-group">
                                                <div class="float-label float-label-lg">
                                                    <div class="input-group mb-3">
                                                    <input id="login_username" type="text" placeholder="contoh username : adminstrator_aciraba" class="form-control form-control-lg">
                                                    <div class="input-group-append">
                                                        <span style="cursor:pointer" class="input-group-text" id="basic-addon2"><i class="fas fa-user"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Form Group -->
                                            <!-- BEGIN Form Group -->
                                            <div class="form-group">
                                                <div class="float-label float-label-lg">
                                                    <div class="input-group mb-3">
                                                    <input id="login_password" type="password" placeholder="Masukkan katasandi : *********" class="form-control form-control-lg">
                                                    <div class="input-group-append">
                                                        <span style="cursor:pointer" class="input-group-text" id="basic-addon2"><i class="fas fa-eye toggle-password"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END Form Group -->
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <!-- BEGIN Form Group -->
                                                <div class="form-group mb-0">
                                                    <div class="custom-control custom-control-lg custom-switch">
                                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                                        <label class="custom-control-label" for="remember">Remember Me</label>
                                                    </div>
                                                </div>
                                                <!-- END Form Group -->
                                                <a href="javascript:void(0)" id="toastforgotpassword">Forgot password ?</a>
                                            </div>
                                            <button id="login_prosesmasuk" type="submit" class="btn btn-primary btn-lg btn-block btn-pill">Masuk</button>
                                            <button id="pendaftaranowner" data-toggle="modal" data-target="#pendaftaranownernya" class="btn btn-success btn-lg btn-block btn-pill">Daftarkan Outlet Anda</button>
										</div>
									</div>
								</div>
							</div>
							<!-- END Portlet -->
						</div>
					</div>
				</div>
			</div>
			<!-- END Page Content -->
		</div>
		<!-- END Page Wrapper -->
	</div>
	<!-- END Page Holder -->
	<!-- BEGIN Float Button -->
	<div class="float-btn float-btn-right">
		<button class="btn btn-flat-primary btn-icon mb-2" id="theme-toggle" data-toggle="tooltip" data-placement="right" title="Ubah Tema">
			<i class="fa fa-moon"></i>
		</button>
	</div>
	<!-- END Float Button -->
<div class="modal fade" id="pengaturanlocalnya">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h5 class="modal-title">Pengaturan Lokal</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-4 col-form-label">Kode Kasa</label>
                    <div class="col-sm-8">
                        <!-- BEGIN Input Group -->
                        <div class="form-group">
                            <div class="input-group">
                                <input id="kodekasa" type="text" class="form-control" placeholder="Masukkan 4 Digit Kode [ADM1]">
                                <div class="input-group-append">
                                    <span style="cursor: pointer;" id="generateiditem" class="input-group-text btn-warning btn">GENERATE ID</span>
                                </div>
                            </div>
                        </div>
                        <!-- END Input Group -->
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label">Kode Socket Printer</label>
                    <div class="col-sm-8">
                        <input id="kodesocketprinter" type="text" class="form-control" placeholder="Kode cek di file .env">
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 col-form-label">Port Socket Printer</label>
                    <div class="col-sm-8">
                        <input id="portsocketprinter" type="text" class="form-control" placeholder="Kode cek di file .env. Default 2222">
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="simpanpengaturan" class="btn btn-primary mr-2">Simpan Pengaturan Lokal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pendaftaranownernya" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-bordered">
                <h3 class="modal-title" style="font-family: 'Irish Grover', cursive;">DAFTARKAN OUTLET ANDA</h3>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <img class="mb-2" src="<?= base_url().'images/login/welcome_register.png';?>" style="display: block;margin-left: auto;margin-right: auto;width: 100%;">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tentukan Nama OUTLET / Usaha</label>
                    <div class="col-sm-8">
                        <input id="namaoutlet" type="text" class="form-control" placeholder="Ex : PT. Eraya Digital Solusindo">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Pemilik</label>
                    <div class="col-sm-8">
                        <input id="namapemilik" type="text" class="form-control" placeholder="Ex : Mr. Seira Sebagai OWNER">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Pengguna</label>
                    <div class="col-sm-8">
                        <input id="username_daftar" type="text" class="form-control" placeholder="Ex : seira_setyawan">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Katasandi</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                        <input id="password_daftar" type="password" class="form-control" placeholder="Ex : inipasswordsangatkuat@@#">
                        <div class="input-group-append">
                            <span style="cursor:pointer" class="input-group-text" id="basic-addon2"><i class="fas fa-eye toggle-password-register"></i></span>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">E-Mail</label>
                    <div class="col-sm-8">
                        <input id="email_daftar" type="email" class="form-control" placeholder="Email untuk atas nama pengirim tagihan online">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">WhatsApp</label>
                    <div class="col-sm-8">
                        <input id="wa_daftar" oninput="hanyaAngka(this)" onkeypress="hanyaAngka(this)" type="text" class="form-control" placeholder="8225780****. Pastikan nomor AKTIF untuk proses OTP">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Request Tenant ID Outlet</label>
                    <div class="col-sm-8">
                        <!-- BEGIN Input Group -->
                        <div class="form-group">
                            <div class="input-group">
                            <input id="kodetenant" type="text" class="form-control" placeholder="Buat TENANT ID anda atau ➡️➡️➡️➡️➡️➡️➡️➡️➡️">
                                <div class="input-group-append">
                                <span style="cursor: pointer;" id="generatekodetenant" class="input-group-text btn-warning btn">GENERATE TENANT</span>
                                </div>
                            </div>
                        </div>
                        <!-- END Input Group -->
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
                <button id="daftarkanoutlet" class="btn btn-primary mr-2">Oke, Aku Join Nih</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/scripts/mandatory.js"></script>
<script type="text/javascript" src="/scripts/dashboard1.js"></script>
<script type="text/javascript" src="/scripts/core.js"></script>
<script type="text/javascript" src="/scripts/vendor.js"></script>
<script type="text/javascript" src="/scripts/login/script.js"></script>
<script type="text/javascript" src="/scripts/globalfn.js"></script>
<script type="text/javascript" src="/scripts/intltelinput/intlTelInput.min.js"></script>
<script type="text/javascript" src="/scripts/intltelinput/utils.js"></script>
<script>
var baseurljavascript = "<?=DYBASESEURL;?>";
var csrfName = '<?= csrf_token() ?>'; 
let inputnohp = document.querySelector("#wa_daftar"), iti = ""
$(document).ready(async function() {
if (localStorage.getItem("KODEKASA") == "" || localStorage.getItem("KODEKASA") == null){
    $('#kodekasa').val(randomstringdigit(4).toUpperCase());
}else{
    $("#kodekasa").val(localStorage.getItem("KODEKASA"));
}
$("#kodesocketprinter").val(localStorage.getItem("KODESOCKETPRINTER"));
$("#portsocketprinter").val(localStorage.getItem("PORTSOCKETPRINTER"));
iti = window.intlTelInput(inputnohp, {
    allowDropdown: false,
    fixDropdownWidth: false,
    initialCountry: "id",
    onlyCountries: ['id', 'us', 'jp', 'sg'],
    separateDialCode: true,
    utilsScript: "/scripts/intltelinput/utils.js",
});
});
$(document).on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#login_password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).on('click', '.toggle-password-register', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password_daftar");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$("#generatekodetenant").on("click", function () {
    $('#kodetenant').val(randomstringdigit(10).toUpperCase());
});
$("#generateiditem").on("click", function () {
    $('#kodekasa').val(randomstringdigit(4).toUpperCase());
});
$("#toastforgotpassword").on("click", function () {
    return toastr["info"]("Lupa informasi masuk ke sistem. Silahkan hubungi ADMINISTRATOR / TIM IT anda untuk melakukan reset informasi masuk ke sistem");
});
</script>
</body>
</html>