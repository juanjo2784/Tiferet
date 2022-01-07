<?php
include_once("conexion.php");
//error_reporting(0);
class BD extends CNX {
  private $consulta;
  private $respuesta = [];
  private $titulo;
  private $contenido;
  private $icono;
  private $tcr;
  private $nimg;
  private $fecha;
  private $autor;
  private $id;
  private $idtema;
  private $tema;
  private $itema;
  private $rarticle;

//Metods
  function ListadoArticulos($tipo){
    $conn = $this->cnx();
    try{
      $this->consulta = $conn->prepare("select titulo, idArticulos from articulos where idTema = :tipo order by idArticulos desc");
      $this->consulta->execute(array(':tipo'=>$tipo));
      $this->respuesta = $this->consulta->fetchAll();
      echo '<ul>';
      foreach ($this->respuesta as $value){
        echo '<li style="padding: 5px 0 5px 0;"><a href="'.(int)$value['idArticulos'].'">'.$value['titulo'].'</a></li>';
      }
      echo '</ul>';
      } catch (Exception $e) {
      echo "Error al realizar la consulta";   
    }
    $this->dbClose();
  }

  function Eventos(){
    $conn= $this->cnx();
    try{
      $this->consulta = $conn->prepare("SELECT id, title, inicio as start, textColor, backgroundColor, dir, img, audio FROM eventos");
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($this->respuesta);
      } catch (Exception $e) {
      echo "Error al realizar la consulta";   
    }
    $this->dbClose();
  }

  function mParasha(){
    $this->respuesta=NULL;
    $conn = $this->cnx();
    try{
      $this->consulta = $conn->prepare("SELECT contenido, titulo, subtitulo, autor, fecha, tcr, nimg FROM articulos WHERE titulo = :id");
      $this->consulta->execute(array(':id'=>$_COOKIE['item']));
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC); 
      if ($this->respuesta){
        foreach($this->respuesta as $valor){
          $this->titulo = $valor['titulo'];
          $this->subtitulo = $valor['subtitulo'];
          $this->autor = $valor['autor'];
          $this->contenido = $valor['contenido'];
          $this->tcr = $valor['tcr'];
          $this->fecha = $valor['fecha'];
          $this->nimg = $valor['nimg'];
          $this->idtema = $valor['idtema'];
          $this->rarticle = $valor['arelacionados'];
          $this->id = $p;
        } 
      } else {
        throw new Exception("<div class='container alert alert-primary alert-dismissible'>
                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                              <strong>Oops!</strong> No hemos cargado aún la Parasha haShavua, Estamos trabajando para mantener nuestros contenidos actualizados.
                            </div>");
      }
    } catch (Exception $e) {
      echo $e->getMessage(), "\n";
    }
    $this->dbClose();
  }

  function bArticulo($p){
    $conn= $this->cnx();
    $this->consulta = $conn->prepare("SELECT contenido, idtema, arelacionados, titulo, subtitulo, autor, fecha, tcr, nimg FROM articulos WHERE idArticulos = :id");
    $this->consulta->execute(array(':id'=>$p));
    $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
    foreach($this->respuesta as $valor){
      $this->titulo = $valor['titulo'];
      $this->subtitulo = $valor['subtitulo'];
      $this->autor = $valor['autor'];
      $this->contenido = $valor['contenido'];
      $this->tcr = $valor['tcr'];
      $this->fecha = $valor['fecha'];
      $this->nimg = $valor['nimg'];
      $this->idtema = $valor['idtema'];
      $this->rarticle = $valor['arelacionados'];
      $this->id = $p;
    }
    $this->dbClose();
  }

