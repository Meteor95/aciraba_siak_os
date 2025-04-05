<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
    .tombolmelayang{ width:300px; height: 40px; position: fixed; background-color: blue; bottom: 0; right: 40%; z-index: 999999;}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="row portlet-row-fill-md h-100">
                            <div class="col-md-12 col-xl-12">
                                <!-- BEGIN Portlet -->
                                <div class="portlet portlet-primary">
                                    <div class="portlet-header">
                                        <div class="portlet-icon">
                                            <i class="fa fa-box"></i>
                                        </div>
                                        <h3 class="portlet-title">Informasi Mutasi Item</h3>
                                    </div>
                                    <div class="portlet-body">
                                        <!-- BEGIN Portlet -->
                                        <div class="portlet mb-2">
                                            <div class="portlet-body">
                                                <!-- BEGIN Widget -->
                                                <div class="widget5">
                                                    <h4 class="widget5-title"></h4>
                                                    <div class="widget5-group">
                                                        <div class="widget5-item mr-2">
                                                            <span class="widget5-info">Asal Outlet</span>
                                                            <span class="widget5-value"><select class="form-control" id="cmblokasioutletasal"></select></span>
                                                        </div>
                                                        <div class="widget5-item mr-2">
                                                            <span class="widget5-info">Lokasi Asal Item</span>
                                                            <span class="widget5-value"><select id="lokasiitemasal" class="selectpicker" data-live-search="true">
                                    <option value="D"> Ambil Dari Display</option>
                                    <option value="G"> Ambil Dari Gudang</option>
                                    <option value="R"> Ambil Dari Retur</option>
                                </select></span>
                                                        </div>
                                                        <div class="widget5-item mr-2">
                                                            <span class="widget5-info"> Tujuan Outlet</span>
                                                            <span class="widget5-value"><select class="form-control" id="cmblokasioutlettujuan"></select></span>
                                                        </div>
                                                        <div class="widget5-item mr-2">
                                                            <span class="widget5-info">Lokasi Tujuan Item</span>
                                                            <span class="widget5-value"><select id="lokasiitemtujuan" class="selectpicker" data-live-search="true">
                                    <option value="D"> Pindah Ke Display</option>
                                    <option value="G"> Pindah Ke Gudang</option>
                                    <option value="R"> Pindah Ke Retur</option>
                                </select></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Widget -->
                                            </div>
                                        </div>
                                        <!-- END Portlet -->
                                    </div>
                                </div>
                                <!-- END Portlet -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-2">
                                <!-- BEGIN Rich List -->
								<div class="rich-list-item w-100 p-0">
									<div class="rich-list-prepend" style="width: 100px;">
										<!-- BEGIN Input Group -->
                                        <div class="input-group-icon input-group-lg">
                                            <div class="input-group-prepend">
                                                <i class="fa fa-cart-plus text-primary"></i>
                                            </div>
                                            <input id="qtykeluarkasir" type="text" class="form-control" value="1" placeholder="QTY">
                                        </div>
                                        <!-- END Input Group -->
									</div>
									<div class="rich-list-content">
										<!-- BEGIN Input Group -->
                                        <div class="input-group-icon input-group-lg">
                                            <div class="input-group-prepend ml-1">
                                                <i class="fa fa-search text-primary"></i>
                                            </div>
                                            <input id="katakuncipencariankasir" type="text" class="form-control" placeholder="Ketikkan Kode item / Nama item">
                                        </div>
                                        <!-- END Input Group -->
									</div>
									<div class="rich-list-append">
										<button id="bersihkanform" class="btn btn-flat-info btn-icon mr-2 btn-lg">
											<i class="fa fa-redo-alt"></i>
										</button>
										<button data-toggle="modal" data-target="#modal6" class="btn btn-flat-info btn-icon mr-2 btn-lg">
											<i class="fa fa-boxes"></i>
										</button>
									</div>
								</div>
								<!-- END Rich List -->
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input value="" type="text" id="notrxmutasi" class="form-control" style="font-size:15px" placeholder="Buat Nomor Nota Anda">
                                    <div class="input-group-prepend">
                                        <span style="cursor:pointer;" onclick="loadnotranskasi()" id="generateiditem" class="input-group-text btn-warning btn">Generate Nota</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input id="keteranganmutasi" type="text" class="form-control" style="font-size:15px" placeholder="Tentukan keterangan mutasi berikut">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input id="tanggaltransaksiopname" type="text" style="font-size:15px" class="form-control" placeholder="Pilih Tanggal Transaksi">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <b>NB : </b>[D] = Display [G] = Gudang [R] = Retur
                        <!-- BEGIN Datatable -->
                        <table id="keranjangmutasi" class="table table-bordered table-striped table-hover nowrap">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Unit</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Mutasi</th>
                                    <th>Nominal HPP</th>
                                    <th>Outlet Awal</th>
                                    <th>Outlet Tujuan</th>
                                    <th>Awal Lokasi</th>
                                    <th>Tujan Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Item</th>
                                    <th>Nama Item</th>
                                    <th>Unit</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Mutasi</th>
                                    <th>Nominal HPP</th>
                                    <th>Outlet Awal</th>
                                    <th>Outlet Tujuan</th>
                                    <th>Awal Lokasi</th>
                                    <th>Tujan Lokasi</th>
                                </tr>
                            </tfoot>
                        </table>
                        <!-- END Datatable -->
                        <button onclick="simpantransaksimutasiitem()" id="simpantrxpenyesuaian" class="tombolmelayang btn btn-success btn-block"><i class="fas fa-box-open"></i> Transaksi Mutasi Item </button>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url();?>scripts/penyesuaian/mutasiitem.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
