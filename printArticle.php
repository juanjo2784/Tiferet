<?php 
session_start();
include_once("config/config.php");
require_once('config/tiferet/mtiferet.php');
require_once('config/tiferet/mPlay.php');
//archivo de parasha del listado
$status = new BD();

if($_GET){
  $status -> bArticulo($_GET['id']);
}

?>
<!DOCTYPE html>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <title><?php echo $sigla; ?></title>
  <meta name="keywords" content="tiferet, TIFERET, Tiferet, Jerusalem, jerusalen, Ayudas, nuevos inmigrantes, parashat, segulot, lugares para visitar, Israel" />
  <meta name="description" content="<?php echo $introd ?>" />
  <meta name="Author" content="Juan José Charry" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href= "<?php echo $ruta ?>css/print.css" rel="stylesheet" media="print">
  <link href="<?php echo $ruta ?>css/menu.css" rel="stylesheet">
</head>
<body>
  <div class="container text-justify"><!--contenedor-->
    <div id="Articulo" class="tab-contents mr-3"><!--articulo-->
    <img src='img/icon2.png' class="rounded" >
      <center>
      <?php $status->gImg() ?>
      <br>
      <h3><?php echo $status->gTitulo() ?></h3>
      <h5><?php echo $status->gSubtitulo() ?></h5><br>       
      </center>
        <p><?php echo nl2br($status -> gContenido()); ?></p><br> 
        <p class="text-right"><?php echo $status -> gAutor();?></p>
        <p class = 'small'><?php echo $status -> gTcr(); ?></p>

    </div><!--fin articulo-->
    <div class = "d-flex flex-row-reverse my-4">
      <button type="button" onclick = "window.print();" class="btn btn-outline-primary" id="btn-print">Guardar PDF</button>
    </div>
    

  </div><!--fin contenedor-->
  
   
</body>