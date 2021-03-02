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
    if(isset($_POST['oprema_id']) && !empty($_POST['oprema_id'])){
        $id = mysqli_real_escape_string($conn,validate($_POST['oprema_id']));
        $sql = "UPDATE sposoja set je_vrnjeno = 1 WHERE oprema_id = ".$id;
        $result = mysqli_query($conn, $sql);
        
        if($result){
            $sql = "UPDATE oprema SET is_taken = 0 WHERE oprema_id = ".$id;
            $result = mysqli_query($conn, $sql); 
            if($result){
                header("Location: ../upravljanje-opreme.php?success=Vrnjeno");
                exit();
            }
            
        }else{
            echo mysqli_error($conn);
        }

    }else{
        //echo $_POST['oprema_id'];
        header("Location: ../upravljanje-opreme.php?error=Napaka pri pošiljanju");
        exit();
    }

}else{
    header("Location: logout.php");
    exit();
}
?>