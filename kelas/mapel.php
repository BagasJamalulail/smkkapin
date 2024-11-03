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
  $kode_mapel = mysqli_real_escape_string($koneksi, $_POST['kode_mapel']);
  $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);

  $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM mengajar WHERE kode_mapel='$kode_mapel' AND kode_kelas='$kode_kelas'"));
  if ($cek > 0) {
    echo "<script>window.alert('Maaf Data Mapel yang mengajar sudah ada !!!')
    window.location='mapel.php?kode_kelas=$kode_kelas';</script>";
  }else{
    mysqli_query($koneksi, "INSERT INTO mengajar VALUES(NULL,'$nip','$kode_kelas','$kode_mapel')");
    header("location:mapel.php?pesan=sukses&kode_kelas=$kode_kelas");
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
                  <li class="breadcrumb-item active" aria-current="page">Mapel</li>
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
                  <a href="" class="btn btn-primary" data-toggle="modal" data-target="#mapel">Input Pengajar Mapel</a>
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
              <strong>Success</strong> Mata Pelajaran Berhasil di tambahkan 
              </div>
              </div>
              </div>';
            }
          }
          if (isset($_GET['pesan_hapus'])) {
            if ($_GET['pesan_hapus']=="hapus") {
              echo '<div class="row">
              <div class="col-lg-12">
              <div class="alert alert-success" role="alert">
              <strong>Success</strong> dihapus !!! 
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
                   <h2>Mapel Kelas <?= $tampil['nama_kelas']; ?></h2>
                 <?php } ?>
                 <div class="table-responsive">
                  <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Guru Pengajar</th>
                        <th>Nama Mapel</th>
                        <th>Materi</th>
                        <th>jadwal Ujian</th>
                        <th>Hasil Ujian</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Guru Pengajar</th>
                        <th>Nama Mapel</th>
                        <th>Materi</th>
                        <th>jadwal Ujian</th>
                        <th>Hasil Ujian</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php 
                      $no = 1;
                      $mapel = mysqli_query($koneksi,"SELECT * FROM mengajar
                        INNER JOIN guru ON mengajar.nip = guru.nip
                        INNER JOIN mapel ON mengajar.kode_mapel = mapel.kode_mapel WHERE kode_kelas='$kode_kelas'");
                      while ($tampil = mysqli_fetch_array($mapel)) {
                        $kode_mapel = $tampil['kode_mapel'];
                        $kode_kelas = $tampil['kode_kelas'];
                        ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $tampil['nama_guru']; ?></td>
                          <td><?= $tampil['nama_mapel']; ?></td>
                          <td><a href="materi.php?kode_kelas=<?= $tampil['kode_kelas']; ?>&kode_mapel=<?= $tampil['kode_mapel']; ?>" class="btn btn-secondary"> <?php 
                          $sql = mysqli_query($koneksi, "SELECT * FROM materi WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel'");
                          $count = mysqli_num_rows($sql);
                          echo "$count"; 
                          ?> Materi</a></td>
                          <td><a href="jenis_ujian.php?kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $tampil['kode_mapel']; ?>" class="btn btn-info">Create</a></td>
                          <td><a href="hasil_jenis_ujian.php?kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $tampil['kode_mapel']; ?>" class="btn btn-secondary"><i class="ni ni-trophy text-yellow"></i> Hasil Ujian</a></td>
                          <td>
                            <a onclick="return confirm('Yakin hapus Data Mapel ini !!!')" href="hapus.php?mapel=hapus&id=<?= $tampil['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" id="mapel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <?php
          $kelas = mysqli_query($koneksi,"SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
          while ($tampil = mysqli_fetch_array($kelas)) {
           ?>
           <h5 class="modal-title" id="exampleModalLabel">Kelas <?= $tampil['nama_kelas']; ?></h5>
         <?php } ?>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nama Mapel</label>
          <select name="kode_mapel" class="form-control" required="required">
            <option>--Pilih--</option>
            <?php
            $mapel = mysqli_query($koneksi,"SELECT * FROM mapel");
            while($tampil = mysqli_fetch_array($mapel)){
              echo '<option value="'.$tampil['kode_mapel'].'">'.$tampil['nama_mapel'].'</option>';
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Guru Pengajar</label>
          <select class="form-control" name="nip" required="required">
            <option>--Pilih--</option>
            <?php
            $wali = mysqli_query($koneksi,"SELECT * FROM guru");
            while($tampil = mysqli_fetch_array($wali)){
              echo '<option value="'.$tampil['nip'].'">'.$tampil['nama_guru'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <input type="submit" name="simpan" class="btn btn-primary" value="Input">
      </div>
    </div>
  </div>
</form>
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
</body>

</html>
