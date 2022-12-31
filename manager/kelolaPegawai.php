<?php

$rg = new lsp();
$table = "table_user";
$autokode = $rg->autokode($table, "kd_user", "US");
$data = $rg->select($table);

if (isset($_POST['getSave'])) {
    $kd_user = $_POST['kd_user'];
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $foto = $_FILES['foto'];
    $level = $_POST['level'];
    $redirect = "?page=kelPegawai";


    if ($nama_user == "" || $username == "" || $password == "" || $confirm == "" || $level == "") {
        $response = ['response' => 'negative', 'alert' => 'Lengkapi Field !!!'];
    } else {
        $response = $rg->register($kd_user, $nama_user, $username, $password, $confirm, $foto, $level, $redirect);
    }
}

if (isset($_POST['getUpdate'])) {
    $kd_user = $rg->validateHtml($_POST['kd_user']);
    $nama_user = $rg->validateHtml($_POST['nama_user']);
    $username = $rg->validateHtml($_POST['username']);
    $password = $rg->validateHtml($_POST['password']);
    $confirm = $rg->validateHtml($_POST['confirm']);
    $level = $rg->validateHtml($_POST['level']);

    if ($_FILES['foto'] == "") {
        $value    = "kd_user='$kd_user', nama_user='$nama_user', username='$username', password='$password', confirm='$confirm', level='$level'";
        $response = $rg->update($table, $value, "kd_user", $_GET['id'], "?page=kelPegawai");
    } else {
        $response = $rg->validateImage();
        if ($response['types'] == "true") {
            $value = "kd_user='$kd_user', nama_user='$nama_user', username='$username', password='$password', confirm='$confirm', level='$level',  foto_user='$response[image]'";
            $response = $rg->update($table, $value, "kd_user", $_GET['id'], "?page=kelPegawai");
        } else {
            $response = ['response' => 'negative', 'alert' => 'Error Gambar'];
        }
    }
}

if (isset($_GET['edit'])) {
    $editData = $rg->selectWhere($table, "kd_user", $_GET['id']);
}

if (isset($_GET['delete'])) {
    $response = $rg->delete($table, "kd_user", $_GET['id'], "?page=kelPegawai");
}

$pass = @$editData['password'];
$passDec = base64_decode($pass);

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
                                <li class="list-inline-item">Kelola Pegawai</li>
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
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Input Pegawai</strong>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Kode User</label>
                                    <?php if (!isset($_GET['edit'])) : ?>
                                        <input type="text" class="form-control form-control-sm" name="kd_user" style="color: red; font-weight: bold;" value="<?php echo $autokode; ?>" readonly>
                                    <?php endif ?>
                                    <?php if (isset($_GET['edit'])) : ?>
                                        <input style="color: red; font-weight: bold;" class="au-input au-input--full" type="text" name="kd_user" value="<?php echo @$editData['kd_user']; ?>" readonly>
                                    <?php endif ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="au-input au-input--full" required type="text" name="nama_user" placeholder="Nama" value="<?php echo @$editData['nama_user'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" required type="text" name="username" placeholder="Username" value="<?php echo @$editData['username'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" required type="text" name="password" placeholder="Password" value="<?php echo $passDec ?>">
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" required type="text" name="confirm" placeholder="Confirm Password" value="<?php echo $passDec ?>">
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Foto</label>
                                    <div style="padding-bottom: 15px;">
                                        <img alt="" width="120" class="img-responsive" id="pict" src="img/<?= @$editData['foto_user'] ?>">
                                    </div>
                                    <input required type="file" name="foto" id="gambar" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <label for="level" class="control-label mb-1">Level</label>
                                    <select name="level" class="form-control mb-1">
                                        <option value="Staff">Staff</option>
                                        <option value="Atasan">Atasan</option>
                                    </select>
                                </div>
                                <?php if (isset($_GET['edit'])) : ?>
                                    <!-- <button type="submit" name="getUpdate" class="btn btn-warning"><i class="fa fa-check"></i> Update</button> -->
                                    <a href="?page=kelPegawai" class="btn btn-danger">Tutup</a>
                                <?php endif ?>
                                <?php if (!isset($_GET['edit'])) : ?>
                                    <button name="getSave" class="au-btn au-btn--green m-b-20" type="submit">Input Pegawai</button>
                                    <button name="btnRegister" class="au-btn btn-danger m-b-20" type="reset">Cancel</button>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Data Pegawai</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pegawai</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Level</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data as $dataB) {
                                        ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $dataB['kd_user']; ?></td>
                                                <td><?= $dataB['nama_user'] ?></td>
                                                <td><?= $dataB['username'] ?></td>
                                                <td><?= $dataB['level'] ?></td>
                                                <td><img width="60" src="img/<?= $dataB['foto_user'] ?>" alt=""></td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit" href="?page=kelPegawai&edit&id=<?= $dataB['kd_user'] ?>">
                                                            <i style="color: #fff;" class="fa fa-eye"></i>
                                                        </a>
                                                        <a id="btnDelete<?php echo $no; ?>" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i style="color: #fff;" class="fa fa-trash"></i>
                                                        </a>
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
                                                            window.location.href = "?page=kelPegawai&delete&id=<?php echo $dataB['kd_user'] ?>";
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