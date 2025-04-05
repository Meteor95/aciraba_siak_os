<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <img src="https://cdn.acirabadatabase.com/acirabawebsite/suplier_01.png" class="img-fluid" alt="Tambah Informasi Suplier" style="display: block;margin: 0 auto;"><hr>
                <div class="form-group row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="portlet">
                            <div class="portlet-header portlet-header-bordered">
                                <h3 class="portlet-title">Masukkan Informasi Suplier</h3>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Form Group -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                    <label for="kodesuplier">Kode Suplier</label>
                                        <div class="input-group">
                                            <input value="<?= $KODESUPPLIER;?>" type="text" id="kodesuplier" class="form-control"
                                                placeholder="Masukkan Kode Suplier">
                                            <div class="input-group-prepend">
                                                <span id="generateidsuplier" class="input-group-text btn-warning btn">Generate ID</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label for="namasuplier">Nama Suplier</label>
                                        <input value="<?= $NAMASUPPLIER ;?>" type="text" class="form-control" id="namasuplier" placeholder="Masukan Nama Suplier Anda">
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <!-- BEGIN Form Group -->
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <label for="provinsi">Negara</label>
                                        <input type="text" class="form-control" id="negerasuplier" value="<?= $NEGARA == "" ? "" : $NEGARA ;?>" readonly>
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <label for="provinsi">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsisuplier" value="<?= $PROVINSI == "" ? "" : $PROVINSI ;?>" placeholder="Tentukan Provinsi Jika Tau">
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <label for="kotasuplier">Kota / Kabupaten</label>
                                        <input type="text" class="form-control" id="kotasuplier" value="<?= $KOTAKAB == "" ? "" : $KOTAKAB ;?>" placeholder="Tentukan Kota / Kabupaten Jika Tau">
                                    </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <label for="kotasuplier">Kecamatan</label>
                                        <input type="text" class="form-control" id="kecamatansuplier" value="<?= $KECAMATAN == "" ? "" : $KECAMATAN ;?>" placeholder="Tentukan Kecamata Jika Tau">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label for="alamatsuplier">Alamat Aktif</label>
                                        <input value="<?= $ALAMAT == "" ? "" : $ALAMAT ;?>" type="text" class="form-control" id="alamatsuplier" placeholder="Tentukan Alamat Suplier Aktif">
                                    </div>
                                </div>
                                <!-- END Form Group -->
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                    <label for="notelpsuplier">Nomor Telpon</label>
                                        <input value="<?= $NOTELP == "" ? "" : $NOTELP ;?>" value="" type="text" id="notelpsuplier" class="form-control" placeholder="Masukkan Nomor Telpon Aktif">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label for="emailsuplier">E-Mail Suplier</label>
                                        <input value="<?= $EMAIL == "" ? "" : $NAMABANK ;?>" type="text" class="form-control" id="emailsuplier"
                                            placeholder="Masukan E-Mail Suplier Jika Ada">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                    <label for="namabanksuplier">Nama BANK </label>
                                        <input value="<?= $NAMABANK == "" ? "" : $NAMABANK ;?>" value="" type="text" id="namabanksuplier" class="form-control" placeholder="Masukkan Nama Bank">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <label for="nomorrekening">Nomor Rekening</label>
                                        <input value="<?= $NOREK == "" ? "" : $NOREK ;?>" type="text" class="form-control" id="nomorrekening" placeholder="Masukan Nomor Rekening">
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <label for="atasnamarek">Atas Nama</label>
                                        <input value="<?= $ATASNAMA == "" ? "" : $ATASNAMA ;?>" type="text" class="form-control" id="atasnamarek" placeholder="Masukan Nama Pemilik Rekening">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input style="visibility: hidden;" checked type="checkbox" id="isinsert">
                        <button id="simpansuplier" class="btn-block btn btn-primary">Simpan Informasi Suplier Anda</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url();?>scripts/masterdata/suplier.js"></script>
<script>
    $(document).ready(function () {
        <?php if ($KODESUPPLIER != ""){ ?> 
            $("#isinsert").removeAttr("checked");
        <?php } ?>
    });
    $("#generateidsuplier").on("click", function () {
        $('#kodesuplier').val("SUP" + session_kodeunikmember + Math.floor(Date.now() / 1000));
    });
</script>
<?= $this->endSection(); ?>