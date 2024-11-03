<?php 
include'../koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print data guru</title>
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
		<h2>DATA GURU</h2>
		<table>
			<tr>
				<td><b>NO</b></td>
				<td><b>NIP</b></td>
				<td><b>NAMA</b></td>
				<td><b>NO TELP</b></td>
				<td><b>ALAMAT</b></td>
			</tr>

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
				</tr>
			<?php } ?>
		</table>
	</div>

</body>
<script type="text/javascript">
	window.print();
</script>
</html>