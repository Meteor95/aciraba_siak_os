$(document).ready(function () { 
    $(".input-daterange").datepicker({ todayHighlight: true,format: 'dd-mm-yyyy',orientation: "bottom left", });
    loadvouchertabel();
});
function loadvouchertabel() {
getCsrfTokenCallback(function() {
    $(".tabelvoucherbelanja").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        columnDefs: [{ className: "text-right",targets: [3, 4, 5, 6, 7, 8]},],
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
            "url": baseurljavascript + 'masterdata/jsontampilvoucherbelanja',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.KODEVOUCHER = $('#kodevoucherbelanja').val() == null ? "" : $('#kodevoucherbelanja').val();
                d.OUTLET = session_outlet;
                d.KODEUNIKMEMBER = session_kodeunikmember;
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        },
        fnInitComplete: function(oSettings, json) {
            getCsrfTokenCallback(function() {});
        }
    });
});
}
$('#kodevoucherbelanja').on('input', debounce(function (e) {
    getCsrfTokenCallback(function() {
        $('.tabelvoucherbelanja').DataTable().ajax.reload();
    });
}, 500));
/* proses simpan diskon barang bertingkat */
$("#simpanvoucherbelanja").click(function() {
    if ($("#masukkankodekupon").val() == "" || $("#awalaktifvoucher").val() == "" || $("#akhiraktifvoucher").val() == "" || $("#nominalpotongan").val() == "" || $("#bataspakaikupon").val() == "" || $("#minimalpembelianvoucher").val() == ""){
        return Swal.fire({
            icon: 'warning',
            html: 'Silahkan lengkapi informasi KODE VOUCHER, RANGE AKTIF <br> MINIMAL BELI, BATAS PAKAI serta MINIMAL BELANJA pelanggan',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Tambah Voucher Belanja",
        text: "Apakah anda ingin menambahkan voucher belanja untuk pelanggan anda. Pelanggan anda pasti bahagia ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Tambahkan!'
    }).then((result) => {
        let nominaldiskon, nominalrupiah,jenisvoucher;
        if (result.isConfirmed) {
            $('#simpanvoucherbelanja').prop("disabled",true);
            $('#simpanvoucherbelanja').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            if ($('input[name="jenisvoucherdiskon"]:checked').val() == 1) {
                nominaldiskon = 0;
                nominalrupiah = nominalpotongan.getNumber();
                jenisvoucher = 'NOMINAL';
            } else {
                nominaldiskon = nominalpotongan.getNumber();
                nominalrupiah = 0;
                jenisvoucher = 'PERSEN';
            }
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'masterdata/jsontambahkuponbelanja',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        VOUCHER_ID : '',
                        NAMAVOUCHER : $("#masukkankodekupon").val(),
                        AWALAKTIF: $("#awalaktifvoucher").val().split("-").reverse().join("-"),
                        AKHIRAKTIF: $("#akhiraktifvoucher").val().split("-").reverse().join("-"),
                        TIPEVOUCHER : jenisvoucher,
                        NOMINALRUPIAH: nominalrupiah,
                        NOMINALDISKON: nominaldiskon,
                        BATASTRANSAKSI: bataspakaikupon.getNumber(),
                        MINIMALPEMBELIAN: minimalpembelianvoucher.getNumber(),
                        KODEUNIKMEMBER: session_kodeunikmember,
                        OUTLET: session_outlet,
                    },
                    complete:function(){
                        $('#simpanvoucherbelanja').prop("disabled",false);
                        $('#simpanvoucherbelanja').html('Simpan Kupon Belanja');
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            getCsrfTokenCallback(function() {
                                $('.tabelvoucherbelanja').DataTable().ajax.reload();
                            });
                            Swal.fire(
                                'Berhasil.. Horee!',
                                response.msg,
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                response.msg,
                                'warning'
                            )
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
        }
    });
});
function onclickhapus(namavoucher,kodeunikmember){
    Swal.fire({
        title: "Hapus Voucher Belanja",
        text: "Anda akan menghapus kode voucher belanja : "+namavoucher+" pada aplikasi",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus Sekarang!'
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'masterdata/jsonhapuskuponbelanja',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        NAMAVOUCHER : namavoucher,
                        OUTLET: session_outlet,
                        KODEUNIKMEMBER: session_kodeunikmember,
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            getCsrfTokenCallback(function() {
                                $('.tabelvoucherbelanja').DataTable().ajax.reload();
                            });
                            Swal.fire(
                                'Berhasil.. Horee!',
                                response.msg,
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                response.msg,
                                'warning'
                            )
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