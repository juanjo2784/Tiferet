<?php 
$id = (isset($_POST['idevento']))?$_POST['idevento']:null;
var_dump($_POST);
session_start();
require_once('../Model/mEventos.php');
    $evento = new Evento(); 
    if(!empty($_POST['fimg'])){
        unlink($_POST['fimg']);
      }
      if(!empty($_POST['faudio'])){
        unlink($_POST['faudio']);
      }
    $evento->delEvento($id);
    $_SESSION['msg']=4;
    header("location: /pages/admon/admin.php?a=eventos");
?>
