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
    <script src="https://kit.fontawesome.com/ef06bd2c19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/profil_style.css" rel="stylesheet" type="text/css">
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    
    
    <title>Profil</title>
</head>
<body onload="loadMessage()">
    
        <div class="meni"> 
        <img src="img/ikona.png" class="ikona" onclick="addClick()">
        <a href="home.php" class="nazaj"><i class="fas fa-angle-double-left"></i> Nazaj</a>
        <a href="home.php" class="zgodovina">Zgodovina</a>
        <!--<a href="home.php" class="profil">Profil</a>-->
        <div class="dropdown">
          <span>Profil <i class="fas fa-caret-right"></i></span>
            <div class="dropdown-content">
                <a href="home.php" class="profil">Profil</a>
                <a href="home.php" class="profil">Odjava </a>
            </div>
        </div>
        <a href="home.php" class="izposoja">Izposoja</a>
        <a href="https://www.facebook.com/tvscnm/" target="_blank" class=fb><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/scnm.tv/" target="_blank" class=ig><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/user/SestgScnm" target="_blank" class=yt><i class="fab fa-youtube"></i></a>
        
    </div>
    

    
    <div class="grid-container" >
    <div class ="grid-item">
    <?php
    $nameSql = "Select ime, priimek, email from users where id_user = ".$_SESSION['id'];
    $result = mysqli_query($conn, $nameSql);
    if($result){
        $row = mysqli_fetch_array($result);
        echo "<p id = 'ime_priimek'>".$row['ime'].' '.$row['priimek']."</p>";
        echo "<p id= 'email_1'>".$row['email']."</p>";
    }else{
        echo mysqli_error($conn);
    }
    
    ?>
    <div id="geslo"><p>Geslo</p></div>
    <form action="backend/spremeni-email.php" method="POST" onSubmit="if(!confirm('Ali je vse izpolnjeno pravilno')){return false;}">   
    <input class="vnosi" type="email" name="email" placeholder="Spremeni email" required>
    <input class="vnosi" type="password" name="pass" placeholder="Vnesi geslo za potrditev" required>
    <input class="potrdi" type="submit"  value="Spremeni">

    </form>

    <form action="backend/spremeni-geslo.php" method="POST" onSubmit="if(!confirm('Ali je vse izpolnjeno pravilno')){return false;}">
    <div id="email"><p>Email</p></div>
    <input class="vnosi" type="password" name="repass" placeholder="Vnesi trenutno geslo" required>
    <input class="vnosi" type="password" name="pass" placeholder="Vnesi novo geslo " required>
    <input class="vnosi" type="password" name="repass" placeholder="Ponovi novo geslo " required>
    <input class="potrdi" type="submit"  value="Spremeni">
    </form>

    <img id="profile" src="" alt="profil">
    
    </div>
    <div class ="grid-item" id="sposoje">
        <table>
        <th>Oprema</th>
        <th>Datum izposoje</th>
        <th>Datum vrnitve</th>
        <?php
        $id = $_SESSION['id'];
        $sql = "SELECT id_sposoje, sp.oprema_id, datum_sposoje, datum_vrnitve, je_vrnjeno, ime_opreme from sposoja as sp left join oprema as op on op.oprema_id = sp.oprema_id where user_id = '$id' order by id_sposoje DESC ";
        $result = mysqli_query($conn, $sql);
        $count = 0;
        while($row = mysqli_fetch_array($result)){
            if($row['je_vrnjeno']){
                $count++;
                /*$text = str_replace("_"," ",$row['ime_opreme']);
                echo "<tr>";
                echo "<th class ='vrnjeno'>".$text."</th>";
                echo "<th class ='vrnjeno'>".$row['datum_sposoje']."</th>";
                echo "<th class ='vrnjeno'>".$row['datum_vrnitve']."</th>";*/
            //echo "<th class ='vrnjeno'><form action = 'vrni-opremo.php' method = 'POST'><input type='hidden' name = 'oprema_id' value=".$row['oprema_id']."> <input type='submit' name='vrni' placeholder='Vrni' ></form></th>";
            echo "</tr>";
            }else{
                $text = str_replace("_"," ",$row['ime_opreme']);
                echo "<tr>";
                echo "<td class='ime_opreme'style='width:35%'>".$text."</td>";
                echo "<td class='datum' style='width:35%'>".$row['datum_sposoje']."</td>";
                echo "<td class='datum' style='width:40%'>".$row['datum_vrnitve']."</td>";
                echo "<td ><form action = 'backend/vrni-opremo.php' method = 'POST'><input type='hidden' name = 'oprema_id' value=".$row['oprema_id']."><input type='hidden' name = 'id_sposoje' value=".$row['id_sposoje']."> 
                <button type='submit' name='vrni' value='Test' id='vrni'><i class='fas fa-undo'></i></button></form></td>";
                echo "</tr>";
            }
        }
        if(mysqli_num_rows($result) == $count){
            echo "<tr ><td><img src='img/ni-sposoj.png' id='slika'></td></tr>";
        }
        
        ?>
        </table>
    </div>
    </div>
    <script>
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


    let profiles = ['user_00.png', 'user_01.png', 'user_02.png', 'user_03.png', 'user_04.png', 'user_05.png', 'user_06.png','user_07.png','user_08.png','user_09.png','user_10.png','user_11.png'];
    let profile = document.getElementById("profile").src = "img/profile/"+ profiles[Math.floor(Math.random() * 11)];
    function loadMessage(){

    <?php

    if(isset($_GET['error'])){
        echo "alert('".$_GET['error']."'); ";
    }else if(isset($_GET['success'])){
        echo "alert('".$_GET['success']."'); ";
    }
    
    ?>
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