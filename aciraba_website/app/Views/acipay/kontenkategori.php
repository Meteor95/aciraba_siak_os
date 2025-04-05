<?= $this->extend('backend/main_acipay'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet">
<style>
.center-middle {
  vertical-align: middle;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div class="form-row col">
                            <input type="text" class="form-control" id="katakunci" placeholder="Masukan kata kunci yang anda inginkan">
                        </div>
                        <a class="ml-2 mr-2" href="<?= base_url() ;?>acipay/produk"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Kelola Produk</button></a>
                        <a class="mr-2" href="<?= base_url() ;?>acipay/operator"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Kelola Operator</button></a>
                    </div>
                    <div class="portlet-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="acipay_idkategori">ID Kategori</label>
                                <input type="text" class="form-control" id="acipay_idkategori" placeholder="TSEL">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="acipay_namakategori">Nama Kategori</label>
                                <input type="text" class="form-control" id="acipay_namakategori" placeholder="TELKOMSEL">
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="imgruel">Citra URL [rekomendasi : 128px x 128px] </label>
                                <input type="text" class="form-control" id="imgruel" placeholder="Masukan URL gambar untuk icon kategori ini">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="statuskategori">Status Kategori</label>
                                <select id="statuskategori" class="selectpicker" data-live-search="true">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Akif</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="formattrx">Format Transaksi</label>
                                <select id="formattrx" class="selectpicker" data-live-search="true">
                                    <option value="REGULER">REGULER</option>
                                    <option value="GAME / VOUCHER GAME">GAME / VOUCHER GAME</option>
                                    <option value="TOKEN">TOKEN</option>
                                    <option value="TAGIHAN">TAGIHAN</option>
                                </select>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="placeholderketerangan">Keterangan Placeholder</label>
                                <input type="text" class="form-control" id="placeholderketerangan" placeholder="Pesan untuk pelanggan anda">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kuncioperator">Pilih ID Operator</label>
                                <select class="form-control kuncioperatorclass"  id="kuncioperator"></select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="providergateway">Pilih Jalur Gerbang</label>
                                <select class="form-control" id="providergateway"></select>
                            </div>
                        </div>
                        <label for="keterangan">Deskripsikan Kategori Ini</label>
                        <div id="textareaeditor">
                            <div id="keterangan" class="mb-3"></div>
                        </div>
                        <!-- BEGIN Form Group -->
                        <!-- END Form Group -->
                        <button id="tambahkategori" class="btn btn-primary">Simpan Informasi</button>
                        <input hidden type="checkbox" id="isedit">
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="daftarkategori" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>ID Kategori</th>
                                    <th>Nama Kategori</th>
                                    <th>Jalur Transaksi</th>
                                    <th>Ip Address</th>
                                    <th>Format Transaksi</th>
                                    <th>Status Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<!-- BEGIN Modal -->
<div class="modal fade" id="modalsinkronproduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sinkronasi <span id="kategorinama"></span> [<span id="kategoriidsinkron"></span>]<br>
                Tujuan Jalur <span id="idserver"></span> [<span id="namaserver"></span>]
                </h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-1">Tentukan kode produk di pada server tujuan dan ambil kata mulai dari 0 - n. CONTOH : KODEPRODUK SERVER <strong>TSELD100</strong>, <strong>TSELD200</strong>, dsb maka masukkan 0 - 5, Maka sistem akan mengambil PRODUK yang mengandung kata <strong>TSELD</strong></p>
                <input id="pemisahproduk" placeholder="Kunci awalan produk [TSELD]" type="text" class="form-control" value="">
                <label for="jenisproduk">Jenis Produk Yang Diambil</label>
                <select id="jenisproduk" class="selectpicker" data-live-search="true">
                    <option value="prepaid">Prepaid - Contoh : PULSA REGULER, GAME, TOKEN</option>
                    <option value="pasca">Pascabayar - Contoh : TAGIHAN PLN, PDAM, CICILAN</option>
                </select>
            </div>
            <div class="modal-footer">
                <button id="sinkron" onclick="sinkronbarang(true,'','','','')" class="btn btn-primary mr-2">Oke, Sinkronkan Sekarang</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet">
<script type="text/javascript">
let daftarkategori;
let quill;
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
quill = new Quill('#keterangan', {
    modules: { toolbar: toolbarOptions },
    theme: 'snow'
});
$(function () {
    loaddatakategori();
    quill;
    $('.kuncioperatorclass').select2({
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
 
                toastr["error"]("Kesalahan dalam request payload. Silahkan cek konsol LOG pada server");
            }
        },
    });
    $('#providergateway').select2({
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
                toastr["error"]("Kesalahan dalam request payload <strong>providergateway</strong>. Silahkan cek konsol LOG pada server");
            }
        },
    });
});
function loaddatakategori(){
getCsrfTokenCallback(function() {
    daftarkategori =  $("#daftarkategori").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        columnDefs: [
            { width: 45, targets: 0 },
            { "targets": [1,2,3,4], "createdCell": function (td, cellData, rowData, row, col) { $(td).css('padding-top', '15px') }}
        ],
        "columns": [
            { "className":'',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
        ],
        scrollCollapse: true,
        scrollY: "100vh",
        scrollX: true,
        bFilter: false,
        ajax: {
            "url": baseurljavascript + 'acipay/daftarkategori',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.KATAKUNCI = $('#katakunci').val();
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        },
        "rowCallback": function(row, data, index) {
          $(row).addClass('center-middle');
        }
    });
});
}
function detailkategorinonppob (d) {
    return "<table style='padding-left:50px;'>"+
        "<tr>"+
            '<td>Placeholder</td>'+
            '<td>'+d[7]+'</td>'+
        "</tr>"+
        "<tr>"+
            '<td>Keterangan</td>'+
            '<td>'+d[8]+'</td>'+
        "</tr>"+
    '</table>';
}
$('#daftarkategori tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = daftarkategori.row( tr );
    if ( row.child.isShown() ) {
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        row.child(detailkategorinonppob(row.data()) ).show();
        tr.addClass('shown');
    }
} );
$("#tambahkategori").on("click", function () {
    if ($("#acipay_idkategori").val() == "" || $("#acipay_namakategori").val() == "" || $("#statuskategori").val() == "" || $("#formattrx").val() == "" || $("#kuncioperator").val() == "" ){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan lengkapi informasi <strong>ID KATEGORI</strong>,<br><strong>NAMA KATEGORI</strong>,<strong>STATUS KATEGORI</strong>,<br>serta <strong>FORMAT TRANSKASI</strong> dari KATEGORI tersebut',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: $('#isedit').is(':checked') ? "Apakah anda ingin mengubah data KATEGORI "+$("#acipay_namakategori").val()+" dengan KODE "+$("#acipay_idkategori").val() : "Apakah anda ingin menambahkan KATEGORI : "+$("#acipay_namakategori").val()+" dengan KODE "+$("#acipay_idkategori").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: $('#isedit').is(':checked') ? 'Oke, Saya Ubah!' : 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#tambahkategori').prop("disabled",true);
            $('#tambahkategori').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'acipay/simpankategori',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        csrf_aciraba: csrfTokenGlobal,
                        URUTAN : "0",
                        KATEGORI_ID : $("#acipay_idkategori").val(),
                        NAMAKATEGORI : $("#acipay_namakategori").val(),
                        FORMAT : $("#formattrx").val(),
                        URL_CITRA : $("#imgruel").val(),
                        SLUG_URL : slugify($("#acipay_namakategori").val()),
                        STATUS : $('#statuskategori').val(),
                        PLACEHOLDER : $("#placeholderketerangan").val(),
                        KETERANGAN : quill.root.innerHTML,
                        ISEDIT : $('#isedit').is(':checked'),
                        IDOPERATOR : $('#kuncioperator').val(),
                        IDVENDOR : $('#providergateway').val(),
                    },
                    complete:function(){
                        $('#tambahkategori').prop("disabled",false);
                        $('#tambahkategori').html("Simpan Informasi");
                    },
                    success: function (response) {
                        $('#daftarkategori').DataTable().ajax.reload();
                        if (response.success == true){
                            Swal.fire(
                                'Berhasil menyimpan informasi!',
                                'Informasi kategori produk berhasil ditambahkan. Silahkan tentukan produk yang akan di berikan kategori ini',
                                'success'
                            )
                            quill = new Quill('#keterangan');
                            quill.setContents([{insert: ' '}]);
                            $('#acipay_idkategori').prop('readonly', false);
                            $("#acipay_idkategori").val("");
                            $("#acipay_namakategori").val("");
                            $("#imgruel").val("");
                            $("#placeholderketerangan").val("");
                            $("#statuskategori").val("1").change();
                            $('#tambahkategori').html("Tambah Informasi");
                            $('#isedit').prop('checked', false);
                        }else{
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                response.msg,
                                'error'
                            )
                        }
                    }
                });
            });
        }
    });
});
function deletekategori(kategoriid, kategorinama,ai){
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menhapus KATEGORI : "+kategorinama+" dengan KODE "+kategoriid+". Informasi yang mengandung KATEGORI "+kategorinama+" tidak akan bisa dicari oleh PELANGGAN",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Saya Yakin!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#hapuskategori'+ai).prop("disabled",true);
            $('#hapuskategori'+ai).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'acipay/hapuskategori',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        csrf_aciraba: csrfTokenGlobal,
                        KATEGORI_ID : kategoriid ,
                    },
                    complete:function(){
                        $('#hapuskategori'+ai).prop("disabled",false);
                        $('#hapuskategori'+ai).html("<i class=\"fas fa-trash\"></i> Hapus");
                    },
                    success: function (response) {
                        if (response.success == true){
                            $('#daftarkategori').DataTable().ajax.reload();
                            Swal.fire(
                                'Berhasil menghapus informasi!',
                                'Informasi kategori produk berhasil dihapus. Silahkan tentukan kategori baru untuk produk yang terlihat pada kategori ini. Karena produk yang terkait tidak bisa dicari oleh pelanggan',
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                obj.msg,
                                'error'
                            )
                        }
                    }
                });
            });
        }
    });
}
function ubahinformasi(kategoriid, kategorinama, imgurl, status, tipe, placeholder, keterangan, operatorid, namaoperator, idjalur, namajalur){
    $('#acipay_idkategori').prop('readonly', true);
    $('#acipay_idkategori').val(kategoriid);
    $('#acipay_namakategori').val(kategorinama);
    $('#imgruel').val(imgurl);
    $('#statuskategori').val(status).change();
    $('#formattrx').val(tipe).change();
    $('#placeholderketerangan').val(placeholder);
    quill.clipboard.dangerouslyPasteHTML(keterangan);
    var newValue = {id: operatorid,text: namaoperator};
    var newOption = new Option(newValue.text, newValue.id, true, true);
    var newValuea = {id: idjalur,text: namajalur};
    var newOptiona = new Option(newValuea.text, newValuea.id, true, true);
    $('#kuncioperator').append(newOption).trigger('change');
    $('#providergateway').append(newOptiona).trigger('change');
    $('#isedit').prop('checked', true);
}
function sinkronbarang(prosessinkron, kategoriid, namakategori, idserver, namaserver){
    if (prosessinkron == true){
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Apakah anda ingin menambahkan KATEGORI : "+$('#kategorinama').html()+" dengan KODE "+$('#kategoriidsinkron').html()+".Barang yang memiliki KODEBARANG sama akan mengalami UPDATE data, jika tidak ada KODEBARANG tersedia maka akan ditambahkan sebagai barang baru",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke, Saya Yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#modalsinkronproduk').block();
                getCsrfTokenCallback(function() {
                    $.ajax({
                        url: baseurljavascript + 'acipay/sinkronproduk',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            csrf_aciraba: csrfTokenGlobal,
                            SERVERID:  $('#idserver').html(),
                            JENISPRODUK: $('#jenisproduk').val(),
                            SKU_EXACT: "", /*kosongin aja dikarenakan mau load semua data */
                            SKU_FILTER: $('#pemisahproduk').val(),
                            KATEGORI_ID: $('#kategoriidsinkron').html(),
                        },
                        success: function (response) {
                            if (response.success == true) {
                                Swal.fire(
                                    'Proses Sinkron Berjalan',
                                    response.msg,
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Gagal.. Uhhhhh!',
                                    response.msg,
                                    'warning'
                                )
                            }
                            $('#modalsinkronproduk').unblock();
                        }
                    });
                });
            }
        });
    }else{
        $('#kategorinama').html(namakategori);
        $('#kategoriidsinkron').html(kategoriid);
        $('#idserver').html(idserver);
        $('#namaserver').html(namaserver);
    }
}
</script>
<?= $this->endSection(); ?>