<?php
// Menghubungkan file dengan koneksi ke database
include '../../connection.php';

// Mengecek apakah request berasal dari form (method POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form dengan fungsi trim() agar tidak ada spasi di awal/akhir
    $nama_kelas = trim($_POST['nama_kelas']);
    $instruktur      = trim($_POST['instruktur']);
    $jadwal      = trim($_POST['jadwal']);
    $waktu      = trim($_POST['waktu']);
    $kapasitas      = trim($_POST['kapasitas']);


    // ==============================
    // VALIDASI INPUT
    // ==============================
    // Mengecek apakah semua field telah diisi. Jika ada yang kosong, tampilkan alert dan hentikan proses.
    if (empty($nama_kelas) || empty($instruktur) || empty($jadwal) || empty($waktu) || empty($kapasitas)) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit;
    }

    // ==============================
    // KEAMANAN PASSWORD
    // ==============================
    // Mengubah password menjadi hash agar tidak disimpan dalam bentuk teks biasa di database
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ==============================
    // PREPARED STATEMENT
    // ==============================
    // Membuat query SQL menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO kelas (nama_kelas, instruktur, jadwal, waktu, kapasitas) VALUES (?, ?, ?, ?, ?)");

    // Mengikat parameter ke dalam query (s = string)
    $stmt->bind_param("sssss", $nama_kelas, $instruktur, $jadwal, $waktu, $kapasitas);

    // ==============================
    // EKSEKUSI QUERY
    // ==============================
    if ($stmt->execute()) {
        // Jika berhasil menambah user baru, tampilkan notifikasi dan arahkan ke halaman manajemen user
        echo "<script>
                alert('Kelas baru berhasil ditambahkan!');
                window.location.href='../index.php?page=class';
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