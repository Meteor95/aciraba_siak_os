<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
    .grid {
        --gap: 1em;
        --columns: 4;
        max-width: 200rem;
        margin: 0 auto;
        columns: var(--columns);
        gap: var(--gap);
    }

    .grid>* {
        break-inside: avoid;
        margin-bottom: var(--gap);
    }

    @supports (grid-template-rows: masonry) {
        .grid {
            display: grid;
            grid-template-columns: repeat(var(--columns), 1fr);
            grid-template-rows: masonry;
            grid-auto-flow: dense;
            /* align-tracks: stretch; */
        }

        .grid>* {
            margin-bottom: 0em;
        }
    }

    .flow>*+* {
        margin-top: var(--flow-space, var(--spacer));
    }

    .content {
        padding: 0.3em;
        box-shadow: 0 0 3em rgba(0, 0, 0, 0.15);
    }

    .title {
        font-weight: 900;
        color: var(--clr-primary);
        line-height: 0.8;
    }

    .card {
        background-color: #fff;
        border: none;
        border-radius: 10px;
        width: 200px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    }

    .image-container {
        position: relative
    }

    .thumbnail-image {
        border-radius: 10px !important
    }

    .discount {
        background-color: red;
        padding-top: 1px;
        padding-bottom: 1px;
        padding-left: 4px;
        padding-right: 4px;
        font-size: 10px;
        border-radius: 6px;
        color: #fff
    }

    .wishlist {
        height: 25px;
        width: 25px;
        background-color: #eee;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    }

    .first {
        position: absolute;
        width: 100%;
        padding: 9px
    }

    .dress-name {
        font-size: 13px;
        font-weight: bold;
        width: 75%
    }

    .new-price {
        font-size: 13px;
        font-weight: bold;
        color: red
    }

    .old-price {
        font-size: 8px;
        font-weight: bold;
        color: grey
    }
    .item-size {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #fff;
        border: 1px solid grey;
        color: grey;
        font-size: 10px;
        text-align: center;
        align-items: center;
        display: flex;
        justify-content: center
    }

    .rating-star {
        font-size: 10px !important
    }

    .rating-number {
        font-size: 10px;
        color: grey
    }

    .buy {
        font-size: 12px;
        color: orange;
        font-weight: 500
    }

    .voutchers {
        background-color: #fff;
        border: none;
        border-radius: 10px;
        width: 200px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        overflow: hidden
    }

    .voutcher-divider {
        display: flex
    }

    .voutcher-left {
        width: 60%
    }

    .voutcher-name {
        color: grey;
        font-size: 9px;
        font-weight: 500
    }

    .voutcher-code {
        color: red;
        font-size: 11px;
        font-weight: bold
    }

    .voutcher-right {
        width: 40%;
        background-color: purple;
        color: #fff
    }

    .discount-percent {
        font-size: 12px;
        font-weight: bold;
        position: relative;
        top: 5px
    }

    .off {
        font-size: 14px;
        position: relative;
        bottom: 5px
    }
    @media screen and (max-width: 750px) {
        .grid {
            --columns: 2;
            columns: var(--columns);
        }
        .card {
            width: 180px;
        }
        .off {
            font-size: 12px;
        } 
    }
    .text-wrap{
        white-space:normal;
    }
    .width-200{
        width:200px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <!-- BEGIN Portlet -->
                <div class="portlet portlet-primary">
                    <div class="portlet-body">
                        <!-- BEGIN Widget -->
                        <div class="widget4 mb-3">
                            <div class="widget4-group">
                                <div class="widget4-display">
                                    <div id="tanggaltrx"></div>
                                    <h3 class="widget4-subtitle text-white">Total Transaksi Pelanggan</h3>
                                    <h2 class="widget4-hightlight text-white"><div id="nominaltotaltrx"></div></h2>
                                </div>
                            </div>
                        </div>
                        <!-- END Widget -->
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- BEGIN Widget -->
                                <div class="widget4">
                                    <div class="widget4-group">
                                        <div class="widget4-display">
                                            <h3 class="widget4-subtitle text-white">Tipe Pembayaran</h3>
                                            <h2 class="widget4-hightlight text-white"><div id="jenispembayaran"></div></h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Widget -->
                            </div>
                            <div class="col-sm-6">
                                <!-- BEGIN Widget -->
                                <div class="widget4">
                                    <div class="widget4-group">
                                        <div class="widget4-display">
                                            <h3 class="widget4-subtitle text-white">Total Item</h3>
                                            <h2 class="widget4-hightlight text-white"><div id="totalqty"></div></h2>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Widget -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet -->
                <div style="display: none;" id="trxformat"></div>
                <div class="d-flex mb-2">
                    <div class="btn-group btn-block">
                        <button onclick="aksisemuastatus('Dalam Perjalanan')" class="btn btn-label-info btn-lg btn-widest"> <i class="fa fa-truck-moving"></i> Kirim Semua </button>
                        <button onclick="aksisemuastatus('Batal Dari Penjual')" class="btn btn-label-info btn-lg btn-widest"> <i class="fa fa-level-down-alt"></i> Batalkan </button>
                    </div>
                    <!-- END Button Group -->
                </div>
                <div class="d-flex">
                    <div class="btn-group btn-block">
                        <button onclick="aksisemuastatus('Proses Pengemasan')" class="btn btn-label-info btn-lg btn-widest"> <i class="fa fa-box-open"></i> Proses Pengemasan </button>
                    </div>
                    <!-- END Button Group -->
                </div>
            </div>
            <div class="col-md-6 col-lg-8 mt-3 mt-md-0">
                <!-- BEGIN Portlet -->
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div class="portlet-icon"><i class="fa fa-tasks"></i></div>
                        <h3 class="portlet-title">Informasi Penerima Paket</h3>
                        <button id="" class="btn btn-success float-right"> <i class="fas fa-map-marked-alt"></i> Lacak
                            Paket</button>
                    </div>
                    <div class="portlet-body p-0">
                        <!-- BEGIN Rich List -->
                        <div class="rich-list rich-list-flush">
                            <div class="rich-list-item p-3">
                                <div class="rich-list-prepend">
                                    <!-- BEGIN Avatar -->
                                    <img style="width: 150px; height: 150px;" class="mw-100"
                                        src="https://res.cloudinary.com/teepublic/image/private/s--R83ha01t--/t_Resized%20Artwork/c_fit,g_north_west,h_954,w_954/co_000000,e_outline:48/co_000000,e_outline:inner_fill:48/co_ffffff,e_outline:48/co_ffffff,e_outline:inner_fill:48/co_bbbbbb,e_outline:3:1000/c_mpad,g_center,h_1260,w_1260/b_rgb:eeeeee/c_limit,f_auto,h_630,q_90,w_630/v1563221181/production/designs/5323277_0.jpg"
                                        alt="Max-width 100%">
                                    <!-- END Avatar -->
                                </div>
                                <div class="rich-list-content">
                                    <span class="rich-list-title">Nama Pelanggan</span>
                                    <span class="rich-list-subtitle"><div id="namapemesan"></div></span>
                                    <span class="rich-list-title">Alamat Penerima</span>
                                    <span class="rich-list-subtitle"><div id="alamatpemesan"></div></span>
                                    <span class="rich-list-title">Alamat Penagihan</span>
                                    <span class="rich-list-subtitle"><div id="alamatpenagihan"></div></span>
                                    <span class="rich-list-title">No Telp</span>
                                    <span class="rich-list-subtitle"><div id="notelppemesan"></div></span>
                                </div>
                            </div>
                            <span style="text-align:center">
                                <h3 class="portlet-title">Keterangan Tambahan</h3>
                            </span>
                            <div class="ml-3 mr-3 mb-3"><div id="keterangantrx"></div></div>
                        </div>
                        <!-- END Rich List -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <div class="portlet-icon"><i class="fa fa-tasks"></i></div>
                <h3 class="portlet-title">Informasi Pesanan</h3>
                <div class="btn-group btn-group-toggle" id="jenistampilan" data-toggle="buttons">
                    <label class="btn btn-flat-primary active">
                        <input type="radio" name="radio_listgrid" id="radio-button1" value="1" checked="checked"> List </label>
                    <label class="btn btn-flat-primary">
                        <input type="radio" name="radio_listgrid" id="radio-button2" value="0"> Grid </label>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="grid">
                        <div id="daftarpesanandetail"></div>
                    </div>
                </div>
                <div id="idtampilpencarian" class="input-group mb-2"><input value="" type="text" id="pencariantabelpesanan" class="form-control" placeholder="Masukkan Nama Item"> <div class="input-group-prepend"> <span id="generateiditem" class="input-group-text btn-warning btn">Seleksi</span> </div> </div>
                <div id="daftarpesanandetailtabel"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="<?= base_url();?>scripts/penjualan/pesanan.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        panggilpesanan("tabel");
    });
