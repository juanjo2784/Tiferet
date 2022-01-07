<?php 
require_once('config/tiferet/mtiferet.php');
//archivo de parasha del listado
$status = new BD();

$lat=explode('/',$_GET['a']);
$tb=$lat[1];
echo $status->gTema(); 
?>

<div class="row text-justify"><!--contenedor-->

    <div class="container">
    <div class="text-center pb-3"><h1><?php $status->dTemas($tb); echo $status->gTema(); ?></h1></div>
      <div > <!--informacion videos Yutube-->
        <?php $status->lAT($tb); ?>
      </div><!--fin informacion videos Yutube -->


 </div><!--fin de contenido-->

</div><!--fin contenedor-->
