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
                    <h3 class="portlet-title">Pencatatan Transaksi Duitku</h3>
                </div>
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
            <h3 class="portlet-title">Informasi Umum PT Kharisma Catur Mandala - DUITKU</h3>
        </div>
        <div class="portlet-body">
            <div class="col-md-12">
                <!-- BEGIN Portlet -->
                <div class="portlet mb-0">
                    <div class="portlet-body">
                        <nav class="mb-3">
                            <!-- BEGIN Nav -->
                            <div class="nav nav-tabs" id="nav3-tab">
                                <a class="nav-item nav-link active" id="nav3-home-tab" data-toggle="tab" href="#nav3-home">Informasi Harga</a>
                                <a class="nav-item nav-link" id="nav3-profile-tab" data-toggle="tab" href="#nav3-profile">Status Transaksi</a>
                                <a class="nav-item nav-link" id="nav3-contact-tab" data-toggle="tab" href="#nav3-contact">On Premise API</a>
                            </div>
                            <!-- END Nav -->
                        </nav>
                        <!-- BEGIN Tab -->
                        <div class="tab-content" id="nav3-tabContent">
                            <div class="tab-pane fade show active" id="nav3-home">
                                <div id="kontenbarang"><div id="informasihargaduiku"></div></div>
                            </div>
                            <div class="tab-pane fade" id="nav3-profile">
                                <p class="mb-0" style="text-align:center">Karena Pihak DUITKU tidak menyediakan API untuk mendapatkan status informasi transaksi, maka kami akan berusaha dalam mengembangkan fitur ini agar dapat melihat status transaksi tanpa ke website DUIKU.COM</p>
                            </div>
                            <div class="tab-pane fade" id="nav3-contact">
                                <p class="mb-0" style="text-align:center">Masih dalam pengembangan sistem</p>
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
</div>
<script>
$(document).ready(async function() {
    loadinformasiharga()
});
function loadinformasiharga(){
    $('#kontenbarang').block();
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'paymentgateway/daftarbankduitku',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]: csrfTokenGlobal,
            },
            success: function (response) {
                if (response.paymentFee === undefined){
                    return  toastr["error"]("Informasi daftar fee atau admin pada DUITKU tidak terkoneksi. Error timestamp expired in signature token. Silahkan coba lagi nanti");
                }
                let stringhtmldaftarabrang = "";
                $("#informasihargaduiku").html("");
                stringhtmldaftarabrang += "<div class=\"\"><div class=\"row\">";
                response.paymentFee.forEach(payment => {
                    stringhtmldaftarabrang += ""
                        + "<div class=\"col-md-4\">"
                        + "<div class=\"portlet widget1\">"
                        + "<div style=\"background-image: url('"+(payment.paymentMethod === "SQ" ? "https://www.nusapay.co.id/img/logos/nusapay-logo.png" : payment.paymentImage)+"');background-size: contain;background-repeat: no-repeat;background-position: center;\" class=\"widget1-display widget1-display-top widget1-display-sm justify-content-between text-white\">"
                        + "<div class=\"widget1-group\">"
                        + "<div class=\"widget1-addon\">"
                        + "<button class=\"btn btn-label-light\"></button>"
                        + "</div>"
                        + "</div>"
                        + "<div class=\"widget1-group\">"
                        + "<h3 class=\"widget1-title\"></h3>"
                        + "</div>"
                        + "</div>"
                        + "<div class=\"widget1-body\">"
                        + "<div class=\"rich-list-item p-0 mb-3\">"
                        + "<div class=\"rich-list-prepend\">"
                        + "<div class=\"avatar\">"
                        + "<div class=\"avatar-display\">"
                        + "<img src=\"https://cdn.worldvectorlogo.com/logos/duitku.svg\" alt=\"Logo Duitku\">"
                        + "</div>"
                        + "</div>"
                        + "</div>"
                        + "<div class=\"rich-list-content\">"
                        + "<h4 class=\"rich-list-title\">Kode : "+payment.paymentMethod+"</h4>"
                        + "<span class=\"rich-list-subtitle\">Nama : "+payment.paymentName+"</span>"
                        + "</div>"
                        + "<div class=\"rich-list-append rich-list-append d-flex flex-column\">"
                        + "<h3 class=\"fw-bolder mb-0\">"+formatRupiah(payment.totalFee,"Rp ")+"</h3>"
                        + "<small class=\"text-muted\">Fee Duitku</small>"
                        + " </div>"
                        + "</div>"
                        + "</div>"
                        + "</div>"
                        + "</div>"; // Penutup col-md-4 di sini
                });
                stringhtmldaftarabrang += "</div></div>";
                $("#informasihargaduiku").html(stringhtmldaftarabrang);

            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    })
    $('#kontenbarang').unblock()
}
</script>
<?= $this->endSection(); ?>