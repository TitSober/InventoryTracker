<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id']) ){
$id = $_SESSION['id'];
/*
$oprema_sql = "SELECT * from oprema where ime_opreme = '$oprema_name'";
$oprema_result = mysqli_query($conn, $oprema_sql);*/
$entry_date = mysqli_real_escape_string($conn,$_POST['edate']);
$return_date = mysqli_real_escape_string($conn,$_POST['return-date']);
//naredi da se spremeni taken bool v opremi
//var_dump($_POST);

//value deluje drugače tako da ni treba validatat id
function validateId($id){
    $nums = "0123456789";
    for($i = 0; i < strlen($id); $i++){
        if(strpos($nums, $id[$i]) == false){
            return false;
        }
    }
    return true;
}



if($_POST['return-date'] < $_POST['edate'] ) {

    header("Location: ../home.php?error=Vnesi veljaven datum");
    exit();
}else if(empty($_POST['edate']) || empty($_POST['return-date'])){
    header("Location: ../home.php?error= Vnesi vse parametre");
    exit();
}else{
    


    $count_sql = "SELECT oprema_id from oprema";
    $count_result = mysqli_query($conn, $count_sql);
    $count_array = array();
    while($row = mysqli_fetch_array($count_result)){
        array_push($count_array,$row['oprema_id']);
    }
    
    
    for($i = 1; $i< max($count_array)+1; $i++){
        if(isset($_POST[strval($i)])){
            
        
            $cur_id = $_POST[strval($i)];
            $checkIfTaken = "Select is_taken from oprema where oprema_id =".$cur_id;
            $resultTaken = mysqli_query($conn, $checkIfTaken);
            if($resultTaken){
                while($row = mysqli_fetch_array($resultTaken)){
                    if(!$row['is_taken']){
                        $sql = "INSERT INTO sposoja (user_id, oprema_id, datum_sposoje,datum_vrnitve) values ('$id','$cur_id','$entry_date','$return_date');";
                        $result = mysqli_query($conn, $sql);
                        $update_oprema = "UPDATE oprema SET is_taken = 1 Where oprema_id = '$cur_id'";
                        $result_update = mysqli_query($conn, $update_oprema);
                    }else{
                        header("Location: ../home.php?error= Naprava je zasedena");
                        exit();
                    }
                }

            }

            
            if(!$result && !$result_update && !$resultTaken){
                header("Location: ../home.php?error= something has gone bananas");
                exit();
            }
            

        }
    }
    
    header("Location: ../home.php?success=Sposoja je bila uspešna");
    exit();
    
}






/*
if($_POST['return-date'] < $_POST['edate'] ) {

    header("Location: home.php?error=Vnesi veljaven datum");
    exit();
}else if(empty($_POST['edate']) || empty($_POST['return-date'])){
    header("Location: ../home.php?error= Vnesi vse parametre");
    exit();
}else{
    $sql = "INSERT INTO sposoja (user_id, oprema_id, datum_sposoje,datum_vrnitve) values ('$id','$oprema_id','$entry_date','$return_date');";
    $result = mysqli_query($conn, $sql);
    $update_oprema = "UPDATE oprema SET is_taken = 1 Where oprema_id = '$oprema_id'";
    $result_update = mysqli_query($conn, $update_oprema);
    if($result && $result_update){
        header("Location: ../home.php?success=Sposoja je bila uspešna :)");
        exit();
    }else{
        header("Location: ../home.php?err= something has gone bananas");
        exit();
        /*echo $update_oprema;
        echo " <br>";
        echo mysqli_error($conn);
        
    }
}
*/



}else{
    header("Location: ../index.php");
    exit();
}

?>