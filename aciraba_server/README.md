![Logo](https://cdn.seirasetyawan.com/images/aciraba_logo.png)
[![forthebadge](https://forthebadge.com/images/badges/built-with-love.svg)](https://forthebadge.com) [![forthebadge](https://forthebadge.com/images/badges/made-with-javascript.svg)](https://forthebadge.com) [![forthebadge](https://forthebadge.com/images/badges/open-source.svg)](https://forthebadge.com) 
## Apa Itu Aciraba Server ?
ACIRABA Server berbasis NODE JS adalah modul webservice yang digunakan untuk algoritma ACIRABA pada website. Modul ini bertanggung jawab untuk menyediakan endpoint dan layanan yang dibutuhkan oleh aplikasi web ACIRABA
## Alat perang sebelum install
1. API KEY untuk verifikasi jika meminta VERIFIKASI API KEY (GRATIS). Join Discord [Pandawa Cipta Karya](https://discord.gg/K3fsg32a6n)
2. Database : MySQL 8 atau MariaDB 10.x.x
3. Visual Code
4. Database Management : Workbrench, Navicat, dll
5. Postman untuk test API
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
2. Download project ini atau clone project ini kedalam perangkat anda
```bash
  git clone https://github.com/Meteor95/aciraba_server.git
  cd aciraba_server
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
Aciraba Server Berjalan 19/6/2023 14.40.51
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

## Dokumentasi [maintenance]
Gunakan ruang ini untuk menunjukkan contoh berguna tentang bagaimana sebuah proyek dapat digunakan. Tangkapan layar tambahan, contoh kode, dan demo berfungsi dengan baik di ruang ini. Anda juga dapat menautkan ke lebih banyak sumber daya.
_Untuk lebih banyak contoh, silakan merujuk ke [Dokumentasi](https://example.com)_

## License
>Cek keterangan lisensi [disini](https://github.com/IgorAntun/node-chat/blob/master/LICENSE)

Proyek ini dilisensikan berdasarkan syarat-syarat lisensi **MIT**.
