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
                            <button  class="btn btn-label-info btn-icon" >
                                <i id="maxmin" class="fa-solid fa-maximize"></i>
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form -->
                            <!-- BEGIN Form Group -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Periode Transaksi</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <div class="input-group input-daterange">
                                        <input id="laporan_pembelian_tanggalwal" type="text" class="form-control" placeholder="Dari Tanggal">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        <input id="laporan_pembelian_tanggalakhir" type="text" class="form-control" placeholder="Sampai Tanggal"><br>
                                    </div>
                                    <span><strong>NB : </strong>Format hutang beredar akan mengambil data TANGGAL TERAKHIR pada pilihan combobox DATE ke 2</span>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <!-- END Form Group -->
                            <!-- BEGIN Form Group -->
                            <div class="form-group row mb-3">
                                <label for="inputAddress1" class="col-sm-2 col-form-label">Cara Bayar</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <div class="input-group-icon">
                                    <select class="form-control" id="laporan_pembelian_carabayar"></select>
                                    </div>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_pembelian_outlet" class="col-sm-2 col-form-label">Lokasi Outlet</label>
                                <div class="col-sm-10">
                                    <select id="laporan_pembelian_outlet" class="form-control cmblokasioutlet"><option value="<?= session('outlet');?>">Lokasi Saat Ini</option></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_pembelian_supplier" class="col-sm-2 col-form-label">Suplier</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_pembelian_supplier" class="form-control" data-live-search="true"></select>
                                    <!-- END Input Group -->
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
                                        <p>Laporan Laporan Hutang Beredar</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <a onclick="panggilreporthutang('hutangberedar')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-green">
                                    <div class="inner">
                                        <h3>Format 2</h3>
                                        <p>Laporan Pembayaran Hutang</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-boxes-stacked"></i>
                                    </div>
                                    <a onclick="panggilreporthutang('pembayaranhutang')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-red">
                                    <div class="inner">
                                        <h3>Format 3</h3>
                                        <p>Laporan Saldo Hutang Supplier</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <a onclick="panggilreporthutang('hutangpersuplier')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-secondary">
                                    <div class="inner">
                                        <h3>Format 4</h3>
                                        <p>Laporan Buku Bantu Hutang</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-cash-register"></i>
                                    </div>
                                    <a onclick="panggilreporthutang('bukubantuhutang')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
