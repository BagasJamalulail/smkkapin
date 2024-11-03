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

$nis = mysqli_real_escape_string($koneksi, $_GET['nis']);

if (isset($_POST['update'])) {

  $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
  $jk = mysqli_real_escape_string($koneksi, $_POST['jk']);
  $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
  $alamat =  mysqli_real_escape_string($koneksi, $_POST['alamat']);

  
  mysqli_query($koneksi,"UPDATE siswa SET nis='$nis', nama_siswa='$nama_siswa', jk='$jk', no_telp='$no_telp', alamat='$alamat' WHERE nis='$nis' ");
  header("location:data_siswa.php?pesan=sukses_edit");
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
              <a class="nav-link active" href="data_siswa.php">
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
              <a class="nav-link" href="../kelas/kelas.php">
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
                  <li class="breadcrumb-item" aria-current="page"><a href="data_siswa.php">Data Siswa</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Data Siswa</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
            </div>
          </div>

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-6">
              <div class="card  card-stats">
                <div class="card-body">
                  <?php 
                  $data = mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
                  while ($tampil = mysqli_fetch_array($data)) {
                   ?>
                   <form action="" method="post">
                    <div class="form-group">
                      <label>NIS</label>
                      <input type="text" name="nis" value="<?= $tampil['nis']; ?>" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                      <label>Nama Siswa</label>
                      <input type="text" name="nama_siswa" value="<?= $tampil['nama_siswa']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <input type="text" name="jk" value="<?= $tampil['jk']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>No Telp</label>
                      <input type="text" name="no_telp" value="<?= $tampil['no_telp']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" name="alamat" value="<?= $tampil['alamat']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" name="update" value="Update" class="btn btn-primary">
                    </div>
                  </form>
                <?php } ?>
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
  <form action="" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input Data Siswa</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>NIS</label>
            <input type="text" class="form-control" name="nis" placeholder="NIS" required="required" autofocus/>
          </div>
          <div class="form-group">
            <label>Nama Siswa</label>
            <input type="text" class="form-control" name="nama_siswa" placeholder="Nama Siswa" required="required">
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select class="form-control" name="jk" required="required">
              <option>--Pilih--</option>
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label>No Telp</label>
            <input type="number" name="no_telp" class="form-control" placeholder="No Telp" required="required">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="alamat" required="required"></textarea>
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
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import File data Siswa</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control" name="file_siswa" required="required">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="submit" name="import" class="btn btn-primary" value="Import">
        </div>
      </div>
    </div>
  </form>
</div>

<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>

<script>
  window.setTimeout (function(){
    $ (".alert").fadeTo(500, 0). slideUp(500, function(){
      $(this).remove();
    });
  }, 4000);
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