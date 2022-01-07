<?php 
 if(isset($_SESSION['msg'])){
  switch($_SESSION['msg']){
    case 0:
      ?><div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Error</strong> el Proceso no se terminó correctamente</div><?php
      $_SESSION['msg']=NULL;
      break;
      case 1:
        $_SESSION['msg']=NULL;
        break;
    case 2:
      ?><div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Registro <strong>Agregado</strong>  Exitosamente</div><?php
      $_SESSION['msg']=NULL;
      break;
    case 3:
      ?><div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong>Registro Actualizado Exitosamente</div><?php
      $_SESSION['msg']=NULL;
      break;
    case 4:
      ?><div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong>Registro Eliminado Exitosamente</div><?php
      $_SESSION['msg']=NULL;
    break;
    case 6:
      ?><div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Infomacion!</strong>Se ha agregado un registro con imagen</div><?php
      $_SESSION['msg']=NULL;
    break;
    case 7:
      ?><div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Infomacion!</strong>Se ha agregado solo el Evento, se debe agregar una imagen!!!</div><?php
      $_SESSION['msg']=NULL;
    break;
    case 9:
      ?><div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong>Registro Eliminado Exitosamente</div><?php
      $_SESSION['msg']=NULL;
    break;
  }
}
if(isset($_SESSION['msg2'])){
  switch($_SESSION['msg2']){
    case 0:
      ?><div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Error</strong> El Archivo no cumple los parametros del programa</div><?php
      $_SESSION['msg2']=NULL;
      break;
      case 1:
        ?><div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error</strong>No se pudo copiar el Archivo el Servidor</div><?php
        $_SESSION['msg2']=NULL;
        break;
    case 2:
      ?><div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Archivo <strong>Agregado</strong>  Exitosamente</div><?php
      $_SESSION['msg2']=NULL;
      break;
    case 3:
      ?><div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      No se encuentra algunas <strong>Imagenes, logo / img_footer </strong>, es necesario para una correcta vista del pagina</div><?php
      $_SESSION['msg2']=NULL;
      break;
  }
}
?>