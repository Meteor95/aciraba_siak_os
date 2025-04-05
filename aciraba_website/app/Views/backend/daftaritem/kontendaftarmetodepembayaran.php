<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
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
                                            <img src="https://erayadigital.co.id/wp-content/uploads/2024/03/cropped-Logo-512-Eraya-Digital.png" alt="Avatar image">
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
                            <a href="https://erayadigital.co.id/" class="btn btn-label-primary btn-wide">Lihat Website</a>
                            <a href="<?= base_url() ;?>masterdata/pembayaranlokal" class="btn btn-label-danger btn-wide">Pengaturan</a>
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
                            <i class="fa fa-funnel-dollar"></i>
                        </div>
                        <h3 class="portlet-title">Gerbang Pembayaran (Payment Gateway)</h3>
                    </div>
                    <!-- BEGIN Carousel -->
                    <!-- END Carousel -->
                    <div class="portlet-body">
                        <div style="background-image: url('https://www.duitku.com/wp-content/themes/duitku/img/logo.svg');background-size: contain;background-repeat: no-repeat;background-position: center;" class="widget1-display widget1-display-top widget1-display-sm justify-content-between bg-primary text-white">
                            <div class="widget1-group">
                                <div class="widget1-addon">
                                    <button class="btn btn-label-light">2024</button>
                                </div>
                            </div>
                            <div class="widget1-group">
                                <h3 class="widget1-title">Payment Gateway DUITKU</h3>
                            </div>
                        </div>
                        <div class="widget1-body">
                            <!-- BEGIN Rich List -->
                            <div class="rich-list-item p-0 mb-3">
                                <div class="rich-list-prepend">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar">
                                        <div class="avatar-display">
                                            <img src="https://cdn.worldvectorlogo.com/logos/duitku.svg" alt="Avatar image">
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                                <div class="rich-list-content">
                                    <h4 class="rich-list-title">2015 - <?= date("Y");?> duitku. All rights reserved.</h4>
                                    <span class="rich-list-subtitle">Jl. Raya Perjuangan No. 12 RT.1/RW.7, Kb. Jeruk    West Jakarta 11530</span>
                                </div>
                                <div class="rich-list-append rich-list-append d-flex flex-column">
                                    <h3 class="fw-bolder mb-0">8</h3>
                                    <small class="text-muted">Kategori PG</small>
                                </div>
                            </div>
                            <!-- END Rich List -->
                            <p class="text-level-1 text-justify">DUITKU PAYMENT GATEWAY KIRIM DAN TERIMA PEMBAYARAN ONLINE DI INDONESIA Praktis dan tangguh. Mulai dalam hitungan menit. Terima pembayaran kartu, transfer bank, e-wallet, dan kirim pembayaran massal melalui 1 integrasi API - dan monitor semua dalam satu tempat. PT Kharisma Catur Mandala telah memiliki izin Transfer Dana & Payment Gateway dari Bank Indonesia, nomor: 23/660/DKSP/Srt/B dan telah terdaftar sebagai Penyedia Sistem Elektronik (PSE) di Kementerian Komunikasi dan Informatika Republik Indonesia, nomor 000972.01/DJAI.PSE/06/2021</p>
                            <a href="https://duitku.com/" class="btn btn-label-primary btn-wide">Lihat Website</a>
                            <a href="<?= base_url() ;?>paymentgateway/duitku" class="btn btn-label-danger btn-wide">Pengaturan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>