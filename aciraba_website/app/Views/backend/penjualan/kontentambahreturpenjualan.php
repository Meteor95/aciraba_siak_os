<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-3">
                    <blockquote class="blockquote mb-0 card-body">
                    <div>Kode Pelanggan : <span id="kodepelanggan"><?= $kodemember ;?></span></div>
                    <div>Nama Pelanggan : <span id="namapelanggan"><?= $namamember ;?></span></div>
                    <div>Alamat : <span id="alamatpelanggan"><?= $alamatmember ;?></span></div>
                    <footer class="blockquote-footer"><small class="text-muted"> Informasi barang member yang akan diretur</small></footer>
                    </blockquote>
                    <div class="row">
                    <div class="col-md-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="filterberdasarkantanggal">
                            <label class="custom-control-label" for="filterberdasarkantanggal">Bypass Penjualan</label>
                        </div>
                        <button data-toggle="modal" data-target="#panggildaftarmember"  id="" class="btn btn-block btn-primary"><i class="fa fa-boxes"></i> Pilih Pelanggan</button>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="notrxreturjual">Ketikan No Trasaksi Penjualan</label>
                            <input readonly type="text" class="form-control" id="notrxreturjual" placeholder="Masukkan No Transaksi Penjualan">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="qtyretur">QTY</label>
                            <input type="text" class="form-control" id="qtyretur" value="1">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                        <label for="kodeitemretur">Kode Item Retur</label>
                            <div class="input-group">
                            <input type="text" class="form-control" id="kodeitemretur" placeholder="Masukkan Kode Item Terdaftar">
                                <div class="input-group-append">
                                <span data-toggle="modal" data-target="#modal6" style="cursor: pointer;" id="generateiditem" class="input-group-text btn-warning btn">Pilih Barang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="portlet">
                    <div class="portlet-body" id="paneltransaksi">
                        <h4 class="header-title text-center">Barang Pada Transaksi Penjualan</h4>
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabeltransaksi" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Tanggal Trx</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Qty</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Sub Total</th>
                                    <th>Jenis Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">Informasi barang yang di retur</h3>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 mb-0">
                                <div class="form-group">
                                    <label for="notranskasiretur">No Transaksi Retur</label>
                                    <input <?= ($isedit == "1" ? "readonly" : "" ) ;?> type="text" class="form-control" value="<?= $nomorreturedit ;?>" id="notranskasiretur" placeholder="RTGDPST20210801#1">
                                </div>
                            </div>
                            <div class="col-md-3 mb-0">
                                <div class="form-group">
                                    <label>Tanggal Transaksi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Pilih Tanggal Transaksi"
                                            id="tanggaltranaksiretur">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-0">
                                <div class="form-group">
                                    <label>Stok Diambil Dari</label>
                                    <select id="stokdiambildari" class="form-control cmblokasioutlet">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-0">
                                <div class="form-group">
                                    <label>Retur Ke Stok</label>
                                    <select id="returkestok" class="selectpicker" data-live-search="true">
                                        <option value="D">Stok Tambah Ke Display</option>
                                        <option value="G">Stok Tambah Ke Gudang</option>
                                        <option value="R">Stok Tambah Ke Retur</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button onclick="hapuskeranjangalert()" class="btn btn-block btn-danger"><i class="fa fa-trash"></i> Bersihkan Keranjang Retur </button>
                        <!-- BEGIN Datatable -->
                        <!-- BEGIN Portlet -->
                        <div class="portlet mb-md-0">
                            <div class="portlet-body">
                                <div class="mb-3">
                                    <!-- BEGIN Nav -->
                                    <div class="nav nav-lines" id="nav1-tab">
                                        <a class="nav-item nav-link active" id="nav1-home-tab" data-toggle="tab" href="#nav1-home">Barang Yang Diretur</a>
                                        <a class="nav-item nav-link" id="potongpiutangtab" data-toggle="tab" href="#nav1-profile">Potong Piutang&nbsp;<span id="namapelanggan1"></span></a>
                                    </div>
                                    <!-- END Nav -->
                                </div>
                                <!-- BEGIN Tab -->
                                <div class="tab-content" id="nav1-tabContent">
                                    <div class="tab-pane fade show active" id="nav1-home">
                                    <table id="dataretur" class="table table-bordered table-striped table-hover nowrap">
                                        <thead>
                                            <tr>
                                                <th>Aksi</th>
                                                <th>No Retur</th>
                                                <th>Nota Penjualan</th>
                                                <th>Kode Item</th>
                                                <th>Nama Item</th>
                                                <th>Σ Beli</th>
                                                <th>Σ Retur</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th>PPN</th>
                                                <th>Ke Oulet</th>
                                                <th>Ke Lokasi</th>
                                                <th>Keterangan</th>
                                                <th>Jenis Trx</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>    
                                    </div>
                                    <div class="tab-pane fade" id="nav1-profile">
                                        <div class="row">
                                        <div class="col-md-4">
                                            <label for="notapembayaranpiutang">Nomor Nota Potong Piutang</label>
                                            <input type="text" class="form-control"  id="notapembayaranpiutang" readonly>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="nominalpotongpiutang">Masukkan Nominal Potong Piutang MAX : <span id="totalpiutangtersedia">Rp 0.00</span><span id="totalpiutangtersedianonformat" style="visibility:hidden"></span></label>
                                            <div class="input-group">
                                            <input type="text" value="0" class="form-control" id="nominalpotongpiutang" placeholder="Masukan Nominal Potong Piutang">
                                                <div class="input-group-append">
                                                <span style="cursor: pointer;" id="bayarsesuaireturbtn" class="input-group-text btn-warning btn">Bayar Sesuai Retur</span>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col"><hr/></div><div class="col-auto">ATAU</div><div class="col"><hr/></div>
                                        </div>
                                        <table id="datareturpotongpiutang" class="table table-bordered table-striped table-hover nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Nota Penjualan</th>
                                                    <th>jatuh Tempo</th>
                                                    <th>Total Kredit</th>
                                                    <th>Sisa Piutang / Trx</th>
                                                    <th>Potong Piutang</th>
                                                    <th>Sub Total</th>
                                                    <th>Keterangan</th>
                                                    <th>Nominal Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>   
                                    </div>
                                </div>
                                <!-- END Tab -->
                            </div>
                        </div>
                        <!-- END Portlet -->
                        <!-- END Datatable -->
                        <div class="row justify-content-between mt-3">
                            <div class="col-md-8 mb-2"></div>
                            <div class="col-md-4">
                                <h2 class="portlet-title">Nominal Retur Jual <span id="totalretur">Rp 0.00</span></h2>
                                <h2 class="portlet-title">HPP Retur Jual <span id="totalhppretur">Rp 0.00</span></h2>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="konfirmasipotongpiutang">
                                    <label class="custom-control-label" for="konfirmasipotongpiutang">Konfirmasi Potong Piutang</label>
                                </div>
                                <button id="simpanretur" style="font-size:15px" class="btn btn-block btn-success float-right"> <i style="font-size:15px" class="fas fa-clipboard-check"></i><span id="buttontext"> Transaksi Retur</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="<?= base_url();?>/scripts/penjualan/returpenjualan.js"></script>
