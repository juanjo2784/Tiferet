<?php 
  include_once('Model/mEventos.php');
    $evento = new Evento(); 

  if($_POST){
    $id = (isset($_POST['id']))?$_POST['id']:null;
    $title = (isset($_POST['title']))?$_POST['title']:null;
    $inicio = (isset($_POST['inicio']))?$_POST['inicio']:null;
    $color= (isset($_POST['textColor']))?$_POST['textColor']:null;
    $fondo=(isset($_POST['backgroundColor']))?$_POST['backgroundColor']:null;
    $dir=(isset($_POST['dir']))?$_POST['dir']:null;
    $action = (isset($_POST['action']))?$_POST['action']:1;
    $img=(isset($_FILES['name']))?$_FILES['name']:null;
    $tmpName=(isset($_FILES['tmp_name']))?$_FILES['tmp_name']:null;
    try{
    switch ($action){
      case 1:
        $evento->Eventos();
        $_SESSION['msg']=1;
      break;       
      case 2:
        $evento->addEvento($title, $inicio, $color, $fondo, $dir, $img);
        $_SESSION['msg']=2;
      break;
      case 3:
        $evento->upEvento($title, $inicio, $color, $fondo, $dir, $img, $video);
        $_SESSION['msg']=3;
      break;
      case 4:
        $evento->delEvento($id);
        $_SESSION['msg']=4;
      break;
    }
    }catch(Exception $e){
        $_SESSION['msg']=0;
    }
  }else{
    $_SESSION['msg']=9;
  }


?>