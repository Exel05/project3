<?php
// Menghubungkan file ke database
include '../../connection.php';

// Mengecek apakah request datang dari method POST (form submit)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form edit user
    $id_user       = intval($_POST['id_user']);           // Konversi id_user ke integer untuk keamanan
    $nama_lengkap = trim($_POST['nama_lengkap']);       // Menghapus spasi berlebih di awal/akhir input nama
    $username      = trim($_POST['username']);            // Menghapus spasi berlebih pada username
    $email      = trim($_POST['email']);
    $nomor_telpon      = trim($_POST['nomor_telpon']);
    $password      = trim($_POST['password']);            // Menghapus spasi berlebih pada password (jika diisi)
    $role          = strtolower(trim($_POST['role']));    // Mengubah role ke huruf kecil agar konsisten

    // Validasi input wajib
    if (empty($nama_lengkap) || empty($username) || empty($role)) {
        // Jika ada field yang kosong, tampilkan pesan peringatan dan kembali ke halaman sebelumnya
        echo "<script>alert('Nama, username, dan role wajib diisi!'); window.history.back();</script>";
        exit;
    }

    // Mengecek apakah password diisi atau tidak
    if (!empty($password)) {
        // Jika password diisi, maka lakukan hashing menggunakan password_hash()
        // $password = password_hash($password, PASSWORD_DEFAULT);

        // Query update dengan mengganti password
        $stmt = $conn->prepare("UPDATE users SET nama_lengkap=?, username=?, email=?, nomor_telpon?, password=?, role=? WHERE id_user=?");
        // Mengikat parameter ke statement (mencegah SQL Injection)
        $stmt->bind_param("ssssssi", $nama_lengkap, $username, $email, $nomor_telpon, $password, $role, $id_user);
    } else {
        // Jika password tidak diisi, update data tanpa mengganti password
        $stmt = $conn->prepare("UPDATE users SET nama_lengkap=?, username=?, email=?, nomor_telpon=?, role=? WHERE id_user=?");
        $stmt->bind_param("sssssi", $nama_lengkap, $username, $email, $nomor_telpon, $role, $id_user);
    }

    // Menjalankan perintah SQL
    if ($stmt->execute()) {
        // Jika berhasil diperbarui, tampilkan notifikasi dan kembali ke halaman manajemen user
        echo "<script>alert('Data user berhasil diperbarui!'); window.location.href='../index.php?page=management_user';</script>";
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