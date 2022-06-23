<?php
require_once("connection.php");
class JsonDisplayMarker
{
    function getMarkers()
    {
        //buat koneksinya 
        $connection = new Connection();
        $conn = $connection->getConnection();
        //buat responsenya
        $response = array();
        $code = "code";
        $message = "message";
        try {
            //tampilkan semua data dari mysql
            $queryMarker = "select * from studio WHERE verifikasi = 'y'";
            $getData = $conn->query($queryMarker);
            $getData->execute();
            $result = $getData->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $data) {
                array_push(
                    $response,
                    array(
                        'nama' => $data['nama'],
                        'latitude' => $data['latitude'],
                        'longitude' => $data['longitude'],
                        'tgl_kejadian' => $data['tgl_kejadian']
                    )
                );
            }
        } catch (PDOException $e) {
            echo "Failed displaying data" . $e->getMessage();
        }
        //buatkan kondisi jika berhasil atau tidaknya
        if ($queryMarker) {
            echo json_encode(
                array("data" => $response, $code => 1, $message => "Success")
            );
        } else {
            echo json_encode(
                array("data" => $response, $code => 0, $message => "Failed displaying data")
            );
        }
    }
}
$location = new JsonDisplayMarker();
$location->getMarkers();
