<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data; 
    }
    
    function validateId($id){
        $nums = "0123456789";
        for($i = 0; i < strlen($id); $i++){
            if(strpos($nums, $id[$i]) == false){
                return false;
            }
        }
        return true;
    }
    

$id = validate($_SESSION['id']);

$ime = mysqli_real_escape_string($conn, $_POST['ime']);
$priimek = mysqli_real_escape_string($conn, $_POST['priimek']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$geslo = mysqli_real_escape_string($conn,$_POST['geslo']);
$hash = password_hash($geslo, PASSWORD_DEFAULT);
$checkNameSql = "SELECT email from users where email = '$email'";
$result = mysqli_query($conn, $checkNameSql);
if(mysqli_num_rows($result) > 0){
    header("Location: ../racuni-dodaj.php?error=Email je že uporabljen");
    exit();
}


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