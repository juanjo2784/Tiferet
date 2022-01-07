<?php 
//echo getcwd();
include_once("../Model/mArticulo.php");
$registro = new Articulo;
?>
<div class="row">
<div class="col-7">
    <select name="aRelacionados" id="aRelacionados" class="form-control" onChage="listado">
        <?php 
        if(isset($_POST['tipoA'])){
            $registro->lArticulos($_POST['tipoA']);
        }
        ?>
    </select>
</div>

<div class="col-3">
    <button id="addarticle" class="btn btn-primary btn-lg" >Agregar</button>
</div>
</div>

<script>
$('#addarticle').click(function(e){
    e.preventDefault();
    let element = $("#aRelacionados").val();
    let existente = $("#tmas").val();
    let tc;
    if(existente == "" || existente == null){
        $('#tmas').val(element);
        tc = element;
    }else{
        $('#tmas').val(existente + ","+element);
        tc = existente + ","+element;
    }
   
    let it = tc.split(',');

    $.ajax({
    type: "POST",
    url: "/pages/admon/Articulos/tArticulos.php",
    data: {idArticulos: it},
        success:function(responce){
        $('#listado').html(responce);
        }
    })

})

</script>