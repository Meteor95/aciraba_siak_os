<?= $this->extend('backend/main_akuntansi'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<style>.grup-row { background-color: #c2c2c2;}#tabel_coa td {padding:3px;}</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                    <button data-toggle="modal" data-target="#modalgrup" id="" class="btn btn-primary mr-2"> <i class="fas fa-plus-circle"></i> Buat Grup</button>
                    <button data-toggle="modal" data-target="#modalledger" id="" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Buat Akun</button>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Form Row -->
                        <div class="form-row"> 
                        <div class="col-md-8 mb-1 col-sm-12 mt-2">
                            <label>Pilih Sub Perusahaan</label><select class="form-control" id="pilihperusahaan">
                                <?php if($kodesubperusahaan != 0){
                                    echo '<option value="'.$kodesubperusahaan.'">['.$kodesubperusahaan.'] '.$namaperusahaan.'</option>';
                                }else{
                                    echo '<option value="0">[0] Perusahaan Induk</option>';
                                }
                                ?>
                            </select>
                        </div>        
                        <div class="col-md-4 mb-1 col-sm-12 mt-2">
                            <button onclick="pindahperusahaanjurnal()" class="btn btn-primary btn-block" style="margin-top:27px"> <i class="fas fa-sign-out"></i> Ubah Ke Jurnal Tujuan</button>
                        </div>        
                        <?php
                            function generateTableTreeView($informasidata, $kodesubperusahaan, $namaperusahaan, $level = 0) {
                                if ($level === 0) {
                                    echo '<table class="table nowrap" id="tabel_coa">';
                                    echo '<tr><th style="text-align:center">Kode Akun</th><th style="text-align:center">Nama Akun</th><th style="text-align:center">Golongan</th><th style="text-align:center">Saldo Awal (IDR)</th><th style="width:200px;text-align:center">Aksi</th></tr>';
                                }
                                foreach ($informasidata as $item) {
                                    $class = ($item['JENISAKUN'] == "LEDGER") ? '' : 'class="grup-row"';
                                    if ($item['PARENT_ID'] == "0"){
                                        echo '<tr ' . $class . '>';
                                    }else{
                                        echo '<tr>';
                                    }
                                    if ($item['PARENT_ID'] == "0"){
                                        echo '<td style="color:red">' . str_repeat('&nbsp;', $level * 5) . $item['KODE_COA_GROUP'] . '</td>';
                                        echo '<td style="color:red">' . str_repeat('&nbsp;', $level * 5) . $item['NAMA_COA_GROUP'] . '</td>';
                                    }else if ($item['JENISAKUN'] == "LEDGER"){
                                        echo '<td><a href="'.base_url().'akuntansi/bukubesar/'.$item['ID'].'/'.$kodesubperusahaan.'/'.urlencode($namaperusahaan).'">' . str_repeat('&nbsp;', $level * 5) . $item['KODE_COA_GROUP'] . '</a></td>';
                                        echo '<td><a href="'.base_url().'akuntansi/bukubesar/'.$item['ID'].'/'.$kodesubperusahaan.'/'.urlencode($namaperusahaan).'">' . str_repeat('&nbsp;', $level * 5) . $item['NAMA_COA_GROUP'] . '</a></td>';
                                    }else{
                                        echo '<td>' . str_repeat('&nbsp;', $level * 5) . $item['KODE_COA_GROUP'] . '</td>';
                                        echo '<td style="color:black">' . str_repeat('&nbsp;', $level * 5) . $item['NAMA_COA_GROUP'] . '</td>';
                                    }
                                    echo '<td style="text-align:center">' . $item['JENISAKUN'] . '</td>';
                                    if ($item['JENISAKUN'] == "LEDGER"){
                                        echo '<td style="text-align:right;color:black">' . ($item['SALDOAWAL'] < 0 ? "(".formatuang('IDR',($item['SALDOAWAL'] * -1),"").")" : formatuang('IDR',$item['SALDOAWAL'],"") ) . '</td>';
                                    }else{
                                        echo '<td style="text-align:center">-</td>';
                                    }
                                    if ($item['PARENT_ID'] != "0"){
                                        if ($item['ISDELETE'] == 'false'){
                                            echo "<td style=\"text-align:center\"><button onclick=\"panggilmodalubah('".$item['JENISAKUN']."','".$item['NAMA_COA_GROUP']."','".$item['KODE_COA_GROUP']."','".$item['PARENT_ID']."','".$item['SALDOAWALDC']."','".$item['SALDOAWAL']."','".$item['KASBANK']."','".$item['ID']."')\" class=\"btn btn-primary btn-block\"><i class=\"fas fa-pencil\"></i> Ubah</button></td>";
                                        }else{ ?>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    <button onclick='panggilmodalubah("<?= $item["JENISAKUN"];?>", "<?= $item["NAMA_COA_GROUP"]; ?>", "<?= $item["KODE_COA_GROUP"]; ?>", "<?= $item["PARENT_ID"]; ?>","<?= $item["SALDOAWALDC"]; ?>","<?= $item["SALDOAWAL"]; ?>","<?= $item["KASBANK"]; ?>","<?= $item["ID"] ;?>")' class="btn btn-block btn-primary"><i class="fas fa-pencil"></i> Ubah</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button onclick='hapuskodecoa("<?= $item["ID"];?>","<?= $item["KODE_COA_GROUP"];?>","<?= $item["NAMA_COA_GROUP"];?>")' class="btn btn-block btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                                    </div>
                                                </div>
                                            </td>
                                        <?php }
                                    }else{
                                        echo '<td style="text-align:right;color:black"></td>';
                                    }
                                    echo '</tr>';
                                    if (isset($item['children']) && !empty($item['children'])) {
                                        generateTableTreeView($item['children'], $kodesubperusahaan, $namaperusahaan, $level + 1);
                                    }
                                }
                                if ($level === 0) {
                                    echo '</table>';
                                }
                            }
                            generateTableTreeView($informasidata, $kodesubperusahaan, $namaperusahaan);
                            ?>
                            </div>
                        <!-- END Form Row -->
                        <hr>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    </div>
</div>
<?php
$selectTreeView = generateSelectTreeView($informasidata,"pilihcoa");
$selectTreeViewEdit = generateSelectTreeView($informasidata,"pilihcoaedit");
$selectTreeViewLedger = generateSelectTreeViewledger($informasidata,"pilihcoaledger");
$selectTreeViewLedgerEdit = generateSelectTreeViewledger($informasidata,"pilihcoaledgeredit");
?>
<div class="modal fade" id="modalgrup">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Grup Akun Akuntansi</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                Untuk membuat / menambahkan Group, ikuti instruksi dibawah ini :<br>
                1. Pilih Group Induk untuk mengelompokkan group yang dibuat ke grup induk yang dituju.<br>
                2. Isikan Kode Group untuk menentukan urutan group yang dibuat.<br>
                3. Isikan Nama Group untuk menentukan nama pada group yang dibuat.<br>
                Setelah di inputkan klik Simpan, maka group yang dibuat telah tersimpan di Master Akun.<br>
                <br>
                Setelah anda membuatnya group, berikutnya buat akun. Anda dapat mengatur akunnya sebagai Akun Kas atau Bank, pilih grup induknya, jenis Debit atau Kredit, dan lain-lain seperti gambar berikut.<br>
                </p><hr>
                <div class="row">
                    <div class="col-md-12"><label for="pilihcoa">Grup Induk</label><?= $selectTreeView; ?></div>
                    <div class="col-md-6 mt-2"><label for="kodegrup">Kode Group</label><input type="text" class="form-control" id="kodegrup"></div>
                    <div class="col-md-6 mt-2"><label for="namagrup">Nama Group</label><input type="text" class="form-control" id="namagrup"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="simpancoagroup" class="btn btn-primary mr-2">Simpan Data COA</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalledger">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Jurnal Akun Akuntansi</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                Untuk membuat / menambahkan Jurnal, ikuti instruksi dibawah ini :<br>
                1. Pilih Group Induk untuk mengelompokkan jurnal yang dibuat ke grup induk yang dituju.<br>
                2. Isikan Kode Jurnal untuk menentukan urutan jurnal yang dibuat.<br>
                3. Isikan Nama Jurnal untuk menentukan nama pada jurnal yang dibuat.<br>
                Setelah di inputkan klik Simpan, maka jurnal yang dibuat telah tersimpan di Master Akun.<br>
                <br>
                Jurnal Akun mengacu pada buku entri asli, di mana akuntan dan pemegang buku mencatat transaksi bisnis mentah, sesuai dengan tanggal terjadinya peristiwa. Jurnal umum adalah tempat pertama pencatatan data, dan setiap halaman dalam item dilengkapi kolom pemisah untuk tanggal, nomor seri, serta catatan debit atau kredit.<br>
                </p><hr>
                <div class="row">
                    <div class="col-md-12"><label for="pilihcoa">Grup Induk Jurnal</label><?= $selectTreeViewLedger; ?></div>
                    <div class="col-md-6 mt-2"><label for="kodeledgergrup">Kode Jurnal</label><input type="text" class="form-control" id="kodeledgergrup"></div>
                    <div class="col-md-6 mt-2"><label for="namaledgergrup">Nama Jurnal</label><input type="text" class="form-control" id="namaledgergrup"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="simpancoaledger" class="btn btn-primary mr-2">Simpan Data COA</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalgrupedit">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Informasi Akun Grup <strong><span id="namaakungrup"></span></strong> [<strong><span id="idkodecoa"></span></strong>]</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                Jika anda merubah kode COAnya maka KODE yang berada diseluruh entri jurnal yang lain akan ikut berubah. Jadi Kode COA akan selalu terhubung dengan data baru ataupun lama.
                </p><hr>
                <div class="row">
                    <div class="col-md-12"><label for="pilihcoaedit">Grup Induk</label><?= $selectTreeViewEdit; ?></div>
                    <div class="col-md-6 mt-2"><label for="kodegrupedit">Kode Group</label><input type="text" class="form-control" id="kodegrupedit"></div>
                    <div class="col-md-6 mt-2"><label for="namagrupedit">Nama Group</label><input type="text" class="form-control" id="namagrupedit"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="ubahcoagroup" class="btn btn-primary mr-2">Ubah Data COA</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modallegeredit">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi Grup Akun LEDGER <strong><span id="namaakunledger"></span></strong>[<strong><span id="idkodecoaledger"></span></strong>]</h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <p class="mb-0">
                Jika anda merubah kode COAnya maka KODE yang berada diseluruh entri jurnal yang lain akan ikut berubah. Jadi Kode COA akan selalu terhubung dengan data baru ataupun lama.
                </p><hr>
                <div class="row">
                    <div class="col-md-12"><label for="pilihcoaledgeredit">Grup Induk</label><?= $selectTreeViewLedgerEdit; ?></div>
                    <div class="col-md-6 mt-2"><label for="kodegrupeditledger">Kode Ledger</label><input type="text" class="form-control" id="kodegrupeditledger"></div>
                    <div class="col-md-6 mt-2"><label for="namagrupeditledger">Nama Ledger</label><input type="text" class="form-control" id="namagrupeditledger"></div>
                    <div class="col-md-6 mt-2"><label for="saldoawaleditledger">Lokasi Saldo Awal</label>
                    <div id="dasarmasukancoa" class="btn-block btn-group btn-group-toggle" data-toggle="buttons">
                        <label id="labeleditdebit" class="btn btn-flat-success active" style="cursor: pointer;">
                            <input type="radio" name="dasarmasukancoadebit" value="D" id="rb_dasarmasukancoadebit"> Debit </label>
                        <label id="labeleditkredit" class="btn btn-flat-success" style="cursor: pointer;">
                            <input type="radio" name="dasarmasukancoadebit" value="K" id="rb_dasarmasukancoakredit"> Kredit </label>
                    </div>
                    </div>
                    <div class="col-md-6 mt-2"><label for="saldoawaleditledger">Nominal Saldo Awal</label><input type="text" class="form-control" id="saldoawaleditledger" value="0"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-8">
                    <div id="statuskasbank" class="btn-block btn-group btn-group-toggle" data-toggle="buttons">
                        <label id="statuskasbanklabel" class="btn btn-flat-success active" style="cursor: pointer;">
                            <input type="radio" name="rb_statuskasbank" value="true" id="rb_kasbankaktif" checked="checked"> Akun Kas Bank </label>
                        <label id="bukanstatuskasbanklabel" class="btn btn-flat-danger" style="cursor: pointer;">
                            <input type="radio" name="rb_statuskasbank" value="false" id="rb_bukankasbankaktif"> Bukan Akun Kas Bank </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <button id="ubahcoaledger" class="btn btn-block btn-primary mr-2 ml-2">Ubah Data COA Ledger</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
let defaultinput="" ,selectedValueGroup ="", selectedValueLedger =""
let kodesupperusahaan = '<?= $kodesubperusahaan ;?>'
const regex = /\((.*?)\)/
let saldoawalAN = new AutoNumeric('#saldoawaleditledger', {decimalCharacter : ',',digitGroupSeparator : '.',});
$(function(){
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
    $("#pilihcoa, #pilihcoaedit").select2({dropdownAutoWidth:true});
    $('#pilihcoa, #pilihcoaedit').on('change', function() {
        selectedValueGroup = $(this).val();
        if (selectedValueGroup != ""){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url:baseurljavascript+'akuntansi/formatkodeakun',
                    type:'POST',
                    dataType:'json',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        id:selectedValueGroup,
                        jenisakun:"GRUP",
                        kodeunikmember:session_kodeunikmember,
                    },
                    success:function(response){
                        $("#kodegrup").val(response.data)
                        defaultinput = response.defaultinput
                    }
                });
            });
        }else{
            $("#kodegrup").val("")
        }
    });
    $("#pilihcoaledger, #pilihcoaledgeredit").select2({dropdownAutoWidth:true});
    $('#pilihcoaledger, #pilihcoaledgeredit').on('change', function() {
        selectedValueLedger = $(this).val();
        if (selectedValueLedger != ""){
            getCsrfTokenCallback(function() {
                $.ajax({
                    url:baseurljavascript+'akuntansi/formatkodeakun',
                    type:'POST',
                    dataType:'json',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        id:selectedValueLedger,
                        jenisakun:"LEDGER",
                        kodeunikmember:session_kodeunikmember,
                    },
                    success:function(response){
                        $("#kodeledgergrup").val(response.data)
                        defaultinput = response.defaultinput
                    }
                });
            });
        }else{
            $("#kodeledgergrup").val("")
        }
    });
})
function simpankodecoagroupledger(jenisakuncoa,parentid,kodeakun,defaultinput,namagroup,idbutton, saldoawaldefaultinput, saldoawal, kasbank,idcoa){
    let titlealert ="", pesankonfirmasialert="",urlnode = "",isinsert = 'true'
    if (idbutton === "simpancoagroup"){
        if ($("#kodegrup").val() == "" || $("#namagrup").val() == "") return toastr["error"]("Terjadi kesalahan dalam SIMPAN informasi. Form Kode COA dan Nama Group harus dilengkapi");
        titlealert = "Penambahan Group COA"
        pesankonfirmasialert = "Apakah anda yakin menambahkan <strong>"+$("#namagrup").val()+"</strong> kedalam Tabel COA Anda dibawah induk "+$("#pilihcoa option:selected").text().replaceAll("\u00a0"," ")+"?"
    }else if (idbutton === "ubahcoagroup"){
        if ($("#kodegrupedit").val() == "" || $("#namagrupedit").val() == "") return toastr["error"]("Terjadi kesalahan dalam UBAH informasi. Form Kode COA dan Nama Group harus dilengkapi");
        titlealert = "Ubah Group COA"
        pesankonfirmasialert = "Apakah anda yakin mengubah informasi <strong>"+$("#namagrupedit").val()+"</strong> [<strong>"+defaultinput+"</strong>] dengan kode <strong>"+$("#kodegrupedit").val()+"</strong> kedalam Tabel COA Anda dibawah induk "+$("#pilihcoa option:selected").text().replaceAll("\u00a0"," ")+"?"
        isinsert = 'false'
    }else if (idbutton === "simpancoaledger"){
        if ($("#kodeledgergrup").val() == "" || $("#namaledgergrup").val() == "") return toastr["error"]("Terjadi kesalahan dalam SIMPAN informasi. Form Kode COA dan Nama Ledger harus dilengkapi");
        titlealert = "Penambahan Ledger COA"
        pesankonfirmasialert = "Apakah anda yakin menambahkan Ledger <strong>"+$("#namaledgergrup").val()+"</strong> [<strong>"+defaultinput+"</strong>] dengan kode <strong>"+$("#kodeledgergrup").val()+"</strong> kedalam Tabel Ledger COA Anda dibawah induk "+$("#pilihcoaledger option:selected").text().replaceAll("\u00a0"," ")+"?"
    }else if (idbutton === "ubahcoaledger"){
        if ($("#kodegrupeditledger").val() == "" || $("#namagrupeditledger").val() == "") return toastr["error"]("Terjadi kesalahan dalam SIMPAN informasi. Form Kode COA dan Nama Ledger harus dilengkapi");
        titlealert = "Ubah Ledger COA"
        pesankonfirmasialert = "Apakah anda yakin mengubah Ledger <strong>"+$("#namagrupeditledger").val()+"</strong> dengan kode <strong>"+$("#kodegrupeditledger").val()+"</strong> kedalam Tabel Ledger COA Anda dibawah induk "+$("#pilihcoaledgeredit option:selected").text().replaceAll("\u00a0"," ")+"?"
        isinsert = 'false'
    }
    Swal.fire({
        title: titlealert,
        html: pesankonfirmasialert,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Simpan Informasi!'
    }).then((result) => {
        if (result.isConfirmed) {
            $("#"+idbutton).prop("disabled", true);
            $('#'+idbutton).html('<i class="fa fa-spin fa-spinner"></i> Proses Simpan Data COA');
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'akuntansi/ajaxtambahcoagrup',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        ID:idcoa,
                        JENISAKUN:jenisakuncoa,
                        PARENTID:parentid,
                        KODEAKUN:kodeakun,
                        DEFAULTINPUT: defaultinput,
                        SALDOAWAL : (idbutton === "ubahcoaledger" ? saldoawal : 0),
                        KASBANK: (idbutton === "ubahcoaledger" ? kasbank : false),
                        NAMAAKUNGROUP:namagroup,
                        ISEDIT:isinsert,
                        //editcoaledger
                        SAWALDEFAULTINPUT:saldoawaldefaultinput,
                        EDITLEDGER:(idbutton === "ubahcoaledger" ? true : false),
                        SUBPERUSAHAAN:$("#pilihperusahaan").val(),
                        NAMASUBPERUSAHAAN:$("#pilihperusahaan").select2('data')[0]['text'],
                    },
                    complete:function(){
                        $("#"+idbutton).prop("disabled", false);
                        $("#"+idbutton).html('Simpan Data COA');
                        setTimeout(() => { location.reload(); }, 1000);
                    },
                    success: function (response) {
                        if (response.success == true){
                            Swal.fire(
                                'COA Berhasil Disimpan',
                                response.msg,
                                'success'
                            )
                        }else{
                            Swal.fire(
                                'COA Gagal Disimpan',
                                response.msg,
                                'warning'
                            )
                        }
                    }
                });
            });
        }
    });
}
$("#simpancoagroup").on("click", function () {
    const match = $("#pilihcoa option:selected").text().match(regex);
    simpankodecoagroupledger("GRUP",selectedValueGroup,$("#kodegrup").val(),(match == null ? "" : match[1]),$("#namagrup").val(),"simpancoagroup","","","",0)
});
$("#simpancoaledger").on("click", function () {
    const match = $("#pilihcoaledger option:selected").text().match(regex);
    simpankodecoagroupledger("LEDGER",selectedValueLedger,$("#kodeledgergrup").val(),(match == null ? "" : match[1]),$("#namaledgergrup").val(),"simpancoaledger","","","",0)
});
function panggilmodalubah(golongan,namaakungroup,kodeakungrup,parentidgrup,defaultinput,saldoawal,kasbank,idcoa){
    if (golongan === "GRUP"){
        $("#idkodecoa").html(idcoa)
        $("#namaakungrup").html(namaakungroup)
        $("#kodegrupedit").val(kodeakungrup)
        $("#namagrupedit").val(namaakungroup)
        $('#pilihcoaedit').val(parentidgrup).trigger('change');
        $('#modalgrupedit').modal('show'); 
    }else{
        saldoawalAN.set(saldoawal);
        if (defaultinput === "K"){
            $('#labeleditdebit').removeClass('active');
            $('#labeleditkredit').addClass('active');
            $('#rb_dasarmasukancoakredit').prop('checked', true);
        }else{
            $('#labeleditkredit').removeClass('active');
            $('#labeleditdebit').addClass('active');
            $('#rb_dasarmasukancoadebit').prop('checked', true);
        }
        if (kasbank === "true"){
            $('#statuskasbanklabel').addClass('active');
            $('#bukanstatuskasbanklabel').removeClass('active');
            $('#rb_kasbankaktif').prop('checked', true);
        }else{
            $('#bukanstatuskasbanklabel').addClass('active');
            $('#statuskasbanklabel').removeClass('active');
            $('#rb_bukankasbankaktif').prop('checked', true);
        }
        $("#idkodecoaledger").html(idcoa)
        $("#namaakunledger").html(namaakungroup)
        $("#namagrupeditledger").val(namaakungroup)
        $("#kodegrupeditledger").val(kodeakungrup)
        $('#pilihcoaledgeredit').val(parentidgrup).trigger('change');
        $('#modallegeredit').modal('show'); 
    }
}
$("#ubahcoagroup").on("click", function () {
    const match = $("#pilihcoaedit option:selected").text().match(regex);
    simpankodecoagroupledger("GRUP",selectedValueGroup,$("#kodegrupedit").val(),(match == null ? "" : match[1]),$("#namagrupedit").val(),"ubahcoagroup","","","",$("#idkodecoa").html())
});
$("#ubahcoaledger").on("click", function () {
    const match = $("#pilihcoaledgeredit option:selected").text().match(regex);
    simpankodecoagroupledger("LEDGER",selectedValueLedger,$("#kodegrupeditledger").val(),(match == null ? "" : match[1]),$("#namagrupeditledger").val(),"ubahcoaledger",$('input[name="dasarmasukancoadebit"]:checked').val(),saldoawalAN.getNumber(),$('input[name="rb_statuskasbank"]:checked').val(),$("#idkodecoaledger").html())
});
function hapuskodecoa(idcoa,kodecoa,namacoa){
    Swal.fire({
        title: "Hapus Kode COA Jurnal",
        html: "Apakah anda ingin menghapus COA Jurnal <strong>["+kodecoa+"] "+namacoa+"</strong>. COA hanya bisa dihapus jika tidak ada entri didalam jurnal akuntansi. Jika ada 1 saja maka COA tidak bisa dihapus",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Hapus COA!',
        cancelButtonText: 'Tunggu Dulu!',
    }).then((result) => {
        if (result.isConfirmed) {
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'akuntansi/ajaxhapuskodecoa',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        IDCOA:idcoa,
                        KODECOA:kodecoa,
                        NAMACOA:namacoa,
                    },
                    success: function (response) {
                        if (response.success == true){
                            Swal.fire(
                                'COA Berhasil Dihapus',
                                response.msg,
                                'success'
                            )
                            setTimeout(() => { location.reload(); }, 1000);
                        }else{
                            Swal.fire(
                                'COA Gagal Dihapus',
                                response.msg,
                                'warning'
                            )
                        }
                    }
                });
            });
        }
    });
}
function pindahperusahaanjurnal(){
    location.href = baseurljavascript+"akuntansi/kodeakunakuntansi/"+$("#pilihperusahaan").val();
}
</script>
<?= $this->endSection(); ?>