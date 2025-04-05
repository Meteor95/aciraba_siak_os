const utils = {};
const crypto = require('crypto');
const nodemailer = require("nodemailer");
const OTPAuth = require('otpauth');
const fs = require("fs");
const moment = require('moment');
const mysql = require('mysql');
const algorithm = 'aes-256-cbc';
const key = crypto.randomBytes(32);
const iv = crypto.randomBytes(16);
const keyreal = crypto.scryptSync("SelaLuchCint4Kamoe", "garam", 32);
const ivreal = crypto.scryptSync("SelaLuchCint4Kamoe", "garam", 16);
const sqlite3 = require("sqlite3").verbose();
const dbcache = "./cache.db"
utils.kirimemail = function (host,port,secure,user,pass){
	let transporter = nodemailer.createTransport({
		host: host,
		port: port,
		secure: secure,
		auth: {
			user: user,
			pass: pass,
		},
	});
	return transporter;
}
utils.otp = function (KODEUNIKMEMBER,NAMAPENGGUNA){
    let totp = new OTPAuth.TOTP({
        issuer: "ERAYADIGITAL"+NAMAPENGGUNA.replace(/\s+/g, '').toUpperCase(),
        label: NAMAPENGGUNA.replace(/\s+/g, '').toUpperCase(),
        algorithm: 'SHA1',
        digits: 6,
        period: 1,
        timestamp: Math.floor(Date.now() / 1000) * 1000,
        secret: Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64'),
	});
	return totp;
}
function createDbConnection() {
    if (fs.existsSync(dbcache)) {
        return new sqlite3.Database(dbcache);
    } else {
        const db = new sqlite3.Database(dbcache, (error) => {
        if (error) console.log(error.message)
        createTable(db);
    });
    console.log("Connection with SQLite has been established");
    return db;
    }
  }