<script type="text/javascript">
var jumlahbeli = [],jumlahretur = [],hargajual = [],hargabeli = [],ppn = [],totalkreditpiutang = [],sisakreditpiutang = [],potongpiutang = [],subtotalpiutang = [],nominalbayarpiutang = [];
let nominalpotongpiutangtxt = new AutoNumeric('#nominalpotongpiutang', {decimalCharacter : ',',digitGroupSeparator : '.',});
var totalbarang = 0;
var isedit = <?=$isedit;?>;
$(document).ready(function () {
    if (isedit == "0"){
        panggilnotareturpenjualan()
    }else{
        loadnotapiutang()
    }
    $("#notrxreturjual").focus();
    $("#paneltransaksi").show();
    $("#notrxreturjual").prop("readonly", false); 
    $("#jenistransaksi").prop('disabled', 'disabled');
    $("#tanggaltranaksiretur").val(moment().format('DD-MM-YYYY'));
    $("#tanggaltranaksiretur").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
    datareturberdasarkannota();
});
function loadnotapiutang(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/notamenupenjualan',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                AWALANOTA : "BP",
                OUTLET: session_outlet,
                KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                TANGGALSEKARANG: moment().format('YYYYMMDD'),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                datatablestabelretur();
                $('#notapembayaranpiutang').val(response.nomornota);
            }
        });
    });
}   
function datareturberdasarkannota(){
    getCsrfTokenCallback(function() {
        $("#tabeltransaksi").DataTable({
            columnDefs: [{className: "text-right",targets: [4,5,6]},],
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollCollapse: true,
            scrollX: true,
            ajax: {
                "url": baseurljavascript + 'penjualan/jsonambiltrxjual',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.DIMANA1 = $('#notrxreturjual').val();
                },
            }
        });
    });
}
function datatablestabelretur(){
    getCsrfTokenCallback(function() {
        tabelretur = $("#dataretur").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            keys: true,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: false,
            ajax: {
                "url": baseurljavascript + 'penjualan/returjuallocal',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KONDISI = null;
                },
            },
            drawCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var data = tabelretur.rows().data();
                data.each(function (value, index) {
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelretur.cell(index,5).nodes().to$().find('input').prop('id'))) { jumlahbeli[index] = new AutoNumeric("#"+tabelretur.cell(index,5).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelretur.cell(index,6).nodes().to$().find('input').prop('id'))) { jumlahretur[index] = new AutoNumeric("#"+tabelretur.cell(index,6).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelretur.cell(index,7).nodes().to$().find('input').prop('id'))) { hargabeli[index] = new AutoNumeric("#"+tabelretur.cell(index,7).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelretur.cell(index,8).nodes().to$().find('input').prop('id'))) { hargajual[index] = new AutoNumeric("#"+tabelretur.cell(index,8).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelretur.cell(index,9).nodes().to$().find('input').prop('id'))) { ppn[index] = new AutoNumeric("#"+tabelretur.cell(index,9).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                });
            },
            initComplete: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                datatablesreturpotongpiutang();
                var data = tabelretur.rows().data();
                let nominalretur = 0, hppretur = 0,totalbaranga = 0;
                data.each(function (value, index) {
                    nominalretur = (nominalretur + (jumlahretur[index].getNumber() * hargajual[index].getNumber())) + ppn[index].getNumber()
                    hppretur = (hppretur + (jumlahretur[index].getNumber() * hargabeli[index].getNumber())) + ppn[index].getNumber()
                    $('#totalretur').html(formatuang(nominalretur,'id-ID','IDR'));
                    $('#totalhppretur').html(formatuang(hppretur,'id-ID','IDR'));
                    $('#totalpiutangtersedia').html(formatuang(nominalretur,'id-ID','IDR'));
                    totalbaranga = totalbaranga + jumlahretur[index].getNumber();
                }); 
                totalbarang = totalbaranga;
            }
        }).on('key-focus', function ( e, datatable, cell, originalEvent ) {
            $('input', cell.node()).focus();
        }).on("focus", "td input", function(){
            $(this).select();
        });
        tabelretur.on('key', function (e, dt, code) {if (code === 13) {tabelretur.keys.move('down');}})
    });
}
function datatablesreturpotongpiutang(){
getCsrfTokenCallback(function() {
    tabelreturpotongpiutang = $("#datareturpotongpiutang").DataTable({
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
        },
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false,
        ajax: {
            "url": baseurljavascript + 'penjualan/jsonambiltrxpiutang',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.MEMBERID = $('#kodepelanggan').html();
                d.NOPOTONGPIUTANG = $('#notranskasiretur').val();
            },
        },
        drawCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            var data = tabelreturpotongpiutang.rows().data();
            data.each(function (value, index) {
                if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotongpiutang.cell(index,2).nodes().to$().find('input').prop('id'))) { totalkreditpiutang[index] = new AutoNumeric("#"+tabelreturpotongpiutang.cell(index,2).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotongpiutang.cell(index,3).nodes().to$().find('input').prop('id'))) { sisakreditpiutang[index] = new AutoNumeric("#"+tabelreturpotongpiutang.cell(index,3).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotongpiutang.cell(index,4).nodes().to$().find('input').prop('id'))) { potongpiutang[index] = new AutoNumeric("#"+tabelreturpotongpiutang.cell(index,4).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotongpiutang.cell(index,5).nodes().to$().find('input').prop('id'))) { subtotalpiutang[index] = new AutoNumeric("#"+tabelreturpotongpiutang.cell(index,5).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotongpiutang.cell(index,7).nodes().to$().find('input').prop('id'))) { nominalbayarpiutang[index] = new AutoNumeric("#"+tabelreturpotongpiutang.cell(index,7).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
            });
        },
        initComplete: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            
        }
    }).on('key-focus', function ( e, datatable, cell, originalEvent ) {
        $('input', cell.node()).focus();
    }).on("focus", "td input", function(){
        $(this).select();
    });
    tabelreturpotongpiutang.on('key', function (e, dt, code) {
        if (code === 13) {
            tabelreturpotongpiutang.keys.move('down');
        }
    })
});
}
function panggilnotareturpenjualan(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/notamenupenjualan',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                AWALANOTA : "RT",
                OUTLET: session_outlet,
                KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                TANGGALSEKARANG: moment().format('YYYYMMDD'),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                loadnotapiutang()
                $('#notranskasiretur').val(response.nomornota);
            }
        });
    });
}
function simpanreturlocal(NOTRXRETUR,NOTRXPENJUALAN,KODEBARANG,NAMABARANG,JUMLAHBELI,JUMLAHRETUR,HARGABELI,HARGAJUAL,PPN,TUJUANOUTLET,TUJUANLOKASISSTOK,KETERANGAN,JENISTRX){
    if ($("#kodepelanggan").html() == "" || $("#stokdiambildari").val() == null){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan pilih NAMA PELANGGAN dan ASAL OUTLET terlebih dahulu<br>sebelum anda melakukan RETUR PENJUALAN',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-right'
        })
    }
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/simpanreturlocal',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                NOTRXRETUR : $('#notranskasiretur').val(),
                NOTRXPENJUALAN : NOTRXPENJUALAN,
                KODEBARANG : KODEBARANG,
                NAMABARANG : NAMABARANG,
                JUMLAHBELI : JUMLAHBELI,
                JUMLAHRETUR : JUMLAHRETUR,
                HARGABELI : HARGABELI,
                HARGAJUAL : HARGAJUAL,
                PPN : PPN,
                TUJUANOUTLET : $('#stokdiambildari').val(),
                TUJUANLOKASISSTOK : $('#returkestok').val(),
                KETERANGAN : KETERANGAN,
                JENISTRX : JENISTRX,
            },
            success: function (response) {
                let obj = $.parseJSON(response);
                getCsrfTokenCallback(function() {
                    $('#dataretur').DataTable().ajax.reload();
                })
                if (obj.status == "false"){
                    Swal.fire(
                        'Pembuatan Nota Error!',
                        obj.msg,
                        'warning'
                    ) 
                }
            }
        });
    });
}

