<?php
include "backend/db_conn.php";
session_start();

if(isset($_SESSION['id'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/ef06bd2c19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css">
    <link href="css/add_oprema.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <title>Dodaj opremo</title>

</head>
<body>
    <a href="home.php" class="nazaj"><i class="fas fa-angle-double-left"></i> Nazaj</a>
    <form action="backend/upload-oprema.php" method="POST" enctype="multipart/form-data">
        <label class="dodaj" for="ime">Dodaj opremo</label> 
        <input class="oprema" name = "ime" type="text" placeholder ="Ime opreme">
        <select name="category" class="category">
        <?php
        $oprema = "SELECT * FROM category";
        $oprema_rezultat = mysqli_query($conn, $oprema);
        while($row = mysqli_fetch_array($oprema_rezultat)){        
            echo "<option name = 'category' id=".$row['category_id']. "  value=".$row['category_id']." onclick='test(this)'>".$row['name']." </option>";
        }
        ?>
        </select>
        <button class="dodaj_kategorijo" type="button"><i class="fas fa-plus"></i></button>
        <input class="upload" type="file" name="image">
        <button class="submit" type="upload">Naloži</button>
        </form>
<script>
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });
</script>

<video autoplay muted loop id="myVideo">
  <source src="../multi_eq/img/Sequence%2002.mp4" type="video/mp4">
</video>
    
</body>
</html>
<?php

}else{
    echo "no u";
}

?>