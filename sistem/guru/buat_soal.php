<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
  header("location: ../../login.php");
  exit;
}
// Include / load file koneksi.php
include "../../koneksi.php";

$nip=$_SESSION['nip'];

$kode_kelas = $_SESSION['kode_kelas'];
$kode_mapel = mysqli_real_escape_string($koneksi, $_GET['kode_mapel']);
$jenis_ujian = mysqli_real_escape_string($koneksi, $_GET['jenis_ujian']);

if (isset($_POST['simpan'])) {
  $soal = $_POST['soal'];
  $a = $_POST['a'];
  $b = $_POST['b']; 
  $c = $_POST['c'];
  $d = $_POST['d'];
  $e = $_POST['e'];
  $knc_jawaban = $_POST['knc_jawaban'];
  $kode_mapel = $kode_mapel;

  if($_POST['simpan']){
    $ekstensi_diperbolehkan = array('png','jpg','JPG','PNG');
    $foto = $_FILES['foto']['name'];
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];    

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran < 11144070){          
        move_uploaded_file($file_tmp, '../../kelas/img/'.$foto);
        
      }else{
        header("location:buat_soal.php?pesan=warning&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
      }
    }
  }
  $query = mysqli_query($koneksi, "INSERT INTO soal VALUES(NULL, '$soal','$a','$b','$c','$d','$e','$knc_jawaban','$kode_kelas','$kode_mapel','$jenis_ujian','$foto')");
  header("location:buat_soal.php?pesan=success&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
}
if (isset($_POST['essay'])) {
  $soal=mysqli_real_escape_string($koneksi, $_POST['soal']);

  $ekstensi_diperbolehkan = array('png','jpg','JPG','PNG');
  $foto = $_FILES['foto']['name'];
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));
  $ukuran = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];    

  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    if($ukuran < 11144070){          
      move_uploaded_file($file_tmp, '../../kelas/img/gambar_soal_essay/'.$foto);
      
    }else{
      header("location:buat_soal.php?pesan=warning&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
    }
  }
  mysqli_query($koneksi,"INSERT INTO soal_essay VALUES(NULL,'$soal','$kode_kelas','$kode_mapel','$jenis_ujian','$foto')");
  header("location:buat_soal.php?pesan=success&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
}
if (isset($_POST['update_soal'])) {
  $id_soal = $_GET['id'];
  $soal = mysqli_real_escape_string($koneksi, $_POST['soal']);
  $a = mysqli_real_escape_string($koneksi, $_POST['a']);
  $b = mysqli_real_escape_string($koneksi, $_POST['b']);
  $c = mysqli_real_escape_string($koneksi, $_POST['c']);
  $d = mysqli_real_escape_string($koneksi, $_POST['d']);
  $e = mysqli_real_escape_string($koneksi, $_POST['e']);
  $knc_jawaban = mysqli_real_escape_string($koneksi, $_POST['knc_jawaban']);

  $update_soal = mysqli_query($koneksi,"UPDATE soal SET soal='$soal', a='$a', b='$b', c='$c', d='$d', e='$e', knc_jawaban='$knc_jawaban' WHERE id_soal='$id_soal'");

  echo "<script>window.alert('Soal berhasil di update')
  window.location='buat_soal.php?kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian'</script>";
}


