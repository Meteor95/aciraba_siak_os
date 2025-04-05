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
                                    <?php if($kodesubperusahaan != ""){
                                        echo '<option value="'.$kodesubperusahaan.'">['.$kodesubperusahaan.'] '.$namaperusahaan.'</option>';
                                    }else{
                                        echo '<option value="0">[0] Perusahaan Induk</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="kodeitemdiskon">Pilih Kode COA Jurnal</label>
                                <?php if($kodesubperusahaan != ""){ echo generateSelectTreeViewledger($informasidata,"pilihcoaledgeredit", 1);}
                                else{
                                    echo "<select id=\"pilihcoaledgeredit\"></select>";
                                }
                                ?>
                                <!-- END Select -->
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
let kodecoa = '<?=$akuncoa;?>'
$(document).ready(function () {
    $("#pilihcoaledgeredit").select2({dropdownAutoWidth:true});
    $('#pilihcoaledgeredit').val(kodecoa).trigger('change');
    getCsrfTokenCallback(function() {
        /*
        Gunakan rumus Saldo Akhir = Saldo Awal + Mutasi Debit - Mutasi Kredit untuk menghitung saldo akhir dengan asumsi default input debit.
        Gunakan rumus Saldo Akhir = Saldo Awal - Mutasi Debit + Mutasi Kredit untuk menghitung saldo akhir dengan asumsi default input kredit.
        */
        let currentSaldo = 0, saldoawalinit = 0, saldoakhirinit = 0,currentopeningBalanceinit = "",currentclosingBalanceinit = "",currentopeningBalanceinitdi = "",currentclosingBalanceinitdi = "";
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
                "url": baseurljavascript + 'akuntansi/bukubesarajax',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KODECOA = $('#pilihcoaledgeredit').val();
                    d.AWALTANGGAL = $('#daritanggal').val();
                    d.AKHIRTANGGAL = $('#sampaitanggal').val();
                    d.SUBPERUSAHAAN = $('#pilihperusahaan').val();
                },
                "dataSrc": function (json) {
                    saldoawalinit = 0, saldoakhirinit = 0
                    if (!json || !json.data || !json.data.detailjurnal) {
                        console.warn("DataTables: Data undefined atau tidak ada");
                        return [];
                    }
                    let detailJurnal = json.data.detailjurnal[0].data;
                    let openingBalance = json.data.openingBalance;
                    let closingBalance = json.data.closingBalance;
                    currentSaldo = parseFloat(openingBalance.amount);
                    currentSaldoDC = openingBalance.dc;
                    
                    saldoawalinit = json.data.openingBalance.amount;
                    saldoakhirinit = json.data.closingBalance.amount;
                    currentopeningBalanceinit =json.data.openingBalance.dc;
                    currentclosingBalanceinit =json.data.closingBalance.dc;
                    currentopeningBalanceinitdi =json.data.openingBalance.di;
                    currentclosingBalanceinitdi =json.data.closingBalance.di;
                    let mergedData = detailJurnal.map(item => {
                        return {
                            ...item,
                            openingDC: openingBalance.dc,
                            openingAmount: openingBalance.amount,
                            closingDC: closingBalance.dc,
                            closingAmount: closingBalance.amount
                        };
                    });
                    return mergedData; 
                }
            },
            initComplete: function(settings, json) {
                let headvalue = 0, footvalue = 0
                if (json.data.detailjurnal) {
                    if (((json.data.openingBalance.di == "D" && json.data.openingBalance.dc == 'K') || (json.data.openingBalance.di == "K" && json.data.openingBalance.dc == "D")) && json.data.openingBalance.amount != 0) {
                        headvalue = "("+formatRupiah(json.data.openingBalance.amount)+")";
                    }else{
                        headvalue = formatRupiah(json.data.openingBalance.amount);
                    }
                    if (((json.data.closingBalance.di == "D" && json.data.closingBalance.dc == 'K') || (json.data.closingBalance.di == "K" && json.data.closingBalance.dc == "D")) && json.data.closingBalance.amount != 0) {
                        footvalue = "("+formatRupiah(json.data.closingBalance.amount)+")";
                    }else{
                        footvalue = formatRupiah(json.data.closingBalance.amount);
                    }
                }
                $("#tabeljurnalumum thead").prepend("<tr><th colspan=7 style=\"text-align:left\">Saldo Awal Saat Ini</th><th style=\"text-align:right\">"+headvalue+"</th></tr>");
                if ($("#tabeljurnalumum tfoot").length === 0) {$("#tabeljurnalumum").append("<tfoot></tfoot>");}
                $("#tabeljurnalumum tfoot").html("<tr><th colspan=7 style=\"text-align:left\">Saldo Akhir Saat Ini</th><th style=\"text-align:right\">"+footvalue+"</th></tr>");
            },
            drawCallback: function(settings) {
                if (((currentopeningBalanceinitdi == "D" && currentopeningBalanceinit == 'K') || (currentopeningBalanceinitdi == "K" && currentopeningBalanceinit == "D")) && saldoawalinit != 0) {
                    headvalue = "("+formatRupiah(saldoawalinit)+")";
                }else{
                    headvalue = formatRupiah(saldoawalinit);
                }
                if ((currentclosingBalanceinitdi == "D" && currentclosingBalanceinit == 'K') || (currentclosingBalanceinitdi == "K" && currentclosingBalanceinit == "D") && saldoakhirinit != 0) {
                    footvalue = "("+formatRupiah(saldoakhirinit)+")";
                }else{
                    footvalue = formatRupiah(saldoakhirinit);
                }
                $("#tabeljurnalumum thead").prepend("<tr><th colspan=7 style=\"text-align:left\">Saldo Awal Saat Ini</th><th style=\"text-align:right\">"+headvalue+"</th></tr>");
                if ($("#tabeljurnalumum tfoot").length === 0) {$("#tabeljurnalumum").append("<tfoot></tfoot>");}
                $("#tabeljurnalumum tfoot").html("<tr><th colspan=7 style=\"text-align:left\">Saldo Akhir Saat Ini</th><th style=\"text-align:right\">"+footvalue+"</th></tr>");
            },
            columnDefs: [{
                defaultContent: "-",
                targets: "_all"
            }],
            columns: [
                {
                    title: "No",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return meta.row + 1;
                        }
                        return data;
                    }
                },
                {
                    title: "Tanggal",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return moment(row.WAKTUTRX).format('DD-MM-YYYY HH:mm:ss');
                        }
                        return '';
                    }
                }, 
                {
                    title: "No Jurnal Transaksi",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return row.NOTRX;
                        }
                        return '';
                    }
                }, 
                {
                    title: "Narasi",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return row.NARASIITEM;
                        }
                        return '';
                    }
                },
                {
                    title: "Golongan",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return ubahstringgolonganjurnal(row.JENISJURNAL);
                        }
                        return '';
                    }
                }, 
                {
                    title: "Debit (IDR)",
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
                    title: "Kredit (IDR)",
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
                }, 
                {
                    title: "SALDO (IDR)",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            const nominalJurnal = row.NOMINAL_JURNAL;
                            const entry_balance = calculate_withdc(
                                currentSaldo,
                                currentSaldoDC,
                                nominalJurnal,
                                row.DEBITKREDIT,
                                row.DEFAULTINPUT
                            );
                            currentSaldo = entry_balance.amount;
                            currentSaldoDC = entry_balance.dc
                            if ((entry_balance.di == "D" && entry_balance.dc == 'K') || entry_balance.di == "K" && entry_balance.dc == "D") {
                                return '<div style="text-align:right">' + "("+formatRupiah(currentSaldo)+")" + '</div>';
                            }
                            return '<div style="text-align:right">' + formatRupiah(currentSaldo) + '</div>';
                        }
                        return '';
                    }
                },
            ],
        })
    });
    $('#daritanggal').val(moment().startOf('month').format('DD-MM-YYYY'));
    $('#sampaitanggal').val(moment().format("DD-MM-YYYY"));
    $(".input-daterange").datepicker({
        todayHighlight: true,
        format:'dd-mm-yyyy',
        orientation: "bottom left",
    });
    $('#pilihcoaledgeredit').select2({placeholder: 'Pilih Kode COA',});
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
        $('#pilihcoaledgeredit').html("<select id=\"pilihcoaledgeredit\"></select>");
        $.ajax({
            url: baseurljavascript + 'akuntansi/getcoaentrijurnal',
            method: 'POST',
            dataType: 'json',
            data: {
                csrf_aciraba: csrfTokenGlobal,
                KODESUBPERUSAHAAN: selectedValue,
            },
            success: function(res){
                let informasidata = JSON.stringify(res);
                const selectCoa = generateSelectTreeViewledger(informasidata, "pilihcoaledgeredit");
                $('#pilihcoaledgeredit').select2({
                    placeholder: 'Pilih Kode COA',
                });
                $('#pilihcoaledgeredit').html(selectCoa.outerHTML);
            }
        });
    });
});
});
$("#prosesjurnalumum").on("click", function () {
    $('#tabeljurnalumum').DataTable().ajax.reload();
});
</script>
<?= $this->endSection(); ?>