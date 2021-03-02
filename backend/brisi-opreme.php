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

    function validateId($id){
        $nums = "0123456789";
        for($i = 0; i < strlen($id); $i++){
            if(strpos($nums, $id[$i]) == false){
                return false;
            }
        }
        return true;
    }

    if(isset($_POST['oprema_id']) && !empty($_POST['oprema_id'])){
        $id = validate($_POST['oprema_id']);
        if(validateId($id) == false){
                header("Location: ../home.php?error=Values wrong!");
                exit();
        }
        $sql = "DELETE from oprema where oprema_id = ".$id;
        $result = mysqli_query($conn, $sql);
        
        if($result){
           
            header("Location: ../upravljanje-opreme.php?success=Izbrisano");
            exit();
            
            
        }else{
            echo mysqli_error($conn);
        }

    }else{
        echo $_POST['oprema_id'];
        //header("Location: ../upravljanje-opreme.php?error=Napaka pri pošiljanju");
        //exit();
    }

}else{
    header("Location: logout.php");
    exit();
}
?>