<?php
include "backend/db_conn.php";
session_start();

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/oprema_style.css" rel="stylesheet" type="text/css" >
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <title>Dodaj opremo</title>
</head>
<body>
    
     <div class="meni"> 
        <img src="img/ikona.png" class="ikona" onclick="addClick()">
        <a href="home.php" class="nazaj"><i class="fas fa-angle-double-left"></i> Nazaj</a>
        <a href="zgodovina-sposoj.php" class="zgodovina">Zgodovina</a>
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
    
    
    
    
    <a href="home.php" style="position: absolute; top: 10px; left: 10px;">Nazaj </a>
    <div class = "form">
    <form action="backend/upload-oprema.php" method="POST" enctype="multipart/form-data">
        <h1 id="dodaj_napravo">Dodaj napravo</h1>
        <input name = "ime" type="text" placeholder ="Ime opreme">
        
        <select name="category" class="category">
            <?php
            $oprema = "SELECT * FROM category";
            $oprema_rezultat = mysqli_query($conn, $oprema);
            while($row = mysqli_fetch_array($oprema_rezultat)){        
                echo "<option name = 'category' id=".$row['category_id']. "  value=".$row['category_id']." onclick='test(this)'>".$row['name']." </option>";
            }
            ?>
        </select>
        <input id=file_upload type="file" name="image">
        
        <button class=button type="submit" name="upload"><i class="fas fa-upload"></i> Naloži</button>
    </form>

        <form action="backend/dodaj-kategorijo.php" method="POST">  
        <h1 id="dodaj_kategorijo">Dodaj kategorijo</h1>
        <input id="ime_kategorije" type="text" name ="ime_kategorije" placeholder="Ime kategorije" >
        <button id=dodaj_kat type="input"> <i class="fas fa-plus"></i></button>
        </form>
        </div>
<script>
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
    
    
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
    echo "no";
}

?>