<script>
$("#toggleCollapse").click(function(){$("#maxmin").toggleClass("fa-maximize fa-minimize");}); 
$('#laporan_pembelian_tanggalwal').val(moment().startOf('month').format('DD-MM-YYYY'));
$('#laporan_pembelian_tanggalakhir').val(moment().endOf('month').format('DD-MM-YYYY'));
var kondisihutang = "0";
var totalhutangfooter = 0,totalsisahutangfooter = 0, totalterbayarfooter = 0;
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
    $('#laporan_pembelian_supplier').select2({
        allowClear: true,
        placeholder: 'Filter Berdasarkan Nama Suplier Terpilih',
        ajax: {
            url: baseurljavascript + 'masterdata/selectvaluereport',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KONDISI : 41,
                    DARI : "COMBOREPORTSUP",
                    KATAKUNCIPENCARIAN: (typeof params.term === "undefined" ? "" : params.term),
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: item.namaoutlet+" ["+item.group+"] ",
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
    
    $('#laporan_pembelian_carabayar').select2({
        allowClear: true,
        placeholder: 'Jenis TOP Pembelian',
        ajax: {
            url: baseurljavascript + 'masterdata/jenispembayarantransaksi',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    NAMAPARAMETER: (typeof params.term === "undefined" ? "" : params.term),
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: item.namatrx,
                            id: item.kodetrx,
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
function panggilreporthutang(controllerReport,jenisformatjikasama){
    let title = "",text = "";
    if (controllerReport == "hutangberedar"){ 
        title = "FORMAT 1 [Laporan Hutang Beredar]"; 
        text = "Apakah anda yakin ingin mencetak laporan hutang beredar dengan FORMAT 1. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "pembayaranhutang"){ 
        title = "FORMAT 2 [Laporan Pembayaran Hutang]"; 
        text = "Apakah anda yakin ingin mencetak laporan pembayaran hutang dengan FORMAT 2. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "hutangpersuplier"){ 
        title = "FORMAT 3 [Laporan Saldo Hutang Suplier]"; 
        text = "Apakah anda yakin ingin mencetak laporan saldo hutang ke suplier dengan FORMAT 3. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "bukubantuhutang"){ 
        title = "FORMAT 4 [Laporan Buku Bantu Hutang]"; 
        text = "Apakah anda yakin ingin mencetak laporan buku bantu hutang ke suplier dengan FORMAT 4. Pastikan periode / outlet sesuai dengan yang diinginkan";
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
            $(".tanggal_perfaktur").html($("#laporan_pembelian_tanggalwal").val() + " s.d "+$("#laporan_pembelian_tanggalakhir").val());
            $(".carabayar_perfaktur").html(($("#laporan_pembelian_carabayar").val() == "" ? "SEMUA" : $("#laporan_pembelian_carabayar").val() ));
            $(".outletterpilih_perfaktur").html(($("#laporan_pembelian_outlet").val() == null ? "SEMUA" : $("#laporan_pembelian_outlet").val() ));
            $(".suplier_perfaktur").html(($("#laporan_pembelian_supplier").val() == null ? "SEMUA" : $("#laporan_pembelian_supplier").val() ));
            setTimeout(function() {
                if (controllerReport == "hutangberedar"){ 
                    totalhutangfooter = 0,totalsisahutangfooter = 0, totalterbayarfooter = 0;
                    getCsrfTokenCallback(function() {
                        let table = $("#tabel_laporan_"+controllerReport).DataTable({
                            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
                            scrollCollapse: true,
                            scrollY: "100%",
                            scrollX: true,
                            ordering: false,
                            bFilter: true,
                            destroy: true,
                            pageLength: -1,
                            lengthMenu: [[10, 50, 100 , 500, -1], [10, 50, 100, 500, "All"]],
                            ajax: {
                                "url": baseurljavascript + 'laporan/formatlaporanhutangnodatatables',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.PERIODEAWAL = $("#laporan_pembelian_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_pembelian_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_pembelian_carabayar").val();
                                    d.OUTLET = $("#laporan_pembelian_outlet").val();
                                    d.KODESUPLIER = $("#laporan_pembelian_supplier").val();
                                    d.KONDISI = controllerReport;
                                    d.KONDISIHUTANG = kondisihutang;
                                }
                            },
                            columns: [
                                { "title": "",data: "NOTRANSAKSI" },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return moment(row.TANGGALBELI).format('DD-MM-YYYY HH:mm:ss');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return moment(row.JATUHTEMPOHUTANG).format('DD-MM-YYYY');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        let stringjatuhtempo = "";
                                        if (row.RENTANGWAKTU < 0){
                                            stringjatuhtempo = "Tempo Melebihi "+(row.RENTANGWAKTU * -1)+" Hari Yang Lalu"
                                        }else{
                                            stringjatuhtempo = "Tempo Akan Datang "+row.RENTANGWAKTU+" Hari Lagi"
                                        }
                                        return stringjatuhtempo;
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.TOTALKREDIT),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.SISAKREDIT),'id-ID','IDR');
                                    },
                                },
                            ],
                            rowGroup: {
                                dataSrc:function(row) {
                                    return row.FK_SUPPLIER;
                                },
                                startRender: function ( rows, group ) {
                                    return $('<tr style="color:red">')
                                        .append("<td>Nama Suplier : "+rows.data()[0].NAMASUPPLIER+"<br>No Transaksi Hutang</td>")
                                        .append("<td>Petugas Konfirmasi : "+rows.data()[0].NAMAPENGGUNA.toUpperCase()+"<br>Waktu Pembelian</td>")
                                        .append("<td style='vertical-align : middle;'>Tanggal Jatuh Tempo</td>")
                                        .append("<td style='vertical-align : middle;'>Keterangan Tempo</td>")
                                        .append("<td style='vertical-align : middle;'>Total Hutang</td>")
                                        .append("<td style='vertical-align : middle;'>Sisa Hutang</td>")
                                        .append('</tr>');
                                },
                                endRender: function ( rows, group ) {
                                    let totalhutang = 0,totalsisahutang = 0, totalterbayar = 0;
                                    $.each(rows.data(), function (index,element) {
                                        totalhutang += element.TOTALKREDIT;
                                        totalsisahutang += element.SISAKREDIT;
                                        totalterbayar += element.TERBAYAR;
                                        totalhutangfooter += element.TOTALKREDIT;
                                        totalsisahutangfooter += element.SISAKREDIT;
                                        totalterbayarfooter += element.TERBAYAR;
                                    });
                                    return $('<tr style="color:red">')
                                        .append("<td colspan='4' style='text-align: right;vertical-align : middle'>SUB TOTAL</td>")
                                        .append('<td>'+formatuang(totalhutang,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalsisahutang,'id-ID','IDR')+'</td>')
                                        .append('</tr>');
                                },
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {   
                                setTimeout(function() {
                                    let $td = $(tfoot).find('th'); 
                                    $td.eq(1).html(formatuang(totalhutangfooter,'id-ID','IDR'));
                                    $td.eq(2).html(formatuang(totalsisahutangfooter,'id-ID','IDR'));
                                    $td.eq(3).html(formatuang(totalterbayarfooter,'id-ID','IDR'));
                                },500)
                            }
                        });
                    });
                }else if (controllerReport == "bukubantuhutang"){ 
                    getCsrfTokenCallback(function() {
                        let table = $("#tabel_laporan_"+controllerReport).DataTable({
                            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
                            scrollCollapse: true,
                            scrollY: "100%",
                            scrollX: true,
                            ordering: false,
                            bFilter: true,
                            destroy: true,
                            pageLength: -1,
                            lengthMenu: [[10, 50, 100 , 500, -1], [10, 50, 100, 500, "All"]],
                            ajax: {
                                "url": baseurljavascript + 'laporan/formatlaporanhutangnodatatables',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.PERIODEAWAL = $("#laporan_pembelian_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_pembelian_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_pembelian_carabayar").val();
                                    d.OUTLET = $("#laporan_pembelian_outlet").val();
                                    d.KODESUPLIER = $("#laporan_pembelian_supplier").val();
                                    d.KONDISI = controllerReport;
                                    d.KONDISIHUTANG = kondisihutang;
                                }
                            },
                            columns: [
                                { "title": "",data: "NOTA" },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return moment(row.TANGGALTRS).format('DD-MM-YYYY HH:mm:ss');
                                    },
                                },
                                { "title": "",data: "KETERANGAN" },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return row.KONDISI;
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.DEBET),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.KREDIT),'id-ID','IDR');
                                    },
                                },
                            ],
                            rowGroup: {
                                dataSrc:function(row) {
                                    return row.FK_SUPPLIER;
                                },
                                startRender: function ( rows, group ) {
                                    return $('<tr style="color:red">')
                                        .append("<td>Kode Suplier : "+group+"<br>No Transaksi</td>")
                                        .append("<td>Nama Suplier : "+rows.data()[0].NAMASUPPLIER+"<br>Waktu Pembelian</td>")
                                        .append("<td style='vertical-align : middle;'>Ket. Transaksi</td>")
                                        .append("<td style='vertical-align : middle;'>Status</td>")
                                        .append("<td style='vertical-align : middle;'>Debit</td>")
                                        .append("<td style='vertical-align : middle;'>Kredit</td>")
                                        .append('</tr>');
                                },
                                endRender: function ( rows, group ) {
                                    let totalhutang = 0,totalsisahutang = 0;
                                    $.each(rows.data(), function (index,element) {
                                        totalhutang += element.DEBET;
                                        totalsisahutang += element.KREDIT;
                                        /*totalhutangfooter += element.TOTALKREDIT;
                                        totalsisahutangfooter += element.SISAKREDIT;*/
                                    });
                                    return $('<tr style="color:red">')
                                        .append("<td colspan='4' style='text-align: right;vertical-align : middle'>SUB TOTAL</td>")
                                        .append('<td>'+formatuang(totalhutang,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalsisahutang,'id-ID','IDR')+'</td>')
                                        .append('</tr>');
                                },
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {   
                                /*setTimeout(function() {
                                    let $td = $(tfoot).find('th'); 
                                    $td.eq(1).html(formatuang(totalhutangfooter,'id-ID','IDR'));
                                    $td.eq(2).html(formatuang(totalsisahutangfooter,'id-ID','IDR'));
                                },500)*/
                            }
                        });
                    });
                }else if(controllerReport == "pembayaranhutang" || controllerReport == "hutangpersuplier"){
                    getCsrfTokenCallback(function() {
                        $("#tabel_laporan_"+controllerReport).DataTable({
                            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
                            scrollCollapse: true,
                            scrollY: "100%",
                            scrollX: true,
                            ordering: false,
                            bFilter: true,
                            destroy: true,
                            pageLength: -1,
                            lengthMenu: [[10, 50, 100 , 500, -1], [10, 50, 100, 500, "All"]],
                            ajax: {
                                "url": baseurljavascript + 'laporan/formatlaporanhutang',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.PERIODEAWAL = $("#laporan_pembelian_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_pembelian_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_pembelian_carabayar").val();
                                    d.OUTLET = $("#laporan_pembelian_outlet").val();
                                    d.KODEBARANG = $("#laporan_pembelian_barang").val();
                                    d.KODESUPLIER = $("#laporan_pembelian_supplier").val();
                                    d.KODEKATEGORI = $("#laporan_pembelian_kategori").val();
                                    d.KONDISI = controllerReport
                                }
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {
                                let response = this.api().ajax.json();
                                let $td = $(tfoot).find('th');
                                if(response){
                                    if (controllerReport == "pembayaranhutang") {
                                        $td.eq(1).text(response.totalpembayaran);
                                    }else if (controllerReport == "hutangpersuplier") {
                                        $td.eq(1).text(response.totalkredit);
                                        $td.eq(2).text(response.totalterbayarkan);
                                        $td.eq(3).text(response.totalsisakredit);
                                    }
                                }
                            }
                        });
                    });
                }
            }, 100);
            $('#modal_'+controllerReport).modal('show');
        }
    })
}
function filterreport(kondisi,valuekondisi){
    kondisihutang = valuekondisi;
    totalhutangfooter = 0,totalsisahutangfooter  = 0, totalterbayarfooter = 0;
    $("#tabel_laporan_"+kondisi).DataTable().ajax.reload();
}
</script>
<?= $this->include('laporan/hutang/format_laporanhutang') ?>
<?= $this->endSection(); ?>