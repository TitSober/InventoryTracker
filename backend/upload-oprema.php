<?php
session_start();
include "db_conn.php";
if(isset($_SESSION['id'] )){



   if(!empty($_POST['ime']) && !empty($_POST['category']) && !empty($_FILES['image']) ){
        $category = mysqli_real_escape_string($conn,$_POST['category']);
        $name = mysqli_real_escape_string($conn,str_replace(" ","_",$_POST['ime']));
        $target = "../img/oprema/". basename($_FILES['image']['name']);
        $image = mysqli_real_escape_string($conn,$_FILES['image']['name']);
        if(empty($image)){
            $sql = "INSERT INTO oprema ( ime_opreme, category_id) values ('$name','$category')";
            $result = mysqli_query($conn, $sql);
            header("Location: ../dodaj-opremo.php?dodalodefault=1");
            exit();
        }else{
            $sql = "INSERT INTO oprema ( ime_opreme, category_id, image) values ('$name','$category','$image')";
            $result = mysqli_query($conn, $sql);
        }


        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            header("Location: ../dodaj-opremo.php?message=Files uploaded succesfully!");

        }else{
            header("Location: ../dodaj-opremo.php?error=Files didn't upload! Something went or no files selected");
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