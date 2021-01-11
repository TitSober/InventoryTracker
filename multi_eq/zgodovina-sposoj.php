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
    <link href="css/history_style.css" rel="stylesheet" type="text/css">
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"> 
    <title>Zgodovina</title>
</head>
<body>
    <div id="top">
    <div class="link-group">    
        <a href="backend/logout.php">Logout</a>
        <a href="dodaj-opremo.php">Dodaj opremo</a>
        <a href="home.php">Nazaj</a>
        <a href="profil.php">Profil</a>
    </div>
    </div>
    <div class="scrollable" id="zgodovina">
    <ol >
    <?php
    $sql = "SELECT ime, priimek, ime_opreme, datum_sposoje, datum_vrnitve FROM users as us left join sposoja sp ON us.id_user = sp.user_id right JOIN oprema as op on sp.oprema_id = op.oprema_id";
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            $name = $row['ime'];
            $priimek = $row['priimek'];
            $ime_opreme = $row['ime_opreme'];
            $datum_sposoje = $row['datum_sposoje'];
            $datum_vrnitve = $row['datum_vrnitve'];
            
            echo "<li id='data'>'$name' '$priimek' '$ime_opreme' '$datum_sposoje' '$datum_vrnitve' </li>";
        }
    }else{
        echo mysqli_error($conn);
    }
    
    ?>
    
    
    </ol>
    
    </div>

    
</body>
</html>
<?php
}else{
    header("Location: backend/logout.php");
    exit();
}

?>