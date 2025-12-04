<?php
include '../connection.php';

// Pastikan ada ID transaksi yang dikirim lewat URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID transaksi tidak ditemukan!'); window.location.href='index.php?page=transaksi';</script>";
    exit;
}

$id_transaksi = intval($_GET['id']);

// Ambil data transaksi berdasarkan ID
$query_transaksi = "
    SELECT t.*, u.username, m.nama_paket, m.harga
    FROM transaksi t
    JOIN users u ON t.id_user = u.id_user
    JOIN memberships m ON t.id_memberships = m.id_memberships
    WHERE t.id_transaksi = $id_transaksi
";

$result = mysqli_query($conn, $query_transaksi);

if (mysqli_num_rows($result) === 0) {
    echo "<script>alert('Transaksi tidak ditemukan!'); window.location.href='index.php?page=transaksi';</script>";
    exit;
}

$data = mysqli_fetch_assoc($result);

// Ambil data memberships
$memberships = mysqli_query($conn, "SELECT id_memberships, nama_paket, harga FROM memberships ORDER BY nama_paket ASC");
?>

<!-- ========================== -->
<!-- FORM EDIT TRANSAKSI -->
<!-- ========================== -->
<div class="col-12 col-md-8 offset-md-2 col-lg-10 offset-lg-1">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Transaksi</h4>
        </div>

        <div class="card-content">
            <div class="card-body">

                <form class="form form-horizontal" action="pages/proses_edit_transaksi.php" method="POST" id="formTransaksi">
                    <input type="hidden" name="id_transaksi" value="<?= htmlspecialchars($data['id_transaksi']); ?>">
                    <input type="hidden" name="id_user" value="<?= htmlspecialchars($data['id_user']); ?>">

                    <div class="form-body">
                        <div class="row align-items-center">

                            <!-- ============================= -->
                            <!-- Nama Pengguna (readonly) -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label class="form-label">Nama Pengguna</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <input type="text" class="form-control bg-light" 
                                       value="<?= htmlspecialchars($data['username']); ?>" readonly>
                            </div>

                            <!-- ============================= -->
                            <!-- Dropdown Membership -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="id_memberships" class="form-label">Membership</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" name="id_memberships" id="id_memberships" required>
                                        <option value="">Pilih Paket Membership</option>
                                        <?php while ($m = mysqli_fetch_assoc($memberships)): ?>
                                            <option 
                                                value="<?= $m['id_memberships']; ?>" 
                                                data-harga="<?= $m['harga']; ?>"
                                                <?= ($m['id_memberships'] == $data['id_memberships']) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($m['nama_paket']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </fieldset>
                            </div>

                            <!-- ============================= -->
                            <!-- Total Harga Otomatis -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="total_harga" class="form-label">Total Harga</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" name="total_harga" id="total_harga" 
                                               class="form-control" required
                                               value="<?= number_format($data['total_harga'], 0, ',', '.'); ?>">
                                        <div class="form-control-icon">
                                            <i class="bi bi-cash"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================= -->
                            <!-- Dropdown Payment -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="payments" class="form-label">Payments</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" name="payments" id="payments" required>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <?php 
                                        $opsi = ['Gopay','Dana','OVO','ShopeePay'];
                                        foreach ($opsi as $p): ?>
                                            <option value="<?= $p; ?>" <?= ($p == $data['payments']) ? 'selected' : ''; ?>>
                                                <?= $p; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </fieldset>
                            </div>

                            <!-- ============================= -->
                            <!-- Tombol Simpan / Batal -->
                            <!-- ============================= -->
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="index.php?page=transaksi" class="btn btn-light-secondary">Batal</a>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- ============================= -->
<!-- SCRIPT JS UNTUK OTOMATIS HARGA -->
<!-- ============================= -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectMembership = document.getElementById('id_memberships');
    const totalHargaInput = document.getElementById('total_harga');
    const form = document.getElementById('formTransaksi');

    // Ubah tampilan harga saat memilih membership
    selectMembership.addEventListener('change', function() {
        const selectedOption = selectMembership.options[selectMembership.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');

        if (harga) {
            totalHargaInput.value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(harga);
        } else {
            totalHargaInput.value = '';
        }
    });

    // Bersihkan format harga sebelum disubmit
    form.addEventListener('submit', function() {
        let rawValue = totalHargaInput.value;
        rawValue = rawValue.split(',')[0]; // hapus bagian koma
        rawValue = rawValue.replace(/[^\d]/g, ''); // ambil angka saja
        totalHargaInput.value = rawValue;
    });
});
</script>
