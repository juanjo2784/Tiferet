<?php 
//echo getcwd();
include_once("../Model/mArticulo.php");
$registro = new Articulo;
$registro->mArticulo($_POST['idArticulos']);
?>