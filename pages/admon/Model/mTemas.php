<?php
//echo getcwd();
include_once("conexion.php");
class Tema extends CNX {
  private $consulta;
  private $respuesta = [];
  public $id;
  public $name;
  public $icon;

  function lTemas(){
  $conn = $this->cnx();
  $this->consulta = $conn->prepare("SELECT * FROM temas");
  $this->consulta->execute();
  $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
  echo '<ul>';
    foreach($this->respuesta as $valor){
      echo '<li class="nav-item"><a class="slink"  href="?a=tema&id='.(int)$valor['id'].'">'.$valor['name'].'</a></li>';
    }
  echo '<ul>';
  $this->dbClose();
  }

  function bTemas($id){
  $conn = $this->cnx();
      $this->consulta = $conn->prepare("SELECT * FROM temas WHERE id = $id");
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach($this->respuesta as $valor){
          $this->name = $valor['name'];
          $this->icon = $valor['icon'];
        }
  $this->dbClose();
  }

  function UpdateTema($name,$icon,$id){
    $pdo = $this->cnx();
    $sql = "UPDATE temas SET name = :name,icon = :icon WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":icon", $icon);
      $stmt->bindValue(":id", $id);
      $stmt->execute();
    $pdo=null;
  }

  function addTema($name,$icon){
    $pdo = $this->cnx();
    $sql = "INSERT INTO temas (name, icon) VALUES(:name, :icon)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":icon", $icon);
      $stmt->execute();
    $pdo=null;
  }

  function delTema($id){
    $pdo = $this->cnx();
    $sql = "DELETE FROM temas WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":id", $id);
      $stmt->execute();
    $pdo=null;
  }

  function gName(){
    echo $this->name;
  }

  function gIcon(){
    echo $this->icon;
  }

  function gId(){
    echo $this->id;
  }

  function dbClose(){
    $this->conn = NULL;
    $this->consulta = NULL;
  }

 }
?>
