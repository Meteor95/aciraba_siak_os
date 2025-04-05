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
                            <!-- END Form Group -->
                            <!-- BEGIN Form Group -->
                            <div class="form-group row mb-3">
                                <label for="inputAddress1" class="col-sm-2 col-form-label">Cara Bayar</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <div class="input-group-icon">
                                    <select id="laporan_penjualan_carabayar" class="selectpicker" data-live-search="true">
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
                                <label for="laporan_penjualan_outlet" class="col-sm-2 col-form-label">Lokasi Outlet</label>
                                <div class="col-sm-10">
                                    <select id="laporan_penjualan_outlet" class="form-control cmblokasioutlet"><option value="<?= session('outlet');?>">Lokasi Saat Ini</option></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_penjualan_customer" class="col-sm-2 col-form-label">Customer</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_penjualan_customer" class="form-control" data-live-search="true"></select>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_penjualan_barang" class="col-sm-2 col-form-label">Barang</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_penjualan_barang" class="form-control" data-live-search="true"></select>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_penjualan_kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_penjualan_kategori" class="form-control" data-live-search="true"></select>
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
                                    <a onclick="panggilreportreturpenjualanformat('returpenjualanperfaktur')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
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
                                    <a onclick="panggilreportreturpenjualanformat('returpenjualanperfakturdetail')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
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
    $('#laporan_penjualan_customer').select2({
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
    $('#laporan_penjualan_barang').select2({
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
    $('#laporan_penjualan_kategori').select2({
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
});
function panggilreportreturpenjualanformat(controllerReport,jenisformatjikasama){
    let title = "",text = "";
    if (controllerReport == "returpenjualanperfaktur"){ 
        title = "FORMAT 1 [Laporan Retur Penjualan Per Faktur]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 1. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "returpenjualanperfakturdetail"){ 
        title = "FORMAT 2 [Laporan Retur Penjualan Detail]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 2. Pastikan periode / outlet sesuai dengan yang diinginkan";
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
            $(".tanggal_perfaktur").html($("#laporan_penjualan_tanggalwal").val() + " s.d "+$("#laporan_penjualan_tanggalakhir").val());
            $(".carabayar_perfaktur").html(($("#laporan_penjualan_carabayar").val() == "" ? "SEMUA" : $("#laporan_penjualan_carabayar").val() ));
            $(".pelanggan_perfaktur").html(($("#laporan_penjualan_customer").val() == null ? "SEMUA" : $("#laporan_penjualan_customer").val() ));
            $(".outletterpilih_perfaktur").html(($("#laporan_penjualan_outlet").val() == null ? "SEMUA" : $("#laporan_penjualan_outlet").val() ));
            $(".barang_perfaktur").html(($("#laporan_penjualan_barang").val() == null ? "SEMUA" : $("#laporan_penjualan_barang").val() ));
            $(".kategori_perfaktur").html(($("#laporan_penjualan_kategori").val() == null ? "SEMUA" : $('#laporan_penjualan_kategori').select2('data')[0].text ));
            setTimeout(function() {
                let totalbarangkeluar = 0,totalppn =0,totalhargabeli=0,totalhargajual=0,totalselisih =0;
                if (controllerReport == "returpenjualanperfakturdetail"){ 
                    getCsrfTokenCallback(function() {
                        let table = $("#tabel_laporan_"+controllerReport).DataTable({
                            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
                            scrollCollapse: true,
                            scrollY: "100%",
                            scrollX: true,
                            ordering: false,
                            destroy: true,
                            pageLength: -1,
                            ajax: {
                                "url": baseurljavascript + 'laporan/formatlaporanreturpenjualannodatatables',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.PERIODEAWAL = $("#laporan_penjualan_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_penjualan_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_penjualan_carabayar").val();
                                    d.OUTLET = $("#laporan_penjualan_outlet").val();
                                    d.IDPELANGGAN = $("#laporan_penjualan_customer").val();
                                    d.KODEBARANG = $("#laporan_penjualan_barang").val();
                                    d.KODEKATEGORI = $("#laporan_penjualan_kategori").val();
                                    d.KONDISI = controllerReport
                                }
                            },
                            columns: [
                                { "title": "",data: "KODEBARANG" },
                                { "title": "",data: "NAMABARANG" },
                                { "title": "",data: "TANGGALRETUR" },
                                { "title": "",data: "JUMLAHRETUR" },
                                { "title": "",data: "PPN" },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return "@HB : "+formatuang((row.HARGABELI),'id-ID','IDR')+"<br>Σ SUB : "+formatuang((row.HARGABELI * row.JUMLAHRETUR),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return "@HJ : "+formatuang((row.HARGAJUAL),'id-ID','IDR')+"<br>Σ SUB : "+formatuang((row.HARGAJUAL * row.JUMLAHRETUR),'id-ID','IDR');
                                    },
                                },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return "Σ SUB HB : "+formatuang((row.HARGABELI * row.JUMLAHRETUR),'id-ID','IDR')+"<br>"
                                        +"Σ SUB HJ : "+formatuang(((row.HARGAJUAL * row.JUMLAHRETUR) + row.PPN),'id-ID','IDR')+"<br>"
                                        +"Σ SUB SELISIH : "+formatuang((((row.HARGAJUAL * row.JUMLAHRETUR) + row.PPN)) - (row.HARGABELI * row.JUMLAHRETUR) < 0 ? (((((row.HARGAJUAL * row.JUMLAHRETUR) + row.PPN)) - (row.HARGABELI * row.JUMLAHRETUR)) * -1) : (((row.HARGAJUAL * row.JUMLAHRETUR) + row.PPN)) - (row.HARGABELI * row.JUMLAHRETUR),'id-ID','IDR');
                                    },
                                },
                            ],
                            rowGroup: {
                                dataSrc:function(row) {
                                return row.NOTRXRETUR;
                                },
                                startRender: function ( rows, group ) {
                                    return $('<tr style="color:red">')
                                        .append("<td style='vertical-align : middle;'>Nama Kasir : "+rows.data()[0].NAMAPENGGUNA+"<br>No Transaksi : "+group+"<br>Kode Item</td>")
                                        .append("<td style='vertical-align : middle;'>Nama Pelanggan : " + rows.data()[0].NAMA +"<br>Nama Item</td>")
                                        .append("<td style='vertical-align : middle;'>Tanggal Trx</td>")
                                        .append("<td style='vertical-align : middle;'>Σ Item</td>")
                                        .append("<td style='vertical-align : middle;'>Σ PPN</td>")
                                        .append("<td style='vertical-align : middle;'>Σ Harga Beli</td>")
                                        .append("<td style='vertical-align : middle;'>Σ Harga Jual</td>")
                                        .append("<td style='vertical-align : middle;'>Sub Total</td>")
                                        .append('</tr>');
                                },
                                endRender: function ( rows, group ) {
                                    let totalbarangkeluar = 0,totalppn =0,totalhargabeli=0,totalhargajual=0,totalselisih =0;
                                    $.each(rows.data(), function (index,element) {
                                        totalbarangkeluar += element.JUMLAHRETUR;
                                        totalppn += element.PPN;
                                        totalhargabeli += (element.HARGABELI * element.JUMLAHRETUR);
                                        totalhargajual += (element.HARGAJUAL * element.JUMLAHRETUR) + element.PPN;
                                        totalselisih += ((((element.HARGAJUAL * element.JUMLAHRETUR) + element.PPN) - (element.HARGABELI * element.JUMLAHRETUR)) < 0 ? ((((element.HARGAJUAL * element.JUMLAHRETUR) + element.PPN) - (element.HARGABELI * element.JUMLAHRETUR))) * -1 : ((((element.HARGAJUAL * element.JUMLAHRETUR) + element.PPN) - (element.HARGABELI * element.JUMLAHRETUR))) )
                                    });
                                    return $('<tr style="color:red">')
                                        .append("<td colspan='3' style='text-align: right;'>SUB TOTAL</td>")
                                        .append('<td>'+totalbarangkeluar.toFixed(2)+'</td>')
                                        .append('<td>'+formatuang(totalppn,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalhargabeli,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalhargajual,'id-ID','IDR')+'</td>')
                                        .append('<td>Σ SUB HB : '+formatuang(totalhargabeli,'id-ID','IDR')+'<br>Σ SUB HJ : '+formatuang(totalhargajual,'id-ID','IDR')+'<br>Σ SUB SELISIH : '+formatuang(totalselisih,'id-ID','IDR')+'</td>')
                                        .append('</tr>');
                                },      
                            },
                            initComplete: function(settings, json) {
                                $.each(json.data, function (index,element) {
                                    totalbarangkeluar += element.JUMLAHRETUR;
                                    totalppn += element.PPN;
                                    totalhargabeli += (element.HARGABELI * element.JUMLAHRETUR);
                                    totalhargajual += (element.HARGAJUAL * element.JUMLAHRETUR) + element.PPN;
                                    totalselisih += ((((element.HARGAJUAL * element.JUMLAHRETUR) + element.PPN) - (element.HARGABELI * element.JUMLAHRETUR)) < 0 ? ((((element.HARGAJUAL * element.JUMLAHRETUR) + element.PPN) - (element.HARGABELI * element.JUMLAHRETUR))) * -1 : ((((element.HARGAJUAL * element.JUMLAHRETUR) + element.PPN) - (element.HARGABELI * element.JUMLAHRETUR))) )
                                });
                                
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {   
                                setTimeout(function() {
                                    let $td = $(tfoot).find('th'); 
                                    $td.eq(1).html(totalbarangkeluar.toFixed(2));
                                    $td.eq(2).html(formatuang(totalppn,'id-ID','IDR'));
                                    $td.eq(3).html(formatuang(totalhargabeli,'id-ID','IDR'));
                                    $td.eq(4).html(formatuang(totalhargajual,'id-ID','IDR'));
                                    $td.eq(5).html('Σ SUB HB : '+formatuang(totalhargabeli,'id-ID','IDR')+'<br>Σ SUB HJ : '+formatuang(totalhargajual,'id-ID','IDR')+'<br>Σ SUB SELISIH : '+formatuang(totalselisih,'id-ID','IDR'));
                                },500)
                            }
                        });
                    });
                }else if (controllerReport == "returpenjualanperfaktur"){ 
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
                                "url": baseurljavascript + 'laporan/formatlaporanreturpenjualan',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.PERIODEAWAL = $("#laporan_penjualan_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_penjualan_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_penjualan_carabayar").val();
                                    d.OUTLET = $("#laporan_penjualan_outlet").val();
                                    d.IDPELANGGAN = $("#laporan_penjualan_customer").val();
                                    d.KODEBARANG = $("#laporan_penjualan_barang").val();
                                    d.KODEKATEGORI = $("#laporan_penjualan_kategori").val();
                                    d.KONDISI = controllerReport
                                }
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {    
                                let response = this.api().ajax.json();
                                let $td = $(tfoot).find('th');
                                if(response){
                                    $td.eq(1).html(response.totalitem);
                                    $td.eq(2).html(response.totalppn);
                                    $td.eq(3).html(response.subtotalhb);
                                    $td.eq(4).html(response.subtotalhj);
                                    $td.eq(5).html(response.subtotalselisih);
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
<?= $this->include('laporan/penjualan/format_laporanreturpenjualan') ?>
<?= $this->endSection(); ?>