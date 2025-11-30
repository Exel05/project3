<?php
// Menghubungkan file ini dengan file koneksi database
include '../connection.php';


// Menjalankan query SQL untuk mengambil semua data dari tabel 'users'
// Data diurutkan berdasarkan kolom 'id_user' secara menurun (DESC)
$query = "SELECT * FROM users ORDER BY id_user DESC";

// Menyimpan hasil query ke variabel $result
$result = mysqli_query($conn, $query);
?>

<!-- Bagian judul halaman -->
<div class="page-heading mb-4">
    <h3>Manajemen User</h3>
</div>

<div class="card">
    <!-- Header card berisi judul dan tombol daftar user -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Daftar User</h5>

        <!-- Tombol Tambah User => mengarahkan ke halaman tambah_user.php -->
        <a href="index.php?page=tambah_user" class="btn btn-primary btn-s">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>
    </div>

    <div class="card-body">
        <!-- Tabel daftar user dengan border, striping, dan teks rata tengah -->
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Mengecek apakah hasil query memiliki data
                if (mysqli_num_rows($result) > 0): 
                    // Inisialisasi nomor urut
                    $no = 1; 
                    // Perulangan untuk menampilkan setiap baris data user
                    while ($row = mysqli_fetch_assoc($result)): 
                ?>
                        <tr>
                            <!-- Menampilkan nomor urut -->
                            <td><?= $no++; ?></td>

                            <!-- Menampilkan nama pengguna dengan htmlspecialchars agar aman dari XSS -->
                            <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>

                            <!-- Menampilkan username -->
                            <td><?= htmlspecialchars($row['username']); ?></td>

                            <!-- Menampilkan role user -->
                            <td>
                                <?php 
                                // Mengecek apakah role user adalah admin atau pengguna
                                if ($row['role'] === 'admin'): ?>
                                    <span class="badge bg-primary">Admin</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Pengguna</span>
                                <?php endif; ?>
                            </td>

                            <!-- STATUS USER -->
                            <td>
                                <?php 
                                // Menampilkan status akun user dengan warna berbeda
                                if ($row['status'] == 'pending'): ?>
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                <?php elseif ($row['status'] == 'active'): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Ditolak</span>
                                <?php endif; ?>
                            </td>

                            <!-- AKSI (Tombol yang bisa dilakukan admin) -->
                            <td>
                                <?php 
                                // Jika status user masih pending → tampilkan tombol verifikasi & tolak
                                if ($row['status'] == 'pending'): ?>
                                    <!-- Tombol untuk menyetujui akun -->
                                    <a href="pages/proses_verifikasi.php?id=<?= $row['id_user']; ?>&status=active"
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('Setujui akun ini?')">
                                       Verifikasi
                                    </a>
                                    <!-- Tombol untuk menolak akun -->
                                    <a href="pages/proses_verifikasi.php?id=<?= $row['id_user']; ?>&status=rejected"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Tolak akun ini?')">
                                       Tolak
                                    </a>

                                <?php 
                                // Jika status user sudah aktif atau ditolak => tampilkan tombol edit & hapus
                                else: ?>
                                    <!-- Tombol edit data user -->
                                    <a href="index.php?page=edit_user&id=<?= $row['id_user']; ?>" 
                                       class="btn btn-warning btn-sm">
                                       Edit
                                    </a>

                                    <!-- Tombol hapus user -->
                                    <a href="pages/hapus_user.php?id=<?= $row['id_user']; ?>" 
                                       class="btn btn-outline-danger btn-sm" 
                                       onclick="return confirm('Yakin ingin menghapus user ini?')">
                                       Hapus
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <!-- Jika tidak ada data user -->
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data user.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>