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
                            <a href="<?= base_url() ;?>masterdata/daftaritemdetail"> <button id="" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah Item</button></a>
                            <button id="bulkinsert" class="btn btn-primary float-right"> <i class="fas fa-dolly-flatbed"></i> Tambah Item Masa [Bulk Insert]</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <div class="form-row">
                            <div class="col-md-9 mb-1 col-sm-12">
                            <p align="justify">Master barang adalah daftar barang-barang yang akan dipakai dalam transaksi
                            akuntansi, Ada barang yang dipakai sebagai aktiva kemudian mengalami penyusutan, ada barang
                            yang langsung dianggap sebagai beban/biaya, ada barang yang masuk di dalam inventory dan ada
                            barang yang akan dijual lagi</p>
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                            <p align="justify"><b>Total Jenis Barang : <?=$totalstok;?> Jenis<br>
                            Data ditampilkan : 500 Max Data<br>
                            Lihat Total Stok : <a href="javascript:void(0)"> Klik Disini </a>
                            </br></p>
                            </div>
                        </div>
                        
                        <hr>
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-3 mb-3 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="kodeitemdiskon">Parameter Pencarian</label>
                                <select id="daftaritem_parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option value="Nama Item">Nama Item</option>
                                    <option value="Kode Item">Kode Item</option>
                                    <option value="Principal">Principal</option>
                                    <option value="Kategori Item">Kategori Item</option>
                                    <option value="Brand">Brand</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="daftaritem_katakunci">Kata Kunci</label>
                                <input name="daftaritem_katakunci" type="text" class="form-control" id="daftaritem_katakunci"
                                    placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label for="statusbarang">Status Barang Ditampilkan</label><br>
                                <div id="statusbarang" class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-flat-success active">
                                        <input type="radio" name="rb_statusbarang" value="1" id="rb_barangaktif" checked="checked">
                                        Barang Aktif </label>
                                    <label class="btn btn-flat-danger">
                                        <input type="radio" name="rb_statusbarang" value="0" id="rb_barangtidakaktif"> Barang
                                        Tidak Aktif </label>
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <!-- BEGIN Datatable -->
                        <table id="masteritem_daftaritem" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th align="center">Aksi</th>
                                    <th>D</th>
                                    <th>G</th>
                                    <th>R</th>
                                    <th>Σ</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Pareto</th>
                                    <th>Kategori</th>
                                    <th>Brand</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th align="center">Aksi</th>
                                    <th>D</th>
                                    <th>G</th>
                                    <th>R</th>
                                    <th>Σ</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Pareto</th>
                                    <th>Kategori</th>
                                    <th>Brand</th>
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
<div class="modal fade" id="modalbulkinsert" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulir Penambahan Barang Bersamaan</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <p><b style="color:red">CATATAN: </b>Informasi GROSIR dan CITRA tidak dapat dilakukan di bulk insert dengan alasan PERFORMA Aplikasi. Silahkan konfirgurasi pada masing masing item yang di pilih. Sistem akan mengabaikan kodeitem jika kodeitem yang dimasukkan sudah ada pada database daftar item</p>
            <div class="row mb-3">
                <div class="col">
                    <div class="input-group">
                        <input type="text" id="kodebarang" class="form-control" placeholder="Masukkan Kode Barang Produk">
                        <div class="input-group-prepend">
                            <span id="generateiditem" class="input-group-text btn-warning btn">Generate ID</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <input type="text" id="kodebarangqrcode" class="form-control" placeholder="Masukkan Kode QR barang jika tersedia">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <input type="text" id="namabarang" class="form-control" placeholder="Masukan nama barang">
                </div>
                <div class="col">
                    <div class="input-group">
                        <input id="beratbarang" type="text"
                            class="form-control" placeholder="Masukan berat barang">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Gram [gr]</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <select class="form-control" id="pilihprincipalbulk"></select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select class="form-control" id="pilihsuplierbulk"></select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select class="form-control" id="pilihbrandbulk"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <select class="form-control" id="pilihkategoribulk"></select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select class="form-control" id="pilihsatuanbulk"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <select class="form-control" id="pilihperusahaanbulk"></select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="aktifkanbestbuy">
                        <label class="custom-control-label" for="aktifkanbestbuy">Aktifkan Best Buy</label>
                    </div>
                </div>
                <div class="col">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="barangbukanstok">
                        <label class="custom-control-label" for="barangbukanstok">Barang Ini Bukan Stok [Jasa]</label>
                    </div>                        
                </div>
                <div class="col">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="stokdapatminus">
                        <label class="custom-control-label" for="stokdapatminus">Stok Dapat Minus</label>
                    </div>
                </div>
            </div>
            <button onclick="tambahkegrid()" class="btn btn-block btn-primary"><i class="fas fa-plus"></i> Tambah Ke Daftar</button>
            <hr>
            <table id="bulkinsert_tabel" class="hovercolor table table-bordered table-striped table-hover nowrap">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Kode Item</th>
                        <th>QR Code</th>
                        <th>Nama Item</th>
                        <th>Berat Barang</th>
                        <th>Kode Principal</th>
                        <th>Nama Principal</th>
                        <th>Kode Suplier</th>
                        <th>Nama Suplier</th>
                        <th>Kode Brand</th>
                        <th>Nama Brand</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Satuan</th>
                        <th>Kode Perusahaan</th>
                        <th>Nama Perusahaan</th>
                        <th>Best Buy</th>
                        <th>Barang Jasa</th>
                        <th>Stok Dapat Minus</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button id="simpanbulk" class="btn btn-block btn-primary"><i class="fas fa-plus"></i> Simpan Bulk Item</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>scripts/masterdata/masteritem.js"></script>
