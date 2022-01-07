<link href='../pages/event/calendario/core/main.css' rel='stylesheet' />
<link href='../pages/event/calendario/daygrid/main.css' rel='stylesheet' />
<script src='../pages/event/calendario/core/main.js'></script>
<script src='../pages/event/calendario/daygrid/main.js'></script>
<script src='../pages/event/calendario/interaction/main.js'></script>
<script src="../../../js/fcalendar.js"></script>

<div class="modal fade" id="evento">
  <div class="modal-dialog">
    <div class="modal-content color3">
    
      <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" id="titulo"></h4>
            <button type="button" class="close" data-dismiss="modal"  onclick='document.getElementById("audio").pause()'>&times;</button>
          </div>
          <div class="container"><h6 class="pl-2" id="fecha">Fecha:</h6></div>
          <!-- Modal body -->

          <div class="container justify-content-center">
          <div class="col-12" id="cimg">
          <center><img src="" id="imagen" class="img-thumbnail"></center>
          </div>

              <div class="row col-12 p-3 justify-content-center" id="caudio">
              <!--button type="button" class="col-off-1 col-2 btn btn-success" id="boton" value="pausa"><i class="material-icons" id="icono">pause</i></button><h4 class="text-center col-9 col-off-1">Escuchar Conferencia</h4-->
                <audio id="audio" controls controlsList="nodownload" autoplay src="" autoplay>
              </div>
              

              <div class="row col-12 p-3 justify-content-center">
                <button type="button" class="btn btn-success btn-lg" data-dismiss="modal" onclick='document.getElementById("audio").pause()'>Cerrar</button>
              </div>

          </div>
    </div>

  </div>
</div>
