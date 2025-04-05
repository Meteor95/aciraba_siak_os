let keranjangarray = [],inforkartubarang = []
let timenow = moment().format('HH:mm:ss');
let indexsubarray = 0
let formatter = new Intl.NumberFormat('id-ID', {style: 'currency',currency: 'IDR',});
let hasilsubtotalkasir = 0;hasilhargabaru = 0;
let socketIo = io(baseurlsocket);
socketIo.on("connect", () => { console.log(socketIo.id); });
/*global listener browser keybind*/
function launchFullscreen(element) {
    var docElm = element;
    if (docElm.requestFullscreen) {
      docElm.requestFullscreen();
    } else if (docElm.msRequestFullscreen) {
      docElm.msRequestFullscreen();
    } else if (docElm.mozRequestFullScreen) {
      docElm.mozRequestFullScreen();
    } else if (docElm.webkitRequestFullScreen) {
      docElm.webkitRequestFullScreen();
    }
}

document.addEventListener('mousedown', function(event) { if (event.detail > 1) { event.preventDefault(); } }, false);
document.addEventListener("keydown", function(e) {
    if($('#modalkonfirmasipembayaran').hasClass('show') && (e.key == "F1")) {
        e.preventDefault();
        $("#tunai").prop("checked", true);
        $("#tunai").trigger("change");
    }else if($('#modalkonfirmasipembayaran').hasClass('show') && (e.key == "F2")) {
        e.preventDefault();
        $("#kredit").prop("checked", true);
        $("#kredit").trigger("change");
    }else if($('#modalkonfirmasipembayaran').hasClass('show') && (e.key == "F3")) {
        e.preventDefault();
        $("#kartu").prop("checked", true);
        $("#kartu").trigger("change");
    }else if($('#modalkonfirmasipembayaran').hasClass('show') && (e.key == "F4")) {
        e.preventDefault();
        $("#splitcash").prop("checked", true);
        $("#splitcash").trigger("change");
    }else if($('#modalkonfirmasipembayaran').hasClass('show') && (e.key == "End")) {
        simpantransaksi();
    }
    if (e.key === "F6") {
        e.preventDefault();
        $('#katakuncipencariankasir').focus();
    }else if (e.key === "F8" || (e.ctrlKey && e.key === "s")) {
        e.preventDefault();
        cekkeranjang();
    }else if (e.ctrlKey && e.key === "d") {
        e.preventDefault();
        simpantransaksipending();
    }else if (e.key === "F2" && !$('#modalkonfirmasipembayaran').hasClass('show')) {
        e.preventDefault();
        panggilsalesman();
        $("#salesmandikasir").modal('show');
    }else if (e.key === "F1" && !$('#modalkonfirmasipembayaran').hasClass('show')) {
        e.preventDefault();
        panggilmemberkasir();
        $("#memberdikasir").modal('show');
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
    }else if (e.key === "F3" && !$('#modalkonfirmasipembayaran').hasClass('show')) {
        e.preventDefault();
        daftarpenjualan();
        $("#daftarpenjualan").modal('show');
    }
});
async function initializeDataTables() {
    try {
        let tokenarr = await getCsrfTokens(8);
        const promises = [
            initializeFirstDataTable(tokenarr[0]),
            initializeSecondDataTable(tokenarr[1]),
            initialize3rdDataTable(tokenarr[2]),
            initialize4thDataTable(tokenarr[3]),
            initialize5thDataTable(tokenarr[4])
        ];
        await Promise.all(promises);
        panggillantai();
    } catch(error) {
        toastr["error"]("Gagal mendapatkan token CSRF.");
    }
}
function initializeFirstDataTable(token1) {
    $("#tabel_pesanananmeja_kasir").DataTable({
        language: {
            "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
        },
        scrollCollapse: true,
        scrollY: "100vh",
        scrollX: true,
        bFilter: true,
        destroy: true,
        ajax: {
            "url": baseurljavascript + 'resto/ajaxdetailpesanan',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = token1;
                d.KODEMEJA = "";
                d.PROSESDARI = 'kasir';
                d.TANGGALAWAL = $('#filtertanggalreservasiawal').val().split("-").reverse().join("-");
                d.TANGGALAKHIR = $('#filtertanggalreservasiakhir').val().split("-").reverse().join("-");
            },
        }
    });
}
function initializeSecondDataTable(token2) {
    $("#kasir_daftarnotapending").DataTable({
        retrieve: true,
        ordering: true,
        order: [[0, 'desc']],
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        ajax: {
            "url": baseurljavascript + 'penjualan/daftarnotapending',
            "type": "POST",
            "data": function (d) {
                d.csrf_aciraba = token2;
                d.KATAKUNCIPENCARIAN = $("#txtpencariannotapending").val();
            }
        },
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false,
        columnDefs: [
            {className: "text-right",targets: [1,2]},
        ],
    }); 
} 
function initialize3rdDataTable(token3) {
    $("#kasir_daftarmember").DataTable({
        retrieve: true,
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        ajax: {
            "url": baseurljavascript + 'masterdata/ajaxdaftarmemberkasir',
            "type": "POST",
            "data": function (d) {
                d.csrf_aciraba = token3;
                d.KATAKUNCI = $("#textpencarianmemberkasir").val();
                d.KODEUNIKMEMBER = session_kodeunikmember;
                d.DATAKE = 0;
                d.LIMIT = 50;
            }
        },
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false
    });
} 
function initialize4thDataTable(token4) {
    $("#kasir_daftarsalesman").DataTable({
        retrieve: true,
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        ajax: {
            "url": baseurljavascript + 'masterdata/ajaxdaftarsalesman',
            "type": "POST",
            "data": function (d) {
                d.csrf_aciraba = token4;
                d.KATAKUNCI = $("#textpencariansuplierkasir").val();
                d.KODEUNIKMEMBER = session_kodeunikmember;
                d.DATAKE = 0;
                d.LIMIT = 50;
            }
        },
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false
    });
}
function initialize5thDataTable(token5) {
    $("#kasir_daftarpenjualan").DataTable({
        retrieve: true,
        ordering: true,
        order: [[0, 'desc']],
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        ajax: {
            "url": baseurljavascript + 'penjualan/ajaxdaftarpenjualankasir',
            "type": "POST",
            "data": function (d) {
                d.csrf_aciraba = token5;
                d.KATAKUNCIPENCARIAN = $("#txtpencariannota").val();
                d.TANGGALAWAL = $("#tanggalawalnota").val().split("-").reverse().join("-");
                d.TANGGALAKHIR = $("#tanggalakhirnota").val().split("-").reverse().join("-");
                d.DATAKE = 0;
                d.LIMIT = 50;
            }
        },
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false,
        columnDefs: [
            {className: "text-right",targets: [2]},
            {targets: [0],visible: false
            },
        ],
    }); 
}
function daftartempatdisewakan(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'resto/ajaxpanggillantai',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
            },
            success: function (response) {
                if (response.success == "true"){
                    let htmlnya = "";
                    htmlnya = "<div class=\"nav nav-lines portlet-nav\" id=\"portlet1-tab\">";
                    for (let i = 0; i < response.totaldata; i++) {
                        if (i == 0){
                            panggilmeja(response.dataquery[i].LANTAI, $("#kontendaftarmejad").attr('id'),'list')
                        }
                        htmlnya += "<a class=\"nav-item nav-link\" onclick=\"panggilmeja('"+response.dataquery[i].LANTAI+"',"+$("#kontendaftarmejad").attr('id')+",'list')\" id=\"portlet1-home-tab\" data-toggle=\"tab\" href=\"javascript:void(0)\">"+response.dataquery[i].LANTAI+"</a>";
                    }    
                    htmlnya += "</div>";
                    $('#daftarlantaitersediad').html("");
                    $('#daftarlantaitersediad').html(htmlnya);
                }else{
                    Swal.fire({
                        title: "Informasi Reservasi",
                        text: response.msg,
                        icon: 'error',
                    });
                }
            }
        });
        $("#daftartempatdisewakan").modal('show');
    });
}
function panggilmeja(lantai,idElement,dari){ 
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
                        htmlnya += ""
    +"<div class=\"col-md-3 card>"
            +"<div class=\"card-body\">"
            +"<img style=\"object-fit: cover; height:250px\"  src=\""+(response.dataquery[i].GAMBAR == "" ? "https://i.ibb.co/d6FsfBx/arti-reservasi-jenis-jenis-manfaat-leng-867483.jpg"  : response.dataquery[i].GAMBAR)+"\" class=\"mb-2 card-img-top mt-2 rounded img-responsive\" alt=\""+response.dataquery[i].KODEMEJA+"\">"
                +"<h5 class=\"card-title\">MEJA : "+response.dataquery[i].NAMAMEJA+" ["+response.dataquery[i].KODEMEJA+"]</h5>"
                +"<p class=\"card-text\">"
                +"Status Meja : <span style=\""+posisi+"\">"+pesan+"</span><br>"
                +"Status Jam Kosong : <span style=\""+posisi+"\">"+time_convert(response.dataquery[i].TOTALJAM - nameArr[1])+"</span><br>"
                +"Total Jam Pesanan : <span style=\""+posisi+"\">"+time_convert(nameArr[1])+"</span><br>"
                +"Dipesan Untuk : <span style=\""+posisi+"\">"+nameArr[0]+" Orang</span><br>"
                +"<p class=\"card-text\">Informasi Meja : <span style=\"color:red\">"+response.dataquery[i].KETERANGAN+"</span></p>"
                +"</p>"
                +"<div class=\"btn-group btn-block\">"
                    +"<button onclick=\"detailpesanan('"+response.dataquery[i].KODEMEJA+"','kasir')\" class=\"btn btn-primary\"><i class=\"fas fa-search\"></i> Lihat Detail </button>"
                    +"<button "+(dari == "list" ? "hidden" : "" )+" onclick=\"pilihmejainikasir('"+response.dataquery[i].KODEMEJA+"')\" class=\"btn btn-success\"><i class=\"fas fa-add\"></i> Pilih Meja Ini </button>"
                +"</div>"
            +"</div>"
                    }    
                    htmlnya += "</div>";
                    $(idElement).html("");
                    $(idElement).append(htmlnya);
                }else{
                    Swal.fire({
                        title: "Gagal... Membaca Database",
                        text: "Silahkan cek log database anda. Kali aja ada yang typo dalam penulisan QUERY",
                        icon: 'error',
                    });
                }
            }
        });
    });
}
function pilihmejainikasir(kodemeja){
    $("#kodemejaterpilih_rev").val(kodemeja)
}
function batalkanpesanantempat(prosesdari,kodepesanantempat,pemesan,tanggal){
    swal.fire({
        title: "Wah.. Pembatalan Kode Pesan : "+kodepesanantempat+" ?",
        text: "Yahh.. yakin nih mau dibatalkan pemesanan tempatnya TANGGAL "+tanggal+". Apa Kasir tidak diarahkan telebih dahulu gitu customernya dengan NAMA : "+pemesan+" ?",
        icon:"question",
        showCancelButton:true,
        confirmButtonText: "Ok.. Saya Yakin",
        cancelButtonText: "Ooops.. Gak Jadi!!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'resto/updatestatuspemesanan',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        PROSESDARI : prosesdari,
                        KODEMEJA : kodepesanantempat,
                    },
                    success: function (response) {
                        getCsrfTokenCallback(function() {
                            $('#tabel_pesanananmeja_kasir').DataTable().ajax.reload();
                        });
                        Swal.fire({
                            title: "Pembatalan Berhasil",
                            text: "Pemesan dengan NAMA : "+pemesan+" telah dibatalkan oleh SISTEM. Batas waktu kursi pada TANGGAL "+tanggal+" telah berkurang dan dapat digunakan disi oleh pemesan lain",
                            icon: 'success',
                        });
                    }
                });
            });
        }
    })
}
function transaksibaru(){
    kosongkankeranjanglokal();
    setTimeout(function (){
        location.href = baseurljavascript+"penjualan/kasir/";
    }, 50);
}
function toastinformasidpkonfirmasi(){
    toastr.options = {newestOnTop: true,};
    toastr["info"]("Informasi yang disajikan adalah informasi pembantu guna KASIR dapat mengingatkan DP yang dibayarkan pelanggan saat reservasi");
}
$("#nominaltunai, #nominalkredit, #nomorkartudebit, #nomorkartukredit, #nominalemoney").on('keyup change input propertychange paste onkeydown', function() { proseskonfirmasipembelian(); });
$("#nominaltunai, #nominalkredit, #nomorkartudebit, #nomorkartukredit, #nominalemoney").on("click", function () { selectAllText($(this)) });
let kembalian = 0, ktotalbelanja = 0
function proseskonfirmasipembelian(daricallback){
    setTimeout(function (){
        ktotalbelanja = Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim())
        ktunai = (nominaltunai.getNumber() + nominaluangmukares.getNumber())
        kkredit = nominalkredit.getNumber()
        kkartudebit = nomorkartudebit.getNumber()
        kkartukredit = nomorkartukredit.getNumber()
        kemoney = nominalemoney.getNumber()
        kembalian = (ktunai + kkredit + kkartudebit + kkartukredit + kemoney) - (ktotalbelanja)
        nominaltotalbayar.set((ktunai + kkredit + kkartudebit + kkartukredit + kemoney))
        nominalkembalian.set(kembalian)
        if (daricallback == 1){
            simpantransaksi()
        }
      }, 100);
}
$("#btnsimpantransaksi").click(function() {
    simpantransaksi()
});
$("#btnsimpanpaygateway").click(function() {
    simpantranskasipaygateway()
});
function restorenotapending(keterangan){
    swal.fire({
        title: "Pilih Nota Pending",
        icon: 'warning',
        text: "Apakah anda ingin memilih nota ini dengan INFORMASI KETERANGAN: "+keterangan+" untuk dijadikan transaksi utama ?. TRANSAKSI PENDING INI AKAN DIHAPUS SETELAH ANDA MEMILIHNYA. Silahkan simpan transaksi pending ulang lagi jika ingin menyimpan lagi.",
        //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
        //imageHeight: 150,
        showCancelButton:true,
        confirmButtonText: "Oke Siap",
        cancelButtonText: "Skip. Tidak jadi!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/pendingkekeranjang',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        KETERANGAN :keterangan,
                    },
                    success: function (response) {
                        let obj = JSON.parse(response);
                        if (obj.status == "true"){
                            swal.fire({
                                title: "Transaksi Ke Keranjang",
                                icon: 'success',
                                text: "Oke, barang pada notapending sudah dialihkan ke keranjang utama, silahkan lanjutkan transaksi yang sempat tertunda",
                                //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
                                //imageHeight: 150,
                                showCancelButton:false,
                                confirmButtonText: "Ye... Lanjutkankan Transaksi",
                            }).then(function(result){
                                if(result.isConfirmed){
                                    loadkeranjangsementara();
                                    $('#daftarnotapending').modal('toggle');
                                }
                            })   
                        }else{
                            Swal.fire({
                                title: "Gagal... Cek Koneksi Database Lokal",
                                text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
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
function daftarnotapending(){
    $('#kasir_daftarnotapending').DataTable().ajax.reload();
    $("#daftarnotapending").on('shown.bs.modal', function(){
        setTimeout(function (){
            $("#txtpencariannotapending").focus();
        }, 150);
    }).modal('show');
}
function simpantransaksipending(){
    proseskonfirmasipembelian()
    if ($('#keterangantransaksi').val() == ""){
        $('#keterangantransaksi').focus();
        Swal.fire({
            title: "Terjadi Kesalahan",
            text: "Silahkan isikan keterangan sebagai penanda NOTA PENDING agar mudah dalam pencarian kembali",
            icon: 'warning',
        });
        return false
    }
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/tambahkeranjangpending',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KETERANGANTRX : $('#keterangantransaksi').val(),
            },
            success: function (response) {
                let obj = JSON.parse(response);
                if (obj.status == "true"){
                    swal.fire({
                        title: "Transaksi Nota Pending",
                        icon: 'success',
                        text: "Transaksi nota pending berhasil disimpan di komputer ini. Yuk silahkan untuk melanjutkan transaksi berikutnya",
                        //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
                        //imageHeight: 150,
                        showCancelButton:false,
                        confirmButtonText: "Ye... Lanjutkan Transaksi Lain",
                    }).then(function(result){
                        if(result.isConfirmed){
                            refreshpage();
                        }
                    })   
                }else{
                    Swal.fire({
                        title: "Gagal... Cek Koneksi Database Lokal",
                        text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
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
function cetakulangnota(nomortransaksi, kodeai){
    keranjangarray = []
    inforkartubarang = []
    swal.fire({
        title: "Mau Cetak Ulang Nota ?",
        icon: 'question',
        text: "Apakah anda ingin mencatak ulang nota dengan NO TRANSAKSI "+nomortransaksi+" ini ?",
        showCancelButton:true,
        confirmButtonText: "Cetak Nota ini",
        cancelButtonText: "Skip. Tidak cetak nota!",
    }).then(function(result){
        if(result.isConfirmed){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/cetakulangtransaksikasir',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        KODEAI : kodeai,
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            for (let i = 0; i < response.totaldata; i++) {
                                Object.keys(response.dataquery[i]).forEach(function(k){
                                    if (k == "NAMABARANG" || k == "HARGAJUAL") inforkartubarang.push(response.dataquery[i][k])
                                    if (k == "PRINCIPAL_ID") inforkartubarang.push((response.dataquery[i]["HARGAJUAL"] * response.dataquery[i]["STOKBARANGKELUAR"]))
                                    if (k == "DARIPERUSAHAAN" || k == "FK_BARANG" || k == "STOKBARANGKELUAR") inforkartubarang.push(response.dataquery[i][k])
                                });
                                keranjangarray.push(inforkartubarang)
                                inforkartubarang = []
                            }
                            $.ajax({
                                url: baseurljavascript + 'penjualan/cetaknota',
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    INFORMASIBARANG : JSON.stringify(keranjangarray),
                                    NOTAPENJUALAN : response.dataquery[0].PK_NOTAPENJUALAN,
                                    NAMAMEMBER : response.dataquery[0].NAMAMEMBER,
                                    NAMASALESMAN : response.dataquery[0].NAMASALESMAN,
                                    TGLKELUAR : moment(response.dataquery[0].TGLKELUAR).format('DD-MM-YYYY'),
                                    WAKTU : response.dataquery[0].WAKTU,
                                    KETERANGAN : response.dataquery[0].KETERANGAN,
                                    NOMINALTUNAI : response.dataquery[0].NOMINALTUNAI,
                                    NOMINALKREDIT : response.dataquery[0].NOMINALKREDIT,
                                    NOMINALKARTUDEBIT : response.dataquery[0].NOMINALKARTUDEBIT,
                                    NOMORKARTUDEBIT :  response.dataquery[0].NOMORKARTUDEBIT,
                                    BANKDEBIT :  response.dataquery[0].BANKDEBIT,
                                    NOMINALKARTUKREDIT :  response.dataquery[0].NOMINALKARTUKREDIT,
                                    NOMORKARTUKREDIT :  response.dataquery[0].NOMORKARTUKREDIT,
                                    BANKKREDIT :  response.dataquery[0].BANKKREDIT,
                                    NOMINALEMONEY :  response.dataquery[0].NOMINALEMONEY,
                                    NAMAEMONEY :  response.dataquery[0].NAMAEMONEY,
                                    NOMINALPOTONGAN :  response.dataquery[0].NOMINALPOTONGAN,
                                    NOMINALPAJAKKELUAR :  response.dataquery[0].NOMINALPAJAKKELUAR,
                                    KEMBALIAN:  response.dataquery[0].KEMBALIAN,
                                    TOTALBELANJA:  response.dataquery[0].TOTALBELANJA,
                                    PAJAKTOKO :  response.dataquery[0].PAJAKTOKO,
                                    PAJAKNEGARA :  response.dataquery[0].PAJAKNEGARA,
                                    POTONGANGLOBAL :  response.dataquery[0].POTONGANGLOBAL,
                                    NOMINALBAYAR:  response.dataquery[0].TOTALBELANJA + response.dataquery[0].KEMBALIAN,
                                    NAMAPENGGUNA :  response.dataquery[0].USERNAMELOGIN,
                                },
                                success: function (response) {
                                    let obj = JSON.parse(response);
                                    if (obj.status == "true"){
                                        refreshpage();
                                    }
                                }
                            });
                        }
                    }
                });
            });
        }
    })   
}

function ambilinformasikeranjang(){
    keranjangarray = [],inforkartubarang = []
    indexsubarray = 0
    timenow = moment().format('HH:mm:ss');
    testContainer = document.querySelector('#keranjangbelanja')
    fourChildNode = testContainer.querySelectorAll('.informasibarang, input')
    fourChildNode.forEach((element,index) => {
        if (element.firstChild != null){
            if (element.firstChild.nodeValue === "===="){
                keranjangarray.push(inforkartubarang);
                inforkartubarang = []
                indexsubarray = indexsubarray + 1
            }else{
                let regexjson = new RegExp(/[{\[]{1}([,:{}\[\]0-9.\-+A-zr-u \n\r\t]|".*:?")+[}\]]{1}/);
                    if (element.firstChild.nodeValue !== "===="){
                        if (regexjson.test(element.firstChild.nodeValue)){
                            inforkartubarang.push(element.nodeName == "INPUT" ? element.defaultValue : btoa(element.firstChild.nodeValue));
                        }else{
                            inforkartubarang.push(element.nodeName == "INPUT" ? element.defaultValue : element.firstChild.nodeValue.replace('Rp', '').replaceAll('.', '').replace(',', '.').trim());
                        }
                    }
                
            }       
        }
    });
}
function convertToItemDetails(pg,array) {
    return array.map(item => {
        if (pg == "duitku"){
            return {
                name: item[0],
                price: parseFloat(item[1]),
                quantity: parseInt(item[6])
            };
        }
    });
}
function simpantranskasipaygateway(){
    //ambilinformasikeranjang()
    $("#btnsimpanpaygateway").html("<i class=\"fa-solid fa-spinner fa-spin-pulse\" style=\"color: #ff0000;\"></i> [F6] Membuat QRIS");
    $("#btnsimpanpaygateway").prop('disabled', true);
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'paymentgateway/qris',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                VENDOR: "duitku",
                NAMAMEMBER: $("#namamember").html(),
                EMAIL: $("#emailpelanggan").html(),
                NOKONTAK: $("#nokontakpelanggan").html(),
                ITEMS : /*convertToItemDetails("duitku",keranjangarray),*/"",
                ORDERID : $('#notakasirpenjualan').html(),
                TOTALBELANJA: Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),
            },
            success: function (response) {
                if (response.status != 200 ){
                    if (response.statusCode !== "00"){
                        return toastr["error"]("Terdapat kesalahan dengan kode error : "+response.status+". Silahkan hubungi momod");
                    }
                }
                var countdownElement = document.getElementById("durasiscanqris");
                countdownTimeStartMinutes(48, countdownElement);
                var options = { 
                    text: response.qrString,
                    correctLevel: QRCode.CorrectLevel.H
                };
                new QRCode(document.getElementById("qrcodeclosepayment"), options);
                $("#btncektransaksipayment").html('<i class="fas fa-vote-yea ms-2"></i> Cek Transaksi '+response.reference)
                $("#labelscanqris,#qrcodeclosepayment,#btncektransaksipayment,#durasiscanqris").show()
                $("#qrcodeclosepayment").css({ "display": "block", "margin": "0 auto" });
                $("#btnsimpanpaygateway").html("<i class=\"fa-solid fa-spinner fa-spin-pulse\" style=\"color: #ff0000;\"></i> [F6] Silahkan Scan QRIS");
            },
            error: function (request, status, error) {
                console.log(error)
            }
        });
    });
}
function simpantransaksi(){
    $("#btnsimpantransaksi").html("<i class=\"fa-solid fa-spinner fa-spin-pulse\" style=\"color: #ff0000;\"></i> [END] Sedang Proses");
    $("#btnsimpantransaksi").prop('disabled', true);
    if (tipeordernya == 1 && ($('#berapaorang_rev').val() == "" || $('#namapemesan_rev').val() == "" || $('#notelp_rev').val() == "" || $('#kodemejaterpilih_rev').val() == "")){
        $("#btnsimpantransaksi").html("<i class=\"fa fa-print ms-2\"></i> [End] Simpan + Cetak");
        $("#btnsimpantransaksi").prop('disabled', false);
        Swal.fire({
            title: "Terjadi Kesalahan",
            icon: 'error',
            text: "Formulir reservasi masih belum lengkap. Silahkan lengkapo formulir terlebih dahulu seperti NAMA PEMESAN, NO KONTAK , MEJA atau BANYAKNYA PERSONIL",
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 1000)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        })
        return false
    }
    if ($("#kredit").is(':checked') && $('#idmember').html() == '1001' && tipeordernya != 1 && tipeordernya != 2){
        $("#btnsimpantransaksi").html("<i class=\"fa fa-print ms-2\"></i> [End] Simpan + Cetak");
        $("#btnsimpantransaksi").prop('disabled', false);
        Swal.fire({
            title: "Terjadi Kesalahan",
            icon: 'error',
            text: "Fitur pembayaran kredit hanya tersedia untuk MEMBER saja. Silahkan tawarkan menjadi MEMBER di toko anda untuk mendapatkan fitur ini",
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 1000)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        })
        return false
    }
    if (nominalkembalian.getNumber() < 0 && !$("#kredit").is(':checked')){
        $("#btnsimpantransaksi").html("<i class=\"fa fa-print ms-2\"></i> [End] Simpan + Cetak");
        $("#btnsimpantransaksi").prop('disabled', false);
        return Swal.fire({
            title: "Terjadi Kesalahan",
            icon: 'error',
            text: "Nominal pembayaran masih kurang sebesar "+formatuang(nominalkembalian.getNumber(),'id-ID','IDR')+". Silahkan cek kembali nominal masukan anda",
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 1000)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        })
    }
    ambilinformasikeranjang()
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/simpantransaksi',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                INFORMASIBARANG : JSON.stringify(keranjangarray),
                ADADATA: indexsubarray,
                PK_NOTAPENJUALAN : $('#notakasirpenjualan').html(),
                FK_MEMBER : $('#idmember').html(),
                FK_SALESMAN : $('#idsalesman').html(),
                ENUM_JENISTRANSAKSI : jenistransaksienum,
                JATUHTEMPO : $('#lamajatuhtempo').html(),
                LOKASI : session_outlet,
                TGLKELUAR : $('#tanggaltrxfield').val().split("-").reverse().join("-"),
                WAKTU : timenow,
                KASIR : session_pengguna_id,
                NOMORNOTA : $('#notakasirpenjualan').html().split('#')[1],
                KETERANGAN : $('#keterangantransaksi').val(),
                KODEUNIKMEMBER : session_kodeunikmember,
                NOMINALTUNAI : nominaltunai.getNumber(),
                NOMINALKREDIT : nominalkredit.getNumber(),
                NOMINALKARTUDEBIT : nomorkartudebit.getNumber(),
                NOMORKARTUDEBIT : $('#nomorkartudebitdantrx').val(),
                BANKDEBIT : $('#idkartudebit').html(),
                NOMINALKARTUKREDIT : nomorkartukredit.getNumber(),
                NOMORKARTUKREDIT : $('#nomorkartukreditdantrx').val(),
                BANKKREDIT : $('#idkartukredit').html(),
                NOMINALEMONEY : nominalemoney.getNumber(),
                NAMAEMONEY : $('#idemoney').html(),
                NOMINALPOTONGAN : nominalpotongan.getNumber(),
                NOMINALPAJAKKELUAR : 0,
                KEMBALIAN: nominalkembalian.getNumber(),
                TOTALBELANJA: Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),
                ISEDITKASIR : iseditkasir,
                PAJAKTOKO : nominalpajaktoko.getNumber(),
                PAJAKNEGARA : nominalpajaknegara.getNumber(),
                POTONGANGLOBAL : nominalpotongan.getNumber(),
                TIPETRANSAKSI : tipeordernya,
                /*jika pesanan tipe oerder 1 */
                KODEPESAN : $('#kodepesan_rev').val(),
                KODEMENUPESANAN : $('#kodemenupesan_rev').val(),
                KODEMEJA : $('#kodemejaterpilih_rev').val(),
                PEMESAN : $('#namapemesan_rev').val(),
                NOTELEPON : $('#notelp_rev').val(),
                UNTUKBERAPAORANG : $('#berapaorang_rev').val(),
                TOTALBELANJA : Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),
                DP : dp_rev.getNumber(),
                TANGGAL : $('#tanggalawal_rev').val().split("-").reverse().join("-"),
                WAKTUAWAL : $('#waktuawal_rev').val(),
                TANGGALAKHIR : $('#tanggalakhir_rev').val().split("-").reverse().join("-"),
                WAKTUAKHIR : $('#waktuselesai_rev').val(),
                NOMOR : $('#notakasirpenjualan').html().split('#')[1],
                WARNAMEMO : $('#warnamemo_rev').val(),
                STATUSPESAN : 1 ,
            },
            success: function (response) {
                $('#modalkonfirmasipembayaran').modal('toggle');
                if (response.hasiljson[0].success == "true"){
                    let refreshPromise = new Promise(function(resolve, reject) {refreshpage();resolve();});
                    swal.fire({
                        title: "Hore.. Transaksi Berhasil!!",
                        icon: 'success',
                        text: response.hasiljson[0].msg,
                        //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
                        //imageHeight: 150,
                        showCancelButton:true,
                        confirmButtonText: "Cetak Nota ini",
                        cancelButtonText: "Skip. Tidak cetak nota!",
                    }).then(function(result){
                        $("#btnsimpantransaksi").html("<i class=\"fa fa-print ms-2\"></i> [End] Simpan + Cetak");
                        $("#btnsimpantransaksi").prop('disabled', false);
                        if(result.isConfirmed){
                            getCsrfTokenCallback(function() {
                                $.ajax({
                                    url: baseurljavascript + 'penjualan/cetaknota',
                                    method: 'POST',
                                    dataType: 'json',
                                    data: {
                                        [csrfName]:csrfTokenGlobal,
                                        INFORMASIBARANG : JSON.stringify(keranjangarray),
                                        NOTAPENJUALAN : $('#notakasirpenjualan').html(),
                                        NAMAMEMBER : $('#namamember').html(),
                                        NAMASALESMAN : $('#namasalesman').html(),
                                        TGLKELUAR : $('#tanggaltrxfield').val(),
                                        WAKTU : timenow.replaceAll('.', ':'),
                                        KETERANGAN : $('#keterangantransaksi').val(),
                                        NOMINALTUNAI : nominaltunai.getNumber(),
                                        NOMINALKREDIT : nominalkredit.getNumber(),
                                        NOMINALKARTUDEBIT : nomorkartudebit.getNumber(),
                                        NOMORKARTUDEBIT : $('#nomorkartudebitdantrx').val(),
                                        BANKDEBIT : $('#idkartudebit').html(),
                                        NOMINALKARTUKREDIT : nomorkartukredit.getNumber(),
                                        NOMORKARTUKREDIT : $('#nomorkartukreditdantrx').val(),
                                        BANKKREDIT : $('#idkartukredit').html(),
                                        NOMINALEMONEY : nominalemoney.getNumber(),
                                        NAMAEMONEY : $('#idemoney').html(),
                                        NOMINALPOTONGAN : nominalpotongan.getNumber(),
                                        NOMINALPAJAKKELUAR : 0,
                                        KEMBALIAN: nominalkembalian.getNumber(),
                                        TOTALBELANJA: Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),
                                        PAJAKTOKO : nominalpajaktoko.getNumber(),
                                        PAJAKNEGARA : nominalpajaknegara.getNumber(),
                                        POTONGANGLOBAL : nominalpotongan.getNumber(),
                                        NOMINALBAYAR: (Number($('#totalbelanjakonfirmasi').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()) + nominalkembalian.getNumber()),
                                        NAMAPENGGUNA: session_namapengguna,
                                        KODESOCKETPRINT : localStorage.getItem("KODESOCKETPRINTER"),
                                    },
                                    success: function (response) {
                                    }
                                });
                            });
                            if (iseditkasir == "true"){
                                refreshPromise.then(function() {location.href = baseurljavascript+"penjualan/kasir/";});
                            }   
                        }else{
                            if (iseditkasir == "true"){
                                refreshPromise.then(function() {location.href = baseurljavascript+"penjualan/kasir/";});
                            }
                        }
                    })   
                }else{
                    Swal.fire({
                        title: "Terjadi Kesalahan",
                        text: response.hasiljson[0].msg,
                        icon: 'error',
                    });
                    $("#btnsimpantransaksi").html("<i class=\"fa fa-print ms-2\"></i> [End] Simpan + Cetak");
                    $("#btnsimpantransaksi").prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
                $("#btnsimpantransaksi").html("<i class=\"fa fa-print ms-2\"></i> [End] Simpan + Cetak");
                $("#btnsimpantransaksi").prop('disabled', false);
            }
        });
    });
}
function refreshpage(){
    bersihkanformmodal()
    kosongkankeranjanglokal();
    loadnotakasir();
    loaddaftarbarang();
    $('#katakuncipencariankasir').focus();
    $('#keranjangkosong').html('<div style="position: absolute;top: 8%; bottom: 0; left: 0; right: 0;margin: auto;" class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Keranjang Belanja Anda Masih Kosong Lo... Silahkan Pilih Item Untuk di Transkasi</h4><!-- BEGIN Avatar --><div class="avatar avatar-label-primary avatar-circle widget12 mb-4"><div class="avatar-display"><i class="fas fa-cart-arrow-down"></i></div></div><!-- END Avatar --><a href="javascript:void(0)" class="btn btn-primary btn-wider">Pilih Barang</a></div>');
    $('#namamember').html("Member Umum");
    $('#idmember').html("1001");
    $('#namasalesman').html("Salesman Umum");
    $('#idsalesman').html("SLS1");
    $('#tanggaltrxfield').val(moment().format('DD-MM-YYYY'));
    $("#tanggaltrxfield").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#keterangantransaksi').val();
    nominalpotongan.set(0)
    nominalpajaktoko.set(0)
    nominalpajaknegara.set(0)
    nominaltotalbayar.set(0)
    tipeordernya = 0;
}
function keybindenterkonfirmasipembayaran(idtextfield){
    if($("#tunai").is(':checked')) {
        if(idtextfield == "nominaltunai"){ $('#btnsimpantransaksi').focus(); return false }
    }else if($("#kredit").is(':checked')){
        if(idtextfield == "nominalkredit"){ $('#btnsimpantransaksi').focus(); return false }
    }else if($("#kartu").is(':checked')) {
        if(idtextfield == "nomorkartudebit"){ $('#nomorkartukredit').focus();$('#nomorkartukredit').select();return false }
        if(idtextfield == "nomorkartukredit"){ $('#nominalemoney').focus();$('#nominalemoney').select();return false }
        if(idtextfield == "nominalemoney"){ $('#btnsimpantransaksi').focus();return false }
    }else if($("#splitcash").is(':checked')) { 
        if(idtextfield == "nominaltunai"){ $('#nomorkartudebit').focus();$('#nomorkartudebit').select();return false }
        if(idtextfield == "nomorkartudebit"){ $('#nomorkartukredit').focus();$('#nomorkartukredit').select();return false }
        if(idtextfield == "nomorkartukredit"){ $('#nominalemoney').focus();$('#nominalemoney').select();return false }
        if(idtextfield == "nominalemoney"){ $('#btnsimpantransaksi').focus();return false }
    }
}
function loadnotakasir(){
    if (iseditkasir == "false"){
        getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'penjualan/notamenupenjualan',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]:csrfTokenGlobal,
                    AWALANOTA : "PJ",
                    OUTLET: session_outlet,
                    KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                    TANGGALSEKARANG: moment().format('YYYYMMDD'),
                    KODEUNIKMEMBER: session_kodeunikmember,
                },
                success: function (response) {
                    $('#notakasirpenjualan').html(response.nomornota);
                }
            });
        });
    }
}
function loadnotareservasi(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/notamenupenjualan',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                AWALANOTA : "MJ",
                OUTLET: session_outlet,
                KODEKUMPUTERLOKAL: localStorage.getItem("KODEKASA"),
                TANGGALSEKARANG: moment().format('YYYYMMDD'),
                KODEUNIKMEMBER: session_kodeunikmember,
            },
            success: function (response) {
                $('#kodepesan_rev').val(response.nomornota);
            }
        });
    });
}
function loadkeranjangsementara(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/bacakeranjangkasir',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.adadata === "ada"){
                    let namavariannya = "";
                    Object.entries(obj.datakeranjang).forEach(([key, value]) => {
                        let kondisiicon = "",textfieldnya = "<h1>"+value.QTY+"</h1>";
                        let objjsonStrjenisvarian = JSON.parse(atob(value.JSONTAMBAHAN));
                        if (value.STATUSBARANGPROSES == "-3"){
                            kondisiicon = "<div class=\"avatar-display\"><i style=\"color:green;font-size:20px\" class=\"fas fa-solid fa-circle-check fa-fade fa-xl\"></i></div>";
                        }else if (value.STATUSBARANGPROSES == "-2"){
                            kondisiicon = "<div class=\"avatar-display\"><i style=\"color:green;font-size:20px\" class=\"fas fa-solid fa-utensils fa-fade fa-xl\"></i></div>";
                        }else if (value.STATUSBARANGPROSES == "-1"){
                                kondisiicon = "<div class=\"avatar-display\"><i style=\"color:green;font-size:20px\" class=\"fas fa-solid fa-spell-check fa-fade fa-xl\"></i></div>";
                        }else if (value.STATUSBARANGPROSES == "1"){
                            kondisiicon = "<div class=\"avatar-display\"><i style=\"color:red;font-size:20px\" class=\"fas fa-solid fa-hourglass-half fa-fade fa-xl\"></i></div>";
                        }else if (value.STATUSBARANGPROSES == "0"){
                            kondisiicon = "<div class=\"avatar-display\"><i style=\";font-size:20px\" class=\"fas fa-solid fa-boxes-packing fa-xl\"></i></div>";
                            textfieldnya = "<input id=\"barangkeluarqty"+value.BARANG_ID+"\" class=\"qtyformat form-control form-control-lg\" type=\"text\" value=\""+value.QTY+"\">";
                        }
                        Object.entries(objjsonStrjenisvarian).forEach(([key, value]) => {
                            value.forEach((variandetail) => {
                                namavariannya += variandetail.namavarian+" ("+variandetail.qty+"x) , "
                            })
                        })
    let prependHTML = ""
    +"<div id=\"barisbelanja"+value.BARANG_ID+"\" class=\"portlet mb-1\">"
        +"<div class=\"rich-list-item flex-column align-items-stretch\"><div class=\"rich-list-item p-0\">"
            +"<div class=\"rich-list-prepend\">"
                +"<div class=\"avatar\">"+kondisiicon+"</div>"
            +"</div>"
        +"<div class=\"rich-list-content\">"
            +"<h4 class=\"rich-list-title\"><span class=\"informasibarang\" id=\"namabarang"+value.BARANG_ID+"\">"+value.NAMA_BARANG+"</span></h4>"
            +"<span class=\"rich-list-subtitle\">HJ @<span class=\"informasibarang\" id=\"hargajual"+value.BARANG_ID+"\">"+formatter.format(value.HARGA_JUAL)+"</span>"
            +"<span style=\"display:none\" style=\"display:none\" id=\"hargajualasli"+value.BARANG_ID+"\">"+value.HARGAASLI+"</span>"
        +"</div>"
        +"<div class=\"rich-list-append\">"
            +"<button onclick=\"modalinfobarang('"+value.BARANG_ID+"','"+value.HARGAASLISEMENTARA+"','"+value.KETERANGAN+"','"+value.HARGAASLI+"','"+value.STATUSBARANGPROSES+"')\" style=\"margin-right:5px\" class=\"btn btn-label-success\"><i class=\"fa fa-bars\"></i>"+(value.APAKAHVARIAN == "AKTIF" ? "<div class=\"btn-marker\"><i class=\"marker marker-dot text-success\"></i></div>" : "")+"</button>"
            +"<button onclick=\"hapusbarangkeranjang('"+value.BARANG_ID+"','"+value.NAMA_BARANG+"','"+value.STATUSBARANGPROSES+"')\" class=\"btn btn-label-danger\"><i class=\"fas fa-trash\"></i></button>"
        +"</div>"
    +"</div>"
    +"<div class=\"form-group row pt-2\">"
        +"<div class=\"col-md-5\">"+textfieldnya+"</div>"
        +"<div class=\"col-md-7 mt-0\">"
            +"<strong> SUB TOTAL : </strong><br>"
            +"<span class=\"informasibarang\" id=\"subtotalbarang"+value.BARANG_ID+"\">0</span>"
        +"</div>"
        +"<div class=\"ml-3\">"
            +"<h4 class=\"rich-list-title\">VARIAN : <span id=\"varian"+value.BARANG_ID+"\">"+namavariannya+"</span></h4>"
        +"</div>"
    +"</div>"
    +"<div id=\"informasibarangheader\" style=\"display:none\" >"
    +"<div id=\"dariperusahaan"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.DARIPERUSAHAAN+"</div>"
    +"<div id=\"kodebarang"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.BARANG_ID+"</div>"
    +"<div id=\"hargabeli"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.HARGA_BELI.replace('.', ',')+"</div>"
    +"<div id=\"qtylabel"+value.BARANG_ID+"\" class=\"informasibarang\">"+($("#barangkeluarqty"+value.BARANG_ID).val() === undefined ? $("#qtykeluarkasir").val() : (Number($("#barangkeluarqty"+value.BARANG_ID).val()) + Number($("#qtykeluarkasir").val())))+"</div>"
    +"<div id=\"brandlabel"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.BRAND_ID+"</div>"
    +"<div id=\"principallabel"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.PRINCIPAL_ID+"</div>"
    +"<div id=\"stokdapatminuslabel"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.STOKDAPATMINUS+"</div>"
    +"<div id=\"jsonjenisvarian"+value.BARANG_ID+"\" class=\"informasibarang\">"+atob(value.JSONTAMBAHAN)+"</div>"
    +"<div id=\"keterangantiapbarang"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.KETERANGAN+"</div>"
    +"<div id=\"apakahvarian"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.APAKAHVARIAN+"</div>"
    +"<div id=\"hargajualubah"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.HARGAASLISEMENTARA.replace('.', ',')+"</div>"
    +"<div id=\"statusprosesitem"+value.BARANG_ID+"\" class=\"informasibarang\">"+value.STATUSBARANGPROSES+"</div>"
    +"<div class=\"informasibarang\">====</div>"
    +"</div>";
                        $("#keranjangbelanja").prepend(prependHTML);
                        $("#barangkeluarqty"+value.BARANG_ID).TouchSpin({min: 1,max: 999999,decimals: 2,forcestepdivisibility: 'none',}).on('input change', debounce(function (e) {
                            $("#qtylabel"+value.BARANG_ID).html($(this).val().replace('.', ',').trim());
                            updatebarangkerankang(value.BARANG_ID,$(this).val(),value.HARGA_JUAL,value.QTY,0)
                        }, 500));
                        $("#subtotalbarang"+value.BARANG_ID).html(formatter.format(Number(value.HARGA_JUAL) * Number(value.QTY)));
                        $("#qtylabel"+value.BARANG_ID).html(value.QTY.replace('.', ',').trim());
                    });
                }else{
                    $('#keranjangkosong').html('<div style="position: absolute;top: 8%; bottom: 0; left: 0; right: 0;margin: auto;" class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Keranjang Belanja Anda Masih Kosong Lo... Silahkan Pilih Item Untuk di Transkasi</h4><!-- BEGIN Avatar --><div class="avatar avatar-label-primary avatar-circle widget12 mb-4"><div class="avatar-display"><i class="fas fa-cart-arrow-down"></i></div></div><!-- END Avatar --><a href="javascript:void(0)" class="btn btn-primary btn-wider">Pilih Barang</a></div>');
                    $("#keranjangbelanja").html("");
                }
                grandtotalkasir();
            }
        });
    });
}
function loaddaftarbarang(){
    $('#kontenbarang').block();
    $.ajax({
        url: baseurljavascript + 'penjualan/ajaxdaftarbarang',
        method: 'POST',
        dataType: 'json',
        data: {
            DIMANA1 : $('#katakuncipencariankasir').val(),
            DIMANA2 : $('#katakuncikategori').val(),
            DIMANA19 : session_outlet,
        },
        success: function (response) {
            let stopinterval = 0
            let stringhtmldaftarabrang = "", urlgambar = "";
            $("#daftaritemkasir").html("");
            if (response[0].success == "false"){
                return Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    html: 'Informasi item / barang yang anda cari tidak ditemukan.<br>Silahkan gunakna katakunci yang lainnya',
                    showConfirmButton: false,
                    toast:true,
                    timer: 1500
                })
            }
            if($(window).width() < 1600){
                jumlahkolom = 4
            }else{
                jumlahkolom = 3
            }
            stringhtmldaftarabrang += "<div class=\"container\"><div class=\"row\">"
            for (datake = 0; datake < response[0].totaldata; datake++) { 
                let urlgambar = response[0].dataquery[datake].FILENAME == 'not_found' ? baseurljavascript + "images/defaultimage.webp" : baseurljavascript + "upload/citraitem/" + response[0].dataquery[datake].FILENAME;
                
                // Mengganti src menjadi data-src
                stringhtmldaftarabrang += ""
                    + "<div class=\"daftarkeranjangkatalog col-md-" + jumlahkolom + "\" onclick=\"pilihbarang('" + response[0].dataquery[datake].BARANG_ID + "','" + response[0].dataquery[datake].NAMABARANG + "','" + response[0].dataquery[datake].HARGAJUAL + "','" + response[0].dataquery[datake].HARGABELI + "','" + response[0].dataquery[datake].DISPLAY + "','" + response[0].dataquery[0].PEMILIK + "','" + response[0].dataquery[datake].APAKAHBONUS + "','" + response[0].dataquery[datake].STOKDAPATMINUS + "','" + response[0].dataquery[datake].BRAND_ID + "','" + response[0].dataquery[datake].PARETO_ID + "','TIDAK ADA KETERANGAN','" + response[0].dataquery[datake].HARGAJUAL + "','" + response[0].dataquery[datake].HARGAJUAL + "')\" style=\"cursor:pointer;padding: 0 !important;margin: 0 !important;\">"
                    + "<div style=\"padding:5px\">"
                    + "<div class=\"card\">"
                    + "<div class=\"row no-gutters\">"
                    + "<div class=\"col-md-5\">"
                    + "<div class=\"image-container\">"
                    + "<img src=\"" + baseurljavascript + "images/spinnerloading.svg" + "\" data-src=\"" + urlgambar + "\" alt=\"Gambar Produk\" loading=\"lazy\">"
                    + "</div>"
                    + "</div>"
                    + "<div class=\"col-md-7\">"
                    + "<div class=\"card-body\">"
                    + "<h4 class=\"card-text\">" + response[0].dataquery[datake].NAMABARANG + "</h4>"
                    + "<h5 class=\"card-title\"><strong>Kode Item : " + response[0].dataquery[datake].BARANG_ID + "</strong></h5>"
                    + "<h5 class=\"card-title\"><strong>Stok : " + response[0].dataquery[datake].DISPLAY + "</strong></h5>"
                    + "<button style=\"position: absolute;bottom:0;left:20%;right:0\" class=\"btn btn-block btn-primary\"><i class=\"fa-solid fa-circle-info\"></i></i> INFORMASI</button>"
                    + "</div>"
                    + "</div>"
                    + "</div>"
                    + "</div>"
                    + "<div class=\"card row no-gutters\">"
                    + "<div class=\"col-md-12\">"
                    + "<h4 style=\"font-size: 200%;font-family:'digital-clock-font'\" class=\"text-center\"><strong>Harga: " + formatter.format(response[0].dataquery[datake].HARGAJUAL) + "</strong></h4>"
                    + "</div>"
                    + "</div>"
                    + "</div>"
                    + "</div>";
            } 
            stringhtmldaftarabrang += "</div></div>"
            if (response[0].totaldata == 1){
                pilihbarang(response[0].dataquery[0].BARANG_ID, response[0].dataquery[0].NAMABARANG, response[0].dataquery[0].HARGAJUAL, response[0].dataquery[0].HARGABELI, response[0].dataquery[0].DISPLAY, response[0].dataquery[0].PEMILIK, response[0].dataquery[0].APAKAHBONUS, response[0].dataquery[0].STOKDAPATMINUS,response[0].dataquery[0].BRAND_ID,response[0].dataquery[0].PARETO_ID,'TIDAK ADA KETERANGAN',response[0].dataquery[0].HARGAJUAL,response[0].dataquery[0].HARGAJUAL);
                $("#katakuncipencariankasir").val("");
                $("#katakuncipencariankasir").focus();
            }
            $("#daftaritemkasir").html(stringhtmldaftarabrang)
            let lazyImages = document.querySelectorAll('img[data-src]');
            let options = {
                threshold: 0.5
            };

            let lazyLoad = function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        let img = entry.target;
                        img.src = img.dataset.src;
                        img.onload = function() {
                            img.removeAttribute('data-src');
                        };
                        observer.unobserve(img);
                    }
                });
            };

            let observer = new IntersectionObserver(lazyLoad, options);
            lazyImages.forEach(image => {
                observer.observe(image);
            });
        },
        error: function(xhr, status, error) {
            toastr["error"](xhr.responseJSON.message);
        }
    });
    $('#kontenbarang').unblock()
}

