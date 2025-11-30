<?php
// Memulai sesi untuk melacak login user
session_start();

// -----------------------------
// Pencegahan Cache Browser
// -----------------------------
// Baris ini mencegah browser menyimpan cache halaman admin.
// Jadi, setelah logout, user tidak bisa kembali ke halaman admin lewat tombol "Back" browser.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// -----------------------------
// Validasi Hak Akses (Admin Only)
// -----------------------------
// Mengecek apakah sesi login sudah ada dan role user adalah admin.
// Jika tidak memenuhi, pengguna diarahkan kembali ke halaman login.
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'pengguna') {
    header("Location: ../index.php");
    exit();
}

// -----------------------------
// Routing Halaman Admin
// -----------------------------
// Variabel $page menentukan halaman mana yang akan dimuat dari URL (?page=...)
// Jika tidak ada parameter 'page', maka secara default menampilkan halaman 'dashboard'
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard_user';

// Menyusun path file halaman berdasarkan parameter / __DIR__ = Directory
$pagePath = __DIR__ . '/pages/' . $page . '.php';
?>

<!DOCTYPE html>
<html lang="en">

<!-- Menyertakan file header (biasanya berisi <head>, link CSS, dan judul halaman) -->
<?php include 'header.php'; ?>

<body>
    <!-- Inisialisasi tema (misal dark/light mode) -->
    <script src="assets/static/js/initTheme.js"></script>

    <div id="app">
        <!-- Bagian sidebar -->
        <div id="sidebar">
            <?php include 'sidebar.php'; ?> <!-- Menampilkan menu navigasi sidebar -->
        </div>

        <div id="main">
            <!-- Header atas halaman -->
            <header class="mb-3">
                <!-- Tombol burger untuk membuka sidebar pada tampilan mobile -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <!-- Konten utama halaman -->
            <div class="page-content">
                <?php
                // -----------------------------
                // Pemanggilan Halaman Dinamis
                // -----------------------------
                // Mengecek apakah file halaman yang diminta ada di folder 'pages'
                // Jika ada => tampilkan isinya
                // Jika tidak ada => tampilkan pesan error sederhana
                if (file_exists($pagePath)) {
                    include $pagePath;
                } else {
                    echo "<h4>Halaman tidak ditemukan.</h4>";
                }
                ?>
            </div>

            <!-- Footer halaman -->
            <!-- <?php include 'footer.php'; ?> -->
        </div>
    </div>

    <!-- -----------------------------
         Pemanggilan File JavaScript
         -----------------------------
         Berisi skrip interaktif untuk tema, scrollbar, dan komponen UI -->
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>
</body>
</html>