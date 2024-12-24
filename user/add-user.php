<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}



// Include file konfigurasi
require_once "../config.php";

// Judul halaman
$title = "Tambah User - Pondok Informatika";

// Include template
require_once "../templete/header.php";
require_once "../templete/navbar.php";
require_once "../templete/sidebar.php";

// Mendapatkan pesan dari parameter URL (jika ada)
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

// Variabel untuk menampilkan alert
$alert = '';
if ($msg == 'cancel') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-xmark"></i> Tambah user gagal, username sudah ada.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} elseif ($msg == 'notimage') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-xmark"></i> Tambah user gagal, file yang Anda upload bukan gambar.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} elseif ($msg == 'oversize') {
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-xmark"></i> Tambah user gagal, ukuran gambar maksimal 1MB.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} elseif ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i> Tambah user berhasil, segera ganti password Anda!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Tambah User</li>
            </ol>
            <form action="proses-user.php" method="POST" enctype="multipart/form-data">
                <?php if ($msg !== '') echo $alert; ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i> Tambah User</span>
                        <button type="submit" class="btn btn-primary float-end" name="simpan">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan
                        </button>
                        <button type="reset" class="btn btn-danger float-end me-1" name="reset">
                            <i class="fa-solid fa-xmark"></i> Reset
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="mb-3 row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" pattern="[A-Za-z0-9]{3,}" title="Minimal 3 karakter kombinasi huruf dan angka" class="form-control" id="username" name="username" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" maxlength="20" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <select name="jabatan" id="jabatan" class="form-select" required>
                                            <option value="" selected>--Pilih Jabatan--</option>
                                            <option value="guru">Calon Siswa</option>
                                            <option value="kepsek">Kepsek</option>
                                            <option value="staf_tu">Staf TU</option>
                                            <option value="guru">Guru Mata Pelajaran</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <img id="previewImage" src="../asset/image/default.png" alt="gambar user" class="mb-3" style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ddd; border-radius: 50%;">
                                <input type="file" id="imageInput" name="image" class="form-control" accept="image/png, image/jpg, image/jpeg" required>
                                <small class="text-secondary">Pilih gambar PNG, JPG, atau JPEG dengan ukuran maksimal 1MB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <?php 

        require_once "../templete/footer.php";

    ?>
</div>


