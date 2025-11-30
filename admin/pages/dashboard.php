<?php
// Menghubungkan ke database
include '../connection.php';

// ------------------------------------------------------
// Hitung jumlah user dengan role "pengguna"
// ------------------------------------------------------
$result_count = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'pengguna'");

// ------------------------------------------------------
// Ambil data transaksi + user + memberships
// ------------------------------------------------------
$query = "
    SELECT 
        transaksi.*, 
        users.username, 
        memberships.nama_paket
    FROM transaksi
    JOIN users ON transaksi.id_user = users.id_user
    JOIN memberships ON transaksi.id_memberships = memberships.id_memberships
    ORDER BY transaksi.id_transaksi DESC
";

$result = mysqli_query($conn, $query);

// ------------------------------------------------------
// Ambil total pengguna
// ------------------------------------------------------
$total_users = 0;
if ($result_count && $row = $result_count->fetch_assoc()) {
    $total_users = $row['total'];
}
?>


<div class="page-heading mb-4">
    <h3>Dashboard</h3>
</div>

<div class="dashboard-container">
    <!-- Header Section -->
    <div class="dashboard-header card shadow-sm border-0 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2>
                    Selamat Datang, 
                    <span style="color: #28a745; font-weight: bold;">
                        <?= htmlspecialchars($_SESSION['username']); ?>
                </span>👋
                </h2>
                <p class="text-secondary mb-0">Ready to start your day with some Exercise?</p>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Illustration" class="illustration">
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card stat-card text-center border-0 shadow-sm bg-warning-subtle">
                <div class="card-body">
                    <h3 class="fw-bold text-warning mb-1"><?= number_format($total_users, 0, ',', '.'); ?></h3>
                    <h2 class="mb-0 text-secondary small">Total Pengguna Sistem</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card stat-card text-center border-0 shadow-sm bg-primary-subtle">
                <div class="card-body">
                    <h3 class="fw-bold text-primary mb-1">77%</h3>
                    <p class="mb-0 text-secondary small">Complete</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card stat-card text-center border-0 shadow-sm bg-pink-subtle">
                <div class="card-body">
                    <h3 class="fw-bold text-pink mb-1">91</h3>
                    <p class="mb-0 text-secondary small">Unique Views</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card stat-card text-center border-0 shadow-sm bg-purple-subtle">
                <div class="card-body">
                    <h3 class="fw-bold text-purple mb-1">126</h3>
                    <p class="mb-0 text-secondary small">Total Views</p>
                </div>
            </div>
        </div>
    </div>

    <div class="page-heading mb-4">
        <h3>Memberships Payments Verifications</h3>
    </div>

    <!-- Project Cards -->
    <div class="card">
    <!-- Header card berisi judul dan tombol tambah user -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Daftar List Memberships</h5>

        <!-- Tombol Tambah User => mengarahkan ke halaman tambah_user.php -->
        <a href="index.php?page=tambah_transaksi" class="btn btn-primary btn-s">
            <i class="bi bi-plus-circle"></i> Tambah Transaksi
        </a>
    </div>

    <div class="card-body">
        <!-- Tabel daftar user dengan border, striping, dan teks rata tengah -->
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Memberships</th>
                    <th>Total Harga</th>
                    <th>Payments</th>
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
                            <td><?= htmlspecialchars($row['username']); ?></td>

                            <!-- Menampilkan username -->
                            <td><?= htmlspecialchars($row['nama_paket']); ?></td>

                            <td><?= htmlspecialchars($row['total_harga']); ?></td>

                            <td><?= htmlspecialchars($row['payments']); ?></td>

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
                                    <a href="pages/proses_verifikasi_memberships.php?id=<?= $row['id_transaksi']; ?>&status=active"
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('Setujui Pembayaran ini?')">
                                       Verifikasi
                                    </a>
                                    <!-- Tombol untuk menolak akun -->
                                    <a href="pages/proses_verifikasi_memberships.php?id=<?= $row['id_transaksi']; ?>&status=rejected"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Tolak Pembayaran ini?')">
                                       Tolak
                                    </a>

                                <?php 
                                // Jika status user sudah aktif atau ditolak => tampilkan tombol edit & hapus
                                else: ?>
                                    <!-- Tombol edit data user -->
                                    <a href="index.php?page=edit_transaksi&id=<?= $row['id_transaksi']; ?>" 
                                       class="btn btn-warning btn-sm">
                                       Edit
                                    </a>

                                    <!-- Tombol hapus user -->
                                    <a href="pages/hapus_transaksi.php?id=<?= $row['id_transaksi']; ?>" 
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
</div>


<style>

    .dashboard-container {
    padding: 10px 15px;
}

.dashboard-header {
    background-color: #f9f7ff;
    border-radius: 15px;
}

.dashboard-header .illustration {
    width: 160px;
    max-width: 100%;
}

.stat-card {
    border-radius: 15px;
}

.bg-warning-subtle { background-color: #fff3cd !important; }
.bg-primary-subtle { background-color: #e7f1ff !important; }
.bg-pink-subtle { background-color: #ffe3ed !important; }
.bg-purple-subtle { background-color: #ede3ff !important; }

.text-pink { color: #e83e8c !important; }
.text-purple { color: #6f42c1 !important; }

.project-thumb {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    background-color: #f5f5f5;
    object-fit: cover;
}


</style>