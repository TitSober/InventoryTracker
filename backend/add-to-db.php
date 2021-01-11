<?php
include "db_conn.php";
session_start();
if(isset($_SESSION['id']) && $_POST['dropdown'] ){
$id = $_SESSION['id'];
$oprema_name = $_POST['dropdown'];// ni id
$oprema_sql = "SELECT * from oprema where ime_opreme = '$oprema_name'";
$oprema_result = mysqli_query($conn, $oprema_sql);
$entry_date = $_POST['edate'];
$return_date = $_POST['return-date'];
//naredi da se spremeni taken bool v opremi

while($row = mysqli_fetch_array($oprema_result)){
    $oprema_id = $row['oprema_id'];
}



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
        echo mysqli_error($conn);*/
        
    }
}




}else{
    header("Location: ../index.php");
    exit();
}

?>