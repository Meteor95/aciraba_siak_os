<?= $this->extend('backend/main_akuntansi'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <a href="<?= base_url() ;?>penjualan/tambahreturpenjualan"><button id="" class="btn btn-primary"> <i class="fas fa-truck-loading"></i> Tambah Retur</button></a>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#datatable-1").DataTable({
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true
        });
        $(".input-daterange").datepicker({
            todayHighlight: true
        });
    });
    $("#simpaninformasidasar").on("click", function () {

    });
</script>
<?= $this->endSection(); ?>