<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
.theme-light .dataTable tbody td.focus, .theme-light .dataTable tbody th.focus { box-shadow: inset 0 0 0 0px #2196f3;}
.tombolmelayang{ width:300px; height: 40px; position: fixed; background-color: blue; bottom: 0; right: 40%; z-index: 999999;}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <select class="form-control" id="pilihperusahaan">
                        <?php if ($top != ""){ echo "<option value=\"".$kodeperusahaan."\">[".$kodeperusahaan."] ".$namaperusahaan."</option>";}?> 
                        </select>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-4 col-sm-12">
                                <!-- BEGIN Select -->
                                <div class="form-group row">
                                    <label for="kodesuplier" class="col-sm-3 col-form-label">Kode Suplier</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input value="<?= $kodesuplier ;?>" type="text" id="kodesuplier" class="form-control" placeholder="Masukkan Kode / Nama Suplier Tertuju">
                                            <div onclick="panggilsuplier()" data-toggle="modal" data-target="#modalpilihsuplier" class="input-group-prepend">
                                                <span id="pilihsuplier" style="cursor:pointer;" class="input-group-text btn">Pilih Suplier</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="font-size:12">Nama Suplier : <b><span id="namasuplier"><?= $namasuplier ;?></span></b></div>
                                <div style="font-size:12">Alamat Suplier : <b><span id="alamatsuplier"><?= $alamat ;?></span></b></div>
                                <div style="font-size:12">No Telepon : <b><span id="notelpnsuplier"><?= $notelepon ;?></span></b></div>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <div class="form-group row">
                                    <label for="nofaktur" class="col-sm-3 col-form-label">No Faktur</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input <?= $isedit == "true" ? 'readonly' : ''  ?> value="<?= $notapembelian;?>" type="text" id="nofaktur" class="form-control" placeholder="Masukkan No Faktur Dari Suplier">
                                            <?php if ($isedit == "false"){
                                                echo '<div class="input-group-prepend" onclick="loadnotapembelian()">
                                                <span id="generateiditem" class="input-group-text btn-warning btn">Generate Faktur</span>
                                                </div>';
                                            }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgltrx" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input value="" type="text" id="tgltrx" class="form-control">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input value="<?= $keterangan ;?>" type="text" id="keterangan" class="form-control"
                                                placeholder="Keterangan Transaksi">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group row">
                                    <label for="jenispembayaran" class="col-sm-5 col-form-label">Sumber Dana Pembayaran</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <select onchange="tampiljatuhtempo()" class="form-control" id="jenispembayaran">
                                            <?php if ($top != ""){ echo "<option value=\"".$top."\">".$namatop."</option>";}?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="jatuhtempoform" class="form-group row">
                                    <label for="jatuhtempo" class="col-sm-3 col-form-label">Jatuh Tempo</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input value="" type="text" id="jatuhtempo" class="form-control"
                                                placeholder="Masukan besaran jatuh tempo">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text btn"> Hari Kedepan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="font-size:17px;text-align:right"> Σ Faktur : <span id="totalpembelian" >Rp 0.00</span></div>
                                <div style="font-size:17px;text-align:right"> Σ HPP + Beban : <span id="totalpembeliannett" >Rp 0.00</span></div>
                                <div style="font-size:17px;text-align:right"> Σ PPN Masukan : <span id="totalppnmasukan" >Rp 0.00</span></div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <div class="form-row ml-1">
                        <div class="custom-control custom-checkbox mr-2">
                            <input checked type="checkbox" class="custom-control-input"
                                id="aktifkanbestbuy">
                            <label class="custom-control-label"
                                for="aktifkanbestbuy">Stok Taruh Gudang</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input onclick="return hitungdenganinfototal();" type="checkbox" class="custom-control-input"
                                id="aktifkanpajakmasukan">
                            <label class="custom-control-label"
                                for="aktifkanpajakmasukan">Aktifkan PPN Masukan</label>
                        </div>
                        </div>
                        <div class="rich-list-item w-100 p-0">
                            <div class="rich-list-prepend" style="width: 100px;">
                                <!-- BEGIN Input Group -->
                                <div class="input-group-icon input-group-lg">
                                    <div class="input-group-prepend">
                                        <i class="fa fa-cart-plus text-primary"></i>
                                    </div>
                                    <input id="qtypemasukan" type="text" class="form-control" value="1" placeholder="QTY">
                                </div>
                                <!-- END Input Group -->
                            </div>
                            <div class="rich-list-content">
                                <!-- BEGIN Input Group -->
                                <div class="input-group-icon input-group-lg">
                                    <div class="input-group-prepend ml-1">
                                        <i class="fa fa-search text-primary"></i>
                                    </div>
                                    <input id="katakuncibarang" type="text" class="form-control"
                                        placeholder="Ketikkan Kode item / Nama item">
                                </div>
                                <!-- END Input Group -->
                            </div>
                            <div class="rich-list-append">
                                <button id="bersihkanform" class="btn btn-flat-info btn-icon mr-2 btn-lg">
                                    <i class="fa fa-redo-alt"></i>
                                </button>
                                <button onclick="panggilinformasibarang()" class="btn btn-flat-info btn-icon mr-2 btn-lg">
                                    <i class="fa fa-boxes"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                        <!-- BEGIN Datatable -->
                        <div class="row portlet-row-fill-md h-100">
								<div class="col-md-12 col-xl-12">
									<!-- BEGIN Portlet -->
									<div class="portlet portlet-primary">
										<div class="portlet-header">
											<div class="portlet-icon">
												<i class="fa fa-chalkboard"></i>
											</div>
											<h3 class="portlet-title">Diskon General</h3>
										</div>
										<div class="portlet-body">
											<!-- BEGIN Portlet -->
											<div class="portlet mb-2">
												<div class="portlet-body">
													<!-- BEGIN Widget -->
													<div class="widget5">
														<h4 class="widget5-title">Ketikan diskon dalam [%] atau [Nominal] jika ingin diskon di semua barang. NB: Kami sarankan masukkan semua barang sebelum melakukan diskon general</h4>
														<div class="widget5-group">
															<div class="widget5-item mr-2">
																<span class="widget5-info">Tentukan Diskon 1</span>
																<span class="widget5-value"><input id="diskon1general" type="text" class="form-control" value="0" placeholder="Tentukan Diskon 1"></span>
															</div>
															<div class="widget5-item mr-2">
																<span class="widget5-info">Tentukan Diskon 2</span>
																<span class="widget5-value"><input id="diskon2general" type="text" class="form-control" value="0" placeholder="Tentukan Diskon 2"></span>
															</div>
                                                            <div class="widget5-item mr-2">
																<span class="widget5-info">Tentukan After Diskon 1</span>
																<span class="widget5-value"><input id="adiskon1general" type="text" class="form-control" value="0" placeholder="Tentukan After Diskon 1"></span>
															</div>
                                                            <div class="widget5-item mr-2">
																<span class="widget5-info">Tentukan After Diskon 2</span>
																<span class="widget5-value"><input id="adiskon2general"type="text" class="form-control" value="0" placeholder="Tentukan After Diskon 2"></span>
															</div>
														</div>
													</div>
													<!-- END Widget -->
												</div>
											</div>
											<!-- END Portlet -->
										</div>
									</div>
									<!-- END Portlet -->
								</div>
							</div>
						</div>
                        <table id="keranjangpembelian" class="hovercolor table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Stok Sebelum</th>
                                    <th>Stok Jumlah Beli</th>
                                    <th>Display</th>
                                    <th>Gudang</th>
                                    <th>Harga Suplier</th>
                                    <th>Exp</th>
                                    <th>Sub Total</th>
                                    <th>Diskon 1</th>
                                    <th>Diskon 2</th>
                                    <th>PPN</th>
                                    <th>After Diskon 1</th>
                                    <th>After Diskon 2</th>
                                    <th>Sub Total Pembelian</th>
                                    <th>HPP</th>
                                    <th>Beban Gaji</th>
                                    <th>Beban Promo</th>
                                    <th>Beban Packing</th>
                                    <th>Beban Transport</th>
                                    <th>HPP + Beban</th>
                                    <th>Nama Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Stok Sebelum</th>
                                    <th>Stok Jumlah Beli</th>
                                    <th>Display</th>
                                    <th>Gudang</th>
                                    <th>Harga Suplier</th>
                                    <th>Exp</th>
                                    <th>Sub Total</th>
                                    <th>Diskon 1</th>
                                    <th>Diskon 2</th>
                                    <th>PPN</th>
                                    <th>After Diskon 1</th>
                                    <th>After Diskon 2</th>
                                    <th>Sub Total Pembelian</th>
                                    <th>HPP</th>
                                    <th>Beban Gaji</th>
                                    <th>Beban Promo</th>
                                    <th>Beban Packing</th>
                                    <th>Beban Transport</th>
                                    <th>HPP + Beban</th>
                                    <th>Nama Barang</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- END Datatable -->
                        <div class="form-group row">
                            <label for="bebanlainlain" class="col-sm-3 col-form-label">Biaya Lain-Lain. <pre>Beban akan dibagi rata dengan jumlah qty terbeli</pre></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input readonly value="" type="text" id="bebanlainlain" class="form-control" placeholder="Tentukan Biaya Lain Lain. Ex: Biaya transport, Beban Ongkir">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button id="simpantransaksipembelian" class="tombolmelayang btn btn-success btn-block"><i class="fas fa-shopping-basket"></i> <?= $buttonsimpan ;?> </button>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    
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
            <table id="admin_daftarsuplier" class="hovercolor table table-bordered table-striped table-hover nowrap">
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
<div class="modal fade mt-2" id="modalubahhargajual" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Silahkan Ubah Harga Jual</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <table id="tabel_ubahhargajual" class="hovercolor table table-bordered table-striped table-hover nowrap">
                <thead>
                    <tr>
                        <th style="text-align:center">Kode Item</th>
                        <th style="text-align:center">Nama Item</th>
                        <th style="text-align:center">Unit</th>
                        <th style="text-align:center">Harga Beli</th>
                        <th style="text-align:center">Harga Jual</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th style="text-align:center">Kode Item</th>
                        <th style="text-align:center">Nama Item</th>
                        <th style="text-align:center">Unit</th>
                        <th style="text-align:center">Harga Beli</th>
                        <th style="text-align:center">Harga Jual</th>
                    </tr>
                </tfoot>
            </table>
            <button onclick="konfirmasiaksi()" class="btn btn-block btn-warning mt-2"><i class="fas fa-close"></i> Oke Selesai</button>
            </div>
            <div class="modal-footer">
            <p class="mb-0"><b style="color:red">CATATAN: </b>Silahkan ubah harga jual yang baru langsung pada form tersebut, maka secara otomatis akan langsung berubah di database pada tiap barang yang terpilih</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url();?>scripts/globalfn.js"></script>
<script type="text/javascript" src="<?=base_url();?>scripts/pembelian/tambahpembelian.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.1/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.4/api/sum().js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/ju/jqc-1.12.4/dt-1.10.20/kt-2.5.1/datatables.min.js"></script>
<script type="text/javascript">
let daftarkeranjang = "";
var anjumlahbeli = [],anstokdisplay = [],anstokgudang = [],hargasuplier = [],/*kadaluarsa = []*/subtotal = [],diskon1 = [],diskon2 = [],ppn = [],adiskon1 = [],adiskon2 = [],subtotalhpp = [],hpp = [],bebangaji = [],bebanpromo = [],bebanpacking = [],bebantransport = [],hppbeban = [], afbelihb = [], afbelihj = [];
var anbebanlainlain = new AutoNumeric("#bebanlainlain", {decimalCharacter : ',',digitGroupSeparator : '.',})
var iseditjs = '<?=$isedit ?>';
$(document).ready(function () {
    $('#jatuhtempoform').hide()
    <?php
    if ($isedit == "true"){ ?>
        anbebanlainlain.set(<?= $biayalainlain ;?>)
        $('#tgltrx').val('<?= $tanggaltrx ;?>');
    <?php }else{ ?>
        anbebanlainlain.set(0)
        $('#tgltrx').val(moment().format('DD-MM-YYYY'));
    <?php } ?>
    $("#tgltrx").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    getCsrfTokenCallback(function() {
        $('#jenispembayaran').select2({
        allowClear: true,
        placeholder: 'Pilih Sumber Dana',
        ajax: {
            url: baseurljavascript + 'masterdata/jenispembayarantransaksi',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    NAMAPARAMETER: (typeof params.term === "undefined" ? "" : params.term),
                }
            },
            processResults: function (data) {
                console.log(data)
                parseJSON = JSON.parse(data);
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: item.namatrx,
                            id: item.kodetrx,
                        }
                    })
                }
            },
            error: function(xhr, status, error) {
                toastr["error"]("Terjadi kesalahan. Silahkan coba lagi nanti atau hubungi Administrator / TIM IT");
            }
        },
    });
    });
    getCsrfTokenCallback(function() {
        daftarkeranjang = $("#keranjangpembelian").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            keys: true,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: false,
            /*fixedColumns: {
                leftColumns: 1,
                rightColumns: 1,
            },*/
            ajax: {
                "url": baseurljavascript + 'pembelian/daftarpembelianlocal',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.KATAKUNCIPENCARIAN = null;
                }
            },
            columnDefs : [
                { 'visible': false, 'targets': [7,21] }
            ],
            drawCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var data = daftarkeranjang.rows().data();
                let totalbelanja = 0, totalbelanjanett = 0;
                data.each(function (value, index) {
                    $('#'+daftarkeranjang.cell(index,7).nodes().to$().find('input').prop('id')).val(moment().format('DD-MM-YYYY'));
                    $('#'+daftarkeranjang.cell(index,7).nodes().to$().find('input').prop('id')).datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,3).nodes().to$().find('input').prop('id'))) { anjumlahbeli[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,3).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,4).nodes().to$().find('input').prop('id'))) { anstokdisplay[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,4).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,5).nodes().to$().find('input').prop('id'))) { anstokgudang[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,5).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,6).nodes().to$().find('input').prop('id'))) { hargasuplier[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,6).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    //if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,7).nodes().to$().find('input').prop('id'))) { kadaluarsa[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,7).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,8).nodes().to$().find('input').prop('id'))) { subtotal[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,8).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,9).nodes().to$().find('input').prop('id'))) { diskon1[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,9).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,10).nodes().to$().find('input').prop('id'))) { diskon2[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,10).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,11).nodes().to$().find('input').prop('id'))) { ppn[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,11).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,12).nodes().to$().find('input').prop('id'))) { adiskon1[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,12).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,13).nodes().to$().find('input').prop('id'))) { adiskon2[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,13).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,14).nodes().to$().find('input').prop('id'))) { subtotalhpp[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,14).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,15).nodes().to$().find('input').prop('id'))) { hpp[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,15).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,16).nodes().to$().find('input').prop('id'))) { bebangaji[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,16).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,17).nodes().to$().find('input').prop('id'))) { bebanpromo[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,17).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,18).nodes().to$().find('input').prop('id'))) { bebanpacking[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,18).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,19).nodes().to$().find('input').prop('id'))) { bebantransport[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,19).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,20).nodes().to$().find('input').prop('id'))) { hppbeban[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,20).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                });
            },
            initComplete: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var data = daftarkeranjang.rows().data();
                let totalbelanja = 0, totalbelanjanett = 0,totalppnmasukan=0;
                data.each(function (value, index) {
                    if (ppn[index].getNumber() > 0){
                        $("#aktifkanpajakmasukan").prop("checked", true);
                    }
                    totalbelanja = totalbelanja + subtotalhpp[index].getNumber()
                    totalbelanjanett = totalbelanjanett + (hppbeban[index].getNumber() * anjumlahbeli[index].getNumber())
                    totalppnmasukan = totalppnmasukan + ppn[index].getNumber()
                    $('#totalpembelian').html(formatuang(totalbelanja.toFixed(2),'id-ID','IDR'));
                    $('#totalpembeliannett').html(formatuang(totalbelanjanett.toFixed(2),'id-ID','IDR'));
                    $('#totalppnmasukan').html(formatuang(totalppnmasukan.toFixed(2),'id-ID','IDR'));
                }); 
                <?php if ($isedit == "true") { ?>
                    hitungdenganinfototal();
                <?php } ;?>
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
        })
    });
    $('#pilihperusahaan').select2({
        allowClear: true,
        placeholder: 'Silahkan tentukan transaksi pembelian a.n perusahaan',
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
    panggilhargajual(null);
});
function panggilhargajual(notranskasi){
    getCsrfTokenCallback(function() {
        formubahhargajual = $("#tabel_ubahhargajual").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            scrollY: "100vh",
            keys: true,
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            ordering: false,
            destroy: true,
            ajax: {
                "url": baseurljavascript + 'pembelian/ubahhargajualsetelahbeli',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.NOTA = notranskasi;
                }
            },
            drawCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var data = formubahhargajual.rows().data();
                data.each(function (value, index) {
                    if (!AutoNumeric.getAutoNumericElement("#"+formubahhargajual.cell(index,3).nodes().to$().find('input').prop('id'))) { afbelihb[index] = new AutoNumeric("#"+formubahhargajual.cell(index,3).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                    if (!AutoNumeric.getAutoNumericElement("#"+formubahhargajual.cell(index,4).nodes().to$().find('input').prop('id'))) { afbelihj[index] = new AutoNumeric("#"+formubahhargajual.cell(index,4).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
                });
            },
        }).on( 'key-focus', function ( e, datatable, cell, originalEvent ) {
            $('input', cell.node()).focus();
        }).on("focus", "td input", function(){
            $(this).select();
        });
        formubahhargajual.on('key', function (e, dt, code) {
            if (code === 13) {
                formubahhargajual.keys.move('down');
            }
        })
    });
}
function tampiljatuhtempo(){
    if ($('#jenispembayaran').val() == "KREDIT"){
        $('#jatuhtempoform').show()
    }else{
        $('#jatuhtempoform').hide()
    }
}
var catchEnterAfB = debounce(function(index) {
    ubahhargajualafb(index)
}, 500);
function ubahhargajualafb(index){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'pembelian/ubahhargajualafb',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KODEITEM : $("#kodeitem"+index).val(),
                HARGAJUAL : afbelihj[index].getNumber(),
            },
            success: function (response) {
                if (response[0].success == "true"){
                    return Swal.fire({
                        icon: 'success',
                        html: 'Horee.. Informasi barang berhasil diubah<br>KODE ITEM: '+$("#kodeitem"+index).val()+'<br>NAMA ITEM: '+$("#namaitem"+index).val(),
                        toast: true,
                        showConfirmButton: false,
                        timer: 1500,
                        position: 'top-right'
                    })
                }else{
                    Swal.fire(
                        'Gagal.. Uhhhhh!',
                        'Tidak ada yang di perbaharui. Silahkan cek pada error log data di server',
                        'error'
                    )
                }
                
            }
        });
    });
}
function konfirmasiaksi(){
swal.fire({
    title: "Oke, Ubah harga selesai",
    text: "Fiyuhh pembelian selesai. Silahkan pilih apakah anda ingin melanjutkan penginputan data atau kembali ke daftar pembelian",
    icon: 'success',
    showCancelButton:true,
    confirmButtonText: "Oke, Lanjut Pembelian!",
    cancelButtonText: "Ke Daftar Aja!",
}).then(function(result){
    kosongkankeranjanglokal();
    if(result.isConfirmed){           
        location.href = baseurljavascript+"pembelian/formpembelian";
    }else{
        location.href = baseurljavascript+"pembelian/daftarpembelian";
    }
})
}
</script>
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->endSection(); ?>