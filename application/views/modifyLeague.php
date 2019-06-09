<link href="<?=base_url();?>assets/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<script src="<?=base_url();?>assets/js/jquery.multi-select.js" type="text/javascript"></script>
<?= form_open('Ligas/modifyLiga/'.$liga->idliga); ?>
<div style="margin-left: 15%; margin-top: 5%; width: 40%; float: left">
    <form id="modifyLiga" method="post" style="display: block;">
    <div class="form-group">
        <label for="nombre">* Nombre: </label>
        <input type="text" class="form-control" value="<?= ($this->input->post('nombre')!=null) ? set_value('nombre') : $liga->nombre?>"
            name="nombre" placeholder="<?=$liga->nombre?>">
        <?= form_error('nombre');?>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción: </label>
        <input type="text" class="form-control" name="descripcion" placeholder="<?=$liga->descripcion?>"
        value="<?= ($this->input->post('descripcion')!=null) ? set_value('descripcion') : $liga->descripcion?>">
    </div>
    <div class="form-group">
      <label for="equipo">* Equipos: </label>
      <select multiple="multiple" id="selectEquipos" name="equipos[]">
          <?php foreach($equipos as $equipo):?>
              <option value="<?=$equipo['idequipos']?>"><?=$equipo['nombre']?></option>
          <?php endforeach; ?>
          <?= form_error('equipos[]');?>
      </select>
    </div><br/>
    <div class="form-group">
    <label for="gestores">Gestores permitidos: </label>
    <select multiple="multiple" id="selectGestores" name="gestores[]">
        <?php foreach($gestores as $gestor):
          foreach($gestor as $gest):?>
            <option value="<?=$gest['idusuarios']?>"><?=$gest['nombre']?></option>
        <?php endforeach; endforeach;?>
    </select>
  </div><br/>
    <div class="form-group" style="margin-left:2%; margin-top:2%;">
    <div class="col-md-offset-2 col-xs-10">
      <div class="checkbox">
        <label>
          <input type="radio" name="visible" value="0"> ¿Quiere que sea privada? (Solo sera administrable por los usuarios de la liga)
        </label>
      </div>
    </div>
    <div class="col-md-offset-2 col-xs-10">
      <div class="checkbox">
        <label>
          <input type="radio" name="visible" value="1"> ¿Quiere que sea visible para todos?
        </label>
      </div>
    </div>
    <?= form_error('visible');?>
  </div>
    <button type="submit" class="btn btn-success">Aceptar</button>
    </form>
</div>

<script>
$('#selectEquipos').multiSelect();
$('#selectGestores').multiSelect();
</script>
