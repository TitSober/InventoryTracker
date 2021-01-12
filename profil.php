<?php
session_start();
include "backend/db_conn.php";

if(isset($_SESSION['id'])){
    if(time()-$_SESSION["time"] >1200)   
    { 
        header("Location:backend/logout.php");
        exit(); 
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/profil_style.css" rel="stylesheet" type="text/css">
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <!--<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">-->
    
    <title>Profil</title>
</head>
<body>
<div class="link-group">
        <a href="backend/logout.php">Logout</a>
        <a href="dodaj-opremo.php">Dodaj opremo</a>
        <a href="zgodovina-sposoj.php">Zgodovina</a>
        <a href="home.php">Nazaj</a>
    </div>
    <div class="grid-container" >
    <div class ="grid-item">

    </div>
    <div class ="grid-item">
        <table>
        <?php
        $id = $_SESSION['id'];
        $sql = "SELECT id_sposoje, sp.oprema_id, datum_sposoje, datum_vrnitve, je_vrnjeno, ime_opreme from sposoja as sp left join oprema as op on op.oprema_id = sp.oprema_id where user_id = '$id' order by id_sposoje DESC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            if($row['je_vrnjeno']){
                $text = str_replace("_"," ",$row['ime_opreme']);
                echo "<tr>";
                echo "<th class ='vrnjeno'>".$text."</th>";
                echo "<th class ='vrnjeno'>".$row['datum_sposoje']."</th>";
                echo "<th class ='vrnjeno'>".$row['datum_vrnitve']."</th>";
            //echo "<th class ='vrnjeno'><form action = 'vrni-opremo.php' method = 'POST'><input type='hidden' name = 'oprema_id' value=".$row['oprema_id']."> <input type='submit' name='vrni' placeholder='Vrni' ></form></th>";
            echo "</tr>";
            }else{
                $text = str_replace("_"," ",$row['ime_opreme']);
                echo "<tr>";
                echo "<th >".$text."</th>";
                echo "<th >".$row['datum_sposoje']."</th>";
                echo "<th >".$row['datum_vrnitve']."</th>";
                echo "<th ><form action = 'backend/vrni-opremo.php' method = 'POST'><input type='hidden' name = 'oprema_id' value=".$row['oprema_id']."><input type='hidden' name = 'id_sposoje' value=".$row['id_sposoje']."> <input type='submit' name='vrni' value='Vrni' ></form></th>";
                echo "</tr>";
            }
        }
        
        ?>
        </table>
    </div>
    </div>
    
    
</body>
</html>
<?php

}else{
    header("Location: backend/logout.php");
    exit();
}
?>