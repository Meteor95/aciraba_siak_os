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
                                        <p>Laporan Retur Penjualan Per Faktur</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <a onclick="panggilreportreturpembelianformat('returpembelianperfaktur')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-green">
                                    <div class="inner">
                                        <h3>Format 2</h3>
                                        <p>Laporan Retur Penjualan Detail</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-boxes-stacked"></i>
                                    </div>
                                    <a onclick="panggilreportreturpembelianformat('returpembelianperfakturdetail')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
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
function panggilreportreturpembelianformat(controllerReport,jenisformatjikasama){
    let title = "",text = "";
    if (controllerReport == "returpembelianperfaktur"){ 
        title = "FORMAT 1 [Laporan Retur Pembelian Per Faktur]"; 
        text = "Apakah anda yakin ingin mencetak laporan retur pembelian dengan FORMAT 1. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "returpembelianperfakturdetail"){ 
        title = "FORMAT 2 [Laporan Retur Pembelian Detail]"; 
        text = "Apakah anda yakin ingin mencetak laporan retur pembelian dengan FORMAT 2. Pastikan periode / outlet sesuai dengan yang diinginkan";
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
                let totalbarangkeluar = 0,totalhargabeli =0,totalpotongan=0,totalppn=0,subtotal =0;
                if (controllerReport == "returpembelianperfakturdetail"){ 
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
                            "url": baseurljavascript + 'laporan/formatlaporanreturpembeliannodatatables',
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
                                    return row.JUMLAHRETUR.toFixed(2);
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
                                    return formatuang((row.POTONGAN),'id-ID','IDR');
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
                                    let namalokasi = "";
                                    if (row.ASALLOKASI == "D") namalokasi = "DISPLAY";
                                    if (row.ASALLOKASI == "G") namalokasi = "GUDANG";
                                    if (row.ASALLOKASI == "R") namalokasi = "RETUR";
                                    return namalokasi;
                                },
                            },
                            { "title": "",data: "KETERANGAN" },
                            { 
                                "title": "",
                                "render": function (data, type, row, meta) {
                                    return formatuang(((row.JUMLAHRETUR  * row.HARGABELI) - row.POTONGAN + row.PPN),'id-ID','IDR');
                                },
                            },
                        ],
                        rowGroup: {
                            dataSrc:function(row) {
                               return row.NOTRXRETURBELI;
                            },
                            startRender: function ( rows, group ) {
                                return $('<tr style="color:red">')
                                    .append("<td style='vertical-align : middle;'>Nama Petugas : "+rows.data()[0].NAMAPENGGUNA.toUpperCase()+"<br>No Transaksi : "+group+"<br>Kode Item</td>")
                                    .append("<td style='vertical-align : middle;'>Nama Suplier : " + rows.data()[0].NAMASUPPLIER.toUpperCase() +"<br>Tanggal Transaksi : "+moment(rows.data()[0].TANGGALTRS).format('DD-MM-YYYY HH:mm:ss')+"<br>Nama Item</td>")
                                    .append("<td style='vertical-align : middle;'>Jumlah Retur</td>")
                                    .append("<td style='vertical-align : middle;'>Harga Beli</td>")
                                    .append("<td style='vertical-align : middle;'>Potongan</td>")
                                    .append("<td style='vertical-align : middle;'>PPN</td>")
                                    .append("<td style='vertical-align : middle;'>Lokasi Stok</td>")
                                    .append("<td style='vertical-align : middle;'>Keterangan</td>")
                                    .append("<td style='vertical-align : middle;'>Sub Total</td>")
                                    .append('</tr>');
                            },
                            endRender: function ( rows, group ) {
                                let totalbarangkeluar = 0,totalhargabeli =0,totalpotongan=0,totalppn=0,subtotal =0;
                                $.each(rows.data(), function (index,element) {
                                    totalbarangkeluar += element.JUMLAHRETUR;
                                    totalhargabeli += element.HARGABELI;
                                    totalpotongan += element.POTONGAN;
                                    totalppn += element.PPN;
                                    subtotal += ((element.JUMLAHRETUR  * element.HARGABELI) - element.POTONGAN + element.PPN);
                                });
                                return $('<tr style="color:red">')
                                    .append("<td colspan='2' style='text-align: right;'>SUB TOTAL</td>")
                                    .append('<td>'+totalbarangkeluar.toFixed(2)+'</td>')
                                    .append('<td>'+formatuang(totalhargabeli,'id-ID','IDR')+'</td>')
                                    .append('<td>'+formatuang(totalpotongan,'id-ID','IDR')+'</td>')
                                    .append('<td>'+formatuang(totalppn,'id-ID','IDR')+'</td>')
                                    .append('<td></td>')
                                    .append('<td></td>')
                                    .append('<td>'+formatuang(subtotal,'id-ID','IDR')+'</td>')
                                    .append('</tr>');
                            },      
                        },
                        initComplete: function(settings, json) {
                            $.each(json.data, function (index,element) {
                                totalbarangkeluar += element.JUMLAHRETUR;
                                totalhargabeli += element.HARGABELI;
                                totalpotongan += element.POTONGAN;
                                totalppn += element.PPN;
                                subtotal += ((element.JUMLAHRETUR  * element.HARGABELI) - element.POTONGAN + element.PPN);
                            });
                            
                        },
                        footerCallback: function( tfoot, data, start, end, display ) {   
                            setTimeout(function() {
                                let $td = $(tfoot).find('th'); 
                                $td.eq(1).html(totalbarangkeluar.toFixed(2));
                                $td.eq(2).html(formatuang(totalhargabeli,'id-ID','IDR'));
                                $td.eq(3).html(formatuang(totalpotongan,'id-ID','IDR'));
                                $td.eq(4).html(formatuang(totalppn,'id-ID','IDR'));
                                $td.eq(7).html(formatuang(subtotal,'id-ID','IDR'));
                            },500)
                        }
                    });
                });
                }else if (controllerReport == "returpembelianperfaktur"){ 
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
                                "url": baseurljavascript + 'laporan/formatlaporanreturpembelian',
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
                                    $td.eq(1).html(response.jumlahitem+" Item");
                                    $td.eq(2).html(response.totalpotongan);
                                    $td.eq(3).html(response.totalsubtotal);
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
<?= $this->include('laporan/pembelian/format_laporanreturpembelian') ?>
<?= $this->endSection(); ?>