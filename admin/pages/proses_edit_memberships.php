<?php
// Menghubungkan file ke database
include '../../connection.php';

// Mengecek apakah request datang dari method POST (form submit)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form edit user
    $id_memberships       = intval($_POST['id_memberships']);           // Konversi id_memberships ke integer untuk keamanan
    $nama_paket = trim($_POST['nama_paket']);       // Menghapus spasi berlebih di awal/akhir input nama
    $durasi      = trim($_POST['durasi']);            // Menghapus spasi berlebih pada durasi
    $harga      = trim($_POST['harga']);
    $deskripsi      = trim($_POST['deskripsi']);          // Menghapus spasi berlebih pada kapasitas (jika diisi)

    // Validasi input wajib
    // if (empty($nama_paket) || empty($durasi)) {
    //     // Jika ada field yang kosong, tampilkan pesan peringatan dan kembali ke halaman sebelumnya
    //     echo "<script>alert('Nama, durasi, dan role wajib diisi!'); window.history.back();</script>";
    //     exit;
    // }

    // Mengecek apakah kapasitas diisi atau tidak
    if (!empty($deskripsi)) {
        // Jika kapasitas diisi, maka lakukan hashing menggunakan kapasitas_hash()
        // $kapasitas = kapasitas_hash($kapasitas, PASSWORD_DEFAULT);

        // Query update dengan mengganti password
        $stmt = $conn->prepare("UPDATE memberships SET nama_paket=?, durasi=?, harga=?, deskripsi=? WHERE id_memberships=?");
        // Mengikat parameter ke statement (mencegah SQL Injection)
        $stmt->bind_param("ssssi", $nama_paket, $durasi, $harga, $deskripsi, $id_memberships);
    } else {
        // Jika kapasitas tidak diisi, update data tanpa mengganti kapasitas
        $stmt = $conn->prepare("UPDATE memberships SET nama_paket=?, durasi=?, harga=?, deskripsi=? WHERE id_memberships=?");
        $stmt->bind_param("ssssi", $nama_paket, $durasi, $harga, $deskripsi, $id_memberships);
    }

    // Menjalankan perintah SQL
    if ($stmt->execute()) {
        // Jika berhasil diperbarui, tampilkan notifikasi dan kembali ke halaman manajemen user
        echo "<script>alert('Data memberships berhasil diperbarui!'); window.location.href='../index.php?page=memberships';</script>";
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