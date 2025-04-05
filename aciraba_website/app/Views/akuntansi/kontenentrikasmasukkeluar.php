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
                            <button id="btnsimpanentrijurnal" class="btn btn-primary"> <i class="fa-solid fa-book-bookmark"></i> Simpan Informasi Kas Bank</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <input type="text" value="1" id="jenistransaksi" style="display:none">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label>Jurnal Perusahaan</label>
                                <select class="form-control" id="pilihperusahaan"><option value="0">[0] Perusahaan Induk</option></select>
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label><?= $jenistransaksi == "kasmasuk" ? "Dimasukkan Ke Kode" : "Dikirim Dari Kode" ;?></label>
                                <select id="coakasbank"></select>  
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label>No Transaksi</label>
                                <div class="input-group">
                                    <div class="input-group">
                                        <input value="" type="text" class="form-control" id="siak_notransaksi" placeholder="Masukan Nomor Transaksi Entri Jurnal">
                                        <div class="input-group-prepend"><button id="generateiditem" class="input-group-text btn-warning btn">Buat Nota Otomatis</button></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <input id="tanggalentrijurnal" type="text" class="form-control" placeholder="Tanggal Entri Kas">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-1 col-sm-12">
                                <label>Narasi Untuk Transaksi Entri Jurnal</label>
                                <div class="quill" id="quill"></div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        Total Entri Jurnal : <span id="totaldebit">Rp 0,00</span>
                        <table id="tabelentrikasbanktransfer" class="tanpatulisangede table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Terima Dari</th>
                                    <th>Narasi Akun</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <button id="tambahbarusentrijurnal" class="btn-block btn btn-primary">Tambah Baris Entri Jurnal</button>
                        <!-- END Datatable -->
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
let entridebit = [], jenistransaksiurl = '<?= $jenistransaksi ;?>', totaldebit = 0,quillnya
let tabelentrikasbanktransfer = "", temprow = 0, informasidata = JSON.stringify([])
$(document).ready(function () {
quillnya = new Quill("#quill",{theme:"snow",modules: { toolbar: toolbarOptions },})
$("#coakasbank").select2({dropdownAutoWidth:true,placeholder: 'Pilih Kode COA',});
$('#tanggalentrijurnal').val(moment().format('DD-MM-YYYY'));
$("#tanggalentrijurnal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
tabelentrikasbanktransfer = $("#tabelentrikasbanktransfer").DataTable({
    language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
    pageLength: 500,
    bLengthChange: false,
    bFilter: false,
    keys: true,
    scrollY: "50vh",
    scrollCollapse: true,
});
tabelentrikasbanktransfer.on('key', function (e, dt, code) {
    if (code === 13) {
        tabelentrikasbanktransfer.keys.move('down');
    }
})
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
        $('#coakasbank').html("<select id=\"pilihcoaledgeredit\"></select>");
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
                    const selectCoa = generateSelectTreeViewledger(informasidata, "coakasbank",true);
                    $('#coakasbank').select2({
                        placeholder: 'Pilih Kode COA',
                    });
                    $('#coakasbank').html(selectCoa.outerHTML);
                }
            }
        });
    });
});
});
$("#generateiditem").on("click", function () {
    $('#siak_notransaksi').val((jenistransaksiurl == "kasmasuk" ? "KM" : "KK" ) + session_kodeunikmember + session_outlet + Math.floor(Date.now() / 1000));
});

function tambahbarusentrijurnal(){
    temprow = temprow + (tabelentrikasbanktransfer.rows().count() == 0 ? 1 : tabelentrikasbanktransfer.rows().count());
    const selectCoa = generateSelectTreeViewledger(informasidata, "entrijurnal" + temprow);
    tabelentrikasbanktransfer.on('draw.dt', function () {
        let data = tabelentrikasbanktransfer.rows().count() + 1;
        if (data > 0){
            if (!AutoNumeric.getAutoNumericElement("#debit"+temprow)) { 
                entridebit[temprow] = new AutoNumeric("#debit"+temprow, {decimalCharacter : ',',digitGroupSeparator : '.',});
            }
        }
        let scrollBody = $('.dataTables_scrollBody')[0];scrollBody.scrollTop = scrollBody.scrollHeight;
    }).on('key-focus', function ( e, datatable, cell, originalEvent ) {
        $('input', cell.node()).focus();
    }).on("focus", "td input", function(){
        $(this).select();
    })
    tabelentrikasbanktransfer.row.add([
        tabelentrikasbanktransfer.rows().count() + 1,
        selectCoa.outerHTML,
        "<input id=\"narasiakun"+temprow+"\" placeholder=\"Ketik narasi pada entri jural item ini\" name=\"narasiakun[]\" class=\"narasiakun form-control\" type=\"text\" value=\"\">",
        "<input id=\"debit"+temprow+"\" name=\"debit[]\" class=\"debit form-control\" type=\"text\" value=\"0\">",
        "<div><button class=\"hapusentrijurnal btn-block btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>",
    ]).draw();
    $('#entrijurnal' + temprow).select2({
        placeholder: 'Pilih Kode COA',
        dropdownAutoWidth: true,
        width: 'auto'
    });
    hitungjurnal()
}
$("#tambahbarusentrijurnal").on("click", function() {
    tambahbarusentrijurnal()
});
$('#tabelentrikasbanktransfer').on('keypress', 'input[id^="debit"]', debounce(function (e) {
    hitungjurnal()
}, 500));
$('#tabelentrikasbanktransfer').on('click', '.hapusentrijurnal', function () {
    try {
        var table = $('#tabelentrikasbanktransfer').DataTable();
        var row = $(this).parents('tr');
        if ($(row).hasClass('child')) {
            table.row($(row).prev('tr')).remove().draw();
        } else {
            table.row($(this).parents('tr')).remove().draw();
        }
        hitungjurnal()
    }
    catch(err) {}
});
document.addEventListener('keydown', function (event) {
    if (event.ctrlKey && event.altKey) {
        tambahbarusentrijurnal()
        hitungjurnal()
    }
    if (event.ctrlKey && event.key === 's') {
        event.preventDefault();
        simpanentrijurnal()
    }
});

