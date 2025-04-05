![Logo](https://aciraba.erayadigital.co.id/images/login/logonya.png)
[![forthebadge](https://forthebadge.com/images/badges/built-with-love.svg)](https://forthebadge.com)
# Apa sih ACIRABA itu ?
Aciraba adalah sistem Integrasi dengan Sistem Eksternal: Beberapa aplikasi POS berbasis website dapat diintegrasikan dengan sistem eksternal seperti sistem akuntansi, sistem manajemen gudang, atau platform e-commerce. Ini memungkinkan sinkronisasi data antara berbagai sistem dan mengurangi kerja yang berulang.<br>

> **Note** UMUM <br>
> 1. Script hanya digunakan untuk 1 nama brand outlet dengan 1 pemilik utama.
> 2. Tidak dapat merubah domain apabila lisensi sudah terinstall.
> 3. Pada outlet harus memiliki setidaknya 1Mbps internet untuk melakukan login sistem.

> **Note** KONTEN <br>
> 1. Isi konten atau layanan yang diberikan di website Anda adalah tanggung jawab Anda.
> 2. Kami tidak bertanggung jawab atas konten dagang tersebut.
> 3. Kami berhak melihat isi produk konten anda sebagai landasan kami guna mengembangkan fitur ACIRABA.
> 4. Kami berhak mematikan produk anda jika menurut kami produk anda melanggar landasar hukum di INDONESIA.
> 5. Kami berhak mengklaim fitur terbaru tesebut jika terdapat fitur yang belum anda pada fitur dasar ACIRABA dan berhak menawarkan kepada organisasi / toko lain secara SAH dan LEGAL.

## Alat perang sebelum install
1. Pengetahuan dasar mengenai CODEIGNITER 4 baik secara logika maupun struktur directory.
2. Visual Code
3. Composer Terbaru
   
## Installation
Berikut adalah cara pemasangan / install webservice untuk aciraba pada perangkat anda
1. Usahakan anda pernah menginstall CODEIGNITER 4 sampai HELLO WORLD
2. Download project ini atau clone project ini kedalam perangkat anda
```bash
git clone https://github.com/Meteor95/aciraba_website.git
cd aciraba_website
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
5. Violaaa....<br>
![LOGIN](https://aciraba.erayadigital.co.id/images/login_form.png)
## DEMO ??
[DEMO ACIRABA](https://aciraba.erayadigital.co.id)<br>
username : erayadigital<br>
password : salam1jiwa<br>
## .env format
```bash
URLAPISERVER= sesuaikan dengan alamat host server pada aplikasi aciraba_server terinstall
API_KEY_PANDAWA= "1C9925D3E1DC6162847B" <-- Gunakan ini saya buat DEMO
PRODUK_ID="9C46DEAE"<-- Gunakan ini saya buat DEMO
LISENSI="4BAA0 -E5682 -BACD4 -B1672"<-- Gunakan ini saya buat DEMO
NAMA_PEMILIK="DEMO_API"<-- Gunakan ini saya buat DEMO
DOMAIN_REGISTER="https://seirasetyawan.com"<-- Gunakan ini saya buat DEMO
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
Diperlukan PHP versi 8.0 atau lebih tinggi, dengan ekstensi berikut wajib terpasang:
- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
  
Selain itu, pastikan ekstensi berikut diaktifkan di PHP Anda:
- json (diaktifkan secara default - jangan dimatikan)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php)

## Dokumentasi [maintenance]
Gunakan ruang ini untuk menunjukkan contoh berguna tentang bagaimana sebuah proyek dapat digunakan. Tangkapan layar tambahan, contoh kode, dan demo berfungsi dengan baik di ruang ini. Anda juga dapat menautkan ke lebih banyak sumber daya.
_Untuk lebih banyak contoh, silakan merujuk ke [Dokumentasi](https://example.com)_
