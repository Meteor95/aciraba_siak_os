<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- BEGIN Portlet -->
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">
                            <a href="<?= base_url() ;?>masterdata/daftaritemdetail"> <button id="" class="btn btn-primary"><i class="fas fa-plus-square"></i> Pindah Piutang</button></a>                            
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="portlet col-md-12">
                                    <div class="portlet-header portlet-header-bordered">
                                        <h3 class="portlet-title">Informasi Pengguna</h3>
                                        <div class="input-group">
                                            <div data-toggle="modal" data-target="#panggildaftarmember" class="input-group-prepend">
												<span class="input-group-text" style="cursor:pointer">
													<i class="fa fa-users mr-2"></i> Pilih Member
												</span>
											</div>
                                        <input type="text" class="form-control" id="pencariannamamember" placeholder="Masukan nama / kode member terkait">
											<div class="input-group-append">
												<span class="input-group-text" style="cursor:pointer">
													<i class="fa fa-search mr-2"></i> Proses Informasi
												</span>
											</div>
										</div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="portlet portlet-primary">
                                            <div class="portlet-header">
                                                <div class="portlet-icon">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                                <h3 class="portlet-title">Informasi Member</h3>
                                                <div class="portlet-addon">
                                                    Kode Member : <span id="kodememberterpilih" class="badge badge-warning badge-pill">1001</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <p class="mb-0">Nama Pelanggan : <span id="namapelanggan"></span></p>
                                                <p class="mb-0">Informasi Ponsel : <span id="nohandphone"></span></p>
                                                <p class="mb-0">Alamat Pelanggan : <span id="alamatpelanggan"></span></p>
                                                <p class="mb-0">Total Piutang : <span id="totalpiutang"></span></p>
                                                <p class="mb-0">Sisa Piutang : <span id="sisapiutang"></span></p>
                                            </div>
                                            <div class="portlet-footer">
                                                <button class="btn btn-warning">Daftar Transaksi Bayar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- BEGIN Form Row -->
                            <div id="cekpembayaran" style="display:none">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Tanggal Transaksi</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Pilih Tanggal Transaksi" id="tanggaltransaksipembayaranpiutang">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kodebarangkartustok">No Transaksi Pembayaran</label>
                                        <h5 class="mt-2"><div id="nomornotapiutang">BHGDPSTKODEKOMPUTER20230320#1</div></h5>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="sisapiutangbawah">Total Sisa Piutang</label>
                                        <h5 style="color:red;font-size:25px"><div id="sisapiutangbawah">Rp 0,00</div></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input style="font-size: 20px;" type="text" class="form-control" placeholder="Masukan Nominal Piutang" id="masukkannominal">
                                    </div>
                                </div>
                                <hr>
                                <table id="datatransaksipiutang" class="table table-bordered table-striped table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal Transaksai</th>
                                            <th>Total Belanja</th>
                                            <th>Sisa Piutang</th>
                                            <th>Nominal Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Tanggal Transaksai</th>
                                            <th>Total Belanja</th>
                                            <th>Sisa Piutang</th>
                                            <th>Nominal Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <input id="keteranganpiutang" type="text" style="font-size: 20px;" class="form-control" placeholder="Keterangan mengenai transkasi piutang">
                                <div class="row"><div class="col"><div class="float-right" style="color:red;font-size:20px"> Kembalian : <span id="kembalian">Rp 0,00</span></div></div></div>
                                    <button onclick="konfirmasibayarpiutang()" class="btn btn-block btn-success"><i class="fas fa-paper-plane"></i> Bayar Transaksi Piutang </button>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Portlet -->
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.4/api/sum().js"></script>
<script type="text/javascript">
    let masukannominal = new AutoNumeric('#masukkannominal', {decimalCharacter : ',',digitGroupSeparator : '.',});
    $(document).ready(function () {
        $('#tanggaltransaksipembayaranpiutang').val(moment().format('DD-MM-YYYY'));
        $("#tanggaltransaksipembayaranpiutang").datepicker({todayHighlight: true,format:'dd-mm-yyyy'});
        loadnotapiutang();
        getCsrfTokenCallback(function() {
            $("#datatransaksipiutang").DataTable({
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                bPaginate: false,
                bLengthChange: false,
                bInfo: false,
                scrollCollapse: true,
                scrollY: "50vh",
                scrollX: true,
                bFilter: false,
                columnDefs: [
                    {className: "text-right",targets: [2,3]},
                ],
                ajax: {
                    "url": baseurljavascript + 'penjualan/daftarpiutangterpilih',
                    "method": 'POST',
                    "data": function (d) {
                        d.csrf_aciraba = csrfTokenGlobal;
                        d.KATAKUNCI = $('#kodememberterpilih').html();
                    },
                },
            });
        });
    });
