<?php 
include_once("Model/mMultimedia.php");
include_once("Model/mDTA.php");
include_once("Model/mFile.php");

$archivo = new Multimedia;
$dta= new DTA;
$file = new File;

if(isset($_GET['id'])){
  $id = (!empty($_GET['id'])) ? $_GET['id'] : "";
  $archivo->BMultimedia($_GET['id']);
  $gtitulo = (!empty($archivo->gTitulo())) ? $archivo->gTitulo() : "" ;
  $gdes = (!empty($archivo->gDes())) ? $archivo->gDes() : "" ;
  $gruta = (!empty($archivo->gRuta())) ? $archivo->gRuta() : "" ;
  $gtipo = $_GET['tipo'];
  $gtc = $_GET['tc']  ;
  $_SESSION['tc']=$gtc;
  $_SESSION['tipo']=$gtipo;
  $gtmas = (!empty($archivo->gTmas())) ? $archivo->gTmas() : "" ;
}else{
  $gtitulo = (!empty($archivo->gTitulo())) ? $archivo->gTitulo() : "" ;
  $gdes = (!empty($archivo->gDes())) ? $archivo->gDes() : "" ;
  $gruta = (!empty($archivo->gRuta())) ? $archivo->gRuta() : "" ;
}

if($_POST){
  if(!empty($_POST['tmas'])){
    $k=2; //material articulo
    }else{
    $k=0; //contenido categoria
  }
//Subir archivo
  if($_POST['tc']>'1'){ //verificar que trabajo con archivo
    if(!empty($_FILES['archivo']['name'])){ //verifcar que existe archivo
      $ruta = $file->addFile($_FILES['archivo'],$k); //agregamos el archivo
    }elseif(isset($_GET['id'])){ //editar: verificar que tiene un dato gudadado
      $archivo->BMultimedia($_GET['id']);
      $ruta = (!empty($archivo->gRuta())) ? $archivo->gRuta() : "" ;
    }else{
      $ruta = NULL;
    }

  }else{
    
    if(!empty($_POST['url'])){
      $ruta = $_POST['url'];
    }elseif(isset($_GET['id'])){
      $archivo->BMultimedia($_GET['id']);
      $ruta = (!empty($archivo->gRuta())) ? $archivo->gRuta() : "" ;
    }else{
      $ruta = NULL;
    }

  }
//fin de subir archivo
//recibo de datos

  $des=(isset($_POST['descripcion']))?$_POST['descripcion']:"contenido multimedia";
  $tc = $file->gTc();
  $_SESSION['tc']=$tc;
  $_SESSION['tipo']=$_POST['idTipo'];
  $tmas=(!empty($_POST['tmas'])?$_POST['tmas']:null);
  $action=$_POST['action'];

  switch ($action){
    case 1:
      $archivo->addMultimedia($_POST['titulo'],$_POST['descripcion'],$ruta,$_POST['idTipo'],$_POST['tc'],$tmas);
    break;
    case 2:
      $archivo->upMultimedia($_POST['id'],$_POST['titulo'],$_POST['descripcion'],$ruta,$_POST['idTipo'],$_POST['tc'],$_POST['tmas']);
    break;
    case 3:
      $archivo->delMultimedia($_POST['id']);
    break;
  }

}


?>
<!-- -->
<div class="container-fluid"> <!--contenedor -->

  <div class="display-4 text-center">Agregar Contenido Multimedia</div>

<div class="row"> <!--Columnas conetendoras -->

<div class="col-3 mt-3"> <!-- contenedor lista de articulos -->
<h3>Listado</h3>
  <div class="ficha mt-3" id="MLT">
    
      <?php
        $tc=(isset($_SESSION['tc'])) ? $_SESSION['tc']: 1;
        $tipo = (isset( $_SESSION['tipo'])) ?  $_SESSION['tipo'] : (isset($_SESSION['tipo'])) ? $_SESSION['tipo'] : 0;
        $dta->Lmultimedia($tipo, $tc);
      ?>
    </div>

</div>

