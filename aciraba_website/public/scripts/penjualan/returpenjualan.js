let bariske = 0,totalputanya=0,jumlahdata = 0, totalisi = 0;
var jssessionbayar;
$('#nominalpotongpiutang').on('input', debounce(function (e) {
    bayarsesuairetur();
}, 500));
$('#notrxreturjual').on('input', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#tabeltransaksi').DataTable().ajax.reload();
    });
}, 500));
function bayarsesuairetur(){
    if (nominalpotongpiutangtxt.getNumber() > Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim())){
        swal.fire({
            title: "Perhitungan Potong Piutang Salah!",
            icon: 'warning',
            text: "Pastikan nominal bayar yang anda masukan tidak melebihi dari total transaksi piutang. Maksimal nominal adalah "+formatuang(Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),'id-ID','IDR'),
            //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
            //imageHeight: 150,
            showCancelButton:true,
            confirmButtonText: "Hitung "+formatuang(Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),'id-ID','IDR'),
            cancelButtonText: "Skip. Gak Jadi",
        }).then(function(result){
            if(result.isConfirmed){
                nominalpotongpiutangtxt.set(Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()))
                hitungpiutangtabel()
            }else{
                nominalpotongpiutangtxt.set(0)
            }
        })   
    }else{
        hitungpiutangtabel()
    }
}
function hitungpiutangtabel(){
    let table = $('#datareturpotongpiutang').DataTable();let numRows = table.rows().count();let sisakredit = 0;let nominalinput;
    if (nominalpotongpiutangtxt.getNumber() > 0){
        nominalinput = nominalpotongpiutangtxt.getNumber()
    }else{
        nominalinput = Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim())
    }
    let sisa=0;
    for(a=0;a<numRows;a++){
        if (a == 0){  
            if (nominalinput > subtotalpiutang[a].getNumber()){
                nominalbayarpiutang[a].set(subtotalpiutang[a].getNumber());
            }else{
                nominalbayarpiutang[a].set(nominalinput);
            }
            sisa = nominalinput - subtotalpiutang[a].getNumber()
        }else{
            if (sisa > subtotalpiutang[a].getNumber()){
                nominalbayarpiutang[a].set(subtotalpiutang[a].getNumber());
            }else if (sisa < subtotalpiutang[a].getNumber() && sisa > 0){
                nominalbayarpiutang[a].set(sisa);
            }else if (sisa == subtotalpiutang[a].getNumber()){
                if (nominalinput == subtotalpiutang[0].getNumber()){
                    nominalbayarpiutang[a].set(sisa);
                }else{
                    nominalbayarpiutang[a].set(subtotalpiutang[a].getNumber());
                }
            }else{
                nominalbayarpiutang[a].set(0);
            }
            sisa = sisa - subtotalpiutang[a].getNumber()
        }
    }
}
$("#bayarsesuaireturbtn").on("click", function () {
    if (nominalpotongpiutangtxt.getNumber() == 0){
        nominalpotongpiutangtxt.set(Number($('#totalpiutangtersedia').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()))
    }
    bayarsesuairetur();
});
$("#parameterpencarian").change(function () {
    $('#tabelreturpenjualan').DataTable().ajax.reload();
});

