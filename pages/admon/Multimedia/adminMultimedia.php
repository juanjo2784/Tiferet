<?php
session_start();
include_once("Model/mMultimedia.php");
$article = new Multimedia;

if($_POST){
  $_SESSION['tipo']=$_POST['tipo'];
  $_SESSION['contenido'] = $_POST['contenido'];
  $_SESSION['formulario'] = $_POST['formulario'];
  header("location: /pages/admon/admin.php?a=adminmultimedia");
}else{
  if (isset($_GET['a'])) {
    $article->BMultimedia($_GET['a']);
    $article->itipo($a);
  }
  $_SESSION['tipo']=(isset($_SESSION['tipo']))?$_SESSION['tipo']:1;
  $_SESSION['contenido']=(isset($_SESSION['contenido']))?$_SESSION['contenido']:6;
  $_SESSION['formulario']=(isset($_SESSION['formulario']))?$_SESSION['formulario']:6;
}
echo $_SESSION['tipo'];
?>

<div class="row" class="cartag">
    <form method="POST" action="" class="container pt-2">
    <h2>Actualizar <?php $article->txtTipo($_SESSION['tipo']); $article->txtContenido($_SESSION['contenido']) ?></h2>
        <div class="form-group row">
          <select name="formulario" id="formulario"  class="col-3 form-control float-right" onchange="Cambiar()">
            <option value=0></option>
            <option value=1>Articulo</option>
            <option value=2>Galeria</option>
            <option value=3>Lugar</option>
          </select>
          <select name="contenido" class="col-3 form-control float-right" id="contenido">
            <option value=0></option>
          </select>
          <select name="tipo" class="col-3 form-control float-right" id="tipo">
            <option value=0></option>
          </select>
          <button type="submit" class="col-3 btn btn btn-outline-success btn-sm">Generar Formulario</button>
        </div>
    </form>
</div>
<div class="row col-12">
  <div class="col-4">
      <form method="POST" action="Multimedia/upMultimedia.php" enctype="multipart/form-data" class="container">
      <div class="form-group row">
      <input type="hidden" name="tipo" value="<?php echo $_SESSION['tipo']?>">
      <input type="hidden" name="contenido" value="<?php echo $_SESSION['contenido']?>">
        <input type="text" name="name" class="form-control" value="<?php echo $article->gNombre()?>" placeholder="Nombre">
      </div>

      <?php if ($_SESSION['formulario'] != 2) {?>
        <div class="form-group row">
        <input type="text" name="titulo" class="form-control" value="<?php $article->gTitulo()?>"  placeholder="Titulo">
        </div>

        <div class="form-group row">
        <input type="text" name="descripcion" class="form-control" value="<?php $article->gDescripcion()?>"  placeholder="Descripción">
        </div>
      <?php } 
      if ($_SESSION['formulario'] == 3) { ?>
        <div class="form-group row">
        <input type="text" name="direccion" class="form-control" value="<?php $article->gDir()?>"  placeholder="Dirección">
        </div>
      <?php } ?>

      <div class="form-group row">
        <input type="file" class="form-control" name="archivo" />
      </div>

      <input type="hidden"  name="id"  value="<?php $article->gIdfile()?>">
      <!--Mostrar contenido multimedia-->
    <div>

    </div>
      <div class="form-group row">
        <div class="col-sm-12 d-flex justify-content-between">
          <a href="?p=<?php $article->gIdfile();?>&a=delMultimedia"  class="lbnt btn btn-danger btn-lg">Eliminar</a>
          <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
        </div>
      </div>
    </form>
  </div>

  <!--imagen-->
  <div class="col-4"><?php
  include_once('Config/msg.php');
  $article->gTipo() ?></div>

<!--Listado de articulos-->
  <div class="col-4">
  <div class="container">
    <?php echo "<h4>".$article->itipo($_SESSION['tipo'])." ".$article->txtContenido($_SESSION['contenido'])."</h4>"; $article->Listado($_SESSION['tipo'],$_SESSION['contenido']); ?>
  </div>
  </div>
</div>


<script type="text/javascript">
  let opc1 = new Array("Parasha","Segula","Emuna y Bitajon","Receta","Tziniut")
  let opc2 = new Array("Galeria")
  let opc3 = new Array("Lugar")
  let opct1 = new Array("Audio","Video")
  let opct2 = new Array("Imagen")
  let opct3 = new Array("Imagen")

  function Cambiar(){
    let contenido = document.getElementById('formulario').value
    if(contenido){
      let b=parseInt(contenido)
      //primer select
      let ceo = eval("opc"+contenido)
      cant = ceo.length //tamaño del array
      switch(b){
        case 1:
          b=1;
          break;
        case 2:
          b=6;
          break;
        case 3:
          b=7
          break;
      }
      document.getElementById('contenido').length = cant //cantidad de elementos que se agregaran al selection
      for(i=0; i<cant; i++){
        document.getElementById('contenido').options[i].value=i+b
        document.getElementById('contenido').options[i].text=ceo[i]
      }
      //segundo select
      let ceo2 =eval("opct"+contenido) 
      cant2 = ceo2.length
      c=(cant2==2)?2:1
      document.getElementById('tipo').length = cant2  
      for(j=0; j<cant; j++){
        document.getElementById('tipo').options[j].value=j+c
        document.getElementById('tipo').options[j].text=ceo2[j]
      } 
    }else{
      document.getElementById('tipo').length =1
      document.getElementById('tipo').options[i].value=0
      document.getElementById('tipo').options[i].text="-"      
    }
    document.getElementById('tipo').options[0].selected=true
  }
</script>