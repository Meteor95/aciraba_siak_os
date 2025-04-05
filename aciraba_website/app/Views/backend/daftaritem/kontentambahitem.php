<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet">
<style>
.image-container {
  position: relative;
  display: inline-block;
}

.edit-icon {
  position: absolute;
  top: 10px;
  right: 10px;
  color: #fff;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-body">
                        <div class="mb-3">
                            <!-- BEGIN Nav -->
                            <div class="nav nav-lines" id="nav1-tab">
                                <a class="nav-item nav-link active" id="nav1-home-tab" data-toggle="tab"
                                    href="#nav1-home">Informasi Dasar</a>
                                <a class="nav-item nav-link" id="nav1grosirdanvoucher" data-toggle="tab"
                                    href="#nav1-contact">Extra Mode</a>
                                <a class="nav-item nav-link" id="nav1-contact-media" data-toggle="tab"
                                    href="#nav1-media">Citra Produk</a>
                            </div>
                            <!-- END Nav -->
                        </div>
                        <!-- BEGIN Tab -->
                        <div class="tab-content" id="nav1-tabContent">
                            <div class="tab-pane fade show active" id="nav1-home">
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="portlet">
                                            <div class="portlet-header portlet-header-bordered">
                                                <h3 class="portlet-title">Informasi Dasar Barang</h3>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="form-group row">
                                                    <label for="kodebarang" class="col-sm-3 col-form-label">Kode
                                                        Barang</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input value="<?= $BARANG_ID ;?>" type="text" id="kodebarang" class="form-control"
                                                                placeholder="Masukkan Kode Barang Produk">
                                                            <div class="input-group-prepend">
                                                                <span id="generateiditem"
                                                                    class="input-group-text btn-warning btn">Generate
                                                                    ID</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kodebarangqrcode" class="col-sm-3 col-form-label">QR Code
                                                        Barang</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input value="<?= $QRCODE_ID ;?>" type="text" id="kodebarangqrcode" class="form-control"
                                                                placeholder="Masukkan Kode QR barang jika tersedia">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="namabarang" class="col-sm-3 col-form-label">Nama
                                                        Barang</label>
                                                    <div class="col-sm-9">
                                                        <input value="<?= $NAMABARANG ;?>" type="text" id="namabarang" class="form-control"
                                                            placeholder="Masukan nama barang">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="beratbarang" class="col-sm-3 col-form-label">Berat
                                                        Barang</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input value="<?= $BERAT_BARANG;?>" id="beratbarang" type="text"
                                                                class="form-control" placeholder="Masukan berat barang">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Gram [gr]</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="hargapokokpembelian" class="col-sm-3 col-form-label">Harga Pokok</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input value="<?= $HARGABELI ;?>" type="text" id="hargapokokpembelian"
                                                            class="form-control"
                                                            placeholder="Masukkan Harga Pokok Pembelian">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="kodebarang" class="col-sm-3 col-form-label">Harga Jual Umum</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input value="<?= $HARGAJUAL ;?>" type="text" id="hargajualumum"
                                                            class="form-control" placeholder="Tentukan Harga Jual Umum">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="pilihprincipal">
                                                    <?php if ($PARETO_ID != ""){ echo "<option value=\"".$PARETO_ID."\">[".$PARETO_ID."] ".$NAMA_PRINCIPAL."</option>";}?> 
                                                    <option value="0">[0] PRINCIPAL TIDAK DIKETAHUI</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="pilihsuplier">
                                                    <?php if ($SUPPLER_ID != ""){ echo "<option value=\"".$SUPPLER_ID."\">[".$SUPPLER_ID."] ".$NAMASUPPLIER."</option>";}?>
                                                    <option value="UNKWNSUP">[UNKWNSUP] Suplier Tidak Terdeteksi</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="pilihkategori">
                                                    <?php if ($KATEGORI_ID != ""){ echo "<option value=\"".$KATEGORI_ID."\">[".$KATEGORI_ID."] ".$NAMAKATEGORI."</option>"; }?>
                                                    <option value="UNKWNKAT">[UNKWNKAT] TIDAK ADA KATEGORI</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="pilihsatuan"><?php
                                                    if ($SATUAN != ""){ echo "<option value=\"".$SATUAN."\">[".$SATUAN."] ".$NAMASATUAN."</option>"; }?>
                                                    <option value="PCS">[PCS] PCS</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="pilihbrand"><?php
                                                    if ($BRAND_ID != ""){ echo "<option value=\"".$BRAND_ID."\">[".$BRAND_ID."] ".$NAMA_BRAND."</option>"; }?>
                                                    <option value="0">[0] BRAND TIDAK DIKETAHUI</option>
                                                    </select>
                                                </div>
                                                <hr>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label id="btn-status-item-1" class="btn-status-item btn btn-flat-success">
                                                        <input value="1" type="radio" name="rb_statusbarangtambahitem" id="radio-button-1"> Barang Aktif </label>
                                                    <label id="btn-status-item-0" class="btn-status-item btn btn-flat-danger active">
                                                        <input value="0" type="radio" name="rb_statusbarangtambahitem" id="radio-button-2" >Barang Tidak Aktif </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="portlet">
                                            <div class="portlet-header portlet-header-bordered">
                                                <h3 class="portlet-title">Informasi Akuntansi Item</h3>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="form-group">
                                                    <select class="form-control" id="pilihperusahaan">
                                                    <?php if ($PEMILIK != ""){ echo "<option value=\"".$PEMILIK."\">[".$PEMILIK."] ".$NAMAPERUSAHAAN."</option>";}?>
                                                    <option value="0">[0] Perusahaan Induk</option>
                                                    </select>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="aktifkanbestbuy">
                                                            <label class="custom-control-label"
                                                                for="aktifkanbestbuy">Aktifkan Best Buy</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="barangbukanstok">
                                                            <label class="custom-control-label"
                                                                for="barangbukanstok">Barang
                                                                Ini Bukan Stok [Jasa]</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="stokdapatminus">
                                                            <label class="custom-control-label"
                                                                for="stokdapatminus">Stok
                                                                Dapat Minus</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="portlet-header portlet-header-bordered">
                                            <h3 class="portlet-title">Informasi Terjabar Barang Ini</h3>
                                        </div>
                                        <div class="portlet-body">
                                            <!-- BEGIN Editor -->
                                            <div class="quill" id="quill">
                                                Tidak ada informasi mengenai barang ini
                                            </div>
                                            <!-- END Editor -->
                                        </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav1-contact">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <!-- BEGIN Portlet -->
                                    <div class="portlet">
                                        <div class="portlet-body">
                                            <div class="mb-3">
                                                <!-- BEGIN Nav -->
                                                <div class="nav nav-lines" id="nav1-tabvouchergrosir">
                                                    <a class="nav-item nav-link active" id="tab_baranggrosir" data-toggle="tab" href="#nav1-grosir">Barang Grosir</a>
                                                    <a class="nav-item nav-link" id="tab_tambahan" data-toggle="tab" href="#nav1-tambahan">Varian Non Stok</a>
                                                </div>
                                                <!-- END Nav -->
                                            </div>
                                            <!-- BEGIN Tab -->
                                            <div class="tab-content" id="nav1-tabContent">
                                                <div class="tab-pane fade show active" id="nav1-grosir">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="aktifbaranggrosir">
                                                        <label class="custom-control-label" for="aktifbaranggrosir">Aktifkan Sistem Grosir</label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <!-- BEGIN Table -->
                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                            <table id="tabelhargagrosir" class="table table-sm mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Nama Barang</th>
                                                                        <th scope="col">Minimal Beli</th>
                                                                        <th scope="col">Harga Jual</th>
                                                                        <th scope="col">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                            <!-- END Table -->
                                                            <button disabled id="tambahbarangbonus" class="btn-block btn btn-primary">Tambah Baris Grosir</button>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="portlet">
                                                                <div class="portlet-header portlet-header-bordered">
                                                                    <h3 class="portlet-title">Informasi</h3>
                                                                </div>
                                                                <div class="portlet-body">
                                                                    <p align="justify">kebijakan penetapan harga dengan
                                                                        cara memberikan potongan harga, baik untuk
                                                                        penjualan kontan/tunai/piutang maupun penjualan
                                                                        dalam jumlah banyak.</p>
                                                                    <p align="justify">contoh: <br> Beli 2 - 5 Harga
                                                                        9500<br> Beli 6 - 10 Harga 8500 <br>* Beli 11
                                                                        Harga 8300<br><br> Kelipatan terakhir akan
                                                                        digunakan sebagai harga untuk kuantiti
                                                                        selanjutnya sampai maksimal stok tersedia</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade show" id="nav1-tambahan">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="aktifkanbarangtambahan">
                                                        <label class="custom-control-label" for="aktifkanbarangtambahan">Aktifkan Tambahan Barang</label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <!-- BEGIN Table -->
                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                            <table id="tabelbarangtambahan" class="table table-sm mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Nama Barang</th>
                                                                        <th scope="col">Tambahan Harga Jual</th>
                                                                        <th scope="col">Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                            <!-- END Table -->
                                                            <button disabled id="barangtambahan" class="btn-block btn btn-primary">Tambah Baris</button>
                                                        </div>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="portlet">
                                                                <div class="portlet-header portlet-header-bordered">
                                                                    <h3 class="portlet-title">Informasi</h3>
                                                                </div>
                                                                <div class="portlet-body">
                                                                    <p align="justify">Pada informasi tab ini berfungsi sebagai tambahan barang jika ingin ditambahkan seperti Beli barang A mendapat barang B,C. Sistem barang B, C tidak terkait dengan HPP ataupun stok, hanya akan menambah NOMINAL harga jual + harga bonus yang ditentukan dan harus konfirmasi manual dari KASIR</p>
                                                                    <p align="justify">Contoh: Beli Minuman ICE BLEND HJ:2000, HPP:1500<br>
                                                                    1. Toping +1000<br>
                                                                    2. Gula +500<br>
                                                                    Maka harga jual akan diubah menajdi 2000+1000+500 = 3500 sebagai HJ:3500 tetapi HPP tetap 1500
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Portlet -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="nav1-media">
                                <div class="portlet">
                                    <div class="portlet-header portlet-header-bordered">
                                        <h3 class="portlet-title">Berikan Gambar Yang Menarik</h3>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="dropzone">
                                            <div class="dz-message">
                                                <h3> Klik atau Drop gambar disini [MAX : 8 Gambar]</h3>
                                                <h5>Gambar ke 9 atas tidak akan teruplaod</h5>
                                            </div>
                                        </div>
                                        <hr>
                                        <center><h3><?= $TOTALGAMBAR ;?> Citra Untuk Produk <?= $NAMABARANG ;?></h3></center>
                                        <div class="flexbin flexbin-margin">
                                            <?php for($i=0; $i<$TOTALGAMBAR; $i++){ ?>
                                                <div class="image-container">
                                                    <img src=<?=base_url().'upload/citraitem/'.$DAFTARCITRAITEM[$i]->FILENAME;?>>
                                                    <a class="edit-icon btn btn-danger" style="margin-right:35px" onclick='deleteimagedropzone("<?=$DAFTARCITRAITEM[$i]->FILENAME;?>","")' href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                                                    <a onclick='pilihcitrautama("<?=$DAFTARCITRAITEM[$i]->FILENAME;?>","<?=$DAFTARCITRAITEM[$i]->KODEITEM;?>")' class="edit-icon btn btn-success" href="javascript:void(0)"><i class="fas fa-check"></i></a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Tab -->
                            <button id="btn_simpan_tambahitem" class="btn btn-primary"><i class="fas fa-save"></i> Simpan </button>
                            <button data-toggle="modal" data-id="pecahsatuan" data-target="#modalPecahsatuan"  class="btn btn-primary"><i class="fas fa-boxes"></i> Pecah Satuan </button>
                            <input style="visibility: hidden;" checked type="checkbox" id="isinsert">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN Modal -->
<div class="modal fade" id="modalPecahsatuan">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pecah Satuan <?= $NAMABARANG ;?> Menjadi ?</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="kodebarangpecahsatuan" class="col-sm-3 col-form-label">Kode Barang</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="kodebarangpecahsatuan" class="form-control"
                                placeholder="Pilih barang terlebih dahulu">
                            <div class="input-group-prepend">
                                <span id="generateiditem" data-toggle="modal" data-target="#modal6" class="input-group-text btn-warning btn">Pilih Barang</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namabarangpecahsatuan" class="col-sm-3 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input readonly type="text" id="namabarangpecahsatuan" class="form-control" placeholder="Pilih barang terlebih dahulu">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="potongstokpecahsatuan" class="col-sm-3 col-form-label">Potong Stok</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="potongstokpecahsatuan" class="form-control" placeholder="1">
                        </div>
                    </div>
                    <small style="text-align: justify;" class="form-text text-muted">Stok barang <?= $NAMABARANG ;?> akan dikurangi sebesar "POTONG STOK" yang kemudian akan dikonversikan ke stok barang tujuan</small>
                </div>
                <div class="form-row">
                    <label for="konversistokpecahsatuan" class="col-sm-3 col-form-label">Konversi Stok</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="konversistokpecahsatuan" placeholder="Tentukan Stok Baru">
                    </div>
                    <div class="col-md-4">
                    <select class="form-control" id="pilihsatuansatuannya"><?php
                        if ($SATUAN != ""){ echo "<option value=\"".$SATUAN."\">[".$SATUAN."] ".$NAMASATUAN."</option>"; }?> </select>
                    </div>
                    <small style="text-align: justify;" class="form-text text-muted">Stok baru akan ditambahkan ke tujuan kodeitem sebesar konversi stok dan stok lama akan dikurangi sebesar potong stok dan akan tercatat di kartu stok sebagai pecah satuan</small>
                </div>
                <div class="form-group row">
                    <label for="hargajualbaru" class="col-sm-3 col-form-label">Atur Harga Jual</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="hargajualbaru" class="form-control" placeholder="Tentukan Harga Jual Umum">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hppprodukbaru" class="col-sm-3 col-form-label">HPP Produk</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="hppprodukbaru" class="form-control" placeholder="Tentukan HPP produk ini">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
				<button id="simpanpecahsatuan" class="btn btn-outline-primary">Proses Sekarang</button>
			</div>
        </div>
    </div>
</div>
<!-- END Modal -->
</div>
<!--/*JS AREA KONTEN TAMBAH ITEM */-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
</script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://rawgit.com/RobinHerbots/Inputmask/5.x/dist/jquery.inputmask.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>

<script src="<?= base_url();?>scripts/dropzone-5.7.0/min/dropzone.min.js"></script>
<script src="<?= base_url();?>scripts/masterdata/masteritem.js"></script>
<script type="text/javascript">
var beratbarang = new AutoNumeric("#beratbarang", {decimalCharacter : ',',digitGroupSeparator : '.',})
var hargapokokpembelian = new AutoNumeric("#hargapokokpembelian", {decimalCharacter : ',',digitGroupSeparator : '.',})
var hargajualumum = new AutoNumeric("#hargajualumum", {decimalCharacter : ',',digitGroupSeparator : '.',})
$(document).ready(function () {
    let tabelbonusabc = $('#bonusbarangitem').DataTable({pageLength: 5,lengthMenu: [5, 10, 15],});
    let tabelgrosir = $('#tabelhargagrosir').DataTable({pageLength: 5,bLengthChange: false,bFilter: false,});
    let tabelbarangtambahan = $('#tabelbarangtambahan').DataTable({pageLength: 5,bLengthChange: false,bFilter: false,});
    <?php if ($BARANG_ID != ""){ ?> 
        $(".btn-status-item").removeClass("active");
        $("#btn-status-item-<?=$AKTIF;?>").addClass("active");
        $('input:radio[name="rb_statusbarangtambahitem"]').filter('[value="<?=$AKTIF;?>"]').attr('checked', true);
        $("#isinsert").removeAttr("checked");
        $("#aktifkanbestbuy").prop('checked',  <?= $APAKAHGROSIR == "AKTIF" ? 'true' : 'false'  ;?>);
        $("#barangbukanstok").prop('checked', <?= $JENISBARANG == "JASA" ? 'true' : 'false' ;?>);
        $("#stokdapatminus").prop('checked', <?= $STOKDAPATMINUS == "DAPAT MINUS" ? 'true' : 'false'  ;?>);
        $("#aktifbaranggrosir").prop('checked', <?= $APAKAHGROSIR == "AKTIF" ? 'true' : 'false'  ;?>);
        $("#tambahbarangbonus").prop('disabled', <?= $APAKAHGROSIR == "AKTIF" ? 'false' : 'true'  ;?>);
        $("#aktifkanbarangtambahan").prop('checked', <?= $APAKAHBONUS == "AKTIF" ? 'true' : 'false'  ;?>);
        $("#barangtambahan").prop('disabled', <?= $APAKAHGROSIR == "AKTIF" ? 'false' : 'true'  ;?>);
        quillHtml.clipboard.dangerouslyPasteHTML('<?= $KETERANGANBARANG ;?>');
        <?php for ($i=0; $i < $JUMLAHDATAHARGAGROSIR; $i++) { ?>
            tabelgrosir.row.add( [
                '<?= $NAMABARANG ;?>',
                "<input name=\"bonusitem[]\" class=\"grosirqty form-control\" type=\"text\" value=\"<?= $DATAHARGAGROSIR[$i]->JIKABELI ;?>\">",
                "<input name=\"bonusitem[]\" class=\"grosirqtyharga form-control\" type=\"text\" value=\"<?= $DATAHARGAGROSIR[$i]->HARGABELIGROSIR ;?>\">",
                '<div><button class=\"hapushargagrosir btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>',
            ] ).draw( false );        
        <?php } ?>
        <?php for ($i=0; $i < $JUMLAHDATABARANGTAMBAHAN; $i++) { ?>
            tabelbarangtambahan.row.add( [
                "<input name=\"namatambahan[]\" class=\"grosirqty form-control\" type=\"text\" value=\"<?= $DATAHARGATAMBAHAN[$i]->NAMATAMBAHAN ;?>\">",
                "<input name=\"bonusitem[]\" class=\"grosirqty form-control\" type=\"text\" value=\"<?= $DATAHARGATAMBAHAN[$i]->HARGA ;?>\">",
                '<div><button class=\"hapusbarangtambahan btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>',
            ] ).draw( false );        
        <?php } ?>
    <?php } ?>
    $("#generateiditem").on("click", function () {
        $('#kodebarang, #kodeitemdiskonxnx, #kodeitemdiskonxnxvoucher').val("ACI" + session_kodeunikmember +
            Math.floor(Date.now() / 1000));
    });
    $("#kodebarang").on('input', function (e) {
        $('#kodeitemdiskonxnx, #kodeitemdiskonxnxvoucher').val($('#kodebarang').val());
    });
    
    $('#pilihprincipal').select2({
        allowClear: true,
        placeholder: 'Tentukan principal barang ini',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonprincipal',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function(params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    NAMAPRINCIPAL: (typeof params.term === "undefined" ? "" : params.term),
                    KODEUNIKMEMBER: session_kodeunikmember,
                };
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.kodeprincipal + "] " + item.namaperusahaan,
                            id: item.kodeprincipal,
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
    $('#pilihsuplier').select2({
        allowClear: true,
        placeholder: 'Tentukan nama suplier terakhir',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonsuplierselect',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    DIMANA1: (typeof params.term === "undefined" ? "" : params.term),
                    DIMANA10: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.idsupplier + "] " + item.namasuplier,
                            id: item.idsupplier,
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
    $('#pilihkategori').select2({
        allowClear: true,
        placeholder: 'Tentukan nama kategori',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonkategoriselect',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    DIMANA1: (typeof params.term === "undefined" ? "" : params.term),
                    DIMANA10: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.idkategori + "] " + item.namakategori,
                            id: item.idkategori,
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
    $('#pilihsatuan').select2({
        allowClear: true,
        placeholder: 'Tentukan satuan item',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonsatuanselect',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    DIMANA1: (typeof params.term === "undefined" ? "" : params.term),
                    DIMANA10: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.idsatuan + "] " + item.namasatuan,
                            id: item.idsatuan,
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
    $('#pilihsatuansatuannya').select2({
        allowClear: true,
        placeholder: 'Tentukan satuan item',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonsatuanselect',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    DIMANA1: (typeof params.term === "undefined" ? "" : params.term),
                    DIMANA10: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.idsatuan + "] " + item.namasatuan,
                            id: item.idsatuan,
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
    $('#pilihperusahaan').select2({
        allowClear: true,
        placeholder: 'Tentukan kepemilikan barang',
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
    $('#pilihbrand').select2({
        allowClear: true,
        placeholder: 'Tentukan brand barang ini',
        ajax: {
            url: baseurljavascript + 'masterdata/jsonpilihbrand',
            method: 'POST',
            dataType: 'json',
            delay: 500,
            data: function (params) {
                return {
                    csrf_aciraba: csrfTokenGlobal,
                    NAMABRAND: (typeof params.term === "undefined" ? "" : params.term),
                    KODEUNIKMEMBER: session_kodeunikmember,
                }
            },
            processResults: function (data) {
                parseJSON = JSON.parse(data);
                getCsrfTokenCallback(function() {});
                return {
                    results: $.map(parseJSON, function (item) {
                        return {
                            text: "[" + item.kodebrang + "] " + item.namabrand,
                            id: item.kodebrang,
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
});

$('#bonusbarangitem').on('click', '.hapusbonusbarang', function () {
    let table = $('#bonusbarangitem').DataTable();
    let row = $(this).parents('tr');
    if ($(row).hasClass('child')) {
        table.row($(row).prev('tr')).remove().draw();
    } else {
        table.row($(this).parents('tr')).remove().draw();
    }
});
/* algoritma master item bonus barang area */
$("#belixgratisx").change(function() {
    if(this.checked) {
        if ($("#kodebarang").val().length === 0){
            Swal.fire({
                position: 'bottom-end',
                icon: 'warning',
                title: 'Pastikan KODEITEM sudah diisi untuk mengaktifkan fitur ini',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            })
            $('#belixgratisx').prop('checked', false);
        }
    }
});
/* batas akhir algoritma master item bonus barang area */
$("#belixgratisabc").change(function() {
    if(this.checked) {
        if ($("#kodebarang").val().length === 0){
            Swal.fire({
                position: 'bottom-end',
                icon: 'warning',
                title: 'Pastikan KODEITEM sudah diisi untuk mengaktifkan fitur ini',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            })
            $('#belixgratisabc').prop('checked', false);
            $("#bonusbarang").prop('disabled', true);
        }else{
            $("#bonusbarang").prop('disabled', false);
        }
    }else{
        $("#bonusbarang").prop('disabled', true);
    }
});
$('#tabelhargagrosir').on('click', '.hapushargagrosir', function () {
    var table = $('#tabelhargagrosir').DataTable();
    var row = $(this).parents('tr');
    if ($(row).hasClass('child')) {
        table.row($(row).prev('tr')).remove().draw();
    } else {
        table.row($(this).parents('tr')).remove().draw();
    }
});
/* batas akhir algoritma master item harga grosir */
$("#tambahbarangbonus").on("click", function () {
    $('#tabelhargagrosir').DataTable().row.add([
        $("#namabarang").val(),
        "<input name=\"bonusitem[]\" class=\"grosirqty form-control\" type=\"text\" value=\"1\">",
        "<input name=\"bonusitem[]\" class=\"grosirqtyharga form-control\" type=\"text\" value=\"1\">",
        "<div><button class=\"hapushargagrosir btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>",
    ]).draw(false);
});
$("#aktifbaranggrosir").change(function() {
    if(this.checked) {
        if ($("#kodebarang").val().length === 0 || $("#namabarang").val().length === 0){
            Swal.fire({
                position: 'bottom-end',
                icon: 'warning',
                title: 'Pastikan KODEITEM dan NAMABARANG sudah diisi untuk mengaktifkan fitur ini',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            })
            $('#aktifbaranggrosir').prop('checked', false);
            $("#tambahbarangbonus").prop('disabled', true);
        }else{
            $("#tambahbarangbonus").prop('disabled', false);
        }
    }else{
        $("#tambahbarangbonus").prop('disabled', true);
    }
});
$("#aktifkanbarangtambahan").change(function() {
    if(this.checked) {
        if ($("#kodebarang").val().length === 0 || $("#namabarang").val().length === 0){
            Swal.fire({
                position: 'bottom-end',
                icon: 'warning',
                title: 'Pastikan KODEITEM dan NAMABARANG sudah diisi untuk mengaktifkan fitur ini',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            })
            $('#aktifkanbarangtambahan').prop('checked', false);
            $("#barangtambahan").prop('disabled', true);
        }else{
            $("#barangtambahan").prop('disabled', false);
        }
    }else{
        $("#barangtambahan").prop('disabled', true);
    }
});
$('#tabelbarangtambahan').on('click', '.hapusbarangtambahan', function () {
    var table = $('#tabelbarangtambahan').DataTable();
    var row = $(this).parents('tr');
    if ($(row).hasClass('child')) {
        table.row($(row).prev('tr')).remove().draw();
    } else {
        table.row($(this).parents('tr')).remove().draw();
    }
});
$("#barangtambahan").on("click", function () {
    $('#tabelbarangtambahan').DataTable().row.add([
        "<input name=\"namatambahan[]\" class=\"namatambahan form-control\" type=\"text\" value=\"\" placeholder=\"Silahkan Tentukan Nama\">",
        "<input name=\"bonusitem[]\" class=\"tambahanqtyharga form-control\" type=\"text\" value=\"0\">",
        "<div><button class=\"hapusbarangtambahan btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>",
    ]).draw(false);
});
/* batas akhir algoritma master item voucher barang */
$("#tab_voucherbarang").on("click", function () {
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let target = $(e.target).attr("href")
        if (target == "#nav1-voucher"){
            $("#btn_simpan_tambahitem").prop('disabled', true);
        }else{
            $("#btn_simpan_tambahitem").prop('disabled', false);
        }
    });
});
$("#aktifvoucherbarnag").change(function() {
    if(this.checked) {
        if ($("#kodebarang").val().length === 0){
            Swal.fire({
                position: 'bottom-end',
                icon: 'warning',
                title: 'Pastikan KODEITEM sudah diisi untuk mengaktifkan fitur ini',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            })
            $('#aktifvoucherbarnag').prop('checked', false);
            $("#tambahbarisvoucher").prop('disabled', true);
        }else{
            $("#tambahbarisvoucher").prop('disabled', false);
        }
    }else{
        $("#tambahbarisvoucher").prop('disabled', true);
    }
});
$("#nav1grosirdanvoucher").on("click", function () {
    $('#nav1-tabvouchergrosir a[href="#nav1-grosir"]').tab('show')
    $("#tab_baranggrosir").addClass("active");
    $("#tab_voucherbarang").removeClass("active");
});
/* upload dropzone */
Dropzone.autoDiscover = false;
let namafiledariserver = "";
var foto_upload = new Dropzone(".dropzone",
{
    url: "<?= base_url('masterdata/uploadcitra') ?>",
    maxFiles:8,
    method:"post",
    acceptedFiles:"image/*",
    paramName:"userfile",
    dictInvalidFileType:"Terjadi kesalahan dalam mengupload gambar",
    addRemoveLinks:true,
    headers: {
        'X-CSRF-TOKEN': getCsrfTokenCallback(function() {})
    },
    init: function () {
        this.on("sending", function(file, xhr, formData){
            formData.append("csrf_aciraba", csrfTokenGlobal);
            formData.append("kodeunikmember", session_kodeunikmember);
            formData.append("kodeitem", $("#kodebarang").val());
            formData.append("tanggalclient", moment().format("YYYYMMDD"));
            getCsrfTokenCallback(function() {})
        });
        this.on("success", function (file, responseText) {
            let data = JSON.parse(responseText)
            namafiledariserver = data[2];
            if (data[0] == "GAGAL"){
                toastr["error"](data[1]);
            }
            getCsrfTokenCallback(function() {})
        });
        this.on("removedfile", function(namafile) {
            deleteimagedropzone(namafile.name,"dropzonejs");
        });
    }
});
//Event ketika Memulai mengupload
foto_upload.on("sending",function(a,b,c){
    a.token=Math.random();
    c.append("token_foto",a.token); //Menmpersiapkan token untuk masing masing foto
});
function pilihcitrautama(idcitra,kodeitem){
    Swal.fire({
        title: 'Jadikan Citra Utama',
        text: 'Apakah anda yakin ingin menjadikan citra ini mejadi citra utama',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Saya Pilih Ini'
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript+'masterdata/pilihcitrautama',
                    method: 'POST',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        IDCITRA:idcitra,
                        KODEITEM:kodeitem,
                    },
                    dataType:'json', 
                    success: function (response) {
                        toastr["info"]("Citra ini berhasil menjadi citra utama pada PRODUK ITEM ini");
                    }
                });
            });
        }
    });
}
function deleteimagedropzone(namafile,kondisi){
    const date = new Date();
    let namafileyangakandihapus;
    if (kondisi == "dropzonejs"){
        namafileyangakandihapus = 'ACIPAY_'+$("#kodebarang").val()+'_'+session_kodeunikmember+"_"+moment().format("YYYYMMDD")+"_"+namafile.split(' ').join('');
    }else{
        namafileyangakandihapus = namafile;
    }
    Swal.fire({
        title: kondisi == "dropzonejs" ? 'File Terhapus' : 'Apakah anda yakin?',
        text: kondisi == "dropzonejs" ? 'File dengan nama '+namafileyangakandihapus+' telah terhapus.' :'Apakah anda ingin menghapus nama file '+namafileyangakandihapus,
        icon: kondisi == "dropzonejs" ? 'success' : 'question',
        showCancelButton: kondisi == "dropzonejs" ? false : true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: kondisi == "dropzonejs" ? 'Mantap Bre!!' : 'Oke, Saya hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript+'masterdata/deletefilephp',
                    method: 'POST',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        filehapus:namafileyangakandihapus,
                        kodeitem:$("#kodebarang").val(),
                        kodeunikmember:session_kodeunikmember,
                    },
                    dataType:'json', 
                    success: function (response) {
                        toastr["info"]("Silahkan merefresh HALAMAN ini jika ingin melihat hasil dari PENGHAPUSAN CITRA ITEM yang terpilih tadi.");
                    }
                });
            });
        }
    });
}
var quillHtml = new Quill('#quill', {
    modules: { toolbar: [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }], 
            [{ 'align': [] }],
            ['link', 'image'],
        ] },
    theme: 'snow',
});
</script>
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->endSection(); ?>