<?php
session_start();
include "backend/db_conn.php";

if(isset($_SESSION['id']) && $_SESSION['admin']){
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
    <title>Računi</title>
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <link href="css/racuni_style.css" rel="stylesheet" type="text/css">

</head>
<body onload="loadMessage()">
    
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
    
    
    
    <div>
    <a id="dodaj" href="racuni-dodaj.php"><i class="fas fa-user-plus"></i></a>
    <table>
    <th>Ime</th>
    <th>E-poštni naslov</th>
    <th>Kriptirano geslo</th>
    <?php 
    $sql = "SELECT * FROM users order by admin DESC";
    $result = mysqli_query($conn, $sql);
    $text = "onSubmit='if(!confirm()){return false;}'";
    if($result){
        while($row = mysqli_fetch_array($result)){
            if($row['admin']){
                echo "<tr class='admin-row'>";
                echo "<td>".$row['ime']." ".$row['priimek']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['password']."</td>";
                echo "<td class='admin'>";
                echo "Admin";
                echo "</td>";
                echo "<td class='button'>";
                echo "<form id='odstrani-admin'action='backend/odstrani-admin.php' method = 'POST' >";
                echo "<input type='hidden' name='id_user' value=".$row['id_user'].">";
                echo "<button id='odstrani-admin' type='submit'> <i class='fas fa-user-slash' ></i></i></button>";
                echo "</form>";
                echo "</td>";
                echo "<td class='button'>";
                echo "<form id='form' action='backend/delete-account.php' method ='POST' ".$text.">";
                echo "<input type='hidden' name='id_user' value=".$row['id_user'].">";
                echo "<button id='izbrisi' type='submit'> <i class='fas fa-trash'></i> </button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";

            }else{
                echo "<tr>";
                echo "<td>".$row['ime']." ".$row['priimek']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['password']."</td>";
                echo "<td class ='admin'>";
                echo "Ni admin";
                echo "</td>";
                echo "<td class='button'>";
                echo "<form id='dodaj-admin'action='backend/dodaj-admin.php' method = 'POST' >";
                echo "<input type='hidden' name='id_user' value=".$row['id_user'].">";
                echo "<button id='dodaj-admin' type='submit'> <i class='fas fa-user-shield' id='ikona-admin'id='ikona-admin'></i> </button>";
                echo "</form>";
                echo "</td>";
                echo "<td class='button'>";
                echo "<form id='form' action='backend/delete-account.php' method ='POST' ".$text.">";
                echo "<input type='hidden' name='id_user' value=".$row['id_user'].">";
                echo "<button id='izbrisi' type='submit'> <i class='fas fa-trash'></i> </button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
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
    header("Location: index.php");
    exit();
}

?>