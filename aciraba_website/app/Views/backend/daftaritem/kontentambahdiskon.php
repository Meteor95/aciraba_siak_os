<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">Informasi Barang Yang Akan Disikon</h3>
                    </div>
                    <div class="portlet-body">
                        <div id="textkodebarangdiskon"></div>
                        <div id="textnamabarangdiskon"></div>
                        <div id="texthargajualumumdiskon"></div>
                        <p align="justify"><b> NB : </b>Untuk besaran diskon akan otomatis dikonversi dengan kondisi jika nominal dibawah sama dengan 99 sampai 1 maka diskon akan dirumuskan kedalam diskon prosentase</p>
                        <hr>
                        <!-- BEGIN Form Group -->
                        <div class="form-group mb-0">
                            <button data-toggle="modal" data-target="#modal6" class="btn-block btn btn-primary">Pilih Barang</button>
                        </div>
                        <!-- END Form Group -->
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="portlet">
                            <div class="portlet-header portlet-header-bordered">
                                <h3 class="portlet-title">Informasi Diskon Untuk Tingkat 1</h3>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Form Group -->
                                <div class="form-group">
                                    <label for="minimalbeliumum">Minimal Beli [QTY]</label>
                                    <input type="text" class="form-control" id="minimalbeliumum"
                                        placeholder="Min. Transkasi QTY">
                                </div>
                                <!-- END Form Group -->
                                <!-- BEGIN Form Group -->
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="diskonumum1dapat">Diskon Umum</label>
                                            <input type="text" class="form-control" id="diskonumum1dapat"
                                                placeholder="Tentukan diskon untuk UMUM">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="diskonmember1dapat">Diskon Member</label>
                                            <input type="text" class="form-control" id="diskonmember1dapat"
                                                placeholder="Tentukan diskon untuk MEMBER">
                                        </div>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="portlet">
                            <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title">Informasi Diskon Untuk Tingkat 2</h3>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Form Group -->
                                <div class="form-group">
                                    <label for="minimalbelimember">Minimal Beli [QTY]</label>
                                    <input type="text" class="form-control" id="minimalbelimember"
                                        placeholder="Tentukan diskon untuk UMUM">
                                </div>
                                <!-- END Form Group -->
                                <!-- BEGIN Form Group -->
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="diskonumum2dapat">Diskon Umum</label>
                                            <input type="text" class="form-control" id="diskonumum2dapat"
                                            placeholder="Tentukan diskon untuk UMUM">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="diskonmember2dapat">Diskon Member</label>
                                            <input type="text" class="form-control" id="diskonmember2dapat"
                                            placeholder="Tentukan diskon untuk MEMBER">
                                        </div>
                                    </div>
                                </div>
                                <!-- END Form Group -->
                            </div>
                        </div>
                        <button id="simpandiskonbertingkat" class="btn-block btn btn-success">Simpan Diskon Barang</button>
                    </div>
                </div>
                <div class="header-wrap header-wrap-block">
                    <h3 class="title">DISKON ITEM YANG TELAH DITAMBAHKAN</h3>
                </div>
                <hr>
                <!-- BEGIN Datatable -->
                <table class="tabeldiskonbarang table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Min. Nominal Tingat 1</th>
                            <th>Diskon Umum</th>
                            <th>Diskon Member</th>
                            <th>Min. Nominal Tingkat 2</th>
                            <th>Diskon Umum</th>
                            <th>Diskon Member</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Aksi</th>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Min. Nominal Tingat 1</th>
                            <th>Diskon Umum</th>
                            <th>Diskon Member</th>
                            <th>Min. Nominal Tingkat 2</th>
                            <th>Diskon Umum</th>
                            <th>Diskon Member</th>
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
<script src="<?= base_url();?>scripts/masterdata/diskonbelanja.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#textkodebarangdiskon").html("Kode Item : ");
        $("#textnamabarangdiskon").html("Nama Barang : ");
        $("#texthargajualumumdiskon").html("Harga Jual Barang : ");
        $(".input-daterange").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
        });
        $("#minimalbeliumum, #diskonumum1dapat, #diskonmember1dapat, #minimalbelimember, #diskonumum2dapat, #diskonmember2dapat").inputmask({
            alias: 'decimal',
            rightAlign: true,
            autoGroup: true
        });
    });
</script>
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->endSection(); ?>