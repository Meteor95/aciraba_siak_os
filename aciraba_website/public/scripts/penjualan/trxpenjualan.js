$(function () {
    loadtabelutama();
});
function loadtabelutama() {
    getCsrfTokenCallback(function() {
        $("#daftarpenjualan").DataTable({
            language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
            dom: 'Bfrtip',
            ordering: false,
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
            columnDefs: [
                { width: 45, targets: 0 },
                { className: "text-right", targets: [5,6]}
            ],
            scrollCollapse: true,
            scrollY: "50vh",
            scrollX: true,
            bFilter: false,
            ajax: {
                "url": baseurljavascript + 'penjualan/ajaxdaftarpenjualan',
                "method": 'POST',
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.DIMANA3 = $('#daritanggal').val().split("-").reverse().join("-");
                    d.DIMANA4 = $('#sampaitanggal').val().split("-").reverse().join("-");
                    d.DIMANA5 = $('#katakunci').val();
                    d.DIMANA6 = $('#parameterpencarian').val();
                    d.DIMANA7 = $('#jenistransaksipenjualan').val();
                    d.DIMANA9 = session_kodeunikmember;
                    d.DIMANA10 = session_outlet;
                    d.DATAKE = 0;
                    d.LIMIT = 500;
                },
            }
        });
    });
}
$('#katakunci').on('input', debounce(function (e) {
    $('#daftarpenjualan').DataTable().ajax.reload();
}, 500));
$("#parameterpencarian").change(function () {
    $('#daftarpenjualan').DataTable().ajax.reload();
});
$("#jenistransaksipenjualan").change(function () {
    $('#daftarpenjualan').DataTable().ajax.reload();
});
$("#pencariantanggal, #prosesdata").on("click", function () {
    $('#daftarpenjualan').DataTable().ajax.reload();
});
function onclickhapustranskasi(notapenjualan,nammember){
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Apakah anda ingin menghapus TRANSAKSI '+notapenjualan+' dengan NAMA MEMBER '+nammember+'. Informasi yang terhubung dengan '+notapenjualan+' akan dihapus termasuk PIUTANG MEMBER hingga JURNAL TRANSAKSI. Stok akan diretur ke DISPLAY di OUTLET '+session_outlet,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Siap!!'
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'penjualan/hapuspenjualan',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        PK_NOTAPENJUALAN : notapenjualan,
                        LOKASI: session_outlet,
                        KODEUNIKMEMBER: session_kodeunikmember,
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            Swal.fire(
                                'Berhasil.. Horee!',
                                response.msg,
                                'success'
                            );
                            getCsrfTokenCallback(function() {
                                $('#daftarpenjualan').DataTable().ajax.reload();
                            });
                        }else{
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                response.msg,
                                'warning'
                            )
                        }
                    }
                });
            });
        }
    })
}
