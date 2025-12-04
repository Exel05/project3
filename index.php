<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gymate | Fitness Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- ======================= NAVBAR ======================= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase" href="#">Gymate</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav me-3">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Classes</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Schedule</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
            <a href="login.php" class="btn btn-danger px-4">Join Class Now</a>
        </div>
    </div>
</nav>

<!-- ======================= HERO SECTION ======================= -->
<section class="hero d-flex align-items-center text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h5 class="text-uppercase text-danger fw-bold">Find Your Energy</h5>
                <h1 class="display-4 fw-bold mb-3">Make Your Body<br>Healthy & Fit</h1>
                <p class="lead">Gymate helps you achieve your dream body with professional trainers and modern facilities.</p>
                <a href="login.php" class="btn btn-danger btn-lg mt-3">Our Classes</a>
            </div>
        </div>
    </div>
</section>

<!-- ======================= ABOUT SECTION ======================= -->
<section class="about py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center">
                <img src="https://media.istockphoto.com/id/518656817/photo/healthy-man-running-on-treadmill.jpg?s=612x612&w=0&k=20&c=HxCwme0F168YU2BjWvE7Xd3agxIZ8N2HZDQdjE6YDdc=" class="img-fluid rounded shadow" alt="Running woman">
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <h6 class="text-danger fw-bold">About Gymate</h6>
                <h2 class="fw-bold mb-3">We Can Give a Shape of Your Body Here!</h2>
                <p class="text-muted">We provide professional training programs that help you get fit, stay healthy, and achieve your goals faster.</p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-2"><i class="bi bi-check2-circle text-danger me-2"></i> Modern Equipment</li>
                    <li><i class="bi bi-check2-circle text-danger me-2"></i> Body Fitness & Strength Training</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ======================= CLASSES SECTION ======================= -->
<section class="classes py-5 bg-light">
    <div class="container text-center">
        <h6 class="text-danger fw-bold text-uppercase">Upcoming Classes</h6>
        <h2 class="fw-bold mb-5">We Offer Body Changes Classes</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="class-card shadow-sm rounded overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1558611848-73f7eb4001a1?auto=format&fit=crop&w=800&q=80" class="img-fluid" alt="Crossfit">
                    <div class="p-3">
                        <h5 class="fw-bold">Crossfit</h5>
                        <p class="text-muted small mb-2">Fri: 09:00am - 10:00am</p>
                        <a href="#" class="btn btn-outline-danger btn-sm">Join Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="class-card shadow-sm rounded overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?auto=format&fit=crop&w=800&q=80" class="img-fluid" alt="Karate">
                    <div class="p-3">
                        <h5 class="fw-bold">Karate</h5>
                        <p class="text-muted small mb-2">Fri: 10:00am - 11:00am</p>
                        <a href="#" class="btn btn-outline-danger btn-sm">Join Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="class-card shadow-sm rounded overflow-hidden">
                    <img src="https://media.istockphoto.com/id/1483989816/photo/adult-arab-male-with-a-ponytail-meditating-in-a-yoga-class.jpg?s=612x612&w=0&k=20&c=FTkO8dit_ZWB_9mUk2bmkELm2mpC-NqH82nCmK1Wx6M=" class="img-fluid" alt="Meditation">
                    <div class="p-3">
                        <h5 class="fw-bold">Meditation</h5>
                        <p class="text-muted small mb-2">Fri: 11:00am - 12:00pm</p>
                        <a href="#" class="btn btn-outline-danger btn-sm">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ======================= FOOTER ======================= -->
<footer>
  <div class="footer-container">
    <h3>Contact Us</h3>
    <p>Have questions or need help? Feel free to reach us!</p>

    <div class="contact-info">
      <p><i class="fa fa-phone"></i> +62 812-3456-7890</p>
      <p><i class="fa fa-envelope"></i> info@gymmemberships.com</p>
      <p><i class="fa fa-map-marker"></i> Jl. Kebugaran No.10, Bandar Lampung</p>
    </div>

    <div class="social-icons">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-instagram"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
    </div>

    <p class="copyright">© 2025 Gym Memberships. All rights reserved.</p>
  </div>
</footer>

<!-- Tambahkan link font awesome untuk ikon -->
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
/>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>

    /* Global */
body {
    font-family: 'Poppins', sans-serif;
    color: #333;
}

/* ======================= HERO SECTION ======================= */
.hero {
    height: 100vh;
    background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.3)),
                url('https://ironbullstrength.com/cdn/shop/articles/forearm_workouts_with_dumbbells.webp?v=1699475567') center/cover no-repeat;
    position: relative;
}

.hero h1 {
    font-size: 3.5rem;
    line-height: 1.2;
}

.hero .btn-danger {
    background-color: #d52b1e;
    border: none;
}

/* ======================= ABOUT SECTION ======================= */
.about h2 {
    color: #111;
}

/* ======================= CLASS SECTION ======================= */
.class-card img {
    transition: transform 0.3s ease;
}

.class-card:hover img {
    transform: scale(1.05);
}

.class-card .btn-outline-danger {
    border-color: #d52b1e;
    color: #d52b1e;
}

.class-card .btn-outline-danger:hover {
    background-color: #d52b1e;
    color: white;
}

/* ======================= FOOTER ======================= */
footer {
  background: linear-gradient(135deg, #111, #222);
  color: #f1f1f1;
  padding: 40px 0;
  text-align: center;
  font-family: 'Poppins', sans-serif;
}

.footer-container {
  width: 90%;
  max-width: 900px;
  margin: 0 auto;
}

.footer-container h3 {
  font-size: 24px;
  margin-bottom: 10px;
  color: #00d084;
}

.footer-container p {
  font-size: 14px;
  margin: 5px 0;
}

.contact-info {
  margin: 20px 0;
}

.contact-info p i {
  color: #00d084;
  margin-right: 8px;
}

.social-icons {
  margin: 15px 0;
}

.social-icons a {
  color: #f1f1f1;
  margin: 0 10px;
  font-size: 20px;
  transition: 0.3s;
}

.social-icons a:hover {
  color: #00d084;
  transform: scale(1.1);
}

footer .copyright {
  font-size: 12px;
  margin-top: 20px;
  color: #aaa;
}



</style>
