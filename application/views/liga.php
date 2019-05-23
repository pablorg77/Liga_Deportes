<?= form_open('Ligas/setLiga'); ?>
<div class="form-horizontal" style="margin-top:5%; margin-left:15%">
<form method="post">
  <div class="form-group">
        <label for="deporte" class="col-md-1 control-label">*Deporte:</label>
        <div class="col-md-5">
            <select id="deporte" name="deporte" class="form-control">
                <?php foreach($deportes as $deporte): ?>
                    <option value="<?=$deporte['iddeporte']?>"><?=$deporte['nombre']?></option>
                <?php endforeach;?>
            </select>
            <?= form_error('deporte');?>
        </div>
  </div>
  <div class="form-group">
        <label for="nombre" class="col-md-2 control-label">* Nombre:</label>
        <div class="col-md-5">
            <input type="text" class="form-control" id="nombre" name="nombre"
                value="<?=set_value('nombre')?>" placeholder="Nombre de su liga">
        </div>
        <?= form_error('nombre');?>
  </div>
  <div class="form-group">
        <label for="nombre" class="col-md-2 control-label">Descripcion: </label>
        <div class="col-md-5">
        <input type="text" class="form-control" id="descripcion" name="descripcion"
                value="<?=set_value('descripcion')?>" placeholder="Nombre de su liga">
        </div>
  </div>
  <div class="form-group" style="margin-left:2%; margin-top:2%;">
    <div class="col-md-offset-2 col-xs-10">
      <div class="checkbox">
        <label>
          <input type="radio" name="visible" value="ko"> ¿Quiere que sea privada? (Solo sera administrable por los usuarios de la liga)
        </label>
      </div>
    </div>
    <div class="col-md-offset-2 col-xs-10">
      <div class="checkbox">
        <label>
          <input type="radio" name="visible" value="ok"> ¿Quiere que sea visible para todos?
        </label>
      </div>
    </div>
  </div>
  <div class="form-group" style="margin-top:2%">
    <div class="col-md-2 col-xs-10">
      <button type="submit" class="btn btn-default">Aceptar</button>
    </div>
  </div>
</form>
</div>