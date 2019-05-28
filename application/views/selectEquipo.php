<div class="clear" style="margin: 15%">
    <h2 style="color: magenta"> ¡Seleccione uno de sus equipos para ser notificado cuando juega! </h2><br/>
    <form method="post" action="<?=site_url('Principal/notify')?>">
    <select name="selectDep" clas="form-control" style="width: 50%; height: 5%">
        <?php foreach($equipos as $equipo):?>
            <option value="<?=$equipo['idequipos']?>"><?=$equipo['nombre']?></option>
        <?php endforeach;?>
    </select><br/><br/>
    <button type="submit" class="btn btn-primary">Aceptar</button>
</div>

