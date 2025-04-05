<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet">
                            <div class="portlet-header portlet-header-bordered">
                                <h3 class="portlet-title">Tambahkan Kupon Belanja</h3>
                                <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                                    <label class="btn btn-flat-success active">
                                        <input type="radio" name="jenisvoucherdiskon" value="1" id="radio-vrp" checked="checked">
                                        Diskon Rupiah </label>
                                    <label class="btn btn-flat-success">
                                        <input type="radio" name="jenisvoucherdiskon" value="0"  id="radio-vper"> Diskon Persen [%]
                                    </label>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Form Group -->
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label for="masukkankodekupon">Masukkan Kupon</label>
                                        <input type="text" class="form-control" id="masukkankodekupon"
                                            placeholder="Buat kode kupon kamu sekarang">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label for="tentukanmasaaktif">Tentukan Masa Aktif Kupon</label>
                                        <div class="input-group input-daterange">
                                            <input id="awalaktifvoucher" type="text" class="form-control" placeholder="Dari Tanggal">
                                            <div class="input-group-prepend input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </span>
                                            </div>
                                            <input id="akhiraktifvoucher" type="text" class="form-control" placeholder="Sampai Tanggal">
                                        </div>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <!-- BEGIN Form Group -->
                                <div class="form-group row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="nomiunalpootngan">Tentukan Nominal Potongan</label>
                                            <input type="text" class="form-control" id="nominalpotongan"
                                                placeholder="10.000">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="bataspakaikipon">Tentukan Batas Pakai Kupon</label>
                                            <input type="text" class="form-control" id="bataspakaikupon"
                                                placeholder="100">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="minimalpembelianvoucher">Tentukan Minimal Pembelian Aktif Kupon</label>
                                            <input type="text" class="form-control" id="minimalpembelianvoucher"
                                                placeholder="1.000.000">
                                        </div>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                            </div>
                        </div>
                        <button id="simpanvoucherbelanja" class="btn-block btn btn-primary">Simpan Kupon Belanja</button>
                    </div>
                </div>
                <div class="header-wrap header-wrap-block">
                    <h3 class="title">KUPON BELANJA YANG TELAH DITAMBAHKAN</h3>
                </div>
                <hr>
                <!-- BEGIN Datatable -->
                <table class="tabelvoucherbelanja table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Kode Kupon</th>
                            <th>Awal Aktif</th>
                            <th>Akhir Aktif</th>
                            <th>Tipe Voucher</th>
                            <th>Nominal Rupiah</th>
                            <th>Nominal Presentase</th>
                            <th>Batas Pakai</th>
                            <th>Minimal Pembelian</th>
                            <th>Outlet</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Aksi</th>
                            <th>Kode Kupon</th>
                            <th>Awal Aktif</th>
                            <th>Akhir Aktif</th>
                            <th>Tipe Voucher</th>
                            <th>Nominal Rupiah</th>
                            <th>Nominal Presentase</th>
                            <th>Batas Pakai</th>
                            <th>Minimal Pembelian</th>
                            <th>Outlet</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- END Datatable -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="<?= base_url();?>scripts/masterdata/voucherbelanja.js"></script>
<script type="text/javascript">
var nominalpotongan = new AutoNumeric("#nominalpotongan", {decimalCharacter : ',',digitGroupSeparator : '.',})
var bataspakaikupon = new AutoNumeric("#bataspakaikupon", {decimalCharacter : ',',digitGroupSeparator : '.',})
var minimalpembelianvoucher = new AutoNumeric("#minimalpembelianvoucher", {decimalCharacter : ',',digitGroupSeparator : '.',})
</script>
<?= $this->endSection(); ?>