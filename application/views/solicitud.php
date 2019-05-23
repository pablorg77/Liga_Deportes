<?= form_open('Login/solicitud'); ?>
<div style="margin-left: 15%; margin-top: 5%; width: 40%; float: left">
    <form id="solicitud" method="post" style="display: block;">
    <h2> Para ser gestor debe indicar unos datos adicionales para su localización </h2><br/>
    <small class="form-text text-muted">Nunca compartiremos sus datos con nadie. </small>
    <div class="form-group">
        <label for="email">DNI: </label>
        <input type="text" class="form-control" value="<?=set_value('dni')?>"
            name="dni" placeholder="Introduzca DNI">
        <?= form_error('dni');?>
    </div>
    <div class="form-group">
        <label for="telefono">Telefono: </label>
        <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
        <?= form_error('tlf');?>
    </div>
    <div class="form-group">
        <label for="residencia">Residencia: </label>
        <input type="text" class="form-control" name="residencia" placeholder="Introduzca la dirección completa">
        <?= form_error('residencia');?>
    </div>
    <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
</div>