<?php
session_start();

// ----------------------------------------------------
// Mencegah caching halaman login oleh browser
// ----------------------------------------------------
// Baris ini memastikan halaman login tidak disimpan di cache browser.
// Tujuannya agar pengguna tidak bisa kembali ke halaman login setelah logout 
// dengan menekan tombol "Back" di browser.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Jika sudah login, arahkan ke dashboard sesuai role
if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
  if ($_SESSION['role'] == 'admin') {
    header("Location: admin/index.php");
    exit();
  } elseif ($_SESSION['role'] == 'pengguna') {
    header("Location: pengguna/index.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login Akun</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">

          <!-- Gambar sisi kiri -->
          <div class="col-md-5 d-none d-md-block">
            <img src="assets/image/gambar-1.jpg" 
                 alt="login" class="login-card-img">
          </div>

          <!-- Form sisi kanan -->
          <div class="col-md-7">
            <div class="card-body">
              <p class="login-card-description text-center">Silakan Masuk</p>

              <!-- Notifikasi -->
              <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger py-2">
                  <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
              <?php endif; ?>

              <form action="proses_login.php" method="POST">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <p class="mt-3 mb-0">
                  Belum punya akun? <a href="register.php">Register</a>
                </p>

                <button type="submit" name="login" class="btn btn-primary w-100 mt-4">Login</button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>
</body>
</html>

<style>
  body {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url("assets/image/gambar-1.jpg") center/cover no-repeat;
  }

  .login-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    overflow: hidden;
  }

  .login-card-img {
    height: 100%;
    object-fit: cover;
    width : 95%;
  }

  .card-body {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    height: 100%;
  }

  .login-card-description {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
  }

  form .form-group {
    margin-bottom: 0.75rem;
  }

  form label {
    font-size: 0.9rem;
    margin-bottom: 0.3rem;
    color: #555;
  }

  @media (max-width: 767px) {
    .login-card {
      height: auto;
    }
    .login-card-img {
      height: 200px;
    }
    .card-body {
      padding: 1.5rem;
    }
  }
</style>
