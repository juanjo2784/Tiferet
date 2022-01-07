<?php
if(!isset($_GET['a'])){
  $contenido="component/Home.php";
}else{
  $a = explode("/",$_GET['a']);
    switch (true) {
    case ($a[0]  == "Admin"):
      header("Location: /pages/admon/Pages/login.php");
    break;
      case ($a[0] == "contacto" ):
      $contenido="pages/contactenos.php";
    break;
      case ($a[0] == "Home"):
      $contenido="component/Home.php";
    break;
      case ($a[0] == "proyecto"):
      $contenido="pages/proyecto.php";
    break;
      case ($a[0] == "muro"):
      $contenido = "pages/muro.php";
      break;
    case ($a[0] == "temas"):
      if(($a[1])==""){
        $contenido="pages/temas.php";
      }else{
        $contenido="pages/bArticulo.php";
      }
    break;
    case($a[0]=="listaEventos"):
      $contenido="lEventos.php";
    break;
    case ($a[0] == "listadotemas"):
      $contenido="pages/tarticles.php";
     break;
    case ($a[0] == "eventos"):
      $contenido="pages/event/cronograma.php";
     break;  
    case ($a[0] == "article" || $a[0] == "Parashat" ):
      $contenido="pages/bArticulo.php";
    break;
    case ($a[0] <=99):
      $contenido="pages/bArticulo.php";
      break;
      case ($a=="salir"):
        session_destroy();
        header("location:pages/admom/Pages/login.php");
      break;
      default:
      session_destroy();
      header("location:pages/admom/Pages/login.php");
    }
  }
?>
