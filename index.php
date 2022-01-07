<?php 
session_start();
include_once("config/config.php");
?>
<!DOCTYPE html>

<html lang="es">

<head>
  <title><?php echo $sigla ?></title>
  <meta charset="UTF-8">
  <meta name="keywords" content="tiferet, TIFERET, Tiferet, Jerusalem, jerusalen, Ayudas, nuevos inmigrantes, parashat, segulot, lugares para visitar, Israel" />
  <meta name="description" content="<?php echo $introd ?>" />
  <meta name="Author" content="Juan José Charry" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <!-- Global site tag (gtag.js) - Google Analytics -->

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171607499-1"></script>

  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-171607499-1');
  </script>
 
  <link href= "<?php echo $ruta ?>css/style.css" rel="stylesheet">
  <link href="<?php echo $ruta ?>css/menu.css" rel="stylesheet">

  <?php 
    $evento = (isset($_GET['a']))?explode("/", $_GET['a']):"Home";
    if ($evento[0] != "eventos"){
      echo "<script src='".$ruta."js/loader.js'></script>";
    }else{
      include_once("pages/event/fEvento.php");
    }
  ?>

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex align-items-start justify-content-between">
      <a class="navbar-brand" href="<?php echo $ruta ?>Home/"><img src="<?php echo $ruta ?>img/icon2.png" alt="logo TIFERET"> </a>
      
        <ul class="navbar-nav ml-auto mtiferet" >
          <li class="itiferet"><a href="<?php echo $ruta ?>Home/" title="Home">Home</a></li>
          <li class="itiferet"><a href="<?php echo $ruta ?>contacto/" title="Contacto">Contactanos</a></li>
          <li class="itiferet"><a href="<?php echo $ruta ?>proyecto/" title="Somos">Somos</a></li>
          <li class="itiferet"><a href="<?php echo $ruta ?>muro/" title="Muro">Nuestro Muro</a></li>
        </ul>

    </nav>
  </header>
  <main>

    <div class="loader" style="display:block;" id="loader" ></div>

    <div  class="pal animate-bottom" style="display:none;" id="myDiv">

    <?php 
      include_once ("config/mapa.php"); 

      require $contenido;

      echo "</div></main>";
      include_once ("component/footer.php"); 
      include_once ('component/menu.php');
    ?>

</body>

</html>