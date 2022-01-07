<?php

include_once("Model/mComentarios.php");
$comentario = new Comment;

//actions
if($_GET){
  print_r($_GET);
  switch($_GET['action']){
    case 0:
      $comentario->dComentarios($_GET['id']);
    break;
    case 1:
      $comentario->aComentarios($_GET['id'],$_GET['nd']);
    break;
  }
}  

switch($_GET['nd']){
  case 0:
    header('Location: ?a=muro#snpublicar');
  break;
  case 1:
    header('Location: ?a=muro#publicados');
  break;
}


?>