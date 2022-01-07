<?php
//echo getcwd();
include_once("conexion.php");
class DTA extends CNX {
  private $consulta;
  private $respuesta = [];
  public $idTema;
  public $nameTema;
  public $aRelacionados;
  
  function ListadoArticulos($idTema){
    $conn = $this->cnx();
      $this->consulta = $conn->prepare("select titulo, idArticulos from articulos where idTema = :idTema");
      $this->consulta ->bindValue(":idTema", $idTema);
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll();
      echo '<ul>';
      foreach ($this->respuesta as $value){
        echo '<li class="nav-item"><a class="slink"  href="?c=1&a='.(int)$value['idArticulos'].'">'.$value['titulo'].'</a></li>';
      }
      echo '</ul>';
    $this->dbClose();
  }

  function Lmultimedia($tipo, $tc){
    $conn = $this->cnx();
    $sql="SELECT titulo, id, tc FROM multimedia WHERE tipo = :tipo AND tc = :tc";
      $this->consulta = $conn->prepare($sql);
      $this->consulta ->bindValue(":tipo", $tipo);
      $this->consulta ->bindValue(":tc", $tc);
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll();
      echo '<ul class="tlink">';
      foreach ($this->respuesta as $value){
        echo '<li><a class="slink" href="?a=multimedia&id='.$value['id'].'&tc='.$value['tc'].'&tipo='.$tipo.'">'.$value['titulo'].'</a></li>';
      }
      echo '</ul>';
      $src="";
    $this->dbClose();
  }

  function Lmuro($tc){
    $conn = $this->cnx();
    $sql="SELECT titulo, id, tc FROM multimedia WHERE tipo = 3 AND tc = :tc";
      $this->consulta = $conn->prepare($sql);
      $this->consulta ->bindValue(":tc", $tc);
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll();
      echo '<ul class="tlink">';
      foreach ($this->respuesta as $value){
        echo '<li><a class="slink" href="?a=muro&id='.$value['id'].'&tc='.$value['tc'].'&tipo=3">'.$value['titulo'].'</a></li>';
      }
      echo '</ul>';
      $src="";
    $this->dbClose();
  }
  
  function lArticulos($idTema){
    $conn = $this->cnx();
    $this->consulta = $conn->prepare("SELECT idArticulos, titulo FROM articulos WHERE idTema = :idTema");
    $this->consulta ->bindValue(":idTema", $idTema);
    $this->consulta->execute();
    $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
    echo '<option value="0" selected ></option>';
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
            $this->nameTema="Parashot";
            echo '<option value="0" selected="true">Parashot</option>';
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
                url: \'/pages/admon/Multimedia/tArticulos.php\',
                data: {idArticulos: datos},
                    success:function(responce){
                    $(\'#lista\').html(responce);
                    }
                })
            })" class="btn btn-danger" ><i class="large material-icons">clear</i></a></th></tr>';
          }
          echo "<tbody>";
          echo "</tbody></table>";
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
