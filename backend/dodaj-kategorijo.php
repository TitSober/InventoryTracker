<?php
session_start();
include "db_conn.php";
if(isset($_SESSION['id'])){
    if(!empty($_POST['ime_kategorije'])){
        $name = $_POST['ime_kategorije'];
        $sql = "INSERT INTO category (name) VALUES ('$name')";
        $result = mysqli_query($conn,$sql);
        if($result){
            header("Location: ../dodaj-opremo.php?success=Kategorija dodana uspešno");
            exit();  
        }else{
            
            echo $sql;
            header("Location: ../dodaj-opremo.php?error=kategorija ni bila dodana");
            exit();
        }
    }

}else{
    header("Location: logout.php");
    exit();
}

?>