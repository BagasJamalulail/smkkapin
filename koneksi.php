<?php 

// PRODUCTION
$koneksi = mysqli_connect("localhost","u736687820_bagasapkuser","Bagasapk01_","u736687820_bagasapk");

// DEVELOPMENT
// $koneksi = mysqli_connect("localhost","root","","ujianonline");

if (mysqli_connect_error()){
	echo "koneksi ke database gagal" .mysqli_connect_error();
}


function query($query) {
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}


function registrasi($data) {
	global $koneksi;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
		alert('Maaf username sudah terdaftar!')
		</script>";
		return false;
	}

	// cek konfimasi password
	if ( $password !== $password2) {
		echo "<script>
		alert('konfirmasi password tidak sesuai!');
		</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan user baru ke database
	mysqli_query($koneksi, "INSERT INTO user VALUES(NULL, '$username', '$password')");
	return mysqli_affected_rows($koneksi);

}

?>