let parse_obj;
function cekkeranjang(){
    if(Number($('#grandtotal').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()) <= 0 && tipeordernya != 1){
        return Swal.fire({
            title: "Kesalahan Nominal",
            text: "Silahkan pilih minimal 1 barang untuk dilakukan transaksi keluar atau mungkin nominal anda dalam kondisi MINUS",
            icon: 'warning',
        });
    }else if (tipeordernya == 2 && $('#keterangantransaksi').val() == ""){
        $('#keterangantransaksi').focus();
        return Swal.fire({
            title: "Kesalahan DINE-IN",
            text: "Anda harus mengisi keterangan mengenai Tranaksi DINE-IN seperti NOMOR MEJA, dll",
            icon: 'warning',
        });
    }else if (tipeordernya == 3 && $('#idsalesman').html() == "SLS1"){
        return Swal.fire({
            title: "Kesalahan TAKE AWAY",
            text: "Salesman umum tidak diizinkan, silahkan tentukan nama salesman secara spesifik yang valid",
            icon: 'warning',
        });
    }else{
        $("#modalkonfirmasipembayaran").on('shown.bs.modal', function(){
            setTimeout(function (){
                let totalbelanjakonfirmasi = formatuang(Number($('#grandtotal').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),'id-ID','IDR')
                $('#totalbelanjakonfirmasi').html(totalbelanjakonfirmasi)
                $('#nominaltunai').focus();
                $('#nominaltunai').select();
                if (iseditkasir == "true"){
                    switch(jenistransaksi){
                        case "TUNAI":
                            $("#tunai").attr("checked",true).trigger("change")
                            break;
                        case "KREDIT":
                            $("#kredit").attr("checked",true).trigger("change")
                            break;
                        case "KARTU":
                            $("#kartu").attr("checked",true).trigger("change")
                            break;
                        case "SPLITCASH":
                            $("#splitcash").attr("checked",true).trigger("change")
                            break;
                        default:
                            $("#tunai").attr("checked",true);
                    }
                    $('#nominalpotongan').trigger('input');
                }
                if (iseditkasir == "false"){
                    nominaltunai.set(0);
                    nominalkredit.set(0);
                    nomorkartudebit.set(0);
                    nomorkartukredit.set(0);
                    nominalemoney.set(0);
                    nominalkembalian.set(Number($('#grandtotal').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()) * -1);
                }
                $("#labelscanqris,#qrcodeclosepayment").hide()
                const imgElement = document.getElementById('qrcodeclosepayment')
                imgElement.src = "https://i.imgflip.com/6j0onv.png"
                proseskonfirmasipembelian();
            }, 250);
        }).modal('show');
}
    
}
function subpilihbarang(barangid, namabarang, hargajual, hargabeli, sisastokmaksimal, pemilik, apakahvarian, stokdapatminus, brandid, principalid, keterangantiapbarang, hargajualasli, hargajualaslisementara){
    $('#keranjangkosong').html("");
    if ($("#statusprosesitem"+barangid).html() != 0 && typeof $("#statusprosesitem"+barangid).html() !== "undefined"){
        return Swal.fire({
            title: "Permintaan Proses Ditolak",
            text: "Kami mohon maaf untuk menolak permintaan anda. Karena item sudah dalam STATUS PROSES atau bahkan SUDAH SELESAI",
            icon: 'error',
        });
    }
    timestamp = Math.floor(Date.now() / 1000)
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/tambahkeranjang',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                BARANG_ID: barangid,
                NAMA_BARANG: namabarang,
                QTY: ($("#barangkeluarqty"+barangid).val() === undefined ? $("#qtykeluarkasir").val() : (Number($("#barangkeluarqty"+barangid).val()) + Number($("#qtykeluarkasir").val()))),
                HARGA_JUAL: hargajual,
                HARGA_BELI: hargabeli,
                PPN: '0',
                DARIPERUSAHAAN: pemilik,
                ISEDIT: iseditkasir,
                APAKAHVARIAN: apakahvarian,
                STOKDAPATMINUS: stokdapatminus,
                JSONTAMBAHAN: btoa(jsonStrjenisvarian),
                BRAND_ID: brandid,
                PRINCIPAL_ID: principalid,
                KETERANGAN: keterangantiapbarang,
                HARGAASLI:hargajualasli,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.status == "out_of_stok"){
                    $("#barangkeluarqty"+barangid).val(sisastokmaksimal)
                    grandtotalkasir()
                    return toastr["error"](obj.msg)
                }
                if (obj.status == "true"){
                    let namavariannya = "";
                    let objjsonStrjenisvarian = JSON.parse(jsonStrjenisvarian);
                    Object.entries(objjsonStrjenisvarian).forEach(([key, value]) => {
                        value.forEach((variandetail) => {
                            namavariannya += variandetail.namavarian+" ("+variandetail.qty+"x) , "
                        })
                    })
    let prependHTML = ""
    +"<div id=\"barisbelanja"+barangid+"\" class=\"portlet mb-1\">"
        +"<div class=\"rich-list-item flex-column align-items-stretch\"><div class=\"rich-list-item p-0\">"
            +"<div class=\"rich-list-prepend\">"
                +"<div class=\"avatar\">"
                    +"<div class=\"avatar-display\"><i class=\"fas fa-box\"></i></div>"
                +"</div>"
            +"</div>"
        +"<div class=\"rich-list-content\">"
            +"<h4 class=\"rich-list-title\"><span class=\"informasibarang\" id=\"namabarang"+barangid+"\">"+namabarang+"</span></h4>"
            +"<span class=\"rich-list-subtitle\">HJ @<span class=\"informasibarang\" id=\"hargajual"+barangid+"\">"+formatter.format(hargajual)+"</span>"
            +"<span style=\"display:none\" id=\"hargajualasli"+barangid+"\">"+hargajualasli+"</span>"
        +"</div>"
        +"<div class=\"rich-list-append\">"
            +"<button onclick=\"modalinfobarang('"+barangid+"','"+hargajualaslisementara+"','"+keterangantiapbarang+"','"+hargajualasli+"','0')\" style=\"margin-right:5px\" class=\"btn btn-label-success\"><i class=\"fa fa-bars\"></i>"+(apakahvarian == "AKTIF" ? "<div class=\"btn-marker\"><i class=\"marker marker-dot text-success\"></i></div>" : "")+"</button>"
            +"<button onclick=\"hapusbarangkeranjang('"+barangid+"','"+namabarang+"','0')\" class=\"btn btn-label-danger\"><i class=\"fas fa-trash\"></i></button>"
        +"</div>"
    +"</div>"
    +"<div class=\"form-group row pt-2\">"
        +"<div class=\"col-md-5\">"
            +"<input id=\"barangkeluarqty"+barangid+"\" class=\"informasibarang qtyformat form-control form-control-lg\" type=\"text\" value=\""+($("#barangkeluarqty"+barangid).val() === undefined ? $("#qtykeluarkasir").val() : (Number($("#barangkeluarqty"+barangid).val()) + Number($("#qtykeluarkasir").val())))+"\">"
        +"</div>"
        +"<div class=\"col-md-7 mt-0\">"
            +"<strong> SUB TOTAL : </strong><br>"
            +"<span class=\"informasibarang\" id=\"subtotalbarang"+barangid+"\">0</span>"
        +"</div>"
        +"<div class=\"ml-3\">"
            +"<h4 class=\"rich-list-title\">VARIAN : <span id=\"varian"+barangid+"\">"+namavariannya+"</span></h4>"
        +"</div>"
    +"</div>"
    +"<div id=\"informasibarangheader\" style=\"display:none\" >"
    +"<div id=\"dariperusahaan"+barangid+"\" class=\"informasibarang\">"+pemilik+"</div>"
    +"<div id=\"kodebarang"+barangid+"\" class=\"informasibarang\">"+barangid+"</div>"
    +"<div id=\"hargabeli"+barangid+"\" class=\"informasibarang\">"+hargabeli.toString().replace('.', ',')+"</div>"
    +"<div id=\"qtylabel"+barangid+"\" class=\"informasibarang\">"+($("#barangkeluarqty"+barangid).val() === undefined ? $("#qtykeluarkasir").val() : (Number($("#barangkeluarqty"+barangid).val()) + Number($("#qtykeluarkasir").val())))+"</div>"
    +"<div id=\"brandlabel"+barangid+"\" class=\"informasibarang\">"+brandid+"</div>"
    +"<div id=\"principallabel"+barangid+"\" class=\"informasibarang\">"+principalid+"</div>"
    +"<div id=\"stokdapatminuslabel"+barangid+"\" class=\"informasibarang\">"+stokdapatminus+"</div>"
    +"<div id=\"jsonjenisvarian"+barangid+"\" class=\"informasibarang\">"+jsonStrjenisvarian+"</div>"
    +"<div id=\"keterangantiapbarang"+barangid+"\" class=\"informasibarang\">"+keterangantiapbarang+"</div>"
    +"<div id=\"apakahvarian"+barangid+"\" class=\"informasibarang\">"+apakahvarian+"</div>"
    +"<div id=\"hargajualubah"+barangid+"\" class=\"informasibarang\">"+hargajual.toString().replace('.', ',')+"</div>"
    +"<div id=\"statusprosesitem"+barangid+"\" class=\"informasibarang\">0</div>"
    +"<div class=\"informasibarang\">====</div>"
    +"</div>";
                    $("#keranjangbelanja").prepend(prependHTML);
                    $("#subtotalbarang"+barangid).html(formatter.format(Number(hargajual) * Number($("#qtykeluarkasir").val())));
                    $("#barangkeluarqty"+barangid).TouchSpin({min: 1,max: 999999,decimals: 2,forcestepdivisibility: 'none',}).on('input change', debounce(function (e) {
                        $("#qtylabel"+barangid).html($(this).val().replace('.', ',').trim());
                        updatebarangkerankang(barangid,$(this).val(),hargajual,sisastokmaksimal)
                    }, 500));
                }else if (obj.status == "adadata"){
                    $("#barangkeluarqty"+barangid).val(Number($("#barangkeluarqty"+barangid).val()) + Number($("#qtykeluarkasir").val()));
                    $("#subtotalbarang"+barangid).html(formatter.format(Number(obj.hargajual) * Number($("#barangkeluarqty"+barangid).val())));
                    $("#hargajual"+barangid).html(formatter.format(obj.hargajual));
                    $("#qtylabel"+barangid).html($("#barangkeluarqty"+barangid).val().replace('.', ',').trim());
                    var tempclone = $("#barisbelanja"+barangid).clone();
                    var tempcloneinformasibarangheader = $("#informasibarangheader"+barangid).clone();
                    $("#barisbelanja"+barangid).remove()
                    $("#informasibarangheader"+barangid).remove()
                    tempclone.prependTo('#keranjangbelanja')
                    tempcloneinformasibarangheader.append('#barisbelanja'+barangid)
                }else{
                    Swal.fire({
                        title: "Gagal... Cek Koneksi Database Lokal",
                        text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
                        icon: 'warning',
                    });
                }
                grandtotalkasir();
                $("#qtykeluarkasir").val('1');
            },
            error: function(xhr, status, error) {
                toastr["error"](xhr.responseJSON.message);
            }
        });
    });
}

