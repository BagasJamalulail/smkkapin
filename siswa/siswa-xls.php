<?php 
include'../koneksi.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Peserta.xls");
?>
<table class="table table-bordered" id="example" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>No</th>
			<th>KODE AKSES</th>
			<th>Nama</th>
			<th>Jk</th>
			<th>No Telp</th>
			<th>Alamat</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>No</th>
			<th>KODE AKSES</th>
			<th>Nama</th>
			<th>Jk</th>
			<th>No Telp</th>
			<th>Alamat</th>
		</tr>
	</tfoot>
	<tbody>
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
	</tbody>
</table>