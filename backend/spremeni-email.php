<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id']) && isset($_POST['email']) && isset($_POST['pass']) ){
    $id = mysqli_real_escape_string($conn,$_SESSION['id']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,$_POST['pass']);
    $sql = "SELECT * FROM users WHERE id_user = '$id'";
    $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $row =  mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['password'])){
                $update = "UPDATE users SET email = '$email' WHERE id_user = '$id'";
                $UpdateResult = mysqli_query($conn, $update);
                if($UpdateResult){
                    header("Location: ../profil.php?success=Zamenjano");
                    exit();
                }
            }else{
                header("Location: ../profil.php?error=gesla se ne ujemajo");
                exit();
            }
        }else{
            header("Location: ../profil.php?error=what");
            exit();
        }

}else{
    header("Location: logout.php");
    exit();
}