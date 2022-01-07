<div class="container-fluid">

<h2 class="text-center display-4" >Quienes Somos</h2>

  <div class = "ficha d-flex flex-wrap">

    <div class="tg carta color5 flex-fill">
      <div class="card-encabezado text-center">
        <i class="material-icons md50 cfi7">contacts</i>
        <h3>Sómos</h3>
        <div class="text-justify p-3">
          <?php
            echo $data->gIntrod();
          ?>
        </div>
      </div>
    </div>

    <div class="tg carta color5 flex-fill">
      <div class="card-encabezado text-center">
        <i class="material-icons md50 cfi7">supervisor_account</i>
      </div>

      <h3>Misión</h3>
        <div class="text-justify p-3">
          <?php
            echo $data->gMision();
          ?>
        </div>

    </div>

    <div class="tg carta color5 flex-fill">
      <div class="card-encabezado text-center">
        <i class="material-icons md50 cfi7">trending_up</i>
      </div>

      <h3>Visión</h3>
        <div class="text-justify p-3">
          <?php
            echo $data->gVision();
          ?>
        </div>

    </div>

  </div>
</div>

<div class="container-fluid pt-3 mlr-3">
  <?php include_once ("component/servicios.php");?>
</div>