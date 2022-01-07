<?php
//echo getcwd();
include_once("conexion.php");

class User extends CNX {
  private $respuesta = [];
  public $shem;

 function vUser($vuser, $vpass){
  $conn = $this->cnx();
  //$hash = password_hash($vpass,PASSWORD_DEFAULT);
  
    $consulta = $conn->prepare("SELECT loggin, pass, rol, shem FROM user WHERE loggin = :vuser");
    $consulta->bindValue(':vuser',$vuser);
    $consulta->execute();
    $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
    foreach($respuesta as $valor){
      if(!empty($valor['pass'])){
        if(password_verify($vpass, $valor['pass'])){
          $_SESSION['user'] = $valor['rol'];
          $this->shem = $respuesta[0]['shem'];
          header('location: ../admin.php');
         }
      }

      }
      echo 'Datos incorrectos, verifique!';
  $this->dbClose();
}
  
  function shem(){
    return $this->shem;
  }


  function dbClose(){
    $this->conn = NULL;
    $this->consulta = NULL;
  }

 }
?>