  function bUArticulo($tipo){
    $conn= $this->cnx();
    $this->consulta = $conn->prepare("SELECT contenido, idArticulos, idtema, arelacionados, titulo, subtitulo, autor, fecha, tcr, nimg FROM articulos where idTema = $tipo order by idArticulos desc limit 1");
    $this->consulta->execute();
    $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
    foreach($this->respuesta as $valor){
      $this->titulo = $valor['titulo'];
      $this->subtitulo = $valor['subtitulo'];
      $this->autor = $valor['autor'];
      $this->contenido = $valor['contenido'];
      $this->tcr = $valor['tcr'];
      $this->fecha = $valor['fecha'];
      $this->nimg = $valor['nimg'];
      $this->idtema = $valor['idtema'];
      $this->rarticle = $valor['arelacionados'];
      $this->id=$valor['idArticulos'];
    }
    
    $this->dbClose();
  }

function bTemas($id){
  $conn = $this->cnx();
      $this->consulta = $conn->prepare("SELECT * FROM temas WHERE id = :id");
      $this->consulta->bindValue(":id", $id);
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
      if(count($this->respuesta)>0){
        echo "<div class='text-right'> <h5>Tema del articulo</h5>";
        foreach($this->respuesta as $valor){
          $this->tema = $valor['name'];
          $this->itema = $valor['icon'];
          echo '<a class="slink"  href="/temas/'.$id.'/'.'">'.$valor['name'].'</a>';
        }
      echo "</div>";
      }

  $this->dbClose();
  }

function lArticles($la){
  $list=explode(',',$la);
  if (!empty($list)){
    $conn = $this->cnx();
    foreach($list as $item){
      $this->consulta = $conn->prepare("SELECT titulo FROM articulos where idArticulos = $item");
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
      if(!empty($this->respuesta[0])){
        echo '<li><a class="slink"  href="'.$item.'">'.$this->respuesta[0]['titulo'].'</a></li>';
      }
      
    }
    echo "</ul>";
  }
}

function lAT($idtema){
  self::dTemas($idtema);
  //echo self::gTema();
  $conn = $this->cnx();
  $this->consulta = $conn->prepare("SELECT idArticulos, tipo, titulo FROM articulos where idTema=$idtema");
  $this->consulta->execute();
  $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
  $k=0;
  $j=count($this->respuesta);
    foreach($this->respuesta as $value){
      if($k==0){
        echo "<div class='row justify-content-center align-items-center'>"; 
      }
  ?>
    <div class = 'tm col-12 flex-fill'>
      <a href="<?php echo $ruta."/article"."/".$value['tipo'] ."/".$value['idArticulos']."/"; ?>">
        <div class='carta color5'>
            <div class='card-encabezado text-center'><i class='material-icons md50 cfi7'><?php echo self::gItema() ?></i></div>
            <div class='card-body'><h4 class='text-center'><?php echo $value['titulo'] ?></h4></div>
        </div>
      </a>
    </div>
  <?php  
      $k+=1;
      if($k==3 || $k==$j){
        echo "</div>";
        $j-=$k;
        $k=0;
      }  
  }

  $this->dbClose();
}

function dTemas($id){
  $conn = $this->cnx();
      $this->consulta = $conn->prepare("SELECT * FROM temas WHERE id = $id");
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
      if(isset($this->respuesta[0])){
        $this->tema=$this->respuesta[0]['name'];
        $this->itema=$this->respuesta[0]['icon'];
      }
  }

  function lTemas(){
    $conn = $this->cnx();
    $this->consulta = $conn->prepare("SELECT * FROM temas");
    $this->consulta->execute();
    $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
    $k=0;
    $j=count($this->respuesta);
      foreach($this->respuesta as $value){
        if($k==0){
          echo "<div class='row justify-content-center align-items-center'>"; 
        }
    ?>
      <div class = 'tm col-12 flex-fill'>
        <a href="<?php echo $value['id'].'/' ?>">
          <div class='carta color5'>
              <div class='card-encabezado text-center'><i class='material-icons md50 cfi7'><?php echo $value['icon'] ?></i></div>
              <div class='card-body'><h4 class='text-center'><?php echo $value['name'] ?></h4></div>
          </div>
        </a>
      </div>
    <?php  
        $k+=1;
        if($k==3 || $k==$j){
          echo "</div>";
          $j-=$k;
          $k=0;
        }  
    }

    $this->dbClose();
  }


  function gTitulo(){
    return $this->titulo;
  }

  function gSubtitulo(){
    if(!empty($this->subtitulo)){
      return $this->subtitulo;
    }    
  }

  function gAutor(){
    return $this->autor;
  }

  function gFecha(){
    echo $this->fecha;
  }  

  function gContenido(){
    //echo nl2br($this->contenido);
    return $this->contenido;
  }

  function gTcr(){
    return $this->tcr;
  }

  function gId(){
    return $this->id;
  }

  function gidTema(){
    return $this->idtema;
  }

  function gRarticle(){
    return $this->rarticle;
  }

  function gTema(){
    return $this->tema;
  }

  function gItema(){
    return $this->itema;
  }

  function dbClose(){
    $conn= $this->cnx();
    $conn = NULL;
    $this->consulta = NULL;
  }

  function gImg(){
    if($this->nimg<>""){
      echo "<img src='/../../upload/Imagenes/$this->nimg' class='img-thumbnail' style='max-width:300px; padding:0; margin-bottom:10px;'>";
    }else{
      echo "";
    }
   }
   //img pdf
   function gSimg(){
    if($this->nimg<>""){
      return 'upload/Imagenes/'.$this->nimg;
    }else{
      return;
    }
    
  }

 //informacion de la fundacion
    public $acronym;
    public $city;
    public $dir;
    public $introd;
    public $legal_representive;
    public $mail;
    public $mision;
    public $vision;
    public $name;
    public $tel_dial;
    public $tel_show;
  //metodos de información de fundacion
  function cFundacion(){
    $conn = $this->cnx();
        $this->consulta = $conn->prepare("SELECT * FROM Fundacion WHERE id = 1");
        $this->consulta->execute();
        $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
          foreach($this->respuesta as $valor){
            $this->acronym = $valor['acronym'];
            $this->city = $valor['city'];
            $this->dir = $valor['dir'];
            $this->legal_representive = $valor['legal_representive'];
            $this->mail = $valor['mail'];
            $this->introd = $valor['introd'];
            $this->mision = $valor['mision'];
            $this->vision = $valor['vision'];
            $this->name = $valor['name'];
            $this->tel_dial = $valor['tel_dial'];
            $this->tel_show = $valor['tel_show'];
          }
    $this->dbClose();
  }

