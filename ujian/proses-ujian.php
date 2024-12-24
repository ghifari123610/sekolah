<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../config.php";

if (isset($_POST['simpan'])) {
    $noUjian = htmlspecialchars($_POST['noUjian']);
    $tgl = htmlspecialchars($_POST['tgl']);
    $nis = htmlspecialchars($_POST['nis']);
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $sum = htmlspecialchars($_POST['sum']);
    $min = htmlspecialchars($_POST['min']);
    $max = htmlspecialchars($_POST['max']);
    $avg = htmlspecialchars($_POST['avg']);

    if ($min < 50 || $avg < 60) {
        $hasilUjian = "GAGAL";
    } else {
        $hasilUjian = "LULUS";
    }

    $mapel = $_POST['mapel'];
    $jurus = $_POST['jurus'];
    $nilai = $_POST['nilai'];

    // Pastikan semua array terdefinisi dan disanitasi
    if (is_array($mapel) && is_array($jurus) && is_array($nilai)) {
        // Periksa apakah noUjian sudah ada
        $checkQuery = mysqli_query($koneksi, "SELECT no_ujian FROM tbl_ujian WHERE no_ujian='$noUjian'");
        if (mysqli_num_rows($checkQuery) > 0) {
            echo "Error: no_ujian sudah ada. Gunakan nilai yang berbeda.";
        } else {
            $queryUjian = "INSERT INTO tbl_ujian (no_ujian, tgl_ujian, nis, jurusan, total_nilai, nilai_terendah, nilai_tertinggi, nilai_rata2, hasil_ujian) 
                           VALUES ('$noUjian', '$tgl', '$nis', '$jurusan', '$sum', '$min', '$max', '$avg', '$hasilUjian')";
            mysqli_query($koneksi, $queryUjian);

            foreach ($mapel as $key => $mpl) {
                $mpl_sanitized = htmlspecialchars($mpl, ENT_QUOTES, 'UTF-8');
                $jurus_sanitized = htmlspecialchars($jurus[$key], ENT_QUOTES, 'UTF-8');
                $nilai_sanitized = htmlspecialchars($nilai[$key], ENT_QUOTES, 'UTF-8');

                $queryNilai = "INSERT INTO tbl_nilai_ujian (no_ujian, pelajaran, jurusan, nilai_ujian) 
                               VALUES ('$noUjian', '$mpl_sanitized', '$jurus_sanitized', '$nilai_sanitized')";
                mysqli_query($koneksi, $queryNilai);
            }

            header("Location: nilai-ujian.php?msg=$hasilUjian&nis=$nis");
            exit();

        }
    } else {
        echo "Input tidak valid. Pastikan semua data terisi dengan benar.";
    }
}
?>
