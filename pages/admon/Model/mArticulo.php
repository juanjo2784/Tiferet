<?php
//echo getcwd();

include_once("conexion.php");
class Articulo extends CNX {
  private $consulta;
  private $respuesta = [];
  public $titulo;
  public $subtitulo;
  public $autor;
  public $tcr;
  public $contenido;
  public $fecha;
  public $id;
  public $tf; //tipo de archivo
  public $nfile;
  public $idTema;
  public $nameTema;
  public $aRelacionados;
  
 function addFile($fzise, $tmp_name, $ruta, $fname){
    if(!empty($tmp_name)){
      if($fzise<9000000){
        // echo "Ori:".$tmp_name."<br>Destino: ".$ruta.$fname;
        if(move_uploaded_file($tmp_name,$ruta.$fname)){
          $_SESSION['msg2']=2;
        }else{
         $_SESSION['msg2']=1;
        }
      }else{
        $_SESSION['msg2']=0;
        if(is_file($ruta.$fname)){
         @unlink(ini_get('upload_tmp_dir'.$tmp_name));
         $_SESSION['msg2']=0;
        }
      }

    }

 }

  function ListadoArticulos($idTema){
    $conn = $this->cnx();
      $this->consulta = $conn->prepare("select titulo, idArticulos from articulos where idTema = :idTema");
      $this->consulta ->bindValue(":idTema", $idTema);
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll();
      echo '<ul>';
      foreach ($this->respuesta as $value){
        echo '<li class="nav-item"><a class="slink"  href="?c='.$idTema.'&a='.(int)$value['idArticulos'].'">'.$value['titulo'].'</a></li>';
      }
      echo '</ul>';
    $this->dbClose();
  }
  
  function lArticulos($idTema){
    $conn = $this->cnx();
    $this->consulta = $conn->prepare("SELECT idArticulos, titulo FROM articulos WHERE idTema = :idTema");
    $this->consulta ->bindValue(":idTema", $idTema);
    $this->consulta->execute();
    $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
      foreach($this->respuesta as $valor){
        echo '<option value="'.(int)$valor['idArticulos'].'">'.$valor['titulo'].'</option>';
      }
    $this->dbClose();
    }

  function lTemas(){
    $conn = $this->cnx();
    $this->consulta = $conn->prepare("SELECT * FROM temas");
    $this->consulta->execute();
    $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
    echo "<option value='0' >Parasha</option>";
      foreach($this->respuesta as $valor){
        echo '<option value="'.(int)$valor['id'].'">'.$valor['name'].'</option>';
      }
    $this->dbClose();
    }

    function bTemas($id){
      $conn = $this->cnx();
      $this->consulta = $conn->prepare("SELECT id, name FROM temas WHERE id = :id");
      $this->consulta ->bindValue(":id", $id);
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
          if($id==0){
            $this->nameTema="Parasha";
            echo '<option value="0" selected="true">Parasha</option>';
          }else{
            $this->nameTema=$this->respuesta[0]['name'];
            echo '<option value="'.$this->respuesta[0]['id'].'" selected="true">'.$this->respuesta[0]['name'].'</option>';
          }
      $this->dbClose();

      return $this->nameTema;
      }

