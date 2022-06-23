<?php
include 'koneksi.php';
$response = array();
$code = "code";
$message = "message";
$query = "select * from studio WHERE verifikasi = 'y'";
$getData = $con->query($query);
$result = $getData->fetch_all(MYSQLI_ASSOC);
foreach ($result as $data) {
    array_push(
        $response,
        array(
            'nama' => $data['nama'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
        )
    );
}

echo json_encode(
    array("data" => $response, $code => 1, $message => "Success")
);
