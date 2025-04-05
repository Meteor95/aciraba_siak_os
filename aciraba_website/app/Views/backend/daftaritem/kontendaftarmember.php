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
                        <a href="<?= base_url();?>masterdata/detailmember"><button id="" class="btn btn-primary"> <i class="fas fa-users"></i> Tambah Data Member</button></a>
                        </h3>
                        <button id="prosesmember" class="btn btn-success float-right"> <i class="fas fa-cog"></i> Proses Cek</button>
                    </div>
                    <div class="portlet-body"><div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="kodemember">Member ID</label>
                            <input type="text" class="form-control" id="kodemember" placeholder="Masukan MEMBER CARD ID">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="membergroup">Member Group</label>
                                <select class="form-control" id="membergroup"></select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="filterberdasarkantanggal">
                                <label class="custom-control-label" for="filterberdasarkantanggal">Akhir Masa Aktif</label>
                            </div>
                            <div class="input-group input-daterange">
                                <input id="filterawalkartustok" type="text" class="form-control" placeholder="Dari Tanggal">
                                <div class="input-group-prepend input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </span>
                                </div>
                                <input id="filteraakhirkartustok" type="text" class="form-control" placeholder="Sampai Tanggal">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="statusbarang">Status Member</label><br>
                            <div id="statusbarang" class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-flat-success active">
                                    <input type="radio" name="rb_statusmember" value="1" id="rb_memberaktif" checked="checked">Aktif </label>
                                <label class="btn btn-flat-danger">
                                    <input type="radio" name="rb_statusmember" value="0" id="rb_membertidakaktif"> Tidak Aktif</label>
                            </div>
                        </div>
                        </div>
                        <p align="justify">Berikut adalah daftar member yang terdaftar pada sistem anda. Anda dapat melakukan CRM kepada mereka dengan cara memberikan promo, informasi item terbaru melalui informasi yang tersedia. Semua aktifitas member anda dapat dikelola di menu ini. Member yang telah terdaftar tidak bisa terhapus, namun dapat dinonaktifkan</p>
                        <hr>
                        <!-- BEGIN Datatable -->
                        <table id="tabelmember" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Group</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>E-Mail</th>
                                    <th>Min. Trx/Poin</th>
                                    <th>Limit Piutang</th>
                                    <th>Masa Aktif</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
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
<script src="<?= base_url();?>scripts/masterdata/member.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#membergroup').select2({
            allowClear: true,
            placeholder: 'Berdasarkan Member Group',
            ajax: {
                url: baseurljavascript + 'masterdata/jsonmembergroup',
                method: 'POST',
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return {
                        KATAKUNCIPENCARIAN: (typeof params.term === "undefined" ? "" : params.term),
                        DIMANA10: session_kodeunikmember,
                        DATAKE: 0,
                        LIMIT: 500,
                    }
                },
                processResults: function (data) {
                    parseJSON = JSON.parse(data);
                    return {
                        results: $.map(parseJSON, function (item) {
                            return {
                                text: "GROUP : " + item.group,
                                id: item.group,
                            }
                        })
                    }
                }
            },
        });
        $(".input-daterange").datepicker({ todayHighlight: true,format: 'dd-mm-yyyy',orientation: "bottom left", });
    });
</script>
<?= $this->endSection(); ?>