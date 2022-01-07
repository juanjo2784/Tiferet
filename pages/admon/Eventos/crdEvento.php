<?php 
session_start();
require_once('../Model/mEventos.php');
$evento = new Evento();

  $id = (isset($_POST['idevento']))?$_POST['idevento']:0;
  $title = (isset($_POST['title']))?$_POST['title']:null;
  $inicio =(isset($_POST['inicio']))?$_POST['fecha']." ".$_POST['inicio']:null;
  $color= (isset($_POST['textColor']))?$_POST['textColor']:null;
  $fondo=(isset($_POST['backgroundColor']))?$_POST['backgroundColor']:null;
  $dir=(isset($_POST['dir']))?$_POST['dir']:null;
  $action = (isset($_POST['action']))?$_POST['action']:null;
 
  $audio=(isset($_POST['rutaudio']))?($_FILES['audio'])?"../../upload/Eventos/".$_FILES['audio']['name']:NULL:($_FILES['audio'])?"../../upload/Eventos/audio/".$_FILES['audio']['name']:$_POST['rutaudio']; 
  $tmpNameAudio=(isset($_FILES['audio']['tmp_name']))?$_FILES['audio']['tmp_name']:null;
  try{
  switch ($action){
    case 2:
      if(!empty($_FILES['img']['name'])){
          $fzise = $_FILES['img']['size'];
          $tmp_name = $_FILES['img']['tmp_name'];
          $ruta = "../../../upload/Eventos/";
          $fname = str_replace(' ', '', $_FILES['img']['name']);
          $img= "/../../upload/Eventos/".$fname;
          if(!strpos($_FILES['img']['type'],"jpg")){
            $evento -> addFile($fzise,$tmp_name, $ruta, $fname);
          }  
      }else{
        $img=$_POST['rutaimg'];
      }
      $evento->addEvento($title, $inicio, $color, $fondo, $dir, $img);
      $_SESSION['msg']=2;
      header("location: /pages/admon/admin.php?a=eventos");
    break;
    case 3:
 //agregamos el archivo de audio y eliminamos el existente cuando exista
        if(!empty($_FILES['img2']['name'])){
          if(!empty($_POST['rutaimg'])){
            unlink($_POST['rutaimg']);
          }
          
          if($_FILES['img2']){
            $fzise = $_FILES['img2']['size'];
            $tmp_name = $_FILES['img2']['tmp_name'];
            $ruta = "../../../upload/Eventos/";
            $fname = str_replace(' ', '', $_FILES['img2']['name']);
            $img= "/../../upload/Eventos/".$fname;

            if(!strpos($_FILES['img2']['type'],"jpg")){
              $evento -> addFile($fzise,$tmp_name, $ruta, $fname);
            }  
          }

        }else{
          $img=$_POST['rutaimg'];
        }
 
        if(!empty($_FILES['audio']['name'])){
          if(!empty($_POST['rutaudio'])){
            unlink($_POST['rutaudio']);
          }
          $audio= "/../../upload/Eventos/Audio/".$_FILES['audio']['name'];

          if($_FILES['audio']){
            $fzise = $_FILES['audio']['size'];
            $tmp_name = $_FILES['audio']['tmp_name'];
            $ruta = "../../../upload/Eventos/Audio/";
            $fname = str_replace(' ', '', $_FILES['audio']['name']);
          
            if(!strpos($_FILES['audio']['type'],"mp3")){
              $evento -> addFile($fzise,$tmp_name, $ruta, $fname);
            }  
          }


        }else{
          $audio=$_POST['rutaudio'];
        }
 //ejecutamos la funccion de agregar evento
    $evento->upEvento($id, $title, $inicio, $color, $fondo, $dir, $img, $audio);
    $_SESSION['msg']=3;
    header("location: /pages/admon/admin.php?a=eventos");
    break;
  }
  }catch(Exception $e){
      $_SESSION['msg']=0;
      header("location: /pages/admon/admin.php?a=eventos");
  }

?>