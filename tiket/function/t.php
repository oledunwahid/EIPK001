
<?php
$host = "localhost"; // server
$user = "root"; // username
$pass = ""; // password
$database = "emp"; // nama database

$koneksi = mysqli_connect($host, $user, $pass, $database); // menggunakan mysqli_connect

if(mysqli_connect_error()){ // mengecek apakah koneksi database error
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error(); // pesan ketika koneksi database error
}
?>




<?php 

$id_tiket ='IT202311271748041';

$sql = mysqli_query($koneksi, "SELECT * FROM ticketing WHERE id_tiket = '$id_tiket'");
$data = mysqli_fetch_array($sql);

$lampiran1 = $data['lampiran1'];



unlink("../file/it/$lampiran1");

?>