function panggilpesanan(isgrid){
    let formatter = new Intl.NumberFormat('id-ID', {style: 'currency',currency: 'IDR',});
    $.ajax({
        url: baseurljavascript + 'penjualan/jsondaftarpesananmodedetail',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI: "3",
            DIMANA1: '<?= $notanonformat ;?>',
            DIMANA6: "notanonformat", 
            DIMANA19: session_outlet,
            DIMANA20: session_kodeunikmember,
            DATAKE: 0 ,
            LIMIT: 500,
            JENISLAYOUT:isgrid
        },
        success: function (response) {
            let gambarnya,totalqtykeluar = 0, nominaltotaltrx = 0;
            $("#jenispembayaran").html(response[0].dataquery[0].ENUM_TIPETRANSAKSI);
            $("#namapemesan").html(response[0].dataquery[0].NAMA);
            $("#alamatpemesan").html(response[0].dataquery[0].ALAMAT);
            $("#alamatpenagihan").html(response[0].dataquery[0].ALAMAT);
            $("#notelppemesan").html(response[0].dataquery[0].TELEPON);
            $("#keterangantrx").html(response[0].dataquery[0].KETERANGANTRX);
            $("#trxformat").html(response[0].dataquery[0].PK_NOTAPENJUALAN);
            $("#tanggaltrx").html("TRX TGL : "+response[0].dataquery[0].TGLKELUAR+" "+response[0].dataquery[0].WAKTU);
            $("#daftarpesanandetailtabel").html("");
            $("#daftarpesanandetail").html("");
            if (isgrid == "grid"){
                $("#idtampilpencarian").hide();
                for (cardke = 0; cardke < response[0].totaldata; cardke++) {
                gambarnya = '<?=base_url();?>upload/citraitem/'+response[0].dataquery[cardke].FILENAME;
                    if (response[0].dataquery[cardke].FILENAME == ''){
                        gambarnya = 'https://img.freepik.com/free-vector/hand-drawn-food-background_52683-2954.jpg?size=338&ext=jpg';
                    }
                    $("#daftarpesanandetail").append("<div class=\"card mb-4\"><div class=\"image-container\"><div class=\"first\"><div class=\"d-flex justify-content-between align-items-center\"> <span class=\"discount\">"+response[0].dataquery[cardke].JENISTRANSAKSI+"</span> <span style=\"cursor:pointer\" onclick=\"onclickakses('"+response[0].dataquery[cardke].NOTANONFORMAT+"','"+response[0].dataquery[cardke].PK_NOTAPENJUALAN+"','"+response[0].dataquery[cardke].FK_BARANG+"','"+response[0].dataquery[cardke].NAMABARANG+"','"+response[0].dataquery[cardke].JENISTRANSAKSI+"','hapuskah')\" class=\"wishlist\"><i class=\"fas fa-stream\"></i></span> </div></div> <img src="+gambarnya+" class=\"img-fluid rounded thumbnail-image\"></div><div class=\"product-detail-container p-2\"><div class=\"d-flex justify-content-between align-items-center\"><h5 class=\"dress-name\" style=\"text-align: justify\">"+response[0].dataquery[cardke].NAMABARANG+"</h5><div class=\"d-flex flex-column mb-2\"> <span class=\"new-price\">"+response[0].dataquery[cardke].STOKBARANGKELUAR+"</span> <small class=\"old-price text-right\">"+response[0].dataquery[cardke].SATUANBARANG+"</small> </div></div><div class=\"d-flex justify-content-between align-items-center pt-1\"><p>"+response[0].dataquery[cardke].KETERANGAN+"</p></div><div class=\"d-flex justify-content-between align-items-center pt-1\"><div> <i class=\"fas fa-star\"></i> <span class=\"rating-number\">5.0</span></div><span class=\"buy\"> Kode Item / SKU : "+response[0].dataquery[cardke].FK_BARANG+"</span></div></div><div class=\"mt-3\"><div class=\"card voutchers\"><div class=\"voutcher-divider\"><div onclick=\"onclickakses('"+response[0].dataquery[cardke].NOTANONFORMAT+"','"+response[0].dataquery[cardke].PK_NOTAPENJUALAN+"','"+response[0].dataquery[cardke].FK_BARANG+"','"+response[0].dataquery[cardke].NAMABARANG+"','"+response[0].dataquery[cardke].JENISTRANSAKSI+"','kurir')\" style=\"cursor:pointer\" class=\"voutcher-left text-center\"> <span class=\"voutcher-name\">Saya Kirim Ke Kurir</span><h5 class=\"voutcher-code\">#VIA "+response[0].dataquery[cardke].KODEJASAKIRIM+"</h5></div><div style=\"cursor:pointer\" class=\"voutcher-right text-center border-left\"><h5 class=\"discount-percent\">0%</h5> <span class=\"off\">OFF</span></div></div></div></div></div>");
                totalqtykeluar = (totalqtykeluar + response[0].dataquery[cardke].STOKBARANGKELUAR);
                nominaltotaltrx = (nominaltotaltrx + response[0].dataquery[cardke].TOTALTRX);
                }
            }else if (isgrid == "tabel"){
                $("#idtampilpencarian").show();
                $("#daftarpesanandetailtabel").append('<table id="tabelpesanangrid" class="table table-bordered table-striped table-hover nowrap"><thead><tr><th>Aksi</th><th>Kode Item / SKU</th><th>Nama Item</th><th>Harga Jual</th><th>Stok Keluar</th><th>Status TRX</th><th><strong>Catatan</strong></th></tr></thead><tbody></tbody></table>');
                let jsonData = new Array();
                for (cardke = 0; cardke < response[0].totaldata; cardke++) {
                    jsonData.push({
                        'FK_BARANG': response[0].dataquery[cardke].FK_BARANG,
                        'NAMABARANG': response[0].dataquery[cardke].NAMABARANG,
                        'TOTALTRX': formatter.format(response[0].dataquery[cardke].TOTALTRX),
                        'STOKBARANGKELUAR': response[0].dataquery[cardke].STOKBARANGKELUAR + " " +response[0].dataquery[cardke].SATUANBARANG,
                        'KETERANGAN': response[0].dataquery[cardke].KETERANGAN,
                        'NOTANONFORMAT': response[0].dataquery[cardke].NOTANONFORMAT,
                        'PK_NOTAPENJUALAN': response[0].dataquery[cardke].PK_NOTAPENJUALAN,
                        'JENISTRANSAKSI': response[0].dataquery[cardke].JENISTRANSAKSI,
                    })
                    totalqtykeluar = (totalqtykeluar + response[0].dataquery[cardke].STOKBARANGKELUAR);
                    nominaltotaltrx = (nominaltotaltrx + response[0].dataquery[cardke].TOTALTRX);
                }
                function format(row) {
                    return '<table">' +
                        '<tr>'+
                            '<td>Keterangan Pelanggan :</td>'+
                            '<td>'+row.KETERANGAN+'</td>'+
                        '</tr>'+
                    '</table>';
                }     
                let tabelpesangrid = $('#tabelpesanangrid').DataTable( {
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.childRowImmediate,
                            type: 'none',
                            target: '',
                        }
                    },
                    "dom": '<"top"l>rt<"bottom"B>',
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
                    language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
                    scrollCollapse: true,
                    scrollY: "50vh",
                    scrollX: true,
                    paging: false,
                    data: jsonData,
                    order: [],
                    columnDefs: [
                        { width: 45, targets: 0 },
                    ],
                    columns: [
                        {
                            "render": function ( data, type, full, meta ) {
                                return "<button onclick=\"onclickakses('"+full.NOTANONFORMAT+"','"+full.PK_NOTAPENJUALAN+"','"+full.FK_BARANG+"','"+full.NAMABARANG+"','"+full.JENISTRANSAKSI+"','kurir')\" class=\"btn btn-outline-info btn-icon\"><i class=\"fas fa-spell-check\"></i></button> <button onclick=\"onclickakses('"+full.NOTANONFORMAT+"','"+full.PK_NOTAPENJUALAN+"','"+full.FK_BARANG+"','"+full.NAMABARANG+"','"+full.JENISTRANSAKSI+"','hapuskah')\" class=\"btn btn-outline-danger btn-icon\"><i class=\"fas fa-stream\"></i></button>";
                            }
                        },
                        {
                            "data": "FK_BARANG",
                        },
                        {
                            "data": "NAMABARANG",
                        },
                        {
                            "data": "TOTALTRX",
                        },
                        {
                            "data": "STOKBARANGKELUAR",
                        },
                        {
                            "data": "JENISTRANSAKSI",
                        },
                        {
                            "data": "KETERANGAN",
                        },
                    ],
                } );
                $('#tabelpesanangrid tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tabelpesangrid.row( tr );
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');     
                    }else{
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }      
                } );
            }
            $("#totalqty").html(totalqtykeluar+" QTY");
            $("#nominaltotaltrx").html(formatter.format(nominaltotaltrx));
        }
    });
}
$("#pencariantabelpesanan").on("input", function () {
    $('#tabelpesanangrid').DataTable().columns([2]).search(this.value).draw();
});
$("#generateiditem").on("click", function () {
    $('#tabelpesanangrid').DataTable().columns([2]).search($("#pencariantabelpesanan").val()).draw();
});
$("#jenistampilan").click(function () {
    if ($('input[name="radio_listgrid"]:checked').val() == 1) {
        panggilpesanan("grid");
    } else {    
        panggilpesanan("tabel");
    }
});
function aksisemuastatus(jenistrx){
    let thistabel =  $('#tabelpesanangrid').DataTable();
    var numberOfRows = thistabel.data().length;
    for (var i = 0; i < numberOfRows; i++) {
        var data = thistabel.row(i).data();
        if (data.JENISTRANSAKSI == "Batal Dari Penjual") { //test cell for value
            return Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'Didalam transkasi ini terdapat status PEMBATALAN TRX<br>Silahkan lakukan pengecekan manual pada tabel dibawah<br>Fitur ini berfungsi jika tidak ada status PEMBATALAN TRX',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            });
        }
    }
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Semua transaksi barang pada nota "+$('#trxformat').html()+" akan diubah ke STATUS : "+jenistrx,
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Siap!!'
    }).then((result) => {
        if (result.isConfirmed) {
            aksibutton($('#trxformat').html(),"all",jenistrx)
        }
    })
}
function onclickakses(notatanpaformat,notaformat,kodebarang,namabarang,jenistrx,kondisi){
    if (kondisi == "kurir"){
        if (jenistrx == "Batal Dari Penjual"){
            return Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'Status anda telah berubah menjadi <br>PEMBATALAN VIA PENJUAL dan sudah dinotifikasikan.<br>Silahkan pembeli mentransaksi <br>ulang jika ingin membeli barang ini ['+namabarang+'] lagi!',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            });
        }
        if (jenistrx == "Dalam Perjalanan"){
            return Swal.fire({
                position: 'bottom-end',
                icon: 'warning',
                title: 'Status sudah berubah menjadi SIAP KIRIM : DALAM PERJALANAN<br>Silahkan kirim ke kurir tujuan<br>Hati hati dijalan ya',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            });
        }
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Apakah Barang "+namabarang+" sudah ready dan dikirim ke kurir dari NOTA : "+notaformat,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke, Siap!!'
        }).then((result) => {
            if (result.isConfirmed) {
                aksibutton(notaformat,kodebarang,"Dalam Perjalanan")
            }
        })
    }else if (kondisi == "hapuskah"){
        if (jenistrx == "Batal Dari Penjual"){
            return Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: 'Status anda telah berubah menjadi <br>PEMBATALAN VIA PENJUAL dan sudah dinotifikasikan.<br>Silahkan pembeli mentransaksi <br>ulang jika ingin membeli barang ini ['+namabarang+'] lagi!',
                showConfirmButton: false,
                toast:true,
                timer: 1500
            });
        }
        Swal.fire({
            title: 'Eitzz Mau Aksi Apa Nih..!!',
            icon: 'question',
            html: '<h5>Waduh... kenapa menekan tombol BATAL Transaksi ? Apakah ada yang salah ? Jika iya silahkan ubah status menjadi</h5><button type="button" class="btn btn-info btn-yes btn-yes-sbmt-rqst">CEK PRODUK</button> <button type="button" class="btn btn-info btn-no swl-cstm-btn-no-jst-prceed">PROSES KEMAS</button> <button type="button" class="btn btn-danger btn-cancel swl-cstm-btn-cancel" >BATALKAN TRX</button>',
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
            onBeforeOpen: () => {
                const yes = document.querySelector('.btn-yes')
                const no = document.querySelector('.btn-no')
                const cancel = document.querySelector('.btn-cancel')
                    yes.addEventListener('click', () => {
                        aksibutton(notaformat,kodebarang,"Menunggu Antrian")
                    })
                    no.addEventListener('click', () => {
                        aksibutton(notaformat,kodebarang,"Proses Pengemasan")
                    })
                    cancel.addEventListener('click', () => {
                        aksibutton(notaformat,kodebarang,"Batal Dari Penjual")
                    })
                }
            })
    }
}
function aksibutton(notaformat,kodebarang, dimana7){
    $.ajax({
        url: baseurljavascript + 'penjualan/jsondaftarpesananmodedapur',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI: "2",
            DIMANA1: kodebarang == "all" ? "all" : "updrnon",
            DIMANA5: "update",//kondisi update atau delete
            DIMANA6: notaformat, 
            DIMANA7: dimana7, 
            DIMANA8: kodebarang,
            DIMANA19: session_outlet,
            DIMANA20: session_kodeunikmember,
            DATAKE: 0 ,
            LIMIT: 500,
        },
        success: function (response) {
            if(response[0].success == "true"){
                Swal.fire(
                    'Berhasil.. Horee!',
                    'Terima kasih, status transaksi diubah menjadi '+dimana7+'.<br>Terus semangat mencari rezeki ya?.',
                    'success'
                )
            }else{
                Swal.fire({
                    position: 'bottom-end',
                    icon: 'warning',
                    title: 'Waduh... ada kesalahan dalam siste. Mohon tunggu untuk berberapa saat lagi',
                    showConfirmButton: false,
                    toast:true,
                    timer: 1500
                })
            }
            panggilpesanan("tabel");
        }
    });
}
</script>
<?= $this->endSection(); ?>