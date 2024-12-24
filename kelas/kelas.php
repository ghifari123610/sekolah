<?php  

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";
$title = "Data Kelas - Pondok Informatika";
require_once "../templete/header.php";
require_once "../templete/navbar.php";
require_once "../templete/sidebar.php";

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Kelas Jurusan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Data Kelas</li>
            </ol>
            <div class="card">
                <div class="card-header">
                <i class="fa-solid fa-list"></i>  Data Setiap Kelas
                <a href="<?= $main_url ?>kelas/add-kelas.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah Kelas</a>
                </div>
                <div class="card-body">
                <table class="table table-hover" id="datatablesSimple">
                    <thead>
                        <tr>
                        <th scope="col"><center>No</center></th>
                        <th scope="col"><center>Foto</center></th>
                        <th scope="col"><center>NIP</center></th>
                        <th scope="col"><center>Nama Guru</center></th>
                        <th scope="col"><center>Telpon</center></th>
                        <th scope="col"><center>Alamat</center></th>
                        <th scope="col"><center>Kelas</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                        while ($data = mysqli_fetch_array($queryGuru)) {
                        ?>
                        <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td align="center"><img src="../asset/image/<?= $data['foto'] ?>" class="rounded-circle" width="60" alt=""></td>
                        <td><?= $data['nip'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['telpon'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td align="center">
                            <a href="kelas-guru.php?jurusan=<?= urlencode($data['jurusan']) ?>" 
                            class="btn btn-success btn-sm rounded-0 col-10 fw-bold text-uppercase"
                            style="color: #fff; text-decoration: none;">
                            <?= $data['jurusan'] ?>
                            </a>
                        </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </main>


    <?php
    require_once "../templete/footer.php";
    ?>