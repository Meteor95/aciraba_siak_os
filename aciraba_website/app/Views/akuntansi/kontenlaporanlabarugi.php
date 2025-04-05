<?= $this->extend('backend/main_akuntansi'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>.group { font-weight: bold; background-color: #f0f0f0; color: red}.align-right { text-align: right;}</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <h3 class="portlet-title"> 
                            <button id="" class="btn btn-danger"> <i class="fa-solid fa-file-pdf"></i> Format PDF</button>
                            <button id="proseslabarugi" class="btn btn-success float-right"> <i class="fas fa-cog"></i> Proses Cek</button>
                        </h3>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row">
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Jurnal Perusahaan</label>
                                <select class="form-control" id="pilihperusahaan">
                                <?php if($kodesubperusahaan != "0"){
                                    echo '<option value="'.$kodesubperusahaan.'">['.$kodesubperusahaan.'] '.$namaperusahaan.'</option>';
                                }else{ echo '<option value="0">[0] Perusahaan Induk</option>'; }
                                ?>
                                </select>
                            </div>
                            <div class="col-md-5 mb-1 col-sm-12">
                                <label>Rentang Periode</label>
                                <div class="input-group input-daterange">
                                    <input id="daritanggal" type="text" class="form-control" placeholder="Dari Tanggal">
                                    <div class="input-group-prepend input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </span>
                                    </div>
                                    <input id="sampaitanggal" type="text" class="form-control" placeholder="Sampai Tanggal">
                                </div>
                            </div>
                            <div class="col-md-2 mb-1 col-sm-12">
                                <label>Tampilkan 0</label>
                                <select class="form-control" id="tampikan0">
                                <option value="0">Tampilkan 0 (Semua Akun)</option>
                                <option value="1">Tidak Tampilkan 0 (Akun Terjurnal)</option>
                                </select>
                            </div>
                        </div>
                        <!-- END Form Row -->
                        <hr>
                        <div style="text-align:center;" id="mondarmandirloading"></div>
                        <div style="text-align:center; size: calc(4vw + 4vh + 2vmin); color:red" class="animasitypejs">SEDANG MEMPERSIAPKAN LABA RUGI ANDA</div>
                        <div class="form-row"> <div class="col-md-12"><h1 style="color:blue;font-weight: bold;"> Σ Laba Usaha : <span style="color:red;font-size: 150%;font-family:'digital-clock-font'" id="totallabausaha" class="float-right">0,00</span></h1></div></div>
                        <div class="form-row">
                            <div class="col-md-6"><h2 style="text-align:center;font-weight: bold;">Pendapatan</h2><hr>
                            <h2 class="portlet-title" style="color:blue;font-weight: bold;">Σ Laba Kotor : <span id="totalpendapatan" class="float-right">0,00</span></h2>
                            <table class="table hovercolor" id="tabelpendapatan">
                                <thead>
                                    <tr>
                                        <th>Akun</th>
                                        <th>Saldo (IDR)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                            <div class="col-md-6"><h2 style="text-align:center;font-weight: bold;">Beban Pengeluaran</h2><hr>
                            <h2 class="portlet-title" style="color:blue;font-weight: bold;">Σ Beban Pengeluaran : <span id="totalbebanpengeluaran" class="float-right">0,00</span></h2>    
                            <table class="table hovercolor" id="tabelbebanpengeluaran">
                                <thead>
                                    <tr>
                                        <th>Akun</th>
                                        <th>Saldo (IDR)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
awalperiode = '<?=$awalperiode;?>', akhirperiode = '<?=$akhirperiode;?>', totalpenjualan = 0, totalbeban = 0;
let jsonlabaditahan = {},jsonpendapatan = {}, jsonbeban ={};
function printAccount(account, idElementHTML, hilangkannol, counter = 0) {
    const tableBody = document.querySelector('#' + idElementHTML + ' tbody');
    const isGroup = account.jenisakun === "GRUP";
    const isTopLevel = account.g_parent_id == 0;
    const indent = '&nbsp;'.repeat(counter * 4);
    const cellStyle = isTopLevel ? "color:red; background-color: #fcc359" : "";
    const cellClass = isGroup ? "group" : "";
    const alignRightClass = isGroup ? "group align-right" : "align-right";
    const opTotalDisplay = account.defaultinput !== account.op_total_dc ? `(${formatRupiah(account.op_total)})` : formatRupiah(account.op_total);
    const clTotalDisplay = account.defaultinput !== account.cl_total_dc ? `(${formatRupiah(account.cl_total)})` : formatRupiah(account.cl_total);
    let selectedOption = $('#pilihperusahaan').select2('data')[0].text.replace(/\[.*?\]/g, '');
    selectedOption = encodeURIComponent(selectedOption);
    const row = document.createElement('tr');
    if (hilangkannol == 1 && account.cl_total == 0) {row.style.display = 'none'; }
    row.innerHTML = `
        <td class="${cellClass}" style="${cellStyle}">
            ${account.jenisakun === 'LEDGER' ? `<a href="${baseurljavascript}akuntansi/bukubesar/${account.id}/${$('#pilihperusahaan').val()}/${selectedOption}">` : ''}
            ${indent}[${account.code}] ${account.name} (${account.defaultinput})
            ${account.jenisakun === 'LEDGER' ? '</a>' : ''}
        </td>
        <td class="${alignRightClass}" style="${cellStyle}">${clTotalDisplay}</td>
    `;
    tableBody.appendChild(row);
    if (account.children_groups) { account.children_groups.forEach(childGroup => printAccount(childGroup,idElementHTML , hilangkannol,counter + 1)); }
    if (account.children_ledgers) { account.children_ledgers.forEach(ledger => printAccount(ledger,idElementHTML, hilangkannol,counter + 1)); }
}

$(document).ready(function () {
$('#daritanggal').val(moment().startOf('month').format('DD-MM-YYYY'));
$('#sampaitanggal').val(moment().format('DD-MM-YYYY'));
$(".input-daterange").datepicker({orientation: "bottom left",format: "dd-mm-yyyy",startDate: new Date(awalperiode.split("-").reverse().join("-")),endDate: new Date(akhirperiode.split("-").reverse().join("-")),});
panggilneraca()
$('#tampikan0').select2({})
$('#pilihperusahaan').select2({
    allowClear: true,
    placeholder: 'Tentukan Jurnal Perusahaan',
    ajax: {
        url: baseurljavascript + 'masterdata/jsonpilihperusahaan',
        method: 'POST',
        dataType: 'json',
        delay: 500,
        data: function (params) {
            return {
                csrf_aciraba: csrfTokenGlobal,
                NAMAPERUSAHAAN: (typeof params.term === "undefined" ? "" : params.term),
                KODEUNIKMEMBER: session_kodeunikmember,
            }
        },
        processResults: function (data) {
            parseJSON = JSON.parse(data);
            return {
                results: $.map(parseJSON, function (item) {
                    return {
                        text: "[" + item.kodepursahaan + "] " + item.namaperusahaan,
                        id: item.kodepursahaan,
                    }
                })
            }
        },
        error: function(xhr, status, error) {
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
$('#tampikan0').on('change', function() {
    $('#tabelpendapatan tbody').empty();
    $('#tabelbebanpengeluaran tbody').empty();
    jsonpendapatan.children_groups.forEach(account => printAccount(account, 'tabelpendapatan',$('#tampikan0').val()));
    jsonbeban.children_groups.forEach(account => printAccount(account, 'tabelbebanpengeluaran',$('#tampikan0').val()));
});
});

function panggilneraca(){
    $('.animasitypejs').show();
    $('#mondarmandirloading').prepend('<img id="mondarmandirloadingimage" src="'+baseurljavascript+'images/avatar/modarmandir.gif'+'" />')
    $('#tabelpendapatan tbody').empty();
    $('#tabelbebanpengeluaran tbody').empty();
    $('#proseslabarugi').prop("disabled",true);
    $('#proseslabarugi').html('<i class="fa fa-spin fa-spinner"></i> Proses Perhitungan');
    getCsrfTokenCallback(function() {
    $.ajax({
        url: baseurljavascript + 'akuntansi/labarugiajax',
        method: 'POST',
        dataType: 'json',
        data: {
            csrf_aciraba: csrfTokenGlobal,
            AWALTANGGAL: $('#daritanggal').val(),
            AKHIRTANGGAL: $('#sampaitanggal').val(),
            SUBPERUSAHAAN: $('#pilihperusahaan').val(),
            TANPANOL: $('#tampikan0').val(),
        },
        complete:function(data, status) {
            $('#proseslabarugi').prop("disabled",false);
            $('#proseslabarugi').html('<i class="fas fa-cog"></i> Proses Cek');
            $('.animasitypejs').fadeOut("slow")
            $('#mondarmandirloadingimage').fadeOut(1000, function() {$(this).remove();});
        },
        success: function (response) {
            totalpenjualan = 0
            totalbeban = 0
            jsonpendapatan = response.pendapatan;
            jsonbeban = response.beban;
            jsonpendapatan.children_groups.forEach(account => printAccount(account, 'tabelpendapatan',$('#tampikan0').val()));
            jsonbeban.children_groups.forEach(account => printAccount(account, 'tabelbebanpengeluaran',$('#tampikan0').val()));
            if ((jsonpendapatan.cl_total_dc === jsonpendapatan.defaultinput) || jsonpendapatan.cl_total == 0){ 
                totalpenjualan =  jsonpendapatan.cl_total 
            }else{ 
                totalpenjualan =  jsonpendapatan.cl_total * -1
            }
            $("#totalpendapatan").html(formatRupiah(totalpenjualan))
            if ((jsonbeban.cl_total_dc === jsonbeban.defaultinput) || jsonbeban.cl_total == 0){ 
                $("#totalbebanpengeluaran").html(formatRupiah(jsonbeban.cl_total))
            }else{ 
                $("#totalbebanpengeluaran").html("("+formatRupiah(jsonbeban.cl_total)+")")
            }
            totalbeban = totalpenjualan-jsonbeban.cl_total
            $("#totallabausaha").html(formatRupiah(totalbeban))
        }
    });
});
}
$("#proseslabarugi").on("click", function () {
    panggilneraca()
});
</script>
<?= $this->endSection(); ?>