<?php 
require_once('config/tiferet/mtiferet.php');

$data = new BD();
$data -> cFundacion();
    $nombre = $data->gName();
    $sigla = $data->gAcronym();
    $representante = $data->gLegal_representive();
    $telefono = $data->gTel_show();
    $telefono1 = $data->gTel_dial();
    $lugar = $data->gCity();
    $mailf = $data->gMail();
    $introd=$data->gIntrod();
    $ruta = "http://mytiferet.com/";
?>