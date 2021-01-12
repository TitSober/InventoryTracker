<?php
include "db_conn.php";
session_start();

if(isset($_POST['uname']) && isset($_POST['pass'] )){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }
    
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['pass']);
    
    
    if (empty($uname)){
        header("Location: ../index.php?error=User Name is Required");
        exit();
    }else if(empty($pass)){
        header("Location: ../index.php?error=Password is required");
        exit();
    
    }else{

        $sql = "SELECT * FROM users WHERE email='$uname'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1){
            $row =  mysqli_fetch_assoc($result);

            if(/*password_verify($pass,*/$row['password'] === $pass/*)*/){
                $_SESSION['id'] = $row['id_user'];
                $_SESSION['username'] = $row['email'];
                $_SESSION['name'] = $row['ime'];
                $_SESSION['time'] = time();
                header("Location: ../home.php");
                //header($name);
                exit();
            }else{
                header("Location: ../index.php?error=Incorect Username or password!");
            exit();
            }

        }else{
            header("Location: ../index.php?error=Incorect Username or password!");
            exit();
        }
    }
   /* echo $uname;
    echo "<br>";
    echo $pass;*/
}else{
    header("Location : ../index.php?asd=asd");
    exit();
}

?>