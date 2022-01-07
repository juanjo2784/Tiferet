<?php 
include_once("Model/mMultimedia.php");
include_once("Model/mComentarios.php");
include_once("Model/mDTA.php");
include_once("Model/mFile.php");

$archivo = new Multimedia;
$dta= new DTA;
$file = new File;
$comentario = new Comment;

if(isset($_GET['id'])){
  $id = (!empty($_GET['id'])) ? $_GET['id'] : "";
  $archivo->BMultimedia($_GET['id']);
  $gtitulo = (!empty($archivo->gTitulo())) ? $archivo->gTitulo() : "" ;
  $gdes = (!empty($archivo->gDes())) ? $archivo->gDes() : "" ;
  $gruta = (!empty($archivo->gRuta())) ? $archivo->gRuta() : "" ;
  $gtipo = $_GET['tipo'];
  $gtc = $_GET['tc'];
  $_SESSION['tc']=$gtc;
  $_SESSION['tipo']=$gtipo;
  $gtmas = (!empty($archivo->gTmas())) ? $archivo->gTmas() : "" ;
}else{
  $gtitulo = (!empty($archivo->gTitulo())) ? $archivo->gTitulo() : "" ;
  $gdes = (!empty($archivo->gDes())) ? $archivo->gDes() : "" ;
  $gruta = (!empty($archivo->gRuta())) ? $archivo->gRuta() : "" ;
}

if($_POST){

//Subir archivo
  if(!empty($_FILES['archivo']['name'])){ //verifcar que existe archivo
    $ruta = $file->addFile($_FILES['archivo'],3); //agregamos el archivo
  }elseif(isset($_GET['id'])){ //editar: verificar que tiene un dato gudadado
    $archivo->BMultimedia($_GET['id']);
    $ruta = (!empty($archivo->gRuta())) ? $archivo->gRuta() : "" ;
  }else{
    $ruta = NULL;
  }

//fin de subir archivo
//recibo de datos
  $des=(isset($_POST['des']))?$_POST['des']:"contenido de Galeria";
  $tmas=null;
  $idTipo = 3;
  $tc = $file->gTc();
  $_SESSION['tc']=$tc;
  $_SESSION['tipo']=$idTipo;
  $action=$_POST['action'];
  switch ($action){
    case 1:
      echo $_POST['titulo'],$des,$ruta,$idTipo,$tc,$tmas;
      $archivo->addMultimedia($_POST['titulo'],$des,$ruta,$idTipo,$tc,$tmas);
    break;
    case 2:
      $archivo->upMultimedia($_POST['id'],$_POST['titulo'],$_POST['descripcion'],$ruta,$idTipo,$_POST['tc'],$tmas);
    break;
    case 3:
      $archivo->delMultimedia($_POST['id']);
    break;
  }
}

?>
<!-- -->
<!-- Nav tabs -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <ul class="navbar-nav ml-auto mtiferet" id="tcontenido">
      <li class="itiferet" id="1"><i class="material-icons md5 cfm" >insert_drive_file</i></li>
      <li class="itiferet" id="2"><i class="material-icons md5 cfm">cloud_done</i></li>
      <li class="itiferet" id="3"><i class="material-icons md5 cfm">cloud_upload</i></li>
    </ul>
    <h3 class="text-center" id="ttipo">Agregar Video e Imagenes</h3>
  </div>
</nav>  

<div class="container-fluid"> <!--contenedor -->

<div id='multimedia'><!--contenido multimedia-->
<div class="row"> <!--Columnas conetendoras -->

<div class="col-3 mt-3"> <!-- contenedor lista de articulos -->
<h3>Listado</h3>
  <div class="ficha mt-3" id="MLT">
    
      <?php
        $tc=(isset($_GET['tc'])) ? $_GET['tc']: 1;
        $dta->Lmuro($tc);
      ?>
    </div>

</div>

<div class="col-7 carta"><!--formulario -->
    <form method="POST" action="" enctype="multipart/form-data" class="mt-3">

    <div class="row form-group">

      <select name="tc" id="tc" class="form-control col">
      <?php 
      if(!empty($_GET['tc'])){
        echo '<option value='.$_GET['tc'].' selected>'.$archivo->gDestc($_GET['tc']).'</option>';
      }
      ?>
        <option value=1 >Imagen</option>
        <option value=3 >Video</option>
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
        <input type="file"  accept=".jpg,.mp4, /img" class="form-control" name="archivo" id="archivo">
      </div>

    </div>

    <div class="container">
      <center>
      <?php
      if(isset($_GET['tc'])){
        switch($_GET['tc']){
          case '1':
            echo '<img src='.$gruta.' class="mx-auto d-block w-25">';
          break;
          case '3':
            echo '<video width="320" height="240" controls><source src='.$gruta.' type="video/mp4"></video>';
          break;
            }
      }

          ?>
      </center>
    </div>

    <div class="form-group row">
      <input type="hidden" name="tmas" id="tmas"  value='<?php echo $gtmas ?>'>
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
</div><!--fin contenido multimedia-->

<div id='publicados'><!--comentarios-->      
  <?php $comentario->lComentarios(1);?>
</div><!--fin comentarios-->

<div id='snpublicar'><!--comentarios-->      
  <?php $comentario->lComentarios(0);?>
</div><!--fin comentarios-->

</div>

<script>
$('#tc').change(function(){
  $.ajax({
  type: "POST",
  url: "/pages/admon/Muro/mla.php",
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
  
</script>

<script>
$(document).ready(function() {
let vd = readCookie( "muro" );
if(vd=="" || vd==null){
  vd = '1';
}else{
  vd = readCookie( "muro" )
}
    
 
  switch (vd){
    case '3':
      $('#snpublicar').show();
      $('#publicados, #multimedia').hide();
      $('#ttipo').html("Comentarios sin Publicar");
      break;
    case '2':
      $('#multimedia,#snpublicar').hide();
      $('#publicados').show();
      $('#ttipo').html("Comentarios Publicados");
      break;
    case '1':
      $('#multimedia').show();
      $('#publicados, #snpublicar').hide();
      $('#ttipo').html("Agregar Video e Imagenes");
      break;        
  }


});

// Select tab by name
$("li").click(function () {
let ruta = "http://localhost/";
  switch (this.id){
    case "1":
      $('#multimedia').show();
      $('#publicados, #snpublicar').hide();
      $('#ttipo').html("Agregar Video e Imagenes");
      // Creamos una cookie
      document.cookie = "muro=" + encodeURIComponent( "1", "/; SameSite=None; Secure");
      break;
    case "2":
      $('#multimedia,#snpublicar').hide();
      $('#publicados').show();
      $('#ttipo').html("Comentarios Publicados");
      document.cookie = "muro=" + encodeURIComponent( "2", "/; SameSite=None; Secure");
      break;
    case "3":
      $('#multimedia,#publicados').hide();
      $('#snpublicar').show();
      $('#ttipo').html("Comentarios sin Publicar");
      document.cookie = "muro=" + encodeURIComponent( "3", "/; SameSite=None; Secure");
    break;
  }
 
})

//Cookie
function readCookie(name) {

var nameEQ = name + "="; 
var ca = document.cookie.split(';');

for(var i=0;i < ca.length;i++) {

  var c = ca[i];
  while (c.charAt(0)==' ') c = c.substring(1,c.length);
  if (c.indexOf(nameEQ) == 0) {
    return decodeURIComponent( c.substring(nameEQ.length,c.length) );
  }

}

return null;

}

</script>