let daftarkeranjang = "";
var stokmutasi = [];
var totalbarangg = 0;
$(document).ready(function () {
loadnotranskasi()
$('#tanggaltransaksiopname').val(moment().format('DD-MM-YYYY'));
$("#tanggaltransaksiopname").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",});
getCsrfTokenCallback(function() {
    daftarkeranjang = $("#keranjangmutasi").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        scrollY: "100vh",
        keys: true,
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        ordering: false,
        ajax: {
            "url": baseurljavascript + 'penyesuaian/daftarmutasilocal',
            "type": "POST",
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.KATAKUNCIPENCARIAN = null;
            }
        },
        drawCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            var data = daftarkeranjang.rows().data();
            data.each(function (value, index) {
                if (!AutoNumeric.getAutoNumericElement("#"+daftarkeranjang.cell(index,5).nodes().to$().find('input').prop('id'))) { stokmutasi[index] = new AutoNumeric("#"+daftarkeranjang.cell(index,5).nodes().to$().find('input').prop('id'), {decimalCharacter : ',',digitGroupSeparator : '.',});}
            });
        },
    }).on('key-focus', function ( e, datatable, cell, originalEvent ) {
        $('input', cell.node()).focus();
    }).on("focus", "td input", function(){
        $(this).select();
    });
    daftarkeranjang.on('key', function (e, dt, code) {
        if (code === 13) {
            daftarkeranjang.keys.move('down');
        }
    });
});
$('#cmblokasioutletasal').select2({
    allowClear: true,
    placeholder: 'Tentukan Asal Outlet ?',
    ajax: {
        url: baseurljavascript + 'auth/outlet',
        method: 'POST',
        dataType: 'json',
        delay: 500,
        data: function (params) {
            return {
                KATAKUNCIPENCARIAN: "",
                KODEUNIKMEMBER: session_kodeunikmember,
            }
        },
        processResults: function (data) {
            parseJSON = JSON.parse(data);
            getCsrfTokenCallback(function() {});
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "OUTLET : " + item.group+" ["+item.namaoutlet+"] ",
                        id: item.group,
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            getCsrfTokenCallback(function() {});
            toastr["error"](xhr.responseJSON.message);
        }

    },
});
$('#cmblokasioutlettujuan').select2({
    allowClear: true,
    placeholder: 'Tentukan Tujuan Outlet ?',
    ajax: {
        url: baseurljavascript + 'auth/outlet',
        method: 'POST',
        dataType: 'json',
        delay: 500,
        data: function (params) {
            return {
                csrf_aciraba: csrfTokenGlobal,
                KATAKUNCIPENCARIAN: (typeof params.term === "undefined" ? "" : params.term),
                KODEUNIKMEMBER: session_kodeunikmember,
            }
        },
        processResults: function (data) {
            parseJSON = JSON.parse(data);
            getCsrfTokenCallback(function() {});
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "OUTLET : " + item.group+" ["+item.namaoutlet+"] ",
                        id: item.group,
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            getCsrfTokenCallback(function() {});
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
});
function loadnotranskasi(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/notamenupenjualan',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                AWALANOTA : "MT",
                OUTLET: session_outlet,
                KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                TANGGALSEKARANG: moment().format('YYYYMMDD'),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                $('#notrxmutasi').val(response.nomornota);
            }
        });
    });
}
function panggilinformasibarangmutasi(){
    let stokawalmutasi = 0;
    if ($("#cmblokasioutletasal").val() == null || $("#cmblokasioutlettujuan").val() == null){
        return Swal.fire(
            'Penentuan Informasi Mutasi!',
            'Silahkan tentukan ASAL outlet dan lokasi stok sebelum dimasukkan keranjang',
            'warning'
        ) 
    }
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'pembelian/pilihbarangpembelian',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KATAKUNCI : $('#katakuncipencariankasir').val(),
            },
            success: function (response) {
                if(response[0].success == "true"){
                    console.log(response[0].totaldata)
                    if (response[0].totaldata > 1){
                        setTimeout(function () { 
                            $("#daftaritem_katakunci_panggil").focus();
                            $("#daftaritem_katakunci_panggil").val($('#katakuncipencariankasir').val());
                            $('#keranjangmutasi').DataTable().ajax.reload();
                        }, 1000);
                        $("#modal6").modal('show');
                    }else{
                        if ($("#lokasiitemasal").val() == "D"){
                            stokawalmutasi = response[0].dataquery[0].DISPLAY;
                        }else if ($("#lokasiitemasal").val() == "G"){
                            stokawalmutasi = response[0].dataquery[0].GUDANG;
                        }else if ($("#lokasiitemasal").val() == "R"){
                            stokawalmutasi = response[0].dataquery[0].RETUR;
                        }
                        tambahkeranjangmutasi(
                            $('#notrxmutasi').val(),
                            response[0].dataquery[0].BARANG_ID,
                            response[0].dataquery[0].NAMABARANG,
                            response[0].dataquery[0].SATUAN,
                            stokawalmutasi,
                            $("#qtykeluarkasir").val(),
                            response[0].dataquery[0].HARGABELI,
                            $("#cmblokasioutletasal").val(),
                            $("#cmblokasioutlettujuan").val(),
                            $("#lokasiitemasal").val(),
                            $("#lokasiitemtujuan").val(),
                            session_outlet,
                            session_kodeunikmember,
                        );
                    }
                }else{
                    Swal.fire({
                        title: "Informasi Tidak Ditemukan",
                        text: "Waduh... Loo Loo Loo informasi yang anda masukan sama sekali tidak ditemukakn di database kami. Silahkan cek kembali",
                        icon: 'warning',
                    }); 
                }
            }
        });
    });
}
function tambahkeranjangmutasi(NOMORMUTASI,KODEBARANG,NAMABARANG,UNIT,STOKAWAL,STOKMUTASI,NOMINAL,ASALOUTLET,TUJUANOUTLET,ASALLOKASIITEM,TUJUANLOKASIITEM,OUTLET,KODEUNIKMEMBER){
    getCsrfTokenCallback(function() {   
        $.ajax({
            url: baseurljavascript + 'penyesuaian/tambahkekeranjangmutasi',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                NOMORMUTASI : NOMORMUTASI,
                KODEBARANG : KODEBARANG,
                NAMABARANG : NAMABARANG,
                UNIT : UNIT,
                STOKAWAL : STOKAWAL,
                STOKMUTASI : STOKMUTASI,
                NOMINAL : NOMINAL,
                ASALOUTLET :ASALOUTLET,
                TUJUANOUTLET : TUJUANOUTLET,
                ASALLOKASIITEM : ASALLOKASIITEM,
                TUJUANLOKASIITEM : TUJUANLOKASIITEM,
                OUTLET :OUTLET,
                KODEUNIKMEMBER : KODEUNIKMEMBER,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.status == "true" || obj.status == "adadata"){
                    $('#katakuncipencariankasir').val('');
                    $('#qtypemasukan').val('1');
                    $('#keranjangmutasi').DataTable().ajax.reload();
                }else{
                    Swal.fire({
                        title: "Gagal... Cek Koneksi Local DB Kasir",
                        text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
                        icon: 'warning',
                    }); 
                }
            }
        });
    });
}
function hapusperbarang(kodebarang,namabarang,ai){
        swal.fire({
            title: "Apakah Yakin ?",
            text: "Apakah yakin ingin menghapus barang "+namabarang+" pada keranjang ini.",
            icon:"warning",
            showCancelButton:true,
            confirmButtonText: "Oke, Hapus Ini!",
            cancelButtonText: "Gak Jadi Ah!",
        }).then(function(result){
            if(result.isConfirmed){
                getCsrfTokenCallback(function() {
                    $.ajax({
                        url: baseurljavascript + 'penyesuaian/hapusperbarangmutasi',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            [csrfName]:csrfTokenGlobal,
                            AI: ai,
                        },
                        success: function (response) {
                            var obj = JSON.parse(response);
                            if (obj.status == "true"){
                                $('#keranjangmutasi').DataTable().ajax.reload();
                            }else{
                                Swal.fire({
                                    title: "Gagal... Cek Koneksi Local DB Kasir",
                                    text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
                                    icon: 'warning',
                                });
                            }
                        }
                    });
                });
            }
        });
}
function kosongkankeranjanglokal(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penyesuaian/hapuskeranjangmutasi',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.status == "true"){
                    $('#katakuncibarang').val('');
                    $('#qtypemasukan').val('1');
                    $('#keranjangmutasi').DataTable().ajax.reload();
                }else{
                    Swal.fire({
                        title: "Gagal... Membersihkan Keranjang, Silahkan tekan F5",
                        text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
                        icon: 'warning',
                    });
                }
            }
        });
    });
}
$("#bersihkanform").on("click", function () {
    swal.fire({
        title: "Apakah Yakin ?",
        text: "Apakah yakin ingin menghapus seluruh pada keranjang mutasi ini ?. Jika anda ingin mensegarkan tampilan ini silahkan tekan F5",
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Hapus Ini!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            kosongkankeranjanglokal()
        }
    })
});
function simpantransaksimutasiitem(){
if (daftarkeranjang.rows().count() <= 0){
    return swal.fire({
        title: "Ooops.... Yakin ?",
        text: "Anda masih belum memilih satupun item yang akan dimutasi. Silahkan pilih minimal 1 barang untuk dimutasi ke tujuan",
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Paham!",
        cancelButtonText: "Yupss.. Maaf!",
    })
}
swal.fire({
    title: "Transaksi Mutasi Ke Tujuan",
    text: "Apakah anda yakin untuk memutasi informasi item yang ada di keranjang diatas ? Mutasi tidak dapat dihapus atau diubah jika sudah di transaksi demi keamanan data",
    icon:"question",
    showCancelButton:true,
    confirmButtonText: "Oke, Cus Mutasikan!",
    cancelButtonText: "Gak Jadi Ah!",
}).then(function(result){
    if(result.isConfirmed){           
        let arraydetailmutasi = [];
        let datamutasi = $('#keranjangmutasi').DataTable().rows().data();
        datamutasi.each(function (isidatatable, index) {
            var temp = new Array();
            temp.push(
                '',
                $('#notrxmutasi').val(),
                datamutasi.cell(index,1).nodes().to$().find('input').val(),
                datamutasi.cell(index,2).nodes().to$().find('input').val(),
                datamutasi.cell(index,3).nodes().to$().find('input').val(),
                datamutasi.cell(index,4).nodes().to$().find('input').val(),
                stokmutasi[index].getNumber(),
                datamutasi.cell(index,6).nodes().to$().find('input').val(),
                datamutasi.cell(index,7).nodes().to$().find('input').val(),
                datamutasi.cell(index,8).nodes().to$().find('input').val(),
                datamutasi.cell(index,9).nodes().to$().find('input').val(),
                datamutasi.cell(index,10).nodes().to$().find('input').val(),
                session_outlet,
                session_kodeunikmember,
            );
            arraydetailmutasi.push(temp)
        });
        getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'penyesuaian/simpanmutasi',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]:csrfTokenGlobal,
                    DETAILMUTASI: arraydetailmutasi,
                    NOMORMUTASI: $('#notrxmutasi').val(),
                    TANGGALTRS: $('#tanggaltransaksiopname').val().split("-").reverse().join("-"),
                    NOMOR: $('#notrxmutasi').val().split('#')[1],
                    KETERANGAN: $('#keteranganmutasi').val(),
                },
                success: function (response) {
                    if (response[0].success == "true"){
                        kosongkankeranjanglokal();
                        swal.fire({
                            title: "Transaksi Mutasi Berhasil",
                            text: "Transaksi mutasi berhasil dengan NO NOTA MUTASI : "+$('#notrxmutasi').val()+". Proses mutasi dicatata dalam kartu stok. Silahkan cek kartu stok jika ingin melihat histori mutasi lainnya",
                            icon: 'success',
                            showCancelButton:true,
                            confirmButtonText: "Oke, Lanjut Transaksi!",
                            cancelButtonText: "Tidak, Kembali Ke Daftar!",
                        }).then(function(result){
                            if(result.isConfirmed){           
                                location.href = baseurljavascript+"penyesuaian/formmutasiitem";
                            }else{
                                location.href = baseurljavascript+"penyesuaian/mutasibarang";
                            }
                        })
                    }else{
                        Swal.fire({
                            title: "Gagal... Melakukan Transaksi, Silahkan tekan F5",
                            text: response.msg,
                            icon: 'warning',
                        });
                    }
                }
            });
        });
    }
})
}
var catchEnter = debounce(function(index) {
    updatekeranjangmutasi(index)
}, 500);
function updatekeranjangmutasi(index){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penyesuaian/updatekeranjangmutasi',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                STOKMUTASI : stokmutasi[index].getNumber(),
                KODEBARANG : daftarkeranjang.cell(index,1).nodes().to$().find('input').val(),
                ASALOUTLET : daftarkeranjang.cell(index,7).nodes().to$().find('input').val(),
                ASALLOKASIITEM : daftarkeranjang.cell(index,9).nodes().to$().find('input').val(),
            },
            success: function (response) {
                let obj = JSON.parse(response);
                if (obj.status == "false"){
                    Swal.fire(
                        'Pembaruan Keranjang Error!',
                        obj.msg,
                        'warning'
                    ) 
                }
            }
        });
    });
}
$('#qtykeluarkasir').keypress(function (e) {let key = e.which; if(key == 13){$('#katakuncipencariankasir').focus();return false;}});
$('#katakuncipencariankasir').keypress(function (e) {let key = e.which; if(key == 13 && $('#katakuncipencariankasir').val() == ""){$('#qtykeluarkasir').focus();return false;}});
</script>
<?= $this->include('backend/panggildaftarbarang') ?>
<?= $this->endSection(); ?>