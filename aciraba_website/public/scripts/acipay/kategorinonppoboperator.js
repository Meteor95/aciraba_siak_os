$(function () {
    loadoperator();
});
function loadoperator(){
    $("#daftaroperator").DataTable({
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
        columnDefs: [
            { width: 45, targets: 0 },
            { "targets": [1,2,3], "createdCell": function (td, cellData, rowData, row, col) { $(td).css('padding-top', '15px') }}
        ],
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false,
        ajax: {
            "url": baseurljavascript + 'acipay/ajaxoperatordt',
            "method": 'POST',
            "data": function (d) {
                d.KATAKUNCI = $('#katakunci').val();
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        }
    });
}
$('#katakunci').on('input', debounce(function (e) {
    $('#daftaroperator').DataTable().ajax.reload();
}, 500));
$("#tambahoperator").on("click", function () {
    if ($("#acipay_idkategori").val() == "" || $("#acipay_namakategori").val() == "" || $("#prefixoperator").val() == ""){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan lengkapi informasi <strong>ID OPERATOR</strong>,<br><strong>NAMA OPERATOR</strong>, serta <strong>PREFIX</strong> dari operator tersebut',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: $('#isedit').is(':checked') ? "Apakah anda ingin mengubah data OPERATOR "+$("#acipay_namakategori").val()+" dengan KODE "+$("#acipay_idkategori").val() : "Apakah anda ingin menambahkan OPERATOR : "+$("#acipay_namakategori").val()+" dengan KODE "+$("#acipay_idkategori").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: $('#isedit').is(':checked') ? 'Oke, Saya Ubah!' : 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseurljavascript + 'acipay/ajaxtambahacipayoperator',
                method: 'POST',
                dataType: 'json',
                data: {
                    APISERVER_ID : "0",
                    OPERATOR_ID : $("#acipay_idkategori").val(),
                    OPERATOR_NAMA : $("#acipay_namakategori").val(),
                    PREFIX : ""+$('#prefixoperator').val()+"",
                    IMGURL : $("#urlgamabar").val(),
                    STATUS : $("#statusoperator").val(),
                    ISEDIT : $('#isedit').is(':checked'),
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    $('#daftaroperator').DataTable().ajax.reload();
                    if (obj.status == "true"){
                        Swal.fire(
                            'Berhasil.. Horee!',
                            obj.msg,
                            'success'
                        )
                        $('#acipay_idkategori').prop('readonly', false);
                        $("#acipay_idkategori").val("");
                        $("#acipay_namakategori").val("");
                        $("#urlgamabar").val("");
                        $("#statusoperator").val("1").change();
                        $('#prefixoperator').val(null).trigger('change');
                        $('#tambahoperator').html("Tambah Informasi");
                        $('#isedit').prop('checked', false);
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
function ubahinformasi(id,nama,prefix,status,url){
    prefix.split(',').forEach(function (item, index) {
        if ($('#prefixoperator').find("option[value='" + item + "']").length) {
            $('#prefixoperator').val(item).trigger('change');
        } else { 
            const newOption = new Option(item, item, true, true);
            $('#prefixoperator').append(newOption).trigger('change');
        }
    });
    $('#acipay_idkategori').prop('readonly', true);
    $('#tambahoperator').html("Ubah Informasi");
    $('#isedit').prop('checked', true);
    $('#acipay_idkategori').val(id);
    $('#acipay_namakategori').val(nama);
    $('#prefixoperator').val(prefix.split(',')).trigger('change');
    $("#statusoperator").val(status).change();
    $('#urlgamabar').val(url);

}
function deleteoperator(operatorid, operatornama){
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menhapus OPERATOR : "+operatornama+" dengan KODE "+operatorid+". Informasi yang mengandung OPERATOR "+operatornama+" tidak akan bisa dicari oleh PELANGGAN",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Saya Yakin!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseurljavascript + 'acipay/acipayhapusoperator',
                method: 'POST',
                dataType: 'json',
                data: {
                    OPERATOR_ID : operatorid,
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    $('#daftaroperator').DataTable().ajax.reload();
                    if (obj.status == "true"){
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