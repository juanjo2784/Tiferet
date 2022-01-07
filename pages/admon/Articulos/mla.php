<?php 
//echo getcwd();
include_once("../Model/mArticulo.php");
session_start();

$_SESSION['tt'] = $_POST['tt'];

$_SESSION['tipo']=$_POST['itema'];

$registro = new Articulo;

$registro->ListadoArticulos($_POST['itema']);
?>