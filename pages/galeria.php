<?php 
require_once('config/tiferet/mtiferet.php');
//require 's3/app/start.php';
$imagen = new BD();?>

<div class="container">
<h1>Galeria de Imagenes</h1>
  <div class="container page-top">
    <div class="row">
    <?php $imagen->gImagenes(6)?>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>  
<script>
$(document).ready(function(){
  $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
    
    $(".zoom").hover(function(){
		
		$(this).addClass('transition');
	}, function(){
        
		$(this).removeClass('transition');
	});
});
</script>