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
                                        <input id="laporan_piutang_tanggalwal" type="text" class="form-control" placeholder="Dari Tanggal">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        <input id="laporan_piutang_tanggalakhir" type="text" class="form-control" placeholder="Sampai Tanggal"><br>
                                    </div>
                                </div>
                            </div>
                            <!-- END Form Group -->
                            <!-- BEGIN Form Group -->
                            <div class="form-group row mb-3">
                                <label for="inputAddress1" class="col-sm-2 col-form-label">Cara Bayar</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <div class="input-group-icon">
                                    <select id="laporan_piutang_carabayar" class="selectpicker" data-live-search="true">
                                        <option value="">Semua</option>
                                        <option value="TUNAI">Tunai / Cash</option>
                                        <option value="KREDIT">Piutang / Kredit</option>
                                        <option value="KARTU">Non Tunai</option>
                                        <option value="SPLITCASH">Split Cash</option>
                                    </select>
                                    </div>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_piutang_outlet" class="col-sm-2 col-form-label">Lokasi Outlet</label>
                                <div class="col-sm-10">
                                    <select id="laporan_piutang_outlet" class="form-control cmblokasioutlet"><option value="<?= session('outlet');?>">Lokasi Saat Ini</option></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_piutang_customer" class="col-sm-2 col-form-label">Customer</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_piutang_customer" class="form-control" data-live-search="true"></select>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_piutang_groumember" class="col-sm-2 col-form-label">Group Customer</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_piutang_groumember" class="form-control" data-live-search="true"></select>
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
                                        <p>Laporan Laporan Piutang Beredar</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <a onclick="panggilreportpiutang('piutangberedar')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-green">
                                    <div class="inner">
                                        <h3>Format 2</h3>
                                        <p>Laporan Pembayaran Piutang</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-boxes-stacked"></i>
                                    </div>
                                    <a onclick="panggilreportpiutang('pembayaranpiutang')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-red">
                                    <div class="inner">
                                        <h3>Format 3</h3>
                                        <p>Laporan Saldo Piutang Member</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <a onclick="panggilreportpiutang('piutangmember')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-secondary">
                                    <div class="inner">
                                        <h3>Format 4</h3>
                                        <p>Laporan Buku Bantu Piutang</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-cash-register"></i>
                                    </div>
                                    <a onclick="panggilreportpiutang('bukubantupiutang')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
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
$('#laporan_piutang_tanggalwal').val(moment().startOf('month').format('DD-MM-YYYY'));
$('#laporan_piutang_tanggalakhir').val(moment().endOf('month').format('DD-MM-YYYY'));
var kondisipiutang = "0";
var totalpiutangfooter = 0,totalsisapiutangfooter = 0, totalterbayarfooter = 0;
var tableDT;
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
    $('#laporan_piutang_customer').select2({
        allowClear: true,
        placeholder: 'Filter Berdasarkan Nama Pelanggan',
        ajax: {
            url: baseurljavascript + 'masterdata/selectvaluereport',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KONDISI : 39,
                    DARI : "COMBOREPORTCUSTOMER",
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
    $('#laporan_piutang_groumember').select2({
        allowClear: true,
        placeholder: 'Filter Berdasarkan Group Member',
        ajax: {
            url: baseurljavascript + 'masterdata/selectvaluereport',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KONDISI : 42,
                    DARI : "COMBOREPORTGROUPMEMBER",
                    KATAKUNCIPENCARIAN: (typeof params.term === "undefined" ? "" : params.term),
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                etCsrfTokenCallback(function() {});
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
});
function panggilreportpiutang(controllerReport,jenisformatjikasama){
    let title = "",text = "";
    if (controllerReport == "piutangberedar"){ 
        title = "FORMAT 1 [Laporan Piutang Beredar]"; 
        text = "Apakah anda yakin ingin mencetak laporan piutang beredar dengan FORMAT 1. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "pembayaranpiutang"){ 
        title = "FORMAT 2 [Laporan Pembayaran Piutang]"; 
        text = "Apakah anda yakin ingin mencetak laporan pembayaran piutang dengan FORMAT 2. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "piutangmember"){ 
        title = "FORMAT 3 [Laporan Saldo Piutang Member]"; 
        text = "Apakah anda yakin ingin mencetak laporan saldo piutang ke member dengan FORMAT 3. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "bukubantupiutang"){ 
        title = "FORMAT 4 [Laporan Buku Bantu Piutang]"; 
        text = "Apakah anda yakin ingin mencetak laporan buku bantu piutang ke member dengan FORMAT 4. Pastikan periode / outlet sesuai dengan yang diinginkan";
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
            $(".tanggal_perfaktur").html($("#laporan_piutang_tanggalwal").val() + " s.d "+$("#laporan_piutang_tanggalakhir").val());
            $(".carabayar_perfaktur").html(($("#laporan_piutang_carabayar").val() == "" ? "SEMUA" : $("#laporan_piutang_carabayar").val() ));
            $(".pelanggan_perfaktur").html(($("#laporan_piutang_customer").val() == null ? "SEMUA" : $("#laporan_piutang_customer").val() ));
            $(".group_perfaktur").html(($("#laporan_piutang_groumember").val() == null ? "SEMUA" : $("#laporan_piutang_groumember").val() ));
            $(".outletterpilih_perfaktur").html(($("#laporan_piutang_outlet").val() == null ? "SEMUA" : $("#laporan_piutang_outlet").val() ));
            setTimeout(function() {
                if (controllerReport == "piutangberedar"){ 
                    totalpiutangfooter = 0,totalsisapiutangfooter = 0, totalterbayarfooter = 0;
                    getCsrfTokenCallback(function() {
                        tableDT = $("#tabel_laporan_"+controllerReport).DataTable({
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
                                "url": baseurljavascript + 'laporan/formatlaporanpiutangnodatatables',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.PERIODEAWAL = $("#laporan_piutang_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_piutang_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_piutang_carabayar").val();
                                    d.OUTLET = $("#laporan_piutang_outlet").val();
                                    d.IDPELANGGAN = $("#laporan_piutang_customer").val();
                                    d.GROUPELANGGAN = $("#laporan_piutang_groumember").val();
                                    d.KONDISI = controllerReport
                                    d.KONDISIPIUTANG = kondisipiutang
                                }
                            },
                            columns: [
                                { "title": "",data: "PK_NOTAPENJUALAN" },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return moment(row.TRXKELUAR).format('DD-MM-YYYY HH:mm:ss');
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
                                    return row.FK_MEMBER;
                                },
                                startRender: function ( rows, group ) {
                                    return $('<tr style="color:red">')
                                        .append("<td>Nama Member : "+rows.data()[0].NAMAMEMBER.toUpperCase()+"<br>No Transaksi Keluar</td>")
                                        .append("<td>Petugas Kasir : "+rows.data()[0].NAMAPENGGUNA.toUpperCase()+"<br>Waktu Transaksi</td>")
                                        .append("<td style='vertical-align : middle;'>Tanggal Jatuh Tempo</td>")
                                        .append("<td style='vertical-align : middle;'>Keterangan Tempo</td>")
                                        .append("<td style='vertical-align : middle;'>Total Hutang</td>")
                                        .append("<td style='vertical-align : middle;'>Sisa Hutang</td>")
                                        .append('</tr>');
                                },
                                endRender: function ( rows, group ) {
                                    let totalpiutang = 0,totalsisapiutang = 0, totalterbayar = 0;
                                    $.each(rows.data(), function (index,element) {
                                        totalpiutang += element.TOTALKREDIT;
                                        totalsisapiutang += element.SISAKREDIT;
                                        totalterbayar += element.TERBAYAR;
                                        totalpiutangfooter += element.TOTALKREDIT;
                                        totalsisapiutangfooter += element.SISAKREDIT;
                                        totalterbayarfooter += element.TERBAYAR;
                                    });
                                    return $('<tr style="color:red">')
                                        .append("<td colspan='4' style='text-align: right;vertical-align : middle'>SUB TOTAL</td>")
                                        .append('<td>'+formatuang(totalpiutang,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalsisapiutang,'id-ID','IDR')+'</td>')
                                        .append('</tr>');
                                },
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {   
                                setTimeout(function() {
                                    let $td = $(tfoot).find('th'); 
                                    $td.eq(1).html(formatuang(totalpiutangfooter,'id-ID','IDR'));
                                    $td.eq(2).html(formatuang(totalsisapiutangfooter,'id-ID','IDR'));
                                    $td.eq(3).html(formatuang(totalterbayarfooter,'id-ID','IDR'));
                                },500)
                            },
                        });
                    });
                }else if (controllerReport == "bukubantupiutang"){ 
                    totalpiutangfooter = 0,totalsisapiutangfooter = 0, totalterbayarfooter = 0;
                    getCsrfTokenCallback(function() {
                        tableDT = $("#tabel_laporan_"+controllerReport).DataTable({
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
                                "url": baseurljavascript + 'laporan/formatlaporanpiutangnodatatables',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.PERIODEAWAL = $("#laporan_piutang_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_piutang_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_piutang_carabayar").val();
                                    d.OUTLET = $("#laporan_piutang_outlet").val();
                                    d.IDPELANGGAN = $("#laporan_piutang_customer").val();
                                    d.GROUPELANGGAN = $("#laporan_piutang_groumember").val();
                                    d.KONDISI = controllerReport
                                    d.KONDISIPIUTANG = kondisipiutang
                                }
                            },
                            columns: [
                                { "title": "",data: "NOTATRANSAKSI" },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return moment(row.WAKTUTRANSAKSI).format('DD-MM-YYYY HH:mm:ss');
                                    },
                                },
                                { "title": "",data: "KETERANGAN" },
                                { "title": "",data: "KONDISI" },
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
                                    return row.KODEMEMBER;
                                },
                                startRender: function ( rows, group ) {
                                    return $('<tr style="color:red">')
                                        .append("<td>Kode Member : "+group+"<br>No Transaksi</td>")
                                        .append("<td>Nama Suplier : "+rows.data()[0].NAMAPELANGGAN+"<br>Waktu Pembelian</td>")
                                        .append("<td style='vertical-align : middle;'>Ket. Transaksi</td>")
                                        .append("<td style='vertical-align : middle;'>Status</td>")
                                        .append("<td style='vertical-align : middle;'>Debit</td>")
                                        .append("<td style='vertical-align : middle;'>Kredit</td>")
                                        .append('</tr>');
                                },
                                endRender: function ( rows, group ) {
                                    let totalpiutang = 0,totalsisapiutang = 0, totalterbayar = 0;
                                    $.each(rows.data(), function (index,element) {
                                        totalpiutang += element.DEBET;
                                        totalsisapiutang += element.KREDIT;
                                    });
                                    return $('<tr style="color:red">')
                                        .append("<td colspan='4' style='text-align: right;vertical-align : middle'>SUB TOTAL</td>")
                                        .append('<td>'+formatuang(totalpiutang,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalsisapiutang,'id-ID','IDR')+'</td>')
                                        .append('</tr>');
                                },
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {   
                            },
                        });
                    });
                }else{
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
                                "url": baseurljavascript + 'laporan/formatlaporanpiutang',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.PERIODEAWAL = $("#laporan_piutang_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_piutang_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_piutang_carabayar").val();
                                    d.OUTLET = $("#laporan_piutang_outlet").val();
                                    d.IDPELANGGAN = $("#laporan_piutang_customer").val();
                                    d.GROUPELANGGAN = $("#laporan_piutang_groumember").val();
                                    d.KONDISI = controllerReport
                                    d.KONDISIPIUTANG = kondisipiutang
                                }
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {    
                                let response = this.api().ajax.json();
                                let $td = $(tfoot).find('th');
                                if(response){
                                    if (controllerReport == "pembayaranpiutang"){
                                        $td.eq(1).html(response.totalpembayaran);
                                    }else if (controllerReport == "piutangmember") {
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
    kondisipiutang = valuekondisi;
    totalpiutangfooter = 0,totalsisapiutangfooter  = 0, totalterbayarfooter = 0;
    $("#tabel_laporan_"+kondisi).DataTable().ajax.reload(); 
}
</script>
<?= $this->include('laporan/piutang/format_laporanpiutang') ?>
<?= $this->endSection(); ?>