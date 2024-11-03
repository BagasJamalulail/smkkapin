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

if ( !isset($_SESSION["nis"]) ) {
  header("location: ../../login.php");
  exit;
}
include'../../koneksi.php';

$nis = $_SESSION['nis'];
$zona_waktu_siswa=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'"));
$kode_kelas = $_SESSION['kode_kelas'];

if (isset($_POST['ubah_foto'])) {
  $ekstensi_diperbolehkan = array('png','jpg','JPG','PNG','jpeg','JPEG');
  $foto = $_FILES['foto']['name'];
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];  

  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    if($ukuran < 50044070){

      move_uploaded_file($file_tmp, '../../assets/img/profil_siswa/'.$foto);
            //query input data registrasi
      $query = mysqli_query($koneksi,"UPDATE siswa SET foto='$foto' WHERE nis='$nis'");
      echo "<script>window.alert('Foto Profil sukses diubah')
      window.location='beranda.php'</script>";
      exit;

    }else{
      echo "<script>window.alert('Ukuran file gambar terlalu besar')
      window.location='beranda.php'</script>";
      exit;
    }
  }else{
    echo "<script>window.alert('Ekstensi file tidak di perbolehkan')
    window.location='beranda.php'</script>";
    exit;
  }
}
if (isset($_POST['simpan_zona'])) {
  $zona_waktu=mysqli_real_escape_string($koneksi, $_POST['zona_waktu']);
  $update=mysqli_query($koneksi,"UPDATE siswa SET zona_waktu='$zona_waktu' WHERE nis='$nis'");
  echo "<script>window.alert('Zona waktu telah disimpan')
  window.location='beranda.php'</script>";
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
  <link rel="icon" href="../../assets/img/brand/YPTKAPIN.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../../assets/img/brand/aplikasi-ujian.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="beranda.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="daftar_siswa.php">
                <i class="ni ni-archive-2 text-primary"></i>
                <span class="nav-link-text">Daftar Siswa</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kelas.php">
                <i class="ni ni-paper-diploma text-info"></i>
                <span class="nav-link-text">Room Kelas</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../logout.php">
                <i class="ni ni-button-power text-dark"></i>
                <span class="nav-link-text">Log Out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">

                    <?php 
                    $profil=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'"));
                    $jk=$profil['jk'];
                    $foto=$profil['foto'];
                    if ($foto!=="") {
                      ?>
                      <img alt="Image placeholder" src="../../assets/img/profil_siswa/<?= $profil['foto']; ?>">
                    <?php }else{ ?>

                      <?php 
                      if ($jk=="L") {
                       ?>
                       <img alt="Image placeholder" src="user L.png">
                     <?php }elseif($jk=="P"){ ?>
                      <img alt="Image placeholder" src="user P.png">
                    <?php } ?>
                  <?php } ?>

                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">NIS : <?= $_SESSION['nis']; ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <a href="../../logout.php" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header -->
  <!-- Header -->
  <div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(../../assets/img/bg.jpg); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
      <div class="row">
        <div class="col-lg-7 col-md-10">
          <?php 
          $data = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
          while ($tampil = mysqli_fetch_array($data)) {
            ?>
            <h1 class="text-white">Hello <?= $tampil['nama_siswa']; ?></h1>
          <?php } ?>
          <p class="text-white mt-0 mb-5">Selamat datang di aplikasi ujian online, selalu semangat dalam belajar </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <center>
        <div class="col-lg-12">
          <div class="card card-profile">
            <img style="height: 150px;" src="../../assets/img/header.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                   <?php 
                   $profil=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'"));
                   $jk=$profil['jk'];
                   $foto=$profil['foto'];
                   if ($foto!=="") {
                    ?>
                    <img style="height: 120px; width: 120px;" class="rounded-circle" alt="Image placeholder" src="../../assets/img/profil_siswa/<?= $profil['foto']; ?>">
                  <?php }else{ ?>
                    <?php 
                    if ($jk=="L") {
                     ?>
                     <img class="rounded-circle" alt="Image placeholder" src="user L.png">
                   <?php }elseif($jk=="P"){ ?>
                    <img class="rounded-circle" alt="Image placeholder" src="user P.png">
                  <?php } ?>
                <?php } ?>
              </a>
            </div>
          </div>
        </div>
        <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          <div class="d-flex justify-content-between">
          </div>
        </div>
        <div class="card-body pt-0">

          <div class="text-center">
            <a href="" data-toggle="modal" data-target="#ubah_profil" class="btn btn-primary"><i class="fa fa-camera"></i> Ubah Foto</a>
            <form action="" method="post">
              <select class="form-control" name="zona_waktu" required="required">
                <option value="" <?php echo ($zona_waktu_siswa['zona_waktu']=='')?"selected":""; ?>>Pilih Zona Waktu Anda</option> 
                <option value="Asia/Jakarta" <?php echo ($zona_waktu_siswa['zona_waktu']=='Asia/Jakarta')?"selected":""; ?>>WIB (Waktu Indonesia Barat)</option>
                <option value="Asia/Makassar" <?php echo ($zona_waktu_siswa['zona_waktu']=='Asia/Makassar')?"selected":""; ?>>WITA (Waktu Indonesia Tengah)</option>
                <option value="Asia/Jayapura" <?php echo ($zona_waktu_siswa['zona_waktu']=='Asia/Jayapura')?"selected":""; ?>>WIT (Waktu Indonesia Timur)</option>
              </select>
              <input type="submit" name="simpan_zona" class="btn btn-primary" value="Save">
            </form>
            <?php 
            $data = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
            while ($tampil = mysqli_fetch_array($data)) {
              ?>
              <h5 class="h3">
                <?= $tampil['nama_siswa']; ?>
              </h5>
            <?php } ?>
            <div class="h5 font-weight-300">
              <i class="ni location_pin mr-2"></i>NIS : <?= $_SESSION['nis']; ?>
            </div>
            <div>
             <?php 
             $data = mysqli_query($koneksi,"SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
             while ($tampil = mysqli_fetch_array($data)) {
              ?>
              <i class="ni education_hat mr-2"></i>Kelas : <?= $tampil['nama_kelas']; ?>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</center>
</div>
<!-- Footer -->

</div>
</div>

<div class="modal fade" id="ubah_profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <!-- <h5 class="modal-title" id="exampleModalLabel">Input Data Guru</h5> -->
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Ambil foto</label>
            <input type="file" class="form-control" accept="image/*" name="foto" required="required">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" name="ubah_foto" class="btn btn-primary" value="Ubah">
        </div>
      </div>
    </div>
  </form>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Argon JS -->
<script src="../../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>