<?php if(! $this->Usuario->isGestor() && ! $this->Usuario->isAdmin()):?>
<div style="margin:5%">
<?php foreach($ligas as $lig):
    foreach($lig as $liga):?>
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
        <?php if($liga['deportes_iddeporte'] == 1):?>
            <th class="th-sm" colspan="2">Ligas de fútbol</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 2):?>
            <th class="th-sm" colspan="2">Ligas de baloncesto</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 3):?>
            <th class="th-sm" colspan="2">Ligas de tenis</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 4):?>
            <th class="th-sm" colspan="2">Ligas de natación</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 5):?>
            <th class="th-sm" colspan="2">Ligas de balonmano</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 6):?>
            <th class="th-sm" colspan="2">Ligas de esgrima</tr>
        <?php endif;?>
        <th class="th-sm" colspan="1">Nombre</th>
        <th class="th-sm" colspan="1">Descripcion</th>
        </tr>
    </thead>
    <tbody>
        <tr onclick="window.location = '<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
            <td colspan="1"><?=$liga['nombre']?></td>
            <td colspan="1"><?=$liga['descripcion']?></td>
        </tr>
    </tbody>
    </table>
<?php endforeach; endforeach;?>
</div><br/>
<?php endif;?>
<?php if($this->Usuario->isGestor() || $this->Usuario->isAdmin()):?>
<div style="margin:5%">
<?php foreach($ligas as $liga):?>
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
        <?php 
        $cols = ($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin()) ? 3 : 2;
        if($liga['deportes_iddeporte'] == 1):?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de fútbol</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 2):;?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de baloncesto</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 3):?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de tenis</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 4):?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de natación</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 5):?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de balonmano</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 6):?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de esgrima</tr>
        <?php endif;?>
        <th class="th-sm" colspan="1">Nombre</th>
        <th class="th-sm" colspan="1">Descripcion</th>
        <?php if($liga['fechamod']!=null):?>
        <th class="th-sm" colspan="1">Última modificación</th>
        <?php endif;?>
        <?php if($cols==3):?>
            <th class="th-sm" colspan="1">Acciones</tr>
        <?php endif;?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="1" onclick="window.location ='<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
            <?=$liga['nombre']?></td>
            <td colspan="1" onclick="window.location ='<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
            <?=$liga['descripcion']?></td>
            <?php if($liga['fechamod']!=null):?>
                <td colspan="1" onclick="window.location ='<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
                <?=$liga['fechamod']?></td>
            <?php endif;?>
            <?php if($cols==3):?>
                <td class="th-sm" colspan="1"><button type="button" class="btn-success"
                onclick="window.location = '<?= site_url('Ligas/modifyLiga/'.$liga['idliga']);?>'">Modificar</button> | 
                <button type="button" class="btn-secondary"
                onclick="window.location = '<?= site_url(''.$liga['idliga']);?>'">Encuentros</button> |
                <button type="button" class="openModal btn-danger">Borrar</button></td>
            <?php endif;?>
        </tr>
    </tbody>
    </table>

    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fl_left">Confirmación</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <span style="color:red">¿Está seguro de querer borrar la liga seleccionada?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" 
                    onclick="window.location = '<?= site_url('Ligas/deleteLiga/'.$liga['idliga']);?>'">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
</div><br/>
<?php endif;?>

<script>
$('.openModal').on('click',function(){
    $('.modal-body').load('content.html',function(){
        $('#myModal').modal({show:true});
    });
});
</script>