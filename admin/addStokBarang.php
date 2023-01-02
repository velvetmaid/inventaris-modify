<?php
$br = new lsp();
if ($_SESSION['level'] != "Staff") {
    header("location:../index.php");
}
$table    = "table_barang";
$transkode = $br->autokode("table_barang_masuk", "kd_barang_masuk", "BM");
$data     = $br->selectWhere($table, "kd_barang", $_GET['id']);
$getMerek = $br->select("table_jenis_barang");
$getDistr = $br->select("table_supplier");
$waktu    = date("Y-m-d");
if (isset($_POST['getSimpan'])) {
    $kode_barang_masuk  = $br->validateHtml($_POST['kode_barang_masuk']);
    $kode_barang  = $br->validateHtml($_POST['kode_barang']);
    $nama_barang  = $br->validateHtml($_POST['nama_barang']);
    $merek_barang = $br->validateHtml($_POST['merek_barang']);
    $distributor  = $br->validateHtml($_POST['distributor']);
    $harga        = $br->validateHtml($_POST['harga']);
    $stok         = $br->validateHtml($_POST['stok']);
    $stok_masuk   = $br->validateHtml($_POST['stok_masuk']);
    $ket          = $_POST['ket'];

    if ($kode_barang == " " || $nama_barang == " " || $harga == " " || $stok == " " || $ket == " ") {
        $response = ['response' => 'negative', 'alert' => 'lengkapi field'];
    } else {
        if ($harga < 0 || $stok < 0 || $harga == 0 || $stok == 0) {
            $response = ['response' => 'negative', 'alert' => 'Harga atau stok tidak boleh 0 atau <'];
        } else {
            if ($_FILES['foto']['name'] == "") {
                $value = "kd_barang='$kode_barang',nama_barang='$nama_barang',kd_jenis_barang='$merek_barang',kd_supplier='$distributor',harga_barang='$harga',stok_barang='$stok',keterangan='$ket'";
                $response = $br->update($table, $value, "kd_barang", $_GET['id'], "?page=viewBarang");

                $value1 = "'$kode_barang_masuk','$kode_barang','$nama_barang','$merek_barang','$distributor','$waktu','$harga','$stok', $stok_masuk, '$response[image]','$ket'";
                $response = $br->insert("table_barang_masuk", $value1, "?page=viewBarang");
            } else {
                $response = $br->validateImage();
                if ($response['types'] == "true") {
                    $valueIns = "'$kode_barang_masuk','$kode_barang','$nama_barang','$merek_barang','$distributor','$waktu','$harga','$stok', $stok_masuk, '$response[image]','$ket'";
                    $response = $br->insert("table_barang_masuk", $valueIns, "?page=viewBarang");

                    $valueUp = "kd_barang='$kode_barang',nama_barang='$nama_barang',kd_jenis_barang='$merek_barang',kd_supplier='$distributor',tanggal_masuk='$waktu',harga_barang='$harga',stok_barang='$stok',keterangan='$ket',gambar='$response[image]'";
                    $response = $br->update($table, $valueUp, "kd_barang", $_GET['id'], "?page=viewBarang");
                }
            }
        }
    }
}
?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="au-card-title" >
                                <div class="bg-overlay bg-overlay--blue"></div>
                                <h3>
                                    <i class="zmdi zmdi-account-calendar"></i>Data Barang Masuk
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6" style="padding: 0 5px 0 0;">
                                                        <label for="">Kode barang masuk</label>
                                                        <input type="text" style="font-weight: bold; color: red;" class="form-control" name="kode_barang_masuk" value="<?= $transkode; ?>" readonly>
                                                    </div>
                                                    <div class="col-md-6" style="padding: 0 0 0 5px;">
                                                        <label for="">Kode barang</label>
                                                        <input type="text" style="font-weight: bold; color: blue;" class="form-control" name="kode_barang" value="<?php echo $data['kd_barang']; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama barang</label>
                                                <input type="text" class="form-control" name="nama_barang" value="<?php echo @$data['nama_barang'] ?>" readonly>
                                            </div>

                                            <div style="display: none;" class="form-group">
                                                <label for="">Jenis Barang</label>
                                                <select name="merek_barang" class="form-control">
                                                    <option value=" ">Pilih Jenis Barang</option>
                                                    <?php foreach ($getMerek as $mr) { ?>
                                                        <?php if ($mr['kd_jenis_barang'] == $data['kd_jenis_barang']) { ?>
                                                            <option value="<?= $mr['kd_jenis_barang'] ?>" selected><?= $mr['nama_jenis_barang'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $mr['kd_jenis_barang'] ?>"><?= $mr['nama_jenis_barang'] ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div style="display: none;" class="form-group">
                                                <label for="">Supplier</label>
                                                <select name="distributor" class="form-control">
                                                    <option value="">Pilih Supplier</option>
                                                    <?php foreach ($getDistr as $dr) { ?>
                                                        <?php if ($dr['kd_supplier'] == $data['kd_supplier']) { ?>
                                                            <option value="<?= $dr['kd_supplier'] ?>" selected><?= $dr['nama_supplier'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $dr['kd_supplier'] ?>"><?= $dr['nama_supplier'] ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group" id="foto">
                                                <!-- <label for="">Foto</label> -->
                                                <div class="row">
                                                    <div class="col-6" style="display: none;">
                                                        <input type="file" name="foto" id="gambar" class="form-control-file">
                                                    </div>
                                                    <div class="col-6 pt-50">
                                                        <div>
                                                            <img style="margin-top: -20px;" alt="" src="img/<?= $data['gambar'] ?>" width="120" class="img-responsive" id="pict">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Harga barang</label>
                                                <input type="number" class="form-control" name="harga" value="<?php echo $data['harga_barang'] ?>" readonly>
                                            </div>

                                            <!-- Sum -->
                                            <div class="form-group">
                                                <label for="">Sisa barang</label>
                                                <input id="sisaStok" type="number" class="form-control" value="<?php echo $data['stok_barang'] ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Tambah stok barang</label>
                                                <input id="tambahStok" type="number" class="form-control" name="stok_masuk">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total stok barang</label>
                                                <input id="totalStok" type="number" name="stok" class="form-control" readonly>
                                            </div>
                                            <!-- End Sum -->

                                            <div class="form-group">
                                                <label for="">Keterangan</label>
                                                <input type="text" class="form-control" name="ket" value="<?php echo $data['keterangan'] ?>" readonly>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Update</button>
                                <a href="?page=viewBarang" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#sisaStok, #tambahStok").on("keydown keyup", sum);

        function sum() {
            $("#totalStok").val(Number($("#sisaStok").val()) + Number($("#tambahStok").val()));
        }
    })
</script>