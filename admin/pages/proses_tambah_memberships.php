<?php
// Menghubungkan file dengan koneksi ke database
include '../../connection.php';

// Mengecek apakah request berasal dari form (method POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form dengan fungsi trim() agar tidak ada spasi di awal/akhir
    $nama_paket = trim($_POST['nama_paket']);
    $durasi      = trim($_POST['durasi']);
    $harga      = trim($_POST['harga']);
    $deskripsi      = trim($_POST['deskripsi']);


    // ==============================
    // VALIDASI INPUT
    // ==============================
    // Mengecek apakah semua field telah diisi. Jika ada yang kosong, tampilkan alert dan hentikan proses.
    if (empty($nama_paket) || empty($durasi) || empty($harga) || empty($deskripsi)) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit;
    }

    // ==============================
    // PREPARED STATEMENT
    // ==============================
    // Membuat query SQL menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO memberships (nama_paket, durasi, harga, deskripsi) VALUES (?, ?, ?, ?)");

    // Mengikat parameter ke dalam query (s = string)
    $stmt->bind_param("ssss", $nama_paket, $durasi, $harga, $deskripsi);

    // ==============================
    // EKSEKUSI QUERY
    // ==============================
    if ($stmt->execute()) {
        // Jika berhasil menambah user baru, tampilkan notifikasi dan arahkan ke halaman manajemen user
        echo "<script>
                alert('Membership baru berhasil ditambahkan!');
                window.location.href='../index.php?page=memberships';
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