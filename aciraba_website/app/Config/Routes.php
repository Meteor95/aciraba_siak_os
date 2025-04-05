<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'hakakses:ha_aksesdasboard']);
$routes->group('auth', ['filter' => 'hakakses'], function($routes) {
    $routes->get('hakakses', 'Auth::hakakses', ['filter' => 'hakakses:ha_pengaturanhakakses']);
});
$routes->group('masterdata', ['filter' => 'hakakses'], function($routes) {
    $routes->get('daftaritem', 'Masterdata::daftaritem', ['filter' => 'hakakses:ha_daftaritem']);
    $routes->get('daftarkartustok', 'Masterdata::daftarkartustok', ['filter' => 'hakakses:ha_kartustok']);
    $routes->get('daftarkuponbelanja', 'Masterdata::daftarkuponbelanja', ['filter' => 'hakakses:ha_kuponbelanja']);
    $routes->get('daftarsuplier', 'Masterdata::daftarsuplier', ['filter' => 'hakakses:ha_dafatarsuplier']);
    $routes->get('daftarmember', 'Masterdata::daftarmember', ['filter' => 'hakakses:ha_daftarmember']);
    $routes->get('daftarsales', 'Masterdata::daftarsales', ['filter' => 'hakakses:ha_daftarsales']);
    $routes->get('daftarsatuan', 'Masterdata::daftarsatuan', ['filter' => 'hakakses:ha_daftarsatuan']);
    $routes->get('daftarkategoribarang', 'Masterdata::daftarkategoribarang', ['filter' => 'hakakses:ha_kategoriitem']);
    $routes->get('daftarkategorimember', 'Masterdata::daftarkategorimember', ['filter' => 'hakakses:ha_kategorianggota']);
    $routes->get('daftarmetodepembayaran', 'Masterdata::daftarmetodepembayaran', ['filter' => 'hakakses:ha_metodepembayaran']);
    $routes->get('pembayaranlokal', 'Masterdata::pembayaranlokal', ['filter' => 'hakakses:ha_metodepembayaranpencatatan']);
    $routes->get('brand', 'Masterdata::brand', ['filter' => 'hakakses:ha_databrand']);
    $routes->get('principal', 'Masterdata::principal', ['filter' => 'hakakses:ha_dataprincipal']);
    $routes->get('informasimerchant', 'Masterdata::informasimerchant', ['filter' => 'hakakses:ha_pengaturanpermerc']);
    $routes->get('outlet', 'Masterdata::outlet', ['filter' => 'hakakses:ha_outlet']);
});
$routes->group('paymentgateway', function($routes) {
    $routes->get('duitku', 'Paymentgateway::duitku', ['filter' => 'hakakses:ha_metodepembayaranduitku']);
});
$routes->group('member', function($routes) {
    $routes->get('/', 'Front::member_profile');
});
$routes->group('penjualan', ['filter' => 'hakakses'], function($routes) {
    $routes->get('daftarreturpenjualan', 'Penjualan::daftarreturpenjualan', ['filter' => 'hakakses:ha_returpenjualan']);
    $routes->get('daftarpenjualan', 'Penjualan::daftarpenjualan', ['filter' => 'hakakses:ha_datapenjualan']);
    $routes->get('daftarhistoryhargajual', 'Penjualan::daftarhistoryhargajual', ['filter' => 'hakakses:ha_datahishargajual']);
    $routes->get('daftarpiutang', 'Penjualan::daftarpiutang', ['filter' => 'hakakses:ha_datapiutanganggota']);
    $routes->get('daftarmeja', 'Penjualan::daftarmeja', ['filter' => 'hakakses:ha_daftarpesanan']);
});
$routes->group('pembelian', ['filter' => 'hakakses'], function($routes) {
    $routes->get('daftarreturpembelian', 'Pembelian::daftarreturpembelian', ['filter' => 'hakakses:ha_returpembelian']);
    $routes->get('daftarpembelian', 'Pembelian::daftarpembelian', ['filter' => 'hakakses:ha_daftarpembelian']);
    $routes->get('daftarhistoryhargabeli', 'Pembelian::daftarhistoryhargabeli', ['filter' => 'hakakses:ha_daftarhishargabeli']);
    $routes->get('daftarhutangsuplier', 'Pembelian::daftarhutangsuplier', ['filter' => 'hakakses:ha_daftarhutangsuplier']);
});
$routes->group('laporan', ['filter' => 'hakakses'], function($routes) {
    $routes->get('masteritem', 'Laporan::masteritem', ['filter' => 'hakakses:ha_laporanmasteritem']);
    $routes->get('mastersup', 'Laporan::mastersup', ['filter' => 'hakakses:ha_laporanmastersuplier']);
    $routes->get('mastermember', 'Laporan::mastermember', ['filter' => 'hakakses:ha_laporanmastermember']);
    $routes->get('penjualan', 'Laporan::penjualan', ['filter' => 'hakakses:ha_laporanpenjualana']);
    $routes->get('returpenjualan', 'Laporan::returpenjualan', ['filter' => 'hakakses:ha_laporanpenjualanretur']);
    $routes->get('pembelian', 'Laporan::pembelian', ['filter' => 'hakakses:ha_laporanpembeliana']);
    $routes->get('returpembelian', 'Laporan::returpembelian', ['filter' => 'hakakses:ha_laporanpembelianretur']);
    $routes->get('piutang', 'Laporan::piutang', ['filter' => 'hakakses:ha_laporanpiutang']);
    $routes->get('hutang', 'Laporan::hutang', ['filter' => 'hakakses:ha_laporanhutang']);
});
$routes->get('penyesuaian/stokopname', 'Penyesuaian::stokopname', ['filter' => 'hakakses:ha_penyesuaianstok']);
$routes->get('penyesuaian/mutasibarang', 'Penyesuaian::mutasibarang', ['filter' => 'hakakses:ha_mutasistok']);
$routes->group('akuntansi', ['filter' => 'hakakses'], function($routes) {
    $routes->get('/', 'Akuntansi::index', ['filter' => 'hakakses:ha_akuntansi']);
    $routes->get('kodeakunakuntansi/', 'Akuntansi::kodeakunakuntansi', ['filter' => 'hakakses:ha_akuntansikodeakunakuntansi']);
    $routes->get('kodeakunakuntansi/(:any)', 'Akuntansi::kodeakunakuntansi', ['filter' => 'hakakses:ha_akuntansikodeakunakuntansi']);
    $routes->get('daftarentrijurnal', 'Akuntansi::daftarentrijurnal', ['filter' => 'hakakses:ha_akuntansidaftarentrijurnal']);
    $routes->get('entrijurnal', 'Akuntansi::entrijurnal', ['filter' => 'hakakses:ha_akuntansidaftarentrijurnal']);
    $routes->get('lihatjural', 'Akuntansi::viewjurnal', ['filter' => 'hakakses:ha_akuntansidaftarentrijurnal']);
    $routes->get('bukubesar', 'Akuntansi::bukubesar', ['filter' => 'hakakses:ha_akuntansibukubesar']);
    $routes->get('bukubesar/(:any)', 'Akuntansi::bukubesar', ['filter' => 'hakakses:ha_akuntansibukubesar']);
    $routes->get('kasdanbank', 'Akuntansi::kasdanbank', ['filter' => 'hakakses:ha_kasdanbank']);
    $routes->get('kasdanbank/kasmasuk', 'Akuntansi::kasbankmasukeluar', ['filter' => 'hakakses:ha_kasdanbank']);
    $routes->get('kasdanbank/kaskeluar', 'Akuntansi::kasbankmasukeluar', ['filter' => 'hakakses:ha_kasdanbank']);
    $routes->get('kasdanbank/kastransfer', 'Akuntansi::kasbanktransfer', ['filter' => 'hakakses:ha_kasdanbank']);
    $routes->get('jurnalumum', 'Akuntansi::jurnalumum', ['filter' => 'hakakses:ha_akuntansijurnalumum']);
    $routes->get('neracasaldo', 'Akuntansi::neracasaldo', ['filter' => 'hakakses:ha_akuntansineracasaldo']);
    $routes->get('neracakeuangan', 'Akuntansi::neracakeuangan', ['filter' => 'hakakses:ha_akuntansineracakeuangan']);
    $routes->get('labarugi', 'Akuntansi::labarugi', ['filter' => 'hakakses:ha_akuntansilabarugi']);
});