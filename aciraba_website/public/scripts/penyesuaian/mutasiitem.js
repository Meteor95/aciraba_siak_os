document.addEventListener('mousedown', function(event) { if (event.detail > 1) { event.preventDefault(); } }, false);
document.addEventListener("keydown", function(e) {
    if (e.key === "F1") {
        e.preventDefault();
        setTimeout(function () { 
            $("#daftaritem_katakunci_panggil").focus();
        }, 1000);
        $('#modal6').modal('show');
    }else if (e.key === "F5") {
        e.preventDefault();
        swal.fire({
            title: "Halaman akan disegarkan [resfresh] ?",
            text: "Apakah anda ingin mensegarkan [refresh] halaman ini. Pastikan anda menyimpan pekerjaan sebelumnya dikarenakan progress akan tereset",
            icon:"warning",
            showCancelButton:true,
            confirmButtonText: "Oke, Segarkan [Refresh] Halaman Ini!",
            cancelButtonText: "Gak Jadi Ah!",
        }).then(function(result){
            if(result.isConfirmed){
                window.location.reload();
            }
        })
    }else if (e.ctrlKey && e.key === "s") {
        e.preventDefault();
        simpantransaksipembelian();
    }
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
    })
}
function kosongkankeranjanglokal(){
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