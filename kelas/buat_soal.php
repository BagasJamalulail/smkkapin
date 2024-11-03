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
// Include / load file koneksi.php
include "../koneksi.php";

$kode_kelas = mysqli_real_escape_string($koneksi, $_GET['kode_kelas']);
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
        move_uploaded_file($file_tmp, 'img/'.$foto);
        
      }else{
        header("location:buat_soal.php?pesan=warning&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
      }
    }
  }
  $query = mysqli_query($koneksi, "INSERT INTO soal VALUES(NULL, '$soal','$a','$b','$c','$d','$e','$knc_jawaban','$kode_kelas','$kode_mapel','$jenis_ujian','$foto')");
  header("location:buat_soal.php?pesan=success&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
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
                  <li class="breadcrumb-item"><a href="mapel.php?kode_kelas=<?= $kode_kelas ?>">Mata Pelajaran</a></li>
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
                  <a href="bank_soal.php?kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Lihat Soal</a>
                </div>
              </div>
            </div>
          </div>

          <?php 
          if (isset($_GET['pesan'])) {
            if ($_GET['pesan']=="success") {
              echo '<div class="row">
              <div class="col-lg-8">
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
              <div class="col-lg-8">
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
              <div class="col-lg-8">
              <div class="alert alert-warning" role="alert">
              <strong>Peringatan</strong> Ukuruan File Gambar Terlalu besar 
              </div>
              </div>
              </div>';
            }
          }
          ?>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-8">
              <div class="card  card-stats">
                <div class="card-body">
                  <?php
                  $mapel = mysqli_query($koneksi,"SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'");
                  while ($tampil = mysqli_fetch_array($mapel)) {
                   ?>
                   <h2>Buat Soal <?= $tampil['nama_mapel']; ?></h2>
                 <?php } ?>
                 <hr>
                 <form action="" method="post" enctype="multipart/form-data">
                  <table class="table-responsive">
                    <tr>
                      <td>
                       <div class="form-group">
                        <label class="form-control-label" for="soal">Soal</label>
                        <textarea name="soal" class="form-control" autofocus="autofocus">
                        </textarea>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <label class="form-control-label" for="pilihan a">Pilihan A</label>
                        <input type="text" name="a" class="form-control" placeholder="Pilihan A" required="required">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <label class="form-control-label" for="pilihan b">Pilihan B</label>
                        <input type="text" name="b" class="form-control" placeholder="Pilihan B" required="required">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group">
                        <label class="form-control-label" for="pilihan b">Kunci Jawaban</label>
                        <select name="knc_jawaban" class="form-control" required="required">
                          <option>--Pilih--</option>
                          <option value="a">A</option>
                          <option value="b">B</option>
                          <option value="c">C</option>
                          <option value="d">D</option>
                          <option value="e">E</option>
                        </select>
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <label class="form-control-label" for="pilihan c">Pilihan C</label>
                        <input type="text" name="c" class="form-control" placeholder="Pilihan C" required="required">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <label class="form-control-label" for="pilihan d">Pilihan D</label>
                        <input type="text" name="d" class="form-control" placeholder="Pilihan D" required="required">
                      </div>
                    </td>
                    <td>
                      <div class="form-group">
                        <label class="form-control-label" for="pilihan d">Pilihan E</label>
                        <input type="text" name="e" class="form-control" placeholder="Pilihan E" required="required">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div class="form-group">
                        <label class="form-control-label">Gambar</label>
                        <input type="file" name="foto" class="form-control-file">
                      </div>
                    </td>
                  </tr>
                </table>
                <hr>
                <div id="insert-form"></div>
                <div class="form-group">
                  <input type="submit" name="simpan" class="btn btn-primary" value="Input">
                  <input type="reset" name="simpan" class="btn btn-danger" value="reset">
                </div>
              </form>
              <input type="hidden" id="jumlah-form" value="1">
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-stats">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                  <tr>
                    <th>No</th>
                    <th>Soal</th>
                    <th>Opsi</th>
                  </tr>
                  <?php 
                  $no = 1;
                  $soal = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                  while ($tampil = mysqli_fetch_array($soal)) {
                    $kode_kelas = $tampil['kode_kelas'];
                    ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $tampil['soal']; ?></td>
                      <td><a onclick="return confirm('Yakin hapus Soal ini !!!')" class="btn btn-danger" href="hapus.php?aksi=hapus&id_soal=<?= $tampil['id_soal']; ?>&kode_kelas=<?= $kode_kelas ?>&jenis_ujian=<?= $jenis_ujian ?>"><i class="fa fa-trash"></i></a></td>
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
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<!--
<script>
  $(document).ready(function(){ // Ketika halaman sudah diload dan siap
    $("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
      var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
      var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
      
      // Kita akan menambahkan form dengan menggunakan append
      // pada sebuah tag div yg kita beri id insert-form
      $("#insert-form").append("<b> " + nextform + "</b>" +
        "<table class='table-responsive'>" +
        "<tr>" +
        "<td><div class='form-group'><label class='form-control-label' for='soal'>Soal</label><textarea name='soal' class='form-control' required='required'></textarea></div></td>" +
        "<td><div class='form-group'><label class='form-control-label' for='pilihan a'>Pilihan A</label><input type='text' name='a[]' class='form-control' placeholder='Pilihan A' required='required'></div></td>" +
        "<td><div class='form-group'><label class='form-control-label' for='pilihan b'>Pilihan B</label><input type='text' name='b[]' class='form-control' placeholder='Pilihan B' required='required'></div></td>" +
        "</tr>" +
        "<tr>" +
        "<td><div class='form-group'><label class='form-control-label' for='pilihan b'>Kunci Jawaban</label><select name='knc_jawaban[]' class='form-control' required='required'><option>--Pilih--</option><option value='a'>A</option><option value='b'>B</option><option value='c'>C</option><option value='d'>D</option></select></div></td>" +
        "<td><div class='form-group'><label class='form-control-label' for='pilihan c'>Pilihan C</label><input type='text' name='c[]' class='form-control' placeholder='Pilihan C' required='required'></div></td>" +
        "<td><div class='form-group'><label class='form-control-label' for='pilihan d'>Pilihan D</label><input type='text' name='d[]' class='form-control' placeholder='Pilihan D' required='required'></div></td>" +
        "</tr>" +
        "</table>" +
        "<hr>"+
        "<br>");
      
      $("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
    });
    
    // Buat fungsi untuk mereset form ke semula
    $("#btn-reset-form").click(function(){
      $("#insert-form").html(""); // Kita kosongkan isi dari div insert-form
      $("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
    });
  });
</script> -->
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script>
  window.setTimeout (function(){
    $ (".alert").fadeTo(500, 0). slideUp(500, function(){
      $(this).remove();
    });
  }, 3500);
</script>

<script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>
