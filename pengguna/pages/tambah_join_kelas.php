<?php
include '../connection.php';

// Ambil id_kelas dari URL (saat klik card)
$id_kelas = isset($_GET['id_kelas']) ? intval($_GET['id_kelas']) : null;

$nama_kelas = '';

if ($id_kelas) {
    // Ambil data kelas dari database
    $query = "SELECT nama_kelas FROM kelas WHERE id_kelas = $id_kelas";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nama_kelas = $row['nama_kelas'];
    }
}
?>

<div class="col-12 col-md-8 offset-md-2 col-lg-10 offset-lg-1">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Join Kelas</h4>
        </div>

        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="pages/proses_join_kelas.php" method="POST">
                    <div class="form-body">
                        <div class="row align-items-center">

                            <!-- Username -->
                            <div class="col-md-3">
                                <label for="id_user" class="form-label">Username</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="username" class="form-control"
                                            value="<?= htmlspecialchars($_SESSION['username']); ?>" readonly>

                                        <input type="hidden" name="id_user"
                                            value="<?= htmlspecialchars($_SESSION['id_user']); ?>">

                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Nama Kelas -->
                            <div class="col-md-3">
                                <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="nama_kelas" name="nama_kelas"
                                            class="form-control" value="<?= htmlspecialchars($nama_kelas); ?>" readonly>

                                        <input type="hidden" name="id_kelas" value="<?= $id_kelas; ?>">

                                        <div class="form-control-icon">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="index.php?page=join_kelas" class="btn btn-danger ms-2">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
