<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <a class="mr-2" href="<?= base_url() ;?>acipay/transkasiacipaybackend"><button id="" class="btn btn-primary"> <i class="fas fa-plus-square"></i> Tambah</button></a>
                        <button id="transaksilampau" class="btn btn-primary"> <i class="fas fa-clipboard-list"></i> Transaksi Lampau</button>
                    </div>
                    <div class="portlet-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-2 col-sm-12">
                                <label for="katakunciproduk">Kata Kunci Transaksi</label>
                                <input type="text" class="form-control" id="katakunciproduk" placeholder="Masukan kata kunci transaksi dengan parameter anda inginkan">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="jenisproduk">Parameter Pencarian</label>
                                <select id="jenisproduk" class="selectpicker">
                                    <option value="notujuan">No Tujuan / Kontrak</option>
                                    <option value="notrx">No Transaksi</option>
                                    <option value="kodeproduk">Kode Produk</option>
                                    <?= session('jenismerchant') == "OW" ? '<option value="member">Nama Member</option>' : '' ;?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2 col-sm-12">
                                <label for="statusbarang">Status Transaksi Ditampilkan</label><br>
                                <div id="statusbarang" class="btn-block btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-flat-primary active">
                                        <input type="radio" name="rb_statusbarang" value="" id="rb_trxall" checked="checked">
                                        Semua Trx </label>
                                    <label class="btn btn-flat-success">
                                        <input type="radio" name="rb_statusbarang" value="1" id="rb_trxsukses">
                                        Sukses </label>
                                    <label class="btn btn-flat-danger">
                                        <input type="radio" name="rb_statusbarang" value="2" id="rb_trxgagal"> Gagal</label>
                                    <label class="btn btn-flat-warning">
                                        <input type="radio" name="rb_statusbarang" value="0" id="rb_trxpending"> Pending</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-5 mb-2">
                                <div style="display:none" class="input-group input-daterange">
                                    <input id="daritanggal" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="sampaitanggal" type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                            <div id="divnyaprosescaricmb" class="col-md-12 mb-2">
                                <button id="prosescaricmb" class="btn btn-block btn-primary"> <i class="fas fa-search"></i> Proses Data</button>
                            </div>
                        </div>
                        <table id="daftarprodukacipay" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                    <th>Trx ID</th>
                                    <th>Tujuan [Produk]</th>
                                    <th>Nama Produk</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Pengirim</th>
                                    <th>Serial Number</th>
                                    <th>TGL Trx</th>
                                    <th>TGL Update</th>
                                    <th>statusid</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kirimulang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cek TRX REFID: <span class="idtranskasisekarang"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0" style="text-align:justify">Jangan pernah mencoba untuk melakukan Cek Status terhadap transaksi yang sudah lewat 60 HARI karena hal tersebut akan menyebabkan pembuatan transaksi BARU.</p>
                <span id="produknyaulang" style="display:none"></span>
                <span id="nomortujuanulang" style="display:none"></span>
                <span id="ketujuanulang" style="display:none"></span>
            </div>
            <div class="modal-footer">
                <button id="kirimulangtrx" class="btn btn-primary">Cek Ulang REFID <span class="idtranskasisekarang"></span></button>        
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/acipay/daftarprodukacipay.js"></script>
<script>
if (statusdata == 1){
    const socket = io(baseurlsocket);
    socket.on(session_kodeunikmember+"#"+session_outlet, (data) => {
        $('#daftarprodukacipay').DataTable().ajax.reload();
    });
}
$(document).ready(function () {
    $('#daritanggal').val(moment().format("DD-MM-YYYY"));
    $('#sampaitanggal').val(moment().format("DD-MM-YYYY"));
    $(".input-daterange").datepicker({
        todayHighlight: true,
        format:'dd-mm-yyyy',
        orientation: "bottom left",
    });
});
</script>
<?= $this->endSection(); ?>