<div class="col-7 carta"><!--formulario -->
    <form method="POST" action="" enctype="multipart/form-data" class="mt-3">

    <div class="row form-group">

      <select name="tc" id="tc" class="form-control col">
      <?php 
      if(isset($_GET['tc'])){
        echo '<option value='.$_SESSION['tc'].' selected>'.$archivo->gDestc($_SESSION['tc']).'</option>';
      }
      ?>
        <option value=0 >YouTube</option>
        <option value=2 >Audio - mp3</option>
        <option value=3 >Video - mp4</option>
        <option value=4 >Adjunto</option>
      </select>

      <select name="idTipo" id="Tipo" class="form-control col">
        <?php 
        if(isset($_GET['tipo'])){
          echo '<option value='.$_SESSION['tipo'].' selected>'.$archivo->gNtema($_SESSION['tipo']).'</option>';
        }
        $dta->lTemas();?>
      </select>

    </div>

     <div class="row form-group">
      <input type="text" name="titulo" class="form-control" required placeholder="Titulo" value='<?php echo $gtitulo ?>' >
      <input type="hidden" name="id" id='idf' class="form-control" value='<?php if(isset($_GET['id'])){echo $_GET['id'];}  ?>' >
     </div>

    <div class="form-group row">
      <input type="text" name="descripcion" class="form-control" placeholder="Descripción"  value='<?php echo $gdes ?>'>
    </div>

    <div class="form-group row d-flex justify-content-between">
      <div class="form-group  row mx-1" id="upfile">
        <input type="file"  accept=".mp3,.mp2,.mp4,.pdf,.doc,.docx,.rar, /img" class="form-control" name="archivo" id="archivo">
      </div>

      <div class="form-group row mx-1" id="upUrl">
        <input type="text" class="form-control" name="url" id="url" placeholder="url"  value='<?php echo $gruta ?>' />
      </div>
    </div>

    <div class="container">
      <center>
      <?php
      if(isset($_GET['tc'])){
        switch($_GET['tc']){
          case '0':
            echo '<iframe width="560" height="315"src="https://www.youtube.com/embed/'.$gruta.'?autoplay=1"
              frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
          break;
          case '2':
            echo '<audio controls><source src='.$gruta.' type="audio/ogg"></audio>';
          break;
          case '3':
            echo '<video width="320" height="240" controls><source src='.$gruta.' type="video/mp4"></video>';
          break;
            }
      }

          ?>
      </center>
    </div>

    <div class="form-group">
    <div class="display-5 my-1">Material de apoyo para articulos:</div>      
    </div>
    <div id="Listado"></div>
    <div id="lista" class="my-2">
        <?php
        if(!empty($dta->gaRelacionados())){
          $datos=$dta->gaRelacionados();
          $ar=explode(",",$datos);
          $dta->mArticulo($ar);
        }
        ?>
    </div>
    <div class="form-group row">
      <input type="hidden" name="tmas" id="tmas"  value='<?php if(!empty($gtmas)){ echo $gtmas;} ?>'>
    </div>
        <div class="form-group row d-flex justify-content-between">

          <div class="w-25">
            <select name="action" id="action" class="custom-select">
            <?php 
            if (isset($_GET['id'])){
              echo '<option value="0">Nuevo</option>
                    <option value="2" selected >Actualizar</option>
                    <option value="3">Eliminar</option>';
            }else{
              echo '<option value="0">Nuevo</option>
                    <option value="1" selected>Agregar</option>';
            }
            ?>
            </select>
          </div>
          <?php
          if(isset($_GET['id'])){
            echo '<div class="w-25 mx-2" id="bAction"><button type="submit"  class="btn btn-warning px-5">Actualizar</button></div>';
          }else{
            echo '<div class="w-25 mx-2" id="bAction"><button type="submit"  class="btn btn-info px-5">Agregar</button></div> ';
          }
          ?>        
        </div>
    </form>
  </div>
</div><!--fin contenedor formulario-->

</div>

<script>


$('#tc').change(function(){
  let a = $('#tc').val();
  switch(a){
    case '0':
      $('#upUrl').show()
      $('#upfile').hide();
      break;
    case '1':
    case '2':
    case '3':
    case '4':
      $('#upUrl').hide()
      $('#upfile').show();
      break;
  }
  $.ajax({
  type: "POST",
  url: "/pages/admon/Multimedia/mla.php",
  data: {itema:$("#Tipo").val(),
        tc:$("#tc").val(),
        tt:$("#Tipo option:selected").text()
        },
    success:function(responce){
      $('#MLT').html(responce);
    }
  })
});


$('#Tipo').change(function() {
  $.ajax({
  type: "POST",
  url: "/pages/admon/Multimedia/larticulos.php",
  data: {tipoA:$("#Tipo").val()},
    success:function(responce){
      $('#Listado').html(responce);
    }
  })
});

$('#Tipo').change(function() {
  $.ajax({
  type: "POST",
  url: "/pages/admon/Multimedia/mla.php",
  data: {itema:$("#Tipo").val(),
        tc:$("#tc").val(),
        tt:$("#Tipo option:selected").text()
        },
    success:function(responce){
      $('#MLT').html(responce);
    }
  })
});

$('#action').change(function(){
  switch($('#action').val()){
    case '0':
      $('#bAction').html('<a href="?a=multimedia"  class="btn btn-success px-5">Nuevo</a>')
    break;
    case '1':
      $('#bAction').html('<button type="submit"  class="btn btn-info px-5">Agregar</button>')
    break;
    case '2':
      $('#bAction').html('<button type="submit"  class="btn btn-warning px-5">Actualizar</button>')
    break;
    case '3':
      $('#bAction').html('<button type="submit"  class="btn btn-danger px-5">Eliminar</button>')
    break;
  }
})

$(document).ready(function(){
  if($('#tc').val()==0){
    $('#upUrl').show()
    $('#upfile').hide();
}else{
  $('#upUrl').hide()
  $('#upfile').show();
}
  
});

window.addEventListener("load",function(){

});
</script>