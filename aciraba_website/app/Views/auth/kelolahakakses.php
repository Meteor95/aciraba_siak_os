<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<!-- BEGIN Page Content -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
<link href="<?= base_url() ;?>styles/cssseira/styleprofile.css" rel="stylesheet">
<style>
input[type=checkbox] {
    transform: scale(1.5);
    cursor:pointer;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="portlet">
            <div class="portlet-header portlet-header-bordered">
                <h3 class="portlet-title">INFORMASI HAK AKSES 
                    <a href="<?= base_url().'masterdata/informasimerchant';?>"><button id="hakakseskontrol" class="btn btn-success float-right"> <i class="fas fa-users"></i> Daftar Pegawai / Rekan</button></a>
                </h3>
            </div>
            <div class="portlet-body">
                <div class="col-md-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet mb-md-0">
                        <div class="portlet-body">
                            <div class="mb-3">
                                <!-- BEGIN Nav -->
                                <div class="nav nav-lines" id="nav1-tab">
                                    <a class="nav-item nav-link active" id="nav1-home-tab" data-toggle="tab" href="#nav1-home">Hak Akses</a>
                                    <a class="nav-item nav-link" id="nav1-profile-tab" data-toggle="tab" href="#nav1-profile">Daftar Hak Akses</a>
                                </div>
                                <!-- END Nav -->
                            </div>
                            <!-- BEGIN Tab -->
                            <div class="tab-content" id="nav1-tabContent">
                                <div class="tab-pane fade show active" id="nav1-home"> 
                                    <div>
                                        <h5 class="my-4">HAK AKSES PENGGUNA</h5>
                                        <input type="text" id="namahakakses" class="mb-2 form-control" placeholder="Masukkan Nama Hak Akses"> 
                                        <input type="hidden" id="aihakakses"> 
                                        <div class="mb-3">
                                            <!-- BEGIN Nav -->
                                            <div class="nav nav-lines" id="nav1-tab_ha">
                                                <a class="nav-item nav-link active" id="nav1-home-tab_ha" data-toggle="tab" href="#nav1-home_ha">POS Aciraba</a>
                                                <a class="nav-item nav-link" id="nav1-profile-tab_ha" data-toggle="tab" href="#nav1-profile_ha">SIAK Aciraba</a>
                                                <a class="nav-item nav-link" id="nav1-pengaturan-tab_ha" data-toggle="tab" href="#nav1-pengaturan_ha">Pengaturan Aciraba</a>
                                            </div>
                                            <!-- END Nav -->
                                        </div>
                                        <!-- BEGIN Tab -->
                                        <div class="tab-content" id="nav1-tabContent_ha">
                                            <div class="tab-pane fade show active" id="nav1-home_ha">
                                            <table id="hakakses" class="table table-striped mb-1">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; vertical-align: middle;">Fitur</th>
                                                        <th style="text-align: center; vertical-align: middle;">Keterangan</th>
                                                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Kasir</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Hanya Kasir</td>
                                                    <td style="text-align: justify; ">Hak akses pengguna dikhususkan untuk kasir. Setelah login pengguna akan dihadapkan langsung dengan KASIR dan TAMPILAN PESANAN. Fitur lain terabaikan</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_hanyakasir_ket" value="Akses Hanya Kasir"><input id="ha_hanyakasir" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Dashboard</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Dashboard</td>
                                                    <td style="text-align: justify; ">Digunakan untuk mengakses dashboard dalam aplikasi ACIRABA - ACIPAY</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_aksesdasboard_ket" value="Akses Beranda Admin"><input id="ha_aksesdasboard" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Kasir</td>
                                                    <td style="text-align: justify; ">Digunakan pengguna untuk melakukan transaksi item keluar melalui FITUR KASIR</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_kasir_ket" value="Hak Akses Kasir"><input id="ha_kasir" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Tampilan Pesanan</td>
                                                    <td style="text-align: justify; ">Lebih di kenal dengan KDS (Kitchen Display System). Tampilan untuk menampilkan item pesanan yang hendak di kelola</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_kds_ket" value="Akses Tampilan KDS"><input id="ha_kds" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Master Data</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Outlet</td>
                                                    <td style="text-align: justify; ">Berisikan informasi mengenai penambahan dan pengurangan informasi outlet anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_outlet_ket" value="Akses Mengelola Outlet"><input id="ha_outlet" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Item</td>
                                                    <td style="text-align: justify; ">Berisikan informasi mengenai item yang dimiliki oleh Oulet</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_daftaritem_ket" value="Akses Melihat Daftar Item"><input id="ha_daftaritem" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Tambah Item</td>
                                                    <td style="text-align: justify; ">User diizinkan untuk menambah item baru pada outlet tersebut</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_tambahitem_ket" value="Akses Menambah Item"><input id="ha_tambahitem" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Tambah Bulk Item</td>
                                                    <td style="text-align: justify; ">User diizinkan untuk menambah item baru secara bersamaan pada outlet tersebut</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_bulkimtem_ket" value="Akses Item Bersamaan"><input id="ha_bulkimtem" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Ubah Informasi Item</td>
                                                    <td style="text-align: justify; ">User dapat mengubah informasi item yang di pilih baik nama, harga, foto, dll</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_ubah_masteritem_ket" value="Akses Ubah Infomrasi Item"><input id="ha_ubah_masteritem" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Kartu Stok Item</td>
                                                    <td style="text-align: justify; ">Berisikan informasi mengenai arus item yang dimiliki oleh tiap outlet</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_kartustok_ket" value="Akses Kartu Stok"><input id="ha_kartustok" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Kupon Belanja</td>
                                                    <td style="text-align: justify; ">Buat kupon belanja kepada pelangganmu agar mereka betah belanja ditokomu</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_kuponbelanja_ket" value="Akses Kupon Belanja"><input id="ha_kuponbelanja" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Suplier</td>
                                                    <td style="text-align: justify; ">Berisikan daftar suplier yang bekerjasama dengan anda dalam menerima item dari mereka</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_dafatarsuplier_ket" value="Akses Daftar Suplier"><input id="ha_dafatarsuplier" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Member</td>
                                                    <td style="text-align: justify; ">Berisikan daftar member yang bekerjasama dengan anda dalam membeli / mendistribusikan barang dagangan anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_daftarmember_ket" value="Akses Daftar Member"><input id="ha_daftarmember" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Sales</td>
                                                    <td style="text-align: justify; ">Berisikna daftar sales yang membantu anda dalam memasarkan, mengantarkan produk item anda kepada pelangganmu</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_daftarsales_ket" value="Akses Daftar Sales"><input id="ha_daftarsales" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Satuan Item</td>
                                                    <td style="text-align: justify; ">Daftar satuan yang dapat digunakan dalam mengelompokkan item anda berdasarkan satuan</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_daftarsatuan_ket" value="Akses Satuan Item"><input id="ha_daftarsatuan" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Kategori Item</td>
                                                    <td style="text-align: justify; ">Daftar kategori yang dapat digunakna dalam mengelompokkan item anda berdasarkan kategori</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_kategoriitem_ket" value="Akses Kategori Item"><input id="ha_kategoriitem" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Kategori Anggota</td>
                                                    <td style="text-align: justify; ">Daftar kategori yang dapat digunakan untuk mengelompokkan member yang loyal terhadap outlet anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_kategorianggota_ket" value="Akses kategori Anggota"><input id="ha_kategorianggota" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Metode Pembayaran</td>
                                                    <td style="text-align: justify; ">Daftar mengelola metode pembayaran untuk mengindentifikasi jenis transaksi keluar, masuk anda </td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_metodepembayaran_ket" value="Akses Metode Pembayaran"><input id="ha_metodepembayaran" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Akses Pencatatan Trx</td>
                                                    <td style="text-align: justify; ">Daftar mengelola metode pembayaran dengan pencatatan pada metode transkasi kasir contoh : Transaksi kasir menggunakan e-wallet ovo </td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_metodepembayaranpencatatan_ket" value="Akses Pencatatan Metode Pembayaran"><input id="ha_metodepembayaranpencatatan" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Akses Duitku</td>
                                                    <td style="text-align: justify; ">Daftar mengelola metode pembayaran gerbang DUITKU.COM </td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_metodepembayaranduitku_ket" value="Akses Gerbang DUITKU.COM"><input id="ha_metodepembayaranduitku" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Data Brand</td>
                                                    <td style="text-align: justify; ">Informasi brand yang tersedia untuk produk anda dapat mengelompokkan item berdasarkan brand</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_databrand_ket" value="Akses Master Brand"><input id="ha_databrand" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Data Principal</td>
                                                    <td style="text-align: justify; "></td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_dataprincipal_ket" value="Akses Master Principal"><input id="ha_dataprincipal" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Penjualan</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Retur Penjualan</td>
                                                    <td style="text-align: justify; ">Prinsipal atau produsen adalah pemilik brand dari produk yang didistribusikan oleh distributor</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_returpenjualan_ket" value="Akses Retur Penjualam"><input id="ha_returpenjualan" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Data Penjualan</td>
                                                    <td style="text-align: justify; ">Informasi transaksi penjualan yang terjadi dalam usaha anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_datapenjualan_ket" value="Akses Daftar Penjualan"><input id="ha_datapenjualan" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">History Harga Jual</td>
                                                    <td style="text-align: justify; ">Untuk melihat perubahan harga jual yang ditawarkan atau ditransaksikan kepada pelanggan</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_datahishargajual_ket" value="Akses Histori Harga Jual"><input id="ha_datahishargajual" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Piutang Anggota</td>
                                                    <td style="text-align: justify; ">Daftar untuk melihat informasi dana anda yang dipegang pelanggan atau PIUTANG agar tidak lupa menagihnya</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_datapiutanganggota_ket" value="Akses Pitang Anggota"><input id="ha_datapiutanganggota" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Pesanan</td>
                                                    <td style="text-align: justify; ">Berisikan informasi pesanan yang akan disiapkan oleh petugas agar saat hari H barang sudah READY</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_daftarpesanan_ket" value="Akses Daftar Pesanan"><input id="ha_daftarpesanan" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Pembelian</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Retur Pembelian</td>
                                                    <td style="text-align: justify; ">Informasi transaksi retur pembelian guna melihat barang mana saja yang dikembalikan beserta alasan kerusakan </td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_returpembelian_ket" value="Akses Retur Pembelian"><input id="ha_returpembelian" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Pembelian</td>
                                                    <td style="text-align: justify; ">Untuk melihat daftar pembelian yang outlet anda lakukan terhadap suplier terkait</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_daftarpembelian_ket" value="Akses Pembelian"><input id="ha_daftarpembelian" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">History Harga Beli</td>
                                                    <td style="text-align: justify; ">Untuk melihat perubahan harga yang diberikan oleh suplier apakah naik atau turun sehingga item ini layak untuk dibeli dan dijual</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_daftarhishargabeli_ket" value="Akses Histori Harga Beli"><input id="ha_daftarhishargabeli" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Daftar Hutang Suplier</td>
                                                    <td style="text-align: justify; ">Informasi mengenai besaran hutang yang harus dibayar kepada suplier sehingga anda tidak lupa</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_daftarhutangsuplier_ket" value="Akses Hutang Outlet"><input id="ha_daftarhutangsuplier" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Penyesuaian</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Penyesuaian Stok Item</td>
                                                    <td style="text-align: justify; ">Berisikan informasi yang menampilkan perubahan stok secara paksa diakibatkan berberapa faktor kondisi</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_penyesuaianstok_ket" value="Akses Penyesuaian Stok"><input id="ha_penyesuaianstok" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Mutasi Stok Barang</td>
                                                    <td style="text-align: justify; ">Daftar perpindahan item ke lokasi berbeda ke outlet lain sehingga anda tidak lupa</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_mutasistok_ket" value="Akses Mutasi Item"><input id="ha_mutasistok" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Laporan</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Laporan Master</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi mengenai DATABASE Master yang dimiliki oleh OUTLET anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanmaster_ket" value="Akses Semua Laporan Master"><input id="ha_laporanmaster" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Laporan Master Item</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi lengkap mengenai item yang anda miliki</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanmasteritem_ket" value="Akses Laporan Master Item"><input id="ha_laporanmasteritem" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Laporan Master Suplier</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi lengkap mengenai suplier yang anda pilih guna menstok item anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanmastersuplier_ket" value="Akses Laporan Master Suplier"><input id="ha_laporanmastersuplier" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Laporan Master Member</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi lengkap mengenai pelanggan anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanmastermember_ket" value="Akses Laporan Master Member"><input id="ha_laporanmastermember" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Laporan Penjualan</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi mengenai PENJUALAN pada usaha anda serta mengelola barang retur dari pelanggan</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanpenjualan_ket" value="Akses Semua Laporan Penjualan"><input id="ha_laporanpenjualan" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Laporan Penjualan</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi mengenai PENJUALAN pada usaha anda agar dapat dianalisa untuk langkah kedepan</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanpenjualana_ket" value="Akses Laporan Penjualan"><input id="ha_laporanpenjualana" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Laporan Retur Penjualan</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi mengenai barang mana saja yang dikembalikan oleh pelanggan kepada kita terhadap berberapa faktoe</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanpenjualanretur_ket" value="Akses Kartu Stok"><input id="ha_laporanpenjualanretur" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Laporan Pembelian</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi barang masuk yang siap dikelola oleh OUTLET anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanpembelian_ket" value="Akses Semua Laporan Pembelian"><input id="ha_laporanpembelian" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Laporan Pembelian</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi laporan mengenai pembelian item yang dilakukan oleh petugas anda guna menambah persediaan stok item</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanpembeliana_ket" value="Akses Laporan Pembelian"><input id="ha_laporanpembeliana" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: center; ">Laporan Retur Pembelian</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi mengenai barang apa saja yang dikembalikan kepada SUPLIER terhadap berberapa faktor</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanpembelianretur_ket" value="Akses Retur Laporan Pembelian"><input id="ha_laporanpembelianretur" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Laporan Hutang</td>
                                                    <td style="text-align: justify; ">Menampilkan informasi hutang anda terhada suplier yang harus dibayar</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanhutang_ket" value="Akses Lapotan Hutang"><input id="ha_laporanhutang" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Laporan Piutang</td>
                                                    <td style="text-align: justify; ">Menampilakan informasi piutang anda agar anda dapat menagih kepada pelanggan terkait</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_laporanpiutang_ket" value="Akses Laporan Piutang"><input id="ha_laporanpiutang" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                            <div class="tab-pane fade" id="nav1-profile_ha">
                                            <table id="hakakses_siak" class="table table-striped mb-1">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; vertical-align: middle;">Fitur</th>
                                                        <th style="text-align: center; vertical-align: middle;">Keterangan</th>
                                                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">SIAK Aciraba</td>
                                                    <td style="text-align: justify; ">Hak akses untuk mengelola keuangan dari perusahaan anda saat ini seperti enti jurnal, melihat neraca atau bahkan laba rugi</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_akuntansi_ket" value="Akses SIAK Aciraba"><input id="ha_akuntansi" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Akuntansi</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Kode COA</td>
                                                    <td style="text-align: justify; ">COA (Chart of Accounts) atau "Bagan Akun" dalam bahasa Indonesia, adalah daftar lengkap semua akun yang digunakan dalam sistem akuntansi perusahaan</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_akuntansikodeakunakuntansi_ket" value="Akses Kode COA"><input id="ha_akuntansikodeakunakuntansi" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Entri Jurnal</td>
                                                    <td style="text-align: justify; ">Entri jurnal (atau jurnal akuntansi) adalah pencatatan sistematis transaksi keuangan dalam buku besar akuntansi. Pengguna dapat memasukan entri jurnal, melihat hasil entri jurnal serta melihat entri jurnal yang ada di aplikasi pada tiap KODE UNIK ANDA. </td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_akuntansidaftarentrijurnal_ket" value="Akses Entri Jurnal"><input id="ha_akuntansidaftarentrijurnal" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Kas dan Bank</td>
                                                    <td style="text-align: justify; ">Pengguna dapat melakukan entri jurnal akuntansi dalam lingkup KAS dan BANK. Pengguna dapat melakukan entri TRANSFER KAS/BANK, KIRIM KAS/BANK, TERIMA KAS/BANK dalam perusahaan anda dengan hak akses bukan kasir</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_kasdanbank_ket" value="Akses Kas dan Bank"><input id="ha_kasdanbank" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Laporan</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Buku Besar</td>
                                                    <td style="text-align: justify; ">Fitur yang digunakan untuk mencatat semua transaksi keuangan suatu perusahaan. Ini mencakup segala jenis transaksi, mulai dari pembelian, penjualan, hingga transaksi kas. Buku besar ini menciptakan gambaran rinci tentang keuangan perusahaan, memungkinkan pemilik bisnis, manajer keuangan, dan akuntan untuk memahami posisi keuangan dengan lebih baik.</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_akuntansibukubesar_ket" value="Akses Buku Besar"><input id="ha_akuntansibukubesar" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Jurnal Umum</td>
                                                    <td style="text-align: justify; ">Akses jurnal yang digunakan untuk melihat catatan sejumlah transaksi keuangan yang muncul dalam periode waktu tertentu sesuai dengan urutan tanggal, dengan mencantumkan nama transaksi, jenis akun, dan nominal saldo di kolom debit ataupun kredit.</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_akuntansijurnalumum_ket" value="Akses Jurnal Umum"><input id="ha_akuntansijurnalumum" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Neraca Saldo</td>
                                                    <td style="text-align: justify; ">Memastikan bahwa tidak ada entri jurnal yang tidak seimbang dalam sistem akuntansi yang tidak memungkinkan untuk menghasilkan laporan keuangan yang akurat.Neraca saldo dijalankan sebagai bagian dari proses penutupan akhir bulan. Laporan ini terutama digunakan untuk memastikan bahwa total semua debit sama dengan total semua kredit.</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_akuntansineracasaldo_ket" value="Akses Neraca Saldo Umum"><input id="ha_akuntansineracasaldo" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Neraca Keuangan</td>
                                                    <td style="text-align: justify; ">Salah satu komponen pelaporan akuntansi paling ringkas. Hanya dengan membaca neraca, biasanya kita sudah tahu berapa besar laba/rugi dan perkembangan aset perusahaan. Bagi Anda yang membutuhkan contoh neraca keuangan, berikut bahasan lengkapnya.</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_akuntansineracakeuangan_ket" value="Akses Neraca Keuangan"><input id="ha_akuntansineracakeuangan" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Laba Rugi Perusahaan</td>
                                                    <td style="text-align: justify; ">laporan keuangan suatu perusahaan yang dihasilkan pada suatu periode akuntansi yang menjabarkan unsur-unsur pendapatan dan beban perusahaan sehingga menghasilkan suatu laba atau rugi bersih. Laporan laba rugi bisa dibuat dalam periode satu bulan, satu tahun, atau berdasarkan konsep perbandingan (matching concept) yang disebut juga konsep pengaitan atau pemadanan, antara pendapatan dan beban yang terkait. Laporan ini masuk ke dalam empat laporan keuangan utama perusahaan dan sebagai penghubung antara dua laporan neraca.</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_akuntansilabarugi_ket" value="Akses Laba Rugi"><input id="ha_akuntansilabarugi" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                            <div class="tab-pane fade" id="nav1-pengaturan_ha">
                                            <table id="hakakses_pengaturan" class="table table-striped mb-1">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; vertical-align: middle;">Fitur</th>
                                                        <th style="text-align: center; vertical-align: middle;">Keterangan</th>
                                                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr><td style="text-align: center; vertical-align: middle;" colspan=4>Pengaturan Penggunaan Aplikasi</td></tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Hak Akses Aplikasi</td>
                                                    <td style="text-align: justify; ">Pengaturan untuk mengelola suatu hak akses pengguna pada suatu aplikasi ACIRABA. Silahkan pilih orang terpercaya anda dalam hak akses ini karena sangat krusial / hak akses sama dengan OWNER</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_pengaturanhakakses_ket" value="Akses Hak Akses"><input id="ha_pengaturanhakakses" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="cellhakseswhere" style="text-align: left; ">Akses Pegawai / Merchant</td>
                                                    <td style="text-align: justify; ">Digunakan untuk mengelola pengguna pegawai / rekanan aplikasi guna mengelola bisnis anda</td>
                                                    <td style="text-align: center;"><input type="hidden" id="ha_pengaturanpermerc_ket" value="Akses Kelola Pegawai / Merchant"><input id="ha_pengaturanpermerc" class="form-check-input" type="checkbox" /></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        <button id="simpanpenggunamerchant" class="mt-2 btn btn-primary">Simpan Informasi</button>
                                        <button id="bersihkan" class="mt-2 btn btn-primary">Bersihkan Formulir</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav1-profile">
                                <table id="tabel_hakakses" class="table table-bordered table-striped table-hover nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama Hak Akses</th>
                                            <th>Fitur Diizinkan</th>
                                            <th>Fitur Ditolak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <!-- END Tab -->
                        </div>
                    </div>
                    <!-- END Portlet -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function () {
    setTimeout(function() {
        loadtabelhakakses();
    }, 500);
})
function loadtabelhakakses(){
getCsrfTokenCallback(function() {
    var tabel = $("#tabel_hakakses").DataTable({
        language:{"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"},
        pageLength: 10,
        lengthMenu: [[10, 50, 100 , 500, -1], [10, 50, 100, 500, "All"]],
        ajax: {
            "url": baseurljavascript + 'auth/daftarhakakses',
            "type": "POST",
            "data": function (d) {
                d.csrf_aciraba = csrfTokenGlobal;
            }
        },
    });
});
}
$("#hakakses").on('click', '.form-check-input', function() {
    let isChecked = $("#ha_hanyakasir").is(":checked");
    if (isChecked){
        $('#hakakses [type="checkbox"]').each(function(i, chk) { 
        if (chk.id === "ha_hanyakasir") {
            chk.checked = true;
        } else {
            chk.checked = false;
        }
    });
    }
    
});
$("#bersihkan").on("click", function(){
    $('#namahakakses').val("")
    $('#aihakakses').val("")
    $('#hakakses #hakakses_siak #hakakses_pengaturan [type="checkbox"]').each(function(i, chk) {$(chk).prop('checked', false);});
});
$("#simpanpenggunamerchant").on("click", function(){
    if ($("#namahakakses").val() == ""){
        return toastr["error"]("Waduh cuy, inforamasi mengenai nama HAK AKSES harus diisi");
    }
    jsonStrMenuAkses = '{"menuakses":[]}';
    let obj = JSON.parse(jsonStrMenuAkses);
    $('#hakakses [type="checkbox"]').each(function(i, chk) { 
        if (chk.checked == true) {
            obj['menuakses'].push({"menuke":chk.id,"status":"1","keterangan":$("#"+chk.id+"_ket").val()});
        }else{
            obj['menuakses'].push({"menuke":chk.id,"status":"0","keterangan":$("#"+chk.id+"_ket").val()});
        }
    });
    $('#hakakses_siak [type="checkbox"]').each(function(i, chk) { 
        if (chk.checked == true) {
            obj['menuakses'].push({"menuke":chk.id,"status":"1","keterangan":$("#"+chk.id+"_ket").val()});
        }else{
            obj['menuakses'].push({"menuke":chk.id,"status":"0","keterangan":$("#"+chk.id+"_ket").val()});
        }
    });
    $('#hakakses_pengaturan [type="checkbox"]').each(function(i, chk) { 
        if (chk.checked == true) {
            obj['menuakses'].push({"menuke":chk.id,"status":"1","keterangan":$("#"+chk.id+"_ket").val()});
        }else{
            obj['menuakses'].push({"menuke":chk.id,"status":"0","keterangan":$("#"+chk.id+"_ket").val()});
        }
    });
    jsonStrMenuAkses = JSON.stringify(obj);
    Swal.fire({
        title: "Simpam Informasi Hak Akses",
        text: "Apakah anda ingin menyimpan Hak Akses dengan NAMA : "+$("#namahakakses").val(),
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke.. Simpan Hak Akses'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#simpanpenggunamerchant').prop("disabled",true);
            $('#simpanpenggunamerchant').html('<i class="fas fa-spin fa-spinner"></i> Proses Simpan');
            getCsrfTokenCallback(function() { 
                $.ajax({
                    url: baseurljavascript + 'masterdata/simpanhakakses',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        [csrfName]: csrfTokenGlobal,
                        NAMAHAKAKSES : $('#namahakakses').val(),
                        JSONMENU : jsonStrMenuAkses,
                        KONDISI : ($('#aihakakses').val() != "" ? true : false),
                        AI : $('#aihakakses').val(),
                    },
                    complete:function(){
                        $('#simpanpenggunamerchant').prop("disabled",false);
                        $('#simpanpenggunamerchant').html('Simpan Informasi');
                    },
                    success: function (response) {
                        if (response.success == "true"){
                            $('#namahakakses').val("")
                            $('#aihakakses').val("")
                            $('#hakakses #hakakses_siak #hakakses_pengaturan [type="checkbox"]').each(function(i, chk) {$(chk).prop('checked', false);});
                            getCsrfTokenCallback(function() {$('#tabel_hakakses').DataTable().ajax.reload();});
                            Swal.fire({
                                title: "Berhasil Horeee!!!",
                                html: response.msg,
                                icon: 'success',
                            });
                        }else{
                            Swal.fire({
                                title: "Gagal... Uhhh",
                                html: response.msg,
                                icon: 'warning',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr["error"](xhr.responseJSON.message);
                    }
                });
            });
        }
    });
});
function ubahhakases(ai,namahakakses,base64jsonha){
    $('#namahakakses').val(namahakakses)
    $('#aihakakses').val(ai)
    $('#hakakses #hakakses_siak #hakakses_pengaturan [type="checkbox"]').each(function(i, chk) {$(chk).prop('checked', false);});
    var menuakses = JSON.parse(atob(base64jsonha));
    menuakses.menuakses.forEach(function(menu) {
        if (menu.status === "1") { document.getElementById(menu.menuke).checked = true;}
    });
    toastr["info"]("NAMA : "+namahakakses+" terpilih untuk diubah. Silahkan cek pada TAB Hak Akses untuk melakukan perubahan FITUR HAK AKSES");
}
</script>
<?= $this->endSection(); ?>