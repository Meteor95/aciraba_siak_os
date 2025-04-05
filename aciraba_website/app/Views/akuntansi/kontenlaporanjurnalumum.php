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
                            <button id="" class="btn btn-danger"> <i class="fa-solid fa-file-pdf"></i> Format PDF</button>
                            <button id="prosesjurnalumum" class="btn btn-success float-right"> <i class="fas fa-cog"></i> Proses Cek</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label>Jurnal Perusahaan</label>
                                <select class="form-control" id="pilihperusahaan">
                                <?php if($kodesubperusahaan != "0"){
                                    echo '<option value="'.$kodesubperusahaan.'">['.$kodesubperusahaan.'] '.$namaperusahaan.'</option>';
                                }else{ echo '<option value="0">[0] Perusahaan Induk</option>'; }
                                ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="kodeitemdiskon">Pilih Kode COA Jurnal</label>
                                <?php if($kodesubperusahaan != "0"){ echo generateSelectTreeViewledger(json_decode($informasidata,true),"pilihcoajurnal", 1);}
                                else{ echo "<select id=\"pilihcoajurnal\"></select>";}
                                ?>
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input id="daritanggal" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="sampaitanggal" type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabeljurnalumum" class="hovercolor table table-bordered table-striped table-hover nowrap"></table>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
let informasidata = JSON.stringify('<?=$informasidata;?>'), awalperiode = '<?=$awalperiode;?>', akhirperiode = '<?=$akhirperiode;?>';
$(document).ready(function () {
$('#pilihcoajurnal').select2({placeholder: 'Pilih Kode COA',});
$('#pilihcoajurnal').val("ALL").trigger('change.select2');
$('#daritanggal').val(awalperiode);
$('#sampaitanggal').val(akhirperiode);
$(".input-daterange").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom left",startDate: new Date(awalperiode.split("-").reverse().join("-")),endDate: new Date(akhirperiode.split("-").reverse().join("-")), });
getCsrfTokenCallback(function() {
tabelentrijurnaltabel = $("#tabeljurnalumum").DataTable({
    language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
    dom: 'rtip',
    scrollCollapse: true,
    scrollX: true,
    bFilter: false,
    bInfo : false,
    ordering: false,
    bPaginate: false,
    bProcessing: true, 
    ajax: {
        "url": baseurljavascript + 'akuntansi/jurnalumumajax',
        "type": "POST",
        "data": function (d) {
            d.csrf_aciraba = csrfTokenGlobal;
            d.KODECOA = $('#pilihcoajurnal').val();
            d.AWALTANGGAL = $('#daritanggal').val();
            d.AKHIRTANGGAL = $('#sampaitanggal').val();
            d.SUBPERUSAHAAN = $('#pilihperusahaan').val();
        },
        "dataSrc": function (json) {
            if (!json || !json.data || !json.data.jurnalumum) {
                console.warn("DataTables: Data undefined atau tidak ada");
                return [];
            }
            return json.data.jurnalumum[0].informasijurnalumum; 
        }
    },
    rowGroup: {
        dataSrc:function(row) {
            return row.NOTRX;
        },
        startRender: function ( rows, group ) {
            stringkolom1 = "<th style='background-color:#CAF4FF;vertical-align : middle;'>Waktu Trx : "+convertISOToDDMMYYYYHHMMSS(rows.data()[0].WAKTUTRX)+"<br>Akun</th>"
            stringkolom2 = "<th style='background-color:#CAF4FF;vertical-align : middle;'>No Trx : "+ group + "<br>Golongan</th>"
            return $('<tr style="color:red">')
                .append(stringkolom1)
                .append(stringkolom2)
                .append("<th style='background-color:#CAF4FF;vertical-align : middle;text-align:center'>Debit (IDR)</th>")
                .append("<th style='background-color:#CAF4FF;vertical-align : middle;text-align:center'>Kredit (IDR)</th>")
                .append('</tr>');
        },
        endRender: function ( rows, group ) {
           
        },      
    },
    columnDefs: [{
        defaultContent: "-",
        targets: "_all"
    }],
    columns: [
        {
            render: function(data, type, row, meta) {
                if (type === 'display') {
                    return row.KODE_COA_GROUP+" "+row.NAMA_COA_GROUP;
                }
                return '';
            }
        },
        {
            render: function(data, type, row, meta) {
                if (type === 'display') {
                    return ubahstringgolonganjurnal(row.JENISJURNAL);
                }
                return '';
            }
        }, 
        {
            render: function(data, type, row, meta) {
                if (type === 'display') {
                    if (row.DEBITKREDIT == 'D'){
                        return '<div style="text-align:right">'+formatRupiah(row.NOMINAL_JURNAL)+'</div>';
                    }else{
                        return '<div style="text-align:right">'+formatRupiah(0)+'</div>';
                    }
                }
                return '';
            }
        }, 
        {
            render: function(data, type, row, meta) {
                if (type === 'display') {
                    if (row.DEBITKREDIT == 'K'){
                        return '<div style="text-align:right">'+formatRupiah(row.NOMINAL_JURNAL)+'</div>';
                    }else{
                        return '<div style="text-align:right">'+formatRupiah(0)+'</div>';
                    }
                }
                return '';
            }
        }
    ],
})
});
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
        $('#pilihcoajurnal').html("<select id=\"pilihcoajurnal\"></select>");
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
                    let datalama = JSON.parse(informasidata);
                    datalama.unshift({"ID": 'ALL', "KODE_COA_GROUP": "ALL", "PARENT_ID": -1, "NAMA_COA_GROUP": "Tampilkan Semua Kode COA", "DEFAULTINPUT": "ALL", "JENISAKUN": "LEDGER", "SALDOAWAL": 0, "SALDOAWALDC": "", "ISDELETE": "false", "LEVEL": 1, "KASBANK": "false", "NAMAPERUSAHAAN": "CV ANUGERAH SEJATI", "children": []});
                    informasidata = JSON.stringify(datalama);
                    const selectCoaAsal = generateSelectTreeViewledger(informasidata, "pilihcoajurnal");
                    $('#pilihcoajurnal').select2({placeholder: 'Pilih Kode COA',});
                    $('#pilihcoajurnal').html(selectCoaAsal.outerHTML);
                    $('#pilihcoajurnal').val("ALL").trigger('change.select2');
                }
            }
        });
    });
});
});
$("#prosesfilterentrijurnal").on("click", function () {
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'akuntansi/ajaxkasbanktotal',
        method: 'POST',
        dataType: 'json',
        data: {
            csrf_aciraba: csrfTokenGlobal,
            SUBPERUSAHAAN: $('#pilihperusahaan').val(),
        },
        complete:function(){},
        success: function (response) {
            $("#kasmasuk").html(formatRupiah(response.kasmasukbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL,"Rp "))
            $("#kaskeluar").html(formatRupiah(response.kaskeluarbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL,"Rp "))
            $("#sisakasmasukkeluar").html(formatRupiah((response.kasmasukbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL - response.kaskeluarbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL),"Rp "))
            $("#totalkassaatini").html(formatRupiah(response.totalkasbulanini[0].informasientrijurnal[0].NOMINAL_JURNAL,"Rp "))
        }
    });
});        
});
$("#prosesjurnalumum").on("click", function () {
    $('#tabeljurnalumum').DataTable().ajax.reload();
});
</script>
<?= $this->endSection(); ?>