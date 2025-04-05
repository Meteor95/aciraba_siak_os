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
                            <div class="form-group row">
                                <label for="kodenamabarang" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <select id="kodenamabarang" class="form-control"></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="pilihperusahaan" class="col-sm-2 col-form-label">Pemilik Barang</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="pilihperusahaan"></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="pilihprincipal" class="col-sm-2 col-form-label">Principal</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="pilihprincipal"></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="pilihsuplier" class="col-sm-2 col-form-label">Suplier</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="pilihsuplier"></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="pilihkategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="pilihkategori"></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="pilihbrand" class="col-sm-2 col-form-label">Brand</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="pilihbrand"></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="stok" class="col-sm-2 col-form-label">Tampilkan Stok</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="stokawal_laporanmasteritem" type="text" class="form-control" placeholder="Parameter Stok Awal. Ex:-5">
                                        <div class="input-group-prepend input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </span>
                                        </div>
                                        <input id="stokakhir_laporanmasteritem" type="text" class="form-control" placeholder="Sampai Dengan. Ex:100">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="lokasistok" class="col-sm-2 col-form-label">Lokasi Stok</label>
                                <div class="col-sm-10">
                                    <select id="lokasistok" class="selectpicker" data-live-search="true">
                                        <option value="">Semua</option>
                                        <option value="D">Display</option>
                                        <option value="G">Gudang</option>
                                        <option value="R">Retur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_penjualan_kategori" class="col-sm-2 col-form-label">Outlet</label>
                                <div class="col-sm-10">
                                    <select id="laporan_penjualan_outlet" class="form-control cmblokasioutlet"><option value="<?= session('outlet');?>">Lokasi Saat Ini</option></select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="laporan_penjualan_kategori" class="col-sm-2 col-form-label">Status Barang</label>
                                <div class="col-sm-10">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label style="cursor:pointer"  id="btn-status-item-1" class="btn-status-item btn btn-flat-success active">
                                            <input value="1" type="radio" name="rb_statusbarangtambahitem" id="radio-button-1"> Barang Aktif </label>
                                        <label style="cursor:pointer"  id="btn-status-item-0" class="btn-status-item btn btn-flat-danger">
                                            <input value="0" type="radio" name="rb_statusbarangtambahitem" id="radio-button-2" >Barang Tidak Aktif </label>
                                        <label style="cursor:pointer"  id="btn-status-item-2" class="btn-status-item btn btn-flat-warning">
                                            <input value="" type="radio" name="rb_statusbarangtambahitem" id="radio-button-3" >Aktif dan Tidak Aktif </label>
                                    </div>
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
                                        <p>Laporan Format Persedian Stok</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-file-invoice"></i>
                                    </div>
                                    <a onclick="panggilreportmasterformat('masteritem_informasibarang')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-red">
                                    <div class="inner">
                                        <h3>Format 2</h3>
                                        <p>Laporan Format Stok Opname</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-boxes-stacked"></i>
                                    </div>
                                    <a onclick="panggilreportmasterformat('masteritem_stokopname')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card-box bg-green">
                                    <div class="inner">
                                        <h3>Format 3</h3>
                                        <p>Laporan Format Daftar Item</p>
                                    </div>
                                    <div class="icon">
                                        <i style="color:black;padding-bottom:27px" class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <a onclick="panggilreportmasterformat('masteritem_daftaritem')" href="javascript:void(0)" class="card-box-footer">Lihat Laporan <i class="fa fa-arrow-circle-right"></i></a>
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
    $('#kodenamabarang').select2({
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
    $('#pilihperusahaan').select2({
        allowClear: true,
        placeholder: 'Tentukan kepemilikan barang',
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
    $('#pilihprincipal').select2({
        allowClear: true,
        placeholder: 'Tentukan principal barang ini',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonprincipal',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    NAMAPRINCIPAL: (typeof params.term === "undefined" ? "" : params.term),
                    KODEUNIKMEMBER: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.kodeprincipal + "] " + item.namaperusahaan,
                            id: item.kodeprincipal,
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
        placeholder: 'Tentukan nama suplier terakhir',
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
    $('#pilihkategori').select2({
        allowClear: true,
        placeholder: 'Tentukan nama kategori',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonkategoriselect',
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
                            text: "[" + item.idkategori + "] " + item.namakategori,
                            id: item.idkategori,
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
    $('#pilihbrand').select2({
        allowClear: true,
        placeholder: 'Tentukan brand barang ini',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonpilihbrand',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    NAMABRAND: (typeof params.term === "undefined" ? "" : params.term),
                    KODEUNIKMEMBER: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.kodebrang + "] " + item.namabrand,
                            id: item.kodebrang,
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
    if (controllerReport == "masteritem_informasibarang"){ 
        title = "FORMAT 1 [Laporan Informasi Barang]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 1. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "masteritem_stokopname"){ 
        title = "FORMAT 2 [Laporan Cetak Format Stok Opname]"; 
        text = "Apakah anda yakin ingin mencetak laporan penjualan dengan FORMAT 2. Pastikan periode / outlet sesuai dengan yang diinginkan";
    }else if (controllerReport == "masteritem_daftaritem"){ 
        title = "FORMAT 3 [Laporan Daftar Item]"; 
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
            $(".pemilik_masteritem").html(($("#pilihperusahaan").val() == null ? "SEMUA" : $("#pilihperusahaan").html() ));
            $(".pricipal_masteritem").html(($("#pilihprincipal").val() == null ? "SEMUA" : $("#pilihprincipal").html() ));
            $(".suplier_masteritem").html(($("#pilihsuplier").val() == null ? "SEMUA" : $("#pilihsuplier").html() ));
            $(".kategori_masteritem").html(($("#pilihkategori").val() == null ? "SEMUA" : $("#pilihkategori").html() ));
            $(".brand_masteritem").html(($("#pilihbrand").val() == null ? "SEMUA" : $("#pilihbrand").html() ));
            $(".tampilkan_masteritem").html(($("#stokawal_laporanmasteritem").val() == "" ? "SEMUA" : $("#stokawal_laporanmasteritem").val() )+" s.d "+($("#stokakhir_laporanmasteritem").val() == "" ? "SEMUA" : $("#stokakhir_laporanmasteritem").val() ));
            $(".lokasi_masteritem").html($("#lokasistok").find('option:selected').text());
            $(".status_masteritem").html(($("input[name=rb_statusbarangtambahitem]:checked").parent().text().trim() == "" ? "Barang Aktif" : $("input[name=rb_statusbarangtambahitem]:checked").parent().text().trim()));
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
                            "url": baseurljavascript + 'laporan/formatlaporanmaster',
                            "type": "POST",
                            "data": function (d) {
                                d.csrf_aciraba = csrfTokenGlobal;
                                d.KODENAMABARANG = $("#kodenamabarang").val();
                                d.KODEPERUSAHAAN = $("#pilihperusahaan").val();
                                d.KODEPINCIPAL = $("#pilihprincipal").val();
                                d.KODEUSUPLIER = $("#pilihsuplier").val();
                                d.KODEKATEGORI = $("#pilihkategori").val();
                                d.KODEBRAND = $("#pilihbrand").val();
                                d.KODEOUTLET = $("#laporan_penjualan_outlet").val();
                                d.STOKAWAL =  $("#stokawal_laporanmasteritem").val();
                                d.STOKAKHIR =  $("#stokakhir_laporanmasteritem").val();
                                d.LOKASISTOK =  $("#lokasistok").val();
                                d.STATUSBARANG =  (typeof $('input[name=rb_statusbarangtambahitem]:checked').val() === "undefined" ? "1" : $('input[name=rb_statusbarangtambahitem]:checked').val());
                                d.KONDISI = controllerReport
                            }
                        },
                        footerCallback: function( tfoot, data, start, end, display ) {   
                            let response = this.api().ajax.json();
                            let $td = $(tfoot).find('th'); 
                            var rowCount = $(tfoot).find('tr').length;
                            $(".totalpersediaanpokok").html(" Menghitung....");
                            $(".totalpersediaanjual").html(" Menghitung....");
                            $(".perkiraanlabakotor").html(" Menghitung....");
                            if (controllerReport == "masteritem_informasibarang"){
                                $td.eq(1).html("Rp 0");
                                $td.eq(2).html("Rp 0");
                                $td.eq(3).html(0);
                                $td.eq(4).html(0);
                                $td.eq(5).html(0);
                                $td.eq(6).html(0);
                            }else if (controllerReport == "masteritem_stokopname"){
                                $td.eq(1).html(0);
                                $td.eq(3).html(0);
                                $td.eq(5).html(0);
                            }
                            if(response){
                                if (controllerReport == "masteritem_informasibarang"){
                                    $td.eq(1).html(response.sumhargabeli);
                                    $td.eq(2).html(response.sumhargajual);
                                    $td.eq(3).html(response.sumdisplay);
                                    $td.eq(4).html(response.sumgudang);
                                    $td.eq(5).html(response.sumretur);
                                    $td.eq(6).html(response.sumsubtotalstok);
                                }else if (controllerReport == "masteritem_stokopname"){
                                    $td.eq(1).html(response.sumdisplay);
                                    $td.eq(3).html(response.sumgudang);
                                    $td.eq(5).html(response.sumretur);
                                }else if (controllerReport == "masteritem_daftaritem"){
                                    $td.eq(1).html("HARGA BELI : "+response.sumhargabeli+"<br>HARGA JUAL : "+response.sumhargajual);
                                    $td.eq(3).html(response.sumdisplay);
                                    $td.eq(4).html(response.sumgudang);
                                    $td.eq(5).html(response.sumretur);
                                    $td.eq(6).html(response.sumsubtotalstok);
                                }
                                $(".totalpersediaanpokok").html(response.totalpersedianpokok);
                                $(".totalpersediaanjual").html(response.totalpersedianjual);
                                $(".perkiraanlabakotor").html(response.perkiraanlaba);
                            }
                        }
                    });
                });
            }, 100);
            $('#modal_'+controllerReport).modal('show');
        }
    })
}
</script>
<?= $this->include('laporan/master/format_laporanmaster') ?>
<?= $this->endSection(); ?>