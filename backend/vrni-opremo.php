<?php
session_start();
include "db_conn.php";
if(isset($_SESSION['id'])){
    if(isset($_POST['oprema_id'])){
        function validateId($id){
            $nums = "0123456789";
            for($i = 0; i < strlen($id); $i++){
                if(strpos($nums, $id[$i]) == false){
                    return false;
                }
            }
            return true;
        }

        

        $opremaId = mysqli_real_escape_string($conn,$_POST['oprema_id']);
        $idSposoje = mysqli_real_escape_string($conn,$_POST['id_sposoje']);
        $sql = "UPDATE oprema SET is_taken = 0 where oprema_id =".$opremaId;
        $result = mysqli_query($conn, $sql);
        if($result){
            $sposoja_sql = "UPDATE sposoja SET je_vrnjeno = 1 WHERE id_sposoje = ".$idSposoje;
            $result_sposoja = mysqli_query($conn,$sposoja_sql);
            if($result_sposoja){
                header("Location: ../profil.php?success=vrnjeno");
                exit();
               
            }else{
                header("Location: ../profil.php?error=how??");
                exit();
            }
        }else{
            header("Location: ../profil.php?error=neki ne štima");
            exit();
        }
    }else{
        header("Location: ../profil.php?error=neki ne štima but how");
        exit();
    }
}else{
    header("Location: logout.php");
    exit();
}


?>