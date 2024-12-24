<?php
require_once '../config.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['siswa_id'])) {
    $siswa_id = $_GET['siswa_id'];

    // Ambil data pembayaran berdasarkan siswa_id
    $query = "SELECT * FROM tbl_pembayaran WHERE siswa_id = '$siswa_id'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Pembayaran</title>
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
            .form-container {
                background-color: #fff;
                padding: 20px 30px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
            }
            .form-container h1 {
                margin-bottom: 20px;
                font-size: 24px;
                text-align: center;
                color: #333;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                color: #555;
            }
            .form-group input {
                width: 100%;
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-sizing: border-box;
            }
            .form-group input:focus {
                border-color: #007bff;
                outline: none;
            }
            .btn {
                display: block;
                width: 100%;
                padding: 10px;
                font-size: 16px;
                text-align: center;
                color: #fff;
                background-color: #007bff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .btn:hover {
                background-color: #0056b3;
            }
            .error-message {
                text-align: center;
                color: red;
                font-size: 16px;
            }
        </style>
    </head>
    <body>
        <div class="form-container">
            <?php if ($data): ?>
                <h1>Edit Pembayaran</h1>
                <form action="update_pembayaran.php" method="post">
                    <input type="hidden" name="siswa_id" value="<?= htmlspecialchars($siswa_id) ?>">
                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar:</label>
                        <input type="number" name="jumlah_bayar" id="jumlah_bayar" value="<?= htmlspecialchars($data['jumlah_bayar']) ?>" required>
                    </div>
                    <button type="submit" class="btn">Update</button>
                </form>
            <?php else: ?>
                <p class="error-message">Data tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
}
?>
