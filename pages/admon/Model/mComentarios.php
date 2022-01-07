<?php
include_once("conexion.php");

class Comment extends CNX {

  function lComentarios($tipo){
    switch($tipo){
      case 0:
        $sql = "SELECT id, comment, cname, mail FROM comments where estado = 0 order by id desc limit 29";
        $nd = 1;
      break;
      case 1:
        $sql = "SELECT id, comment, cname, mail FROM comments where estado = 1 order by id desc limit 29";
        $nd = 0;
      break;
    }
    $conn = $this->cnx();
    $consulta = $conn->prepare($sql);
    $consulta->execute();
    $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $k=0;
    $j=count($respuesta);
    foreach($respuesta as $dato){
    if($k==0){
      echo "<div class='row justify-content-center align-items-center'>"; 
    }
    echo '<div class="carta2 color5">
            <div class = "d-flex justify-content-end">
            <a href="?a=vmuro&action=0&id='.$dato['id'].'"   class="btn btn-outline-danger px-3"><i class="large material-icons">delete</i></a>
            </div>
          <div class="card-body">
            <h3 class="text-center">'.$dato['comment'].'</h3>
            <h6 class="text-right">'.$dato['cname'].'</h6>
            <h6 class="text-right">'.$dato['mail'].'</h6>
            <a href="?a=vmuro&action=1&id='.$dato['id'].'&nd='.$nd.'"  class="btn btn-outline-warning px-5">Cambiar estado</a>
          </div>
      </div>';

      $k+=1;
      if($k==3 || $k==$j){
        echo "</div>";
        $j-=$k;
        $k=0;
      } 
    }   
      $this->dbClose();
  }

//cerra bd
function dbClose(){
  $conn = NULL;
  $consulta = NULL;
}

function aComentarios($id, $estado){
  echo "id: ".$id." estado:".$estado;
  $conn = $this->cnx();
  $sql = "UPDATE comments Set estado = $estado where id = $id";
  $consulta = $conn->prepare($sql);
  $consulta->execute();
  $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
$conn=null;
}

function dComentarios($id){
  echo "id: ".$id;
  $conn = $this->cnx();
  $sql = "DELETE FROM comments WHERE id = $id";
  $consulta = $conn->prepare($sql);
  $consulta->execute();
  $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
$conn=null;
}

}

?>