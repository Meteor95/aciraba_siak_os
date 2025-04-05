<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">
                            <a href="<?= base_url() ;?>penyesuaian/formmutasiitem"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Tambah Mutasi Item</button></a>
                            <button id="pencariandata" class="btn btn-success float-right"> <i class="fas fa-search"></i> Proses Data</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <p class="text-center">Mutasi Stock adalah perpindahan item atau barang dari satu tempat penyimpanan menuju tempat penyimpanan lain. Suatu contoh untuk mutasi barang dari gudang menuju toko maka secara otomatis stock yang ada pada gudang akan berkurang dan stock yang ada di toko akan bertambah.</p>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="parameterpencarian">Parameter Pencarian</label>
                                <select id="parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option value="notrx">No Transakasi</option>
                                    <option value="kodeitem">Kode Item</option>
                                    <option value="namaitem">Nama Barang</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="katakuncipencarian">Kata Kunci</label>
                                <input type="text" class="form-control" id="katakuncipencarian"
                                    placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input id="tanggalawal" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="tanggalakhir" type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input onclick="tampilkanformarus()" type="checkbox" class="custom-control-input" id="aktifkanbestbuy">
                            <label class="custom-control-label" for="aktifkanbestbuy">Arus Mutasi</label>
                        </div>
                        <!-- END Form Row -->
                        <div id="arusmutasipanel" class="mt-2 row portlet-row-fill-md h-100">
                            <div class="col-md-12 col-xl-12">
                                <!-- BEGIN Portlet -->
                                <div class="portlet portlet-primary">
                                    <div class="portlet-header">
                                        <div class="portlet-icon">
                                            <i class="fa fa-box"></i>
                                        </div>
                                        <h3 class="portlet-title">Pencarian Berdasarkan Arus Mutasi</h3>
                                    </div>
                                    <div class="portlet-body">
                                        <!-- BEGIN Portlet -->
                                        <div class="portlet mb-2">
                                            <div class="portlet-body">
                                                <!-- BEGIN Widget -->
                                                <div class="widget5">
                                                    <h4 class="widget5-title"></h4>
                                                    <div class="widget5-group">
                                                        <div class="widget5-item mr-2">
                                                            <span class="widget5-info">Asal Outlet</span>
                                                            <span class="widget5-value"><select class="form-control" id="cmblokasioutletasal"></select></span>
                                                        </div>
                                                        <div class="widget5-item mr-2">
                                                            <span class="widget5-info">Lokasi Asal Item</span>
                                                            <span class="widget5-value"><select id="lokasiitemasal" class="selectpicker" data-live-search="true">
                                    <option value="D"> Ambil Dari Display</option>
                                    <option value="G"> Ambil Dari Gudang</option>
                                    <option value="R"> Ambil Dari Retur</option>
                                </select></span>
                                                        </div>
                                                        <div class="widget5-item mr-2">
                                                            <span class="widget5-info"> Tujuan Outlet</span>
                                                            <span class="widget5-value"><select class="form-control" id="cmblokasioutlettujuan"></select></span>
                                                        </div>
                                                        <div class="widget5-item mr-2">
                                                            <span class="widget5-info">Lokasi Tujuan Item</span>
                                                            <span class="widget5-value"><select id="lokasiitemtujuan" class="selectpicker" data-live-search="true">
                                    <option value="D"> Pindah Ke Display</option>
                                    <option value="G"> Pindah Ke Gudang</option>
                                    <option value="R"> Pindah Ke Retur</option>
                                </select></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Widget -->
                                            </div>
                                        </div>
                                        <!-- END Portlet -->
                                    </div>
                                </div>
                                <!-- END Portlet -->
                            </div>
                        </div>
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="daftarmutasiitem" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Nomor Mutasi</th>
                                    <th>Total Mutasi</th>
                                    <th>Total Nominal Mutasi</th>
                                    <th>Petugas</th>
                                    <th>Tanggal Trx</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Nomor Mutasi</th>
                                    <th>Total Mutasi</th>
                                    <th>Total Nominal Mutasi</th>
                                    <th>Petugas</th>
                                    <th>Tanggal Trx</th>
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
<div class="modal fade" id="detailmutasi">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Mutasi No Faktur <span id="nofakturmutasi"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- BEGIN Datatable -->
                <table id="tabeldetailmutasi" class="dataTable table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Unit</th>
                            <th>Stok Awal</th>
                            <th>Stok Mutasi</th>
                            <th>Nominal</th>
                            <th>Asal Oulet</th>
                            <th>Asal Lokasi</th>
                            <th>Tujuan Outlet</th>
                            <th>Tujuan Lokasi</th>
                            <th>Subtotal Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Unit</th>
                            <th>Stok Awal</th>
                            <th>Stok Mutasi</th>
                            <th>Nominal</th>
                            <th>Asal Oulet</th>
                            <th>Asal Lokasi</th>
                            <th>Tujuan Outlet</th>
                            <th>Tujuan Lokasi</th>
                            <th>Subtotal Nominal</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- END Datatable -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$("#arusmutasipanel").hide();
