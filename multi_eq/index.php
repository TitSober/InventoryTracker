<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/basic_style.css" rel="stylesheet" type="text/css" >
    <title>Login</title>
</head>
<body>
<form action="backend/login.php" method="POST">
    <br>
    <br>
    <br>
    <h1>Prijava</h1>
    <br>
    <br>
    <!--<label for="">Uporabniško ime</label>-->
    <input id="username" type="text" name="uname" placeholder="Uporabniško ime" required>
    <br>
    <!--<label for="">Geslo</label>-->
    <input id="password" type="password" name="pass" placeholder="Geslo" required>
    <button class="login" type="submit">Prijava</button>
    
    <div class="popup" onclick="myFunction()">Pozabljeno geslo?
        <span class="popuptext" id="myPopup">Kontaktiraj administratorje</span>
    </div>
        <?php
        if(isset($_GET['error'])){
            ?>
          <p class="error"><?php echo $_GET['error']?></p>
        <?php        
    }?>
</form>

<div id = "odzadje">
    <p1 class="register">Kontaktiraj administratorje</p1>
    <div id = "login_text">
        <h1 style>Še nimaš<br>uporabniškega računa?</h1>
    </div>
    <div id = "odzadje_1">
    </div>
</div>  

<!--animation za popup pri pozabljenem geslu-->
<script>
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
    
//animation za 2 popup
function myFunction2() {
  var popup2 = document.getElementById("myPopup2");
  popup.classList.toggle("show");
}


</script>

</body>
</html>