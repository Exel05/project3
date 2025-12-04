<?php
include '../connection.php';

// Ambil data paket dari URL (saat klik card)
$id_memberships = isset($_GET['id_memberships']) ? intval($_GET['id_memberships']) : null;

$nama_paket = '';
$harga = '';

if ($id_memberships) {
    $query = "SELECT nama_paket, harga FROM memberships WHERE id_memberships = $id_memberships";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nama_paket = $row['nama_paket'];
        $harga = $row['harga'];
    }
}
?>

<div class="col-12 col-md-8 offset-md-2 col-lg-10 offset-lg-1">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Join Memberships</h4>
        </div>

        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="pages/proses_join_memberships.php" method="POST">
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

                            <!-- Nama Paket -->
                            <div class="col-md-3">
                                <label for="nama_paket" class="form-label">Nama Paket</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="nama_paket" name="nama_paket"
                                            class="form-control" value="<?= htmlspecialchars($nama_paket); ?>" readonly>
                                        <input type="hidden" name="id_memberships" value="<?= $id_memberships; ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-box-seam"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Harga -->
                            <div class="col-md-3">
                                <label for="total_harga" class="form-label">Total Harga</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" id="total_harga" name="total_harga"
                                            class="form-control"
                                            value="<?= $harga ? 'Rp ' . number_format($harga, 0, ',', '.') : ''; ?>" readonly>
                                        <input type="hidden" name="harga" value="<?= $harga; ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-cash"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment -->
                            <div class="col-md-3">
                                <label for="payments" class="form-label">Payment</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <fieldset class="form-group">
                                            <select class="form-select" name="payments" id="payments" required>
                                                <option value="">Pilih Payment</option>
                                                <option value="Dana">Dana</option>
                                                <option value="Ovo">Ovo</option>
                                                <option value="ShopeePay">ShopeePay</option>
                                                <option value="Gopay">Gopay</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="index.php?page=join_memberships" class="btn btn-danger ms-2">
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
