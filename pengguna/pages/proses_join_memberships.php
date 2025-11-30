<?php
// Menghubungkan file dengan koneksi ke database
include '../../connection.php';

// Mengecek apakah request berasal dari form (method POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form dengan fungsi trim() agar tidak ada spasi di awal/akhir
    $id_user = trim($_POST['id_user']);
    $id_memberships = trim($_POST['id_memberships']);
    $total_harga = trim($_POST['harga_asli']);
    $payments = trim($_POST['payments']);



    // ==============================
    // VALIDASI INPUT
    // ==============================
    // Mengecek apakah semua field telah diisi. Jika ada yang kosong, tampilkan alert dan hentikan proses.
    if (empty($id_memberships) || empty($payments)) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
        exit;
    }

    $status = 'pending';

    // ==============================
    // PREPARED STATEMENT
    // ==============================
    // Membuat query SQL menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO transaksi (id_user, id_memberships, total_harga, payments, status) VALUES (?, ?, ?, ?, ?)");

    // Mengikat parameter ke dalam query (s = string)
    $stmt->bind_param("sssss", $id_user, $id_memberships, $total_harga, $payments, $status);

    // ==============================
    // EKSEKUSI QUERY
    // ==============================
    if ($stmt->execute()) {
        // Jika berhasil menambah user baru, tampilkan notifikasi dan arahkan ke halaman manajemen user
        echo "<script>
                alert('Kelas baru berhasil ditambahkan!');
                window.location.href='../index.php?page=join_memberships';
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