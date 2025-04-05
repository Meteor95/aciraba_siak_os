<!-- BEGIN Modal -->
<div class="modal fade" id="panggildaftarmember">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Pilih Member</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <input name="daftaritem_katakunci" type="text" class="form-control mb-2" id="katakuncipencarian" placeholder="Masukan kata kunci yang anda inginkan">
                <!-- BEGIN Datatable -->
                <table id="pilihdaftarmember" class="ogrid table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th style="text-align:center">Kode Member</th>
                            <th style="text-align:center">Nama Member</th>
                            <th style="text-align:center">Alamat</th>
                            <th style="text-align:center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align:center">Kode Member</th>
                            <th style="text-align:center">Nama Member</th>
                            <th style="text-align:center">Alamat</th>
                            <th style="text-align:center">Aksi</th>
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
        setTimeout(function() {
            $("#pilihdaftarmember").DataTable({
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
                    "url": baseurljavascript + 'masterdata/ajaxdaftarmember',
                    "method": 'POST',
                    "data": function (d) {
                        d.KATAKUNCIPENCARIAN = $('#katakuncipencarian').val() == null ? "" : $('#katakuncipencarian').val();
                        d.KONDISIQUERY = '1';
                        d.DIMANA1 = "ASCKODEMEMBER";
                        d.MEMBERGROUP = "";
                        d.RANGEAWAL = "";
                        d.RANGEAKHIR = "";
                        d.STATUSMEMBER = 1;
                        d.ISFILTERDATE = "false";
                        d.DARIPANGGILBARANG = "true";
                        d.KONDISIDARI = '<?= $SEGMENT;?>';
                        d.KODEUNIKMEMBER = session_kodeunikmember;
                        d.DATAKE = 0;
                        d.LIMIT = 100;
                    },
                }
            });
        }, 1000);
    });
    $('#katakuncipencarian').on('input', debounce(function (e) {
        $('#pilihdaftarmember').DataTable().ajax.reload();
    }, 500));

    function onclickplihmember(kodemember, namamember, alamat, kondisi) {
        if (kondisi == "tambahreturpenjualan") {
            $("#kodepelanggan").html(kodemember);
            $("#namapelanggan").html(namamember);
            $("#namapelanggan1").html(namamember);
            $("#alamatpelanggan").html(alamat);
            getCsrfTokenCallback(function() {
                $('#datareturpotongpiutang').DataTable().ajax.reload();
            });
            $('#panggildaftarmember').modal('hide');
        }else  if (kondisi == "detailreturpenjualan") {
            Swal.fire({
                icon: 'error',
                html: "Anda tidak dapat mengganti informasi pelanggan pada nota ini.<br>Silahkan <strong>HAPUS TRANSAKSI RETUR</strong> terlebih dahulu kemudian sesuaikan informasi pelanggannya",
                toast: true,
                showConfirmButton: false,
                timer: 4000,
                position: 'top-right'
            })
            
            $('#panggildaftarmember').modal('hide');
        }else  if (kondisi == "bayarpiutang") {
            $('#pencariannamamember').val(kodemember);
            $('#kodememberterpilih').html(kodemember),
            filtermaubayarpiutang();
            $('#panggildaftarmember').modal('hide');
        }
    }
</script>