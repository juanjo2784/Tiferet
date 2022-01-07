<?php 
if($_SESSION['user']){
  if(!isset($_GET['a'])){
    $contenido = "Articulos/AddArticulo.php";
  }else{
    $a = ($_GET['a']);
    switch(true){
      //Admin
      case ($a=="admin"):
        $contenido = "admin/Administrar.php";
      break;
      case ($a=="tema"):
        $contenido = "admin/temas.php";
      break;
      case ($a=="usuario"):
        $contenido = "admin/usuarios.php";
      break;
      //Articulos
      case ($a=="articulos"):
        $contenido = "Articulos/AddArticulo.php";
      break;
      case ($a=="larticulos"):
        $contenido = "Articulos/larticulos.php";
      break;
      case ($a=="UpdateArticulo"):
        $contenido = "Articulos/adminArticulo.php";
      break;
      case ($a=="delArticulo"):
        $contenido = "Articulos/delArticulo.php";
      break;
      //Multimedia
      case ($a=="multimedia"):
        $contenido = "Multimedia/addMultimedia.php";
      break;
      //muro
      case ($a=="muro"):
        $contenido = "Muro/muro.php";
      break;
      case ($a=="vmuro"):
        $contenido = "Muro/vmuro.php";
      break;
      //Eventos
      case ($a=="eventos"):
        $contenido = "Eventos/View/cronograma.php";
      break;
      case ($a >= 0):
        switch($_GET['c']){
          case 0:
          case 1:
            $contenido = "Articulos/adminArticulo.php";
          break;
          case 2:
            $contenido = "Multimedia/addMultimedia.php";
          break;
          case 3:
            $contenido = "Youtube/adminvideo.php";
          break;
          /*case 4:
            $contenido = "Admin/temas.php";
          break;*/
          }
      break;
      case ($a=="salir"):
        session_destroy();
        header("location:Pages/login.php");
      break;
      default:
      session_destroy();
      header("location:Pages/login.php");
    }
  }
}else{
  header("location:Pages/login.php");
}
?>