// import soal
if (isset($_POST['import'])) {
  require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require('spreadsheet-reader-master/SpreadsheetReader.php');

// upload file xls
  $target = basename($_FILES['file_ganda']['name']) ;
  move_uploaded_file($_FILES['file_ganda']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
  chmod($_FILES['file_ganda']['name'],0777);

// mengambil isi file xls
  $data = new Spreadsheet_Excel_Reader($_FILES['file_ganda']['name'],false);
// menghitung jumlah baris data yang ada
  $jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
  $berhasil = 0;
  for ($i=2; $i<=$jumlah_baris; $i++){

    // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing

    $soal   = $data->val($i, 1);
    $pilihan_a   = $data->val($i, 2);
    $pilihan_b   = $data->val($i, 3);
    $pilihan_c   = $data->val($i, 4);
    $pilihan_d   = $data->val($i, 5);
    $pilihan_e   = $data->val($i, 6);
    $knc_jawaban   = $data->val($i, 7);
    $foto="";

        // input data ke database (table data_pegawai)
        // mysqli_query($koneksi,"INSERT INTO siswa values('$nim','$nama_mhs','$status','$waktu')");
    if ($soal !== "" ) {
      mysqli_query($koneksi,"INSERT INTO soal VALUES(NULL,'$soal','$pilihan_a','$pilihan_b','$pilihan_c','$pilihan_d','$pilihan_e','$knc_jawaban','$kode_kelas','$kode_mapel','$jenis_ujian','$foto')");
      $berhasil++;
    }
  }
// hapus kembali file .xls yang di upload tadi
  unlink($_FILES['file_ganda']['name']);

// alihkan halaman ke index.php
  echo "<script>window.alert('$berhasil Soal berhasil diimport')
  window.location='buat_soal.php?kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian'</script>";
  // header("location:mapel?berhasil=$berhasil");
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
  <script type="text/javascript" src="../../ckeditor/ckeditor.js"></script>
  <link rel="icon" href="../../assets/img/brand/YPTKAPIN.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="../../https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
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
                  <li class="breadcrumb-item"><a href="../../index.php">Dashboards</a></li>
                  <li class="breadcrumb-item"><a href="kelas.php">Kelas</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Buat Soal</li>
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
                  <a href="aksi-buat-soalpilihan.php?kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>" class="btn btn-primary">Buat Soal Pilihan Ganda</a>
                  <a href="aksi-buat-soal-essay.php?kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>" class="btn btn-primary">Buat Soal Essay</a>
                  <a href="bank_soal.php?kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat Soal</a>
                  <a href="" class="btn btn-primary" data-toggle="modal" data-target="#import"><i class="fa fa-file"></i> Import Soal</a>
                  <a href="../../FORMAT SOAL.xls" class="btn btn-success"><i class="fa fa-download"></i> Format Soal XLS</a>
                </div>
              </div>
            </div>
          </div>

          <?php 
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="success") {
              echo '<div class="row">
              <div class="col-lg-12">
              <div class="alert alert-success" role="alert">
              <strong>Success</strong> 
              </div>
              </div>
              </div>';
            }
          }
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="sukses") {
              echo '<div class="row">
              <div class="col-lg-12">
              <div class="alert alert-success" role="alert">
              <strong>Success</strong> dihapus !!!
              </div>
              </div>
              </div>';
            }
          }
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="warning") {
              echo '<div class="row">
              <div class="col-lg-12">
              <div class="alert alert-warning" role="alert">
              <strong>Peringatan</strong> Ukuruan File Gambar Terlalu besar 
              </div>
              </div>
              </div>';
            }
          }
          ?>

          <?php 
          $soal_ganda = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
          $cek_soal=mysqli_num_rows($soal_ganda);

          if ($cek_soal > 0) {
           ?>

           <div class="row">
            <div class="col-lg-12">
              <div class="card card-stats">
                <div class="card-body">
                  <div class="table-responsive">
                    <?php
                    $mapel = mysqli_query($koneksi,"SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'");
                    while ($tampil = mysqli_fetch_array($mapel)) {
                     ?>
                     <h4>Soal Pilihan Ganda <?= $tampil['nama_mapel']; ?></h4>
                   <?php } ?>
                   <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                    <tr>

                      <th>No</th>
                      <th>Opsi</th>
                      <th>Soal</th>
                      
                    </tr>
                    <?php 
                    $no = 1;
                    $soal = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                    while ($tampil = mysqli_fetch_array($soal)) {
                      $kode_kelas = $tampil['kode_kelas'];
                      $kode_mapel = $tampil['kode_mapel'];
                      $jenis_ujian = $tampil['jenis_ujian'];
                      ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td>
                          <a onclick="return confirm('Yakin hapus Soal ini !!!')" class="btn btn-danger" href="hapus.php?aksi=hapus&id_soal=<?= $tampil['id_soal']; ?>&kode_kelas=<?= $kode_kelas ?>&jenis_ujian=<?= $jenis_ujian ?>"><i class="fa fa-trash"></i></a>
                          <a class="btn btn-primary" href="aksi-edit-soal.php?id_soal=<?= $tampil['id_soal']; ?>&kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>"><i class="fa fa-edit"></i></a>
                        </td>
                        <td><?= $tampil['soal']; ?></td>
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
  <?php } ?>


  <?php 
  $soal_essay = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
  $cek_soal_essay=mysqli_num_rows($soal_essay);

  if ($cek_soal_essay > 0) {
   ?>
   <div class="row">
    <div class="col-xl-12">
      <div class="card card-stats">
        <div class="card-body">
          <div class="table-responsive">
            <?php
            $mapel = mysqli_query($koneksi,"SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'");
            while ($tampil = mysqli_fetch_array($mapel)) {
             ?>
             <h4>Soal Essay <?= $tampil['nama_mapel']; ?></h4>
           <?php } ?>
           <table class="table table-bordered" id="example" width="100%" cellspacing="0">
             <tr>
              <th>No</th>
              <th>Soal</th>  
              <th>Opsi</th>
            </tr>
            <?php 
            $no = 1;
            $soal = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
            while ($tampil = mysqli_fetch_array($soal)) {
              $kode_kelas = $tampil['kode_kelas'];
              $kode_mapel = $tampil['kode_mapel'];
              $jenis_ujian = $tampil['jenis_ujian'];
              ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $tampil['soal']; ?></td>
                <td><a href="hapus.php?aksi=hapus_essay&id_soal=<?= $tampil['id_soal']; ?>&kode_kelas=<?= $kode_kelas ?>&jenis_ujian=<?= $jenis_ujian ?>" onclick="return confirm('Yakin hapus soal ini !!!')" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Footer -->
<?php } ?>

</div>
</div>




<script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>


<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Soal</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label><b>File Xls</b></label>
            <input type="file" class="form-control" name="file_ganda">
          </div>
          <div class="modal-footer">
            <input type="submit" name="import" class="btn btn-primary" value="Import">
          </div>
        </div>
      </div>
    </form>
  </div>


  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script>
    window.setTimeout (function(){
      $ (".alert").fadeTo(500, 0). slideUp(500, function(){
        $(this).remove();
      });
    }, 2000);
  </script>

  <script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>
