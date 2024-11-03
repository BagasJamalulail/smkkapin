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

if (isset($_POST['simpan'])) {
  $tgl = mysqli_real_escape_string($koneksi, $_POST['tgl']);
  $jam = mysqli_real_escape_string($koneksi, $_POST['jam']);
  $menit = mysqli_real_escape_string($koneksi, $_POST['menit']);
  $jenis_ujian = mysqli_real_escape_string($koneksi, $_POST['jenis_ujian']);

  mysqli_query($koneksi,"INSERT INTO mengerjakan VALUES(NULL,'$kode_mapel','$kode_kelas','$tgl','$jam','$menit','$jenis_ujian')");

  echo "<script>window.alert('sukses')
  window.location='jenis_ujian.php?kode_kelas=$kode_kelas&kode_mapel=$kode_mapel'</script>";
}

function tgl_indo($tanggal){
  $bulan = array (
    1 => 'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
if (isset($_POST['update_ujian'])) {
  $id = $_GET['id'];
  $jenis_ujian = mysqli_real_escape_string($koneksi, $_POST['jenis_ujian']);
  $tgl = mysqli_real_escape_string($koneksi, $_POST['tgl']);
  $jam = mysqli_real_escape_string($koneksi, $_POST['jam']);
  $menit = mysqli_real_escape_string($koneksi, $_POST['menit']);

  mysqli_query($koneksi,"UPDATE mengerjakan SET jenis_ujian='$jenis_ujian', tgl='$tgl', jam='$jam', menit='$menit' WHERE id='$id'");
  echo "<script>window.alert('sukses di update')
  window.location='jenis_ujian.php?kode_kelas=$kode_kelas&kode_mapel=$kode_mapel'</script>";
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
  <link rel="stylesheet" href="../../https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.2.0" type="text/css">

  <link href="../../assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="beranda.php">Dashboards</a></li>
                  <li class="breadcrumb-item"><a href="kelas.php">Kelas</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Ujian</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
            </div>
          </div>

          <?php 
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="sukses_hapus") {
              echo "<div class='alert alert-success' role='alert'>
              <strong>Sukses !!!</strong>
              </div>";
            }
          }
          ?>

          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-4">
              <div class="card  card-stats">
                <div class="card-body">
                  <form action="" method="post">
                    <div class="form-group">
                      <label>Tanggal Ujian</label>
                      <input type="date" name="tgl" class="form-control" placeholder="tgl ujian" required="required">
                    </div>
                    <div class="form-group">
                      <label>Jam</label>
                      <input type="number" name="jam" value="0" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <label>Menit</label>
                      <input type="number" name="menit" value="0" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <label>Jenis Ujian</label>
                      <input type="text" name="jenis_ujian" placeholder="Jenis Ujian" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <input type="submit" name="simpan" class="btn btn-primary" value="Buat">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-xl-8">
              <div class="card  card-stats">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                      <tr>
                        <th>Jenis Ujian</th>
                        <th>Tgl Ujian</th>
                        <th>Jam</th>
                        <th>Menit</th>
                        <th>Aksi</th>
                      </tr>
                      <?php 
                      $data = mysqli_query($koneksi,"SELECT * FROM mengerjakan WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel'");
                      while ($tampil = mysqli_fetch_array($data)) {
                        $kode_kelas = $tampil['kode_kelas'];
                        $kode_mapel = $tampil['kode_mapel'];
                        $jenis_ujian = $tampil['jenis_ujian'];
                        ?>
                        <tr>                         
                          <td><?= $tampil['jenis_ujian']; ?></td>
                          <td><?= tgl_indo($tampil['tgl']); ?></td>
                          <td><?= $tampil['jam']; ?></td>
                          <td><?= $tampil['menit']; ?></td>
                          <td><a href="buat_soal.php?kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>" class="btn btn-info">Create Soal</a>
                            <a class="btn btn-danger" href="hapus.php?aksi_ujian=hapus_ujian&kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&id=<?= $tampil['id']; ?>&jenis_ujian=<?= $jenis_ujian ?>"><i class="fa fa-trash"></i></a>
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $tampil['id']; ?>"><i class="fa fa-edit"></i></a>
                          </td>

                          <div class="modal fade" id="edit<?= $tampil['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="jenis_ujian.php?id=<?= $tampil['id']; ?>&kode_mapel=<?= $kode_mapel; ?>" method="post">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5>Edit Room ujian</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label>Jenis Ujian</label>
                                      <input type="text" name="jenis_ujian" value="<?= $tampil['jenis_ujian']; ?>" class="form-control" required="required" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                      <label>Tanggal Ujian</label>
                                      <input type="date" name="tgl" value="<?= $tampil['tgl']; ?>" class="form-control" required="required">
                                    </div>
                                    <div class="form-group">
                                      <label>Jam</label>
                                      <input type="number" name="jam" value="<?= $tampil['jam']; ?>" class="form-control" required="required">
                                    </div>
                                    <div class="form-group">
                                      <label>Menit</label>
                                      <input type="number" name="menit" value="<?= $tampil['menit']; ?>" class="form-control" required="required">
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <input type="submit" name="update_ujian" class="btn btn-primary" value="Update">
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>


                        </tr>
                      <?php } ?>
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
    }, 3500);
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
