/*
 Navicat Premium Data Transfer

 Source Server         : Server Seira
 Source Server Type    : MySQL
 Source Server Version : 80024
 Source Host           : 103.175.217.130:3306
 Source Schema         : sql_aciraba_seir

 Target Server Type    : MySQL
 Target Server Version : 80024
 File Encoding         : 65001

 Date: 01/07/2023 19:41:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for 01_tms_keranjang
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_keranjang`;
CREATE TABLE `01_tms_keranjang`  (
  `AI` int(0) NOT NULL AUTO_INCREMENT,
  `BARANG_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `NAMA_BARANG` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `QTY` double(30, 2) NOT NULL,
  `HARGA_JUAL` double(30, 2) NOT NULL,
  `HARGA_BELI` double(30, 2) NOT NULL,
  `POTONGANGLOBAL` double(15, 2) NOT NULL,
  `DARIPERUSAHAAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KETERANGAN` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `APAKAHVARIAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `STOKDAPATMINUS` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `JSONTAMBAHAN` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `CATATANPERBARANG` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `BRAND_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PRINCIPAL_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `HARGAASLI` double(30, 2) NOT NULL,
  `HARGAASLISEMENTARA` double(30, 2) NOT NULL DEFAULT 0.00,
  `OUTLET` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KODEKOMPUTER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `STATUSBARANGPROSES` int(0) NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 953 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of 01_tms_keranjang
-- ----------------------------
INSERT INTO `01_tms_keranjang` VALUES (932, 'A-1141108010101', 'BOLA INJAK', 1.00, 15000.00, 13500.00, 0.00, '0', 'TIDAK ADA KETERANGAN', 'TIDAK AKTIF', 'DAPAT MINUS', 'eyJqZW5pc3ZhcmlhbiI6W119', '', '0', '0', 15000.00, 15000.00, 'GDPST', '1000001', 'OXC4', 0);
INSERT INTO `01_tms_keranjang` VALUES (946, 'A-11412017894150170010101', 'LEMARI JEPARA 4 SUSUN JEPARA JEPARA', 1.00, 260000.00, 13920.00, 0.00, '0', 'TIDAK ADA KETERANGAN', 'TIDAK AKTIF', 'DAPAT MINUS', 'eyJqZW5pc3ZhcmlhbiI6W119', 'TIDAK ADA KETERANGAN', '0', '0', 260000.00, 260000.00, 'GDPST', '1000001', '5EKX', 0);
INSERT INTO `01_tms_keranjang` VALUES (947, 'A-1141914111002010010192018010101', 'BOTOL KACA KAKTUS NON PACK', 1.00, 6000.00, 4700.00, 0.00, '0', 'TIDAK ADA KETERANGAN', 'TIDAK AKTIF', 'DAPAT MINUS', 'eyJqZW5pc3ZhcmlhbiI6W119', 'TIDAK ADA KETERANGAN', '0', '0', 6000.00, 6000.00, 'GDPST', '1000001', '5EKX', 0);
INSERT INTO `01_tms_keranjang` VALUES (948, 'A-11419141110020217241819010101', 'BOTOL KACA CRYSTAL', 3.00, 6000.00, 4150.00, 0.00, '0', 'TIDAK ADA KETERANGAN', 'TIDAK AKTIF', 'DAPAT MINUS', 'eyJqZW5pc3ZhcmlhbiI6W119', 'TIDAK ADA KETERANGAN', '0', '0', 6000.00, 6000.00, 'GDPST', '1000001', '5EKX', 0);
INSERT INTO `01_tms_keranjang` VALUES (949, 'A-17013190136100170010101', 'RANTANG KARAKTER 2 SUSUN', 2.00, 21500.00, 13761.86, 0.00, '0', 'TIDAK ADA KETERANGAN', 'TIDAK AKTIF', 'DAPAT MINUS', 'eyJqZW5pc3ZhcmlhbiI6W119', 'TIDAK ADA KETERANGAN', '0', '0', 21500.00, 21500.00, 'GDPST', '1000001', '5EKX', 0);
INSERT INTO `01_tms_keranjang` VALUES (950, 'R-81302010101', 'INACO MIX 1 DUS 10.000 GR', 1.00, 227000.00, 217818.00, 0.00, '0', 'TIDAK ADA KETERANGAN', 'AKTIF', 'TIDAK DAPAT MINUS', 'eyJqZW5pc3ZhcmlhbiI6W119', 'TIDAK ADA KETERANGAN', '1', 'UJ', 227000.00, 227000.00, 'GDPST', '1000001', '5EKX', 0);
INSERT INTO `01_tms_keranjang` VALUES (952, '6930820686662', 'LED Mosquito HP888', 1.00, 25000.00, 13841.38, 0.00, '0', 'TIDAK ADA KETERANGAN', 'TIDAK AKTIF', 'DAPAT MINUS', 'eyJqZW5pc3ZhcmlhbiI6W119', '', '0', '0', 25000.00, 25000.00, 'gudang001', '1000001', '5EKX', 0);

-- ----------------------------
-- Table structure for 01_tms_keranjang_barangmasuk
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_keranjang_barangmasuk`;
CREATE TABLE `01_tms_keranjang_barangmasuk`  (
  `AI` int(0) NOT NULL AUTO_INCREMENT,
  `KODEBARANG` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `NAMABARANG` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `STOKSEBELUM` double(30, 2) NOT NULL,
  `JUMLAHBELI` double(30, 2) NOT NULL,
  `DISPLAY` double(30, 2) NOT NULL,
  `GUDANG` double(30, 2) NOT NULL,
  `HARGASUPLIER` double(30, 2) NOT NULL,
  `EXP` date NOT NULL,
  `SUBTOTAL` double(30, 2) NOT NULL,
  `DISKON1` double(30, 2) NOT NULL,
  `DISKON2` double(30, 2) NOT NULL,
  `PPN` double(30, 2) NOT NULL,
  `ADISKON1` double(30, 2) NOT NULL,
  `ADISKON2` double(30, 2) NOT NULL,
  `SUBTOTALHPP` double(30, 2) NOT NULL,
  `HPP` double(30, 2) NOT NULL,
  `BEBANGAJI` double(30, 2) NOT NULL,
  `BEBANPROMO` double(30, 2) NOT NULL,
  `BEBANPACKING` double(30, 2) NOT NULL,
  `BEBANTRANSPORT` double(30, 2) NOT NULL,
  `HPPBEBAN` double(30, 2) NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KODEKOMPUTER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of 01_tms_keranjang_barangmasuk
-- ----------------------------
INSERT INTO `01_tms_keranjang_barangmasuk` VALUES (1, '6930820686662', 'LED Mosquito HP888', 0.00, 2.00, 0.00, 2.00, 13438.47, '0000-00-00', 26876.94, 0.00, 0.00, 0.00, 0.00, 0.00, 26876.94, 13438.47, 1000.00, 2000.00, 3000.00, 4000.00, 23438.47, '', '', '');
INSERT INTO `01_tms_keranjang_barangmasuk` VALUES (2, 'A-1013190111010101', 'BANTAL BRENDIS', 0.00, 2.00, 0.00, 2.00, 13424.74, '0000-00-00', 26849.48, 0.00, 0.00, 0.00, 0.00, 0.00, 26849.48, 13424.74, 1000.00, 2000.00, 3000.00, 4000.00, 23424.74, '', '', '');

-- ----------------------------
-- Table structure for 01_tms_keranjang_pending
-- ----------------------------
DROP TABLE IF EXISTS `01_tms_keranjang_pending`;
CREATE TABLE `01_tms_keranjang_pending`  (
  `AI` int(0) NOT NULL AUTO_INCREMENT,
  `BARANG_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `NAMA_BARANG` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `QTY` double(30, 2) NOT NULL,
  `HARGA_JUAL` double(30, 2) NOT NULL,
  `HARGA_BELI` double(30, 2) NOT NULL,
  `POTONGANGLOBAL` double(15, 2) NOT NULL,
  `DARIPERUSAHAAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KETERANGAN` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `APAKAHVARIAN` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `STOKDAPATMINUS` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `JSONTAMBAHAN` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `CATATANPERBARANG` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `BRAND_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PRINCIPAL_ID` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `HARGAASLI` double(30, 2) NOT NULL,
  `HARGAASLISEMENTARA` double(30, 2) NOT NULL DEFAULT 0.00,
  `OUTLET` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `KODEKOMPUTER` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `STATUSBARANGPROSES` int(0) NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_mutasibarang_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_mutasibarang_detail`;
CREATE TABLE `01_trs_mutasibarang_detail`  (
  `AI` int(0) NOT NULL AUTO_INCREMENT,
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
  `KODEKOMPUTER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_opname_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_opname_detail`;
CREATE TABLE `01_trs_opname_detail`  (
  `AI` int(0) NOT NULL AUTO_INCREMENT,
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
  `KODEKOMPUTER` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for 01_trs_returpembelian_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_returpembelian_detail`;
CREATE TABLE `01_trs_returpembelian_detail`  (
  `AI` int(0) NOT NULL AUTO_INCREMENT,
  `NOTRXRETURBELI` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NOTRXPEMBELIAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEBARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `NAMABARANG` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JUMLAHBELI` decimal(30, 2) NOT NULL,
  `JUMLAHRETUR` decimal(30, 2) NOT NULL,
  `HARGABELI` decimal(30, 2) NOT NULL,
  `POTONGAN` decimal(30, 2) NOT NULL DEFAULT 0.00,
  `PPN` decimal(30, 2) NOT NULL,
  `ASALOUTLET` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ASALLOKASI` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KETERANGAN` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `JENISTRX` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEUNIKMEMBER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `OUTLET` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `KODEKOMPUTER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of 01_trs_returpembelian_detail
-- ----------------------------
INSERT INTO `01_trs_returpembelian_detail` VALUES (1, 'RBGDPSTOXC420230414#1', 'TANPA NOTA', '8990800022581', 'MENTOS MINT ROLL ISI 14', 0.00, 3.00, 28420.00, 0.00, 0.00, 'GDPST', 'R', '', 'TUNAI', '1000001', 'GDPST', '');
INSERT INTO `01_trs_returpembelian_detail` VALUES (2, 'RBGDPSTOXC420230414#1', 'TANPA NOTA', 'ACI10000011677029634', 'NAMA BARANGNYA', 0.00, 3.00, 12500.00, 0.00, 0.00, 'GDPST', 'R', '', 'TUNAI', '1000001', 'GDPST', '');

-- ----------------------------
-- Table structure for 01_trs_returpenjualan_detail
-- ----------------------------
DROP TABLE IF EXISTS `01_trs_returpenjualan_detail`;
CREATE TABLE `01_trs_returpenjualan_detail`  (
  `AI` int(0) NOT NULL AUTO_INCREMENT,
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
  `KODEKOMPUTER` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`AI`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of 01_trs_returpenjualan_detail
-- ----------------------------
INSERT INTO `01_trs_returpenjualan_detail` VALUES (1, 'RTGDPSTOXC420230412#1', 'TANPA NOTA', '6930820686662', 'LED Mosquito HP888', 0.00, 22.00, 10120.00, 11000.00, 0.00, 'GDPST', 'D', '-', 'TUNAI', 'GDPST', '1000001', '');
INSERT INTO `01_trs_returpenjualan_detail` VALUES (2, 'RTGDPSTOXC420230412#1', 'TANPA NOTA', 'A-1013190111010101', 'BANTAL BRENDIS', 0.00, 22.00, 28000.00, 29000.00, 0.00, 'GDPST', 'D', '-', 'TUNAI', 'GDPST', '1000001', '');

SET FOREIGN_KEY_CHECKS = 1;