  function gAcronym(){
    return $this->acronym;
  }

  function gCity(){
    return $this->city;
  }

  function gDir(){
    return $this->dir;
  }

  function gImgintro(){
    if(!empty($this->img_intro)){
      return $this->contenido;
    }    
  }

  function gIntrod(){
    return $this->introd;
  }

  function gLegal_representive(){
    return $this->legal_representive;
  }  

  function gLogo_banner(){
    return $this->logo_banner;
  }

  function gLogo_footer(){
    return $this->logo_footer;
  } 

  function gMail(){
    return $this->mail;
  } 


  function gName(){
    return $this->name;
  } 


  function gMision(){
    return $this->mision;
  } 


  function gTel_dial(){
    return $this->tel_dial;
  } 


  function gTel_show(){
    return $this->tel_show;
  } 


  function gVision(){
    return $this->vision;
  } 

 //Eventos
   function gAudioE($c){
   
     if($c==1){
      $sql="SELECT * FROM eventos order by id desc";
    }else{
      $sql="SELECT * FROM eventos order by id desc limit 3";
    }
    $conn= $this->cnx();
    $this->consulta = $conn->prepare($sql);
    $this->consulta->execute();
    $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
    $k=0;
    $j=count($this->respuesta);
      foreach($this->respuesta as $value){
        if($k==0){
          echo "<div class='row justify-content-center align-items-center mb-2' >"; 
        }
        ?>
        <div class = 'te flex-fill my-3'>
          <a data-toggle='modal' data-target="#myModal<?php echo $value['id'] ?>" data-backdrop="static" data-keyboard="false" onclick="document.getElementById('archivo<?php echo $value['id'] ?>').play();">
            <div class='carta2 color5'>
                <div class='card-encabezado text-center'><h4 class='text-center'><?php echo $value['title'] ?></h4>
                <div><?php
                  $fecha = new datetime($value['inicio'] );
                  $f= $fecha->format('d-M');
                  $h=$fecha->format('G:s');
                  echo "Fecha: ".$f."  Hora:" .$h;
                ?></div></div>
                <div class='card-body'><img class="imgEv him" src="<?php echo $value['img']?>" ></div>
            </div>
          </a>
        </div>
    
        <div class='modal fade' id="myModal<?php echo $value['id']; ?>"  tabindex='5' role='dialog' >
              <div class='modal-dialog modal-lg'>
              <div class="modal-content">
                  <center>
                    <?php $this->gSrcEvento($value['audio'], $value['img'],$value['id']) ?>
                  </center>
                </div>
              </div>
            </div>
      
        <?php  
        $k+=1;
        if($k==3 || $k==$j){
          echo "</div>";
          $j-=$k;
          $k=0;
        }  
    }
    $this->dbClose();
  }

  function gSrcEvento($src, $img, $id){

    $mostrar = "<a type='button'  class='d-flex justify-content-end' data-dismiss='modal' onclick='document.getElementById(\"archivo".$id."\").pause();'><i class='large material-icons close2'>close</i></a>
    <div class='color8 justify-content-center align-items-center'>
      <ul class='mmodal'>
        <li><a class='iconMM' href='#CGaleria' role='button' data-dismiss='modal'><i class='material-icons px-2' ></i></a></li>
      </ul>
      <center>
        <audio id='archivo".$id."' src=".$src." controls controlslist='nodownload'>Tu navegador no Soporta MP3.</audio>
        <img  class='w-75 mgaleria mt-3 mb-2' src=".$img."  >
      </center>
    </div>";

    echo $mostrar;
  }


//EQUIPO
function gEquipo(){
  $sql = "SELECT shem, titulo, correo, rol, cargo, foto, id FROM user where rol = 3";
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
        echo '<div class = "tm flex-fill">
              <div class="carta2 color5 cfi8">
              <div class="card-encabezado text-center"><img src="'.$dato['foto'].'" class="zoom img-fluid "></div>
              <div class="card-body">
              <h5 class="text-center">'.$dato['shem'].'</h5>
              <h6 class="text-center">'.$dato['titulo'].'</h6>
              <h6 class="text-center">'.$dato['cargo'].'</h6>
              <p class="text-center">'.$dato['correo'].'</p>
              </div>
              </div>
          </div>';
  
          $k+=1;
          if($k==3 || $k==$j){
            $j-=$k;
            $k=0;
          } 
    
          $this->dbClose();
        }
  }

function vTeam(){
  $sql = "SELECT rol FROM user where rol = 3";
  $conn = $this->cnx();
  $consulta = $conn->prepare($sql);
  $consulta->execute();
  $cant = $consulta ->fetch(PDO::FETCH_NUM);
    if($cant > 0){
      echo '<div class="row justify-content-center" >
      <div class="container-fluid color3 pt-3">
        <h2 class="text-center display-4" >Nuestro Equipo</h2>';
        self::gEquipo();
      echo '</div></div>';
    }
  }



 }

?>