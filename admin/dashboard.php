<?php
$pg = new lsp();
$pegawai = $pg->selectCount("table_user", "kd_user");
$barang  = $pg->selectCount("table_barang", "kd_barang");
$berhasil = $pg->selectCount("table_barang_keluar", "kd_barang_keluar");
$assoc1   = $pg->selectCount("table_barang_keluar", "jumlah_beli");
$dis  = $pg->getCountRows("table_supplier");
$mer  = $pg->getCountRows("table_jenis_barang");
$bar  = $pg->selectCount("table_barang", "kd_barang");
$pegawai = $pg->selectCount("table_user", "kd_user");
$stokmin = mysqli_query($con, "SELECT * FROM table_barang WHERE stok_barang < 5"); // Stok barang yang kurang dari 5
$jumlah_stokmin = mysqli_num_rows($stokmin); // Hitung row data yang memiliki stok_barang kurang dari 5
// $row = $jumlah_stokmin->fetch_assoc();
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
                                <!-- <canvas id="widgetChart3"></canvas> -->
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
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-chart"></i>
                                </div>
                                <div class="text">
                                    <h2><?= $jumlah_stokmin ?></h2>
                                    <span>Barang Min</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exModal">Lihat</button>
                                <!-- <canvas id="widgetChart23"></canvas> -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-case-check"></i>
                                </div>
                                <div class="text">
                                    <h2><?= $berhasil['count'] ?></h2>
                                    <span>Barang Keluar</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <!-- <canvas id="widgetChart3"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-assignment-check"></i>
                                </div>
                                <div class="text">
                                    <h2><?= $assoc1['count']; ?></h2>
                                    <span>Barang Terjual</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                <canvas id="widgetChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Semua Barang</h3>
                                <br>
                                <!-- <a href="manager/export.php" name="export" class="btn btn-success" target="_blank">Export Excel</a>
                                <a href="manager/databarangfull.php" target="_blank" class="btn btn-info">Print</a> -->
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                            <th>Kode barang</th>
                                            <th>Nama barang</th>
                                            <th>Harga</th>
                                            <th>Sisa Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($stokmin as $ds) { ?>
                                            <tr>
                                                <td><?= $ds['kd_barang'] ?></td>
                                                <td><?= $ds['nama_barang'] ?></td>
                                                <td><?= number_format($ds['harga_barang']) ?></td>
                                                <td><?= $ds['stok_barang'] ?></td>
                                            </tr>
                                        <?php $no++;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
<!-- End Modal -->