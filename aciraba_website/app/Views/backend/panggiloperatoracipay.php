<!-- BEGIN Modal -->
<div class="modal fade" id="modal6">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Pilih Operator</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <input autofocus name="daftaritem_katakunci" type="text" class="form-control mb-2" id="daftaritem_katakunci_panggil" placeholder="Masukan kata kunci yang anda inginkan">
                
                <!-- BEGIN Datatable -->
                <table id="pangil_daftaroperator" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th align="center">Aksi</th>
                            <th align="center">Kode Operator</th>
                            <th align="center">Nama Operator</th>
                            <th align="center">Prefix</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Aksi</th>
                            <th align="center">Kode Operator</th>
                            <th align="center">Nama Operator</th>
                            <th align="center">Prefix</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- END Datatable -->
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->
<script>
    $(function () {
        $("#pangil_daftaroperator").DataTable({
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
            ajax: {
                "url": baseurljavascript + 'acipay/ajaxoperatordt',
                "method": 'POST',
                "data": function (d) {
                    d.KATAKUNCI = $("#daftaritem_katakunci_panggil").val();
                    d.DARIPPILIHOPERATOR = 1;
                    d.SEGMENT = "<?= $SEGMENT ;?>";
                    d.DATAKE = 0;
                    d.LIMIT = 500;
                },
            },
        });
    });
    $('#daftaritem_katakunci_panggil').on('input', debounce(function (e) {
        $('#pangil_daftaroperator').DataTable().ajax.reload();
    }, 500));

    function onclickplihbarang(operatorid, operatornama, kondisi) {
        let addrows = true;
        if (kondisi == "produknonppobkategori"){
            $("#operatorproduk").val(operatorid+" - "+operatornama);
            $('#modal6').modal('hide');
        }
        $("#daftaritem_katakunci_panggil").focus();
    }
</script>