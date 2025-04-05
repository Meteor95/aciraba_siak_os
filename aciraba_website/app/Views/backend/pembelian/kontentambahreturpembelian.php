<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card p-3">
                    <blockquote class="blockquote mb-0 card-body">
                    <div>Kode Suplier : <span id="kodesuplier"><?= $kodesuplier ;?></span></div>
                    <div>Nama Suplier : <span id="namasuplier"><?= $namasuplier ;?></span></div>
                    <div>Alamat : <span id="alamatsuplier"><?= $alamatsuplier ;?></span></div>
                    <footer class="blockquote-footer"><small class="text-muted"> Informasi barang yang akan diretur ke suplier</small></footer>
                    </blockquote>
                    <p align="justify"><b style="color:red">CATATAN</b> : Semua barang yang hendak dilakukan transkasi RETUR PEMBELIAN wajib berada di lokasi RETUR agar status stok tidak terjadi kekeliruan dalam pengambilan keputusan. Jadi jangan keburu dilakukan STOK OPNAME jika barang yang dicari tidak ditemukan. Silahkan teliti stok sebelum melakukan tindakan agar tidak terjadi selisih data.</p>
                    <div class="row">
                    <div class="col-md-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="filterberdasarkantanggal">
                            <label class="custom-control-label" for="filterberdasarkantanggal">Bypass Pembelian</label>
                        </div>
                        <button data-toggle="modal" data-target="#modalpilihsuplier" class="btn btn-block btn-primary"><i class="fa fa-boxes"></i> Pilih Suplier</button>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="notrxreturpembelian">Ketikan No Trasaksi Pembelian</label>
                            <input readonly type="text" class="form-control" id="notrxreturpembelian" placeholder="Masukkan No Transaksi Pembelian">
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
                                <span onclick="bukadaftarbarang('R')" style="cursor: pointer;" id="generateiditem" class="input-group-text btn-warning btn">Pilih Barang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="portlet">
                    <div class="portlet-body" id="paneltransaksi">
                        <h4 class="header-title text-center">Barang Pada Transaksi Pembelian</h4>
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
                                    <input <?= ($isedit == "1" ? "readonly" : "" ) ;?> type="text" class="form-control" value="<?= $nomorreturedit ;?>" id="notranskasiretur" placeholder="RBGDPST20210801#1">
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
                                    <label>Asal Stok Retur</label>
                                    <select id="returkestok" class="selectpicker" data-live-search="true">
                                        <option value="R">Stok Diambil Dari Retur</option>
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
                                        <a class="nav-item nav-link" id="potonghutangtab" data-toggle="tab" href="#nav1-profile">Potong Hutang&nbsp;<span id="namapelanggan1"></span></a>
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
                                                <th>Potongan</th>
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
                                            <label for="notepembayaranhutang">Nomor Nota Potong Hutang</label>
                                            <input type="text" class="form-control"  id="notepembayaranhutang" readonly>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="nominalpotonghutang">Masukkan Nominal Potong Hutang MAX : <span id="totalpiutangtersedia">Rp 0.00</span><span id="totalpiutangtersedianonformat" style="visibility:hidden"></span></label>
                                            <div class="input-group">
                                            <input type="text" value="0" class="form-control" id="nominalpotonghutang" placeholder="Masukan Nominal Potong Piutang">
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
                                        <table id="tabelreturpotonghutang" class="table table-bordered table-striped table-hover nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Nota Penjualan</th>
                                                    <th>jatuh Tempo</th>
                                                    <th>Total Kredit</th>
                                                    <th>Sisa Hutang / Trx</th>
                                                    <th>Potong Hutang</th>
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
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="konfirmasipotonghutang">
                                    <label class="custom-control-label" for="konfirmasipotonghutang">Konfirmasi Potong Hutang</label>
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

