<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">
                            <a href="<?= base_url();?>masterdata/tambahdiskonitem"><button id=""
                                    class="btn btn-primary"> <i class="fas fa-box-open"></i> Tambah Diskon
                                    Item</button></a>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-4 mb-0">
                                <label for="kodeitemdiskon">Kode Diskon / Kodebarang</label>
                                <input type="text" class="form-control" id="kodeitemdiskon"
                                    placeholder="Masukan kodenya untuk melihat statusnya">
                            </div>
                            <div class="col-md-8 mb-0">
                                <p align="justify">Diskon adalah potongan harga yang diberikan oleh penjual agar pembeli
                                    tertarik untuk membeli produk yang didiskon tersebut. Dalam aciraba diskon tersebut
                                    dibagi menjadi 2 diskon umum dan member, masing masin memiliki tingkatan untuk saat
                                    ini 2 tingkat dan bersifat permanen tanpa ada batas wakt, jadi anda harus menghapus
                                    jika ingin menonaktifkan diskon tersebut.</p>
                            </div>
                        </div>
                        <!-- END Form Row -->
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
                        <p align="justify"><b> NB : </b>Untuk besaran diskon akan otomatis dikonversi dengan kondisi jika nominal dibawah sama dengan 99 sampai 1 maka diskon akan dirumuskan kedalam diskon prosentase</p>
                    </div>
                </div>
            </div>
            <!-- END Portlet -->
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>scripts/masterdata/diskonbelanja.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".input-daterange").datepicker({
            todayHighlight: true,
            orientation: "bottom left",
        });
    });
</script>
<?= $this->endSection(); ?>