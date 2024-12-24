<footer class="py-4 bg-light mt-auto border footer-custom">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">
                 Copyright &copy; Pondok Informatika <?= date('Y'); ?>
            </div>
        </div>
    </div>
</footer>

<!-- Tambahkan ini untuk memastikan footer berada di bawah -->
<style>
    /* Pastikan seluruh halaman menggunakan layout penuh */
    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    #layoutSidenav {
        flex: 1; /* Agar Sidenav mengambil ruang penuh */
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    #layoutSidenav_content {
        flex: 1; /* Konten halaman mengambil ruang yang tersisa */
    }

    footer {
        background-color: #f8f9fa; /* Warna latar belakang footer */
        border-top: 1px solid #ddd; /* Garis pembatas atas */
        text-align: center;
        width: 100%; /* Full-width footer */
        position: relative;
        bottom: 0;
        z-index: 10; /* Pastikan footer tetap terlihat */
    }

    /* Responsif: menyesuaikan untuk layar lebih kecil */
    @media (max-width: 768px) {
        footer {
            padding: 1rem; /* Mengurangi padding footer di layar kecil */
        }
    }
</style>

<!-- JavaScript dan penutup body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= $main_url ?>asset/sb_admin/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= $main_url ?>asset/sb_admin/js/datatables-simple-demo.js"></script>
