var entridebit = [], entrikredit = []
let totaldebit = 0,totalkredit = 0;
$("#generateiditem").on("click", function () {
    $('#siak_notransaksi').val("SIAK" + session_kodeunikmember + session_outlet + Math.floor(Date.now() / 1000));
});
function tambahbarisentrijurnal(){
    if (notrxeditjurnal == ""){
        temprow = temprow + (tabelentrijurnaltabel.rows().count() == 0 ? 1 : tabelentrijurnaltabel.rows().count());
        const selectCoa = generateSelectTreeViewledger(informasidata, "entrijurnal" + temprow);
        tabelentrijurnaltabel.on('draw.dt', function () {
            let data = tabelentrijurnaltabel.rows().count() + 1;
            if (data > 0){
                if (!AutoNumeric.getAutoNumericElement("#debit"+temprow)) { 
                    entridebit[temprow] = new AutoNumeric("#debit"+temprow, {decimalCharacter : ',',digitGroupSeparator : '.',});
                }
                if (!AutoNumeric.getAutoNumericElement("#kredit"+temprow)) { 
                    entrikredit[temprow] = new AutoNumeric("#kredit"+temprow, {decimalCharacter : ',',digitGroupSeparator : '.',});
                }
            }
            let scrollBody = $('.dataTables_scrollBody')[0];scrollBody.scrollTop = scrollBody.scrollHeight;
        }).on('key-focus', function ( e, datatable, cell, originalEvent ) {
            $('input', cell.node()).focus();
        }).on("focus", "td input", function(){
            $(this).select();
        })
        tabelentrijurnaltabel.row.add([
            tabelentrijurnaltabel.rows().count() + 1,
            selectCoa.outerHTML,
            "<input id=\"narasiakun"+temprow+"\" placeholder=\"Ketik narasi pada entri jural item ini\" name=\"narasiakun[]\" class=\"narasiakun form-control\" type=\"text\" value=\"\">",
            "<input id=\"debit"+temprow+"\" name=\"debit[]\" class=\"debit form-control\" type=\"text\" value=\"0\">",
            "<input id=\"kredit"+temprow+"\" name=\"kredit[]\" class=\"kredit form-control\" type=\"text\" value=\"0\">",
            "<div><button class=\"hapusentrijurnal btn-block btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>",
        ]).draw();
        $('#entrijurnal' + temprow).select2({
            placeholder: 'Pilih Kode COA',
            dropdownAutoWidth: true,
            width: 'auto'
        });
    }else{
        const currentTimeInMillis = new Date().getTime();
        const uniqueId = currentTimeInMillis + tabelentrijurnaltabel.rows().count();
        const newRowData = {
            "No": tabelentrijurnaltabel.rows().count() + 1,
            "Akun": generateSelectTreeViewledger(informasidata, "entrijurnal" + uniqueId).outerHTML,
            "Narasi Akun": "<input id=\"narasiakun"+uniqueId+"\" placeholder=\"Ketik narasi pada entri jural item ini\" name=\"narasiakun[]\" class=\"narasiakun form-control\" type=\"text\" value=\"\">",
            "Debit": "<input id=\"debit"+uniqueId+"\" name=\"debit[]\" class=\"debit form-control\" type=\"text\" value=\"\">",
            "Kredit": "<input id=\"kredit"+uniqueId+"\" name=\"kredit[]\" class=\"kredit form-control\" type=\"text\" value=\"\">",
            "Aksi": "<div><button class=\"hapusentrijurnal btn-block btn btn-danger\"><i class=\"fas fa-trash\"></i> Hapus</button></div>"
        };
        tabelentrijurnaltabel.row.add(newRowData).draw();
    }
    tabelentrijurnaltabel.columns.adjust().draw();
    hitungjurnal()
}
$("#tambahbarusentrijurnal").on("click", function() {
    tambahbarisentrijurnal()
});