function pilihbarang(barangid, namabarang, hargajual, hargabeli, sisastokmaksimal, pemilik,apakahvarian, stokdapatminus, brandid, principalid, keterangantiapbarang, hargajualasli, hargajualaslisementara){
    if (Number(sisastokmaksimal) <= 0 && stokdapatminus === "TIDAK DAPAT MINUS"){
        swal.fire({
            title: "Waduh Terjadi Kesalahan!!!",
            text: "Nama Barang : "+namabarang+" stok habis. Silahkan lakukan MUTASI, PENYESUAIAN STOK atau HUBUNGI ADMIN BARANG ?",
            imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
            imageHeight: 150,
            confirmButtonText: "Oke. Saya Paham!",
        }).then(function(result){
            if(result.isConfirmed){
                return false
            }
        })   
    }else{
        subpilihbarang(barangid, namabarang, hargajual, hargabeli, sisastokmaksimal, pemilik, apakahvarian, stokdapatminus, brandid, principalid, keterangantiapbarang, hargajualasli, hargajualaslisementara)
    }
}
function grandtotalkasir(){
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'penjualan/grandtotalkasir',
        method: 'POST',
        dataType: 'json',
        data: {
            [csrfName]:csrfTokenGlobal,
        },
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.data[0].TOTALBELANJA > 0){
                $('#keranjangkosong').html("");
            }else{
                $('#keranjangkosong').html('<div style="position: absolute;top: 8%; bottom: 0; left: 0; right: 0;margin: auto;" class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Keranjang Belanja Anda Masih Kosong Lo... Silahkan Pilih Item Untuk di Transkasi</h4><!-- BEGIN Avatar --><div class="avatar avatar-label-primary avatar-circle widget12 mb-4"><div class="avatar-display"><i class="fas fa-cart-arrow-down"></i></div></div><!-- END Avatar --><a href="javascript:void(0)" class="btn btn-primary btn-wider">Pilih Barang</a></div>');
            }
            $('#totalbelanjaatas').html(formatter.format(obj.data[0].TOTALBELANJA));
            if (iseditkasir == "true"){
                nominalpotongan.set(vnominalpotongan)
                nominalpajaktoko.set(vpajaktoko)
                nominalpajaknegara.set(vpajaknegara)
                $('#grandtotal').html(formatter.format((Number(obj.data[0].TOTALBELANJA) - Number(vnominalpotongan) + Number(vpajaktoko) + Number(vpajaknegara)).toFixed(2)));
            }else{
                $('#grandtotal').html(formatter.format(obj.data[0].TOTALBELANJA));
            }
        }
    });
});
}
function ajaxupdatebarangkeranjang(barangid,qty,hargajual,sisastokmaksimal){
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'penjualan/updatekasirsementara',
        method: 'POST',
        dataType: 'json',
        data: {
            [csrfName]:csrfTokenGlobal,
            BARANG_ID : barangid,
            QTY : qty,
            HARGAJUAL: (iseditkasir == "true" ? Number($("#hargajual"+barangid).html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()) : hargajual),
            DARIUBAHHJDETAIL : "TIDAK",
            ISEDITKASIR : iseditkasir,
            EDITGROSIRAKTIF : $('#edithargagrosiraktif').is(':checked'),
        },
        success: function (response) {
            var obj = JSON.parse(response);
            if (obj.status == "out_of_stok"){
                $("#barangkeluarqty"+barangid).val(sisastokmaksimal)
                grandtotalkasir()
                return toastr["error"](obj.msg)
            }
            if (obj.status == "true"){
                if (iseditkasir == "true"){
                    $("#subtotalbarang"+barangid).html(formatter.format(Number(hargajual) * Number(qty)));
                    $("#hargajual"+barangid).html(formatter.format(hargajual));
                }else{
                    $("#subtotalbarang"+barangid).html(formatter.format(Number(obj.hargajual) * Number(qty)));
                    $("#hargajual"+barangid).html(formatter.format(obj.hargajual));
                }
                grandtotalkasir();
                return;
            }
            return Swal.fire({title: "Kesalahan Respon",text: "Terjadi kesalahan respon API pada UPDATE QTY PENJUALAN",icon: 'warning',});
        }
    });
});
}
function updatebarangkerankang(barangid,qty,hargajual,sisastokmaksimal){
    if (iseditkasir == "true"){
        ajaxupdatebarangkeranjang(barangid,qty,hargajual,sisastokmaksimal)
    }else{
        ajaxupdatebarangkeranjang(barangid,qty,Number($("#hargajual"+barangid).html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim()),sisastokmaksimal)
    }
}
function hapusbarangkeranjang(barangid,namabarang, statusitem){
    if (statusitem != 0){
        return Swal.fire({
            title: "Permintaan Proses Ditolak",
            text: "Kami mohon maaf untuk menolak permintaan anda. Karena item sudah dalam STATUS PROSES atau mungkin SUDAH SELEAI",
            icon: 'error',
        });
    }
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
                    url: baseurljavascript + 'penjualan/hapusperbarang',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        BARANG_ID: barangid,
                    },
                    success: function (response) {
                        var obj = JSON.parse(response);
                        if (obj.status == "true"){
                            $('#barisbelanja'+barangid).remove();
                            $('#dariperusahaan'+barangid).remove();
                            $('#kodebarang'+barangid).remove();
                            $('#hargabeli'+barangid).remove();
                            $('#qtylabel'+barangid).remove();
                            grandtotalkasir();
                        }else{
                            Swal.fire({
                                title: "Kesalahan Respon",
                                text: "Cek kesalahan pada API HAPUS BARANG di KASIR",
                                icon: 'warning',
                            });
                        }
                    }
                });
            });
        }
    })
}

