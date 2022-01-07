<?php
//echo getcwd();
include_once("conexion.php");
class User extends CNX {
  private $consulta;
  private $respuesta = [];
  protected $id;
  protected $loggin;
  protected $pass;
  protected $rol;
  protected $shem;
  protected $titulo;
  protected $correo;
  protected $foto;
  protected $cargo;

  function lUser(){
  $conn = $this->cnx();
  $this->consulta = $conn->prepare("SELECT id, loggin, rol FROM user");
  $this->consulta->execute();
  $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
  echo '<ul>';
    foreach($this->respuesta as $valor){
      echo '<li class="nav-item"><a class="slink" onclick="$(\'#change\').show()" href="?a=usuario&id='.(int)$valor['id'].'">'.$valor['loggin'].'</a></li>';
    }
  echo '<ul>';
  $this->dbClose();
  }

  function bUser($id){
  $conn = $this->cnx();
      $this->consulta = $conn->prepare("SELECT * FROM user WHERE id = :id");
      $this->consulta ->bindValue(":id", $id);
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
          $this->loggin = $this->respuesta[0]['loggin'];
          $this->pass = $this->respuesta[0]['pass'];
          $this->rol = $this->respuesta[0]['rol'];
          $this->shem = $this->respuesta[0]['shem'];
          $this->titulo = $this->respuesta[0]['titulo'];
          $this->correo = $this->respuesta[0]['correo'];
          $this->foto = $this->respuesta[0]['foto'];
          $this->cargo = $this->respuesta[0]['cargo'];
  $this->dbClose();
  }

  function uUser($loggin, $pass, $rol, $shem, $titulo, $correo, $foto, $cargo, $id){
    $pdo = $this->cnx();
    //$vpass = password_hash($pass,PASSWORD_DEFAULT);
    $sql = "UPDATE user SET loggin = :loggin, pass = :pass, rol = :rol, shem = :shem, titulo = :titulo, correo = :correo, foto = :foto, cargo = :cargo WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":loggin", $loggin);
      $stmt->bindValue(":pass", $pass);
      $stmt->bindValue(":rol", $rol);
      $stmt->bindValue(":shem", $shem);
      $stmt->bindValue(":titulo", $titulo);
      $stmt->bindValue(":correo", $correo);
      $stmt->bindValue(":foto", $foto);
      $stmt->bindValue(":cargo", $cargo);
      $stmt->bindValue(":id", $id);
      $stmt->execute();
    $pdo=null;
  }

  function uUser2($loggin, $rol, $shem, $titulo, $correo, $foto, $cargo, $id){
    $pdo = $this->cnx();
    $sql = "UPDATE user SET loggin = :loggin, rol = :rol, shem = :shem, titulo = :titulo, correo = :correo, foto = :foto, cargo = :cargo WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":loggin", $loggin);
      $stmt->bindValue(":rol", $rol);
      $stmt->bindValue(":shem", $shem);
      $stmt->bindValue(":titulo", $titulo);
      $stmt->bindValue(":correo", $correo);
      $stmt->bindValue(":foto", $foto);
      $stmt->bindValue(":cargo", $cargo);
      $stmt->bindValue(":id", $id);
      $stmt->execute();
    $pdo=null;
  }

  function aUser($loggin, $rol, $shem, $titulo, $correo, $foto, $cargo){
    $pdo = $this->cnx();
    $sql = "INSERT INTO user (loggin, rol, shem, titulo, correo, foto, cargo) VALUES(:loggin, :rol, :shem, :titulo, :correo, :foto, :cargo)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":loggin", $loggin);
      $stmt->bindValue(":rol", $rol);
      $stmt->bindValue(":shem", $shem);
      $stmt->bindValue(":titulo", $titulo);
      $stmt->bindValue(":correo", $correo);
      $stmt->bindValue(":foto", $foto);
      $stmt->bindValue(":cargo", $cargo);
      $stmt->execute();
    $pdo=null;
  }

  function delUser($id){
    $pdo = $this->cnx();
    $sql = "DELETE FROM user WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":id", $id);
      $stmt->execute();
    $pdo=null;
  }

  function gLoggin(){
    return $this->loggin;
  }

  function gPass(){
    return $this->pass;
  }

  function gRol(){
    return $this->rol;
  }

  function gId(){
    return $this->id;
  }

  function gShem(){
    echo $this->shem;
  } 

  function gTitulo(){
    echo $this->titulo;
  } 

  function gCorreo(){
    echo $this->correo;
  }

  function gFoto(){
    return $this->foto;
  } 

  
  function gCargo(){
    echo $this->cargo;
  } 

  function dbClose(){
    $this->conn = NULL;
    $this->consulta = NULL;
  }

 }
?>
