<?php 
session_start();
include_once("../Model/mMultimedia.php");
$registro = new Multimedia;

$categoria = (isset($_POST['contenido']))?$_POST['contenido']:NULL;
$tipo = (isset($_POST['tipo']))?$_POST['tipo']:$_SESSION['tipo'];
$nombre =(isset($_POST['name']))?$_POST['name']:$_FILES['archivo']['name'];
$titulo = (isset($_POST['titulo']))?$_POST['titulo']:NULL;
$descripcion = (isset($_POST['descripcion']))?$_POST['descripcion']:NULL;
$dir = (isset($_POST['dir']))?$_POST['dir']:NULL;
$idarchivo = (isset($_POST['id']))?$_POST['id']:NULL;

try {
  if(!empty($_FILES['archivo']['name'])){
    $ruta=$registro->gRuta($tipo);

    //agregar archivo
    $fzise = $_FILES['archivo']['size'];
    $tmp_name = $_FILES['archivo']['tmp_name'];
    $fname = str_replace(' ', '', $_FILES['archivo']['name']);

    if(!strpos($_FILES['archivo']['type'],"jpg") || !strpos($_FILES['archivo']['type'],"mp3") || !strpos($_FILES['archivo']['type'],"txt") || !strpos($_FILES['archivo']['type'],"mp4" )){
      $archivo -> addFile($tipo, $fzise, $tmp_name, $fname);
    } 
    
    if(!empty($_POST['name'])){
      unlink($ruta.$_POST['name']);
    }
  }
  $registro->UpMultimedia($categoria, $tipo, $nombre, $titulo, $descripcion, $dir, $idarchivo);
  $_SESSION['msg']=3;
  header("location: /pages/admon/admin.php?a=adminmultimedia"); //&msg=3
  } catch (\Throwable $th) {
    $_SESSION['msg']=0;
    header("location: /pages/admon/admin.php?a=adminmultimedia");
  }

?>