<?php
//echo getcwd();
include_once("conexion.php");
class Fundacion extends CNX {
  private $consulta;
  private $respuesta = [];
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

  function addFile($fzise, $tmp_name, $ruta, $fname){
    if($fzise<9000000){
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

  function UpdateFundacion($name,$acronym,$legal_representive, $dir, $city, $tel_show,$tel_dial,$mail,$introd, $mision, $vision, $id){
    $pdo = $this->cnx();
    $sql = "UPDATE Fundacion SET name = :name,
    acronym = :acronym,
    legal_representive = :legal_representive,
    tel_show = :tel_show,
    tel_dial = :tel_dial,
    dir = :dir,
    city = :city,
    mail = :mail,
    mision = :mision,
    vision = :vision,
    introd = :introd";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":acronym", $acronym);
      $stmt->bindValue(":legal_representive", $legal_representive);
      $stmt->bindValue(":tel_dial", $tel_dial);
      $stmt->bindValue(":tel_show", $tel_show);
      $stmt->bindValue(":dir", $dir);
      $stmt->bindValue(":city", $city);
      $stmt->bindValue(":mail", $mail);
      $stmt->bindValue(":mision", $mision);
      $stmt->bindValue(":vision", $vision);
      $stmt->bindValue(":introd", $introd);
      $stmt->execute();
      header('Location: /pages/admon/admin.php?a=admin');
    $pdo=null;
  }


  function gAcronym(){
    echo $this->acronym;
  }

  function gCity(){
    echo $this->city;
  }

  function gDir(){
    echo $this->dir;
  }

  function gImgintro(){
    if(!empty($this->img_intro)){
      echo $this->contenido;
    }    
  }

  function gIntrod(){
    echo $this->introd;
  }

  function gLegal_representive(){
    echo $this->legal_representive;
  }  

  function gLogo_banner(){
    echo $this->logo_banner;
  }

  function gLogo_footer(){
    echo $this->logo_footer;
  } 

  function gMail(){
    echo $this->mail;
  } 


  function gName(){
    echo $this->name;
  } 


  function gMision(){
    echo $this->mision;
  } 


  function gTel_dial(){
    echo $this->tel_dial;
  } 


  function gTel_show(){
    echo $this->tel_show;
  } 


  function gVision(){
    echo $this->vision;
  } 

  function dbClose(){
    $this->conn = NULL;
    $this->consulta = NULL;
  }

 }
?>
