var csrfTokenGlobal;
function formatuang(nominaluang,kodeuang,kodeinternasional){
    let formatter = new Intl.NumberFormat(kodeuang, {style: 'currency',currency: kodeinternasional,});
    return formatter.format(nominaluang);
}
function time_convert(num){ 
  let hours = Math.floor(num / 60);  
  let minutes = num % 60;
  return hours + " Jam : " + minutes+" Menit";         
}
function selectAllText(textbox) { textbox.focus(); textbox.select(); }
function formatRupiah(angka, prefix) {
    let number_string = angka.toString().replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }
    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    if (rupiah.indexOf(',') === -1) { rupiah += ',00'; }
    return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
}
function gantikata(str, find, replace){
    for (let i = 0; i < find.length; i++) {
        str = str.replace(new RegExp(find[i], 'gi'), replace[i]);
    }
    return str;
}
function gantikatamapobj(str,mapObj){
    let re = new RegExp(Object.keys(mapObj).join("|"),"gi");
    return str.replace(re, function(matched){
        return mapObj[matched.toLowerCase()];
    });
}
function parseLocaleNumber(stringNumber, locale) {
    let thousandSeparator = Intl.NumberFormat(locale).format(11111).replace(/\p{Number}/gu, '');
    let decimalSeparator = Intl.NumberFormat(locale).format(1.1).replace(/\p{Number}/gu, '');

    return parseFloat(stringNumber
        .replace(new RegExp('\\' + thousandSeparator, 'g'), '')
        .replace(new RegExp('\\' + decimalSeparator), '.')
    );
}
function decodeEntities(encodedString) {
    let textArea = document.createElement('p');
    textArea.innerHTML = encodedString;
    return textArea.value;
}
function cekjsonduplicate(kotakbelanja, key, value) {
    return kotakbelanja.filter(function (object) {
        return object[key] === value;
    });
};
const debounce = (func, delay) => {
    let debounceTimer
    return function() {
        const context = this
        const args = arguments
            clearTimeout(debounceTimer)
                debounceTimer
            = setTimeout(() => func.apply(context, args), delay)
    }
}
function randomstringdigit(length) {
    let result           = '';
    let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let charactersLength = characters.length;
    for ( let i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    let rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
function getCsrfTokenCallback(callback) {
    $.ajax({
        url: baseurljavascript + 'auth/getCsrfToken',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            csrfTokenGlobal = response.csrf_token;
            callback();
        },
        error: function(xhr, status, error) {
            toastr["error"]("Ada kesalahan dalam CALLBACK TOKEN");
        }
    });
}
async function getCsrfTokens(count) {
    try {
        const response = await $.ajax({
        url: baseurljavascript + 'auth/getCsrfTokens/' + count,
        method: 'GET',
        dataType: 'json'
    });
        const csrfTokens = response.csrf_tokens;
        return csrfTokens;
    } catch (error) {
        throw new Error("Gagal mendapatkan token CSRF.");
    }
}
function slugify(str) {
    return String(str)
      .normalize('NFKD')
      .replace(/[\u0300-\u036f]/g, '')
      .trim()
      .toLowerCase()
      .replace(/[^a-z0-9 -]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-');
}
function loadingAnimation() {
    let stringHTMLloading =
        "<div class=\"containerloading\">" +
        "<div class=\"contact-card\">" +
        "<div class=\"avatar\"></div>" +
        "<div class=\"text\"></div>" +
        "</div>" +
        "<div class=\"contact-card\">" +
        "<div class=\"avatar\"></div>" +
        "<div class=\"text\"></div>" +
        "</div>" +
        "<div id=\"magnifying-glass\">" +
        "<div id=\"glass\"></div>" +
        "<div id=\"handle\">" +
        "<div id=\"handle-inner\"></div>" +
        "</div>" +
        "</div>" +
        "</div>";

    return stringHTMLloading;
}
function countdownTimeStartMinutes(durationInMinutes, targetElement) {
    let countDownDate = new Date().getTime() + durationInMinutes * 60 * 1000;
    let x = setInterval(function() {
        let now = new Date().getTime();
        let distance = countDownDate - now;
        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        targetElement.innerHTML = "\nBayar Sebelum : "+hours + " jam "+ minutes + " menit " + seconds + " detik Lagi";
        if (distance < 0) { 
            clearInterval(x); 
            targetElement.innerHTML = "Transaksi Kadaluarsa, Silahkan Buat Ulang QRCode"; 
        }
    }, 1000);
}
function wait(ms){
    let start = new Date().getTime();
    let end = start;
    while(end < start + ms) {
      end = new Date().getTime();
   }
}
function hanyaAngka(field) {
    const validChars = "0123456789";
    let inputVal = field.value;
    let newVal = "";
    for (let i = 0; i < inputVal.length; i++) {
      if (validChars.indexOf(inputVal.charAt(i)) != -1) {
        newVal += inputVal.charAt(i);
      }
    }
    field.value = newVal;
}
function generateSelectTreeViewledger(informasidata, idnya, kasbank) {
    (typeof kasbank === 'undefined' ? kasbank = false : kasbank = true)
    const select = document.createElement('select');
    select.className = 'form-control';
    select.id = idnya;
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Silahkan pilih COA Induk';
    select.appendChild(defaultOption);
    const addOptions = (data, level = 0) => {
        data.forEach(item => {
            const indentation = '\xa0'.repeat(level * 2);
            const option = document.createElement('option');
            option.value = item.ID;
            option.textContent = `${indentation}${item.KODE_COA_GROUP} - ${item.NAMA_COA_GROUP} (${item.DEFAULTINPUT})`;
            if (item.JENISAKUN !== 'LEDGER') {
                option.disabled = true;
                option.classList.add('non-ledger');
            } else {
                option.disabled = false; 
                option.classList.remove('non-ledger');
            }
            if (kasbank){
                if (item.KASBANK == 'true') select.appendChild(option);
            }else{
                select.appendChild(option);
            }
            if (item.children && item.children.length > 0) {
                addOptions(item.children, level + 1);
            }
        });
    };
    addOptions(JSON.parse(informasidata));
    return select;
}
function getFullNumberFromString(str) {
    const regex = /\d+/g;
    const matches = str.match(regex);
    if (matches) {
        const fullNumber = matches.join('');
        return BigInt(fullNumber);
    }
    return null;
}
function ubahstringgolonganjurnal(str) {
    if (str == "JU") return "[JU] -  Jurnal Umum"
    if (str == "PJ") return "[PJ] -  Jurnal Penjualan"
    if (str == "PB") return "[PB] -  Jurnal Pembelian"
    if (str == "HT") return "[HT] -  Jurnal Hutang"
    if (str == "PT") return "[PT] -  Jurnal Piutang"
    if (str == "KM") return "[PT] -  Jurnal Kas Bank Masuk"
    if (str == "KK") return "[PT] -  Jurnal Kas Bank Keluar"
    if (str == "TK") return "[PT] -  Jurnal Transfer Kas Bank"
    return "ERROR - GOLONGAN TIDAK DITEMUKAN";
}
function calculatebcmath(param1 = 0, param2 = 0, op = '', decimalPlaces = 2) {
    const toFixed = (num, places) => parseFloat((num || 0).toFixed(places));
    switch (op) {
        case '+':
            return toFixed(param1 + param2, decimalPlaces);
        case '-':
            return toFixed(param1 - param2, decimalPlaces);
        case '==':
            return Math.abs(param1 - param2) < Math.pow(10, -decimalPlaces);
        case '!=':
            return Math.abs(param1 - param2) >= Math.pow(10, -decimalPlaces);
        case '<':
            return param1 < param2;
        case '>':
            return param1 > param2;
        case '>=':
            return param1 >= param2;
        case 'n':
            return toFixed(-param1, decimalPlaces);
        default:
            throw new Error('Invalid operation');
    }
}
/*
Gunakan rumus Saldo Akhir = Saldo Awal + Mutasi Debit - Mutasi Kredit untuk menghitung saldo akhir dengan asumsi default input debit.
Gunakan rumus Saldo Akhir = Saldo Awal - Mutasi Debit + Mutasi Kredit untuk menghitung saldo akhir dengan asumsi default input kredit.
*/
function calculate_withdc(param1, param1_dc, param2, param2_dc, defaultinput, decimalPlaces = 2) {
    let result;
    let result_dc;
    //console.log("Nilai "+param1+" "+"Tipe Input "+param1_dc)
    //console.log("Nilai "+param2+" "+"Tipe Input "+param2_dc)
    if (param1_dc === 'D' && param2_dc === 'D') {
        result = calculatebcmath(param1, param2, '+', decimalPlaces);
        result_dc = 'D';
    } else if (param1_dc === 'K' && param2_dc === 'K') {
        result = calculatebcmath(param1, param2, '+', decimalPlaces);
        result_dc = 'K';
    } else {
        if (calculatebcmath(param1, param2, '>', decimalPlaces)) {
            result = calculatebcmath(param1, param2, '-', decimalPlaces);
            result_dc = param1_dc;
        } else {
            result = calculatebcmath(param2, param1, '-', decimalPlaces);
            result_dc = param2_dc;
        }
    }
    //console.log("Hasil "+result+" "+"Tipe Input "+result_dc)
    return {
        amount: result,
        dc: result_dc,
        di: defaultinput,
    };
}
function extractNumericValue(currencyString) {
    const cleanedString = currencyString.replace(/[^0-9.]/g, '');
    const numericValue = parseFloat(cleanedString);
    return numericValue;
}
function hilangkanKodeNegara(nomor) {
    nomor = nomor.replace(/\D/g, '').replace('+', '');
    if (nomor.startsWith('0')) { nomor = nomor.substring(1); }
    if (nomor.startsWith('0')) { return '+62' + nomor.substring(1);}
    return nomor;
}
function convertISOToDDMMYYYYHHMMSS(isoDateString) {
    let date = new Date(isoDateString);
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();
    let formattedDay = (day < 10 ? '0' : '') + day;
    let formattedMonth = (month < 10 ? '0' : '') + month;
    let formattedHours = (hours < 10 ? '0' : '') + hours;
    let formattedMinutes = (minutes < 10 ? '0' : '') + minutes;
    let formattedSeconds = (seconds < 10 ? '0' : '') + seconds;
    let formattedDateString = formattedDay + '-' + formattedMonth + '-' + year + ' ' + formattedHours + ':' + formattedMinutes + ':' + formattedSeconds;
    return formattedDateString;
}
var wordflick = function () {
    skip_count = 0
    skip_delay = 15
    speed = 50
    setInterval(function () {
      if (forwards) {
        if (offset >= words[i].length) {
          ++skip_count;
          if (skip_count == skip_delay) {
            forwards = false;
            skip_count = 0;
          }
        }
      }
      else {
        if (offset == 0) {
          forwards = true;
          i++;
          offset = 0;
          if (i >= len) {
            i = 0;
          }
        }
      }
      part = words[i].substr(0, offset);
      if (skip_count == 0) {
        if (forwards) {
          offset++;
        }
        else {
          offset--;
        }
      }
      $('.animasitypejs').text(part);
    },speed);
  };