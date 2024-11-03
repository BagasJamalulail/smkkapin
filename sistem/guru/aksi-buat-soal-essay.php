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
$data_kelas=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'"));
$kode_mapel = mysqli_real_escape_string($koneksi, $_GET['kode_mapel']);
$data_mapel=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'"));
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

  $ekstensi_diperbolehkan = array('png','jpg','JPG','PNG','jpeg','JPEG');
  $foto = $_FILES['foto']['name'];
  if ($foto!=="") {
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];    
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran < 41144070){          
        move_uploaded_file($file_tmp, '../../kelas/img/'.$foto);
      }else{
        header("location:buat_soal.php?pesan=warning&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
      }
    }
  }else{
    $foto="";
  }
  $query = mysqli_query($koneksi, "INSERT INTO soal VALUES(NULL, '$soal','$a','$b','$c','$d','$e','$knc_jawaban','$kode_kelas','$kode_mapel','$jenis_ujian','$foto')");
  header("location:buat_soal.php?pesan=success&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
}
if (isset($_POST['essay'])) {
  $soal=mysqli_real_escape_string($koneksi, $_POST['soal']);

  $ekstensi_diperbolehkan = array('png','jpg','JPG','PNG','jpeg','JPEG');
  $foto = $_FILES['foto']['name'];
  if ($foto!=="") {
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];    
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
      if($ukuran < 41144070){          
        move_uploaded_file($file_tmp, '../../kelas/img/gambar_soal_essay/'.$foto);
      }else{
        header("location:buat_soal.php?pesan=warning&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
      }
    }
  }else{
    $foto="";
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
                  <li class="breadcrumb-item"><a href="buat_soal.php?kode_kelas=<?= $kode_kelas; ?>&kode_mapel=<?= $kode_mapel; ?>&jenis_ujian=<?= $jenis_ujian; ?>">Tempat Soal</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Buat Soal</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
            </div>
          </div>


          <div class="row">
            <div class="col-lg-12">
              <div class="card  card-stats">
                <div class="card-body">
                  <h4>Buat Soal Essay Mapel : <?= $data_mapel['nama_mapel']; ?></h4>
                  <h4>Kelas : <?= $data_kelas['nama_kelas']; ?></h4>
                  <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          <div class="form-group">
                            <label><b>Soal</b></label>
                            <textarea style="height: 50px;" class="ckeditor" id="ckedtor" name="soal" autofocus="autofocus" required="required"></textarea>
                          </div>
                          <div class="form-group">
                            <label class="form-control-label">Gambar (Jika ingin gunakan gambar)</label>
                            <input type="file" name="foto" class="form-control">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="submit" name="essay" class="btn btn-primary" value="Input">
                        </div>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>


        </div>
      </div>


      <div class="modal fade" id="buatsoal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <?php
                $mapel = mysqli_query($koneksi,"SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'");
                while ($tampil = mysqli_fetch_array($mapel)) {
                 ?>
                 <h5 class="modal-title" id="exampleModalLabel">Buat Soal Pilihan ganda <?= $tampil['nama_mapel']; ?></h5>
               <?php } ?>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label><b>Soal</b></label>
                <textarea style="height: 50px;" class="ckeditor" id="ckedtor" name="soal" autofocus="autofocus" required="required"></textarea>
              </div>
              <div class="form-group">
                <label><b>Pilihan A</b></label>
                <textarea style="height: 50px;" class="ckeditor" id="ckedtor" name="a" autofocus="autofocus" required="required"></textarea>
              </div>
              <div class="form-group">
                <label><b>Pilihan B</b></label>
                <textarea style="height: 50px;" class="ckeditor" id="ckedtor" name="b" autofocus="autofocus" required="required"></textarea>
              </div>
              <div class="form-group">
                <label><b>Pilihan C</b></label>
                <textarea style="height: 50px;" class="ckeditor" id="ckedtor" name="c" autofocus="autofocus" required="required"></textarea>
              </div>
              <div class="form-group">
                <label><b>Pilihan D</b></label>
                <textarea style="height: 50px;" class="ckeditor" id="ckedtor" name="d" autofocus="autofocus" required="required"></textarea>
              </div>
              <div class="form-group">
                <label><b>Pilihan E</b></label>
                <textarea style="height: 50px;" class="ckeditor" id="ckedtor" name="e" autofocus="autofocus" required="required"></textarea>
              </div>
              <div class="form-group">
                <label class="form-control-label" for="pilihan b"><b>Kunci Jawaban</b></label>
                <select name="knc_jawaban" class="form-control" required="required">
                  <option>--Pilih--</option>
                  <option value="a">A</option>
                  <option value="b">B</option>
                  <option value="c">C</option>
                  <option value="d">D</option>
                  <option value="e">E</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-control-label">Gambar</label>
                <input type="file" name="foto" class="form-control-file">
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


    <div class="modal fade" id="soalessay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <?php
              $mapel = mysqli_query($koneksi,"SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'");
              while ($tampil = mysqli_fetch_array($mapel)) {
               ?>
               <h5 class="modal-title" id="exampleModalLabel">Buat Soal Essay <?= $tampil['nama_mapel']; ?></h5>
             <?php } ?>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label><b>Soal</b></label>
              <textarea style="height: 50px;" class="ckeditor" id="ckedtor" name="soal" autofocus="autofocus" required="required"></textarea>
            </div>
            <div class="form-group">
              <label class="form-control-label">Gambar</label>
              <input type="file" name="foto" class="form-control-file">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input type="submit" name="essay" class="btn btn-primary" value="Input">
          </div>
        </div>
      </div>
    </form>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
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
