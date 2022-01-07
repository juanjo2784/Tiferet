<?php 
require_once('config/tiferet/mtiferet.php');
//archivo de parasha del listado
$status = new BD();
?>

<div class="row text-justify"><!--contenedor-->

    <div class="container-fluid">
    <div class="text-center pb-3"><h1>Temas de Mujeres</h1></div>
      <div > <!--informacion videos Yutube-->
        <?php $status->lTemas(); ?>
      </div><!--fin informacion videos Yutube -->


 </div><!--fin de contenido-->

</div><!--fin contenedor-->