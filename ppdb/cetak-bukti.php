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

$peserta = mysqli_query($koneksi, "SELECT * FROM tbl_pendaftaran WHERE id_pendaftaran = '".$_GET['id']."' ");
$p = mysqli_fetch_object($peserta);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSB Online</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f4f4f4; 
            margin: 0; 
            padding: 0;
        }
        .container {
            width: 60%; 
            margin: 125px auto; 
            overflow: hidden; 
            padding: 20px; 
            background: #fff; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            text-align: center; /* Center-align the header text */ 
            margin-top: 20px;
        }
        table {
            width: 100%; 
            border-collapse: collapse; 
            margin: 20px 0;
        }
        table, th, td{
            border: 1px solid #ddd;
        }
        th, td { 
        padding: 12px; 
        text-align: center; /* Center-align text in table cells */ 
        }
        tr:nth-child(even) { 
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd; 
        }

    </style>
    <script>
        window.print();
    </script>
</head>
<body>

    <div class="container">
        <h2>Bukti pendaftaran</h2>
        <table>
            <tr>
                <td>Kode pendaftaran</td>
                <td>:</td>
                <td><?php echo $p->id_pendaftaran?></td>
            </tr>
            <tr>
                <td>Tahun ajaran</td>
                <td>:</td>
                <td><?php echo $p->th_ajaran?></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td><?php echo $p->jurusan?></td>
            </tr>
            <tr>
                <td>Nama lengkap</td>
                <td>:</td>
                <td><?php echo $p->mm_peserta?></td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td><?php echo $p->tmp_lahir.', '.$p->tgl_lahir ?></td>
            </tr>
            <tr>
                <td>Jenis kelamin</td>
                <td>:</td>
                <td><?php echo $p->jk ?></td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td><?php echo $p->agama ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $p->almt_peserta?></td>
            </tr>
        </table>
    </div> 



</body>
</html>