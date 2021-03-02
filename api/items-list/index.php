<?php
include "../../backend/db_conn.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$response = array();
$i = 0;
$sql = "SELECT * from oprema";
$result = mysqli_query($conn, $sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        $response[$i]['oprema_id'] = $row['oprema_id'];
        $response[$i]['oprema_ime'] = $row['ime_opreme'];
        $response[$i]['category_id'] = $row['category_id'];
        $response[$i]['taken_status'] = $row['is_taken'];
        $response[$i]['image'] = $row['image'];
        
        
        $i++;
    }
    echo json_encode($response,JSON_PRETTY_PRINT);
}else{
    echo "shit";
}



?>