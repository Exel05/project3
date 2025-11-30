<?php
// Menghubungkan file dengan koneksi ke database
include '../../connection.php';

// Mengecek apakah request berasal dari form (method POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form dengan fungsi trim() agar tidak ada spasi di awal/akhir
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $username      = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $nomor_telpon      = trim($_POST['nomor_telpon']);
    $password      = trim($_POST['password']);
    $role          = strtolower(trim($_POST['role'])); // role disamakan ke huruf kecil untuk konsistensi

    // ==============================
    // VALIDASI INPUT
    // ==============================
    // Mengecek apakah semua field telah diisi. Jika ada yang kosong, tampilkan alert dan hentikan proses.
    if (empty($nama_lengkap) || empty($username) || empty($email) || empty($nomor_telpon) || empty($password) || empty($role)) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit;
    }

    // ==============================
    // PREPARED STATEMENT
    // ==============================
    // Membuat query SQL menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (nama_lengkap, username, email, nomor_telpon, password, role, status) VALUES (?, ?, ?, ?, ?, ?, 'active')");

    // Mengikat parameter ke dalam query (s = string)
    $stmt->bind_param("ssssss", $nama_lengkap, $username, $email, $nomor_telpon, $password, $role);

    // ==============================
    // EKSEKUSI QUERY
    // ==============================
    if ($stmt->execute()) {
        // Jika berhasil menambah user baru, tampilkan notifikasi dan arahkan ke halaman manajemen user
        echo "<script>
                alert('User baru berhasil ditambahkan!');
                window.location.href='../index.php?page=management_user';
              </script>";
    } else {
        // Jika terjadi error saat menyimpan data, tampilkan pesan error
        echo "<script>
                alert('Terjadi kesalahan: " . $stmt->error . "');
                window.history.back();
              </script>";
    }

    // Menutup statement dan koneksi ke database untuk menghemat resource
    $stmt->close();
    $conn->close();

} else {
    // Jika file diakses tanpa method POST, tampilkan pesan error
    echo "<script>alert('Akses tidak valid!'); window.history.back();</script>";
}
?>