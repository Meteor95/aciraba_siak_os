<div class="modal fade" id="modal_piutangberedar" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Piutang Beredar</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0"> Laporan Daftar Piutang Beredar</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-4">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-4">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-4">Pelanggan : <span class="pelanggan_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-6">Group Pelanggan : <span class="group_perfaktur"></span></div>
                    <div class="col-md-6">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row mb-3">
                            <label for="laporan_penjualan_kategori" class="col-sm-2 col-form-label">Status Piutang</label>
                            <div class="col-sm-10">
                                <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                    <label onclick="filterreport('piutangberedar','0')" style="cursor:pointer"  id="btn-status-item-1" class="btn-status-item btn btn-flat-success active">
                                        <input value="0" type="radio" name="rb_statuspiutang" id="radio-button-1">Semua</label>
                                    <label onclick="filterreport('piutangberedar','1')" style="cursor:pointer"  id="btn-status-item-0" class="btn-status-item btn btn-flat-danger">
                                        <input value="1" type="radio" name="rb_statuspiutang" id="radio-button-2" >Melebihi Tempo </label>
                                    <label onclick="filterreport('piutangberedar','2')" style="cursor:pointer"  id="btn-status-item-2" class="btn-status-item btn btn-flat-warning">
                                        <input value="2" type="radio" name="rb_statuspiutang" id="radio-button-3" >Akan Jatuh Tempo </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <table id="tabel_laporan_piutangberedar" class="table table-bordered table-striped table-hover nowrap">
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
<div class="modal fade" id="modal_pembayaranpiutang" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 2 - Laporan Pembayaran Piutang</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Pembayaran Piutang</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-4">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-4">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-4">Pelanggan : <span class="pelanggan_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-6">Group Pelanggan : <span class="group_perfaktur"></span></div>
                    <div class="col-md-6">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_pembayaranpiutang" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>No Transaksi</th>
                            <th>No Transkasi Keluar</th>
                            <th>Petugas</th>
                            <th>Nama Member</th>
                            <th>Keterangan</th>
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
<div class="modal fade" id="modal_piutangmember" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 3 - Saldo Piutang Di Member</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Saldo Piutang Ke Member</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-4">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-4">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-4">Pelanggan : <span class="pelanggan_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-6">Group Pelanggan : <span class="group_perfaktur"></span></div>
                    <div class="col-md-6">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_piutangmember" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Kode Member</th>
                            <th>Nama Member</th>
                            <th>Alamat</th>
                            <th>Nomor Telp</th>
                            <th>Total Piutang</th>
                            <th>Total Terbayarkan</th>
                            <th>Sisa Piutang</th>
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
<div class="modal fade" id="modal_bukubantupiutang" data-backdrop="static" data-keyboard="true" tabindex="-1">
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
                    <div class="col-md-4">Tanggal : <span class="tanggal_perfaktur"></span></div>
                    <div class="col-md-4">Cara Bayar : <span class="carabayar_perfaktur"></span></div>
                    <div class="col-md-4">Pelanggan : <span class="pelanggan_perfaktur"></span></div>
                </div>
                <div class="row">
                    <div class="col-md-6">Group Pelanggan : <span class="group_perfaktur"></span></div>
                    <div class="col-md-6">Kode Outlet : <span class="outletterpilih_perfaktur"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_bukubantupiutang" class="table table-bordered table-striped table-hover nowrap">

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