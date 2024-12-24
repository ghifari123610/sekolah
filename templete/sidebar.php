<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion bg-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link" href="<?= $main_url ?>index.php?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <hr class="mb-0">
                            <div class="sb-sidenav-menu-heading">Data</div>
                            <a class="nav-link" href="<?= $main_url ?>siswa/siswa.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Siswa
                            </a>
                            <a class="nav-link" href="<?= $main_url ?>guru/guru.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div>
                                Guru
                            </a>
                            <a class="nav-link" href="<?= $main_url ?>pelajaran/pelajaran.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Mata Pelajaran
                            </a>
                            <a class="nav-link" href="<?= $main_url ?>ujian/ujian.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-pen"></i></div>
                                Ujian
                            </a>
                            <a class="nav-link" href="<?= $main_url ?>kelas/kelas.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Kelas
                            </a>
                            <a class="nav-link" href="<?= $main_url ?>spp/pembayaran_spp.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                                Pembayaran SPP
                            </a>

                            <hr class="mb-0">
                            
                            <div class="sb-sidenav-menu-heading">Admin</div>
                            <a class="nav-link" href="<?= $main_url ?>user/password.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                                Ganti Password
                            </a>
                            <a class="nav-link" href="<?= $main_url ?>ppdb/login.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-key"></i></div>
                                Login Admin
                            </a>
                            <hr class="mb-0">
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer border">
                        <div class="small">Logged in as:</div>
                        <?= $_SESSION['ssUser'] ?>
                    </div>
                </nav>
            </div>