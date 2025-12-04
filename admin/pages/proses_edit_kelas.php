<?php
// Menghubungkan file ke database
include '../../connection.php';

// Mengecek apakah request datang dari method POST (form submit)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form edit user
    $id_kelas       = intval($_POST['id_kelas']);           // Konversi id_kelas ke integer untuk keamanan
    $nama_kelas = trim($_POST['nama_kelas']);       // Menghapus spasi berlebih di awal/akhir input nama
    $instruktur      = trim($_POST['instruktur']);            // Menghapus spasi berlebih pada instruktur
    $jadwal      = trim($_POST['jadwal']);
    $waktu      = trim($_POST['waktu']);
    $kapasitas      = trim($_POST['kapasitas']);            // Menghapus spasi berlebih pada kapasitas (jika diisi)

    // Validasi input wajib
    // if (empty($nama_kelas) || empty($instruktur)) {
    //     // Jika ada field yang kosong, tampilkan pesan peringatan dan kembali ke halaman sebelumnya
    //     echo "<script>alert('Nama, instruktur, dan role wajib diisi!'); window.history.back();</script>";
    //     exit;
    // }

    // Mengecek apakah kapasitas diisi atau tidak
    if (!empty($kapasitas)) {
        // Jika kapasitas diisi, maka lakukan hashing menggunakan kapasitas_hash()
        // $kapasitas = kapasitas_hash($kapasitas, PASSWORD_DEFAULT);

        // Query update dengan mengganti password
        $stmt = $conn->prepare("UPDATE kelas SET nama_kelas=?, instruktur=?, jadwal=?, waktu=?, kapasitas=? WHERE id_kelas=?");
        // Mengikat parameter ke statement (mencegah SQL Injection)
        $stmt->bind_param("sssssi", $nama_kelas, $instruktur, $jadwal, $waktu, $kapasitas, $id_kelas);
    } else {
        // Jika kapasitas tidak diisi, update data tanpa mengganti kapasitas
        $stmt = $conn->prepare("UPDATE kelas SET nama_kelas=?, instruktur=?, jadwal=?, waktu=? WHERE id_kelas=?");
        $stmt->bind_param("ssssi", $nama_kelas, $instruktur, $jadwal, $waktu, $id_kelas);
    }

    // Menjalankan perintah SQL
    if ($stmt->execute()) {
        // Jika berhasil diperbarui, tampilkan notifikasi dan kembali ke halaman manajemen user
        echo "<script>alert('Data kelas berhasil diperbarui!'); window.location.href='../index.php?page=class';</script>";
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