<script type="text/javascript">
var jumlahbeli = [],jumlahretur = [],potongan = [],hargabeli = [],ppn = [],totalkredithutang = [],sisakredithutang = [],potonghutang = [],subtotalhutang = [],nominalbayarhutang = [];
let notepembayaranhutangtxt = new AutoNumeric('#nominalpotonghutang', {decimalCharacter : ',',digitGroupSeparator : '.',});
var totalbarang = 0, totalnominal = 0, totalpotongan = 0;
var isedit = <?=$isedit;?>;
$(document).ready(function () {
    $("#stokhanyaretur").prop('checked', true);
    $("#notrxreturpembelian").focus();
    $("#notrxreturpembelian").prop("readonly", false); 
    $("#paneltransaksi").show();
    $("#jenistransaksi").prop('disabled', 'disabled');
    $("#tanggaltranaksiretur").val(moment().format('DD-MM-YYYY'));
    $("#tanggaltranaksiretur").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
    if(isedit == "0"){ panggilnotareturpenjualan() }
    loadnotapotonghutang()
    getCsrfTokenCallback(function() {
        $("#tabeltransaksi").DataTable({
            columnDefs: [{className: "text-right",targets: [4,5,6]},],
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollCollapse: true,
            scrollX: true,
            ajax: {
                "url": baseurljavascript + 'pembelian/jsontrxbeli',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.DIMANA1 = $('#notrxreturpembelian').val();
                },
            }
        });
    });
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
                "url": baseurljavascript + 'pembelian/returjuallocal',
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
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelretur.cell(index,8).nodes().to$().find('input').prop('id'))) { potongan[index] = new AutoNumeric("#"+tabelretur.cell(index,8).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelretur.cell(index,9).nodes().to$().find('input').prop('id'))) { ppn[index] = new AutoNumeric("#"+tabelretur.cell(index,9).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                });
            },
            initComplete: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var data = tabelretur.rows().data();
                let nominalretur = 0, hppretur = 0,totalbaranga = 0, totalnominala = 0, totalpotongana = 0;
                data.each(function (value, index) {
                    nominalretur = nominalretur + ((jumlahretur[index].getNumber() * hargabeli[index].getNumber()) - potongan[index].getNumber()  + ppn[index].getNumber())
                    hppretur = hppretur + ((jumlahretur[index].getNumber() * hargabeli[index].getNumber()) - potongan[index].getNumber()  + ppn[index].getNumber())
                    $('#totalretur').html(formatuang(nominalretur,'id-ID','IDR'));
                    $('#totalpiutangtersedia').html(formatuang(nominalretur,'id-ID','IDR'));
                    totalbaranga = totalbaranga + jumlahretur[index].getNumber();
                    totalnominala = nominalretur;
                    totalpotongana = totalpotongana + potongan[index].getNumber();
                }); 
                totalbarang = totalbaranga;
                totalnominal = totalnominala;
                totalpotongan = totalpotongana;
                getCsrfTokenCallback(function() {});
            }
        }).on('key-focus', function ( e, datatable, cell, originalEvent ) {
            $('input', cell.node()).focus();
        }).on("focus", "td input", function(){
            $(this).select();
        });
        tabelretur.on('key', function (e, dt, code) {
            if (code === 13) {
                tabelretur.keys.move('down');
            }
        })
    });
    getCsrfTokenCallback(function() {
        tabelreturpotonghutang = $("#tabelreturpotonghutang").DataTable({
            language: {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true,
            bFilter: false,
            ajax: {
                "url": baseurljavascript + 'pembelian/jsonambiltrxhutang',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KODESUPLIER = $('#kodesuplier').html();
                    d.NOPOTONGHUTANG = $('#notranskasiretur').val();
                },
            },
            drawCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var data = tabelreturpotonghutang.rows().data();
                data.each(function (value, index) {
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotonghutang.cell(index,2).nodes().to$().find('input').prop('id'))) { totalkredithutang[index] = new AutoNumeric("#"+tabelreturpotonghutang.cell(index,2).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotonghutang.cell(index,3).nodes().to$().find('input').prop('id'))) { sisakredithutang[index] = new AutoNumeric("#"+tabelreturpotonghutang.cell(index,3).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotonghutang.cell(index,4).nodes().to$().find('input').prop('id'))) { potonghutang[index] = new AutoNumeric("#"+tabelreturpotonghutang.cell(index,4).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotonghutang.cell(index,5).nodes().to$().find('input').prop('id'))) { subtotalhutang[index] = new AutoNumeric("#"+tabelreturpotonghutang.cell(index,5).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+tabelreturpotonghutang.cell(index,7).nodes().to$().find('input').prop('id'))) { nominalbayarhutang[index] = new AutoNumeric("#"+tabelreturpotonghutang.cell(index,7).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                });
            },
            initComplete: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {

            }
        }).on('key-focus', function ( e, datatable, cell, originalEvent ) {
            $('input', cell.node()).focus();
        }).on("focus", "td input", function(){
            $(this).select();
        });
    });
});
$("#filterberdasarkantanggal").click(function() {
    if($('#filterberdasarkantanggal').is(':checked')) { 
        $('#paneltransaksi').hide();
        $("#notrxreturpembelian").prop("readonly", true); 
        $("#jenistransaksi").removeAttr('disabled');
        $('#kodeitemretur').focus();
    } else {
        $('#paneltransaksi').show();
        $("#notrxreturpembelian").prop("readonly", false); 
        $('#notrxreturpembelian').focus();
        $("#jenistransaksi").prop('disabled', 'disabled');
    }
});
function loadnotapotonghutang(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/notamenupenjualan',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                AWALANOTA : "BH",
                OUTLET: session_outlet,
                KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                TANGGALSEKARANG: moment().format('YYYYMMDD'),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                $('#notepembayaranhutang').val(response.nomornota);
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
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
                AWALANOTA : "RB",
                OUTLET: session_outlet,
                KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                TANGGALSEKARANG: moment().format('YYYYMMDD'),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                $('#notranskasiretur').val(response.nomornota);
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}
function bukadaftarbarang(kondisi){
    $("#stokhanyaretur").prop('checked', true);
    setTimeout(function(){
        $("#daftaritem_katakunci_panggil").focus();
    }, 200);
    $("#modal6").modal('show'); 
}
function pilihnotapembelian(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'pembelian/pilihnotapembelian',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]: csrfTokenGlobal,
                NOTAPEMBELIAN : $('#notrxreturpembelian').val(),
            },
            success: function (response) {
                $('#notepembayaranhutang').val(response.nomornota);
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}
function informasibarang(kodeitem){
    if ($("#kodesuplier").html() == "" || $("#stokdiambildari").val() == null){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan pilih NAMA SUPLIER dan ASAL OUTLET terlebih dahulu<br>sebelum anda melakukan RETUR PEMBELIAN',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-right'
        })
    }
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/returpenjualandetailbarang',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KODEBARANG : kodeitem,
            },
            success: function (obj) {
                if (obj[0].success == "true"){
                    simpanreturlocal(
                        $('#notranskasiretur').val(),
                        "TANPA NOTA",
                        obj[0].dataquery[0].BARANG_ID,
                        obj[0].dataquery[0].NAMABARANG,
                        "0",
                        $('#qtyretur').val(),
                        obj[0].dataquery[0].HARGABELI,
                        "0",
                        "0",
                        $('#stokdiambildari').val(),
                        $('#returkestok').val(),
                        "",
                        "TUNAI"
                    );
                    return Swal.fire({
                        icon: 'info',
                        html: 'Nama : '+obj[0].dataquery[0].NAMABARANG + '<br>dengan kode ['+obj[0].dataquery[0].BARANG_ID+']<br>tertambahkan ke keranjang retur',
                        toast: true,
                        showConfirmButton: false,
                        timer: 1500,
                        position: 'top-right'
                    })
                }else{
                    Swal.fire(
                        'Gagal.. Uhhhhh!',
                        "Terjadi kesalahan dalam pengemabilan informasi barang ini. Mohon ulangi untuk berberapa saat lagi",
                        'warning'
                    )
                }
            }
        });
    });
}
function simpanreturlocal(NOTRXRETUR,NOTRXPEMBELIAN,KODEBARANG,NAMABARANG,JUMLAHBELI,JUMLAHRETUR,HARGABELI,POTONGAN,PPN,ASALOUTLET,ASALLOKASI,KETERANGAN,JENISTRX){
    if ($("#kodesuplier").html() == "" || $("#stokdiambildari").val() == null){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan pilih NAMA SUPLIER dan ASAL OUTLET terlebih dahulu<br>sebelum anda melakukan RETUR PEMBELIAN',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-right'
        })
    }
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'pembelian/simpanreturlocal',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                NOTRXRETURBELI : $('#notranskasiretur').val(),
                NOTRXPEMBELIAN : NOTRXPEMBELIAN,
                KODEBARANG : KODEBARANG,
                NAMABARANG : NAMABARANG,
                JUMLAHBELI : JUMLAHBELI,
                JUMLAHRETUR : JUMLAHRETUR,
                HARGABELI : HARGABELI,
                POTONGAN : POTONGAN,
                PPN : PPN,
                ASALOUTLET : $('#stokdiambildari').val(),
                ASALLOKASI : $('#returkestok').val(),
                KETERANGAN : KETERANGAN,
                JENISTRX : JENISTRX,
            },
            success: function (response) {
                let obj = $.parseJSON(response);
                getCsrfTokenCallback(function() {
                    $('#dataretur').DataTable().ajax.reload();
                });
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
                    url: baseurljavascript + 'pembelian/hapusperbarangretur',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        AI: ai,
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if (obj.status == "true"){
                            getCsrfTokenCallback(function() {
                                $('#dataretur').DataTable().ajax.reload();
                            });
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
    let nominalretur = 0, hppretur = 0,totalbaranga = 0, totalnominala = 0, totalpotongana = 0;
    data.each(function (value, index) {
        nominalretur = (nominalretur + (jumlahretur[index].getNumber() * hargabeli[index].getNumber())) - potongan[index].getNumber()  + ppn[index].getNumber()
        hppretur = (hppretur + (jumlahretur[index].getNumber() * hargabeli[index].getNumber())) - potongan[index].getNumber()  + ppn[index].getNumber()
        $('#totalretur').html(formatuang(nominalretur,'id-ID','IDR'));
        $('#totalpiutangtersedia').html(formatuang(nominalretur,'id-ID','IDR'));
        totalbaranga = totalbaranga + jumlahretur[index].getNumber();
        totalnominala = nominalretur;
        totalpotongana = totalpotongana + potongan[index].getNumber();
    }); 
    totalbarang = totalbaranga;
    totalnominal = totalnominala;
    totalpotongan = totalpotongana;
}
function updatekeranjangretur(index){
    let nppn = 0;
    if (ppn[index].getNumber() < 100){
        nppn = (ppn[index].getNumber() / 100) * ((jumlahretur[index].getNumber() * hargabeli[index].getNumber()) - potongan[index].getNumber())
    }else{
        nppn =  ppn[index].getNumber();
    }
    ppn[index].set(nppn)
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'pembelian/updatekeranjangretur',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                JUMLAHBELI :jumlahretur[index].getNumber(),
                HARGABELI : hargabeli[index].getNumber(),
                POTONGAN : potongan[index].getNumber(),
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
function hapuskeranjangalert(){
    swal.fire({
        title: "Apakah Yakin ?",
        text: "Apakah yakin ingin membersihkan keranjang retur pembelian ini. Jika terhapus maka anda harus mengulang dari barang awal lagi",
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Bersihkan Dong!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            hapuskeranjangretur();
        }
    })
}
function hapuskeranjangretur(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'pembelian/hapuskeranjangretur',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.status == "true"){
                    $('#dataretur').DataTable().ajax.reload();
                    $('#totalretur').html(formatuang(0,'id-ID','IDR'));
                    $('#totalpiutangtersedia').html(formatuang(0,'id-ID','IDR'));
                }else{
                    Swal.fire({
                        title: "Gagal... Membersihkan Keranjang, Silahkan tekan F5",
                        text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
                        icon: 'warning',
                    });
                }
            }
        });
    });
}
$("#bayarsesuaireturbtn").on("click", function () {
    if (notepembayaranhutangtxt.getNumber() == 0){
        notepembayaranhutangtxt.set(Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()))
    }
    bayarsesuairetur();
});
$('#nominalpotonghutang').on('input', debounce(function (e) {
    bayarsesuairetur();
}, 500));
function bayarsesuairetur(){
    if (notepembayaranhutangtxt.getNumber() > Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim())){
        swal.fire({
            title: "Perhitungan Potong Hutang Salah!",
            icon: 'warning',
            text: "Pastikan nominal bayar yang anda masukan tidak melebihi dari total transaksi piutang. Maksimal nominal adalah "+formatuang(Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),'id-ID','IDR'),
            //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
            //imageHeight: 150,
            showCancelButton:true,
            confirmButtonText: "Hitung "+formatuang(Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),'id-ID','IDR'),
            cancelButtonText: "Skip. Gak Jadi",
        }).then(function(result){
            if(result.isConfirmed){
                notepembayaranhutangtxt.set(Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()))
                hitungpiutangtabel()
            }else{
                notepembayaranhutangtxt.set(0)
            }
        })   
    }else{
        hitungpiutangtabel()
    }
}
function hitungpiutangtabel(){
    let table = $('#tabelreturpotonghutang').DataTable();let numRows = table.rows().count();let sisakredit = 0;let nominalinput;
    if (notepembayaranhutangtxt.getNumber() > 0){
        nominalinput = notepembayaranhutangtxt.getNumber()
    }else{
        nominalinput = Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim())
    }
    let sisa=0;
    for(a=0;a<numRows;a++){
        if (a == 0){  
            if (nominalinput > subtotalhutang[a].getNumber()){
                nominalbayarhutang[a].set(subtotalhutang[a].getNumber());
            }else{
                nominalbayarhutang[a].set(nominalinput);
            }
            sisa = nominalinput - subtotalhutang[a].getNumber()
        }else{
            if (sisa > subtotalhutang[a].getNumber()){
                nominalbayarhutang[a].set(subtotalhutang[a].getNumber());
            }else if (sisa < subtotalhutang[a].getNumber() && sisa > 0){
                nominalbayarhutang[a].set(sisa);
            }else if (sisa == subtotalhutang[a].getNumber()){
                if (nominalinput == subtotalhutang[0].getNumber()){
                    nominalbayarhutang[a].set(sisa);
                }else{
                    nominalbayarhutang[a].set(subtotalhutang[a].getNumber());
                }
            }else{
                nominalbayarhutang[a].set(0);
            }
            sisa = sisa - subtotalhutang[a].getNumber()
        }
    }
}
$("#konfirmasipotonghutang").click(function() {
    if($('#konfirmasipotonghutang').is(':checked')) { 
        $('#buttontext').html("Transaksi Retur + Potong Hutang");
    } else {
        $('#buttontext').html("Transaksi Retur");
    }
});
var catchEnterpotong = debounce(function(index) {
    hitungpotongpiutang(index)
}, 500);
function hitungpotongpiutang(index){
    let data = tabelreturpotonghutang.rows().data();
    subtotalhutang[index].set(sisakredithutang[index].getNumber() - potonghutang[index].getNumber())
}
$("#simpanretur").on("click", function () {
    hitunginformasi();
    let table = $('#dataretur').DataTable();let numRows = table.rows().count();pesanpotonghutang ="",apakahedit = "false";
    let d = new Date(); let timenow = d.toLocaleTimeString();
    if (numRows == 0 ){
        return Swal.fire({
            icon: 'error',
            html: 'Anda belum melakukan pemilihan barang untuk di RETUR HUTANG<br>Proses simpan akan difungsikan apabila<br>anda memilih 1 barang untuk di RETUR HUTANG',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-right'
        })
    }
    if ($("#kodesuplier").html() == ""){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan pilih member terlebih dahulu untuk<br>dijadikan pelanggan retur pembelian,<br>dan pastikan anda tidak salah pilih member',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-right'
        })
    }
    if($('#konfirmasipotonghutang').is(':checked')) { 
        pesanpotonghutang = ". Serta potong hutang sebesar "+formatuang(notepembayaranhutangtxt.getNumber(),'id-ID','IDR');
    } else {
        pesanpotonghutang = "";
    }
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda akan melakuakn retur dengan NO TRX : "+$("#notranskasiretur").val()+" sebesar "+$('#totalretur').html().replace('&nbsp;', ' ').trim()+" "+pesanpotonghutang,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Siap!!'
    }).then((result) => {
        if (result.isConfirmed) {
            let arrayreturpembelian = [],arrayreturpotonghutang = [];
            let daftarkeranjangretur = $('#dataretur').DataTable().rows().data();
            let datareturpotonghutang = $('#tabelreturpotonghutang').DataTable().rows().data();
            daftarkeranjangretur.each(function (isidatatable, index) {
                var temp = new Array();
                temp.push(
                    '',
                    daftarkeranjangretur.cell(index,1).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,2).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,3).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,4).nodes().to$().find('input').val(),
                    jumlahbeli[index].getNumber(),
                    jumlahretur[index].getNumber(),
                    hargabeli[index].getNumber(),
                    potongan[index].getNumber(),
                    ppn[index].getNumber(),
                    daftarkeranjangretur.cell(index,10).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,11).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,12).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,13).nodes().to$().find('input').val(),
                    session_outlet,
                    session_kodeunikmember
                );
                arrayreturpembelian.push(temp)
            });
            datareturpotonghutang.each(function (isidatatable, index) {
                if (nominalbayarhutang[index].getNumber() > 0){
                    var temp = new Array();
                    temp.push(
                        '',
                        $("#notepembayaranhutang").val(),
                        datareturpotonghutang.cell(index,0).nodes().to$().find('input').val(),
                        $('#kodesuplier').html(),
                        $('#tanggaltranaksiretur').val().split("-").reverse().join("-"),
                        timenow.replaceAll('.', ':'),
                        session_pengguna_id,
                        nominalbayarhutang[index].getNumber(),
                        datareturpotonghutang.cell(index,6).nodes().to$().find('input').val(),
                        session_outlet,
                        session_kodeunikmember,
                        $('#notranskasiretur').val().split('#')[1],
                        $('#notranskasiretur').val(),
                    );
                    arrayreturpotonghutang.push(temp)
                }
            });
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'pembelian/jsontambahreturdanpotonghutang',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        ARRAYRETURBELI : arrayreturpembelian,
                        ARRAYPOTONGHUTANG : arrayreturpotonghutang,
                        POTONGHUTANGAKTIF : $('#konfirmasipotonghutang').is(':checked'),
                        NOTRXRETURBELI  : $('#notranskasiretur').val(),
                        SUPPLIERID  : $('#kodesuplier').html(),
                        TANGGALTRS  :  $('#tanggaltranaksiretur').val().split("-").reverse().join("-"),
                        NOMORNOTA  : $('#notranskasiretur').val().split('#')[1],
                        TOTALBARANG  : totalbarang,
                        TOTALNOMINAL  : totalnominal,
                        TOTALPOTONGAN  : totalpotongan,
                        ISEDIT : isedit,
                    },
                    success: function (response) {
                        var obj = $.parseJSON(response);
                        if (obj.status == "true"){
                            hapuskeranjangretur();
                            Swal.fire({
                                title: 'Transaksi Retur Berhasil?',
                                text: "Transaksi Retur dengan NO TRX : "+$("#notranskasiretur").val()+" sebesar "+$('#totalretur').html().replace('&nbsp;', '').trim()+" "+pesanpotonghutang+" berhasil.",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke, Siap Transaksi Lagi',
                                cancelButtonText: 'Tidak, Ke Daftar Retur'
                            }).then((result) => {
                                if(result.isConfirmed){           
                                    location.href = baseurljavascript+"pembelian/formreturpembelian";
                                }else{
                                    location.href = baseurljavascript+"pembelian/daftarreturpembelian";
                                }
                            })
                        }else{
                            Swal.fire(
                                'Aww Snap..!!',
                                obj.msg,
                                'error'
                            )
                        }
                    }
                });
            });
        }
    })
});
$("#notrxreturpembelian").on('input change click', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#tabeltransaksi').DataTable().ajax.reload();
    });
}, 500));
$("#potonghutangtab").on('click', debounce(function (e) {
    hitunginformasi()
}, 100));
$('#qtyretur').keypress(function (e) {let key = e.which; if(key == 13){$('#kodeitemretur').focus();return false;}});
$('#kodeitemretur').keypress(function (e) {let key = e.which; if(key == 13 && $('#kodeitemretur').val() == ""){$('#qtyretur').focus();return false;}});
</script>
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->include('backend/panggilsuplier') ?>
<?= $this->endSection(); ?>