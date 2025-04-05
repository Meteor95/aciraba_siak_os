<?= $this->extend('backend/main_akuntansi'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
.select2-results__option[aria-disabled="true"] {
    color: red !important; 
    cursor: not-allowed;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title"> 
                            <button id="btnsimpanentrijurnal" class="btn btn-primary"> <i class="fa-solid fa-book-bookmark"></i> Simpan Informasi Kas Bank Transfer</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <input type="text" value="1" id="jenistransaksi" style="display:none">
                            <div class="col-md-12 mb-1 col-sm-12">
                                <label>Jurnal Perusahaan</label>
                                <select class="form-control" id="pilihperusahaan"><option value="0">[0] Perusahaan Induk</option></select>
                            </div>
                            <div class="col-md-6 mb-1 col-sm-12">
                                <label>No Transaksi</label>
                                <div class="input-group">
                                    <div class="input-group">
                                        <input value="" type="text" class="form-control" id="siak_notransaksi" placeholder="Masukan Nomor Transaksi Entri Jurnal">
                                        <div class="input-group-prepend"><button id="generateiditem" class="input-group-text btn-warning btn">Buat Nota Otomatis</button></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <input id="tanggalentrijurnal" type="text" class="form-control" placeholder="Tanggal Entri Kas">
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label>Asal Kas Bank</label>
                                <select id="coakasbankasal"></select>  
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label>Tujuan Kas Bank</label>
                                <select id="coakasbanktujuan"></select>  
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label>Nominal Transfer</label>
                                <input value="" type="text" class="form-control" id="nominaltransfer" placeholder="Masukan Nominal Transfer Kas Bank">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-1 col-sm-12">
                                <label>Narasi Untuk Transaksi Entri Jurnal</label>
                                <div class="quill" id="quill"></div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
let nominaltransfer = 0, jenistransaksiurl = '<?= $jenistransaksi ;?>', totaldebit = 0,quillnya
let tabelentrikasbanktransfer = "", temprow = 0, informasidata = JSON.stringify([])
nominaltransfer = new AutoNumeric("#nominaltransfer", {decimalCharacter : ',',digitGroupSeparator : '.',});
$(document).ready(function () {
quillnya = new Quill("#quill",{theme:"snow",modules: { toolbar: toolbarOptions },})
$("#coakasbankasal, #coakasbanktujuan").select2({dropdownAutoWidth:true,placeholder: 'Pilih Kode COA',});
$('#tanggalentrijurnal').val(moment().format('DD-MM-YYYY'));
$("#tanggalentrijurnal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
$('#pilihperusahaan').select2({
    allowClear: true,
    placeholder: 'Tentukan Jurnal Perusahaan',
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
$('#pilihperusahaan').on('change', function() {
    let selectedValue = $(this).val();
    getCsrfTokenCallback(function() {
        $('#coakasbankasal').html("<select id=\"pilihcoaledgeredit\"></select>");
        $('#coakasbanktujuan').html("<select id=\"pilihcoaledgeredit\"></select>");
        $.ajax({
            url: baseurljavascript + 'akuntansi/getcoaentrijurnal',
            method: 'POST',
            dataType: 'json',
            data: {
                csrf_aciraba: csrfTokenGlobal,
                KODESUBPERUSAHAAN: selectedValue,
            },
            success: function(res){
                if (res.length == 0) { informasidata = JSON.stringify([]) }
                else{
                    informasidata = JSON.stringify(res); 
                    const selectCoaAsal = generateSelectTreeViewledger(informasidata, "coakasbankasal", true);
                    const selectCoaTujuan = generateSelectTreeViewledger(informasidata, "coakasbanktujuan", true);
                    $('#coakasbankasal').select2({placeholder: 'Pilih Kode COA Asal',});
                    $('#coakasbankasal').html(selectCoaAsal.outerHTML);
                    $('#coakasbanktujuan').select2({placeholder: 'Pilih Kode COA Tujuan',});
                    $('#coakasbanktujuan').html(selectCoaTujuan.outerHTML);
                }
            }
        });
    });
});
});
$("#generateiditem").on("click", function () {
    $('#siak_notransaksi').val("TK" + session_kodeunikmember + session_outlet + Math.floor(Date.now() / 1000));
});

function simpanentrijurnal(){
    if (nominaltransfer.getNumber() == 0){
        return toastr["error"]("Nominal tidak boleh kosong. Silahkan isikan nominal TRANSFER KAS BANK terlebih dahulu");
    }
    Swal.fire({
        title: "Yakin Ingin Melakukan Transfer Antar Kas Bank",
        text: "Apakah anda yakin ingin melakukan transfer dari KAS BANK Kode COA : "+$("#coakasbankasal option:selected").text().replaceAll("\u00a0"," ")+" akan ditambahkan ke KAS BANK Kode COA "+$("#coakasbanktujuan option:selected").text().replaceAll("\u00a0"," ")+" sebesar "+formatRupiah(nominaltransfer.getNumber()),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Entri Sekarang!!',
        cancelButtonText: 'Tunggu Dulu!!'
    }).then((result) => {
        if (result.isConfirmed) {
            let dataEntriJurnal = [];
            for (let i = 1; i <= 2; i++) {
                let dataJurnal = {
                    kodecoa: (i == 1 ? $("#coakasbankasal").val() : $("#coakasbanktujuan").val() ),
                    narasiakun: quillnya.root.innerHTML,
                    debit: (i == 1 ? 0 : nominaltransfer.getNumber() ),
                    kredit: (i == 1 ? nominaltransfer.getNumber() : 0 ),
                };
                dataEntriJurnal.push(dataJurnal);
            }
            const datatrxentrijurnal = {
                notransaksi: $("#siak_notransaksi").val(),
                tanggaltrx: $("#tanggalentrijurnal").val().split("-").reverse().join("-"),
                narasientrijurnal: quillnya.root.innerHTML,
                totaldebit: nominaltransfer.getNumber(),
                totalkredit: nominaltransfer.getNumber(),
                outlet: session_outlet,
                kodeunikmember: session_kodeunikmember,
                perusahaan: $("#pilihperusahaan").val(),
                dataentrijurnal: dataEntriJurnal,
            };
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'akuntansi/simpanentrijurnal',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        INFORMASIENTRIJURNAL : datatrxentrijurnal,
                        NOTRXEDIT : "",
                        JENISJURNAL : "TK",
                    },
                    success: function (response) {
                        if (response.success == true){
                            Swal.fire({
                                title: "Entri Transfer KAS BANK Berhasil",
                                text: "Transfer antar KAS BANK Kode COA : "+$("#coakasbankasal option:selected").text().replaceAll("\u00a0"," ")+" akan ditambahkan ke KAS BANK Kode COA "+$("#coakasbanktujuan option:selected").text().replaceAll("\u00a0"," ")+" sebesar "+formatRupiah(nominaltransfer.getNumber())+" Berhasil",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Entri JurnalBaru!!',
                                cancelButtonText: 'Ke Daftar Jurnal!!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    bersihkanformulir()
                                }else{
                                    window.location.href = baseurljavascript+'akuntansi/kasdanbank';
                                }
                            })
                        }else{
                            Swal.fire(
                                'Terjadi Kesalahan!',
                                response.msg,
                                'error'
                            )
                        }
                    }
                });
            });
        }
    })
}
function bersihkanformulir(){
    $("#siak_notransaksi").val(""),
    $('#pilihperusahaan').val($('#pilihperusahaan option:first-child').val()).trigger('change');
    $('#tanggalentrijurnal').val(moment().format('DD-MM-YYYY'));
    quillnya.setContents([{insert: ' '}]);
    informasidata = JSON.stringify([])
    $('#nominaltransfer').val();
}
$("#btnsimpanentrijurnal").on("click", function() {
    simpanentrijurnal()
});
</script>
<?= $this->endSection(); ?>