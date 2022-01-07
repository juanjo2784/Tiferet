<?php 
require_once('config/tiferet/mPlay.php');
//require 's3/app/start.php';
$imagen = new Play();

if($_POST){
  $imagen->sComentario($_POST['comment'],$_POST['cname'],$_POST['mail']);
}

?>

<div class='carta'>
<!-- Nav tabs -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <ul class="navbar-nav ml-auto mtiferet" id="tcontenido">

    <li class="itiferet" id="1">
      <div class="card cfm" style="width: 8rem;">
      <i class="material-icons md5" >image</i>
        <h5 class="card-title">Imagenes</h5>
      </div>
    </li>

    <li class="itiferet" id="2">
      <div class="card cfm" style="width: 8rem;">
      <i class="material-icons md5" >movie_creation</i>
        <h5 class="card-title">Videos</h5>
      </div>
    </li>    

    <li class="itiferet" id="3">
      <div class="card cfm" style="width: 8rem;">
      <i class="material-icons md5" >chat_bubble</i>
        <h5 class="card-title">Mensajes</h5>
      </div>
    </li> 

    </ul>
    <h3 class="text-center" id="ttipo">Mensajes</h3>
  </div>
</nav>  
<!-- fin Nav tabs -->
<div class="container">

    <div id="Mensajes"  class="tab-contents mr-3">
      <?php $imagen->lComentarios()?>
      <h1 class="display-4 mt-5">Danos tu comentario!</h1>
      <center>
        <div class="container carta"><!--formulario -->
            <form method="POST" action=""  class="mt-3">

            <div class="row form-group">
              <input type="text" name="cname" class="form-control" required placeholder="Nombre" >
            </div>

            <div class="form-group row">
              <textarea name="comment"  row='3' class="form-control" placeholder="Escribe tu comentario aqui" ></textarea>
            </div>

            <div class="form-group row">
              <input type="text" name="mail" id="mail" class="form-control" placeholder="Mail, para ser notificado si se requiere" >
            </div>
                <div class="form-group row d-flex justify-content-center">
                <div class="w-25 mx-2" id="bAction"><button type="submit"  class="btn btn-info px-5">Enviar</button></div>
                </div>
            </form>
          </div>
          <a href="https://api.whatsapp.com/send?phone=0123456789&text=I'm%20interested%20in%20your%20services" target="_blank"> Haga clic en WhatsApp Chat </a>
        </div><!--fin contenedor formulario-->

      </center>
    </div>

    <div id="videos"  class="tab-contents mr-3">
      <?php $imagen->gvideo(3,3)?>
    </div>

    <div id="fotos"  class="tab-contents mr-3">
      <?php $imagen->gImagenes()?>
    </div>

  </div>
</div>

<?php $imagen->gMImagen();?>
<script>
$(document).ready(function() {
  $('#fotos').show();
  $('#Mensajes, #videos').hide();
  $('#ttipo').html("Galeria de Imagenes");
});

// Select tab by name
$("li").click(function () {
  switch (this.id){
    case "1":
      $('#fotos').show();
      $('#Mensajes, #videos').hide();
      $('#ttipo').html("Galeria de Imagenes");
      break;
    case "2":
      $('#videos').show();
      $('#Mensajes, #fotos').hide();
      $('#ttipo').html("Galeria de Videos");
      break;
    case "3":
      $('#Mensajes').show();
      $('#fotos, #videos').hide();
      $('#ttipo').html("Mensajes");
      break;
  }
 
})

function switchStyle() {
  if (document.getElementById('styleSwitch').checked) {
    document.getElementById('gallery').classList.add("custom");
    document.getElementById('exampleModal').classList.add("custom");
  } else {
    document.getElementById('gallery').classList.remove("custom");
    document.getElementById('exampleModal').classList.remove("custom");
  }
}
</script>