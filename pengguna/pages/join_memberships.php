<?php
include '../connection.php';
$query = "SELECT * FROM memberships ORDER BY id_memberships ASC";
$result = mysqli_query($conn, $query);
?>

<div class="page-heading mb-4">
  <h3>Daftar Paket Membership</h3>
</div>

<div class="row g-4">
  <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="membership-card p-4 h-100 rounded-4 d-flex flex-column align-items-center text-center shadow-sm">

          <div class="icon-box mb-3">
            <i class="bi bi-gem align-item-center icon-large"></i>
          </div>

          <h5 class="fw-bold text-success mb-1">
            <?= htmlspecialchars($row['nama_paket']); ?>
          </h5>

          <h4 class="fw-bold text-light-mode mb-3">
            Rp<?= number_format($row['harga'], 0, ',', '.'); ?>
            <small class="text-secondary fs-6">/ <?= htmlspecialchars($row['durasi']); ?></small>
          </h4>

          <ul class="list-unstyled text-start small mb-4">
            <li><i class="bi bi-check-circle text-success me-2"></i> Fitness Training</li>
            <li><i class="bi bi-check-circle text-success me-2"></i> Classes Group</li>
            <li><i class="bi bi-check-circle text-success me-2"></i> Personal Training</li>
            <li><i class="bi bi-check-circle text-success me-2"></i> Team Workout</li>
            <li><i class="bi bi-check-circle text-success me-2"></i> Access All Classes</li>
          </ul>

          <a href="index.php?page=tambah_join_memberships&id_memberships=<?= $row['id_memberships']; ?>" 
            class="btn btn-success w-100 fw-bold mt-auto">
            Pilih Paket
            </a>


        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="col-12 text-center">
      <p class="text-muted">Belum ada data membership.</p>
    </div>
  <?php endif; ?>
</div>

<style>
/* Warna otomatis menyesuaikan tema */
:root[data-bs-theme="light"] .membership-card {
  background-color: #f8f9fa;
  color: #212529;
  transition: 0.3s;
}

:root[data-bs-theme="dark"] .membership-card {
  background-color: #1e1e2d;
  color: #f1f1f1;
  transition: 0.3s;
}

.membership-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
}

.icon-box {
  width: 70px;
  height: 70px;
  border-radius: 20px;
  background-color: rgba(40, 167, 69, 0.15);
  color: #28a745;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-success {
  background-color: #28a745;
  border: none;
}

.btn-success:hover {
  background-color: #1e7e34;
}

/* Warna teks mengikuti tema */
:root[data-bs-theme="light"] .text-light-mode {
  color: #212529 !important;
}

:root[data-bs-theme="dark"] .text-light-mode {
  color: #f8f9fa !important;
}

.icon-large {
    font-size : 32px;
    margin-bottom : 30px;
    margin-right : 14px;
       /* Sesuaikan ukuran sesuai kebutuhan */
    }
</style>
