<div class="modal fade" id="modal_master_informasimember" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Informasi Daftar Member</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Informasi Daftar Member</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-4">Nama Member : <span class="member_masteritem"></span></div>
                    <div class="col-md-4">Periode Aktivitas : <span class="periode_aktivias"></span></div>
                    <div class="col-md-4">Lokasi Outlet : <span class="lokasi_outlet"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_master_informasimember" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th style="vertical-align:middle;text-align:center;">Member ID</th>
                            <th style="vertical-align:middle;text-align:center;">Nama Member</th>
                            <th style="vertical-align:middle;text-align:center;">Informasi Alamat</th>
                            <th style="vertical-align:middle;text-align:center;">Informasi Kontak</th>
                            <th style="vertical-align:middle;text-align:center;">Status Member</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
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
<div class="modal fade" id="modal_master_aktiviasmemebr" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 2 - Aktivitas Ringkasan Pembelian</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Aktivitas Ringkasan Pembelian</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-4">Nama Member : <span class="member_masteritem"></span></div>
                    <div class="col-md-4">Periode Aktivitas : <span class="periode_aktivias"></span></div>
                    <div class="col-md-4">Lokasi Outlet : <span class="lokasi_outlet"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_master_aktiviasmemebr" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th rowspan=2 style="vertical-align:middle;text-align:center;">Kode Member</th>
                            <th rowspan=2 style="vertical-align:middle;text-align:center;">Nama Member</th>
                            <th rowspan=2 style="vertical-align:middle;text-align:center;">Total Penjualan</th>
                            <th colspan=4 style="text-align:center;">Metode Pembayaran</th>
                        </tr>
                        <tr>
                            <th>Tunai</th>
                            <th>Kredit</th>
                            <th>Kartu</th>
                            <th>Split Cash</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
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