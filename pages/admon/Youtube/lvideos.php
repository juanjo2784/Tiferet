<?php 
session_start();
include_once("../Model/mVY.php");
$video = new Video;
$_SESSION['tipo']=$_POST['tipo'];
$video->Listado($_SESSION['tipo']);
//echo $_SESSION['tipo'];
?>