<div class="modal fade" id="modal_penjualanperfaktur" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Penjualan Per Faktur</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Penjualan Per-Faktur</h2>
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
                <table id="tabel_laporan_penjualanperfaktur" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>No Faktur</th>
                            <th>Waktu Transaksi</th>
                            <th>Nama Member</th>
                            <th>Jumlah Item</th>
                            <th>Subtotal</th>
                            <th>Pajak Resto</th>
                            <th>PPN</th>
                            <th>Potongan Global</th>
                            <th>Jumlah</th>
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
<div class="modal fade" id="modal_penjualanperbarang" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 2 - Laporan Penjualan Per Barang</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Penjualan Per-Barang</h2>
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
                <table id="tabel_laporan_penjualanperbarang" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Kategori</th>
                            <th>Total Keluar</th>
                            <th>Total Jual</th>
                            <th>Total Beli</th>
                            <th>Total Laba</th>
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
<div class="modal fade" id="modal_penjualanperpelanggan" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 3 - Laporan Penjualan Per Pelanggan</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Penjualan Per-Pelanggan</h2>
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
                <table id="tabel_laporan_penjualanperpelanggan" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Kode Item</th>
                            <th>Nama Item</th>
                            <th>Alamat</th>
                            <th>Tunai</th>
                            <th>Uang Muka</th>
                            <th>Kredit</th>
                            <th>Kartu Debit</th>
                            <th>Kartu Kredit</th>
                            <th>E-Money</th>
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
                            <th></th>
                        </tr>
                        <tr>
                            <th style='text-align:right' colspan='3'>TOTAL PENDAPATAN</th>
                            <th style='text-align:left' colspan='6'><span id="totalpenjualanpermember">Rp 0</span></th>
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
<div class="modal fade" id="modal_penjualanperkasir" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 4 - Laporan Penjualan Per Kasir</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Penjualan Per-Kasir</h2>
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
                <table id="tabel_laporan_penjualanperkasir" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Id Kasir</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Nama Kasir</th>
                            <th colspan="6" style="vertical-align : middle;text-align:center;">Metode Pembayaran</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Sub Total</th>
                        </tr>
                        <tr>
                            <th>Tunai/Cash</th>
                            <th>Uang Muka</th>
                            <th>Piutang/Kredit</th>
                            <th>Kartu Debit</th>
                            <th>Kartu Kredit</th>
                            <th>E-Money</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
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
<div class="modal fade" id="modal_penjualandetailnota" data-backdrop="static" data-keyboard="true" tabindex="-1">
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
                <table id="tabel_laporan_penjualandetailnota" class="table table-bordered table-hover nowrap">
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
<div class="modal fade" id="modal_penjualanperjenistransaksi" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 7 - Laporan Penjualan Per Jenis Transaksi</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Penjualan Per-Jenis Transaksi</h2>
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
                <table id="tabel_laporan_penjualanperjenistransaksi" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Jenis Pembayaran</th>
                            <th>Nominal Jenis Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align:right'>GRAND TOTAL</th>
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
<div class="modal fade" id="modal_penjualanpertanggal" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 8 - Laporan Penjualan Per Tanggal</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Penjualan Per-Tanggal</h2>
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
                <table id="tabel_laporan_penjualanpertanggal" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Tanggal</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Jumlah Item</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Pajak Resto</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">PPN</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Potongan Global</th>
                            <th colspan="6" style="vertical-align : middle;text-align:center;">Metode Pembayaran</th>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;">Sub Total</th>
                        </tr>
                        <tr>
                            <th>Tunai/Cash</th>
                            <th>Uang Muka</th>
                            <th>Piutang/Kredit</th>
                            <th>Kartu Debit</th>
                            <th>Kartu Kredit</th>
                            <th>E-Money</th>
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