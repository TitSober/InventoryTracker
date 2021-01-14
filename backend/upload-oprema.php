<?php
session_start();
include "db_conn.php";
if(isset($_SESSION['id'] )){
    

    
   if(!empty($_POST['ime']) && !empty($_POST['category']) && !empty($_FILES['image']) ){
        $category = $_POST['category'];
        $name = str_replace(" ","_",$_POST['ime']);
        $target = "../img/". basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        $sql = "INSERT INTO oprema ( ime_opreme, category_id, image) values ('$name','$category','$image')";
        $result = mysqli_query($conn, $sql);

        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            header("Location: ../dodaj-opremo.php?message=Files uploaded succesfully!");
            
        }else{
            header("Location: ../dodaj-opremo.php?error=Files didn't upload! Something went ");
            exit();
        }
    }else{
        header("Location: ../dodaj-opremo.php?error=Izpolni vsa polja");
        exit();
        
        }
}else{
    header("Location: logout.php");
    exit();
}

?>