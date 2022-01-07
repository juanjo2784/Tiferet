<?php
//error_reporting(0); 
ini_set("mail.smtp.starttls.enable", "true");
ini_set("SMTP","smtp.gmail.com");
ini_set("smtp_port","587");
	$subject = $_POST['txAsunto']; 
	$nombre=$_POST['txnombre'];
	$cel=$_POST['txFijo'];
	$correo=$_POST['txCorreo'];
	$contenido=$_POST['txMensaje'];
	$to = "tiferetnashim@gmail.com";
	$message = "Contacto: ".$nombre."\r\n Celular: ".$cel."\r\n Correo: ".$correo."\r\n".$contenido;
	$headers =  'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'From: Your name <info@address.com>' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	mail($to,$subject,$message, $headers);
?> 