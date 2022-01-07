<?php 
session_start();
  include_once('Config/config.php');
?>
<!DOCTYPE html>

<html lang="es">

<head>
<title>Administrador</title>
  <meta charset="UTF-8">
  <meta name="Author" content="Juan José Charry" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <link href= "../../../css/style.css" rel="stylesheet">
  <link href="../../../css/menu.css" rel="stylesheet">
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php 

$evento = (isset($_GET['a']))?explode("/", $_GET['a']):"articulos";
if ($evento[0] == "eventos"){
  include 'Eventos/View/modalCalendar.php';
}else{
  echo '<script>"../../../js/loader.js"</script>';
}
?>
</head>
<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="mx-auto">
      <div class="btn-group">
<?php 
 if($_SESSION['user']=="1"){
  echo '<a type="button" class="btn btn-primary" href="?a=admin">Administrar</a>';
  echo '<a type="button" class="btn btn-primary" href="?a=tema">Temas</a>';
  echo '<a type="button" class="btn btn-primary" href="?a=usuario">Usuarios</a>';
 }
?>
        <a type="button" class="btn btn-primary" href="?a=articulos">Articulos</a>
        <a type="button" class="btn btn-primary" href="?a=multimedia">Multimedia</a>
        <a type="button" class="btn btn-primary" href="?a=muro">Muro</a>
        <a type="button" class="btn btn-primary" href="?a=eventos">Eventos</a>
        <a type="button" class="btn btn-primary" href="?a=salir">Salir</a>
      </div>
    </div>

  </nav>
</header>

<div  class="pal container-fluid">

<?php 
  require "Config/mapaLogin.php"; 
  require $contenido;   
  echo "</div>";
  include_once ("Component/footer.php"); 
?>
</body>
</html>