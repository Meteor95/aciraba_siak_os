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
                                <label class="col-sm-2 col-form-label">Periode</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <div class="input-group input-daterange">
                                        <input id="laporan_pembelian_tanggalwal" type="text" class="form-control" placeholder="Dari Tanggal">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        <input id="laporan_pembelian_tanggalakhir" type="text" class="form-control" placeholder="Sampai Tanggal">
                                    </div>
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
                            <div class="form-group row mb-3">
                                <label for="laporan_pembelian_barang" class="col-sm-2 col-form-label">Barang</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_pembelian_barang" class="form-control" data-live-search="true"></select>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_pembelian_kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_pembelian_kategori" class="form-control" data-live-search="true"></select>
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
                                        <p>Laporan Pembelian Per Faktur</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <a onclick="panggilrepotpembelianformat('pembelianperfaktur')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-green">
                                    <div class="inner">
                                        <h3>Format 2</h3>
                                        <p>Laporan Pembelian Per Barang</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-boxes-stacked"></i>
                                    </div>
                                    <a onclick="panggilrepotpembelianformat('pembelianperbarang')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-red">
                                    <div class="inner">
                                        <h3>Format 3</h3>
                                        <p>Laporan Pembelian Per Tanggal</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <a onclick="panggilrepotpembelianformat('pembelianpertanggal')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-secondary">
                                    <div class="inner">
                                        <h3>Format 4</h3>
                                        <p>Laporan Pembelian Detail Per Nota</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-cash-register"></i>
                                    </div>
                                    <a onclick="panggilrepotpembelianformat('pembeliandetail')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
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
    $('#laporan_pembelian_barang').select2({
        allowClear: true,
        placeholder: 'Filter Berdasarkan Nama Barang Terpilih',
        ajax: {
            url: baseurljavascript + 'masterdata/selectvaluereport',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KONDISI : 40,
                    DARI : "COMBOREPORTBARANG",
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
    $('#laporan_pembelian_kategori').select2({
        allowClear: true,
        placeholder: 'Filter Berdasarkan Kategori Barang',
        ajax: {
            url: baseurljavascript + 'masterdata/selectvaluereport',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KONDISI : 43,
                    DARI : "COMBOREPORTKATEGORI",
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
function panggilrepotpembelianformat(controllerReport,jenisformatjikasama){
    let title = "",text = "";
    if (controllerReport == "pembelianperfaktur"){ 
        title = "FORMAT 1 [Laporan Pembelian Per Faktur]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 1. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else  if (controllerReport == "pembelianperbarang"){ 
        title = "FORMAT 2 [Laporan Pembelian Rekap Per Barang]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 2. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else  if (controllerReport == "pembelianpertanggal"){ 
        title = "FORMAT 3 [Laporan Pembelian Rekap Per Tanggal]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 3. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else  if (controllerReport == "pembeliandetail"){ 
        title = "FORMAT 4 [Laporan Pembelian Detail Per Nota]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 4. Pastikan periode / outlet sesuai dengan yang diinginkan";
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
            $(".barang_perfaktur").html(($("#laporan_pembelian_barang").val() == null ? "SEMUA" : $("#laporan_pembelian_barang").val() ));
            $(".suplier_perfaktur").html(($("#laporan_pembelian_supplier").val() == null ? "SEMUA" : $("#laporan_pembelian_supplier").val() ));
            $(".kategori_perfaktur").html(($("#laporan_pembelian_kategori").val() == null ? "SEMUA" : $('#laporan_pembelian_kategori').select2('data')[0].text ));
            setTimeout(function() {
                if (controllerReport == "pembeliandetail"){ 
                    let collapsedGroups = {};
                    let totalkeluar = 0,totalhargabeli = 0, totaldsplay = 0,totalgudang = 0,totaldiskon1 = 0, totaldiskon2 =0,totalppn = 0, totalafterdiskon1 = 0, totalafterdiskon2 = 0, totalhpp = 0, totalbebangaji = 0, totalbebanpromo = 0,totalbebanpacking = 0, totalbebantransport = 0, totalbebanhpp = 0, subtotal = 0;
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
                                "url": baseurljavascript + 'laporan/formatlaporanpembeliannodatatables',
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
                            columns: [
                                { "title": "",data: "KODEBARANG" },
                                { "title": "",data: "NAMABARANG" },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return row.JUMLAHBELI+" Item";
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.HARGABELI),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return row.DISPLAY+" Item";
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return row.GUDANG+" Item";
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.DISKON1),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.DISKON2),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.PPN),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.AFTERDISKON1),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.AFTERDISKON2),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.HPP),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang(row.SUBTOTALPEMBELIAN,'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.BEBANGAJI),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.BEBANPROMO),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.BEBANPACKING),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.BEBANTRANSPORT),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.HPPBEBAN),'id-ID','IDR');
                                    },
                                },
                            ],
                            rowGroup: {
                                dataSrc:function(row) {
                                    return row.NOTA;
                                },
                                startRender: function ( rows, group ) {
                                    return $('<tr style="color:red">')
                                        .append("<td>No Transaksi : "+rows.data()[0].NOTA+"<br>Dari Suplier : "+rows.data()[0].NAMASUPPLIER+"<br>Kode Item</td>")
                                        .append("<td>Waktu Transaksi : "+moment(rows.data()[0].TANGGALTRS).format('DD-MM-YYYY HH:mm:ss')+"<br>Petugas Konfirmasi : "+rows.data()[0].NAMAPENGGUNA.toUpperCase()+"<br>Nama Item</td>")
                                        .append("<td style='vertical-align : middle;'>Jumlah Beli</td>")
                                        .append("<td style='vertical-align : middle;'>Harga Beli</td>")
                                        .append("<td style='vertical-align : middle;'>Taruh Display</td>")
                                        .append("<td style='vertical-align : middle;'>Taruh Gudang</td>")
                                        .append("<td style='vertical-align : middle;'>Diskon 1</td>")
                                        .append("<td style='vertical-align : middle;'>Diskon 2</td>")
                                        .append("<td style='vertical-align : middle;'>PPN</td>")
                                        .append("<td style='vertical-align : middle;'>After Diskon 1</td>")
                                        .append("<td style='vertical-align : middle;'>After Diskon 2</td>")
                                        .append("<td style='vertical-align : middle;'>HPP</td>")
                                        .append("<td style='vertical-align : middle;'>Sub Total</td>")
                                        .append("<td style='vertical-align : middle;'>Beban Gaji</td>")
                                        .append("<td style='vertical-align : middle;'>Beban Promo</td>")
                                        .append("<td style='vertical-align : middle;'>Beban Packing</td>")
                                        .append("<td style='vertical-align : middle;'>Beban Transport</td>")
                                        .append("<td style='vertical-align : middle;'>HPP + Beban</td>")
                                        .append('</tr>');
                                },
                                endRender: function ( rows, group ) {
                                    let totalkeluar = 0,totalhargabeli = 0, totaldsplay = 0,totalgudang = 0,totaldiskon1 = 0, totaldiskon2 =0,totalppn = 0, totalafterdiskon1 = 0, totalafterdiskon2 = 0, totalhpp = 0, totalbebangaji = 0, totalbebanpromo = 0,totalbebanpacking = 0, totalbebantransport = 0, subtotal = 0, totalbebanhpp = 0;
                                    $.each(rows.data(), function (index,element) {
                                        totalkeluar += element.JUMLAHBELI;
                                        totalhargabeli += element.HARGABELI;
                                        totaldsplay += element.DISPLAY;
                                        totalgudang += element.GUDANG;
                                        totaldiskon1 += element.DISKON1;
                                        totaldiskon2 += element.DISKON2;
                                        totalppn += element.PPN;
                                        totalafterdiskon1 += element.AFTERDISKON1;
                                        totalafterdiskon2 += element.AFTERDISKON2;
                                        totalhpp += element.HPP;
                                        totalbebangaji += element.BEBANGAJI;
                                        totalbebanpromo += element.BEBANPROMO;
                                        totalbebanpacking += element.BEBANPACKING;
                                        totalbebantransport += element.BEBANPACKING;
                                        totalbebanhpp += element.HPPBEBAN;
                                        subtotal += element.SUBTOTALPEMBELIAN;
                                    });
                                    return $('<tr style="color:red">')
                                        .append("<td colspan='2' style='text-align: right;vertical-align : middle'>SUB TOTAL</td>")
                                        .append('<td>'+totalkeluar.toFixed(2)+' Item</td>')
                                        .append('<td>'+formatuang(totalhargabeli,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totaldsplay,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalgudang,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totaldiskon1,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totaldiskon2,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalppn,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalafterdiskon1,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalafterdiskon2,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalhpp,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(subtotal,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalbebangaji,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalbebanpromo,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalbebanpacking,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalbebantransport,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalbebanhpp,'id-ID','IDR')+'</td>')
                                        .append('</tr>');
                                },     
                            },
                            initComplete: function(settings, json) {
                                $.each(json.data, function (index,element) {
                                    totalkeluar += element.JUMLAHBELI;
                                    totalhargabeli += element.HARGABELI;
                                    totaldsplay += element.DISPLAY;
                                    totalgudang += element.GUDANG;
                                    totaldiskon1 += element.DISKON1;
                                    totaldiskon2 += element.DISKON2;
                                    totalppn += element.PPN;
                                    totalafterdiskon1 += element.AFTERDISKON1;
                                    totalafterdiskon2 += element.AFTERDISKON2;
                                    totalhpp += element.HPP;
                                    totalbebangaji += element.BEBANGAJI;
                                    totalbebanpromo += element.BEBANPROMO;
                                    totalbebanpacking += element.BEBANPACKING;
                                    totalbebantransport += element.BEBANPACKING;
                                    totalbebanhpp += element.HPPBEBAN;
                                    subtotal += element.SUBTOTALPEMBELIAN;
                                });
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {   
                                setTimeout(function() {
                                    let $td = $(tfoot).find('th'); 
                                    $td.eq(1).html(totalkeluar.toFixed(2)+" Item");
                                    $td.eq(2).html(formatuang(totalhargabeli,'id-ID','IDR'));
                                    $td.eq(3).html(formatuang(totaldsplay,'id-ID','IDR'));
                                    $td.eq(4).html(formatuang(totalgudang,'id-ID','IDR'));
                                    $td.eq(5).html(formatuang(totaldiskon1,'id-ID','IDR'));
                                    $td.eq(6).html(formatuang(totaldiskon2,'id-ID','IDR'));
                                    $td.eq(7).html(formatuang(totalppn,'id-ID','IDR'));
                                    $td.eq(8).html(formatuang(totalafterdiskon1,'id-ID','IDR'));
                                    $td.eq(9).html(formatuang(totalafterdiskon2,'id-ID','IDR'));
                                    $td.eq(10).html(formatuang(totalhpp,'id-ID','IDR'));
                                    $td.eq(11).html(formatuang(subtotal,'id-ID','IDR'));
                                    $td.eq(12).html(formatuang(totalbebangaji,'id-ID','IDR'));
                                    $td.eq(13).html(formatuang(totalbebanpromo,'id-ID','IDR'));
                                    $td.eq(14).html(formatuang(totalbebanpacking,'id-ID','IDR'));
                                    $td.eq(15).html(formatuang(totalbebantransport,'id-ID','IDR'));
                                    $td.eq(16).html(formatuang(totalbebanhpp,'id-ID','IDR'));
                                },500)
                            
                            }
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
                                "url": baseurljavascript + 'laporan/formatlaporanpembelian',
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
                                    if (controllerReport == "pembelianperfaktur"){
                                        $td.eq(1).text(response.jumlahitem+" Item");
                                        $td.eq(2).text();
                                        $td.eq(3).text(response.diskon1);
                                        $td.eq(4).text(response.diskon2);
                                        $td.eq(5).text(response.ppn);
                                        $td.eq(6).text(response.adiskon1);
                                        $td.eq(7).text(response.adiskon2);
                                        $td.eq(8).text(response.totalpembelian);
                                        $td.eq(9).text(response.totalbeban);
                                        $td.eq(10).text(response.totalhutang);
                                    }else if (controllerReport == "pembelianperbarang" || controllerReport == "pembelianpertanggal"){
                                        $td.eq(1).text(response.jumlahitem+" Item");
                                        $td.eq(2).text(response.diskon1);
                                        $td.eq(3).text(response.diskon2);
                                        $td.eq(4).text(response.ppn);
                                        $td.eq(5).text(response.adiskon1);
                                        $td.eq(6).text(response.adiskon2);
                                        $td.eq(7).text(response.totalpembelian);
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
</script>
<?= $this->include('laporan/pembelian/format_laporanpembelian') ?>
<?= $this->endSection(); ?>