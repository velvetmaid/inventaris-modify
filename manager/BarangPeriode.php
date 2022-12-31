<?php
$qb = new lsp();

if (isset($_POST['btnSearch'])) {
	$whereparam = "tanggal_masuk";
	$param      = $_POST['dateAwal'];
	$param1     = $_POST['dateAkhir'];
	$dataB      = $qb->selectBetween("detailbarang", $whereparam, $param, $param1);
}
?>

<style>
	@media print {

		input[type="date"] {
			border: none;
			margin-left: -12.5px;
		}

		table {
			margin-top: -100px !important;
			border: #000 solid 1px;
		}

		.btn,
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

<div class="main-content" style="margin-top: 20px;">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<form method="post">
							<div class="card-header">
								<h3>Barang Periode</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-4">
										<label for="#">Dari Tanggal</label>
										<input value="<?= $_POST['dateAwal'] ?>" class="form-control" type="date" placeholder="Select Date" name="dateAwal" required>
									</div>
									<div class="col-sm-4">
										<label for="#">Ke Tanggal</label>
										<input value="<?= $_POST['dateAkhir'] ?>" class="form-control" type="date" placeholder="Select Date" name="dateAkhir" required>
									</div>
								</div>
								<br>
								<button class="btn btn-primary" name="btnSearch"><i class="fa fa-search"></i> Search</button>
								<a href="?page=periode" class="btn btn-danger">Reload</a>
								<br><br>
								<?php if (isset($_POST['dateAwal'])) : ?>
									<button class="btn btn-info" onclick="window.print()">Print</button>
								<?php endif ?>
								<br><br>
								<table class="table table-striped table-hover table-bordered">
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
										foreach (@$dataB['data'] as $ds) { ?>
											<tr>
												<td><?= $ds['kd_barang'] ?></td>
												<td><?= $ds['nama_barang'] ?></td>
												<td><?= $ds['nama_jenis_barang'] ?></td>
												<td><?= $ds['nama_supplier'] ?></td>
												<td><?= $ds['tanggal_masuk'] ?></td>
												<td><?= number_format($ds['harga_barang']) ?></td>
												<td><?= $ds['stok_barang'] ?></td>
											<?php $no++;
										} ?>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>