<?= $this->extend('backend/main_acipay'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet">
<style>
label {font-weight: bold;}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h5>Informasi Detail Produk</h5>
                    </div>
                    <div class="portlet-body">
                    <div class="form-row">
                            <div class="col-md-12 mb-1 col-sm-12">
                            <p align="justify">Berikut adalah informasi untuk mengelola produk acipay secara individu atau 1 produk. Jika ingin menambahkan produk secara cepat melalui jalur API yang tersedia, silahkan sinkronkan melalui kategori produk <a style="pointer:cursor" href="<?= base_url();?>acipay/kategori">disini</a>. Silahkan kelola produk ini secara hati hati dan jangan lupa selalu bersyukur</p>
                            </div>
                        </div>
                        <!-- BEGIN Form Row -->
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <label for="servervendor">Pilih Jalur Gerbang</label>
                                <select class="form-control" id="servervendor">
                                <?php if (isset($SUPPLER_ID)){ echo "<option value=\"".$SUPPLER_ID."\">[".$SUPPLER_ID."] ".$NAMA_SERVER."</option>"; }?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="kodeproduk">Kode Produk [Prefix : ACI]</label>
                                <input id="kodeproduk" type="text" class="form-control" placeholder="Contoh : TSELP100" value="<?= isset($BARANG_ID) ? $BARANG_ID : "" ;?>">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="kodeprodukserver">Kode Server</label>
                                <input id="kodeprodukserver" type="text" class="form-control" placeholder="Contoh : TSELP100" value="<?= isset($PRODUK_ID_VENDOR) ? $PRODUK_ID_VENDOR : "" ;?>">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="namaproduk">Nama Produk</label>
                                <input id="namaproduk" type="text" class="form-control" placeholder="Contoh : TELKOMSEL 100K" value="<?= isset($NAMABARANG) ? $NAMABARANG : "" ;?>">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="kategori">Pilih ID Kategori</label>
                                <select class="form-control" id="kategori">
                                <?php if (isset($KATEGORI_ID)){ echo "<option value=\"".$KATEGORI_ID."\">[".$KATEGORI_ID."] ".$NAMAKATEGORI."</option>"; }?>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="operator">Pilih ID Operator</label>
                                <select class="form-control" id="operator">
                                    <?php if (isset($PARETO_ID)){ echo "<option value=\"".$PARETO_ID."\">[".$PARETO_ID."] ".$NAMA_PRINCIPAL."</option>"; }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="col-md-3 col-sm-12">
                            <label for="statusproduk">Status Produk</label>
                            <select id="statusproduk" class="selectpicker" data-live-search="true">
                                <option value="1">Normal</option>
                                <option value="0">Produk Gangguan</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="poin">Point / Trx</label>
                            <input id="poin" type="text" class="form-control" value="<?= isset($POIN) ? $POIN : "1" ;?>">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="imgurl">IMG URL [Rekomendasi 128px x 128px]</label>
                            <input id="imgurl" type="text" class="form-control" placeholder="Masukan URL citra untuk icon" value="<?= isset($FILECITRA) ? $FILECITRA : "" ;?>">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="multi">Jenis Transkasi</label>
                            <select id="multi" class="selectpicker" data-live-search="true">
                                <option value="true">Transkasi Ganda</option>
                                <option value="false">Transaksi 1x 1hari</option>
                            </select>
                            <strong strong>NB : </strong>Banyaknya transkasi berulang pada nomor yang sama apakah cuma 1x atau lebih dari Nx.
                        </div>
                        </div>
                        <div id="parametertagihan" class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <label for="admintagihan">Admin Tagihan</label>
                                <input id="admintagihan" type="text" class="form-control" placeholder="0" value="">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="komisisukses">Komisi Sukses</label>
                                <input id="komisisukses" type="text" class="form-control" placeholder="0" value="">
                            </div>
                        </div>
                        <div id="parameternontagihan" class="form-row">
                            <div class="col-md-3 col-sm-12">
                                <label for="hss">Harga Server</label>
                                <input id="hss" type="text" class="form-control"  value="<?= isset($HARGABELI) ? $HARGABELI : "0" ;?>">
                                <strong strong>NB : </strong>Harga server akan berubah secara otomatis jika transaksi sukses khusus NON TAGIHAN.
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="hu">Harga Umum</label>
                                <input id="hu" type="text" class="form-control" placeholder="0" value="<?= isset($HARGAJUAL) ? $HARGAJUAL : "" ;?>">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="ha">Harga Agen</label>
                                <input id="ha" type="text" class="form-control" placeholder="0" value="<?= isset($HARGA_1) ? $HARGA_1 : "" ;?>">
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <label for="hs">Harga Spesial</label>
                                <input id="hs" type="text" class="form-control" placeholder="0" value="<?= isset($HARGA_2) ? $HARGA_2 : "" ;?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 col-sm-12">
                                <label for="keteranganproduk">Keterangan Produk Ini</label>
                                <div id="textareaeditor">
                                    <div id="keteranganproduk" class="mb-3"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button id="simpanprodukacipay" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Informasi</button>
                        <input style="visibility: hidden;" type="checkbox" id="isedit">
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>
<script type="text/javascript">
let quillketeranganproduk;
const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],

    ['clean']                                         // remove formatting button
];
quillketeranganproduk = new Quill('#keteranganproduk', {
    modules: { toolbar: toolbarOptions },
    theme: 'snow'
});
$(document).ready(function () {
    quillketeranganproduk
    $("#parameternontagihan").hide()
    $("#parametertagihan").hide()
    if ("<?= $SEGMENT3 ;?>" != ""){
        $("#kodeproduk").prop('readonly', true);
        $("#isedit").prop('checked', true);
        $('#multi').val("<?= isset($MULTI) ? $MULTI : "" ;?>").change();
        $('#statusproduk').val("<?= isset($AKTIF) ? $AKTIF : "" ;?>").change();
        if ("<?= isset($FORMAT) ? $FORMAT : "" ;?>" == "TAGIHAN"){
            $("#parameternontagihan").hide()
            $("#parametertagihan").show()
        }else{
            $("#parameternontagihan").show()
            $("#parametertagihan").hide()
        }
        quillketeranganproduk.clipboard.dangerouslyPasteHTML('<?= isset($KETERANGANBARANG) ? $KETERANGANBARANG : "" ;?>');
    }
    $('#kategori').select2({
        allowClear: true,
        placeholder: 'Tentukan kategori produk',
        ajax: {
            url: baseurljavascript + 'acipay/kategoriselect2',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KATAKUNCI: (typeof params.term === "undefined" ? "" : params.term),
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
                toastr["error"]("Kesalahan dalam request payload. Silahkan cek konsol LOG pada server");
            }
        },
    });
    $('#kategori').on('change', function() {
        let selectedValue = $(this).val();
        getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'acipay/getformat',
            method: 'POST',
            dataType: 'json',
            data: {
                csrf_aciraba: csrfTokenGlobal,
                kategori_id: selectedValue
            },
            success: function (response) {
                if (response.success == true){
                    if (response.data == "TAGIHAN"){
                        $("#parameternontagihan").hide()
                        $("#parametertagihan").show()
                    }else{
                        $("#parameternontagihan").show()
                        $("#parametertagihan").hide()
                    }
                }else{
                    Swal.fire(
                        'Wadidaw Terjadi Kegagalan!',
                        response.msg,
                        'error'
                    )
                }
            }
        });
        });
    });
    $('#operator').select2({
        allowClear: true,
        placeholder: 'Tentukan operator produk',
        ajax: {
            url: baseurljavascript + 'acipay/pilihoperator',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    KATAKUNCI: (typeof params.term === "undefined" ? "" : params.term),
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.idoperator + "] " + item.namaoperator,
                            id: item.idoperator,
                        }
                    })
                }
            },
            error: function(xhr, status, error) {
                getCsrfTokenCallback(function() {});
                toastr["error"]("Kesalahan dalam request payload. Silahkan cek konsol LOG pada server");
            }
        },
    });
    $('#servervendor').select2({
        allowClear: true,
        placeholder: 'Tentukan jalur transaksi',
        ajax: {
            url: baseurljavascript + 'acipay/bacaserver',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    TIPE: "select2",
                    KATAKUNCI: (typeof params.term === "undefined" ? "" : params.term),
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.idjalur + "] " + item.namajalur,
                            id: item.idjalur,
                        }
                    })
                }
            },
            error: function(xhr, status, error) {
                getCsrfTokenCallback(function() {});
                toastr["error"]("Kesalahan dalam request payload <strong>providergateway</strong>. Silahkan cek konsol LOG pada server");
            }
        },
    });
});
$("#simpanprodukacipay").click(function () {
    if ($("#kodeproduk").val() == "" || $("#namaproduk").val() == "" || $("#kategori").val() == "" || $("#operator").val() == "" || $("#hss").val() == "" || $("#hu").val() == "" || $("#ha").val() == "" || $("#hs").val() == "" || $("#poin").val() == ""){
        return toastr["error"]("Informasi <strong>KODEPRODUK, NAMAPRODUK, KATEGORI, OPERATOR, HARGASERVER, HARGA JUAL, dan POIN</strong> harus disi.");
    }
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: $('#isedit').is(":checked") == true ? 'Apakah anda ingin mengubah data '+$("#namaproduk").val()+". Pastikan anda merubah ketika DENOM "+$("#namaproduk").val()+" tidak padat transkasi" : 'Informasi barang '+$("#namaproduk").val()+' akan ditambahkan ? Pastikan kode produk produk anda sama dengan kode produk pada delear atau suplier anda, jika tidak maka transkasi tidak dapat diteruskan ke provider',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: $('#isedit').is(":checked") == true ? 'Oke, Ubah Data' : 'Oke, Tambah Produk!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#simpanprodukacipay').prop("disabled",true);
            $('#simpanprodukacipay').html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'acipay/tambahprodukproses',
                method: 'POST',
                dataType: 'json',
                data: {
                    csrf_aciraba: csrfTokenGlobal,
                    'ISEDIT' : $('#isedit').is(":checked"),
                    'PRODUK_ID' : ($('#isedit').is(":checked") == true ? $('#kodeproduk').val():"ACI"+$('#kodeproduk').val()),
                    'PRODUK_SERVER' : $('#kodeprodukserver').val(),
                    'QRCODE_ID' : "ACI"+$('#kodeproduk').val(),
                    'NAMABARANG' : $('#namaproduk').val(),
                    'BERAT_BARANG' : 0,
                    'PARETO_ID' : $('#operator').val(),
                    'SUPPLER_ID' : $('#servervendor').val(),
                    'KATEGORI_ID' : $('#kategori').val(),
                    'BRAND_ID' : 0,
                    'KETERANGANBARANG' : quillketeranganproduk.root.innerHTML,
                    'HARGABELI' : $('#hss').val(),
                    'HARGAJUAL' : $('#hu').val(),
                    'SATUAN' : "PCS",
                    'AKTIF' : $('#statusproduk').val(),
                    'KODEUNIKMEMBER' : session_kodeunikmember,
                    'APAKAHGROSIR' : "TIDAK AKTIF",
                    'STOKDAPATMINUS' : "DAPAT MINUS",
                    'JENISBARANG' : "DIGITAL",
                    'PEMILIK' : "0",
                    'APAKAHBONUS' : "TIDAK AKTIF",
                    'FILECITRA' : ($('#imgurl').val() == "" ? "not_found" : $('#imgurl').val()),
                    'URUTAN' : "0",
                    /*produk acipay join */
                    'HARGA_1' : $('#ha').val(),
                    'HARGA_2' : $('#hs').val(),
                    'HARGA_3' : "0",
                    'MULTI' : $('#multi').val(),
                    'ADMIN' : $('#admintagihan').val(),
                    'KOMISI' : $('#komisisukses').val(),
                    'POIN' : $('#poin').val(),
                },
                complete:function(){
                    $('#simpanprodukacipay').prop("disabled",false);
                    $('#simpanprodukacipay').html("<i class='fas fa-save'></i> Simpan Informasi");
                },
                success: function (response) {
                    if (response.success == true){
                        Swal.fire(
                            'Informasi Produk Berhasil Disimpan!!!',
                            response.msg,
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Wadidaw Terjadi Kegagalan!',
                            response.msg,
                            'error'
                        )
                    }
                },
                error: function(xhr, status, error) {
                    getCsrfTokenCallback(function() {});
                    toastr["error"](xhr.responseJSON.message);
                }
            });
            });
        }
    })
});
</script>
<?= $this->endSection(); ?>