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
                                <label for="laporan_penjualan_supplier" class="col-sm-2 col-form-label">Suplier</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_penjualan_supplier" class="form-control" data-live-search="true"></select>
                                    <!-- END Input Group -->
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_penjualan_groumember" class="col-sm-2 col-form-label">Group Customer</label>
                                <div class="col-sm-10">
                                    <!-- BEGIN Input Group -->
                                    <select id="laporan_penjualan_groumember" class="form-control" data-live-search="true"></select>
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
                                        <p>Laporan Jual Per Faktur</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <a onclick="panggilreportpenjualanformat('penjualanperfaktur')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-green">
                                    <div class="inner">
                                        <h3>Format 2</h3>
                                        <p>Laporan Jual Per Barang</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-boxes-stacked"></i>
                                    </div>
                                    <a onclick="panggilreportpenjualanformat('penjualanperbarang')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-orange">
                                    <div class="inner">
                                        <h3>Format 3</h3>
                                        <p>Laporan Omset Per Pelangan</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-users-between-lines"></i>
                                    </div>
                                    <a onclick="panggilreportpenjualanformat('penjualanperpelanggan')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-red">
                                    <div class="inner">
                                        <h3>Format 4</h3>
                                        <p>Laporan Rekap Jual Per Kasir</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-cash-register"></i>
                                    </div>
                                    <a onclick="panggilreportpenjualanformat('penjualanperkasir')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-success">
                                    <div class="inner">
                                        <h3>Format 5</h3>
                                        <p>Laporan Penjualan Detail</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-book-journal-whills"></i>
                                    </div>
                                    <a onclick="panggilreportpenjualanformat('penjualandetailnota','notapenjualan')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-secondary">
                                    <div class="inner">
                                        <h3>Format 6</h3>
                                        <p>Laporan Jual Per Tanggal Detail </p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-calendar-days"></i>
                                    </div>
                                    <a onclick="panggilreportpenjualanformat('penjualandetailtanggal','tanggal')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-primary">
                                    <div class="inner">
                                        <h3>Format 7</h3>
                                        <p>Laporan Jual Per Jenis Transaksi</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-credit-card"></i>
                                    </div>
                                    <a onclick="panggilreportpenjualanformat('penjualanperjenistransaksi')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-red">
                                    <div class="inner">
                                        <h3>Format 8</h3>
                                        <p>Laporan Jual Per Tanggal</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <a onclick="panggilreportpenjualanformat('penjualanpertanggal')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
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
    $('#laporan_penjualan_supplier').select2({
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
    $('#laporan_penjualan_groumember').select2({
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
function panggilreportpenjualanformat(controllerReport,jenisformatjikasama){
    let title = "",text = "";
    if (controllerReport == "penjualanperfaktur"){ 
        title = "FORMAT 1 [Laporan Per Faktur]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 1. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "penjualanperbarang"){ 
        title = "FORMAT 2 [Laporan Per Barang]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 2. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "penjualanperpelanggan"){ 
        title = "FORMAT 3 [Laporan Per Pelanggan]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 3. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "penjualanperkasir"){ 
        title = "FORMAT 4 [Laporan Per Kasir]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 4. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "penjualandetailnota"){ 
        title = "FORMAT 5 [Laporan Detail Per Nota]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 5. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "penjualandetailtanggal"){ 
        title = "FORMAT 6 [Laporan Detail Per Tanggal]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 6. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "penjualanperjenistransaksi"){ 
        title = "FORMAT 7 [Laporan Detail Per Jenis Pembayaran]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 7. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "penjualanpertanggal"){ 
        title = "FORMAT 8 [Laporan Detail Per Tanggal]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 8. Pastikan periode / outlet sesuai dengan yang diinginkan";
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
            $(".suplier_perfaktur").html(($("#laporan_penjualan_supplier").val() == null ? "SEMUA" : $("#laporan_penjualan_supplier").val() ));
            $(".group_perfaktur").html(($("#laporan_penjualan_groumember").val() == null ? "SEMUA" : $("#laporan_penjualan_groumember").val() ));
            $(".kategori_perfaktur").html(($("#laporan_penjualan_kategori").val() == null ? "SEMUA" : $('#laporan_penjualan_kategori').select2('data')[0].text ));
            setTimeout(function() {
                if (controllerReport == "penjualandetailnota" || controllerReport == "penjualandetailtanggal"){ 
                    // karena 1 format cuma beda groupby tanggal saja
                    if (controllerReport == "penjualandetailtanggal") { 
                        controllerReport = "penjualandetailnota"; 
                    } 
                    let collapsedGroups = {};
                    var totalkeluar = 0,totalpenjualan = 0,totalhpp = 0,totallaba = 0, satuan = "";
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
                            columnDefs: [
                                { "visible": false, "targets": 7 }
                            ],
                            ajax: {
                                "url": baseurljavascript + 'laporan/formatlaporanpenjualannodatatables',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.DIMANA2 = $("#daftaritem_katakunci_panggil").val();
                                    d.PERIODEAWAL = $("#laporan_penjualan_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_penjualan_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_penjualan_carabayar").val();
                                    d.OUTLET = $("#laporan_penjualan_outlet").val();
                                    d.IDPELANGGAN = $("#laporan_penjualan_customer").val();
                                    d.KODEBARANG = $("#laporan_penjualan_barang").val();
                                    d.KODESUPLIER = $("#laporan_penjualan_supplier").val();
                                    d.GROUPELANGGAN = $("#laporan_penjualan_groumember").val();
                                    d.KODEKATEGORI = $("#laporan_penjualan_kategori").val();
                                    d.KONDISI = controllerReport
                                }
                            },
                            columns: [
                                { "title": "",data: "FK_BARANG" },
                                { "title": "",data: "NAMABARANG" },
                                { "title": "",data: (jenisformatjikasama == "tanggal" ? "PK_NOTAPENJUALAN" : "NAMAKATEGORI" ) },
                                { "title": "",data: "TOTALKELUAR" },
                                { 
                                    "title": "",
                                    "render": function (data, type, row, meta) {
                                        return formatuang((row.HARGAJUAL + row.PAJAKTOKO + row.PAJAKNEGARA - row.POTONGANGLOBAL),'id-ID','IDR');
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
                                        return formatuang((row.HARGAJUAL + row.PAJAKTOKO + row.PAJAKNEGARA - row.POTONGANGLOBAL) - (row.HARGABELI),'id-ID','IDR');
                                    },
                                },
                                { "title": "",data: "PK_NOTAPENJUALAN" },
                            ],
                            rowGroup: {
                                dataSrc:function(row) {
                                    if (jenisformatjikasama == "notapenjualan") return row.PK_NOTAPENJUALAN;
                                    if (jenisformatjikasama == "tanggal") return row.TGLKELUAR;
                                },
                                startRender: function ( rows, group ) {
                                    let stringkolom1, stringkolom2, stringkolom3;
                                    if (jenisformatjikasama == "notapenjualan"){
                                        stringkolom1 = "<td style='vertical-align : middle;'>Waktu Trx : "+rows.data()[0].FULLWAKTU+"<br>No Trx : "+ group + "<br>Kode Item</td>"
                                        stringkolom2 = "<td style='vertical-align : middle;'>Nama Kasir : "+rows.data()[0].NAMAPENGGUNA+"<br>Nama Pelanggan : " + rows.data()[0].NAMA + "<br>Nama Item</td>"
                                        stringkolom3 = "<td style='vertical-align : middle;'>Kategori</td>"
                                    }else{
                                        stringkolom1 = "<td style='vertical-align : middle;'>Waktu Trx : "+group+"<br>Kode Item</td>"
                                        stringkolom2 = "<td style='vertical-align : middle;'>Nama Kasir : "+rows.data()[0].NAMAPENGGUNA+"<br>Nama Pelanggan : " + rows.data()[0].NAMA + "<br>Nama Item</td>"
                                        stringkolom3 = "<td style='vertical-align : middle;'>No Transaksi</td>"
                                    }
                                    return $('<tr style="color:red">')
                                        .append(stringkolom1)
                                        .append(stringkolom2)
                                        .append(stringkolom3)
                                        .append("<td style='vertical-align : middle;'>Σ Barang Keluar</td>")
                                        .append("<td style='vertical-align : middle;'>Σ Penjualan</td>")
                                        .append("<td style='vertical-align : middle;'>Σ Hpp</td>")
                                        .append("<td style='vertical-align : middle;'>Σ Laba</td>")
                                        .append('</tr>');
                                },
                                endRender: function ( rows, group ) {
                                    let totalkeluar = 0,totalpenjualan = 0,totalhpp = 0,totallaba = 0;
                                    $.each(rows.data(), function (index,element) {
                                        totalkeluar += element.STOKBARANGKELUAR;
                                        totalpenjualan += (element.HARGAJUAL * element.STOKBARANGKELUAR) + element.PAJAKTOKO + element.PAJAKNEGARA - element.POTONGANGLOBAL;
                                        totalhpp += element.HARGABELI;
                                        totallaba += (((element.HARGAJUAL  * element.STOKBARANGKELUAR) + element.PAJAKTOKO + element.PAJAKNEGARA - element.POTONGANGLOBAL) - element.HARGABELI);
                                        satuan = element.SATUAN;
                                    });
                                    return $('<tr style="color:red">')
                                        .append("<td colspan='3' style='text-align: right;vertical-align : middle;'>SUB TOTAL</td>")
                                        .append('<td>'+totalkeluar.toFixed(2)+' '+rows.data()[0].SATUAN +'</td>')
                                        .append('<td>'+formatuang(totalpenjualan,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totalhpp,'id-ID','IDR')+'</td>')
                                        .append('<td>'+formatuang(totallaba,'id-ID','IDR')+'</td>')
                                        .append('</tr>');
                                },      
                            },
                            initComplete: function(settings, json) {
                                $.each(json.data, function (index,element) {
                                    totalkeluar += element.STOKBARANGKELUAR;
                                    totalpenjualan += (element.HARGAJUAL * element.STOKBARANGKELUAR) + element.PAJAKTOKO + element.PAJAKNEGARA - element.POTONGANGLOBAL;
                                    totalhpp += element.HARGABELI;
                                    totallaba += (((element.HARGAJUAL  * element.STOKBARANGKELUAR) + element.PAJAKTOKO + element.PAJAKNEGARA - element.POTONGANGLOBAL) - element.HARGABELI);
                                });
                                
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {   
                                setTimeout(function() {
                                    let $td = $(tfoot).find('th'); 
                                    $td.eq(1).html(totalkeluar.toFixed(2)+" "+satuan);
                                    $td.eq(2).html(formatuang(totalpenjualan,'id-ID','IDR'));
                                    $td.eq(3).html(formatuang(totalhpp,'id-ID','IDR'));
                                    $td.eq(4).html(formatuang(totallaba,'id-ID','IDR'));
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
                                "url": baseurljavascript + 'laporan/formatlaporanpenjualan',
                                "type": "POST",
                                "data": function (d) {
                                    d.csrf_aciraba = csrfTokenGlobal;
                                    d.DIMANA2 = $("#daftaritem_katakunci_panggil").val();
                                    d.PERIODEAWAL = $("#laporan_penjualan_tanggalwal").val().split("-").reverse().join("-");
                                    d.PERIODEAKHIR = $("#laporan_penjualan_tanggalakhir").val().split("-").reverse().join("-");
                                    d.CARABAYAR = $("#laporan_penjualan_carabayar").val();
                                    d.OUTLET = $("#laporan_penjualan_outlet").val();
                                    d.IDPELANGGAN = $("#laporan_penjualan_customer").val();
                                    d.KODEBARANG = $("#laporan_penjualan_barang").val();
                                    d.KODESUPLIER = $("#laporan_penjualan_supplier").val();
                                    d.GROUPELANGGAN = $("#laporan_penjualan_groumember").val();
                                    d.KODEKATEGORI = $("#laporan_penjualan_kategori").val();
                                    d.KONDISI = controllerReport
                                }
                            },
                            footerCallback: function( tfoot, data, start, end, display ) {    
                                let response = this.api().ajax.json();
                                let $td = $(tfoot).find('th');
                                if(response){
                                    if (controllerReport == "penjualanperfaktur"){
                                        $td.eq(1).html(response.jumlahitem);
                                        $td.eq(2).html(response.subtotal);
                                        $td.eq(3).html(response.pajaktoko);
                                        $td.eq(4).html(response.pajaknegara);
                                        $td.eq(5).html(response.potonganglobal);
                                        $td.eq(6).html(response.jumlah);
                                    }else if (controllerReport == "penjualanperbarang"){
                                        $td.eq(1).html(response.jumlahitem);
                                        $td.eq(2).html(response.totaljual);
                                        $td.eq(3).html(response.totalbeli);
                                        $td.eq(4).html(response.totallaba);
                                    }else if (controllerReport == "penjualanperpelanggan"){
                                        $td.eq(1).html(response.tunai);
                                        $td.eq(2).html(response.uangmuka);
                                        $td.eq(3).html(response.kredit);
                                        $td.eq(4).html(response.kdebit);
                                        $td.eq(5).html(response.kkredit);
                                        $td.eq(6).html(response.emoney);
                                        $('tr:eq(1) th:eq(1)', this.api().table().footer()).html(response.grandtotal);
                                    }else if (controllerReport == "penjualanperjenistransaksi"){
                                        $td.eq(1).html(response.grandtotaljenistrasnaksi);
                                    }else if (controllerReport == "penjualanperkasir"){
                                        $td.eq(1).html(response.tunai);
                                        $td.eq(2).html(response.uangmuka);
                                        $td.eq(3).html(response.kredit);
                                        $td.eq(4).html(response.kdebit);
                                        $td.eq(5).html(response.kkredit);
                                        $td.eq(6).html(response.emoney);
                                        $td.eq(7).html(response.grandtotal);
                                    }else if (controllerReport == "penjualanpertanggal"){
                                        $td.eq(1).html(response.jumlahitem);
                                        $td.eq(2).html(response.pajaktoko);
                                        $td.eq(3).html(response.pajaknegara);
                                        $td.eq(4).html(response.potonganglobal);
                                        $td.eq(5).html(response.tunai);
                                        $td.eq(6).html(response.uangmuka);
                                        $td.eq(7).html(response.kredit);
                                        $td.eq(8).html(response.kdebit);
                                        $td.eq(9).html(response.kkredit);
                                        $td.eq(10).html(response.emoney);
                                        $td.eq(11).html(response.grandtotal);
                                    }
                                }
                            }
                        });
                    });
                }
            }, 100);
            if (controllerReport == "penjualandetailtanggal") { controllerReport = "penjualandetailnota"; } // karena 1 format cuma beda groupby tanggal saja
            $('#modal_'+controllerReport).modal('show');
        }
    })
}
</script>
<?= $this->include('laporan/penjualan/format_laporanpenjualan') ?>
<?= $this->endSection(); ?>