$('#katakuncipencariankasir').on('input', debounce(function (e) {
    loaddaftarbarang();
}, 500));
function kosongkankeranjanglokal(){
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/hapuskeranjang',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
            },
            success: function (response) {
                var obj = JSON.parse(response);
                if (obj.status == "true"){
                    $('#keranjangkosong').html('<div style="position: absolute;top: 8%; bottom: 0; left: 0; right: 0;margin: auto;" class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Keranjang Belanja Anda Masih Kosong Lo... Silahkan Pilih Item Untuk di Transkasi</h4><!-- BEGIN Avatar --><div class="avatar avatar-label-primary avatar-circle widget12 mb-4"><div class="avatar-display"><i class="fas fa-cart-arrow-down"></i></div></div><!-- END Avatar --><a href="javascript:void(0)" class="btn btn-primary btn-wider">Pilih Barang</a></div>');
                    $("#keranjangbelanja").html("");
                    loaddaftarbarang();
                }else{
                    Swal.fire({
                        title: "Gagal... Membersihkan Keranjang, Silahkan tekan F5",
                        text: "Silahkan Hubungi Teknisi Untuk Permasalahan Ini",
                        icon: 'warning',
                    });
                }
                grandtotalkasir();
            }
        });
    });
}
$("#bersihkanform").on("click", function () {
    swal.fire({
        title: "Loo Loo.. Anda Yakin ?",
        text: "Apakah anda ingin membersihkan KERANJANG pada TRANSAKSI ini ?. Jangan galau kalau sampai kehapus ya....",
        icon:"question",
        showCancelButton:true,
        confirmButtonText: "Bersihkan Keranjang",
        cancelButtonText: "Ooops.. Gak Jadi!!",
    }).then(function(result){
        if(result.isConfirmed){
            kosongkankeranjanglokal()
        }
    })
});
$('#textpencarianmemberkasir').on('input', debounce(function (e) {
    $('#kasir_daftarmember').DataTable().ajax.reload();
}, 500));
$('#textpencariankategori').on('input', debounce(function (e) {
    panggilkategorikasir()
}, 500));
function panggilkategorikasir(){
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'masterdata/daftakategoriselectkasir',
        method: 'POST',
        dataType: 'json',
        data: {
            [csrfName]:csrfTokenGlobal,
            NAMAKATEGORI: $("#textpencariankategori").val(),
            KODEUNIKMEMBER: session_kodeunikmember,
        },
        success: function (response) {
            let obj = JSON.parse(response);
            let htmljoin = "";
            if (obj.success == "false"){
                $('#tampilankategori').html('<div class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Kategori Yang Anda Cari Tidak Ditemukan, Silahkan Periksa Katakunci Yang Anda Masukkan</h4><!-- BEGIN Avatar --><div class="avatar avatar-label-primary avatar-circle widget12 mb-4"><div class="avatar-display"><i class="fas fa-box-open"></i></div></div></div>');
            }else{
                htmljoin += '<div class="row">';
                for (datake = 0; datake < obj.totaldata; datake++) {
                    htmljoin += "<div class=\"col-md-3 col-sm-4 mb-2\"><div class=\"card-sl\"><div class=\"card-image\"><img src=\""+obj.daftarkategori[datake].logokategori+"\" /></div><div class=\"card-heading\">Nama Kategori :<br>\""+obj.daftarkategori[datake].namakategori+"\"</div><a onclick=\"pilihkategori('"+obj.daftarkategori[datake].idkategori+"')\" href=\"javascript:void(0)\" class=\"card-button\">Filter Kategori</a></div></div>";
                }
                htmljoin += '</div>';
                $("#tampilankategori").html(htmljoin);
            }
        }
    });
});
}
function panggilkategorikasir_acipay(kondisi,katakunci){
    let htmljoin = ""
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'masterdata/kategoridompetdata',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KONDISI: kondisi,
                KATAKUNCI: katakunci,
            },
            success: function (response) {
                if (response.success == false){
                    $('#tampilankategori_acipay').html('<div class="d-flex flex-column align-items-center justify-content-center"><h4 style="text-align:center;"> Oopss.. Kategori Yang Anda Cari Tidak Ditemukan, Silahkan Periksa Katakunci Yang Anda Masukkan</h4><!-- BEGIN Avatar --><div class="avatar avatar-label-primary avatar-circle widget12 mb-4"><div class="avatar-display"><i class="fas fa-box-open"></i></div></div></div>');
                }else{
                    htmljoin += '<div class="row m-2">';
                    for (datake = 0; datake < response.totaldata; datake++) {
                        htmljoin += "<div style=\"cursor:pointer;\" class=\"col-md-3 col-sm-4 mb-2\"><div class=\"card-sl\"><div class=\"card-image\"><img src=\""+(response.data[datake].LOGOKATEGORI == "" ? baseurljavascript+"images/avatar/no_image.png" : response.data[datake].LOGOKATEGORI )+"\" /></div><div class=\"card-heading\">Nama Kategori :<br>\""+response.data[datake].NAMAKATEGORI+"\"</div><a onclick=\"pilihkategori('"+response.data[datake].KATEGORIPARENT_ID+"')\" href=\"javascript:void(0)\" class=\"card-button\">Pilih Ini</a></div></div>";
                    }
                    htmljoin += '</div>';
                    $("#tampilankategori_acipay").html(htmljoin);
                }
            }
        });
    });
}
function pilihkategori(kategoriid){
    $('#katakuncikategori').val(kategoriid)
    loaddaftarbarang();
    $('#filterbycategori').modal('toggle');
    $('#katakuncikategori').val("")

}
function panggildompetdata(){
    panggilkategorikasir_acipay("ROOT_DIGITAL","ROOT_DIGITAL")
    $("#panggildompetdata").on('shown.bs.modal', function(){
        setTimeout(function (){
            $("#textpencarianmemberkasir").focus()
        }, 150);
    }).modal('show');
}
function panggilmemberkasir(){
    $('#kasir_daftarmember').DataTable().ajax.reload();
    $("#memberdikasir").on('shown.bs.modal', function(){
        setTimeout(function (){
            $("#textpencarianmemberkasir").focus();
        }, 150);
    }).modal('show');
}
function pilihmemberkasir(kodemember,namamember,lamajatuhtempo,emailpelanggan,nokontakpelanggan){
    $("#namamember").html(namamember);
    $("#idmember").html(kodemember);
    $("#lamajatuhtempo").html(lamajatuhtempo);
    $("#emailpelanggan").html(emailpelanggan);
    $("#nokontakpelanggan").html(nokontakpelanggan);
    $('#memberdikasir').modal('toggle');
}
function detailinformasimember (){
getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'masterdata/detailmemberterpilih',
        method: 'POST',
        dataType: 'json',
        data: {
            [csrfName]:csrfTokenGlobal,
            KATAKUNCI: $("#idmember").html(),
            KODEUNIKMEMBER: session_kodeunikmember,
            DATAKE: 0,
            LIMIT: 1,
        },
        success: function (response) {
            let obj = JSON.parse(response);
            if (obj.success == "true"){
                $('#namapelanggandetail').html(obj.NAMA);
                $('#alamatpelanggandetail').html(obj.ALAMAT);
                $('#limitbataspiutangdetail').html(formatuang(obj.LIMITJUMLAHPIUTANG,'id-ID','IDR'));
                $('#memberiddetail').html(obj.MEMBER_ID);
                $('#nomortelepondetail').html(obj.TELEPON);
                $('#alamatemaildetail').html(obj.EMAIL);
                $('#kotamemberdetail').html(obj.KOTA);
                $('#totaldeposit').html(formatuang(obj.TOTALDEPOSIT,'id-ID','IDR'));
                $('#informasimember').modal();
            }else{
            }
        },
        error: function(xhr, status, error) {
            toastr["error"](xhr.responseJSON.message);
        }
    });
});
}
function panggilsalesman(){
    $('#kasir_daftarsalesman').DataTable().ajax.reload();
    $("#salesmandikasir").on('shown.bs.modal', function(){
        setTimeout(function (){
            $("#textpencariansuplierkasir").focus();
        }, 150);
    }).modal('show');
}
function pilihsalesman(kodesales,namasales){
    $("#idsalesman").html(kodesales);
    $("#namasalesman").html(namasales);
    $('#salesmandikasir').modal('toggle');
}
function pilihbank(kondisi,jenisbank){
    let htmlnya = '';
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'masterdata/daftarpembayarannontunai',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                KODEUNIKMEMBER: session_kodeunikmember,
                JENISNONTUNAI: jenisbank,
            },
            success: function (response) {
                if (kondisi == "D"){
                    htmlnya = '<div class="row mt-2" style="display:none" id="pilihbankdebitdaftar">';
                }else if (kondisi == "K"){
                    htmlnya = '<div class="row mt-2" style="display:none" id="pilihbankkreditdaftar">';
                }else{
                    htmlnya = '<div class="row mt-2" style="display:none" id="pilihemoneyaftar">';
                }
                for (let i = 0; i < response.daftarpembayarannontunai[0].totaldatadataquery; i++) {
                    htmlnya += "<div onclick=\"pilihbankterpilih('"+kondisi+"','"+response.daftarpembayarannontunai[0].dataquery[i].BANK_ID+"')\" style=\"cursor:pointer\" class=\"card mt-1 mx-auto\"><img style=\"max-height:50px\" src=\""+response.daftarpembayarannontunai[0].dataquery[i].URLLOGO+"\" class=\"img-thumbnail p-2 card-img-top\" alt=\"Logo Bank\"><div class=\"card-body\"><h5 class=\"text-center card-title\">\""+response.daftarpembayarannontunai[0].dataquery[i].NAMABANK+"\"</h5><a id=\"btnpilihbankcss"+kondisi+""+""+response.daftarpembayarannontunai[0].dataquery[i].BANK_ID+"\"  onclick=\"pilihbankterpilih('"+kondisi+"','"+response.daftarpembayarannontunai[0].dataquery[i].BANK_ID+"')\" href=\"javascript:void(0)\" class=\"butonbank"+kondisi+" btn btn-primary btn-block\">Pilih Bank Ini</a></div></div>";
                }
            
                htmlnya += '</div>'
                if (kondisi == "D"){
                    $("#daftarbankdebit").append(htmlnya)
                    if ($("#pilihbankdebitdaftar").is(':visible')){
                        if (iseditkasir == "true" && nomorkartudebit.getNumber() > 0){
                            $("#pilihbankdebitdaftar").show();
                        }else{
                            $("#pilihbankdebitdaftar").hide();
                            $(".butonbank"+kondisi).css({"color": "","background-color": "","border-color": ""});
                        }
                    }else{
                        $("#pilihbankdebitdaftar").show();
                    }
                }else if (kondisi == "K"){
                    $("#daftarbankkredit").append(htmlnya)
                    if ($("#pilihbankkreditdaftar").is(':visible')){
                        if (iseditkasir == "true" && nomorkartukredit.getNumber() > 0){
                            $("#pilihbankkreditdaftar").show();
                        }else{
                            $("#pilihbankkreditdaftar").hide();
                            $(".butonbank"+kondisi).css({"color": "","background-color": "","border-color": ""});
                        }
                    }else{
                        $("#pilihbankkreditdaftar").show();
                    }
                }else{
                    $("#daftaremoney").append(htmlnya)
                    if ($("#pilihemoneyaftar").is(':visible')){
                        if (iseditkasir == "true" && nominalemoney.getNumber() > 0){
                            $("#pilihemoneyaftar").show();
                        }else{
                            $("#pilihemoneyaftar").hide();
                            $(".butonbank"+kondisi).css({"color": "","background-color": "","border-color": ""});
                        }
                    }else{
                        $("#pilihemoneyaftar").show();
                    }
                }
            }
        });
    });
}
function daftarpenjualan(){
    $('#kasir_daftarpenjualan').DataTable().ajax.reload();
    $("#daftarpenjualan").on('shown.bs.modal', function(){
        setTimeout(function (){
            $("#txtpencariannota").focus();
        }, 100);
    }).modal('show');

}
function pilihbankdebit(){pilihbank("D","B")}
function pilihbankkredit(){pilihbank("K","B")}
function pilihemoney(){pilihbank("E","E")}
function pilihbankterpilih(kondisi,bankterpilih){
    $(".butonbank"+kondisi).css({"color": "","background-color": "","border-color": ""});
    $("#btnpilihbankcss"+kondisi+bankterpilih).css({"color": "#ffffff","background-color": "#1F2838","border-color": "#494F57"});
    if (kondisi == "D"){
        $("#idkartudebit").html(bankterpilih);
    }else if(kondisi == "K"){
        $("#idkartukredit").html(bankterpilih);
    }else{
        $("#idemoney").html(bankterpilih);
    }
}

