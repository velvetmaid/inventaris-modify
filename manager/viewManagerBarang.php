<!--  -->

<?php
$qb = new lsp();
$dataB = $qb->select("detailbarangmasuk");
if ($_SESSION['level'] != "Atasan") {
	header("location:../index.php");
}
if (isset($_GET['delete'])) {
	$response = $qb->delete("table_barang", "kd_barang", $_GET['id'], "?page=viewBarang");
}
?>

<style>
	@media print {

		.btn,
		.au-breadcrumb-content,
		.au-breadcrumb m-t-75,
		.zmdi-account-calendar,
		.dataTables_length,
		.dataTables_filter,
		.dataTables_info,
		.dataTables_paginate,
		.hd,
		.action {
			display: none;
		}
		.table {
			width: 500px !important;
		}
	}
</style>

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
								<li class="list-inline-item">Semua Data Barang</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="main-content" style="margin-top: -60px;">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="au-card-title">
							<div class="bg-overlay bg-overlay--blue"></div>
							<h3>
								<i class="zmdi zmdi-account-calendar"></i>Semua Data Barang Masuk
							</h3>
						</div>
						<div class="card-body">
							<a href="manager/export.php" name="export" class="btn btn-success" target="_blank">Export Excel</a>
							<button class="btn btn-info" onclick="window.print()">Print</button>
							<br>
							<br>
							<div class="table-responsive">
								<table id="example" class="table table-borderless table-striped table-earning">
									<thead>
										<tr>
											<th class="kode_id">Kode barang masuk</th>
											<th class="kode_id">Kode barang</th>
											<th>Nama barang</th>
											<th>Jenis Barang</th>
											<th>Supplier</th>
											<th>Tanggal Masuk</th>
											<th>Harga</th>
											<th>Stok Masuk</th>
											<th class="action">Detail</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($dataB as $ds) {
										?>
											<tr>
												<td><?= $ds['kd_barang_masuk'] ?></td>
												<td><?= $ds['kd_barang'] ?></td>
												<td><?= $ds['nama_barang'] ?></td>
												<td><?= $ds['nama_jenis_barang'] ?></td>
												<td><?= $ds['nama_supplier'] ?></td>
												<td><?= $ds['tanggal_masuk'] ?></td>
												<td><?= number_format($ds['harga_barang']) ?></td>
												<td><?= $ds['stok_masuk'] ?></td>
												<td class="action text-center">
													<a href="?page=viewBarangDetail&id=<?php echo $ds['kd_barang_masuk'] ?>" class="btn btn-warning"><i class="fa fa-search"></i></a>
												</td>
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
		</div>
	</div>
</div>