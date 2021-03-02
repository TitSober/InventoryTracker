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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Računi</title>
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <link href="css/racuni_dodaj_style.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/ef06bd2c19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css">

</head>
<body onload="loadMessage()">
    <div id="okvir">
        <a id="nazaj" href="racuni.php"><i class="fas fa-angle-double-left"></i> </a>
        <img id="vektor" src="img/undraw_Personal_site_re_c4bp.svg">
        <div id="obrazec">
        <h2 id="naslov">Dodajanje uporabnika</h2>
        <form action="backend/add-account.php" method="POST">
        <input id="ime" type="text" name="ime" placeholder="Ime" required>
        <input id="priimek" type="text" name="priimek" placeholder="Priimek"required>
        <input id="email" type="text" name="email" placeholder="Spletni naslov"required>
        <input id="geslo" type="password" name="geslo" placeholder="Geslo"required>
        <button id="dodaj" type="submit"><i class="fas fa-user-plus"></i> Dodaj</button>
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
    </script>
</body>
</html>
<?php
}else{
    header("Location: index.php");
    exit();
}

?>