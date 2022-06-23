<?php
include 'koneksi.php';
$nama    = $_POST['nama'];
$latitude  = $_POST['latitude'];
$longitude  = $_POST['longitude'];
$tgl_kejadian        = date("Y-m-d");

//pembuatan syntax SQL
if ($nama != '' && $latitude != '' && $longitude != '') {
	// code...
	$sql = mysqli_query($con, "INSERT INTO studio(nama,latitude,longitude,tgl_kejadian,verifikasi)
    VALUES('$nama','$latitude','$longitude','$tgl_kejadian','n')");
}
if ($sql) {
	// code...
	echo "berhasil";
} else {
	echo "gagal";
}
mysqli_close($con);
