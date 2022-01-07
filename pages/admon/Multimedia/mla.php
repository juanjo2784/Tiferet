<?php 
//echo getcwd();
include_once("../Model/mDTA.php");
session_start();

$_SESSION['tt'] = $_POST['tt'];
$_SESSION['tipo']=$_POST['itema'];
$_SESSION['tc'] = (isset($_POST['tc'])) ? $_POST['tc'] : 2;
$registro = new DTA;
//$registro->ListadoArticulos($_POST['itema']);
$registro->Lmultimedia($_POST['itema'], $_POST['tc']);
?>