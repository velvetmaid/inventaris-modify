<?php
$dis = new lsp();
if ($_SESSION['level'] != "Atasan") {
    header("location:../index.php");
}
$table = "table_supplier";
$dataDis = $dis->select($table);
$autokode = $dis->autokode($table, "kd_supplier", "SP");

if (isset($_GET['delete'])) {
    $where = "kd_supplier";
    $whereValues = $_GET['id'];
    $redirect = "?page=viewDistributor";
    $response = $dis->delete($table, $where, $whereValues, $redirect);
}

if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $editData = $dis->selectWhere($table, "kd_supplier", $id);
    $autokode = $editData['kd_supplier'];
}
if (isset($_POST['getSave'])) {
    $kd_supplier   = $dis->validateHtml($_POST['kode_distributor']);
    $nama_supplier = $dis->validateHtml($_POST['nama_supplier']);
    $nohp_distributor = $dis->validateHtml($_POST['nohp_distributor']);
    $alamat           = $dis->validateHtml($_POST['alamat']);

    if ($kd_supplier == " " || empty($kd_supplier) || $nama_supplier == " " || empty($nama_supplier) || $nohp_distributor == " " || empty($nohp_distributor) || $alamat == " " || empty($alamat)) {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi field'];
    } else {
        $validno = substr($nohp_distributor, 0, 2);
        if ($validno != "08") {
            $response = ['response' => 'negative', 'alert' => 'Masukan No. Hp yang valid'];
        } else {
            if (strlen($nohp_distributor) < 11) {
                $response = ['response' => 'negative', 'alert' => 'Masukan 11 digit No. Hp'];
            } else {
                $value = "'$kd_supplier','$nama_supplier','$alamat','$nohp_distributor'";
                $response = $dis->insert($table, $value, "?page=viewDistributor");
            }
        }
    }
}

if (isset($_POST['getUpdate'])) {
    $kd_supplier   = $dis->validateHtml($_POST['kode_distributor']);
    $nama_supplier = $dis->validateHtml($_POST['nama_supplier']);
    $nohp_distributor = $dis->validateHtml($_POST['nohp_distributor']);
    $alamat           = $dis->validateHtml($_POST['alamat']);

    if ($kd_supplier == "" || $nama_supplier == "" || $nohp_distributor == "" || $alamat == "") {
        $response = ['response' => 'negative', 'alert' => 'lengkapi field'];
    } else {
        $validno = substr($nohp_distributor, 0, 2);
        if ($validno != "08") {
            $response = ['response' => 'negative', 'alert' => 'Masukan No HP yang valid'];
        } else {
            if (strlen($nohp_distributor) < 11) {
                $response = ['response' => 'negative', 'alert' => 'Masukan 11 digit No Hp'];
            } else {
                $value = "kd_supplier='$kd_supplier',nama_supplier='$nama_supplier',no_telp='$nohp_distributor',alamat='$alamat'";
                $response = $dis->update($table, $value, "kd_supplier", $_GET['id'], "?page=viewDistributor");
            }
        }
    }
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
                                <li class="list-inline-item">Data Supplier</li>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Input Supplier</strong>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="">Kode Supplier</label>
                                    <input type="text" class="form-control form-control-sm" name="kode_distributor" style="font-weight: bold; color: red;" value="<?php echo $autokode; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Supplier</label>
                                    <input type="text" class="form-control form-control-sm" name="nama_supplier" value="<?php echo @$editData['nama_supplier'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">No. Hp Supplier</label>
                                    <input type="text" class="form-control form-control-sm" name="nohp_distributor" value="<?php echo @$editData['no_telp']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat" rows="5" class="form-control"><?php echo @$editData['alamat'] ?></textarea>
                                </div>
                                <hr>
                                <?php if (isset($_GET['edit'])) : ?>
                                    <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button>
                                    <a href="?page=viewDistributor" class="btn btn-danger">Cancel</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['edit'])) : ?>
                                    <button type="submit" name="getSave" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Supplier</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Kode Supplier</th>
                                            <th>Nama</th>
                                            <th>No. Hp</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataDis as $ds) {
                                        ?>
                                            <tr>
                                                <td><?= $ds['kd_supplier'] ?></td>
                                                <td><?= $ds['nama_supplier'] ?></td>
                                                <td><?= $ds['no_telp'] ?></td>
                                                <td><?= $ds['alamat'] ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a data-toggle="tooltip" data-placement="top" title="Edit" href="?page=viewDistributor&edit&id=<?= $ds['kd_supplier'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a id="btnDelete<?php echo $no; ?>" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger"><i style="color: #fff;" class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <script src="vendor/jquery-3.2.1.min.js"></script>
                                            <script>
                                                $('#btnDelete<?php echo $no; ?>').click(function(e) {
                                                    e.preventDefault();
                                                    swal({
                                                        title: "Hapus",
                                                        text: "Yakin Ingin menghapus?",
                                                        type: "error",
                                                        showCancelButton: true,
                                                        confirmButtonText: "Yes",
                                                        cancelButtonText: "Cancel",
                                                        closeOnConfirm: false,
                                                        closeOnCancel: true
                                                    }, function(isConfirm) {
                                                        if (isConfirm) {
                                                            window.location.href = "?page=viewDistributor&delete&id=<?php echo $ds['kd_supplier'] ?>";
                                                        }
                                                    });
                                                });
                                            </script>
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
</div>