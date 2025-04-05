let dataJenisArus = "";
$(function () {
    loadkartustok();
    $('#filterawalkartustok').val(moment().format('DD-MM-YYYY'));
    $("#filterawalkartustok").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#filteraakhirkartustok').val(moment().format('DD-MM-YYYY'));
    $("#filteraakhirkartustok").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
});
function loadkartustok() {
    getCsrfTokenCallback(function() {
        $("#tabelkartustok").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            dom: 'Bfrtip',
            buttons: [
                {
                    extend:    'copyHtml5',
                    text:      '<i class="far fa-copy"></i> Copy',
                    titleAttr: 'Copy'
                },
                {
                    extend:    'excelHtml5',
                    text:      '<i class="far fa-file-excel"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend:    'csvHtml5',
                    text:      '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="far fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                }
            ],
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true,
            bFilter: false,
            ordering: false,
            columnDefs: [
                {
                    className: "text-right",
                    targets: [5, 6, 7, 8,9,10]
                },
            ],
            ajax: {
                "url": baseurljavascript + 'masterdata/jsonproseskartustok',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KODEITEM = $('#kodebarangkartustok').val();
                    d.ORDERBY = "DESC";
                    d.JENISARUSBARANG = $("#jenistranskasikartustok").val();
                    d.DATAJENIS = dataJenisArus;
                    d.KONDISIPERIODE = $('#filterberdasarkantanggal').is(":checked") == true ? "1" : "0";
                    d.PERIODEAWAL = $('#filterawalkartustok').val();
                    d.PERIODEAKHIR = $('#filteraakhirkartustok').val();
                    d.OUTLET = session_outlet;
                    d.KODEUNIKMEMBER = session_kodeunikmember;
                    d.DATAKE = 0;
                    d.LIMIT = 500;
                },
            },
            fnInitComplete: function(oSettings, json) {
                getCsrfTokenCallback(function() {});
            }
        });
    });
}
$("#proseskartustok").on("click", function(){
    switch($("#jenistranskasikartustok").val()) {
        case "Semua":
            dataJenisArus = "";
            break;
        case "Transaksi Pembelian":
            dataJenisArus = "TRSPMB";
            break;
        case "Transaksi Penjualan":
            dataJenisArus = "TRSKSR";
            break;
        case "Mutasi":
            dataJenisArus = "MTS";
            break;
        case "Retur Pembelian":
            dataJenisArus = "RTPB";
            break;
        case "Retur Penjualan":
            dataJenisArus = "RTRPJ";
            break;
        default:
            dataJenisArus = "";
    }
    getCsrfTokenCallback(function() {
        $('#tabelkartustok').DataTable().ajax.reload();
    });
});