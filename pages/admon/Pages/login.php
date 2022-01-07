<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="Juan José Charry" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <link href="../../css/style.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>

<header>
  <a class="navbar-brand" href="?a=Home"><img src="/../img/icon2.png" alt="logo TIFERET"> </a>
</header>

<div  class="pal container-fluid">

<div class="container pt-5 cfi3">
<form action="" method="POST">
  <fieldset>
  <center>
  <legend>Loggin Administrador Tiferet</legend></br>
  
  <input type="text" class="form-control col-xs-12 col-lg-7" id="tuser" name="user" placeholder="Ingrese el Usuario"></br>
  <input type="password" class="form-control col-xs-12 col-lg-7" id="tpwd" name="pwd" placeholder="Ingrese la contraseña"></br>

  <input type="submit" value="Aceptar">
  </center>
 
  </fieldset>
</form>
</div>
  
</div>

</body>
</html>

<?php 
  session_start();
  include_once("../Model/mLoggin.php");
  $login = new User;
    if($_POST){
      $login->vUser($_POST['user'],$_POST['pwd']);
    }
?>