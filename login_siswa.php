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
session_start();
include'koneksi.php';

if(isset($_POST['login'])){
  $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
  $kode_kelas = mysqli_real_escape_string($koneksi, $_POST['kode_kelas']);
  
  $cek = mysqli_query($koneksi,"SELECT * FROM join_kelas WHERE nis='$nis' AND kode_kelas='$kode_kelas'");
  $tampil = mysqli_fetch_array($cek);
  $nis = $tampil['nis'];
  $kode_kelas = $tampil['kode_kelas'];
  if ( mysqli_num_rows($cek) === 1) {
    $_SESSION["login"] = true;
    $_SESSION['nis'] = $nis;
    $_SESSION['kode_kelas'] = $kode_kelas;
    header('location:sistem/siswa/beranda.php');
  }else{
    echo "<script>window.alert('Siswa Tidak terdaftar pada kelas')
    window.location='login_siswa.php'</script>";
  }
}
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
      <a class="navbar-brand" href="dashboard.html">
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
            <a href="login.php" class="nav-link">
              <span style="text-shadow: 1px 1px 1px black;" class="nav-link-inner--text">Login</span>
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
          <h1 style="text-shadow: 1px 1px 1px black;" class="text-white">Welcome!</h1>
          <p style="text-shadow: 1px 1px 1px black;" class="text-lead text-white">Aplikasi Ujian Online SMK KAPIN</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container mt--9 pb-1">
  <!-- Table -->
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-8">
      <div class="card bg-secondary border-0">
        <div class="card-body px-lg-5 py-lg-5">
          <div class="text-muted text-center mt-2 mb-4"><small>Login Siswa</small></div>
          <form action="" method="post">
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input class="form-control" name="nis" placeholder="NIS" type="text" required="required">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-merge input-group-alternative mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-key"></i></span>
                </div>
                <input class="form-control" name="kode_kelas" placeholder="Kode kelas" type="text" required="required">
              </div>
            </div>
            <div class="text-center">
              <input type="submit" name="login" class="btn btn-primary" value="Join">
              <input type="reset" class="btn btn-danger" value="Reset">
            </div><br>
            <div class="form-group">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Footer -->

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