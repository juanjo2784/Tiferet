<?php 
include_once("Model/mArticulo.php");
include_once("Model/mFile.php");

$registro = new Articulo;
$file = new File;

if(!empty($_POST['id'])){

  $tipo =  !empty($_POST['itema']) ? $_POST['itema'] : !empty($_SESSION['tipo']) ? $_SESSION['tipo'] : 1;
  $titulo = $_POST['titulo'];
  $subtitulo = $_POST['subtitulo'];
  $autor = $_POST['autor'];
  $contenido = $_POST['contenido'];
  $tcr = $_POST['tcr'];
  $id = $_GET['a'];
  $idTema = $_POST['idTema'];
  $aRelacionados = $_POST['tmas'];

    $fname = ($_FILES['img']) ? $_FILES['img']['name'] : "";
    $file->addFile($_FILES['img'],0);

  $registro->UpdateArticulo($titulo, $subtitulo, $autor,  $idTema, $tipo, $contenido, $tcr, $fname, $aRelacionados, $id);

  $_POST['id']=null;
}else{
  if(isset($_GET['a'])){
    $registro->BuscarArticulo($_GET['a']);
    $idT=$registro->gidTema();
  }
}
?> 

<div class="row ficha">

<div class="col-3">

<div class="container">
<form action="" method="post">
    <div class="form-group row">
      <select name="Tipo" id="Tipo" class="form-control mt-3">
        <?php
            echo "<option value='null' seleted ></option>";
            $registro->lTemas();
        ?>
      </select>
      <br/>
    </div>
  </form>
    <div class="ficha mt-3" id="MLT">
    <?php
      $tipo =  (!empty($_POST['itema'])) ? ($_POST['itema']) : (!empty($_SESSION['tipo'])) ? $_SESSION['tipo'] : 1;
      $registro->ListadoArticulos($tipo);
    ?>
    </div>
</div>

</div>

<div class="col-9">
  <?php include_once('Config/msg.php');?>
<form action="" method="post" enctype="multipart/form-data">
    <fieldset>
    <?php $_SESSION['tt'] = (isset($_SESSION['tt'])) ? $_SESSION['tt'] : "Parasha" ?>
    <legend class="text-center display-4" id="tform"><?php echo "Actualizar ".$_SESSION['tt'] ?></legend>
    </fieldset>

    <div class="form-group row">
      <label for="titulo" class="col-xs-12  col-lg-2 col-form-label">Titulo</label>
      <div class="col-xs-12  col-lg-10">
        <input type="text" class="form-control col-8 float-left" id="titulo" name="titulo"  value="<?php $registro->gTitulo() ?>">
        <input type="file" class="form-control col-4" name="img">
      </div>
    </div>

    <div class="form-group row">
      <label for="subtitulo" class="col-xs-12  col-lg-2 col-form-label">SubTitulo</label>
      <div class="col-xs-12  col-lg-10">
        <input type="text" class="form-control col-8 float-left" id="subtitulo" name="subtitulo" value="<?php $registro->gSubtitulo() ?>">
        <input type="text" class="form-control col-4" name="filename" value="<?php if(!empty($registro->nfile)){$registro->gFname();}?>" >
      </div>
    </div>

    <div class="form-group row">
      <label for="Autor" class="col-xs-12  col-lg-2 col-form-label">Autor</label>
      <div class="col-xs-12  col-lg-10">
        <input type="text" class="form-control col-8 float-left" id="autor" name="autor"  placeholder="Nombre del autor"  value="<?php $registro->gAutor() ?>">
        <select name="idTema" class="form-control col-4">
        <?php
            $registro->bTemas($idT);

            $registro->lTemas();
        ?>
      </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="tcr" class="col-xs-12  col-lg-2 col-form-label">Texto de Derechos de Autor</label>
      <div class="col-xs-12  col-lg-10">
        <textarea rows="3" class="form-control" id="tcr" name="tcr"><?php $registro->gTcr() ?></textarea>
      </div>
    </div>

    <div class="form-group row">
      <label for="tcr" class="col-xs-12  col-lg-2 col-form-label">Contenido</label>
      <div class="col-xs-12  col-lg-10">
        <textarea rows="6" class="form-control" id="contenido" name="contenido"><?php $registro->gContenido() ?></textarea>
      </div>
    </div>

    <div class="form-group row">
    <label for="idtema" class="col-xs-12  col-lg-2 col-form-label">Asociar con:</label>
      <select name="aso" id = "aso" class="form-control col-3">
      <option value="null" selected ></option>
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
</div>


</div>

<div class="form-group row">
  <input type="hidden" name="tmas" id="tmas" class="col-xs-12  col-lg-8 col-form-label" value="<?php echo $registro->gaRelacionados() ?>">
</div>

    <input type="hidden" class="form-control" name="id" value="<?php $registro->gId();?>">

    <div class="form-group row d-flex justify-content-between">
    <a class="lbnt btn btn-danger btn-lg" href="?p=<?php $registro->gId();?>&a=delArticulo&n=<?php $registro->gFname();?>">Eliminar Articulo</a>
        <button type="submit" class="btn btn-primary btn-lg">Actualzar Articulo</button>
    </div>
  </form>


</div>
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

$('#Tipo').change(function() {
  $.ajax({
  type: "POST",
  url: "/pages/admon/Articulos/mla.php",
  data: {itema:$("#Tipo").val(),
        tt:$("#Tipo option:selected").text()
        },
    success:function(responce){
      $('#MLT').html(responce);
    }
  })
});

$('#Tipo').click(function(){
  let tt=$("#Tipo option:selected").text();
  $('#tform').html(tt);
})

</script>
