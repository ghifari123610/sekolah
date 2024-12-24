<?php
session_start();

if (!isset($_SESSION["ssLogin"])) {
    header("location: ../auth/login.php");
    exit();
}

require_once "../config.php";

$title = "Siswa - Pondok Informatika";
require_once "../templete/header.php";
require_once "../templete/navbar.php";
require_once "../templete/sidebar.php";

// Ambil parameter jurusan dari URL
$selectedJurusan = isset($_GET['jurusan']) ? mysqli_real_escape_string($koneksi, $_GET['jurusan']) : '';

$querySiswa = "SELECT * FROM tbl_siswa";
if (!empty($selectedJurusan)) {
    $querySiswa .= " WHERE jurusan = '$selectedJurusan'";
}

$resultSiswa = mysqli_query($koneksi, $querySiswa);
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Siswa Kelas <?= htmlspecialchars($selectedJurusan) ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="kelas.php">Kelas</a></li>
                <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-list"></i> Data Siswa</span>
                    <a href="<?= $main_url ?>/../siswa/add-siswa.php" class="btn btn-sm btn-primary float-end"><i class="fa-solid fa-plus"></i> Tambah Siswa</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col"><center>Foto</center></th>
                                <th scope="col"><center>NIS</center></th>
                                <th scope="col"><center>Nama</center></th>
                                <th scope="col"><center>Jurusan</center></th>
                                <th scope="col"><center>Alamat</center></th>
                                <th scope="col"><center>Operasi</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = mysqli_fetch_array($resultSiswa)) { ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td align="center"><img src="../asset/image/<?= $data['foto'] ?>" class="rounded-circle" width="60"></td>
                                    <td><?= $data['nis'] ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['jurusan'] ?></td>
                                    <td><?= $data['alamat'] ?></td>
                                <td align="center">
                                    <a href="../siswa/edit-siswa.php?nis=<?= $data['nis'] ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen" title="Update Siswa"></i> </a>
                                    <a href="../siswa/hapus-siswa.php?nis=<?= $data['nis'] ?>&foto=<?= $data['foto'] ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" title="Hapus Siswa" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"></i> </a>
                                </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

<?php require_once "../templete/footer.php"; ?>
