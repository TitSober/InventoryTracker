<?php
session_start();
include "backend/db_conn.php";

if(isset($_SESSION['id'])){
    if(time()-$_SESSION["time"] >1200)   
    { 
        header("Location:backend/logout.php");
        exit(); 
    } 
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM oprema order by category_id;"; 
    $result = mysqli_query($conn,$sql);

    $category = "SELECT * FROM category";
    $category_result = mysqli_query($conn, $category);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/home_style.css" rel="stylesheet" type="text/css">
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    

    <title>Home</title>
</head>
<body>
    <div class="link-group">
        <a href="backend/logout.php">Logout</a>
        <a href="dodaj-opremo.php">Dodaj opremo</a>
        <a href="zgodovina-sposoj.php">Zgodovina</a>
        <a href="profil.php">Profil</a>
    </div>
    <div class="grid-container">

    <div class="grid-item" id="category-container">
        <a href="home.php" class = "category">Počisti kategorije</a>
        <br>

        
         <?php
         while($row = mysqli_fetch_array($category_result)){
             echo "<a class='category' href='home.php?category=".$row['category_id']."'>".$row['name']."</a>";
             echo "<br>";
            
         }
         ?>   
    </div> 
    <div class="grid-item " id="oprema-container">
        <form action="backend/add-to-db.php" method= "POST">
        <label for="edate">Datum sposoje</label>
        <input type="date" name="edate" >
        <br>
        <label for="return-date"> Datum vrnitve</label>
        <input type="date" name="return-date" >
        <br>
        <button type="submit">Potrdi</button>

         <?php
         if(isset($_GET['category'])){
            $oprema = "SELECT * FROM oprema where category_id = ".$_GET['category'];
            $oprema_rezultat = mysqli_query($conn, $oprema);
            while($row = mysqli_fetch_array($oprema_rezultat)){
                if($row['is_taken']){
                    echo "<div class='oprema-package'>";
                    echo "<input class='btn' name=".$row['oprema_id']." type='checkbox' value=".$row['oprema_id']." disabled> ";
                    echo "<label for=".$row['oprema_id']." class = 'oprema disabled'>".$row['ime_opreme']."</label>";
                    echo "<img src = img/".$row['image']." class ='image'>";
                    echo "</div>";
                }else{
                    echo "<div class='oprema-package'>";
                    echo "<input class='btn' name=".$row['oprema_id']." type='checkbox' value=".$row['oprema_id']."> ";
                    echo "<label for=".$row['oprema_id']." class = 'oprema'>".$row['ime_opreme']."</label>";
                    echo "<img src = img/".$row['image']." class ='image'>";
                    echo "</div>";
                }
            }

            }else{
                $oprema = "SELECT * FROM oprema ";
                $oprema_rezultat = mysqli_query($conn, $oprema);
                while($row = mysqli_fetch_array($oprema_rezultat)){
                    if($row['is_taken']){
                        echo "<div class='oprema-package'>";
                        echo "<input class='btn' name=".$row['oprema_id']." type='checkbox' value=".$row['oprema_id']." disabled> ";
                        echo "<label for=".$row['oprema_id']." class = 'oprema disabled'>".$row['ime_opreme']."</label>";
                        echo "<img src = img/".$row['image']." class ='image'>";
                        echo "</div>";
                    }else{
                        echo "<div class='oprema-package'>";
                        echo "<input class='btn' name=".$row['oprema_id']." type='checkbox' value=".$row['oprema_id']."> ";
                        echo "<label for=".$row['oprema_id']." class = 'oprema'>".$row['ime_opreme']."</label>";
                        echo "<img src = img/".$row['image']." class ='image'>";
                        echo "</div>";
                    }
                    
                    

            }
         }
         ?>

        </form>
    </div>
    </div>
<script>
    

</script>
</body>
</html>
<?php
}else{
    header("Location: index.php?at home");
    exit();
}

?>