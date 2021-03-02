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

    $geslo = mysqli_real_escape_string($conn,validate($_POST['geslo']));
    $sql = "SELECT password from users where id_user =".$_SESSION['id'];
    $result = mysqli_query($conn, $sql);

    if($result){
        while($row = mysqli_fetch_array($result)){
            $hashed = $row['password'];
        }
    }else{
        
        //echo $sql;
        header("Location: ../profil.php?error=sql failed!");
        exit();
    }
    
    if(password_verify($geslo,$hashed)){
        
    }else{
        //header("Location: ../profil.php?error=Napačno geslo!");
        //exit();
        echo password_verify($geslo,$hashed);
        echo $hashed;
        echo $geslo;

    }

    if($_POST['pass'] == $_POST['repass'] ){
        $hash = password_hash(validate($_POST['pass']),PASSWORD_DEFAULT);
        $id = $_SESSION['id'];
        $sql = "UPDATE users SET password = '$hash' where id_user = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: ../profil.php?success=yes");
            exit();
        }else{
            echo mysqli_error($conn);
        }
    }else{
        header("Location: ../profil.php?error=passwords do not match");
        exit();
    }
}else{
    header("Location: logout.php");
    exit();
}

