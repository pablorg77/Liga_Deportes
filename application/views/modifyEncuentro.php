<?= form_open('Plays/modifyEncuentro/'.$encuentro->idencuentros); ?>
<div style="margin-left: 15%; margin-top: 5%; width: 40%; float: left">
    <form id="modifyLiga" method="post" style="display: block;">
    <?php if($encuentro->fechamod != null):?>
        <div class="fl-right" style="margin-right:5%">Última modificación: <?=$encuentro->fechamod?></div>
    <?php endif;?>
    <div class="form-group">
    <div class="title"> <h2>Datos del encuentro:</h2> </div><br/>
        <label>Fecha: </label>
        <input type="text" class="form-control" disabled value="<?=$encuentro->fecha?>">
        <label>Local: </label>
        <input type="text" class="form-control" disabled value="<?=$encuentro->local?>">
        <label>Visitante: </label>
        <input type="text" class="form-control" disabled  value="<?=$encuentro->visitante?>">
        <label>Lugar: </label>
        <input type="text" class="form-control" disabled  value="<?=$encuentro->lugar?>">
    </div>
    <div class="form-group">
        <label for="resultado">Ganador: </label>
        <?php if($encuentro->fecha != date('Y-m-d')):?>
            <input type="text" class="form-control" disabled>
            <p><small>Solo podrá editarse el día del encuentro.</small></p>
        <?php endif; if($encuentro->fecha == date('Y-m-d')):?>
            <input type="text" class="form-control" name="resultado" placeholder="<?=$encuentro->local?> / <?=$encuentro->visitante?>" value="<?=set_value('resultado')?>">
        <?php endif;?>
        <?= form_error('resultado');?>
        <?=$mensaje?>
    </div><br/>
    <div class="form-group">
        <label for="resultadoL"> Resultado de local: </label>
        <?php if($encuentro->fecha != date('Y-m-d')):?>
            <input type="text" class="form-control" disabled>
            <p><small>Solo podrá editarse el día del encuentro.</small></p>
        <?php endif; if($encuentro->fecha == date('Y-m-d')):?>
            <input type="text" class="form-control" name="resultadoLocal" placeholder="Puntuación numérica" value="<?=set_value('resultadoLocal')?>">
        <?php endif;?>
        <?= form_error('resultadoLocal');?><br/>
        <label for="resultadoV"> Resultado de visitante: </label>
        <?php if($encuentro->fecha != date('Y-m-d')):?>
            <input type="text" class="form-control" disabled>
            <p><small>Solo podrá editarse el día del encuentro.</small></p>
        <?php endif; if($encuentro->fecha == date('Y-m-d')):?>
            <input type="text" class="form-control" name="resultadoVisitante" placeholder="Puntuación numérica" value="<?=set_value('resultadoVisitante')?>">
        <?php endif;?>
        <?= form_error('resultadoVisitante');?>
    </div>
    <?php if($encuentro->fecha != date('Y-m-d')):?>
        <button type="submit" class="btn btn-success" disabled>Aceptar</button>
    <?php endif; if($encuentro->fecha == date('Y-m-d')):?>
        <button type="submit" class="btn btn-success">Aceptar</button>
    <?php endif;?>
    </form>
</div>