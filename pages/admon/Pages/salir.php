<?php 
$_SESSION['user']=NULL;
session_destroy();
header("location:login.php");
?>