function hitungjurnal(){
    let datarow = tabelentrikasbanktransfer.rows().count();
    if (datarow <= 0){
        $('#totaldebit').html(formatuang(0,'id-ID','IDR'));
    }else{
        let data = tabelentrikasbanktransfer.rows().data();
        totaldebit = 0;
        data.each(function (value, idindex) {
            let row = tabelentrikasbanktransfer.row(idindex).node();
            let debitInputId = $(row).find('input[id^="debit"]').attr('id');
            let debitValue = entridebit[getFullNumberFromString(debitInputId)] ? entridebit[getFullNumberFromString(debitInputId)].getNumber() : 0;
            totaldebit = totaldebit + debitValue;
            $('#totaldebit').html(formatuang(totaldebit.toFixed(2),'id-ID','IDR'));
        })
    }
}
function simpanentrijurnal(){
    Swal.fire({
        title: (jenistransaksiurl == "kasmasuk" ? "Entri Terima Kas Bank Masuk" : "Entri Kirim Kas Bank" ),
        text: (jenistransaksiurl == "kasmasuk" ? "Apakah anda yakin ingin menambahkan total terima Kas Bank sebesar "+totaldebit.toFixed(2)+" ke AKUN : "+$("#pilihperusahaan :selected").select2(this.data).text()+" dari tabel jurnal di bawah ini" : "Apakah anda yakin ingin menguraki total Kas Bank sebesar "+totaldebit.toFixed(2)+" dari AKUN : "+$("#pilihperusahaan :selected").select2(this.data).text()+" untuk jurnal dari tabel di bawah ini"),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Entri Sekarang!!',
        cancelButtonText: 'Tunggu Dulu!!'
    }).then((result) => {
        if (result.isConfirmed) {
            if (tabelentrikasbanktransfer.rows().count() < 1) return toastr["error"]("Entri jurnal masih belum terpenuhi. Silahkan masukan minimal 1 baris entri jurnal untuk melanjutkan transaksi kas bank ini");
            let data = tabelentrikasbanktransfer.rows().data();
            let dataEntriJurnal = [];
            let dataJurnal = {
                kodecoa: $("#coakasbank").val(),
                narasiakun: "Kas Bank "+(jenistransaksiurl == "kasmasuk" ? "Masuk" : "Keluar"),
                debit: (jenistransaksiurl == "kasmasuk" ? totaldebit.toFixed(2) : 0),
                kredit: (jenistransaksiurl == "kasmasuk" ? 0 : totaldebit.toFixed(2) ),
            };
            totaldebit = 0;
            dataEntriJurnal.push(dataJurnal);
            for (let i = 0; i < data.length; i++) {
                let row = tabelentrikasbanktransfer.row(i).node();      
                let select2ElementId = $(row).find('select[id^="entrijurnal"]'); 
                let narasiakunInputId = $(row).find('input[id^="narasiakun"]');
                let debitInputId = $(row).find('input[id^="debit"]').attr('id');
                let kreditInputId = $(row).find('input[id^="kredit"]').attr('id');
                let debitValue = entridebit[getFullNumberFromString(debitInputId)] ? entridebit[getFullNumberFromString(debitInputId)].getNumber() : 0;
                totaldebit += debitValue;
                let dataJurnal = {
                    kodecoa: select2ElementId.val(),
                    narasiakun: narasiakunInputId.val(),
                    debit: (jenistransaksiurl == "kasmasuk" ? 0 : debitValue ),
                    kredit: (jenistransaksiurl == "kasmasuk" ? debitValue : 0 ),
                };
                if (select2ElementId.val() === null || select2ElementId.val() === ""){
                    return toastr["error"]("Kode COA dalam entri jurnal wajib diisi. Silahkan tentukan kode COA pada baris "+$(row).find('td').eq(0).text());
                }
                dataEntriJurnal.push(dataJurnal);
            }
            const datatrxentrijurnal = {
                notransaksi: $('#siak_notransaksi').val(),
                tanggaltrx: $("#tanggalentrijurnal").val().split("-").reverse().join("-"),
                narasientrijurnal: quillnya.root.innerHTML,
                totaldebit: totaldebit,
                totalkredit: totaldebit,
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
                        JENISJURNAL : (jenistransaksiurl == "kasmasuk" ? "KM" : "KK" ),
                    },
                    success: function (response) {
                        if (response.success == true){
                            Swal.fire({
                                title: "Entri "+(jenistransaksiurl == "kasmasuk" ? " Terima" : "Kirim")+" Kas Bank Berhasil Dicatat",
                                text: response.msg,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Entri Jurnal Kas Bank Baru!!',
                                cancelButtonText: 'Kembali Ke Daftar Jurnal!!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    bersihkanformulir()
                                }else{
                                    window.location.href = baseurljavascript+'akuntansi/kasdanbank/'+(jenistransaksiurl == "kasmasuk" ? " kasmasuk" : "kaskeluar");
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
    $('#totaldebit').html(formatuang(0,'id-ID','IDR'));
    tabelentrikasbanktransfer.clear().draw();
}
$("#btnsimpanentrijurnal").on("click", function() {
    simpanentrijurnal()
});
</script>
<?= $this->endSection(); ?>