      function mArticulo($id){
        //print_r($ar);
        echo "<table class='table table-dark table-striped'>";
        echo "<thead><tr><th>Articulo</th><th class ='align-right'></th></tr></thead>";
        $conn = $this->cnx();
          foreach($id as $key=>$articulo){
            $sql = "SELECT idArticulos, titulo FROM articulos WHERE idArticulos = $articulo";
            $this->consulta = $conn->prepare($sql);
            $this->consulta->execute();
            $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
            echo '<tr><td>'.$this->respuesta[0]['titulo'].'</td><th class="d-flex flex-row-reverse" id="ord'.$key.'"><a  onclick="$(function(){
              let datos;
              datos = $(\'#tmas\').val();
              datos=datos.split(\',\');
              console.log(datos);
              let orden = '.$key.';
              nuevos = datos.splice(orden,1);
              console.log(datos);
              $(\'#tmas\').val(datos);
              $.ajax({
                type: \'POST\',
                url: \'/pages/admon/Articulos/tArticulos.php\',
                data: {idArticulos: datos},
                    success:function(responce){
                    $(\'#listado\').html(responce);
                    }
                })
            })" class="btn btn-danger" ><i class="large material-icons">clear</i></a></th></tr>';
          }
          echo "<tbody>";
          echo "</tbody></table>";
        }

  function BuscarArticulo($p){
    $conn = $this->cnx();
        $this->consulta = $conn->prepare("SELECT * FROM articulos WHERE idArticulos = :p");
        $this->consulta ->bindValue(":p", $p);
        $this->consulta->execute();
        $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
          foreach($this->respuesta as $valor){
            $this->titulo = $valor['titulo'];
            $this->subtitulo = $valor['subtitulo'];
            $this->autor = $valor['autor'];
            $this->contenido = $valor['contenido'];
            $this->tcr = $valor['tcr'];
            $this->fecha = $valor['fecha'];
            $this->nfile = $valor['nimg'];
            $this->idTema = $valor['idTema'];
            $this->aRelacionados = $valor['arelacionados'];
            $this->id = $p;
          } 
    $this->dbClose();
  }

  function AddArticulo($titulo, $subtitulo, $autor, $idTema, $contenido, $tcr, $fecha,  $nimg, $aRelacionados){
    $conn = $this->cnx();
    $sql='INSERT INTO articulos (titulo, subtitulo, autor, idTema, contenido, tcr, fecha, nimg, arelacionados) VALUES (:titulo, :subtitulo, :autor, :idTema, :contenido, :tcr, :fecha, :nimg, :aRelacionados)';
    try{
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(":titulo", $titulo);
      $stmt->bindValue(":subtitulo", $subtitulo);
      $stmt->bindValue(":autor", $autor);
      $stmt->bindValue(":idTema", $idTema);
      $stmt->bindValue(":contenido", $contenido); 
      $stmt->bindValue(":tcr", $tcr);
      $stmt->bindValue(":fecha", $fecha);
      $stmt->bindValue(":nimg", $nimg);
      $stmt->bindValue(":aRelacionados", $aRelacionados);
      if($stmt->execute()){
        $_SESSION['msg']=3;
      }else{
        $_SESSION['msg']=0;
      }
      $this->dbClose();
    }catch(Exception $e){
      echo $e;
    }
  }

  function UpdateArticulo($titulo, $subtitulo, $autor,  $idTema, $tipo, $contenido, $tcr, $fname, $aRelacionados, $id){
    $pdo = $this->cnx();
    if ($fname != ""){
      $sql = "UPDATE articulos SET titulo = :titulo, subtitulo = :subtitulo, autor = :autor, contenido = :contenido, tcr = :tcr, nimg = :fname, idTema =:idTema,arelacionados = :aRelacionados WHERE idArticulos = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":titulo", $titulo);
      $stmt->bindValue(":subtitulo", $subtitulo);
      $stmt->bindValue(":autor", $autor);
      $stmt->bindValue(":contenido", $contenido); 
      $stmt->bindValue(":tcr", $tcr);
      $stmt->bindValue(":fname", $fname);
      $stmt->bindValue(":idTema", $idTema);
      $stmt->bindValue(":aRelacionados", $aRelacionados);
      $stmt->bindValue(":id", $id);
    } else {
      $sql = "UPDATE articulos SET titulo = :titulo, subtitulo = :subtitulo, autor = :autor, contenido = :contenido, tcr = :tcr,  idTema =:idTema,arelacionados = :aRelacionados WHERE idArticulos = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":titulo", $titulo);
      $stmt->bindValue(":subtitulo", $subtitulo);
      $stmt->bindValue(":autor", $autor);
      $stmt->bindValue(":contenido", $contenido); 
      $stmt->bindValue(":tcr", $tcr);
      $stmt->bindValue(":idTema", $idTema);
      $stmt->bindValue(":aRelacionados", $aRelacionados);
      $stmt->bindValue(":id", $id);    
    }
      if($stmt->execute()){
        $_SESSION['msg']=3;
      }else{
        $_SESSION['msg']=0;
      }
    $pdo=null;
  }

  function DelArticulo($p){
    $conn = $this->cnx();
    $this->consulta = $conn->prepare("DELETE FROM articulos WHERE (idArticulos=:p)");
    $this->consulta ->bindValue(":p", $p);
    $this->consulta->execute();
    $this->dbClose();
  }

  function gTitulo(){
    echo $this->titulo;
  }

  function gSubtitulo(){
    if(!empty($this->subtitulo)){
      echo $this->subtitulo;
    }else{
      echo '';
    }
  }

  function gAutor(){
    echo $this->autor;
  }

  function gContenido(){
    echo $this->contenido;
  }

  function gTcr(){
    echo $this->tcr;
  }

  function gFecha(){
    echo $this->fecha;
  }  

  function gId(){
    echo $this->id;
  }

  function gFname(){
    echo $this->nfile;
  } 

  function gidTema(){
    return $this->idTema;
  } 

  function gNameTema(){
    return $this->nameTema;
  }
  function gaRelacionados(){
    return $this->aRelacionados;
  } 

  function dbClose(){
    $this->conn = NULL;
    $this->consulta = NULL;
  }

 }
?>
