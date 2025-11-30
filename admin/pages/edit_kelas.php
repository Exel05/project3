<?php
include '../connection.php'; // Menghubungkan file ini dengan database melalui file connection.php

// Mengecek apakah parameter ID dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak ada ID, tampilkan pesan error dan arahkan kembali ke halaman manajemen user
    echo "<script>alert('ID user tidak ditemukan!'); window.location.href='index.php?page=class';</script>";
    exit;
}

$id_kelas = intval($_GET['id']); // Mengubah ID menjadi integer untuk keamanan (hindari SQL Injection)

// Mengambil data kelas berdasarkan ID
$result = $conn->query("SELECT * FROM kelas WHERE id_kelas = $id_kelas");

// Jika data kelas tidak ditemukan
if ($result->num_rows == 0) {
    echo "<script>alert('kelas tidak ditemukan!'); window.location.href='index.php?page=class';</script>";
    exit;
}

$data = $result->fetch_assoc(); // Mengambil hasil query sebagai array asosiatif
?>

<!-- Bagian tampilan form edit user -->
<div class="col-12 col-md-8 offset-md-2 col-lg-10 offset-lg-1">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Kelas</h4>
        </div>
        <div class="card-content">
            <div class="card-body">

                <!-- Form Edit User -->
                <!-- Form ini akan dikirim ke file proses_edit_user.php untuk diproses -->
                <form class="form form-horizontal" action="pages/proses_edit_kelas.php" method="POST">

                    <!-- Hidden input untuk menyimpan ID user -->
                    <input type="hidden" name="id_kelas" value="<?= htmlspecialchars($data['id_kelas']); ?>">

                    <div class="form-body">
                        <div class="row align-items-center">

                            <!-- Input Nama Pengguna -->
                            <div class="col-md-3">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan nama pengguna dari database -->
                                        <input type="text" name="nama_kelas" id="nama_kelas" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['nama_kelas']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Username -->
                            <div class="col-md-3">
                                <label for="instruktur" class="form-label">Instruktur</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan instruktur yang sudah ada -->
                                        <input type="text" name="instruktur" id="instruktur" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['instruktur']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input jadwal -->
                            <div class="col-md-3">
                                <label for="jadwal" class="form-label">Jadwal</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan instruktur yang sudah ada -->
                                        <input type="text" name="jadwal" id="jadwal" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['jadwal']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Nomor Telpon -->
                            <div class="col-md-3">
                                <label for="waktu" class="form-label">Waktu</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan username yang sudah ada -->
                                        <input type="text" name="waktu" id="waktu" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['waktu']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input kapasitas -->
                            <div class="col-md-3">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- kapasitas tidak diisi otomatis demi keamanan -->
                                        <input type="kapasitas" name="kapasitas" id="kapasitas" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['kapasitas']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="col-12 d-flex justify-content-end">
                                <!-- Tombol untuk menyimpan perubahan -->
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <!-- Tombol untuk batal dan kembali ke halaman sebelumnya -->
                                <a href="index.php?page=class" class="btn btn-light-secondary">Batal</a>
                            </div>

                        </div>
                    </div>
                </form>
                <!-- Akhir Form -->
            </div>
        </div>
    </div>
</div>