<?php
$qb = new lsp();
$dataB = $qb->edit("detailbarang", "stok_barang", 0);
if (isset($_GET['export'])) {
	$dateNow = date("Y-m-d");
	header("Content-type:application/vnd-ms-excel");
	header("Content-Disposition:attachment;filename='$dateNow'-DataBarangHabis.xls");
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
								<li class="list-inline-item">Data Barang Habis</li>
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
						<div class="au-card-title" >
							<div class="bg-overlay bg-overlay--blue"></div>
							<h3>
								<i class="zmdi zmdi-account-calendar"></i>Data Barang Habis
							</h3>
						</div>
						<div class="card-body">
							<!-- <button class="btn btn-success"><a href="manager/BarangHabisPrint.php" style="color: white;">Export Excel</a></button> -->
							<button class="btn btn-info" onclick="window.print()">Print</button>
							<br>
							<br>
							<div class="table-responsive">
								<table id="example" class="table table-borderless table-striped table-earning">
									<thead>
										<tr>
											<th>Kode barang</th>
											<th>Nama barang</th>
											<th>Jenis Barang</th>
											<th>Supplier</th>
											<th>Tanggal Masuk</th>
											<th>Harga</th>
											<th>Stok</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($dataB as $ds) {
										?>
											<tr>
												<td><?= $ds['kd_barang'] ?></td>
												<td><?= $ds['nama_barang'] ?></td>
												<td><?= $ds['nama_jenis_barang'] ?></td>
												<td><?= $ds['nama_supplier'] ?></td>
												<td><?= $ds['tanggal_masuk'] ?></td>
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
		</div>
	</div>
</div>