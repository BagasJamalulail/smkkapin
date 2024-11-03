<?php 
include'../koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print data Siswa</title>
	<style type="text/css">
		.container{
			margin: auto;
			width: 210mm;
		}
		table{
			width: 100%;
			border-collapse: collapse;
			border: 1px solid black;
		}
		tr,td{
			border-collapse: collapse;
			border: 1px solid black;
			padding: 5px;
		}	
	</style>
</head>
<body>

	<div class="container">
		<h2>DATA SISWA</h2>
		<table>
			<tr>
				<td><b>NO</b></td>
				<td><b>NIS</b></td>
				<td><b>NAMA</b></td>
				<td><b>JENIS KELAMIN</b></td>
				<td><b>NO TELP</b></td>
				<td><b>ALAMAT</b></td>
			</tr>

			<?php
			$no=1;
			$data_siswa = mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY nama_siswa");
			while ($tampil = mysqli_fetch_array($data_siswa)) {
				?>
				<tr>
					<td><?php echo $no++; ?>.</td>
					<td><?php echo $tampil['nis']; ?></td>
					<td><?php echo $tampil['nama_siswa']; ?></td>
					<td><?php echo $tampil['jk']; ?></td>
					<td><?php echo $tampil['no_telp']; ?></td>
					<td><?php echo $tampil['alamat']; ?></td>
				</tr>
			<?php } ?>
		</table>
	</div>

</body>
<!-- <script type="text/javascript">
	window.print();
</script> -->
</html>