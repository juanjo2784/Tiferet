<div class="color6 pt-5 mb-0" id="myDiv" style="display:block;" >
<div class="d-flex justify-content-between  p-5">

  <div class="p-2">
  <?php 
        if(!empty($_SESSION['user'])){
          switch ($_SESSION['user']){
            case 1:
              echo '<h4>Administrador</h4>';
            break;
            case 2:
              echo '<h4>Editor</h4>';
            break;
            case 3:
              echo '<h4>Instructor</h4>';
            break;
          }
        }
        ?>
  </div>

  <div class="p-2" >
    <h4>Administrador de Contenidos Develope by Appsher</h4>
  </div>

  <div class="p-2">
    <h4>2020-v4</h4>
  </div>

</div>
</div>