<script>
$(document).ready(function () {
getCsrfTokenCallback(function() {
    $("#masteritem_daftaritem").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        columnDefs: [{
                className: "text-right",
                targets: [7,8]
            },
            {
                className: "text-center",
                targets: [0, 1, 2, 3, 4]
            },
        ],
        ajax: {
            "url": baseurljavascript + 'masterdata/jsontabeldaftaritem',
            "type": "POST",
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.DIMANA2 = $("#daftaritem_katakunci").val();
                d.DIMANA3 = $("#daftaritem_parameterpencarian").val();
                d.DIMANA6 = session_outlet;
                d.DIMANA8 = statusbarang;
                d.DIMANA10 = session_kodeunikmember;
                d.DATAKE = 0;
                d.LIMIT = 500;
            }
        },
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false,
    });
});
tableModal = $("#bulkinsert_tabel").DataTable({
    language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
    scrollX:true,
    destroy:true,
    initComplete:function(settings,json){},
});
$('#pilihprincipalbulk').select2({
    dropdownParent: $("#modalbulkinsert"),
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
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
$('#pilihsuplierbulk').select2({
    dropdownParent: $("#modalbulkinsert"),
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
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
$('#pilihkategoribulk').select2({
    dropdownParent: $("#modalbulkinsert"),
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
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
$('#pilihsatuanbulk').select2({
    dropdownParent: $("#modalbulkinsert"),
    allowClear: true,
    placeholder: 'Tentukan satuan item',
    ajax: {
        url: baseurljavascript + 'masterdata/jsonsatuanselect',
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
            
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "[" + item.idsatuan + "] " + item.namasatuan,
                        id: item.idsatuan,
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
$('#pilihsatuansatuannyabulk').select2({
    dropdownParent: $("#modalbulkinsert"),
    allowClear: true,
    placeholder: 'Tentukan satuan item',
    ajax: {
        url: baseurljavascript + 'masterdata/jsonsatuanselect',
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
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "[" + item.idsatuan + "] " + item.namasatuan,
                        id: item.idsatuan,
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
$('#pilihperusahaanbulk').select2({
    dropdownParent: $("#modalbulkinsert"),
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
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
$('#pilihbrandbulk').select2({
    dropdownParent: $("#modalbulkinsert"),
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
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
})
$("#generateiditem").on("click", function () {
    $('#kodebarang').val("ACI" + session_kodeunikmember + Math.floor(Date.now() / 1000));
});
function tambahkegrid(){
    $('#bulkinsert_tabel').DataTable().row.add([
        "<div><button class=\"hapusbarangbulkpilih btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>",
        "<input readonly type=\"text\" value=\""+$('#kodebarang').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#kodebarangqrcode').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#namabarang').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#beratbarang').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihprincipalbulk').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihprincipalbulk').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihsuplierbulk').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihsuplierbulk').text()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihbrandbulk').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihbrandbulk').text()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihkategoribulk').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihkategoribulk').text()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihsatuanbulk').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihperusahaanbulk').val()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#pilihperusahaanbulk').text()+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#aktifkanbestbuy').is(':checked')+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#barangbukanstok').is(':checked')+"\" class=\"form-control-plaintext\">",
        "<input readonly type=\"text\" value=\""+$('#stokdapatminus').is(':checked')+"\" class=\"form-control-plaintext\">",     
    ]).draw();
}
$('#bulkinsert_tabel').on('click', '.hapusbarangbulkpilih', function () {
    let table = $('#bulkinsert_tabel').DataTable();
    let row = $(this).parents('tr');
    if ($(row).hasClass('child')) {
        table.row($(row).prev('tr')).remove().draw();
    } else {
        table.row($(this).parents('tr')).remove().draw();
    }
});
</script>
<?= $this->endSection(); ?>