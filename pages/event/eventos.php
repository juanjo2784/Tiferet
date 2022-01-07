<?php 
header('Content-Type: application/json');
//echo getcwd();
require_once('../../config/tiferet/mtiferet.php');

$evento = new BD();
$evento->Eventos();
?>