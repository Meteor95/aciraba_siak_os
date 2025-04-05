<div class="modal fade" id="modalpilihsuplier" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Pilih Suplier Yang Tersedia</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <input id="txtpencariansuplier" type="text" class="form-control mt-2" placeholder="Masukkan nama / kode suplier"><hr>
            <table id="admin_daftarsuplier" class="table table-bordered table-striped table-hover nowrap">
                <thead>
                    <tr>
                        <th style="text-align:center">Aksi</th>
                        <th style="text-align:center">Kode Suplier</th>
                        <th style="text-align:center">Nama Suplier</th>
                        <th style="text-align:center">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align:center">Aksi</th>
                        <th style="text-align:center">Kode Suplier</th>
                        <th style="text-align:center">Nama Suplier</th>
                        <th style="text-align:center">Alamat</th>
                    </tr>
                </tfoot>
            </table>
            </div>
            <div class="modal-footer">
            <p class="mb-0">Suplier akan ditampilkan pada semua status baik aktif maupun tidak aktif, gunakan pencarian beradasarkan KODE atau NAMA suplier guna mencari informasi suplier yang spesifik. Data ditampilkan per pencarian maximal 50 Data</p>
            </div>
        </div>
    </div>
</div>
<!-- END Modal -->
<script>
    var kondisi = '<?= $SEGMENT ;?>'
    $(document).ready(function () {
        getCsrfTokenCallback(function() {
            $("#admin_daftarsuplier").DataTable({
                retrieve: true,
                ordering: true,
                order: [[0, 'desc']],
                language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
                ajax: {
                    "url": baseurljavascript + 'pembelian/modaldaftarsuplier',
                    "type": "POST",
                    "data": function (d) {
                        d.csrf_aciraba = csrfTokenGlobal;
                        d.KATAKUNCIPENCARIAN = $("#txtpencariansuplier").val();
                    }
                },
                scrollCollapse: true,
                scrollY: "50vh",
                scrollX: true,
                bFilter: false,
            }); 
        }); 
    });
    $("#txtpencariansuplier").on('input focus keypress keydown', debounce(function(e) {
        getCsrfTokenCallback(function() {
            $('#admin_daftarsuplier').DataTable().ajax.reload();
        });
    }, 500))
    function pilihsuplier(namasup, alamatsup, notelpsub, kodesup) {
        if (kondisi == "formhutang"){
            $("#pencariannamasuplier").val(kodesup);
            filtermaubayarhutang()
            $('#modalpilihsuplier').modal('hide');
        }else if (kondisi == "formreturpembelian"){
            $("#kodesuplier").html(kodesup);
            $("#namasuplier").html(namasup);
            $("#alamatsuplier").html(alamatsup);
            $('#tabelreturpotonghutang').DataTable().ajax.reload();
            $('#modalpilihsuplier').modal('hide');
        }
    }
</script>