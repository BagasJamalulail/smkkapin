<?php 

include'../koneksi.php';

$id_materi = mysqli_real_escape_string($koneksi, $_GET['id_materi']);

$data = mysqli_query($koneksi,"SELECT * FROM materi WHERE id_materi='$id_materi'");
while($d = mysqli_fetch_array($data)){

	$lampiran = $d['file'];

// The location of the PDF file 
// on the server 
	$filename = "materi/$lampiran"; 

// Header content type 
	header("Content-type: application/pdf"); 

	header("Content-Length: " . filesize($filename)); 

// Send the file to the browser. 
	readfile($filename); 

}
?>