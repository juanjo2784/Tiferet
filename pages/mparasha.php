<?php 
//echo getcwd();
require_once('config/tiferet/mtiferet.php');
session_start();
//archivo de pasahat hayom; echo $_SESSION['item']."<br>";
$status = new BD();
$status -> mParasha($_COOKIE['item']);
$_SESSION['tipo']=0;
$var = explode("/", $_GET['a']);
if ($var[1]<>0){
  $status -> bArticulo($var[1]);
}else{
  $status-> bUArticulo(1);
}
?>

<div class="row text-justify"><!--contenedor-->
  <div class="col-sx-11 col-md-3"> <!--Listado de Articulos-->
       <h5><?php echo $listado?></h5>
       <?php $status ->ListadoArticulos($_SESSION['tipo']);?>
  </div><!--fin listado de Articulos-->

  <div class="col-sx-11 col-md-9 cartag"><!--contenido-->

<!-- Nav tabs -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <ul class="navbar-nav ml-auto mtiferet" id="tcontenido">
      <li class="itiferet" id="1"><i class="material-icons md5 cfm" >insert_drive_file</i></li>
      <li class="itiferet"id="2"><i class="material-icons md5 cfm">music_note</i></li>
      <li class="itiferet" id="3"><i class="material-icons md5 cfm">movie</i></li>
      <li class="itiferet" id="4"><i class="material-icons md5 cfm">play_arrow</i></li>
      <li class="itiferet" id="pdf"><a class="material-icons md5 cfm" href="<?php echo $ruta."printArticle.php?id=".$status->gId() ?>">picture_as_pdf</a></li>
    </ul>
    <h3 class="text-center" id="ttipo">Artículo</h3>
  </div>
</nav>     

<div class="container">

<div id="Articulo" class="tab-contents"><!--articulo-->
  <center>
  <?php $status->gImg() ?>
  <h3><?php echo $status->gTitulo() ?></h3>
  <h5><?php echo $status->gSubtitulo() ?></h5><br>       
  </center>
    <p><?php echo nl2br($status -> gContenido()); ?></p><br> 
    <p class="text-right"><?php echo $status -> gAutor();?></p>
    <p class = 'small'><?php echo $status -> gTcr(); ?></p>
</div><!--fin articulo-->

<div id="Canal"class="tab-contents" > <!--informacion videos Yutube-->
  <?php $status->gYoutube($_SESSION['tipo'])?>
</div><!--fin informacion videos Yutube-->

<div id="Audio" class="tab-contents"><!--Informacion de Audio-->
  <?php $status->gMultimedia($_SESSION['tipo'],2)?>
</div><!--fin Informacion de Audio-->

<div class="tab-contents" id="Video"> <!--Informacion de Videos-->
  <?php $status->gMultimedia($_SESSION['tipo'],3)?>
</div><!--fin Informacion de Videos-->

</div>

<div id="Audio" class="tab-contents"><!--Informacion de Audio-->
  <?php $status->gMultimedia($_SESSION['tipo'],2)?>
</div><!--fin Informacion de Audio-->

<div class="tab-contents" id="Video"> <!--Informacion de Videos-->
  <h2>Videos</h2>
  <?php $status->gMultimedia($_SESSION['tipo'],3)?>
</div><!--fin Informacion de Videos-->
  </div><!--fin de contenido-->
</div><!--fin contenedor-->

<script>
// Select tab by name
$("li").click(function () {
  switch (this.id){
    case "1":
      $('#Articulo, #pdf').show();
      $('#Audio, #Video, #Canal').hide();
      $('#ttipo').html("Artículo");
      break;
    case "2":
      $('#Audio').show();
      $('#Video, #Canal, #Articulo, #pdf').hide();
      $('#ttipo').html("Audio");
      break;
    case "3":
      $('#Video').show();
      $('#Audio, #Canal, #Articulo, #pdf').hide();
      $('#ttipo').html("Video");
      break;
    case "4":
      $('#Canal').show();
      $('#Articulo, #Audio, #Video, #pdf').hide();
      $('#ttipo').html("YouTube");
      break;
  }
 
})

</script>