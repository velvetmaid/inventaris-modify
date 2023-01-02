<?php
$br = new lsp();
if ($_SESSION['level'] != "Staff") {
    header("location:../index.php");
}
$table = "table_barang";
$getMerek = $br->select("table_jenis_barang");
$getBar = $br->select("table_barang");
$getDistr = $br->select("table_supplier");
$autokode = $br->autokode("table_barang", "kd_barang", "BR");
$transkode = $br->autokode("table_barang_masuk", "kd_barang_masuk", "BM");
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
    $foto         = $_FILES['foto'];
    $ket   = $_POST['ket'];

    if ($kode_barang == " " || $nama_barang == " " || $merek_barang == " " || $distributor == " " || $harga == " " || $stok == " " || $stok_masuk == " " || $foto == " " || $ket == " ") {
        $response = ['response' => 'negative', 'alert' => 'lengkapi field'];
    } else {
        if ($harga < 0 || $stok < 0 || $harga == 0 || $stok == 0) {
            $response = ['response' => 'negative', 'alert' => 'Harga atau stok tidak boleh 0 atau <'];
        } else {
            $response = $br->validateImage();
            if ($response['types'] == "true") {
                $valueIns = "'$kode_barang','$nama_barang','$merek_barang','$distributor','$waktu','$harga','$stok', $stok_masuk, '$response[image]','$ket'";
                $response = $br->insert("table_barang", $valueIns, "?page=viewBarang");

                $value = "'$kode_barang_masuk','$kode_barang','$nama_barang','$merek_barang','$distributor','$waktu','$harga','$stok', $stok_masuk, '$response[image]','$ket'";
                $response = $br->insert("table_barang_masuk", $value, "?page=viewBarang");
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Kode barang masuk</label>
                                            <input type="text" style="font-weight: bold; color: red;" class="form-control" name="kode_barang_masuk" value="<?php echo $transkode; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kode barang</label>
                                            <input type="text" style="font-weight: bold; color: blue;" class="form-control" name="kode_barang" value="<?php echo $autokode; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama barang</label>
                                            <input type="text" placeholder="Nama Barang" class="form-control" name="nama_barang" value="<?php echo @$_POST['nama_barang'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jenis Barang</label>
                                            <select name="merek_barang" class="form-control">
                                                <option value=" ">Pilih Jenis Barang</option>
                                                <?php foreach ($getMerek as $mr) { ?>
                                                    <option value="<?= $mr['kd_jenis_barang'] ?>"><?= $mr['nama_jenis_barang'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Supplier</label>
                                            <select name="distributor" class="form-control">
                                                <option value="">Pilih Supplier</option>
                                                <?php foreach ($getDistr as $dr) { ?>
                                                    <option value="<?= $dr['kd_supplier'] ?>"><?= $dr['nama_supplier'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Harga barang</label>
                                            <input type="number" class="form-control" name="harga">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Stok barang</label>
                                            <input id="stok" type="number" class="form-control" name="stok">
                                            <input id="stok_masuk" style="display: none;" type="number" class="form-control" name="stok_masuk">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <input type="text" class="form-control" name="ket">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#stok').keyup(function() {
        $('#stok_masuk').val($(this).val());
    });
    $('#stok_masuk').keyup(function() {
        $('#stok').val($(this).val());
    });
</script>