function createTable(db) {
    db.exec(`
    CREATE TABLE otpqueue
    (
      id INTEGER PRIMARY KEY AUTOINCREMENT,
      key VARCHAR(255) NOT NULL,
      token VARCHAR(255) NOT NULL,
      kodeunikmember VARCHAR(255) NOT NULL,
      period INTEGER NOT NULL
    );
  `);
}
utils.cacheotp = async function (TOKEN, KODEUNIKMEMBER,NAMAPENGGUNA,AKSI,PERIOD){
    let databaseex = createDbConnection();
    if (AKSI == 1){
        databaseex.each(`SELECT *,COUNT(*) as ADADATA FROM otpqueue WHERE key = ?`,[Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64')], (error, row) => {
            if (error) return console.error(error.message);
            if (row.ADADATA == 0){
                databaseex.run(
                    `INSERT INTO otpqueue (id, key, token, kodeunikmember, period) VALUES (?, ?, ?, ?, ?)`,
                    [, Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64'), TOKEN, KODEUNIKMEMBER, moment().add(PERIOD, 'seconds').unix()],
                    function (error) { if (error) console.error(error.message) }
                )
                databaseex.close()
                return true
            }
            if (row.key === Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64')){
                databaseex.run(
                    `UPDATE otpqueue SET token = ?, period = ? WHERE key = ?`,
                    [TOKEN, moment().add(PERIOD, 'seconds').unix(), Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64')],
                    function (error) { if (error) console.error(error.message);}
                );
                databaseex.close()
                return true
            }
        });
    }else if (AKSI == 2){
        return new Promise((resolve, reject) => {
            databaseex.each(`SELECT *,COUNT(*) as ADADATA FROM otpqueue WHERE key = ? AND token = ? LIMIT 1`,
                [Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64'), TOKEN],
                (error, row) => {
                    if (error) return reject(error);
                    //console.log(Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64'))
                    //console.log(TOKEN)
                    //console.log(row.ADADATA)
                    //console.log(row)
                    if (row.ADADATA > 0) {
                        if (row.key === Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64')) {
                            if (row.period < moment().unix()) {
                                resolve(0);
                              } else {
                                databaseex.run(`DELETE FROM otpqueue WHERE key = ?`, [Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64')], (error) => {
                                    if (error) return reject(error);
                                    resolve(1);
                                });
                            }
                        } else {
                            //console.log("Data tidak ditemukan. Karena TOKEN " + TOKEN + " dan KEY " + Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64'));
                            resolve(2);
                        }
                    } else {
                        //console.log("Data tidak ditemukan. Karena TOKEN " + TOKEN + " dan KEY " + Buffer.from(KODEUNIKMEMBER+NAMAPENGGUNA).toString('base64'));
                        resolve(2);
                    }
                });
        });
    }
}
utils.eksekusiQueryPromise = async (req, sql, param, con) => {
    return new Promise(function (resolve, reject) {
        con.query(sql, param, (err, rows) => {
            if (err) {
                reject(err);
            } else {
                resolve(rows);
            }
        });
    });
};
utils.eksekusiQueryCallback = (req, sql, param, con, callback) => {
    con.query(sql, param, (err, rows) => {
        if (err) {
            callback(err, null);
        } else {
            callback(null, rows);
        }
    });
};

utils.encrypt = function (text) {
    let cipher = crypto.createCipheriv(algorithm, Buffer.from(keyreal), ivreal);
    let encrypted = cipher.update(text);
    encrypted = Buffer.concat([encrypted, cipher.final()]);
    return JSON.stringify({ publickey: iv.toString('hex'), lokasihttaccess: encrypted.toString('hex'), publicsalt: key.toString('hex')});
}
utils.decrypt = function (text) {
    let textparse = JSON. parse(text)
    let encryptedText = Buffer.from(textparse.lokasihttaccess, 'hex');
    let decipher = crypto.createDecipheriv(algorithm, Buffer.from(keyreal), ivreal);
    let decrypted = decipher.update(encryptedText);
    decrypted = Buffer.concat([decrypted, decipher.final()]);
    return decrypted.toString();
}
utils.rsaencrypt = function (text, key) {
    const crypt = new JSEncrypt();
    crypt.setKey(key);
    return crypt.encrypt(text);
}

utils.rsadecrypt = function (encrypted, privateKey) {
    const crypt = new JSEncrypt();
    crypt.setPrivateKey(privateKey);
    return crypt.decrypt(encrypted);
}
utils.replaceMiddle = (string, n) => {
    var rest = string.length - n;
    return string.slice(0, Math.ceil(rest / 2) + 1) + '*'.repeat(n) + string.slice(-Math.floor(rest / 2) + 1);
};

utils.randomstring = function (length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}
utils.getWordBeforeUnderscore = function(kalimat,arrayke){
    const words = kalimat.split('_');
    return words[arrayke];
}
utils.terbilang = function (bilangan) {
    var kalimat = "";
    var angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
    var kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
    var tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun');
    var panjang_bilangan = bilangan.length;

    /* pengujian panjang bilangan */
    if (panjang_bilangan > 15) {
        kalimat = "Diluar Batas";
    } else {
        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for (i = 1; i <= panjang_bilangan; i++) {
            angka[i] = bilangan.substr(-(i), 1);
        }
        var i = 1;
        var j = 0;
        /* mulai proses iterasi terhadap array angka */
        while (i <= panjang_bilangan) {
            subkalimat = "";
            kata1 = "";
            kata2 = "";
            kata3 = "";
            /* untuk Ratusan */
            if (angka[i + 2] != "0") {
                if (angka[i + 2] == "1") {
                    kata1 = "Seratus";
                } else {
                    kata1 = kata[angka[i + 2]] + " Ratus";
                }
            }
            /* untuk Puluhan atau Belasan */
            if (angka[i + 1] != "0") {
                if (angka[i + 1] == "1") {
                    if (angka[i] == "0") {
                        kata2 = "Sepuluh";
                    } else if (angka[i] == "1") {
                        kata2 = "Sebelas";
                    } else {
                        kata2 = kata[angka[i]] + " Belas";
                    }
                } else {
                    kata2 = kata[angka[i + 1]] + " Puluh";
                }
            }
            /* untuk Satuan */
            if (angka[i] != "0") {
                if (angka[i + 1] != "1") {
                    kata3 = kata[angka[i]];
                }
            }
            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
            if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
                subkalimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " ";
            }
            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
            kalimat = subkalimat + kalimat;
            i = i + 3;
            j = j + 1;
        }
        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")) {
            kalimat = kalimat.replace("Satu Ribu", "Seribu");
        }
    }
    return kalimat;
}
utils.replacestringaaray = function ( str, findArray, replaceArray ){
	var i, regex = [], map = {}; 
	for( i=0; i<findArray.length; i++ ){ 
		regex.push( findArray[i].replace(/([-[\]{}()*+?.\\^$|#,])/g,'\\$1') );
		map[findArray[i]] = replaceArray[i]; 
	}
	regex = regex.join('|');
	str = str.replace( new RegExp( regex, 'g' ), function(matched){
		return map[matched];
	});
	return str;
}
utils.ekstensiuploadimage = function not(data, jenis) {
	var names = [];
	if (jenis == "'ubahinfoagen'"){
		names = ["image/jpeg", "image/jpg","application/octet-stream"];
	}
	if (names.indexOf(data) !== -1) return true;
	return false
}
utils.replaceNonAlphanumericWithDash = function (str) {
    return str.replace(/\W+/g, '-');
}
utils.calculate = function (param1 = 0, param2 = 0, op = '', decimal_places = 2) {
    const factor = Math.pow(10, decimal_places);
    function compare(p1, p2, dp) {
        const scale1 = Math.round(p1 * Math.pow(10, dp));
        const scale2 = Math.round(p2 * Math.pow(10, dp));
        return scale1 - scale2;
    }
    switch (op) {
        case '+':
            return parseFloat(((param1 + param2) * factor / factor).toFixed(decimal_places));
        case '-':
            return parseFloat(((param1 - param2) * factor / factor).toFixed(decimal_places));
        case '==':
            return compare(param1, param2, decimal_places) === 0;
        case '!=':
            return compare(param1, param2, decimal_places) !== 0;
        case '<':
            return compare(param1, param2, decimal_places) < 0;
        case '>':
            return compare(param1, param2, decimal_places) > 0;
        case '>=':
            return compare(param1, param2, decimal_places) >= 0;
        case 'n':
            return parseFloat((param1 * -1).toFixed(decimal_places));
        default:
            throw new Error('Invalid operation');
    }
}
utils.calculate_withdc = function (param1, param1_dc, param2, param2_dc, defaultinput, decimalPlaces = 2) {
    let result;
    let result_dc;
    //console.log("Nilai "+param1+" "+"Tipe Input "+param1_dc)
    //console.log("Nilai "+param2+" "+"Tipe Input "+param2_dc)
    if (param1_dc === 'D' && param2_dc === 'D') {
        result = utils.calculate(param1, param2, '+', decimalPlaces);
        result_dc = 'D';
    } else if (param1_dc === 'K' && param2_dc === 'K') {
        result = utils.calculate(param1, param2, '+', decimalPlaces);
        result_dc = 'K';
    } else {
        if (utils.calculate(param1, param2, '>', decimalPlaces)) {
            result = utils.calculate(param1, param2, '-', decimalPlaces);
            result_dc = param1_dc;
        } else {
            result = utils.calculate(param2, param1, '-', decimalPlaces);
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
module.exports = utils;