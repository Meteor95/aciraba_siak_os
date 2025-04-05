<?= $this->extend('backend/main'); ?>
<?= $this->section('kontenutama'); ?>
<?= $this->include('backend/header') ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="headermember">
                    <main>
                        <div class="row">
                            <div class="left col-lg-4">
                                <div class="photo-left">
                                    <img class="photomember"
                                        src="https://images.pexels.com/photos/1804796/pexels-photo-1804796.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" />
                                        <div class="top-right-image"><i class="fa-lg fas fa-camera"></i></div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
                <hr>
                <div class="col-md-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <!-- BEGIN Widget -->
                        <div class="widget10 widget10-vertical-md">
                            <div class="widget10-item">
                                <div class="widget10-content">
                                    <h2 class="widget10-title"><?= $TOTALPENJUALAN ;?></h2>
                                    <h2 class="widget10-subtitle">Total Penjualan</h2>
                                </div>
                                <div class="widget10-addon">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-info avatar-circle widget8-avatar m-0">
                                        <div class="avatar-display">
                                            <i class="fa fa-chart-line"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                            </div>
                            <div class="widget10-item">
                                <div class="widget10-content">
                                    <h2 class="widget10-title"><?= $TOTALTRX ;?></h2>
                                    <h2 class="widget10-subtitle">Total TRX</h2>
                                </div>
                                <div class="widget10-addon">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-primary avatar-circle widget8-avatar m-0">
                                        <div class="avatar-display">
                                            <i class="fa fa-dolly-flatbed"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                            </div>
                            <div class="widget10-item">
                                <div class="widget10-content">
                                    <h2 class="widget10-title"><?= $POIN ;?></h2>
                                    <h2 class="widget10-subtitle">Poin</h2>
                                </div>
                                <div class="widget10-addon">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-success avatar-circle widget8-avatar m-0">
                                        <div class="avatar-display">
                                            <i class="fa fa-print"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                            </div>
                            <div class="widget10-item">
                                <div class="widget10-content">
                                    <h2 class="widget10-title"><?= $DEPOSIT ;?></h2>
                                    <h2 class="widget10-subtitle">Deposit</h2>
                                </div>
                                <div class="widget10-addon">
                                    <!-- BEGIN Avatar -->
                                    <div class="avatar avatar-label-danger avatar-circle widget8-avatar m-0">
                                        <div class="avatar-display">
                                            <i class="fa fa-wallet"></i>
                                        </div>
                                    </div>
                                    <!-- END Avatar -->
                                </div>
                            </div>
                        </div>
                        <!-- END Widget -->
                    </div>
                    <!-- END Portlet -->
                    <!-- BEGIN Portlet -->
                    <div class="portlet mb-3">
                        <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title"><i class="fas fa-users"></i> Informasi</h3>
                            <div class="portlet-addon">
                                <!-- BEGIN Nav -->
                                <div class="nav nav-lines portlet-nav" id="portlet1-tab">
                                    <a class="nav-item nav-link active" id="portlet1-home-tab" data-toggle="tab" href="#info_member_biodata">Biodata</a>
                                    <a class="nav-item nav-link" id="portlet1-profile-tab" data-toggle="tab" href="#info_member_pengaturan">Pengaturan</a>
                                    <a class="nav-item nav-link" id="portlet1-profile-tab" data-toggle="tab" href="#info_member_acipay">Acipay</a>
                                </div>
                                <!-- END Nav -->
                            </div>
                        </div>
                        <div class="portlet-body">
                            <!-- BEGIN Tab -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="info_member_biodata">
                                    <div style="font-size:2em;font-family: 'Irish Grover', cursive;" class="text-center"><i class="fa-solid fa-arrow-down fa-bounce"></i> Tentukan Status Anggota Ini <i class="fa-solid fa-arrow-down fa-bounce"></i></div>
                                    <div id="statusmembernya" class="btn-group btn-block btn-group-toggle" data-toggle="buttons">
                                        <label style="cursor:pointer" id="btn-status-item-1" class="btn-status-item btn btn-flat-success <?= $STATUSAKTIF == "" ? "active" : ($STATUSAKTIF == "1" ? "active" : "") ;?>">
                                            <input type="radio" name="rb_statusmembernya" value="1" id="rb_aktif">Member Ini Aktif </label>
                                        <label style="cursor:pointer" id="btn-status-item-0" class="btn-status-item btn btn-flat-warning <?= $STATUSAKTIF == "0" ? "active" : "" ;?>">
                                            <input type="radio" name="rb_statusmembernya" value="0" id="rb_tidakaktif"> Member Ini Tidak Aktif </label>
                                    </div><hr>
                                    <div class="form-group row">
                                        <label for="kodemember" class="col-sm-2 col-form-label">Kode Member</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <input value="<?= $MEMBER_ID ;?>" type="text" id="kodemember" class="form-control"
                                                    placeholder="Tentukan Kode Member">
                                                <div class="input-group-prepend">
                                                    <span id="generateiditem" class="input-group-text btn-warning btn">Generate ID</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- BEGIN Form -->
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Nama</label>
											<div class="col-sm-10">
												<!-- BEGIN Input Group -->
												<div class="input-group">
													<input value="<?= $NAMAD ;?>" id="namadepan" type="text" class="form-control" placeholder="Nama Depan dan Tengah">
													<input value="<?= $NAMAB ;?>" id="namabelkang" type="text" class="form-control" placeholder="Nama Akhir">
												</div>
												<!-- END Input Group -->
											</div>
										</div>
                                        <div class="form-group row">
											<label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
											<div class="col-sm-10">
                                                <select id="jeniskelamin" data-size="3" class="selectpicker" data-live-search="true">
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                    <option value="ALIEN">Alien</option>
                                                </select>
											</div>
										</div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
												<label for="negaramember">Negara</label>
												<input readonly type="text" class="form-control" id="negaramember" value="INDONESIA">
											</div>
                                            <div class="col-md-4 mb-3">
												<label for="provinsi">Provinsi</label>
                                                <input value="<?= $PROVINSI ;?>" type="text" class="form-control" id="provinsi" placeholder="Tentukan provinsi anda">
											</div>
											<div class="col-md-4 mb-3">
												<label for="kotamember">Kota</label>
												<input value="<?= $KOTA ;?>" type="text" class="form-control" id="kotamember" placeholder="Tentukan kota anda">
											</div>
										</div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
												<label for="kecamatan">Kecamatan</label>
												<input value="<?= $KECAMATAN ;?>" type="text" class="form-control" id="kecamatan" placeholder="Tentukan kecamatan anda">
											</div>
                                            <div class="col-md-8 mb-3">
												<label for="alamatmember">Alamat Terang</label>
                                                <input value="<?= $ALAMAT ;?>" type="text" class="form-control" id="alamatmember" placeholder="Tentukan alamat anda, RT/RW/NO jika ada">
											</div>
										</div>
                                        <div class="form-row">
											<div class="col-md-4 mb-3">
												<label for="kodepos">Kode POS</label>
												<input value="<?= $KODEPOS ;?>" type="text" placeholder="Tentukan kode pos untuk pengiriman barang"  class="form-control" id="kodepos">
											</div>
											<div class="col-md-4 mb-3">
												<label for="notelpmember">No Telepon</label>
												<input value="<?= $TELEPON ;?>" type="text" placeholder="Masukan no telepon aktif" class="form-control" id="notelpmember">
											</div>
											<div class="col-md-4 mb-3">
												<label for="emailmember">E-Mail</label>
												<!-- BEGIN Input Group -->
												<div class="input-group">
                                                    <input value="<?= $EMAIL ;?>" placeholder="Masukkan email aktif member" type="text" class="form-control" id="emailmember">
												</div>
												<!-- END Input Group -->
											</div>
										</div>
										<!-- END Form Group -->
										<label for="keteranganmember mb-3">Keterangan Member</label>
										<textarea class="form-control " id="keteranganmember" rows="3"><?= $KETERANGAN ;?></textarea>
                                </div>
                                <div class="tab-pane fade" id="info_member_pengaturan">
                                    <div class="form-row">
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="limitmember">Limit Piutang Member</label>
                                            <input value="<?= $LIMITJUMLAHPIUTANG ;?>" type="text" class="form-control" id="limitmember" placeholder="Tentukan akumulasi batas total piutang belanja">
                                            <small class="form-text text-muted">ISIKAN DENGAN ANGKA <b>0</b> JIKA TIDAK ADA BATAS NOMINAL TRX PIUTANG.</small>
                                        </div>
                                        <!-- END Form Group -->
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="jatuhtempomember">Jatuh Tempo</label>
                                            <div class="input-group">
                                                <input value="<?= $BATASTAMBAHKREDIT ;?>" type="text" class="form-control" id="jatuhtempomember" placeholder="Tentukan lama jatuh tempo tiap transaksi">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-warning btn">HARI</span>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">ISIKAN DENGAN ANGKA <b>0</b> JIKA TIDAK ADA BATAS JATUH TEMPO X HARI PIUTANG.</small>
                                        </div>
                                        <!-- END Form Group -->
                                    </div>
                                    <div class="form-row">
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="jenismember">Jenis Member</label>
                                            <select id="jenismember" data-size="3" class="selectpicker" data-live-search="true">
                                                <option value="Yakut Member">Yakut Member</option>
                                                <option value="Kalimaya Member">Kalimaya Member</option>
                                                <option value="Emerald Member">Emerald Member</option>
                                                <option value="Sapphire Member">Sapphire Member</option>
                                                <option value="Ruby Member">Ruby Member</option>
                                                <option value="Diamond Member">Diamond Member</option>
                                            </select>
                                        </div>
                                        <!-- END Form Group -->
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="membergroup">Group Pelanggan</label>
                                            <select class="form-control" id="membergroup"><?php if ($GRUP != ""){ echo "<option value=\"".$GRUP."\"> GROUP : ".$GRUP."</option>"; }?> ;?></select>
                                        </div>
                                        <!-- END Form Group -->
                                    </div>
                                    <div class="form-row">
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="minbelanjaperpoint">Min. Belanja / Poin</label>
                                            <input value="<?= $MINIMALPOIN ;?>" type="text" class="form-control" id="minbelanjaperpoint" placeholder="Kelipatan belanja per point">
                                            <small class="form-text text-muted">EX: SETIAP BELANJA KELIPATAN 10K AKAN MENDAPAT POINT 1.</small>
                                        </div>
                                        <!-- END Form Group -->
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="limitbarangmember">Limit Barang</label>
                                            <input value="<?= $LIMIT_BRG ;?>" type="text" class="form-control" id="limitbarangmember" placeholder="Tentukan limit dagang barang">
                                            <small class="form-text text-muted">LIMIT BARANG DIGUNAKAN UNTUK MEMBER MENGUPLOAD MAX PRODUK DALAM TOKONYA.</small>
                                        </div>
                                        <!-- END Form Group -->
                                    </div>
                                    <div class="form-row">
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="statusmember">Masa Aktif Member Anda</label><br>
                                            <div id="statusmember" class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label style="cursor:pointer" id="btn-status-item-1" class="btn-status-item btn btn-flat-success <?= $AKHIRAKTIFA == "9999-12-31" ? "active" : "" ;?>">
                                                    <input type="radio" name="rb_statusmember" value="1" id="rb_barangaktif">Always ON </label>
                                                <label style="cursor:pointer" id="btn-status-item-0" class="btn-status-item btn btn-flat-warning <?= $AKHIRAKTIFA !== "9999-12-31" ? "active" : "" ;?>">
                                                    <input type="radio" name="rb_statusmember" value="0" id="rb_barangtidakaktif"> Sampai Tanggal </label>
                                            </div>
                                        </div>
                                        <!-- END Form Group -->
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="akhiraktifmember">Tentukan Tanggal Tidak Aktif</label>
                                            <div class="input-group">
												<input readonly type="text" class="form-control" placeholder="Tidak aktif tanggal" id="akhiraktifmember">
												<div class="input-group-append">
													<span class="input-group-text">
														<i class="fa fa-calendar-alt"></i>
													</span>
												</div>
											</div>
                                        </div>
                                        <!-- END Form Group -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="info_member_acipay">
                                    <div class="form-row">
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="pintrx">PIN Transaksi</label>
                                            <input value="<?= $PINTRX ;?>" type="text" class="form-control" id="pintrx" placeholder="Tentukan panjang PIN antara 4 - 12 Digit">
                                            <small class="form-text text-muted">USAHAKAN PIN JANGAN MUDAH DITEBAK <b>OK</b> TETAPI YANG MUDAH DIINGAT. JIKA DALAM MODE UBAH DATA, ISIKAN PASSWORD JIKA INGIN DIUBAH,BIARKAN KOSONG JIKA TIDAK INGIN DIUBAH.</small>
                                        </div>
                                        <!-- END Form Group -->
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="apikey">API KEY</label>
                                            <div class="input-group">
                                                <input value="<?= $APIKEY ;?>" readonly type="password" class="form-control" id="apikey" placeholder="Masih dalam pengembangan">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-warning btn">PERLIHATAKAN API KEY</span>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">MASIH DALAM PENGEMBANGAN.MOHON TUNGGU KABAR SELANJUTNYA.</small>
                                        </div>
                                        <!-- END Form Group -->
                                    </div>
                                    <div class="form-row">
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="usernameid">User ID Acipay</label>
                                            <input value="<?= $USERNAME ;?>" type="text" class="form-control" id="usernameid" placeholder="Tentukan username untuk akses ACIPAY">
                                            <small class="form-text text-muted">DIGUNAKAN UNTUK AUTENTIKASI TRANSAKSI MELALUI JALUR API.USERNAME DAPAT DIGABUNGKAN ANTARA HURUF,ANGKA,SPASI,BAHKAN SPESIAL KARAKTER</small>
                                        </div>
                                        <!-- END Form Group -->
                                        <!-- BEGIN Form Group -->
                                        <div class="form-group col-md-6">
                                            <label for="passwordakses">Password ID</label>
                                            <div class="input-group">
                                                <input value="" type="password" class="form-control" id="passwordakses" placeholder="Tentukan password untuk akses ACIPAY">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-warning btn"><i class="fas fa-kiss-beam"></i></span>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">JIKA DALAM MODE UBAH DATA, ISIKAN PASSWORD JIKA INGIN DIUBAH,BIARKAN KOSONG JIKA TIDAK INGIN DIUBAH. SEBAGAI PRIVATE KEY ANDA DALAM MELAKUKAN AUTENTIKASI TRANSAKSI MELALUI JALUR API.</small>
                                        </div>
                                        <!-- END Form Group -->
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="kodeunikmember">KODEUNIKMEMBER</label>
                                            <input readonly value="<?= $KODEUNIKMEMBER ;?>" type="text" class="form-control" id="kodeunikmember" placeholder="Kelipatan belanja per point">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="markuphargaagen">MARKUP</label>
                                            <input value="<?= $MARKUP ;?>" type="text" class="form-control" id="markuphargaagen" placeholder="Harga jual akan ditambah dengan MARKUP">
                                            <small class="form-text text-muted">BERIKAN KELIPATAN MARKUP YANG SEWAJARNYA, JANGAN TERLALU BESAR ATAUPUN TERLALU KECIL.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Tab -->
                        </div>
                        <button id="simpanmember" class="btn btn-primary">Simpan Informasi Member </button>
                        <input style="visibility: hidden;" checked type="checkbox" id="isinsert">
                    </div>
                    <!-- END Portlet -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url();?>scripts/masterdata/member.js"></script>
