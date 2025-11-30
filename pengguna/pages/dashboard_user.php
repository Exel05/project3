<?php
include '../connection.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header('Location: ../login.php');
    exit;
}

$id_user = $_SESSION['id_user'];

/* ==========================
   AMBIL STATUS TRANSAKSI
========================== */
$query_status = "SELECT status FROM transaksi WHERE id_user = '$id_user' ORDER BY id_transaksi DESC LIMIT 1";
$result_status = mysqli_query($conn, $query_status);

$status = null;
if ($result_status && mysqli_num_rows($result_status) > 0) {
    $row = mysqli_fetch_assoc($result_status);
    $status = strtolower($row['status']);
}

/* ==========================
   AMBIL DATA MEMBERSHIPS
========================== */
$query_membership = "
    SELECT m.nama_paket, m.durasi 
    FROM memberships m
    JOIN transaksi t ON m.id_memberships = t.id_memberships
    WHERE t.id_user = '$id_user'
    ORDER BY t.id_transaksi DESC LIMIT 1
";
$result_membership = mysqli_query($conn, $query_membership);

$nama_paket = "-";
if ($result_membership && mysqli_num_rows($result_membership) > 0) {
    $row_m = mysqli_fetch_assoc($result_membership);
    $nama_paket = htmlspecialchars($row_m['nama_paket']) . ' / ' . htmlspecialchars($row_m['durasi']);
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
                    </span> 👋
                </h2>
                <p class="text-secondary mb-0">Selamat datang di halaman dashboardmu!</p>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png" alt="Illustration" class="illustration">
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row g-3 mb-4">
        <!-- Membership Status -->
        <div class="col-md-3 col-6">
            <div class="card stat-card text-center border-0 shadow-sm bg-warning-subtle">
                <div class="card-body">
                    <h3 class="fw-bold text-warning mb-2">Memberships</h3>
                    <p class="mb-0 text-secondary small mt-2">
                        <?php if (!$status): ?>
                            <span class="badge bg-secondary">Belum Memberships</span>
                        <?php elseif ($status == 'pending'): ?>
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        <?php elseif ($status == 'active'): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Nama Paket -->
        <div class="col-md-3 col-6">
            <div class="card stat-card text-center border-0 shadow-sm bg-primary-subtle">
                <div class="card-body">
                    <h3 class="fw-bold text-primary mb-1">Nama Paket</h3>
                    <span class="badge bg-warning text-dark"><?= $nama_paket; ?></span>
                </div>
            </div>
        </div>

        <!-- Example other cards -->
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

    <!-- Tabel Join Kelas -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Riwayat Kelas yang Diikuti</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Jadwal Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_kelas = "
                            SELECT dk.id_daftar, k.nama_kelas, k.jadwal
                            FROM daftar_kelas dk
                            JOIN kelas k ON dk.id_kelas = k.id_kelas
                            WHERE dk.id_user = '$id_user'
                            ORDER BY dk.id_daftar DESC
                        ";
                        $result_kelas = mysqli_query($conn, $query_kelas);

                        if ($result_kelas && mysqli_num_rows($result_kelas) > 0):
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result_kelas)): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama_kelas']); ?></td>
                                    <td><?= htmlspecialchars($row['jadwal']); ?></td>
                                    <td>
                                        <a href="pages/hapus_riwayat.php?id=<?= $row['id_daftar']; ?>" 
                                           class="btn btn-outline-danger btn-sm"
                                           onclick="return confirm('Yakin ingin menghapus data ini?');">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada data kelas yang diikuti
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
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
</style>
