<?php
include "../backend/db_conn.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$response = array();
$i = 0;
$sql = "SELECT id_sposoje, user_id, ime, priimek, sp.oprema_id, ime_opreme, datum_sposoje, datum_vrnitve, je_vrnjeno from sposoja as sp left join users as us on sp.user_id = us.id_user right join oprema as op on sp.oprema_id = op.oprema_id;";
$result = mysqli_query($conn, $sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        $response[$i]['id_sposoje'] = $row['id_sposoje'];
        $response[$i]['user_id'] = $row['user_id'];
        $response[$i]['ime'] = $row['ime'];
        $response[$i]['priimek'] = $row['priimek'];
        $response[$i]['oprema_id'] = $row['oprema_id'];
        $response[$i]['ime_opreme'] = $row['ime_opreme'];
        $response[$i]['datum_sposoje'] = $row['datum_sposoje'];
        $response[$i]['datum_vrnitve'] = $row['datum_vrnitve'];
        $response[$i]['je_vrnjeno'] = $row['je_vrnjeno'];
        
        $i++;
    }
    echo json_encode($response,JSON_PRETTY_PRINT);
}else{
    echo "shit";
}



?>