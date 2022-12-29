<?php
$struk  = new lsp();
$id = $_GET['id'];
$data   = $struk->edit("transaksi", "kd_transaksi", $id);
$total  = $struk->selectSumWhere("transaksi", "sub_total", "kd_transaksi='$id'");
$dataDetail = $struk->edit("detailtransaksi", "kd_transaksi", $id);
$jumlah_barang = $struk->selectSumWhere("transaksi", "jumlah", "kd_transaksi='$id'");
?>
<style>
	.col-sm-8 {
		background: white;
		padding: 20px;
	}

	@media print {
		table {
			align-content: center;
		}

		header {
			display: none;
		}

		.ds {
			display: none;
		}

		.card {
			box-shadow: none;
			border: none;
		}

		.hd {
			display: none;
		}
	}
</style>
<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<h4>Rincian Barang Keluar</h4>
							<p>PT Inventory Indonesia</p>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-6">Kode Barang Keluar : <?php echo $id ?></div>
								<div class="col-sm-6">
									<p class="text-right"><span><?php echo "Tanggal Cetak : " . date("Y-m-d"); ?></p>
								</div>
							</div>
							<br>
							<table class="table table-striped table-bordered" width="80%">
								<tr>
									<td>Kode Antrian</td>
									<td>Nama Barang</td>
									<td>Harga Satuan</td>
									<td>Jumlah</td>
									<td>Sub Total</td>
								</tr>
								<?php foreach ($dataDetail as $dd) : ?>
									<tr>
										<td><?= $dd['kd_pretransaksi'] ?></td>
										<td><?= $dd['nama_barang'] ?></td>
										<td><?= $dd['harga_barang'] ?></td>
										<td><?= $dd['jumlah'] ?></td>
										<td><?= "Rp." . number_format($dd['sub_total']) . ",-" ?></td>
									</tr>
								<?php endforeach ?>
								<tr>
									<td colspan="2"></td>
									<td>Jumlah Pembelian Barang</td>
									<td><?php echo $jumlah_barang['sum'] ?></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="2"></td>
									<td colspan="2">Total</td>
									<td><?php echo "Rp." . number_format($total['sum']) . ",-" ?></td>
								</tr>
							</table>
							<br>
							<p>Tanggal Beli : <?php echo $dd['tanggal_beli']; ?></p>
							<br>
							<a href="#" class="btn btn-info ds" onclick="window.print()"><i class="fa fa-print"></i> Cetak Rincian Barang Keluar</a>
							<a href="?" class="btn btn-danger ds">Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>