![Logo](https://cdn.erayadigital.co.id/images/logo_aciraba.png)
[![forthebadge](https://forthebadge.com/images/badges/built-with-love.svg)](https://forthebadge.com)
# ACIRABA FRONT END

# Kenapa tidak jadi 1 saja di Codeigniter, Malah CI + Node JS
Karena dulu ingin belajar nodejs + express dan ingin belajar komunikasi data dengan API, ya sudah sekalian dapat project + dibayar + belajar + udah dapat izin dulu di masing masing client, clientnya cuma bilang. Ya udah mas yang penting kenceng, benar, dan akurat data saya
# Kok Tidak Ada Mode Deploy Seperti Docker
Mohon maaf, karena ini project lama sekitar 1 2 tahun lalu dan saya belum belajar docker jadi tidak saya distkan dalam bentuk docker atau sejenisnya. Tidak apalah yang penting bisa digunakan
# Apa sih ACIRABA itu ?
Aciraba adalah sistem Integrasi dengan Sistem Eksternal: Beberapa aplikasi POS berbasis website dapat diintegrasikan dengan sistem eksternal seperti sistem akuntansi, sistem manajemen gudang, atau platform e-commerce. Ini memungkinkan sinkronisasi data antara berbagai sistem dan mengurangi kerja yang berulang.<br>

> **Note** UMUM <br>
> 1. Script bebas dikembangkan dan dipakai komersial asalahkan ANDA PEMILIK USAHA.
> 2. Script tidak boleh diperjual belikan secara utuh ya, boleh dikomersilkan asalkan tidak merubah hak cipta seperti logo, footer, command, dll dan jika cair harus disumbangkan 10% untuk zakat bebas terserah anda.
> 3. Pada outlet harus memiliki setidaknya 1Mbps internet untuk melakukan login sistem.

> **Note** KONTEN <br>
> 1. Isi konten atau layanan yang diberikan di website Anda adalah tanggung jawab Anda.
> 2. Kami tidak bertanggung jawab atas konten dagang tersebut.
> 3. Kami berhak melihat isi produk konten anda sebagai landasan kami guna mengembangkan fitur ACIRABA.
> 4. Kami berhak mematikan produk anda jika menurut kami produk anda melanggar landasar hukum di INDONESIA.
> 5. Kami berhak mengklaim fitur terbaru tesebut jika terdapat fitur yang belum anda pada fitur dasar ACIRABA dan berhak menawarkan kepada organisasi / toko lain secara SAH dan LEGAL.

> **Note** APAKAH ADA AKUNTANSI <br>
> 1. Iya sebenarnya ada cuma masih belum saya integrasikan karena ada request dari clien tp tidak jadi karena pembayaran macet.
> 2. Akuntansinya jalan kok jadi harus manual masukinnya semacam rekap penjualan.

## Alat perang sebelum install
1. Pengetahuan dasar mengenai CODEIGNITER 4.6 baik secara logika maupun struktur directory.
2. IDE Kesayangan Anda : Trae, Windsurf, VS Code, Cursor atau Bahkan MS WORD <-- THE BEST IDE EVER
3. Composer Terbaru
   
## Installation
Berikut adalah cara pemasangan / install webservice untuk aciraba pada perangkat anda
1. Usahakan anda pernah menginstall CODEIGNITER 4 sampai HELLO WORLD
2. Download project ini atau clone project ini kedalam perangkat anda. bebas mau via HTTPS, SSH atau Unduh Manual deh ini contohnya via clone HTTPS
```bash
git clone https://github.com/Meteor95/aciraba_siak_os.git
cd ACIRABA/aciraba_websit
```
3. Pasang semua komponen yang dibutuhkan untuk menjalankan ACIRABA dengan cara
```bash
composer install
composer update
```
4. Langkah terakhir seharusnya anda sudah bisa menikmati sistem yang disajikan oleh ACIRABA
```bash
php spark serve

CodeIgniter v4.x.x Command Line Tool - Server Time: 20xx-xx-xx xx:xx:xx UTC+00:00

CodeIgniter development server started on http://localhost:8080
Press Control-C to stop.
[Mon xxx xx xx:xx:xx 20xx] PHP 8.x.x Development Server (http://hostname:port) started
```
5. Violaaa..... jangan khawatir gambar hanya editan, aslinya gak lebai ada kuning kuningnya kok biar sangar aja dan bikin penasaran<br>
![LOGIN](https://cdn.erayadigital.co.id/images/login_dark_mode_light_mode.jpg)
## DEMO ??
Kalau mau DEMO nanti saya upate disini atau di threads. Soalnya gak ada space kosong. silahkan coba dilocal aja ya<br>
username : erayadigital<br>
password : salam1jiwa<br>
## .env format
```bash
URLAPISERVER= sesuaikan dengan alamat host server pada aplikasi aciraba_server terinstall
API_KEY_PANDAWA= "1C9925D3E1DC6162847B" <-- Gunakan ini saya buat DEMO
PRODUK_ID="9C46DEAE"<-- Gunakan ini saya buat DEMO
LISENSI="4BAA0 -E5682 -BACD4 -B1672"<-- Gunakan ini saya buat DEMO
NAMA_PEMILIK="DEMO_API"<-- Gunakan ini saya buat DEMO
DOMAIN_REGISTER="https://erayadigital.co.id"<-- Gunakan ini saya buat DEMO
TOKENAPI="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOjEsImlhdCI6MTYyNDI2MTk1NywiZXhwIjoxNjM5ODEzOTU3fQ.MSLX2hbVGle88bofGlCAgMdkUjs54ntyinQljs6_RCI" <-- Gunakan ini saya buat DEMO
TOKENRAJAONGKIR= beli aja di RAJAONGKIR.COM fitur ini masih dikembangkan 
TOKENAPIGOOGLEMAPS= beli aja di cloud.google.com fitur ini masih dikembangkan
```
## ERROR SAAT APLIKASI DI JALANKAN ?
Warning: Undefined array key "URLAPISERVER" in ./../aciraba_website/app/Config/Constants.php on line 112 <br>
ini_set(): Session ini settings cannot be changed after headers have already been sent<br>
Coba tambahkan code ini pada ./app/Config/Constants.php pada awal setelah tag PHP<br>
```bash
use Dotenv\Dotenv;
$rootPath = realpath(__DIR__ . '/../..');
require_once $rootPath . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable($rootPath);
$dotenv->load();
```

## Persyaratan Perangkat
Diperlukan PHP versi 8.1, dengan ekstensi berikut wajib terpasang:
- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
  
Selain itu, pastikan ekstensi berikut diaktifkan di PHP Anda:
- json (diaktifkan secara default - jangan dimatikan)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php)

===========================================================

# ACIRABA NODE SERVER - BACKEND

[![forthebadge](https://forthebadge.com/images/badges/built-with-love.svg)](https://forthebadge.com) [![forthebadge](https://forthebadge.com/images/badges/made-with-javascript.svg)](https://forthebadge.com) [![forthebadge](https://forthebadge.com/images/badges/open-source.svg)](https://forthebadge.com) 
## Apa Itu Aciraba Server ?
ACIRABA Server berbasis NODE JS adalah modul webservice yang digunakan untuk algoritma ACIRABA pada website. Modul ini bertanggung jawab untuk menyediakan endpoint dan layanan yang dibutuhkan oleh aplikasi web ACIRABA
## Alat perang sebelum install
1. Database : MySQL 8 atau MariaDB 10.x.x (Kok gak pakai PostgreeSQL: Dulu masih belajar udah jangan protes hahaha)
2. Database Management : Workbrench, Navicat, dll
3. Postman untuk test API

## Installation
Berikut adalah cara pemasangan / install webservice untuk aciraba pada perangkat anda <br>
0. Pastikan unggah database terlebih dahulu yang terletak pada FOLDER DATABASE kedalam MYSQL DATABASE SERVER anda kemudian sesuaikan konfigurasi pada .env yang anda. Untuk format format .env
```bash
DB_HOST=Alamat ip / domain host database anda
DB_USER=user database
DB_PASS=password database
DB_NAME=nama database
DB_PORT=port database

PRICEPLAN=
DEFAUL_MARKUP=5

ACCESS_TOKEN_RHS=buat token yang untuk untuk JWT
OTP_TOKEN_RHS=OTP Token
FCM_SERVER_KEY=

DIGIFLAZZ_USERNAME=
DIGIFLAZZ_KEY_BACK=
DIGIFLAZZ_KEY=
DIGIFLAZZ_SECRET_KEY=

EMAIL_HOST=
EMAIL_PORT=
EMAIL_ISSECURE=true
EMAIL_USERNAME=
EMAIL_PASSWORD=
EMAIL_DARI =
```
1. Install nodejs pada perangkat anda dan pilih versi node js dengan versi 16 keatas
2. Download project ini atau clone project ini kedalam perangkat anda, kalau sudah melakukan pada step FRONT END bisa diskip sih yang clone nya
```bash
  git clone https://github.com/Meteor95/aciraba_siak_os.git
  cd ACIRABA/aciraba_server
```
3. Pasang / install komponen yang dibutuhkan aciraba server dengan perintah, tunggu hingga selesai
```bash
    npm install
```
4. Kemudian run server nodejs anda dengan cara
```bash
    npm run gas
```
Tunggu hingga proses seperti dibawah ini. Jika muncul dibawah ini maka server berjalan dengan normal
```bash
> apicaipay@1.0.0 gas
> nodemon apiaciraba.js

[nodemon] 2.0.20
[nodemon] to restart at any time, enter `rs`
[nodemon] watching path(s): *.*
[nodemon] watching extensions: js,mjs,json
[nodemon] starting `node apiaciraba.js`
Aciraba Server Berjalan 05/4/2025 08.40.51
Listen Mysql : ALL
```
atau anda bisa ubah sendiri sesuai dengan keinginan anda. buka file package.json
```bash
"scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "gasToken": "nodemon serverToken.js",
    "gasServer": "nodemon --exec babel-node server.js",
    "gas": "nodemon apiaciraba.js"
},
```
5. Test secara pribadi ya di postman atau aplikasi lain yang anda ketahui apakah webservice sudah berfungsi secara normal.

## License
>Cek keterangan lisensi [disini](https://github.com/IgorAntun/node-chat/blob/master/LICENSE)
Proyek ini dilisensikan berdasarkan syarat-syarat lisensi **MIT**.

## Dokumentasi [maintenance]
Untuk dokumentasi untuk versi ini tidak ada, karena sekarang lagi kami re-write kedalam bahasa pemograman dan kerangka kerja lain. Jadi ini project BUG FIXING. Jika ada request tapi minor boleh lah JAPRI

## BIG THANKS FOR THEM
1. Kotak Cantik Magelang
2. Toko Oli Magelang Sanjaya
3. Toko Sepatu QQ Magelang
4. Toko Grosir Bara
5. Olivia Baby Shop Kota Malang
6. TEFA MART SMK NEGERI 1 Malang<br>
Yang mau jadi sponsor dulu, belajar sambil dibayar<br>
Makasih juga yang lainnya seperti toko klontong kecil kecil, warung kopi langganan saya yang menggunakan Aciraba sebagai ujicoba aplikasi HAHAHA
