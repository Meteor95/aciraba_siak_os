<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
    .tombolmelayang{ width:300px; height: 40px; position: fixed; background-color: blue; bottom: 0; right: 40%; z-index: 999999;}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="row">
                            <div class="col mb-2">
                                <!-- BEGIN Rich List -->
								<div class="rich-list-item w-100 p-0">
									<div class="rich-list-prepend" style="width: 100px;">
										<!-- BEGIN Input Group -->
                                        <div class="input-group-icon input-group-lg">
                                            <div class="input-group-prepend">
                                                <i class="fa fa-cart-plus text-primary"></i>
                                            </div>
                                            <input id="qtykeluarkasir" type="text" class="form-control" value="1" placeholder="QTY">
                                        </div>
                                        <!-- END Input Group -->
									</div>
									<div class="rich-list-content">
										<!-- BEGIN Input Group -->
                                        <div class="input-group-icon input-group-lg">
                                            <div class="input-group-prepend ml-1">
                                                <i class="fa fa-search text-primary"></i>
                                            </div>
                                            <input id="katakuncipencariankasir" type="text" class="form-control" placeholder="Ketikkan Kode item / Nama item">
                                        </div>
                                        <!-- END Input Group -->
									</div>
									<div class="rich-list-append">
										<button onclick="hapuskeranjang()" id="bersihkanform" class="btn btn-flat-info btn-icon mr-2 btn-lg">
											<i class="fa fa-redo-alt"></i>
										</button>
										<button data-toggle="modal" data-target="#modal6" class="btn btn-flat-info btn-icon mr-2 btn-lg">
											<i class="fa fa-boxes"></i>
										</button>
									</div>
								</div>
								<!-- END Rich List -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <input id="notransaksiopname" type="text" class="form-control">
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <select id="lokasioutlet" class="selectpicker" data-live-search="true">
                                    <option value="D"> Stok Akan Diubah Di Lokasi Display</option>
                                    <option value="G"> Stok Akan Diubah Di Lokasi Gudang</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <select id="kondisipenyesuaian" class="selectpicker" data-live-search="true">
                                    <option value="T"> Stok Akan Di Tambah [+]</option>
                                    <option value="K"> Stok Akan Di Kurang [-]</option>
                                    <option value="R"> Stok Akan Di Ganti</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input id="tanggaltransaksiopname" type="text" class="form-control" placeholder="Pilih Tanggal Transaksi">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2" style="font-size:24px">
                            <div class="col-md-4 mb-1 col-sm-12">
                                <div>Σ Nominal : <span id="totalnominal">Rp 0.00</span></div>
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12" style="color:red">
                                <div>Σ Minus : <span id="totalminus">Rp 0.00</span></div>
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12" style="color:green">
                                <div>Σ Surplus : <span id="totalplus">Rp 0.00</span></div>
                            </div>
                        </div>   
                        <!-- END Form Row -->
                        <hr>
                        <input id="keteranganopname" type="text" class="form-control" style="font-size:15px" placeholder="Tentukan keterangan opname">
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="keranjangopname" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Barang</th>
                                    <th style="width:80px">Lokasi</th>
                                    <th style="width:80px">Stok Digital</th>
                                    <th style="width:80px">Stok Fisik</th>
                                    <th>Kondisi</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Barang</th>
                                    <th>Lokasi</th>
                                    <th>Stok Digital</th>
                                    <th>Stok Fisik</th>
                                    <th>Kondisi</th>
                                    <th>Harga</th>
                                    <th>Keterangan</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- END Datatable -->
                        <button onclick="simpantransaksiopname()" id="simpantrxpenyesuaian" class="tombolmelayang btn btn-success btn-block"><i class="fas fa-box-open"></i> Transaksi Semua Penyesuaian </button>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url();?>scripts/penyesuaian/penyesuaian.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
let daftarkeranjang = "";
var anharga = [], anstokkom = [], anstokfiskik =[];
var totalbarangg = 0;
$(document).ready(function () {
    loadnotranskasi()
    $('#tanggaltransaksiopname').val(moment().format('DD-MM-YYYY'));
    $("#tanggaltransaksiopname").datepicker({todayHighlight: true,format:'dd-mm-yyyy'});
    getCsrfTokenCallback(function() {
        daftarkeranjang = $("#keranjangopname").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            keys: true,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: false,
            ajax: {
                "url": baseurljavascript + 'penyesuaian/daftaropnamelocal',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KATAKUNCIPENCARIAN = null;
                }
            },
            drawCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var data = daftarkeranjang.rows().data();
                let totalbelanja = 0, totalbelanjanett = 0;
                data.each(function (value, index) {
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,4).nodes().to$().find('input').prop('id'))) { anstokkom[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,4).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,5).nodes().to$().find('input').prop('id'))) { anstokfiskik[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,5).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,7).nodes().to$().find('input').prop('id'))) { anharga[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,7).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                });
            },
            initComplete: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var data = daftarkeranjang.rows().data();
                let totalopname = 0, totalminus = 0, totalsurplus=0, selisih = 0, totalbarang =0;
                data.each(function (value, index) {
                    selisih = (anstokkom[index].getNumber() - anstokfiskik[index].getNumber())
                    if (selisih > 0){
                        totalminus = (totalminus + (anharga[index].getNumber() * selisih) * -1)
                    }else if (selisih < 0){
                        totalsurplus = (totalsurplus + (anharga[index].getNumber() * selisih) * -1)
                    }
                    $('#totalminus').html(formatuang((totalminus),'id-ID','IDR').replaceAll('-', '').trim());
                    $('#totalplus').html(formatuang((totalsurplus),'id-ID','IDR').replaceAll('-', '').trim());
                    totalbarang = totalbarang + anstokfiskik[index].getNumber();
                }); 
                totalbarangg = totalbarang;
                totalopname = totalsurplus + totalminus;
                $('#totalnominal').html(formatuang((totalopname),'id-ID','IDR'));
            }
        }).on( 'key-focus', function ( e, datatable, cell, originalEvent ) {
            $('input', cell.node()).focus();
        }).on("focus", "td input", function(){
            $(this).select();
        });
        daftarkeranjang.on('key', function (e, dt, code) {
            if (code === 13) {
                daftarkeranjang.keys.move('down');
            }
        });
    });
});
$('#qtykeluarkasir').keypress(function (e) {let key = e.which; if(key == 13){$('#katakuncipencariankasir').focus();return false;}});
$('#katakuncipencariankasir').keypress(function (e) {let key = e.which; if(key == 13 && $('#katakuncipencariankasir').val() == ""){$('#qtykeluarkasir').focus();return false;}});
</script>
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->endSection(); ?>