
let daftarprodukacipay, statusdata;
$(function () {
    statusdata = 1;
    loadmore();
    statusbarangcheck = "";
});
function format ( d ) {
    return '<table style="padding-left:50px;">'+
        '<tr>'+
            '<td>Keterangan :</td>'+
            '<td>'+d[11]+'</td>'+
        '</tr>'+
    '</table>';
}
function loadmore(){
    $('#daftarprodukacipay tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = daftarprodukacipay.row( tr );
        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
    daftarprodukacipay =  $("#daftarprodukacipay").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        dom: 'Bfrtip',
        columns: [
            { "className":'',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
            { "className":'details-control',},
        ],
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
            {className: "text-right",targets: [4,5,6,7]},
            {visible: false, "targets": [10,11] },
            {width: 45, targets: [0,1] },
            {"targets": [2,3,4,5,6,7,8,9], "createdCell": function (td, cellData, rowData, row, col) { $(td).css('padding-top', '15px') }}
        ],
        scrollCollapse: true,
        scrollY: "50vh",
        scrollX: true,
        bFilter: false,
        ajax: {
            "url": baseurljavascript + 'acipay/dafartranskasi',
            "method": 'POST',
            "data": function (d) {
                d.KONDISIMODEL = "TABEL";
                d.KODEUNIKMEMNER = session_kodeunikmember,
                d.AGEN = session_namapengguna;
                d.LOKASI = session_outlet;
                d.KATAKUNCIPENCARIAN = $('#katakunciproduk').val();
                d.PARAMETERPENCARIAN = $('#jenisproduk').val();
                d.STATUSTRANSKASI = statusbarangcheck;
                d.STATUSMEMBER = session_statusmember;
                d.TANGGALAWAL = $('#daritanggal').val();
                d.TANGGALAKHIR = $('#sampaitanggal').val();
                d.STATUSDATA = statusdata;
                d.DATAKE = 0;
                d.LIMIT = 500;
            },
        },
        fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            if (aData[10] == "0"){ $('td', nRow).css('background-color', 'Yellow'); }
        }
    });
}
function statusbarang(){
    if ($('input[name="rb_statusbarang"]:checked').val() == "1") {
        statusbarangcheck = 1;
    }else if ($('input[name="rb_statusbarang"]:checked').val() == "2") {
        statusbarangcheck = 2;
    }else if ($('input[name="rb_statusbarang"]:checked').val() == "0") {
        statusbarangcheck = 0;
    }else{
        statusbarangcheck = "";
    }
}
$("#prosescaricmb").on("click", function(){
    statusbarang();
    $('#daftarprodukacipay').DataTable().ajax.reload();
});
$('#jenisproduk').on('change', function() {
    statusbarang();
    $('#daftarprodukacipay').DataTable().ajax.reload();
});
$('#katakunciproduk').on('input', debounce(function (e) {
    $('#daftarprodukacipay').DataTable().ajax.reload();
}, 500));
function hapustransaksiacipay(transaksiid,namaproduk){
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Apakah anda ingin menghapus TRANSAKSI dengan ID "+transaksiid+" dengan NAMA PRODUK "+namaproduk+" ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Hapus Sekarang!!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseurljavascript + 'acipay/hapuspenjualan',
                method: 'POST',
                dataType: 'json',
                data: {
                    TRANSAKSIID : transaksiid,
                    OUTLET:session_outlet,
                    KODENIKMEMBER:session_kodeunikmember,
                    NAMAPRODUK:namaproduk,
                },
                success: function (response) {
                    if (response[0].success == "true"){
                        Swal.fire(
                            'Data TRANSAKSI di HAPUS',
                            "ID : "+transaksiid+" "+response[0].msg,
                            'success'
                        )
                        statusbarang();
                        $('#daftarprodukacipay').DataTable().ajax.reload();
                    }else{
                        Swal.fire(
                            'Gagal.. Uhhhhh!',
                            response[0].msg,
                            'warning'
                        )
                    }
                }
            });
        }
    });
}
function kirimulangfn(idtransaksi,idserver,nomortujuan,produknya){
    $(".idtranskasisekarang").html(idtransaksi);
    $("#ketujuanulang").html(idserver);
    $("#nomortujuanulang").html(nomortujuan);
    $("#produknyaulang").html(produknya);
}
$("#kirimulangtrx").on("click", function(){
    $.blockUI({message:"Membaca informasi dari NO TUJUAN "+$('#nomortujuanulang').html()+" slur. Tunggu yaa..."});
    $.ajax({
        url: baseurljavascript + 'acipay/cektransaksi',
        method: 'POST',
        dataType: 'json',
        data: {
            TRANSKASI_ID : $(".idtranskasisekarang").html(),
            IDSERVER : $('#ketujuanulang').html(),
            TUJUAN : $('#nomortujuanulang').html(),
            KODEPRODUK : $('#produknyaulang').html(),
        },
        success: function (response) {
            Swal.fire(
                'INFORMASI DARI DEALER',
                "ID : "+$(".idtranskasisekarang").html()+" ["+$('#produknyaulang').html()+"] dengan TUJAUN "+$('#nomortujuanulang').html()+" berstatus "+response[0].data.status+" dengan keterangan "+response[0].data.message,
                'success'
            )
        }
    });
    $.unblockUI();
});
$("#transaksilampau").on("click", function(){
    if (statusdata == 1){
        statusdata = 0;
        $('#daritanggal').val(moment().startOf('month').format('DD-MM-YYYY'));
        $('#sampaitanggal').val(moment().format("DD-MM-YYYY"));
        $('.input-daterange').show();
        $(".titleheader").html('TRANSAKSI LAMPAU')
        $('#divnyaprosescaricmb').removeClass("col-md-12").addClass("col-md-7");
        $("#transaksilampau").html('<i class="fas fa-clipboard-list"></i> Transaksi Hari Ini')
    }else{
        statusdata = 1;
        $('#daritanggal').val(moment().format("DD-MM-YYYY"));
        $('#sampaitanggal').val(moment().format("DD-MM-YYYY"));
        $('.input-daterange').hide();
        $(".titleheader").html('TRANSAKSI HARI INI')
        $('#divnyaprosescaricmb').removeClass("col-md-7").addClass("col-md-12");
        $("#transaksilampau").html('<i class="fas fa-clipboard-list"></i> Transaksi Lampau')
    }
    $('#daftarprodukacipay').DataTable().ajax.reload();
});