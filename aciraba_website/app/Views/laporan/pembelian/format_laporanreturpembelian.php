<div class="modal fade" id="modal_returpembelianperfaktur" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Retur Pembelian Per Faktur</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Retur Penjualan Per Faktur</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-4">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-4">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-4">Barang : <span class="barang_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-4">Suplier : <span class="suplier_perfaktur"></span></div>
                    <div class="col-md-4">Kategori : <span class="kategori_perfaktur"></span></div>
                    <div class="col-md-4">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_returpembelianperfaktur" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>No Faktur</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Suplier</th>
                            <th>Total Item</th>
                            <th>Total Potongan</th>
                            <th>Sub Total</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align:right' colspan='3'>GRAND TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </foot>
                </table>
                <hr>
                <div class="row ml-3 mr-3">
                <div class="col"><button class="btn btn-block btn-danger justify-content-end"><i class="fa-solid fa-file-pdf"></i> Export PDF</button></div>
                <div class="col"><button class="btn btn-block btn-success"><i class="fa-solid fa-file-excel"></i> Export Excel</button></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_returpembelianperfakturdetail" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 5 - Laporan Penjualan Detail Per Nota</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Penjualan Detail Per-Nota</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-4">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-4">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-4">Barang : <span class="barang_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-4">Suplier : <span class="suplier_perfaktur"></span></div>
                    <div class="col-md-4">Kategori : <span class="kategori_perfaktur"></span></div>
                    <div class="col-md-4">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_returpembelianperfakturdetail" class="table table-bordered table-hover nowrap">
                    <tfoot>
                        <tr>
                            <th style='text-align:right' colspan='2'>GRAND TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </foot>
                </table>
                <hr>
                <div class="row ml-3 mr-3">
                <div class="col"><button class="btn btn-block btn-danger justify-content-end"><i class="fa-solid fa-file-pdf"></i> Export PDF</button></div>
                <div class="col"><button class="btn btn-block btn-success"><i class="fa-solid fa-file-excel"></i> Export Excel</button></div>
            </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>