$("#konfirmasipotongpiutang").click(function() {
    if($('#konfirmasipotongpiutang').is(':checked')) { 
        $('#buttontext').html("Transaksi Retur + Potong Piutang");
    } else {
        $('#buttontext').html("Transaksi Retur");
    }
});
$("#filterberdasarkantanggal").click(function() {
    if($('#filterberdasarkantanggal').is(':checked')) { 
        $('#paneltransaksi').hide();
        $("#notrxreturjual").prop("readonly", true); 
        $("#jenistransaksi").removeAttr('disabled');
        $('#kodeitemretur').focus();
    } else {
        $('#paneltransaksi').show();
        $("#notrxreturjual").prop("readonly", false); 
        $('#notrxreturjual').focus();
        $("#jenistransaksi").prop('disabled', 'disabled');
    }
});
function hapusperbarangretur(kodebarang,namabarang,ai){
    swal.fire({
        title: "Apakah Yakin ?",
        text: "Apakah yakin ingin menghapus barang "+namabarang+" pada keranjang retur ini ?. Anda dapat menambahkan lagi jika anda terjadi kesalahan hapus",
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Hapus Ini!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/hapusperbarangretur',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        AI: ai,
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if (obj.status == "true"){
                            getCsrfTokenCallback(function() {
                                $('#dataretur').DataTable().ajax.reload();
                            })
                        }else{
                            Swal.fire({
                                title: "Gagal... Cek Koneksi Local DB Kasir",
                                text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
                                icon: 'warning',
                            });
                        }
                    }
                });
            });
        }
    })
}
var catchEnter = debounce(function(index) {
    updatekeranjangretur(index)
}, 500);
function hitunginformasi(){
    var data = tabelretur.rows().data();
    let nominalretur = 0, hppretur = 0,totalbaranga = 0;
    data.each(function (value, index) {
        nominalretur = (nominalretur + (jumlahretur[index].getNumber() * hargajual[index].getNumber())) + ppn[index].getNumber()
        hppretur = (hppretur + (jumlahretur[index].getNumber() * hargabeli[index].getNumber())) + ppn[index].getNumber()
        $('#totalretur').html(formatuang(nominalretur,'id-ID','IDR'));
        $('#totalhppretur').html(formatuang(hppretur,'id-ID','IDR'));
        $('#totalpiutangtersedia').html(formatuang(nominalretur,'id-ID','IDR'));
        totalbaranga = totalbaranga + jumlahretur[index].getNumber();
    }); 
    totalbarang = totalbaranga;
}
function updatekeranjangretur(index){
    let nppn = 0;
    if (ppn[index].getNumber() < 100){
        nppn = (ppn[index].getNumber() / 100) * (jumlahretur[index].getNumber() * hargajual[index].getNumber())
    }else{
        nppn =  ppn[index].getNumber();
    }
    ppn[index].set(nppn)
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/updatekeranjangretur',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                JUMLAHBELI :jumlahretur[index].getNumber(),
                HARGAJUAL : hargajual[index].getNumber(),
                KETERANGAN : tabelretur.cell(index,12).nodes().to$().find('input').val(),
                PPN : ppn[index].getNumber(),
                KODEBARANG : tabelretur.cell(index,3).nodes().to$().find('input').val(),
                OUTLET : tabelretur.cell(index,10).nodes().to$().find('input').val(),
            },
            success: function (response) {
                let obj = JSON.parse(response);
                if (obj.status == "false"){
                    Swal.fire(
                        'Pembaruan Keranjang Error!',
                        obj.msg,
                        'warning'
                    ) 
                }
            }
        });
    });
    hitunginformasi()
}
var catchEnterpotong = debounce(function(index) {
    hitungpotongpiutang(index)
}, 500);
function hitungpotongpiutang(index){
    let data = tabelreturpotongpiutang.rows().data();
    subtotalpiutang[index].set(sisakreditpiutang[index].getNumber() - potongpiutang[index].getNumber())
}
$("#potongpiutangtab").on('click', debounce(function (e) {
    hitunginformasi()
}, 100));
$('#qtyretur').keypress(function (e) {let key = e.which; if(key == 13){$('#kodeitemretur').focus();return false;}});
$('#kodeitemretur').keypress(function (e) {let key = e.which; if(key == 13 && $('#kodeitemretur').val() == ""){$('#qtyretur').focus();return false;}});
</script>
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->include('backend/panggildaftarmember') ?>
<?= $this->endSection(); ?>