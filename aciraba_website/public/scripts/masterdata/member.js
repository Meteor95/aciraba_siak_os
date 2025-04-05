let statusmember = 1,masaaktif = 0;
$(function () {
    loadtabelutama();
    $('#filterawalkartustok').val(moment().format('DD-MM-YYYY'));
    $("#filterawalkartustok").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
    $('#filteraakhirkartustok').val(moment().format('DD-MM-YYYY'));
    $("#filteraakhirkartustok").datepicker({todayHighlight: true,format:'dd-mm-yyyy',});
});
function loadtabelutama() {
getCsrfTokenCallback(function() {
    $("#tabelmember").DataTable({
        fixedColumns:{leftColumns: 2},
        columnDefs: [
            { className: "text-right",targets: [6, 7]},
        ],
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
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
        scrollY: "80vh",
        scrollX: true,
        bFilter: false,
        ajax: {
            "url": baseurljavascript + 'masterdata/ajaxdaftarmember',
            "method": 'POST',
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
                d.KATAKUNCIPENCARIAN = $('#kodemember').val() == null ? "" : $('#kodemember').val();
                d.KONDISIQUERY = '1';
                d.DIMANA1 = "ASCKODEMEMBER";
                d.MEMBERGROUP = $('#membergroup').val();
                d.RANGEAWAL = $('#filterawalkartustok').val();
                d.RANGEAKHIR = $('#filteraakhirkartustok').val();
                d.STATUSMEMBER = statusmember;
                d.ISFILTERDATE = $('#filterberdasarkantanggal').is(":checked");
                d.KODEUNIKMEMBER = session_kodeunikmember;
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        }
    });
});
}
function onclickdisablemember(kodemember, namamember,kondisiitem){
    Swal.fire({
        title: kondisiitem == "0" ? "Aktifkan Member" : "Tidak Aktif Member",
        text: kondisiitem == "0" ? "Apakah anda ingin mengaktifkan "+namamember+" ["+kodemember+"] ini kembali" : "Apakah anda ingin mengubah "+namamember+" ["+kodemember+"] ini menjadi tidak aktif, hal ini menjadikan member ini tidak dapat dicari tetapi dapat muncul di laporan",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: kondisiitem == "0" ? "Aktifkan member sekarang" : "Oke, Jadikan tidak aktif"
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'masterdata/statusmember',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        KONDISI : kondisiitem,
                        KODEMEMBER: kodemember,
                        KODEUNIKMEMBER: session_kodeunikmember,
                        NAMAMEMBER: namamember,
                    },
                    success: function (response) {
                        var obj = $.parseJSON(response);
                        if (obj.status == "true"){
                            getCsrfTokenCallback(function() {
                                $('#tabelmember').DataTable().ajax.reload();
                            });
                            Swal.fire(
                                'Berhasil.. Horee!',
                                obj.msg,
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                obj.msg,
                                'success'
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
$("#simpanmember").on("click", function(){
    if ($("#namadepan").val() == "" || $("#namabelkang").val() == "" || $("#alamatmember").val() == "" || $("#kotamember").val() == "" || $("#alamatsales").val() == "" || $("#kodemember").val() == "" || $("#membergroup").val() == null){
        return Swal.fire({
            icon: 'warning',
            html: 'Silahkan lengkapi informasi NAMA DEPAN BELAKANG, ALAMAT, KOTA ,<br> ALAMAT , KODE MEMBER serta MEMBER GROUP dari member anda',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Simpam Informasi Member",
        text: $('#isinsert').is(":checked") == false ? 'Apakah anda ingin mengubah data NAMA '+$("#namadepan").val() : "Apakah anda ingin menambahkan NAMA : "+$("#namadepan").val() +" "+ $("#namabelkang").val() +" dengan KODE ["+$("#kodemember").val()+"] ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: $('#isinsert').is(":checked") == false ? 'Oke, Ubah Data' : 'Oke, Tambah Info Member!'
    }).then((result) => {
        if (result.isConfirmed) {
            if ($('input[name="rb_statusmembernya"]:checked').val() == 1) { statusmember = 1;} else { statusmember = 0;}
            if ($('input[name="rb_statusmember"]:checked').val() == 1) { masaaktif = 1;} else { masaaktif = 0;}
            $('#simpanmember').prop("disabled",true);
            $('#simpanmember').html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'masterdata/jsontambahmember',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        MEMBER_ID : $('#kodemember').val(),
                        NAMA: $('#namadepan').val()+"::"+$('#namabelkang').val(),
                        ALAMAT: $('#alamatmember').val(),
                        KECAMATAN: $('#kecamatan').val(),
                        KOTA: $('#kotamember').val(),
                        PROVINSI: $('#provinsi').val(),
                        NEGARA: $('#negaramember').val(),
                        KODEPOS: $('#kodepos').val(),
                        JK:  $('#jeniskelamin').val(),
                        EMAIL:  $('#emailmember').val(),
                        TELEPON:  $('#notelpmember').val(),
                        FAX: "",
                        AKHIRAKTIF: masaaktif == 1 ? "9999-12-31" :  $('#akhiraktifmember').val().split("-").reverse().join("-"),
                        STATUSAKTIF : statusmember,
                        POINT: "0",
                        NOREK: "",
                        PEMILIKREK: "",
                        BANK: "",
                        NPWP: "",
                        KETERANGAN: $('#keteranganmember').val(),
                        LIMITJUMLAHPIUTANG: limitmember.getNumber(),
                        JENIS: $('#jenismember').val(),
                        GRUP: $('#membergroup').val(),
                        MINIMALPOIN: minbelanjaperpoint.getNumber(),
                        BATASTAMBAHKREDIT:jatuhtempomember.getNumber(),
                        KEJARTARGET : "0",
                        NAMAFILE : "",
                        USERNAME: $('#usernameid').val(),
                        PASSWORD: $('#passwordakses').val(),
                        CATATAN: "",
                        LIMITBARANGONLINE: "",
                        LOGO: "",
                        LIMIT_BRG: limitbarangmember.getNumber(),
                        NISBACKUP: "",
                        KODEUNIKMEMBER: session_kodeunikmember,
                        OUTLET: session_outlet,
                        NOMOR: statusmember == 1 ? "1" : "0",
                        TOTALDEPOSIT: "0",
                        ISRESELLER: "0",
                        ANGKAKESUKAAN: Math.floor((Math.random() * 10) + 1),
                        ISINSERT : $('#isinsert').is(":checked"),
                        PINTRX : $('#pintrx').val(),
                        APIKEY : $('#apikey').val(),
                        MARKUP : $('#markuphargaagen').val(),
                    },
                    complete:function(){
                        $('#simpanmember').prop("disabled",false);
                        $('#simpanmember').html('Simpan Informasi Member');
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            Swal.fire({
                                title: "Berhasil Horeee!!!",
                                text: response.msg,
                                icon: 'success',
                            });
                            if (!$('#isinsert').is(":checked")) return setTimeout(function(){ location.href = baseurljavascript+"masterdata/daftarmember"; }, 1000);
                            $('#kodemember').val("")
                            $('#namadepan').val("")
                            $('#namabelkang').val("")
                            $('#alamatmember').val("")
                            $('#kecamatan').val("")
                            $('#kotamember').val("")
                            $('#provinsi').val("")
                            $('#negaramember').val("")
                            $('#kodepos').val("")
                            $('#jeniskelamin').val("")
                            $('#emailmember').val("")
                            $('#notelpmember').val("")
                            $('#keteranganmember').val("")
                            $('#limitmember').val("")
                            $('#minbelanjaperpoint').val("")
                            $('#usernameid').val("")
                            $('#passwordakses').val("")
                            $('#pintrx').val("")
                            $('#apikey').val("")
                            $('#markuphargaagen').val("")
                            $('#limitbarangmember').val("")
                            $('#jatuhtempomember').val("")
                        }else{
                            Swal.fire({
                                title: "Gagal... Uhhh",
                                text: response.msg,
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
    });
});
$("#prosesmember").on("click", function(){
    if ($('input[name="rb_statusmember"]:checked').val() == 1) {
        statusmember = 1;
    } else {
        statusmember = 0;
    }
    getCsrfTokenCallback(function() {
        $('#tabelmember').DataTable().ajax.reload();
    });
});
