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
            <h4 class="card-title">Tambah User Baru</h4>
        </div>

        <div class="card-content">
            <div class="card-body">
                <!-- Form untuk menambah user baru -->
                <!-- action = file tujuan untuk memproses data (proses_tambah_user.php) -->
                <!-- method POST = mengirim data secara tersembunyi (tidak tampil di URL) -->
                <form class="form form-horizontal" action="pages/proses_tambah_user.php" method="POST">
                    <div class="form-body">
                        <div class="row align-items-center">

                            <!-- ============================= -->
                            <!-- Input Nama Pengguna -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input teks untuk nama pengguna -->
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" 
                                               class="form-control" placeholder="Nama Lengkap" required>
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
                                <label for="username" class="form-label">Username</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input teks untuk username -->
                                        <input type="text" name="username" id="username" 
                                               class="form-control" placeholder="Username" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================= -->
                            <!-- Input Email -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="email" class="form-label">Email</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input teks untuk username -->
                                        <input type="text" name="email" id="email" 
                                               class="form-control" placeholder="Email" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================= -->
                            <!-- Input Nomor Telpon -->
                            <!-- ============================= -->

                            <div class="col-md-3">
                                <label for="nomor_telpon" class="form-label">Nomor Telpon</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input teks untuk username -->
                                        <input type="text" name="nomor_telpon" id="nomor_telpon" 
                                               class="form-control" placeholder="Nomor Telpon" required>
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
                                <label for="password" class="form-label">Password</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Input untuk password -->
                                        <input type="password" name="password" id="password" 
                                               class="form-control" placeholder="Password" required>
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================= -->
                            <!-- Pilihan Role (Admin / Pengguna) -->
                            <!-- ============================= -->
                            <div class="col-md-3">
                                <label for="role" class="form-label">Role</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group has-icon-left">
                                    <div class="position-relative">
                                        <!-- Dropdown (select box) untuk memilih peran user -->
                                        <fieldset class="form-group">
                                            <select class="form-select" name="role" id="role" required>
                                                <option value="">Pilih Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="pengguna">Pengguna</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <!-- ============================= -->
                            <!-- Tombol Aksi => Simpan & Reset -->
                            <!-- ============================= -->
                            <div class="col-12 d-flex justify-content-end">
                                <!-- Tombol Simpan untuk kirim data -->
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="index.php?page=management_user" class="btn btn-danger ms-2">
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