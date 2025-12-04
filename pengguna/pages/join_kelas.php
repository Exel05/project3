<?php
include '../connection.php';
$query = "SELECT * FROM kelas ORDER BY id_kelas ASC";
$result = mysqli_query($conn, $query);
?>

<div class="page-heading mb-4">
  <h3>Daftar Kelas yang Tersedia</h3>
</div>

<div class="row g-4">
  <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="kelas-card p-4 h-100 rounded-4 d-flex flex-column align-items-center text-center shadow-sm">

          <!-- Icon -->
          <div class="icon-box mb-3">
            <i class="bi bi-activity icon-large"></i>
          </div>

          <!-- Nama Kelas -->
          <h5 class="fw-bold text-primary mb-1">
            <?= htmlspecialchars($row['nama_kelas']); ?>
          </h5>

          <!-- Instruktur -->
          <p class="text-secondary mb-2">
            <i class=" me-1"></i> <?= htmlspecialchars($row['instruktur']); ?>
          </p>

          <!-- Jadwal dan Waktu -->
          <p class="mb-1 text-light-mode">
            <i class="bi bi-calendar-event me-1"></i> <?= htmlspecialchars($row['jadwal']); ?>
          </p>
          <p class="mb-3 text-light-mode">
            <i class="bi bi-clock me-1"></i> <?= htmlspecialchars($row['waktu']); ?>
          </p>

          <!-- Kapasitas -->
          <p class="text-muted small mb-4">
            <i class="bi bi-people-fill me-1"></i> Kapasitas: <?= htmlspecialchars($row['kapasitas']); ?> orang
          </p>

          <!-- Tombol Join -->
          <a href="index.php?page=tambah_join_kelas&id_kelas=<?= $row['id_kelas']; ?>" 
             class="btn btn-primary w-100 fw-bold mt-auto">
             Join Kelas
          </a>

        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="col-12 text-center">
      <p class="text-muted">Belum ada data kelas yang tersedia.</p>
    </div>
  <?php endif; ?>
</div>

<style>
/* ===== Warna otomatis sesuai tema ===== */
:root[data-bs-theme="light"] .kelas-card {
  background-color: #f8f9fa;
  color: #212529;
  transition: 0.3s;
}

:root[data-bs-theme="dark"] .kelas-card {
  background-color: #1e1e2d;
  color: #f1f1f1;
  transition: 0.3s;
}

/* ===== Efek hover ===== */
.kelas-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
}

/* ===== Icon ===== */
.icon-box {
  width: 70px;
  height: 70px;
  border-radius: 20px;
  background-color: rgba(13, 110, 253, 0.15);
  color: #0d6efd;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-large {
  font-size: 32px;
}

/* ===== Tombol Join ===== */
.btn-primary {
  background-color: #0d6efd;
  border: none;
  transition: 0.3s;
}

.btn-primary:hover {
  background-color: #0b5ed7;
}

/* ===== Warna teks mengikuti tema ===== */
:root[data-bs-theme="light"] .text-light-mode {
  color: #212529 !important;
}

:root[data-bs-theme="dark"] .text-light-mode {
  color: #f8f9fa !important;
}
</style>
