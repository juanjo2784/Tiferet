<?php 
include_once("Model/mArticulo.php");
$registro = new Articulo;
$ruta=(isset($_GET['n']))?"../../upload/Imagenes/".$_GET['n']:null;
$id = $_GET['p'];
try {
    $registro->DelArticulo($id);
    if($ruta != null){
        unlink($ruta);
    }
    $_SESSION['msg']=3;
    header("location: /pages/admon/admin.php?a=UpdateArticulo");
} catch (\Throwable $th) {
    $_SESSION['msg']=0;
    header("location: /pages/admon/admin.php?a=UpdateArticulo");
}
?>