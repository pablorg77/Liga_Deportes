<div style="margin:5%">
<?php foreach($deportes as $deporte):?>
<table class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr><th class="th-sm" colspan="3">Ligas públicas de <?=$deporte['nombre']?></tr>
        <tr>
        <th class="th-sm" colspan="1">Nombre</th>
        <th class="th-sm" colspan="1">Descripcion</th>
        <th class="th-sm" colspan="1">Última modificación</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ligas as $liga):
            if($liga['deportes_iddeporte'] == $deporte['iddeporte']):?>
        <tr onclick="window.location = '<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
            <td colspan="1"><?=$liga['nombre']?></td>
            <td colspan="1"><?=$liga['descripcion']?></td>
            <?php if($liga['fechamod']!=null):?>
                <td colspan="1"><?=$liga['fechamod']?></td>
            <?php endif; if($liga['fechamod']==null):?>
                <td colspan="1"></td>
            <?php endif;?>
        </tr>
        <?php endif; endforeach;?>
    </tbody>
    </table>
<?php endforeach;?>
</div><br/>
