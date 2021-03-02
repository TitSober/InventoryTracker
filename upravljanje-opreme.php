<?php
session_start();
include "backend/db_conn.php";

if(isset($_SESSION['id']) && $_SESSION['admin']){
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="css/upravljaj-opremo_style.css" rel="stylesheet" type="text/css">
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/ef06bd2c19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css">
    <title>Upravljaj opremo</title>
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
                <a href="home.php" class="profil">Odjava </a>
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
    <th>Ime Opreme</th>
    <th>kategorija</th> 
    <th>Prisilno vrni opremo</th>
    <th>izbriši opremo</th>
    
    <?php
    $sql = "SELECT is_taken,oprema_id ,ime_opreme, name from oprema as op left JOIN category as ct on ct.category_id = op.category_id order by is_taken DESC
    ";
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            if(empty($row['oprema_id'])){
                echo "<tr>";
                echo "</tr>";
            }else{
                $oprema_id = $row['oprema_id'];
                $name = $row['ime_opreme'];
                $category = $row['name'];
                $is_taken = $row['is_taken'];
                
                if($is_taken){
                    echo "<tr>";
                    echo "<td>".$name."</td>";
                    echo "<td>".$category."</td>";
                    echo "<td>";
                    echo "<form action='backend/prisilno-vrni-opremo.php' method='POST'>";
                    echo "<input type='hidden' name='oprema_id' value= '$oprema_id'>";
                    
                    echo "<button type='submit' ><i class='fas fa-undo-alt'></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>";
                    echo "<form action='backend/brisi-opreme.php' method='POST'>";
                    echo "<input type='hidden' name='oprema_id' value= '$oprema_id'>";
                    echo "<button type='submit' ><i class='fas fa-trash'></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }else{
                    echo "<tr>";
                    echo "<td>".$name."</td>";
                    echo "<td>".$category."</td>";
                    echo "<td>";
                    echo "</td>";
                    echo "<td>";
                    echo "<form action='backend/brisi-opreme.php' method='POST' onSubmit='askIfSure()'>";
                    echo "<input type='hidden' name='oprema_id' value= '$oprema_id'>";
                    echo "<button type='submit' ><i class='fas fa-trash'></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
               
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
    <?php
        if(isset($_GET['error'])){
            echo "alert('".$_GET['error']."'); ";
        }else if(isset($_GET['success'])){
            echo "alert('".$_GET['success']."'); ";
        }
        
        ?>

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

    function askIfSure(){
        if(!confirm('Ali je vse izpolnjeno pravilno')){return false;}
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