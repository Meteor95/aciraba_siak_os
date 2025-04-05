<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <a class="mr-2" href="<?= base_url() ;?>acipay/transkasiacipaybackend"><button id="" class="btn btn-primary"> <i class="fas fa-id-badge"></i> Transkasi Baru</button></a>
                        <a class="mr-2" href="<?= base_url() ;?>acipay/tambahprodukacipay"><button id="" class="btn btn-primary"> <i class="fas fa-file-invoice"></i> Transaksi History</button></a>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-6 mb-1 col-sm-12">
                                <label for="katakunciproduk">Kata Kunci Nama Produk</label>
                                <input type="text" class="form-control" id="katakunciproduk" placeholder="Masukan nama produk yang anda inginkan">
                            </div>
                            <div class="col-md-1 mb-1 col-sm-12">
                                <label for="stokproduk">Stok</label>
                                <input type="text" class="form-control" id="stokproduk" placeholder="[<=]">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="jenisproduk">Jenis Produk</label>
                                <select id="jenisproduk" class="selectpicker">
                                    <option value="">Semua Jenis</option>
                                    <option value="prepaid">Prabayar</option>
                                    <option value="pasca">Pascabayar</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-1 col-sm-12">
                                <label for="statusbarang">Status Produk Ditampilkan</label><br>
                                <div id="statusbarang" class="btn-block btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-flat-success active">
                                        <input type="radio" name="rb_statusbarang" value="1" id="rb_barangaktif" checked="checked">
                                        Produk Aktif </label>
                                    <label class="btn btn-flat-danger">
                                        <input type="radio" name="rb_statusbarang" value="0" id="rb_barangtidakaktif"> Produk
                                        Gangguan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="kuncikategori">Filter Berdasarkan Kategori</label>
                                <select class="form-control" id="kuncikategori"></select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="kuncioperator">Filter Berdasarkan Operator</label>
                                <select class="form-control" id="kuncioperator"></select>
                            </div>
                            <div class="col-md-2 mb-3 mt-2">
                                <br>
                                <button id="prosescaricmb" class="btn btn-block btn-primary"> <i class="fas fa-search"></i> Proses Data</button>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="daftarprodukacipay" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Produk ID</th>
                                    <th>Server Produk ID</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Server</th>
                                    <th>Harga Umum</th>
                                    <th>Harga Agen</th>
                                    <th>Harga Spesial</th>
                                    <th>Status Trx</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Produk ID</th>
                                    <th>Server Produk ID</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Server</th>
                                    <th>Harga Umum</th>
                                    <th>Harga Agen</th>
                                    <th>Harga Mega Agen</th>
                                    <th>Status Trx</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/acipay/daftarproduknonppob.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#kuncikategori').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Tentukan kategori produk',
            ajax: {
                url: baseurljavascript + 'acipay/ajaxdaftarkategoriacipayselect2',
                method: 'POST',
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return {
                        KATAKUNCI: (typeof params.term === "undefined" ? "" : params.term),
                    }
                },
                processResults: function (data) {
                    parseJSON = JSON.parse(data);
                    return {
                        results: $.map(parseJSON, function (item) {
                            return {
                                text: "[" + item.idkategori + "] " + item.namakategori,
                                id: item.idkategori,
                            }
                        })
                    }
                }
            },
        });
        $('#kuncioperator').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: 'Tentukan operator produk',
            ajax: {
                url: baseurljavascript + 'acipay/ajaxdaftaroperatoracipayselect2',
                method: 'POST',
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return {
                        KATAKUNCI: (typeof params.term === "undefined" ? "" : params.term),
                    }
                },
                processResults: function (data) {
                    parseJSON = JSON.parse(data);
                    return {
                        results: $.map(parseJSON, function (item) {
                            return {
                                text: "[" + item.idkategori + "] " + item.namakategori,
                                id: item.idkategori,
                            }
                        })
                    }
                }
            },
        });
    });
</script>
<?= $this->endSection(); ?>