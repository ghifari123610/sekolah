<?php
require_once '../config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $siswa_id = $_POST['siswa_id'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    $query = "UPDATE tbl_pembayaran SET jumlah_bayar = '$jumlah_bayar' WHERE siswa_id = '$siswa_id'";
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Pembayaran</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #f4f4f9;
            }
            .message-box {
                background-color: #fff;
                padding: 20px 30px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            .message-box h1 {
                margin: 0 0 10px;
                font-size: 24px;
                color: #333;
            }
            .message-box p {
                margin: 0 0 20px;
                color: #666;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                font-size: 16px;
                color: #fff;
                background-color: #007bff;
                text-decoration: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .btn:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="message-box">
            <?php
            if (mysqli_query($koneksi, $query)) {
                echo "<h1>Berhasil!</h1>";
                echo "<p>Data pembayaran telah berhasil diupdate.</p>";
            } else {
                echo "<h1>Gagal!</h1>";
                echo "<p>Terjadi kesalahan: " . mysqli_error($koneksi) . "</p>";
            }
            ?>
            <a href="laporan_pembayaran.php" class="btn">Kembali ke Laporan</a>
        </div>
    </body>
    </html>
    <?php
}
?>
