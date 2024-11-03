<?php 
session_start();

if ( !isset($_SESSION["login"]) ) {
	header("location: ../../login.php");
	exit;
}



include'../../koneksi.php';

$nis = $_GET['nis'];	
$kode_kelas = $_GET['kode_kelas'];
$kode_mapel = $_GET['kode_mapel'];
$jenis_ujian = $_GET['jenis_ujian'];

$data = mysqli_query($koneksi,"SELECT * FROM mengajar
	INNER JOIN guru ON mengajar.nip = guru.nip WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel'");
$row_guru=mysqli_fetch_array($data);

$kelas=mysqli_query($koneksi,"SELECT * FROM kelas WHERE kode_kelas='$kode_kelas'");
$row_kelas=mysqli_fetch_array($kelas);

$mapel=mysqli_query($koneksi,"SELECT * FROM mapel WHERE kode_mapel='$kode_mapel'");
$row_mapel=mysqli_fetch_array($mapel);

$siswa=mysqli_query($koneksi,"SELECT * FROM siswa WHERE nis='$nis'");
$row=mysqli_fetch_array($siswa);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Jawaban essay</title>
</head>
<body>



	<table>
		<tr>
			<td>
				<b>Kelas</b>
			</td>
			<td>: <?= $row_kelas['nama_kelas']; ?></td>
		</tr>
		<tr>
			<td>
				<b>Guru Pengajar</b>
			</td>
			<td>: <?= $row_guru['nama_guru']; ?></td>
		</tr>
		<tr>
			<td>
				<b>Nama Siswa</b>
			</td>
			<td>: <?= $row['nama_siswa']; ?></td>
		</tr>
		<tr>
			<td>
				<b>Mata Pelajaran</b>
			</td>
			<td>: <?= $row_mapel['nama_mapel']; ?></td>
		</tr>
		<tr>
			<td>
				<b>Jenis Ujian</b>
			</td>
			<td>: <?= $jenis_ujian; ?></td>
		</tr>
	</table>
	<hr>
	<br>
	<table style="width: 100%;">
		<tr>
			<th>NO</th>
			<td><b>SOAL</b></td>
			<td><b>JAWABAN</b></td>
		</tr>
		
		<?php
		$no=1;
		$hasil_ujian_essay=mysqli_query($koneksi,"SELECT * FROM jawaban_essay
			INNER JOIN soal_essay ON jawaban_essay.id_soal=soal_essay.id_soal WHERE jawaban_essay.nis='$nis' AND jawaban_essay.kode_kelas='$kode_kelas' AND jawaban_essay.kode_mapel='$kode_mapel' AND jawaban_essay.jenis_ujian='$jenis_ujian'");
		while ($tampil=mysqli_fetch_array($hasil_ujian_essay)) {
			?>

			<tr>
				<th>
					<b><?= $no++; ?>.</b>
				</th>
				<td>
					<?= $tampil['soal']; ?>
				</td>
				<td>
					<?= $tampil['jawaban']; ?>
				</td>
			</tr>

		<?php } ?>

	</table>

	<!-- <script type="text/javascript">
		window.print();
	</script> -->

</body>
</html>