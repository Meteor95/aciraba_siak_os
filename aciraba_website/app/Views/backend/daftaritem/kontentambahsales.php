<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <img src="https://www.barantum.com/blog/wp-content/uploads/2019/04/Monitoring-Sales.png" class="img-fluid" style="display: block;margin: 0 auto;" alt="Tambah Informasi Sales"><hr>
                <div class="form-group row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet">
                            <div class="portlet-header portlet-header-bordered">
                                <h3 class="portlet-title">Masukkan Informasi Sales</h3>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Form Group -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                    <label for="kodesales">Kode Suplier</label>
                                        <div class="input-group">
                                            <input value="<?= $KODESALES;?>" type="text" id="kodesales" class="form-control"
                                                placeholder="Masukkan Kode Sales">
                                            <div class="input-group-prepend">
                                                <span id="generateidsales"
                                                    class="input-group-text btn-warning btn">Generate ID</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label for="namasales">Nama Sales</label>
                                        <input value="<?= $NAMA ;?>" type="text" class="form-control" id="namasales" placeholder="Masukan Nama Sales Anda">
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <!-- BEGIN Form Group -->
                                <div class="form-group row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label for="provinsi">Provinsi</label>
                                        <select id="provinsi" data-size="3" class="selectpicker" data-live-search="true">
                                            <?php if ($PROVINSI != ""){
                                                echo '<option value="'.$PROVINSI.'">Provinsi '.$PROVINSI.'</option>';
                                            };?>
                                            <option value="Aceh">Provinsi Aceh</option>
                                            <option value="Bali">Provinsi Bali</option>
                                            <option value="Banten">Provinsi Banten</option>
                                            <option value="Bengkulu">Provinsi Bengkulu</option>
                                            <option value="DKI Yogyakarta">Provinsi DKI Yogyakarta</option>
                                            <option value="DKI Jakarta">Provinsi DKI Jakarta</option>
                                            <option value="Gorontalo">Provinsi Gorontalo</option>
                                            <option value="Jambi">Provinsi Jambi</option>
                                            <option value="Jawa Barat">Provinsi Jawa Barat</option>
                                            <option value="Jawa Tengah">Provinsi Jawa Tengah</option>
                                            <option value="Jawa Timur">Provinsi Jawa Timur</option>
                                            <option value="Kalimantan Barat">Provinsi Kalimantan Barat</option>
                                            <option value="Kalimantan Selatan">Provinsi Kalimantan Selatan</option>
                                            <option value="Kalimantan Tengah">Provinsi Kalimantan Tengah</option>
                                            <option value="Kalimantan Timur">Provinsi Kalimantan Timur</option>
                                            <option value="Kalimantan Utara">Provinsi Kalimantan Utara</option>
                                            <option value="Kepulauan Bangka Belitung">Provinsi Kepulauan Bangka Belitung</option>
                                            <option value="Kepulauan Riau">Provinsi Kepulauan Riau</option>
                                            <option value="Lampung">Provinsi Lampung</option>
                                            <option value="Maluku">Provinsi Maluku</option>
                                            <option value="Maluku Utara">Provinsi Maluku Utara</option>
                                            <option value="Nusa Tenggara Barat">Provinsi Nusa Tenggara Barat</option>
                                            <option value="Nusa Tenggara Timur">Provinsi Nusa Tenggara Timur</option>
                                            <option value="Papua">Provinsi Papua</option>
                                            <option value="Papua Barat">Provinsi Papua Barat</option>
                                            <option value="Riau">Provinsi Riau</option>
                                            <option value="Sulawesi Barat">Provinsi Sulawesi Barat</option>
                                            <option value="Sulawesi Selatan">Provinsi Sulawesi Selata</option>
                                            <option value="Sulawesi Tengah">Provinsi Sulawesi Tengah</option>
                                            <option value="Sulawesi Tenggara">Provinsi Sulawesi Tenggara</option>
                                            <option value="Sulawesi Utara">Provinsi Sulawesi Utara</option>
                                            <option value="Sumatera Barat">Provinsi Sumatera Barat</option>
                                            <option value="Sumatera Selatan">Provinsi Sumatera Selatan</option>
                                            <option value="Sumatera Utara">Provinsi Sumatera Utara</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <label for="kotasales">Kota</label>
                                        <input value="<?= $KOTA ;?>" type="text" class="form-control" id="kotasales" placeholder="Tentukan Kota Asal Sales">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <label for="alamatsales">Alamat Aktif</label>
                                        <input value="<?= $ALAMAT ;?>" type="text" class="form-control" id="alamatsales" placeholder="Tentukan Alamat Suplier Sales">
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                    <label for="notelpsales">Nomor Telpon</label>
                                        <input value="<?= $TELEPON ;?>" value="" type="text" id="notelpsales" class="form-control" placeholder="Masukkan Nomor Telpon Aktif">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label for="emailsales">E-Mail Suplier</label>
                                        <input value="<?= $EMAIL ;?>" type="text" class="form-control" id="emailsales" placeholder="Masukan E-Mail Suplier Jika Ada">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                    <label for="banksales">Bank Tertuju</label>
                                        <input value="<?= $BANK ;?>" value="" type="text" id="banksales" class="form-control" placeholder="Masukkan Bank Tujuan">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label for="norekening">No Rekening</label>
                                        <input value="<?= $NOREK ;?>" type="text" class="form-control" id="norekening" placeholder="Masukan No Rekening">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input style="visibility: hidden;" checked type="checkbox" id="isinsert">
                        <button id="simpansales" class="btn-block btn btn-primary">Simpan Informasi Sales Anda</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url();?>scripts/masterdata/sales.js"></script>
<script>
    $(document).ready(function () {
        <?php if ($KODESALES != ""){ ?> 
            $("#isinsert").removeAttr("checked");
        <?php } ?>
    });
    $("#generateidsales").on("click", function () {
        $('#kodesales').val("SALES" + session_kodeunikmember + Math.floor(Date.now() / 1000));
    });
</script>
<?= $this->endSection(); ?>