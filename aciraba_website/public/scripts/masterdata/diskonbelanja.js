$(function () {
    loadkartustok();
});
function loadkartustok() {
    $(".tabeldiskonbarang").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        columnDefs: [{
            className: "text-right",
            targets: [3, 4, 5, 6, 7, 8]
        },
    ],
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="far fa-copy"></i> Copy',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="far fa-file-excel"></i> Excel',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fas fa-file-csv"></i> CSV',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="far fa-file-pdf"></i> PDF',
                titleAttr: 'PDF'
            }
        ],
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false,
        ajax: {
            "url": baseurljavascript + 'masterdata/jsontampildiskonbelanja',
            "method": 'POST',
            "data": function (d) {
                d.KODEITEM = $('#kodeitemdiskon').val() == null ? "" : $('#kodeitemdiskon').val();
                d.OUTLET = session_outlet;
                d.KODEUNIKMEMBER = session_kodeunikmember;
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        }
    });
}
$('#kodeitemdiskon').on('input', debounce(function (e) {
    $('.tabeldiskonbarang').DataTable().ajax.reload();
}, 500));
/* proses simpan diskon barang bertingkat */
$("#simpandiskonbertingkat").click(function() {
    if ($("#textkodebarangdiskon").html() == "Kode Item : " || $("#minimalbeliumum").val() == "" || $("#diskonumum1didapat").val() == "" || $("#diskonumum2didapat").val() == "" || $("#minimalbelimember").val() == "" || $("#diskonmember1didapat").val() == "" || $("#diskonmember2didapat").val() == ""){
        return Swal.fire({
            icon: 'warning',
            html: 'Anda belum mengisikan informasi diskon dengan benar.<br>Silahkan pilih item terlebih dahulu serta tentukan besaran diskon sebelum ditambahkan',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Tambah Diskon Barang",
        text: "Anda akan menambah diskon bertingkat : "+ $("#textnamabarangdiskon").html()+" ["+ $("#textkodebarangdiskon").html() +"] pada aplikasi",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsontambahdiskonbarang',
                method: 'POST',
                dataType: 'json',
                data: {
                    DISKONID : '',
                    BARANGID: $("#textkodebarangdiskon").text().substring($("#textkodebarangdiskon").text().indexOf(':') + 1).replace(/\s/g, ''),
                    MINBELITINGKAT1: $("#minimalbeliumum").val(),
                    DISCMEMBER1: $("#diskonmember1dapat").val(),
                    DISCNONMEMBER1 : $("#diskonumum1dapat").val(),
                    MINBELITINGKAT2: $("#minimalbelimember").val(),
                    DISCMEMBER2: $("#diskonmember2dapat").val(),
                    DISCNONMEMBER2: $("#diskonumum2dapat").val(),
                    KATEGORI: '',
                    KODEUNIKMEMBER: session_kodeunikmember,
                    OUTLET: session_outlet,
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    if (obj.status == "true"){
                        $('.tabeldiskonbarang').DataTable().ajax.reload();
                        Swal.fire(
                            'Berhasil.. Horee!',
                            obj.msg,
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Gagal.. Uhhhhh!',
                            obj.msg,
                            'warning'
                        )
                    }
                }
            });
        }
    });
});
function onclickhapus(barang,namabarang,kodeunikmember){
    Swal.fire({
        title: "Hapus Diskon Barang",
        text: "Anda akan menghapus diskon bertingkat : "+namabarang+" ["+ barang +"] pada aplikasi",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseurljavascript + 'masterdata/jsonhapusdiskonbarang',
                method: 'POST',
                dataType: 'json',
                data: {
                    KODEITEM : barang,
                    KODEUNIKMEMBER: session_kodeunikmember,
                    OUTLET: session_outlet,
                    NAMABARANG: namabarang,
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    if (obj.status == "true"){
                        $('.tabeldiskonbarang').DataTable().ajax.reload();
                        Swal.fire(
                            'Berhasil.. Horee!',
                            obj.msg,
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'Gagal.. Uhhhhh!',
                            obj.msg,
                            'warning'
                        )
                    }
                }
            });
        }
    });
}