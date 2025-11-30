<?php
session_start();
include 'connection.php';

// Ambil input
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validasi input
if (empty($username) || empty($password)) {
    $_SESSION['error'] = "Username dan password wajib diisi!";
    header("Location: login.php");
    exit();
}

// Ambil user berdasarkan username
$stmt = $conn->prepare("SELECT id_user, username, password, role, status FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $data = $result->fetch_assoc();

    // Pastikan kolom status di DB bernama 'status'. Jika beda, sesuaikan.
    if ($data['status'] !== 'active') {
        $_SESSION['error'] = "Akun Anda belum diverifikasi oleh admin.";
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit();
    }

    // Karena kita tidak menggunakan hash, bandingkan plaintext langsung
    if ($password === $data['password']) {
        // Login sukses
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        $stmt->close();
        $conn->close();

        if ($data['role'] === 'admin') {
            header("Location: admin/index.php");
            exit();
        } else {
            header("Location: pengguna/index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Password salah!";
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit();
    }

} else {
    $_SESSION['error'] = "Username tidak ditemukan!";
    $stmt->close();
    $conn->close();
    header("Location: login.php");
    exit();
}
?>
