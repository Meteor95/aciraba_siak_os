<div class="modal fade" id="modal_hutangberedar" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Hutang Beredar</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0"> Laporan Daftar Hutang Beredar</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-3">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-3">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-3">Suplier : <span class="suplier_perfaktur"></span></div>
                    <div class="col-md-3">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row mb-3">
                            <label for="laporan_penjualan_kategori" class="col-sm-2 col-form-label">Status Hutang</label>
                            <div class="col-sm-10">
                                <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                    <label onclick="filterreport('hutangberedar','0')" style="cursor:pointer"  id="btn-status-item-1" class="btn-status-item btn btn-flat-success active">
                                        <input value="0" type="radio" name="rb_statushutang" id="radio-button-1">Semua</label>
                                    <label onclick="filterreport('hutangberedar','1')" style="cursor:pointer"  id="btn-status-item-0" class="btn-status-item btn btn-flat-danger">
                                        <input value="1" type="radio" name="rb_statushutang" id="radio-button-2" >Melebihi Tempo </label>
                                    <label onclick="filterreport('hutangberedar','2')" style="cursor:pointer"  id="btn-status-item-2" class="btn-status-item btn btn-flat-warning">
                                        <input value="2" type="radio" name="rb_statushutang" id="radio-button-3" >Akan Jatuh Tempo </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <table id="tabel_laporan_hutangberedar" class="table table-bordered table-striped table-hover nowrap">
                    <tfoot>
                        <tr>
                            <th style='text-align:right' colspan=4>GRAND TOTAL</th>
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
<div class="modal fade" id="modal_pembayaranhutang" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 2 - Laporan Pembayaran Hutang</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Pembayaran Hutang</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-3">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-3">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-3">Suplier : <span class="suplier_perfaktur"></span></div>
                    <div class="col-md-3">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_pembayaranhutang" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>No Transaksi</th>
                            <th>No Transkasi Pembelian</th>
                            <th>Petugas</th>
                            <th>Nama Suplier</th>
                            <th>Potong Hutang Retur</th>
                            <th>Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align:right' colspan=6>GRAND TOTAL</th>
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
<div class="modal fade" id="modal_hutangpersuplier" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 3 - Saldo Hutang Ke Suplier</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Saldo Hutang Ke Suplier</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-3">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-3">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-3">Suplier : <span class="suplier_perfaktur"></span></div>
                    <div class="col-md-3">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_hutangpersuplier" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Kode Suplier</th>
                            <th>Nama Suplier</th>
                            <th>Alamat</th>
                            <th>Nomor Telp</th>
                            <th>Total Kredit</th>
                            <th>Total Terbayarkan</th>
                            <th>Sisa Hutang</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style='text-align:right' colspan=4>GRAND TOTAL</th>
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
<div class="modal fade" id="modal_bukubantuhutang" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 4 - Laporan Buku Bantu Hutang</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0"> Laporan Buku Bantu Hutang</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-3">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-3">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-3">Suplier : <span class="suplier_perfaktur"></span></div>
                    <div class="col-md-3">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_bukubantuhutang" class="table table-bordered table-striped table-hover nowrap">

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