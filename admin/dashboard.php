<?php
$dash = new lsp();
$dis  = $dash->getCountRows("table_supplier");
$mer  = $dash->getCountRows("table_jenis_barang");
$bar  = $dash->selectCount("table_barang", "kd_barang");
$pegawai = $dash->selectCount("table_user", "kd_user");
$barang  = $dash->selectCount("table_barang", "kd_barang");
$berhasil = $dash->selectCount("table_barang_keluar", "kd_barang_keluar");
$assoc1   = $dash->selectCount("table_barang_keluar", "jumlah_beli");

if ($_SESSION['level'] != "Staff") {
    header("location:../index.php");
}
?>
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row" style="margin-top: -30px;">
                <!-- Pembukuan Teks-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 style="color: white;">Pembukuan</h3>
                        </div>
                        <div class="card-body">
                            <a href="?page=kasirTransaksi" class="btn btn-primary">Disini !</a>
                        </div>
                    </div>
                </div>
                <!-- End -->
                <div class="row">
                    <!-- <div class="col-sm-6 col-lg-4">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-money-box"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?= $berhasil['count'] ?></h2>
                                        <span>Barang Keluar</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart3"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-item overview-item--c4">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-assignment-check"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?= $assoc1['count']; ?></h2>
                                        <span>Barang Keluar</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <!-- <canvas id="widgetChart4"></canvas> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?= $bar['count'] ?></h2>
                                        <span>Jumlah Barang</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <!-- <canvas id="widgetChart1"></canvas> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-item overview-item--c2">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?= $mer; ?></h2>
                                        <span>Jenis Barang</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <!-- <canvas id="widgetChart2"></canvas> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?= $dis; ?></h2>
                                        <span>Supplier</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <!-- <canvas id="widgetChart3"></canvas> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>