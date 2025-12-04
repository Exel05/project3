<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Registrasi Akun</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">

          <!-- Gambar sisi kiri -->
          <div class="col-md-5 d-none d-md-block">
            <img src="https://media.istockphoto.com/id/1448303096/photo/gym-equipment-and-weights-of-fitness-background-for-exercise-training-or-heavy-workout-for.jpg?s=612x612&w=0&k=20&c=IUnGrKeIoHpDCMhA6MVxxJANZuKcrCIvAw5Mp5sONmo=" 
                 alt="register" class="login-card-img">
          </div>

          <!-- Form sisi kanan -->
          <div class="col-md-7">
            <div class="card-body">
              <p class="login-card-description text-center">Buat Akun Baru</p>

              <!-- Notifikasi -->
              <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger py-2">
                  <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
              <?php endif; ?>

              <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success py-2">
                  <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
              <?php endif; ?>

              <form action="proses_register.php" method="POST">
                <div class="form-group">
                  <label for="nama_lengkap">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="nomor_telpon">No Handphone</label>
                  <input type="text" name="nomor_telpon" id="nomor_telpon" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <p class=" mt-3 mb-0">Sudah punya akun? 
                  <a href="login.php">Login</a>
                </p>

                <button type="submit" name="register" class="btn btn-primary w-100 mt-4">Daftar</button>

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

    .btn-warning {
      font-weight: 600;
      border-radius: 8px;
      padding: 0.6rem;
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
