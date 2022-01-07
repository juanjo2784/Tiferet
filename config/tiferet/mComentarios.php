<?php
include_once("conexion.php");

class Comment extends CNX {

  function lComentarios(){
    $conn = $this->cnx();
    $consulta = $conn->prepare("SELECT id, comment, cname,estado FROM comments where estado = '1' order by desc");
    $consulta->execute();
    $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
    $k=0;
    $j=count($respuesta);
    foreach($respuesta as $dato){
    if($k==0){
      echo "<div class='row justify-content-center align-items-center'>"; 
    }
    echo '<div class = "tm flex-fill">
          <div class="carta2 color5">
          <div class="card-body">
            <h3 class="text-center">'.$dato['comment'].'</h3>
            <h6 class="text-right">'.$dato['cname'].'</h6>
            <h6 class="text-right">'.$dato['estado'].'</h6>
          </div>
          </div>
      </div>';

      $k+=1;
      if($k==3 || $k==$j){
        echo "</div>";
        $j-=$k;
        $k=0;
      } 

      $this->dbClose();
    }

  }

  function aComentarios($comment, $cname, $mail){
    $conn = $this->cnx();
    $sql = "INSERT INTO comments (comment, img, cname, mail) VALUES(:comment, :cname, :mail)";
    $consulta = $conn->prepare($sql);
    $sql->bindValue(":comment", $comment);
    $sql->bindValue(":cname", $cname);
    $sql->bindValue(":mail", $mail);
    $consulta->execute();
    $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
  $conn->dbClose();
  }

}

?>