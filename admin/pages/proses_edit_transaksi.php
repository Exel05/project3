<?php
// Menghubungkan file ke database
include '../../connection.php';

// Mengecek apakah request datang dari method POST (form submit)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form edit user
    $id_transaksi       = intval($_POST['id_transaksi']);           // Konversi id_transaksi ke integer untuk keamanan
    $id_user = trim($_POST['id_user']);       // Menghapus spasi berlebih di awal/akhir input nama
    $id_memberships      = trim($_POST['id_memberships']);            // Menghapus spasi berlebih pada id_memberships
    $total_harga      = trim($_POST['total_harga']);
    $payments      = trim($_POST['payments']);          // Menghapus spasi berlebih pada kapasitas (jika diisi)

    // Validasi input wajib
    // if (empty($id_user) || empty($id_memberships)) {
    //     // Jika ada field yang kosong, tampilkan pesan peringatan dan kembali ke halaman sebelumnya
    //     echo "<script>alert('Nama, id_memberships, dan role wajib diisi!'); window.history.back();</script>";
    //     exit;
    // }

    // Mengecek apakah kapasitas diisi atau tidak
    if (!empty($payments)) {
        // Jika kapasitas diisi, maka lakukan hashing menggunakan kapasitas_hash()
        // $kapasitas = kapasitas_hash($kapasitas, PASSWORD_DEFAULT);

        // Query update dengan mengganti password
        $stmt = $conn->prepare("UPDATE transaksi SET id_user=?, id_memberships=?, total_harga=?, payments=? WHERE id_transaksi=?");
        // Mengikat parameter ke statement (mencegah SQL Injection)
        $stmt->bind_param("ssssi", $id_user, $id_memberships, $total_harga, $payments, $id_transaksi);
    } else {
        // Jika kapasitas tidak diisi, update data tanpa mengganti kapasitas
        $stmt = $conn->prepare("UPDATE transaksi SET id_user=?, id_memberships=?, total_harga=?, payments=? WHERE id_transaksi=?");
        $stmt->bind_param("ssssi", $id_user, $id_memberships, $total_harga, $payments, $id_transaksi);
    }

    // Menjalankan perintah SQL
    if ($stmt->execute()) {
        // Jika berhasil diperbarui, tampilkan notifikasi dan kembali ke halaman manajemen user
        echo "<script>alert('Data memberships berhasil diperbarui!'); window.location.href='../index.php?page=dashboard';</script>";
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>alert('Terjadi kesalahan: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Menutup statement dan koneksi database
    $stmt->close();
    $conn->close();

} else {
    // Jika file diakses langsung tanpa form submit, tampilkan pesan error
    echo "<script>alert('Akses tidak valid!'); window.history.back();</script>";
}
?>