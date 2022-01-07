<?php 
//echo getcwd();
include_once("Model/mArticulo.php");
include_once('Config/msg.php');
$registro = new Articulo;

if ($_POST){
  if($_FILES['img']){
    $fzise = $_FILES['img']['size'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $ruta = "../../upload/Imagenes/";
    $fname =(!empty($_FILES['img']['name']))?str_replace(' ', '', $_FILES['img']['name']):'';
    if(!strpos($_FILES['img']['type'],"jpg") || !strpos($_FILES['img']['type'],"jpeg")){
      $registro -> addFile($fzise,$tmp_name, $ruta, $fname);
    }
  }else{
    $fname=null;
  }

  $titulo = $_POST['titulo'];
  $subtitulo =(!empty($_POST['subtitulo']))?$_POST['subtitulo']:null;
  $autor = (!empty($_POST['autor']))?$_POST['autor']:"Anonimo"; 
  $contenido = $_POST['contenido'];
  $tcr = $_POST['tcr'];
  $fecha = $_POST['fecha'];
  $idTema = (!empty($_POST['idTema']))?$_POST['idTema']:0;
  $aRelacionados = (!empty($_POST['tmas']))?$_POST['tmas']:null;                                  
  $registro->AddArticulo($titulo, $subtitulo, $autor, $idTema, $contenido, $tcr, $fecha,  $fname, $aRelacionados);
}

?>

<div class="container cartag">
<form action="" method="post" enctype="multipart/form-data">
<fieldset><legend class="text-center">Agregar un Articulo de Texto</legend>
<div class="form-group row">
  <label for="titulo" class="col-xs-12  col-lg-2 col-form-label">Titulo</label>
  <div class="col-xs-12  col-lg-10">
    <input type="text" required class="form-control col-8 float-left" id="titulo" name="titulo"  placeholder="Titulo">
    <input type="file" class="form-control col-4" name="img" />
  </div>
</div>

<div class="form-group row">
  <label for="subtitulo" class="col-xs-12  col-lg-2 col-form-label">SubTitulo</label>
  <div class="col-xs-12  col-lg-10">
    <input type="text" class="form-control col-8 float-left" id="subtitulo" name="subtitulo"  placeholder="SubTitulo">
    <input type="date" class="form-control col-4 float-right" id="fecha" name="fecha" value="<?php echo date('Y-m-d') ?>">
  </div>
</div>

<div class="form-group row">
  <label for="Autor" class="col-xs-12  col-lg-2 col-form-label">Autor</label>
  <div class="col-xs-12  col-lg-10">
    <input type="text" class="form-control col-8 float-left" id="autor" name="autor"  placeholder="Nombre del autor">
    <select name="idTema" class="form-control col-4">
    <option value="0" selected = true>Parasha</option>
    <?php $registro->lTemas() ?>
  </select>
  </div>
</div>

<div class="form-group row">
  <label for="tcr" class="col-xs-12  col-lg-2 col-form-label">Texto de Derechos de Autor</label>
  <div class="col-xs-12  col-lg-10">
    <textarea rows="2" class="form-control" id="tcr" name="tcr"  placeholder="ingrese el texto que indique las condiciones del Derecho de Autor"></textarea>
  </div>
</div>

<div class="form-group row">
  <label for="tcr" class="col-xs-12  col-lg-2 col-form-label">Contenido</label>
  <div class="col-xs-12  col-lg-10">
    <textarea required rows="6" class="form-control" id="contenido" name="contenido"  placeholder="Pegue el texto, se respentaran los parrafos"></textarea>
  </div>
</div>

  <div class="form-group row">
    <label for="idtema" class="col-xs-12  col-lg-2 col-form-label">Asociar con:</label>
      <select name="aso" id = "aso" class="form-control col-3">
      <option value="null" selected ></option>
      <option value="0">Parasha</option>
          <?php $registro->lTemas() ?>
      </select>    
      <div class="col-xs-12  col-lg-6" id="resultado">
      <?php
        if(!empty($registro->gaRelacionados())){
          $datos=$registro->gaRelacionados();
          $ar=explode(",",$datos);
          $registro->mArticulo($ar);
        }
        ?>
        
      </div> 
      <div class="row justify-content-end">
      <div class="form-group col-xs-12  col-lg-9 mt-2"  id="listado"></div>
      </div>
  </div>

<div class="form-group row">
  <input type="hidden" name="tmas" id="tmas" class="col-xs-12  col-lg-8">
</div>

<div class="form-group row">
  <div class="col-sm-12 d-flex justify-content-between">
    <a href="?a=UpdateArticulo"  class="btn btn-success btn-lg">Listar Articulos</a>
    <button type="submit" class="btn btn-primary btn-lg">Guardar Articulo</button>
  </div>
</div>

</fieldset>
</form>
</div>

<script>
$('#aso').change(function() {
  $.ajax({
  type: "POST",
  url: "/pages/admon/Articulos/larticulos.php",
  data: {tipoA:$("#aso").val()},
    success:function(responce){
      $('#resultado').html(responce);
    }
  })
});

</script>