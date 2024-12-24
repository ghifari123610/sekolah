<?php


session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Tambah Siswa - Pondok Informatika";
require_once "../templete/header.php";
require_once "../templete/navbar.php";
require_once "../templete/sidebar.php";

$queryNis = mysqli_query($koneksi, "SELECT max(nis) as maxnis FROM tbl_siswa");
$data = mysqli_fetch_array($queryNis);
$maxnis = $data['maxnis'];

$noUrut = (int) substr($maxnis, 3, 3);
$noUrut++;
$maxnis = "NIS".sprintf("%03s", $noUrut);

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Siswa</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="siswa.php">Siswa</a></li>
                <li class="breadcrumb-item active">Tambah Siswa</li>
            </ol>
            <form action="proses-siswa.php" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                    <span class="h5 my-2"><i class="fa-solid fa-square-plus"></i> Tambah Siswa</span>
                    <button type="submit" name="simpan" class="btn btn-primary float-end"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="reset" name="reset" class="btn btn-danger float-end me-1"><i class="fa-solid fa-xmark" ></i> Reset</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                        <div class="mb-3 row">
                            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                            <label for="nis" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9" style="margin-left: -50px;">
                            <input type="text" name="nis" readonly class="form-control-plaintext border-bottom ps-2" id="nis" value="<?= $maxnis ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <label for="nis" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9" style="margin-left: -50px;">
                            <input type="text" name="nama" required class="form-control border-0 border-bottom ps-2" id="nis">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                            <label for="nis" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9" style="margin-left: -50px;">
                            <select name="kelas" id="kelas" class="form-select border-0 border-bottom ps-2" required>
                                <option selected>--Pilih Kelas--</option>
                                <option value="X">VII</option>
                                <option value="X">VIII</option>
                                <option value="X">IX</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                                <option value="Kuliah">Kuliah</option>
                                <option value="Kuliah">Tamat Sekolah</option>
                            </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <label for="jurusan" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9" style="margin-left: -50px;">
                                <select name="jurusan" id="jurusan" class="form-select border-0 border-bottom ps-2" required>
                                    <option selected>--Pilih Jurusan--</option>
                                    <option value="Frontend Developer">Umum</option>
                                    <option value="Backend Developer">Kimia Industri</option>
                                    <option value="Backend Developer">Kimia Analis</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <label for="nis" class="col-sm-1 col-form-label">:</label>
                            <div class="col-sm-9" style="margin-left: -50px;">
                               <textarea name="alamat" id="alamat" rows="3" placeholder="alamat siswa" class="form-control" required></textarea>
                            </div>
                        </div>
                        </div>
                        <div class="col-4 text-center px-5">
                            <img src="../asset/image/default.png" alt="" class="mb-3" width="40%">
                            <input type="file" name="image" class="form-control form-control-sm">
                            <small class="text-secondary">Pilih foto PNG, JPG, atau JPEG Degan ukuran maksimal 1 MB</small>
                            <div><small class="text-secondary">width = height</small></div>
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