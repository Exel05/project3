<?php
// Memulai sesi PHP agar bisa mengakses variabel sesi
session_start();

// Menghapus semua variabel sesi yang ada
session_unset();

// Menghancurkan seluruh sesi (logout sepenuhnya)
session_destroy();

// Menambahkan header untuk mencegah browser menyimpan cache halaman ini
// Cache-Control: no-store, no-cache, must-revalidate, max-age=0 → memaksa browser tidak menyimpan halaman
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// post-check & pre-check digunakan untuk kompatibilitas dengan beberapa browser lama (IE)
header("Cache-Control: post-check=0, pre-check=0", false);

// Menonaktifkan cache pada browser lama dengan menggunakan header Pragma
header("Pragma: no-cache");

// Setelah sesi dihapus, pengguna diarahkan kembali ke halaman login (index.php)
header("Location: login.php");

// Menghentikan eksekusi script agar redirect berjalan segera
exit();
?>