<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <a href="<?= base_url() ;?>pembelian/formhutang"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Tambah Pembayaran Hutang</button></a>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN Portlet -->
                            <div class="portlet mb-md-0">
                                <div class="portlet-body">
                                    <div class="mb-3">
                                        <!-- BEGIN Nav -->
                                        <div class="nav nav-lines" id="nav1-tab">
                                            <a class="nav-item nav-link active" id="nav1-home-tab" data-toggle="tab"
                                                href="#nav1-home">Hutang Toko</a>
                                            <a class="nav-item nav-link " id="nav1-profile-tab"
                                                data-toggle="tab" href="#nav1-profile">Pembayaran Hutang</a>
                                        </div>
                                        <!-- END Nav -->
                                    </div>
                                    <!-- BEGIN Tab -->
                                    <div class="tab-content" id="nav1-tabContent">
                                        <div class="tab-pane fade show active" id="nav1-home">
                                        <div class="portlet-body">
                                            <!-- BEGIN Form Row -->
                                            <div class="form-row">
                                                <div class="col-md-4 mb-1 col-sm-12">
                                                    <label for="katakuncipencarianhutangtoko">Kode - Nama Suplier / No Transaksi</label>
                                                    <input type="text" class="form-control" id="katakuncipencarianhutangtoko" placeholder="Masukan kata kunci yang anda inginkan">
                                                </div>
                                                <div class="col-md-5 mb-1 col-sm-12">
                                                    <label>Tentukan Tanggal Jatuh Tempo</label>
                                                    <div class="input-group input-daterange">
                                                        <input id="tanggalawalhis" type="text" class="form-control" placeholder="Dari Tanggal">
                                                        <div class="input-group-prepend input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-ellipsis-h"></i>
                                                            </span>
                                                        </div>
                                                        <input id="tanggalakhirhis" type="text" class="form-control" placeholder="Sampai Tanggal">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-1 col-sm-12">
                                                    <button id="prosescari" class="btn btn-success float-right mt-4"><i class="fas fa-search"></i> Proses Data</button> 
                                                </div>
                                            </div>
                                            <!-- END Form Row -->
                                            <hr>
                                            <!-- BEGIN Datatable -->
                                            <table id="daftarhutangtoko" class="table table-bordered table-striped table-hover nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Aksi</th>
                                                        <th>No Transaksi</th>
                                                        <th>Kode Suplier</th>
                                                        <th>Nama Suplier</th>
                                                        <th>Tanggal Transaksi</th>
                                                        <th>Jatuh Tempo</th>
                                                        <th>Petugas</th>
                                                        <th>Total Hutang</th>
                                                        <th>Sisa Hutang</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Aksi</th>
                                                        <th>No Transaksi</th>
                                                        <th>Kode Suplier</th>
                                                        <th>Nama Suplier</th>
                                                        <th>Tanggal Transaksi</th>
                                                        <th>Jatuh Tempo</th>
                                                        <th>Petugas</th>
                                                        <th>Total Hutang</th>
                                                        <th>Sisa Hutang</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <!-- END Datatable -->
                                        </div>
                                        </div>
                                        <div class="tab-pane fade " id="nav1-profile">
                                            <p align="justify">Utang (hutang) atau pinjaman adalah tanggungan wajib yang harus dibayar karena adanya transaksi pembelian suatu barang atau jasa secara kredit, dan harus dibayar dalam jangka waktu tertentu. Dalam dunia akuntansi, pinjaman artinya pengorbanan ekonomis untuk kepentingan masa depan yang berbentuk penyerahan aktiva dan jasa, serta sudah ada kesepakatan dengan dua belah pihak di masa lalu.</p>
                                            <div class="row">
                                                <div class="col-md-4 mb-1 col-sm-12">
                                                    <label for="katakuncipembayaranhutang">Kode - Nama Suplier / No Transaksi</label>
                                                    <input type="text" class="form-control" id="katakuncipembayaranhutang" placeholder="Masukan kata kunci yang anda inginkan">
                                                </div>
                                                <div class="col-md-5 mb-1 col-sm-12">
                                                    <label>Tentukan Tanggal Transaksi Bayar Hutang</label>
                                                    <div class="input-group input-daterange">
                                                        <input id="tanggalawalhisbayar" type="text" class="form-control" placeholder="Dari Tanggal">
                                                        <div class="input-group-prepend input-group-append">
                                                            <span class="input-group-text">
                                                                <i class="fa fa-ellipsis-h"></i>
                                                            </span>
                                                        </div>
                                                        <input id="tanggalakhirhisbayar" type="text" class="form-control" placeholder="Sampai Tanggal">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-1 col-sm-12">
                                                    <button id="prosescaribayar" class="btn btn-success float-right mt-4"><i class="fas fa-search"></i> Proses Data</button> 
                                                </div>
                                            </div>
                                            <table id="daftarpembayaranhutang" class="table table-bordered table-striped table-hover nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Aksi</th>
                                                        <th>No Transaksi</th>
                                                        <th>Waktu Transaksi</th>
                                                        <th>Nominal</th>
                                                        <th>Nama Petugas</th>
                                                        <th>Kode Suplier</th>
                                                        <th>Nama Suplier</th>
                                                        <th>Nota Retur</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Aksi</th>
                                                        <th>No Transaksi</th>
                                                        <th>Waktu Transaksi</th>
                                                        <th>Nominal</th>
                                                        <th>Nama Petugas</th>
                                                        <th>Kode Suplier</th>
                                                        <th>Nama Suplier</th>
                                                        <th>Nota Retur</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END Tab -->
                                </div>
                            </div>
                            <!-- END Portlet -->
                        </div>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detailpembayaranhutang">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pembayaran No Transkasi : <span id="nopembayaranhutang"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-12">
                <div id="kartuhutang"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('#tanggalawalhis').val(moment().startOf('month').format('DD-MM-YYYY'));
    $("#tanggalawalhis").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
    $('#tanggalakhirhis').val(moment().endOf('month').format('DD-MM-YYYY'));
    $("#tanggalakhirhis").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
    $('#tanggalawalhisbayar').val(moment().startOf('month').format('DD-MM-YYYY'));
    $("#tanggalawalhisbayar").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
    $('#tanggalakhirhisbayar').val(moment().endOf('month').format('DD-MM-YYYY'));
    $("#tanggalakhirhisbayar").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom" });
    getCsrfTokenCallback(function() {
        $("#daftarhutangtoko").DataTable({
            language: {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    text: '<i class="far fa-copy"></i> Copy',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="far fa-file-excel"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="far fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                }
            ],
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true,
            bFilter: false,
            columnDefs: [
                //{className: "text-right",targets: [7,8]},
            ],
            ajax: {
                "url": baseurljavascript + 'pembelian/ajaxdaftarhutang',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KATAKUNCI = $('#katakuncipencarianhutangtoko').val();
                    d.TANGGALAWAL = $('#tanggalawalhis').val().split("-").reverse().join("-");
                    d.TANGGALAKHIR = $('#tanggalakhirhis').val().split("-").reverse().join("-");
                },
            }
        });
    });
    getCsrfTokenCallback(function() {
        $("#daftarpembayaranhutang").DataTable({
            language: {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    text: '<i class="far fa-copy"></i> Copy',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="far fa-file-excel"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="far fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                }
            ],
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true,
            bFilter: false,
            columnDefs: [
                {className: "text-right",targets: [3]},
            ],
            ajax: {
                "url": baseurljavascript + 'pembelian/ajaxdaftarpembayaranhutang',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KATAKUNCI = $('#katakuncipembayaranhutang').val();
                    d.TANGGALAWAL = $('#tanggalawalhisbayar').val().split("-").reverse().join("-");
                    d.TANGGALAKHIR = $('#tanggalakhirhisbayar').val().split("-").reverse().join("-");
                },
            }
        });
    });
});
$("#prosescari").click(function() {
    getCsrfTokenCallback(function() {
        $('#daftarhutangtoko').DataTable().ajax.reload();
    });
});
$("#katakuncipencarianhutangtoko, #tanggalawalhis, #tanggalakhirhis").on('keyup input propertychange paste', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#daftarhutangtoko').DataTable().ajax.reload();
    });
}, 500));
$("#prosescaribayar").click(function() {
    getCsrfTokenCallback(function() {
        $('#daftarpembayaranhutang').DataTable().ajax.reload();
    });
});
$("#katakuncipembayaranhutang, #tanggalawalhisbayar, #tanggalakhirhisbayar").on('keyup input propertychange paste', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#daftarpembayaranhutang').DataTable().ajax.reload();
    });
}, 500));
function hapuspembayaranhutang(nota,namasuplier){
    swal.fire({
        title: "Penghapusan Informasi Hutang!!",
        icon: 'question',
        text: "Apakah anda yakin untuk menghapus catatan hutang NAMA: "+namasuplier+" dengan NO TRANSAKSI "+nota,
        //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
        //imageHeight: 150,
        showCancelButton:true,
        confirmButtonText: "Oke, Transaksikan Bosku!",
        cancelButtonText: "Gak Jadi Ah!",
        allowOutsideClick: false
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'pembelian/hapustransaksibhutang',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        NOTAPEMBAYARANHUTANG : nota,
                    },
                    success: function (response) {
                        let obj = JSON.parse(response);
                        if (obj.status == "true"){
                            Swal.fire({
                                title: "Proses Hapus Berhasil",
                                text: obj.msg,
                                icon: 'success',
                            });
                            $('#daftarhutangtoko').DataTable().ajax.reload();
                            $('#daftarpembayaranhutang').DataTable().ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Terjadi Kesalahan",
                                text: obj.msg,
                                icon: 'warning',
                            });
                        }
                    }
                });
            });
        }
    })  
}
function detailpembayaranhutang(notransaksi){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'pembelian/detailpembayaranhutang',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                NOTRANSAKSI : notransaksi,
            },
            success: function (response) {
                if (response[0].success == "true"){
                    $('#nopembayaranhutang').html(notransaksi);
                    $("#kartuhutang").html('');
                    $stringkartu = "<div class=\"wallet-col-sm-2 wallet-col-md-3\">";
                    for (let i = 0; i < response[0].totaldata; i++) {
                        $stringkartu += "<div class=\"portlet\"><div class=\"portlet-header\"><div class=\"portlet-icon\"><i class=\"fa fa-file\"></i></div><h4 class=\"portlet-title\">No Nota: ["+response[0].dataquery[i].TRANSAKSI_ID+"]</h4></div><div class=\"portlet-body py-4\"><h3 class=\"mb-0 ml-1\"><span class=\"text-level-2\" id=\"nominalbayar\"></span></h3><p class=\"mb-0 ml-1\">Total Piutang : "+formatuang(response[0].dataquery[i].TOTALKREDIT,'id-ID','IDR')+"</p><p class=\"mb-0 ml-1\">Nominal di Nota Lain : "+formatuang(response[0].dataquery[i].TOTALKREDIT - response[0].dataquery[i].BAYAR - response[0].dataquery[i].SISAKREDIT,'id-ID','IDR')+"</p><p class=\"mb-0 ml-1\">Tanggal Transaksi : "+moment(response[0].dataquery[i].TANGGALTRS).format('DD-MM-YYYY')+" "+response[0].dataquery[i].WAKTU+"</p><hr><p class=\"mb-0 ml-1\">Total Bayar:</p> <input style=\"font-size:24px\" type=\"text\" id=\"totalbayar"+i+"\" class=\"form-control\"></div><div class=\"portlet-footer\"><button onclick=\"hapuspernotabayarpiutang('"+response[0].dataquery[i].BARISBDETAILBAYAR+"','"+notransaksi+"','"+response[0].dataquery[i].NOTRANSAKSI+"','"+response[0].dataquery[i].BAYAR+"','edt','"+i+"')\" class=\"btn btn-success mr-2\"><i class=\"fa fa-edit mr-2\"></i>Ubah Trx</button><button onclick=\"hapuspernotabayarpiutang('"+response[0].dataquery[i].BARISBDETAILBAYAR+"','"+notransaksi+"','"+response[0].dataquery[i].NOTRANSAKSI+"','"+response[0].dataquery[i].BAYAR+"','hps','"+i+"')\" class=\"btn btn-danger mr-2\"><i class=\"fa fa-trash mr-2\"></i>Hapus Trx</button></div></div>";
                    } 
                    $stringkartu += "</div>";
                    $("#kartuhutang").append($stringkartu);
                    for (let i = 0; i < response[0].totaldata; i++) {
                        let an = new AutoNumeric('#totalbayar'+i, {decimalCharacter : ',',digitGroupSeparator : '.',});
                        an.set(response[0].dataquery[i].BAYAR);
                    } 
                    $('#detailpembayaranhutang').modal('show');
                }else{
                    Swal.fire({
                        title: "Terjadi Kesalahan",
                        text: response.msg,
                        icon: 'warning',
                    });
                }
            }
        });
    });
}
function hapuspernotabayarpiutang(aibayar,notransaksi,notapenjualan,besaran,kondisihapus,idDOMElement){
    if (kondisihapus == "hps"){
        pesan = "Apakah anda yakin untuk menghapus catatan piutang NO TRANSAKSI HUTANG: "+notransaksi+" dengan NO SUB "+aibayar+" dari NO TRANSAKSI PEMBELIAN "+notapenjualan
    }else{
        pesan = "Apakah anda yakin ingin mengubah nominal pembayaran hutang menjadi "+formatuang(besaran,'id-ID','IDR')+"!!"
    }
    swal.fire({
        title: kondisihapus == "hps" ? "Penghapusan Hutang Sebesar : "+formatuang(besaran,'id-ID','IDR')+"!!" : "Ubah Data Hutang Sebesar : "+formatuang(besaran,'id-ID','IDR')+"!!",
        icon: 'question',
        text: pesan,
        //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
        //imageHeight: 150,
        showCancelButton:true,
        confirmButtonText: kondisihapus == "hps" ? "Oke, Hapus Transaksi Bosku!" : "Oke, Ubah Nominal Hutang Bosku!",
        cancelButtonText: "Gak Jadi Ah!",
        allowOutsideClick: false
    }).then(function(result){
        if(result.isConfirmed){
            totalbayarnominal = new AutoNumeric('#totalbayar'+idDOMElement, {decimalCharacter : ',',digitGroupSeparator : '.',});
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'pembelian/hapustransaksihutang',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        NOTRANSAKSI : aibayar,
                        SUBNOTA : kondisihapus == "hps" ? "true" : "edit",
                        BAYAR : kondisihapus == "hps" ? besaran : totalbayarnominal.getNumber(),
                    },
                    success: function (response) {
                        let obj = JSON.parse(response);
                        if (obj.status == "true"){
                            Swal.fire({
                                title: kondisihapus == "hps" ? "Proses Hapus Berhasil" : "Proses Ubah Data Berhasil",
                                text: obj.msg,
                                icon: 'success',
                            });
                            $('#detailpembayaranhutang').modal('hide');
                            $('#daftarhutangtoko').DataTable().ajax.reload();
                            $('#daftarpembayaranhutang').DataTable().ajax.reload();
                        }else{
                            Swal.fire({
                                title: "Terjadi Kesalahan",
                                text: obj.msg,
                                icon: 'warning',
                            });
                        }
                    }
                });
            });
        }
    })  
}
</script>
<?= $this->endSection(); ?>