$('#entrijurnaltabel').on('click', '.hapusentrijurnal', function () {
    try {
        var table = $('#entrijurnaltabel').DataTable();
        var row = $(this).parents('tr');
        if ($(row).hasClass('child')) {
            table.row($(row).prev('tr')).remove().draw();
        } else {
            table.row($(this).parents('tr')).remove().draw();
        }
        hitungjurnal()
    }
    catch(err) {}
});
document.addEventListener('keydown', function (event) {
    if (event.ctrlKey && event.altKey) {
        tambahbarisentrijurnal()
        hitungjurnal()
    }
    if (event.ctrlKey && event.key === 's') {
        event.preventDefault();
        simpanentrijurnal()
    }
});
function hitungjurnal(){
    let datarow = tabelentrijurnaltabel.rows().count();
    if (datarow <= 0){
        $('#totaldebit').html(formatuang(0,'id-ID','IDR'));
        $('#totalkredit').html(formatuang(0,'id-ID','IDR'));
        $('#selisih').html(formatuang(0,'id-ID','IDR'));
    }else{
        let data = tabelentrijurnaltabel.rows().data();
        totaldebit = 0,totalkredit = 0;
        data.each(function (value, idindex) {
            let row = tabelentrijurnaltabel.row(idindex).node();
            let debitInputId = $(row).find('input[id^="debit"]').attr('id');
            let kreditInputId = $(row).find('input[id^="kredit"]').attr('id');    
            let debitValue = entridebit[getFullNumberFromString(debitInputId)] ? entridebit[getFullNumberFromString(debitInputId)].getNumber() : 0;
            let kreditValue = entrikredit[getFullNumberFromString(kreditInputId)] ? entrikredit[getFullNumberFromString(kreditInputId)].getNumber() : 0;
            totaldebit = totaldebit + debitValue;
            totalkredit = totalkredit + kreditValue;
            $('#totaldebit').html(formatuang(totaldebit.toFixed(2),'id-ID','IDR'));
            $('#totalkredit').html(formatuang(totalkredit.toFixed(2),'id-ID','IDR'));
            $('#selisih').html(formatuang(((totaldebit - totalkredit) < 0 ? ((totaldebit - totalkredit) * -1) : (totaldebit - totalkredit)).toFixed(2),'id-ID','IDR'));    
        })
    }
}
$('#entrijurnaltabel').on('keypress', 'input[id^="debit"]', debounce(function (e) {
    hitungjurnal()
}, 500));
$('#entrijurnaltabel').on('keypress', 'input[id^="kredit"]', debounce(function (e) {
    hitungjurnal()
}, 500));
function bersihkanformulir(){
    $("#siak_notransaksi").val(""),
    $('#pilihperusahaan').val($('#pilihperusahaan option:first-child').val()).trigger('change');
    $('#tanggalentrijurnal').val(moment().format('DD-MM-YYYY'));
    quillnya.setContents([{insert: ' '}]);
    $('#totaldebit').html(formatuang(0,'id-ID','IDR'));
    $('#totalkredit').html(formatuang(0,'id-ID','IDR'));
    $('#selisih').html(formatuang(0,'id-ID','IDR'));
    tabelentrijurnaltabel.clear().draw();
}
function simpanentrijurnal(){
    Swal.fire({
        title: 'Apakah Entri Jurnal Benar?',
        text: 'Apakah anda yakin ingin melakukan entri jural pada sistem keuangan anda. Jikalau anda melakukan perubahan pastikan sebelum anda melakukan proses TUTUP BUKU',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke, Entri Sekarang!!',
        cancelButtonText: 'Tunggu Dulu!!'
    }).then((result) => {
        if (result.isConfirmed) {
            if (tabelentrijurnaltabel.rows().count() < 2) return toastr["error"]("Entri jurnal masih belum terpenuhi. Silahkan masukan minimal 2 baris entri jurnal dengan DEBIT dan KREDIT yang seimbang");
            if ((totaldebit - totalkredit) != 0) return toastr["error"]("Entri Jurnal masih belum seimbang. Silahkan cek selisih antara DEBIT KREDIT");
            let data = tabelentrijurnaltabel.rows().data();
            let dataEntriJurnal = [];
            totaldebit = 0,totalkredit = 0;
            for (let i = 0; i < data.length; i++) {
                let row = tabelentrijurnaltabel.row(i).node();      
                let select2ElementId = $(row).find('select[id^="entrijurnal"]'); 
                let narasiakunInputId = $(row).find('input[id^="narasiakun"]');
                let debitInputId = $(row).find('input[id^="debit"]').attr('id');
                let kreditInputId = $(row).find('input[id^="kredit"]').attr('id');
                let debitValue = entridebit[getFullNumberFromString(debitInputId)] ? entridebit[getFullNumberFromString(debitInputId)].getNumber() : 0;
                let kreditValue = entrikredit[getFullNumberFromString(kreditInputId)] ? entrikredit[getFullNumberFromString(kreditInputId)].getNumber() : 0;
                totaldebit += debitValue;
                totalkredit += kreditValue;
                let dataJurnal = {
                    kodecoa: select2ElementId.val(),
                    narasiakun: narasiakunInputId.val(),
                    debit: debitValue,
                    kredit: kreditValue,
                };
                if (select2ElementId.val() === null || select2ElementId.val() === ""){
                    return toastr["error"]("Kode COA dalam entri jurnal wajib diisi. Silahkan tentukan kode COA pada baris "+$(row).find('td').eq(0).text());
                }
                if (debitValue > 0 && kreditValue > 0){
                    return toastr["error"]("Entri jurnal debit dan kredit tidak boleh diisi dalam 1 kode COA. Cek pada baris "+$(row).find('td').eq(0).text()+" untuk melakukan refisi");
                }
                dataEntriJurnal.push(dataJurnal);
            }
            const datatrxentrijurnal = {
                notransaksi: ($("#siak_notransaksi").val() == "" ? "SIAK" + session_kodeunikmember + Math.floor(Date.now() / 1000) : $("#siak_notransaksi").val()),
                tanggaltrx: $("#tanggalentrijurnal").val().split("-").reverse().join("-"),
                narasientrijurnal: quillnya.root.innerHTML,
                totaldebit: totaldebit,
                totalkredit: totalkredit,
                outlet: session_outlet,
                kodeunikmember: session_kodeunikmember,
                perusahaan: $("#pilihperusahaan").val(),
                dataentrijurnal: dataEntriJurnal
            };
            getCsrfTokenCallback(function() {
                $.ajax({
                    url: baseurljavascript + 'akuntansi/simpanentrijurnal',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]:csrfTokenGlobal,
                        INFORMASIENTRIJURNAL : datatrxentrijurnal,
                        NOTRXEDIT : notrxeditjurnal,
                        JENISJURNAL : 'JU',
                    },
                    success: function (response) {
                        if (response.success == true){
                            Swal.fire({
                                title: 'Entri Jurnal Berhasil Di Catat',
                                text: response.msg,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Entri Jurnal Baru!!',
                                cancelButtonText: 'Kembali Ke Daftar Jurnal!!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    bersihkanformulir()
                                }else{
                                    window.location.href = baseurljavascript+'akuntansi/daftarentrijurnal';
                                }
                            })
                        }else{
                            Swal.fire(
                                'Terjadi Kesalahan!',
                                response.msg,
                                'error'
                            )
                        }
                    }
                });
            });
        }
    })
}
$("#btnsimpanentrijurnal").on("click", function() {
    simpanentrijurnal()
});