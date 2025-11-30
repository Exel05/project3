<?php
// Menghubungkan file ini dengan file koneksi database
include '../connection.php';

// Menjalankan query SQL untuk mengambil semua data dari tabel 'users'
// Data diurutkan berdasarkan kolom 'id_user' secara menurun (DESC)
$query = "SELECT * FROM memberships ORDER BY id_memberships DESC";

// Menyimpan hasil query ke variabel $result
$result = mysqli_query($conn, $query);
?>

<!-- Bagian judul halaman -->
<div class="page-heading mb-4">
    <h3>Memberships</h3>
</div>

<div class="card">
    <!-- Header card berisi judul dan tombol tambah user -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Kategori Memberships</h5>

        <!-- Tombol Tambah User => mengarahkan ke halaman tambah_user.php -->
        <a href="index.php?page=tambah_memberships" class="btn btn-primary btn-s">
            <i class="bi bi-plus-circle"></i> Tambah Memberships
        </a>
    </div>

    <div class="card-body">
        <!-- Tabel daftar user dengan border, striping, dan teks rata tengah -->
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Durasi</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
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
                            <td><?= htmlspecialchars($row['nama_paket']); ?></td>

                            <!-- Menampilkan username -->
                            <td><?= htmlspecialchars($row['durasi']); ?></td>

                            <td><?= htmlspecialchars($row['harga']); ?></td>
                            
                            <td><?= htmlspecialchars($row['deskripsi']); ?></td>


                            <!-- AKSI (Tombol yang bisa dilakukan admin) -->
                            <td>
                                    <!-- Tombol edit data user -->
                                    <a href="index.php?page=edit_memberships&id=<?= $row['id_memberships']; ?>" 
                                       class="btn btn-warning btn-sm">
                                       Edit
                                    </a>

                                    <!-- Tombol hapus user -->
                                    <a href="pages/hapus_memberships.php?id=<?= $row['id_memberships']; ?>" 
                                       class="btn btn-outline-danger btn-sm" 
                                       onclick="return confirm('Yakin ingin menghapus user ini?')">
                                       Hapus
                                    </a>
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