<?= $this->extend('backend/main_akuntansi'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div class="row">
                            <div class="col-md-8 mb-1 col-sm-12 mb-2">
                                <select class="form-control" id="pilihperusahaan"><option value="0">[0] Perusahaan Induk</option></select>
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12 mb-2">
                                <button id="prosesfilterentrijurnal" class="btn btn-primary btn-block"> <i class="fas fa-cog"></i> Proses Cek</button>
                            </div>
                            <div class="col">
                                <!-- BEGIN Card -->
                                <div class="alert alert-outline-success">
                                    <div class="alert-icon">
                                        <i class="fa fa-arrow-up"></i>
                                    </div>
                                    <div class="alert-content">
                                        <h4 class="alert-heading">Pemasukan Kas Bank Bulan Ini!</h4>
                                        <hr>
                                        <h5 id="kasmasuk"><?=$kasmasuk;?></h5>
                                    </div>
                                </div>
                                <!-- END Card -->
                            </div>
                            <div class="col">
                                <!-- BEGIN Card -->
                                <div class="alert alert-outline-danger">
                                    <div class="alert-icon">
                                        <i class="fa fa-arrow-down"></i>
                                    </div>
                                    <div class="alert-content">
                                        <h4 class="alert-heading">Pengeluaran Kas Bank Bulan Ini!</h4>
                                        <hr>
                                        <h5 id="kaskeluar"><?=$kaskeluar;?></h5>
                                    </div>
                                </div>
                                <!-- END Card -->
                            </div>
                            <div class="col">
                                <!-- BEGIN Card -->
                                <div class="alert alert-outline-info">
                                    <div class="alert-icon">
                                        <i class="fa fa-chart-bar"></i>
                                    </div>
                                    <div class="alert-content">
                                        <h4 class="alert-heading">Total Saldo Kas Bank Bulan Ini!</h4>
                                        <hr>
                                        <h5 id="sisakasmasukkeluar"><?=$sisakasbank;?></h5>
                                    </div>
                                </div>
                                <!-- END Card -->
                            </div>
                            <div class="col">
                                <!-- BEGIN Card -->
                                <div class="alert alert-outline-primary">
                                    <div class="alert-icon">
                                        <i class="fa fa-chart-bar"></i>
                                    </div>
                                    <div class="alert-content">
                                        <h4 class="alert-heading">Total Saldo Kas Bank Saat Ini!</h4>
                                        <hr>
                                        <h5 id="totalkassaatini"><?=$totalkassaatini;?></h5>
                                    </div>
                                </div>
                                <!-- END Card -->
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="row row-cols-1 row-cols-md-2 g-3">
                            <div class="col">
                                <!-- BEGIN Card -->
                                <div class="card">
                                    <img src="/images/asset/terimakasbank.png" class="card-img-top" alt="Transfer Kas Bank">
                                    <div class="card-body">
                                        <h5 class="card-title">Terima Uang Kas/Bank</h5>
                                        <p class="card-text">Fitur yang digunakan untuk mencatat terima UANG atau DANA dari pendapatan diluar sistem aplikasi seperti pemodalan dari BANK / Investor dan lain sebagainya serta dicatat agar lebih rapi dan jelas</p>
                                        <a href="<?= base_url().'akuntansi/kasdanbank/kasmasuk' ;?>" class="btn btn-primary btn-block">Entri Terima Uang Kas/Bank</a>
                                    </div>
                                </div>
                                <!-- END Card -->
                            </div>
                            <div class="col">
                                <!-- BEGIN Card -->
                                <div class="card">
                                    <img src="/images/asset/kirimkasbank.png" class="card-img-top" alt="Transfer Kas Bank">
                                    <div class="card-body">
                                        <h5 class="card-title">Kirim Uang Kas/Bank</h5>
                                        <p class="card-text">Fitur yang digunakan untuk mencatat kirim UANG atau DANA dari perusahaan untuk keperluan lain seperti pembayaran PAJAK, Pembayaran BEBAN jika diambil dari KAS/BANK agar semakin jelas margin usaha</p>
                                        <a href="<?= base_url().'akuntansi/kasdanbank/kaskeluar' ;?>" class="btn btn-primary btn-block">Entri Kirim Uang Kas/Bank</a>
                                    </div>
                                </div>
                                <!-- END Card -->
                            </div>
                            <div class="col">
                                <!-- BEGIN Card -->
                                <div class="card">
                                    <img src="/images/asset/transferkasbank.png" class="card-img-top" alt="Transfer Kas Bank">
                                    <div class="card-body">
                                        <h5 class="card-title">Transfer Antar Uang Kas/Bank</h5>
                                        <p class="card-text">Fitur yang digunakan untuk mencatat pemindahan UANG atau DANA antara KAS/BANK asal ke KAS/BANK tujuan agar lebih rapi dan jelas seperti pemindahan modal dari BANK BCA ke KAS BESAR</p>
                                        <a href="<?= base_url().'akuntansi/kasdanbank/kastransfer' ;?>" class="btn btn-primary btn-block">Entri Transfer Antar Uang Kas/Bank</a>
                                    </div>
                                </div>
                                <!-- END Card -->
                            </div>
                        </div>
                        <!-- END Form Row -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('#pilihperusahaan').select2({
    allowClear: true,
    placeholder: 'Tentukan Jurnal Perusahaan',
    ajax: {
        url: baseurljavascript + 'masterdata/jsonpilihperusahaan',
        method: 'POST',
        dataType: 'json',
        delay: 500,
        data: function (params) {
            return {
                csrf_aciraba: csrfTokenGlobal,
                NAMAPERUSAHAAN: (typeof params.term === "undefined" ? "" : params.term),
                KODEUNIKMEMBER: session_kodeunikmember,
            }
        },
        processResults: function (data) {
            parseJSON = JSON.parse(data);
            getCsrfTokenCallback(function() {});
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "[" + item.kodepursahaan + "] " + item.namaperusahaan,
                        id: item.kodepursahaan,
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
$("#prosesfilterentrijurnal").on("click", function () {
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'akuntansi/ajaxkasbanktotal',
        method: 'POST',
        dataType: 'json',
        data: {
            csrf_aciraba: csrfTokenGlobal,
            SUBPERUSAHAAN: $('#pilihperusahaan').val(),
        },
        complete:function(){},
        success: function (response) {
            $("#kasmasuk").html(formatRupiah(response.kasmasukbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL,"Rp "))
            $("#kaskeluar").html(formatRupiah(response.kaskeluarbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL,"Rp "))
            $("#sisakasmasukkeluar").html(formatRupiah((response.kasmasukbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL - response.kaskeluarbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL),"Rp "))
            $("#totalkassaatini").html(formatRupiah(response.totalkasbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL,"Rp "))
        }
    });
});        
});
</script>
<?= $this->endSection(); ?>