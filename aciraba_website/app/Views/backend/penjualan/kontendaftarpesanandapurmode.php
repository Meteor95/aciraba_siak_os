<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
    .grid {
        --gap: 1em;
        --columns: 3;
        max-width: 100rem;
        margin: 0 auto;
        columns: var(--columns);
        gap: var(--gap);
    }

    @media screen and (max-width: 750px) {
        .grid {
            --columns: 1;
            columns: var(--columns);
        }
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
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- BEGIN Portlet -->
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title">Penyaring Data Pesanan Dapur</h3>
                        <div class="portlet-addon">
                            <button class="btn btn-label-info btn-icon" data-toggle="portlet" data-target="parent"
                                data-behavior="toggleCollapse">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="portlet-header portlet-header-bordered">
                            <div class="col-9">
                                <div class="input-group input-daterange">
                                    <input id="tglawaltrx" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="tglakhirtrx" type="text" class="form-control"
                                        placeholder="Sampai Tanggal">
                                    <div style="cursor:pointer;" id="pencariandapur" class="input-group-prepend input-group-append">
                                        <span class="input-group-text btn-warning btn">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <button id="segarkan" class="btn btn-primary btn-block"> <i class="fas fa-retweet"></i> Segarkan
                                </button>
                            </div>
                        </div>
                        <div style="text-align:center" class="portlet-body">
                            <button id="antri" class="btn btn-info col-3"> Antri </button>
                            <button id="proses" class="btn btn-warning col-3 mr-1 ml-1"> Proses </button>
                            <button id="selesai" class="btn btn-success col-3"> Selesai </button>
                        </div>
                    </div>
                </div>
                <!-- END Portlet -->
                <div class="grid">
                    <!-- BEGIN Card -->
                    <div id="cardpesanan"></div>
                    <!-- END Cards -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="<?= base_url();?>scripts/penjualan/pesanan.js"></script>
<script src="<?= base_url();?>scripts/printThis.js"></script>
<script type="text/javascript">
    let firstDay = moment().startOf('month').format('DD-MM-YYYY');
    let lastDay = moment().endOf('month').format('DD-MM-YYYY');
    $('#tglawaltrx').val(firstDay);
    $('#tglakhirtrx').val(lastDay);
    $(document).ready(function () {
        $(".input-daterange").datepicker({
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            orientation: "bottom left",
        });
        panggilpesandapur("2","Menunggu Antrian",$('#tglawaltrx').val(),$('#tglakhirtrx').val());
    });
    socket.on("DAPUR"+session_outlet+""+session_kodeunikmember, function (data) {
        toastr["info"]("Hallo bagian dapur, ada pesanan baru masuk nih. Minta tolong buatin ya. TERIMA KASIH" );
        const audio = new Audio("https://cdn.acirabadatabase.com/sound/bus-horn-409.mp3");
        audio.play();
    });
function panggilpesandapur(kondisi,dimana1,dimana3,dimana4,dimana5,dimana6,dimana7){
    $.ajax({
        url: baseurljavascript + 'penjualan/jsondaftarpesananmodedapur',
        method: 'POST',
        dataType: 'json',
        data: {
            KONDISI: kondisi,
            DIMANA1: dimana1,
            DIMANA3: dimana3,
            DIMANA4: dimana4, 
            DIMANA5: dimana5,//kondisi update atau delete
            DIMANA6: dimana6, 
            DIMANA7: dimana7, 
            DIMANA19: session_outlet,
            DIMANA20: session_kodeunikmember,
            DATAKE: 0 ,
            LIMIT: 500,
        },
        success: function (response) {
            if (dimana5 != "update"){
                let detailpesanan ="";
                $("#cardpesanan").html("");
                for (cardke = 0; cardke < 10; cardke++) {
                    for (isicard = 0; isicard < response[cardke].children.length; isicard++) {
                        detailpesanan += "<li>"+response[cardke].children[isicard].NAMABARANG+" ["+response[cardke].children[isicard].STOKBARANGKELUAR+"]</li>";
                    }
                    $("#cardpesanan").append("<div id=\""+response[cardke].meja+"\" class=\"mb-2 card content flow\"><div class=\"card-header\"><h3 class=\"card-title\">Urutan : "+(cardke+1)+" Nomor Meja : "+response[cardke].meja+"</h3><div class=\"card-addon\"><i onclick='progressblockselesai("+response[cardke].meja+")' style=\"cursor:pointer\" class=\"fas fa-concierge-bell\"></i></div></div><div class=\"card-body card-body-"+response[cardke].meja+"\"><h5 class=\"card-title\">A.N : "+response[cardke].namapemesan+"</h5><p class=\"card-text\"><ol>"+detailpesanan+"</ol></p><button onclick='progressblock("+response[cardke].meja+",\""+response[cardke].nomota+"\",\"Proses Mengelola Hidangan\")' class=\"btn btn-primary mr-2\">Proses</button><button onclick='progressblocksiapsaji("+response[cardke].meja+",\""+response[cardke].nomota+"\",\"Siap Saji\")' class=\"btn btn-success\">Selesai</button><button onclick='progressblocksiapsaji("+response[cardke].meja+",\""+response[cardke].nomota+"\",\"Menunggu Antrian\")' class=\"btn btn-danger float-right\">Batal</button></div><div class=\"card-footer text-muted\">Waktu : "+response[cardke].waktupesan+"<br>Nota TRX: "+response[cardke].nomota+"</div></div>");
                    if (response[cardke].statuspesanan == "Proses Mengelola Hidangan"){
                        $(".card-body-"+response[cardke].meja).block({message:'\n <div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Proses Kelola...</h1>\n'});
                    }
                }
            }
        }
    });
}
function progressblock(elemenid,notapenjualan,ubahkestatus){
    panggilpesandapur("2","",$('#tglawaltrx').val(),$('#tglakhirtrx').val(),"update",notapenjualan,ubahkestatus);      
    $("#"+elemenid).on("click",function(){$(".card-body-"+elemenid).block({message:'\n <div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Proses Kelola...</h1>\n'})});
}
function progressblocksiapsaji(elemenid,notapenjualan,ubahkestatus){
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: ubahkestatus == "Menunggu Antrian" ? "Anda akan ingin mengubah menjadi ANTRIAN kembali dari NOTA : "+notapenjualan  : "Anda akan memproses NOTA : "+notapenjualan+" menjad SELESAI dan SIAP SAJI",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Sudah Selesai!'
    }).then((result) => {
        if (result.isConfirmed) {
            panggilpesandapur("2","",$('#tglawaltrx').val(),$('#tglakhirtrx').val(),"update",notapenjualan,ubahkestatus);
            if (ubahkestatus == "Siap Saji"){
                $("#"+elemenid).remove();      
            }
        }
    })
}
function progressblockselesai(elemenid){
    $("#"+elemenid).on("click",function(){$(".card-body-"+elemenid).unblock({message:'\n <div class="spinner-grow text-success"></div>\n<h1 class="blockui blockui-title">Proses Kelola...</h1>\n'})});
}
$("#pencariandapur").on("click", function(){
    panggilpesandapur("2","",$('#tglawaltrx').val(),$('#tglakhirtrx').val());
});
$("#antri").on("click", function(){
    panggilpesandapur("2","Menunggu Antrian",$('#tglawaltrx').val(),$('#tglakhirtrx').val());
});
$("#proses").on("click", function(){
    panggilpesandapur("2","Proses Mengelola Hidangan",$('#tglawaltrx').val(),$('#tglakhirtrx').val());
});
$("#selesai").on("click", function(){
    panggilpesandapur("2","Siap Saji",$('#tglawaltrx').val(),$('#tglakhirtrx').val());
});
$("#segarkan").on("click", function(){
    $('#tglawaltrx').val(firstDay);
    $('#tglakhirtrx').val(lastDay);
    panggilpesandapur("2","",$('#tglawaltrx').val(),$('#tglakhirtrx').val());
});
</script>
<?= $this->endSection(); ?>