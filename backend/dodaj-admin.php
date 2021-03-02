<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id'])){
    if(isset($_POST['id_user'])){

        function validateId($id){
            $nums = "0123456789";
            for($i = 0; i < strlen($id); $i++){
                if(strpos($nums, $id[$i]) == false){
                    return false;
                }
            }
            return true;
        }

        $id = mysqli_real_escape_string($conn,$_POST['id_user']);
        

        $sql = "UPDATE users set admin = 1 WHERE id_user = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: ../racuni.php?success=Admin je dodan!");
            exit();
        }else{
            echo mysqli_error($conn);
        }
    }else{
        header("Location: ../racuni.php?error=No POST data!");
        exit();
    }



}else{
    header("Location: logout.php");
    exit();
}