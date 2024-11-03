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
  header("location: ../../login.php");
  exit;
}
include'../../koneksi.php';

$nip=$_SESSION['nip'];

$kode_kelas = $_SESSION['kode_kelas'];
$kode_mapel = mysqli_real_escape_string($koneksi, $_GET['kode_mapel']);
$jenis_ujian = mysqli_real_escape_string($koneksi, $_GET['jenis_ujian']);

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
  <link rel="stylesheet" href="../../https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.2.0" type="text/css">

  <link href="../../assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- <style type="text/css">
    table, tr, td{
      border-collapse: collapse;
      border: 1px solid black;
    }
  </style> -->
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
              <a class="nav-link active" href="kelas.php">
                <i class="ni ni-paper-diploma text-info"></i>
                <span class="nav-link-text">Manajemen pelajaran</span>
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
                    <?php 
                    $profil=mysqli_query($koneksi,"SELECT * FROM guru WHERE nip='$nip'");
                    $tampil_profil=mysqli_fetch_array($profil);
                    ?>
                    <img alt="Image placeholder" src="../../assets/img/profil_guru/<?= $tampil_profil['foto']; ?>">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">NIP : <?= $_SESSION['nip']; ?></span>
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
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">


          <div class="row">
            <div class="col-xl-12">
              <div class="card  card-stats">
                <div class="card-body">
                  <a href="buat_soal.php?kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>" class="btn btn-primary">Back</a>
                </div>
              </div>
            </div>
          </div>

          <?php 
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="sukses") {
              echo "<div class='alert alert-success' role='alert'>
              <strong>Sukses!</strong> Data Guru Berhasil Diinput
              </div>";
            }
          }
          ?>

          <?php 
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="sukseshapus") {
              echo "<div class='alert alert-success' role='alert'>
              <strong>Sukses!</strong> Data Guru Berhasil Dihapus
              </div>";
            }
          }
          ?>

          <?php 
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="warning") {
              echo "<div class='alert alert-warning' role='alert'>
              <strong>Maaf!</strong> Data Sudah ada
              </div>";
            }
          }
          ?>
          
          <?php 
          $soal_ganda = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
          $cek_soal=mysqli_num_rows($soal_ganda);

          if ($cek_soal > 0) {
           ?>

           <div class="row">
            <div class="col-xl-12">
              <div class="card  card-stats">
                <div class="card-body"  style="overflow: scroll; height: 500px;">
                  <div class="table-responsive">
                    <table>
                      <?php 
                      $no = 1;
                      $soal = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian' ORDER BY RAND ()");
                      $jumlah=mysqli_num_rows($soal);
                      while ($tampil = mysqli_fetch_array($soal)) {
                        $id = $tampil['id_soal'];
                        ?>
                        <input type="hidden" name="id[]" value="<?php echo $id; ?>">
                        <input type="hidden" name="jumlah" value="<?php echo $jumlah; ?>">
                        <tr>
                          <td>
                            <div class="form-group">
                              <b><?= $no++; ?>.</b>
                            </div>
                          </td>
                          <td colspan="3"><?= $tampil['soal']; ?></td>

                        </tr>
                        <tr>
                          <td></td>
                          <td>
                            <div class="form-group">
                              <input type="radio" name="<?= $tampil['id_soal']; ?>">
                            </div>
                          </td>
                          <td> A. <?= $tampil['a']; ?></td>
                          <td rowspan="4">
                           <?php 
                           if (!empty($tampil['foto'])) {
                            echo "<img width='280' height='200' src='../../kelas/img/$tampil[foto]'>";
                          }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>
                          <div class="form-group">
                            <input type="radio" name="<?= $tampil['id_soal']; ?>">
                          </div>
                        </td>
                        <td> B. <?= $tampil['b']; ?></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>
                          <div class="form-group">
                            <input type="radio" name="<?= $tampil['id_soal']; ?>"> 
                          </div>
                        </td>
                        <td>C. <?= $tampil['c']; ?></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>
                          <div class="form-group">
                            <input type="radio" name="<?= $tampil['id_soal']; ?>"> 
                          </div>
                        </td>
                        <td>D. <?= $tampil['d']; ?></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>
                          <div class="form-group">
                            <input type="radio" name="<?= $tampil['id_soal']; ?>"> 
                          </div>
                        </td>
                        <td>E. <?= $tampil['e']; ?></td>
                      </tr>
                    <?php } ?>
                  </table>
                  <hr>
                </div>
              </div>
            </div>

          <?php } ?>

          <?php 
          $soal_essay = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
          $cek_soal_essay=mysqli_num_rows($soal_essay);

          if ($cek_soal_essay > 0) {
           ?>

           <div class="row">
            <div class="col-xl-12">
              <div class="card  card-stats">
                <div class="card-body">
                  <div class="table-responsive">
                    <h4>Soal Essay</h4>
                    <table>
                      <?php 
                      $no = 1;
                      $soal = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                      $jumlah=mysqli_num_rows($soal);
                      while ($tampil = mysqli_fetch_array($soal)) {
                        $id = $tampil['id_soal'];
                        ?>
                        <tr>
                          <td><b><?= $no++; ?>.</b></td>
                          <td style="color: black;"><b> <?= $tampil['soal']; ?></b></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>
                            <?php 
                            if (!empty($tampil['foto'])) {
                              echo "<img width='80%;' height='250px' src='../../kelas/img/gambar_soal_essay/$tampil[foto]'>";
                            }
                            ?>
                          </td>
                        </tr>

                      <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      <?php } ?>

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
<div class="modal fade" id="inputguru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="" method="post">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input Data Guru</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name="nip" placeholder="NIP" required="required" autofocus/>
          </div>
          <div class="form-group">
            <label>Nama Guru</label>
            <input type="text" class="form-control" name="nama_guru" placeholder="Nama Guru" required="required">
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
<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
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
  }, 2000);
</script>

<script src="../../assets/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Optional JS -->
<script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="../../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>
