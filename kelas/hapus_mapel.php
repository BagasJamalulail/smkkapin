<?php

include'../koneksi.php';

$kode_mapel = mysqli_real_escape_string($koneksi, $_GET['kode_mapel']);

mysqli_query($koneksi,"DELETE FROM mapel WHERE kode_mapel='$kode_mapel'");

echo "<script>window.alert('Success')
window.location='kelas.php'</script>";

?>