<?php
session_start();
include "db_conn.php";
if(isset($_SESSION['id'])){
    

    $category = $_POST['category'];
    $name = str_replace(" ","_",$_POST['ime']);
    $target = "../img/". basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
    $sql = "INSERT INTO oprema ( ime_opreme, category_id, image) values ('$name','$category','$image')";
    $result = mysqli_query($conn, $sql);

    if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
        header("Location: ../dodaj-opremo.php?message=Files uploaded succesfully!");
        
    }else{
        header("Location: ../dodaj-opremo.php?error=Files didn't upload! Something went wrong");
        exit();
    }

}else{
    header("Location: logout.php");
    exit();
}

?>