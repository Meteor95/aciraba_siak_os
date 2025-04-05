<?= $this->extend('backend/main_akuntansi'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title"> 
                            <a href="<?= base_url() ;?>akuntansi/entrijurnal"><button id="" class="btn btn-primary"> <i class="fa-solid fa-book-bookmark"></i> Entri Jurnal</button></a>
                            <button id="prosesfilterentrijurnal" class="btn btn-success float-right"> <i class="fas fa-cog"></i> Proses Cek</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-2 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="notransaksi">No Transaksi</label>
                                <input type="text" class="form-control" id="notransaksi" placeholder="Masukan No Transaksi">
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="narasijurnal">Narasi Jurnal</label>
                                <input type="text" class="form-control" id="narasijurnal" placeholder="Masukan Narasi Informasi Jurnal">
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input id="waktuawal" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="waktuakhir" type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label>Jurnal Perusahaan</label>
                                <select class="form-control" id="pilihperusahaan"><option value="0">[0] Perusahaan Induk</option></select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="notransaksi">Jenis Transaksi Jurnal</label>
                                <select id="jenisjurnaltransaksi">
                                    <option value="ALL">Semua Jurnal</option>
                                    <option value="JU">Jurnal Umum</option>
                                    <option value="PJ">Jurnal Penjualan</option>
                                    <option value="PB">Jurnal Pembelian</option>
                                    <option value="HT">Jurnal Hutang</option>
                                    <option value="PT">Jurnal Piutang</option>
                                    <option value="KM">Jurnal Kas Bank Masuk</option>
                                    <option value="KK">Jurnal Kas Bank Keluar</option>
                                    <option value="TK">Jurnal Transfer Kas Bank</option>
                                </select>
                                <!-- END Select -->
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabelentrijurnal" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No Transaksi</th>
                                    <th>Narasi Entri Jurnal</th>
                                    <th>Total Debit</th>
                                    <th>Total Kredit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No Transaksi</th>
                                    <th>Narasi Entri Jurnal</th>
                                    <th>Total Debit</th>
                                    <th>Total Kredit</th>
                                    <th>Aksi</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#waktuawal').val(moment().startOf('month').format('DD-MM-YYYY'));
    $('#waktuakhir').val(moment().format('DD-MM-YYYY'));
    $(".input-daterange").datepicker({
        todayHighlight: true,
        format: 'dd-mm-yyyy',
    }).datepicker('setDate', moment().format('DD-MM-YYYY'));
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
    $('#jenisjurnaltransaksi').select2({allowClear: true,placeholder: 'Tentukan Jurnal Perusahaan',}); 
    getCsrfTokenCallback(function() {
        $("#tabelentrijurnal").DataTable({
            lengthMenu: [10, 50, 100, 200, 500],
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true,
            bFilter: false,
            ordering: false,
            processing: true,
            columnDefs: [{ className: "text-right", targets: [3,4],},{targets: 2,render: function ( data, type, row, meta ) { return '<span style="white-space:normal">'+data+'</span>';}}],
            ajax: {
                "url": baseurljavascript + 'akuntansi/jsontabelentrijurnal',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.NOTRANSAKI = $("#notransaksi").val();
                    d.WAKTUAWAL = $("#waktuawal").val();
                    d.WAKTUAKHIR = $("#waktuakhir").val();
                    d.NARASI = $("#narasijurnal").val();
                    d.SUBPERUSAHAAN = $("#pilihperusahaan").val();
                    d.JENISJURNALTRANSAKSI = $("#jenisjurnaltransaksi").val();
                }
            },
        });
    });   
});
$("#prosesfilterentrijurnal").click(function () {
    $('#tabelentrijurnal').DataTable().ajax.reload();
});
function hapusjurnal(nomortrx,subperusahaan){
Swal.fire({
    title: 'Hapus Jurnal Terpilih',
    text: 'Apakah anda ingin menghapus JURNAL dengan NOMOR '+nomortrx+". Jurnal yang terhapus tidak akan bisa dikembalikan dan tidak terpaut dengan transaksi Otomatis",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Oke, Hapus Sekarang!!',
    cancelButtonText: 'Tunggu Dulu!!'
}).then((result) => {
    if (result.isConfirmed) {
        getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'akuntansi/hapusjurnal',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]:csrfTokenGlobal,
                    NOMORTRX : nomortrx,
                    SUBPERUSAHAAN : subperusahaan,
                },
                success: function (response) {
                    if (response.success == true){
                        Swal.fire(
                            'Jurnal Berhasil Dihapus!',
                            response.msg,
                            'success'
                        )
                        $('#tabelentrijurnal').DataTable().ajax.reload();
                    }else{
                        toastr["error"](response.msg);
                    }
                }
            });
        });
    }
})
}
</script>
<?= $this->endSection(); ?>