$("#txtpencariannota, #tanggalawalnota, #tanggalakhirnota").on('input change', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#kasir_daftarpenjualan').DataTable().ajax.reload();
    });
}, 500));
$("#filtertanggalreservasiawal, #filtertanggalreservasiakhir").on('input change', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#tabel_pesanananmeja_kasir').DataTable().ajax.reload();
    });
}, 500));
$("#txtpencariannotapending").on('input change', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('#kasir_daftarnotapending').DataTable().ajax.reload();
    });
}, 500));
function modalinfobarang(kodebarang, hargajual, catatanperbarang, hargajualstak, statusitem){
    let htmlnya = "";
    if (statusitem != 0){
        return Swal.fire({
            title: "Permintaan Proses Ditolak",
            text: "Kami mohon maaf untuk menolak permintaan anda. Karena item sudah dalam STATUS PROSES.",
            icon: 'error',
        });
    }
    $("#pilihanvariansebelumnya").html($("#varian"+kodebarang).html())
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'penjualan/detailbarangkeranjang',
            method: 'POST',
            dataType: 'json',
            data: {
                [csrfName]:csrfTokenGlobal,
                BARANG_ID : kodebarang
            },
            success: function (response) {
                jsonStrjenisvarian = '{"jenisvarian":[]}';
                hasilhargabaru = 0;
                htmlnya = "<div class=\"row\"><div class=\"col\">";
                if (response[0].dataquery[0].NAMATAMBAHAN != null){
                    for (let i = 0; i < response[0].totaldata; i++) {
                        htmlnya += "<button id=\""+response[0].dataquery[i].NAMATAMBAHAN.toLowerCase().replace(/\s/g, '')+"\" onclick=\"ubahhargajual('"+response[0].dataquery[i].HARGATAMBAHAN+"','"+response[0].dataquery[i].NAMATAMBAHAN+"',"+this.id+")\" style=\"font-size: 18px;\" class=\"btn btn-primary btn-block\">"+response[0].dataquery[i].NAMATAMBAHAN+" +"+formatuang(response[0].dataquery[i].HARGATAMBAHAN,'id-ID','IDR')+"</button>";
                    }
                }else{
                    htmlnya += "<p style=\"font-size:15px\">Tidak Ada Varian Yang Tersedia Dalam "+response[0].dataquery[0].NAMABARANG+"</p>";
                }
                htmlnya += "</div></div>";
                $("#detailvarianbarang").html("");
                $("#detailvarianbarang").append(htmlnya);
                $("#juduldetailbarang").html(response[0].dataquery[0].NAMABARANG);
                $("#kodebarangv").val(kodebarang);
                $("#namabarangv").val(response[0].dataquery[0].NAMABARANG);
                hargajualv.set($("#hargajual"+kodebarang).html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim());
                hargajualasliv.set((hargajual == 0 ? hargajualstak : hargajual ));
                nominalhargajualvstak.set(hargajualstak)
                qtyv.set($("#barangkeluarqty"+kodebarang).val());
                $("#hargajualbarudetail").html(formatuang(hargajualv,'id-ID','IDR'));
                $('#catatanperbarang').val((catatanperbarang == "" ? "" : catatanperbarang )),
                $("#modaldetailbarang").modal('show');     
            }
        });
    });
}
$('#hargajualv, #catatanperbarang').on('keypress', debounce(function (e) {
    hargajualasliv.set(hargajualv.getNumber())
    $("#hargajualbarudetail").html(formatuang(hargajualv.getNumber(),'id-ID','IDR'));
    jsonStrjenisvarian = '{"jenisvarian":[]}';
    hasilhargabaru = hargajualv.getNumber();
    $("#keterangantiapbarang"+$("#kodebarangv").val()).html($('#catatanperbarang').val())
    ubahhargajual(0,"",this.id);
}, 500));
function ubahhargajual(tambahanharga,namavarian,idElement){
    //jsonStrjenisvarian = '{"jenisvarian":[]}';
    let paksaupdatehj = 0, output, obj = JSON.parse(jsonStrjenisvarian);
    if ($("#paksaubah").is(':checked')){ paksaupdatehj = 1;}
    if (tambahanharga > 0){
        swal.fire({
            title: "Konfirmasi Informasi Varian",
            text: "Apakah anda ingin menambahkan atau membatalkan varian "+namavarian,
            icon:"question",
            showCancelButton:true,
            confirmButtonText: "Tambahkan Varian",
            cancelButtonText: "Batalkan Varian",
        }).then(function(result){
            if(result.isConfirmed){
                if (hasilhargabaru <= hargajualv.getNumber()){
                    hasilhargabaru = hargajualv.getNumber();
                }else{
                    hasilhargabaru = hasilhargabaru;
                }
                obj['jenisvarian'].push({"namavarian":namavarian,"hargavarian":tambahanharga,"qty":1});
                $("#subtotalbarang"+$("#kodebarangv").val()).html(formatter.format(qtyv.getNumber() * hargajualv.getNumber()));
                $("#hargajual"+$("#kodebarangv").val()).html(formatter.format(hargajualv.getNumber()));
                hasilhargabaru = hasilhargabaru + Number(tambahanharga)
                $("#hargajualbarudetail").html(formatuang(hasilhargabaru,'id-ID','IDR'));
            }else{
                obj['jenisvarian'].push({"namavarian":namavarian,"hargavarian":tambahanharga,"qty":-1});
                $("#subtotalbarang"+$("#kodebarangv").val()).html(formatter.format(qtyv.getNumber() * hargajualv.getNumber()));
                $("#hargajual"+$("#kodebarangv").val()).html(formatter.format(hargajualv.getNumber()));
                if (hasilhargabaru > hargajualv.getNumber()){
                    hasilhargabaru = hasilhargabaru - Number(tambahanharga)
                }
                $("#hargajualbarudetail").html(formatuang(hasilhargabaru,'id-ID','IDR'));
            }
            output = _(obj['jenisvarian']).groupBy('namavarian').map((objs, key) => ({'namavarian': key, "hargavarian":tambahanharga, 'qty': _.sumBy(objs, 'qty') })).value();      
            _.remove(output, {qty: 0});
            _.remove(output, {qty: -1});
            jsonStrjenisvarian = '{"jenisvarian":'+JSON.stringify(output)+'}';
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/updatekasirsementara',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        BARANG_ID : $("#kodebarangv").val(),
                        QTY : qtyv.getNumber(),
                        HARGAJUAL : hasilhargabaru,
                        PAKSAUPDTE : paksaupdatehj,
                        DARIUBAHHJDETAIL : (idElement == "hargajualv" ? "UBAHHJNYA" : "YA"),
                        JSONVARIAN : btoa(jsonStrjenisvarian),
                        KETERANGAN : $('#catatanperbarang').val(),
                    },
                    success: function (response) {
                        let namavariannya = "";
                        let objjsonStrjenisvarian = JSON.parse(jsonStrjenisvarian);
                        Object.entries(objjsonStrjenisvarian).forEach(([key, value]) => {
                            value.forEach((variandetail) => {
                                namavariannya += variandetail.namavarian+" ("+variandetail.qty+"x) , "
                            })
                        })
                        $("#subtotalbarang"+$("#kodebarangv").val()).html(formatter.format(qtyv.getNumber() * hasilhargabaru));
                        $("#hargajual"+$("#kodebarangv").val()).html(formatuang(hasilhargabaru,'id-ID','IDR'));
                        $("#hargajualbarudetail").html(formatuang(hasilhargabaru,'id-ID','IDR'));
                        $("#jsonjenisvarian"+$("#kodebarangv").val()).html(jsonStrjenisvarian);
                        $("#varian"+$("#kodebarangv").val()).html(namavariannya);
                        $("#hargajualubah"+$("#kodebarangv").val()).html(hargajualasliv.getNumber())
                        grandtotalkasir();
                    }
                });
            });
        })
    }else{
        getCsrfTokenCallback(function() {
            $.ajax({
                url: baseurljavascript + 'penjualan/updatekasirsementara',
                method: 'POST',
                dataType: 'json',
                data: {
                    [csrfName]:csrfTokenGlobal,
                    BARANG_ID : $("#kodebarangv").val(),
                    QTY : qtyv.getNumber(),
                    HARGAJUAL : (hargajualv.getNumber() != hasilhargabaru ? hasilhargabaru : hargajualv.getNumber()),
                    PAKSAUPDTE : paksaupdatehj,
                    DARIUBAHHJDETAIL : (idElement == "hargajualv" ? "UBAHHJNYA" : "YA"),
                    JSONVARIAN : btoa(jsonStrjenisvarian),
                    KETERANGAN : $('#catatanperbarang').val(),
                },
                success: function (response) {
                    let namavariannya = "";
                    let objjsonStrjenisvarian = JSON.parse(jsonStrjenisvarian);
                    Object.entries(objjsonStrjenisvarian).forEach(([key, value]) => {
                        value.forEach((variandetail) => {
                            namavariannya += variandetail.namavarian+" ("+variandetail.qty+"x) , "
                        })
                    })
                    $("#subtotalbarang"+$("#kodebarangv").val()).html(formatter.format(qtyv.getNumber() * hargajualv.getNumber()));
                    $("#hargajual"+$("#kodebarangv").val()).html(formatter.format(hargajualv.getNumber()));
                    $("#hargajualbarudetail").html(formatuang(hasilhargabaru,'id-ID','IDR'));
                    $("#jsonjenisvarian"+$("#kodebarangv").val()).html(jsonStrjenisvarian);
                    $("#varian"+$("#kodebarangv").val()).html(namavariannya);
                    $("#hargajualubah"+$("#kodebarangv").val()).html(hargajualasliv.getNumber())
                    grandtotalkasir();
                }
            });
        });
    }
}
function hitungpotongan(){
    let totalbelanjaatas = Number($("#totalbelanjaatas").html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim())
    nominalpajaktoko.set(0)
    nominalpajaknegara.set(0)
    $("#grandtotal").html(formatuang(totalbelanjaatas - nominalpotongan.getNumber(),'id-ID','IDR'))
}
function hitungpajak(jenis){    
    let totalbelanjatasnya = Number($('#totalbelanjaatas').html().replace('Rp&nbsp;', '').replaceAll('.', '').replace(',', '.').trim())
    if (jenis == "manualtoko"){
        if (nominalpajaktoko.getNumber() < 100){
            nominalpajaktoko.set((totalbelanjatasnya - nominalpotongan.getNumber()) * (nominalpajaktoko.getNumber() / 100));
        }else{
            nominalpajaktoko.set(nominalpajaktoko.getNumber());
        }
        nominalpajaknegara.set(0)
    }else if (jenis == "manualnegara"){
         if (nominalpajaknegara.getNumber() < 100){
            nominalpajaknegara.set((totalbelanjatasnya - nominalpotongan.getNumber() - nominalpajaktoko.getNumber()) * (nominalpajaknegara.getNumber() / 100));
        }else{
            nominalpajaknegara.set(nominalpajaknegara.getNumber());
        }
    }else if (jenis == "toko"){
        nominalpajaktoko.set((totalbelanjatasnya - nominalpotongan.getNumber()) * (pajaktoko / 100));
        nominalpajaknegara.set(0)
    }else if(jenis == "negara"){
        nominalpajaknegara.set((totalbelanjatasnya - nominalpotongan.getNumber() - nominalpajaktoko.getNumber()) * (pajaknegara / 100));
    }
    $("#grandtotal").html(formatuang(totalbelanjatasnya - nominalpotongan.getNumber() + nominalpajaktoko.getNumber() + nominalpajaknegara.getNumber(),'id-ID','IDR'))
}
function batalkanmodal(){
    let pesanpembatalan = "";
    if (tipeordernya == 1){
        pesanpembatalan = "Apakah anda yakin ingin membatalkan reservasi meja atas Nama: "+$('#namapemesan_rev').val()+" dengan Kode:"+$('#kodepesan_rev').val();
    }
    swal.fire({
        title: "Formulir Pembatalan!!",
        icon: 'warning',
        text: pesanpembatalan,
        //imageUrl: 'https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExMzhiMTE3M2RjM2U1ZWI3OWFjMjVjYjUxZjI4NjZhYTk2NzZiNmNiZCZjdD1z/jn27S7H3ARZVHex8z6/giphy.gif',
        //imageHeight: 150,
        showCancelButton:true,
        confirmButtonText: "Oke, Batalkan",
        cancelButtonText: "Tunggu Sebentar!",
    }).then(function(result){
        if(result.isConfirmed){
            bersihkanformmodal();
        }
    })   
}
function bersihkanformmodal(){
    tipeordernya = 0;
    $("#iconresrvasi").css({'color':'black'});
    $("#icondinein").css({'color':'black'});
    $("#modalreservation").modal('hide');
    $('#titlekasir').html("ACIRABA");
    $('#berapaorang_rev').val("");
    $('#namapemesan_rev').val("");
    $('#notelp_rev').val("");
    $('#kodemejaterpilih_rev').val("");
    $('#keterangantransaksi').val("")
    $('#tanggalawal_rev').val(moment().format('DD-MM-YYYY'));
    $("#tanggalawal_rev").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#tanggalakhir_rev').val(moment().format('DD-MM-YYYY'));
    $("#tanggalakhir_rev").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#waktuawal_rev').clockTimePicker();
    $('#waktuselesai_rev').clockTimePicker();
    $('#waktuawal_rev').clockTimePicker('value', moment().format('HH:mm'));
    $('#waktuselesai_rev').clockTimePicker('value', moment().add(3, 'hours').format('HH:mm'));
}
function konfirmasipesananmeja(){
    if ($("#berapaorang_rev").val() == "" || $("#namapemesan_rev").val() == "" || $("#notelp_rev").val() == "" || $("#kodemejaterpilih_rev").val() == ""){
        return Swal.fire({
            title: "Terjadi Kesalahan",
            text: "Silahkan isikan formulir pesanan dengan benar seperti BERAPA ORANG, NAMA PEMESAN, NOTELEPON, LOKASI MEJA",
            icon: 'error',
        });
    }
    swal.fire({
        title: "Formulir Konfirmasi!!",
        icon: 'question',
        text: "Apakah anda yakin dengan pemesanan tempat ini ? Silahkan masukan menu untuk dipesan",
        showCancelButton:true,
        confirmButtonText: "Oke, Catat",
        cancelButtonText: "Tunggu Sebentar!",
    }).then(function(result){
        if(result.isConfirmed){
            $("#modalreservation").modal('hide');
            pilihbarang("ACI100000100000001", "TIKET PEMESANAN "+$("#namapemesan_rev").val()+" "+$("#kodemenupesan_rev").val(), dp_rev.getNumber(), "0", "9", "0", false, false, "DAPAT MINUS", 0, "0", 0, 0)
        }
    })   
}
function getresolusikasir(){
    if($(window).width() < 1600){
        if ($("body").hasClass("chat-contact-desktop-show")){
            $(".daftarkeranjangkatalog").removeClass("col-md-6");
            $(".daftarkeranjangkatalog").addClass("col-md-4");
        }else{
            $(".daftarkeranjangkatalog").removeClass("col-md-4");
            $(".daftarkeranjangkatalog").addClass("col-md-6");
        }
    }else{
        if ($("body").hasClass("chat-contact-desktop-show")){
            $(".daftarkeranjangkatalog").removeClass("col-md-4");
            $(".daftarkeranjangkatalog").addClass("col-md-3");
        }else{
            $(".daftarkeranjangkatalog").removeClass("col-md-3");
            $(".daftarkeranjangkatalog").addClass("col-md-4");
        }
    }
}
$("#buttonkiri").click(function() {
    getresolusikasir()
});
socketIo.on("callbackduitku", function (data) {
    /*   00 - Success    01 - Pending    02 - Canceled   */
    if (data.response_code == "00"){
        if (data.no_transaksi === $("#notakasirpenjualan").html()){
            toastr["success"]("Transaksi Terbayarkan Pada Payment Gateway");
            $("#labelscanqris,#qrcodeclosepayment,#btncektransaksipayment,#durasiscanqris").hide()
            $("#btnsimpanpaygateway").html("[F6] Buat Trx QRIS");
            $("#btnsimpanpaygateway").prop('disabled', false);
            $("#qrcodeclosepayment").html('');
            $("#kartu").prop("checked", true);
            $("#kartu").trigger("change");
            nominalemoney.set(ktotalbelanja);
            $('#idemoney').html('QRISD');
            proseskonfirmasipembelian(1);
        }
    }else if (data.response_code == "01"){
        toastr["info"]("Informasi Transaksi Pending Pada Payment Gateway");
    }else if (data.response_code == "02"){
        toastr["error"]("Informasi Transaksi Batal Pada Payment Gateway");
    }
    console.log(data.no_transaksi)
});