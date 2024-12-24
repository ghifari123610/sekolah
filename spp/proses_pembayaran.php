<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $siswa_id = $_POST['siswa_id'];
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $tanggal_bayar = date('Y-m-d');
    $foto = '';

    // Validasi dan upload file
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['png', 'jpg', 'jpeg'];
        $max_size = 1 * 1024 * 1024; // 1 MB

        if (in_array($file_ext, $allowed_ext) && $_FILES['image']['size'] <= $max_size) {
            $unique_name = uniqid('foto_', true) . '.' . $file_ext;
            $upload_dir = '../uploads/';
            $upload_path = $upload_dir . $unique_name;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $foto = $unique_name;
            } else {
                echo "<script>alert('Gagal mengunggah file!'); window.history.back();</script>";
                exit;
            }
        } else {
            echo "<script>alert('Format file tidak valid atau ukuran terlalu besar!'); window.history.back();</script>";
            exit;
        }
    }

    // Simpan ke database
    $query = "INSERT INTO tbl_pembayaran (siswa_id, tanggal_bayar, jumlah_bayar, foto) VALUES ('$siswa_id', '$tanggal_bayar', '$jumlah_bayar', '$foto')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Pembayaran berhasil disimpan.');
                window.location.href = 'laporan_pembayaran.php';
              </script>";
    } else {
        $error_message = mysqli_error($koneksi);
        echo "<script>
                alert('Terjadi kesalahan: $error_message');
                window.history.back();
              </script>";
    }
}
?>
