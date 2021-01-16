<?php
session_start();
include "db_conn.php";
if(isset($_SESSION['id'] )){
    if(isset($_POST['oprema_id'])){
        $sql = "UPDATE oprema SET is_taken = 0 where oprema_id =".$_POST['oprema_id'];
        $result = mysqli_query($conn, $sql);
        if($result){
            $sposoja_sql = "UPDATE sposoja SET je_vrnjeno = 1 WHERE id_sposoje = ".$_POST['id_sposoje'];
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