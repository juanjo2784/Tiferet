<?php 
include_once("conexion.php");
class  Play extends CNX {

  public $icono;
  public $respuesta;
  public $consulta;

  function lMultimedia($tipo,$tc){
   $sql = "SELECT titulo, id, ruta FROM multimedia WHERE tc = :tc and tipo = :tipo order by id desc";
   $conn = $this->cnx();
   $consulta = $conn->prepare($sql);
   $consulta->bindValue(":tc", $tc);
   $consulta->bindValue(":tipo", $tipo);
   $consulta->execute();
   $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
   $icono = $this->gIcono($tc);
   $k=0;
   $j=count($respuesta);
   foreach($respuesta as $dato){
   if($k==0){
        echo "<div class='row justify-content-center align-items-center'>"; 
      }
      echo '<div class = "tm flex-fill">
          <a data-toggle="modal" data-target="#myModal'.$dato['id'].'" data-backdrop="static" data-keyboard="false">
            <div class="carta color5">
            <div class="card-encabezado text-center"><i class="material-icons md50 cfi7">'.$icono.'</i></div>
            <div class="card-body"><h5 class="text-center">'.$dato['titulo'].'</h5></div>
            </div>
          </a>
        </div>';

//agregar modal
echo '<div class="modal fade" id="myModal'.$dato["id"].'" tabindex="5" role="dialog" >
<div class="modal-dialog modal-lg">
  <div class="modal-content color0">
    <center>
      '.$this->Mostrar($dato["ruta"],$tc,$dato["id"]).'
    </center>
  </div>
</div>
</div>';

//fin modal
        $k+=1;
        if($k==3 || $k==$j){
          echo "</div>";
          $j-=$k;
          $k=0;
        } 
  
        $this->dbClose();
      }
  }


  function dbClose(){
    $conn= $this->cnx();
    $conn = NULL;
    $this->consulta = NULL;
  }

 function gIcono($tc){
   switch($tc){
     case 0:
      return "play_arrow";
     break;
     case 2:
      return "music_video";
     break;
     case 3:
      return "local_movies";
     break;
     case 4:
      return "attach_file";
     break;
   }
 }

//mostrar contenido
function Mostrar($src, $tc, $id){
  switch($tc){
    case 0: //youytube
      return "<a type='button' class='d-flex justify-content-end' data-dismiss='modal' onclick='$(\"#vy".$id."\").attr(\"src\",\"http://www.youtube.com/embed/$src\")'>
          <i class='large material-icons close2'>close</i></a>
          <div class='cv'>
            <iframe id='vy".$id."' width='560' height='315'  frameborder='0' allow='autoplay'  src='http://www.youtube.com/embed/$src?autoplay=1'></iframe>
          </div>";
        break;
    case 2:
      return "<a type='button' class='d-flex justify-content-end' data-dismiss='modal' onclick='document.getElementById(\"archivo".$id."\").pause();'><i class='large material-icons close2'>close</i></a>
          <div class='cv'>
                <audio controls controlslist='nodownload' preload='auto' id='archivo".$id."' src=".$src." >Tu navegador no soporta MP3.</audio>
          </div>";
    break;
    case 3:
      return "<a type='button' class='d-flex justify-content-end' data-dismiss='modal' onclick='document.getElementById(\"archivo".$id."\").pause();'><i class='large material-icons close2'>close</i></a>
      <div class='cv'>
            <video controls controlslist='nodownload' preload='auto' id='archivo".$id."' src=".$src." >Tu navegador no soporta MP4.</video>
      </div>";
    break;
    case 4:
      return "<a type='button' class='d-flex justify-content-end' data-dismiss='modal' onclick='document.getElementById(\"archivo".$id."\").pause();'><i class='large material-icons close2'>close</i></a>
      <div class='cv color4 pt-5'>
      <a download='archivo".$id."' href=".$src." class='display-3'>Descargar el Archivo</a>
      <div class='container py-5 mt-5'><a download='archivo".$id."' href=".$src."><i class='material-icons md50 cfi7'>file_download</i></a></div>
      </div>"; 
    break;
  }
      

}

function gImagenes(){
  $conn = $this->cnx();
  $consulta = $conn->prepare("SELECT ruta, id  FROM multimedia WHERE tipo = 3 AND tc = 1  order by id desc");
  $consulta->execute();
  $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
  echo '<div id="gallery" data-toggle="modal" data-target="#exampleModal">';
  $k = 0;
   foreach($respuesta as $key => $value){
          if($k==0){
            echo'<div class="d-flex flex-row justify-content-center align-items-center">';
          }

          echo '<div class="carta te"><img src="'.$value['ruta'].'" class="zoom img-fluid" data-target="#carouselExample" data-slide-to="'.$key.'"></div>'; 
          $k++;

          if($k>=4){
            $k=0;
          }
            if($k==0){
              echo'</div>';
            }
    
          //<div>'.$value['descr'].'</div> muestra descripcion de la foto
  }
    echo '</div>';
  $this->dbClose();
}

function gOlimg(){
  $conn= $this->cnx();
  $consulta = $conn->prepare("SELECT ruta, id FROM multimedia WHERE tipo = 3 AND tc = 1 order by id desc");
  $consulta->execute();
  $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
  echo '<ol class="carousel-indicators">';
  $select=0;
    foreach($respuesta as $key => $value){
      if($select==0){
        $c="class='active'";
      }
      echo '<li data-target="#carouselExample" data-slide-to="'.$key.'" '.$c.'></li>';
      $select++;
      $c='';
    }
    echo '</ol>';
  $this->dbClose();
}


function gMImagen(){
  $conn= $this->cnx();
  $consulta = $conn->prepare("SELECT ruta, descr, id FROM multimedia WHERE tipo = 3 AND tc = 1 order by id desc");
  $consulta->execute();
  $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);

