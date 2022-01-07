<?php 
session_start();
include_once("Model/mMultimedia.php");
$registro = new Multimedia;

$id = $_GET['p'];
switch($_GET['t']){
    case 1:
        $ruta="../../upload/Imagenes/".$_GET['n'];
    break;
    case 2:
        $ruta="../../upload/Audio/".$_GET['n'];
    break;
    case 3:
        $ruta="../../upload/Video/".$_GET['n'];
    break;
}
try{
    $registro->delMultimedia($id);
    if(!empty($_GET['n'])){
        unlink($ruta);
    }
    $_SESSION['result']=1;
    header("location: admin.php?a=adminmultimedia");
} catch (Exception $e){
    $_SESSION['result']=0;
}
?>