function loadnotapiutang(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/notamenupenjualan',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                AWALANOTA : "BP",
                OUTLET: session_outlet,
                KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                TANGGALSEKARANG: moment().format('YYYYMMDD'),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                $('#nomornotapiutang').html(response.nomornota);
            }
        });
    });
}   
$('#masukkannominal').on('keyup input propertychange paste', debounce(function (e) {
    getCsrfTokenCallback(function() {
        proseshitungtabelpiutang();
    });
}, 500));
function proseshitungtabelpiutang(){
    let table = $('#datatransaksipiutang').DataTable();let numRows = table.rows().count();let sisakredit = 0;
    const nominalinput = Number(masukannominal.getNumber());
    let sisa=0;
    for(a=0;a<numRows;a++){
        let an = new AutoNumeric('#pembayaran'+a, {decimalCharacter : ',',digitGroupSeparator : '.',});
        sisakredit = $("#sisakredit"+a).html().replace('Rp', '').replaceAll('.', '').replace(',', '.').trim();
        if (a == 0){ sisa = nominalinput - sisakredit; }
        if (sisa > 0 && a==0){
            an.set(sisakredit);
        }else if (sisa < 0 && a==0){
            an.set(nominalinput);
        }else if (sisa < 0 && a>0){
            an.set(0);
        }else if (sisa < sisakredit){
            an.set(sisa);
        }else if (sisa > sisakredit && a > 0){
            an.set(sisakredit);
        }else{
            an.set(0);
        }
    }
    if (Number($("#sisapiutangbawah").html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()) > masukannominal){
        $("#kembalian").html(formatuang(0,'id-ID','IDR'))
    }else{
        $("#kembalian").html(formatuang(nominalinput - Number($("#sisapiutangbawah").html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),'id-ID','IDR'))
        
    }
}
function changeIt(bariske,hapus) {
    var key = event.which || event.keyCode;
    if (key == '13') {
        hitungpernota(bariske,hapus)
    }
}
function hitungpernota(bariske,hapus){
    let table = $('#datatransaksipiutang').DataTable();let numRows = table.rows().count();let nominalbayar = 0;
    let an = new AutoNumeric('#pembayaran'+bariske, {decimalCharacter : ',',digitGroupSeparator : '.',});
    if (hapus == "1"){
        an.set(0)
    }else if (hapus == '0'){
        sisakredit = $("#sisakredit"+bariske).html().replace('Rp', '').replaceAll('.', '').replace(',', '.').trim();
        an.set(sisakredit);
    }
    let nodes = table.column(4).nodes();
    let total = table.column(4).nodes().reduce(function(sum,node) {
        return sum + parseFloat($(node).find('input').val().replaceAll('.', '').replace(',', '.').trim());
    }, 0 );
    masukannominal.set(total);
    if (Number($("#sisapiutangbawah").html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()) > masukannominal){
        $("#kembalian").html(formatuang(0,'id-ID','IDR'))
    }else{
        $("#kembalian").html(formatuang(masukannominal.getNumber() - Number($("#sisapiutangbawah").html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),'id-ID','IDR'))
    }
}
$('#datatransaksipiutang tbody').on('keydown', 'tr', function (e) {
    let table = $('#datatransaksipiutang').DataTable();
    if (e.which === 13) {
        var idx = table.row(this).index();
        $('#pembayaran'+(idx+1)).focus();
    }    
});  
function filtermaubayarpiutang(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/filtermaubayarpiutang',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                MEMBERID : $('#kodememberterpilih').html(),
            },
            success: function (response) {
                if (response[0].dataquery[0].SUMSISAKREDIT > 0){
                    $('#datatransaksipiutang').DataTable().ajax.reload();
                    $('#cekpembayaran').show();
                    $('#namapelanggan').html(response[0].dataquery[0].NAMA.replace("::"," "));
                    $('#nohandphone').html(response[0].dataquery[0].TELEPON);
                    $('#alamatpelanggan').html(response[0].dataquery[0].ALAMAT);
                    $('#totalpiutang').html(formatuang(response[0].dataquery[0].SUMTOTALKREDIT,'id-ID','IDR'));
                    $('#sisapiutang').html(formatuang(response[0].dataquery[0].SUMSISAKREDIT,'id-ID','IDR'));
                    $('#sisapiutangbawah').html(formatuang(response[0].dataquery[0].SUMSISAKREDIT,'id-ID','IDR'));
                    $('#masukkannominal').focus()
                }else{
                    $('#cekpembayaran').hide();
                    Swal.fire({
                        title: "Informasi Piutang",
                        text: "Wow... amazing. Informasi atas piutang member dengan kode "+$('#kodememberterpilih').html()+" tidak ditemukan",
                        icon: 'warning',
                    });
                }
        
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}
function konfirmasibayarpiutang(){
    if (masukannominal.getNumber() <= 0){
        return Swal.fire({
            title: "Informasi Piutang",
            text: "Anda belum memasukan besaran pembayaran PIUTANG untuk NOTA: "+$('#nomornotapiutang').html(),
            icon: 'error',
        });
    }
    let arraydetailpembyaranpiutang = [];
    let datapembyaranpiutang = $('#datatransaksipiutang').DataTable().rows().data();
    let hasiljson = {};
    datapembyaranpiutang.each(function (isidatatable, index) {
        var temp = new Array();
        if ((Number(datapembyaranpiutang.cell(index,4).nodes().to$().find('input').val().replaceAll('.', '').replace(',', '.').trim())) > 0){
            temp.push(datapembyaranpiutang.cell(index,0).nodes().to$().find('input').val(),datapembyaranpiutang.cell(index,4).nodes().to$().find('input').val().replaceAll('.', '').replace(',', '.').trim(),"0");
            arraydetailpembyaranpiutang.push(temp)
        }
    });
    swal.fire({
        title: "Konfirmasi Pembayaran Piutang",
        text: "Apakah anada ingin mentransaksi transaksi PIUTANG dengan NOTA: "+$('#nomornotapiutang').html()+" dengan besaran TRANSAKSI :"+$('#masukkannominal').val(),
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Transaksikan Bosku!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            let d = new Date(); let timenow = d.toLocaleTimeString();
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/transaksipiutang',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        INFORMASIPIUTANG : arraydetailpembyaranpiutang,
                        TANGGALBAYAR : $('#tanggaltransaksipembayaranpiutang').val().split("-").reverse().join("-"),
                        KETERANGAN : $('#keteranganpiutang').val(),
                        NOTAPIUTANG : $('#nomornotapiutang').html(),
                        NOMOR : $('#nomornotapiutang').html().split('#')[1],
                        WAKTU : timenow.replaceAll('.', ':'),
                    },
                    success: function (response) {
                        let obj = JSON.parse(response);
                        if (obj.status == "true"){
                            swal.fire({
                                title: "Hore.. Transaksi Berhasil!!",
                                icon: 'success',
                                text: obj.msg,
                                //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
                                //imageHeight: 150,
                                showCancelButton:false,
                                confirmButtonText: "Oke.. Selamat Ya",
                                allowOutsideClick: false
                            }).then(function(result){
                                if(result.isConfirmed){
                                    window.location.reload();
                                }
                            })  
                        }else{
                            Swal.fire({
                                title: "Terjadi Kesalahan",
                                text: obj.msg,
                                icon: 'warning',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
        }
    })
}
</script>
<?= $this->include('backend/panggildaftarmember') ?>
<?= $this->endSection(); ?>