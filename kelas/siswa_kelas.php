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

if ( !isset($_SESSION["login"]) ) {
  header("location: ../login.php");
  exit;
}
include'../koneksi.php';
$kode_kelas = mysqli_real_escape_string($koneksi, $_GET['kode_kelas']);

if (isset($_POST['simpan'])) {
  $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);

  $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM join_kelas WHERE nis='$nis'"));
  if ($cek > 0) {
    echo "<script>window.alert('Maaf Siswa Sudah pernah Terdaftar Pada Suatu kelas !!!')
    window.location='siswa_kelas.php?kode_kelas=$kode_kelas';</script>";
  }else{
    mysqli_query($koneksi, "INSERT INTO join_kelas VALUES('$kode_kelas','$nis')");
    header("location:siswa_kelas.php?pesan=sukses&kode_kelas=$kode_kelas");
  }
}

if (isset($_POST['tambah_siswa'])) {
  $check = isset($_POST['pilih']) ? "checked" : "unchecked";
  if ($check=="checked") {
    $nis = $_POST['pilih'];
    $jumlah_dipilih = count($nis);
    for($x=0;$x<$jumlah_dipilih;$x++){
      $ok=mysqli_query($koneksi,"INSERT INTO join_kelas VALUES('$kode_kelas','$nis[$x]')");
        // $ok=mysqli_query($koneksi,"DELETE FROM tbl_kelas WHERE kode_kelas='$kode_kelas[$x]'");
      echo "<script>window.alert('$jumlah_dipilih Data Siswa yang dipilih berhasil di simpan')
      window.location='siswa_kelas.php?kode_kelas=$kode_kelas'</script>";
    }
  }else{
   echo "<script>window.alert('Belum ada data yang anda pilih !!!')
   window.location='siswa_kelas.php?kode_kelas=$kode_kelas'</script>";
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
  <link rel="icon" href="../assets/img/brand/YPTKAPIN.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="../https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">

  <link href="../assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../assets/img/brand/aplikasi-ujian.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../guru/data_guru.php">
                <i class="ni ni-archive-2 text-primary"></i>
                <span class="nav-link-text">Master Data Guru</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../siswa/data_siswa.php">
                <i class="ni ni-archive-2 text-primary"></i>
                <span class="nav-link-text">Master Data Siswa</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../mapel/mapel.php">
                <i class="ni ni-archive-2 text-pink"></i>
                <span class="nav-link-text">Master Data Mapel</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="kelas.php">
                <i class="ni ni-paper-diploma text-info"></i>
                <span class="nav-link-text">Kelas</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../medsos/medsos.php">
                <i class="ni ni-world-2 text-success"></i>
                <span class="nav-link-text">Medsos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../pengguna/pengguna.php">
                <i class="ni ni-single-02 text-dark"></i>
                <span class="nav-link-text">Pengguna</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">
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
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                </div>
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
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
                    <img alt="Image placeholder" src="../assets/img/user.png">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?= $_SESSION['username']; ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <a href="../logout.php" class="dropdown-item">
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
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="../index.php">Dashboards</a></li>
                  <li class="breadcrumb-item"><a href="kelas.php">Kelas</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Siswa</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
            </div>
          </div>

          <div class="row">
            <div class="col-xl-12">
              <div class="card  card-stats">
                <div class="card-body">
                  <a href="" class="btn btn-primary" data-toggle="modal" data-target="#inputsiswa">Tambah Siswa</a>
                </div>
              </div>
            </div>
          </div>

          <?php 
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="sukses") {
              echo '<div class="row">
              <div class="col-lg-12">
              <div class="alert alert-success" role="alert">
              <strong>Success</strong> Siswa berhasil di tambahkan  
              </div>
              </div>
              </div>';
            }
          }
          if (isset($_GET['aksi_hapus'])) {
            if ($_GET['aksi_hapus']=="hapus") {
              echo '<div class="row">
              <div class="col-lg-12">
              <div class="alert alert-success" role="alert">
              <strong>Success</strong> Siswa berhasil di dihapus !!!
              </div>
              </div>
              </div>';
            }
          }
          ?>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-12">
              <div class="card  card-stats">
                <div class="card-body">
                  <?php
                  $kelas = mysqli_query($koneksi,"SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
                  while ($tampil = mysqli_fetch_array($kelas)) {
                   ?>
                   <h2>Siswa Kelas <?= $tampil['nama_kelas']; ?></h2>
                 <?php } ?>
                 <div class="table-responsive">
                  <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Jk</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Jk</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php 
                      $no = 1;
                      $siswa = mysqli_query($koneksi,"SELECT * FROM join_kelas
                        INNER JOIN siswa ON join_kelas.nis = siswa.nis  WHERE kode_kelas='$kode_kelas'");
                      while ($tampil = mysqli_fetch_array($siswa)) {
                       ?>
                       <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $tampil['nis']; ?></td>
                        <td><?= $tampil['nama_siswa']; ?></td>
                        <td><?= $tampil['jk']; ?></td>
                        <td>
                          <a onclick="return confirm('Yakin hapus data ini !!!')" href="hapus.php?siswa=hapus_siswa&nis=<?= $tampil['nis']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
  </div>
  <div class="row">
    <div class="col-xl-12">

    </div>
  </div>
  <!-- Footer -->

</div>
</div>
<!-- Argon Scripts -->
<div class="modal fade" id="inputsiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <?php
        $kelas = mysqli_query($koneksi,"SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
        while ($tampil = mysqli_fetch_array($kelas)) {
         ?>
         <h5 class="modal-title" id="exampleModalLabel">Siswa Kelas <?= $tampil['nama_kelas']; ?></h5>
       <?php } ?>
       <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">
      <form action="" method="post">
        <table class="table">
         <tr>
          <td colspan="3"><input type="submit" class="btn btn-primary" name="tambah_siswa" value="simpan"></td>
        </tr>
        <tr>
          <th>Opsi select all <br><input type="checkbox" onclick="toggle(this);"></th>
          <th>No.</th>
          <th>Nama</th>
        </tr>
        <?php
        $nomor=1;
        $siswa = mysqli_query($koneksi,"SELECT * FROM siswa");
        while($tampil = mysqli_fetch_array($siswa)){
          $nis=$tampil['nis'];
          ?>
          <?php 
          $data=mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM join_kelas WHERE nis='$nis' AND kode_kelas='$kode_kelas'"));
          if ($data > 0) {

          }else{
            ?>
            <tr>
              <td><input type="checkbox" name="pilih[]" value="<?= $nis; ?>"></td>
              <td><b><?= $nomor++; ?></b></td>
              <td><?= $tampil['nama_siswa']; ?></td>
            </tr>
          <?php }} ?>
        </table>
        
      </form>
    </div>

  </div>
</div>
</div>
<!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script>
  window.setTimeout (function(){
    $ (".alert").fadeTo(500, 0). slideUp(500, function(){
      $(this).remove();
    });
  }, 3500);
</script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>

<script src="../assets/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Optional JS -->
<script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="../assets/js/argon.js?v=1.2.0"></script>

<script type="text/javascript">
  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != source)
        checkboxes[i].checked = source.checked;
    }
  }
</script>
</body>

</html>
