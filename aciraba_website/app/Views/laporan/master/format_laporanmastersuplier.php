<div class="modal fade" id="modal_master_informasisuplier" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 1 - Laporan Informasi Daftar Suplier</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Informasi Daftar Suplier</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-6">Suplier : <span class="suplier_masteritem"></span></div>
                    <div class="col-md-6">Periode Aktivitas : <span class="periode_aktivias"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_master_informasisuplier" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th style="vertical-align:middle;text-align:center;">Kode Suplier</th>
                            <th style="vertical-align:middle;text-align:center;">Nama Suplier</th>
                            <th style="vertical-align:middle;text-align:center;">Alamat</th>
                            <th style="vertical-align:middle;text-align:center;">Informasi Kontak</th>
                            <th style="vertical-align:middle;text-align:center;">Bank / No Rek</th>
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
<div class="modal fade" id="modal_master_aktiviassuplier" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 2 - Laporan Aktivias Suplier Kirim</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Aktivias Suplier Kirim</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-6">Suplier : <span class="pricipal_masteritem"></span></div>
                    <div class="col-md-6">Periode Aktivitas : <span class="suplier_masteritem"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_master_aktiviassuplier" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Kode Suplier</th>
                            <th>Nama Suplier</th>
                            <th>Tanggal Trx</th>
                            <th>Nota Pembelian</th>
                            <th>TOP</th>
                            <th>Total Pembelian</th>
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
<div class="modal fade" id="modal_master_logsuplier" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-xl full_modal-dialog">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Format 3 - Laporan Format Log Suplier</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center text-primary font-weight-bolder mb-0">Laporan Format Log Suplier</h2>
                Parameter :
                <div class="row">
                    <div class="col-md-6">Suplier : <span class="pricipal_masteritem"></span></div>
                    <div class="col-md-6">Periode Aktivitas : <span class="suplier_masteritem"></span></div>
                </div>
                <hr>
                <table id="tabel_laporan_master_logsuplier" class="table table-bordered table-striped table-hover nowrap">
                    <thead>
                        <tr>
                            <th>Kode Suplier</th>
                            <th>Nama Suplier</th>
                            <th>No Transaksi</th>
                            <th>Tanggal Akses</th>
                            <th>Proses</th>
                            <th>Keterangan Proses</th>
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