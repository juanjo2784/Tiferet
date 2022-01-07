<?php 
include_once("Model/mTemas.php");
$tema = new Tema;

if(isset($_GET['id'])){ //validamos si existe algun get para realizar la busqueda
  $id=$_GET['id'];
  $tema->bTemas($id);
}

if($_POST){
  switch($_POST['action']){
    case 1:
      $tema->addTema($_POST['name'],$_POST['icon']);
      echo "Agregado exitosamente";
    break;
    case 2:
      $tema->UpdateTema($_POST['name'],$_POST['icon'],$_POST['id']);
      echo "Actualizacion Exitosa";
    break;    
    case 3:
      $tema->delTema($_POST['id']);
      echo "Registro Eliminado exitosamente";
    break; 
  }
}

?> 

<div class="row ficha">

<div class="col-3">

<div class="container">
 <h3>Temas</h3>
  <?php $tema->lTemas();?>
</div>

</div>

<div class="col-9 contorno">
<?php
include_once('Config/msg.php');
//echo getcwd();
?>
<form action="" method="post" enctype="multipart/form-data">
<fieldset class="border border-info my-2 p-2">
<h4 class="text-center my-2 py-2">Agregar Tema</h4>

    <div class="form-group row">
      <label for="name" class="col-xs-12  col-lg-2 col-form-label">Nombre</label>
      <div class="col-xs-12  col-lg-10">
        <input type="text" class="form-control col-8 float-left" id="name" name="name"  value="<?php $tema->gName() ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="autor" class="col-xs-12  col-lg-2 col-form-label">Icono</label>
      <div class="col-xs-12  col-lg-10">
        <input type="text" class="form-control col-8 float-left" id="icon" name="icon" value="<?php $tema->gIcon() ?>">
      </div>
      <div class="col-xs-12  col-lg-10">
      <a href="https://materializecss.com/icons.html" target="_blank">Iconos que se pueden usar</a>
      </div>
      
    </div>
</fieldset>
     <fieldset class="border border-info my-2 p-2">

<h4 class="text-center my-2 py-2">Selecciona la acción</h4>

<div class="form-group row d-flex justify-content-between">

<div class="w-25">
  <select name="action" id="action" class="custom-select">
  <?php
    if($_GET['id']){
      echo "<option value='0'>Nuevo</option>
            <option value=2 selected='true'>actualizar</option>
            <option value=3>Eliminar</option>";
    }else{
      echo "<option value='0'>Nuevo</option>
            <option value=1 selected='true'>Agregar</option>";
    }
  ?>
  </select>
</div>
<div class="w-25 mx-2" id="bAction">
  <?php
    if(isset($_GET['id'])){
      echo "<button type='submit'  class='btn btn-warning px-5'>Actualizar</button>";
      
    }else{
      echo "<button type='submit'  class='btn btn-info px-5'>Agregar</button>";
    }
  ?>
</div> 

</fieldset>


  </form>
  
</div>
</div>

<script>
$('#action').change(function(){
  switch($('#action').val()){
    case '0':
      $('#bAction').html('<a href="?a=tema" type="button" class="btn btn-success px-5 lbnt">Nuevo</a>')
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