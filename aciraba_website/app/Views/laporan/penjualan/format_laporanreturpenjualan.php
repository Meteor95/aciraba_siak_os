<div class="modal fade" id="modal_returpenjualanperfaktur" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Retur Penjualan Per Faktur</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Retur Penjualan Per Faktur</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-3">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-3">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-3">Pelanggan : <span class="pelanggan_perfaktur"></span></div>
                    <div class="col-md-3">Barang : <span class="barang_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-3">Suplier : <span class="suplier_perfaktur"></span></div>
                    <div class="col-md-3">Group Pelanggan : <span class="group_perfaktur"></span></div>
                    <div class="col-md-3">Kategori : <span class="kategori_perfaktur"></span></div>
                    <div class="col-md-3">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_returpenjualanperfaktur" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>No Faktur</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Member</th>
                            <th>Jumlah Item</th>
                            <th>PPN</th>
                            <th>Sub Total HB</th>
                            <th>Sub Total HJ</th>
                            <th>Selisih</th>
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
<div class="modal fade" id="modal_returpenjualanperfakturdetail" data-backdrop="static" data-keyboard="true" tabindex="-1">
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
                    <div class="col-md-3">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-3">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-3">Pelanggan : <span class="pelanggan_perfaktur"></span></div>
                    <div class="col-md-3">Barang : <span class="barang_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-3">Suplier : <span class="suplier_perfaktur"></span></div>
                    <div class="col-md-3">Group Pelanggan : <span class="group_perfaktur"></span></div>
                    <div class="col-md-3">Kategori : <span class="kategori_perfaktur"></span></div>
                    <div class="col-md-3">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_returpenjualanperfakturdetail" class="table table-bordered table-hover nowrap">
                    <tfoot>
                        <tr>
                            <th style='text-align:right' colspan='3'>GRAND TOTAL</th>
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