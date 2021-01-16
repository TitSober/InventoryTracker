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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Računi</title>
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <link href="css/racuni_style.css" rel="stylesheet" type="text/css">

</head>
<body>
    <a href="racuni.php">nazaj</a>
    <form action="backend/add-account.php" method="POST">
    <input type="text" name="ime" placeholder="Vnesi ime" required>
    <input type="text" name="priimek" placeholder="Vnesi priimek"required>
    <input type="text" name="email" placeholder="Vnesi email"required>
    <input type="password" name="geslo" placeholder="Vnesi geslo"required>
    <input type="submit" value="icon">

    
    
    
    </form>


</body>
</html>
<?php
}else{
    header("Location: index.php");
    exit();
}

?>