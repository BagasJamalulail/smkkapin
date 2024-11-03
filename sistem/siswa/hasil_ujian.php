<?php 
session_start();

if ( !isset($_SESSION["login"]) ) {
  header("location:../../login.php");
  exit;
}
include'../../koneksi.php';

$nis = $_SESSION['nis'];

$kode_kelas = mysqli_real_escape_string($koneksi, $_GET['kode_kelas']);
$kode_mapel = mysqli_real_escape_string($koneksi, $_GET['kode_mapel']);
$jenis_ujian = mysqli_real_escape_string($koneksi, $_GET['jenis_ujian']);

if(isset($_GET['simpan'])){  
  if ($_GET['simpan']=="cek") {

    $soal_ganda = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
    $cek_soal=mysqli_num_rows($soal_ganda);
    $soal_essay = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
    $cek_soal_essay=mysqli_num_rows($soal_essay);

    if ($cek_soal_essay > 0) {
      unset($_SESSION['waktu']);

      $cek_jwb_essay=mysqli_query($koneksi,"SELECT * FROM nilai_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian' AND nis='$nis'");
      $hasil_cek=mysqli_num_rows($cek_jwb_essay);

      if ($hasil_cek > 0) {
        echo "<script>window.alert('Anda sudah mengikuti Ujian sebelumnya !!!')
        window.location='hasil_ujian.php?kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian'</script>";
      }elseif ($hasil_cek == 0) {

        mysqli_query($koneksi,"INSERT INTO nilai_essay VALUES(NULL,'$nis','$kode_kelas','$kode_mapel','$jenis_ujian')");
        $id_soal_essay=$_POST['id_soal_essay'];  
        $isi_jawaban=$_POST['isi_jawaban'];   
        $jenis_ujian=$_POST['jenis_ujian'];  
        $jumlah_dipilih = count($isi_jawaban); 
        for($x=0;$x<$jumlah_dipilih;$x++){
          mysqli_query($koneksi, "INSERT INTO jawaban_essay VALUES(NULL,'$id_soal_essay[$x]','$nis','$isi_jawaban[$x]','$kode_kelas','$kode_mapel','$jenis_ujian')");

        }
      }    
    }


    $soal_ganda = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
    $cek_soal=mysqli_num_rows($soal_ganda);

    $soal_essay = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
    $cek_soal_essay=mysqli_num_rows($soal_essay);

    if ($cek_soal > 0) {

      unset($_SESSION['waktu']);
      $pilihan=$_POST["pilihan"];
      $id_soal=$_POST["id"];
      $jumlah=$_POST['jumlah'];
      $jenis_ujian = $_POST['jenis_ujian'];
      $score=0;
      $benar=0;
      $salah=0;
      $kosong=0;

      for ($i=0;$i<$jumlah;$i++){
                //id nomor soal
        $nomor=$id_soal[$i];

                //jika user tidak memilih jawaban
        if (empty($pilihan[$nomor])){
          $kosong++;
        }else{
                    //jawaban dari user
          $jawaban=$pilihan[$nomor];

                    //cocokan jawaban user dengan jawaban di database
          $query=mysqli_query($koneksi, "select * from soal where id_soal='$nomor' and knc_jawaban='$jawaban'");

          $cek=mysqli_num_rows($query);

          if($cek){
                        //jika jawaban cocok (benar)
            $benar++;
          }else{
                        //jika salah
            $salah++;
          }
        } 
      }


      if ($benar==0 AND $salah==0) {
        echo "<script>window.alert('Sesi ujian Gagal silahkan atur Zona waktu anda terlebih dahulu !!!')
        window.location='beranda.php'</script>";
      }else{

                /*RUMUS
                Jika anda ingin mendapatkan Nilai 100, berapapun jumlah soal yang ditampilkan 
                hasil= 100 / jumlah soal * jawaban yang benar
                */
                
                $result=mysqli_query($koneksi, "SELECT * FROM soal WHERE kode_kelas='$kode_kelas' and kode_mapel='$kode_mapel' and jenis_ujian='$jenis_ujian'");
                $jumlah_soal=mysqli_num_rows($result);
                $score = 100/$jumlah_soal*$benar;
                $hasil = number_format($score,1);

                $cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM nilai WHERE nis='$nis' AND kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'"));
                if ($cek > 0) {
                  echo "<script>window.alert('Anda sudah mengikuti Ujian sebelumnya !!!')
                  window.location='hasil_ujian.php?kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian'</script>";
                }else{
                  $input=mysqli_query($koneksi,"INSERT INTO nilai VALUES(NULL,'$nis','$kode_kelas','$kode_mapel','$jumlah_soal','$benar','$salah','$kosong','$hasil','$jenis_ujian')");
                  echo "<script>window.alert('TERIMA KASIH TELAH MENGIKUTI UJIAN !!!')
                  window.location='hasil_ujian.php?kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian'</script>";
                  
                }
              }
            }
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
                            $profil=mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
                            $tampil_profil=mysqli_fetch_array($profil);
                            ?>
                            <img alt="Image placeholder" src="../../assets/img/profil_siswa/<?= $tampil_profil['foto']; ?>">
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
            <div class="header bg-primary pb-6">
              <div class="container-fluid">
                <div class="header-body">


                  <!-- Card stats -->
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="card  card-stats">
                        <div class="card-body">
                          <div class="alert alert-info">
                            <?php 
                            $data = mysqli_query($koneksi,"SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
                            while ($tampil =  mysqli_fetch_array($data)) {
                             ?>
                             <h4>Kelas : <?= $tampil['nama_kelas']; ?></h4>
                           <?php } ?>

                           <?php 
                           $data = mysqli_query($koneksi,"SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'");
                           while ($tampil = mysqli_fetch_array($data)) {
                            ?>
                            <h4>Mata Pelajaran : <?= $tampil['nama_mapel']; ?></h4>
                          <?php } ?>

                          <?php 
                          $data = mysqli_query($koneksi,"SELECT * FROM mengajar
                           INNER JOIN guru ON mengajar.nip = guru.nip WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel'");
                          while ($tampil = mysqli_fetch_array($data)) {
                            ?>
                            <h4>Guru Pengajar : <?= $tampil['nama_guru']; ?></h4>
                          <?php } ?>
                          <h4>Jenis ujian : <?= $jenis_ujian; ?></h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered" width="100%" cellspacing="0">


                            <?php 
                            $soal_ganda = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                            $cek_soal=mysqli_num_rows($soal_ganda);

                            $soal_essay = mysqli_query($koneksi,"SELECT * FROM nilai_essay
                              INNER JOIN siswa ON nilai_essay.nis=siswa.nis WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian' AND nilai_essay.nis='$nis'");
                            $cek_soal_essay=mysqli_num_rows($soal_essay);

                            if ($cek_soal_essay > 0 AND $cek_soal == 0) {
                             ?>

                             <thead>
                              <tr>
                                <th>NAMA</th>
                                <th>Jenis Soal</th>
                                <th>Jumlah soal</th>
                                <th>Opsi</th>
                              </tr>

                            <?php } ?>

                            <?php 
                            $soal_essay_jml = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                            $jml_soal_essay=mysqli_num_rows($soal_essay_jml);

                            $soal_ganda = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                            $cek_soal=mysqli_num_rows($soal_ganda);

                            $soal_essay = mysqli_query($koneksi,"SELECT * FROM nilai_essay
                              INNER JOIN siswa ON nilai_essay.nis=siswa.nis WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian' AND nilai_essay.nis='$nis'");
                            while ($tampil_essay=mysqli_fetch_array($soal_essay)) {
                              $cek_soal_essay=mysqli_num_rows($soal_essay);
                              $nis=$tampil_essay['nis'];

                              if ($cek_soal_essay > 0 AND $cek_soal == 0) {
                               ?>

                               <tr>
                                <td><?= $tampil_essay['nama_siswa']; ?></td>
                                <td>Essay</td>
                                <td><?= $jml_soal_essay; ?></td>
                                <td><a href="jwb_essay.php?nis=<?= $nis ?>&kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak Jawaban</a></td>
                              </tr>
                            </thead>
                          <?php } }?>

                          <?php 
                          $soal_ganda = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                          $cek_soal=mysqli_num_rows($soal_ganda);

                          if ($cek_soal > 0) {
                           ?>
                           <thead>
                            <tr>
                              <th>Jumlah Soal</th>
                              <th>Jawaban benar</th>
                              <th>Jawaban Salah</th>
                              <th>Jawaban Kosong</th>
                              <th>Skor</th>
                              <?php 
                              $soal_ganda = mysqli_query($koneksi,"SELECT * FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                              $cek_soal=mysqli_num_rows($soal_ganda);

                              $soal_essay = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                              $cek_soal_essay=mysqli_num_rows($soal_essay);

                              if ($cek_soal_essay AND $cek_soal > 0) {
                               ?>
                               <th>Jawaban Essay</th>
                             <?php } ?>
                             <th>Jenis Ujian</th>
                           </tr>
                         </thead>
                         <tbody>
                          <?php 
                          $data_hasil = mysqli_query($koneksi,"SELECT * FROM nilai WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND nis='$nis' AND jenis_ujian='$jenis_ujian'");
                          while ($tampil = mysqli_fetch_array($data_hasil)) {
                            $nis=$tampil['nis'];
                            ?>
                            <tr>
                              <td><?= $tampil['jml_soal']; ?></td>
                              <td><?= $tampil['jwb_benar']; ?></td>
                              <td><?= $tampil['jwb_salah']; ?></td>
                              <td><?= $tampil['jwb_kosong']; ?></td>
                              <td><p class="btn btn-primary"><?= $tampil['skor']; ?></p></td>
                              <?php 
                              $soal_essay = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
                              $cek_soal_essay=mysqli_num_rows($soal_essay);

                              if ($cek_soal_essay > 0) {
                               ?>
                               <td><a href="jwb_essay.php?nis=<?= $nis ?>&kode_kelas=<?= $kode_kelas ?>&kode_mapel=<?= $kode_mapel ?>&jenis_ujian=<?= $jenis_ujian ?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Cetak jawaban</a></td>
                             <?php } ?>
                             <td><?= $tampil['jenis_ujian']; ?></td>
                           </tr>
                         <?php } ?>
                       </tbody>
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

<script src="../../assets/datatables/jquery.dataTables.min.js"></script>
<script src="../../assets/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Optional JS -->
<script src="../../assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="../../assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="../../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>
