<?= form_open('Sports/creaEquipo'); ?>
<div style="margin-left: 15%; margin-top: 5%; width: 40%; float: left">
    <form method="post" style="display: block;">
    <div class="form-group">
        <label for="nombre">* Nombre: </label>
        <input type="text" class="form-control" value="<?=set_value('nombre')?>" name="nombre">
        <?= form_error('nombre');?>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción: </label>
        <input type="text" class="form-control" name="descripcion" value="<?= set_value('descripcion')?>">
    </div>
    <div class="form-group">
      <label for="equipo">* Deporte: </label>
      <select class="form-control" name="deportes_iddeporte">
          <?php foreach($deportes as $deporte):?>
              <option value="<?=$deporte['iddeporte']?>"><?=$deporte['nombre']?></option>
          <?php endforeach; ?>
      </select>
    </div><br/>
    <div class="form-group">
        <label for="origen">* Origen: </label>
        <input type="text" class="form-control" name="origen" value="<?= set_value('origen')?>">
    </div>
    <div class="form-group">
        <label for="capitan">Capitán : </label>
        <input type="text" class="form-control" name="capitan" value="<?= set_value('capitan')?>">
    </div>
        <button type="submit" class="btn btn-success">Aceptar</button>
    </form>
</div>