<div class="color6 pt-3 clearfix" style="display:block;" >
<div class="row">

  <div class="col-xs-12 col-sm-3">
    <img class="logo" id="imlogo" src="<?php echo $ruta ?>img/Logo.png" alt="Logo de la Asociadion" longdesc="inc/logodescription.html" >
  
  </div>

  <div class="col-xs-12 col-sm-4" >
  </div>

  <div class="col-xs-12 col-sm-4">
    <div class="container">
    <address>
    <h1><img src="<?php echo $ruta ?>img/letras.png" alt=""></h1>
    <table>
      <tbody>
        <tr>
          <th><span class="material-icons">my_location</span></th>
          <th class="text-left"><?php echo $lugar?></th>
        </tr>
        <tr>
          <th><span class="material-icons">phone_android</span></th>
          <th class="text-left"><a href="tel:<?php echo $telefono1 ?>" title="Telefono de contacto"><?php echo $telefono ?></a></th>
        </tr>
        <tr>
          <th><span class="material-icons">local_post_office</span></th>
          <th class="text-left"><a class="correo" href="mailto:<?php echo $mailf ?>?&subject=Información%20adicional&body=Móvil:%0d%0aNombre:%0d%0a" title="Link de acceso para enviar correo electrónico"><?php echo $mailf ?></a></th>
        </tr>
      </tbody>
      </table>
    </address>

     </div>
  </div>

  <div class="col-sm-1 col-sm-offset-1"></div>

</div>
</div>