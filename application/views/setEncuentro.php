<?= form_open('Ligas/setEncuentros/'.$liga->idliga); ?>
<div class="form-horizontal" style="margin-top:5%; margin-left:15%">
<form method="post">
  <div class="form-group">
  <div style="margin:1%"><?= (isset($mensaje) && $mensaje != '') ? $mensaje : '';?></div>
        <label for="local" class="col-md-1 control-label">* Local:</label>
        <div class="col-md-5">
            <select name="local" class="form-control">
                <?php foreach($equipos as $equip): 
                    foreach($equip as $equipo):?>
                    <option value="<?=$equipo['nombre']?>"><?=$equipo['nombre']?></option>
                <?php endforeach; endforeach;?>
            </select>
        </div>
  </div>
  <div class="form-group">
        <label for="visitante" class="col-md-2 control-label">* Visitante:</label>
        <div class="col-md-5">
            <select name="visitante" class="form-control">
                <?php foreach($equipos as $equip): 
                    foreach($equip as $equipo):?>
                    <option value="<?=$equipo['nombre']?>"><?=$equipo['nombre']?></option>
                <?php endforeach; endforeach;?>
            </select>
        </div>
  </div>
  <div class="form-group">
        <label for="fecha" class="col-md-2 control-label">* Fecha:</label>
        <div class="col-md-5">
            <input type="text" class="form-control" name="fecha"
                value="<?=set_value('fecha')?>" placeholder="YYYY-MM-DD">
        </div>
        <?= form_error('fecha');?>
  </div>
  <div class="form-group">
        <label for="lugar" class="col-md-2 control-label"> Lugar: </label>
        <div class="col-md-5">
        <input type="text" class="form-control" name="lugar"
                value="<?=set_value('lugar')?>">
        <p><small>Si no lo especifica, será en el campo del local</small></p>
        </div>
        
  </div>
  <div class="form-group" style="margin-top:2%">
    <div class="col-md-2 col-xs-10">
      <button type="submit" class="btn btn-default">Aceptar</button>
    </div>
  </div>
</form>
</div>