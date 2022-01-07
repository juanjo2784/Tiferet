<?php 
include_once("conexion.php");
class Multimedia extends CNX {
  private $consulta;
  private $respuesta = [];
  public $titulo;
  public $tc;
  public $tipo;
  public $descr;
  public $ruta;
  public $tmas;
  public $nfile;
  public $id;

  function BMultimedia($id){
  $conn = $this->cnx();
  $this->consulta = $conn->prepare("SELECT * FROM multimedia WHERE id = :id");
  $this->consulta ->bindValue(":id", $id);
  $this->consulta->execute();
  $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
    $this->titulo = $this->respuesta[0]['titulo'];
    $this->descr = $this->respuesta[0]['descr'];
    $this->categoria = $this->respuesta[0]['tc'];
    $this->tipo = $this->respuesta[0]['tipo'];
    $this->ruta = $this->respuesta[0]['ruta'];
    $this->id = $this->respuesta[0]['id'];
  $this->dbClose();
}

function Listado($tipo, $tc){
  $conn = $this->cnx();
  $sql="SELECT titulo, id FROM multimedia WHERE tipo = :tipo AND tc = :tc";
    $this->consulta = $conn->prepare($sql);
    $this->consulta ->bindValue(":tipo", $tipo);
    $this->consulta ->bindValue(":tc", $tc);
    $this->consulta->execute();
    $this->respuesta = $this->consulta->fetchAll();
    echo '<ul class="tlink">';
    foreach ($this->respuesta as $value){
      echo '<li><a href="?c=2&a='.$value['id'].'&n='.$value['tc'].'&t='.$tipo.'">'.$value['titulo'].'</a></li>';
    }
    echo '</ul>';
    $src="";
  $this->dbClose();
}

function addMultimedia($titulo,$descr,$ruta,$tipo,$tc,$tmas){
  $conn = $this->cnx();
  //echo  $titulo.' - '.$descr.' - '.$ruta.' - '.$tipo.' - tc:  '.$tc.' - '.$tmas;
  $sql="INSERT INTO multimedia (titulo,descr,ruta,tipo,tc,tmas) values(:titulo,:descr,:ruta,:tipo,:tc,:tmas)";
  $this->consulta = $conn->prepare($sql);
  $this->consulta->bindValue(":titulo", $titulo);
  $this->consulta->bindValue(":descr", $descr);
  $this->consulta->bindValue(":ruta", $ruta);
  $this->consulta->bindValue(":tipo", $tipo);
  $this->consulta->bindValue(":tc", $tc);
  $this->consulta->bindValue(":tmas", $tmas);
  if($this->consulta->execute()){
    echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Proceso finalizado conrrectamente!</strong> Se ha guardado el Registro.
          </div>';
  }else{
    echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>!Error</strong> No se ha guardado el Registro.
          </div>';
  }
  $this->dbClose();
 }

 function upMultimedia($id,$titulo,$descr,$ruta,$tipo,$tc,$tmas){
  $conn = $this->cnx();
    $sql="UPDATE multimedia  SET titulo = :titulo,
          descr = :descr,
          ruta = :ruta,
          tipo = :tipo,
          tc = :tc,
          tmas = :tmas
          WHERE id = :id";
  $this->consulta = $conn->prepare($sql);
  $this->consulta->bindValue(":titulo", $titulo);
  $this->consulta->bindValue(":descr", $descr);
  $this->consulta->bindValue(":ruta", $ruta);
  $this->consulta->bindValue(":tipo", $tipo);
  $this->consulta->bindValue(":tc", $tc);
  $this->consulta->bindValue(":tmas", $tmas);
  $this->consulta->bindValue(":id", $id);

  if($this->consulta->execute()){
    echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Proceso finalizado conrrectamente!</strong> Se ha Actualizado el Registro.
          </div>';
  }else{
    echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>!Error</strong> No se ha Actualizado el Registro.
          </div>';
  }
  $this->dbClose();
 }

 function DelMultimedia($id){
   $conn = $this->cnx();
     $this->consulta = $conn->prepare("DELETE FROM multimedia WHERE (id=:id)");
     $this->consulta ->bindValue(":id", $id);
     if($this->consulta->execute()){
      echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Proceso finalizado conrrectamente!</strong> Se ha Eliminado el Registro.
              </div>';
      }else{
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>!Error</strong> No se ha Eliminado el Registro.
              </div>';
      }
    $this->dbClose();
 }
 
function gDestc($tc){
  switch($tc){
    case 0:
      return 'YouTube';
    break;
    case 1:
      return 'Imagen';
    break;
    case 2:
      return 'Audio - mp3';
    break;
    case 3:
      return 'Video - mp4';
    break;
    case 4:
      return 'Adjunto';
    break;
  }
}

function gTitulo(){
  return $this->titulo;
}

function gDes(){
  return $this->descr;
}

function gTipo(){
  return $this->tipo;
}

function gTC(){
  return $this->tc;
}

function gRuta(){
  return $this->ruta;
}

function gTmas(){
  return $this->tmas;
}


///optener el nombre del tema
function gNtema($id){
  if($id!=0){
      $conn = $this->cnx();
      $this->consulta = $conn->prepare("SELECT * FROM temas WHERE id = :id"); //====
      $this->consulta->bindValue(":id", $id);
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
      $name = $this->respuesta[0]['name'];
      $this->dbClose();
      return $name;
  }else{
    return "Parasha";
  }

}

//cerra bd
function dbClose(){
  $conn = NULL;
  $this->consulta = NULL;
}


}
?>
