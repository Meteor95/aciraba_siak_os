/*
 Navicat Premium Data Transfer

 Source Server         : Aciraba Website Sandy
 Source Server Type    : MySQL
 Source Server Version : 100506
 Source Host           : 103.56.149.181:3306
 Source Schema         : aciraba_website

 Target Server Type    : MySQL
 Target Server Version : 100506
 File Encoding         : 65001

 Date: 12/07/2023 19:31:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for 01_bnt_stok_suplier
-- ----------------------------
DROP TABLE IF EXISTS `01_bnt_stok_suplier`;
CREATE TABLE `01_bnt_stok_suplier`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `KODESUPLIER` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `STOK` double(15, 2) NOT NULL DEFAULT 0,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'GDPST',
  `HPP` double(15, 2) NOT NULL DEFAULT 0,
  `NOTAPEMBELIAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `TANGGALDATANG` bigint(20) NOT NULL DEFAULT 0,
  `DARISUBPERUSAHAAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NON',
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_log_activityuser
-- ----------------------------
DROP TABLE IF EXISTS `01_log_activityuser`;
CREATE TABLE `01_log_activityuser`  (
  `AI_LOG` int(11) NOT NULL AUTO_INCREMENT,
  `DATE` bigint(20) NOT NULL,
  `USERLOG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JENISLOG` enum('PENJUALAN','PEMBELIAN','RETUR PENJUALAN','RETUR PEMBELIAN') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTRANSAKSI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI_LOG`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_set_app
-- ----------------------------
DROP TABLE IF EXISTS `01_set_app`;
CREATE TABLE `01_set_app`  (
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SYNP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAPEMILIK` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ALAMATPEMILIK` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NPWP` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FOTOKTP` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `NOTELP` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `EXPIREDSYN` date NOT NULL,
  PRIMARY KEY (`SYNP`, `KODEUNIKMEMBER`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_set_app_dongle
-- ----------------------------
DROP TABLE IF EXISTS `01_set_app_dongle`;
CREATE TABLE `01_set_app_dongle`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FD_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PIN_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_set_outlet
-- ----------------------------
DROP TABLE IF EXISTS `01_set_outlet`;
CREATE TABLE `01_set_outlet`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEOUTLET` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAOUTLET` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ALAMAT` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LAT` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `LONG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `NOTELP` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `APAKAHPUSAT` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAJAKNEGARA` double(30, 2) NOT NULL DEFAULT 11,
  `PAJAKTOKO` double(30, 2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`AI`) USING BTREE,
  UNIQUE INDEX `INDEX`(`KODEUNIKMEMBER`, `KODEOUTLET`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tmp_barcodeprint
-- ----------------------------
DROP TABLE IF EXISTS `01_tmp_barcodeprint`;
CREATE TABLE `01_tmp_barcodeprint`  (
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HARGAJUAL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KATEGORI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MINIMALSTOK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JUMLAHCETAK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `KODEBARANG`(`KODEBARANG`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tmp_kaskecilbesar
-- ----------------------------
DROP TABLE IF EXISTS `01_tmp_kaskecilbesar`;
CREATE TABLE `01_tmp_kaskecilbesar`  (
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NILAIMINIMAL` double(15, 2) NOT NULL,
  PRIMARY KEY (`KODEUNIKMEMBER`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tmp_labarugi
-- ----------------------------
DROP TABLE IF EXISTS `01_tmp_labarugi`;
CREATE TABLE `01_tmp_labarugi`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `TIPEINPUT` enum('PENJUALAN','PEMBELIAN','BEBAN NON OPERASIONAL','BEBAN OPERASIONAL','HPP','PENDAPATAN NON OPERASIONAL','PENDAPATAN LAIN LAIN','PENGELUARAN LAIN LAIN','BEBAN','RETUR PEMBELIAN','RETUR PENJUALAN') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTRANSAKSI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMINAL` double(15, 2) NOT NULL,
  `NAMAPERKIRAAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGAL` bigint(20) NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `POSISI` int(11) NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tmp_pecahsatuan
-- ----------------------------
DROP TABLE IF EXISTS `01_tmp_pecahsatuan`;
CREATE TABLE `01_tmp_pecahsatuan`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `IDBARANGASAL` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `IDBARANGBARU` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ASALPECAH` int(11) NOT NULL,
  `MENJADI` int(11) NOT NULL,
  `HARGAJUAL` double(15, 2) NOT NULL,
  `HARGABELI` double(15, 2) NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `KASIR` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_barangitemcitra
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_barangitemcitra`;
CREATE TABLE `01_tms_barangitemcitra`  (
  `AI` int(255) NOT NULL AUTO_INCREMENT,
  `KODEITEM` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `FILENAME` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `GAMBARUTAMA` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_barangkharisma
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_barangkharisma`;
CREATE TABLE `01_tms_barangkharisma`  (
  `AI` bigint(15) NOT NULL AUTO_INCREMENT,
  `BARANG_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `QRCODE_ID` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BERAT_BARANG` double(15, 2) NOT NULL,
  `PARETO_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SUPPLER_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KATEGORI_ID` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BRAND_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGANBARANG` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `HARGABELI` decimal(15, 2) NOT NULL,
  `HARGAJUAL` decimal(15, 2) NOT NULL,
  `SATUAN` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'pcs',
  `AKTIF` int(11) NOT NULL DEFAULT 1,
  `KODEUNIKMEMBER` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `APAKAHGROSIR` enum('AKTIF','TIDAK AKTIF') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'AKTIF',
  `STOKDAPATMINUS` enum('DAPAT MINUS','TIDAK DAPAT MINUS') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'DAPAT MINUS',
  `JENISBARANG` enum('JASA','BUKAN JASA') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'BUKAN JASA',
  `PEMILIK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `APAKAHBONUS` enum('AKTIF','TIDAK AKTIF') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FILECITRA` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEXCARI`(`BARANG_ID`, `NAMABARANG`, `KODEUNIKMEMBER`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9721 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_barangkharismabestbuy
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_barangkharismabestbuy`;
CREATE TABLE `01_tms_barangkharismabestbuy`  (
  `KATBAR_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ISKATEGORI` enum('True','Self') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Adalah penentu apakah best buy untuk kategori, barang, atau dirinya sendiri\njika Self maka algoritma akan diarahkan ke penambahan beli A(qty) gratis A(qty) + potingan harga jika ada\njika True maka algoritma akan diarahkan ke join 01_tms_besatbuykategori dengan join KATBAR_ID = ID_KATEGORI dari 01_tms_barangkharisma',
  `MINBELI` int(11) NOT NULL DEFAULT 1 COMMENT 'Digunakan untuk memberikan minimal berli saat berapa A(qty) mendapatkan aksi self',
  `KATEGORI_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ADDSELF` int(11) NOT NULL DEFAULT 0 COMMENT 'Untuk menambah jumlah qty yang sama secara gratis jika item tersebut tepenuhi tergantung dari addself\nex: beli 2 gratis 1',
  `MINBELIQTY` int(11) NOT NULL DEFAULT 0 COMMENT 'batas minimal pembelian untuk mendapatkan bonus barang\nex: minimal beli X barang dapat barang di KATEGORI_ID',
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'BLV',
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`KATBAR_ID`) USING BTREE,
  INDEX `INDEX`(`KATBAR_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_barangkharismaserial
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_barangkharismaserial`;
CREATE TABLE `01_tms_barangkharismaserial`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SERIAL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_barangsatuan
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_barangsatuan`;
CREATE TABLE `01_tms_barangsatuan`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `NAMASATUAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`NAMASATUAN`, `KODEUNIKMEMBER`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_bestbuybaranggrosir
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_bestbuybaranggrosir`;
CREATE TABLE `01_tms_bestbuybaranggrosir`  (
  `AI_GROSIR` int(11) NOT NULL AUTO_INCREMENT,
  `BARANG_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JIKABELI` int(11) NOT NULL,
  `HARGABELIGROSIR` double(30, 2) NOT NULL,
  `HARGADASAR` double(30, 2) NOT NULL,
  `SATUAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'BLV',
  PRIMARY KEY (`AI_GROSIR`) USING BTREE,
  INDEX `INDEX`(`BARANG_ID`, `KODEUNIKMEMBER`, `OUTLET`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18422 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_bestbuybarangtambahan
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_bestbuybarangtambahan`;
CREATE TABLE `01_tms_bestbuybarangtambahan`  (
  `AI_TAMBAHAN` int(12) NOT NULL AUTO_INCREMENT,
  `BARANG_ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NAMATAMBAHAN` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `HARGA` double(30, 2) NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`AI_TAMBAHAN`) USING BTREE,
  INDEX `INDEX`(`BARANG_ID`, `NAMATAMBAHAN`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_brand
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_brand`;
CREATE TABLE `01_tms_brand`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `BRAND_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `NAMA_BRAND` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1000001',
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`BRAND_ID`, `NAMA_BRAND`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_diskon
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_diskon`;
CREATE TABLE `01_tms_diskon`  (
  `DISKON_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BARANG_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MINBELITINGKAT1` int(11) NOT NULL,
  `DISCNONMEMBER1` decimal(10, 2) NOT NULL,
  `DISCMEMBER1` decimal(10, 2) NOT NULL,
  `MINBELITINGKAT2` int(11) NOT NULL,
  `DISCNONMEMBER2` decimal(10, 2) NOT NULL,
  `DISCMEMBER2` decimal(10, 2) NOT NULL,
  `KATEGORI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`DISKON_ID`) USING BTREE,
  UNIQUE INDEX `BARANG_ID_UNIQUE`(`BARANG_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_hutangtoko
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_hutangtoko`;
CREATE TABLE `01_tms_hutangtoko`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `NOTRANSAKSI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `SUPPLIER_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JATUHTEMPO` date NOT NULL,
  `KASIR_ID` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOTALKREDIT` decimal(30, 2) NOT NULL,
  `SISAKREDIT` decimal(30, 2) NOT NULL,
  `KODEUNIKMEMBER` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_hutangtoko_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_hutangtoko_detail`;
CREATE TABLE `01_tms_hutangtoko_detail`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `NOTRANSAKSI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `TRANSAKSI_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SUPPLIER_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGALTRS` date NOT NULL,
  `WAKTU` time(0) NOT NULL,
  `PETUGAS` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BAYAR` decimal(30, 2) NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LOKASI` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMOR` int(11) NOT NULL DEFAULT 0,
  `NOTARETURBELI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Bukan Potong Hutang',
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_kategori
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_kategori`;
CREATE TABLE `01_tms_kategori`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `KATEGORIPARENT_ID` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NAMAKATEGORI` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `LOGOKATEGORI` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BEBANGAJI` double(30, 2) NULL DEFAULT NULL,
  `BEBANPACKING` double(30, 2) NULL DEFAULT NULL,
  `BEBANPROMO` double(30, 2) NULL DEFAULT NULL,
  `BEBANTRANSPORT` double(30, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`KATEGORIPARENT_ID`, `NAMAKATEGORI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_member
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_member`;
CREATE TABLE `01_tms_member`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `MEMBER_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ALAMAT` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KOTA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PROVINSI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NEGARA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEPOS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JK` enum('L','P','ALIEN') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `EMAIL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TELEPON` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FAX` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AKHIRAKTIF` date NOT NULL,
  `STATUSAKTIF` int(11) NOT NULL,
  `POINT` int(11) NOT NULL,
  `NOREK` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PEMILIKREK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BANK` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NPWP` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LIMITJUMLAHPIUTANG` double(15, 2) NOT NULL,
  `JENIS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `GRUP` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MINIMALPOIN` double(15, 2) NOT NULL DEFAULT 100000,
  `BATASTAMBAHKREDIT` int(11) NOT NULL DEFAULT 1,
  `KEJARTARGET` double(15, 2) NOT NULL DEFAULT 0,
  `NAMAFILE` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `USERNAME` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PASSWORD` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CATATAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `LIMITBARANGONLINE` int(11) NOT NULL DEFAULT 100,
  `LOGO` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `LIMIT_BRG` int(11) NOT NULL DEFAULT 50,
  `NISBACKUP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NOMOR` int(11) NOT NULL DEFAULT 0,
  `TOTALDEPOSIT` double(30, 2) NOT NULL DEFAULT 0,
  `ISRESELLER` int(2) NOT NULL DEFAULT 0,
  `ANGKAKESUKAAN` int(2) NOT NULL DEFAULT 10,
  `KECAMATAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `PK_MEMBER`(`MEMBER_ID`, `NAMA`, `AKHIRAKTIF`, `JENIS`, `GRUP`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_member_grup
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_member_grup`;
CREATE TABLE `01_tms_member_grup`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `KODEGRUP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JENIS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `GRUP` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`KODEGRUP`, `JENIS`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_memberdeposit
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_memberdeposit`;
CREATE TABLE `01_tms_memberdeposit`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `MEMBER_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMINAL` double(15, 2) NOT NULL,
  `TANGGALTRANSAKSI` bigint(20) NOT NULL,
  `BUKTI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JENIS` enum('MASUK','KELUAR') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AKUN_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `UNTUK` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 86 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_memberpoin
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_memberpoin`;
CREATE TABLE `01_tms_memberpoin`  (
  `PK_IDPOIN` int(11) NOT NULL AUTO_INCREMENT,
  `KODEMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `POINT_SEBELUM` int(11) NOT NULL,
  `POINT_SESUDAH` int(11) NOT NULL,
  `TANGGAL` bigint(15) NOT NULL,
  `KETERANGAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PETUGAS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`PK_IDPOIN`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_nota
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_nota`;
CREATE TABLE `01_tms_nota`  (
  `NOTA_AI` int(11) NOT NULL AUTO_INCREMENT,
  `NOTAYANGADA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`NOTA_AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_pembayaranbank
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_pembayaranbank`;
CREATE TABLE `01_tms_pembayaranbank`  (
  `BANK_ID` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABANK` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PAJAKDEBIT` decimal(15, 2) NOT NULL,
  `PAJAKKREDIT` decimal(15, 2) NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `URLLOGO` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `JENISNONTUNAI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`BANK_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_penggunaaplikasi
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_penggunaaplikasi`;
CREATE TABLE `01_tms_penggunaaplikasi`  (
  `AI_PENGGUNA` int(12) NOT NULL AUTO_INCREMENT,
  `PENGGUNA_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAOUTLET` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAPENGGUNA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PASSWORD` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `URLFOTO` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HAKAKSESID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ALAMAT` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTELP` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOREKENING` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOTALDEPOSIT` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IDHAKAKSES` int(12) NOT NULL DEFAULT 1,
  `PIN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `LATLONG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `EMAIL` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOKENKEY` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STATUSAKTIF` int(3) NOT NULL DEFAULT 0,
  `NOMOR` int(12) NOT NULL DEFAULT 0,
  PRIMARY KEY (`AI_PENGGUNA`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_penggunaaplikasiha
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_penggunaaplikasiha`;
CREATE TABLE `01_tms_penggunaaplikasiha`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAHAKAKSES` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JSONMENU` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_perusahaan`;
CREATE TABLE `01_tms_perusahaan`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `KODEPERUSAHAAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAPERUSAHAAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAPEMILIK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NPWP` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ALAMAT` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `NOTELEPON` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DBAKUNTANSI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_piutangkredit
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_piutangkredit`;
CREATE TABLE `01_tms_piutangkredit`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `TRANSAKSI_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMOR` int(11) NOT NULL DEFAULT 1,
  `MEMBER_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JATUHTEMPO` date NOT NULL,
  `KASIR_ID` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOTALKREDIT` decimal(30, 2) NOT NULL,
  `SISAKREDIT` decimal(30, 2) NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 82 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_piutangkredit_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_piutangkredit_detail`;
CREATE TABLE `01_tms_piutangkredit_detail`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `NOTRANSAKSI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `TRANSAKSI_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGALBAYAR` date NOT NULL,
  `WAKTU` time(0) NOT NULL,
  `KASIR_ID` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BAYAR` decimal(30, 2) NOT NULL,
  `POTONGAN` decimal(30, 2) NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTARETUR` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMOR` int(12) NOT NULL,
  `LOKASI` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_prekeluar
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_prekeluar`;
CREATE TABLE `01_tms_prekeluar`  (
  `NOTAPENDING_ID` int(11) NOT NULL COMMENT 'dijoinkan dengan tabel 01_tmp_notapending',
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PELANGGANNONMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SALES_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KOMISI` decimal(15, 2) NOT NULL,
  `KONSINYASI` enum('TRUE','FALSE') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'FALSE',
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`NOTAPENDING_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_preorder
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_preorder`;
CREATE TABLE `01_tms_preorder`  (
  `PREORDER_AI` int(11) NOT NULL AUTO_INCREMENT,
  `NOTRANSAKSI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGAL` bigint(20) NOT NULL,
  `SUPPLIER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CABANG` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGANBARANG` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HARGAPESAN` decimal(15, 2) NOT NULL,
  `JUMLAHPESANAN` int(11) NOT NULL,
  `DP` decimal(15, 2) NOT NULL,
  `KEKURANGAN` decimal(15, 2) NOT NULL,
  `NOMOR` int(11) NOT NULL,
  `KONSINYASI` enum('True','False') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'False',
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`PREORDER_AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_principal
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_principal`;
CREATE TABLE `01_tms_principal`  (
  `AI` int(255) NOT NULL AUTO_INCREMENT,
  `PRINCIPAL_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `NAMA_PRINCIPAL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1000001',
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`PRINCIPAL_ID`, `NAMA_PRINCIPAL`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_rekening
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_rekening`;
CREATE TABLE `01_tms_rekening`  (
  `REKENING_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAREKENING` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KELOMPOKAKUN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KELOMPOKLAPORAN` enum('NERACA','LABA RUGI') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`REKENING_ID`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_resto_daftarmeja
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_resto_daftarmeja`;
CREATE TABLE `01_tms_resto_daftarmeja`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `KODEMEJA` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NAMAMEJA` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `GAMBAR` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KETERANGAN` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `LANTAI` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `JAMBUKA` time(0) NOT NULL,
  `JAMTUTUP` time(0) NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_resto_pesanmeja
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_resto_pesanmeja`;
CREATE TABLE `01_tms_resto_pesanmeja`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `KODEPESAN` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEMENUPESANAN` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEMEJA` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PEMESAN` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NOTELEPON` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UNTUKBERAPAORANG` int(12) NOT NULL,
  `TOTALBELANJA` double(30, 2) NOT NULL,
  `DP` double(30, 2) NOT NULL,
  `TANGGAL` date NOT NULL,
  `WAKTU` time(0) NOT NULL,
  `TANGGALAKHIR` date NOT NULL,
  `WAKTUAKHIR` time(0) NOT NULL,
  `NOMOR` int(12) NOT NULL,
  `WARNAMEMO` char(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `STATUSPESAN` int(12) NOT NULL DEFAULT 1,
  `TANGGALPROSES` date NOT NULL,
  `WAKTUPROSES` time(0) NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_sales
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_sales`;
CREATE TABLE `01_tms_sales`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `KODESALES` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ALAMAT` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KOTA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PROVINSI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NEGARA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEPOS` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TELEPON` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FAX` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `EMAIL` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOREK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PEMILIKREK` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BANK` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`KODESALES`, `NAMA`, `KODEUNIKMEMBER`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_stok
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_stok`;
CREATE TABLE `01_tms_stok`  (
  `DISPLAY_AI` int(11) NOT NULL AUTO_INCREMENT,
  `BARANG_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DISPLAY` double(200, 2) NOT NULL,
  `GUDANG` double(200, 2) NOT NULL,
  `RETUR` double(200, 2) NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`DISPLAY_AI`) USING BTREE,
  INDEX `INDEX`(`BARANG_ID`, `KODEUNIKMEMBER`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1843190 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_supplier
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_supplier`;
CREATE TABLE `01_tms_supplier`  (
  `SUPPLIER_AI` int(11) NOT NULL AUTO_INCREMENT,
  `KODESUPPLIER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMASUPPLIER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NEGARA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PROVINSI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KOTAKAB` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KECAMATAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ALAMAT` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTELP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABANK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOREK` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ATASNAMA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `EMAIL` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`SUPPLIER_AI`) USING BTREE,
  INDEX `INDEX`(`KODESUPPLIER`, `NAMASUPPLIER`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 313 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_voucher
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_voucher`;
CREATE TABLE `01_tms_voucher`  (
  `VOUCHER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAMAVOUCHER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AWALAKTIF` date NOT NULL,
  `AKHIRAKTIF` date NOT NULL,
  `TIPEVOUCHER` enum('PERSEN','NOMINAL') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMINALRUPIAH` decimal(15, 2) NOT NULL,
  `NOMINALDISKON` decimal(4, 2) NOT NULL,
  `BATASTRANSAKSI` int(11) NOT NULL,
  `MINIMALPEMBELIAN` int(11) NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`VOUCHER_ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_tms_voucherbarang
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_voucherbarang`;
CREATE TABLE `01_tms_voucherbarang`  (
  `VOUCHER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BARANGID` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMAVOUCHER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AWALAKTIF` int(11) NOT NULL,
  `AKHIRAKTIF` int(11) NOT NULL,
  `TIPEVOUCHER` enum('DISKON','NOMINAL') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMINALRUPIAH` decimal(15, 2) NOT NULL,
  `NOMINALDISKON` decimal(4, 2) NOT NULL,
  `BATASTRANSAKSI` int(11) NOT NULL,
  `MINIMALPEMBELIAN` int(11) NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`VOUCHER_ID`) USING BTREE,
  UNIQUE INDEX `NAMAVOUCHER_UNIQUE`(`NAMAVOUCHER`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangkeluar
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangkeluar`;
CREATE TABLE `01_trs_barangkeluar`  (
  `AI_TRANSAKSIKELUAR` int(11) NOT NULL AUTO_INCREMENT,
  `PK_NOTAPENJUALAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FK_MEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FK_SALESMAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ENUM_JENISTRANSAKSI` enum('TUNAI','KREDIT','KARTU','SPLITCASH') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JATUHTEMPO` int(12) NOT NULL,
  `LOKASI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TGLKELUAR` datetime(0) NOT NULL,
  `WAKTU` time(0) NOT NULL,
  `KASIR` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMORNOTA` int(11) NOT NULL DEFAULT 0,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMINALTUNAI` double(30, 2) NOT NULL,
  `NOMINALKREDIT` double(30, 2) NOT NULL,
  `NOMINALKARTUDEBIT` double(30, 2) NOT NULL,
  `NOMORKARTUDEBIT` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BANKDEBIT` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMINALKARTUKREDIT` double(30, 2) NOT NULL,
  `NOMORKARTUKREDIT` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BANKKREDIT` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMINALEMONEY` double(30, 2) NOT NULL,
  `NAMAEMONEY` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMINALPOTONGAN` double(30, 2) NOT NULL,
  `NOMINALPAJAKKELUAR` double(30, 2) NOT NULL,
  `KEMBALIAN` double(30, 2) NOT NULL,
  `TOTALBELANJA` double(30, 2) NOT NULL,
  `PAJAKTOKO` double(30, 2) NOT NULL,
  `PAJAKNEGARA` double(30, 2) NOT NULL,
  `POTONGANGLOBAL` double(30, 2) NOT NULL,
  `TIPETRANSAKSI` int(12) NOT NULL,
  PRIMARY KEY (`AI_TRANSAKSIKELUAR`) USING BTREE,
  INDEX `PK_NOTAPENJUALAN_2`(`PK_NOTAPENJUALAN`) USING BTREE,
  INDEX `FK_MEMBER`(`FK_MEMBER`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 87 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangkeluar_beban
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangkeluar_beban`;
CREATE TABLE `01_trs_barangkeluar_beban`  (
  `AI_TRANSAKSIKELUAR` int(11) NOT NULL AUTO_INCREMENT,
  `PK_NOTAPENJUALAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FK_BARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BEBANGAJI` double(15, 0) NOT NULL,
  `BEBANPACKING` double(15, 2) NOT NULL,
  `BEBANPROMO` double(15, 2) NOT NULL,
  `BEBANTRANSPOT` double(15, 0) NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`AI_TRANSAKSIKELUAR`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 371 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangkeluar_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangkeluar_detail`;
CREATE TABLE `01_trs_barangkeluar_detail`  (
  `AI_TRANSAKSIKELUAR` int(12) NOT NULL AUTO_INCREMENT,
  `PK_NOTAPENJUALAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FK_BARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HARGAJUAL` double(30, 2) NOT NULL,
  `HARGABELI` double(30, 2) NOT NULL,
  `STOKBARANGKELUAR` double(15, 2) NOT NULL,
  `DARIPERUSAHAAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `PPN` double(30, 2) NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `BRAND_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PRINCIPAL_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `STOKDAPATMINUS` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `JSONTAMBAHAN` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `CATATANPERBARANG` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `APAKAHVARIAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `HARGAJUALSEMENTARA` double(30, 2) NOT NULL DEFAULT 0,
  `STATUSBARANGPROSES` int(5) NOT NULL DEFAULT 0,
  `TANGGALPROSES` date NOT NULL,
  `WAKTUPROSES` time(0) NOT NULL,
  PRIMARY KEY (`AI_TRANSAKSIKELUAR`) USING BTREE,
  INDEX `INDEXCARI`(`PK_NOTAPENJUALAN`, `FK_BARANG`, `NAMABARANG`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 393 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangkeluar_dp
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangkeluar_dp`;
CREATE TABLE `01_trs_barangkeluar_dp`  (
  `AI` int(13) NOT NULL AUTO_INCREMENT,
  `PK_NOTRANSAKSI` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TUNAI` double(30, 2) NOT NULL,
  `DEBIT` double(30, 2) NOT NULL,
  `KREDIT` double(30, 2) NOT NULL,
  `EMONEY` double(30, 2) NOT NULL,
  `TGLTRANSAKSI` datetime(0) NOT NULL,
  `IDKASIR` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangkeluarnota
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangkeluarnota`;
CREATE TABLE `01_trs_barangkeluarnota`  (
  `AI` int(11) NOT NULL,
  `NOTAPEMBELIAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `NOTAPENJUALAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `QTYKELUAR` double(10, 2) NOT NULL DEFAULT 0,
  `DELETE` int(11) NOT NULL AUTO_INCREMENT,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HPP` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`DELETE`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangkeluarsaldoawal
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangkeluarsaldoawal`;
CREATE TABLE `01_trs_barangkeluarsaldoawal`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `TANGGAL` date NOT NULL,
  `NOMINAL` double(15, 2) NOT NULL,
  `USERNAME` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangmasuk
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangmasuk`;
CREATE TABLE `01_trs_barangmasuk`  (
  `PK_BARANGMASUK` int(15) NOT NULL AUTO_INCREMENT,
  `NOTA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `FK_SUPPLIER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGALTRS` datetime(0) NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOP` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMATOP` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JATUHTEMPO` datetime(0) NOT NULL,
  `PETUGAS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOTALPEMBELIAN` decimal(30, 2) NOT NULL,
  `TOTALPEMBELIANBEBAN` decimal(30, 2) NOT NULL,
  `TOTALHUTANG` decimal(30, 2) NOT NULL,
  `TOTALPPNMASUKAN` decimal(30, 2) NOT NULL,
  `BIAYALAINLAIN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DARISUBPERUSAHAAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NON',
  `NOMOR` int(12) NOT NULL,
  PRIMARY KEY (`PK_BARANGMASUK`) USING BTREE,
  INDEX `NOTA`(`TANGGALTRS`, `PK_BARANGMASUK`, `NOTA`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'bentar mas ada pembeli' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangmasuk_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangmasuk_detail`;
CREATE TABLE `01_trs_barangmasuk_detail`  (
  `PK_BARANGMASUK` int(11) NOT NULL AUTO_INCREMENT,
  `NOTA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `HARGABELI` decimal(30, 2) NOT NULL DEFAULT 0,
  `JUMLAHBELI` decimal(30, 2) NOT NULL,
  `DISPLAY` decimal(30, 2) NOT NULL,
  `GUDANG` decimal(30, 2) NOT NULL,
  `EXP` date NOT NULL,
  `DISKON1` decimal(30, 2) NOT NULL,
  `DISKON2` decimal(30, 2) NOT NULL,
  `PPN` decimal(30, 2) NOT NULL,
  `AFTERDISKON1` decimal(30, 2) NOT NULL,
  `AFTERDISKON2` decimal(30, 2) NOT NULL,
  `HPP` decimal(30, 2) NOT NULL,
  `BEBANGAJI` decimal(30, 2) NOT NULL DEFAULT 0,
  `BEBANPROMO` decimal(30, 2) NOT NULL,
  `BEBANPACKING` decimal(30, 2) NOT NULL,
  `BEBANTRANSPORT` decimal(30, 2) NOT NULL DEFAULT 0,
  `HPPBEBAN` decimal(30, 2) NOT NULL DEFAULT 0,
  `OUTLET` varbinary(11) NOT NULL DEFAULT 1,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `DARISUBPERUSAHAAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NON',
  `NAMABARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`PK_BARANGMASUK`) USING BTREE,
  INDEX `INDEX`(`NOTA`, `KODEBARANG`, `NAMABARANG`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 154 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'bentar mas ada pembeli' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangmasukpre
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangmasukpre`;
CREATE TABLE `01_trs_barangmasukpre`  (
  `PK_BARANGMASUK` int(11) NOT NULL AUTO_INCREMENT,
  `NOTA` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGALTRS` bigint(20) NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOP` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CARABAYAR` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PETUGAS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JATUHTEMPO` bigint(20) NOT NULL,
  `HARGAJUALBARU` decimal(15, 2) NOT NULL DEFAULT 0,
  `HARGABELI` decimal(15, 2) NOT NULL DEFAULT 0,
  `JUMLAHBELI` int(11) NOT NULL,
  `DISPLAY` int(11) NOT NULL,
  `ONLINE` int(11) NOT NULL,
  `PROMO` int(11) NOT NULL,
  `GUDANG` int(11) NOT NULL,
  `EXP` bigint(20) NOT NULL,
  `DISKON1` decimal(15, 2) NOT NULL,
  `RP1` decimal(15, 2) NOT NULL,
  `DISKON2` decimal(15, 2) NOT NULL,
  `RP2` decimal(15, 2) NOT NULL,
  `DISKON3` decimal(15, 2) NOT NULL,
  `RP3` decimal(15, 2) NOT NULL,
  `PPN` int(11) NOT NULL,
  `AFTERDISKON1` decimal(15, 2) NOT NULL,
  `ARP1` decimal(15, 2) NOT NULL,
  `AFTERDISKON2` decimal(15, 2) NOT NULL,
  `ARP2` decimal(15, 2) NOT NULL,
  `HARGANETT` decimal(15, 2) NOT NULL,
  `FK_SUPPLIER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMORNOTA` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STATUSLUNAS` enum('TRUE','FALSE') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TRUE',
  `BIAYALAIN` decimal(15, 0) NOT NULL DEFAULT 0,
  `BARANGADA` enum('true','false') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'true' COMMENT 'True = BARANG TIDAK DATANG\nFalse = BARANG DATANG',
  `TOTALTERSEDIA` int(11) NOT NULL DEFAULT 0,
  `HARGARATASEBELUM` double(15, 2) NOT NULL DEFAULT 0,
  `DP` double(15, 2) NOT NULL DEFAULT 0,
  `TOPKREDIT` double(15, 2) NOT NULL DEFAULT 0,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ISINSERT` int(11) NOT NULL DEFAULT 1,
  `TERMUTASI` int(11) NOT NULL DEFAULT 1,
  `WARNING` int(11) NOT NULL DEFAULT 0,
  `EDBARANG` int(11) NOT NULL DEFAULT 0,
  `DARISUBPERUSAHAAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NON',
  PRIMARY KEY (`PK_BARANGMASUK`) USING BTREE,
  INDEX `NOTA`(`TANGGALTRS`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_barangmasukqty
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_barangmasukqty`;
CREATE TABLE `01_trs_barangmasukqty`  (
  `QTY` int(11) NOT NULL,
  `NOTAPEMBELIAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_kartulog_suplier
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_kartulog_suplier`;
CREATE TABLE `01_trs_kartulog_suplier`  (
  `KARTUSUP_AI` int(12) NOT NULL AUTO_INCREMENT,
  `KODESUPPLIER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NOTRANSAKSI` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TGLTRANSAKSI` datetime(0) NOT NULL,
  `PROSESAPA` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KETERANGAN` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`KARTUSUP_AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_kartustok
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_kartustok`;
CREATE TABLE `01_trs_kartustok`  (
  `KARTUSTOK_AI` int(11) NOT NULL AUTO_INCREMENT,
  `NOTRANSAKSI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `BARANG_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGALTRANSAKSI` datetime(0) NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `TIPE` enum('TRSKSR','TRSKSRB','TRSPMB','OPM','MTS','RTRPJ','RTPB','SAWAL','PECAHSATUAN') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'TRSKSR = kode untuk transaksi normal pada umumnya\nTRSKSRB = kode untuk transaksi barang bonus\nTRSPMB = kode untuk transaksi pembelian barang\nOPM = kode untuk transaksi opname barang\nMTS = kode untuk transaksi mutasi status barang\nRTRPJ = kode untuk transaksi retur penjualan\nRTPB = kode untuk transaksi retur pembelian\nSAWAL = kode untuk transaksi saldo awal informasi barang',
  `KASIR_ID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `MASUK` double(30, 2) NOT NULL DEFAULT 0,
  `MUTASI` double(30, 2) NOT NULL,
  `OPNAME` double(30, 2) NOT NULL DEFAULT 0,
  `KELUAR` double(30, 2) NOT NULL DEFAULT 0,
  `SALDO` double(30, 2) NOT NULL DEFAULT 0,
  `SALDOSEMUA` double(30, 2) NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`KARTUSTOK_AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2408 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_mutasibarang
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_mutasibarang`;
CREATE TABLE `01_trs_mutasibarang`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `NOMORMUTASI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PETUGAS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGALTRS` date NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMOR` int(11) NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_mutasibarang_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_mutasibarang_detail`;
CREATE TABLE `01_trs_mutasibarang_detail`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `NOMORMUTASI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABARANG` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `UNIT` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `STOKAWAL` double(30, 2) NOT NULL,
  `STOKMUTASI` double(30, 2) NOT NULL,
  `NOMINAL` double(30, 2) NOT NULL,
  `ASALOUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TUJUANOUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ASALLOKASIITEM` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TUJUANLOKASIITEM` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'NON',
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_opname
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_opname`;
CREATE TABLE `01_trs_opname`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `NOTAOPNAME` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOTALBARANG` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOTALSURPLUS` double(15, 2) NOT NULL,
  `TOTALMINUS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TOTALOPANAME` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOMOR` int(11) NOT NULL,
  `KETERANGAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PETUGAS` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TANGGALTRS` date NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_opname_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_opname_detail`;
CREATE TABLE `01_trs_opname_detail`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `NOTAOPNAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `NAMABARANG` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `LOKASIOPNAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `STOKKOMPUTER` double(30, 2) NOT NULL,
  `STOKOPNAME` double(30, 2) NOT NULL,
  `KONDISIOPNAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `HPP` decimal(30, 2) NOT NULL,
  `INFORMASI` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_returpembelian
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_returpembelian`;
CREATE TABLE `01_trs_returpembelian`  (
  `AI` int(11) NOT NULL AUTO_INCREMENT,
  `NOTRXRETURBELI` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PETUGAS` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `SUPPLIERID` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGALTRS` datetime(0) NOT NULL,
  `NOMOR` int(12) NOT NULL,
  `TOTALBARANG` decimal(30, 2) NOT NULL,
  `TOTALNOMINAL` decimal(30, 2) NOT NULL,
  `TOTALPOTONGAN` decimal(30, 2) NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`NOTRXRETURBELI`, `SUPPLIERID`, `TANGGALTRS`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_returpembelian_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_returpembelian_detail`;
CREATE TABLE `01_trs_returpembelian_detail`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `NOTRXRETURBELI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTRXPEMBELIAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JUMLAHBELI` decimal(30, 2) NOT NULL,
  `JUMLAHRETUR` decimal(30, 2) NOT NULL,
  `HARGABELI` decimal(30, 2) NOT NULL,
  `POTONGAN` decimal(30, 2) NOT NULL,
  `PPN` decimal(30, 2) NOT NULL,
  `ASALOUTLET` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ASALLOKASI` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JENISTRX` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`NOTRXRETURBELI`, `NOTRXPEMBELIAN`, `KODEBARANG`, `NAMABARANG`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_returpenjualan
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_returpenjualan`;
CREATE TABLE `01_trs_returpenjualan`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `NOTRXRETUR` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `PETUGAS` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `IDPELANGGAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TANGGALRETUR` date NOT NULL,
  `NOMORNOTA` int(12) NOT NULL,
  `TOTALBARANG` decimal(30, 2) NOT NULL,
  `TOTALRETUR` decimal(30, 2) NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`NOTRXRETUR`, `PETUGAS`, `IDPELANGGAN`, `NOMORNOTA`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_returpenjualan_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_returpenjualan_detail`;
CREATE TABLE `01_trs_returpenjualan_detail`  (
  `AI` int(12) NOT NULL AUTO_INCREMENT,
  `NOTRXRETUR` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTRXPENJUALAN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABARANG` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JUMLAHBELI` double(30, 2) NOT NULL,
  `JUMLAHRETUR` double(30, 2) NOT NULL,
  `HARGABELI` decimal(30, 2) NOT NULL,
  `HARGAJUAL` decimal(30, 2) NOT NULL,
  `PPN` decimal(30, 2) NOT NULL,
  `TUJUANOUTLET` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `TUJUANLOKASISSTOK` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGAN` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `JENISTRX` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'TUNAI',
  `KODEUNIKMEMBER` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE,
  INDEX `INDEX`(`NOTRXRETUR`, `NOTRXPENJUALAN`, `KODEBARANG`, `NAMABARANG`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 85 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Function structure for BIGINTTODATETIME
-- ----------------------------
DROP FUNCTION IF EXISTS `BIGINTTODATETIME`;
delimiter ;;
CREATE FUNCTION `BIGINTTODATETIME`(`TIMESTAMPNYA` BIGINT(20))
 RETURNS varchar(100) CHARSET latin1
BEGIN
	RETURN (SELECT TIMESTAMPADD(second,TIMESTAMPNYA, CAST('1970-01-01' AS DATETIME)));
END
;;
delimiter ;

-- ----------------------------
-- Function structure for BIGINTTODATETIMENOW
-- ----------------------------
DROP FUNCTION IF EXISTS `BIGINTTODATETIMENOW`;
delimiter ;;
CREATE FUNCTION `BIGINTTODATETIMENOW`()
 RETURNS varchar(100) CHARSET latin1
BEGIN
    RETURN (UNIX_TIMESTAMP(CONVERT_TZ(NOW(), '+00:00', 'SYSTEM')));
END
;;
delimiter ;

-- ----------------------------
-- Function structure for PEMBULATANANGKA
-- ----------------------------
DROP FUNCTION IF EXISTS `PEMBULATANANGKA`;
delimiter ;;
CREATE FUNCTION `PEMBULATANANGKA`(`HARGAJUAL` BIGINT(20))
 RETURNS int(11)
BEGIN
	DECLARE TOTALHARGA BIGINT(20);
	SET TOTALHARGA = CEIL(HARGAJUAL);
	IF SUBSTR(TOTALHARGA,-3,2) > 0 AND SUBSTR(TOTALHARGA,-3,2) < 100 THEN
		SET TOTALHARGA =CEIL(`HARGAJUAL`/ 100) * 100;
	END IF; 
    RETURN TOTALHARGA;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for proc_Controller_Admin
-- ----------------------------
DROP PROCEDURE IF EXISTS `proc_Controller_Admin`;
delimiter ;;
CREATE PROCEDURE `proc_Controller_Admin`(IN `kondisi` INT, IN `dimana1` VARCHAR(255), IN `dimana2` VARCHAR(255), IN `dimana3` VARCHAR(255), IN `dimana4` VARCHAR(255), IN `dimana5` VARCHAR(255), IN `dimana6` VARCHAR(255), IN `dimana7` VARCHAR(255), IN `dimana8` VARCHAR(255), IN `dimana9` VARCHAR(255), IN `dimana10` VARCHAR(255), IN `datake` INT, IN `ditampilkan` INT)
BEGIN

DECLARE KELUARSTOK, DATAKEAI, OLDSTOKKARTU, GUDANGADA, HASILSTOK, SISASTOKTAMBAH, ADABARANG,BANYAKDATA,totalpembelian,sDISPLAY, sDISPLAYTERBATAS, sGUDANG, sONLINE, sRETUR, sBonusBarang, sBonusKategori,sBarangRakitan,RETURHASIL, RETURVARLAWAS INT(11);
DECLARE DEBITNYA,KREDITNYA,TOTALTRANSAKSI,JUMLAHTRANSAKSI DOUBLE(15,2);
DECLARE STRING1,STRING2 VARCHAR(100);
IF kondisi = -1 THEN
	IF dimana1 = "UI" THEN
		SELECT COUNT(*) as ADAKUNCI FROM 01_set_app_dongle WHERE `FD_ID` = dimana2 LIMIT 1;
    ELSE
		SELECT COUNT(*) as ADAID FROM 01_set_app_dongle WHERE `FD_ID` = dimana2 AND `PIN_ID` = dimana3 LIMIT 1;
    END IF;
ELSEIF kondisi = 0 THEN
	IF dimana1 = 0 THEN
		SELECT * FROM 01_tms_barangkharisma as A 
		JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID 
		JOIN 01_tms_kategori as C ON A.KATEGORI_ID = C.KATEGORIPARENT_ID
		JOIN 01_tms_principal as D ON A.PARETO_ID = D.PRINCIPAL_ID
		JOIN 01_tms_brand as E ON A.BRAND_ID = E.BRAND_ID
		JOIN 01_tms_supplier as F ON A.SUPPLER_ID = F.KODESUPPLIER
		WHERE B.OUTLET = dimana6 AND A.KODEUNIKMEMBER = dimana10 AND B.KODEUNIKMEMBER = dimana10 AND F.KODEUNIKMEMBER = dimana10 AND E.KODEUNIKMEMBER = dimana10 AND D.KODEUNIKMEMBER = dimana10 AND C.KODEUNIKMEMBER = dimana10 AND A.`BARANG_ID` != "ACI100000100000001" AND 
      CASE
			WHEN dimana8 = '0' THEN A.`AKTIF` = 0
            WHEN dimana8 = '1' THEN A.`AKTIF` = 1
            WHEN dimana8 = '2' THEN A.`AKTIF` >= 0
      END AND
      CASE 
						WHEN dimana3 = 'Kode Item' THEN A.`BARANG_ID` LIKE CONCAT('%',dimana2,'%')
            WHEN dimana3 = 'Nama Item' THEN `NAMABARANG` LIKE CONCAT('%',dimana2,'%')
            WHEN dimana3 = 'Kategori Item' THEN `NAMAKATEGORI` LIKE CONCAT('%',dimana2,'%')
            WHEN dimana3 = 'Principal' THEN `NAMA_PRINCIPAL` LIKE CONCAT('%',dimana2,'%')
            WHEN dimana3 = 'Brand' THEN `NAMA_BRAND` LIKE CONCAT('%',dimana2,'%')
						WHEN dimana3 = 'kombinasi' THEN (A.`BARANG_ID` LIKE CONCAT('%',dimana2,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana2,'%'))
       END AND
			 CASE
						WHEN dimana4 = 's' THEN 1 = 1
						WHEN dimana4 = 'r' THEN B.`RETUR` > 0
						ELSE 1 = 1
			 END
		LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 1 THEN
		SELECT SUM(`DISPLAY`) INTO sDISPLAY FROM 01_bnt_display WHERE `KODEBARANG` = dimana2 AND `OUTLET` = dimana3 AND `KODEUNIKMEMBER` = dimana4;
		SELECT SUM(`GUDANG`) INTO sGUDANG FROM 01_bnt_gudang WHERE `BARANG_ID` = dimana2 AND `OUTLET` = dimana3 AND `KODEUNIKMEMBER` = dimana4;
		SELECT SUM(`ONLINE`) INTO sONLINE FROM 01_bnt_online WHERE `KODEBARANG` = dimana2 AND `KODEUNIKMEMBER` = dimana4;
		SELECT SUM(`RETUR`) INTO sRETUR FROM 01_bnt_retur WHERE `KODEBARANG` = dimana2 AND `OUTLET` = dimana3 AND `KODEUNIKMEMBER` = dimana4;
		SELECT SUM(`QTYPROMO`) INTO sBonusBarang FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'BARANG' AND `OUTLET` = dimana3 AND `KODEUNIKMEMBER` = dimana4;
		SELECT SUM(`QTYPROMO`) INTO sBonusKategori FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'KATEGORI' AND `OUTLET` = dimana3 AND `KODEUNIKMEMBER` = dimana4;
		SELECT SUM(`QTYPROMO`) INTO sBarangRakitan FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'RAKITAN' AND `OUTLET` = dimana3 AND `KODEUNIKMEMBER` = dimana4;
		SELECT IFNULL(sDISPLAY,0) as sDISPLAY,IFNULL(sGUDANG,0) as sGUDANG,IFNULL(sONLINE,0) as sONLINE,IFNULL(sRETUR,0) as sRETUR,IFNULL(sBonusBarang,0) as sBonusBarang ,IFNULL(sBonusKategori,0) as sBonusKategori,IFNULL(sBarangRakitan,0) as sBarangRakitan;
	ELSEIF dimana1 = 2 THEN
		SELECT 
		CASE
			WHEN dimana3 = 'Kode Item' THEN A.`BARANG_ID` LIKE CONCAT('%',dimana2,'%')
            WHEN dimana3 = 'Nama Item' THEN `NAMABARANG` LIKE CONCAT('%',dimana2,'%')
            WHEN dimana3 = 'Kategori Item' THEN `NAMAKATEGORI` LIKE CONCAT('%',dimana2,'%')
            WHEN dimana3 = 'Pareto' THEN `NAMA_PARETO` LIKE CONCAT('%',dimana2,'%')
            WHEN dimana3 = 'Brand' THEN `NAMA_BRAND` LIKE CONCAT('%',dimana2,'%')
		END as HAVINGKOLOM,
		Z.`BARANG_ID`,`NAMABARANG`,`NAMASUPPLIER`,`NAMAKATEGORI`,`HARGAJUAL`,`HARGABELI`,`HARGARATA`,`HARGANETTTERAKHIR`,`EXP_ENUM`, `NAMAFILE`,`BESTBUY`,`SATUAN`,`NAMASATUAN`,`STOKMINIMUM`,`AKTIF`,
		`STOKTANPAOUTLET` as TOTAL FROM 01_tms_barangkharisma as Z 
		JOIN 01_tms_supplier as B ON Z.`SUPPLER_ID` = B.`KODESUPPLIER` 
		JOIN 01_tms_kategori as C ON Z.`KATEGORI_ID` = C.`KATEGORIPARENT_ID` 
		JOIN 01_tms_barangsatuan as D ON Z.`SATUAN` = D.`NAMASATUAN`
		HAVING TOTAL < dimana9 AND HAVINGKOLOM LIKE CONCAT('%',dimana2,'%') ORDER BY
		CASE WHEN dimana4 = 'ASCNAMABARANG' THEN `NAMABARANG` END ASC ,
		CASE WHEN dimana4 = 'DESCNAMABARANG' THEN `NAMABARANG` END DESC
		LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 3 THEN
		SELECT A.BARANG_ID as BARANGLAMA, A.NAMABARANG as NAMALAMA, A.LINKSTUFF, B.NAMABARANG FROM 01_tms_barangkharisma as A JOIN 01_tms_barangkharisma as B ON A.BARANG_ID = B.LINKSTUFF WHERE A.`NAMABARANG` LIKE CONCAT('%',dimana2,'%') OR B.`NAMABARANG` LIKE CONCAT('%',dimana2,'%') LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 4 THEN
		SELECT COUNT(*) AS TOTALBARANGAKTIF FROM 01_tms_barangkharisma WHERE `AKTIF` = 1;
	ELSEIF dimana1 = 5 THEN
		UPDATE 01_tms_barangkharisma SET `AKTIF` = dimana2 WHERE `BARANG_ID` = dimana3;
	ELSEIF dimana1 = 6 THEN
		SELECT `KATBAR_ID`, SUM(`QTYBONUS`) as TOTALBARANGNYA, COUNT(*) as TOTALBARANG, `UNTUK` FROM 01_tms_bestbuykategori WHERE 
		CASE
		WHEN dimana4 = '1' THEN `KATBAR_ID` LIKE CONCAT('%',dimana2,'%') 
		WHEN dimana4 = '2' THEN `KATBAR_ID` LIKE CONCAT('%',dimana2,'%') AND `UNTUK` = dimana5
		END
		GROUP BY `KATBAR_ID` ORDER BY
		CASE WHEN dimana3 = 'ASCNAMAKATEGORI' THEN `KATBAR_ID` END ASC ,
		CASE WHEN dimana3 = 'DESCNAMAKATEGORI' THEN `KATBAR_ID` END DESC
		LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 7 THEN
		SELECT B.`BARANG_ID`, B.`NAMABARANG`, A.`QTY`,A.`MINKATEGORI`,A.`QTYBONUS`,`MINIMALHARGA`,`KELIPATAN`,`BATASPERHARI`,A.`UNTUK` FROM 01_tms_bestbuykategori as A JOIN 01_tms_barangkharisma as B ON A.`BARANG_ID` = B.`BARANG_ID` WHERE A.`KATBAR_ID` = dimana2 AND `OUTLET` = dimana3;
	ELSEIF dimana1 = 8 THEN
		IF dimana4 = 1 THEN
			SELECT B.`KATBAR_ID` as `KATEGORI_ID`, `NAMABARANG`, COUNT(A.`KATEGORI_ID`) AS TOTALJENISBARANG, SUM(`QTY`) AS TOTALKELUAR, SUM(`QTYBONUS`) AS TOTALSTOKBONUS FROM 01_tms_bestbuybarang as A JOIN 01_tms_barangkharismabestbuy as B ON A.`KATEGORI_ID` = B.`KATEGORI_ID` JOIN 01_tms_barangkharisma as C ON B.`KATBAR_ID` = C.`BARANG_ID` WHERE `NAMABARANG` LIKE CONCAT('%',dimana2,'%') OR A.`KATEGORI_ID` LIKE CONCAT('%',dimana2,'%')
			GROUP BY A.`KATEGORI_ID` ORDER BY
			CASE WHEN dimana3 = 'ASCBARANG' THEN A.`KATEGORI_ID` END ASC ,
			CASE WHEN dimana3 = 'DESBARANG' THEN A.`KATEGORI_ID` END DESC
			LIMIT datake, ditampilkan;
		ELSEIF dimana4 = 2 THEN
			SELECT C.`BARANG_ID`, C.`NAMABARANG`, `QTY`, `QTYBONUS` FROM 01_tms_bestbuybarang as A JOIN 01_tms_barangkharismabestbuy as B ON A.`KATEGORI_ID` = B.`KATEGORI_ID` JOIN 01_tms_barangkharisma as C ON A.`BARANG_ID` = C.`BARANG_ID` WHERE A.`KATEGORI_ID` LIKE CONCAT('%',dimana2,'%');
		END IF;
	ELSEIF dimana1 = 9 THEN
		SELECT * FROM 01_tms_barangkharisma as A 
		JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID 
		JOIN 01_tms_kategori as C ON A.KATEGORI_ID = C.KATEGORIPARENT_ID
		JOIN 01_tms_principal as D ON A.PARETO_ID = D.PRINCIPAL_ID
		JOIN 01_tms_brand as E ON A.BRAND_ID = E.BRAND_ID
		JOIN 01_tms_supplier as F ON A.SUPPLER_ID = F.KODESUPPLIER
		JOIN 01_tms_perusahaan as G ON A.PEMILIK = G.KODEPERUSAHAAN 
		JOIN 01_tms_barangsatuan as H ON A.SATUAN = H.NAMASATUAN 
		WHERE A.`BARANG_ID` = dimana2 AND B.`OUTLET` = dimana3 AND A.`KODEUNIKMEMBER` = dimana4 LIMIT 1;
	ELSEIF dimana1 = 10 THEN
		SELECT `KATBAR_ID`, `MINBELI`,`ADDSELF`,`MINBELIQTY` FROM 01_tms_barangkharismabestbuy WHERE `KATBAR_ID` = dimana2 LIMIT 1;
	ELSEIF dimana1 = 11 THEN
		SELECT `KODEBARANG`,`NAMABARANG`, `JUMLAH`,A.`SATUAN`,`HARGA`,(`JUMLAH` * `HARGA`) as SUBTOTAL FROM 01_bnt_displaygabung as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` WHERE `KODEBARANGRAKITAN` = dimana2;
	ELSEIF dimana1 = 12 THEN
		SELECT `SATUAN`,`JIKABELI`, `HARGABELIGROSIR` FROM 01_tms_bestbuybaranggrosir WHERE `BARANG_ID` = dimana2;
	ELSEIF dimana1 = 13 THEN
		SELECT `NOTAPEMBELIAN`,`NAMABARANG`,`GUDANG` FROM 01_bnt_gudang as A JOIN 01_tms_barangkharisma as B ON A.`BARANG_ID` = B.`BARANG_ID` WHERE A.`BARANG_ID` = dimana2 AND `NOTAPEMBELIAN` LIKE CONCAT('%',dimana3,'%') LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 14 THEN
		SELECT `NOTAPEMBELIAN`,`NAMABARANG`,`DISPLAY` FROM 01_bnt_display as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` WHERE `KODEBARANG` = dimana2 AND `NOTAPEMBELIAN` LIKE CONCAT('%',dimana3,'%') LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 15 THEN
		SELECT `NOTAPEMBELIAN`,`NAMABARANG`,`ONLINE` FROM 01_bnt_online as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` WHERE `KODEBARANG` = dimana2 AND `NOTAPEMBELIAN` LIKE CONCAT('%',dimana3,'%') LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 16 THEN
		SELECT `NOTAPEMBELIAN`,`NAMABARANG`,`RETUR`,`KETERANGAN` FROM 01_bnt_retur as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` WHERE `KODEBARANG` = dimana2 AND `NOTAPEMBELIAN` LIKE CONCAT('%',dimana3,'%') LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 17 THEN
		SELECT SUM(`QTYPROMO`) INTO sBonusBarang FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'BARANG' GROUP BY `KODEBARANG`;
		SELECT SUM(`QTYPROMO`) INTO sBonusKategori FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'KATEGORI' GROUP BY `KODEBARANG`;
		SELECT SUM(`QTYPROMO`) INTO sBarangRakitan FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'RAKITAN' GROUP BY `KODEBARANG`;
		SELECT `NAMABARANG`, sBonusBarang, sBonusKategori, sBarangRakitan FROM 01_bnt_displaybonus as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID`  WHERE `KODEBARANG` = dimana2 GROUP BY `KODEBARANG` LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 18 THEN
		SELECT COUNT(*), `NAMABARANG` INTO KELUARSTOK, STRING1 FROM `01_tms_barangkharisma` WHERE `KODEAKUN` = 'GDPST' AND `KODEUNIKMEMBER` = dimana4 AND `BARANG_ID` = dimana2 LIMIT 1;
        SELECT COUNT(*) as TOTALBARANG, KELUARSTOK, STRING1 FROM `01_tms_barangkharisma` WHERE `BARANG_ID` = dimana2 AND `KODEAKUN` = dimana3 AND `KODEUNIKMEMBER` = dimana4 LIMIT 1;
	ELSEIF dimana1 = 19 THEN
		SELECT COUNT(*) INTO KELUARSTOK FROM 01_tms_barangkharisma WHERE `KODEUNIKMEMBER` = dimana4 AND `KODEAKUN` = dimana5 AND `BARANG_ID` = dimana2;
		IF KELUARSTOK = 0 THEN
			INSERT INTO 01_tms_barangkharisma (`AI`, `BARANG_ID`, `RAK_ID`, `NAMABARANG`, `SUPPLER_ID`, `KATEGORI_ID`, `HARGABELI`, `HARGAJUAL`, `HARGASALES`, `HARGATRADER`, `HARGADISTRIBUTOR`, `EXP_ENUM`,  `BESTBUY`, `SATUAN`, `QTYSATUAN`, `QTYGUDANG`, `QTYONLINE`, `QTYRETUR`, `LINKSTUFF`, `JENISALUR`, `KONSINYASI`, `SERIAL`, `AKTIF`, `STOKMINIMUM`, `NAMAFILE`, `KODEAKUN`, `MANUFAKTUR`, `KASIR_ID`, `HARGARATA`, `KETERANGANBARANG`, `KODEUNIKMEMBER`, `ALIASTOTALSTOK`, `JASA`, `STOKTANPAOUTLET`, `HARGANETTTERAKHIR`) SELECT '', `BARANG_ID`, `RAK_ID`, `NAMABARANG`, `SUPPLER_ID`, `KATEGORI_ID`, `HARGABELI`, `HARGAJUAL`, `HARGASALES`, `HARGATRADER`, `HARGADISTRIBUTOR`, `EXP_ENUM`, `BESTBUY`, `SATUAN`, 0, 0, 0, 0, `LINKSTUFF`, `JENISALUR`, `KONSINYASI`, `SERIAL`, `AKTIF`, `STOKMINIMUM`, `NAMAFILE`, dimana5, `MANUFAKTUR`, `KASIR_ID`, `HARGARATA`, `KETERANGANBARANG`, `KODEUNIKMEMBER`, `ALIASTOTALSTOK`, `JASA`, `STOKTANPAOUTLET`, `HARGANETTTERAKHIR` FROM 01_tms_barangkharisma WHERE `KODEAKUN` = dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `BARANG_ID` = dimana2;
		END IF;
	ELSEIF dimana1 = 20 THEN
		SELECT `BARANG_ID`, `NAMABARANG` ,`HARGAJUAL`,`HARGABELI`,`HARGANETTTERAKHIR`,`STOKTANPAOUTLET`,`STOKMINIMUM` FROM 01_tms_barangkharisma WHERE `KODEAKUN` = dimana2 AND `KODEUNIKMEMBER` = dimana3 AND (`BARANG_ID` LIKE CONCAT('%',dimana4,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana4,'%')) AND `STOKTANPAOUTLET` <= `STOKMINIMUM` AND `AKTIF` = 1 LIMIT ditampilkan;
	ELSEIF dimana1 = 21 THEN
		SELECT * FROM 01_trs_barangkeluar as A JOIN 01_tms_barangkharisma as B ON A.`FK_BARANG` = B.`BARANG_ID` WHERE A.`KODEUNIKMEMBER` = dimana2 AND A.`PK_NOTAPENJUALAN` = dimana3 AND B.`KODEAKUN` = dimana4;
	ELSEIF dimana1 = 22 THEN
		SELECT `AI`,`BARANG_ID`, `NAMABARANG`, `HARGABELI`, `KASIR_ID`, `KODEAKUN`, `KETERANGANBARANG` FROM `01_tms_barangkharisma` WHERE `ISVERIFIEDPUSAT` = dimana3 AND `KODEAKUN` = dimana9 AND `KODEUNIKMEMBER` = dimana10 AND (`BARANG_ID` LIKE CONCAT('%',dimana2,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana2,'%') OR `KASIR_ID` LIKE CONCAT('%',dimana2,'%')) LIMIT datake, ditampilkan;
    ELSEIF dimana1 = 23 THEN
        CREATE TABLE dimana2 LIKE `01_tms_barangkharisma`;
        INSERT INTO dimana2 SELECT * FROM `01_tms_barangkharisma` WHERE `AI` = dimana2;
		UPDATE dimana2 SET `KODEAKUN` = 'GDPST', `ISVERIFIEDPUSAT` = 'True', `AI` = NULL;
		INSERT INTO `01_tms_barangkharisma` SELECT * FROM dimana2;
		DROP TABLE IF EXISTS dimana2;
        UPDATE `01_tms_barangkharisma` SET `ISVERIFIEDPUSAT` = 'True' WHERE `AI` = dimana2;
	END IF;
ELSEIF kondisi = 1 THEN
	SELECT `BARANG_ID`,`RAK_ID`,`NAMABARANG`,`NAMASUPPLIER`,`NAMAKATEGORI`,`HARGABELI`,`HARGAJUAL`,`HARGASALES`,`HARGATRADER`,`HARGADISTRIBUTOR`,`EXP_ENUM`,`DISPLAY`,`GUDANG`,`RETUR`,`PROMO`,`ONLINE`,`BATASPROMO`,`NAMAFILE`,`EKS`,`BESTBUY`,`SATUAN`,`NAMASATUAN` FROM 01_tmp_barangkharismatrash as A JOIN 01_tms_supplier as B ON A.SUPPLER_ID = B.SUPPLIER_ID JOIN 01_tms_kategori as C ON A.KATEGORI_ID = C.KATEGORIPARENT_ID JOIN 01_tms_barangsatuan as D ON A.SATUAN = D.SATUAN_ID LIMIT datake, ditampilkan;
ELSEIF kondisi = 2 THEN
	IF dimana2 = 1 THEN
	if exists (SELECT `PK_BARANGMASUK` FROM 01_trs_barangmasukpre) THEN 
	SELECT `PK_BARANGMASUK`,`NOTA`,`TANGGALTRS`,`FK_SUPPLIER`,`OUTLET`,`KODEBARANG`,`NAMABARANG`,`KETERANGAN`,`HARGANETT`,`JUMLAHBELI`, `DP`, ((`HARGANETT`*`JUMLAHBELI`)-`DP`) as KEKURANGAN, `KONSINYASI`, `NOMORNOTA`, SUM(`JUMLAHBELI`) as JUMLAHQTY, count(`PK_BARANGMASUK`) as JUMLAHITEM FROM 01_trs_barangmasukpre AS A LEFT JOIN 01_tms_barangkharisma AS B on A.KODEBARANG = B.BARANG_ID where (`KONSINYASI` = 'True') AND (`NOTA` LIKE CONCAT('%',dimana3,'%') OR `FK_SUPPLIER` LIKE CONCAT('%',dimana3,'%') OR `OUTLET` LIKE CONCAT('%',dimana3,'%') OR `KODEBARANG` LIKE CONCAT('%',dimana3,'%')) AND (`TANGGALTRS` BETWEEN dimana4 AND dimana5) group by `NOTA` ORDER BY
		CASE WHEN dimana1 = 'ASCNOTRANSAKSI' THEN `NOTA` END ASC ,
		CASE WHEN dimana1 = 'DESCNOTRANSAKSI' THEN `NOTA` END DESC,
		CASE WHEN dimana1 = 'ASCTANGGAL' THEN `TANGGALTRS` END ASC,
		CASE WHEN dimana1 = 'DESCTANGGAL' THEN `TANGGALTRS` END DESC,
		CASE WHEN dimana1 = 'ASCSUPPLIER' THEN `FK_SUPPLIER` END ASC,
		CASE WHEN dimana1 = 'DESCSUPPLIER' THEN `FK_SUPPLIER` END DESC,
		CASE WHEN dimana1 = 'ASCCABANG' THEN `OUTLET` END ASC,
		CASE WHEN dimana1 = 'DESCCABANG' THEN `OUTLET` END DESC,
		CASE WHEN dimana1 = 'ASCKODEBARANG' THEN `KODEBARANG` END ASC,
		CASE WHEN dimana1 = 'DESCKODEBARANG' THEN `KODEBARANG` END DESC,
		CASE WHEN dimana1 = '' then `NOTA` END ASC
		LIMIT datake, ditampilkan;
	END IF;
	 elseif dimana2 = 2 THEN

	 if exists (SELECT `PK_BARANGMASUK` FROM 01_trs_barangmasukpre) THEN 

		select `TANGGALTRS` FROM 01_trs_barangmasukpre order by `TANGGALTRS` DESC LIMIT 1;

	END IF;

	 elseif dimana2 = 3 THEN

	 if exists (SELECT `PK_BARANGMASUK` FROM 01_trs_barangmasukpre) THEN 

		select `TANGGALTRS` FROM 01_trs_barangmasukpre order by `TANGGALTRS` ASC LIMIT 1;

	END IF;

	elseif dimana2 = 4 THEN

	select `KODESUPPLIER` from 01_tms_supplier where `KODESUPPLIER` = dimana3;

	END IF;

ELSEIF kondisi = 4 THEN

	IF dimana2 = 1 THEN

	SELECT `BARANG_ID`, `RAK_ID`, `NAMABARANG`, `SUPPLER_ID`, `KATEGORI_ID`, `HARGABELI`, `HARGAJUAL`, `HARGASALES`, `HARGATRADER`, `HARGADISTRIBUTOR`, `SATUAN`, `QTYSATUAN`,`QTYGUDANG`,`QTYONLINE`,`QTYRETUR`, COALESCE(SUM(`DISPLAY`),0) as DISPLAY, COALESCE(`QTYPROMO`,0) as QTYPROMO, COALESCE(`NAMASUPPLIER`,'-') as NAMASUPPLIER, COALESCE(`NAMAKATEGORI`,'-') as NAMAKATEGORI FROM 01_tms_barangkharisma as a left join 01_bnt_display as b on a.BARANG_ID = b.KODEBARANG left JOIN 01_bnt_displaybonus as c on a.BARANG_ID = c.KODEBARANG left join 01_tms_supplier as d on a.SUPPLER_ID = d.KODESUPPLIER left join 01_tms_kategori as e on a.KATEGORI_ID = e.KATEGORIPARENT_ID where (`BARANG_ID` LIKE CONCAT('%',dimana3,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana3,'%') OR `RAK_ID` LIKE CONCAT('%',dimana3,'%') OR `SATUAN` LIKE CONCAT('%',dimana3,'%') OR `NAMASUPPLIER` LIKE CONCAT('%',dimana3,'%') OR `NAMAKATEGORI` LIKE CONCAT('%',dimana3,'%')) AND `KONSINYASI` = 'true' AND `AKTIF` LIKE CONCAT('%',dimana4,'%') GROUP BY `BARANG_ID` ORDER BY

		CASE WHEN dimana1 = 'ASCBARANG_ID' THEN `BARANG_ID` END ASC ,

		CASE WHEN dimana1 = 'DESCBARANG_ID' THEN `BARANG_ID` END DESC,

        CASE WHEN dimana1 = 'ASCNAMABARANG' THEN `NAMABARANG` END ASC,

        CASE WHEN dimana1 = 'DESCNAMABARANG' THEN `NAMABARANG` END DESC,

        CASE WHEN dimana1 = 'ASCRAK_ID' THEN `RAK_ID` END ASC,

        CASE WHEN dimana1 = 'DESCRAK_ID' THEN `RAK_ID` END DESC,

        CASE WHEN dimana1 = 'ASCSATUAN' THEN `SATUAN` END ASC,

        CASE WHEN dimana1 = 'DESCSATUAN' THEN `SATUAN` END DESC,

        CASE WHEN dimana1 = 'ASCNAMASUPPLIER' THEN `NAMASUPPLIER` END ASC,

        CASE WHEN dimana1 = 'DESCNAMASUPPLIER' THEN `NAMASUPPLIER` END DESC,

        CASE WHEN dimana1 = 'ASCNAMAKATEGORI' THEN `NAMAKATEGORI` END ASC,

        CASE WHEN dimana1 = 'DESCNAMAKATEGORI' THEN `NAMAKATEGORI` END DESC,

		CASE WHEN dimana1 = '' then `BARANG_ID` END ASC

		LIMIT datake, ditampilkan;

	elseif dimana2 = 2 THEN

    SELECT count(`BARANG_ID`) as TOTALBARANGKONSINYASI FROM 01_tms_barangkharisma where KONSINYASI = 'true';

	END IF;

ELSEIF kondisi = 5 THEN

	IF dimana2 = 1 THEN

		SELECT TANGGALTRS, NOTA,`NAMASUPPLIER`,`TOP`,`CARABAYAR`,`PETUGAS`,`OUTLET`,SUM(JUMLAHBELI) as JUMLAHBELI, SUM(HARGANETT * JUMLAHBELI) as TOTALBELANJA, BIAYALAIN, 

        CASE

            WHEN dimana3 = 'NOTA' THEN NOTA

			WHEN dimana3 = 'TOP' THEN TOP

			WHEN dimana3 = 'CARABAYAR' THEN CARABAYAR

			WHEN dimana3 = 'PETUGAS' THEN PETUGAS

			WHEN dimana3 = 'NAMASUPPLIER' THEN NAMASUPPLIER

			WHEN dimana3 = 'NAMABARANG' THEN NAMABARANG

            WHEN dimana3 = 'KODEBARANG' THEN KODEBARANG

		END as HAVINGKOLOM

        FROM 01_trs_barangmasuk as A JOIN 01_tms_supplier as B ON A.`FK_SUPPLIER` = B.`KODESUPPLIER` JOIN 01_tms_barangkharisma as C ON A.KODEBARANG = C.BARANG_ID WHERE KONSINYASI = 'true' AND STATUSLUNAS = 'TRUE' AND (TANGGALTRS BETWEEN dimana5 AND dimana6) GROUP BY NOTA HAVING HAVINGKOLOM LIKE CONCAT('%',dimana1,'%')  ORDER BY

        CASE WHEN dimana4 = 'ASCKODENOTA' THEN NOTA END ASC ,

		CASE WHEN dimana4 = 'ASCNAMASUPPLIER' THEN NAMASUPPLIER END ASC,

        CASE WHEN dimana4 = 'ASCTGLTRANSAKSI' THEN TANGGALTRS END ASC,

        CASE WHEN dimana4 = 'DESCKODENOTA' THEN NOTA END DESC ,

		CASE WHEN dimana4 = 'DESCNAMASUPPLIER' THEN NAMASUPPLIER END DESC,

        CASE WHEN dimana4 = 'DESCTGLTRANSAKSI' THEN TANGGALTRS END DESC,

		CASE WHEN dimana4 = '' then TANGGALTRS END ASC

        LIMIT datake, ditampilkan;

	ELSEIF dimana2 = 2 THEN

		SELECT COALESCE(SUM(HARGANETT * JUMLAHBELI),0) as TOTALPERPERIODE FROM 01_trs_barangmasuk AS A JOIN 01_tms_barangkharisma as C ON A.KODEBARANG = C.BARANG_ID WHERE KONSINYASI = 'true' AND (TANGGALTRS BETWEEN dimana5 AND dimana6) AND STATUSLUNAS = 'TRUE';

	ELSEIF dimana2 = 3 THEN

		SELECT C.`KODESUPPLIER`,A.`BARANGADA`,C.`NAMASUPPLIER`,C.`ALAMATSUPPLIER`,DATE_FORMAT(BIGINTTODATETIME(TANGGALTRS),'%d-%m-%Y') as TANGGALTRS,DATE_FORMAT(BIGINTTODATETIME(TANGGALTRS),'%Y/%m/%d/%H/%i/%s') as TANGGALTRSF,`NOTA`,`KETERANGAN`,`TOP`,`CARABAYAR`,`PPN`,`KODEBARANG`,`NAMABARANG`,`HARGAJUALBARU`,`JUMLAHBELI`,`DISPLAY`,`ONLINE`,`PROMO`,`GUDANG`,A.`HARGABELI`,(JUMLAHBELI * A.`HARGABELI`) as SUBTOTAL,`EXP` as EXPDUP, DATE_FORMAT(BIGINTTODATETIME(EXP),'%d %M %Y') as EXP,`DISKON1`,`RP1`,`DISKON2`,`RP2`,`DISKON3`,`RP3`,`AFTERDISKON1`,`ARP1`,`AFTERDISKON2`,`ARP2`,`BIAYALAIN` FROM 01_trs_barangmasuk as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` JOIN 01_tms_supplier as C ON A.`FK_SUPPLIER` = C.`KODESUPPLIER` WHERE KONSINYASI = 'true' AND NOTA = dimana1 ORDER BY TANGGALTRS DESC;

	ELSEIF dimana2 = 4 THEN

		SELECT COUNT(*) as ADANOTA FROM 01_trs_barangkeluarnota WHERE NOTAPEMBELIAN = dimana1;

	ELSEIF dimana2 = 5 THEN

		SELECT `PK_NOTAPENJUALAN`,`KODEBARANG`,`NAMABARANG`,`TGLKELUAR`,`STOKBARANGKELUAR` FROM 01_trs_barangkeluarnota as A JOIN 01_trs_barangkeluar as B ON A.`NOTAPENJUALAN` = B.`PK_NOTAPENJUALAN` WHERE `NOTAPEMBELIAN` = dimana1 OR `FK_BARANG`= dimana1 GROUP BY A.`NOTAPENJUALAN`;

	ELSEIF dimana2 = 6 THEN

		DELETE FROM 01_trs_barangmasuk WHERE NOTA = dimana1 OR KODEBARANG = dimana2;

	ELSEIF dimana2 = 7 THEN

		SELECT SUM(STOKBARANGKELUAR) as STOKBARANGKELUAR FROM 01_trs_barangkeluar as A JOIN 01_trs_barangkeluarnota as B ON A.PK_NOTAPENJUALAN = B.NOTAPENJUALAN WHERE FK_BARANG = dimana1 AND NOTAPEMBELIAN = dimana3 GROUP BY NOTAPEMBELIAN;

	ELSEIF dimana2 = 8 THEN

		IF dimana3 = 0 THEN

			SELECT MASUK,`KARTUSTOK_AI` INTO OLDSTOKKARTU,DATAKEAI FROM 01_trs_kartustok WHERE NOTRANSAKSI = dimana1 AND BARANG_ID = dimana4 AND TIPE = 'TRSPMB';

            UPDATE 01_trs_kartustok SET SALDO = SALDO - OLDSTOKKARTU WHERE KARTUSTOK_AI > DATAKEAI AND BARANG_ID = dimana4; 

            DELETE FROM 01_trs_kartustok WHERE BARANG_ID = dimana4 AND NOTRANSAKSI = dimana1;

            DELETE FROM 01_bnt_gudang WHERE BARANG_ID = dimana4 AND NOTAPEMBELIAN = dimana1;

            DELETE FROM 01_bnt_display WHERE KODEBARANG = dimana4 AND NOTAPEMBELIAN = dimana1;

            DELETE FROM 01_bnt_online WHERE KODEBARANG = dimana4 AND NOTAPEMBELIAN = dimana1;

            DELETE FROM 01_bnt_retur WHERE KODEBARANG = dimana4 AND NOTAPEMBELIAN = dimana1;

        END IF;	

	ELSEIF dimana2 = 9 THEN

		SELECT COUNT(*) as ADABARANG FROM 01_trs_barangmasuk WHERE NOTA = dimana3 AND KODEBARANG = dimana1;

	ELSEIF dimana2 = 10 THEN

		SELECT TANGGALTRS, NOTA,`NAMASUPPLIER`,`TOP`,`CARABAYAR`,`PETUGAS`,`OUTLET`,SUM(JUMLAHBELI) as JUMLAHBELI, SUM(HARGANETT * JUMLAHBELI) as TOTALBELANJA, BIAYALAIN, 

        CASE

            WHEN dimana3 = 'NOTA' THEN NOTA

			WHEN dimana3 = 'TOP' THEN TOP

			WHEN dimana3 = 'CARABAYAR' THEN CARABAYAR

			WHEN dimana3 = 'PETUGAS' THEN PETUGAS

			WHEN dimana3 = 'NAMASUPPLIER' THEN NAMASUPPLIER

			WHEN dimana3 = 'NAMABARANG' THEN NAMABARANG

            WHEN dimana3 = 'KODEBARANG' THEN KODEBARANG

		END as HAVINGKOLOM

        FROM 01_trs_barangmasuk as A JOIN 01_tms_supplier as B ON A.`FK_SUPPLIER` = B.`KODESUPPLIER` JOIN 01_tms_barangkharisma as C ON A.KODEBARANG = C.BARANG_ID WHERE KONSINYASI = 'true' AND STATUSLUNAS = 'TRUE' AND (TANGGALTRS BETWEEN dimana5 AND dimana6) GROUP BY NOTA HAVING HAVINGKOLOM LIKE CONCAT('%',dimana1,'%')  ORDER BY

        CASE WHEN dimana4 = 'ASCKODENOTA' THEN NOTA END ASC ,

		CASE WHEN dimana4 = 'ASCNAMASUPPLIER' THEN NAMASUPPLIER END ASC,

        CASE WHEN dimana4 = 'ASCTGLTRANSAKSI' THEN TANGGALTRS END ASC,

        CASE WHEN dimana4 = 'DESCKODENOTA' THEN NOTA END DESC ,

		CASE WHEN dimana4 = 'DESCNAMASUPPLIER' THEN NAMASUPPLIER END DESC,

        CASE WHEN dimana4 = 'DESCTGLTRANSAKSI' THEN TANGGALTRS END DESC,

		CASE WHEN dimana4 = '' then TANGGALTRS END ASC

        LIMIT datake, ditampilkan;

	END IF;

ELSEIF kondisi = 6 THEN

	IF dimana1 = 1 THEN

		SELECT PK_NOTAPENJUALAN,SUM(`STOKBARANGKELUAR`) as TOTALBARANGKELUAR, `TGLKELUAR`, SUM(A.`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)) as TOTALKELUAR FROM 01_trs_barangkeluar WHERE DATE(`TGLKELUAR`) BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() GROUP BY PK_NOTAPENJUALAN;

	ELSEIF dimana1 = 2 THEN

		SELECT 

        CASE

			WHEN dimana6 = 'Nota' THEN PK_NOTAPENJUALAN

            WHEN dimana6 = 'Lokasi' THEN LOKASI

            WHEN dimana6 = 'Petugas' THEN KASIR

            WHEN dimana6 = 'TOP' THEN ENUM_TIPETRANSAKSI

            WHEN dimana6 = 'Jenis' THEN ENUM_JENISTRANSAKSI

            WHEN dimana6 = 'Nama Barang' THEN A.NAMABARANG

        END as HAVINGKOLOM,

        PK_NOTAPENJUALAN,`KASIR`,`NAMA`, SUM(A.`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)) as TOTALTRANSAKSI, SUM(STOKBARANGKELUAR) as TOTALBARANGKELUAR, DATE_FORMAT(TGLKELUAR,'%d-%m-%Y') as TGLKELUAR, WAKTU,`BAYAR`,`ENUM_TIPETRANSAKSI`,`ENUM_JENISTRANSAKSI`,`LOKASI` FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B ON A.`FK_MEMBER` = B.`MEMBER_ID` JOIN 01_tms_barangkharisma AS C ON A.FK_BARANG = C.BARANG_ID

        WHERE KONSINYASI = 'true' AND (DATE(`TGLKELUAR`) BETWEEN dimana3 AND dimana4) AND STATUS_LUNAS = 1 GROUP BY PK_NOTAPENJUALAN

        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY

        CASE WHEN dimana2 = 'KODEASC' THEN PK_NOTAPENJUALAN END ASC ,

		CASE WHEN dimana2 = 'KODEDESC' THEN PK_NOTAPENJUALAN END DESC,

        CASE WHEN dimana2 = 'NAMAASC' THEN A.NAMABARANG END ASC,

        CASE WHEN dimana2 = 'NAMADESC' THEN A.NAMABARANG END DESC,

		CASE WHEN dimana2 = 'TGLASC' THEN AI_TRANSAKSIKELUAR END ASC,

        CASE WHEN dimana2 = 'TGLDESC' THEN AI_TRANSAKSIKELUAR END DESC,

		CASE WHEN dimana2 = '' then AI_TRANSAKSIKELUAR END ASC

        LIMIT datake, ditampilkan;

	ELSEIF dimana1 = 3 THEN

		SELECT 

        CASE

			WHEN dimana6 = 'Kode Barang' THEN FK_BARANG

            WHEN dimana6 = 'Nama Barang' THEN NAMABARANG

            WHEN dimana6 = 'Lokasi' THEN LOKASI

            WHEN dimana6 = 'Bulan' THEN MONTH(TGLKELUAR)

            WHEN dimana6 = 'Waktu' THEN WAKTU

        END as HAVINGKOLOM,

        PK_NOTAPENJUALAN,`FK_BARANG`,`NAMABARANG`, STOKBARANGKELUAR,`HARGAJUALTIAP`,`HARGADASAR`,`WAKTU`,DATE_FORMAT(TGLKELUAR,'%M') as TGLKELUAR,`LOKASI` FROM 01_trs_barangkeluar 

        WHERE (DATE(`TGLKELUAR`) BETWEEN dimana3 AND dimana4) GROUP BY PK_NOTAPENJUALAN

        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY

        CASE WHEN dimana2 = 'KODEASC' THEN PK_NOTAPENJUALAN END ASC ,

		CASE WHEN dimana2 = 'KODEDESC' THEN PK_NOTAPENJUALAN END DESC,

        CASE WHEN dimana2 = 'NAMAASC' THEN NAMABARANG END ASC,

        CASE WHEN dimana2 = 'NAMADESC' THEN NAMABARANG END DESC,

        CASE WHEN dimana2 = 'TGLASC' THEN AI_TRANSAKSIKELUAR END ASC,

        CASE WHEN dimana2 = 'TGLDESC' THEN AI_TRANSAKSIKELUAR END DESC,

		CASE WHEN dimana2 = '' then AI_TRANSAKSIKELUAR END ASC

        LIMIT datake, ditampilkan;

	ELSEIF dimana1 = 4 THEN

		SELECT 

        CASE

			WHEN dimana6 = 'Nota' THEN PK_NOTAPENJUALAN

            WHEN dimana6 = 'Lokasi' THEN LOKASI

            WHEN dimana6 = 'Petugas' THEN KASIR

            WHEN dimana6 = 'TOP' THEN ENUM_TIPETRANSAKSI

            WHEN dimana6 = 'Jenis' THEN ENUM_JENISTRANSAKSI

            WHEN dimana6 = 'Nama Barang' THEN A.NAMABARANG

            WHEN dimana6 = 'Nama Member' THEN NAMA

        END as HAVINGKOLOM,

        PK_NOTAPENJUALAN,`KASIR`,`MEMBER_ID`,`NAMA`,`FK_SALESMAN`,SUM(A.`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)) as TOTALTRANSAKSI, SUM(STOKBARANGKELUAR) as TOTALBARANGKELUAR, DATE_FORMAT(TGLKELUAR,'%d-%m-%Y') as TGLKELUAR,DATE_FORMAT(JATUHTEMPO,'%d-%m-%Y') as JATUHTEMPO, STATUS_LUNAS,`LOKASI` FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B ON A.`FK_MEMBER` = B.`MEMBER_ID` JOIN 01_tms_barangkharisma AS C ON A.FK_BARANG = C.BARANG_ID

        WHERE KONSINYASI = 'true' AND (JATUHTEMPO BETWEEN dimana3 AND dimana4) AND ENUM_TIPETRANSAKSI = 'KIRIM' AND STATUS_LUNAS = dimana7 GROUP BY PK_NOTAPENJUALAN

        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY

        CASE WHEN dimana2 = 'KODEASC' THEN PK_NOTAPENJUALAN END ASC ,

		CASE WHEN dimana2 = 'KODEDESC' THEN PK_NOTAPENJUALAN END DESC,

        CASE WHEN dimana2 = 'NAMAASC' THEN A.NAMABARANG END ASC,

        CASE WHEN dimana2 = 'NAMADESC' THEN A.NAMABARANG END DESC,

        CASE WHEN dimana2 = 'TGLASC' THEN AI_TRANSAKSIKELUAR END ASC,

        CASE WHEN dimana2 = 'TGLDESC' THEN AI_TRANSAKSIKELUAR END DESC,

		CASE WHEN dimana2 = '' then AI_TRANSAKSIKELUAR END ASC

        LIMIT datake, ditampilkan;

	ELSEIF dimana1 = 5 THEN

		SELECT PK_PIUTANGKIRIM,`PETUGAS`,`BAYAR`,DATE_FORMAT(TANGGALBAYAR,'%d-%m-%Y') as TANGGALBAYAR,DATE_FORMAT(JATUHTEMPO,'%d-%m-%Y') as JATUHTEMPO,`CABANG` FROM 01_trs_piutangkirim WHERE NOFAKTURPENGIRIMAN = dimana2 ORDER BY PK_PIUTANGKIRIM DESC;

	ELSEIF dimana1 = 6 THEN

		UPDATE 01_trs_barangkeluar SET STATUS_LUNAS = dimana3 WHERE PK_NOTAPENJUALAN = dimana2;

    END IF;

ELSEIF kondisi = 11 THEN

	if dimana2 = 1 THEN

		SELECT `MEMBER_ID`, `NAMA`, `GRUP`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`, `TELEPON`, `FAX`, `EMAIL`, `NOREK`, `PEMILIKREK`, `BANK`,`KETERANGAN`, `AKHIRAKTIF` FROM 01_tms_member where `MEMBER_ID` <> '1001' ORDER BY

		CASE WHEN dimana1 = 'ASCKODEMEMBER' THEN `MEMBER_ID` END ASC ,

		CASE WHEN dimana1 = 'DESCKODEMEMBER' THEN `MEMBER_ID` END DESC,

		CASE WHEN dimana1 = '' then `MEMBER_ID` END ASC

		LIMIT datake, ditampilkan;

     elseif dimana2 = 2 THEN

		SELECT `MEMBER_ID`, `NAMA`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`,`JK`,`EMAIL`, `TELEPON`, `FAX`,  `AKHIRAKTIF`, `NOREK`, `PEMILIKREK`, `BANK`,`NPWP`,`KETERANGAN`,`LIMITJUMLAHPIUTANG`, `JENIS`, `GRUP`,`MINIMALPOIN`,`BATASTAMBAHKREDIT`,`KEJARTARGET`  FROM 01_tms_member where `MEMBER_ID` = dimana3;

     elseif dimana2 = 3 THEN

		SELECT count(`MEMBER_ID`) as JUMLAHMEMBER FROM 01_tms_member WHERE `MEMBER_ID` <> '1001';

     elseif dimana2 = 4 THEN

		SELECT count(`MEMBER_ID`) as JUMLAHMEMBERAKTIF FROM 01_tms_member WHERE `MEMBER_ID` <> '1001' AND `STATUSAKTIF` = 1;

	elseif dimana2 = 5 THEN

		SELECT count(`MEMBER_ID`) as JUMLAHMEMBERTIDAKAKTIF FROM 01_tms_member WHERE `MEMBER_ID` <> '1001' AND `STATUSAKTIF` <> 1;

    elseif dimana2 = 6 THEN

		SELECT `GRUP` FROM 01_tms_member_grup;

	elseif dimana2 = 7 THEN

		SELECT `MEMBER_ID`, `NAMA`, `GRUP`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`, `TELEPON`, `FAX`, `EMAIL`, `NOREK`, `PEMILIKREK`, `BANK`,`KETERANGAN`, `AKHIRAKTIF` FROM 01_tms_member where `MEMBER_ID` LIKE CONCAT('%',dimana3,'%') OR `NAMA` LIKE CONCAT('%',dimana3,'%') OR `GRUP` LIKE CONCAT('%',dimana3,'%')  AND `MEMBER_ID` <> '1001'  ORDER BY

		CASE WHEN dimana1 = 'ASCKODEMEMBER' THEN `MEMBER_ID` END ASC ,

		CASE WHEN dimana1 = 'DESCKODEMEMBER' THEN `MEMBER_ID` END DESC,

		CASE WHEN dimana1 = '' then `MEMBER_ID` END ASC

		LIMIT datake, ditampilkan;

     END IF;

ELSEIF kondisi = 12 THEN

	SELECT `KODEGRUP`, `JENIS`, `GRUP` FROM 01_tms_member_grup where `JENIS` LIKE CONCAT('%',dimana1,'%');

ELSEIF kondisi = 13 THEN
	IF dimana2 = 1 THEN
		SELECT `TANGGALTRS`, `NOTA`,`NAMASUPPLIER`,`TOP`,`CARABAYAR`,`PETUGAS`,`OUTLET`,SUM(`JUMLAHBELI`) as JUMLAHBELI, SUM(A.`HARGABELI` * `JUMLAHBELI` - `RP1` - `RP2` - `RP3` + `RPPPN` - `ARP1` - `ARP2`) + SUM(`BIAYALAIN`) as TOTALBELANJA, `BIAYALAIN`, 
        CASE
            WHEN dimana3 = 'NOTA' THEN `NOTA`
			WHEN dimana3 = 'TOP' THEN `TOP`
			WHEN dimana3 = 'CARABAYAR' THEN `CARABAYAR`
			WHEN dimana3 = 'PETUGAS' THEN `PETUGAS`
			WHEN dimana3 = 'NAMASUPPLIER' THEN `NAMASUPPLIER`
            WHEN dimana3 = 'BARANG_ID' THEN C.`BARANG_ID`
			WHEN dimana3 = 'NAMABARANG' THEN C.`NAMABARANG`
		END as HAVINGKOLOM
        FROM 01_trs_barangmasuk as A JOIN 01_tms_supplier as B ON A.`FK_SUPPLIER` = B.`KODESUPPLIER` JOIN 01_tms_barangkharisma as C ON A.KODEBARANG = C.BARANG_ID WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`OUTLET` = dimana10 AND  (`TANGGALTRS` BETWEEN dimana5 AND dimana6) AND C.`KODEAKUN` = dimana7 GROUP BY 
        CASE 
        WHEN dimana3 = 'NAMABARANG' THEN `PK_BARANGMASUK`
        WHEN dimana3 = 'BARANG_ID' THEN `PK_BARANGMASUK`
        ELSE `NOTA` 
        END 
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana1,'%')  ORDER BY
        CASE WHEN dimana4 = 'ASCKODENOTA' THEN `NOTA` END ASC ,
		CASE WHEN dimana4 = 'ASCNAMASUPPLIER' THEN `NAMASUPPLIER` END ASC,
        CASE WHEN dimana4 = 'ASCTGLTRANSAKSI' THEN `TANGGALTRS` END ASC,
        CASE WHEN dimana4 = 'DESCKODENOTA' THEN `NOTA` END DESC ,
		CASE WHEN dimana4 = 'DESCNAMASUPPLIER' THEN `NAMASUPPLIER` END DESC,
        CASE WHEN dimana4 = 'DESCTGLTRANSAKSI' THEN `TANGGALTRS` END DESC,
		CASE WHEN dimana4 = '' then `TANGGALTRS` END ASC
        LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 2 THEN
		SELECT COALESCE(SUM(`HARGANETT` * `JUMLAHBELI`),0) as TOTALPERPERIODE FROM 01_trs_barangmasuk WHERE (`TANGGALTRS` BETWEEN dimana5 AND dimana6);
	ELSEIF dimana2 = 3 THEN
		SELECT A.`OUTLET`,D.`NAMAOUTLET`, B.`SATUAN`,`BARANGADA`,A.`RPPPN`,`PK_BARANGMASUK`,C.`KODESUPPLIER`,C.`NAMASUPPLIER`,C.`ALAMATSUPPLIER`,ROUND((`JATUHTEMPO` - `TANGGALTRS`)/60/60/24,0) as JATUHTEMPO, DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRS`),'%d-%m-%Y') as TANGGALTRS,DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRS`),'%Y/%m/%d/%H/%i/%s') as TANGGALTRSF,`NOTA`,`KETERANGAN`,`TOP`,`CARABAYAR`,`PPN`,`KODEBARANG`,`NAMABARANG`,`HARGAJUALBARU`,`JUMLAHBELI`,`DISPLAY`,`ONLINE`,`PROMO`,`GUDANG`,A.`HARGABELI`,(`JUMLAHBELI` * A.`HARGABELI`) as SUBTOTAL,`EXP` as EXPDUP, DATE_FORMAT(BIGINTTODATETIME(`EXP`),'%d %M %Y') as EXP,`DISKON1`,`RP1`,`DISKON2`,`RP2`,`DISKON3`,`RP3`,`AFTERDISKON1`,`ARP1`,`AFTERDISKON2`,`ARP2`,`BIAYALAIN`,`DP`,`TOTALTERSEDIA`,`HARGARATASEBELUM`,`HARGANETT` FROM 01_trs_barangmasuk as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` JOIN 01_tms_supplier as C ON A.`FK_SUPPLIER` = C.`KODESUPPLIER` JOIN 01_set_outlet as D ON A.`OUTLET` = D.`KODEOUTLET` WHERE `NOTA` = dimana1 AND B.`KODEAKUN` = dimana3 AND A.`KODEUNIKMEMBER` = dimana4 ORDER BY `TANGGALTRS` DESC;
	ELSEIF dimana2 = 4 THEN
		SELECT COUNT(*) as ADANOTA FROM 01_trs_barangkeluarnota WHERE `NOTAPEMBELIAN` = dimana1;
	ELSEIF dimana2 = 5 THEN
		SELECT `PK_NOTAPENJUALAN`,`KODEBARANG`,`NAMABARANG`,`TGLKELUAR`,`STOKBARANGKELUAR` FROM 01_trs_barangkeluarnota as A JOIN 01_trs_barangkeluar as B ON A.`NOTAPENJUALAN` = B.`PK_NOTAPENJUALAN` WHERE `NOTAPEMBELIAN` = dimana1 OR `FK_BARANG`= dimana1 GROUP BY A.`NOTAPENJUALAN`;
	ELSEIF dimana2 = 6 THEN
		DELETE FROM 01_trs_barangmasuk WHERE `NOTA` = dimana1 OR `KODEBARANG` = dimana2;
	ELSEIF dimana2 = 7 THEN
		SELECT SUM(`STOKBARANGKELUAR`) as STOKBARANGKELUAR FROM 01_trs_barangkeluar as A JOIN 01_trs_barangkeluarnota as B ON A.PK_NOTAPENJUALAN = B.NOTAPENJUALAN WHERE `FK_BARANG` = dimana1 AND `NOTAPEMBELIAN` = dimana3 GROUP BY `NOTAPEMBELIAN`;
	ELSEIF dimana2 = 8 THEN
		IF dimana3 = 0 THEN
			SELECT `MASUK`,`KARTUSTOK_AI` INTO OLDSTOKKARTU,DATAKEAI FROM `01_trs_kartustok` WHERE `NOTRANSAKSI` = dimana1 AND `BARANG_ID` = dimana4 AND `TIPE` = 'TRSPMB';
            UPDATE 01_trs_kartustok SET `SALDO` = `SALDO` - OLDSTOKKARTU WHERE `KARTUSTOK_AI` > DATAKEAI AND `BARANG_ID` = dimana4; 
            DELETE FROM 01_trs_kartustok WHERE `BARANG_ID` = dimana4 AND `NOTRANSAKSI` = dimana1;
            DELETE FROM 01_bnt_gudang WHERE `BARANG_ID` = dimana4 AND `NOTAPEMBELIAN` = dimana1;
            DELETE FROM 01_bnt_display WHERE `KODEBARANG` = dimana4 AND `NOTAPEMBELIAN` = dimana1;
            DELETE FROM 01_bnt_online WHERE `KODEBARANG` = dimana4 AND `NOTAPEMBELIAN` = dimana1;
            DELETE FROM 01_bnt_retur WHERE `KODEBARANG` = dimana4 AND `NOTAPEMBELIAN` = dimana1;
        END IF;	
	ELSEIF dimana2 = 9 THEN
		SELECT COUNT(*) as ADABARANG FROM 01_trs_barangmasuk WHERE `NOTA` = dimana3 AND `KODEBARANG` = dimana1;
	ELSEIF dimana2 = 10 THEN
		SELECT `TANGGALTRS`, `NOTA`,`NAMASUPPLIER`,`TOP`,`CARABAYAR`,`PETUGAS`,`OUTLET`,SUM(`JUMLAHBELI`) as JUMLAHBELI, SUM(`HARGANETT` * `JUMLAHBELI`) as TOTALBELANJA, `BIAYALAIN`,`DP`, 
        CASE
            WHEN dimana3 = 'Nota' THEN `NOTA`
			WHEN dimana3 = 'TOP' THEN `TOP`
			WHEN dimana3 = 'Cara Bayar' THEN `CARABAYAR`
			WHEN dimana3 = 'Petugas' THEN `PETUGAS`
			WHEN dimana3 = 'Nama Suplier' THEN `NAMASUPPLIER`
			WHEN dimana3 = 'Nama Barang' THEN `NAMABARANG`
            WHEN dimana3 = '' THEN `NOTA`
		END as HAVINGKOLOM
        FROM 01_trs_barangmasukpre as A JOIN 01_tms_supplier as B ON A.`FK_SUPPLIER` = B.`KODESUPPLIER` JOIN 01_tms_barangkharisma as C ON A.KODEBARANG = C.BARANG_ID WHERE (`TANGGALTRS` BETWEEN dimana5 AND dimana6) GROUP BY `NOTA` HAVING HAVINGKOLOM LIKE CONCAT('%',dimana1,'%')  ORDER BY
        CASE WHEN dimana4 = 'ASCKODENOTA' THEN `NOTA` END ASC ,
		CASE WHEN dimana4 = 'ASCNAMASUPPLIER' THEN `NAMASUPPLIER` END ASC,
        CASE WHEN dimana4 = 'ASCTGLTRANSAKSI' THEN `TANGGALTRS` END ASC,
        CASE WHEN dimana4 = 'DESCKODENOTA' THEN `NOTA` END DESC ,
		CASE WHEN dimana4 = 'DESCNAMASUPPLIER' THEN `NAMASUPPLIER` END DESC,
        CASE WHEN dimana4 = 'DESCTGLTRANSAKSI' THEN `TANGGALTRS` END DESC,
		CASE WHEN dimana4 = '' then `TANGGALTRS` END ASC
        LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 11 THEN
		SELECT `PK_BARANGMASUK`, C.`KODESUPPLIER`,C.`NAMASUPPLIER`,C.`ALAMATSUPPLIER`,DATE_FORMAT(BIGINTTODATETIME(`JATUHTEMPO`),'%d-%m-%Y') as JATUHTEMPO,DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRS`),'%d-%m-%Y') as TANGGALTRS,DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRS`),'%Y/%m/%d/%H/%i/%s') as TANGGALTRSF,`NOTA`,`KETERANGAN`,`TOP`,`CARABAYAR`,`PPN`,`KODEBARANG`,`NAMABARANG`,`HARGAJUALBARU`,`JUMLAHBELI`,`DISPLAY`,`ONLINE`,`PROMO`,`GUDANG`,A.`HARGABELI`,(`JUMLAHBELI` * A.`HARGABELI`) as SUBTOTAL,`EXP` as EXPDUP, DATE_FORMAT(BIGINTTODATETIME(`EXP`),'%d %M %Y') as EXP,`DISKON1`,`RP1`,`DISKON2`,`RP2`,`DISKON3`,`RP3`,`AFTERDISKON1`,`ARP1`,`AFTERDISKON2`,`ARP2`,`BIAYALAIN`,`DP`,`NOTELP`,`DP`, `HARGANETT`,`TOTALTERSEDIA`,`HARGARATASEBELUM` FROM 01_trs_barangmasukpre as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` JOIN 01_tms_supplier as C ON A.`FK_SUPPLIER` = C.`KODESUPPLIER` WHERE `NOTA` = dimana1 ORDER BY `TANGGALTRS` DESC;
	ELSEIF dimana2 = 12 THEN
		SELECT 
        CASE
			WHEN dimana5 = 'Kode Barang' THEN `KODEBARANG`
            WHEN dimana5 = 'Nama Barang' THEN `NAMABARANG`
            WHEN dimana5 = 'Lokasi' THEN `OUTLET`
            WHEN dimana5 = 'Bulan' THEN MONTH(BIGINTTODATETIME(`TANGGALTRS`))
            WHEN dimana5 = 'Waktu' THEN TIME(BIGINTTODATETIME(`TANGGALTRS`))
        END as HAVINGKOLOM, `NOTA`,`KODEBARANG`,`NAMABARANG`,`NAMASUPPLIER`,`JUMLAHBELI`,A.`HARGABELI`,A.`HARGANETT`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRS`),'%d-%m-%Y %H:%i:%s') AS TANGGALTRANSAKSI,MONTH(BIGINTTODATETIME(`TANGGALTRS`)) AS BULANMASUK,A.`OUTLET`
        FROM 01_trs_barangmasuk as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` JOIN 01_tms_supplier as C ON A.`FK_SUPPLIER` = C.`KODESUPPLIER`
        WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`OUTLET` = dimana10 AND (`TANGGALTRS` BETWEEN dimana3 AND dimana4)
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana1,'%') ORDER BY
        CASE WHEN dimana6 = 'KODEASC' THEN `NOTA` END ASC ,
		CASE WHEN dimana6 = 'KODEDESC' THEN `NOTA` END DESC,
        CASE WHEN dimana6 = 'NAMAASC' THEN `NAMABARANG` END ASC,
        CASE WHEN dimana6 = 'NAMADESC' THEN `NAMABARANG` END DESC,
        CASE WHEN dimana6 = 'TGLASC' THEN `TANGGALTRS` END ASC,
        CASE WHEN dimana6 = 'TGLDESC' THEN `TANGGALTRS` END DESC,
		CASE WHEN dimana6 = '' then `TANGGALTRS` END ASC
        LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 13 THEN
		SELECT 
        CASE
			WHEN dimana5 = 'Kode Barang' THEN `KODEBARANG`
			WHEN dimana5 = 'Nama Barang' THEN `NAMABARANG`

			WHEN dimana5 = 'Kode Suplier' THEN `FK_SUPPLIER`

            WHEN dimana5 = 'Nama Suplier' THEN `NAMASUPPLIER`

            WHEN dimana5 = 'No Transaksi' THEN `NOTA`

            WHEN dimana5 = 'Petugas' THEN `PETUGAS`

        END as HAVINGKOLOM,

        `NOTA`,DATE_FORMAT(BIGINTTODATETIME(MIN(`TANGGALTRS`)),'%d-%m-%Y') as `TANGGALTRS`,`NAMASUPPLIER`,`PETUGAS`,`OUTLET`,SUM(`JUMLAHBELI`) AS TOTALBLMDTG,SUM(A.`HARGABELI`) AS TOTALBELI, DATE_FORMAT(BIGINTTODATETIME(MIN(`JATUHTEMPO`)),'%d-%m-%Y') AS JTTERDEKAT FROM 01_trs_barangmasuk as A

        JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID`

        JOIN 01_tms_supplier as C ON A.`FK_SUPPLIER` = C.`KODESUPPLIER`

        WHERE (`TANGGALTRS` BETWEEN dimana3 AND dimana4) AND `BARANGADA` = "false"

        GROUP BY `NOTA`

        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana1,'%') ORDER BY

        CASE WHEN dimana6 = 'TRSASC' THEN `NOTA` END ASC ,

		CASE WHEN dimana6 = 'TRSDESC' THEN `NOTA` END DESC,

        CASE WHEN dimana6 = 'TGLASC' THEN `TANGGALTRS` END ASC,

        CASE WHEN dimana6 = 'TGLDESC' THEN `TANGGALTRS` END DESC,

        CASE WHEN dimana6 = 'NMSUPLASC' THEN `NAMASUPPLIER` END ASC,

        CASE WHEN dimana6 = 'NMSUPLDESC' THEN `NAMASUPPLIER` END DESC,

		CASE WHEN dimana6 = '' then `TANGGALTRS` END ASC

        LIMIT datake, ditampilkan;

	ELSEIF dimana2 = 14 THEN
		UPDATE 01_trs_barangmasuk SET `PPN` = dimana3,`BIAYALAIN` = dimana4, `HARGANETT` = ROUND(((`HARGABELI` * `JUMLAHBELI`) - `RP1` - `RP2` - `Rp3` + (IF(dimana3 = 0,0, (dimana3 / 100) * ((`HARGABELI` * `JUMLAHBELI`) - `RP1` - `RP2` - `Rp3`))) - `ARP1` - `ARP2`) / `JUMLAHBELI` + `BIAYALAIN`,2) WHERE `NOTA` = dimana1;
	ELSEIF dimana2 = 15 THEN
		SELECT COUNT(*) as TOTALBARIS, COALESCE(`BAYAR`,0) as BAYARAWAL FROM 01_tms_hutangtoko WHERE `TRANSAKSI_ID` = dimana1 LIMIT 1;
	ELSEIF dimana2 = 16 THEN
		SELECT COALESCE(SUM(`QTYKELUAR`),0) as KELUAR FROM 01_trs_barangkeluarnota WHERE `NOTAPEMBELIAN` = dimana1 LIMIT 1;
	ELSEIF dimana2 = 17 THEN
		/*SELECT B.`NAMABARANG`,B.`BARANG_ID`,`HARGANETTTERAKHIR`,`HARGARATA`,`HARGAJUAL` FROM 01_trs_barangmasuk as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` WHERE A.`NOTA` = dimana3 AND `KODEAKUN` = dimana4 AND A.`KODEUNIKMEMBER` = dimana5;*/
         SELECT B.`NAMABARANG`,B.`BARANG_ID`,`HARGANETT` as HARGANETTTERAKHIR, B.`ALIASTOTALSTOK` ,A.`HARGABELI`, A.`HARGANETT`, `HARGARATA`,`HARGAJUAL` FROM 01_trs_barangmasuk as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANG` = B.`BARANG_ID` WHERE A.`NOTA` = dimana3 AND `KODEAKUN` = dimana4 AND A.`KODEUNIKMEMBER` = dimana5;
	END IF;
ELSEIF kondisi = 14 THEN
    IF dimana5 = 1 THEN
		SELECT `NOTRANSAKSI`,A.`BARANG_ID`,`NAMABARANG`,TANGGALTRANSAKSI,`TIPE`,A.`KETERANGAN`,A.`KASIR_ID`,`MASUK`,`MUTASI`,`OPNAME`,`KELUAR`,`SALDO`,`SALDOSEMUA` FROM 01_trs_kartustok as A JOIN 01_tms_barangkharisma as B ON A.BARANG_ID = B.BARANG_ID WHERE B.`KODEUNIKMEMBER` = dimana9 AND A.`OUTLET` = dimana8 AND A.`BARANG_ID` LIKE CONCAT('%', dimana1,'%') AND `TIPE` LIKE CONCAT('%',dimana4,'%') AND (`TANGGALTRANSAKSI` BETWEEN dimana6 AND dimana7) ORDER BY KARTUSTOK_AI DESC LIMIT datake, ditampilkan;
    ELSEIF dimana5 = 2 THEN
		SELECT `NOTRANSAKSI`,A.`BARANG_ID`,`NAMABARANG`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRANSAKSI`),'%d-%m-%Y %H:%i:%s') as TANGGALTRANSAKSI,`TIPE`,A.`KETERANGANBARANG`,A.`KASIR_ID`,`MASUK`,`MUTASI`,`KELUAR`,`SALDO` FROM 01_trs_kartustok as A JOIN 01_tms_barangkharisma as B ON A.BARANG_ID = B.BARANG_ID WHERE A.`BARANG_ID` = dimana1 AND `TIPE` LIKE CONCAT('%',dimana4,'%');
    ELSE
		SELECT `NOTRANSAKSI`,A.`BARANG_ID`,`NAMABARANG`,TANGGALTRANSAKSI,`TIPE`,A.`KETERANGAN`,A.`KASIR_ID`,`MASUK`,`MUTASI`,`OPNAME`,`KELUAR`,`SALDO`,`SALDOSEMUA` FROM 01_trs_kartustok as A JOIN 01_tms_barangkharisma as B ON A.BARANG_ID = B.BARANG_ID WHERE B.`KODEUNIKMEMBER` = dimana9 AND A.`OUTLET` = dimana8 AND `TIPE` LIKE CONCAT('%',dimana4,'%') ORDER BY KARTUSTOK_AI DESC LIMIT datake, ditampilkan;
		END IF;
ELSEIF kondisi = 15 THEN
	IF dimana2 = 1 THEN
		SELECT `KODESUPPLIER`,`NAMASUPPLIER`,`NOTELP` FROM 01_tms_supplier WHERE (KODESUPPLIER LIKE CONCAT('%',DIMANA1,'%') OR NAMASUPPLIER LIKE CONCAT('%',DIMANA1,'%')) AND KODEUNIKMEMBER = DIMANA10 ORDER BY `NAMASUPPLIER` ASC LIMIT 0,100;
	ELSEIF dimana2 = 2 THEN
		SELECT * FROM 01_tms_kategori WHERE `NAMAKATEGORI` LIKE CONCAT('%',dimana1,'%') AND KODEUNIKMEMBER = dimana10 LIMIT 0,500;
	ELSEIF dimana2 = 3 THEN
		SELECT `NAMASATUAN`,`KETERANGAN` FROM 01_tms_barangsatuan WHERE (`NAMASATUAN` LIKE CONCAT('%',dimana1,'%') OR `KETERANGAN` LIKE CONCAT('%',dimana1,'%')) AND KODEUNIKMEMBER = DIMANA10;
	ELSEIF dimana2 = 4 THEN
		IF dimana1 = "BONUS" THEN
			SELECT `QTYPROMO` as TOTALSTOK FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana3 AND `JENIS` = dimana4 AND `OUTLET` = dimana5;
		ELSEIF dimana1 = "akutansi" THEN
			SELECT `AKUNID`,`NAMAPERKIRAAN`,`JENIS` FROM 01_akun_grup;
		ELSEIF dimana1 = "bank" THEN
			SELECT `BANK_ID`,`NAMABANK`,`PAJAKDEBIT`,`PAJAKKREDIT` FROM 01_tms_pembayaranbank;
		ELSEIF dimana1 = "barcode" THEN
			SELECT `BARANG_ID`,`NAMABARANG`,`HARGAJUAL`,`KATEGORI_ID`,`STOKMINIMUM` FROM 01_tms_barangkharisma WHERE `BARANG_ID` = dimana3 LIMIT 1;
		ELSEIF dimana1 = "tampilbarcode" THEN
			SELECT `KODEBARANG`,`NAMABARANG`,`HARGAJUAL`,`KATEGORI`,`MINIMALSTOK`, SUM(JUMLAHCETAK) as JUMLAHCETAK FROM 01_tmp_barcodeprint GROUP BY `KODEBARANG`;
		ELSEIF dimana1 = "tampilbarcodewhere" THEN
			IF dimana3 = "" THEN
				SELECT `KODEBARANG`,`NAMABARANG`,`HARGAJUAL`,`KATEGORI`,`MINIMALSTOK`, `JUMLAHCETAK` FROM 01_tmp_barcodeprint;
            ELSE
				SELECT `KODEBARANG`,`NAMABARANG`,`HARGAJUAL`,`KATEGORI`,`MINIMALSTOK`, `JUMLAHCETAK` FROM 01_tmp_barcodeprint WHERE `KODEBARANG` = dimana3;
            END IF;
		ELSEIF dimana1 = "updatebonus" THEN
			UPDATE `01_tms_barangkharismabestbuy` SET `ISKATEGORI`= dimana3 WHERE `KATBAR_ID`= dimana4;
		ELSEIF dimana1 = "panggilstokrakitan" THEN
			SELECT SUM(`JUMLAH`) as JUMLAH FROM 01_bnt_displaygabung WHERE `KODEBARANG` = dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `OUTLET` = dimana5;
		ELSEIF dimana1 = "SAPerkiraan" THEN
			SELECT `AKUNID`,`NAMAPERKIRAAN`,`SALDOAWAL`,`DEBIT` FROM 01_akun_grup WHERE CASE
				WHEN dimana3 = "1" THEN (`AKUNID` LIKE '2.%' OR `AKUNID` LIKE '3.%' ) 
				WHEN dimana3 = "0" THEN `AKUNID` LIKE '1.%' 
			END AND `KODEUNIKMEMBER` = dimana4 AND `OUTLET` = dimana5 ORDER BY AKUNID;
		ELSEIF dimana1 = "SAUpdate" THEN
			UPDATE `01_akun_grup` SET `SALDOAWAL`= dimana4 WHERE `AKUNID` = dimana3 AND `KODEUNIKMEMBER` = dimana9 AND `OUTLET` = dimana10;
            SELECT COUNT(*) INTO HASILSTOK FROM 01_akun_jurnalumum WHERE `NOTRANSAKSI` = dimana5 AND `LOKASI` = dimana6 AND `KODEUNIKMEMBER` = dimana7; 
            IF dimana8 = "+" THEN
				SET DEBITNYA = dimana4; /* DEBIT */
                SET KREDITNYA = 0;
			ELSE
				SET DEBITNYA = 0; /* DEBIT */
                SET KREDITNYA = dimana4; 
			END IF;
            IF HASILSTOK > 0 THEN
                UPDATE 01_akun_jurnalumum SET `DEBET` = DEBITNYA, `KREDIT` = KREDITNYA WHERE `NOTRANSAKSI` = dimana5 AND `LOKASI` = dimana6 AND `KODEUNIKMEMBER` = dimana7;
            ELSE
				INSERT INTO `01_akun_jurnalumum` (`AI`, `TIPEINPUT`, `NOTRANSAKSI`, `TGLTRANSAKSI`, `TGLJURNAL`, `KODEACC`, `KETERANGAN`, `DEBET`, `KREDIT`, `POSISI`, `JENIS`, `NOMOR`, `KASAL`, `KTUJUAN`, `LOKASI`, `KODEUNIKMEMBER`, `READONLY`) VALUES (NULL, 'SALDO AWAL', dimana5, BIGINTTODATETIMENOW(), BIGINTTODATETIMENOW(), dimana3, 'SALDO AWAL PERKIRAAN APLIKASI', DEBITNYA, KREDITNYA, '1', 'JURNAL', '1', 'NONE', 'NONE', dimana6, dimana7, 'TRUE');
            END IF;
        END IF;
		ELSEIF dimana2 = 5 THEN
			SELECT * FROM `01_tms_perusahaan`;
    END IF;
ELSEIF kondisi = 16 THEN
	IF dimana2 = 1 THEN
		SELECT `MEMBER_ID`, `NAMA`, `GRUP`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`, `TELEPON`, `FAX`, `EMAIL`, `MINIMALPOIN`, `KEJARTARGET`, `LIMITJUMLAHPIUTANG`,`BATASTAMBAHKREDIT`, `AKHIRAKTIF`, `POINT`,`KETERANGAN`,STATUSAKTIF FROM 01_tms_member WHERE (NAMA LIKE CONCAT('%',dimana3,'%') OR MEMBER_ID LIKE CONCAT('%',dimana3,'%')) AND GRUP LIKE CONCAT('%',dimana7,'%') AND STATUSAKTIF = dimana4 AND
	 CASE 
		WHEN dimana10 = 'true' THEN (AKHIRAKTIF BETWEEN dimana5 AND dimana6)
		WHEN dimana10 = 'false' THEN 1=1
	 END
	AND KODEUNIKMEMBER = dimana9 ORDER BY MEMBER_ID ASC LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 2 THEN
		SELECT * FROM 01_tms_member_grup WHERE (JENIS LIKE CONCAT('%',dimana1,'%') OR KODEGRUP LIKE CONCAT('%',dimana1,'%')) AND KODEUNIKMEMBER = dimana9 LIMIT  datake, ditampilkan;
	ELSEIF dimana2 = 3 THEN
		SELECT COALESCE((SUM(HARGAJUAL * STOKBARANGKELUAR) - NOMINALPOTONGAN),0), COALESCE(COUNT(*),0) INTO TOTALTRANSAKSI, JUMLAHTRANSAKSI FROM 01_trs_barangkeluar_detail as A JOIN 01_trs_barangkeluar as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN WHERE B.FK_MEMBER = dimana3 AND A.KODEUNIKMEMBER = dimana1;
		SELECT *,TOTALTRANSAKSI as OMSET, JUMLAHTRANSAKSI as TOTALTRX, 0 as DEPOSIT, "" as APIKEY, 0 as MARKUP FROM 01_tms_member WHERE MEMBER_ID = dimana3 AND KODEUNIKMEMBER = dimana1 LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 9 THEN
		select DATE_FORMAT(BIGINTTODATETIME(MIN(`AKHIRAKTIF`)),'%m/%d/%Y') as `AKHIRAKTIFMIN`, DATE_FORMAT(BIGINTTODATETIME(MAX(`AKHIRAKTIF`)),'%m/%d/%Y') as `AKHIRAKTIFMAX` FROM 01_tms_member;
	ELSEIF dimana2 = 10 THEN
		SELECT `NAMA`,`ALAMAT`,`TELEPON`,`FAX`,`POINT`,COALESCE(SUM(`NOMINAL`),0) as DEPOSIT,`NAMAFILE` FROM 01_tms_member as a left join 01_trs_barangkeluar as b on a.MEMBER_ID = B.FK_MEMBER left join 01_tms_memberdeposit as c on a.MEMBER_ID = c.MEMBER_ID WHERE A.`MEMBER_ID` = dimana3;
	END IF;
ELSEIF kondisi = 17 THEN
	if dimana2 = 1 THEN
		SELECT `KODEGRUP`, `JENIS`, `GRUP` FROM 01_tms_member_grup where `JENIS` = dimana1 AND KODEUNIKMEMBER = dimana10;
    elseif dimana2 = 2 THEN
		SELECT `KODEGRUP`, `JENIS`, `GRUP` FROM 01_tms_member_grup  WHERE KODEUNIKMEMBER = dimana10 group by JENIS;
	elseif dimana2 = 3 THEN
		SELECT `KODEGRUP`, `JENIS`, `GRUP` FROM 01_tms_member_grup WHERE KODEUNIKMEMBER = dimana10 AND (KODEGRUP LIKE CONCAT('%',DIMANA1,'%') OR JENIS LIKE CONCAT('%',DIMANA1,'%') OR GRUP LIKE CONCAT('%',DIMANA1,'%'));
	END IF;
ELSEIF kondisi = 18 THEN
	if dimana2 = 1 THEN
		SELECT `PK_IDPOIN`,`KODEMEMBER`,`POINT_SEBELUM`, `POINT_SESUDAH`, `TANGGAL`, A.`KETERANGAN` as KETERANGAN, `PETUGAS`, `NAMA`, `ALAMAT`, `TELEPON` FROM 01_tms_memberpoin AS A JOIN 01_tms_member AS B ON A.KODEMEMBER = B.MEMBER_ID where (KODEMEMBER LIKE CONCAT('%',dimana1,'%') or NAMA LIKE CONCAT('%',dimana1,'%') or PETUGAS LIKE CONCAT('%',dimana1,'%')) AND TANGGAL BETWEEN dimana3 AND dimana4  LIMIT datake, ditampilkan;
	elseif dimana2 = 2 THEN
		SELECT `TGLKELUAR` FROM 01_trs_barangkeluar;
	elseif dimana2 = 3 THEN
		SELECT `PK_IDPOIN` from 01_tms_memberpoin where KODEMEMBER = dimana1 order by PK_IDPOIN DESC LIMIT 1;
	elseif dimana2 = 4 THEN
		SELECT `PK_IDPOIN`,`KODEMEMBER`,`POINT_SEBELUM`, `POINT_SESUDAH`, `TANGGAL`, A.`KETERANGAN` as KETERANGAN, `PETUGAS`, `NAMA`, `ALAMAT`, `TELEPON` FROM 01_tms_memberpoin AS A JOIN 01_tms_member AS B ON A.KODEMEMBER = B.MEMBER_ID where PK_IDPOIN = dimana1;
	END IF;	
ELSEIF kondisi = 19 THEN
	if dimana2 = 1 THEN
	SELECT * FROM 01_tms_supplier where (`KODESUPPLIER` LIKE CONCAT('%',dimana3,'%') OR `NAMASUPPLIER` LIKE CONCAT('%',dimana3,'%')) AND KODEUNIKMEMBER = dimana10 ORDER BY NAMASUPPLIER ASC LIMIT datake, ditampilkan;
    elseif dimana2 = 2 THEN
    SELECT `SUPPLIER_AI`, `KODESUPPLIER`, `NAMASUPPLIER`, `PROVINSI`, `KOTAKAB`, `ALAMATSUPPLIER`, `NOTELP`, `NAMAPENANGGUNG`, `TGLDATANG`, `TGLDATANGLAST`, `NOREK`, `ATASNAMA`, `EMAIL` FROM 01_tms_supplier where SUPPLIER_AI = dimana1;
    END IF;
ELSEIF kondisi = 20 THEN
	if dimana2 = 1 THEN
	SELECT `KODESALES`, `NAMA`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`, `TELEPON`, `FAX`, `EMAIL`, `NOREK`, `PEMILIKREK`, `BANK`, `KETERANGAN` FROM 01_tms_sales where (`KODESALES` LIKE CONCAT('%',dimana3,'%') OR `NAMA` LIKE CONCAT('%',dimana3,'%') OR `ALAMAT` LIKE CONCAT('%',dimana3,'%') OR `KOTA` LIKE CONCAT('%',dimana3,'%')) AND KODEUNIKMEMBER = dimana1 LIMIT datake, ditampilkan;
elseif dimana2 = 2 THEN
    SELECT count(`KODESALES`) as TOTALSALES FROM 01_tms_sales;
    elseif dimana2 = 3 THEN
    SELECT `KODESALES`,`NAMA`, `ALAMAT`, `KOTA`, `PROVINSI`, `NEGARA`, `KODEPOS`, `TELEPON`, `FAX`, `EMAIL`, `NOREK`, `PEMILIKREK`, `BANK`, `KETERANGAN` FROM 01_tms_sales where `KODESALES` = dimana1;
    END IF;
ELSEIF kondisi = 21 THEN
	SELECT `NAMAVOUCHER`,`AWALAKTIF`,`AKHIRAKTIF`,`TIPEVOUCHER`,`NOMINALRUPIAH`,`NOMINALDISKON`,`BATASTRANSAKSI`,`MINIMALPEMBELIAN`,`OUTLET` FROM 01_tms_voucher WHERE NAMAVOUCHER LIKE CONCAT('%',dimana1,'%') AND KODEUNIKMEMBER = dimana10 LIMIT datake, ditampilkan;
ELSEIF kondisi = 22 THEN
	SELECT A.`BARANG_ID`, `NAMABARANG`,`MINBELITINGKAT1`, `DISCNONMEMBER1`, `DISCMEMBER1`, `MINBELITINGKAT2`, `DISCNONMEMBER2`, `DISCMEMBER2` FROM 01_tms_diskon as A JOIN 01_tms_barangkharisma as B ON A.BARANG_ID = B.BARANG_ID WHERE A.`BARANG_ID` LIKE CONCAT('%',dimana1,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana1,'%') LIMIT datake, ditampilkan;
ELSEIF kondisi = 23 THEN
	IF dimana1 = 1 THEN
		SELECT `PK_NOTAPENJUALAN`,SUM(`STOKBARANGKELUAR`) as TOTALBARANGKELUAR, `TGLKELUAR`, SUM(`HARGAJUAL`) as TOTALKELUAR FROM 01_trs_barangkeluar WHERE DATE(`TGLKELUAR`) BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() GROUP BY `PK_NOTAPENJUALAN`;
	ELSEIF dimana1 = 2 THEN
		SELECT 
        CASE
			WHEN dimana6 = 'Nota' THEN `PK_NOTAPENJUALAN`
            WHEN dimana6 = 'Lokasi' THEN `LOKASI`
            WHEN dimana6 = 'Petugas' THEN `KASIR`
            WHEN dimana6 = 'TOP' THEN `ENUM_TIPETRANSAKSI`
            WHEN dimana6 = 'Jenis' THEN `ENUM_JENISTRANSAKSI`
            WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`
            WHEN dimana6 = 'Nama Member' THEN `NAMA`
        END as HAVINGKOLOM,
        `PK_NOTAPENJUALAN`,`KASIR`,A.`FK_MEMBER`,`NAMA`, SUM(( IF(`MINBELI` > 0, COALESCE((TRUNCATE((STOKBARANGKELUAR) /(MINBELI + ADDSELF),0)) * MINBELI + MOD((STOKBARANGKELUAR), (MINBELI+ADDSELF)),0) * (A.HARGADASARGROSIR + (A.HARGADASARGROSIR * ( PPN/ 100))) , ((A.HARGADASARGROSIR + (A.HARGADASARGROSIR * ( PPN/ 100))) * (A.STOKBARANGKELUAR)) ) - A.DISKON) * ((100 + A.CASHBANK) / 100)) as TOTALTRANSAKSI, SUM(`STOKBARANGKELUAR`) as TOTALBARANGKELUAR, CONCAT(`TGLKELUAR`,' ',`WAKTU`) as `TGLKELUAR`, `ENUM_TIPETRANSAKSI`,`ENUM_JENISTRANSAKSI`,`LOKASI` FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B ON A.`FK_MEMBER` = B.`MEMBER_ID` 
        WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`LOKASI` = dimana10 AND (DATE(`TGLKELUAR`) BETWEEN dimana3 AND dimana4) GROUP BY `PK_NOTAPENJUALAN`
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `PK_NOTAPENJUALAN` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `PK_NOTAPENJUALAN` END DESC,
        CASE WHEN dimana2 = 'NAMAASC' THEN `NAMABARANG` END ASC,
        CASE WHEN dimana2 = 'NAMADESC' THEN `NAMABARANG` END DESC,
		CASE WHEN dimana2 = 'TGLASC' THEN `AI_TRANSAKSIKELUAR` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `AI_TRANSAKSIKELUAR` END DESC,
		CASE WHEN dimana2 = '' then `AI_TRANSAKSIKELUAR` END ASC
        LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 3 THEN
		SELECT 
        CASE
			WHEN dimana6 = 'Kode Barang' THEN `FK_BARANG`
            WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`
            WHEN dimana6 = 'Lokasi' THEN `LOKASI`
            WHEN dimana6 = 'Bulan' THEN MONTH(`TGLKELUAR`)
            WHEN dimana6 = 'Waktu' THEN `WAKTU`
        END as HAVINGKOLOM, `NAMA`,
        `PK_NOTAPENJUALAN`,`FK_BARANG`,`NAMABARANG`, `STOKBARANGKELUAR`,`HARGAJUALTIAP`,`HARGADASAR`, CONCAT(DATE_FORMAT(`TGLKELUAR`, "%d-%m-%Y"),' ',`WAKTU`) as WAKTU,`LOKASI` FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B  ON A.`FK_MEMBER` = B.`MEMBER_ID` WHERE A.`KODEUNIKMEMBER` = dimana9 AND `LOKASI` = dimana10 AND (DATE(`TGLKELUAR`) BETWEEN dimana3 AND dimana4) GROUP BY `PK_NOTAPENJUALAN`
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `PK_NOTAPENJUALAN` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `PK_NOTAPENJUALAN` END DESC,
        CASE WHEN dimana2 = 'NAMAASC' THEN `NAMABARANG` END ASC,
        CASE WHEN dimana2 = 'NAMADESC' THEN `NAMABARANG` END DESC,
        CASE WHEN dimana2 = 'TGLASC' THEN `AI_TRANSAKSIKELUAR` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `AI_TRANSAKSIKELUAR` END DESC,
		CASE WHEN dimana2 = '' then `AI_TRANSAKSIKELUAR` END ASC
        LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 4 THEN
		SELECT 
        CASE
			WHEN dimana6 = 'Nota' THEN `PK_NOTAPENJUALAN`
            WHEN dimana6 = 'Lokasi' THEN `LOKASI`
            WHEN dimana6 = 'Petugas' THEN `KASIR`
            WHEN dimana6 = 'TOP' THEN `ENUM_TIPETRANSAKSI`
            WHEN dimana6 = 'Jenis' THEN `ENUM_JENISTRANSAKSI`
            WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`
            WHEN dimana6 = 'Nama Member' THEN `NAMA`
        END as HAVINGKOLOM,
        `PK_NOTAPENJUALAN`,`KASIR`,`MEMBER_ID`,`NAMA`,`FK_SALESMAN`, SUM(A.`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)) as TOTALTRANSAKSI, SUM(`STOKBARANGKELUAR`) as TOTALBARANGKELUAR, DATE_FORMAT(`TGLKELUAR`,'%d-%m-%Y') as `TGLKELUAR`,DATE_FORMAT(`JATUHTEMPO`,'%d-%m-%Y') as `JATUHTEMPO`, `STATUS_LUNAS`,`LOKASI` FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B ON A.`FK_MEMBER` = B.`MEMBER_ID` 
        WHERE (`JATUHTEMPO` BETWEEN dimana3 AND dimana4) AND `ENUM_TIPETRANSAKSI` = 'KIRIM' AND `STATUS_LUNAS` = dimana7 GROUP BY `PK_NOTAPENJUALAN`
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `PK_NOTAPENJUALAN` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `PK_NOTAPENJUALAN` END DESC,
        CASE WHEN dimana2 = 'NAMAASC' THEN `NAMABARANG` END ASC,
        CASE WHEN dimana2 = 'NAMADESC' THEN `NAMABARANG` END DESC,
        CASE WHEN dimana2 = 'TGLASC' THEN `AI_TRANSAKSIKELUAR` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `AI_TRANSAKSIKELUAR` END DESC,
		CASE WHEN dimana2 = '' then `AI_TRANSAKSIKELUAR` END ASC
        LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 5 THEN
		SELECT `PK_PIUTANGKIRIM`,`PETUGAS`,`BAYAR`,DATE_FORMAT(`TANGGALBAYAR`,'%d-%m-%Y') as `TANGGALBAYAR`,DATE_FORMAT(`JATUHTEMPO`,'%d-%m-%Y') as `JATUHTEMPO`,`CABANG` FROM 01_trs_piutangkirim WHERE `NOFAKTURPENGIRIMAN` = dimana2 ORDER BY `PK_PIUTANGKIRIM` DESC;

	ELSEIF dimana1 = 6 THEN

		UPDATE 01_trs_barangkeluar SET `STATUS_LUNAS` = dimana3 WHERE `PK_NOTAPENJUALAN` = dimana2;

	ELSEIF dimana1 = 7 THEN

		SELECT A.`MEMBER_ID`,`NAMA`,`KASIR_ID`,`TOTALKREDIT`,`TOTALPOTONGAN`,`TANGGALPELUNASAN`,`TRANSAKSI_ID` FROM 01_tms_piutangkreditlunas as A JOIN 01_tms_member as B ON A.`MEMBER_ID` = B.`MEMBER_ID` WHERE (B.`NAMA` LIKE CONCAT('%',dimana2,'%') OR A.`TRANSAKSI_ID` LIKE CONCAT('%',dimana2,'%')) AND `TANGGALPELUNASAN` BETWEEN dimana3 AND dimana4  LIMIT datake, ditampilkan;

	ELSEIF dimana1 = 8 THEN
		IF dimana8 = "True" THEN
			SELECT *,COUNT(*) as ADADATA FROM 01_tms_barangkharisma WHERE `BARANG_ID` = dimana3 AND `KODEAKUN` = dimana9 AND `KODEUNIKMEMBER` = dimana10;
        ELSE
			SELECT `ISPROMO`,C.`NOTAPEMBELIAN`, `PK_NOTAPENJUALAN`,`FK_BARANG`,`KASIR`,A.`NAMABARANG`, A.`HARGAJUALTIAP`,A.`HARGADASAR`, `STOKBARANGKELUARRETUR` , DATE_FORMAT(`TGLKELUAR`,'%d-%m-%Y') as `TGLKELUAR`, `WAKTU`,`BAYAR`,`ENUM_TIPETRANSAKSI`,`ENUM_JENISTRANSAKSI`,`LOKASI`,`JENISPROMO` FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B ON A.`FK_MEMBER` = B.`MEMBER_ID` JOIN 01_trs_barangkeluarnota as C ON A.`PK_NOTAPENJUALAN` = C.`NOTAPENJUALAN` JOIN 01_tms_barangkharisma as D on A.`FK_BARANG` = D.`BARANG_ID`
        WHERE (`FK_BARANG` LIKE CONCAT('%',dimana3,'%') OR A.`NAMABARANG` LIKE CONCAT('%',dimana3,'%')) AND `PK_NOTAPENJUALAN` LIKE CONCAT('%',dimana4,'%') AND `FK_MEMBER` LIKE CONCAT('%',dimana5,'%') GROUP BY `PK_NOTAPENJUALAN`,`FK_BARANG`
        ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `PK_NOTAPENJUALAN` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `PK_NOTAPENJUALAN` END DESC,
        CASE WHEN dimana2 = 'NAMAASC' THEN A.`NAMABARANG` END ASC,
        CASE WHEN dimana2 = 'NAMADESC' THEN A.`NAMABARANG` END DESC,
		CASE WHEN dimana2 = 'TGLASC' THEN `AI_TRANSAKSIKELUAR` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `AI_TRANSAKSIKELUAR` END DESC,
		CASE WHEN dimana2 = '' then `AI_TRANSAKSIKELUAR` END ASC LIMIT 0,100;
        END IF;
	ELSEIF dimana1 = 9 THEN
		SELECT  `NOTRANSAKSI`,`NAMA`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALRETUR`),'%d-%m-%Y') as `TANGGALRETUR`,SUM(`JUMLAHBARANGRETUR`) as `JUMLAHBARANGRETUR`, SUM(`HARGABARANG` * `JUMLAHBARANGRETUR`- `DISKON`) as `HARGABARANG`,`PETUGAS`,A.`OUTLET` FROM 01_trs_returpenjualan as A JOIN 01_tms_member as B ON A.`NAMAPELANGGAN` = B.`MEMBER_ID` JOIN 01_tms_barangkharisma as C ON A.`KODEBARANGRETUR` = C.`BARANG_ID`
        WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`OUTLET` = dimana10 AND (`TANGGALRETUR` BETWEEN dimana3 AND dimana4) GROUP BY `NOTRANSAKSI` ORDER BY `TANGGALRETUR` DESC,
		CASE WHEN dimana2 = '' then `NOTRANSAKSI` END ASC LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 10 THEN
		SELECT `NOTAPEMBELIAN`,`NAMAPELANGGAN`,`NOTRANSAKSI`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALRETUR`),'%d-%m-%Y')  as `TANGGALRETUR`, `KODEBARANGRETUR`,`NAMABARANG`,`NAMA`,B.`HARGABELI`,`NOFAKTUR`,`HARGABARANG`,`JUMLAHBARANGASAL`,`JUMLAHBARANGRETUR`,A.`KETERANGAN`,`KESTOK`, `DISKON`,A.`JENIS` FROM 01_trs_returpenjualan as A JOIN 01_tms_barangkharisma as B ON A.`KODEBARANGRETUR` = B.`BARANG_ID` JOIN 01_tms_member as C ON A.`NAMAPELANGGAN` = C.`MEMBER_ID` WHERE `NOTRANSAKSI` = dimana2 AND `KODEAKUN` = dimana3 AND A.`KODEUNIKMEMBER` = dimana4;
	ELSEIF dimana1 = 11 THEN
		SELECT `ISPROMO`,C.`NOTAPEMBELIAN`, `PK_NOTAPENJUALAN`,`FK_BARANG`,`KASIR`,A.`NAMABARANG`, A.`HARGAJUALTIAP`,A.`HARGADASAR`, `STOKBARANGKELUAR`,DATE_FORMAT(`TGLKELUAR`,'%d-%m-%Y') as `TGLKELUAR`, `WAKTU`,`BAYAR`,`ENUM_TIPETRANSAKSI`,`ENUM_JENISTRANSAKSI`,`LOKASI`,`JENISPROMO` FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B ON A.`FK_MEMBER` = B.`MEMBER_ID` JOIN 01_trs_barangkeluarnota as C ON A.`PK_NOTAPENJUALAN` = C.`NOTAPENJUALAN` JOIN 01_tms_barangkharisma as D on A.`FK_BARANG` = D.`BARANG_ID`
         WHERE `FK_BARANG` = dimana3 AND `PK_NOTAPENJUALAN` = dimana4 AND `FK_MEMBER` = dimana5 GROUP BY `PK_NOTAPENJUALAN`,`FK_BARANG`
        ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `PK_NOTAPENJUALAN` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `PK_NOTAPENJUALAN` END DESC,
        CASE WHEN dimana2 = 'NAMAASC' THEN A.`NAMABARANG` END ASC,
        CASE WHEN dimana2 = 'NAMADESC' THEN A.`NAMABARANG` END DESC,
		CASE WHEN dimana2 = 'TGLASC' THEN `AI_TRANSAKSIKELUAR` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `AI_TRANSAKSIKELUAR` END DESC,
		CASE WHEN dimana2 = '' then `AI_TRANSAKSIKELUAR` END ASC LIMIT 0,2500;
    ELSEIF dimana1 = 16 THEN
		SELECT 
        CASE
			WHEN dimana6 = 'No Nota' THEN `NOTRANSAKSI`
            WHEN dimana6 = 'Nama Member' THEN `NAMA`
            WHEN dimana6 = 'Kode Barang' THEN `KODEBARANGRETUR`
            WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`
        END as HAVINGKOLOM,
        `NOTRANSAKSI`,`NAMA`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALRETUR`),'%d-%m-%Y') as `TANGGALRETUR`,SUM(`JUMLAHBARANGRETUR`) as `JUMLAHBARANGRETUR`, SUM(`HARGABARANG`) as `HARGABARANG`,`PETUGAS`,`OUTLET` FROM 01_trs_returpenjualan as A JOIN 01_tms_member as B ON A.`NAMAPELANGGAN` = B.`MEMBER_ID` JOIN 01_tms_barangkharisma as C ON A.`KODEBARANGRETUR` = C.`BARANG_ID`
        WHERE (`TANGGALRETUR` BETWEEN dimana3 AND dimana4) AND `KONSINYASI` = 'True' GROUP BY `NOTRANSAKSI`
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `NOTRANSAKSI` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `NOTRANSAKSI` END DESC,
        CASE WHEN dimana2 = 'NAMAASC' THEN `KODEBARANGRETUR` END ASC,
        CASE WHEN dimana2 = 'NAMADESC' THEN `KODEBARANGRETUR` END DESC,
		CASE WHEN dimana2 = 'TGLASC' THEN `TANGGALRETUR` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `TANGGALRETUR` END DESC,
		CASE WHEN dimana2 = '' then `NOTRANSAKSI` END ASC LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 17 THEN

		SELECT 

        CASE

			WHEN dimana6 = 'No Transaksi' THEN `NOTRANSAKSI`

            WHEN dimana6 = 'Petugas' THEN `PETUGAS`

            WHEN dimana6 = 'Jenis Barang Retur' THEN `NAMAKATEGORI`

        END as HAVINGKOLOM,

        `NOTRANSAKSI`, `TANGGALRETUR`, `PETUGAS`, `NAMAKATEGORI`, SUM(`JUMLAHBARANG`) as JUMLAHRETUR from 01_trs_returpembelian as a join 01_tms_barangkharisma as b on a.`KODE_BARANGRETUR` = b.`BARANG_ID` join 01_tms_kategori as c on b.`KATEGORI_ID` = c.`KATEGORIPARENT_ID`

        WHERE (`TANGGALRETUR` BETWEEN dimana3 AND dimana4) AND `KONSINYASI` = 'True' GROUP BY `NOTRANSAKSI`

        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY

        CASE WHEN dimana2 = 'KODEASC' THEN `NOTRANSAKSI` END ASC ,

		CASE WHEN dimana2 = 'KODEDESC' THEN `NOTRANSAKSI` END DESC,

        CASE WHEN dimana2 = 'KATASC' THEN `NAMAKATEGORI` END ASC,

        CASE WHEN dimana2 = 'KATDESC' THEN `NAMAKATEGORI` END DESC,

		CASE WHEN dimana2 = 'TGLASC' THEN `TANGGALRETUR` END ASC,

        CASE WHEN dimana2 = 'TGLDESC' THEN `TANGGALRETUR` END DESC,

		CASE WHEN dimana2 = '' then `NOTRANSAKSI` END ASC LIMIT datake, ditampilkan;

	ELSEIF dimana1 = 18 THEN

		SELECT 

        CASE

			WHEN dimana6 = 'Nama Member' THEN `NAMA`

            WHEN dimana6 = 'Nota' THEN `nota`

            WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`

            WHEN dimana6 = 'Token' THEN `token`

        END as HAVINGKOLOM,

        A.`nota`,DATE_FORMAT(BIGINTTODATETIME(A.`tgl_penjualan`),'%d-%m-%Y') AS tgl_penjualan ,A.`member_id`, B.`NAMA`,`pembayaran`, `token`, `status` as STATUSPEMBELIAN , (`harga_karisma` * `qty`) as TOTALBAYAR,`EMAIL` FROM 01_online_sales AS A JOIN 01_tms_member AS B ON A.`member_id` = B.`MEMBER_ID` JOIN 01_online_customer AS C ON A.`customer_id` = C.`customer_id` JOIN 01_tms_barangkharisma AS D ON A.`barang_id` = D.`BARANG_ID`

        WHERE `pembayaran` != "" AND (`tgl_penjualan` BETWEEN dimana3 AND dimana4) AND (`nota` LIKE CONCAT('%',dimana7,'%') OR `token` LIKE CONCAT('%',dimana7,'%')) AND `status` LIKE CONCAT('%',dimana8,'%')

        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY

        CASE WHEN dimana2 = 'KODEASC' THEN `tgl_penjualan` END ASC ,

		CASE WHEN dimana2 = 'KODEDESC' THEN `tgl_penjualan` END DESC,

        CASE WHEN dimana2 = 'NAMAASC' THEN `NAMA` END ASC,

        CASE WHEN dimana2 = 'NAMADESC' THEN `NAMA` END DESC,

		CASE WHEN dimana2 = 'TGLASC' THEN `tgl_penjualan` END ASC,

        CASE WHEN dimana2 = 'TGLDESC' THEN `tgl_penjualan` END DESC,

		CASE WHEN dimana2 = '' then `tgl_penjualan` END ASC

        LIMIT datake, ditampilkan;

	ELSEIF dimana1 = 19 THEN

		SELECT A.`KODEBARANG`, A.`NAMABARANG`,`QTY` FROM del_tbl as A JOIN sale as B ON A.`INV` = B.`sale_code` WHERE `INV` = dimana2; 

    END IF;

ELSEIF kondisi = 24 THEN
	IF dimana2 = 1 THEN
		SELECT `AI`, `TRANSAKSI_ID`,`NAMASUPPLIER`,`ALAMATSUPPLIER`,`NOTELP`,`NAMAPENANGGUNG`,`NOREK`,`ATASNAMA`,`EMAIL`,`TOTALKREDIT`,DATE_FORMAT(BIGINTTODATETIME(`TGLDATANG`),'%d-%m-%Y') as TGLDATANG,`KASIR_ID`,`BAYAR`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALBAYAR`),'%d-%m-%Y %H:%i:%s %p') as TANGGALBAYAR,DATE_FORMAT(BIGINTTODATETIME(`JATUHTEMPO`),'%d-%m-%Y') as JATUHTEMPO,`LOKASI` FROM 01_tms_hutangtoko as A JOIN 01_tms_supplier as B ON A.`SUPPLIER_ID` = B.`KODESUPPLIER` WHERE `TRANSAKSI_ID` = dimana1;
	ELSEIF dimana2 = 2 then
		SELECT 
        CASE
        /* DISABLED */
			WHEN dimana6 = 'No Transaksi' THEN `TRANSAKSI_ID`
            WHEN dimana6 = 'Nama Suplier' THEN `NAMASUPPLIER`
            WHEN dimana6 = 'Kode Suplier' THEN `KODESUPPLIER`
            WHEN dimana6 = 'Dari Kode Suplier' THEN `KODESUPPLIER`
        END as HAVINGKOLOM, (SELECT COALESCE(`BAYAR`,0) FROM 01_tms_hutangtoko WHERE `NOTARETURPOTONGHUTANG` = dimana3 LIMIT 1) as BAYARHUTANG , SUM(BAYAR) as ALIASBAYAR, `JATUHTEMPO` as TANGGALTRS, `SUPPLIER_ID`,`LOKASI`,`TRANSAKSI_ID`,`NAMASUPPLIER`,`TOTALKREDIT`,`KASIR_ID`,A.`KETERANGAN`,SUM(`BAYAR`) as BAYAR,DATE_FORMAT(BIGINTTODATETIME(`TANGGALBAYAR`),'%d-%m-%Y') as TANGGALBAYAR,DATE_FORMAT(BIGINTTODATETIME(A.`JATUHTEMPO`),'%d-%m-%Y') as JATUHTEMPO,A.`STATUSLUNAS` FROM 01_tms_hutangtoko as A 
        JOIN 01_tms_supplier as B ON A.`SUPPLIER_ID` = B.`KODESUPPLIER` 
        WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`LOKASI` = dimana10 AND 
        CASE
			WHEN dimana4 = "0" THEN  `NOTARETURPOTONGHUTANG` = dimana3 
            WHEN dimana4 != "0" THEN  "" = ""
        END
        AND
        CASE
			WHEN dimana5 = "true" THEN  A.`JATUHTEMPO` <= dimana4 
            WHEN dimana5 = "false" THEN (`TANGGALBAYAR` BETWEEN dimana3 AND dimana4)
            WHEN dimana5 = "potong" THEN `TANGGALBAYAR` > 0
        END
        GROUP BY `TRANSAKSI_ID` HAVING 
        CASE
			WHEN dimana6 = "Dari Kode Suplier" THEN HAVINGKOLOM = dimana1
            WHEN dimana6 != "Dari Kode Suplier" THEN HAVINGKOLOM LIKE CONCAT('%',dimana1,'%')
        END
        AND IF(dimana7 = "FALSE",ALIASBAYAR != TOTALKREDIT, ALIASBAYAR = TOTALKREDIT)
        ORDER BY
        CASE WHEN dimana8 = 'TID' THEN `TRANSAKSI_ID` END ASC ,
		CASE WHEN dimana8 = 'TIDD' THEN `TRANSAKSI_ID` END DESC,
        CASE WHEN dimana8 = 'NAMAASC' THEN `NAMASUPPLIER` END ASC,
        CASE WHEN dimana8 = 'NAMADESCD' THEN `NAMASUPPLIER` END DESC,
		CASE WHEN dimana8 = 'TGLBYR' THEN A.`JATUHTEMPO` END ASC,
        CASE WHEN dimana8 = 'TGLBYRD' THEN A.`JATUHTEMPO` END DESC,
        CASE WHEN dimana8 = 'TGLBAYAR' THEN `TANGGALBAYAR` END ASC,
        CASE WHEN dimana8 = 'TGLBAYARD' THEN `TANGGALBAYAR` END DESC,
        CASE WHEN dimana8 = '' THEN `TANGGALBAYAR` END DESC LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 3 THEN
		UPDATE 01_trs_barangmasuk SET `STATUSLUNAS` = dimana3 WHERE `NOTA` = dimana1;
	ELSEIF dimana2 = 4 THEN
        IF dimana8 = "True" THEN
			IF dimana7 = "RETUR" THEN
				SELECT SUM(`RETUR`) INTO KELUARSTOK FROM 01_bnt_retur WHERE `KODEBARANG` = dimana1 AND `OUTLET` = dimana5 AND `KODEUNIKMEMBER` = dimana6;
			ELSEIF dimana7 = "GUDANG" THEN
				SELECT SUM(`GUDANG`) INTO KELUARSTOK FROM 01_bnt_gudang WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana5 AND `KODEUNIKMEMBER` = dimana6;
			ELSEIF dimana7 = "DISPLAY" THEN
				SELECT SUM(`DISPLAY`) INTO KELUARSTOK FROM 01_bnt_display WHERE `KODEBARANG` = dimana1 AND `OUTLET` = dimana5 AND `KODEUNIKMEMBER` = dimana6;
			END IF;
			SELECT *,COUNT(*) as ADADATA,COALESCE(KELUARSTOK,0) as RETUR FROM 01_tms_barangkharisma WHERE `BARANG_ID` = dimana1 AND `KODEAKUN` = dimana5 AND `KODEUNIKMEMBER` = dimana6;
        ELSE
			SELECT TOP,
            CASE
				WHEN dimana7 = "RETUR" THEN (SELECT COALESCE(SUM(`RETUR`),0) FROM 01_bnt_retur WHERE `KODEBARANG` = Z.KODEBARANG AND `OUTLET` = dimana5 AND `KODEUNIKMEMBER` = dimana6)
				WHEN dimana7 = "GUDANG" THEN (SELECT SUM(`GUDANG`) FROM 01_bnt_gudang WHERE `BARANG_ID` = Z.KODEBARANG  AND `OUTLET` = dimana5 AND `KODEUNIKMEMBER` = dimana6)
				WHEN dimana7 = "DISPLAY" THEN (SELECT SUM(`DISPLAY`) FROM 01_bnt_display WHERE `KODEBARANG` = Z.KODEBARANG  AND `OUTLET` = dimana5 AND `KODEUNIKMEMBER` = dimana6)
			END as RETUR,
            Z.NOTA,DATE_FORMAT(BIGINTTODATETIME(TANGGALTRS),'%d-%m-%Y %H:%i:%s') AS TANGGALTRS,Z.KODEBARANG,NAMABARANG,JUMLAHBELI,Z.HARGABELI,HARGANETT,NAMASUPPLIER FROM 01_trs_barangmasuk as Z JOIN 01_tms_barangkharisma as A ON Z.KODEBARANG = A.BARANG_ID JOIN
 01_tms_supplier as C ON Z.FK_SUPPLIER = C.KODESUPPLIER WHERE `KODEAKUN` = dimana5 AND Z.`KODEUNIKMEMBER` = dimana6 AND Z.NOTA = dimana3 AND Z.KODEBARANG LIKE CONCAT('%',dimana1,'%')  ORDER BY Z.TANGGALTRS DESC;
        END IF;
	ELSEIF dimana2 = 5 THEN
		SELECT 
        CASE
			WHEN dimana6 = 'Kode Suplier' THEN A.`KODESUPLIER`
			WHEN dimana6 = 'Nama Suplier' THEN `NAMASUPPLIER`
            WHEN dimana6 = 'Faktur Retur' THEN  A.`NOTRANSAKSI`
            WHEN dimana6 = 'Faktur Beli' THEN A.`NOFAKTUR`
        END as HAVINGKOLOM,
        A.`NOTRANSAKSI`,`DARIKOLOM`,`NAMASUPPLIER`,ROUND((SUM(`JUMLAHBARANG` * `HARGABARANG`) - SUM(`POTONGAN`)) + ((`PAJAK` / 100) * (SUM(`JUMLAHBARANG` * `HARGABARANG`) - SUM(`POTONGAN`))),2) as NOMINALRETUR,DATE_FORMAT(BIGINTTODATETIME(A.`TANGGALRETUR`),'%d-%m-%Y %H:%i:%s %p') AS TANGGALRETUR,A.`PETUGAS`,COUNT(`PK_RETURPEMBELIAN`) as JENISBARANG,SUM(`JUMLAHBARANG`) as TOTALBARANG FROM 01_trs_returpembelian as A JOIN 01_tms_supplier as B ON A.`KODESUPLIER` = B.`KODESUPPLIER` WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`IDCABANG` = dimana10 AND  (A.`TANGGALRETUR` BETWEEN dimana3 AND dimana4) GROUP BY A.`NOTRANSAKSI` HAVING HAVINGKOLOM LIKE CONCAT('%',dimana1,'%') ORDER BY A.`TANGGALRETUR` DESC LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 6 THEN
		SELECT A.`NOTRANSAKSI`,A.`TUNAI`,`DARIKOLOM`,A.`POTONGAN`,A.`PAJAK`,`NOFAKTUR`,DATE_FORMAT(BIGINTTODATETIME(A.`TANGGALRETUR`),'%d-%m-%Y') AS TANGGALRETUR, `KODE_BARANGRETUR`, `NAMABARANG`,`NAMASUPPLIER`,`KODESUPLIER`,`HARGABARANG`, `STOKSEBELUM`, `JUMLAHBARANG`,A.`KETERANGAN`,`JENISPEMBAYARAN` FROM 01_trs_returpembelian as A 
        JOIN 01_tms_supplier as C ON A.`KODESUPLIER` = C.`KODESUPPLIER` 
        JOIN 01_tms_barangkharisma as D ON A.`KODE_BARANGRETUR` = D.`BARANG_ID` WHERE `NOTRANSAKSI` = dimana1 AND `KODEAKUN` = dimana3;
	ELSEIF dimana2 = 11 THEN
		SELECT 
		`PK_BARANGMASUK`,Z.`NOTA`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRS`),'%d-%m-%Y %H:%i:%s') AS `TANGGALTRS`,Z.`KODEBARANG`,`NAMABARANG`,`JUMLAHBELI`,Z.`HARGABELI`,`HARGANETT`,`FK_SUPPLIER`, `NAMASUPPLIER`,COALESCE(SUM(`JUMLAHBELI`),0) as RETUR FROM 01_trs_barangmasuk as Z 
		JOIN 01_tms_barangkharisma as A ON Z.`KODEBARANG` = A.`BARANG_ID` 
		JOIN 01_tms_supplier as C ON Z.`FK_SUPPLIER` = C.`KODESUPPLIER`
        WHERE `KONSINYASI` = 'True' AND Z.`NOTA` LIKE CONCAT('%',dimana3,'%') AND (`NAMABARANG`LIKE CONCAT('%',dimana1,'%') OR Z.`KODEBARANG` LIKE CONCAT('%',dimana1,'%')) AND `NAMASUPPLIER` = dimana4 GROUP BY `NOTA`,Z.`KODEBARANG`ORDER BY Z.`TANGGALTRS` DESC LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 12 THEN
		SELECT COALESCE(SUM(`BAYAR`),0) INTO RETURVARLAWAS FROM 01_tms_hutangtoko WHERE (`TANGGALBAYAR` BETWEEN dimana3 AND dimana4) AND `BAYAR` > 0 AND `AKUN_ID` = '0';
        SELECT COALESCE(SUM(`BAYAR`),0) INTO RETURHASIL FROM 01_tms_hutangtoko WHERE (`TANGGALBAYAR` BETWEEN dimana3 AND dimana4) AND `BAYAR` > 0 AND `AKUN_ID` = '1';
		SELECT RETURVARLAWAS,RETURHASIL,CASE WHEN dimana6 = 'No Transaksi' THEN `TRANSAKSI_ID` WHEN dimana6 = 'Nama Suplier' THEN `NAMASUPPLIER` END as HAVINGKOLOM,
        A.`NOTRANSAKSI`,A.`SUPPLIER_ID`,`NAMASUPPLIER`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALBAYAR`),'%d-%m-%Y %h:%i:%s %p') as TANGGALBAYAR ,SUM(`BAYAR`) as BAYAR,`KASIR_ID`,`KETERANGAN`,`VARIFIKASINOTA` FROM 01_tms_hutangtoko as A JOIN 01_tms_supplier as B ON A.`SUPPLIER_ID` = B.`KODESUPPLIER` WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`LOKASI` = dimana10 AND `NOTARETURPOTONGHUTANG` = "Bukan Potong Hutang" AND (`TANGGALBAYAR` BETWEEN dimana3 AND dimana4) AND `BAYAR` > 0 GROUP BY A.`NOTRANSAKSI` HAVING HAVINGKOLOM LIKE CONCAT('%',dimana1,'%') ORDER BY `TANGGALBAYAR` DESC LIMIT datake, ditampilkan;
	END IF;

ELSEIF kondisi = 25 THEN
	IF dimana1 = 1 THEN
		SELECT 
        CASE
			WHEN dimana6 = 'No Transaksi' THEN `NOSTOKOPNAME`
            WHEN dimana6 = 'Kode Barang' THEN `KODEBARANG`
            WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`
        END as HAVINGKOLOM, 
        `NOSTOKOPNAME`,`PETUGAS`, `KODEBARANG`, `NAMABARANG`, COUNT(`NAMABARANG`) as TOTALITEM, DATE_FORMAT(BIGINTTODATETIME(`TGLTRANSAKSI`),'%d-%m-%Y %h:%i:%s %p') as `TGLTRANSAKSI`, `OUTLET`, SUM(`NILAIOPNAME`) as NILAIOPNAME, SUM(`STOKSEBELUM`) as STOKSEBELUM, SUM(`NILAIOPNAME`) - SUM(`STOKSEBELUM`) as SELISIH, `KETERANGAN` FROM 01_trs_opname  as a JOIN 01_tms_barangkharisma as b on a.`KODEBARANG` = b.`BARANG_ID`
        WHERE (`TGLTRANSAKSI` BETWEEN dimana3 AND dimana4) AND a.`OUTLET` = dimana7 AND b.`KODEAKUN` = dimana7 AND a.`KODEUNIKMEMBER` = dimana9 GROUP BY `NOSTOKOPNAME`
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `NOSTOKOPNAME` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `NOSTOKOPNAME` END DESC,
        CASE WHEN dimana2 = 'NAMAASC' THEN `KODEBARANG` END ASC,
        CASE WHEN dimana2 = 'NAMADESC' THEN `KODEBARANG` END DESC,
		CASE WHEN dimana2 = 'TGLASC' THEN `TGLTRANSAKSI` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `TGLTRANSAKSI` END DESC,
		CASE WHEN dimana2 = '' then `NOSTOKOPNAME` END ASC LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 2 THEN
		SELECT A.`BARANG_ID`, `NAMABARANG`, `KATEGORI_ID`,`HARGAJUAL`, CASE
			WHEN dimana3 = 'DISPLAY' THEN COALESCE(SUM(`DISPLAY`),0)
			WHEN dimana3 = 'GUDANG' THEN COALESCE(SUM(`GUDANG`),0)
			WHEN dimana3 = 'ONLINE' THEN COALESCE(SUM(`ONLINE`),0)
            WHEN dimana3 = 'RETUR' THEN COALESCE(SUM(`RETUR`),0)
		END 
		as DISPLAY FROM 01_tms_barangkharisma as A 
		LEFT JOIN 01_bnt_display as B ON A.BARANG_ID = B.KODEBARANG
		LEFT JOIN 01_bnt_gudang as D ON A.BARANG_ID = D.BARANG_ID
		LEFT JOIN 01_bnt_online as E on A.BARANG_ID = E.KODEBARANG
		LEFT JOIN 01_bnt_retur as F on A.BARANG_ID = F.KODEBARANG
		WHERE A.`KATEGORI_ID` LIKE CONCAT('%',dimana2,'%') AND A.`KODEUNIKMEMBER` = dimana4 AND `KODEAKUN` = dimana5 GROUP BY A.`BARANG_ID` ORDER BY `NAMABARANG`;
	ELSEIF dimana1 = 3 THEN
		SELECT 
		CASE
			WHEN dimana6 = 'Kode Barang' THEN `KODEBARANG`
			WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`
		END as HAVINGKOLOM,`KOMPUTERSEMENTARA`, `KODEBARANG`, `NAMABARANG`, IF(dimana7 = 'LIST',`NILAIOPNAME`,SUM(`NILAIOPNAME`)) as NILAIOPNAME,
		CASE
			WHEN `NAMAKOLOM` = 'DISPLAY' THEN `STOKDISPLAY`
            WHEN `NAMAKOLOM` = 'RETUR' THEN `STOKGUDANG`
            WHEN `NAMAKOLOM` = 'ONLINE' THEN `STOKONLINE`
            WHEN `NAMAKOLOM` = 'GUDANG' THEN `STOKGUDANG`
		END as STOKSEKARANG, `NAMAKOLOM`,IF(dimana7 = 'LIST',`RAK`,GROUP_CONCAT(`RAK` SEPARATOR ',')) as RAK,DATE_FORMAT(BIGINTTODATETIME(`TGLTRANSAKSI`),'%d-%m-%Y %H:%i:%s') as TGLTRANSAKSI, `TGLTRANSAKSI` as TGLTRANSAKSIASLI,`SISASTOK`, `KETERANGAN`,B.`HARGABELI` FROM 01_trs_opnamesementara  as A JOIN 01_tms_barangkharisma as B on A.`KODEBARANG` = B.`BARANG_ID` WHERE `NAMAKOLOM` = dimana2 AND A.`OUTLET` = dimana3 AND `KODEAKUN` = dimana3 
        GROUP BY  
        CASE 
            WHEN dimana7 = 'GROUP' THEN `KODEBARANG`
            WHEN dimana7 = 'LIST' THEN A.`AI`
		END HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') AND 
        CASE
			WHEN dimana8 = '!' THEN STOKSEKARANG > -1
            WHEN dimana8 = '=' THEN IF(`KOMPUTERSEMENTARA` = -1, SISASTOK = STOKSEKARANG, SISASTOK = `KOMPUTERSEMENTARA`)
            WHEN dimana8 = '>' THEN IF(`KOMPUTERSEMENTARA` = -1, SISASTOK > STOKSEKARANG, SISASTOK > `KOMPUTERSEMENTARA`)
            WHEN dimana8 = '<' THEN IF(`KOMPUTERSEMENTARA` = -1, SISASTOK < STOKSEKARANG, SISASTOK < `KOMPUTERSEMENTARA`)
        END;
	ELSEIF dimana1 = 4 THEN
		SELECT 
        CASE
			WHEN dimana6 = 'No Transaksi' THEN `NOSTOKOPNAME`
            WHEN dimana6 = 'Kode Barang' THEN `KODEBARANG`
            WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`
            WHEN dimana6 = 'Lokasi Stok' THEN `NAMAKOLOM`
        END as HAVINGKOLOM, `KODEBARANG`,
        `NOSTOKOPNAME`, `NAMABARANG`, DATE_FORMAT(BIGINTTODATETIME(`TGLTRANSAKSI`),'%d-%m-%Y') as `TGLTRANSAKSI`, `OUTLET`, `NILAIOPNAME`, `STOKSEBELUM`, (`NILAIOPNAME` - `STOKSEBELUM`) as SELISIH, `KETERANGAN` FROM 01_trs_opname  as a JOIN 01_tms_barangkharisma as b on a.`KODEBARANG` = b.`BARANG_ID`
        WHERE `NOSTOKOPNAME` = dimana3 AND b.`KODEAKUN` = dimana7
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `NOSTOKOPNAME` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `NOSTOKOPNAME` END DESC,
        CASE WHEN dimana2 = 'NAMAASC' THEN `KODEBARANG` END ASC,
        CASE WHEN dimana2 = 'NAMADESC' THEN `KODEBARANG` END DESC,
		CASE WHEN dimana2 = 'TGLASC' THEN `TGLTRANSAKSI` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `TGLTRANSAKSI` END DESC,
		CASE WHEN dimana2 = '' then `NOSTOKOPNAME` END ASC LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 5 THEN
		SELECT 
        `NOSTOKOPNAME`,`SATUAN`, `KODEBARANG`, `NAMABARANG`, DATE_FORMAT(BIGINTTODATETIME(`TGLTRANSAKSI`),'%d-%m-%Y') as `TGLTRANSAKSI`, `OUTLET`, `NILAIOPNAME`, `STOKSEBELUM` , (`NILAIOPNAME` - `STOKSEBELUM`) as SELISIH, `KETERANGAN` FROM 01_trs_opname  as a JOIN 01_tms_barangkharisma as b on a.`KODEBARANG` = b.`BARANG_ID`
        WHERE a.`OUTLET` = dimana7 AND a.`KODEUNIKMEMBER` = dimana9 AND (`TGLTRANSAKSI` BETWEEN dimana3 AND dimana4) ORDER BY `TGLTRANSAKSI` ASC LIMIT datake, ditampilkan;
	END IF;
ELSEIF kondisi = 26 THEN
	IF dimana1 = 1 THEN
		 IF dimana3 = 'DISPLAY' THEN 
			SELECT SUM(`DISPLAY`) as DISPLAY, A.`BARANG_ID`, `NAMABARANG`, `KATEGORI_ID` FROM 01_tms_barangkharisma as A JOIN 01_bnt_display as B ON A.BARANG_ID = B.KODEBARANG WHERE A.`BARANG_ID` = dimana2 AND `OUTLET` = dimana4 AND `KODEAKUN` = dimana6;
		ELSEIF dimana3 = 'GUDANG' THEN 
			SELECT SUM(`GUDANG`) as DISPLAY, A.`BARANG_ID`, `NAMABARANG`, `KATEGORI_ID` FROM 01_tms_barangkharisma as A JOIN 01_bnt_gudang as B ON A.BARANG_ID = B.BARANG_ID WHERE A.`BARANG_ID` = dimana2 AND `OUTLET` = dimana4 AND `KODEAKUN` = dimana6;
		ELSEIF dimana3 = 'ONLINE' THEN
			SELECT SUM(`ONLINE`) as DISPLAY, A.`BARANG_ID`, `NAMABARANG`, `KATEGORI_ID` FROM 01_tms_barangkharisma as A JOIN 01_bnt_online as B on A.BARANG_ID = B.KODEBARANG WHERE A.`BARANG_ID` = dimana2 AND `OUTLET` = dimana4 AND `KODEAKUN` = dimana6;
		ELSEIF dimana3 = 'RETUR' THEN
			SELECT SUM(`RETUR`) as DISPLAY, A.`BARANG_ID`, `NAMABARANG`, `KATEGORI_ID` FROM 01_tms_barangkharisma as A JOIN 01_bnt_retur as B on A.BARANG_ID = B.KODEBARANG WHERE A.`BARANG_ID` = dimana2 AND `OUTLET` = dimana4 AND `KODEAKUN` = dimana6;
		END IF;
	END IF;
ELSEIF kondisi = 27 THEN
	IF dimana1 = 1 THEN
		SELECT 
        CASE
			WHEN dimana6 = 'No Transaksi' THEN `PK_MUTASI`
            WHEN dimana6 = 'Kode Barang' THEN `FK_BARANG`
            WHEN dimana6 = 'Nama Barang' THEN `NAMABARANG`
        END as HAVINGKOLOM,
        `PK_MUTASI`,`ASALOUTLET`,`KEOUTLET`, `ASAL`, `TUJUAN`, SUM(`JUMLAH`) as JUMLAH, DATE_FORMAT(BIGINTTODATETIME(`TANGGAL_MUTASI`),'%d-%m-%Y') as `TANGGAL_MUTASI`, `PETUGAS` from 01_trs_mutasibarang as a join 01_tms_barangkharisma as b on a.`FK_BARANG` = b.`BARANG_ID`
        WHERE a.`ASALOUTLET` = dimana7 AND a.`KODEUNIKMEMBER` = dimana9 AND (`TANGGAL_MUTASI` BETWEEN dimana3 AND dimana4) AND `KODEAKUN` = dimana7 GROUP BY `PK_MUTASI`
        HAVING HAVINGKOLOM LIKE CONCAT('%',dimana5,'%') ORDER BY
        CASE WHEN dimana2 = 'KODEASC' THEN `PK_MUTASI` END ASC ,
		CASE WHEN dimana2 = 'KODEDESC' THEN `PK_MUTASI` END DESC,
		CASE WHEN dimana2 = 'TGLASC' THEN `TANGGAL_MUTASI` END ASC,
        CASE WHEN dimana2 = 'TGLDESC' THEN `TANGGAL_MUTASI` END DESC,
		CASE WHEN dimana2 = '' then `PK_MUTASI` END ASC LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 2 THEN
		SELECT `ASALOUTLET`,`KEOUTLET`,`PK_MUTASI`,`FK_BARANG`,`NAMABARANG`,`ASAL`,`TUJUAN`,`JUMLAH`,`TANGGAL_MUTASI`,`PETUGAS`,`STOKSEBELUM`,`KATEGORI` FROM 01_trs_mutasibarang AS A JOIN 01_tms_barangkharisma AS B ON A.`FK_BARANG` =  B.`BARANG_ID` WHERE `PK_MUTASI` = dimana2 AND `KODEAKUN` = dimana3;
    END IF;
ELSEIF kondisi = 28 THEN
	IF dimana1 = 1 THEN
		SELECT `AKUNID`,`NAMAPERKIRAAN`,`DEBIT`,`KREDIT` FROM 01_akun_grup WHERE `PARENTID` = '0';
	ELSEIF dimana1 = 0 THEN
		SELECT `AKUNID`,`NAMAPERKIRAAN`,`JENIS`FROM 01_akun_grup WHERE (`AKUNID` LIKE CONCAT('%',dimana2,'%') OR `NAMAPERKIRAAN`LIKE CONCAT('%',dimana2,'%')) AND `AKUNID` LIKE CONCAT('%',dimana3,'%') AND `KODEUNIKMEMBER` = dimana4 ORDER BY AKUNID ASC;
	ELSEIF dimana1 = 2 THEN
		SELECT `AKUNID`,`NAMAPERKIRAAN`,`JENIS` FROM 01_akun_grup WHERE `KODEUNIKMEMBER` = dimana9 AND`OUTLET` = dimana10 AND (`AKUNID` LIKE CONCAT(dimana2,'%') OR `PARENTID` LIKE CONCAT(dimana2,'%')) AND `TIPE` = 'D' ORDER BY `AKUNID`;
	ELSEIF dimana1 = 3 THEN
		SELECT `AKUNID`,`NAMAPERKIRAAN` INTO STRING1,STRING2 FROM 01_akun_grup WHERE `AKUNID` LIKE CONCAT(SUBSTRING(dimana2, 0, 2),'%') AND `PARENTID` = '0' LIMIT 1;
		SELECT A.`AKUNID`,A.`NAMAPERKIRAAN`,A.`DEBIT`,A.`KREDIT`,A.`KASBANK`,A.`TIPE`,A.`KASBANK`,A.`TIPE`,COALESCE(B.`AKUNID`,0) AS AKUNIDA, COALESCE(B.`NAMAPERKIRAAN`,0) AS NAMAPERKIRAANA, STRING1, STRING2  FROM 01_akun_grup as A LEFT JOIN 01_akun_grup as B ON A.`PARENTID` = B.`AKUNID` WHERE A.`AKUNID` = dimana2;
	ELSEIF dimana1 = 4 THEN
		SELECT `AKUNID`,`NAMAPERKIRAAN` FROM 01_akun_grup WHERE `KASBANK` = true;
	ELSEIF dimana1 = 5 THEN
		SELECT A.`NOTRANSAKSI`,A.`AI`, DATE_FORMAT(BIGINTTODATETIME(`TGLTRANSAKSI`),'%d-%m-%Y %H:%i:%s') as `TGLTRANSAKSI`,DATE_FORMAT(BIGINTTODATETIME(`TGLJURNAL`),'%d-%m-%Y %H:%i:%s') as `TGLJURNAL`,`KODEACC`,`NAMAPERKIRAAN`,`KETERANGAN`,A.`DEBET`,A.`KREDIT` FROM 01_akun_jurnalumum as A JOIN 01_akun_grup as B ON A.`KODEACC` = B.`AKUNID` WHERE B.`KODEUNIKMEMBER` = dimana9 AND B.`OUTLET` = dimana10 AND (`NOTRANSAKSI` LIKE CONCAT('%',dimana2,'%') OR `KETERANGAN` LIKE CONCAT('%',dimana2,'%') OR `NAMAPERKIRAAN` LIKE CONCAT('%',dimana2,'%') OR `KODEACC` LIKE CONCAT('%',dimana2,'%')) AND `TIPEINPUT` LIKE CONCAT('%',dimana3,'%') AND (`TGLTRANSAKSI` BETWEEN dimana4 AND dimana5) 
        ORDER BY
        CASE WHEN dimana6 = 'ASCKODE' THEN A.`NOTRANSAKSI` END ASC ,
		CASE WHEN dimana6 = 'DESCKODE' THEN A.`NOTRANSAKSI` END DESC,
		CASE WHEN dimana6 = 'ASCNAMAAKUN' THEN `NAMAPERKIRAAN` END ASC,
        CASE WHEN dimana6 = 'DESCNAMAAKUN' THEN `NAMAPERKIRAAN` END DESC,
        CASE WHEN dimana6 = 'ASCTGL' THEN `TGLJURNAL` END DESC,
        CASE WHEN dimana6 = 'DESCTGL' THEN `TGLJURNAL` END DESC,
        CASE WHEN dimana6 = '' THEN A.`AI` END DESC
        LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 6 THEN
		SELECT A.`JENIS`,A.`KODEAKUN`,`NAMAPERKIRAAN` FROM 01_akun_settingdasar as A JOIN 01_akun_grup as B ON A.`KODEAKUN` = B.`AKUNID` WHERE A.`JENIS` = dimana2;
	ELSEIF dimana1 = 7 THEN
		SELECT COALESCE(SUM(`DEBET`),0) AS TOTALSALDO, COALESCE(SUM(`KREDIT`),0) AS TOTALKREDIT FROM 01_akun_jurnalumum WHERE `KODEACC` = dimana2;
	ELSEIF dimana1 = 8 THEN
		SELECT `AKUNID`,`NAMAPERKIRAAN` FROM 01_akun_grup WHERE `KASBANK` = dimana2;
	ELSEIF dimana1 = 9 THEN
		SELECT 
        CASE
			WHEN dimana2 = 'Kode Transaksi' THEN `NOTRANSAKSI`
            WHEN dimana2 = 'Nama Perkiraan' THEN `NAMAPERKIRAAN`
            WHEN dimana2 = 'Kode Akun' THEN `KODEACC`
            WHEN dimana2 = 'Keterangan' THEN `KETERANGAN`
        END as HAVINGKOLOM,
        `NOTRANSAKSI`,`TGLTRANSAKSI`,`TIPEINPUT`,`KODEACC`,`NAMAPERKIRAAN`,`KETERANGAN`,`KASAL`,`KTUJUAN`
        FROM 01_akun_jurnalumum as A JOIN 01_akun_grup as B ON A.`KODEACC` = B.`AKUNID`
        WHERE 
        CASE
			WHEN dimana3 != "SEMUA" THEN `TIPEINPUT` = dimana3
            WHEN dimana3 = "SEMUA" THEN `TIPEINPUT` LIKE '%KAS%'
        END     
        AND `TGLJURNAL` BETWEEN dimana4 AND dimana5 HAVING HAVINGKOLOM LIKE CONCAT('%',dimana6,'%') ORDER BY `TGLTRANSAKSI` DESC LIMIT datake, ditampilkan;		
	ELSEIF dimana1 = 10 THEN
		SELECT A.`NOTRANSAKSI`,A.`AI`, DATE_FORMAT(BIGINTTODATETIME(`TGLTRANSAKSI`),'%Y-%m-%d') as `TGLTRANSAKSI`,`LOKASI`,`KODEACC`,`NAMAPERKIRAAN`,`KETERANGAN`,A.`DEBET`,A.`KREDIT` FROM 01_akun_jurnalumum as A JOIN 01_akun_grup as B ON A.`KODEACC` = B.`AKUNID` WHERE B.`OUTLET` = dimana6 AND (A.`NOTRANSAKSI` LIKE CONCAT('%',dimana4,'%') OR `KETERANGAN` LIKE CONCAT('%',dimana4,'%')) AND (`TGLTRANSAKSI` BETWEEN dimana2 AND dimana3) AND A.`KODEUNIKMEMBER` = dimana5 AND A.`LOKASI` = dimana6 AND A.`TIPEINPUT` = 'MANUAL';
	ELSEIF dimana1 = 11 THEN
		UPDATE 01_trs_barangmasuk SET `NOTA` = dimana2 WHERE `NOTA` = dimana4 AND `KODEUNIKMEMBER` = dimana3;
        UPDATE 01_bnt_gudang SET `NOTAPEMBELIAN`= dimana2 WHERE `NOTAPEMBELIAN` = dimana4  AND `KODEUNIKMEMBER` = dimana3;
		UPDATE 01_trs_barangmasukqty SET `NOTAPEMBELIAN`= dimana2 WHERE `NOTAPEMBELIAN` = dimana4 AND `KODEUNIKMEMBER` = dimana3;
        UPDATE 01_akun_jurnalumum SET `NOTRANSAKSI` = dimana2 WHERE `NOTRANSAKSI` = dimana4 AND `KODEUNIKMEMBER` = dimana3;
    END IF;
ELSEIF kondisi = 29 THEN
	IF dimana1 = 1 THEN
		SELECT 
        CASE
			WHEN dimana2 = 'Kode Member' THEN A.`MEMBER_ID`
            WHEN dimana2 = 'Nama Member' THEN A.`NAMA`
            WHEN dimana2 = 'Username' THEN `USERNAME`
            WHEN dimana2 = 'Alamat' THEN A.`ALAMAT`
            WHEN dimana2 = 'Telepon' THEN `TELEPON`
            WHEN dimana2 = 'Jenis' THEN A.`JENIS`
        END as HAVINGKOLOM,
		A.`MEMBER_ID`,A.`NAMA`,`TELEPON`,A.`ALAMAT`, SUM(`NOMINAL`) as SALDO, `POINT` FROM 01_tms_member as A JOIN 01_tms_memberdeposit as B ON A.`MEMBER_ID` = B.`MEMBER_ID`
		WHERE 
        CASE
			WHEN dimana4 = '1' THEN B.`JENIS` LIKE CONCAT('%',dimana5,'%') AND `POINT` >= dimana7 AND (B.`TANGGALTRANSAKSI` BETWEEN dimana8 AND dimana9)
            WHEN dimana4 = '0' THEN B.`JENIS` LIKE CONCAT('%',dimana5,'%') AND `POINT` >= dimana7
		END
        GROUP BY A.`MEMBER_ID` HAVING HAVINGKOLOM LIKE CONCAT('%',dimana10,'%') AND `SALDO` >= dimana6 ORDER BY
        CASE WHEN dimana3 = 'KODEMEMBERASC' THEN A.`MEMBER_ID` END ASC ,
		CASE WHEN dimana3 = 'KODEMEMBERDESC' THEN A.`MEMBER_ID` END DESC,
		CASE WHEN dimana3 = 'NAMAASC' THEN A.`NAMA` END ASC,
        CASE WHEN dimana3 = 'NAMADESC' THEN A.`NAMA` END DESC,
        CASE WHEN dimana3 = 'JENISASC' THEN A.`JENIS` END DESC,
        CASE WHEN dimana3 = 'JENISDESC' THEN A.`JENIS` END DESC LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 2 THEN
		SELECT A.`MEMBER_ID`,`NAMA`,`ALAMAT`,`NAMAFILE`,`TELEPON`,DATE_FORMAT(BIGINTTODATETIME(`AKHIRAKTIF`),'%d-%m-%Y') as AKHIRAKTIF,`EMAIL`,`POINT`,`NOTA`,`NOMINAL`,DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRANSAKSI`),'%d-%m-%Y') AS `TANGGALTRANSAKSI`,B.`JENIS`,`UNTUK` FROM 01_tms_member as A JOIN 01_tms_memberdeposit as B ON A.`MEMBER_ID` = B.`MEMBER_ID` WHERE A.`MEMBER_ID` = dimana2 AND
		CASE
			WHEN dimana3 = '1' THEN `NOTA` LIKE CONCAT('%',dimana4,'%') AND (`TANGGALTRANSAKSI` BETWEEN dimana5 AND dimana6)
			WHEN dimana3 = '0' THEN `NOTA` LIKE CONCAT('%',dimana4,'%')
		END	ORDER BY `TANGGALTRANSAKSI` DESC LIMIT datake, ditampilkan;
    ELSEIF dimana1 = 3 THEN
		SELECT * FROM 01_tms_penggunaaplikasiha as A LEFT JOIN 01_tms_penggunaaplikasi as B ON A.`NAMAHAKAKSES` = B.`HAKAKSESID` WHERE `NAMAHAKAKSES` LIKE CONCAT('%',dimana2,'%');
	ELSEIF dimana1 = 4 THEN
		SELECT `NAMAHAKAKSES` FROM 01_tms_penggunaaplikasiha;
	ELSEIF dimana1 = 5 THEN
		SELECT * FROM 01_tms_penggunaaplikasi WHERE `NAMAPENGGUNA` LIKE CONCAT('%',dimana2,'%');
	ELSEIF dimana1 = 6 THEN
		UPDATE 01_trs_barangkeluar SET `KASIR` = dimana2 WHERE `KASIR` = dimana3;
        UPDATE 01_trs_barangmasuk SET `PETUGAS` = dimana2 WHERE `PETUGAS` = dimana3;
        UPDATE 01_trs_mutasibarang SET `PETUGAS` = dimana2 WHERE `PETUGAS` = dimana3;
        UPDATE 01_trs_opname SET `PETUGAS` = dimana2 WHERE `PETUGAS` = dimana3;
        UPDATE 01_trs_returpembelian SET `PETUGAS` = dimana2 WHERE `PETUGAS` = dimana3;
        UPDATE 01_trs_returpenjualan SET `PETUGAS` = dimana2 WHERE `PETUGAS` = dimana3;
        UPDATE 01_tms_hutangtoko SET `KASIR_ID` = dimana2 WHERE `KASIR_ID` = dimana3;
        UPDATE 01_tms_memberdeposit SET `BUKTI` = dimana2 WHERE `BUKTI` = dimana3;
        UPDATE 01_tms_piutangkredit SET `KASIR_ID` = dimana2 WHERE `KASIR_ID` = dimana3;
	ELSEIF dimana1 = 7 THEN

		SELECT `NAMAPENGGUNA`,`NAMA`,`ALAMAT`,`NOTELP`,`URLFOTO` FROM 01_tms_penggunaaplikasi WHERE `NAMA` LIKE CONCAT('%',dimana2,'%') OR `NAMAPENGGUNA` LIKE CONCAT('%',dimana2,'%') LIMIT datake, ditampilkan;

	END IF;

ELSEIF kondisi = 30 THEN
	IF dimana1 = 1 THEN
		SELECT `NOTAPEMBELIAN`,COALESCE((`DISPLAY`),0) as DISPLAY, `HPP` FROM 01_bnt_display WHERE `KODEBARANG` = dimana2 AND `DISPLAY` != 0;
	ELSEIF dimana1 = 2 THEN
        SELECT `HPP`  FROM 01_bnt_display WHERE `KODEBARANG` = dimana2;
	ELSEIF dimana1 = 3 THEN
        SELECT `NOTAPEMBELIAN`,COALESCE((`GUDANG`),0) as GUDANG, `HPP`  FROM 01_bnt_gudang WHERE `BARANG_ID` = dimana2 AND `GUDANG` != 0;
	ELSEIF dimana1 = 4 THEN
		SELECT `NOTAPEMBELIAN`,COALESCE((`ONLINE`),0) as ONLINEE, `HPP`  FROM 01_bnt_online WHERE `KODEBARANG` = dimana2 AND `ONLINE` != 0;
	ELSEIF dimana1 = 5 THEN
		SELECT `NOTAPEMBELIAN`,COALESCE((`RETUR`),0) as RETUR, `HPP`  FROM 01_bnt_retur WHERE `KODEBARANG` = dimana2 AND `RETUR` != 0;
	ELSEIF dimana1 = 6 THEN
		SELECT COALESCE((`QTYPROMO`),0) as QTYPROMOBARANG, `HPP` FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'BARANG' AND `QTYPROMO` != 0;
	ELSEIF dimana1 = 7 THEN
		SELECT COALESCE((`QTYPROMO`),0) as QTYPROMOKATEGORI, `HPP` FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'KATEGORI' AND `QTYPROMO` != 0;
	ELSEIF dimana1 = 8 THEN
		SELECT COALESCE((`QTYPROMO`),0) as QTYPROMORAKITAN, `HPP` FROM 01_bnt_displaybonus WHERE `KODEBARANG` = dimana2 AND `JENIS` = 'RAKITAN' AND `QTYPROMO` != 0;
    END IF;
ELSEIF kondisi = 31 THEN
	IF dimana1 = 1 THEN
		SELECT * FROM 01_set_app WHERE `KODEUNIKMEMBER` = dimana2 LIMIT 1;
	ELSEIF dimana1 = 2 THEN
		SELECT `KODEOUTLET`,`NAMAOUTLET`,`ALAMAT`,`LAT`,`LONG`,`NOTELP` FROM 01_set_outlet WHERE `KODEUNIKMEMBER` = dimana2 AND `KODEOUTLET` = dimana3 LIMIT datake,ditampilkan;
	ELSEIF dimana1 = 3 THEN
		SELECT `KODEOUTLET`,`NAMAOUTLET`,A.`ALAMAT`, CONCAT(`LONG`,',',`LONG`) as LATLONG,A.`NOTELP`,`NAMA` FROM 01_set_outlet as A JOIN 01_tms_penggunaaplikasi as B ON A.`USERNAMEID` = B.`NAMAPENGGUNA` WHERE A.`KODEUNIKMEMBER` = dimana2;
	ELSEIF dimana1 = 4 THEN
		SELECT * FROM 01_tms_perusahaan WHERE `KODEUNIKMEMBER` = dimana2;
    END IF;
ELSEIF kondisi = 31 THEN
	SELECT COUNT(`BARANG_ID`) as TOTALBARANG FROM 01_tms_barangkharisma WHERE `KODEUNIKMEMBER` = dimana1;
ELSEIF kondisi = 32 THEN
	SELECT `TGLTRANSAKSI` FROM 01_akun_jurnalumum WHERE `NOTRANSAKSI` = dimana1;
ELSEIF kondisi = 33 THEN
	SELECT COUNT(*) INTO ADABARANG FROM 01_akun_jurnalumum WHERE `NOTRANSAKSI` = dimana1 LIMIT 1;
    IF ADABARANG > 0 THEN
		DELETE FROM 01_akun_jurnalumum WHERE `NOTRANSAKSI` = dimana1;
        SELECT 1 as BALASAN;
	ELSE
		SELECT 0 as BALASAN;
    END IF;
ELSEIF kondisi = 34 THEN
	SELECT COALESCE(SUM(`KELUAR`),0) INTO KELUARSTOK FROM 01_trs_kartustok WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana2 AND `TANGGALTRANSAKSI` >= dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `TIPE` = "TRSKSR";
    SELECT COALESCE(SUM(`MASUK`),0) INTO DATAKEAI FROM 01_trs_kartustok WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana2 AND `TANGGALTRANSAKSI` >= dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `TIPE` = "TRSKSRB";
    SELECT COALESCE(SUM(`MASUK`),0) INTO OLDSTOKKARTU FROM 01_trs_kartustok WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana2 AND `TANGGALTRANSAKSI` >= dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `TIPE` = "TRSPMB";
    SELECT IF(`OUTLET` = dimana2,COALESCE(SUM(`MASUK`),0),COALESCE(SUM(`MASUK` * -1),0)) INTO GUDANGADA FROM 01_trs_kartustok WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana2 AND `TANGGALTRANSAKSI` >= dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `TIPE` = "OPM";
    SELECT IF(`OUTLET` = dimana2 AND `OUTLET` = dimana5,COALESCE(SUM(`MASUK`),0),COALESCE(SUM(`MASUK` * -1),0))  INTO HASILSTOK FROM 01_trs_kartustok WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana2 AND `TANGGALTRANSAKSI` >= dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `TIPE` = "MTS";
    SELECT COALESCE(SUM(`MASUK`),0) INTO SISASTOKTAMBAH FROM 01_trs_kartustok WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana2 AND `TANGGALTRANSAKSI` >= dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `TIPE` = "RTRPJ";
    SELECT COALESCE(SUM(`KELUAR`),0) INTO ADABARANG FROM 01_trs_kartustok WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana2 AND `TANGGALTRANSAKSI` >= dimana3 AND `KODEUNIKMEMBER` = dimana4 AND `TIPE` = "RTPB";
    UPDATE `01_trs_opnamesementara` SET `SISASTOK` = (dimana5 - KELUARSTOK + DATAKEAI + OLDSTOKKARTU + GUDANGADA + HASILSTOK + SISASTOKTAMBAH - ADABARANG) WHERE `KODEBARANG` = dimana1 AND `OUTLET` = dimana2 AND `KODEUNIKMEMBER` = dimana4;
ELSEIF kondisi = 35 THEN
	UPDATE `01_tms_barangkharisma` SET `ALIASTOTALSTOK`= SEMUASTOK(dimana1,dimana2,dimana3) WHERE `BARANG_ID`= dimana1 AND `KODEAKUN` = dimana2 AND `KODEUNIKMEMBER` = dimana3;
        UPDATE `01_tms_barangkharisma` SET `STOKTANPAOUTLET` = SEMUASTOKTNPOUTLET(dimana1,dimana3) WHERE `BARANG_ID`= dimana1 AND `KODEUNIKMEMBER` = dimana3;
        UPDATE `01_tms_barangkharisma` SET `STOKDISPLAY` = (SELECT SUM(`DISPLAY`) FROM 01_bnt_display WHERE `KODEBARANG` = dimana1 AND `OUTLET` = dimana2 AND `KODEUNIKMEMBER` = dimana3), `STOKGUDANG` = (SELECT SUM(`GUDANG`) FROM 01_bnt_gudang WHERE `BARANG_ID` = dimana1 AND `OUTLET` = dimana2 AND `KODEUNIKMEMBER` = dimana3), `STOKRETUR` = (SELECT SUM(`RETUR`) FROM 01_bnt_retur WHERE `KODEBARANG` = dimana1 AND `OUTLET` = dimana2 AND `KODEUNIKMEMBER` = dimana3), `STOKONLINE` = (SELECT SUM(`ONLINE`) FROM 01_bnt_online WHERE `KODEBARANG` = dimana1 AND `KODEUNIKMEMBER` = dimana3) WHERE `BARANG_ID`= dimana1 AND `KODEUNIKMEMBER` = dimana3 AND `KODEAKUN` = dimana2;
ELSEIF kondisi = 36 THEN
	/* laporan aruskas kasir*/
	IF dimana1 = 1 THEN
		SELECT A.`NOTRANSAKSI`,`KETERANGAN`,`NAMAPERKIRAAN`, 
        CASE
						WHEN dimana2 = 1 THEN A.`KREDIT`
            WHEN dimana2 = 0 THEN A.`DEBET`
        END as NOMINAL
        FROM 01_akun_jurnalumum as A JOIN 01_akun_grup as B ON A.`KODEACC` = B.`AKUNID` WHERE `LOKASI` = dimana3 AND `OUTLET` = dimana3 AND A.`KODEUNIKMEMBER` = dimana4 AND (`TGLTRANSAKSI` BETWEEN dimana5 AND dimana6) AND `PETUGAS` = dimana7 AND
				CASE
						WHEN dimana2 = 1 THEN `KODEACC` = '6.4000'
            WHEN dimana2 = 0 THEN `KODEACC` = '7.1930'
        END	
				AND `KETERANGAN` LIKE CONCAT('%',dimana8,'%') AND 
        CASE
						WHEN dimana2 = 1 THEN A.`KREDIT` > 0
            WHEN dimana2 = 0 THEN A.`DEBET` > 0
        END GROUP BY A.`NOTRANSAKSI` ORDER BY A.`AI` DESC;
    END IF;
ELSEIF kondisi = 100 THEN
	IF dimana1 = 1 THEN
		SELECT * FROM 01_tms_barangkharisma WHERE `KODEAKUN` = dimana2 AND `KODEUNIKMEMBER` = dimana3 AND `ISUPDATED` = '1';
    ELSEIF dimana1 = 2 THEN
		SELECT COUNT(*) as ADAUPDATE FROM 01_tms_barangkharisma WHERE `KODEAKUN` = dimana2 AND `KODEUNIKMEMBER` = dimana3 AND `ISUPDATED` = '1';
	ELSEIF dimana1 = 3 THEN
		SELECT * FROM 01_tms_bestbuybaranggrosir WHERE `KODEUNIKMEMBER` = dimana3;
	ELSEIF dimana1 = 4 THEN
		SELECT * FROM 01_tms_barangkharismabestbuy WHERE `KODEUNIKMEMBER` = dimana3;
	ELSEIF dimana1 = 5 THEN
		SELECT * FROM 01_bnt_display WHERE `OUTLET` = dimana2 AND `KODEUNIKMEMBER` = dimana3;
    END IF;
ELSEIF kondisi = 1000 THEN
	IF dimana10 = 1 THEN
		SELECT  `01_set_outlet`.`KODEOUTLET` AS `LOKASI`,`NAMAOUTLET`, COALESCE(SUM(`barangkeluar_items_extended`.`GRANDTOTAL`) + coalesce(( SELECT SUM(`NOMINAL`) FROM 01_tms_memberdeposit WHERE `BUKTI` = `KASIR` AND (`TANGGALTRANSAKSI` BETWEEN dimana1 AND dimana2)),0), 0) AS `GRANDTOTAL` FROM `barangkeluar_items_extended` LEFT JOIN 01_set_outlet ON `barangkeluar_items_extended`.`LOKASI` = `01_set_outlet`.`KODEOUTLET` WHERE (DATE(`TGLKELUAR`) BETWEEN DATE_FORMAT(BIGINTTODATETIME(dimana1),'%Y-%m-%d') AND DATE_FORMAT(BIGINTTODATETIME(dimana2),'%Y-%m-%d')) AND `ENUM_JENISTRANSAKSI` LIKE CONCAT('%',dimana3,'%') AND `KODEOUTLET` LIKE CONCAT('%',dimana4,'%') GROUP BY `01_set_outlet`.`KODEOUTLET`;
	ELSEIF dimana10 = 2 THEN
		SELECT count(DISTINCT(PK_NOTAPENJUALAN)) as TOTALTRANSAKSI FROM 01_trs_barangkeluar WHERE (DATE(`TGLKELUAR`) BETWEEN DATE_FORMAT(BIGINTTODATETIME(dimana1),'%Y-%m-%d') AND DATE_FORMAT(BIGINTTODATETIME(dimana2),'%Y-%m-%d')) AND `ENUM_JENISTRANSAKSI` LIKE CONCAT('%',dimana3,'%') AND `LOKASI` LIKE CONCAT('%',dimana4,'%');
	ELSEIF dimana10 = 3 THEN
		SELECT  DATE(`barangkeluar_items_extended`.`TGLKELUAR`) AS `TGLKELUAR`, COALESCE(SUM(`barangkeluar_items_extended`.`GRANDTOTAL`) + coalesce(( SELECT SUM(`NOMINAL`) FROM 01_tms_memberdeposit WHERE `BUKTI` = `KASIR` AND (`TANGGALTRANSAKSI` BETWEEN dimana1 AND dimana2)),0), 0) AS `GRANDTOTAL` FROM `barangkeluar_items_extended` LEFT JOIN 01_set_outlet ON `barangkeluar_items_extended`.`LOKASI` = `01_set_outlet`.`KODEOUTLET` WHERE (DATE(`TGLKELUAR`) BETWEEN DATE_FORMAT(BIGINTTODATETIME(dimana1),'%Y-%m-%d') AND DATE_FORMAT(BIGINTTODATETIME(dimana2),'%Y-%m-%d')) AND `ENUM_JENISTRANSAKSI` LIKE CONCAT('%',dimana3,'%') AND `KODEOUTLET` LIKE CONCAT('%',dimana4,'%') GROUP BY `barangkeluar_items_extended`.`TGLKELUAR`;
	ELSEIF dimana10 = 4 THEN
		SELECT (SELECT COUNT(*) FROM 01_tms_member) as TOTALSEMUAMEMBER, (SELECT COUNT(*) FROM 01_tms_member  WHERE `STATUSAKTIF` = '1') as TOTALAKTIF, (SELECT COUNT(*) FROM 01_tms_member WHERE `STATUSAKTIF` = '0') as TOTALATIDAKKTIF;
	ELSEIF dimana10 = 5 THEN
		SELECT DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRS`),'%Y-%m-%d') as `TANGGALTRSALIAS`, SUM(A.HARGABELI * JUMLAHBELI - RP1 - RP2 - RP3 + RPPPN - ARP1 - ARP2) + SUM(BIAYALAIN) AS JUMLAH FROM 01_trs_barangmasuk AS A JOIN 01_tms_supplier AS B ON A.`FK_SUPPLIER` = B.`KODESUPPLIER` JOIN 01_tms_barangkharisma AS D ON A.`KODEBARANG` = D.`BARANG_ID` WHERE (`TANGGALTRS` BETWEEN dimana1 AND dimana2) AND `FK_SUPPLIER` LIKE CONCAT('%',dimana3,'%') AND `KODEBARANG` LIKE CONCAT('%',dimana4,'%') AND `KATEGORI_ID` LIKE CONCAT('%',dimana5,'%') AND D.`KODEAKUN` LIKE CONCAT('%',dimana6,'%') GROUP BY DATE_FORMAT(BIGINTTODATETIME(`TANGGALTRS`),'%d-%m-%Y') ORDER BY `TANGGALTRS` ASC;
	ELSEIF dimana10 = 6 THEN
		SELECT 
        `a`.`AI_TRANSAKSIKELUAR` AS `AI_TRANSAKSIKELUAR`,
        DATE_FORMAT(CAST(`a`.`TGLKELUAR` AS DATE),'%d-%m-%Y') AS `TGLKELUAR`,
        SUM(`STOKBARANGKELUAR`) as JATUHTEMPO,
        `a`.`FK_MEMBER` AS `FK_MEMBER`,
        `b`.`NAMA` AS `NAMA`,
        `a`.`PK_NOTAPENJUALAN` AS `PK_NOTAPENJUALAN`,
        SUM((((`a`.`HARGADASARGROSIR` * (`a`.`STOKBARANGKELUAR`)) - a.`DISKON`) * ((100 + `a`.`CASHBANK`) / 100)) + (IF((`a`.`DISKON` < 100),
                    ((`a`.`DISKON` / 100) * (`a`.`HARGADASARGROSIR` * (`a`.`STOKBARANGKELUAR`))),
                    `a`.`DISKON`))) AS `SUBTOTAL`,
        SUM(IF((`a`.`DISKON` < 100),
                    ((`a`.`DISKON` / 100) * (`a`.`HARGADASARGROSIR` * (`a`.`STOKBARANGKELUAR`))),
                    `a`.`DISKON`)) AS `DISKON`,
        SUM(((`a`.`HARGADASARGROSIR` * (`a`.`STOKBARANGKELUAR`)) - `a`.`DISKON`) * ((100 + `a`.`CASHBANK`) / 100))  AS `JUMLAH`,
		(SUM(((`a`.`HARGADASARGROSIR` * (`a`.`STOKBARANGKELUAR`)) - `a`.`DISKON`) * ((100 + `a`.`CASHBANK`) / 100)) - SUM(IF((`a`.`ENUM_JENISTRANSAKSI` = 'KREDIT'),
            REPLACE(`a`.`NOTRX`, '-', ''),
            0)))
 AS `RETUR`,
        COALESCE((CASE
                    WHEN
                        (1 = 1)
                    THEN
                        IF((`a`.`ENUM_JENISTRANSAKSI` = 'KREDIT'),
                            SUM(REPLACE(`a`.`NOTRX`, '-', '')),
                            0)
                END),
                0) AS `BAYAR`,
        `a`.`ENUM_JENISTRANSAKSI` AS `ENUM_JENISTRANSAKSI`
    FROM
        (`01_trs_barangkeluar` `a`
        JOIN `01_tms_member` `b` ON ((`a`.`FK_MEMBER` = `b`.`MEMBER_ID`))) WHERE (`TGLKELUAR` BETWEEN dimana1 AND dimana2) AND `ENUM_JENISTRANSAKSI` LIKE CONCAT('%',dimana3,'%') AND `LOKASI` LIKE CONCAT('%',dimana4,'%') AND (`a`.`PK_NOTAPENJUALAN` LIKE CONCAT('%',dimana5,'%') OR `b`.`NAMA` LIKE CONCAT('%',dimana5,'%'))
    GROUP BY `a`.`PK_NOTAPENJUALAN` ORDER BY `a`.`AI_TRANSAKSIKELUAR` DESC LIMIT datake, ditampilkan;
	ELSEIF dimana10 = 7 THEN
		SELECT count(DISTINCT(`a`.`PK_NOTAPENJUALAN`)) as TOTALDATA FROM (`01_trs_barangkeluar` `a` JOIN `01_tms_member` `b` ON ((`a`.`FK_MEMBER` = `b`.`MEMBER_ID`))) WHERE (`TGLKELUAR` BETWEEN dimana1 AND dimana2) AND `ENUM_JENISTRANSAKSI` LIKE CONCAT('%',dimana3,'%') AND `LOKASI` LIKE CONCAT('%',dimana4,'%') AND (`a`.`PK_NOTAPENJUALAN` LIKE CONCAT('%',dimana5,'%') OR `b`.`NAMA` LIKE CONCAT('%',dimana5,'%'));
	ELSEIF dimana10 = 8 THEN
		SELECT A.FK_BARANG, A.NAMABARANG, SUM((A.STOKBARANGKELUAR)) AS QTY, SUM(((HARGADASARGROSIR * (A.STOKBARANGKELUAR)) - IF((A.DISKON < 100),
            ((A.DISKON / 100) * (A.HARGADASARGROSIR * (A.STOKBARANGKELUAR))), A.DISKON)) * ((100 + A.CASHBANK) / 100)) AS TOTAL, SUM(HARGADASAR * (STOKBARANGKELUAR)) AS TOTALHARGABELI, SUM((((HARGADASARGROSIR * (STOKBARANGKELUAR)) - A.DISKON) * ((100 + A.CASHBANK) / 100)) - (HARGADASAR * (STOKBARANGKELUAR))) AS TOTALLABA FROM 01_trs_barangkeluar AS A JOIN 01_tms_barangkharisma AS C ON A.FK_BARANG = C.BARANG_ID WHERE (A.TGLKELUAR BETWEEN dimana1 AND dimana2) AND A.ENUM_JENISTRANSAKSI LIKE CONCAT('%',dimana3,'%') AND LOKASI LIKE CONCAT('%',dimana4,'%') AND (SUPPLER_ID LIKE CONCAT('%',dimana5,'%') OR KATEGORI_ID LIKE CONCAT('%',dimana5,'%') OR BARANG_ID LIKE CONCAT('%',dimana5,'%')) AND KODEAKUN LIKE CONCAT('%GDPST%') GROUP BY A.FK_BARANG LIMIT datake, ditampilkan;
	ELSEIF dimana10 = 9 THEN
		SELECT `NAMASUPPLIER`,`LOKASI`,`TRANSAKSI_ID`,`NAMASUPPLIER`,`TOTALKREDIT`,`KASIR_ID`,`KETERANGAN`,SUM(`BAYAR`) as BAYAR,DATE_FORMAT(BIGINTTODATETIME(`TANGGALBAYAR`),'%d-%m-%Y') as TANGGALBAYAR,DATE_FORMAT(BIGINTTODATETIME(`JATUHTEMPO`),'%d-%m-%Y') as JATUHTEMPO,`STATUSLUNAS` FROM 01_tms_hutangtoko as A JOIN 01_tms_supplier as B ON A.`SUPPLIER_ID` = B.`KODESUPPLIER` WHERE `NAMASUPPLIER` LIKE CONCAT('%',dimana1,'%') AND (`JATUHTEMPO` BETWEEN dimana2 AND dimana3) GROUP BY `TRANSAKSI_ID`  HAVING TOTALKREDIT <> BAYAR ORDER BY `JATUHTEMPO` LIMIT datake, ditampilkan;  
	ELSEIF dimana10 = 10 THEN
		SELECT COUNT(*) as TOTALBARANG,`BARANG_ID`,`NAMABARANG`,`HARGARATA`,`HARGAJUAL` FROM 01_tms_barangkharisma WHERE (`BARANG_ID` LIKE CONCAT('%',dimana1,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana1,'%')) AND `KODEAKUN` = dimana2 AND `KODEUNIKMEMBER` = dimana3;
	ELSEIF dimana10 = 11 THEN
		SELECT IF( EXISTS(
             SELECT `LABABERSIHDANMODAL` FROM 01_akun_modal WHERE `TAHUN` = dimana1 AND `BULAN` = dimana2 AND `CABANG` = dimana3 AND `KODEUNIKMEMBER` = dimana4 LIMIT 1), (SELECT `LABABERSIHDANMODAL` FROM 01_akun_modal WHERE `TAHUN` = dimana1 AND `BULAN` = dimana2 AND `CABANG` = dimana3 AND `KODEUNIKMEMBER` = dimana4 LIMIT 1), 0) as TOTALUNTUNGDANMODAL;
	ELSEIF dimana10 = 12 THEN
		SELECT COUNT(*) as TOTAL FROM 01_akun_jurnalumum WHERE `NOTRANSAKSI` = dimana1 LIMIT 1;
    END IF;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for proc_Controller_API
-- ----------------------------
DROP PROCEDURE IF EXISTS `proc_Controller_API`;
delimiter ;;
CREATE PROCEDURE `proc_Controller_API`(IN `kondisi` INT, IN `dimana1` VARCHAR(255), IN `dimana2` VARCHAR(255), IN `dimana3` VARCHAR(255), IN `dimana4` VARCHAR(255), IN `dimana5` VARCHAR(255), IN `dimana6` VARCHAR(255), IN `dimana7` VARCHAR(255), IN `dimana8` VARCHAR(255), IN `dimana9` VARCHAR(255), IN `dimana10` VARCHAR(255), IN `dimana11` VARCHAR(255), IN `dimana12` VARCHAR(255), IN `dimana13` VARCHAR(255), IN `dimana14` VARCHAR(255), IN `dimana15` VARCHAR(255), IN `datake` INT, IN `ditampilkan` INT)
BEGIN
DECLARE cekjumlah INT(10);
DECLARE DATA1, DATA2, DATA3, DATA4 DECIMAL(15,2);
IF kondisi = 0 THEN
	IF dimana15 = "0" THEN
		SELECT `ADDSELF`,`MINBELI`,`ISKATEGORI`,`MINBELIQTY` INTO DATA1 , DATA2, DATA3 , DATA4  FROM 01_tms_barangkharismabestbuy WHERE `KATBAR_ID` = dimana1 AND `KODEUNIKMEMBER` = dimana3;
		SELECT count(*) INTO cekjumlah FROM 01_tms_barangkharisma as A JOIN 01_tms_diskon as B ON A.`BARANG_ID` = B.`BARANG_ID` WHERE A.`BARANG_ID` = dimana1 AND A.`KODEUNIKMEMBER` = dimana3;
		IF cekjumlah > 0 THEN
			SELECT 1 as BELI, `HARGAJUAL` as SUBTOTAL, `AI`,`NAMAFILE`,`ISGROSIR`,`ISBESTBUY`,`ISCANMINUS`, `KONSINYASI`, A.`BARANG_ID`,`NAMABARANG`,`KATEGORI_ID`,`HARGABELI`,`HARGAJUAL`,`MINBELITINGKAT1`, `DISCNONMEMBER1`,`DISCMEMBER1`,`MINBELITINGKAT2`,`BESTBUY`,`DISCNONMEMBER2`,`DISCMEMBER2`,`HARGARATA`,`NAMASATUAN`,STOKDISPLAY as DISPLAY,`JENISALUR`,COALESCE(DATA1 ,0) as ADDSELF , COALESCE(DATA2 ,0) as MINBELI, COALESCE(DATA3 ,0) as ISKATEGORI, COALESCE(DATA4 ,0) as MINBELIQTY FROM 01_tms_barangkharisma as A LEFT JOIN 01_tms_diskon as B ON A.`BARANG_ID` = B.`BARANG_ID` JOIN 01_tms_barangsatuan as C ON A.`SATUAN` = C.`NAMASATUAN` WHERE (A.`BARANG_ID` LIKE CONCAT('%',dimana1,'%') OR A.`NAMABARANG` LIKE CONCAT('%',dimana1,'%')) AND `KODEAKUN` = dimana2 AND A.`KODEUNIKMEMBER` = dimana3 AND `AKTIF` = 1 LIMIT ditampilkan;
		ELSE
			SELECT 1 as BELI, `HARGAJUAL` as SUBTOTAL, `AI`,`NAMAFILE`,`ISGROSIR`,`ISBESTBUY`,`ISCANMINUS`, `KONSINYASI`, `BARANG_ID`,`KATEGORI_ID`,`NAMABARANG`,`HARGAJUAL`,`HARGABELI`,`HARGARATA` ,`NAMASATUAN`, 0 as TOTALDISKON, 0 as MINBELITINGKAT1, 0 as DISCNONMEMBER1,0 as DISCMEMBER1,0 as MINBELITINGKAT2,0 as DISCNONMEMBER2,0 as DISCMEMBER2,`BESTBUY`, STOKDISPLAY as DISPLAY,`JENISALUR`,COALESCE(DATA1 ,0) as ADDSELF , COALESCE(DATA2 ,0) as MINBELI, COALESCE(DATA3 ,0) as ISKATEGORI, COALESCE(DATA4 ,0) as MINBELIQTY FROM 01_tms_barangkharisma as A JOIN 01_tms_barangsatuan as B ON A.`SATUAN` = B.`NAMASATUAN`  WHERE (`BARANG_ID` LIKE CONCAT('%',dimana1,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana1,'%')) AND `KODEAKUN` = dimana2 AND A.`KODEUNIKMEMBER` = dimana3 AND `AKTIF` = 1 LIMIT ditampilkan;
		END IF;
	ELSEIF dimana15 = "1" THEN
		SELECT `KODEUNIKMEMBER`,`PENGGUNA_ID`,`NAMAPENGGUNA`,`NAMA`,`ALAMAT`,`NOTELP`,`HAKAKSESID` FROM `01_tms_penggunaaplikasi` WHERE `NAMAPENGGUNA` = dimana1 AND CONVERT(AES_DECRYPT(`SESSIONKODEUNIKMEMBER`,'TidakAdaKataKunci') USING utf8) = dimana2 LIMIT 1;
	ELSEIF dimana15 = "2" THEN
		SELECT A.`KODEUNIKMEMBER`,A.`ALAMAT`,`KODEOUTLET`,`NAMAOUTLET`,`USERNAMEID`,A.`NOTELP` FROM 01_set_outlet as A JOIN 01_tms_penggunaaplikasi as B ON A.`USERNAMEID` = B.`NAMAPENGGUNA` WHERE A.`KODEUNIKMEMBER` = dimana1;
    END IF;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for proc_Controller_Kasir
-- ----------------------------
DROP PROCEDURE IF EXISTS `proc_Controller_Kasir`;
delimiter ;;
CREATE PROCEDURE `proc_Controller_Kasir`(IN `kondisi` INT, IN `dimana1` VARCHAR(255), IN `dimana2` VARCHAR(255), IN `dimana3` VARCHAR(255), IN `dimana4` VARCHAR(255), IN `dimana5` VARCHAR(255), IN `dimana6` VARCHAR(255), IN `dimana7` VARCHAR(255), IN `dimana8` VARCHAR(255), IN `dimana9` VARCHAR(255), IN `dimana10` VARCHAR(255), IN `datake` INT, IN `ditampilkan` INT)
BEGIN
DECLARE cekjumlah,ispromo INT(10);
DECLARE apakahBarangDiskon, maxvaluenya,lastpay,minvaluenya,notransaksinya VARCHAR(255);
DECLARE qtydaridatabase, sisastok, tmp, adadata, totalstoksemua INT(12);
DECLARE hargaratanya, DATA1, DATA2, DATA3, DATA4, DATA5 DECIMAL(15,2);
IF kondisi = 0 THEN
	IF dimana3 = 'DISPLAY' THEN 
		SELECT `STOKTANPAOUTLET` as SEMUASTOKADA, COALESCE(SUM(`DISPLAY`),0) as DISPLAY, A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`KATEGORI_ID`,`HARGARATA` FROM 01_tms_barangkharisma as A LEFT JOIN 01_bnt_display as B ON A.BARANG_ID = B.KODEBARANG WHERE (`NAMABARANG` LIKE CONCAT('%',dimana1,'%') OR A.`BARANG_ID` LIKE CONCAT('%',dimana1,'%')) AND `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND IF(dimana5 = "" ,`SUPPLER_ID` != "", `SUPPLER_ID` = dimana5) AND `KODEAKUN` = dimana4 AND `AKTIF` = 1 GROUP BY A.`BARANG_ID` ORDER BY `NAMABARANG` ASC LIMIT datake,ditampilkan;
	ELSEIF dimana3 = 'GUDANG' THEN 
		SELECT COALESCE(SUM(`GUDANG`),0) as DISPLAY, A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`HARGARATA` FROM 01_tms_barangkharisma as A left JOIN 01_bnt_gudang as B ON A.BARANG_ID = B.BARANG_ID WHERE `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND `OUTLET` = dimana4 AND `AKTIF` = 1 GROUP BY `BARANG_ID` ORDER BY `NAMABARANG` ASC LIMIT datake,ditampilkan;
	ELSEIF dimana3 = 'ONLINE' THEN
		SELECT COALESCE(SUM(`ONLINE`),0) as DISPLAY, A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`HARGARATA` FROM 01_tms_barangkharisma as A left JOIN 01_bnt_online as B on A.BARANG_ID = B.KODEBARANG WHERE `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND `OUTLET` = dimana4 AND `AKTIF` = 1 GROUP BY `BARANG_ID` ORDER BY `NAMABARANG` ASC LIMIT datake,ditampilkan;
	ELSEIF dimana3 = 'QTYPROMO' THEN
		SELECT COALESCE(SUM(`QTYPROMO`),0) as DISPLAY, A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`HARGARATA` FROM 01_tms_barangkharisma as A left JOIN 01_bnt_displaybonus as B ON A.BARANG_ID = B.KODEBARANG WHERE `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND `OUTLET` = dimana4 AND `AKTIF` = 1 GROUP BY `BARANG_ID` ORDER BY `NAMABARANG` ASC LIMIT datake,ditampilkan;
 END IF;
ELSEIF kondisi = 1 THEN
	IF dimana3 = 'DISPLAY' THEN
		SELECT `NAMAFILE`, `STOKTANPAOUTLET` as SEMUASTOKADA, `STOKDISPLAY` as DISPLAY, A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`KATEGORI_ID`,`HARGARATA` FROM 01_tms_barangkharisma as A LEFT JOIN 01_bnt_display as B ON A.BARANG_ID = B.KODEBARANG WHERE (`NAMABARANG` LIKE CONCAT('%',dimana1,'%') OR A.`BARANG_ID` LIKE CONCAT('%',dimana1,'%')) AND `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND IF(dimana5 = "" ,`SUPPLER_ID` != "", `SUPPLER_ID` = dimana5) AND `KODEAKUN` = dimana6 AND `AKTIF` = 1 GROUP BY A.`BARANG_ID` ORDER BY `NAMABARANG` LIMIT datake,ditampilkan;
	ELSEIF dimana3 = 'GUDANG' THEN 
		SELECT COALESCE(SUM(`GUDANG`),0) as DISPLAY, A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`HARGARATA` FROM 01_tms_barangkharisma as A JOIN 01_bnt_gudang as B ON A.BARANG_ID = B.BARANG_ID WHERE (`NAMABARANG` LIKE CONCAT('%',dimana1,'%') OR A.`BARANG_ID` LIKE CONCAT('%',dimana1,'%') OR `KATEGORI_ID` LIKE CONCAT('%',dimana1,'%')) AND `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND `OUTLET` = dimana4 AND `KODEAKUN` = dimana6 AND `AKTIF` = 1 GROUP BY A.`BARANG_ID` ORDER BY `NAMABARANG` LIMIT datake,ditampilkan;
	ELSEIF dimana3 = 'ONLINE' THEN
		SELECT COALESCE(SUM(`ONLINE`),0) as DISPLAY, A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`HARGARATA` FROM 01_tms_barangkharisma as A JOIN 01_bnt_online as B on A.BARANG_ID = B.KODEBARANG WHERE (`NAMABARANG` LIKE CONCAT('%',dimana1,'%') OR A.`BARANG_ID` LIKE CONCAT('%',dimana1,'%') OR `KATEGORI_ID` LIKE CONCAT('%',dimana1,'%')) AND `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND `KODEAKUN` = dimana6 AND `AKTIF` = 1 GROUP BY A.`BARANG_ID` ORDER BY `NAMABARANG` LIMIT datake,ditampilkan;
	ELSEIF dimana3 = 'RETUR' THEN
		SELECT COALESCE(SUM(`RETUR`),0) as DISPLAY,A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`HARGARATA` FROM 01_tms_barangkharisma as A JOIN 01_bnt_retur as B on A.BARANG_ID = B.KODEBARANG WHERE (`NAMABARANG` LIKE CONCAT('%',dimana1,'%') OR A.`BARANG_ID` LIKE CONCAT('%',dimana1,'%') OR `KATEGORI_ID` LIKE CONCAT('%',dimana1,'%')) AND `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND `KODEAKUN` = dimana6 AND `AKTIF` = 1 GROUP BY A.`BARANG_ID` ORDER BY `NAMABARANG` LIMIT datake,ditampilkan;
	ELSEIF dimana3 = 'SEMUA' THEN
		SELECT `BARANG_ID`,`NAMABARANG`,`KATEGORI_ID`,`HARGARATA` FROM 01_tms_barangkharisma WHERE `KATEGORI_ID` = dimana1 AND `OUTLET` LIKE CONCAT('%',dimana4,'%') AND `AKTIF` = 1 ORDER BY `NAMABARANG` ASC;
	ELSEIF dimana3 = 'SAMADENGAN' THEN
		SELECT `ALIASTOTALSTOK` as SEMUASTOKADA, `STOKDISPLAY` as DISPLAY, A.`BARANG_ID`, `RAK_ID`, `NAMABARANG`, `HARGAJUAL`, `HARGABELI`,`EXPTANGGAL`,`SATUAN`,`KATEGORI_ID`,`HARGARATA` FROM 01_tms_barangkharisma as A LEFT JOIN 01_bnt_display as B ON A.BARANG_ID = B.KODEBARANG WHERE (`NAMABARANG` = dimana1 OR A.`BARANG_ID` = dimana1) AND `KONSINYASI` LIKE CONCAT('%',dimana2,'%') AND IF(dimana5 = "" ,`SUPPLER_ID` != "", `SUPPLER_ID` = dimana5) AND `KODEAKUN` = dimana6 AND `AKTIF` = 1 GROUP BY A.`BARANG_ID` ORDER BY `NAMABARANG` LIMIT datake,ditampilkan;
 END IF;
ELSEIF kondisi = 2 THEN
	select `NOMORNOTA`, `PK_NOTAPENJUALAN` from 01_trs_barangkeluar WHERE PK_NOTAPENJUALAN LIKE CONCAT('%PJ',dimana1,'',dimana2,'',dimana3,'#%') ORDER BY `NOMORNOTA` DESC LIMIT 1;
ELSEIF kondisi = 3 THEN
	SELECT `ADDSELF`,`MINBELI`,`ISKATEGORI`,`MINBELIQTY` INTO DATA1 , DATA2, DATA3 , DATA4  FROM 01_tms_barangkharismabestbuy WHERE `KATBAR_ID` = dimana1 AND `OUTLET` = dimana2 AND `KODEUNIKMEMBER` = dimana4;
	SELECT count(*) INTO cekjumlah FROM 01_tms_barangkharisma as A JOIN 01_tms_diskon as B ON A.`BARANG_ID` = B.`BARANG_ID` WHERE A.`BARANG_ID` = dimana1 AND A.`KODEUNIKMEMBER` = dimana4;
	IF cekjumlah > 0 THEN
	/* jika ada barang di tabel diskon */
		SELECT 1 as BELI,0 as `DARISUBPERUSAHAAN`, `HARGAJUAL` as SUBTOTAL, A.`AI`,COUNT(*) as TOTALBARIS,`NAMAFILE`,`ISGROSIR`,`ISBESTBUY`,`ISCANMINUS`, `KONSINYASI`, A.`BARANG_ID`,`NAMABARANG`,`KATEGORI_ID`,`HARGABELI`,`HARGAJUAL`,`MINBELITINGKAT1`, `DISCNONMEMBER1`,`DISCMEMBER1`,`MINBELITINGKAT2`,`BESTBUY`,`DISCNONMEMBER2`,`DISCMEMBER2`,`HARGARATA`,`NAMASATUAN`,STOKDISPLAY as DISPLAY,`JENISALUR`,COALESCE(DATA1 ,0) as ADDSELF , COALESCE(DATA2 ,0) as MINBELI, COALESCE(DATA3 ,0) as ISKATEGORI, COALESCE(DATA4 ,0) as MINBELIQTY FROM 01_tms_barangkharisma as A LEFT JOIN 01_tms_diskon as B ON A.`BARANG_ID` = B.`BARANG_ID` JOIN 01_tms_barangsatuan as C ON A.`SATUAN` = C.`NAMASATUAN` WHERE A.`BARANG_ID` = dimana1 AND `KODEAKUN` = dimana2 AND A.`KODEUNIKMEMBER` = dimana4 AND `AKTIF` = 1 LIMIT 2;
	ELSE
		SELECT 1 as BELI,0 as `DARISUBPERUSAHAAN`, `HARGAJUAL` as SUBTOTAL, A.`AI`,COUNT(*) as TOTALBARIS,`NAMAFILE`,`ISGROSIR`,`ISBESTBUY`,`ISCANMINUS`, `KONSINYASI`, `BARANG_ID`,`KATEGORI_ID`,`NAMABARANG`,`HARGAJUAL`,`HARGABELI`,`HARGARATA` ,`NAMASATUAN`, 0 as TOTALDISKON, 0 as MINBELITINGKAT1, 0 as DISCNONMEMBER1,0 as DISCMEMBER1,0 as MINBELITINGKAT2,0 as DISCNONMEMBER2,0 as DISCMEMBER2,`BESTBUY`, STOKDISPLAY as DISPLAY,`JENISALUR`,COALESCE(DATA1 ,0) as ADDSELF , COALESCE(DATA2 ,0) as MINBELI, COALESCE(DATA3 ,0) as ISKATEGORI, COALESCE(DATA4 ,0) as MINBELIQTY FROM 01_tms_barangkharisma as A JOIN 01_tms_barangsatuan as B ON A.`SATUAN` = B.`NAMASATUAN` WHERE A.`BARANG_ID` = dimana1 AND `KODEAKUN` = dimana2 AND A.`KODEUNIKMEMBER` = dimana4 AND `AKTIF` = 1    LIMIT 2;
	END IF;
ELSEIF kondisi = 4 THEN
	IF dimana5 != "" THEN
				SELECT * FROM 01_tms_penggunaaplikasiha WHERE `NAMAHAKAKSES` = dimana5 AND `KODEUNIKMEMBER` = dimana3 LIMIT 1;
	ELSE
		IF dimana3 = "" OR dimana3 = "127.0.0.1" OR dimana3 = "localhost" THEN
			SELECT 0 as KOSONG;
		ELSE
			SELECT COUNT(*) INTO notransaksinya FROM 01_set_app WHERE `KODEUNIKMEMBER` = dimana3 AND `SYNP` = dimana4 LIMIT 1;
			IF notransaksinya = 0 THEN
				SELECT 0 as KOSONG;
			ELSE
				SELECT `NAMAPENGGUNA`,`NAMAPENGGUNA`,`PASSWORD`,`HAKAKSESID`,`URLFOTO`,A.`KODEUNIKMEMBER`,`ISADMIN`, 1 as KOSONG, `F_KASIRKIRIM` FROM 01_tms_penggunaaplikasi as A JOIN 01_tms_penggunaaplikasiha as B ON A.`HAKAKSESID` = B.`NAMAHAKAKSES` WHERE `NAMAPENGGUNA` = dimana1 limit ditampilkan;    
			END IF;
		END IF;
    END IF;
ELSEIF kondisi = 5 THEN
	 SELECT CASE
		WHEN dimana2 = 'DEBIT CARD' THEN `PAJAKDEBIT`
		WHEN dimana2 = 'CREDIT CARD' THEN `PAJAKKREDIT`
	END as TIPEKARTU
 FROM 01_tms_pembayaranbank WHERE `BANK_ID` = dimana1 LIMIT 1;
ELSEIF kondisi = 6 THEN
	IF dimana2 = 2 THEN
		SELECT COALESCE(SUM(`NOMINAL`),0) INTO cekjumlah FROM 01_tms_member as A JOIN 01_tms_memberdeposit as B ON A.MEMBER_ID = B.MEMBER_ID WHERE A.MEMBER_ID = dimana1;
		SELECT cekjumlah,COALESCE((SELECT `SISAPIUTANG` FROM 01_tms_piutangkredit WHERE `MEMBER_ID` = dimana1 ORDER BY AI DESC LIMIT 1),0) as DIAADAHUTANG, `MEMBER_ID`,`TELEPON`,`NAMA`,`JENIS`,`POINT`,`ALAMAT`,`AKHIRAKTIF`,COALESCE(`MINIMALPOIN`,0) as MINIMALPOINT,`BATASTAMBAHKREDIT`, `GRUP`,`LIMITJUMLAHPIUTANG` FROM 01_tms_member WHERE `MEMBER_ID` = dimana1 LIMIT 1;
	ELSEIF dimana2 = 3 THEN
		SELECT COALESCE(SUM(`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)),0) as OMSET FROM 01_trs_barangkeluar WHERE `FK_MEMBER` = dimana1;
	ELSE
		SELECT `MEMBER_ID`,`NAMA`,`JENIS`,`POINT`,`ALAMAT`,`AKHIRAKTIF`,`MINIMALPOIN`,`BATASTAMBAHKREDIT`,`GRUP` FROM 01_tms_member WHERE `NAMA` LIKE CONCAT('%',dimana1,'%') OR `MEMBER_ID` LIKE CONCAT('%',dimana1,'%') GROUP BY `MEMBER_ID` ORDER BY `NAMA` ASC LIMIT datake,ditampilkan;
	END IF;
ELSEIF kondisi = 7 THEN
	UPDATE 01_tms_member SET `POINT` = dimana2 WHERE `MEMBER_ID` = dimana1;
ELSEIF kondisi = 8 THEN
	SELECT `PK_NOTAPENJUALAN`,SUM(( IF(`MINBELI` > 0, COALESCE((TRUNCATE((STOKBARANGKELUAR) /(MINBELI + ADDSELF),0)) * MINBELI + MOD((STOKBARANGKELUAR), (MINBELI+ADDSELF)),0) * HARGADASARGROSIR , (HARGADASARGROSIR * (STOKBARANGKELUAR)) ) - DISKON) * ((100 + CASHBANK) / 100)) as TOTALHARGA  , SUM(STOKBARANGKELUAR) as TOTALKELUAR, COALESCE(B.`DEBET`,0) as DARIJUENAL, ENUM_TIPETRANSAKSI,`NAMABANK`, ENUM_JENISTRANSAKSI, WAKTU FROM 01_trs_barangkeluar as A JOIN 01_akun_jurnalumum as B ON A.`PK_NOTAPENJUALAN` = B.`NOTRANSAKSI` WHERE (B.`KETERANGAN` LIKE '%Transaksi Kas Kecil TUNAI Oleh%' OR B.`KETERANGAN` LIKE '%Transaksi Kredit Oleh%' OR B.`KETERANGAN` LIKE '%Transaksi Kas Kartu Debit Oleh%' OR B.`KETERANGAN` LIKE '%Transaksi Kas Kartu Kredit Oleh%') AND DATE(`TGLKELUAR`) = dimana4 AND A.`LOKASI` = dimana2 AND CASE
		WHEN dimana5 = 0 THEN `KASIR` LIKE '%%'
		WHEN dimana5 = 1 THEN `KASIR` = dimana3 
	END GROUP BY PK_NOTAPENJUALAN ORDER BY AI_TRANSAKSIKELUAR DESC LIMIT datake,ditampilkan;
ELSEIF kondisi = 9 THEN
	SELECT COALESCE(SUM(((`HARGADASARGROSIR` * (STOKBARANGKELUAR)) -  DISKON) * ((100 + CASHBANK) / 100)),0) as TOTALHARGA , SUM(STOKBARANGKELUAR) as TOTAL FROM 01_trs_barangkeluar WHERE DATE(`TGLKELUAR`) = CURDATE() AND `ENUM_JENISTRANSAKSI` = dimana1 AND `LOKASI` = dimana2;
ELSEIF kondisi = 10 THEN
	SELECT `PK_NOTAPENJUALAN`,SUM(( IF(`MINBELI` > 0, COALESCE((TRUNCATE((STOKBARANGKELUAR) /(MINBELI + ADDSELF),0)) * MINBELI + MOD((STOKBARANGKELUAR), (MINBELI+ADDSELF)),0) * HARGADASARGROSIR , (HARGADASARGROSIR * (STOKBARANGKELUAR)) ) - DISKON) * ((100 + CASHBANK) / 100)) as TOTALHARGA , SUM(STOKBARANGKELUAR) as TOTALKELUAR, COALESCE(B.`DEBET`,0) as DARIJUENAL, ENUM_TIPETRANSAKSI,`NAMABANK`, ENUM_JENISTRANSAKSI, WAKTU FROM 01_trs_barangkeluar as A JOIN 01_akun_jurnalumum as B ON A.`PK_NOTAPENJUALAN` = B.`NOTRANSAKSI` WHERE (B.`KETERANGAN` LIKE '%Transaksi Kas Kecil TUNAI Oleh%' OR B.`KETERANGAN` LIKE '%Transaksi Kredit Oleh%' OR B.`KETERANGAN` LIKE '%Transaksi Kas Kartu Debit Oleh%' OR B.`KETERANGAN` LIKE '%Transaksi Kas Kartu Kredit Oleh%') AND DATE(`TGLKELUAR`) = dimana4 AND `PK_NOTAPENJUALAN` LIKE CONCAT('%',dimana1,'%') AND A.`LOKASI` = dimana2 AND CASE
		WHEN dimana5 = 0 THEN `KASIR` LIKE '%%'
		WHEN dimana5 = 1 THEN `KASIR` = dimana3 
	END GROUP BY PK_NOTAPENJUALAN ORDER BY AI_TRANSAKSIKELUAR DESC LIMIT datake,ditampilkan;
ELSEIF kondisi = 11 THEN
	SELECT A.`PPN`,0 as `DARIPERUSAHAAN`, `FK_BARANG`,`AI_TRANSAKSIKELUAR`,`ISGROSIR`,`ISBESTBUY`,`ISCANMINUS`,`FK_MEMBER`, A.`NAMABARANG`,`STOKBARANGKELUAR`,`TOTALBARANGSEBELUM`,A.`HARGADASAR`,A.`HARGADASARGROSIR`,B.`ALIASTOTALSTOK`,A.`DISKON`,C.`NAMASATUAN`,A.`ISPROMO`,A.`MINBELI`,A.`ADDSELF`,`FK_SALESMAN`,`TGLKELUAR`,`JATUHTEMPO`,`POTONGANVCH`,`BAYAR`,`NOTRX`,`ENUM_JENISTRANSAKSI`,A.`KASIR`,`JENISARUST`,`BARANGPROMO`,A.`KETERANGAN`,A.`HARGABELI`,A.`KONSINYASI`,B.`HARGARATA` FROM 01_trs_barangkeluar as A JOIN 01_tms_barangkharisma as B ON A.FK_BARANG = B.BARANG_ID JOIN 01_tms_barangsatuan as C ON B.`SATUAN` = C.`NAMASATUAN` WHERE `PK_NOTAPENJUALAN` = dimana1 GROUP BY `FK_BARANG` ORDER BY AI_TRANSAKSIKELUAR ASC;
ELSEIF kondisi = 12 THEN
	SELECT A.`PK_NOTAPENJUALAN`,A.`KETERANGAN`,`FK_MEMBER`,`NAMA`,`ALAMAT`,`POINT`, `KASIR`,SUM(`STOKBARANGKELUAR`) AS TOTALBARANG,SUM(`HARGAJUAL`) AS TOTALHARGA FROM 01_tmp_notapending as A JOIN 01_tms_member as B ON A.`FK_MEMBER` = B.`MEMBER_ID` WHERE A.`KETERANGAN` LIKE CONCAT('%',dimana1,'%') AND `LOKASI` = dimana2 GROUP BY `KETERANGAN` ORDER BY KETERANGAN DESC;
ELSEIF kondisi = 14 THEN
	SELECT A.`PPN`,`DARIPERUSAHAAN`,`FK_BARANG`,0 as `AI_TRANSAKSIKELUAR`,`ISGROSIR`,`ISBESTBUY`,`ISCANMINUS`,`FK_MEMBER`,`PK_NOTAPENJUALAN`, A.`NAMABARANG`,`STOKBARANGKELUAR`,`TOTALBARANGSEBELUM`,A.`HARGADASAR`,A.`HARGADASARGROSIR`,B.`ALIASTOTALSTOK`,A.`DISKON`,C.`NAMASATUAN`,A.`ISPROMO`,A.`MINBELI`,A.`ADDSELF`,`FK_SALESMAN`,`TGLKELUAR`,`JATUHTEMPO`,`POTONGANVCH`,`BAYAR`,`NOTRX`,`ENUM_JENISTRANSAKSI`,A.`KASIR`,`JENISARUST`,`BARANGPROMO`,A.`KETERANGAN`,A.`HARGABELI`,A.`KONSINYASI`,B.`HARGARATA` FROM 01_tmp_notapending as A JOIN 01_tms_barangkharisma as B ON A.FK_BARANG = B.BARANG_ID JOIN 01_tms_barangsatuan as C ON B.`SATUAN` = C.`NAMASATUAN` WHERE  A.`PK_NOTAPENJUALAN` = dimana1 AND B.`KODEAKUN` = dimana2;
ELSEIF kondisi = 15 THEN
	SELECT 0;
ELSEIF kondisi = 16 THEN
	IF dimana2 = 1 THEN
		SELECT DISTINCT(B.`BARANG_ID`),B.`QTY`, C.`NAMABARANG`,C.`HARGAJUAL`,C.`SATUAN`, C.`HARGABELI`, A.`KATBAR_ID`,E.`NAMAKATEGORI`,`JENISALUR`,`MINKATEGORI`,`QTYBONUS`,`MINIMALHARGA`,`MINHARGA`,`KELIPATAN`,`BATASPERHARI`,`UNTUK`,A.`KATEGORI_ID` FROM 01_tms_barangkharismabestbuy as A JOIN 01_tms_bestbuykategori as B ON A.KATBAR_ID = B.KATBAR_ID JOIN 01_tms_barangkharisma AS C ON B.BARANG_ID = C.BARANG_ID JOIN 01_bnt_display as D ON C.BARANG_ID = D.KODEBARANG JOIN 01_tms_kategori as E ON A.`KATBAR_ID` = E.`KATEGORIPARENT_ID` WHERE A.`KATBAR_ID` = dimana1 AND B.`OUTLET` = dimana3;
 ELSEIF dimana2 = 2 THEN
		SELECT DISTINCT(B.`BARANG_ID`),B.`QTY`, C.`NAMABARANG`,C.`HARGAJUAL`, C.`HARGABELI`, A.`KATEGORI_ID`,`JENISALUR`, `QTYBONUS`,`MINBELI`,`MINBELIQTY` FROM 01_tms_barangkharismabestbuy as A JOIN 01_tms_bestbuybarang as B ON A.KATEGORI_ID = B.KATEGORI_ID JOIN 01_tms_barangkharisma as C ON B.BARANG_ID = C.BARANG_ID JOIN 01_bnt_display as D ON C.BARANG_ID = D.KODEBARANG WHERE `KATBAR_ID` = dimana1 AND B.`OUTLET` = dimana3 AND B.`QTYBONUS` > 0;
	ELSEIF dimana2 = 3 THEN
		SELECT `BARANGID`, `NAMAVOUCHER`, DATE_FORMAT(BIGINTTODATETIME(`AWALAKTIF`),'%d-%m-%Y') as AWALAKTIF, DATE_FORMAT(BIGINTTODATETIME(`AKHIRAKTIF`),'%d-%m-%Y') as AKHIRAKTIF, `TIPEVOUCHER`, `NOMINALRUPIAH`, `NOMINALDISKON`, `BATASTRANSAKSI`, `MINIMALPEMBELIAN` FROM 01_tms_voucherbarang WHERE `BARANGID` = dimana1 AND `NAMAVOUCHER` LIKE CONCAT('%',dimana3,'%');
	END IF;
ELSEIF kondisi = 17 THEN
	IF EXISTS(SELECT * FROM 01_tms_bestbuykategorilog WHERE `MEMBER_ID` = dimana1) = 0 THEN
		SELECT COALESCE(COUNT(*),0) as TOTALBELI FROM 01_tms_bestbuykategorilog;
 ELSE
		SELECT COALESCE(SUM(`QTY`),0) as TOTALBELI FROM 01_tms_bestbuykategorilog WHERE `MEMBER_ID` = dimana1 AND `TANGGALTRANSAKSI` = CURDATE() GROUP BY `KATEGORI_ID`;
 END IF;
ELSEIF kondisi = 18 THEN
	IF ditampilkan > 1 THEN
		SELECT `HARGABELIGROSIR`,`JIKABELI` FROM 01_tms_bestbuybaranggrosir WHERE `BARANG_ID` = dimana1 AND `JIKABELI` >= dimana2 AND `KODEUNIKMEMBER` = dimana3 AND `OUTLET` = dimana4;
    ELSE
		SELECT `HARGABELIGROSIR`,`JIKABELI` FROM 01_tms_bestbuybaranggrosir WHERE `BARANG_ID` = dimana1 AND `JIKABELI` <= dimana2 AND `KODEUNIKMEMBER` = dimana3 AND `OUTLET` = dimana4 ORDER BY `AI_GROSIR` DESC LIMIT ditampilkan;
    END IF;
ELSEIF kondisi = 19 THEN
	IF dimana2 = 1 THEN
		SELECT `TRANSAKSI_ID`,A.`MEMBER_ID`,`NAMA`, `TOTALKREDIT`, SUM(`POTONGAN`) as POTONGAN,SUM(`BAYAR`) as BAYAR, `KASIR_ID`, `STATUSLUNAS`, MIN(`JATUHTEMPO`) as TERDEKAT, MAX(`JATUHTEMPO`) as TERAKHIR, MAX(`KREDITKE`) as CICILANKE FROM 01_tms_piutangkredit as A JOIN 01_tms_member as B ON A.MEMBER_ID = B.MEMBER_ID GROUP BY `MEMBER_ID` ORDER BY SUM(`BAYAR`) DESC  LIMIT datake,ditampilkan;
	ELSEIF dimana2 = 2 THEN
		IF dimana5 = "True" THEN
			SELECT `EMAIL`, B.`MEMBER_ID`,`NAMA`, `TOTALKREDIT` - SUM(`POTONGAN`) - SUM(`BAYAR`) as SISAHUTANG ,`TOTALKREDIT`, SUM(`POTONGAN`) as POTONGAN,SUM(`BAYAR`) as BAYAR, `KASIR_ID`, MIN(`JATUHTEMPO`) as TERDEKAT, MAX(`JATUHTEMPO`) as TERAKHIR, `TANGGALBAYAR` FROM 01_tms_piutangkredit as A JOIN 01_tms_member as B ON A.MEMBER_ID = B.MEMBER_ID WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`LOKASI` = dimana10 AND (B.`MEMBER_ID` LIKE CONCAT('%',dimana1,'%') OR `NAMA` LIKE CONCAT('%',dimana1,'%')) GROUP BY B.`MEMBER_ID` HAVING CASE WHEN dimana6 = "0" THEN (TOTALKREDIT - BAYAR) = 0 WHEN dimana6 = "1" THEN TOTALKREDIT > 0 END AND CASE WHEN dimana7 = "1" THEN `TANGGALBAYAR` < dimana4  WHEN dimana7 = "2" THEN MIN(`JATUHTEMPO`) < dimana4  WHEN dimana7 = 3 THEN MAX(`JATUHTEMPO`) < dimana4 END LIMIT datake,ditampilkan ;
		ELSEIF dimana5 = "Ubah" THEN
			/*DECLARE apakahBarangDiskon, maxvaluenya,lastpay,minvaluenya,notransaksinya VARCHAR(255);*/
            SELECT COALESCE(SISAPIUTANG,0) INTO apakahBarangDiskon FROM 01_tms_piutangkredit WHERE `NOTRANSAKSI` = 0 AND `MEMBER_ID` = dimana1 ORDER BY `AI` DESC LIMIT 1;
			SELECT `LOKASI`,apakahBarangDiskon as SISAPIUTANGNYA,`TRANSAKSI_ID`,A.`MEMBER_ID`,`NAMA`,`GRUP`,`ALAMAT`,MAX(`TANGGALBAYAR`) as TANGGALBAYAR, TOTALOMSET(dimana1,0) as GLOBALTOTALPIUTANG ,(SELECT (`TOTALKREDIT` - SUM(`POTONGAN`) - SUM(`BAYAR`)) FROM 01_tms_piutangkredit WHERE `TRANSAKSI_ID` = A.`TRANSAKSI_ID` AND `KODEUNIKMEMBER` = dimana9 AND `LOKASI` = dimana10 AND `MEMBER_ID` = dimana1 ) as TOTALKREDIT, SUM(`POTONGAN`) as POTONGAN, SUM(`BAYAR`) as BAYAR, `KASIR_ID`, `STATUSLUNAS`, MIN(`JATUHTEMPO`) as TERDEKAT, MAX(`JATUHTEMPO`) as TERAKHIR FROM 01_tms_piutangkredit as A JOIN 01_tms_member as B ON A.MEMBER_ID = B.MEMBER_ID WHERE `NOTRANSAKSI` = dimana6 AND A.`KODEUNIKMEMBER` = dimana9 AND A.`LOKASI` = dimana10 AND A.`MEMBER_ID` = dimana1 GROUP BY `TRANSAKSI_ID` HAVING ROUND(TOTALKREDIT - POTONGAN - BAYAR) != 0 LIMIT datake,ditampilkan;
		ELSE
		SELECT JATUHTEMPO,TOTALKREDIT,SISAKREDIT,A.TRANSAKSI_ID as TRANSAKSI_ID, A.AI as BARISAI, COALESCE((SELECT BAYAR FROM 01_tms_piutangkredit_detail WHERE NOTARETUR = dimana6 AND TRANSAKSI_ID = A.TRANSAKSI_ID),0) as BAYAR FROM 01_tms_piutangkredit as A
	WHERE A.MEMBER_ID = dimana1 AND A.KODEUNIKMEMBER = dimana9 AND A.SISAKREDIT > 0
	GROUP BY A.TRANSAKSI_ID;
		/*SELECT JATUHTEMPO,TOTALKREDIT,SISAKREDIT,A.TRANSAKSI_ID as TRANSAKSI_ID, A.AI as BARISAI, B.BAYAR FROM 01_tms_piutangkredit as A
			LEFT JOIN 01_tms_piutangkredit_detail as B ON A.TRANSAKSI_ID = B.TRANSAKSI_ID
			WHERE A.MEMBER_ID = dimana1 AND A.KODEUNIKMEMBER = dimana9 AND A.SISAKREDIT > 0
			GROUP BY A.TRANSAKSI_ID ORDER BY B.TANGGALBAYAR DESC, B.WAKTU DESC;*/
 END IF;
	ELSEIF dimana2 = 3 THEN
		SELECT `MEMBER_ID`,`TRANSAKSI_ID`,`TANGGALBAYAR`,`JATUHTEMPO`, SUM(`TOTALKREDIT`) as TOTALKREDIT ,SUM(`POTONGAN`) as POTONGAN,SUM(`BAYAR`) as BAYAR FROM 01_tms_piutangkredit WHERE `MEMBER_ID` = dimana1 AND `STATUSLUNAS` = 'False' GROUP BY `TRANSAKSI_ID` ORDER BY `TANGGALBAYAR` DESC;
	ELSEIF dimana2 = 4 THEN
		SELECT `TRANSAKSI_ID`,`NAMA`, `TANGGALBAYAR`, `KASIR_ID`,`TOTALKREDIT`,MAX(`KREDITKE`) as KREDITKE,`POTONGAN`,`BAYAR` FROM 01_tms_piutangkredit as A JOIN 01_tms_member as B ON A.MEMBER_ID = B.MEMBER_ID WHERE `STATUSLUNAS` = 'False' AND (A.`MEMBER_ID` LIKE CONCAT('%',dimana1,'%') OR `NAMA` LIKE CONCAT('%',dimana1,'%')) LIMIT ditampilkan;
	ELSEIF dimana2 = 5 THEN
        SELECT DATE_FORMAT(BIGINTTODATETIME(MAX(`TANGGALBAYAR`)),'%d %M %Y'), DATE_FORMAT(BIGINTTODATETIME(MIN(`JATUHTEMPO`)),'%d %M %Y'), DATE_FORMAT(BIGINTTODATETIME(MAX(`JATUHTEMPO`)),'%d %M %Y') INTO lastpay, minvaluenya, maxvaluenya FROM 01_tms_piutangkredit WHERE `NOTRANSAKSI` = dimana6;
		SELECT `TRANSAKSI_ID`,`NAMA`, `TANGGALBAYAR`, `KASIR_ID`, `SISAPIUTANG`, `POTONGAN`,SUM(`BAYAR`) as BAYAR ,lastpay as LASTPAY, minvaluenya as JTPENDEK, maxvaluenya as JTAKHIR, `NOMINALBAYAR` FROM 01_tms_piutangkredit as A JOIN 01_tms_member as B ON A.MEMBER_ID = B.MEMBER_ID WHERE `NOTRANSAKSI` = dimana6;
	ELSEIF dimana2 = 6 THEN
		SET cekjumlah = (SELECT EXISTS(SELECT 1 FROM 01_tms_piutangkredit WHERE `MEMBER_ID` = dimana3 HAVING (SUM(`TOTALKREDIT`) - (SUM(`BAYAR`) + SUM(`POTONGAN`))) != 0));
		IF cekjumlah = 0 THEN
			UPDATE 01_tms_piutangkredit SET `STATUSLUNAS` = 'True' WHERE `MEMBER_ID` = dimana3 AND `STATUSLUNAS` = 'False';
		END IF;
	ELSEIF dimana2 = 7 THEN
		SELECT DISTINCT(A.`TRANSAKSI_ID`) as NOTATRANSAKASI, B.`TOTALKREDIT`, B.`KASIR_ID`,`NAMA`,`GRUP`,DATE_FORMAT(BIGINTTODATETIME(`AKHIRAKTIF`),'%d %M %Y') as AKHIRMEMBER FROM acirabag_pos_aciraba1.01_tms_piutangkreditlunas as A RIGHT JOIN 01_tms_piutangkredit as B ON A.MEMBER_ID = B.MEMBER_ID JOIN 01_tms_member as C ON A.`MEMBER_ID` = C.`MEMBER_ID` WHERE A.`MEMBER_ID` = dimana1 AND B.TOTALKREDIT <> 0 ORDER BY `AI` DESC LIMIT 5;
	ELSEIF dimana2 = 8 THEN
        SELECT `NOTRANSAKSI`,B.`MEMBER_ID`,`NAMA`, DATE_FORMAT(BIGINTTODATETIME(`TANGGALBAYAR`),'%d-%M-%Y') as `TANGGALBAYAR`, IF(`NOMINALBAYAR` >= `BAYAR`,SUM(`BAYAR`),SUM(`NOMINALBAYAR`)) as NOMINALBAYAR,SUM(`POTONGAN`) as POTONGAN,`KASIR_ID`,A.`KETERANGAN` FROM 01_tms_piutangkredit as A JOIN 01_tms_member as B ON A.MEMBER_ID = B.MEMBER_ID WHERE A.`KODEUNIKMEMBER` = dimana9 AND A.`LOKASI` = dimana10 AND `NOTARETURPOTONGPIUTANG` = "Bukan Potong Piutang" AND (TANGGALBAYAR BETWEEN dimana3 AND dimana4) AND (A.MEMBER_ID LIKE CONCAT('%',dimana1,'%') OR NAMA LIKE CONCAT('%',dimana1,'%')) AND IF (dimana6='D',`NOTRANSAKSI` = dimana7 AND A.KETERANGAN != 'Piutang', A.KETERANGAN != 'Piutang')  GROUP BY IF (dimana6='D',`TRANSAKSI_ID`,`NOTRANSAKSI`) ORDER BY CASE WHEN dimana5 = 'KODEASC' THEN B.MEMBER_ID END ASC , CASE WHEN dimana5 = 'NAMAASC' THEN NAMA END ASC , CASE WHEN dimana5 = 'TGLASC' THEN TANGGALBAYAR END ASC , CASE WHEN dimana5 = 'KODEDESC' THEN B.MEMBER_ID END DESC, CASE WHEN dimana5 = 'NAMADESC' THEN NAMA END DESC, CASE WHEN dimana5 = 'TGLDESC' THEN TANGGALBAYAR END DESC LIMIT datake, ditampilkan;
	ELSEIF dimana2 = 9 THEN
		SELECT `EMAIL`, B.`MEMBER_ID`,`NAMA`, SUM(`TOTALKREDIT` - `POTONGAN` - `BAYAR`) as SISAHUTANG , DATE_FORMAT(BIGINTTODATETIME(MIN(`JATUHTEMPO`)),'%d %M %Y') as TERDEKAT, DATE_FORMAT(BIGINTTODATETIME(MAX(`JATUHTEMPO`)),'%d %M %Y') as TERAKHIR  FROM 01_tms_piutangkredit as A JOIN 01_tms_member as B ON A.MEMBER_ID = B.MEMBER_ID WHERE `JATUHTEMPO` < dimana4 AND (B.`MEMBER_ID` LIKE CONCAT('%',dimana1,'%') OR `NAMA` LIKE CONCAT('%',dimana1,'%')) GROUP BY B.`MEMBER_ID` HAVING SISAHUTANG > 0 ORDER BY `TANGGALBAYAR` ASC LIMIT datake,ditampilkan ;
 END IF;
ELSEIF kondisi = 20 THEN
	IF dimana2 = 1 THEN
		SELECT `KODESUPPLIER`,`NAMASUPPLIER`,`ALAMATSUPPLIER` FROM 01_tms_supplier WHERE `KODESUPPLIER` LIKE CONCAT('%',dimana1,'%') OR `NAMASUPPLIER` LIKE CONCAT('%',dimana1,'%') LIMIT datake,ditampilkan;
 END IF;
ELSEIF kondisi = 100 THEN
	SELECT `PK_NOTAPENJUALAN`,`MINBELI`, `NAMABARANG`, `STOKBARANGKELUAR`, `HARGAJUALTIAP` as `HARGAJUALTIAPAPIK`,`HARGADASAR`,`HARGADASARGROSIR`, format(`HARGADASARGROSIR`,0) as HARGADASARGROSIRRP,(`STOKBARANGKELUAR` - COALESCE((TRUNCATE(`STOKBARANGKELUAR` /(`MINBELI` + `ADDSELF`),0)) * `MINBELI` + MOD(`STOKBARANGKELUAR`, (`MINBELI` + `ADDSELF`)),0)) AS STOKGRATIS, `KASIR`,`BAYAR` ,`NAMA`, `DISKON`, `CASHBANK`, `ALAMAT`, (IF(`ENUM_JENISTRANSAKSI` = 'TUNAI',0,`NOTRX`)) AS `NOTRX`,`NOKARTU`, `HARGAJUAL` AS `HSEBELUMDISC`, `ENUM_JENISTRANSAKSI`, DATE_FORMAT(`TGLKELUAR`,'%d-%m-%Y') as TGLKELUAR , `WAKTU`, `ENUM_TIPETRANSAKSI`,IF(`MEMBER_ID` = '1001',0,CONCAT('Rp. ',format((SELECT (SUM(IF(MINBELI > 0,(((`HARGADASARGROSIR` * ((TRUNCATE(STOKBARANGKELUARRETUR /(MINBELI + ADDSELF),0)) * MINBELI + MOD(STOKBARANGKELUARRETUR, (MINBELI+ADDSELF)))) - A.DISKON) * ((100 + A.`CASHBANK`) / 100)) ,(((`HARGADASARGROSIR` * (A.`STOKBARANGKELUARRETUR`)) - A.`DISKON`) * ((100 + A.`CASHBANK`) / 100)) ))) FROM 01_trs_barangkeluar as A WHERE LOKASI = dimana1 AND FK_MEMBER = B.MEMBER_ID),0),'.00')) as OMSET, IF(`MEMBER_ID` = '1001',0,`POINT`) as POIN, CONCAT('Rp. ',format(`SISASALDO`,0),'.00') as SISASALDO, A.`KETERANGAN` FROM 01_trs_barangkeluar as A JOIN 01_tms_member as B ON A.FK_MEMBER = B.MEMBER_ID WHERE `LOKASI` = dimana1 AND `PK_NOTAPENJUALAN` = dimana2;
ELSEIF kondisi = 101 THEN
	SELECT DISTINCT(`PK_NOTAPENJUALAN`) AS NOTATERAKHIR,`ENUM_JENISTRANSAKSI`,`NAMABANK`,FORMAT(((((HARGADASARGROSIR * (STOKBARANGKELUAR)) - DISKON) * ((100 + CASHBANK) / 100))),2) as TOTALNYA FROM 01_trs_barangkeluar WHERE `LOKASI` = dimana1 AND `ENUM_TIPETRANSAKSI` = dimana2 ORDER BY `AI_TRANSAKSIKELUAR` DESC LIMIT 1;
ELSEIF kondisi = 102 THEN
	SELECT DISTINCT(`PK_NOTAPENJUALAN`) AS NOTATERAKHIR,`ENUM_JENISTRANSAKSI`,`NAMABANK`,FORMAT(((((HARGADASARGROSIR * (STOKBARANGKELUAR)) - DISKON) * ((100 + CASHBANK) / 100))),2) as TOTALNYA  FROM 01_trs_barangkeluar WHERE `LOKASI` = dimana1 ORDER BY `AI_TRANSAKSIKELUAR` DESC LIMIT 1;
ELSEIF kondisi = 103 THEN
	SELECT DISTINCT(`PK_NOTAPENJUALAN`), `WAKTU`, `ENUM_JENISTRANSAKSI`, `NAMABANK` FROM 01_trs_barangkeluar WHERE DATE(`TGLKELUAR`) = dimana1 ORDER BY WAKTU DESC;
ELSEIF kondisi = 104 THEN
	SELECT DISTINCT(`PK_NOTAPENJUALAN`), `WAKTU`, `ENUM_JENISTRANSAKSI`, `NAMABANK` FROM 01_trs_barangkeluar WHERE `WAKTU` LIKE CONCAT('%',dimana2,'%') OR `PK_NOTAPENJUALAN` LIKE CONCAT('%',dimana2,'%') ORDER BY WAKTU DESC LIMIT 100;
ELSEIF kondisi = 105 THEN
	SELECT COALESCE(SUM(`DISPLAY`),0) as DISPLAY FROM 01_bnt_display WHERE `KODEBARANG` = dimana1 LIMIT datake,ditampilkan;
ELSEIF kondisi = 106 THEN
	SELECT A.`BARANG_ID`,`NAMABARANG`,`RAK_ID`, `HARGAJUAL`, (COALESCE(SUM(`DISPLAY`),0) + COALESCE(SUM(`QTYPROMO`),0) + COALESCE(SUM(`JUMLAH`),0) + COALESCE(SUM(`GUDANG`),0) + COALESCE(SUM(`ONLINE`),0)) as TOTADISPLAY ,`HARGABELI`,`EXPTANGGAL`, `STOKMINIMUM` FROM 01_tms_barangkharisma as A 
 LEFT JOIN 01_bnt_display as B ON A.`BARANG_ID` = B.`KODEBARANG` 
 LEFT JOIN 01_bnt_displaybonus as C ON A.`BARANG_ID` = C.`KODEBARANG` 
 LEFT JOIN 01_bnt_online as D ON A.`BARANG_ID` = D.`ONLINE` 
 LEFT JOIN 01_bnt_displaygabung as E ON A.`BARANG_ID` = E.`KODEBARANG` 
 LEFT JOIN 01_bnt_gudang as F ON A.`BARANG_ID` = F.`BARANG_ID` 
 WHERE (`NAMABARANG` LIKE CONCAT('%',dimana1,'%') OR A.`BARANG_ID` LIKE CONCAT('%',dimana1,'%')) AND `SUPPLER_ID` = dimana4 GROUP BY A.`BARANG_ID` HAVING 
 CASE
 WHEN dimana5 = "0" THEN (TOTADISPLAY BETWEEN dimana2 AND dimana3)
 WHEN dimana5 = "1" THEN (TOTADISPLAY < `STOKMINIMUM`)
 END ORDER BY `NAMABARANG` ASC LIMIT datake,ditampilkan;
ELSEIF kondisi = 107 THEN
	SELECT COUNT(*) INTO cekjumlah FROM 01_tms_barangkharisma as A JOIN 01_bnt_display as B ON A.`BARANG_ID` = B.`KODEBARANG` WHERE `BARANG_ID` LIKE CONCAT('%',dimana2,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana2,'%');
	IF dimana1 = 1 THEN
		SELECT cekjumlah, `BARANG_ID`,`NAMABARANG`,`RAK_ID`,`HARGAJUAL`,`DISPLAY` FROM 01_tms_barangkharisma as A JOIN 01_bnt_display as B ON A.`BARANG_ID` = B.`KODEBARANG` WHERE `BARANG_ID` LIKE CONCAT('%',dimana2,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana2,'%') LIMIT datake,ditampilkan;
	ELSEIF dimana1 = 2 THEN
		SELECT cekjumlah,A.`BARANG_ID`,`NAMABARANG`,A.`HARGAJUAL`,`MINBELITINGKAT1`, `DISCNONMEMBER1`, `DISCMEMBER1`, `MINBELITINGKAT2`, `DISCNONMEMBER2`, `DISCMEMBER2` FROM 01_tms_barangkharisma as A JOIN 01_tms_diskon as B ON A.`BARANG_ID` = B.`BARANG_ID` WHERE A.`BARANG_ID` LIKE CONCAT('%',dimana2,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana2,'%') LIMIT datake,ditampilkan;
 ELSEIF dimana1 = 3 THEN
		SELECT cekjumlah, A.`BARANG_ID`,`NAMABARANG`,`RAK_ID`,`SATUAN`,`HARGAJUAL`,`MINBELI`,`ADDSELF` FROM 01_tms_barangkharisma as A JOIN 01_tms_barangkharismabestbuy as B ON A.`BARANG_ID` = B.`KATBAR_ID` WHERE A.`BARANG_ID` LIKE CONCAT('%',dimana2,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana2,'%') LIMIT datake,ditampilkan;
	ELSEIF dimana1 = 5 THEN
		SELECT cekjumlah, A.`BARANG_ID`,`NAMABARANG`,`HARGAJUAL`,B.`SATUAN`,`JIKABELI`,`HARGABELIGROSIR` FROM 01_tms_barangkharisma as A JOIN 01_tms_bestbuybaranggrosir as B ON A.`BARANG_ID` = B.`BARANG_ID` WHERE A.`BARANG_ID` LIKE CONCAT('%',dimana2,'%') OR `NAMABARANG` LIKE CONCAT('%',dimana2,'%') LIMIT datake,ditampilkan;
 END IF;
ELSEIF kondisi = 108 THEN
/* jurnal penyesuaian untuk persediaan sampai FIX pembeliannya */
SELECT SUM(`DEBET` - `KREDIT`) INTO DATA1 FROM tefa_mart.01_akun_jurnalumum WHERE `KODEACC` = '1.1210' AND `LOKASI` = dimana1 AND `KODEUNIKMEMBER` = dimana2;
SELECT SUM((IFNULL((SELECT SUM(`DISPLAY`) FROM 01_bnt_display WHERE `KODEBARANG` = A.`BARANG_ID` AND `OUTLET` = A.`KODEAKUN` AND `KODEUNIKMEMBER` = A.`KODEUNIKMEMBER`),0) + 
		IFNULL((SELECT SUM(`GUDANG`) FROM 01_bnt_gudang WHERE `BARANG_ID` = A.`BARANG_ID` AND `OUTLET` = A.`KODEAKUN` AND `KODEUNIKMEMBER` = A.`KODEUNIKMEMBER`),0) +
		IFNULL((SELECT SUM(`ONLINE`) FROM 01_bnt_online WHERE `KODEBARANG` = A.`BARANG_ID` AND `OUTLET` = A.`KODEAKUN` AND `KODEUNIKMEMBER` = A.`KODEUNIKMEMBER`),0) +
		IFNULL((SELECT SUM(`RETUR`) FROM 01_bnt_retur WHERE `KODEBARANG` = A.`BARANG_ID` AND `OUTLET` = A.`KODEAKUN` AND `KODEUNIKMEMBER` = A.`KODEUNIKMEMBER`),0) +
		IFNULL((SELECT SUM(`QTYPROMO`) FROM 01_bnt_displaybonus WHERE `KODEBARANG`= A.`BARANG_ID` AND `JENIS` = 'BARANG' AND `OUTLET` = A.`KODEAKUN` AND `KODEUNIKMEMBER` = A.`KODEUNIKMEMBER`),0) +
		IFNULL((SELECT SUM(`QTYPROMO`) FROM 01_bnt_displaybonus WHERE `KODEBARANG`= A.`BARANG_ID` AND `JENIS` = 'KATEGORI' AND `OUTLET` = A.`KODEAKUN` AND `KODEUNIKMEMBER` = A.`KODEUNIKMEMBER`),0) +
		IFNULL((SELECT SUM(`QTYPROMO`) FROM 01_bnt_displaybonus WHERE `KODEBARANG`= A.`BARANG_ID` AND `JENIS` = 'RAKITAN' AND `OUTLET` = A.`KODEAKUN` AND `KODEUNIKMEMBER` = A.`KODEUNIKMEMBER`),0)) * HARGARATA) INTO DATA2 FROM 01_tms_barangkharisma as A WHERE `KODEAKUN` = dimana1 AND `KODEUNIKMEMBER` = dimana2 AND JASA = '0';	
	IF DATA1 != DATA2 THEN
		SELECT COUNT(*) INTO DATA4 FROM 01_akun_jurnalumum WHERE `NOTRANSAKSI` = CONCAT(dimana3,'-',dimana4,'-Sistem Auto Persediaan');
        IF DATA4 = 0 THEN
			INSERT INTO `01_akun_jurnalumum` (`AI`, `TIPEINPUT`, `NOTRANSAKSI`, `TGLTRANSAKSI`, `TGLJURNAL`, `KODEACC`, `KETERANGAN`, `DEBET`, `KREDIT`, `POSISI`, `JENIS`, `NOMOR`, `KASAL`, `KTUJUAN`, `LOKASI`, `KODEUNIKMEMBER`, `READONLY`) VALUES ('', 'TIDAK TAMPIL', CONCAT(dimana3,'-',dimana4,'-Sistem Auto Persediaan'), UNIX_TIMESTAMP(STR_TO_DATE(CONCAT(dimana3,",",dimana4,",02"), "%Y,%m,%d")), UNIX_TIMESTAMP(STR_TO_DATE(CONCAT(dimana3,",",dimana4,",02"), "%Y,%m,%d")), '1.1210', CONCAT(dimana3,'-',dimana4,'-Sistem Auto Persediaan'), DATA2 - DATA1, '0', '0', 'JURNAL', '1', 'NONE', 'NONE', dimana1, dimana2, 'TRUE');
			INSERT INTO `01_akun_jurnalumum` (`AI`, `TIPEINPUT`, `NOTRANSAKSI`, `TGLTRANSAKSI`, `TGLJURNAL`, `KODEACC`, `KETERANGAN`, `DEBET`, `KREDIT`, `POSISI`, `JENIS`, `NOMOR`, `KASAL`, `KTUJUAN`, `LOKASI`, `KODEUNIKMEMBER`, `READONLY`) VALUES ('', 'TIDAK TAMPIL', CONCAT(dimana3,'-',dimana4,'-Sistem Auto Persediaan'), UNIX_TIMESTAMP(STR_TO_DATE(CONCAT(dimana3,",",dimana4,",02"), "%Y,%m,%d")), UNIX_TIMESTAMP(STR_TO_DATE(CONCAT(dimana3,",",dimana4,",02"), "%Y,%m,%d")), '1.1110', CONCAT(dimana3,'-',dimana4,'-Sistem Auto Persediaan'), '0', DATA2 - DATA1, '0', 'JURNAL', '1', 'NONE', 'NONE', dimana1, dimana2, 'TRUE');
        ELSE
			UPDATE 01_akun_jurnalumum SET `DEBET` = (DATA2 - DATA1) WHERE `KREDIT` = '0' AND `NOTRANSAKSI` =  CONCAT(dimana3,'-',dimana4,'-Sistem Auto Persediaan') AND `KODEACC` = dimana1 AND `KODEUNIKMEMBER` = dimana2;
            UPDATE 01_akun_jurnalumum SET `KREDIT` = (DATA2 - DATA1) WHERE `DEBET` = '0' AND `NOTRANSAKSI` =  CONCAT(dimana3,'-',dimana4,'-Sistem Auto Persediaan') AND `KODEACC` = dimana1 AND `KODEUNIKMEMBER` = dimana2;
        END IF;
    END IF;
/* untuk website bukan core */
ELSEIF kondisi = 200 THEN
	SELECT COUNT(`AI_TRANSAKSIKELUAR`) as TOTALTRANSAKSI ,COALESCE(SUM(`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)),0) as TOTAL FROM 01_trs_barangkeluar WHERE DATE(`TGLKELUAR`) BETWEEN dimana1 AND dimana2;
ELSEIF kondisi = 201 THEN
	IF dimana1 = 1 THEN
		SELECT DISTINCT(`TOTALKREDIT`) - SUM(`BAYAR`) as TOTALHUTANG FROM acirabag_pos_aciraba1.01_tms_hutangtoko WHERE `TANGGALBAYAR` BETWEEN dimana2 AND dimana3 GROUP BY `SUPPLIER_ID`;
	ELSEIF dimana1 = 2 THEN
		SELECT COUNT(*) as TOTALTRANSAKSI , HOUR(`TGLKELUAR`) as JAMKELUAR, `FK_BARANG`,`NAMABARANG` ,SUM(STOKBARANGKELUAR) as TOTALKELUAR FROM 01_trs_barangkeluar WHERE DATE(`TGLKELUAR`) BETWEEN dimana2 AND dimana3
 GROUP BY 
 CASE
			WHEN dimana4 = "0" THEN `NAMABARANG`
			WHEN dimana4 = "1" THEN HOUR(`TGLKELUAR`)
		END
 ORDER BY
 CASE WHEN dimana4 = "0" THEN `STOKBARANGKELUAR` END DESC,
		CASE WHEN dimana4 = "1" THEN COUNT(*) END DESC
 LIMIT datake, ditampilkan;
	ELSEIF dimana1 = 3 THEN
		SELECT COUNT(`AI_TRANSAKSIKELUAR`) as TOTALTRANSAKSI ,COALESCE(SUM(`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)),0) as TOTAL, DAYNAME(DATE(`TGLKELUAR`)) as HARI, SUM(`STOKBARANGKELUAR`) TOTALKELUAR FROM 01_trs_barangkeluar WHERE DATE(`TGLKELUAR`) BETWEEN dimana2 AND dimana3 GROUP BY DAYNAME(DATE(TGLKELUAR));
	ELSEIF dimana1 = 4 THEN
		SELECT `MEMBER_ID`,`KEJARTARGET`,`NAMA`,A.`JENIS`,`POINT`,`MINIMALPOIN`,`GRUP`, COALESCE(SUM(`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)),0) as OMSET FROM 01_tms_member as A RIGHT JOIN 01_trs_barangkeluar as B ON A.MEMBER_ID = B.FK_MEMBER WHERE `MEMBER_ID` <> '1001' AND DATE(`TGLKELUAR`) BETWEEN dimana2 AND dimana3 GROUP BY `MEMBER_ID` ORDER BY COALESCE(SUM(`HARGAJUALTIAP` * (`STOKBARANGKELUAR`)),0) ASC LIMIT ditampilkan;
	ELSEIF dimana1 = 5 THEN
		SELECT COUNT(`FK_BARANG`) INTO cekjumlah FROM 01_trs_barangkeluar as A JOIN 01_tms_barangkharisma as B ON A.`FK_BARANG` = B.`BARANG_ID` WHERE DATE(`TGLKELUAR`) = CURDATE();
		SELECT COUNT(`FK_BARANG`) INTO adadata FROM 01_trs_barangkeluar as A JOIN 01_tms_barangkharisma as B ON A.FK_BARANG = B.BARANG_ID JOIN 01_tms_barangsatuan as C ON B.SATUAN = C.NAMASATUAN WHERE DATE(`TGLKELUAR`) = CURDATE() AND (A.`NAMABARANG` LIKE CONCAT('%',dimana2,'%') OR `FK_BARANG` LIKE CONCAT('%',dimana2,'%'));
		SELECT cekjumlah, adadata, `FK_BARANG`, A.`NAMABARANG`,`STOKBARANGKELUAR`,A.`HARGADASAR`,A.`DISKON`,`POTONGANVCH` FROM 01_trs_barangkeluar as A JOIN 01_tms_barangkharisma as B ON A.FK_BARANG = B.BARANG_ID JOIN 01_tms_barangsatuan as C ON B.SATUAN = C.NAMASATUAN WHERE DATE(`TGLKELUAR`) = CURDATE() AND (A.`NAMABARANG` LIKE CONCAT('%',dimana2,'%') OR `FK_BARANG` LIKE CONCAT('%',dimana2,'%')) LIMIT datake,ditampilkan;
 END IF;
END IF;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for proc_Controller_Website
-- ----------------------------
DROP PROCEDURE IF EXISTS `proc_Controller_Website`;
delimiter ;;
CREATE PROCEDURE `proc_Controller_Website`(IN `kondisi` INT, IN `dimana1` VARCHAR(255), IN `dimana2` VARCHAR(255), IN `dimana3` VARCHAR(255), IN `dimana4` VARCHAR(255), IN `dimana5` VARCHAR(255), IN `dimana6` VARCHAR(255), IN `dimana7` VARCHAR(255), IN `dimana8` VARCHAR(255), IN `dimana9` VARCHAR(255), IN `dimana10` VARCHAR(255),IN `dimana11` VARCHAR(255),IN `dimana12` VARCHAR(255),IN `dimana13` VARCHAR(255),IN `dimana14` VARCHAR(255),IN `dimana15` VARCHAR(255),IN `dimana16` VARCHAR(255),IN `dimana17` VARCHAR(255),IN `dimana18` VARCHAR(255),IN `dimana19` VARCHAR(255),IN `dimana20` VARCHAR(255), IN `datake` INT, IN `ditampilkan` INT)
BEGIN
		DECLARE BATASWAKTU, TOTALWAKTU, TOTALORANG VARCHAR(255);
		DECLARE TOTALMEMBER, ITEMAKTIF, ITEMAKTIFKUANTITI, TOTALPEMBELIAN DOUBLE(15,2);
		IF kondisi = 1 THEN
			SELECT * FROM 01_tms_barangkharisma as A JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID LEFT JOIN 01_tms_barangitemcitra as C ON A.FILECITRA = C.FILENAME WHERE (A.NAMABARANG LIKE CONCAT('%',dimana1,'%') OR A.BARANG_ID LIKE CONCAT('%',dimana1,'%')) AND KATEGORI_ID LIKE CONCAT('%',dimana2,'%') AND B.OUTLET = dimana19 AND A.KODEUNIKMEMBER = dimana20 AND B.KODEUNIKMEMBER = dimana20 AND A.AKTIF = '1' AND A.BARANG_ID != "ACI100000100000001" LIMIT datake,ditampilkan;
		ELSEIF kondisi = 2 THEN
			SELECT *, (SELECT DP FROM 01_tms_resto_pesanmeja WHERE KODEMENUPESANAN = A.PK_NOTAPENJUALAN AND OUTLET = A.LOKASI AND KODEUNIKMEMBER = A.KODEUNIKMEMBER) as DPPESANAN, MAX(STATUSBARANGPROSES) as MAXPROSES, MIN(STATUSBARANGPROSES) as MINPROSES, A.AI_TRANSAKSIKELUAR as URUTANAIKELUAR, DATE_FORMAT(TGLKELUAR,'%d-%m-%Y %H:%i:%s') as WAKTUTRANSAKSI, CONCAT(DATE_FORMAT(TGLKELUAR, '%d-%m-%Y'),' ',WAKTU) as WAKTUPEMBAYARAN, (SUM(B.HARGAJUAL * B.STOKBARANGKELUAR) - A.NOMINALPOTONGAN) as TOTALBELANJA FROM 01_trs_barangkeluar as A JOIN 01_trs_barangkeluar_detail as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN WHERE (A.PK_NOTAPENJUALAN LIKE CONCAT('%',dimana1,'%') OR KETERANGAN LIKE CONCAT('%',dimana1,'%')) AND (DATE(TGLKELUAR) BETWEEN dimana2 AND dimana3) AND A.KODEUNIKMEMBER = dimana20 AND B.KODEUNIKMEMBER = dimana20 GROUP BY A.PK_NOTAPENJUALAN ORDER BY A.TGLKELUAR DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 3 THEN
			SELECT *,A.AI_TRANSAKSIKELUAR as AITRX, C.NAMA as NAMAMEMBER, TOTALBELANJA, COUNT(*) as TOTALBARANGKELUAR FROM 01_trs_barangkeluar as A 
			JOIN 01_trs_barangkeluar_detail as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN 
			JOIN 01_tms_member as C ON A.FK_MEMBER = C.MEMBER_ID 
			JOIN 01_tms_penggunaaplikasi as D ON A.KASIR = D.PENGGUNA_ID 
			JOIN 01_tms_barangkharisma as E ON B.FK_BARANG= E.BARANG_ID
			WHERE A.`ENUM_JENISTRANSAKSI` LIKE CONCAT('%',dimana7,'%') AND
			CASE
				WHEN dimana6 = 'nota' THEN A.`PK_NOTAPENJUALAN` LIKE CONCAT('%',dimana5,'%')
        WHEN dimana6 = 'barang' THEN E.`NAMABARANG` LIKE CONCAT('%',dimana5,'%')
        WHEN dimana6 = 'member' THEN C.`NAMA` LIKE CONCAT('%',dimana5,'%')
      END	AND (DATE(A.TGLKELUAR) BETWEEN dimana3 AND dimana4) AND A.LOKASI = dimana10 AND A.KODEUNIKMEMBER = dimana9 AND B.KODEUNIKMEMBER = dimana9 AND C.KODEUNIKMEMBER = dimana9 AND D.KODEUNIKMEMBER = dimana9 AND E.KODEUNIKMEMBER = dimana9 GROUP BY A.PK_NOTAPENJUALAN ORDER BY DATE(A.TGLKELUAR) DESC,A.WAKTU DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 4 THEN
			SELECT *,A.KETERANGAN ,D.NAMAPENGGUNA as USERNAMELOGIN, C.NAMA as NAMAMEMBER, F.NAMA as NAMASALESMAN,G.TOTALBELANJA as PESANANTOTALBELANJA, A.TOTALBELANJA, B.HARGAJUAL as HARGAJUALKELUAR, A.KETERANGAN as KETERANGANTRX, A.LOKASI, A.KODEUNIKMEMBER FROM 01_trs_barangkeluar as A 
			JOIN 01_trs_barangkeluar_detail as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN 
			JOIN 01_tms_member as C ON A.FK_MEMBER = C.MEMBER_ID 
			JOIN 01_tms_penggunaaplikasi as D ON A.KASIR = D.PENGGUNA_ID 
			JOIN 01_tms_barangkharisma as E ON B.FK_BARANG= E.BARANG_ID
			JOIN 01_tms_sales as F ON A.FK_SALESMAN = F.KODESALES
			LEFT JOIN 01_tms_resto_pesanmeja as G ON A.PK_NOTAPENJUALAN = G.KODEMENUPESANAN
			WHERE A.AI_TRANSAKSIKELUAR = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2 AND C.KODEUNIKMEMBER = dimana2 AND D.KODEUNIKMEMBER = dimana2 AND E.KODEUNIKMEMBER = dimana2 AND F.KODEUNIKMEMBER = dimana2 AND (G.KODEUNIKMEMBER IS NULL OR G.KODEUNIKMEMBER = dimana2);
		ELSEIF kondisi = 5 THEN
			SELECT B.AI_TRANSAKSIKELUAR, FK_BARANG, NAMABARANG, HARGABELI, HARGAJUAL, NAMA, CONCAT(DATE_FORMAT(DATE(TGLKELUAR), '%d-%m-%Y'),' ',WAKTU) as TANGGALTRX, A.PK_NOTAPENJUALAN FROM 01_trs_barangkeluar_detail as A JOIN 01_trs_barangkeluar as B ON A. PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN JOIN 01_tms_member as C ON B.FK_MEMBER = C.MEMBER_ID WHERE 
			CASE
				WHEN DIMANA1 = 'barang' THEN A.`FK_BARANG` LIKE CONCAT('%',dimana2,'%')
        WHEN DIMANA1 = 'namabarang' THEN `NAMABARANG` LIKE CONCAT('%',dimana2,'%')
        WHEN DIMANA1 = 'namamember' THEN `NAMA` LIKE CONCAT('%',dimana2,'%')
      END AND (DATE(TGLKELUAR) BETWEEN dimana3 AND dimana4)	AND LOKASI = DIMANA6 AND A.KODEUNIKMEMBER = DIMANA5 AND B.KODEUNIKMEMBER = DIMANA5 AND C.KODEUNIKMEMBER = DIMANA5 LIMIT datake,ditampilkan;
		ELSEIF kondisi = 6 THEN
			SELECT *,A.JATUHTEMPO as JATUHTEMPO ,C.NAMA as NAMAMEMBER FROM 01_tms_piutangkredit as A
			JOIN 01_tms_penggunaaplikasi as B ON A.KASIR_ID = B.PENGGUNA_ID
			JOIN 01_tms_member as C ON A.MEMBER_ID = C.MEMBER_ID
			JOIN 01_trs_barangkeluar as D ON A.TRANSAKSI_ID = D.PK_NOTAPENJUALAN
			WHERE (TRANSAKSI_ID LIKE CONCAT('%',dimana1,'%') OR C.NAMA LIKE CONCAT('%',dimana1,'%') OR A.MEMBER_ID LIKE CONCAT('%',dimana1,'%')) AND (A.JATUHTEMPO BETWEEN dimana2 AND dimana3) AND A.KODEUNIKMEMBER = dimana4 AND B.KODEUNIKMEMBER = dimana4 AND C.KODEUNIKMEMBER = dimana4 AND D.KODEUNIKMEMBER = dimana4 AND A.KODEUNIKMEMBER = dimana4 ORDER BY DATE(TGLKELUAR),WAKTU DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 7 THEN
			SELECT * FROM 01_trs_barangkeluar as A JOIN 01_tms_piutangkredit as B ON A.PK_NOTAPENJUALAN = B.TRANSAKSI_ID WHERE B.MEMBER_ID = dimana1 AND SISAKREDIT > 0 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2 AND LOKASI = dimana3;
		ELSEIF kondisi = 8 THEN
			SELECT *,SUM(TOTALKREDIT) as SUMTOTALKREDIT, SUM(SISAKREDIT) as SUMSISAKREDIT FROM 01_tms_member as A JOIN 01_tms_piutangkredit as B ON A.MEMBER_ID = B.MEMBER_ID WHERE B.MEMBER_ID = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2;
		ELSEIF kondisi = 9 THEN
			SELECT *, A.AI as URUTANPEMBAYARAN, C.NAMA as NAMAMEMBER, SUM(BAYAR) as TOTALBAYAR FROM `01_tms_piutangkredit_detail` as A
			JOIN 01_tms_piutangkredit as B ON A.TRANSAKSI_ID = B.TRANSAKSI_ID
			JOIN 01_tms_member as C ON B.MEMBER_ID = C.MEMBER_ID
			JOIN 01_tms_penggunaaplikasi as D ON B.KASIR_ID = D.PENGGUNA_ID
			WHERE (B.MEMBER_ID LIKE CONCAT('%',dimana1,'%') OR C.NAMA LIKE CONCAT('%',dimana1,'%')) AND (A.TANGGALBAYAR BETWEEN dimana2 AND dimana3) AND LOKASI = dimana4 AND A.KODEUNIKMEMBER = dimana5 AND B.KODEUNIKMEMBER = dimana5 AND C.KODEUNIKMEMBER = dimana5 AND D.KODEUNIKMEMBER = dimana5 GROUP BY A.NOTRANSAKSI ORDER BY A.TANGGALBAYAR DESC ,A.WAKTU DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 10 THEN
			SELECT *,A.AI as BARISBDETAILBAYAR FROM 01_tms_piutangkredit_detail as A
			JOIN 01_tms_piutangkredit as B ON A.TRANSAKSI_ID = B.TRANSAKSI_ID
			WHERE A.NOTRANSAKSI = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2;
		ELSEIF kondisi = 11 THEN
			SELECT * FROM 01_tms_supplier WHERE KODESUPPLIER LIKE CONCAT('%',dimana1,'%') AND KODEUNIKMEMBER = dimana2 LIMIT datake,ditampilkan;
		ELSEIF kondisi = 12 THEN
			SELECT * FROM 01_tms_barangkharisma as A 
			JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID
			JOIN 01_tms_kategori as C ON A.KATEGORI_ID = C.KATEGORIPARENT_ID
			WHERE B.OUTLET = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2 AND C.KODEUNIKMEMBER = dimana2 AND (A.BARANG_ID LIKE CONCAT('%',dimana3,'%') OR A.NAMABARANG LIKE CONCAT('%',dimana3,'%')) LIMIT 2;
		ELSEIF kondisi = 13 THEN
			SELECT *,A.PK_BARANGMASUK as AIBARANGMASUK, COUNT(*) as TOTALBELANJA FROM 01_trs_barangmasuk as A
			JOIN 01_trs_barangmasuk_detail as B ON A.NOTA = B.NOTA
			JOIN 01_tms_barangkharisma as C ON B.KODEBARANG = C.BARANG_ID
			JOIN 01_tms_supplier as D ON A.FK_SUPPLIER = D.KODESUPPLIER
			JOIN 01_tms_penggunaaplikasi as E ON A.PETUGAS = E.PENGGUNA_ID
			WHERE 
			CASE
				WHEN DIMANA1 = 'notrx' THEN A.`NOTA` LIKE CONCAT('%',dimana2,'%')
        WHEN DIMANA1 = 'kodeitem' THEN B.KODEBARANG LIKE CONCAT('%',dimana2,'%')
        WHEN DIMANA1 = 'namabarang' THEN B.`NAMABARANG` LIKE CONCAT('%',dimana2,'%')
				WHEN DIMANA1 = 'namapetugas' THEN `NAMAPENGGUNA` LIKE CONCAT('%',dimana2,'%')
				WHEN DIMANA1 = 'namasuplier' THEN `NAMASUPPLIER` LIKE CONCAT('%',dimana2,'%')
      END AND (DATE(TANGGALTRS) BETWEEN dimana3 AND dimana4) AND A.OUTLET = dimana5 AND A.KODEUNIKMEMBER = dimana6 AND B.KODEUNIKMEMBER = dimana6 AND C.KODEUNIKMEMBER = dimana6 AND D.KODEUNIKMEMBER = dimana6 AND E.KODEUNIKMEMBER = dimana6 
			GROUP BY A.NOTA ORDER BY A.TANGGALTRS DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 14 THEN
			SELECT * FROM 01_trs_barangmasuk as A
			JOIN 01_trs_barangmasuk_detail as B ON A.NOTA = B.NOTA
			JOIN 01_tms_supplier as C ON A.FK_SUPPLIER = C.KODESUPPLIER
			JOIN 01_tms_perusahaan as D ON A.DARISUBPERUSAHAAN = D.KODEPERUSAHAAN
			WHERE A.PK_BARANGMASUK = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER AND C.KODEUNIKMEMBER = dimana2 AND D.KODEUNIKMEMBER = dimana2;
		ELSEIF kondisi = 15 THEN
			SELECT *, A.NOTA as NOMORNOTA, A.PK_BARANGMASUK as AIBARANGMASK FROM 01_trs_barangmasuk as A
			JOIN 01_trs_barangmasuk_detail as B ON A.NOTA = B.NOTA
			JOIN 01_tms_supplier as C ON A.FK_SUPPLIER = C.KODESUPPLIER
			WHERE 
			CASE
				WHEN DIMANA1 = 'barang' THEN B.`KODEBARANG` LIKE CONCAT('%',dimana2,'%')
        WHEN DIMANA1 = 'namabarang' THEN B.NAMABARANG LIKE CONCAT('%',dimana2,'%')
        WHEN DIMANA1 = 'namasuplier' THEN C.`NAMASUPPLIER` LIKE CONCAT('%',dimana2,'%')
      END AND 
			A.OUTLET = dimana6 AND A.KODEUNIKMEMBER = dimana5 AND B.KODEUNIKMEMBER = dimana5 AND C.KODEUNIKMEMBER = dimana5 GROUP BY A.NOTA ORDER BY TANGGALTRS DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 16 THEN
			SELECT *, SUM(TOTALKREDIT) as TOTALHUANG, SUM(SISAKREDIT) as SISAHUTANG FROM 01_tms_hutangtoko as A
			JOIN 01_tms_supplier as B ON A.SUPPLIER_ID = B.KODESUPPLIER
			WHERE A.SUPPLIER_ID = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2;
		ELSEIF kondisi = 17 THEN
			SELECT * FROM 01_trs_barangmasuk as A JOIN 01_tms_hutangtoko as B ON A.NOTA = B.NOTRANSAKSI WHERE A.FK_SUPPLIER = dimana1 AND SISAKREDIT > 0 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2 AND A.OUTLET = dimana3;
		ELSEIF kondisi = 18 THEN
			SELECT * FROM 01_tms_hutangtoko as A
			JOIN 01_trs_barangmasuk as B ON A.NOTRANSAKSI = B.NOTA
			JOIN 01_tms_supplier as C ON B.FK_SUPPLIER = C.KODESUPPLIER
			JOIN 01_tms_penggunaaplikasi as D ON B.PETUGAS = D.PENGGUNA_ID
			WHERE (B.NOTA LIKE CONCAT('%',dimana1,'%') OR B.FK_SUPPLIER LIKE CONCAT('%',dimana1,'%') OR C.NAMASUPPLIER LIKE CONCAT('%',dimana1,'%')) AND (A.JATUHTEMPO BETWEEN dimana2 AND dimana3) AND B.OUTLET = dimana5 AND C.KODEUNIKMEMBER = dimana4 AND A.KODEUNIKMEMBER = dimana4 ORDER BY B.TANGGALTRS DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 19 THEN
				SELECT *,A.NOTRANSAKSI as NOTABAYAR, SUM(BAYAR) as TOTALBAYAR FROM 01_tms_hutangtoko_detail as A
				JOIN 01_tms_hutangtoko as B ON A.TRANSAKSI_ID = B.NOTRANSAKSI
				JOIN 01_tms_supplier as C ON B.SUPPLIER_ID = C.KODESUPPLIER
				JOIN 01_tms_penggunaaplikasi as D ON A.PETUGAS = D.PENGGUNA_ID
				WHERE (KODESUPPLIER LIKE CONCAT('%',dimana1,'%') AND NAMASUPPLIER LIKE CONCAT('%',dimana1,'%') AND A.TRANSAKSI_ID LIKE CONCAT('%',dimana1,'%')) AND (TANGGALTRS BETWEEN dimana2 AND dimana3) AND A.LOKASI = dimana5 AND A.KODEUNIKMEMBER = dimana4 AND B.KODEUNIKMEMBER = dimana4 AND C.KODEUNIKMEMBER = dimana4 AND D.KODEUNIKMEMBER = dimana4 GROUP BY A.NOTRANSAKSI ORDER BY A.TANGGALTRS DESC, A.WAKTU DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 20 THEN
			SELECT *,A.AI as BARISBDETAILBAYAR,A.NOTRANSAKSI as NOTABAYAR FROM 01_tms_hutangtoko_detail as A
			JOIN 01_tms_hutangtoko as B ON A.TRANSAKSI_ID = B.NOTRANSAKSI
			WHERE A.NOTRANSAKSI = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2;
		ELSEIF kondisi = 21 THEN
			SELECT *, A.NOTAOPNAME as NOTAOP FROM 01_trs_opname as A
			JOIN 01_trs_opname_detail as B ON A.NOTAOPNAME = B.NOTAOPNAME
			JOIN 01_tms_barangkharisma as C ON B.KODEBARANG = C.BARANG_ID
			JOIN 01_tms_penggunaaplikasi as D ON A.PETUGAS = D.PENGGUNA_ID
			WHERE 
			CASE
				WHEN DIMANA1 = 'notrx' THEN A.`NOTAOPNAME` LIKE CONCAT('%',DIMANA2,'%')
        WHEN DIMANA1 = 'kodeitem' THEN C.`BARANG_ID` LIKE CONCAT('%',DIMANA2,'%')
        WHEN DIMANA1 = 'namaitem' THEN C.`NAMABARANG` LIKE CONCAT('%',DIMANA2,'%')
      END AND B.`LOKASIOPNAME` LIKE CONCAT('%',DIMANA3,'%') AND (`TANGGALTRS` BETWEEN DIMANA4 AND DIMANA5) AND A.OUTLET = DIMANA6 AND A.KODEUNIKMEMBER = DIMANA7 AND B.KODEUNIKMEMBER = DIMANA7 AND C.KODEUNIKMEMBER = DIMANA7 AND D.KODEUNIKMEMBER = DIMANA7 GROUP BY A.`NOTAOPNAME` ORDER BY `TANGGALTRS` DESC LIMIT datake, ditampilkan;
		ELSEIF kondisi = 22 THEN
			SELECT * FROM 01_trs_opname_detail as A
			JOIN 01_tms_barangkharisma as B ON A.KODEBARANG = B.BARANG_ID
			WHERE NOTAOPNAME = dimana1 AND A.OUTLET = dimana3 AND A.KODEUNIKMEMBER = dimana4 AND B.KODEUNIKMEMBER = dimana4;
		ELSEIF kondisi = 23 THEN
			SELECT *,A.NOMORMUTASI as NOTRX, COUNT(*) as TOTALMUTASIDATA, SUM(STOKMUTASI * NOMINAL) as TOTALNOMINALMUTASI FROM 01_trs_mutasibarang as A
			JOIN 01_trs_mutasibarang_detail as B ON A.NOMORMUTASI = B.NOMORMUTASI
			JOIN 01_tms_barangkharisma as C ON B.KODEBARANG = C.BARANG_ID
			JOIN 01_tms_penggunaaplikasi as D ON A.PETUGAS = D.PENGGUNA_ID
			WHERE A.OUTLET = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND
			CASE
				WHEN DIMANA3 = 'notrx' THEN A.NOMORMUTASI LIKE CONCAT('%',dimana4,'%')
        WHEN DIMANA3 = 'kodeitem' THEN B.KODEBARANG LIKE CONCAT('%',dimana4,'%')
        WHEN DIMANA3 = 'namaitem' THEN C.`NAMABARANG` LIKE CONCAT('%',dimana4,'%')
      END AND (A.TANGGALTRS BETWEEN dimana5 AND dimana6) AND
			CASE
				WHEN DIMANA7 = 'true' THEN ASALOUTLET = dimana8 AND ASALLOKASIITEM = dimana9 AND ASALOUTLET = dimana10 AND TUJUANLOKASIITEM = dimana11
        WHEN DIMANA7 = 'false' THEN 1 = 1
      END
			GROUP BY A.NOMORMUTASI ORDER BY A.TANGGALTRS DESC LIMIT datake,ditampilkan;
		ELSEIF kondisi = 24 THEN
			SELECT * FROM 01_trs_mutasibarang_detail as A
			JOIN 01_tms_barangkharisma as B ON A.KODEBARANG = B.BARANG_ID
			WHERE NOMORMUTASI = dimana1 AND OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3;
		ELSEIF kondisi = 25 THEN
			SELECT *,A.PK_NOTAPENJUALAN as NOTAPENJUALAN FROM 01_trs_barangkeluar as A
			JOIN 01_trs_barangkeluar_detail as B ON A.PK_NOTAPENJUALAN = B.PK_NOTAPENJUALAN
			WHERE A.PK_NOTAPENJUALAN = dimana1 AND A.LOKASI = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3 ORDER BY B.NAMABARANG ASC;
		ELSEIF kondisi = 26 THEN
			SELECT * FROM 01_tms_barangkharisma as A
			JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID
			WHERE A.BARANG_ID = dimana1 AND B.OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3;
		ELSEIF kondisi = 27 THEN
			SELECT *,C.NAMA as NAMA, A.AI as BARISRETUR FROM 01_trs_returpenjualan as A 
			JOIN 01_trs_returpenjualan_detail as B ON A.NOTRXRETUR = B.NOTRXRETUR
			JOIN 01_tms_member as C ON A.IDPELANGGAN = C.MEMBER_ID
			JOIN 01_tms_barangkharisma as D ON B.KODEBARANG = D.BARANG_ID
			JOIN 01_tms_penggunaaplikasi as E ON A.PETUGAS = E.PENGGUNA_ID
			WHERE 
			CASE
				WHEN DIMANA1 = 'notrx' THEN A.`NOTRXRETUR` LIKE CONCAT('%',DIMANA2,'%')
        WHEN DIMANA1 = 'kodeitem' THEN B.`KODEBARANG` LIKE CONCAT('%',DIMANA2,'%')
        WHEN DIMANA1 = 'namaitem' THEN D.`NAMABARANG` LIKE CONCAT('%',DIMANA2,'%')
				WHEN DIMANA1 = 'kodemember' THEN C.`MEMBER_ID` LIKE CONCAT('%',DIMANA2,'%')
				WHEN DIMANA1 = 'namamember' THEN C.`NAMA` LIKE CONCAT('%',DIMANA2,'%')
      END AND (TANGGALRETUR BETWEEN dimana3 AND dimana4) AND A.OUTLET = dimana5 AND A.KODEUNIKMEMBER = dimana6 AND B.KODEUNIKMEMBER = dimana6 AND C.KODEUNIKMEMBER = dimana6 AND D.KODEUNIKMEMBER = dimana6 AND E.KODEUNIKMEMBER = dimana6 GROUP BY A.`NOTRXRETUR` LIMIT datake,ditampilkan;
		ELSEIF kondisi = 28 THEN
			SELECT *,A.NOTRXRETUR FROM 01_trs_returpenjualan as A
			JOIN 01_trs_returpenjualan_detail as B ON A.NOTRXRETUR = B.NOTRXRETUR
			JOIN 01_tms_member as C ON A.IDPELANGGAN = C.MEMBER_ID
			WHERE A.AI = dimana1 AND A.OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3 AND C.KODEUNIKMEMBER = dimana3;
		ELSEIF kondisi = 29 THEN
			SELECT * FROM 01_trs_barangmasuk as A
			JOIN 01_trs_barangmasuk_detail as B ON A.NOTA = B.NOTA
			WHERE A.NOTA = dimana1 AND A.OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3 ;
		ELSEIF kondisi = 30 THEN
			SELECT * FROM 01_tms_barangkharisma as A
			JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID
			JOIN 01_trs_barangmasuk_detail as C ON A.BARANG_ID = C.KODEBARANG
			WHERE A.BARANG_ID = dimana1 AND B.OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3 AND C.KODEUNIKMEMBER = dimana3;
		ELSEIF kondisi = 31 THEN
			SELECT JATUHTEMPO,TOTALKREDIT,SISAKREDIT,A.NOTRANSAKSI as NOTRANSAKSI, A.AI as BARISAI, COALESCE((SELECT BAYAR FROM 01_tms_hutangtoko_detail WHERE NOTARETURBELI = dimana2 AND TRANSAKSI_ID = A.NOTRANSAKSI),0) as BAYAR FROM 01_tms_hutangtoko as A WHERE A.SUPPLIER_ID = dimana1 AND A.KODEUNIKMEMBER = dimana3 AND A.SISAKREDIT > 0 GROUP BY A.NOTRANSAKSI;
		ELSEIF kondisi = 32 THEN
			SELECT *,A.NOTRXRETURBELI, A.AI as BARISRETUR FROM 01_trs_returpembelian as A
			JOIN 01_trs_returpembelian_detail as B ON A.NOTRXRETURBELI = B.NOTRXRETURBELI
			JOIN 01_tms_penggunaaplikasi as C ON A.PETUGAS = C.PENGGUNA_ID
			JOIN 01_tms_supplier as D ON A.SUPPLIERID = D.KODESUPPLIER
			JOIN 01_tms_barangkharisma as E ON B.KODEBARANG = E.BARANG_ID
			WHERE (DATE(A.TANGGALTRS) BETWEEN DIMANA3 AND DIMANA4) AND
			CASE
				WHEN DIMANA1 = 'notrx' THEN A.`NOTRXRETURBELI` LIKE CONCAT('%',DIMANA2,'%')
        WHEN DIMANA1 = 'kodeitem' THEN B.`KODEBARANG` LIKE CONCAT('%',DIMANA2,'%')
        WHEN DIMANA1 = 'namaitem' THEN E.`NAMABARANG` LIKE CONCAT('%',DIMANA2,'%')
				WHEN DIMANA1 = 'kodesuplier' THEN D.`KODESUPPLIER` LIKE CONCAT('%',DIMANA2,'%')
				WHEN DIMANA1 = 'namasuplier' THEN D.`NAMASUPPLIER` LIKE CONCAT('%',DIMANA2,'%')
      END AND A.OUTLET = dimana5 AND A.KODEUNIKMEMBER = dimana6 AND B.KODEUNIKMEMBER = dimana6 AND C.KODEUNIKMEMBER = dimana6 AND D.KODEUNIKMEMBER = dimana6 AND E.KODEUNIKMEMBER = dimana6 GROUP BY A.`NOTRXRETURBELI` LIMIT datake,ditampilkan;
		ELSEIF kondisi = 33 THEN
			SELECT *,A.NOTRXRETURBELI FROM 01_trs_returpembelian as A
			JOIN 01_trs_returpembelian_detail as B ON A.NOTRXRETURBELI = B.NOTRXRETURBELI
			JOIN 01_tms_supplier as C ON A.SUPPLIERID = C.KODESUPPLIER
			WHERE A.AI = dimana1 AND A.OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3 AND C.KODEUNIKMEMBER = dimana3; 
		ELSEIF kondisi = 34 THEN
			SELECT *,A.NAMABARANG FROM 01_trs_barangmasuk_detail as A
			JOIN 01_tms_barangkharisma as B ON A.KODEBARANG = B.BARANG_ID
			WHERE A.NOTA = dimana1 AND A.OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3;
		ELSEIF kondisi = 35 THEN
			SELECT *,B.HARGA as HARGATAMBAHAN,A.BARANG_ID as KODEBARANG FROM 01_tms_barangkharisma as A
			LEFT JOIN 01_tms_bestbuybarangtambahan as B ON A.BARANG_ID = B.BARANG_ID
			WHERE A.BARANG_ID = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND (B.KODEUNIKMEMBER IS NULL OR B.KODEUNIKMEMBER = dimana2);
		ELSEIF kondisi = 36 THEN
			SELECT COUNT(*) INTO TOTALMEMBER FROM 01_tms_member WHERE KODEUNIKMEMBER = dimana1;
			SELECT COUNT(*),COALESCE(SUM(DISPLAY) + SUM(GUDANG) + SUM(RETUR),0)	 INTO ITEMAKTIF,ITEMAKTIFKUANTITI  FROM 01_tms_barangkharisma as A
			JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID
			/*JOIN 01_tms_perusahaan as C ON A.PEMILIK = C.KODEPERUSAHAAN
			JOIN 01_tms_principal as D ON A.PARETO_ID = D.PRINCIPAL_ID
			JOIN 01_tms_supplier as E ON A.SUPPLER_ID = E.KODESUPPLIER
			JOIN 01_tms_kategori as F ON A.KATEGORI_ID = F.KATEGORIPARENT_ID
			JOIN 01_tms_brand as G ON A.BRAND_ID = G.BRAND_ID*/ WHERE A.KODEUNIKMEMBER = dimana1 AND B.KODEUNIKMEMBER = dimana2 AND B.OUTLET = dimana2 AND A.AKTIF = 1;
			SELECT TOTALMEMBER, ITEMAKTIF, ITEMAKTIFKUANTITI;
		ELSEIF kondisi = 37 THEN
			/*SELECT COUNT(*) INTO TOTALPEMBELIAN FROM 01_trs_barangmasuk WHERE TANGGALTRS = CURDATE() AND KODEUNIKMEMBER = dimana1;*/
			SELECT COUNT(*) as BANYAKTRX, COALESCE(SUM(TOTALBELANJA),0) as TOTALBELANJA FROM 01_trs_barangkeluar WHERE DATE(TGLKELUAR) = CURDATE() AND KODEUNIKMEMBER = dimana1;
		ELSEIF kondisi = 38 THEN
			SELECT WAKTU, A.PK_NOTAPENJUALAN, SUM(STOKBARANGKELUAR) as JUMLAHBELANJA, TOTALBELANJA, LOKASI, KASIR, NAMAPENGGUNA FROM 01_trs_barangkeluar as A 
			JOIN 01_tms_penggunaaplikasi as B ON A.KASIR = B.PENGGUNA_ID
			JOIN 01_trs_barangkeluar_detail as C ON A.PK_NOTAPENJUALAN = C.PK_NOTAPENJUALAN
			WHERE DATE(TGLKELUAR) = CURDATE() AND A.LOKASI = dimana1 AND A.KODEUNIKMEMBER = dimana2 AND B.KODEUNIKMEMBER = dimana2 AND C.KODEUNIKMEMBER = dimana2 GROUP BY A.PK_NOTAPENJUALAN ORDER BY A.WAKTU DESC LIMIT 100;
		ELSEIF kondisi = 39 THEN
			SELECT * FROM 01_tms_member WHERE (NAMA LIKE CONCAT('%',dimana1,'%') OR MEMBER_ID LIKE CONCAT('%',dimana1,'%')) AND KODEUNIKMEMBER = dimana2 ORDER BY NAMA ASC LIMIT 100;
		ELSEIF kondisi = 40 THEN
			SELECT * FROM 01_tms_barangkharisma WHERE (BARANG_ID LIKE CONCAT('%',dimana1,'%') OR NAMABARANG LIKE CONCAT('%',dimana1,'%')) AND KODEUNIKMEMBER = dimana2 ORDER BY NAMABARANG ASC LIMIT 100;
		ELSEIF kondisi = 41 THEN
			SELECT * FROM 01_tms_supplier WHERE (KODESUPPLIER LIKE CONCAT('%',dimana1,'%') OR NAMASUPPLIER LIKE CONCAT('%',dimana1,'%')) AND KODEUNIKMEMBER = dimana2 ORDER BY NAMASUPPLIER ASC LIMIT 100;
		ELSEIF kondisi = 42 THEN
			SELECT * FROM 01_tms_member_grup WHERE (KODEGRUP LIKE CONCAT('%',dimana1,'%') OR JENIS LIKE CONCAT('%',dimana1,'%')) AND KODEUNIKMEMBER = dimana2 ORDER BY JENIS ASC LIMIT 100;
		ELSEIF kondisi = 43 THEN
		SELECT * FROM 01_tms_kategori WHERE (KATEGORIPARENT_ID LIKE CONCAT('%',dimana1,'%') OR NAMAKATEGORI LIKE CONCAT('%',dimana1,'%')) AND KODEUNIKMEMBER = dimana2 ORDER BY NAMAKATEGORI ASC LIMIT 100;
		ELSEIF kondisi = 1000 THEN
			SELECT *,TIMESTAMPDIFF(MINUTE,JAMBUKA,JAMTUTUP) as TOTALJAM, (SELECT CONCAT(COALESCE(SUM(UNTUKBERAPAORANG),0),'::',COALESCE(TIMESTAMPDIFF(MINUTE,MIN(WAKTU),MAX(WAKTUAKHIR)),0)) FROM 01_tms_resto_pesanmeja WHERE KODEMEJA = A.KODEMEJA AND KODEMEJA != "0" AND STATUSPESAN > 0 LIMIT 1) as INFORMASIPESANAN FROM 01_tms_resto_daftarmeja as A WHERE LANTAI LIKE CONCAT('%',dimana1,'%') AND A.OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND KODEMEJA != "0";
		ELSEIF kondisi = 1001 THEN
			SELECT * FROM 01_tms_resto_pesanmeja as A
			JOIN 01_trs_barangkeluar as B ON A.KODEMENUPESANAN = B.PK_NOTAPENJUALAN
			WHERE (TANGGAL BETWEEN dimana1 AND dimana2) AND A.OUTLET = dimana3 AND A.KODEUNIKMEMBER = dimana4 AND B.KODEUNIKMEMBER = dimana4;
		ELSEIF kondisi = 1002 THEN
			SELECT *, C.AI_TRANSAKSIKELUAR as KODEAI FROM 01_trs_barangkeluar_detail as A
			JOIN 01_tms_resto_pesanmeja as B ON A.PK_NOTAPENJUALAN = B.KODEMENUPESANAN
			JOIN 01_trs_barangkeluar as C ON A.PK_NOTAPENJUALAN = C.PK_NOTAPENJUALAN
			WHERE B.KODEMENUPESANAN = dimana1 AND B.OUTLET = dimana2 AND A.KODEUNIKMEMBER = dimana3 AND B.KODEUNIKMEMBER = dimana3 AND C.KODEUNIKMEMBER = dimana3;
		END IF;	
END
;;
delimiter ;

-- ----------------------------
-- Function structure for SEMUASTOK
-- ----------------------------
DROP FUNCTION IF EXISTS `SEMUASTOK`;
delimiter ;;
CREATE FUNCTION `SEMUASTOK`(`KODEBARANGP` VARCHAR(100), `KODEUNIKMEMBERP` VARCHAR(100))
 RETURNS double(15,2)
BEGIN
	RETURN (
		IFNULL((SELECT SUM(`DISPLAY`) FROM 01_tms_stok WHERE BARANG_ID = KODEBARANGP AND KODEUNIKMEMBER = KODEUNIKMEMBERP LIMIT 1),0) +
		IFNULL((SELECT SUM(`GUDANG`) FROM 01_tms_stok WHERE BARANG_ID = KODEBARANGP AND KODEUNIKMEMBER = KODEUNIKMEMBERP LIMIT 1),0) +
		IFNULL((SELECT SUM(`RETUR`) FROM 01_tms_stok WHERE BARANG_ID = KODEBARANGP AND KODEUNIKMEMBER = KODEUNIKMEMBERP LIMIT 1),0)
	); 
END
;;
delimiter ;

-- ----------------------------
-- Function structure for SEMUASTOKTIPE
-- ----------------------------
DROP FUNCTION IF EXISTS `SEMUASTOKTIPE`;
delimiter ;;
CREATE FUNCTION `SEMUASTOKTIPE`(`KODEBARANGP` VARCHAR(100), `OUTLETP` VARCHAR(100), `KODEUNIKMEMBERP` VARCHAR(100), `TIPEBARANG` VARCHAR(100))
 RETURNS double(15,2)
BEGIN
	RETURN (
		IFNULL((SELECT SUM(`DISPLAY`) FROM 01_bnt_display WHERE `KODEBARANG` = KODEBARANGP AND `OUTLET` = OUTLETP AND `KODEUNIKMEMBER` = KODEUNIKMEMBERP),0) +
		IFNULL((SELECT SUM(`GUDANG`) FROM 01_bnt_gudang WHERE `BARANG_ID` = KODEBARANGP AND `OUTLET` = OUTLETP AND `KODEUNIKMEMBER` = KODEUNIKMEMBERP),0) +
		IFNULL((SELECT SUM(`RETUR`) FROM 01_bnt_retur WHERE `KODEBARANG` = KODEBARANGP AND `OUTLET` = OUTLETP AND `KODEUNIKMEMBER` = KODEUNIKMEMBERP),0)
	); 
END
;;
delimiter ;

-- ----------------------------
-- Function structure for SEMUASTOKTNPOUTLET
-- ----------------------------
DROP FUNCTION IF EXISTS `SEMUASTOKTNPOUTLET`;
delimiter ;;
CREATE FUNCTION `SEMUASTOKTNPOUTLET`(`KODEBARANGP` VARCHAR(100), `KODEUNIKMEMBERP` VARCHAR(100))
 RETURNS double(15,2)
BEGIN
	RETURN (
		IFNULL((SELECT SUM(`DISPLAY`) FROM 01_bnt_display WHERE `KODEBARANG` = KODEBARANGP AND `KODEUNIKMEMBER` = KODEUNIKMEMBERP),0) +
		IFNULL((SELECT SUM(`GUDANG`) FROM 01_bnt_gudang WHERE `BARANG_ID` = KODEBARANGP AND `KODEUNIKMEMBER` = KODEUNIKMEMBERP),0) +
		IFNULL((SELECT SUM(`RETUR`) FROM 01_bnt_retur WHERE `KODEBARANG` = KODEBARANGP AND `KODEUNIKMEMBER` = KODEUNIKMEMBERP),0)
	); 
END
;;
delimiter ;

-- ----------------------------
-- Function structure for STOKOUTLET
-- ----------------------------
DROP FUNCTION IF EXISTS `STOKOUTLET`;
delimiter ;;
CREATE FUNCTION `STOKOUTLET`(`KODEBARANGP` VARCHAR(100), `KODEUNIKMEMBERP` VARCHAR(100), JENISTOK INT(2), LOKASISTOK INT(2), OUTLETSP VARCHAR(100))
 RETURNS double(20,2)
BEGIN
		IF JENISTOK = 1 THEN
				RETURN (IFNULL((SELECT `DISPLAY` + `GUDANG` + `RETUR` FROM 01_tms_stok WHERE BARANG_ID = KODEBARANGP AND OUTLET = OUTLETSP AND KODEUNIKMEMBER = KODEUNIKMEMBERP LIMIT 1),0));
		END IF;
END
;;
delimiter ;

-- ----------------------------
-- Function structure for TOTALOMSET
-- ----------------------------
DROP FUNCTION IF EXISTS `TOTALOMSET`;
delimiter ;;
CREATE FUNCTION `TOTALOMSET`(`KODEMEMBER` VARCHAR(100), `KONDISI` INT(11))
 RETURNS int(11)
BEGIN
	IF KONDISI = 0 THEN
		RETURN (SELECT (SUM(TOTALKREDIT) - (SELECT SUM(BAYAR) - SUM(POTONGAN) FROM aciraba_kotakcantik.01_tms_piutangkredit WHERE MEMBER_ID = KODEMEMBER)) FROM aciraba_kotakcantik.01_tms_piutangkredit WHERE MEMBER_ID = KODEMEMBER AND `NOTRANSAKSI` = '0');
    END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tmp_pecahsatuan
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTER_INSERT`;
delimiter ;;
CREATE TRIGGER `AFTER_INSERT` AFTER INSERT ON `01_tmp_pecahsatuan` FOR EACH ROW BEGIN
	UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` - NEW.`ASALPECAH` WHERE BARANG_ID = NEW.`IDBARANGASAL` AND OUTLET = NEW.`OUTLET` AND KODEUNIKMEMBER = NEW.`KODEUNIKMEMBER`;
	INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, CONCAT("PS",NEW.`IDBARANGASAL`,BIGINTTODATETIMENOW()),NEW.`IDBARANGASAL`, NEW.`OUTLET`,NOW(), CONCAT("PECAH SATUAN DARI ",NEW.`IDBARANGASAL`,"MENJADI BARANG ",NEW.`IDBARANGBARU`),'PECAHSATUAN', NEW.`KASIR`,'0','0','0',NEW.`ASALPECAH`,STOKOUTLET(NEW.`IDBARANGBARU`,NEW.`KODEUNIKMEMBER`,1,1,NEW.`OUTLET`),SEMUASTOK(NEW.`IDBARANGBARU`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);
	UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` + NEW.`MENJADI` WHERE BARANG_ID = NEW.`IDBARANGBARU`AND OUTLET = NEW.`OUTLET` AND KODEUNIKMEMBER = NEW.`KODEUNIKMEMBER`;
	INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, CONCAT("PS",NEW.`IDBARANGASAL`,BIGINTTODATETIMENOW()),NEW.`IDBARANGASAL`, NEW.`OUTLET`,NOW(), CONCAT("PECAH SATUAN DARI ",NEW.`IDBARANGASAL`,"MENJADI BARANG ",NEW.`IDBARANGBARU`),'PECAHSATUAN', NEW.`KASIR`,NEW.`MENJADI`,'0','0','0',STOKOUTLET(NEW.`IDBARANGBARU`,NEW.`KODEUNIKMEMBER`,1,1,NEW.`OUTLET`),SEMUASTOK(NEW.`IDBARANGBARU`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_bestbuybaranggrosir
-- ----------------------------
DROP TRIGGER IF EXISTS `01_tms_bestbuybaranggrosir_AFTER_INSERT`;
delimiter ;;
CREATE TRIGGER `01_tms_bestbuybaranggrosir_AFTER_INSERT` AFTER INSERT ON `01_tms_bestbuybaranggrosir` FOR EACH ROW BEGIN
	UPDATE `01_tms_barangkharisma` SET `APAKAHGROSIR` = 'AKTIF' WHERE `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER` AND `BARANG_ID` = NEW.`BARANG_ID`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_bestbuybaranggrosir
-- ----------------------------
DROP TRIGGER IF EXISTS `01_tms_bestbuybaranggrosir_AFTER_DELETE`;
delimiter ;;
CREATE TRIGGER `01_tms_bestbuybaranggrosir_AFTER_DELETE` AFTER DELETE ON `01_tms_bestbuybaranggrosir` FOR EACH ROW BEGIN
	UPDATE `01_tms_barangkharisma` SET `APAKAHGROSIR` = 'TIDAK AKTIF' WHERE `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER` AND `BARANG_ID` = OLD.`BARANG_ID`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_hutangtoko_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AFIHUTANG`;
delimiter ;;
CREATE TRIGGER `AFIHUTANG` AFTER INSERT ON `01_tms_hutangtoko_detail` FOR EACH ROW BEGIN
	UPDATE `01_tms_hutangtoko` SET `SISAKREDIT` = `SISAKREDIT` - NEW.BAYAR WHERE `NOTRANSAKSI` = NEW.TRANSAKSI_ID AND KODEUNIKMEMBER = NEW.KODEUNIKMEMBER;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_hutangtoko_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AUPBHUTANG`;
delimiter ;;
CREATE TRIGGER `AUPBHUTANG` AFTER UPDATE ON `01_tms_hutangtoko_detail` FOR EACH ROW BEGIN
		UPDATE `01_tms_hutangtoko` SET `SISAKREDIT` = `SISAKREDIT` + OLD.`BAYAR` - NEW.`BAYAR` WHERE `NOTRANSAKSI` = NEW.`TRANSAKSI_ID` AND KODEUNIKMEMBER = NEW.KODEUNIKMEMBER;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_hutangtoko_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `ADELBHUTANG`;
delimiter ;;
CREATE TRIGGER `ADELBHUTANG` AFTER DELETE ON `01_tms_hutangtoko_detail` FOR EACH ROW BEGIN
	UPDATE `01_tms_hutangtoko` SET `SISAKREDIT` = `SISAKREDIT` + OLD.BAYAR WHERE `NOTRANSAKSI` = OLD.TRANSAKSI_ID AND KODEUNIKMEMBER = OLD.KODEUNIKMEMBER;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_member
-- ----------------------------
DROP TRIGGER IF EXISTS `01_tms_member_AFTER_INSERT`;
delimiter ;;
CREATE TRIGGER `01_tms_member_AFTER_INSERT` AFTER INSERT ON `01_tms_member` FOR EACH ROW BEGIN
	INSERT INTO 01_tms_memberdeposit (`AI`,`MEMBER_ID`,`NOMINAL`,`TANGGALTRANSAKSI`,`BUKTI`,`JENIS`,`AKUN_ID`) VALUES (NULL,NEW.MEMBER_ID,'0','0','0','MASUK','0');
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_member
-- ----------------------------
DROP TRIGGER IF EXISTS `01_tms_member_AFTER_DELETE`;
delimiter ;;
CREATE TRIGGER `01_tms_member_AFTER_DELETE` AFTER DELETE ON `01_tms_member` FOR EACH ROW BEGIN
	DELETE FROM `01_tms_memberdeposit` WHERE `MEMBER_ID`= OLD.`MEMBER_ID`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_nota
-- ----------------------------
DROP TRIGGER IF EXISTS `01_tms_nota_BEFORE_INSERT`;
delimiter ;;
CREATE TRIGGER `01_tms_nota_BEFORE_INSERT` BEFORE INSERT ON `01_tms_nota` FOR EACH ROW BEGIN

END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_penggunaaplikasiha
-- ----------------------------
DROP TRIGGER IF EXISTS `01_tms_penggunaaplikasiha_AFTER_DELETE`;
delimiter ;;
CREATE TRIGGER `01_tms_penggunaaplikasiha_AFTER_DELETE` AFTER DELETE ON `01_tms_penggunaaplikasiha` FOR EACH ROW BEGIN
	UPDATE 01_tms_penggunaaplikasi SET `HAKAKSESID` = "DEFAULT" WHERE `HAKAKSESID` = OLD.`NAMAHAKAKSES`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_piutangkredit_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTERINESRT`;
delimiter ;;
CREATE TRIGGER `AFTERINESRT` AFTER INSERT ON `01_tms_piutangkredit_detail` FOR EACH ROW BEGIN
		UPDATE `01_tms_piutangkredit` SET `SISAKREDIT` = `SISAKREDIT` - NEW.`BAYAR` WHERE `TRANSAKSI_ID` = NEW.`TRANSAKSI_ID` AND KODEUNIKMEMBER = NEW.`KODEUNIKMEMBER`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_piutangkredit_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTERUBAHPIUTANG`;
delimiter ;;
CREATE TRIGGER `AFTERUBAHPIUTANG` AFTER UPDATE ON `01_tms_piutangkredit_detail` FOR EACH ROW BEGIN
		UPDATE `01_tms_piutangkredit` SET `SISAKREDIT` = `SISAKREDIT` + OLD.`BAYAR` - NEW.`BAYAR` WHERE `TRANSAKSI_ID` = NEW.`TRANSAKSI_ID`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_piutangkredit_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTERDELETEPIUTANG`;
delimiter ;;
CREATE TRIGGER `AFTERDELETEPIUTANG` AFTER DELETE ON `01_tms_piutangkredit_detail` FOR EACH ROW BEGIN
		UPDATE `01_tms_piutangkredit` SET `SISAKREDIT` = `SISAKREDIT` + OLD.`BAYAR` WHERE `TRANSAKSI_ID` = OLD.`TRANSAKSI_ID` AND KODEUNIKMEMBER = OLD.`KODEUNIKMEMBER`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_resto_daftarmeja
-- ----------------------------
DROP TRIGGER IF EXISTS `AFDELETE`;
delimiter ;;
CREATE TRIGGER `AFDELETE` AFTER DELETE ON `01_tms_resto_daftarmeja` FOR EACH ROW BEGIN
	DELETE FROM 01_tms_resto_pesanmeja WHERE KODEMEJA = OLD.KODEMEJA AND OUTLET = OLD.OUTLET AND KODEUNIKMEMBER = OLD.KODEUNIKMEMBER;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_tms_voucher
-- ----------------------------
DROP TRIGGER IF EXISTS `01_tms_voucher_BEFORE_DELETE`;
delimiter ;;
CREATE TRIGGER `01_tms_voucher_BEFORE_DELETE` BEFORE DELETE ON `01_tms_voucher` FOR EACH ROW BEGIN
	DELETE FROM 01_akun_jurnalumum WHERE `NOTRANSAKSI` = OLD.`NAMAVOUCHER` AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER` AND `LOKASI` = OLD.`OUTLET`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangkeluar
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTERINSERTTRX`;
delimiter ;;
CREATE TRIGGER `AFTERINSERTTRX` AFTER INSERT ON `01_trs_barangkeluar` FOR EACH ROW BEGIN
		DECLARE MINIMPOINT INT(12);
		IF NEW.`ENUM_JENISTRANSAKSI` = 'KREDIT' THEN
			INSERT INTO `01_tms_piutangkredit`(`AI`, `TRANSAKSI_ID`, `MEMBER_ID`, `JATUHTEMPO`, `KASIR_ID`, `TOTALKREDIT`, `SISAKREDIT`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`PK_NOTAPENJUALAN`, NEW.`FK_MEMBER`, DATE_ADD(NOW(), INTERVAL NEW.`JATUHTEMPO` DAY) , NEW.`KASIR`, (NEW.`KEMBALIAN` * -1),(NEW.`KEMBALIAN` * -1) , NEW.`KODEUNIKMEMBER`);
		END IF;
		IF NEW.TIPETRANSAKSI = 1 THEN
				INSERT INTO `01_trs_barangkeluar_dp`(`AI`, `PK_NOTRANSAKSI`, `TUNAI`, `DEBIT`, `KREDIT`, `EMONEY`, `TGLTRANSAKSI`, `IDKASIR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`PK_NOTAPENJUALAN`, NEW.`NOMINALTUNAI`, NEW.`NOMINALKARTUDEBIT`, NEW.`NOMORKARTUKREDIT`, NEW.`NOMINALEMONEY`, NEW.`TGLKELUAR`, NEW.`KASIR`, NEW.`LOKASI`, NEW.`KODEUNIKMEMBER`);
		END IF;
		SELECT MINIMALPOIN INTO MINIMPOINT FROM 01_tms_member WHERE MEMBER_ID = NEW.FK_MEMBER AND KODEUNIKMEMBER = NEW.KODEUNIKMEMBER LIMIT 1;
		UPDATE 01_tms_member SET POINT = POINT + ROUND(NEW.`TOTALBELANJA` / MINIMPOINT,0) WHERE MEMBER_ID = NEW.FK_MEMBER AND KODEUNIKMEMBER = NEW.KODEUNIKMEMBER LIMIT 1;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangkeluar
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTEREDIT`;
delimiter ;;
CREATE TRIGGER `AFTEREDIT` AFTER UPDATE ON `01_trs_barangkeluar` FOR EACH ROW BEGIN
		DECLARE MINIMPOINT INT(12);
		DELETE FROM 01_tms_piutangkredit WHERE TRANSAKSI_ID = NEW.PK_NOTAPENJUALAN AND KODEUNIKMEMBER = NEW.`KODEUNIKMEMBER`;
		IF NEW.`ENUM_JENISTRANSAKSI` = 'KREDIT' THEN
			INSERT INTO `01_tms_piutangkredit`(`AI`, `TRANSAKSI_ID`, `MEMBER_ID`, `JATUHTEMPO`, `KASIR_ID`, `TOTALKREDIT`, `SISAKREDIT`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`PK_NOTAPENJUALAN`, NEW.`FK_MEMBER`, DATE_ADD(NOW(), INTERVAL NEW.`JATUHTEMPO` DAY) , NEW.`KASIR`, (NEW.`KEMBALIAN` * -1),(NEW.`KEMBALIAN` * -1) , NEW.`KODEUNIKMEMBER`);
		END IF;
		SELECT MINIMALPOIN INTO MINIMPOINT FROM 01_tms_member WHERE MEMBER_ID = NEW.FK_MEMBER AND KODEUNIKMEMBER = NEW.KODEUNIKMEMBER LIMIT 1;
		UPDATE 01_tms_member SET POINT = POINT + ROUND(NEW.`TOTALBELANJA` / MINIMPOINT,0) WHERE MEMBER_ID = NEW.FK_MEMBER AND KODEUNIKMEMBER = NEW.KODEUNIKMEMBER LIMIT 1;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangkeluar
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTERDELETE`;
delimiter ;;
CREATE TRIGGER `AFTERDELETE` AFTER DELETE ON `01_trs_barangkeluar` FOR EACH ROW BEGIN
		DECLARE MINIMPOINT INT(12);
		DELETE FROM 01_trs_barangkeluar_beban WHERE PK_NOTAPENJUALAN = OLD.PK_NOTAPENJUALAN AND KODEUNIKMEMBER = OLD.KODEUNIKMEMBER;
		SELECT MINIMALPOIN INTO MINIMPOINT FROM 01_tms_member WHERE MEMBER_ID = OLD.FK_MEMBER AND KODEUNIKMEMBER = OLD.KODEUNIKMEMBER LIMIT 1;
		UPDATE 01_tms_member SET POINT = POINT - ROUND(OLD.`TOTALBELANJA` / MINIMPOINT,0) WHERE MEMBER_ID = OLD.FK_MEMBER AND KODEUNIKMEMBER = OLD.KODEUNIKMEMBER LIMIT 1;
		DELETE FROM 01_tms_resto_pesanmeja WHERE KODEMENUPESANAN = OLD.PK_NOTAPENJUALAN AND OUTLET = OLD.LOKASI AND KODEUNIKMEMBER = OLD.KODEUNIKMEMBER;
		DELETE FROM 01_trs_barangkeluar_dp WHERE PK_NOTRANSAKSI = OLD.PK_NOTAPENJUALAN AND OUTLET = OLD.LOKASI AND KODEUNIKMEMBER = OLD.KODEUNIKMEMBER;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangkeluar_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTERINSERT`;
delimiter ;;
CREATE TRIGGER `AFTERINSERT` AFTER INSERT ON `01_trs_barangkeluar_detail` FOR EACH ROW BEGIN
		DECLARE SOUTLET, SKATEGORIID,SBEBANGAJI,SBEBANPACKING,SBEBANPROMO,SBEBANTRANSPORT, SKASIRID VARCHAR(255);
		SELECT LOKASI, KASIR INTO SOUTLET,SKASIRID FROM 01_trs_barangkeluar WHERE `PK_NOTAPENJUALAN` = NEW.`PK_NOTAPENJUALAN` LIMIT 1;
		IF NEW.STOKDAPATMINUS = "BUKAN JASA" THEN
			UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` - NEW.`STOKBARANGKELUAR` WHERE `BARANG_ID` = NEW.`FK_BARANG` AND `OUTLET` = SOUTLET AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
		END IF;
		/* khusus manufaktur */
			SELECT KATEGORI_ID INTO SKATEGORIID FROM 01_tms_barangkharisma WHERE BARANG_ID = NEW.`FK_BARANG` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER` LIMIT 1;
			SELECT BEBANGAJI,BEBANPACKING,BEBANPROMO,BEBANTRANSPORT INTO SBEBANGAJI,SBEBANPACKING,SBEBANPROMO,SBEBANTRANSPORT FROM 01_tms_kategori WHERE KATEGORIPARENT_ID = SKATEGORIID LIMIT 1;
		INSERT INTO `01_trs_barangkeluar_beban`(`AI_TRANSAKSIKELUAR`, `PK_NOTAPENJUALAN`, `FK_BARANG`, `BEBANGAJI`, `BEBANPACKING`, `BEBANPROMO`, `BEBANTRANSPOT`,`KODEUNIKMEMBER`) VALUES ('',NEW.`PK_NOTAPENJUALAN`,NEW.`FK_BARANG`,SBEBANGAJI, SBEBANPACKING, SBEBANPROMO, SBEBANTRANSPORT, NEW.`KODEUNIKMEMBER`);
			INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`PK_NOTAPENJUALAN`,NEW.`FK_BARANG`,SOUTLET, NOW(), 'Transaksi Kasir','TRSKSR', SKASIRID,'0','0','0',NEW.`STOKBARANGKELUAR`,STOKOUTLET(NEW.`FK_BARANG`,NEW.`KODEUNIKMEMBER`,1,1,SOUTLET),SEMUASTOK(NEW.`FK_BARANG`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangkeluar_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `HAPUSDETAIL`;
delimiter ;;
CREATE TRIGGER `HAPUSDETAIL` AFTER DELETE ON `01_trs_barangkeluar_detail` FOR EACH ROW BEGIN
		DECLARE SOUTLET, SKASIRID, TOTALBARIS VARCHAR(255);
		IF OLD.STOKDAPATMINUS = "DAPAT MINUS" THEN
			SELECT LOKASI,KASIR INTO SOUTLET,SKASIRID FROM 01_trs_barangkeluar WHERE `PK_NOTAPENJUALAN` = OLD.`PK_NOTAPENJUALAN` AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER` LIMIT 1;
			UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` + OLD.`STOKBARANGKELUAR` WHERE `BARANG_ID` = OLD.`FK_BARANG` AND `OUTLET` = SOUTLET AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER`;
			DELETE FROM 01_trs_barangkeluar_beban WHERE PK_NOTAPENJUALAN = OLD.PK_NOTAPENJUALAN AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER`;
			INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, OLD.`PK_NOTAPENJUALAN`,OLD.`FK_BARANG`,SOUTLET, NOW(),'Transaksi dihapus','TRSKSR', SKASIRID,OLD.`STOKBARANGKELUAR`,'0','0','0',STOKOUTLET(OLD.`FK_BARANG`,OLD.`KODEUNIKMEMBER`,1,1,SOUTLET),SEMUASTOK(OLD.`FK_BARANG`,OLD.`KODEUNIKMEMBER`), OLD.`KODEUNIKMEMBER`);
		END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangkeluarnota
-- ----------------------------
DROP TRIGGER IF EXISTS `01_trs_barangkeluarnota_AFTER_DELETE`;
delimiter ;;
CREATE TRIGGER `01_trs_barangkeluarnota_AFTER_DELETE` AFTER DELETE ON `01_trs_barangkeluarnota` FOR EACH ROW BEGIN
    INSERT INTO 01_bnt_display (`DISPLAY_AI`, `NOTAPEMBELIAN`, `KODEBARANG`, `DISPLAY`, `HPP`,`OUTLET`,`KODEUNIKMEMBER`) VALUES  (NULL, OLD.`NOTAPEMBELIAN`, OLD.`KODEBARANG` ,OLD.`QTYKELUAR`, OLD.`HPP`, OLD.`OUTLET`, OLD.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangmasuk
-- ----------------------------
DROP TRIGGER IF EXISTS `AFTERINSERTPEMBELIAN`;
delimiter ;;
CREATE TRIGGER `AFTERINSERTPEMBELIAN` AFTER INSERT ON `01_trs_barangmasuk` FOR EACH ROW BEGIN
		DECLARE ADADATA, TOTALBAYARHUTANG, ITEMAKTIFKUANTITI, TOTALPEMBELIAN DOUBLE(15,2);
		IF NEW.`TOP` = "KREDIT" THEN
			SELECT COALESCE(SUM(BAYAR),0) INTO TOTALBAYARHUTANG FROM 01_tms_hutangtoko_detail WHERE TRANSAKSI_ID = NEW.`NOTA` AND KODEUNIKMEMBER = NEW.`KODEUNIKMEMBER`;
			SELECT COUNT(*) INTO ADADATA FROM 01_tms_hutangtoko WHERE NOTRANSAKSI = NEW.`NOTA` AND KODEUNIKMEMBER =  NEW.`KODEUNIKMEMBER`;
			IF ADADATA > 0 THEN
				UPDATE `01_tms_hutangtoko` SET `SUPPLIER_ID` = NEW.`FK_SUPPLIER`, `JATUHTEMPO` = NEW.`JATUHTEMPO`, `KASIR_ID` = NEW.`PETUGAS`, `TOTALKREDIT` = NEW.`TOTALHUTANG`, `SISAKREDIT` = NEW.`TOTALHUTANG` - TOTALBAYARHUTANG WHERE `NOTRANSAKSI` = NEW.`NOTA` AND KODEUNIKMEMBER =  NEW.`KODEUNIKMEMBER`;
			ELSE
				INSERT INTO `01_tms_hutangtoko`(`AI`, `NOTRANSAKSI`, `SUPPLIER_ID`, `JATUHTEMPO`, `KASIR_ID`, `TOTALKREDIT`, `SISAKREDIT`, `KODEUNIKMEMBER`) VALUES ('', NEW.`NOTA`, NEW.`FK_SUPPLIER`, NEW.`JATUHTEMPO`, NEW.`PETUGAS`, NEW.`TOTALHUTANG`, NEW.`TOTALHUTANG`, NEW.`KODEUNIKMEMBER`);
			END IF;
		END IF;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangmasuk_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AINSERTPBD`;
delimiter ;;
CREATE TRIGGER `AINSERTPBD` AFTER INSERT ON `01_trs_barangmasuk_detail` FOR EACH ROW BEGIN
		DECLARE SKASIRID, STOKSEBEELUM, HARGABELILAMA VARCHAR(255);
		SELECT PETUGAS INTO SKASIRID FROM 01_trs_barangmasuk WHERE NOTA = NEW.`NOTA` LIMIT 1;
		UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` + NEW.`DISPLAY`,`GUDANG` = `GUDANG` + NEW.`GUDANG` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`OUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
		/* ubah harga hpp */
		SELECT HARGABELI, (DISPLAY + GUDANG + RETUR) INTO HARGABELILAMA,STOKSEBEELUM FROM 01_tms_barangkharisma as A JOIN 01_tms_stok as B ON A.BARANG_ID = B.BARANG_ID WHERE A.BARANG_ID = NEW.`KODEBARANG` AND B.OUTLET = NEW.`OUTLET` AND B.KODEUNIKMEMBER = NEW.`KODEUNIKMEMBER` LIMIT 1;
		/* rumus hargarata PROCEDURE (a*b) + (c*d) / a+c*/
		UPDATE `01_tms_barangkharisma` SET `HARGABELI` = (((STOKSEBEELUM * HARGABELILAMA) + (NEW.`JUMLAHBELI` * NEW.`HPPBEBAN`)) / (STOKSEBEELUM + NEW.`JUMLAHBELI`)) WHERE `BARANG_ID` = NEW.`KODEBARANG` AND KODEUNIKMEMBER = NEW.KODEUNIKMEMBER;
		INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`NOTA`,NEW.`KODEBARANG`,NEW.`OUTLET`, NOW(), 'Transaksi Pembelian','TRSPMB', SKASIRID, NEW.`JUMLAHBELI`,'0','0','0',STOKOUTLET(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`,1,1,NEW.`OUTLET`),SEMUASTOK(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_barangmasuk_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `ADELETEPB`;
delimiter ;;
CREATE TRIGGER `ADELETEPB` AFTER DELETE ON `01_trs_barangmasuk_detail` FOR EACH ROW BEGIN
		DECLARE SKASIRID VARCHAR(255);
		SELECT PETUGAS INTO SKASIRID FROM 01_trs_barangmasuk WHERE NOTA = OLD.`NOTA` LIMIT 1;
		UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` - OLD.`DISPLAY`, `GUDANG` = `GUDANG` - OLD.`GUDANG` WHERE `BARANG_ID` = OLD.`KODEBARANG` AND `OUTLET` = OLD.`OUTLET` AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER`;
		INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, OLD.`NOTA`,OLD.`KODEBARANG`,OLD.`OUTLET`, NOW(), 'Hapus Transaksi Pembelian','TRSPMB', SKASIRID, OLD.`JUMLAHBELI`,'0','0','0',STOKOUTLET(OLD.`KODEBARANG`,OLD.`KODEUNIKMEMBER`,1,1,OLD.`OUTLET`),SEMUASTOK(OLD.`KODEBARANG`,OLD.`KODEUNIKMEMBER`), OLD.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_mutasibarang
-- ----------------------------
DROP TRIGGER IF EXISTS `01_trs_mutasibarang_AFTER_INSERT`;
delimiter ;;
CREATE TRIGGER `01_trs_mutasibarang_AFTER_INSERT` AFTER INSERT ON `01_trs_mutasibarang` FOR EACH ROW BEGIN
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_mutasibarang_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AIMUTASIBARANGD`;
delimiter ;;
CREATE TRIGGER `AIMUTASIBARANGD` AFTER INSERT ON `01_trs_mutasibarang_detail` FOR EACH ROW BEGIN
	DECLARE ADADATA INT(12);
	DECLARE SKASIRID VARCHAR(255);
	SELECT PETUGAS INTO SKASIRID FROM 01_trs_mutasibarang WHERE NOMORMUTASI = NEW.`NOMORMUTASI` AND OUTLET = NEW.`OUTLET` AND KODEUNIKMEMBER = NEW.`KODEUNIKMEMBER`;
	/*pengurangan stok awal mutasi */
	IF NEW.ASALLOKASIITEM = "D" THEN
		UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` - NEW.`STOKMUTASI` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`ASALOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
	ELSEIF NEW.ASALLOKASIITEM = "G" THEN
		UPDATE `01_tms_stok` SET `GUDANG` = `GUDANG` - NEW.`STOKMUTASI` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`ASALOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
	ELSEIF NEW.ASALLOKASIITEM = "R" THEN
		UPDATE `01_tms_stok` SET `RETUR` = `RETUR` - NEW.`STOKMUTASI` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`ASALOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
	END IF;
	/* penambahan stok tujuan mutasi*/
	SELECT COUNT(*) INTO ADADATA FROM `01_tms_stok` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
	IF NEW.TUJUANLOKASIITEM = "D" THEN
		IF ADADATA > 0 THEN
			UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` + NEW.`STOKMUTASI` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
		ELSE
			INSERT INTO `01_tms_stok`(`BARANG_ID`, `DISPLAY`, `GUDANG`, `RETUR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (NEW.`KODEBARANG`, NEW.`STOKMUTASI`, 0, 0, NEW.`TUJUANOUTLET`, NEW.`KODEUNIKMEMBER`);
		END IF;
	ELSEIF NEW.TUJUANLOKASIITEM = "G" THEN
		IF ADADATA > 0 THEN
			UPDATE `01_tms_stok` SET `GUDANG` = `GUDANG` + NEW.`STOKMUTASI` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
		ELSE
			INSERT INTO `01_tms_stok`(`BARANG_ID`, `DISPLAY`, `GUDANG`, `RETUR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (NEW.`KODEBARANG`, 0, NEW.`STOKMUTASI`, 0,  NEW.`TUJUANOUTLET`, NEW.`KODEUNIKMEMBER`);
		END IF;
	ELSEIF NEW.TUJUANLOKASIITEM = "R" THEN
		IF ADADATA > 0 THEN
			UPDATE `01_tms_stok` SET `RETUR` = `RETUR` + NEW.`STOKMUTASI` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
		ELSE
			INSERT INTO `01_tms_stok`(`BARANG_ID`, `DISPLAY`, `GUDANG`, `RETUR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (NEW.`KODEBARANG`, 0, 0, NEW.`STOKMUTASI`, NEW.`TUJUANOUTLET`, NEW.`KODEUNIKMEMBER`);
		END IF;
	END IF;
INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`NOMORMUTASI`,NEW.`KODEBARANG`,NEW.`ASALOUTLET`, NOW(), CONCAT('Transaksi Mutasi Keluar : OUTLET [',NEW.`ASALOUTLET`,'] Lokasi [',NEW.`ASALLOKASIITEM`,'] Masuk Ke [',NEW.`TUJUANOUTLET`,'] Lokasi [',NEW.`TUJUANLOKASIITEM`,']'),'MTS', SKASIRID, '0',NEW.`STOKMUTASI`,'0','0',STOKOUTLET(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`,1,1,NEW.`ASALOUTLET`),SEMUASTOK(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);
INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`NOMORMUTASI`,NEW.`KODEBARANG`,NEW.`TUJUANOUTLET`, NOW(), CONCAT('Transaksi Mutasi Masuk : OUTLET [',NEW.`TUJUANOUTLET`,'] Lokasi [',NEW.`TUJUANLOKASIITEM`,'] Dari [',NEW.`ASALOUTLET`,'] Lokasi [',NEW.`ASALLOKASIITEM`,']'),'MTS', SKASIRID, '0',NEW.`STOKMUTASI`,'0','0',STOKOUTLET(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`,1,1,NEW.`TUJUANOUTLET`),SEMUASTOK(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);

END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_opname_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AOPINSER`;
delimiter ;;
CREATE TRIGGER `AOPINSER` AFTER INSERT ON `01_trs_opname_detail` FOR EACH ROW BEGIN
	DECLARE SKASIRID VARCHAR(255);
	SELECT PETUGAS INTO SKASIRID FROM 01_trs_opname WHERE `NOTAOPNAME` = NEW.`NOTAOPNAME` LIMIT 1;
	IF NEW.`LOKASIOPNAME` = 'D' THEN
			IF NEW.`KONDISIOPNAME` = 'T' THEN
				UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` + NEW.`STOKOPNAME` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`OUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			ELSEIF NEW.`KONDISIOPNAME` = 'K' THEN
				UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` - NEW.`STOKOPNAME` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`OUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			ELSEIF NEW.`KONDISIOPNAME` = 'R' THEN
				UPDATE `01_tms_stok` SET `DISPLAY` = NEW.`STOKOPNAME` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`OUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			END IF;
	ELSE
			IF NEW.`KONDISIOPNAME` = 'T' THEN
				UPDATE `01_tms_stok` SET `GUDANG` = `GUDANG` + NEW.`STOKOPNAME` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`OUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			ELSEIF NEW.`KONDISIOPNAME` = 'K' THEN
				UPDATE `01_tms_stok` SET `GUDANG` = `GUDANG` - NEW.`STOKOPNAME` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`OUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			ELSEIF NEW.`KONDISIOPNAME` = 'R' THEN
				UPDATE `01_tms_stok` SET `GUDANG` = NEW.`STOKOPNAME` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`OUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			END IF;
	END IF;
		INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`NOTAOPNAME`,NEW.`KODEBARANG`,NEW.`OUTLET`, NOW(), CONCAT('Transaksi OPNAME Kondisi : [',NEW.`KONDISIOPNAME`,'] Lokasi [',NEW.`LOKASIOPNAME`,']'),'OPM', SKASIRID, '0','0',NEW.`STOKOPNAME`,'0',STOKOUTLET(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`,1,1,NEW.`OUTLET`),SEMUASTOK(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_returpembelian
-- ----------------------------
DROP TRIGGER IF EXISTS `01_trs_returpembelian_AFTER_DELETE`;
delimiter ;;
CREATE TRIGGER `01_trs_returpembelian_AFTER_DELETE` AFTER DELETE ON `01_trs_returpembelian` FOR EACH ROW BEGIN
	DELETE FROM 01_tms_hutangtoko_detail WHERE NOTARETURBELI = OLD.`NOTRXRETURBELI`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_returpembelian_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AIRBINSERT`;
delimiter ;;
CREATE TRIGGER `AIRBINSERT` AFTER INSERT ON `01_trs_returpembelian_detail` FOR EACH ROW BEGIN
		DECLARE ADADATA INT(12);
		DECLARE SKASIRID, STOKSEBEELUM, HPPSEBELUM VARCHAR(255);
		SELECT PETUGAS INTO SKASIRID FROM 01_trs_returpembelian WHERE NOTRXRETURBELI = NEW.`NOTRXRETURBELI` LIMIT 1;
		SELECT COUNT(*) INTO ADADATA FROM `01_tms_stok` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`OUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
		IF NEW.ASALLOKASI = "R" THEN
			UPDATE `01_tms_stok` SET `RETUR` = `RETUR` - NEW.`JUMLAHRETUR` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`ASALOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
		END IF;
		INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`NOTRXRETURBELI`,NEW.`KODEBARANG`,NEW.`ASALOUTLET`, NOW(), 'Transaksi Retur Pembelian','RTPB', SKASIRID, '0','0','0',NEW.`JUMLAHRETUR`,STOKOUTLET(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`,1,1,NEW.`ASALOUTLET`),SEMUASTOK(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_returpembelian_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `AIRBDELETE`;
delimiter ;;
CREATE TRIGGER `AIRBDELETE` AFTER DELETE ON `01_trs_returpembelian_detail` FOR EACH ROW BEGIN
		DECLARE ADADATA INT(12);
		DECLARE SKASIRID, STOKSEBEELUM, HPPSEBELUM VARCHAR(255);
		SELECT PETUGAS INTO SKASIRID FROM 01_trs_returpembelian WHERE NOTRXRETURBELI = OLD.`NOTRXRETURBELI` LIMIT 1;
		IF OLD.ASALLOKASI = "R" THEN
			UPDATE `01_tms_stok` SET `RETUR` = `RETUR` + OLD.`JUMLAHRETUR` WHERE `BARANG_ID` = OLD.`KODEBARANG` AND `OUTLET` = OLD.`ASALOUTLET` AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER`;
		END IF;
		INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, OLD.`NOTRXRETURBELI`,OLD.`KODEBARANG`,OLD.`ASALOUTLET`, NOW(), 'Transaksi Retur Pembelian','RTPB', SKASIRID, OLD.`JUMLAHRETUR`,'0','0','0',STOKOUTLET(OLD.`KODEBARANG`,OLD.`KODEUNIKMEMBER`,1,1,OLD.`ASALOUTLET`),SEMUASTOK(OLD.`KODEBARANG`,OLD.`KODEUNIKMEMBER`), OLD.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_returpenjualan
-- ----------------------------
DROP TRIGGER IF EXISTS `01_trs_returpenjualan_AFTER_DELETE`;
delimiter ;;
CREATE TRIGGER `01_trs_returpenjualan_AFTER_DELETE` AFTER DELETE ON `01_trs_returpenjualan` FOR EACH ROW BEGIN
	DELETE FROM 01_tms_piutangkredit_detail WHERE NOTARETUR = OLD.`NOTRXRETUR`;
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_returpenjualan_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `ARTJUAL`;
delimiter ;;
CREATE TRIGGER `ARTJUAL` AFTER INSERT ON `01_trs_returpenjualan_detail` FOR EACH ROW BEGIN
		DECLARE ADADATA INT(12);
		DECLARE SKASIRID, STOKSEBEELUM, HPPSEBELUM VARCHAR(255);
		SELECT PETUGAS INTO SKASIRID FROM 01_trs_returpenjualan WHERE NOTRXRETUR = NEW.`NOTRXRETUR` LIMIT 1;
		SELECT COUNT(*) INTO ADADATA FROM `01_tms_stok` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
		IF NEW.TUJUANLOKASISSTOK = "D" THEN
			IF ADADATA > 0 THEN
				UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` + NEW.`JUMLAHRETUR` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			ELSE
				INSERT INTO `01_tms_stok`(`BARANG_ID`, `DISPLAY`, `GUDANG`, `RETUR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (NEW.`KODEBARANG`, NEW.`JUMLAHRETUR`, 0, 0, NEW.`TUJUANOUTLET`, NEW.`KODEUNIKMEMBER`);
			END IF;
		ELSEIF NEW.TUJUANLOKASISSTOK = "G" THEN
			IF ADADATA > 0 THEN
				UPDATE `01_tms_stok` SET `GUDANG` = `GUDANG` + NEW.`JUMLAHRETUR` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			ELSE
				INSERT INTO `01_tms_stok`(`BARANG_ID`, `DISPLAY`, `GUDANG`, `RETUR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (NEW.`KODEBARANG`, NEW.`JUMLAHRETUR`, 0, 0, NEW.`TUJUANOUTLET`, NEW.`KODEUNIKMEMBER`);
			END IF;
		ELSEIF NEW.TUJUANLOKASISSTOK = "R" THEN
			IF ADADATA > 0 THEN
				UPDATE `01_tms_stok` SET `RETUR` = `RETUR` + NEW.`JUMLAHRETUR` WHERE `BARANG_ID` = NEW.`KODEBARANG` AND `OUTLET` = NEW.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = NEW.`KODEUNIKMEMBER`;
			ELSE
				INSERT INTO `01_tms_stok`(`BARANG_ID`, `DISPLAY`, `GUDANG`, `RETUR`, `OUTLET`, `KODEUNIKMEMBER`) VALUES (NEW.`KODEBARANG`, NEW.`JUMLAHRETUR`, 0, 0, NEW.`TUJUANOUTLET`, NEW.`KODEUNIKMEMBER`);
			END IF;
		END IF;
		INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, NEW.`NOTRXRETUR`,NEW.`KODEBARANG`,NEW.`TUJUANOUTLET`, NOW(), 'Transaksi Retur Penjualan','RTRPJ', SKASIRID, NEW.`JUMLAHRETUR`,'0','0','0',STOKOUTLET(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`,1,1,NEW.`TUJUANOUTLET`),SEMUASTOK(NEW.`KODEBARANG`,NEW.`KODEUNIKMEMBER`), NEW.`KODEUNIKMEMBER`);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table 01_trs_returpenjualan_detail
-- ----------------------------
DROP TRIGGER IF EXISTS `ADRTJUAL`;
delimiter ;;
CREATE TRIGGER `ADRTJUAL` AFTER DELETE ON `01_trs_returpenjualan_detail` FOR EACH ROW BEGIN
		DECLARE ADADATA INT(12);
		DECLARE SKASIRID, STOKSEBEELUM, HPPSEBELUM VARCHAR(255);
		SELECT PETUGAS INTO SKASIRID FROM 01_trs_returpenjualan WHERE NOTRXRETUR = OLD.`NOTRXRETUR` LIMIT 1;
		IF OLD.TUJUANLOKASISSTOK = "D" THEN
			UPDATE `01_tms_stok` SET `DISPLAY` = `DISPLAY` - OLD.`JUMLAHRETUR` WHERE `BARANG_ID` = OLD.`KODEBARANG` AND `OUTLET` = OLD.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER`;
		ELSEIF OLD.TUJUANLOKASISSTOK = "G" THEN
			UPDATE `01_tms_stok` SET `GUDANG` = `GUDANG` - OLD.`JUMLAHRETUR` WHERE `BARANG_ID` = OLD.`KODEBARANG` AND `OUTLET` = OLD.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER`;
		ELSEIF OLD.TUJUANLOKASISSTOK = "R" THEN
			UPDATE `01_tms_stok` SET `RETUR` = `RETUR` - OLD.`JUMLAHRETUR` WHERE `BARANG_ID` = OLD.`KODEBARANG` AND `OUTLET` = OLD.`TUJUANOUTLET` AND `KODEUNIKMEMBER` = OLD.`KODEUNIKMEMBER`;
		END IF;
		INSERT INTO `01_trs_kartustok`(`KARTUSTOK_AI`, `NOTRANSAKSI`, `BARANG_ID`, `OUTLET`, `TANGGALTRANSAKSI`, `KETERANGAN`, `TIPE`, `KASIR_ID`, `MASUK`, `MUTASI`, `OPNAME`, `KELUAR`, `SALDO`, `SALDOSEMUA`, `KODEUNIKMEMBER`) VALUES (NULL, OLD.`NOTRXRETUR`,OLD.`KODEBARANG`,OLD.`TUJUANOUTLET`, NOW(), 'Transaksi Hapus Retur Penjualan','RTRPJ', SKASIRID, '0','0','0',OLD.`JUMLAHRETUR`,STOKOUTLET(OLD.`KODEBARANG`,OLD.`KODEUNIKMEMBER`,1,1,OLD.`TUJUANOUTLET`),SEMUASTOK(OLD.`KODEBARANG`,OLD.`KODEUNIKMEMBER`), OLD.`KODEUNIKMEMBER`);
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
