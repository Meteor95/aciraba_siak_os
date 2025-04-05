let acipaydatakategorinonppob;
let quill;
const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],

    ['clean']                                         // remove formatting button
    ];
quill = new Quill('#keterangan', {
    modules: { toolbar: toolbarOptions },
    theme: 'snow'
});
$(function () {
    loaddatakategori();
    quill;
});
function loaddatakategori(){
    acipaydatakategorinonppob =  $("#acipaydatakategorinonppob").DataTable({
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
            { "targets": [1,2,3,4], "createdCell": function (td, cellData, rowData, row, col) { $(td).css('padding-top', '15px') }}
        ],
        "columns": [
            { "className":'',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
        ],
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false,
        ajax: {
            "url": baseurljavascript + 'acipay/ajaxdaftarkategoriacipaynonppob',
            "method": 'POST',
            "data": function (d) {
                d.KATAKUNCI = $('#katakunci').val();
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        }
    });
}
function detailkategorinonppob (d) {
    return "<table style='padding-left:50px;'>"+
        "<tr>"+
            '<td>Placeholder</td>'+
            '<td>'+d[5]+'</td>'+
        "</tr>"+
        "<tr>"+
            '<td>Keterangan</td>'+
            '<td>'+decodeEntities(d[6])+'</td>'+
        "</tr>"+
    '</table>';
}
$('#acipaydatakategorinonppob tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = acipaydatakategorinonppob.row( tr );
    if ( row.child.isShown() ) {
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        row.child(detailkategorinonppob(row.data()) ).show();
        tr.addClass('shown');
    }
} );
$("#tambahkategori").on("click", function () {
    if ($("#acipay_idkategori").val() == "" || $("#acipay_namakategori").val() == "" || $("#statuskategori").val() == "" || $("#formattrx").val() == "" ){
        return Swal.fire({
            icon: 'error',
            html: 'Silahkan lengkapi informasi <strong>ID KATEGORI</strong>,<br><strong>NAMA KATEGORI</strong>,<strong>STATUS KATEGORI</strong>,<br>serta <strong>FORMAT TRANSKASI</strong> dari KATEGORI tersebut',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            position: 'bottom-end',
        })
    }
    Swal.fire({
        title: "Apakah anda yakin?",
        text: $('#isedit').is(':checked') ? "Apakah anda ingin mengubah data KATEGORI "+$("#acipay_namakategori").val()+" dengan KODE "+$("#acipay_idkategori").val() : "Apakah anda ingin menambahkan KATEGORI : "+$("#acipay_namakategori").val()+" dengan KODE "+$("#acipay_idkategori").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: $('#isedit').is(':checked') ? 'Oke, Saya Ubah!' : 'Oke, Tambahkan!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseurljavascript + 'acipay/ajaxtambahacipaykategori',
                method: 'POST',
                dataType: 'json',
                data: {
                    APISERVER_ID : "1",
                    URUTAN : "0",
                    KATEGORI_ID : $("#acipay_idkategori").val(),
                    KATEGORI_NAMA : $("#acipay_namakategori").val(),
                    TIPE : $("#formattrx").val(),
                    IMGURL : $("#imgruel").val(),
                    SLUG_URL : $("#acipay_namakategori").val(),
                    STATUS : $('#statuskategori').val(),
                    PLACEHOLDER : $("#placeholderketerangan").val(),
                    KETERANGAN : $("#keterangan").html(),
                    ISEDIT : $('#isedit').is(':checked'),
                    IDOPERATOR : $('#kuncioperator').val(),
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    $('#acipaydatakategorinonppob').DataTable().ajax.reload();
                    if (obj.status == "true"){
                        Swal.fire(
                            'Berhasil.. Horee!',
                            obj.msg,
                            'success'
                        )
                        quill = new Quill('#keterangan');
                        quill.setContents([{insert: ' '}]);
                        $('#acipay_idkategori').prop('readonly', false);
                        $("#acipay_idkategori").val("");
                        $("#acipay_namakategori").val("");
                        $("#imgruel").val("");
                        $("#placeholderketerangan").val("");
                        $("#statuskategori").val("1").change();
                        $('#tambahkategori').html("Tambah Informasi");
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
function deletekategori(kategoriid, kategorinama){
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menhapus KATEGORI : "+kategorinama+" dengan KODE "+kategoriid+". Informasi yang mengandung KATEGORI "+kategorinama+" tidak akan bisa dicari oleh PELANGGAN",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Saya Yakin!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseurljavascript + 'acipay/acipayhapuskategori',
                method: 'POST',
                dataType: 'json',
                data: {
                    KATEGORI_ID : kategoriid ,
                },
                success: function (response) {
                    var obj = $.parseJSON(response);
                    $('#acipaydatakategorinonppob').DataTable().ajax.reload();
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
function ubahinformasi(kategoriid, kategorinama, imgurl, status, tipe, placeholder, keterangan, operatorid){
    $('#tambahkategori').html("Ubah Informasi");
    $('#acipay_idkategori').prop('readonly', true);
    $('#acipay_idkategori').val(kategoriid);
    $('#acipay_namakategori').val(kategorinama);
    $('#imgruel').val(imgurl);
    $('#statuskategori').val(status).change();
    $('#formattrx').val(tipe).change();
    $('#placeholderketerangan').val(placeholder);
    $("#keterangan").html(keterangan);
    $('#isedit').prop('checked', true);
}
function sinkronbarang(){
    if (validasisinkron == "KONFIRMASI"){
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Apakah anda ingin menambahkan KATEGORI : "+$('#kategorinama').html()+" dengan KODE "+$('#kategoriidsinkron').html()+".Barang yang memiliki KODEBARANG sama akan mengalami UPDATE data, jika tidak ada KODEBARANG tersedia maka akan ditambahkan sebagai barang baru",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke, Saya Yakin!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#modalsinkronproduk').block();
                $.ajax({
                    url: baseurljavascript + 'acipay/sinkronproduk',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        JENISPRODUK: $('#jenisproduk').val(),
                        KATPRODUK: "", /*kosongin aja dikarenakan mau load semua data */
                        PEMISAH: $('#pemisakproduk').val(),
                        BATASJUMLAH: $('#pemisakproduk').val().length,
                        PRODUK_OPERATOR_ID: $('#operatorproduk').val(),
                        PRODUK_KATEGORI_ID: $('#kategoriidsinkron').html(),
                        IKONPRODUK: $('#iconproduk').val(),
                    },
                    success: function (response) {
                        var obj = $.parseJSON(response);
                        if (obj.status == "true") {
                            Swal.fire(
                                'Sinkron Sukses. Horee!!',
                                obj.msg,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'Gagal.. Uhhhhh!',
                                obj.msg,
                                'warning'
                            )
                        }
                        $('#modalsinkronproduk').unblock();
                    }
                });
            }
        });
    }else{
        $('#kategorinama').html(kategorinama);
        $('#kategoriidsinkron').html(kategoriid);
    }
}