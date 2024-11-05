<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php 
include'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Aplikasi Ujian Online</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/brand/YPTKAPIN.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <style type="text/css">
    body,html{
      background-image: url('assets/img/bg20.jpg');
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="assets/img/brand/aplikasi-ujian.png">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="dashboard.html">
                <img src="assets/img/brand/aplikasi-ujian.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="login_admin.php" class="nav-link">
              <span style="text-shadow: 1px 1px 1px black;" class="nav-link-inner--text">Login Admin</span>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none" />
        <?php 
        $data = mysqli_query($koneksi,"SELECT * FROM medsos");
        while ($tampil = mysqli_fetch_array($data)) {
         ?>
         <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="<?= $tampil['fb']; ?>" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
              <i class="fab fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="<?= $tampil['ig']; ?>" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
              <i class="fab fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">Instagram</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="<?= $tampil['twitter']; ?>" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Twitter">
              <i class="fab fa-twitter-square"></i>
              <span class="nav-link-inner--text d-lg-none">Twitter</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="<?= $tampil['yt']; ?>" target="_blank" data-toggle="tooltip" data-original-title="Youtube">
              <i class="fab fa-youtube"></i>
              <span class="nav-link-inner--text d-lg-none">Youtube</span>
            </a>
          </li>
        </ul>
      <?php } ?>
    </div>
  </div>
</nav>
<!-- Main content -->
<div class="main-content">
  <!-- Header -->
  <div class="header py-7 py-lg-8 pt-lg-9">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 style="text-shadow: 1px 1px 1px black;" class="text-white">Selamat Datang!</h1>
            <p style="text-shadow: 1px 1px 1px black;" class="text-lead text-white">Aplikasi Ujian Online SMK KAPIN</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container mt--9 pb-1">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent pb-5">
            <div class="text-muted text-center mt-2 mb-3"><small>LOGIN</small></div>
            <div class="btn-wrapper text-center">
              <a href="login_guru.php" style="height: 50px; font-size: 14pt;" class="btn btn-primary">
                Guru
              </a>
              <a href="login_siswa.php" style="height: 50px; font-size: 14pt;" class="btn btn-primary">
                Murid
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<br><br>
<!-- Footer -->
<footer class="py-5" id="footer-main">
  <div class="container">
    <div class="row align-items-center justify-content-xl-between">
      <div class="col-xl-6">
        <div class="copyright text-center text-xl-left text-muted">
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Argon Scripts -->
<!-- Core -->
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/js-cookie/js.cookie.js"></script>
<script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="assets/js/argon.js?v=1.2.0"></script>
</body>

</html>