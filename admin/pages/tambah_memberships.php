<?php
// Mengimpor (menyertakan) file koneksi ke database
// Agar halaman ini bisa terhubung dengan database MySQL
include '../connection.php';
?>

<!-- Bagian layout menggunakan Bootstrap grid system -->
<div class="col-12 col-md-8 offset-md-2 col-lg-10 offset-lg-1">
    <div class="card">
        <!-- Header dari card -->
        <div class="card-header">
            <h4 class="card-title">Tambah Membership Baru</h4>
        </div>

        <div class="card-content">
            <div class="card-body">
                <!-- Form untuk menambah user baru -->
                <!-- action = file tujuan untuk memproses data (proses_tambah_user.php) -->
                <!-- method POST = mengirim data secara tersembunyi (tidak tampil di URL) -->
                <form class="form form-horizontal" action="pages/proses_tambah_memberships.php" method="POST">
                    <div class="form-body">
                        <div class="row align-items-center">

                            <!-- ============================= -->
                            <!-- Input Nama Pengguna -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="nama_paket" class="form-label">Nama Paket</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input teks untuk nama pengguna -->
                                        <input type="text" name="nama_paket" id="nama_paket" 
                                               class="form-control" placeholder="Nama Paket" required>
                                        <!-- Ikon dekoratif di dalam input -->
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================= -->
                            <!-- Input Username -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="durasi" class="form-label">Durasi</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input teks untuk durasi -->
                                        <input type="text" name="durasi" id="durasi" 
                                               class="form-control" placeholder="Durasi" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================= -->
                            <!-- Input Password -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="harga" class="form-label">Harga</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input untuk harga -->
                                        <input type="text" name="harga" id="harga" 
                                               class="form-control" placeholder="Harga" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input untuk deskripsi -->
                                        <input type="text" name="deskripsi" id="deskripsi" 
                                               class="form-control" placeholder="Deskripsi" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================= -->
                            <!-- Tombol Aksi => Simpan & Reset -->
                            <!-- ============================= -->
                            <div class="col-12 d-flex justify-content-end">
                                <!-- Tombol Simpan untuk kirim data -->
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="index.php?page=memberships" class="btn btn-danger ms-2">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>

                        </div>
                    </div>
                </form> <!-- Akhir Form -->
            </div>
        </div>
    </div>
</div>