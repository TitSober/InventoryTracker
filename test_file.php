<?php

session_start();
include "backend/db_conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/home_style.css" rel="stylesheet" type="text/css">
    <script src="js/generateItems.js"></script>
    <title>asd</title>
</head>
<body>
<body >
    <div class="link-group">
        <?php
        if($_SESSION['admin']){
            ?>
        <a href="backend/logout.php">Logout</a>
        <a href="dodaj-opremo.php">Dodaj opremo</a>
        <a href="zgodovina-sposoj.php">Zgodovina</a>
        <a href="profil.php">Profil</a>
        <a href="racuni.php">Računi</a>
        <a href="upravljanje-opreme.php">Upravljaj opremo</a>
        <?php
        }else{
        ?>
        <a href="backend/logout.php">Logout</a>
        <a href="zgodovina-sposoj.php">Zgodovina</a>
        <a href="profil.php">Profil</a>
        <?php
        }  
        ?>
    </div>
    <div class="grid-container">

    <div class="grid-item" id="category-container">
        <a href="home.php">Počisti</a>
        <br>

        
         <?php
         for($i = 0; $i < count($categoryIds);$i++){
             echo "<a href='home.php?category=$categoryIds[$i]'>$categoryNames[$i]</a>";
             echo "<br>";
            }
         ?>   
    </div> 




    <div class="grid-item " id="oprema-container">
        <form action="backend/add-to-db.php" method= "POST" onSubmit="if(!confirm('Ali je vse izpolnjeno pravilno')){return false;}">
        <?php
        if(isset($_GET['error'])){
            echo "<p id='error'>".$_GET['error']."</p>";
        }else if(isset($_GET['success'])){
            echo "<p id='success'>".$_GET['success']."</p>";
        }
        
        ?>
        <label for="edate">Datum sposoje</label>
        <input type="date" name="edate" >
        <br>
        <label for="return-date"> Datum vrnitve</label>
        <input type="date" name="return-date" >
        <br>
        <button type="submit">Potrdi</button>
        <div id="container"></div>
         <?php
            //if(isset($_GET['category'])){
                /*$oprema = "SELECT * FROM oprema where category_id = ".$_GET['category'];
                $oprema_rezultat = mysqli_query($conn, $oprema);
                if(mysqli_num_rows($oprema_rezultat)%2 ==0){
                    for($i = 0; $i < mysqli_num_rows($oprema_rezultat)-1; $i= $i+2){
                        if($row['is_taken']){
                            echo "<div class='oprema-package'>";
                            echo "<input class='btn' name=".$row['oprema_id']." type='checkbox' value=".$row['oprema_id']." disabled> ";
                            echo "<label for=".$row['oprema_id']." class = 'oprema disabled'>".str_replace("_"," ",$row['ime_opreme'])."</label>";
                            echo "<img src = img/oprema/".$row['image']." class ='image'>";
                            echo "</div>";
                        }else{
                            echo "<div class='oprema-package'>";
                            echo "<input class='btn' name=".$row['oprema_id']." type='checkbox' value=".$row['oprema_id']."> ";
                            echo "<label for=".$row['oprema_id']." class = 'oprema'>".str_replace("_"," ",$row['ime_opreme'])."</label>";
                            echo "<img src = img/oprema/".$row['image']." class ='image'>";
                            echo "</div>";
                        }*/
               // }
                
                
               // }else{
                    /*$oprema = "SELECT * FROM oprema ";
                    $oprema_rezultat = mysqli_query($conn, $oprema);
                    //if(mysqli_num_rows($oprema_rezultat)%2 ==0){
                           $row = mysqli_fetch_array($oprema_rezultat);/*
                            $category = $row['category_id'];
                            if($row[$i]['is_taken']){
                                
                                echo "<div class='oprema-package' class=".$category.">";
                                echo "<input class='btn'  name=".$row[$i]['oprema_id']." type='checkbox' value=".$row[$i]['oprema_id']." disabled> ";
                                echo "<label for=".$row[$i]['oprema_id']." class = 'oprema disabled'>".str_replace("_"," ",$row[$i]['ime_opreme'])."</label>";
                                echo "<img src = img/oprema/".$row[$i]['image']." class ='image'>";
                                echo "</div>";
                            }else{
                                echo "<div class='oprema-package' class=".$category.">";
                                echo "<input class='btn'  name=".$row[$i]['oprema_id']." type='checkbox' value=".$row[$i]['oprema_id']."> ";
                                echo "<label for=".$row[$i]['oprema_id']." class = 'oprema'>".str_replace("_"," ",$row[$i]['ime_opreme'])."</label>";
                                echo "<img src = img/oprema/".$row[$i]['image']." class ='image'>";
                                echo "</div>";
                            }*/
                            //var_dump($row);
                    //}   
                    
                        
                        

                //}
            //}
        
         ?>

        </form>
    </div>
    </div>
    
</body>
</html>