<?php 
require_once('config/tiferet/mtiferet.php');
require_once('config/tiferet/mPlay.php');
//archivo de parasha del listado
$status = new BD();
$file = new Play();

$vb = (isset($_GET['a']))?explode("/", $_GET['a']):0;
if(!isset($_SESSION['tipo']) && !isset($vb[1])){
   $_SESSION['tipo']=0;
}elseif(isset($vb[1])){
   $_SESSION['tipo']=$vb[1];
};
if($_SESSION['tipo']==0){
  $listado = "Parashot";
}else{
  $status->dTemas($_SESSION['tipo']);
  $listado=$status->gTema();
}

 $var = explode("/", $_GET['a']);

  $id=(isset($var[2]))?$var[2]:0;
  if($id<>0){
    $status -> bArticulo($id);
  }else{
    if($var[0]!="Parashat"){
      $status -> bUArticulo($_SESSION['tipo']);
    }else{
      $status -> mParasha($_COOKIE['item']);
    }
    
  }
?>

<div class="row text-justify"><!--contenedor-->
  <div class="col-sx-11 col-md-3"> <!--Listado de Articulos-->
       <h4><?php echo $listado?></h4>
       <?php $status ->ListadoArticulos($_SESSION['tipo']);?>
  </div><!--fin listado de Articulos-->

  <div class="col-sx-11 col-md-9 cartag"><!--contenido-->

<!-- Nav tabs -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <ul class="navbar-nav ml-auto mtiferet" id="tcontenido">
      <li class="itiferet" id="1"><i class="material-icons md5 cfm" >insert_drive_file</i></li>
      <li class="itiferet" id="3"><i class="material-icons md5 cfm">attach_file</i></li>
      <li class="itiferet"id="2"><i class="material-icons md5 cfm">music_note</i></li>
      <li class="itiferet" id="4"><i class="material-icons md5 cfm">play_arrow</i></li>
      <li class="itiferet" id="pdf"><a class="material-icons md5 cfm" href="<?php echo $ruta."printArticle.php?id=".$status->gId() ?>">picture_as_pdf</a></li>
    </ul>
    <h3 class="text-center" id="ttipo">Artículo</h3>
  </div>
</nav>     

<div class="container">

  <div id="Articulo" class="tab-contents mr-3"><!--articulo-->
    <center>
    <?php $status->gImg() ?>
    <h3><?php echo $status->gTitulo() ?></h3>
    <h5><?php echo $status->gSubtitulo() ?></h5><br>       
    </center>
      <p><?php echo nl2br($status -> gContenido()); ?></p><br> 
      <p class="text-right"><?php echo $status -> gAutor();?></p>
      <p class = 'small'><?php echo $status -> gTcr(); ?></p>

      <div class="container pt-4">
        <div class = "container">
          <?php 
          //$r=$status->gRarticle(); && $r<>""
          $t = $status->gidTema();
          $l = $status->gRarticle();
          if($t!=""){
            echo "<h5>Si te intereza el contenido... también puedes mirar:</h5>";
            $status->bTemas($t);
            $status->lArticles($l);
          }
          ?>
        </div>
      </div>
  </div><!--fin articulo-->

  <div id="Canal"class="tab-contents" > <!--informacion videos Yutube-->
    <?php $file->lMultimedia($_SESSION['tipo'],0)?>
  </div><!--fin informacion videos Yutube-->

  <div id="Audio" class="tab-contents"><!--Informacion de Audio-->
    <?php $file->lMultimedia($_SESSION['tipo'],2)?>
  </div><!--fin Informacion de Audio-->

  <div  id="dfile" class="tab-contents"> <!--Informacion de Videos-->
    <?php $file->lMultimedia($_SESSION['tipo'],3)?>
  </div><!--fin Informacion de Videos-->


  </div><!--fin de contenido-->

</div><!--fin contenedor-->

<script>
$(document).ready(function() {
  $('#Articulo, #pdf').show();
  $('#Audio, #dfile, #Canal').hide();
  $('#ttipo').html("Artículo");
});

// Select tab by name
$("li").click(function () {
  switch (this.id){
    case "1":
      $('#Articulo, #pdf').show();
      $('#Audio, #dfile, #Canal').hide();
      $('#ttipo').html("Artículo");
      break;
    case "2":
      $('#Audio').show();
      $('#dfile, #Canal, #Articulo, #pdf').hide();
      $('#ttipo').html("Audio");
      break;
    case "3":
      $('#dfile').show();
      $('#Audio, #Canal, #Articulo, #pdf').hide();
      $('#ttipo').html("Material de Apoyo");
      break;
    case "4":
      $('#Canal').show();
      $('#Articulo, #Audio, #dfile, #pdf').hide();
      $('#ttipo').html("YouTube");
      break;
  }
 
})

</script>