<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Mailer/Exception.php';
require 'Mailer/PHPMailer.php';
require 'Mailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    //recibo los datos:
    $nombre = $_POST["nombre"];
    $cel = $_POST["telefono"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];
    $asunto =  $_POST['asunto'];
    $contenido = "Nombre: ".$nombre."\nMovil: ".$cel."\nCorreo: ".$correo."\r\nMensaje: ".$mensaje;

    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  			// Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'tiferetnashim@gmail.com';                     // SMTP username
    $mail->Password   = 'Ruti1970';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($correo, $nombre);	   //Quien envia
    $mail->addAddress($mailf, 'Representante');     // Quien recibe

    $mail->isHTML(true);         
    $mail->Subject = $asunto;
    $mail->Body = $contenido;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $_POST["nombre"]="";
    $_POST["mensaje"]="";
    header("location:..\index.php?p=1#contacto");

} catch (Exception $e) {
    echo "Error al enviar el correo. Mailer Error: {$mail->ErrorInfo}";
}