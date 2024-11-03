<?php 

include'../../koneksi.php';

// untuk hapus data siswa perkelas
if (isset($_GET['siswa'])) {
	if ($_GET['siswa']=="hapus_siswa") {
		$nis = mysqli_real_escape_string($koneksi, $_GET['nis']);
		mysqli_query($koneksi,"DELETE FROM join_kelas WHERE nis='$nis'");
		echo $nis;
		header("location:daftar_siswa.php?pesan=sukses_hapus");
	}		
}

if (isset($_GET['materi'])) {
	if ($_GET['materi']=="hapus") {
		$kode_kelas= mysqli_real_escape_string($koneksi, $_GET['kode_kelas']);
		$id_materi= mysqli_real_escape_string($koneksi, $_GET['id_materi']);
		$pilih = mysqli_query($koneksi,"SELECT * FROM materi WHERE id_materi='$id_materi'");
		while($data = mysqli_fetch_array($pilih)){
			$kode_mapel = $data['kode_mapel'];
			$kode_kelas = $data['kode_kelas'];
			$lampiran =$data['file'];

			unlink("../../kelas/materi/".$lampiran);

			mysqli_query($koneksi,"DELETE FROM materi WHERE id_materi='$id_materi'");

			header("location:materi.php?pesan_hapus=hapus&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel");

		}
	}
}

// hapus ujian
if (isset($_GET['aksi_ujian'])) {
	if ($_GET['aksi_ujian']=="hapus_ujian") {
		$id = mysqli_real_escape_string($koneksi, $_GET['id']);
		$kode_kelas = mysqli_real_escape_string($koneksi, $_GET['kode_kelas']);
		$kode_mapel = mysqli_real_escape_string($koneksi, $_GET['kode_mapel']);
		$jenis_ujian = mysqli_real_escape_string($koneksi, $_GET['jenis_ujian']);
		$data_ujian = mysqli_query($koneksi,"SELECT * FROM mengerjakan WHERE id='$id'");
		mysqli_query($koneksi,"DELETE FROM mengerjakan WHERE id='$id'");
		mysqli_query($koneksi,"DELETE FROM soal_essay WHERE kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
		mysqli_query($koneksi,"DELETE FROM jawaban_essay WHERE kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
		mysqli_query($koneksi,"DELETE FROM nilai_essay WHERE kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
		mysqli_query($koneksi,"DELETE FROM nilai WHERE kode_mapel='$kode_mapel' AND jenis_ujian='$jenis_ujian'");
		mysqli_query($koneksi,"DELETE FROM soal WHERE kode_kelas='$kode_kelas' AND kode_mapel='$kode_mapel'");
		while ($tampil = mysqli_fetch_array($data_ujian)) {
			header("location:jenis_ujian.php?pesan=sukses_hapus&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel");
		}
	}
}

if (isset($_GET['aksi'])) {
	if ($_GET['aksi']=="hapus") {
		$id_soal = mysqli_real_escape_string($koneksi, $_GET['id_soal']);
		$kode_kelas = mysqli_real_escape_string($koneksi, $_GET['kode_kelas']);
		$jenis_ujian = mysqli_real_escape_string($koneksi, $_GET['jenis_ujian']);
		$data_soal = mysqli_query($koneksi,"SELECT * FROM soal WHERE id_soal='$id_soal'");
		mysqli_query($koneksi,"DELETE FROM soal WHERE id_soal='$id_soal'");
		while ($tampil = mysqli_fetch_array($data_soal)) {
			$kode_mapel = $tampil['kode_mapel'];
			$kode_kelas = $tampil['kode_kelas'];
			header("location:buat_soal.php?pesan=sukses&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
		}
	}
}

if (isset($_GET['aksi'])) {
	if ($_GET['aksi']=="hapus_essay") {
		$id_soal = mysqli_real_escape_string($koneksi, $_GET['id_soal']);
		$kode_kelas = mysqli_real_escape_string($koneksi, $_GET['kode_kelas']);
		$jenis_ujian = mysqli_real_escape_string($koneksi, $_GET['jenis_ujian']);
		$data_soal = mysqli_query($koneksi,"SELECT * FROM soal_essay WHERE id_soal='$id_soal'");
		mysqli_query($koneksi,"DELETE FROM soal_essay WHERE id_soal='$id_soal'");
		while ($tampil = mysqli_fetch_array($data_soal)) {
			$kode_mapel = $tampil['kode_mapel'];
			$kode_kelas = $tampil['kode_kelas'];
			if (!empty($tampil['foto'])) {
				$lampiran =$tampil['foto'];
				unlink("../../kelas/img/gambar_soal_essay/".$lampiran);
			}
			header("location:buat_soal.php?pesan=sukses&kode_kelas=$kode_kelas&kode_mapel=$kode_mapel&jenis_ujian=$jenis_ujian");
			
		}
	}
}
?>