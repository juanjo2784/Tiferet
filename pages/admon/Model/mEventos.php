<?php
include_once("conexion.php");
class Evento extends CNX {
  private $consulta;
  private $respuesta = [];

  function addFile($fzise, $tmp_name, $ruta, $fname){
     if($fzise<9000000 && !is_file($ruta.$fname)){
      if(move_uploaded_file($tmp_name,$ruta.$fname)){
        $_SESSION['msg2']=2;
      }else{
        $_SESSION['msg2']=1;
      }
    }else{
      $_SESSION['msg2']=0;
      @unlink(ini_get('upload_tmp_dir'.$tmp_name));
    }
  }

  function Eventos(){
    $conn = $this->cnx();
    try{
      $this->consulta = $conn->prepare("SELECT id, title, inicio as start, textColor, backgroundColor, dir, img, audio FROM eventos");
      $this->consulta->execute();
      $this->respuesta = $this->consulta->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($this->respuesta,JSON_FORCE_OBJECT);
      } catch (Exception $e) {
      echo "Error al realizar la consulta";   
    }
    $this->dbClose();
  }

  function dbClose(){
    $conn = NULL;
    $this->consulta = NULL;
  }

  function AddEvento($title, $inicio, $color, $fondo, $dir, $img){
    $conn = $this->cnx();
      $this->consulta = $conn->prepare("INSERT INTO eventos (title, inicio, backgroundColor, textColor, dir, img) VALUES (:title, :inicio, :backgroundColor, :textColor, :dir, :img)");
      $this->consulta->execute(array(":title"=>$title, ":inicio" => $inicio, ":backgroundColor"=>$fondo, ":textColor"=>$color, ":dir"=>$dir,":img"=> $img));
      $this->dbClose();
  }

  function upEvento($id, $title, $inicio, $color, $fondo, $dir, $img, $audio){
      $inicio='\''.$inicio.'\'';
      $img='\''.$img.'\'';
      $audio='\''.$audio.'\'';
      $color='\''.$color.'\'';
      $fondo='\''.$fondo.'\'';
    $conn = $this->cnx();
    $this->consulta = $conn->prepare("UPDATE eventos set title=:title, inicio=$inicio, textColor=$color, backgroundColor=$fondo, dir=:dir, img=$img, audio=$audio  WHERE (id=$id)");
    $this->consulta->execute(array(":title"=>$title, ":dir"=>$dir));
    $this->dbClose();
  }

  function delEvento($id){
    $conn = $this->cnx();
    try{
      $this->consulta = $conn->prepare("DELETE FROM eventos WHERE (id=$id)");
      $this->consulta->execute();
    } catch (Exception $e){
      echo "Error al eliminar";
    }
  $this->dbClose();
  }

 }
?>