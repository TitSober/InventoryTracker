<?php
$servername = "localhost";
$username = "root";
$conn_pass = "";
$db_name = "multimedija";
$conn = mysqli_connect($servername, $username, $conn_pass, $db_name);
if (!$conn) {
     echo "connection failed cause";
}



?>