<script>
var limitmember = new AutoNumeric("#limitmember", {decimalCharacter : ',',digitGroupSeparator : '.',})
var jatuhtempomember = new AutoNumeric("#jatuhtempomember", {decimalCharacter : ',',digitGroupSeparator : '.',})
var minbelanjaperpoint = new AutoNumeric("#minbelanjaperpoint", {decimalCharacter : ',',digitGroupSeparator : '.',})
var limitbarangmember = new AutoNumeric("#limitbarangmember", {decimalCharacter : ',',digitGroupSeparator : '.',})
$(document).ready(function () {
    $("#akhiraktifmember").datepicker({autoclose:true, format: 'dd-mm-yyyy', });
    <?php if ($MEMBER_ID != ""){ ?> 
        $("#isinsert").removeAttr("checked");
        $("#jeniskelamin").val("<?= $JK ;?>").change();
        $("#jenismember").val("<?= $JENIS ;?>").change();
        $("#akhiraktifmember").datepicker('update', '<?= ($AKHIRAKTIFA == "9999-12-31" ? "31-12-9999" : $AKHIRAKTIFA)  ;?>');
    <?php } ?>
    getCsrfTokenCallback(function() {
        $('#membergroup').select2({
            allowClear: true,
            placeholder: 'Berdasarkan Member Group',
            ajax: {
                url: baseurljavascript + 'masterdata/jsonmembergroup',
                method: 'POST',
                dataType: 'json',
                delay: 500,
                data: function (params) {
                    return {
                        csrf_aciraba: csrfTokenGlobal,
                        KATAKUNCIPENCARIAN: (typeof params.term === "undefined" ? "" : params.term),
                        DIMANA10: session_kodeunikmember,
                        DATAKE: 0,
                        LIMIT: 500,
                    }
                },
                processResults: function (data) {
                    parseJSON = JSON.parse(data);
                    getCsrfTokenCallback(function() {});
                    return {
                        results: $.map(parseJSON, function (item) {
                            return {
                                text: "GROUP : " + item.group,
                                id: item.group,
                            }
                        })
                    }
                },
                error: function(xhr, status, error) {
                    getCsrfTokenCallback(function() {});
                    toastr["error"](xhr.responseJSON.message);
                }
            },
        });
    });
});
$("#generateiditem").on("click", function () {
    $('#kodemember').val("SOHIB" + session_kodeunikmember + Math.floor(Date.now() / 1000));
});
$("#statusbarang").on("click", function () {
    if ($('input[name="rb_statusmember"]:checked').val() == 1) {
        $("#akhiraktifmember").removeAttr('readonly');
    } else {
        $('#akhiraktifmember').prop('readonly', true);
    }
});
</script>
<?= $this->endSection(); ?>