<div class="header" style="z-index: 100;">
    <!-- BEGIN Header Holder -->
    <div class="header-holder header-holder-desktop sticky-header" id="sticky-header-desktop">
        <div class="header-container container-fluid">
            <div class="header-wrap">
                <!-- BEGIN Nav -->
                <ul class="nav nav-pills">
                    <!-- BEGIN Dropdown -->
                    <li class="nav-item dropdown ">
                        <a href="javascript:void(0)" class="nav-link active" data-toggle="dropdown">OUTLET : <?= session('outlet');?></a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-wide dropdown-menu-animated overflow-hidden">
                            <div class="dropdown-row">
                                <!-- BEGIN Dropdown Column -->
                                <div class="dropdown-col d-flex flex-column align-items-start justify-content-center bg-primary text-white">
                                    <h2 class="font-weight-bolder">Selamat Datang!</h2>
                                    <p>Terima kasih telah menggunakan dan mempercayakan bisnis anda kepada kami. Kami akana terus mengembangkan sistem ini agar dapat memanjakan anda dan meningkatkan keuntungan anda.</p>
                                </div>
                                <!-- END Dropdown Column -->
                                <!-- BEGIN Dropdown Column -->
                                <div class="dropdown-col">
                                    <h4 class="dropdown-header dropdown-header-lg">Features</h4>
                                    <!-- BEGIN Grid Nav -->
                                    <div class="grid-nav grid-nav-action">
                                        <div class="grid-nav-row">
                                            <a href="#" class="grid-nav-item">
                                                <div class="grid-nav-icon">
                                                    <i class="far fa-window-restore"></i>
                                                </div>
                                                <span class="grid-nav-content">Dashboard</span>
                                            </a>
                                            <a href="#" class="grid-nav-item">
                                                <div class="grid-nav-icon">
                                                    <i class="far fa-clipboard"></i>
                                                </div>
                                                <span class="grid-nav-content">TODO list</span>
                                            </a>
                                            <a href="#" class="grid-nav-item">
                                                <div class="grid-nav-icon">
                                                    <i class="far fa-question-circle"></i>
                                                </div>
                                                <span class="grid-nav-content">Bantuan</span>
                                            </a>
                                        </div>
                                        <div class="grid-nav-row">
                                            <a href="#" class="grid-nav-item">
                                                <div class="grid-nav-icon">
                                                    <i class="far fa-images"></i>
                                                </div>
                                                <span class="grid-nav-content">Galery</span>
                                            </a>
                                            <a href="#" class="grid-nav-item">
                                                <div class="grid-nav-icon">
                                                    <i class="far fa-chart-bar"></i>
                                                </div>
                                                <span class="grid-nav-content">Scrumboard</span>
                                            </a>
                                            <a href="#" class="grid-nav-item">
                                                <div class="grid-nav-icon">
                                                    <i class="far fa-bookmark"></i>
                                                </div>
                                                <span class="grid-nav-content">Dokumentasi</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- END Grid Nav -->
                                </div>
                                <!-- END Dropdown Column -->
                            </div>
                        </div>
                    </li>
                    <!-- END Dropdown -->
                </ul>
                <!-- END Nav -->
            </div>
            <div class="header-wrap header-wrap-block">
                <!-- BEGIN Input Group -->
                <h3 class="title titleheader" style="text-align:center"><?= $titleheader ;?></h3>
                <!-- END Input Group -->
            </div>
            <div class="header-wrap">
            <div class="dropdown">
                    <button class="btn btn-label-primary btn-icon" id="theme-toggle" data-toggle="tooltip"
                        data-placement="bottom" title="Ubah Tema">
                        <i class="fa fa-moon"></i>
                    </button>
                    <button class="btn btn-label-primary btn-icon" data-toggle="dropdown">
                        <i class="fas fa-cash-register"></i>
                        <div class="btn-marker">
                            <i class="marker marker-dot text-success"></i>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-wide dropdown-menu-animated overflow-hidden py-0">
                        <!-- BEGIN Portlet -->
                        <div class="portlet border-0 portlet-scroll">
                            <div class="portlet-header bg-primary rounded-0">
                                <div class="portlet-icon text-white">
                                    <i class="far fa-bell"></i>
                                </div>
                                <h3 class="portlet-title text-white">Jalan Pintas</h3>
                                <div class="portlet-addon">
                                    <span class="badge badge-warning badge-square badge-lg">2</span>
                                </div>
                            </div>
                            <div class="portlet-body p-0 rounded-0" data-toggle="simplebar">
                                <!-- BEGIN Rich List -->
                                <div class="rich-list rich-list-action">
                                    <a href="<?= base_url().'penjualan/kasir/';?>" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-danger">
                                                <div class="avatar-display">
                                                    <i class="fas fa-cash-register"></i>
                                                    
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">Aplikasi POS [Kasir]</h4>
                                            <span class="rich-list-subtitle">Transaksi Penjualan Pelanggan</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                    <a href="<?= base_url().'kds/';?>" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-info">
                                                <div class="avatar-display">
                                                    <i class="fa fa-file-invoice"></i>
                                                    
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">Proses Paking Item</h4>
                                            <span class="rich-list-subtitle">KDS / Area Paking Barang</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                </div>
                                <!-- END Rich List -->
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                </div>
                <!-- BEGIN Dropdown -->
                <!-- END Dropdown -->
                <button class="btn btn-label-primary btn-icon ml-2" data-toggle="sidemenu" data-target="#sidemenu-todo">
                    <i class="fas fa-sliders-h"></i>
                </button>
                <!-- BEGIN Dropdown -->
                <div class="dropdown ml-2">
                    <button class="btn btn-flat-primary widget13" data-toggle="dropdown">
                        <div class="widget13-text"> Hi <strong><?= strtoupper(session('namapengguna')) ;?></strong>
                        </div>
                        <!-- BEGIN Avatar -->
                        <div class="avatar avatar-info widget13-avatar">
                            <div class="avatar-display">A</div>
                        </div>
                        <!-- END Avatar -->
                    </button>
                    <div class="dropdown-menu dropdown-menu-wide dropdown-menu-right dropdown-menu-animated overflow-hidden py-0">
                        <!-- BEGIN Portlet -->
                        <div class="portlet border-0">
                            <div class="portlet-header bg-primary rounded-0">
                                <!-- BEGIN Rich List Item -->
                                <div class="rich-list-item w-100 p-0">
                                    <div class="rich-list-prepend">
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar">
                                            <div class="avatar-display">
                                                <img src="<?= session('fotourl') == "" ? "https://sm.ign.com/ign_ap/cover/a/avatar-gen/avatar-generations_hugw.jpg" : session('fotourl') ;?>" alt="Avatar image">
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </div>
                                    <div class="rich-list-content">
                                        <h3 class="rich-list-title text-white"><?= session('namaasli');?></h3>
                                        <span class="rich-list-subtitle text-white"><?= session('hakakses');?></span>
                                    </div>
                                    <div class="rich-list-append">
                                        <span class="badge badge-warning badge-square badge-lg">9+</span>
                                    </div>
                                </div>
                                <!-- END Rich List Item -->
                            </div>
                            <div class="portlet-body p-0">
                                <!-- BEGIN Grid Nav -->
                                <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                    <div class="grid-nav-row">
                                        <a href="#" class="grid-nav-item">
                                            <div class="grid-nav-icon">
                                                <i class="far fa-address-card"></i>
                                            </div>
                                            <span class="grid-nav-content">Profile</span>
                                        </a>
                                        <a href="#" class="grid-nav-item">
                                            <div class="grid-nav-icon">
                                                <i class="far fa-comments"></i>
                                            </div>
                                            <span class="grid-nav-content">Messages</span>
                                        </a>
                                        <a href="#" class="grid-nav-item">
                                            <div class="grid-nav-icon">
                                                <i class="far fa-clone"></i>
                                            </div>
                                            <span class="grid-nav-content">Activities</span>
                                        </a>
                                    </div>
                                    <div class="grid-nav-row">
                                        <a href="#" class="grid-nav-item">
                                            <div class="grid-nav-icon">
                                                <i class="far fa-calendar-check"></i>
                                            </div>
                                            <span class="grid-nav-content">Tasks</span>
                                        </a>
                                        <a href="#" class="grid-nav-item">
                                            <div class="grid-nav-icon">
                                                <i class="far fa-sticky-note"></i>
                                            </div>
                                            <span class="grid-nav-content">Notes</span>
                                        </a>
                                        <a href="#" class="grid-nav-item">
                                            <div class="grid-nav-icon">
                                                <i class="far fa-bell"></i>
                                            </div>
                                            <span class="grid-nav-content">Notification</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- END Grid Nav -->
                            </div>
                            <div class="portlet-footer portlet-footer-bordered rounded-0">
                                <button onclick="verifikasikeluar()" class="btn btn-label-danger">Keluar</button>
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                </div>
                <!-- END Dropdown -->
            </div>
        </div>
    </div>
    <!-- END Header Holder -->
    <!-- BEGIN Header Holder -->
    <div class="header-holder header-holder-desktop">
        <div class="header-container container-fluid">
            <h4 class="header-title"><?= $sidetitle ;?></h4>
            <i class="header-divider"></i>
            <div class="header-wrap header-wrap-block justify-content-start">
                <!-- BEGIN Breadcrumb -->
                <div class="breadcrumb-icon"><i data-feather="home"></i></div>
                <?php foreach ($breadcrumb as $key=>$value) {
                    if($value!=''){?>
                    <a href="<?=$value; ?>" class="breadcrumb-item">
                        <span class="breadcrumb-text"><?= $key ;?></span>
                    </a>
                <?php } } ?>     
                
                <!-- END Breadcrumb -->
            </div>
            <div class="header-wrap">
                <!-- BEGIN Button Group -->
                <h4 class="header-title">SALDO : <span id="saldomembersekarang"><?= formatuang("IDR",session('totaldeposit'),"Rp");?></span></h4>
                <!-- END Button Group -->
                <button class="btn btn-label-info btn-icon ml-2" id="fullscreen-trigger" data-toggle="tooltip" title="Toggle fullscreen" data-placement="left">
                    <i class="fa fa-expand fullscreen-icon-expand"></i>
                    <i class="fa fa-compress fullscreen-icon-compress"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- END Header Holder -->
    <!-- BEGIN Header Holder -->
    <div class="header-holder header-holder-mobile sticky-header" id="sticky-header-mobile">
        <div class="header-container container-fluid">
            <div class="header-wrap header-wrap-block justify-content-start">
                <h4 class="header-brand titleheader"><?= $titleheader ;?></h4>
            </div>
            <div class="header-wrap">
                <!-- BEGIN Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-flat-primary btn-icon" data-toggle="dropdown">
                        <i class="far fa-bell"></i>
                        <div class="btn-marker">
                            <i class="marker marker-dot text-success"></i>
                        </div>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-wide dropdown-menu-animated overflow-hidden py-0">
                        <!-- BEGIN Portlet -->
                        <div class="portlet border-0 portlet-scroll">
                            <div class="portlet-header bg-primary rounded-0">
                                <div class="portlet-icon text-white">
                                    <i class="far fa-bell"></i>
                                </div>
                                <h3 class="portlet-title text-white">Notification</h3>
                                <div class="portlet-addon">
                                    <span class="badge badge-warning badge-square badge-lg">9+</span>
                                </div>
                            </div>
                            <div class="portlet-body p-0 rounded-0" data-toggle="simplebar">
                                <!-- BEGIN Rich List -->
                                <div class="rich-list rich-list-action">
                                    <a href="#" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-info">
                                                <div class="avatar-display">
                                                    <i class="fa fa-file-invoice"></i>
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">New report has been received</h4>
                                            <span class="rich-list-subtitle">2 min ago</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                    <a href="#" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-success">
                                                <div class="avatar-display">
                                                    <i class="fa fa-shopping-basket"></i>
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">Last order was completed</h4>
                                            <span class="rich-list-subtitle">1 hrs ago</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                    <a href="#" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-danger">
                                                <div class="avatar-display">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">Company meeting canceled</h4>
                                            <span class="rich-list-subtitle">5 hrs ago</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                    <a href="#" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-warning">
                                                <div class="avatar-display">
                                                    <i class="fa fa-paper-plane"></i>
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">New feedback received</h4>
                                            <span class="rich-list-subtitle">6 hrs ago</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                    <a href="#" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-primary">
                                                <div class="avatar-display">
                                                    <i class="fa fa-download"></i>
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">New update was availabled</h4>
                                            <span class="rich-list-subtitle">1 day ago</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                    <a href="#" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-success">
                                                <div class="avatar-display">
                                                    <i class="fa fa-asterisk"></i>
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">Your password was changed</h4>
                                            <span class="rich-list-subtitle">2 day ago</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                    <a href="#" class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <!-- BEGIN Avatar -->
                                            <div class="avatar avatar-label-info">
                                                <div class="avatar-display">
                                                    <i class="fa fa-user-plus"></i>
                                                </div>
                                            </div>
                                            <!-- END Avatar -->
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title">New account has been registered</h4>
                                            <span class="rich-list-subtitle">5 day ago</span>
                                        </div>
                                        <div class="rich-list-append">
                                            <i class="caret mx-2"></i>
                                        </div>
                                    </a>
                                </div>
                                <!-- END Rich List -->
                            </div>
                        </div>
                        <!-- END Portlet -->
                    </div>
                </div>
                <!-- END Dropdown -->
                <button class="btn btn-flat-primary btn-icon ml-2" data-toggle="sidemenu" data-target="#sidemenu-todo">
                    <i class="far fa-calendar-alt"></i>
                </button>
                <button class="btn btn-flat-primary btn-icon ml-2" data-toggle="aside">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- END Header Holder -->
    <!-- BEGIN Header Holder -->
    <div class="header-holder header-holder-mobile">
        <div class="header-container container-fluid">
            <div class="header-wrap header-wrap-block justify-content-start w-100">
                <!-- BEGIN Breadcrumb -->
                <div class="breadcrumb-icon"><i data-feather="home"></i></div>
                <?php foreach ($breadcrumb as $key=>$value) {
                    if($value!=''){?>
                    <a href="<?=$value; ?>" class="breadcrumb-item">
                        <span class="breadcrumb-text"><?= $key ;?></span>
                    </a>
                <?php } } ?>     
                
                <!-- END Breadcrumb -->
            </div>
        </div>
    </div>
    <!-- END Header Holder -->
</div>