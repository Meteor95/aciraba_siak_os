<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div class="dropdown-col border-left">
                            <!-- BEGIN Select -->
                            <select id="jenistransaksi" class="selectpicker" data-live-search="true">
                                <optgroup label="Transaksi Barang">
                                    <option data-icon="fa-cloud-meatball">Semua Status Transaksi</option>
                                    <option data-icon="fa-people-arrows">Menunggu Transfer</option>
                                    <option data-icon="fa-box-open">Proses Pengemasan</option>
                                    <option data-icon="fa-truck-moving">Dalam Perjalanan</option>
                                    <option data-icon="fa-people-carry">Barang Diterima</option>
                                    <option data-icon="fa-shopping-basket">Transaksi Berhasil</option>
                                </optgroup>
                                <optgroup label="Transaksi Makanan">
                                    <option data-icon="fa-chalkboard-teacher">Menunggu Antrian</option>
                                    <option data-icon="fa-mitten">Proses Mengelola Hidangan</option>
                                    <option data-icon="fa-utensils">Siap Saji</option>
                                </optgroup>
                            </select>
                            <!-- END Select -->
                        </div>
                        <button id="" class="btn btn-success float-right"> <i class="fas fa-map-marked-alt"></i> Cek Lokasi</button>
                        <a href="<?= base_url() ;?>penjualan/daftarpesananmodedapur"><button id="" class="btn btn-success float-right ml-1"> <i class="fas fa-receipt"></i> Mode Dapur</button></a>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-3 mb-1 col-sm-12">
                                <!-- BEGIN Select -->
                                <label for="parameterpencarian">Parameter Pencarian</label>
                                <select id="parameterpencarian" class="selectpicker" data-live-search="true">
                                    <option> No Transaksi</option>
                                    <option> Nama Member</option>
                                    <option> Nama Barang</option>
                                    <option> Tipe Transaksi</option>
                                </select>
                                <!-- END Select -->
                            </div>
                            <div class="col-md-4 mb-1 col-sm-12">
                                <label for="katakuncipencarian">Kata Kunci</label>
                                <input id="katakuncipencarian" type="text" class="form-control"
                                    placeholder="Masukan kata kunci yang anda inginkan">
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Tentukan Tanggal Transaksi</label>
                                <div class="input-group input-daterange">
                                    <input id="tglawaltrx" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="tglakhirtrx" type="text" class="form-control" placeholder="Sampai Tanggal">
                                    <div style="cursor:pointer;" id="pencarian" class="input-group-prepend input-group-append">
                                        <span class="input-group-text btn-warning btn">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabelpesanan" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Waktu Trx</th>
                                    <th>No Trx</th>
                                    <th>Kode Member</th>
                                    <th>Nama Member</th>
                                    <th>Total Trx</th>
                                    <th>Stok Keluar</th>
                                    <th>Tipe Trx</th>
                                    <th>Jenis Trx</th>
                                    <th>Status Trx</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Waktu Trx</th>
                                    <th>No Trx</th>
                                    <th>Kode Member</th>
                                    <th>Nama Member</th>
                                    <th>Total Trx</th>
                                    <th>Stok Keluar</th>
                                    <th>Tipe Trx</th>
                                    <th>Jenis Trx</th>
                                    <th>Status Trx</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="<?= base_url();?>scripts/penjualan/pesanan.js"></script>
<script type="text/javascript">
    let firstDay = moment().startOf('month').format('DD-MM-YYYY');
    let lastDay = moment().endOf('month').format('DD-MM-YYYY');
    $('#tglawaltrx').val(firstDay);
    $('#tglakhirtrx').val(lastDay);
    $(document).ready(function () {
        $(".input-daterange").datepicker({
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            orientation: "bottom left",
        });
        $("#tabelpesanan").DataTable({
            language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copyHtml5',
                    text: '<i class="far fa-copy"></i> Copy',
                    titleAttr: 'Copy'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="far fa-file-excel"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="far fa-file-pdf"></i> PDF',
                    titleAttr: 'PDF'
                }
            ],
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true,
            bFilter: false,
            ajax: {
                "url": baseurljavascript + 'penjualan/jsondaftarpesanan',
                "method": 'POST',
                "data": function (d) {
                    d.KONDISI = "1",
                    d.DIMANA1 = $('#jenistransaksi').val();
                    d.DIMANA2 = $('#parameterpencarian').val();
                    d.DIMANA3 = $('#katakuncipencarian').val() == null ? "" : $('#katakuncipencarian').val();
                    d.DIMANA4 = $('#tglawaltrx').val();
                    d.DIMANA5 = $('#tglakhirtrx').val();
                    d.DIMANA19 = session_outlet;
                    d.DIMANA20 = session_kodeunikmember;
                    d.DATAKE = 0;
                    d.LIMIT = 500;
                },
            }
        });
        /*socket.emit('notifikasi_dapur', {
            outlet:session_outlet,
            kodeunikmember:session_kodeunikmember,
            title: "HALLO REALTIME "+Math.random(),
        });*/
    });
</script>
<?= $this->endSection(); ?>