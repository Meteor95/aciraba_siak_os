<!-- BEGIN Modal -->
<div class="modal fade" id="modal6">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Pilih Item</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <input name="daftaritem_katakunci" type="text" class="form-control mb-2 mt-2" id="daftaritem_katakunci_panggil" placeholder="Masukan kata kunci yang anda inginkan">
                <div class="row">
                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="stokhanyaretur">
                            <label class="custom-control-label" for="stokhanyaretur">Stok Hanya Retur</label>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- BEGIN Datatable -->
                <table id="pangil_daftarabarang" class="dataTable table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th align="center">Kode Item</th>
                            <th align="center">Nama Item</th>
                            <th align="center">Harga Jual</th>
                            <th align="center">Stok Tersedia</th>
                            <th align="center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Kode Item</th>
                            <th align="center">Nama Item</th>
                            <th align="center">Harga Jual</th>
                            <th align="center">Stok Tersedia</th>
                            <th align="center">Aksi</th>
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
        $("#pangil_daftarabarang").DataTable({
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
                "url": baseurljavascript + 'masterdata/panggilbarangglobal',
                "type": "POST",
                "data": function (d) {
                    let kondisipilihbarang = "S";
                    if ($('#stokhanyaretur').is(':checked')) {
                        kondisipilihbarang = "r";
                    }else{
                        kondisipilihbarang = "s";
                    }
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.DIMANA2 = $("#daftaritem_katakunci_panggil").val();
                    d.DIMANA3 = "kombinasi";
                    d.DIMANA4 = kondisipilihbarang;
                    d.DIMANA6 = session_outlet;
                    d.DIMANA8 = statusbarang;
                    d.DIMANA10 = session_kodeunikmember;
                    d.DATAKE = '0';
                    d.LIMIT = '50';
                    d.KONDISIDARI = '<?= $SEGMENT;?>';
                }
            },
        });
    });
    $("#daftaritem_katakunci_panggil").on('input focus keypress keydown', debounce(function(e) {
        $('#pangil_daftarabarang').DataTable().ajax.reload();   
    }, 500))
    function onclickplihbarang(kodeitem, namaitem, harga, kondisi) {
        let addrows = true;
        if (kondisi == "daftaritemdetail") {
            if ($("#modalPecahsatuan").data('bs.modal')?._isShown){
                $("#kodebarangpecahsatuan").val(kodeitem);
                $("#namabarangpecahsatuan").val(namaitem);
                $("#hargajualbaru").val(harga.replace('IDR','').replace(',',''));
                $('#modal6').modal('hide');
            }else{
                var data = $('#bonusbarangitem').DataTable().rows().data();
                data.each(function (isidatatable, index) {
                    var temp = new Array();
                    temp = isidatatable.toString().split(",");
                    if (temp[0] == kodeitem) {
                        addrows = false;
                        return false;
                    }
                });
                if (addrows == true){
                    $('#bonusbarangitem').DataTable().row.add([
                        kodeitem,
                        namaitem,
                        "<input name=\"bonusitem[]\" class=\"form-control\" type=\"text\" value=\"1\">",
                        "<div><button class=\"hapusbonusbarang btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>",
                    ]).draw(false);
                    Swal.fire({
                        icon: 'success',
                        target: document.getElementById('modal6'),
                        text: namaitem + ' telah ditambahkan',
                        toast: true,
                        showConfirmButton: false,
                        timer: 1500,
                        position: 'top-right'
                    })
                }else{
                    Swal.fire({
                        icon: 'warning',
                        target: document.getElementById('modal6'),
                        text: namaitem + ' sudah ada, pilih yang lainnya',
                        toast: true,
                        showConfirmButton: false,
                        timer: 1500,
                        position: 'top-right'
                    })
                }
            }
        }else if (kondisi == "formpembelian"){
            $("#katakuncibarang").val(kodeitem);
            panggilinformasibarang();
            $('#modal6').modal('hide');
        }else if (kondisi == "formmutasiitem"){
            $("#katakuncipencariankasir").val(kodeitem);
            panggilinformasibarangmutasi();
            $('#modal6').modal('hide');
        }else if (kondisi == "formpenyesuianstok"){
            $("#katakuncipencariankasir").val(kodeitem);
            panggilinformasibarang();
            $('#modal6').modal('hide');
        }else if (kondisi == "daftarkartustok"){
            $("#kodebarangkartustok").val(kodeitem);
            $('#modal6').modal('hide');
        }else if (kondisi == "tambahdiskonitem"){
            $("#textkodebarangdiskon").html("Kode Item : "+kodeitem);
            $("#textnamabarangdiskon").html("Nama Barang : "+namaitem);
            $("#texthargajualumumdiskon").html("Harga Jual Barang : "+harga);
            $('#modal6').modal('hide');
        }else if (kondisi == "tambahreturpenjualan" || kondisi == "detailreturpenjualan" || kondisi == "formreturpembelian"){
            informasibarang(kodeitem);
            $('#modal6').modal('hide');
        }
        $("#daftaritem_katakunci_panggil").focus();
    }
</script>