<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet portlet-collapsed">
                    <div style="cursor:pointer" id="toggleCollapse" data-toggle="portlet" data-target="parent" data-behavior="toggleCollapse" class="portlet-header portlet-header-bordered">
                        <div class="portlet-icon">
                            <i class="fa-solid fa-calendar-week"></i>
                        </div>
                        <h3 class="portlet-title">Tentukan Parameter Laporan</h3>
                        <div class="portlet-addon">
                            <button class="btn btn-label-info btn-icon" >
                                <i id="maxmin" class="fa-solid fa-maximize"></i>
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form -->
                            <!-- BEGIN Form Group -->
                            <div class="form-group row mb-3">
                                <label for="pilihsuplier" class="col-sm-2 col-form-label">Suplier</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="pilihsuplier"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Periode Aktivitas</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <div class="input-group input-daterange">
                                        <input id="laporan_penjualan_tanggalwal" type="text" class="form-control" placeholder="Dari Tanggal">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        <input id="laporan_penjualan_tanggalakhir" type="text" class="form-control" placeholder="Sampai Tanggal">
                                    </div>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_penjualan_kategori" class="col-sm-2 col-form-label">Outlet</label>
                                <div class="col-sm-10">
                                    <select id="laporan_penjualan_outlet" class="form-control cmblokasioutlet"><option value="<?= session('outlet');?>">Lokasi Saat Ini</option></select>
                                </div>
                            </div>
                        <!-- END Form -->
                    </div>
                </div>
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div class="portlet-icon">
                            <i class="fa-solid fa-folder-tree"></i>
                        </div>
                        <h3 class="portlet-title">Tentukan Format Laporan</h3>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-blue">
                                    <div class="inner">
                                        <h3>Format 1</h3>
                                        <p>Laporan Informasi Daftar Suplier</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <a onclick="panggilreportmasterformat('master_informasisuplier')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-red">
                                    <div class="inner">
                                        <h3>Format 2</h3>
                                        <p>Laporan Aktivias Suplier Kirim</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-boxes-stacked"></i>
                                    </div>
                                    <a onclick="panggilreportmasterformat('master_aktiviassuplier')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-green">
                                    <div class="inner">
                                        <h3>Format 3</h3>
                                        <p>Laporan Log Suplier Pada Sistem</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <a onclick="panggilreportmasterformat('master_logsuplier')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
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
<script src="https://momentjs.com/downloads/moment.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$("#toggleCollapse").click(function(){$("#maxmin").toggleClass("fa-maximize fa-minimize");}); 
$('#laporan_penjualan_tanggalwal').val(moment().startOf('month').format('DD-MM-YYYY'));
$('#laporan_penjualan_tanggalakhir').val(moment().endOf('month').format('DD-MM-YYYY'));
$(document).ready(function () {
    $(".input-daterange").datepicker({
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        orientation: "bottom left",
    });
    $('.cmblokasioutlet').select2({
        allowClear: true,
        placeholder: 'Pilih Jika Dari Outlet Lain!!',
        ajax: {
            url: baseurljavascript + 'auth/outlet',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KATAKUNCIPENCARIAN: (typeof params.term === "undefined" ? "" : params.term),
                    KODEUNIKMEMBER: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: item.group+" ["+item.namaoutlet+"] ",
                            id: item.group,
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
    $('#pilihsuplier').select2({
        allowClear: true,
        placeholder: 'Tentukan Nama Suplier',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonsuplierselect',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    DIMANA1: (typeof params.term === "undefined" ? "" : params.term),
                    DIMANA10: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.idsupplier + "] " + item.namasuplier,
                            id: item.idsupplier,
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
function panggilreportmasterformat(controllerReport,jenisformatjikasama){
    let title = "",text = "";
    if (controllerReport == "master_informasisuplier"){ 
        title = "FORMAT 1 [Laporan Informasi Daftar Suplier]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 1. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "master_aktiviassuplier"){ 
        title = "FORMAT 2 [Laporan Format Aktivitas Suplier]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 2. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "master_logsuplier"){ 
        title = "FORMAT 3 [Laporan Format Log Suplier]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 3. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }
    swal.fire({
        title: title,
        text: text,
        icon:"question",
        showCancelButton:true,
        confirmButtonText: "Lihat Laporan",
        cancelButtonText: "Gak Jadi!!",
    }).then(function(result){
        if(result.isConfirmed){
            $(".periode_aktivias").html($("#laporan_penjualan_tanggalwal").val() + " s.d "+$("#laporan_penjualan_tanggalakhir").val());
            $(".suplier_masteritem").html(($("#pilihsuplier").val() == null ? "SEMUA" : $("#pilihsuplier").html() ));
            $(".outlet_masteritem").html(($("#laporan_penjualan_outlet").val() == null ? "SEMUA" : $("#laporan_penjualan_outlet").val() ));
            setTimeout(function() {
                getCsrfTokenCallback(function() {
                    var tabel = $("#tabel_laporan_"+controllerReport).DataTable({
                        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
                        scrollCollapse: true,
                        scrollY: "100%",
                        scrollX: true,
                        ordering: false,
                        bFilter: true,
                        destroy: true,
                        pageLength: 10,
                        lengthMenu: [[10, 50, 100 , 500, -1], [10, 50, 100, 500, "All"]],
                        ajax: {
                            "url": baseurljavascript + 'laporan/formatlaporanmastersup',
                            "type": "POST",
                            "data": function (d) {
                                d.csrf_aciraba = csrfTokenGlobal;
                                d.KODESUPLIER = $("#pilihsuplier").val();
                                d.PERIODEAWAL = $("#laporan_penjualan_tanggalwal").val().split("-").reverse().join("-");
                                d.PERIODEAKHIR = $("#laporan_penjualan_tanggalakhir").val().split("-").reverse().join("-");
                                d.OUTLET = $("#laporan_penjualan_outlet").val();
                                d.KONDISI = controllerReport
                            }
                        },
                        footerCallback: function( tfoot, data, start, end, display ) {   
                            let response = this.api().ajax.json();
                            let $td = $(tfoot).find('th'); 
                            var rowCount = $(tfoot).find('tr').length;
                            if(response){}
                        }
                    });
                });
            }, 100);
            $('#modal_'+controllerReport).modal('show');
        }
    })
}
</script>
<?= $this->include('laporan/master/format_laporanmastersuplier') ?>
<?= $this->endSection(); ?>