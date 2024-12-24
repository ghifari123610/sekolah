<?php 

session_start();

if (isset($_SESSION["sslogin"])) {
    header("location:../auth/login.php");
    exit();
}

require_once "../config.php";
$title = "Mata Pelajaran - Pondok Informatika";
require_once "../templete/header.php";
require_once "../templete/navbar.php";
require_once "../templete/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
if ($msg == 'cancel') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circel-xmark"></i> Tambah pelajaran gagal, mata pelajaran sudah ada...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($msg == 'added') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" id="added" role="alert">
        <i class="fa-solid fa-circle-check"></i> Tambah pelajaran berharil..
    </div>';
}
if ($msg == 'deleted') {
    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i> Pelajaran berhasil dihapus..
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($msg == 'cancelupdate') {
    $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circel-xmark"></i> Update pelajaran gagal, mata pelajaran sudah ada...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($msg == 'updated') {
    $alert = '<div class="alert alert-success alert-dismissible" style="display: none;" role="alert" id="updated">
        <i class="fa-solid fa-circle-check"></i> Pelajaran berhasil diperbarui..
    </div>';
}

 
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Mata Pelajaran</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item active">Mata Pelajaran</li>
            </ol>

            <?php if ($msg !== "") {
                echo $alert;
            }
            ?>
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa-solid fa-plus"></i> Tambah Pelajaran
                        </div>
                        <div class="card-body">
                           <form action="proses-pelajaran.php" method="POST">
                                <div class="mb-3">
                                    <label for="pelajaran" class="form-label">Pelajaran</label>
                                    <input type="text" class="form-control ps-1" id="pelajaran" name="pelajaran" placeholder="nama pelajaran" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <select name="jurusan" id="jurusan" class="form-select" required>
                                        <option value="" selected>--Pilih Jurusan--</option>
                                        <option value="Umum">Umum</option>
                                        <option value="Kimia Industri">Kimia Industri</option>
                                        <option value="Kimia Analis">Kimia Analis</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="guru" class="form-label">Guru</label>
                                    <select name="guru" id="guru" class="form-select" required>
                                        <option value="" selected>--Pilih Guru--</option>
                                        <?php
                                            $queryGuru = mysqli_query($koneksi, "SELECT * FROM tbl_guru");
                                            while ($dataGuru = mysqli_fetch_array($queryGuru)) {
                                                echo '<option value="' . $dataGuru['nama'] . '">' . $dataGuru['nama'] . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="simpan">
                                    <i class="fa-solid fa-floppy-disk"></i> Simpan
                                </button>
                                <button type="reset" class="btn btn-danger" name="reset">
                                    <i class="fa-solid fa-xmark"></i> Reset
                                </button>
                           </form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <i class="fa-solid fa-list me-2"></i> <!-- Menempatkan ikon di sebelah kiri dengan margin kanan -->
                            <span>Data Pelajaran</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <form action="" method="GET" class="col-4">
                                    <?php
                                    if (@$_GET['cari']) {
                                        $cari = @$_GET['cari'];
                                    } else {
                                        $cari = "";
                                    }
                                    ?>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="keyword" name="cari" value="<?= $cari; ?>">
                                        <button class="btn btn-secondary" type="submit" id="btnCari"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                                <?php
                                  $page = 5;
                                  if (isset($_GET['hal'])) {
                                      $halaktif = $_GET['hal'];
                                  } else {
                                      $halaktif = 1;
                                  }
                                  if (@$_GET['cari']) {
                                      $keyword = @$_GET['cari'];
                                  } else {
                                      $keyword = "";
                                  }
                                  
                                  $start = ($page * $halaktif) - $page;
                                  $no = $start + 1;
                                  $queryPelajaran = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE pelajaran like '%$keyword%' or jurusan like '%$keyword%' or guru like '%$keyword%' limit $page offset $start");

                                  $queryJmlData = mysqli_query($koneksi, "SELECT * FROM tbl_pelajaran WHERE pelajaran like '%$keyword%' or jurusan like '%$keyword%' or guru like '%$keyword%'");
                                  $jmlData = mysqli_num_rows($queryJmlData);
                                  $pages = ceil($jmlData / $page);
                                ?>
                                <div class="col-4 text-end">
                                    <label class="col-8 col-form-label text-end"> Jumlah data :<?= $jmlData ?></label>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">no</th>
                                    <th scope="col">
                                        <center>Mata Pelajaran</center>
                                    </th>
                                    <th scope="col">
                                        <center>Jurusan</center>
                                    </th>
                                    <th scope="col">
                                        <Center>Guru</Center>
                                    </th>
                                    <th scope="col">
                                        <Center>Operasi</Center>
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($queryPelajaran) > 0) {
                                        while ($data = mysqli_fetch_array($queryPelajaran)) { ?>
                                        
                                            <tr>
                                                <th scope="row"><?= $no++; ?></th>
                                                <td><?= $data['pelajaran']; ?></td>
                                                <td><?= $data['jurusan']; ?></td>
                                                <td><?= $data['guru']; ?></td>
                                                <td align="center">
                                                    <a href="edit-pelajaran.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-warning" title="update
                                                    pelajaran"><i class="fa-solid fa-pen"></i></a>
                                                    <button type="button" data-id="<?= $data['id']; ?>" id="btnHapus" class="btn btn-sm
                                                    btn-danger" title="hapus pelajaran"><i class="fa-solid fa-trash-can"></i></button>
                                                </td>
                                            </tr>

                                    <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="5" align="center">Data tidak ditemukan</td>
                                    
                                    <?php } ?>
                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <?php if (@$halaktif > 1) { ?>

                                    <li class="page-item">
                                    <a class="page-link" href="?hal=<?= $halaktif - 1 ?>&cari=<?= $keyword; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        </a>
                                        </li>
                                        <?php }
                                        for ($hal = 1; $hal <= $pages; $hal++) {
                                            if ($hal == $halaktif) { ?>
                                                 <li class="page-item active"><a class="page-link" href="?hal=<?= $hal; ?>&cari=<?= $keyword; ?>"><?= $hal; ?></a></li>
                                        <?php } else { ?>
                                            <li class="page-item"><a class="page-link" href="?hal=<?= $hal; ?>&cari=<?= $keyword; ?>"><?= $hal; ?></a></li>
                                        <?php        
                                            }
                                        }
                                        if (@$halaktif < $pages) {?>
                                        <li class="page-item">
                                        <a class="page-link" href="?hal=<?= $halaktif + 1 ?>&cari=<?= $keyword; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                    </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main> 


     <!-- Modal hapus data -->

                
     <div class="modal" id="mdlHapus" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Anda yakin akan mengapus data ini ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="" id="btnMdlHapus" class="btn btn-primary">Ya</a>
                    </div>
                </div>
            </div>
        </div>


    <script>
        $(document).ready(function() {
            $(document).on('click', '#btnHapus', function() {
                $('#mdlHapus').modal('show');
                let id = $(this).data('id');
                $('#btnMdlHapus').attr('href', 'hapus-pelajaran.php?id=' + id);
            })
            setTimeout(() => {
                $('#added').fadeIn('slow');
            }, 300)
            setTimeout(function(){
                $('#added').fadeOut('slow');
            }, 3000)

            setTimeout(function(){
                $('#updated').slideDown(700);
            }, 300)
            setTimeout(function(){
                $('#updated').slideUp(700);
            }, 5000)
        })
    </script>


<?php 

require_once "../templete/footer.php";

?>
