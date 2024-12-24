<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location:../auth/login.php");
    exit;
}

require_once "../config.php";

$title = "Pendaftaran - Pondok Informatika";
require_once "../templete/header.php";
require_once "../templete/navbar.php";
require_once "../templete/sidebar.php";

if (isset($_POST['submit'])) {

    // Ambil id terbesar di kolom id_pendaftaran, lalu ambil 5 karakter dari sebelah kanan
    $getMaxId = mysqli_query($koneksi, "SELECT MAX(RIGHT(id_pendaftaran, 5)) AS id FROM tbl_pendaftaran");
    $d = mysqli_fetch_object($getMaxId);

    // Konversi $d->id ke integer, jika NULL jadikan 0
    $maxId = isset($d->id) ? (int)$d->id : 0;

    // Generate ID baru
    $generateId = 'p' . date('Y') . sprintf("%05s", $maxId + 1);

    // Proses insert
    $insert = mysqli_query($koneksi, "INSERT INTO tbl_pendaftaran VALUES (
        '".$generateId."',
        '".date('Y-m-d')."',
        '".$_POST['th_ajaran']."',
        '".$_POST['jurusan']."',
        '".$_POST['mm']."',
        '".$_POST['tmp_lahir']."',
        '".$_POST['tgl_lahir']."',
        '".$_POST['jk']."',
        '".$_POST['agama']."',
        '".$_POST['alamat']."'
    )");

    if ($insert) {
        echo '<script>window.location="berhasil.php?id='.$generateId  .'"</script>';
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSB Online</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    

<!-- contoh inputan -->
<input type="text" name="mm" class="input-control" required>
<span class="peringatan">Mohon isi nama lengkap</span>
    </style>
</head>
<body>
        

        <!-- bagian box formulir -->
        <section class="box-formulir">
            <h2>Formulir Pendaftaran Siswa PondokIT</h2>

            
            <!-- bagian form -->
            <form action="" method="post">
                <div class="box" >
                    <table border="0" class="table-form">
                        <tr>
                            <td>Tahun Ajaran</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="th_ajaran" class="input-control" value="2024/2025" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Jurusan</td>
                            <td>:</td>
                            <td>
                                <select class="input-control" name="jurusan" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Umum">Umum</option>
                                    <option value="kimia analis">kimia analis</option>
                                    <option value="Kimia industri">kimia industri</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>

                <h3>Data Diri Calon Siswa</h3>

                <div class="box" >
                    <table border="0" class="table-form">
                        <tr>
                            <td>Nama lengkap</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="mm" class="input-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Tempat lahir</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="tmp_lahir" class="input-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal lahir</td>
                            <td>:</td>
                            <td>
                                <input type="date" name="tgl_lahir" class="input-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis kelamin </td>
                            <td>:</td>
                            <td>
                                <input type="radio" name="jk" class="input-control" value="laki-laki">Laki-laki &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="jk" class="input-control" value="Perempuan">Perempuan
                            </td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>
                                <select class="input-control" name="agama" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Harus islam">Harus islam</option>
                                    <option value="Harus islam">Harus islam</option>
                                    <option value="Harus islam">Harus islam</option>
                                    <option value="Harus islam">Harus islam</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat lengkap</td>
                            <td>:</td>
                            <td>
                                <textarea class="input-control" name="alamat" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" class="btn-daftar" value="Daftar sekarang">
                            </td>
                        </tr>
                    </table>
                </div>

            </form>
        </section>



</body>
</html>