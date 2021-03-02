<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id']) ){
$id = mysqli_real_escape_string($conn,$_POST['id_user']);
function validateId($id){
    $nums = "0123456789";
    for($i = 0; i < strlen($id); $i++){
        if(strpos($nums, $id[$i]) == false){
            return false;
        }
    }
    return true;
}

$sql = "DELETE FROM users where id_user = ".$id;
$result = mysqli_query($conn, $sql);
if($result){
    header("Location: ../racuni.php?success=yaaaay");
    exit();
}else{
    
    header("Location: ../racuni.php?error=oh no shit went sideways");
    exit();
}



}else{
    header("Location: ../index.php");
    exit();
}

?>