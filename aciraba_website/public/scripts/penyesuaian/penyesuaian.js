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
        simpantransaksiopname();
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
                AWALANOTA : "OP",
                OUTLET: session_outlet,
                KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                TANGGALSEKARANG: moment().format('YYYYMMDD'),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                $('#notransaksiopname').val(response.nomornota);
            }
        });
    });
}
function panggilinformasibarang(){
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
                            $("#daftaritem_katakunci_panggil").val($('#katakuncibarang').val());
                            $('#pangil_daftarabarang').DataTable().ajax.reload();
                        }, 500);
                        $("#modal6").modal('show');
                    }else{
                        tambahkeranjang(
                            response[0].dataquery[0].BARANG_ID,
                            response[0].dataquery[0].NAMABARANG,
                            $("#lokasioutlet").val(),
                            $("#lokasioutlet").val() == "D" ? response[0].dataquery[0].DISPLAY : response[0].dataquery[0].GUDANG,
                            $("#qtykeluarkasir").val(),
                            $("#kondisipenyesuaian").val(),
                            session_outlet,
                            session_kodeunikmember,
                            response[0].dataquery[0].HARGABELI,
                            ""
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
function tambahkeranjang(KODEBARANG,NAMABARANG,LOKASIOPNAME,STOKKOMPUTER,STOKOPNAME,KONDISIOPNAME,OUTLET,KODEUNIKMEMBER,HPP,INFORMASI){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penyesuaian/tambahkekeranjangopname',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                NOTAOPNAME : $('#notransaksiopname').val(),
                KODEBARANG : KODEBARANG,
                NAMABARANG : NAMABARANG,
                LOKASIOPNAME : LOKASIOPNAME,
                STOKKOMPUTER : STOKKOMPUTER,
                STOKOPNAME : STOKOPNAME,
                KONDISIOPNAME : KONDISIOPNAME,
                OUTLET : OUTLET,
                KODEUNIKMEMBER : KODEUNIKMEMBER,
                HPP : HPP,
                INFORMASI : INFORMASI,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.status == "true" || obj.status == "adadata"){
                    $('#katakuncipencariankasir').val('');
                    $('#qtykeluarkasir').val('1');
                    getCsrfTokenCallback(function() {
                        $('#keranjangopname').DataTable().ajax.reload();
                    });
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
var catchEnter = debounce(function(index) {
    hitungkeranjangbeli(index)
}, 500);
function hitungkeranjangbeli(index){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penyesuaian/updatekeranjangopname',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                NOTAOPNAME : $('#notransaksiopname').val(),
                KODEBARANG : daftarkeranjang.cell(index,1).nodes().to$().find('input').val(),
                STOKOPNAME : anstokfiskik[index].getNumber(),
                INFORMASI : daftarkeranjang.cell(index,8).nodes().to$().find('input').val(),
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
    hitunginformasi()
}
function hitunginformasi(){
    var data = daftarkeranjang.rows().data();
    let totalopname = 0, totalminus = 0, totalsurplus=0, selisih = 0, totalbarang=0;
    data.each(function (value, index) {
        selisih = (anstokkom[index].getNumber() - anstokfiskik[index].getNumber())
        if (selisih > 0){
            totalminus = (totalminus + (anharga[index].getNumber() * selisih) * -1)
        }else if (selisih < 0){
            totalsurplus = (totalsurplus + (anharga[index].getNumber() * selisih) * -1)
        }
        $('#totalminus').html(formatuang((totalminus),'id-ID','IDR').replaceAll('-', '').trim());
        $('#totalplus').html(formatuang((totalsurplus),'id-ID','IDR').replaceAll('-', '').trim());
        totalbarang = totalbarang + anstokfiskik[index].getNumber();
    }); 
    totalbarangg = totalbarang;
    totalopname = totalsurplus + totalminus;
    $('#totalnominal').html(formatuang((totalopname),'id-ID','IDR'));
}
function hapusperbarang(kodebarang,namabarang){
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
                    url: baseurljavascript + 'penyesuaian/hapusperbarang',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        KODEBARANG: kodebarang,
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if (obj.status == "true"){
                            $('#keranjangopname').DataTable().ajax.reload();
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
function ajaxkosongkan(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penyesuaian/hapuskeranjang',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.status == "true"){
                    getCsrfTokenCallback(function() {
                        $('#keranjangopname').DataTable().ajax.reload();
                    });
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
function hapuskeranjang(){
    swal.fire({
        title: "Apakah Yakin ?",
        text: "Apakah yakin ingin membersihkan keranjang sementara opname ini. Jika terhapus maka anda harus mengulang dari barang awal lagi",
        icon:"warning",
        showCancelButton:true,
        confirmButtonText: "Oke, Bersihkan Dong!",
        cancelButtonText: "Gak Jadi Ah!",
    }).then(function(result){
        if(result.isConfirmed){
            ajaxkosongkan();
        }
    })
}
function simpantransaksiopname(){
    hitunginformasi();
    swal.fire({
        title: "Apakah Yakin ?",
        text: "Stok akan diubah sesuai dengan kondisi dan lokasi outlet yang anda pilih sebelum memasukkan keranjang. Penyesuaian stok yang terproses tidak dapat diubah tetapi dapat dihapus",
        icon:"question",
        showCancelButton:true,
        confirmButtonText: "Siap, Transaksikan!",
        cancelButtonText: "Gak Jadi Ah, Atut!",
    }).then(function(result){
        if(result.isConfirmed){
            let arraydetailpenyesuaian = [];
            let daftarkeranjang = $('#keranjangopname').DataTable().rows().data();
            let $kondisiopname = "";
            daftarkeranjang.each(function (isidatatable, index) {
                if (daftarkeranjang.cell(index,6).nodes().to$().find('input').val() === "Stok Akhir [+]"){$kondisiopname = "T";}else if (daftarkeranjang.cell(index,6).nodes().to$().find('input').val() === "Stok Akhir [-]"){$kondisiopname = "K";}else{$kondisiopname = "R";}
                var temp = new Array();
                temp.push(
                    daftarkeranjang.cell(index,1).nodes().to$().find('input').val(),
                    daftarkeranjang.cell(index,2).nodes().to$().find('input').val(),
                    daftarkeranjang.cell(index,3).nodes().to$().find('input').val() == "Display" ? "D" : "G",
                    daftarkeranjang.cell(index,4).nodes().to$().find('input').val(),
                    anstokfiskik[index].getNumber(),
                    $kondisiopname,
                    session_outlet,
                    session_kodeunikmember,
                    daftarkeranjang.cell(index,7).nodes().to$().find('input').val(),
                    daftarkeranjang.cell(index,8).nodes().to$().find('input').val(),
                );
                arraydetailpenyesuaian.push(temp)
            });
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penyesuaian/simpantransaksiopname',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        DETAILOPNAME :arraydetailpenyesuaian,
                        NOTAOPNAME : $('#notransaksiopname').val(),
                        TOTALBARANG : totalbarangg,
                        TOTALSURPLUS :  $('#totalplus').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim(),
                        TOTALMINUS :  $('#totalminus').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim(),
                        TOTALOPANAME :  $('#totalnominal').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim(),
                        NOMOR : $('#notransaksiopname').val().split('#')[1],
                        KETERANGAN : $('#keteranganopname').val(),
                        TANGGALTRS : $("#tanggaltransaksiopname").val().split("-").reverse().join("-"),
                    },
                    success: function (response) {
                        ajaxkosongkan();
                        if (response[0].success == "true"){
                            swal.fire({
                                title: "Apakah Yakin ?",
                                text: response[0].msg,
                                icon:"success",
                                showCancelButton:true,
                                confirmButtonText: "Lanjutkan Opanem Lagi!",
                                cancelButtonText: "Kembali Ke Daftar!",
                            }).then(function(result){
                                if(result.isConfirmed){           
                                    location.href = baseurljavascript+"penyesuaian/formpenyesuianstok";
                                }else{
                                    location.href = baseurljavascript+"penyesuaian/stokopname";
                                }
                            })
                        }else{
                            Swal.fire(
                                'Gagal Dalam Transaksi Alias Error!',
                                response[0].msg,
                                'warning'
                            ) 
                        }
                    }
                });
            });
        }
    })
}