  echo '<div class="modal fade coloros" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" >
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content color0">
      <div class="modal-header d-flex flex-row-reverse">
        <ul class="mmodal">
          <li><a class="iconMM" href="#carouselExample" role="button" data-dismiss="modal"><i class="material-icons px-2" >close</i></a></li>
          <li><a class="iconMM" href="#carouselExample" role="button" data-slide="next"><i class="material-icons" >navigate_next</i></a></li>
          <li><a class="iconMM" href="#carouselExample" role="button" data-slide="prev"><i class="material-icons px-3">navigate_before</i></a></li>
        </ul>
      </div>
      <div class="modal-body color0">
        <div id="carouselExample" class="carousel slide" data-ride="carousel">';
          self::gOlimg();
      echo '<div class="carousel-inner">';
          $select=0;
          foreach($respuesta as $value){
            if($select==0){
              $c="active";
            }
              echo '<div class="carousel-item '.$c.'">
                      <div class="d-flex justify-content-center">
                        <img class="zoom" alt="'.$value['descr'].'"  src="/../upload/Imagenes/'.$value['ruta'].'">
                      </div>
                            <div class="carousel-caption mb-5 pb-5">
                            <h3>'.$value['descr'].'</h3>
                            </div>
                    </div>';
            $select++;
            $c='';
          }    
      echo '</div>     
        </div>
      </div>
    </div>
  </div>
</div>';
  $this->dbClose();
}


function gVideo(){
 
  $conn= $this->cnx();
  $consulta = $conn->prepare("SELECT ruta, id FROM multimedia WHERE tipo = 3 AND tc = 3 order by id desc");
  $consulta->execute();
  $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
  echo '<div class="row justify-content-center align-items-center mb-2">';
   foreach($respuesta as $key => $value){
          echo "<div class='carta te flex-fill'>
                    <div class='embed-responsive embed-responsive-16by9'>
                      <video class='embed-responsive-item' controls controlslist='nodownload' preload='auto' src=".$value['ruta']." >Tu navegador no soporta MP4.</video>
                    </div>
                </div>";   
  }
    echo '</div>';
  $this->dbClose();
}

function lComentarios(){
  $conn = $this->cnx();
  $consulta = $conn ->prepare("SELECT id, comment, cname FROM  comments where estado = 1 order by id  desc limit 25");
  $consulta->execute();
  $respuesta = $consulta->fetchAll(PDO::FETCH_ASSOC);
  foreach($respuesta as $value){
    echo "<div class='carta flex-fill color3'>
            <h4 class='text-center'>".$value['comment']."</h4>
            <h6 class='text-right'>Por: ".$value['cname']."</h6>
          </div>";
  }
}

function sComentario($comment, $cname, $mail){
  $conn = $this->cnx();
  $consulta = $conn ->prepare("INSERT INTO comments(comment, cname, mail) VALUES(:comment, :cname, :mail)");
  $consulta ->bindValue(":comment", $comment);
  $consulta ->bindValue(":cname", $cname);
  $consulta ->bindValue(":mail", $mail);
  if($consulta->execute()){
    echo "El registro se ha enviado exitosamente, una vez sea aprovado, se podra ver en la pagina";
  }else{
    echo "Error al enviar el registro, intentanuevamente";
  }
}


//fin de la clase  
}


?>
