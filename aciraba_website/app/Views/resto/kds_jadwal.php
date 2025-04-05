<?= $this->extend('resto/kds'); ?>
<?= $this->section('kontenutama'); ?>
<style>
.fc-event-time {
    color: 'red';
    font-size: 2em;
    cursor: pointer;
}
</style>
<div class="content" style="background-image: url('https://static.vecteezy.com/system/resources/previews/003/127/955/original/abstract-white-and-grey-background-with-dynamic-waves-shape-free-vector.jpg');background-repeat: no-repeat;background-attachment: fixed;background-position: center; ;">
    <div class="container">  
    <?php if (session('kodeunikmember') == ""){ ?>
        <button  class="btn btn-block btn-success btn-lg"><i class="fas fa-users"></i> Login Sebagai Dapur</button>
    <?php }else{ ?>
        <div class="portlet">
            <div class="portlet-body">
                <div id="kalendarpemesan"></div>
            </div>
        </div>
    <?php } ?>
    </div>
</div>
<div class="modal fade" id="modaldetailcalendar" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Informasi <span id="penjelasan"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row portlet-row-fill-md h-100">
                    <div class="col-md-6 col-xl-12">
                        <!-- BEGIN Portlet -->
                        <div class="portlet portlet-primary">
                            <div class="portlet-header">
                                <div class="portlet-icon">
                                    <i class="fa fa-chalkboard"></i>
                                </div>
                                <h3 class="portlet-title">Daftar Pesanan <span id="namapemesan"></span></h3>
                            </div>
                            <div id="kodeai" style="display:none"></div>
                            <div id="detailitemfullcalendar"></div>
                            <div class="portlet-footer text-right">
                                <button id="cetakpesanan" class="btn btn-label-light">Cetak Pesanan Ini</button>
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.11/index.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function () {
    calendar.render();
});
var calendarEl = document.getElementById('kalendarpemesan');
var calendar = new FullCalendar.Calendar(calendarEl, {
initialView: 'dayGridWeek',
headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridWeek,timeGridDay'
},
buttonText:{
    today:'Hari Ini',
    month:'Bulan',
    week:'Minggu',
    day:'Hari',
    list:'Daftar'
},
events: (dates, callback) => {
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'resto/ajaxfullcalendarevent',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                TANGGALAWAL : moment(dates.startStr).format('YYYY-MM-DD'),
                TANGGALAKHIR : moment(dates.endStr).format('YYYY-MM-DD'),
            },
            success: function(response) {
                if (response.success == "true"){
                    let events = [];
                    for (let i = 0; i < response.totaldata; i++) {
                        events.push({
                            title: response.dataquery[i].PEMESAN+" ["+response.dataquery[i].KODEMENUPESANAN+"]",
                            start: moment(response.dataquery[i].TANGGAL).format('YYYY-MM-DD')+" "+response.dataquery[i].WAKTU,
                            end: moment(response.dataquery[i].TANGGALAKHIR).format('YYYY-MM-DD')+" "+response.dataquery[i].WAKTUAKHIR,
                            description: response.dataquery[i].PEMESAN,
                            color: "#"+response.dataquery[i].WARNAMEMO,
                            id: response.dataquery[i].KODEPESAN,
                        });
                    }
                    callback(events);
                }else{
                    Swal.fire({
                        title: "Tidak Ada Event",
                        text: "Jangan sedih ya. Tidak ada event yang ditemukan. Ayoo semangat",
                        icon: 'error',
                    });
                }
            },
            eventRender: function(info){
                info.el.innerHTML += info.event.extendedProps.description;
            },
        });
    });
},
eventClick: function(info) {
    detailevent(info)
}
});
</script>
<?= $this->endSection(); ?>