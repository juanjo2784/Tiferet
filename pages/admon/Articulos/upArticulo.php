<?php 
//echo getcwd();
session_start();
include_once("../Model/mArticulo.php");
$registro = new Articulo;

  //print_r($_POST);
  if($_FILES['img']['name']!=NULL){
    //print_r($_FILES);
    $fzise = $_FILES['img']['size'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $ruta = "../../../upload/Imagenes/";
    $fname = str_replace(' ', '', $_FILES['img']['name']);
  	$nimg=$_FILES['img']['name'];
    if(!strpos($_FILES['img']['type'],"jpg")){
      $evento -> addFile($fzise,$tmp_name, $ruta, $fname);
      $_SESSION['msg2']=2;
    }else{
      $_SESSION['msg2']=0;
    }  
    if(isset($_POST['filename'])){
        unlink("../../../upload/Imagenes/".$_POST['filename']);
    }
  }else{
  	$nimg=$_POST['filename'];
  }

  $titulo = $_POST['titulo'];
  $subtitulo = $_POST['subtitulo'];
  $autor = $_POST['autor'];
  $contenido = $_POST['contenido'];
  $tcr = $_POST['tcr'];
  $fecha = $_POST['fecha'];
  $id = $_POST['id'];
  //$nimg =(!empty($_POST['filename']))?$_POST['filename']:str_replace(' ', '', $_FILES['img']['name']);
  $registro->UpdateArticulo($titulo, $subtitulo, $autor, $tipo, $contenido, $tcr, $fecha, $nimg, $id);
?>
