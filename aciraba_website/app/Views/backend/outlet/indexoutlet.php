<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<!-- BEGIN Page Content -->
<div class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12"><span id="infoalert"></span></div>
        </div>
        <div class="row">
            <div class="col-12">
                <div data-toggle="modal" data-id="pecahsatuan" data-target="#formulioulet"  class="portlet widget17">
                    <div class="portlet-body">
                        <!-- BEGIN Avatar -->
                        <div class="avatar avatar-label-primary avatar-circle avatar-lg mb-3">
                            <div class="avatar-display">
                                <i class="fa fa-plus"></i>
                            </div>
                        </div>
                        <!-- END Avatar -->
                        <h5 class="text-level-3">Tambah Outlet Anda</h5>
                        <p class="text-level-1 mb-0">Tambahkan informasi outlet yang valid agar informasi yang dikelola sistem tidak rancu.</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="outletterdaftar"></div>
    </div>
</div>
<div class="modal fade" id="formulioulet">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Berikan informasi yang valid pada FORMULIR ini</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="kodeoutlet" class="col-sm-3 col-form-label">Buat KODE OUTLET</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="kodeoutlet" class="form-control" placeholder="Buat kode outlet atau ➡️➡️➡️➡️➡️">
                            <div class="input-group-prepend">
                                <span id="generatekodeoutlet" class="input-group-text btn-warning btn" style="cursor:pointer">Generate ID Outlet</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namaoutlet" class="col-sm-3 col-form-label">Nama Outlet</label>
                    <div class="col-sm-9">
                        <input type="text" id="namaoutlet" class="form-control" placeholder="Ketikkan nama outlet">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamatoutlet" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" id="alamatoutlet" class="form-control" placeholder="Alamat outlet">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="notelp" class="col-sm-3 col-form-label">No Telepon</label>
                    <div class="col-sm-9">
                        <input type="text" id="notelp" class="form-control" placeholder="Isikan jika outlet memiliki no telp">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pajakoutlet" class="col-sm-3 col-form-label">Pajak Outlet</label>
                    <div class="col-sm-9">
                        <input type="text" id="pajakoutlet" class="form-control" placeholder="Masukkan Nominal Pajak Dalam Persen">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pajaknegara" class="col-sm-3 col-form-label">Pajak Negara</label>
                    <div class="col-sm-9">
                        <input type="text" id="pajaknegara" class="form-control" placeholder="Masukkan Nominal Pajak Dalam Persen">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="latlonglokasi" class="col-sm-3 col-form-label">Titik Koordinat [Lat, Long]</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" id="latlonglokasi" class="form-control" placeholder="">
                            <div class="input-group-prepend">
                                <span onclick="konversikelatlong()" id="latlonglokasibtn" class="input-group-text btn-warning btn" style="cursor:pointer">Ubah Alamat Ke Lat Long</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="latlonglokasi" class="col-sm-3 col-form-label">Status Outlet</label>
                    <div id="statusbarang" class="btn-group btn-group-toggle ml-3" data-toggle="buttons">
                        <label id="labelaktifpusat" style="cursor:pointer"  class="btn btn-flat-success"><input type="radio" name="rb_statusoutlet" value="YA" id="rb_statusoutletya"> Outlet Pusat</label>
                        <label id="labelaktifbukanpusat" style="cursor:pointer"  class="btn btn-flat-warning active"> <input type="radio" name="rb_statusoutlet" value="TIDAK" id="rb_statusoutlettidak" checked="checked"> Outlet Cabang </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-bordered">
				<button onclick="simpanoutlet()" id="prosessimpanoutlet" class="btn btn-outline-primary">Simpan Informasi</button>
			</div>
        </div>
    </div>
</div>

