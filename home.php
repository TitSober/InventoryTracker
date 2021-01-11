<?php
session_start();
include "backend/db_conn.php";

if(isset($_SESSION['id'])){
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

    <title>Home</title>
</head>
<body>
    <div class="link-group">
        <a href="backend/logout.php">Logout</a>
        <a href="dodaj-opremo.php">Dodaj opremo</a>
    </div>
    <div class="grid-container">

    <div class="grid-item">
    
    <form action="backend/add-to-db.php" method="POST">
        <?php
        if(isset($_GET['error'])){
            ?>
          <p class="error"><?php echo $_GET['error']?></p>  
        <?php
        }else if(isset($_GET['success'])){
            ?>
            <p class="success"><?php echo $_GET['success']?></p> 
            <?php
        }
        
        ?>
        <h1>Sposoja</h1>
        <select name="dropdown" id="dropdown">
            <?php
            while($row_item = mysqli_fetch_array($result)){
                echo "<option value = ".$row_item['ime_opreme'].">".$row_item['ime_opreme']."</option>";
            }
            ?>
            
        </select>
    <br>
    <label for="edate">Datum sposoje</label>
    <input type="date" name="edate" >
    <br>
    <label for="return-date"> Datum vrnitve</label>
    <input type="date" name="return-date" >
    <br>
    <button type="submit">Potrdi</button>

    </form>
    </div>
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
         <?php
         if(isset($_GET['category'])){
            $oprema = "SELECT * FROM oprema where category_id = ".$_GET['category'];
            $oprema_rezultat = mysqli_query($conn, $oprema);
            while($row = mysqli_fetch_array($oprema_rezultat)){
                echo "<input class='btn' id=".$row['oprema_id']. " type='radio' value=".$row['oprema_id']." onclick='test(this)'> ";
                echo "<label for=".$row['oprema_id']." class = 'oprema'>".$row['ime_opreme']."</p>";
            }

            }else{
                $oprema = "SELECT * FROM oprema ";
                $oprema_rezultat = mysqli_query($conn, $oprema);
                while($row = mysqli_fetch_array($oprema_rezultat)){
                    echo "<div class='oprema-package'>";
                    echo "<input class='btn' id=".$row['oprema_id']. " type='radio' value=".$row['oprema_id']." onclick='test(this)'> ";
                    echo "<label for=".$row['oprema_id']." class = 'oprema'>".$row['ime_opreme']."</p>";
                    echo "<img src = img/".$row['image']." class ='image'>";
                    echo "</div>";
                    

            }
         }
         ?>


    </div>
    </div>
<script>
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });

  var radioState = false;
    function test(element){
        if(radioState == false) {
            check(element);
            radioState = true;
        }else{
            uncheck(element);
            radioState = false;
        }
    }
    function check(element) {
        element.checked = true;
    }
    function uncheck(element) {
        element.checked = false;
    }

</script>
</body>
</html>
<?php
}else{
    header("Location: index.php?at home");
    exit();
}

?>