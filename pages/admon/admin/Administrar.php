<?php 
//echo getcwd();
include_once("Model/mAdmin.php");
$registro = new Fundacion;
$registro -> cFundacion();

$acronym = (!empty($_POST['acronym']))?$_POST['acronym']:"";
$city = (!empty($_POST['city']))?$_POST['city']:"";
$dir = (!empty($_POST['dir']))?$_POST['dir']:"";
/*$img_intro = (!empty($_POST['img_intro']))?$_POST['img_intro']:"";
$logo_banner = (!empty($_POST['logo_banner']))?$_POST['logo_banner']:"";       
$logo_footer = (!empty($_POST['logo_footer']))?$_POST['logo_footer']:"";*/
$legal_representive = (!empty($_POST['legal_representive']))?$_POST['legal_representive']:"";
$mail = (!empty($_POST['mail']))?$_POST['mail']:"";
$mision = (!empty($_POST['mision']))?$_POST['mision']:"";
$vision = (!empty($_POST['vision']))?$_POST['vision']:"";
$name = (!empty($_POST['name']))?$_POST['name']:"";
$tel_dial = (!empty($_POST['tel_dial']))?$_POST['tel_dial']:"";
$tel_show = (!empty($_POST['tel_show']))?$_POST['tel_show']:"";
$introd = (!empty($_POST['introd']))?$_POST['introd']:"";
if($_POST){
  /*/logo
  if(!empty(($_FILES['logo']))){
    $fzise = $_FILES['logo']['size'];
    $tmp_name = $_FILES['logo']['tmp_name'];
    $ruta = "../../img/";
    $fname ="logo.png";
    if(!strpos($_FILES['logo']['type'],"png")){
      $registro -> addFile($fzise,$tmp_name, $ruta, $fname);
    }
  }
  //img_footer
  if(!empty(($_FILES['img_footer']))){
    $fzise = $_FILES['img_footer']['size'];
    $tmp_name = $_FILES['img_footer']['tmp_name'];
    $ruta = "../../img/";
    $fname = "img_footer.png";
    if(!strpos($_FILES['img_footer']['type'],"png")){
      $registro -> addFile($fzise,$tmp_name, $ruta, $fname);
    }
  }

  //img_introd
  if(!empty(($_FILES['img_intro']))){
    $fzise = $_FILES['img_intro']['size'];
    $tmp_name = $_FILES['img_intro']['tmp_name'];
    $ruta = "../../img/";
    $fname = "img_intro.png";
    if(!strpos($_FILES['img_intro']['type'],"png")){
      $registro -> addFile($fzise,$tmp_name, $ruta, $fname);
    }
  }
  */
  //guardar
  try{
    //print_r($_POST);
    $registro->UpdateFundacion($name,$acronym,$legal_representive, $dir, $city, $tel_show,$tel_dial,$mail,$introd, $mision, $vision, 1);
    $_SESSION['msg']=3;
  } catch (Exception $e){
    $_SESSION['msg']=0;
    echo $e;
  }


}
?>

<div class="container cartag">
<?php
include_once('Config/msg.php');
?>
<form action="" method="post" enctype="multipart/form-data">
<fieldset><legend class="text-center">Informacion sobre la fundacion</legend>

<div class="form-group row">
  <label for="name" class="col-xs-12  col-lg-3 col-form-label">Nombre y Logo</label>
  <div class="col-xs-12  col-lg-9"> <!--value="<//?php $article->gName() ?>"-->
    <input type="text" class="form-control col-8 float-left" id="name" name="name" value="<?php $registro->gName(); ?>" >
    <input type="file" class="form-control col-4" name="logo" />
  </div>
</div>

<div class="form-group row">
  <label for="sigla" class="col-xs-12  col-lg-3 col-form-label">Sigla e Imagen Footer</label>
  <div class="col-xs-12  col-lg-9">
    <input type="text" class="form-control col-8 float-left" id="acronym" name="acronym"  placeholder="Sigla" value="<?php $registro->gAcronym(); ?>">
    <input type="file" class="form-control col-4" name="img_footer" />
  </div>
</div>


<div class="form-group row">
  <div class="col-xs-12  col-lg-12">
  <input type="text" class="form-control col-4 float-left" name="legal_representive"  placeholder="Representante Legal" value="<?php $registro->gLegal_representive();?>">
    <input type="text" class="form-control col-5 float-left" name="dir"  placeholder="Dirección" value="<?php $registro->gDir();?>">
    <input type="text" class="form-control col-3 float-left" name="city"  placeholder="Ciudad" value="<?php $registro->gCity();?>"> 
  </div>
</div>

<div class="form-group row">
  <div class="col-xs-12  col-lg-12">
    <input type="text" class="form-control col-4 float-left" name="tel_show" value="<?php $registro->gTel_show();?>"> 
    <input type="text" class="form-control col-3 float-left" name="tel_dial" value="<?php $registro->gTel_dial();?>"> 
    <input type="text" class="form-control col-5 float-left" name="mail"  placeholder="e-mail" value="<?php $registro->gMail();?>"> 
  </div>
</div>

<div class="form-group row">
  <label for="introd" class="col-xs-12  col-lg-2 col-form-label">Nuestro Proyecto (Introduccion)</label>
  <div class="col-xs-12  col-lg-10">
    <textarea rows="6" class="form-control" name="introd"  placeholder="Breve descripción del proyecto"><?php $registro->gIntrod();?></textarea>
  </div>
  <div class="container pt-3 row">
  <label class="col-xs-12  col-lg-3 col-form-label">Imagen</label>
  <input type="file" class="form-control col-9 float-left" name="img_intro" />
</div>

</div>


<div class="form-group row">
  <label for="mision" class="col-xs-12  col-lg-2 col-form-label">Mision</label>
  <div class="col-xs-12  col-lg-10">
    <textarea rows="6" class="form-control" id="mision" name="mision"  placeholder="Pegue el texto, se respentaran los parrafos"><?php $registro->gMision();?></textarea>
  </div>
</div>

<div class="form-group row">
  <label for="vision" class="col-xs-12  col-lg-2 col-form-label">Vision</label>
  <div class="col-xs-12  col-lg-10">
    <textarea rows="6" class="form-control" id="vision" name="vision"  placeholder="Pegue el texto, se respentaran los parrafos"><?php $registro->gVision();?></textarea>
  </div>
</div>

<div class="form-group row">
  <div class="col-sm-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary btn-lg px-5">Actualizar</button>
  </div>
</div>
</fieldset>
</form>
</div>
