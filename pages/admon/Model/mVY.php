<?php
include_once("conexion.php");
class Video extends CNX {
  private $consulta;
  private $respuesta = [];
  public $titulo;
  public $id;
  public $url;
  public $vurl;
  public $tipo;


  function dbClose(){
    $this->conn = NULL;
    $this->consulta = NULL;
  }

  function Listado($tipo){
    $conn = $this->cnx();
    try{
      $this->consulta = $conn->prepare("SELECT idvideo, titulo, vurl from youtube where tipo = $tipo");
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll();
      echo '<ul>';
      foreach ($this->respuesta as $value){
        echo '<li class="nav-item col-12"><a class="slink"  href="?c=3&a='.(int)$value['idvideo'].'">'.$value['titulo'].'</a></li>';
      }
      echo '</ul>';
    } catch (Exception $e) {
      echo "<div>NO hay resultados de la consulta</div>";   
    }
    $this->dbClose();
  }

  function Bvideo($id){
    $conn = $this->cnx();
      try{
        $this->consulta = $conn->prepare("SELECT * FROM youtube WHERE idvideo = $id");
        $this->consulta->execute();
        $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
          foreach($this->respuesta as $valor){
            $this->id = $valor['idvideo'];
            $this->tipo = $valor['tipo'];
            $this->titulo = $valor['titulo'];
            $this->vurl = $valor['vurl'];
            $this->url = 'https://www.youtube.com/embed/'.$valor['vurl'].'';
          } 
      } catch (Exception $e){
        echo " ";
      }
    $this->dbClose();
  }
 
  public function AddVideo($titulo, $tipo, $url){
    $conn = $this->cnx();
    $sql="INSERT INTO youtube (titulo, tipo, vurl) VALUES ($titulo, $tipo, $url)";
    echo $sql;
      $consulta = $conn->prepare("INSERT INTO youtube (titulo, tipo, vurl) VALUES (:titulo, :tipo, :vurl)");
      $consulta->bindParam(':titulo',$titulo);
      $consulta->bindParam(':tipo',$tipo);
      $consulta->bindParam(':vurl',$url);
      $consulta->execute();
    $this->dbClose();
  }

  public function DelVideo($id){
    $conn = $this->cnx();
      $consulta = $conn->prepare("DELETE FROM youtube WHERE idvideo=:id");
      $consulta->bindParam(':id',$id, PDO::PARAM_INT);
      $consulta->execute();
    $this->dbClose();
  }

  public function UpVideo($id, $titulo, $tipo, $url){
    $sql="UPDATE youtube SET tipo= :tipo, titulo=:titulo, vurl=:url WHERE idvideo=:id";
    $conn = $this->cnx();
    $consulta = $conn->prepare($sql);
    $consulta->bindValue(":tipo", $tipo);
    $consulta->bindValue(":titulo", $titulo);
    $consulta->bindValue(":url", $url);
    $consulta->bindValue(":id", $id);
    $consulta->execute();
    $this->dbClose();
  }

  function gTitulo(){
    echo $this->titulo;
  }

  function gId(){
    echo $this->id;
  }


  function gTipo(){
      switch($this->tipo){
          case 1:
            $a="Parasha";
          break;
          case 2:
            $a="Segula";
          case 3:
            $a="Articulo";
          break;
          case 4:
            $a="Receta";
          break;
          case 5:
            $a="Tziniut";
          break;
          default:
          $a="Seleccione";
      }
    echo $a;
  }

  function gVurl(){
    echo $this->url;
  }

  function getVurl(){
    echo $this->vurl;
  }

 }
?>