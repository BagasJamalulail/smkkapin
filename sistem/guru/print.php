<?php 
include'../../koneksi.php';

$kode_kelas = mysqli_real_escape_string($koneksi, $_GET['kode_kelas']);
$kode_mapel = mysqli_real_escape_string($koneksi, $_GET['kode_mapel']);
$jenis_ujian = mysqli_real_escape_string($koneksi, $_GET['jenis_ujian']);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Hasil ujian Siswa</title>
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
	<style type="text/css">
		@page{
			size: A4;
		}
	</style>
</head>
<body>

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

	<?php 
	$data = mysqli_query($koneksi,"SELECT * FROM mengerjakan WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
	while ($tampil = mysqli_fetch_array($data)) {
		?>
		<h4>Jenis Ujian : <?= $tampil['jenis_ujian']; ?></h4>
	<?php } ?>

	<div class="table-responsive">
		<table class="table table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>Nama Siswa</th>
					<th>Jawaban benar</th>
					<th>Jawaban Salah</th>
					<th>Jawaban Kosong</th>
					<th>Skor</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$data_hasil = mysqli_query($koneksi,"SELECT * FROM nilai 
					INNER JOIN siswa ON nilai.nis = siswa.nis WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian' ");
				while ($tampil = mysqli_fetch_array($data_hasil)) {
					?>
					<tr>
						<td><?= $tampil['nama_siswa']; ?></td>
						<td><?= $tampil['jwb_benar']; ?></td>
						<td><?= $tampil['jwb_salah']; ?></td>
						<td><?= $tampil['jwb_kosong']; ?></td>
						<td><?= $tampil['skor']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

		<script type="text/javascript">
			window.print();
		</script>

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