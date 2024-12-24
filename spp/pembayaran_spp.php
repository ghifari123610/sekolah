<?php
require_once '../config.php'; // File koneksi database

// Ambil data siswa
$query = "SELECT * FROM tbl_guru";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            width: 100%;
            max-width: 400px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px; /* Memberikan jarak antar elemen */
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form select, form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        form button:hover {
            background-color: #218838;
        }
        .back-button {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        .back-button a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
        }
        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Pembayaran SPP</h1>
        <div class="container">
        <form action="proses_pembayaran.php" method="POST" enctype="multipart/form-data">
            <label for="siswa">Pilih Siswa:</label>
            <select name="siswa_id" id="siswa" required>
                <option value="">-- Pilih Siswa --</option>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="jumlah_bayar">Jumlah Bayar:</label>
            <input type="number" name="jumlah_bayar" id="jumlah_bayar" required>

            <label for="image">Bukti Pembayaran:</label>
            <input type="file" name="image" id="image" required>
            <small>Format file: PNG, JPG, JPEG. Maksimal 1 MB.</small>

            <button type="submit">Bayar</button>
        </form>

        </div>
    <div class="back-button">
        <a href="javascript:history.back()"> <i class="fas fa-arrow-left"> Kembali</a>
    </div>
</body>
</html>
