<?php 
    $ruta = "http://mytiferet.com/";

    if(!isset($_SESSION['user'])){
        header("location:Pages/login.php");
      }
?>