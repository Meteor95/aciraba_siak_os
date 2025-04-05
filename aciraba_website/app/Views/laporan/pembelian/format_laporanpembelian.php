<div class="modal fade" id="modal_pembelianperfaktur" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Pembelian Rekap Per Faktur</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0"> Laporan Pembelian Rekap Per Faktur</h2>
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
                <table id="tabel_laporan_pembelianperfaktur" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>No Faktur</th>
                            <th>Waktu Transaksi</th>
                            <th>Nama Suplier</th>
                            <th>Petugas</th>
                            <th>Jumlah Item</th>
                            <th>TOP</th>
                            <th>Diskon 1</th>
                            <th>Diskon 2</th>
                            <th>PPN</th>
                            <th>After Diskon 1</th>
                            <th>After Diskon 2</th>
                            <th>Sub Total Pembelian</th>
                            <th>Sub Total Beban</th>
                            <th>Sub Total Hutang</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align:right' colspan='4'>GRAND TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
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
<div class="modal fade" id="modal_pembelianperbarang" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Pembelian Rekap Per Barang</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0"> Laporan Pembelian Rekap Per Barang</h2>
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
                <table id="tabel_laporan_pembelianperbarang" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Informasi Barang</th>
                            <th>Jumlah Item</th>
                            <th>Diskon 1</th>
                            <th>Diskon 2</th>
                            <th>PPN</th>
                            <th>After Diskon 1</th>
                            <th>After Diskon 2</th>
                            <th>Sub Total Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align:right'>GRAND TOTAL</th>
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
<div class="modal fade" id="modal_pembelianpertanggal" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Pembelian Rekap Per Tanggal</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0"> Laporan Pembelian Rekap Per Tanggal</h2>
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
                <table id="tabel_laporan_pembelianpertanggal" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th>Jumlah Item</th>
                            <th>Diskon 1</th>
                            <th>Diskon 2</th>
                            <th>PPN</th>
                            <th>After Diskon 1</th>
                            <th>After Diskon 2</th>
                            <th>Sub Total Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align:right'>GRAND TOTAL</th>
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
<div class="modal fade" id="modal_pembeliandetail" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 5 - Laporan Pembelian Detail Per Nota</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Pembelian Detail Per-Nota</h2>
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
                <table id="tabel_laporan_pembeliandetail" class="table table-bordered table-hover nowrap">
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
                            <th></th>
                            <th></th>
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