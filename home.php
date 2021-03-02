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
    $categoryIds = array();
    $categoryNames = array();
    while($row = mysqli_fetch_array($category_result)){
        array_push($categoryIds,$row['category_id']);
        array_push($categoryNames,$row['name']);
    }
    


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
<body onload="loadMessage()">
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
        
        

         <?php

         
            if(isset($_GET['category'])){
                $oprema = "SELECT * FROM oprema where category_id = ".$_GET['category'];
                $oprema_rezultat = mysqli_query($conn, $oprema);
                while($row = mysqli_fetch_array($oprema_rezultat)){
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
                    }
                }
                }else{
                    $oprema = "SELECT * FROM oprema ";
                    $oprema_rezultat = mysqli_query($conn, $oprema);
                    while($row = mysqli_fetch_array($oprema_rezultat)){
                        $category = $row['category_id'];
                        if($row['is_taken']){
                            
                            echo "<div class='oprema-package' class=".$category.">";
                            echo "<input class='btn'  name=".$row['oprema_id']." type='checkbox' value=".$row['oprema_id']." disabled> ";
                            echo "<label for=".$row['oprema_id']." class = 'oprema disabled'>".str_replace("_"," ",$row['ime_opreme'])."</label>";
                            echo "<img src = img/oprema/".$row['image']." class ='image'>";
                            echo "</div>";
                        }else{
                            echo "<div class='oprema-package' class=".$category.">";
                            echo "<input class='btn'  name=".$row['oprema_id']." type='checkbox' value=".$row['oprema_id']."> ";
                            echo "<label for=".$row['oprema_id']." class = 'oprema'>".str_replace("_"," ",$row['ime_opreme'])."</label>";
                            echo "<img src = img/oprema/".$row['image']." class ='image'>";
                            echo "</div>";
                        }
                        
                        

                }
            }
        
         ?>

        </form>
    </div>
    </div>
<script>
function loadMessage(){

<?php

    if(isset($_GET['error'])){
        echo "alert('".$_GET['error']."'); ";
    }else if(isset($_GET['success'])){
        echo "alert('".$_GET['success']."'); ";
    }
    
    ?>
}
    /*function displayCategory(id){
        document.getElementsByClassName(id).style.visibility = "hidden"; 
    }
    function clearCategory(){
        let categoryIds = [<?php $string = implode(",", $categoryIds); echo $string?>];
        for(let i = 0; i< categoryIds.length; i++){
            document.getElementsByClassName(categoryIds[i]).style.visibility = "visible";
        }
    }*/

</script>
</body>
</html>
<?php
}else{
    header("Location: index.php?at home");
    exit();
}

?>