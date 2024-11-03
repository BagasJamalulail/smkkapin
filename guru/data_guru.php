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
include'../assets/excel_reader2.php';

if (isset($_POST['simpan'])) {
  $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);
  $nama_guru = mysqli_real_escape_string($koneksi, $_POST['nama_guru']);
  $no_telp = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
  $alamat =  mysqli_real_escape_string($koneksi, $_POST['alamat']);
  $foto = 'user.png';

  $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM guru WHERE nip='$nip'"));
  if ($cek > 0) {
    header("location:data_guru.php?pesan=warning");
    exit;
  }else{
    mysqli_query($koneksi,"INSERT INTO guru VALUES('$nip','$nama_guru','$no_telp','$alamat','$foto')");
    header("location:data_guru.php?pesan=sukses");
    exit;
  }
}

//hapus data
if (isset($_GET['nip']) && isset($_GET['aksi'])) {
  $nip = mysqli_real_escape_string($koneksi, $_GET['nip']);
  mysqli_query($koneksi,"DELETE FROM guru WHERE nip='$nip'");
  header("location:data_guru.php?pesan=sukseshapus");
}


//import file guru
if (isset($_POST['import'])) {
  $target = basename($_FILES['file_guru']['name']) ;
  move_uploaded_file($_FILES['file_guru']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
  chmod($_FILES['file_guru']['name'],0777);

// mengambil isi file xls
  $data = new Spreadsheet_Excel_Reader($_FILES['file_guru']['name'],false);
// menghitung jumlah baris data yang ada
  $jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
  $berhasil = 0;
  for ($i=2; $i<=$jumlah_baris; $i++){

  // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
    $nip     = $data->val($i, 1);
    $nama_guru   = $data->val($i, 2);
    $no_telp   = $data->val($i, 3);
    $alamat   = $data->val($i, 4);
    $foto = $data->val($i, 5);

    if($nip != "" && $nama_guru != ""){
    // input data ke database (table mapel)
      mysqli_query($koneksi,"INSERT INTO guru values('$nip','$nama_guru','$no_telp','$alamat','$foto')");
      $berhasil++;
    }
  }

// hapus kembali file .xls yang di upload tadi
  unlink($_FILES['file_guru']['name']);

// alihkan halaman ke index.php
  header("location:data_guru.php?berhasil=$berhasil");
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
              <a class="nav-link active" href="data_guru.php">
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
                    <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
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
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#inputguru">Tambah data</a>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#import"><i class="fa fa-file-excel"></i> Import File</a>
                    <a href="../Data Guru.xls" class="btn btn-success"><i class="fa fa-file-excel"></i> Format File Exel</a>
                    <a href="cetak.php" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
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
            if (isset($_GET['pesan'])) {
              if ($_GET['pesan']=="sukses_edit") {
                echo "<div class='alert alert-info' role='alert'>
                <strong>Data Sukses di Update !!!</strong>
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
            if(isset($_GET['berhasil'])){
              echo "<div class='alert alert-success' role='alert'>
              <strong>".$_GET['berhasil']."</strong> Data Guru berhasil di Upload
              </div>";
            }
            ?>
            <!-- Card stats -->
            <div class="row">
              <div class="col-xl-12">
                <div class="card  card-stats">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php
                          $no=1;
                          $data_guru = mysqli_query($koneksi,"SELECT * FROM guru ORDER BY nama_guru");
                          while ($tampil = mysqli_fetch_array($data_guru)) {
                           ?>
                           <tr>
                            <td><?= $no++; ?>.</td>
                            <td><?= $tampil['nip']; ?></td>
                            <td><?= $tampil['nama_guru']; ?></td>
                            <td><?= $tampil['no_telp']; ?></td>
                            <td><?= $tampil['alamat']; ?></td>
                            <td>
                              <a onclick="return confirm('Yakin hapus data ini !!!')" href="data_guru.php?aksi=hapus&nip=<?= $tampil['nip']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                              <a href="edit.php?nip=<?= $tampil['nip']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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
  <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import File data guru</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>File</label>
              <input type="file" class="form-control" name="file_guru" required="required">
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
