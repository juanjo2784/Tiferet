<?php
/* //echo getcwd();
article = 0 -evento = 1 -apoyo = 2 -fundacion = 3 -user = 4
*/
class File{
 
  public $show;
  public $tc;
  public $ruta;
  public $name;
  public $destino;

  function addFile($file, $tipo){
    $tmpName=$file['tmp_name'];
    $this->name = str_replace(" ","",$file['name']);
    $type = $file['type'];
    $size = $file['size'];
    $gext = explode('.',$this->name);
    $ext= strtolower(end($gext));
    $allowExt=array('jpg', 'gif', 'png', 'jpeg', 'zip', 'txt', 'pdf', 'docs', 'doc','mp3', 'mp4', 'ogg');

    switch ($tipo){
      case 0:
        switch($ext){
          case 'jpg':
          case 'gif':
          case 'png':
            $this->ruta='../../upload/Imagenes/';
            $this->show ='<img src='.$this->ruta.$this->name.' class="mx-auto d-block w-25 p-2">';
            $this->tc=1;
          break;
          case 'mp3':
          case 'mp4':
            $this->ruta = '../../upload/Audio/';
            $this->show = "<center><audio src=".$this->ruta.$this->name."  preload='auto' controls>Tu navegador no Soporta MP3.</audio></center>";
            $this->tc=2;
          break;
          case 'ogg':
            $this->ruta = '../../upload/Audio/';
            $this->show = "<center><audio src=".$this->ruta.$this->name."  preload='auto' controls>Tu navegador no Soporta ogg.</audio></center>";
            $this->tc=2;
          break;
          default: 
          echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Error!</strong> La Extension del archivo no es valida.
                </div>';
        }
        break;
      case 1:
        switch($ext){
          case 'jpg':
          case 'gif':
          case 'png':
            $this->ruta='../../upload/Eventos/';
            $this->show='<img src='.$this->ruta.$this->name.' class="mx-auto d-block w-25 p-2">';
            $this->tc=1;
          break;
          case 'mp3':
            $this->ruta = '../../upload/Eventos/Audio/';
            $this->show = "<center><audio src=".$this->ruta.$this->name."  preload='auto' controls>Tu navegador no Soporta MP3.</audio></center>";
            $this->tc=2;
          break;
          default: 
          echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Error!</strong> La Extension del archivo no es valida.
                </div>';
        }
        break;
      case 2:
        switch($ext){
          case 'jpg':
          case 'gif':
          case 'png':
          case 'jpeg':
            $this->ruta='../../upload/Material/Img/';
            $this->show ='<img src='.$this->ruta.$this->name.' class="mx-auto d-block w-25 p-2">';
            $this->tc=1;
          break;
          case 'mp3':
            $this->ruta = '../../upload/Material/Audio/';
            $this->show = "<center><audio src=".$this->ruta.$this->name."  preload='auto' controls>Tu navegador no Soporta MP3.</audio></center>";
            $this->tc=2;
          break;
          case 'mp4':
            $this->ruta = '../../upload/Material/Video/';
            $this->show = "<center><video src=".$this->ruta.$this->name." width='640' height='480' controls preload='auto'>Tu navegador no soporta MP4.</video></center>";
            $this->tc=3;
          break;
          case 'pdf':
          case 'docs':
          case 'doc':
          case 'zip':
            $this->ruta = '../../upload/Material/Docs/';
            $this->show ="has subido el archivo: ".$this->name;
            $this->tc=4;
          break;
          default: 
          echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Error!</strong> La Extension del archivo no es valida o archivo excede el tamaño permitido 90Mb.
                </div>';
        }
        break;
      case 3:
        switch($ext){
          case 'jpg':
          case 'gif':
          case 'png':
          case 'jpeg':
            $this->ruta='../../img/Galeria/Img/';
            $this->show ='<img src='.$this->ruta.$this->name.' class="mx-auto d-block w-25 p-2">';
            $this->tc=1;
          break;
          case 'mp4':
            $this->ruta = '../../img/Galeria/Video/';
            $this->show = "<center><video src=".$this->ruta.$this->name." width='640' height='480' controls preload='auto'>Tu navegador no soporta MP4.</video></center>";
            $this->tc=3;
          break;
          default: 
          echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Error!</strong> La Extension del archivo no es valida o archivo excede el tamaño permitido 90Mb.
                  <div>'.$this->show.'</div>
                </div>';
        }
        break;
      case 4:
        if($ext=="jpg" || $ext=="jpeg"){
          $this->ruta='../../img/user/';
          $this->show ='<img src='.$this->ruta.$this->name.' class="mx-auto d-block w-25">';
          $this->tc=1;
        }else{
          echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Error!</strong> La Extension del archivo no es valida o archivo excede el tamaño permitido 90Mb.
                </div>';
        }
        break;
    } //funcionSwicht princpal
    $this->destino=$this->ruta.$this->name;
    if(copy($tmpName,$this->destino)){
      echo '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>Proceso finalizado conrrectamente!</strong> Se ha guardado el Archivo.
              <div>'.$this->show.'</div>
            </div>';
      return $this->destino;
    }else{
      @unlink(ini_get('upload_tmp_dir'.$tmpName));
      return 0;
    }
  } //fin funcion Addfile
  
  function gShow(){
    return $this->show;
  }

  function gTc(){
    return $this->tc;
  }

  function gDestino(){
    return $this->destino;
  }

}