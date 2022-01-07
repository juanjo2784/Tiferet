<div class="container cartag">
<h2>Agregar Video de YouTube</h2>
<form method="POST" action="Youtube/crudVideo.php" enctype="multipart/form-data">

  <div class="form-group row">
    <label for="titulo" class="col-3 col-form-label">Titulo del video</label>
    <input type="text" name="titulo" class="form-control col-9">
  </div>

  <div class="form-group row">
    <label for="tipo" class="col-3 col-form-label">Categoria del Contenido</label>
    <select name="tipo" class="col-9 form-control">
      <option value=1>Parasha</option>
      <option value=2>Segula</option>
      <option value=3>Articulo</option>
      <option value=4>Receta</option>
      <option value=5>Tziniut</option>
    </select>
  </div>

  <div class="form-group row">
  <label for="url" class="col-3 col-form-label">Url de YouTube</label>
  <input type="text" name="url" class="col-9 form-control">
  <input type="hidden" name="action" class="col-9 form-control" value="2">
  </div>

  <div class="form-group row">
    <div class="col-sm-12 d-flex justify-content-between">
      <a href="?a=adminvideo"  class="btn btn-success btn-lg">Listar Videos Youtube</a>
      <button type="submit" class="btn btn-primary btn-lg">Agregar Video</button>
    </div>
  </div>

  </form>
</div>
