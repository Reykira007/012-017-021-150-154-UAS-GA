<?php
include 'connection.php';

$nama = $_POST['nama'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$tgl_kejadian = date("Y-m-d");

//pembuatan syntax sql
$sql = mysqli_query($con, "INSERT INTO studio(nama,latitude,longitude,tgl_kejadian,verifikasi) 
VALUES('$nama','$latitude','$longitude','$tgl_kejadian', 'n')");

if ($sql) {
	echo json_encode($sql);
}
