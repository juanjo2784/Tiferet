<?php
if(isset($_COOKIE['item'])){
  $item = $_COOKIE['item'];
}
?>  

<article class="color1 d-flex flex-wrap">
<div class="row justify-content-center" >
<h1 class="d-none" >Tiferet Nashim Latina</h1>
  <img id="banner" src="<?php echo $ruta ?>img/Tiferet.png" alt="">

  <!--div class="container-fluid pt-3 mlr-3">
    <!?php include_once ("pages/proyecto.php");?>
  </div-->

</div>
</article>

<article class="color0  p-3">
  <div class="container-fluid pt-3 mlr-3">
    <?php include_once ("component/servicios.php");?>
  </div>
</article>

<article class="tmujeres p-5">
<h2 class="d-none">Entre Mujeres</h2>
<div class="row justify-content-center">


<div> 
<div class="p-5 m-5"><h2 class="stmujeres">אשת חיל</h2></div>
    <div class="m-t5 color5 flex-fill">
    <a href="<?php echo $ruta ?>temas/" style="posicion:" class="btmujer">
        <button type="button" class="btn btn-lg btn-outline-info">Temas de Mujeres</button>
    </a>
    </div>
</div>

</div>
</article>

<article class="color3 p-3">
<h2 class="text-center display-4" >HaShavua</h2>
  <div class="container-fluid ">
    <?php include_once ("component/carrusel.php");  ?>
  </div>
</article>

<article class="p-5" id='Eventos'>
<h2 class="text-center display-4">Eventos y Shiurim </h2>
<div class="row container-fluid justify-content-center">
  <?php $data->gAudioE(5); ?>
</div>

<div class="row justify-content-center">
  <a href="<?php echo $ruta ?>listaEventos/">
      <button type="button" class="btn btn-lg btn-outline-info px-5">Eventos</button>
  </a>
</div>

</article>

<article class='color3'>
  <div class="container p-4">
    <h2 class="text-center display-4 m-5" >Apoyanos</h2>

    <h3 class="font-italic">"Si hiciéramos todas las cosas que somos capaces de hacer, nos sorprenderíamos a nosotros mismos". <small>Thomas Edison</small></h3>

    <div class="d-flex p-3 justify-content-center">

      <form action="https://www.paypal.com/donate" method="post" target="_top">
      <input type="hidden" name="hosted_button_id" value="BQZXRNVEVD7FS" />
      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
      <img alt="" border="0" src="https://www.paypal.com/en_IL/i/scr/pixel.gif" class='al150' width="1" height="1" />
      </form>

    </div>


  </div>
</article>

<article>
  <?php $data->vTeam(); ?>
</article>

<article>
<div class="row justify-content-center" >
<div class="container-fluid pt-3">
    <?php include_once ("pages/contactenos.php");?>
  </div>
</div>
</article>