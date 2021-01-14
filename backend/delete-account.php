<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id']) ){
$id = $_POST['id_user'];
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