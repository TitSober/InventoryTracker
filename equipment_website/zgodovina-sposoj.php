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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="css/history_style.css" rel="stylesheet" type="text/css">
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/ef06bd2c19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css">
    <title>Zgodovina</title>
</head>
<body>
    <div id="top">
        
    <div class="meni"> 
        <img src="img/ikona.png" class="ikona" onclick="addClick()">
        <a href="home.php" class="nazaj"><i class="fas fa-angle-double-left"></i> Nazaj</a>
        <a href="home.php" class="zgodovina">Zgodovina</a>
        <!--<a href="home.php" class="profil">Profil</a>-->
        <div class="dropdown">
          <span>Profil <i class="fas fa-caret-right"></i></span>
            <div class="dropdown-content">
                <a href="home.php" class="profil">Profil</a>
                <a href="home.php" class="logout">Odjava </a>
            </div>
        </div>
        <a href="home.php" class="izposoja">Izposoja</a>
        <a href="https://www.facebook.com/tvscnm/" target="_blank" class=fb><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/scnm.tv/" target="_blank" class=ig><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/user/SestgScnm" target="_blank" class=yt><i class="fab fa-youtube"></i></a>
        
    </div>
        
    <div class="link-group">    
        <!--<a href="backend/logout.php">Logout</a>-->
        <!--<a href="dodaj-opremo.php">Dodaj opremo</a>-->
        <!--<a href="profil.php">Profil</a>-->
    </div>
    </div>
    <div class="scrollable" id="zgodovina">
    <table>
    <th>Ime</th>
    <th>Priimek</th>
    <th>Oprema</th>
    <th>Datum izposoje</th>
    <th>Datum vrnitve</th>
    <?php
    $sql = "SELECT ime, priimek, ime_opreme, datum_sposoje, datum_vrnitve FROM users as us left join sposoja sp ON us.id_user = sp.user_id right JOIN oprema as op on sp.oprema_id = op.oprema_id";
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            if(empty($row['ime'])){
                echo "<tr>";
                echo "</tr>";
            }else{
                $name = $row['ime'];
                $priimek = $row['priimek'];
                $ime_opreme = $row['ime_opreme'];
                $datum_sposoje = $row['datum_sposoje'];
                $datum_vrnitve = $row['datum_vrnitve'];
                
                echo "<tr>";
                echo "<td>".$name."</td>";
                echo "<td>".$priimek."</td>";
                echo "<td>".$ime_opreme."</td>";
                echo "<td>".$datum_sposoje."</td>";
                echo "<td>".$datum_vrnitve."</td>";
                echo "</tr>";
            }
        }
    }else{
        echo mysqli_error($conn);
    }
    
    ?>
    
    
    </table>
    
    </div>

    <script>

    //pradvaja avocado from mexico

    let click = 0;
    function checkIfClick(){
        if(click>9){
            let audio = new Audio('img/avocado.mp3');
            audio.play();
            click = 0;
        }
    }
    
    function addClick(){
        click += 1;
        checkIfClick();
        
    }
    
    
    </script>
</body>
</html>
<?php
}else{
    header("Location: backend/logout.php");
    exit();
}

?>