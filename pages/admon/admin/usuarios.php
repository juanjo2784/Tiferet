<?php 
include_once("Model/mUser.php");
include_once("Model/mFile.php");
$user = new User;
$file = new File;

if(isset($_GET['id'])){ //validamos si existe algun get para realizar la busqueda
  //print_r($_GET);
  $user->bUser($_GET['id']);
  $id=$_GET['id'];
}

if($_POST){
  $loggin = $_POST['loggin'];
  $shem = $_POST['shem'];
  $titulo = $_POST['titulo'];
  $cargo = $_POST['cargo'];
  $correo = $_POST['muser'];
  $rol = $_POST['rol'];

  if(!empty($_FILES['foto']['name'])){
    $foto=$file->addFile($_FILES['foto'],'4');
  }else{
      if(!empty($user->gFoto())){
        $foto=$user->gFoto();
      }else{
        $foto="";
      }
    }
//$foto=(!empty($_FILES['foto']['tmp_name'])) ? $file->addFile($_FILES['foto'],'4') : (!empty($user->gFoto())) ? $user->gFoto() : "" ;
  if(!empty($_POST['vp1']) && !empty($_POST['vp2']) ){
    if($_POST['vp1']==$_POST['vp2']){
      $pass=password_hash($_POST['vp1'], PASSWORD_DEFAULT);
      $user->uUser($loggin, $pass, $rol, $shem, $titulo, $correo, $foto, $cargo, $id);
      echo "Actualizacion Exitosa";
    }else{
      echo "La contraseña ingresada no corresponde";
    }
  }else{
    switch($_POST['action']){
      case 1:
        $user->aUser($loggin, $rol, $shem, $titulo, $correo, $foto, $cargo);
        echo "Agregado exitosamente";
      break;
      case 2:
        $user->uUser2($loggin, $rol, $shem, $titulo, $correo, $foto, $cargo, $id);
      break;    
      case 3:
        $user->delUser($id);
        echo "Registro Eliminado exitosamente";
      break; 
    }
  }


}

?> 

<div class="row ficha">

  <div class="col-3">

    <div class="container">
    <h3>Usuarios</h3>
      <?php $user->lUser();?>
    </div>

  </div>

<div class="col-9 contorno">
  <?php
  include_once('Config/msg.php');
  //echo getcwd();
  ?>
<form action="" method="post" enctype="multipart/form-data">

<fieldset class="border border-info my-2 p-2">

<h4 class="text-center my-2 py-2">Informacion de Acceso</h4>

<div class="form-group row">
      <label for="name" class="col-3 col-form-label">Login</label>
      <div class="col-9 form-control">
        <input type="text" id="loggin" name="loggin"  value="<?php echo $user->gLoggin(); ?>">
      </div>
    </div>

<div  id='password'> 
  <div class="form-group row">
    <div class="container">

      <div class="row my-2"><label for="vp1" class="col-3 col-form-label">Nuevo Password</label><input type="password" class="form-control col-9" name="vp1"></div>

      <div class="row my-2"><label for="vp2" class="col-3 col-form-label">Confirmar Password</label><input type="password" class="form-control col-9" name="vp2"></div>

    </div>
  </div>

</div>

<div class="d-flex justify-content-end">
      <button name="change" class="btn btn-primary btn-md col-4" id="change">Add/Change Password</button>
    </div>

      </fieldset>


  <fieldset class="border border-info my-2 p-2">

    <h4 class="text-center my-2 py-2">Informacion Personal</h4>

    <div class="form-group row">
    <label for="shem" class="col-3 col-form-label">Nombre</label>
      <div class="col-9 form-control">
        <input type="text" id="shem" name="shem"  value="<?php echo $user->gShem() ?>">
      </div>
    </div>

    <div class="form-group row">
    <label for="titulo" class="col-3 col-form-label">Titulo</label>
      <div class="col-9 form-control">
        <input type="text" id="titulo" name="titulo"  value="<?php echo $user->gtitulo() ?>">
      </div>
    </div>

    <div class="form-group row">
    <label for="cargo" class="col-3 col-form-label">Cargo</label>
      <div class="col-9 form-control">
        <input type="text" id="cargo" name="cargo"  value="<?php echo $user->gCargo() ?>">
      </div>
    </div>


    <div class="form-group row">
    <label for="muser" class="col-3 col-form-label">Mail</label>
      <div class="col-9 form-control">
        <input type="email" multiple id="muser" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="muser"  value="<?php echo $user->gCorreo() ?>">
      </div>
    </div>

    <div class="form-group row">
    <label for="foto" class="col-3 col-form-label">Foto</label>
      <div class="custom-file my-2 col-9" >
      
        <input type="file" class="form-control" id="foto" name="foto" >
        
      </div>
    </div>
      
    <div class="row my-2">
      <label for="rol" class="col-3 col-form-label">Perfil</label>
      <div class="col-9">
        <select name="rol" id="rol" class="form-control">
          <?php
            if(!empty($user->gRol())){
              switch($user->gRol()){
                case 1:
                  $nrol="Administrador";
                break;
                case 2:
                  $nrol="Editor";
                break;
                case 3:
                  $nrol="Intructor";
                break;                  
              }
              echo '<option value='.$user->gRol().'>'.$nrol.'</option>';
            }
          ?>
          <option value="1">Administrador</option>
          <option value="2">Editor</option>
          <option value="3">Instructor</option>
        </select>
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
$(document).ready(function(){
 if($('#action').val()!='2'){
    $('#change').hide()
    $('#password').hide();
 }  
});

$('#change').click(function(event){
  event.preventDefault();
  $('#password').toggle();
});


$('#action').change(function (){
  switch($('#action').val()){
    case '0':
      $('#bAction').html('<a href="?a=usuario" type="button" class="btn btn-success px-5 lbnt">Nuevo</a>')
      $('#change').hide()
      $('#password').show();
    break;
    case '1':
      $('#bAction').html('<button type="submit"  class="btn btn-info px-5">Agregar</button>')
      $('#change').hide()
      $('#password').show();
    break;
    case '2':
      $('#bAction').html('<button type="submit"  class="btn btn-warning px-5">Actualizar</button>')
      $('#change').show()
      $('#password').show();

    break;
    case '3':
      $('#bAction').html('<button type="submit"  class="btn btn-danger px-5">Eliminar</button>')
      $('#change').hide()
      $('#password').hide();
    break;
  }

})
</script>