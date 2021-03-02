<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ef06bd2c19.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/fontawesome.min.css">
    <link href="multimedija_logo.png" rel="icon" type="image/png">
    <link href="css/basic_style.css" rel="stylesheet" type="text/css" >
    <title>Login</title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-sm">
    </div>
    <div class="col-sm-7">
    <form action="backend/login.php" method="POST" class="form-row align-items-center">
      <h1>Prijava</h1>
      <input id="username" type="text" name="uname" placeholder=" &#xf406; Uporabniško ime" required>
      <br>
      <input id="password" type="password" name="pass" placeholder=" &#xf023; Geslo" required> 
      
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
    </div>
    <div class="col-sm">
    </div>
  </div>
</div>

<!--
<div id = "odzadje">
    <a href="mailto:dejan.curk@sc-nm.si" class="register">Kontaktiraj administratorja</a>
    <div id = "login_text">
        <h1 style>Še nimaš<br>uporabniškega računa?</h1>
    </div>
    <div id = "odzadje_1"></div>
</div>  -->
    
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