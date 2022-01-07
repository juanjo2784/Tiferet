<?php 
  session_start();
  require_once('../Model/mVY.php');
  $video = new Video();
  $action = (isset($_POST['action']))?$_POST['action']:null;
if($_POST){
  $titulo= (isset($_POST['titulo']))?$_POST['titulo']:null;
  $tipo=$_SESSION['tipo'];
  $url=(isset($_POST['vurl']))?$_POST['vurl']:null;
  try{
    switch ($action){
      case 2:
        $video->AddVideo($titulo, $tipo, $url);
        $_SESSION['msg']=2;
        header("location:/pages/admon/admin.php?a=video");
      break;
      case 3:
        $id = (isset($_POST['id']))?$_POST['id']:0;
        $titulo = "'".$titulo."'";
        $url="'".$url."'";
        $tipo="'".$tipo."'";
        $video->UpVideo($id, $titulo, $tipo, $url);
        $_SESSION['msg']=3;
        header("location:/pages/admon/admin.php?a=adminvideo");
      break;
      case 4:
        $id=$_POST['id'];
        $video->DelVideo($id);
        $_SESSION['msg']=3;
        header("location:localhost/pages/admon/admin.php?a=adminvideo");
      break;
    }
    }catch(Exception $e){
        $_SESSION['msg']=0;
    }

}
?>