<?= $this->extend('backend/main_acipay'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
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
                        <a class="mr-2" href="<?= base_url() ;?>acipay/kategori"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Kelola Kategori</button></a>
                    </div>
                    <div class="portlet-body">
                        <div class="form-row">
                            <div class="col-md-4 mb-2">
                                <label for="acipay_idkategori">ID Operator</label>
                                <input type="text" class="form-control" id="acipay_idkategori" placeholder="TSEL">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="acipay_namakategori">Nama Operator</label>
                                <input type="text" class="form-control" id="acipay_namakategori" placeholder="TELKOMSEL">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="statusoperator">Status Operator</label>
                                <select id="statusoperator" class="selectpicker" data-live-search="true">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Akif</option>
                                </select>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-12 mb-2">
                                <label for="urlgamabar">Citra URL [rekomendasi : 128px x 128px] </label>
                                <input type="text" class="form-control" id="urlgamabar" placeholder="Masukan URL gambar untuk icon kategori ini">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="prefixoperator">Prefix Operator</label>
                                <select class="form-control" id="prefixoperator" multiple="multiple"></select>
                                <small class="form-text text-muted">Anda dapat melakukan copy + paste untuk mempercepat pemasukan data prefix dengan format [0825,0821,0823,0875]</small>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <!-- BEGIN Form Group -->
                        <!-- END Form Group -->
                        <button id="tambahoperator" class="btn btn-primary">Simpan Informasi</button>
                        <input style="visibility:hidden" type="checkbox" id="isedit">
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="daftaroperator" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>ID Operator</th>
                                    <th>Nama Operator</th>
                                    <th>Prefix</th>
                                    <th>Status</th>
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
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(function () {
$("#prefixoperator").select2({tokenSeparators: [',', ', ', ' '],dropdownAutoWidth:true,placeholder:"Pisahkan dengan SPACE atau KOMA, ENTER jika selesai",tags:true});
getCsrfTokenCallback(function() {
    $("#daftaroperator").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        scrollCollapse: true,
        scrollY: "100vh",
        scrollX: true,
        bFilter: false,
        ajax: {
            "url": baseurljavascript + 'acipay/ajaxoperatordt',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.KATAKUNCI = $('#katakunci').val();
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        }
    });
});
});

$('#katakunci').on('input', debounce(function (e) {
    $('#daftaroperator').DataTable().ajax.reload();
}, 500));
$("#tambahoperator").on("click", function () {
    if ($("#acipay_idkategori").val() == "" || $("#acipay_namakategori").val() == "" || $("#prefixoperator").val() == ""){
        return toastr["error"]("Silahkan lengkapi informasi <strong>ID OPERATOR</strong>,<br><strong>NAMA OPERATOR</strong>, serta <strong>PREFIX</strong> dari operator tersebut");
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: $('#isedit').is(':checked') ? "Apakah anda ingin mengubah data OPERATOR "+$("#acipay_namakategori").val()+" dengan KODE "+$("#acipay_idkategori").val() : "Apakah anda ingin menambahkan OPERATOR : "+$("#acipay_namakategori").val()+" dengan KODE "+$("#acipay_idkategori").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: $('#isedit').is(':checked') ? 'Oke, Saya Ubah!' : 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#tambahoperator').prop("disabled",true);
            $('#tambahoperator').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'acipay/simpanoperator',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        csrf_aciraba: csrfTokenGlobal,
                        PRINCIPAL_ID : $("#acipay_idkategori").val(),
                        NAMA_PRINCIPAL : $("#acipay_namakategori").val(),
                        URL_CITRA : $("#urlgamabar").val(),
                        STATUS : $("#statusoperator").val(),
                        PREFIX : $('#prefixoperator').val().join(','),
                        ISEDIT : $('#isedit').is(':checked'),
                    },
                    complete:function(){
                        $('#tambahoperator').prop("disabled",false);
                        $('#tambahoperator').html("Simpan Informasi");
                    },
                    success: function (response) {
                        if (response.success == true){
                            Swal.fire('Berhasil.. Horee!',response.msg,'success')
                            $("#acipay_idkategori").val("");
                            $("#acipay_namakategori").val("");
                            $("#urlgamabar").val("");
                            $("#statusoperator").val("1").change();
                            $('#prefixoperator').val(null).trigger('change');
                            $('#isedit').prop('checked', false);
                            $('#daftaroperator').DataTable().ajax.reload();
                        }else{
                            Swal.fire('Proses Simpan Gagal',response.msg,'error')
                        }
                    }
                });
            });
        }
    });
});
function ubahinformasi(id,nama,prefix,status,url,ai){
    prefix.split(',').forEach(function (item, index) {
        if ($('#prefixoperator').find("option[value='" + item + "']").length) {
            $('#prefixoperator').val(item).trigger('change');
        } else { 
            const newOption = new Option(item, item, true, true);
            $('#prefixoperator').append(newOption).trigger('change');
        }
    });
    $('#acipay_idkategori').prop('readonly', true);
    $('#isedit').prop('checked', true);
    $('#acipay_idkategori').val(id);
    $('#acipay_namakategori').val(nama);
    $('#prefixoperator').val(prefix.split(',')).trigger('change');
    $("#statusoperator").val(status).change();
    $('#urlgamabar').val(url);

}
function deleteoperator(operatorid, operatornama, ai){
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menhapus OPERATOR : "+operatornama+" dengan KODE "+operatorid+". Informasi yang mengandung OPERATOR "+operatornama+" tidak akan bisa dicari oleh PELANGGAN",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Saya Yakin!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#hapusoperatorid'+ai).prop("disabled",true);
            $('#hapusoperatorid'+ai).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'acipay/hapusoperator',
                method: 'POST',
                dataType: 'json',
                data: {
                    csrf_aciraba: csrfTokenGlobal,
                    OPERATOR_ID : operatorid,
                },
                complete:function(){
                    $('#hapusoperatorid'+ai).prop("disabled",false);
                    $('#hapusoperatorid'+ai).html('<i class=\"fas fa-trash\"></i> Hapus');
                },
                success: function (response) {
                    $('#daftaroperator').DataTable().ajax.reload();
                    if (response.success == true){
                        Swal.fire(
                            'Operator Terhapus!',
                            'Informasi operator '+operatornama+' berhasil terhapus. Silahkan ubah produk yang menggunakan operator ini agar dapat ditranskasi oleh MEMBER',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Gagal.. Uhhhhh!',
                            response.msg,
                            'warning'
                        )
                    }
                }
            });
            });
        }
    });
}
</script>
<?= $this->endSection(); ?>