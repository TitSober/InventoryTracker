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
    <a href="racuni-dodaj.php">+</a>
    <a href="home.php">nazaj</a>
    <div>
    <table>
    <?php 
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$row['ime']." ".$row['priimek']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['password']."</td>";
            echo "<td>";
            echo "<form id='form' action='backend/delete-account.php' method ='POST'>";
            echo "<input type='hidden' name='id_user' value=".$row['id_user'].">";
            echo "<input type='submit' value='t'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    }

    ?>
    </table>
</div>


</body>
</html>
<?php
}else{
    header("Location: index.php");
    exit();
}

?>