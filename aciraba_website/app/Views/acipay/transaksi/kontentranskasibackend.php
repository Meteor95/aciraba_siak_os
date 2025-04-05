<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<link href="<?= base_url() ;?>styles/3dcardRGB.css" rel="stylesheet">
<style>
.scrolling-wrapper{
	overflow-x: auto;
    scrollbar-color: #6969dd #e0e0e0;
    scrollbar-width: thin;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div id="panelisi" class="row">
            <div class="col-12">
                <div class="portlet">
                    <div class="portlet-header portlet-header-bordered">
                        <div class="portlet-icon">
                            <i class="fa fa-map-marker-alt"></i>
                        </div>
                        <h3 class="portlet-title">TRX ID : <span id="notabaruacipay"></span></h3>
                        <div class="portlet-addon">
                            <!-- BEGIN Nav -->
                            <div class="nav nav-lines portlet-nav" id="portlet4-tab">
                                <a class="nav-item nav-link active" id="portlet4-home-tab" data-toggle="tab" href="#portlet4-home">Prabayar</a>
                                <a class="nav-item nav-link" id="portlet4-profile-tab" data-toggle="tab" href="#portlet4-profile">Dunia Game</a>
                                <a class="nav-item nav-link" id="portlet4-contact-tab" data-toggle="tab" href="#portlet4-contact">Tagihan</a>
                            </div>
                            <!-- END Nav -->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN Tab -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="portlet4-home">
                                <div class="col-sm-12">
                                    <!-- BEGIN Accordion -->
                                    <div class="accordion" id="accordion1">
                                        <!-- BEGIN Card -->
                                        <!-- BEGIN Card -->
                                        <div class="card">
                                            <div class="card-header" data-toggle="collapse" data-target="#accordion1-collapse3">
                                                <div class="card-icon">
                                                    <i class="fa fa-newspaper"></i>
                                                </div>
                                                <h3 class="card-title">PULSA, PAKET DATA, VOUCHER</h3>
                                                <div class="card-addon"><i class="caret accordion-caret"></i></div>
                                            </div>
                                            <div id="accordion1-collapse3" class="collapse show" data-parent="#accordion1">
                                                <div class="card-body">
                                                <input value="" type="text" id="cariproduktransaksi" class="form-control form-control-lg" placeholder="Masukkan nomor tujan anda / pelanggan">
                                                <div class="container-fluid rich-list rich-list-flush portlet-body mb-2">
                                                    <div id="informasikategoritersedia"></div>
                                                </div>
                                                <div class="portlet">
                                                    <div class="portlet-header portlet-header-bordered">
                                                    <span style="display:none" id="kategoriidnya"></span>
                                                    <input type="text" class="form-control" id="katakunciprodukatas" placeholder="Saring berdasarkan produk tersedia">
                                                    </div>
                                                    <div id="informasiproduktersedia"></div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Card -->
                                        <!-- BEGIN Card -->
                                        <div class="card">
                                            <div class="card-header collapsed" data-toggle="collapse" data-target="#accordion1-collapse4">
                                                <div class="card-icon">
                                                    <i class="fa fa-cog"></i>
                                                </div>
                                                <h3 class="card-title">E-MONEY, TOKEN LISTRIK, TOKEN GAS</h3>
                                                <div class="card-addon"><i class="caret accordion-caret"></i></div>
                                            </div>
                                            <div id="accordion1-collapse4" class="collapse" data-parent="#accordion1">
                                            <div class="card-body">
                                            <div class="row mb-1">
                                                <div class="col-md-12">
                                                <div class="form-row align-items-center">
                                                    <div class="col-md-10 col-sm-6">
                                                        <span style="display:none" id="kategorikatakuncitokenprabayar"></span>
                                                        <input type="text" class="mb-2 form-control form-control-lg" id="katakuncitokenprabayar" placeholder="Masukan nama TOKEN / E-MONEY yang ada inginkan">
                                                    </div>
                                                    <div class="mb-2 col-md-2 col-sm-6"><button id="filterproduktokenpasca" class="btn btn-block btn-lg btn-primary"><i class="fas fa-search"></i> Cari</button></div>
                                                </div>    
                                                </div>
                                            </div>
                                            <div id="kontenprabyartoken"></div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- END Card -->
                                    </div>
                                    <!-- END Accordion -->
                                </div>
                            </div>
                            <div class="tab-pane fade" id="portlet4-profile">
                                <div class="form-row">
                                    <div class="col-md-12 mb-1 col-sm-12">
                                        <div class="form-row align-items-center">
                                            <div class="col-md-10 col-sm-6">
                                                <span style="display:none" id="kategorikatakunciduniagame"></span>
                                                <input type="text" class="mb-2 form-control form-control-lg" id="katakunciduniagame" placeholder="Masukkan nama permainan yang anda inginkan">
                                            </div>
                                            <div class="mb-2 col-md-2 col-sm-6"><button id="filterprodukgame" class="btn btn-block btn-lg btn-primary"><i class="fas fa-search"></i> Cari</button></div>
                                        </div>    
                                    </div>
                                </div>
                                <div id="kontengame"></div>
                            </div>
                            <div class="tab-pane fade" id="portlet4-contact">
                                <div class="form-row">
                                    <div class="col-md-12 mb-1 col-sm-12">
                                    <input id="nomorkontrakpasca" type="text" class="mb-2 form-control-lg form-control" placeholder="Masukkan nomor kontrak anda / pelanggan anda">
                                        <div class="form-row align-items-center">
                                            <div class="col-md-10 col-sm-6">
                                                <span style="display:none" id="kategoripascabayar"></span>
                                                <input style="display:none" type="text" class="mb-2 form-control form-control-lg" id="katakuncikategoripascabayar" placeholder="Saring kategori PRODUK PASCABAYAR">
                                            </div>
                                            <div class="mb-2 col-md-2 col-sm-6"><button style="display:none" id="filterkategoripasca" class="btn btn-block btn-lg btn-primary"><i class="fas fa-search"></i> Cari</button></div>
                                        </div>    
                                    </div>
                                </div>
                                <div id="kontenpasca"></div>
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
<div class="modal fade" id="muncultagihannya">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">HASIL CEK TAGIHAN <span id="namaprodukpasca"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="widget16">
                    <div class="widget16-display">
                        <div class="widget16-content">
                            <div class="widget16-title">TOTAL TAGIHAN : <strong><span class="totaltagihanpasca"></span></div>
                            <div class="widget16-subtitle">KODE PRODUK : <strong><span id="kodeproduk"></span></div>
                        </div>
                        <div class="widget16-addon">
                            <div class="avatar">
                                <div class="avatar-display">
                                    <img id="logobayarpasca" src="" alt="LOGO PRODUK">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget16-list">
                        <div class="widget16-list-item">
                            <span class="widget16-list-data">Nomor Tagihan / Kontrak</span>
                            <span class="widget16-list-value"><strong><span id="nomorcustomer"></span></strong></span>
                        </div>
                        <div class="widget16-list-item">
                            <span class="widget16-list-data">Nama Pemilik Tagihan</span>
                            <span class="widget16-list-value"><strong><span id="atasnamapasca"></span></strong></span>
                        </div>
                        <div class="widget16-list-item">
                            <span class="widget16-list-data">Total Tagihan</span>
                            <span class="widget16-list-value"><strong><span class="totaltagihanpasca"></span></strong></span>
                        </div>
                        <div class="widget16-list-item">
                            <span class="widget16-list-data pt-2">Harga Jual Anda</span>
                            <span class="widget16-list-value"><input id="hargajualppob" type="text" class="form-control" placeholder="Jasa Loket Anda"></span>
                        </div>
                        <div class="widget16-list-item">
                            <span class="widget16-list-data pt-2">PIN TRX Anda</span>
                            <span class="widget16-list-value"><input type="password" class="form-control" id="pintrxpasca" placeholder="Masukkan PIN Transaksi"></span>
                        </div>
                        <hr>
                        NB : <p style="text-align: justify;"> Total tagihan diatas merupakan total dari TAGIHAN ASLI + ADMIN BANK. Besaran ADMIN BANK yang dikenakan sebesar <span style="font-color:red" id="adminbankpasca"></span> dan tidak boleh diubah karena sesuai dengan ketentuan berlaku. Anda dapat menentukan jasa LOKET untuk mendapatkan keuntungan jika dijual ulang kepada PELANGGAN</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Bayar Tagihan!!</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltransaksi">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">TRX [<span id="kodeproduknya"></span>] : <span id="judulmodal"></span></h5>
                <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
            <p> <span id="keteranganproduk"></span></p>
            <div class="form-group row">
                <span style="display:none" id="idservertujuan"></span>
                <span style="display:none" id="jenisproduknya"></span>
                <label for="notujuan" class="col-sm-3 col-form-label">Nomor Tujuan</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="notujuan" placeholder="Contoh: 0822********535">
                <small class="form-text text-muted">Nomor tujuan tidak akan kami sebarkan kesiapun. Privasi terjaga.</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="hargajualkepelangan" class="col-sm-3 col-form-label">Tentukan Harga Jual</label>
                <div class="col-sm-9">
                <input type="hargajualkepelangan" class="form-control" id="hargajualkepelanggan" placeholder="Harga jual ke pelanggan">
                <small class="form-text text-muted"><strong>HARGA BELI : <span id="hargabeli"></span> </strong> Bersainglah secara sehat dalam menentukan harga jual ke pelanggan.</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">PIN TRX [4-12 Digits]</label>
                <div class="col-sm-9">
                <input type="password" class="form-control" id="pintrx" placeholder="Masukkan PIN Transaksi">
                <small class="form-text text-muted">Jangan sebarkan PIN atau OTP anda kepada siapaun OKE BOSS!!.</small>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <span style="display:none" id="sessionkode"><?= session('sessionkode') ;?></span>
                <button style="display:none" id="ceknomortujuan" class="btn btn-warning mr-2">Cek ID Dulu!!</button>
                <button id="transaksiacipaybro" class="btn btn-primary mr-2">Oke.. Gaskan!!</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.1/vanilla-tilt.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>scripts/acipay/prosestransaksi.js"></script>
<?= $this->endSection(); ?>