$('#tanggalawal').val(moment().startOf('month').format('DD-MM-YYYY'));
$("#tanggalawal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
$('#tanggalakhir').val(moment().format('DD-MM-YYYY'));
$("#tanggalakhir").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
getCsrfTokenCallback(function() {
    $("#daftarmutasiitem").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        scrollY: "100vh",
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [{
                className: "text-right",
                targets: [3]
            },
        ],
        ajax: {
            "url": baseurljavascript + 'penyesuaian/ajaxdaftarmutasi',
            "type": "POST",
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.DIMANA3 = $("#parameterpencarian").val();
                d.DIMANA4 = $("#katakuncipencarian").val();
                d.DIMANA5 = $("#tanggalawal").val().split("-").reverse().join("-");
                d.DIMANA6 = $("#tanggalakhir").val().split("-").reverse().join("-");
                d.DIMANA7 = document.getElementById('aktifkanbestbuy').checked == true ? "true" : "false";
                d.DIMANA8 = $("#cmblokasioutletasal").val();
                d.DIMANA9 = $("#lokasiitemasal").val();
                d.DIMANA10 = $("#cmblokasioutlettujuan").val();
                d.DIMANA11 = $("#lokasiitemtujuan").val();

            }
        }
    });
});
$("#parameterpencarian, #katakuncipencarian, #tanggalawal, #tanggalakhir, #aktifkanbestbuy").on('keyup input propertychange paste click', debounce(function(e) {
    getCsrfTokenCallback(function() {
        $('#daftarmutasiitem').DataTable().ajax.reload();
    });
}, 500))
$('#cmblokasioutletasal').select2({
    allowClear: true,
    placeholder: 'Tentukan Asal Outlet ?',
    ajax: {
        url: baseurljavascript + 'auth/outlet',
        method: 'POST',
        dataType: 'json',
        delay: 500,
        data: function (params) {
            return {
                KATAKUNCIPENCARIAN: "",
                KODEUNIKMEMBER: session_kodeunikmember,
            }
        },
        processResults: function (data) {
            parseJSON = JSON.parse(data);
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "OUTLET : " + item.group+" ["+item.namaoutlet+"] ",
                        id: item.group,
                    }
                })
            }
        }
    },
});
$('#cmblokasioutlettujuan').select2({
    allowClear: true,
    placeholder: 'Tentukan Tujuan Outlet ?',
    ajax: {
        url: baseurljavascript + 'auth/outlet',
        method: 'POST',
        dataType: 'json',
        delay: 500,
        data: function (params) {
            return {
                csrf_aciraba: csrfTokenGlobal,
                KATAKUNCIPENCARIAN: "",
                KODEUNIKMEMBER: session_kodeunikmember,
            }
        },
        processResults: function (data) {
            parseJSON = JSON.parse(data);
            getCsrfTokenCallback(function() {});
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "OUTLET : " + item.group+" ["+item.namaoutlet+"] ",
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
function tampilkanformarus(){
    if (document.getElementById('aktifkanbestbuy').checked) {
        $("#arusmutasipanel").show();
    }else{
        $("#arusmutasipanel").hide();
    }
}
$("#pencariandata").on("click", function () {
    getCsrfTokenCallback(function() {
        $('#daftarmutasiitem').DataTable().ajax.reload();
    }); 
});
function panggildetailmutasi(nofakturmutasi){
    $('#nofakturmutasi').html(nofakturmutasi);
    getCsrfTokenCallback(function() {
        $("#tabeldetailmutasi").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            scrollX: true,
            scrollCollapse: true,
            searching: true,
            stateSave: true,
            bDestroy: true,
            ajax: {
                "url": baseurljavascript + 'penyesuaian/daftardetailmutasi',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.DIMANA1 = nofakturmutasi;
                }
            },
        });
    }); 
    $('#detailmutasi').modal('show');
}
</script>
<?= $this->endSection(); ?>