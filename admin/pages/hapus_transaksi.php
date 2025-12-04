<?php
// Menghubungkan file ini dengan database
// connection.php berisi konfigurasi koneksi ke MySQL (host, user, password, database)
include '../../connection.php';

// Mengecek apakah parameter 'id' dikirim melalui URL (GET)
if (isset($_GET['id'])) {
    // Mengubah nilai id menjadi integer untuk menghindari injeksi SQL (keamanan)
    $id = intval($_GET['id']);

    // Menjalankan perintah SQL untuk menghapus data user berdasarkan id_user
    // Baris ini akan menghapus 1 data user dari tabel 'users'
    $conn->query("DELETE FROM transaksi WHERE id_transaksi = $id");
}

// Setelah proses hapus selesai, arahkan kembali ke halaman manajemen user
// page=management_user akan membuka halaman daftar user di dalam admin panel
header("Location: ../index.php?page=dashboard");

// Menghentikan eksekusi script agar tidak ada kode lain yang dijalankan
exit();
?>

<!--
Fungsi isset() pada PHP digunakan untuk memeriksa apakah sebuah variabel telah 
dideklarasikan dan memiliki nilai selain NULL.
-->