<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id'])){
$id = $_SESSION['id'];
$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$email = $_POST['email'];
$geslo = $_POST['geslo'];
$hash = password_hash($geslo, PASSWORD_DEFAULT);
if(empty($ime)){

        header("Location: ../racuni-dodaj.php?error=oh no shit went sideways");
        exit();


}else{
    $sql = "INSERT INTO users (ime, priimek, email, password) VALUES ('$ime','$priimek','$email','$hash')";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: ../racuni-dodaj.php?success=yaaaay");
        exit();
    }else{
        
        header("Location: ../racuni-dodaj.php?error=oh no shit went sideways");
        exit();
    }

}

}else{
    header("Location: ../index.php");
    exit();
}

?>