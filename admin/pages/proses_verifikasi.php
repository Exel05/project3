<?php
// Menghubungkan file ini dengan database melalui connection.php
include '../../connection.php';

// =======================================================
// AMBIL & SANITASI INPUT
// =======================================================

// Ambil nilai id_user dari URL dan ubah ke integer agar aman dari SQL Injection
$id_user = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil nilai status dari URL dan hapus spasi di awal/akhir
$status  = isset($_GET['status']) ? trim($_GET['status']) : '';

// =======================================================
// VALIDASI INPUT
// =======================================================

// Daftar status yang diperbolehkan (hanya bisa 'active' atau 'rejected')
$allowed_status = ['active', 'rejected'];

// Jika id tidak valid (≤ 0) atau status tidak termasuk dalam daftar yang diizinkan
if ($id_user <= 0 || !in_array($status, $allowed_status)) {
    // Tampilkan peringatan dan kembali ke halaman sebelumnya
    echo "<script>alert('Parameter tidak valid'); window.history.back();</script>";
    exit;
}

// =======================================================
// EKSEKUSI QUERY MENGGUNAKAN PREPARED STATEMENT (ANTI SQL INJECTION)
// =======================================================

// Siapkan query untuk memperbarui kolom status_user berdasarkan id_user
$stmt = $conn->prepare("UPDATE users SET status = ? WHERE id_user = ?");

// Jika query gagal disiapkan, tampilkan pesan error
if (!$stmt) {
    echo "<script>alert('Terjadi kesalahan pada query'); window.history.back();</script>";
    exit;
}

// Hubungkan parameter ke query: 
// "si" berarti s = string (status_user), i = integer (id_user)
$stmt->bind_param("si", $status, $id_user);

// =======================================================
// JALANKAN QUERY DAN CEK HASILNYA
// =======================================================

// Jika berhasil dijalankan, tampilkan pesan sukses dan arahkan kembali ke halaman manajemen user
if ($stmt->execute()) {
    echo "<script>alert('Status user berhasil diperbarui!'); window.location.href='../index.php?page=management_user';</script>";
} else {
    // Jika gagal, tampilkan pesan error dan kembali ke halaman sebelumnya
    echo "<script>alert('Gagal memperbarui status!'); window.history.back();</script>";
}

// =======================================================
// TUTUP STATEMENT & KONEKSI DATABASE
// =======================================================
$stmt->close();
$conn->close();
?>