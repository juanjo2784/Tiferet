<?php 
//echo getcwd();
include_once("../Model/mDTA.php");
session_start();

$_SESSION['tipo']=3 ;
$_SESSION['tc'] = (isset($_POST['tc'])) ? $_POST['tc'] : 2;
$registro = new DTA;
//fotos
echo '<article>
        <div class = "container">';
$registro->Lmuro($_POST['tc']);
echo '</div>
    </article>';
?>