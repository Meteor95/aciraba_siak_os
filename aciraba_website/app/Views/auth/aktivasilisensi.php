<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Formulir Aktivasi</title>


  <!-- Favicons -->
  <link href="<?= base_url() ;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="<?= base_url() ;?>images/favicon.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url() ;?>app/landing_aktivasi/assets/css/style.css" rel="stylesheet">
  <link href="<?= base_url() ;?>styles/ltr-vendor.css" rel="stylesheet">
  <script>
  var csrfName = '<?= csrf_token() ?>'; 
  </script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Formulir Aktivasi</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#why-us">Syarat dan Ketentuan</a></li>
          <li><a class="nav-link scrollto" href="#faq">Kebijakan Privasi</a></li>
          <li><a class="getstarted" href="<?= base_url().'auth';?>">Halaman Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Solusi Lebih Baik Untuk Bisnis Anda</h1>
          <h2>Aciraba adalah aplikasi berbakat yang dapat meringankan, membantu dalam penyelesaian masalah retail anda</h2>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="<?= base_url() ;?>app/landing_aktivasi/assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container-fluid" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

            <div class="content">
              <h3><strong>Syarat dan Ketentuan Aplikasi ACIRABA</strong></h3>
              <p>Dengan menggunakan Aplikasi ACIRABA Anda telah membaca, menyetujui serta tunduk dengan syarat dan ketentuan penggunaan di bawah ini. Ketentuan ini sewaktu-waktu dapat berubah tanpa pemberitahuan terlebih dahulu.</p>
            </div>

            <div class="accordion-list">
              <ul>
                <li>
                  <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Umum <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                    <p>
                        1. Script hanya digunakan untuk 1 nama brand outlet dengan 1 pemilik utama.<br>
                        2. Tidak dapat merubah domain apabila lisensi sudah terinstall.<br>
                        3. Pada outlet harus memiliki setidaknya 1Mbps internet untuk melakukan login sistem.<br>
                    </p>
                  </div>
                </li>
                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Konten <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                        1. Isi konten atau layanan yang diberikan di website Anda adalah tanggung jawab Anda.<br>
                        2. Kami tidak bertanggung jawab atas konten dagang tersebut.<br>
                        3. Kami berhak melihat isi produk konten anda sebagai landasan kami guna mengembangkan fitur ACIRABA.<br>
                        4. Kami berhak mematikan produk anda jika menurut kami produk anda melanggar landasar hukum di INDONESIA.<br>
                        5. Kami berhak mengklaim fitur terbaru tesebut jika terdapat fitur yang belum anda pada fitur dasar ACIRABA dan berhak menawarkan kepada organisasi / toko lain secara SAH dan LEGAL.<br>
                    </p>
                  </div>
                </li>
                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Larangan <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                        1. Tidak boleh mendekode file-file yang dienkode.<br>
                        2. Tidak boleh memperjual belikan atau membagikan script ke orang lain tanpa seiijin TIM Kami.<br>
                        3. Tidak boleh menghapus komentar di semua file php.<br>
                        4. Tidak boleh mempublikasikan ulang materi dari ACIRABA<br>
                    </p>
                  </div>
                </li>
                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-4" class="collapsed"><span>04</span> Garansi <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-4" class="collapse" data-bs-parent=".accordion-list">
                    <p>
                        1. Aciraba tidak memberikan garansi ketika pada saat installasi script tidak cocok atau tidak bisa dijalankan di server Anda. Oleh karena itu berdiskusilah dengan kami<br>
                        2. Aciraba akan memberikan garansi ketika fungsi / kode php sudah deprecated atau sudah usang, garansi tersebut diberikan melalui pembaruan / update.<br>
                        3. Garansi kepada organisasi / toko / Enterprise Client berbeda dan wajib di diskusikan .<br>
                    </p>
                  </div>
                </li>
                <li>
                  <a data-bs-toggle="collapse" data-bs-target="#accordion-list-5" class="collapsed"><span>05</span> Pembaruan <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="accordion-list-5" class="collapse" data-bs-parent=".accordion-list">
                    <p>Pembaruan / update script diberikan secara gratis apabila memenuhi kriteria di bawah ini.</p>
                    <p>
                        1. Keanggotaan masih aktif terekam pada database kami.<br>
                        2. Tidak melanggar 1 aturan pun pada konteks TAB 02 LARANGAN.<br>
                        3. Website And masih menggunakan Script dari kamu secara original. Jika tidak original tetapi tidak melanggar aturan TAB 02 LARANGAN maka tidak ada jaminan kompatible dengan algoritma anda<br>
                        4. Transaksi di website Anda masih aktif dan berjalan normal.
                    </p>
                    <p>Pembaruan / update script  tidak akan memberikan pembaruan gratis apabila: </p>
                    <p>
                        1. Melanggar salah satu ketentuan larangan pada TAB 02 Larangan.<br>
                        2. Anda telah melakukan penipuan atau hal lainnya yang merugian orang lain.<br>
                    </p>
                  </div>
                </li>

              </ul>
            </div>

          </div>

          <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("<?= base_url() ;?>app/landing_aktivasi/assets/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
        </div>

      </div>
    </section><!-- End Why Us Section -->


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Kebijakan Privasi Aciraba</h2>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Masih Dalam Koordinasi <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>Masih di diskusikan</p>
              </div>
            </li>

            <!--<li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="500">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
                </p>
              </div>
            </li>-->

          </ul>
          <button id="konfirmasiaktivasi" class="btn btn-block btn-success mb-2" style="width:100%"> Sudah Baca Semua ? Aktivasi Sekarang </button>
        </div>
      </div>
    </section><!-- End Frequently Asked Questions Section -->

  </main><!-- End #main -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/aos/aos.js"></script>
<script src="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url() ;?>app/landing_aktivasi/assets/vendor/swiper/swiper-bundle.min.js"></script>

<script type="text/javascript" src="<?= base_url() ;?>scripts/mandatory.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/dashboard1.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/core.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/vendor.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/globalfn.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
<!-- Template Main JS File -->
<script src="<?= base_url() ;?>app/landing_aktivasi/assets/js/main.js"></script>
<script>
var baseurljavascript = "<?=DYBASESEURL;?>";
$("#konfirmasiaktivasi").click(function(){
  getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'auth/ceklisensi_key',
        method: 'POST',
        dataType: 'json',
        data: {
            [csrfName]: csrfTokenGlobal,
            PUBLICKEY : randomstringdigit(20),
            PRIVATE: "ACIRABATHEWORLDINYOUTHAND",
        },
        success: function (response) {
          if (response.code == "200_LC"){
            return toastr["success"](response.message);
          }else{
            Swal.fire({
                title: "Aktivasi Lisensi Aciraba",
                text: "Pastikan anda terkoneksi dengan INTERNET sebelum melakukan aktivasi. Silahkan koneksikan perangkat anda dengan modem atau interface lainnya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oke, Aktivkan Sekarang!',
                cancelButtonText: 'Waduh Gak Ada Internet!'
            }).then((result) => {
                if (result.isConfirmed) {
                  getCsrfTokenCallback(function() {aktivasi_lisensi()});  
                }
            });  
          }
        }
    });
  });
});
function aktivasi_lisensi(){
  $.ajax({
    url: baseurljavascript + 'auth/aktivasilisensi_key',
    method: 'POST',
    dataType: 'json',
    data: {
        [csrfName]: csrfTokenGlobal,
        PUBLICKEY : randomstringdigit(20),
        PRIVATE: "ACIRABATHEWORLDINYOUTHAND",
    },
    success: function (response) {
      if (response.status){
          let timerInterval
          Swal.fire({
            title: 'Pendaftaran Lisensi Berhasil!',
            html: response.message+' Anda akan diteruskan ke halaman LOGIN dalam <b></b> ms, kemudian LOGIN lah sesuai user yang telah kami berikan',
            timer: 5000,
            icon:"success",
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location = baseurljavascript+"auth";
            }
          })
        }else{
          Swal.fire({
            title: 'Oops... Terdapat kesalahan!',
            html: 'Anda akan diteruskan ke halaman LOGIN dalam <b></b> ms untuk verif ulang, '+response.message,
            timer: 5000,
            icon:"error",
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading()
              const b = Swal.getHtmlContainer().querySelector('b')
              timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
              }, 100)
            },
            willClose: () => {
              clearInterval(timerInterval)
            }
          }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
              window.location = baseurljavascript+"auth";
            }
          })
        }
    }
});
}
</script>
</body>

</html>