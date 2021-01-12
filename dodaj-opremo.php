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
    <a href="home.php" style="position: absolute; top: 10px; left: 10px;">Nazaj </a>
    <div class = "form">
    <form action="backend/upload-oprema.php" method="POST" enctype="multipart/form-data">
        <h1>Dodaj napravo</h1>
        <input name = "ime" type="text" placeholder ="Ime opreme">
        
        <select name="category" id="category">
            <?php
            $oprema = "SELECT * FROM category";
            $oprema_rezultat = mysqli_query($conn, $oprema);
            while($row = mysqli_fetch_array($oprema_rezultat)){        
                echo "<option name = 'category' id=".$row['category_id']. "  value=".$row['category_id']." onclick='test(this)'>".$row['name']." </option>";
            }
            ?>
        </select>
        <input type="file" name="image" >
        <input type="submit" name="upload" value="Naloži">
        </form>

        <form action="backend/dodaj-kategorijo.php" method="POST">  
        <h1>Dodaj kategorijo</h1>
        <input type="text" name ="ime_kategorije" placeholder="Ime kategorije" >
        <input type="submit" value="Dodaj kategorijo" ><i class="fas fa-plus"></i>

        </form>
        </div>
<script>
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>
</body>
</html>
<?php

}else{
    echo "no";
}

?>