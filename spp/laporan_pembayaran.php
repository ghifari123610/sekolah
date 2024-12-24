<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Laporan Pembayaran SPP Siswa">
    <title>Laporan Pembayaran SPP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }
        tr:hover td {
            background-color: #e9ecef;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .edit-btn {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }
        .edit-btn:hover {
            background-color: #218838;
        }
        .exit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .exit-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Pembayaran SPP</h1>
        <table aria-label="Tabel Laporan Pembayaran">
            <thead>
                <tr>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Jumlah Bayar</th>
                    <th scope="col">Status</th>
                    <th scope="col">bukti</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../config.php'; // File koneksi database

                // Query untuk laporan pembayaran
                $query = "
                SELECT 
                    s.id AS siswa_id, 
                    s.nama, 
                    IFNULL(SUM(p.jumlah_bayar), 0) AS jumlah_bayar,
                    CASE 
                        WHEN SUM(p.jumlah_bayar) > 0 THEN 'Sudah Membayar'
                        ELSE 'Belum Membayar'
                    END AS status,
                    MAX(p.bukti) AS bukti
                FROM 
                    tbl_guru s
                LEFT JOIN 
                    tbl_pembayaran p ON s.id = p.siswa_id
                GROUP BY 
                    s.id, s.nama
                ";
            
                $result = mysqli_query($koneksi, $query);

                // Tampilkan hasil query
                while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= number_format($row['jumlah_bayar'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td>
                            <?= $row['bukti'] ? '<a href="../uploads/' . htmlspecialchars($row['bukti']) . '" target="_blank">Lihat Bukti</a>' : 'Tidak Ada Bukti' ?>
                        </td>
                        <td>
                            <button class="edit-btn" onclick="window.location.href='edit_pembayaran.php?siswa_id=<?= $row['siswa_id'] ?>'">Edit</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button class="exit-btn" onclick="window.location.href='../index.php'">Keluar</button>
    </div>
</body>
</html>
