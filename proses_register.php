<?php
session_start();
include 'connection.php'; // pastikan connection.php membuat $conn (mysqli)

// Ambil input
$nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$nomor_telpon = trim($_POST['nomor_telpon'] ?? '');
$password = trim($_POST['password'] ?? '');


// Validasi sederhana
if (empty($nama_lengkap) || empty($username) || empty($email) || empty($nomor_telpon) || empty($password)) {
    $_SESSION['error'] = "Semua field wajib diisi!";
    header("Location: register.php");
    exit();
}

// if ($password !== $password) {
//     $_SESSION['error'] = "Password dan konfirmasi password tidak cocok!";
//     header("Location: register.php");
//     exit();
// }

// Cek apakah username sudah ada
$stmt = $conn->prepare("SELECT id_user FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $_SESSION['error'] = "Username sudah digunakan!";
    $stmt->close();
    header("Location: register.php");
    exit();
}
$stmt->close();

// Simpan password secara plaintext (tidak di-hash) — SESUAI PERMINTAAN
$role = "pengguna"; // default role
$status = "pending"; // default status (admin harus verifikasi)

// Insert user
$stmt = $conn->prepare("INSERT INTO users (nama_lengkap, username, email, nomor_telpon, password, role, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $nama_lengkap, $username, $email, $nomor_telpon, $password, $role, $status);

if ($stmt->execute()) {
    $_SESSION['success'] = "Registrasi berhasil! Silakan tunggu verifikasi admin.";
    $stmt->close();
    $conn->close();
    header("Location: register.php");
    exit();
} else {
    $_SESSION['error'] = "Gagal menyimpan data: " . $stmt->error;
    $stmt->close();
    $conn->close();
    header("Location: register.php");
    exit();
}
?>
