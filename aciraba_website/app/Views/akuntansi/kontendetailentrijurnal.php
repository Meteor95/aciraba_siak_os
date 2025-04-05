<?= $this->extend('backend/main_akuntansi'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style> .hilang { display: none; } .terlihat { display: block; }</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div id="borderalert" class="alert <?= ($statusjurnal == 0 ? "alert-outline-danger" : "alert-outline-success" ) ;?> col-md-12">
                            <div class="alert-icon">
                                <i id="iconstatusjurnal" class="fa <?= ($statusjurnal == 0 ? "fa-wrench" : "fa-check" ) ;?>"></i>
                            </div>
                            <div class="alert-content" style="font-size 15px;">
                                <h3 class="portlet-title"> 
                                    <div id="labelstatusjurnal" class="float-left mt-2"><?= ($statusjurnal == 0 ? "JURNAL DIPERIKSA OLEH PETUGAS AUDIT" : "JURNAL DITERIMA OLEH PETUGAS AUDIT" );?></div>
                                    <button id="" class="btn btn-danger float-right"> <i class="fa-solid fa-file-pdf"></i> Format PDF</button>
                                    <button id="batalverifjurnal" class="<?= ($statusjurnal == 0 ? "hilang" : "terlihat" );?> btn btn-warning float-right mr-2"> <i class="fa-solid fa-close fa-beat" style="--fa-beat-scale: 2.0;"></i></i> Batalkan Verifikasi Jurnal</button>
                                    <button id="verifjurnal" class="<?= ($statusjurnal == 1 ? "hilang" : "terlihat" );?> btn btn-success float-right mr-2"> <i class="fa-solid fa-check fa-beat" style="--fa-beat-scale: 2.0;"></i></i> Verifikasi Jurnal</button>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <h5>
                            Tanggal Transaksi : <?= $waktutrx;?><br>
                            Ditransaksi / Diubah Oleh : <?= $dientrioleh." / ".$diubaholeh;?><br>
                        </h5>
                        <table id="tabeldetailjurnal" class="hovercolor table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Transaksi</th>
                                    <th style="text-align:center">Akun</th>
                                    <th style="text-align:center">Debit (IDR)</th>
                                    <th style="text-align:center">Kredit (IDR)</th>
                                    <th style="text-align:center">Narasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" style="text-align:right">Total Entri</th>
                                    <th style="text-align:right"><?= $total_debit;?></th>
                                    <th style="text-align:right"><?= $total_kredit;?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Narasi Jurnal</h3>
                            </div>
                            <div class="card-body">
                                <?= $narasi ;?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript">
let notransaksi = '<?=$notrxjurnal;?>';
let subperusahaan = '<?=$subperusahaan;?>';
$(document).ready(function () {
    getCsrfTokenCallback(function() {
        $("#tabeldetailjurnal").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            dom: 'rtip',
            scrollCollapse: true,
            scrollX: true,
            bFilter: false,
            bInfo : false,
            ordering: false,
            bPaginate: false,
            ajax: {
                "url": baseurljavascript + 'akuntansi/jsonviewjurnal',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.NOTRANSAKI = notransaksi;
                }
            },
        });
    });   
});
$("#verifjurnal").on("click", function() {
    ubahverifikasijurnal(1)
});
$("#batalverifjurnal").on("click", function() {
    ubahverifikasijurnal(0)
});
function ubahverifikasijurnal(statusverifikasi){
    Swal.fire({
        title: 'Verifikasi Jurnal '+notransaksi+' ?',
        text: 'Ketika anda verifikasi jurnal ini maka jural akan tercatan pada pembukuan akuntansi seperti neraca dll. Ketika diverifikasi jurnal tidak bisa diedit atau dihapus. Batalkan verifikasi hanya bisa dilakukan sebelum TUTUP BUKU',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Verifikasi Sekarang!!',
        cancelButtonText: 'Tunggu Dulu!!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseurljavascript + 'akuntansi/verifentri',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]:csrfTokenGlobal,
                    NOTRXEDIT : notransaksi,
                    SUBPERUSAHAAN : subperusahaan,
                    STATUSUBAH : statusverifikasi,
                },
                success: function (response) {
                    if (response.success == true){
                        if(statusverifikasi == 1){
                            $("#verifjurnal").addClass("hilang").removeClass("terlihat");
                            $("#batalverifjurnal").addClass("terlihat").removeClass("hilang");
                            $("#borderalert").removeClass("alert-outline-danger").addClass("alert-outline-success");
                            $("#iconstatusjurnal").removeClass("fa-wrench").addClass("fa-check");
                            $("#labelstatusjurnal").text("JURNAL DITERIMA OLEH PETUGAS AUDIT");
                        } else {
                            $("#verifjurnal").addClass("terlihat").removeClass("hilang");
                            $("#batalverifjurnal").addClass("hilang").removeClass("terlihat");
                            $("#borderalert").removeClass("alert-outline-success").addClass("alert-outline-danger");
                            $("#iconstatusjurnal").removeClass("fa-check").addClass("fa-wrench");
                            $("#labelstatusjurnal").text("JURNAL DIPERIKSA OLEH PETUGAS AUDIT");
                        }
                        Swal.fire(
                            'Jurnal Berhasil Diverifikasi!',
                            response.msg,
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Terjadi Kesalahan!',
                            response.msg,
                            'error'
                        )
                    }
                }
            });
        }
    })
}
</script>
<?= $this->endSection(); ?>