<script>
var pajakoutlet = new AutoNumeric("#pajakoutlet", {decimalCharacter : ',',digitGroupSeparator : '.',})
var pajaknegara = new AutoNumeric("#pajaknegara", {decimalCharacter : ',',digitGroupSeparator : '.',})
$(document).ready(function () {
    getCsrfTokenCallback(function() {
        outletterdaftar()
    }); 
});
function simpanoutlet(){
    statusbarang = "TIDAK";
    if ($("#kodeoutlet").val() == "" || $("#namaoutlet").val() == "" || $("#alamatoutlet").val() == "" || $("#notelp").val() == ""  || $("#pajaktoko").val() == "" || $("#pajaknegara").val() == ""){
        return toastr["info"]("Semua formulir pada pendaftaran OUTLET harus diisi semua secara benar dan akurat");
    }
    var latlong = $("#latlonglokasi").val().split(",");
    if ($('input[name="rb_statusoutlet"]:checked').val() == "YA") { statusbarang = "YA"; } else { statusbarang = "TIDAK"; }
    Swal.fire({
        title: "Simpan Informasi Outlet ?",
        text: "Apakah anda ingin menyimpan informasi OUTLET "+$("#namaoutlet").val()+" ["+$("#kodeoutlet").val()+"] ? ",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Simpan Outlet!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#prosessimpanoutlet').prop("disabled",true);
            $('#prosessimpanoutlet').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url:baseurljavascript+'auth/prosesoutlet',
                    type:'POST',
                    dataType:'json',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        KODEOUTLET:$("#kodeoutlet").val(),
                        NAMAOUTLET:$("#namaoutlet").val(),
                        ALAMAT:$("#alamatoutlet").val(),
                        LAT:(latlong[0] == "" ? 0 : latlong[0]),
                        LONG:(typeof latlong[1] === "undefined" ? 0 : latlong[1]),
                        NOTELP:$("#notelp").val(),
                        APAKAHPUSAT:statusbarang,
                        PAJAKNEGARA:pajaknegara.getNumber(),
                        PAJAKTOKO:pajakoutlet.getNumber(),
                    },
                    complete:function(){
                        $('#prosessimpanoutlet').prop("disabled",false);
                        $('#prosessimpanoutlet').html('Simpan Informasi');
                    },
                    success:function(response){
                        if (response[0].success == "false"){
                            toastr["error"]("KODE : "+response[0].rc+"<br>PESAN : "+response[0].msg);
                        }else{
                            $('#formulioulet').modal('toggle');
                            Swal.fire(
                                'Iyess.. Simpan Sukses!',
                                response[0].msg,
                                'success'
                            )
                            let alerttext = "<div class=\"alert alert-outline-success mb-0\">"
                            +"<div class=\"alert-content\">"
                            +"<h4 class=\"alert-heading\">Well done!</h4>"
                            +"<p>Aww yeah, Outlet kamu sudah tertambahkan / terbarui pada sistem kami. Agara dapat melanjutkan pengelolaan OUTLET anda. Kami mohon anda melakukan RE-LOG agar sistem membaca outlet anda jika anda MENAMBAH OUTLET BARU tetapi jika anda HANYA MENGHUBAH INFORMASI OUTLET maka tidak perlu RE-LOG.</p><hr>"
                            +"<p class=\"mb-0\">Tenang saja.Anda tidak diusir kok CUMA RE-LOG saja.</p>"
                            +"</div><button type=\"button\" class=\"btn btn-text-danger btn-icon alert-dismiss\" data-dismiss=\"alert\"><i class=\"fa fa-times\"></i></button></div>"
                            $('#infoalert').html(alerttext)
                            getCsrfTokenCallback(function() {
                                outletterdaftar()
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
        }
    });
}

$("#generatekodeoutlet").on("click", function () {
    $('#kodeoutlet').val(randomstringdigit(4).toUpperCase());
});
function outletterdaftar(){
    let htmloutletterdaftar = ""
    $.ajax({
        url: baseurljavascript + 'auth/outletnoselect',
        method: "POST",
        data: {
            [csrfName]: csrfTokenGlobal,
            KATAKUNCIPENCARIAN: "",
        },
        beforeSend: function(){},
        complete:function(){},
        success: function(response) {
            response = JSON.parse(response)
            $("#outletterdaftar").html("")
            if (response.totaldataquery > 0){
                htmloutletterdaftar = "<div class=\"row\">";
                for (let i = 0; i < response.totaldataquery; i++) {
                    htmloutletterdaftar +=""
                    +"<div class=\"col-md-4\">"
                        +"<div class=\"portlet\">"
                            +"<div class=\"portlet-header\"><div class=\"portlet-icon\"><i class=\"fa fa-home\"></i></div> NAMA OUTLET : "+response.dataquery[i].NAMAOUTLET+" ["+response.dataquery[i].KODEOUTLET+"]</div>"
                            +"<div class=\"portlet-body py-4\">"
                                +"<p class=\"mb-0 ml-1\">Status Outlet PUSAT : "+response.dataquery[i].APAKAHPUSAT+"</p>"
                                +"<p class=\"mb-0 ml-1\">Alamat : "+response.dataquery[i].ALAMAT+"</p>"
                                +"<p class=\"mb-0 ml-1\">Nomor Telpon : "+response.dataquery[i].NOTELP+"</p>"
                                +"<p class=\"mb-0 ml-1\">Pajak Outlet : "+response.dataquery[i].PAJAKTOKO+"% </p>"
                                +"<p class=\"mb-0 ml-1\">Pajak Negara : "+response.dataquery[i].PAJAKNEGARA+"%</p>"
                                +"<p class=\"mb-0 ml-1\">Lat, Long : "+response.dataquery[i].LAT+","+response.dataquery[i].LAT+"</p>"
                            +"</div>"
                            +"<div class=\"portlet-footer\">"
                                +"<button onclick=\"pindahoutlet('"+response.dataquery[i].KODEOUTLET+"')\" class=\"btn btn-success mr-2\"><i class=\"fa fa-check mr-2\"></i>Pindah Oulet</button>"
                                +"<button id=\"btninformasi"+response.dataquery[i].KODEOUTLET+"\" onclick=\"detailinformasioutlet('"+response.dataquery[i].KODEOUTLET+"')\" class=\"btn btn-warning mr-2\"><i class=\"fa fa-info mr-2\"></i>Informasi</button>"
                                +"<button id=\"btnoutlet"+response.dataquery[i].KODEOUTLET+"\" onclick=\"hapusoutlet('"+response.dataquery[i].KODEOUTLET+"')\" class=\"btn btn-danger\"><i class=\"fa fa-trash mr-2\"></i>Hapus</button>"
                            +"</div>"
                        +"</div>"
                    +"</div>"
                } 
                htmloutletterdaftar += "</div>"
            }else{
                htmloutletterdaftar = '<div style="z-index:-1;background-image: url('+baseurljavascript+'images/avatar/notfound.png); background-repeat: no-repeat, repeat; background-position: center;position: absolute;top: 8%; bottom: 0; left: 20.5rem; right: 0;margin: auto;" class="d-flex flex-column align-items-center justify-content-center"><h3 style="text-align:center;"> Huft... Anda tidak meiliki data OUTLET sama sekali. Silahkan tambahkan informasi OUTLET anda</h3></div>';
            }
            $("#outletterdaftar").html(htmloutletterdaftar)
        },
        error: function(xhr, status, error) {
            return toastr["info"]("Request Failed. Error: " + status + " - " + error);
        }
    });
}
function konversikelatlong(){
    let latlongdidapat = "Gagal, coba lagi atau manual deh";
    $.ajax({
        url: "https://maps.googleapis.com/maps/api/geocode/json",
        method: "GET",
        data: {
            address: $("#alamatoutlet").val(),
            key: '<?= $_ENV['TOKENAPIGOOGLEMAPS'] ;?>',
        },
        beforeSend: function(){
            $('#latlonglokasibtn').prop("disabled",true);
            $('#latlonglokasibtn').html('<i class="fa fa-spin fa-spinner"></i> Proses Cari Lat Long');
        },
        complete:function(){
            $('#latlonglokasibtn').prop("disabled",false);
            $('#latlonglokasibtn').html('Ubah Alamat Ke Lat Long');
        },
        success: function(response) {
            if (response.length > 0) {
                latlongdidapat = response[0].lat+","+response[0].lon
            }
            $("#latlonglokasi").val(latlongdidapat);
        },
        error: function(xhr, status, error) {
            $("#latlonglokasi").val(latlongdidapat);
            return toastr["info"]("Request Failed. Error: " + status + " - " + error);
        }
    });
}
function hapusoutlet(kodeoutlet){
    Swal.fire({
		title: "Apakah anda ingin menghapus OUTLET : " + kodeoutlet,
		text: "Informasi yang berhubungan tentang OUTLET "+kodeoutlet+" tidak terhapus, karena dapat DATA masih dapat dikelolah suatu hari nanti",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Oke, Hapus!!'
	}).then((result) => {
		if (result.isConfirmed) {
			$('#btnoutlet'+kodeoutlet).prop("disabled",true);
            $('#btnoutlet'+kodeoutlet).html('<i class="fa fa-spin fa-spinner"></i> Proses Hapus');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url:baseurljavascript+'auth/hapusoutlet',
                    type:'POST',
                    dataType:'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        KODEOUTLET:kodeoutlet,
                    },
                    complete:function(){
                        $('#btnoutlet'+kodeoutlet).prop("disabled",false);
                        $('#btnoutlet'+kodeoutlet).html('<i class="fa fa-trash"></i> Hapus');
                    },
                    success:function(response){
                        Swal.fire(
                            'Outlet '+kodeoutlet+', berhasil dihapus!',
                            response.msg,
                            'success'
                        )
                        getCsrfTokenCallback(function() {
                            outletterdaftar()
                        });
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
		}
	})
}
function detailinformasioutlet(kodeoutlet){ 
    $('#btninformasi'+kodeoutlet).prop("disabled",true);
    $('#btninformasi'+kodeoutlet).html('<i class="fa fa-spin fa-spinner"></i> Baca Data');
    getCsrfTokenCallback(function() {
        $.ajax({
            url:baseurljavascript+'auth/detailinformasioutlet',
            type:'POST',
            dataType:'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KODEOUTLET:kodeoutlet,
            },
            complete:function(){
                $('#btninformasi'+kodeoutlet).prop("disabled",false);
                $('#btninformasi'+kodeoutlet).html('<i class="fa fa-info mr-2"></i> Informasi');
            },
            success:function(response){
                $("#generatekodeoutlet").hide();
                $("#kodeoutlet").attr('readonly', true);
                $("#kodeoutlet").val(response.data[0].KODEOUTLET)
                $("#namaoutlet").val(response.data[0].NAMAOUTLET)
                $("#alamatoutlet").val(response.data[0].ALAMAT)
                $("#latlonglokasi").val(response.data[0].LAT+","+response.data[0].LONG)
                $("#notelp").val(response.data[0].NOTELP)
                pajaknegara.set(response.data[0].PAJAKNEGARA)
                pajakoutlet.set(response.data[0].PAJAKTOKO)
                if (response.data[0].APAKAHPUSAT == "YA") {
                    $('#rb_statusoutletya').prop('checked', true);
                    $('#labelaktifpusat').addClass('active')
                    $('#labelaktifbukanpusat').removeClass('active')
                } else {
                    $('#rb_statusoutlettidak').prop('checked', true);
                    $('#labelaktifbukanpusat').addClass('active')
                    $('#labelaktifpusat').removeClass('active')
                }
                $('#formulioulet').modal('show');
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}
</script>
<?= $this->endSection(); ?>