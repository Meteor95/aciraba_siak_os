<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
.fc-event-time {
    color: 'red';
    font-size: 2em;
    cursor: pointer;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">
                            <button onclick="modalubahdatameja('','new','','','','','')" class="btn btn-primary"> <i class="fas fa-add"></i> Tambah Informasi Meja</button>
                            <button class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Daftar Meja</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <div class="collapse" id="collapseExample">
                            <div class="portlet mb-md-0">
                                <div class="portlet-header portlet-header-bordered">
                                    <h3 class="portlet-title">Lokasi Meja Berdasarkan Lokasi</h3>
                                    <div class="portlet-addon">
                                        <div id="daftarlantaitersedia"></div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN Tab -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="portlet1-home">
                                            <div id="kontendaftarmeja"></div>                          
                                        </div>
                                    </div>
                                    <!-- END Tab -->
                                </div>
                            </div>
                        </div>
                        <div id="kalendarpemesan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaldetailmeja" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulir Penambahan Barang Bersamaan</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <hr>
            <table id="tabel_pesanananmeja" class="table table-bordered table-striped table-hover nowrap">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Tanggal Pesan</th>
                        <th>Kode</th>
                        <th>Pemesan</th>
                        <th>No Telepon</th>
                        <th>Untuk</th>
                        <th>Total Belanja</th>
                        <th>Uang Muka</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalinformasimeja" data-backdrop="static" data-keyboard="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content full_modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Meja <span id="namamejaspan"></span> [<span id="kodemejaspan"></span>]</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <img id="photoexample" style="width:100%" class="rounded img-thumbnail img-responsive">
                <div class="form-group row mt-2">
                    <label for="urlgambar" class="col-sm-3 col-form-label">Masukan URL Gambar</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input id="urlgambar" type="text" class="form-control" placeholder="Isikan URL Gambar untuk meja ini">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kodemeja" class="col-sm-3 col-form-label">Kode Meja</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input id="kodemeja" type="text" class="form-control" placeholder="Tentukan Kode Meja">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namameja" class="col-sm-3 col-form-label">Nama Meja</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input id="namameja" type="text" class="form-control" placeholder="Tentukan Nama Meja">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keteranganmeja" class="col-sm-3 col-form-label">Keterangan Meja</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input id="keteranganmeja" type="text" class="form-control" placeholder="Isikan informasi keterangan mengenai Meja ini">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lokasilantai" class="col-sm-3 col-form-label">Lokasi Lantai</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input id="lokasilantai" type="text" class="form-control" placeholder="Ex: Lantai 1, Balkoni">
                        </div>
                        <p> Usahakan nama lantai sama agar data terkelompok secara benar</p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        Waktu Awal : <input readonly id="waktuaktif" type="text"  class="form-control" placeholder="Waktu Awal Aktif">
                    </div>
                    <div class="col">
                        Waktu Akhir : <input readonly id="waktuakhir" type="text" class="form-control" placeholder="Waktu Akhir Aktif">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="simpaninformasimeja(1)" class="btn btn-primary"><i class="fas fa-add"></i> Simpan Informasi</button>
            </div>
        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/resto/daftarmeja.js"></script>
<script type="text/javascript" src="<?= base_url() ;?>scripts/timepickerseira.js"></script>
<script>
$('#waktuaktif').clockTimePicker();
$('#waktuakhir').clockTimePicker();
$('#waktuaktif').clockTimePicker('value', moment().format('HH:mm'));
$('#waktuakhir').clockTimePicker('value', moment("23:00:00", 'HH:mm:ss').format('HH:mm'));
$(document).ready(function () {
    panggillantai();
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
function bersihkanmodalinformasimeja(){
    $("#kodemeja").val("");
    $("#namameja").val("");
    $("#urlgambar").val("");
    $("#keteranganmeja").val("");
    $("#lokasilantai").val("");
}
function panggilmeja(lantai){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'resto/ajaxpanggilmeja',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                LANTAI : lantai,
            },
            success: function (response) {
                if (response.success == "true"){
                    let htmlnya = "";
                    htmlnya = "<div class=\"row\">";
                    for (let i = 0; i < response.totaldata; i++) {
                        let nameArr = response.dataquery[i].INFORMASIPESANAN.split('::'), pesan = "KOSONG", posisi = 0;
                        if (nameArr[0] > 0) {
                            posisi = "color:red";
                            pesan = "TERPESAN";
                        }
                        htmlnya += "<div class=\"col-md-3 card\"><img style=\"object-fit: cover; height:250px\" src=\""+(response.dataquery[i].GAMBAR == "" ? "https://i.ibb.co/d6FsfBx/arti-reservasi-jenis-jenis-manfaat-leng-867483.jpg"  : response.dataquery[i].GAMBAR)+"\" class=\"card-img-top mt-2 rounded img-responsive\" alt=\""+response.dataquery[i].KODEMEJA+"\"><div class=\"card-body\"><h5 class=\"card-title\">MEJA : "+response.dataquery[i].NAMAMEJA+" ["+response.dataquery[i].KODEMEJA+"]</h5><p class=\"card-text\">Status Meja : <span style=\""+posisi+"\">"+pesan+"</span><br>Status Jam Kosong : <span style=\""+posisi+"\">"+time_convert(response.dataquery[i].TOTALJAM - nameArr[1])+"</span><br>Total Jam Pesanan : <span style=\""+posisi+"\">"+time_convert(nameArr[1])+"</span><br>Dipesan Untuk : <span style=\""+posisi+"\">"+nameArr[0]+" Orang</span><br><p class=\"card-text\">Informasi Meja : <span style=\"color:red\">"+response.dataquery[i].KETERANGAN+"</span></p></p><div class=\"btn-group btn-block\"><button onclick=\"detailpesanan('"+response.dataquery[i].KODEMEJA+"','')\" class=\"btn btn-primary\"><i class=\"fas fa-search\"></i> Lihat Detail </button><button onclick=\"modalubahdatameja('"+response.dataquery[i].NAMAMEJA+"','"+response.dataquery[i].KODEMEJA+"','"+response.dataquery[i].KETERANGAN+"','"+lantai+"','"+response.dataquery[i].JAMBUKA+"','"+response.dataquery[i].JAMTUTUP+"','"+response.dataquery[i].GAMBAR+"')\" class=\"btn btn-secondary\"><i class=\"fas fa-pencil\"></i> Ubah</button><button onclick=\"hapusinformasimeja('"+response.dataquery[i].KODEMEJA+"','"+response.dataquery[i].NAMAMEJA+"','"+lantai+"')\" class=\"btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div></div></div>";
                    }    
                    htmlnya += "</div>";
                    $('#kontendaftarmeja').html("");
                    $('#kontendaftarmeja').append(htmlnya);
                }else{
                    window.location.reload();
                }
            }
        });
    });
}
</script>
<?= $this->endSection(); ?>