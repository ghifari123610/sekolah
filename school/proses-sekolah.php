<?php

session_start();

if (!isset($_SESSION['ssLogin'])) {
    header("location: ../auth/login.php");
    exit;
}


require_once "../config.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    //ambil value diposting
    $id         = $_POST['id'];
    $name       = trim(htmlspecialchars($_POST['nama']));
    $email      = trim(htmlspecialchars($_POST['email']));
    $status     = $_POST['status'];
    $akreditasi = $_POST['akreditasi'];
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $visimisi   = trim(htmlspecialchars($_POST['visimisi']));
    $gbr        = trim(htmlspecialchars($_POST['gbrLama']));

    //cek apakah gambar diupload
    if ($_FILES['image']['error'] === 4) {
        $gbrSekolah = $gbr;
    }else {
        $url = 'profile-sekolah.php';
        $gbrSekolah = uploadimg($url);
        @unlink('../asset/image/' . $gbr);
    }


    //update data
    $stmt = $koneksi->prepare("UPDATE tbl_sekolah SET 
    nama = ?, 
    email = ?, 
    status = ?, 
    akreditasi = ?, 
    alamat = ?, 
    visimisi = ?, 
    gambar = ? 
    WHERE id = ?");
        $stmt->bind_param("sssssssi", $name, $email, $status, $akreditasi, $alamat, $visimisi, $gbrSekolah, $id);
        $stmt->execute();
        $stmt->close();


    header("location:profile-sekolah.php?msg=updated");
    return;
}