function informasibarang(kodeitem){
    if ($("#kodepelanggan").html() == "" || $("#stokdiambildari").val() == null){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan pilih NAMA PELANGGAN dan ASAL OUTLET terlebih dahulu<br>sebelum anda melakukan RETUR PENJUALAN',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-right'
        })
    }
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/returpenjualandetailbarang',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KODEBARANG : kodeitem,
            },
            success: function (obj) {
                if (obj[0].success == "true"){
                    simpanreturlocal(
                        $('#notranskasiretur').val(),
                        "TANPA NOTA",
                        obj[0].dataquery[0].BARANG_ID,
                        obj[0].dataquery[0].NAMABARANG,
                        "0",
                        $('#qtyretur').val(),
                        obj[0].dataquery[0].HARGABELI,
                        obj[0].dataquery[0].HARGAJUAL,
                        "0",
                        $('#stokdiambildari').val(),
                        $('#returkestok').val(),
                        "",
                        "TUNAI"
                    );
                    return Swal.fire({
                        icon: 'info',
                        html: 'Nama : '+obj[0].dataquery[0].NAMABARANG + '<br>dengan kode ['+obj[0].dataquery[0].BARANG_ID+']<br>tertambahkan ke keranjang retur',
                        toast: true,
                        showConfirmButton: false,
                        timer: 1500,
                        position: 'top-right'
                    })
                }else{
                    Swal.fire(
                        'Gagal.. Uhhhhh!',
                        "Terjadi kesalahan dalam pengemabilan informasi barang ini. Mohon ulangi untuk berberapa saat lagi",
                        'warning'
                    )
                }
            }
        });
    });
}
function hapuskeranjangalert(){
    swal.fire({
        title: "Apakah Yakin ?",
        text: "Apakah yakin ingin membersihkan keranjang retur penjualan ini. Jika terhapus maka anda harus mengulang dari barang awal lagi",
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Bersihkan Dong!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            hapuskeranjangretur();
        }
    })
}
function hapuskeranjangretur(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/hapuskeranjangretur',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.status == "true"){
                    $('#dataretur').DataTable().ajax.reload();
                    $('#totalretur').html(formatuang(0,'id-ID','IDR'));
                    $('#totalhppretur').html(formatuang(0,'id-ID','IDR'));
                    $('#totalpiutangtersedia').html(formatuang(0,'id-ID','IDR'));
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
$("#simpanretur").on("click", function () {
    hitunginformasi()
    let table = $('#dataretur').DataTable();let numRows = table.rows().count();pesanpotonghutang ="",apakahedit = "false";
    let d = new Date(); let timenow = d.toLocaleTimeString();
    if (numRows == 0 ){
        return Swal.fire({
            icon: 'error',
            html: 'Anda belum melakukan pemilihan barang untuk di RETUR PENJUALAN<br>Proses simpan akan difungsikan apabila<br>anda memilih 1 barang untuk di RETUR PENJUALAN',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-right'
        })
    }
    if ($("#kodepelanggan").html() == ""){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan pilih member terlebih dahulu untuk<br>dijadikan pelanggan retur penjualan,<br>dan pastikan anda tidak salah pilih member',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'top-right'
        })
    }
    if($('#konfirmasipotongpiutang').is(':checked')) { 
        pesanpotonghutang = ". Serta potong piutang sebesar "+formatuang(nominalpotongpiutangtxt.getNumber(),'id-ID','IDR');
    } else {
        pesanpotonghutang = "";
    }
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda akan melakuakn retur dengan NO TRX : "+$("#notranskasiretur").val()+" sebesar "+$('#totalretur').html().replace('&nbsp;', '').trim()+" "+pesanpotonghutang,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Siap!!'
    }).then((result) => {
        if (result.isConfirmed) {
            let arrayreturpenjualan = [],arrayreturpotongpiutang = [];
            let daftarkeranjangretur = $('#dataretur').DataTable().rows().data();
            let datareturpotongpiutang = $('#datareturpotongpiutang').DataTable().rows().data();
            daftarkeranjangretur.each(function (isidatatable, index) {
                var temp = new Array();
                temp.push(
                    '',
                    daftarkeranjangretur.cell(index,1).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,2).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,3).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,4).nodes().to$().find('input').val(),
                    jumlahbeli[index].getNumber(),
                    jumlahretur[index].getNumber(),
                    hargabeli[index].getNumber(),
                    hargajual[index].getNumber(),
                    ppn[index].getNumber(),
                    daftarkeranjangretur.cell(index,10).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,11).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,12).nodes().to$().find('input').val(),
                    daftarkeranjangretur.cell(index,13).nodes().to$().find('input').val(),
                    session_outlet,
                    session_kodeunikmember
                );
                arrayreturpenjualan.push(temp)
            });
            datareturpotongpiutang.each(function (isidatatable, index) {
                if (nominalbayarpiutang[index].getNumber() > 0){
                    var temp = new Array();
                    temp.push(
                        '',
                        $("#notapembayaranpiutang").val(),
                        datareturpotongpiutang.cell(index,0).nodes().to$().find('input').val(),
                        $('#tanggaltranaksiretur').val().split("-").reverse().join("-"),
                        timenow.replaceAll('.', ':'),
                        session_pengguna_id,
                        nominalbayarpiutang[index].getNumber(),
                        potongpiutang[index].getNumber(),
                        datareturpotongpiutang.cell(index,6).nodes().to$().find('input').val(),
                        session_kodeunikmember,
                        $('#notranskasiretur').val(),
                        $('#notranskasiretur').val().split('#')[1],
                        session_outlet,
                    );
                    arrayreturpotongpiutang.push(temp)
                }
            });
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/jsontambahreturdanpotongpiutang',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        ARRAYRETURBELI : arrayreturpenjualan,
                        ARRAYPOTONGPIUTANG : arrayreturpotongpiutang,
                        POTONGPIUTANGAKTIF : $('#konfirmasipotongpiutang').is(':checked'),
                        APAKAHEDIT : apakahedit,
                        NOTRXRETUR  : $('#notranskasiretur').val(),
                        IDPELANGGAN :  $('#kodepelanggan').html(),
                        TANGGALRETUR  : $('#tanggaltranaksiretur').val().split("-").reverse().join("-"),
                        NOMORNOTA  : $('#notranskasiretur').val().split('#')[1],
                        TOTALBARANG  : totalbarang,
                        TOTALRETUR  : Number($('#totalretur').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),
                        ISEDIT : isedit,
                    },
                    success: function (response) {
                        var obj = $.parseJSON(response);
                        if (obj.status == "true"){
                            hapuskeranjangretur();
                            Swal.fire({
                                title: 'Transaksi Retur Berhasil!',
                                text: "Transaksi Retur dengan NO TRX : "+$("#notranskasiretur").val()+" sebesar "+$('#totalretur').html().replace('&nbsp;', '').trim()+" "+pesanpotonghutang+" berhasil.",
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oke, Siap Transaksi Lagi',
                                cancelButtonText: 'Tidak, Ke Daftar Retur'
                            }).then((result) => {
                                if(result.isConfirmed){           
                                    location.href = baseurljavascript+"penjualan/tambahreturpenjualan";
                                }else{
                                    location.href = baseurljavascript+"penjualan/daftarreturpenjualan";
                                }
                            })
                        }else{
                            Swal.fire(
                                'Aww Snap..!!',
                                obj.msg,
                                'error'
                            )
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
        }
    })
});
function hapusreturpenjualan(notransaksi,nominal){
    swal.fire({
        title: "Hapus Transaksi Retur Penjualan ?",
        text: "Apakah anda ingin menghapus TRANSAKSI RETUR dengan NOTA : "+notransaksi+" dengan besaran nominal "+nominal,
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Hapus Ini!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/hapusreturpenjualan',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        NOTARETURPENJUALAN: notransaksi,
                    },
                    success: function (response) {
                        if (response[0].success == "true"){
                            Swal.fire({
                                title: "Hapus Transkasi Retur",
                                text: "Hapus transaksi retur penjualan dengan NOTA : "+notransaksi+" dengan besaran nominal "+nominal+" berhasil di hapus. Stok akan dikurangi dan dicatat pada KARTU STOK",
                                icon: "success",
                            });
                            $('#tabelreturpenjualan').DataTable().ajax.reload();
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
    })
}