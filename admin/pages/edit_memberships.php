<?php
include '../connection.php'; // Menghubungkan file ini dengan database melalui file connection.php

// Mengecek apakah parameter ID dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak ada ID, tampilkan pesan error dan arahkan kembali ke halaman manajemen user
    echo "<script>alert('ID user tidak ditemukan!'); window.location.href='index.php?page=memberships';</script>";
    exit;
}

$id_memberships = intval($_GET['id']); // Mengubah ID menjadi integer untuk keamanan (hindari SQL Injection)

// Mengambil data memberships berdasarkan ID
$result = $conn->query("SELECT * FROM memberships WHERE id_memberships = $id_memberships");

// Jika data user tidak ditemukan
if ($result->num_rows == 0) {
    echo "<script>alert('User tidak ditemukan!'); window.location.href='index.php?page=memberships';</script>";
    exit;
}

$data = $result->fetch_assoc(); // Mengambil hasil query sebagai array asosiatif
?>

<!-- Bagian tampilan form edit user -->
<div class="col-12 col-md-8 offset-md-2 col-lg-10 offset-lg-1">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Memberships</h4>
        </div>
        <div class="card-content">
            <div class="card-body">

                <!-- Form Edit User -->
                <!-- Form ini akan dikirim ke file proses_edit_user.php untuk diproses -->
                <form class="form form-horizontal" action="pages/proses_edit_memberships.php" method="POST">

                    <!-- Hidden input untuk menyimpan ID user -->
                    <input type="hidden" name="id_memberships" value="<?= htmlspecialchars($data['id_memberships']); ?>">

                    <div class="form-body">
                        <div class="row align-items-center">

                            <!-- Input Nama Pengguna -->
                            <div class="col-md-3">
                                <label for="nama_paket" class="form-label">Nama Paket</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan nama pengguna dari database -->
                                        <input type="text" name="nama_paket" id="nama_paket" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['nama_paket']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Username -->
                            <div class="col-md-3">
                                <label for="durasi" class="form-label">Durasi</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan durasi yang sudah ada -->
                                        <input type="text" name="durasi" id="durasi" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['durasi']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Nomor Telpon -->
                            <div class="col-md-3">
                                <label for="harga" class="form-label">Harga</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan username yang sudah ada -->
                                        <input type="text" name="harga" id="harga" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['harga']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input deskripsi -->
                            <div class="col-md-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- deskripsi tidak diisi otomatis demi keamanan -->
                                        <input type="deskripsi" name="deskripsi" id="deskripsi" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['deskripsi']); ?>" required>
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
                                <a href="index.php?page=memberships" class="btn btn-light-secondary">Batal</a>
                            </div>

                        </div>
                    </div>
                </form>
                <!-- Akhir Form -->
            </div>
        </div>
    </div>
</div>