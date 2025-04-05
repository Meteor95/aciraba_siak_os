<?= $this->extend('backend/main_akuntansi'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>
.horizontal-line {
  position: relative;
  text-align: center;
  margin: 20px 20px;
}

.horizontal-line::before {
  content: "";
  display: block;
  border-top: 1px solid #000;
  width: 100%;
  margin: 0 auto;
}

.text {
  position: relative;
  top: -10px;
  background-color: #fff;
  padding: 0 10px;
}
.select2-results__option[aria-disabled="true"] {
    color: red !important; 
    cursor: not-allowed;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne" style="cursor:pointer" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="mb-0">Parameter Informasi Entri Jurnal</h4>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-7 mb-1 col-sm-12">
                                    <label for="kodeitemdiskon">No Transaksi</label>
                                    <div class="input-group">
                                        <div class="input-group">
                                        <input <?= ($notransaksi != "" ? "readonly" : "" );?> value="<?= $notransaksi;?>" type="text" class="form-control" id="siak_notransaksi" placeholder="Masukan Nomor Transaksi Entri Jurnal">
                                        <?php if ($notransaksi == "") {
                                            echo '<div class="input-group-prepend"><button id="generateiditem" class="input-group-text btn-warning btn">Buat Nota Otomatis</button></div>';
                                        }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mb-1 col-sm-12">
                                    <label>Tanggal Transaksi</label>
                                    <input id="tanggalentrijurnal" value="<?=$tgltrx;?>" type="text" class="form-control" placeholder="Pilih Tanggal Transaksi">
                                </div>
                                <div class="col-md-3 mb-1 col-sm-12">
                                    <label>Jurnal Perusahaan</label>
                                    <select class="form-control" id="pilihperusahaan">
                                        <?php if ($subperusahaan != ""){ echo "<option value=\"".$subperusahaan."\">[".$subperusahaan."] ".$namasubperusahaan."</option>";}?>
                                        <option value="0">[0] Perusahaan Induk</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-1 col-sm-12">
                                    <label>Narasi Untuk Transaksi Entri Jurnal</label>
                                    <div class="quill" id="quill"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <button id="btnsimpanentrijurnal" class="btn btn-primary"> <i class="fa-solid fa-book-medical"></i> Simpan Entri Jurnal</button>
                    </div>
                    <div class="portlet-body">
                        <!-- END Form Row -->
                        <div class="horizontal-line mb-0"><span class="text">ENTRI JURNAL KAMU PADA TABEL DIBAWAH INI</span></div>
                        <!-- BEGIN Datatable -->
                        <div style="text-align:right"><h4>Total Debit : <span id="totaldebit"><?= formatuang("IDR",0,"Rp ") ;?></span></h4>
                        <h4>Total Kredit : <span id="totalkredit"><?= formatuang("IDR",0,"Rp ") ;?></span></h4>
                        <h4>Selisih : <span id="selisih"><?= formatuang("IDR",0,"Rp ") ;?></span></h4></div>
                        <?php if($notransaksi == ""){ ?>
                            <table id="entrijurnaltabel" class="tanpatulisangede table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Akun</th>
                                    <th scope="col">Narasi Akun</th>
                                    <th scope="col">Debit</th>
                                    <th scope="col">Kredit</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        <?php }else{ ?>
                            <table id="entrijurnaltabel" class="tanpatulisangede table table-bordered table-striped table-hover nowrap"></table>
                        <?php } ?>
                        
                        <button id="tambahbarusentrijurnal" class="btn-block btn btn-primary">Tambah Baris Entri Jurnal</button>
                        <!-- END Datatable -->
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>scripts/akuntansi/entrijurnal.js"></script>
<script type="text/javascript">
let informasidata = JSON.stringify([]), tabelentrijurnaltabel = "", temprow = 0, daftarkeranjang = "", quillnya, notrxeditjurnal = '<?=$notransaksi;?>', subperusahaan = '<?= $subperusahaan ;?>',awalperiode = '<?=$awalperiode;?>', akhirperiode = '<?=$akhirperiode;?>';
$(document).ready(function () {
quillnya = new Quill("#quill",{theme:"snow",modules: { toolbar: toolbarOptions },})
if (notrxeditjurnal != ""){
    quillnya.clipboard.dangerouslyPasteHTML('<?= $narasi;?>')
    $('#totaldebit').html(formatuang(<?= $total_debit;?>,'id-ID','IDR'));
    $('#totalkredit').html(formatuang(<?= $total_kredit;?>,'id-ID','IDR'));
    $('#selisih').html(formatuang(<?= (($total_debit - $total_kredit) < 0 ? (($total_debit - $total_kredit) * -1) : ($total_debit - $total_kredit) );?>,'id-ID','IDR'));
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'akuntansi/getcoaentrijurnal',
            method: 'POST',
            dataType: 'json',
            data: {
                csrf_aciraba: csrfTokenGlobal,
                KODESUBPERUSAHAAN: subperusahaan,
            },
            success: function(res){
                if (res.length == 0) return informasidata = JSON.stringify([])
                informasidata = JSON.stringify(res);
            }
        });
    });
    getCsrfTokenCallback(function() {
        let nominaldebit = 0, nominalkredit = 0;
        tabelentrijurnaltabel = $("#entrijurnaltabel").DataTable({
            language: {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
            },
            pageLength: 500,
            bLengthChange: false,
            bFilter: false,
            keys: true,
            scrollY: "50vh",
            scrollCollapse: true,
            destroy: true,
            ajax: {
                "url": baseurljavascript + 'akuntansi/detailjurnalitemedit',
                "type": "POST",
                "data": function (d) {
                    d.csrf_aciraba = csrfTokenGlobal;
                    d.NOTRX = notrxeditjurnal;
                    d.SUBPERUSAHAAN = '<?=$subperusahaan;?>';
                },
                "dataSrc": function (json) {
                    return json.data[0].daftarentrijurnal;
                }
            },
            columnDefs: [{
                defaultContent: "-",
                targets: "_all"
            }],
            columns: [
                {
                    title: "No",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            return meta.row + 1;
                        }
                        return data;
                    }
                },
                {
                    title: "Akun",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            const currentTimeInMillis = new Date().getTime();
                            const uniqueId = currentTimeInMillis + meta.row;
                            const selectCoa = generateSelectTreeViewledger(informasidata, "entrijurnal" + uniqueId);
                            setTimeout(() => {
                                $('#entrijurnal' + uniqueId).select2({
                                    placeholder: 'Pilih Kode COA',
                                    dropdownAutoWidth: true,
                                    width: 'auto'
                                });
                                $('#entrijurnal' + uniqueId).val(row.LEDGER_ID).trigger('change');
                            }, 0);
                            return selectCoa.outerHTML;
                        }
                        return '';
                    }
                }, 
                {
                    title: "Narasi Akun",
                    render: function(data, type, row, meta) {
                        const currentTimeInMillis = new Date().getTime();
                        const uniqueId = currentTimeInMillis + meta.row;
                        return "<input id=\"narasiakun"+uniqueId+"\" placeholder=\"Ketik narasi pada entri jural item ini\" name=\"narasiakun[]\" class=\"narasiakun form-control\" type=\"text\" value=\""+(typeof(row.NARASIITEM) == "undefined" ? "" : row.NARASIITEM )+"\">"
                    }
                },
                {
                    title: "Debit",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            nominaldebit = 0, nominalkredit = 0;
                            const currentTimeInMillis = new Date().getTime();
                            const uniqueId = currentTimeInMillis + meta.row;
                            if(row.DEBITKREDIT == "D"){ nominaldebit = row.NOMINAL_JURNAL; }
                            let inputElement = "<input id=\"debit"+uniqueId+"\" name=\"debit[]\" class=\"debit form-control\" type=\"text\" value=\""+nominaldebit+"\">";
                            setTimeout(() => {
                                try {
                                    if (!AutoNumeric.getAutoNumericElement("#debit"+uniqueId)) { 
                                        entridebit[uniqueId] = new AutoNumeric("#debit"+uniqueId, {decimalCharacter : ',',digitGroupSeparator : '.',});
                                    }
                                }
                                catch(err) {}
                            }, 0);
                            return inputElement;
                        }
                        return '';
                    }
                },
                {
                    title: "Kredit",
                    render: function(data, type, row, meta) {
                        if (type === 'display') {
                            nominaldebit = 0, nominalkredit = 0;
                            const currentTimeInMillis = new Date().getTime();
                            const uniqueId = currentTimeInMillis + meta.row;
                            if(row.DEBITKREDIT == "K"){nominalkredit = row.NOMINAL_JURNAL;}
                            let inputElement = "<input id=\"kredit"+uniqueId+"\" name=\"kredit[]\" class=\"kredit form-control\" type=\"text\" value=\""+nominalkredit+"\">";
                            setTimeout(() => {
                                try {
                                    if (!AutoNumeric.getAutoNumericElement("#kredit"+uniqueId)) { 
                                        entrikredit[uniqueId] = new AutoNumeric("#kredit"+uniqueId, {decimalCharacter : ',',digitGroupSeparator : '.',});
                                    }
                                }
                                catch(err) {}
                            }, 0);
                            return inputElement;
                        }
                        return '';
                    }
                },
                {
                    title: "Aksi",
                    render: function(data, type, row, meta) {
                        return "<div><button class=\"hapusentrijurnal btn-block btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>";
                    }
                },
            ],
        }).on('key-focus', function ( e, datatable, cell, originalEvent ) {
            $('input', cell.node()).focus();
        }).on("focus", "td input", function(){
            $(this).select();
        })
        tabelentrijurnaltabel.on('key', function (e, dt, key, cell, originalEvent) {
            if (key === 13) { 
                dt.keys.move('down');
            }
        });
    });
}else{
    tabelentrijurnaltabel = $('#entrijurnaltabel').DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        pageLength: 500,
        bLengthChange: false,
        bFilter: false,
        keys: true,
        scrollY: "50vh",
        scrollCollapse: true,
    })
    tabelentrijurnaltabel.on('key', function (e, dt, code) {
        if (code === 13) {
            tabelentrijurnaltabel.keys.move('down');
        }
    })
}    
$('#tanggalentrijurnal').val(moment().format('DD-MM-YYYY'));
$("#tanggalentrijurnal").datepicker({todayHighlight: true,format:'dd-mm-yyyy',orientation: "bottom",
    startDate: new Date(awalperiode),
    endDate: new Date(akhirperiode),
 });
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
            getCsrfTokenCallback(function() {});
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
            getCsrfTokenCallback(function() {});
            toastr["error"](xhr.responseJSON.message);
        }
    },
});
$('#pilihperusahaan').on('change', function() {
    let selectedValue = $(this).val();
    getCsrfTokenCallback(function() {
        $.ajax({
            url: baseurljavascript + 'akuntansi/getcoaentrijurnal',
            method: 'POST',
            dataType: 'json',
            data: {
                csrf_aciraba: csrfTokenGlobal,
                KODESUBPERUSAHAAN: selectedValue,
            },
            success: function(res){
                if (res.length == 0) return informasidata = JSON.stringify([])
                informasidata = JSON.stringify(res);
            }
        });
    });
});
});
</script>
<?= $this->endSection(); ?>