<?php
include '../connection.php';

// Ambil data user dengan role 'pengguna'
$query_users = "SELECT id_user, username FROM users WHERE role = 'pengguna' ORDER BY username ASC";
$result_users = mysqli_query($conn, $query_users);

// Ambil data memberships (paket + harga)
$query_memberships = "SELECT id_memberships, nama_paket, harga FROM memberships ORDER BY nama_paket ASC";
$result_memberships = mysqli_query($conn, $query_memberships);
?>

<div class="col-12 col-md-8 offset-md-2 col-lg-10 offset-lg-1">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tambah Transaksi Baru</h4>
        </div>

        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="pages/proses_tambah_transaksi.php" method="POST" id="formTransaksi">
                    <div class="form-body">
                        <div class="row align-items-center">

                            <!-- Dropdown Nama Pengguna -->
                            <div class="col-md-3">
                                <label for="id_user" class="form-label">Nama Pengguna</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" name="id_user" id="id_user" required>
                                        <option value="">Pilih Pengguna</option>
                                        <?php while ($row_user = mysqli_fetch_assoc($result_users)): ?>
                                            <option value="<?= $row_user['id_user']; ?>">
                                                <?= htmlspecialchars($row_user['username']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </fieldset>
                            </div>

                            <!-- Dropdown Membership -->
                            <div class="col-md-3">
                                <label for="id_memberships" class="form-label">Membership</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" name="id_memberships" id="id_memberships" required>
                                        <option value="">Pilih Paket Membership</option>
                                        <?php while ($row_paket = mysqli_fetch_assoc($result_memberships)): ?>
                                            <option value="<?= $row_paket['id_memberships']; ?>" data-harga="<?= $row_paket['harga']; ?>">
                                                <?= htmlspecialchars($row_paket['nama_paket']); ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </fieldset>
                            </div>

                            <!-- Input Total Harga (otomatis) -->
                            <div class="col-md-3">
                                <label for="total_harga" class="form-label">Total Harga</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <input type="text" name="total_harga" id="total_harga"
                                               class="form-control" placeholder="Total harga otomatis" readonly required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-cash"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dropdown Payments -->
                            <div class="col-md-3">
                                <label for="payments" class="form-label">Payments</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <fieldset class="form-group">
                                    <select class="form-select" name="payments" id="payments" required>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="Gopay">Gopay</option>
                                        <option value="Dana">Dana</option>
                                        <option value="OVO">OVO</option>
                                        <option value="ShopeePay">ShopeePay</option>
                                    </select>
                                </fieldset>
                            </div>

                            <!-- Tombol Simpan & Reset -->
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="index.php?page=dashboard" class="btn btn-danger ms-2">
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

<!-- Script Harga Otomatis -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectMembership = document.getElementById('id_memberships');
    const totalHargaInput = document.getElementById('total_harga');
    const form = document.getElementById('formTransaksi');

    // Saat user memilih paket membership
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

    // Sebelum form dikirim, ubah format ke angka murni
    form.addEventListener('submit', function() {
        let rawValue = totalHargaInput.value;

        // Ambil hanya angka sebelum koma (jika ada)
        rawValue = rawValue.split(',')[0]; // pisahkan bagian belakang koma
        rawValue = rawValue.replace(/[^\d]/g, ''); // hapus semua karakter non-digit

        totalHargaInput.value = rawValue;
    });
});
</script>

