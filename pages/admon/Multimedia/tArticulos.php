<?php 
//echo getcwd();
include_once("../Model/mDTA.php");
$registro = new DTA;

$registro-> mArticulo($_POST['idArticulos']);
?>