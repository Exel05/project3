<?php
include '../connection.php'; // Menghubungkan file ini dengan database melalui file connection.php

// Mengecek apakah parameter ID dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak ada ID, tampilkan pesan error dan arahkan kembali ke halaman manajemen user
    echo "<script>alert('ID user tidak ditemukan!'); window.location.href='index.php?page=management_user';</script>";
    exit;
}

$id_user = intval($_GET['id']); // Mengubah ID menjadi integer untuk keamanan (hindari SQL Injection)

// Mengambil data user berdasarkan ID
$result = $conn->query("SELECT * FROM users WHERE id_user = $id_user");

// Jika data user tidak ditemukan
if ($result->num_rows == 0) {
    echo "<script>alert('User tidak ditemukan!'); window.location.href='index.php?page=management_user';</script>";
    exit;
}

$data = $result->fetch_assoc(); // Mengambil hasil query sebagai array asosiatif
?>

<!-- Bagian tampilan form edit user -->
<div class="col-12 col-md-8 offset-md-2 col-lg-10 offset-lg-1">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit User</h4>
        </div>
        <div class="card-content">
            <div class="card-body">

                <!-- Form Edit User -->
                <!-- Form ini akan dikirim ke file proses_edit_user.php untuk diproses -->
                <form class="form form-horizontal" action="pages/proses_edit_user.php" method="POST">

                    <!-- Hidden input untuk menyimpan ID user -->
                    <input type="hidden" name="id_user" value="<?= htmlspecialchars($data['id_user']); ?>">

                    <div class="form-body">
                        <div class="row align-items-center">

                            <!-- Input Nama Pengguna -->
                            <div class="col-md-3">
                                <label for="nama_lengkap" class="form-label">Nama Pengguna</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan nama pengguna dari database -->
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['nama_lengkap']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Username -->
                            <div class="col-md-3">
                                <label for="username" class="form-label">Username</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan username yang sudah ada -->
                                        <input type="text" name="username" id="username" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['username']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Email -->
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan username yang sudah ada -->
                                        <input type="text" name="email" id="email" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['email']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Nomor Telpon -->
                            <div class="col-md-3">
                                <label for="nomor_telpon" class="form-label">Nomor Telpon</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Menampilkan username yang sudah ada -->
                                        <input type="text" name="nomor_telpon" id="nomor_telpon" 
                                               class="form-control" 
                                               value="<?= htmlspecialchars($data['nomor_telpon']); ?>" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Password -->
                            <div class="col-md-3">
                                <label for="password" class="form-label">Password</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Password tidak diisi otomatis demi keamanan -->
                                        <input type="password" name="password" id="password" 
                                               class="form-control" 
                                               placeholder="Kosongkan jika tidak ingin mengubah password">
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pilihan Role User -->
                            <div class="col-md-3">
                                <label for="role" class="form-label">Role</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <fieldset class="form-group">
                                            <!-- Dropdown untuk memilih peran user -->
                                            <select class="form-select" name="role" id="role" required>
                                                <option value="">Pilih Role</option>
                                                <!-- Menandai role yang sesuai dari database -->
                                                <option value="admin" <?= ($data['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                <option value="pengguna" <?= ($data['role'] == 'pengguna') ? 'selected' : ''; ?>>Pengguna</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="col-12 d-flex justify-content-end">
                                <!-- Tombol untuk menyimpan perubahan -->
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <!-- Tombol untuk batal dan kembali ke halaman sebelumnya -->
                                <a href="index.php?page=management_user" class="btn btn-light-secondary">Batal</a>
                            </div>

                        </div>
                    </div>
                </form>
                <!-- Akhir Form -->
            </div>
        </div>
    </div>
</div>