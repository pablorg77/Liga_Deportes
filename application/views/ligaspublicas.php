<div style="margin:5%">
<?php foreach($ligas as $liga):?>
<?php $cols = ($liga['fechamod']!=null) ? 3 : 2;?>
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
        <?php if($liga['deportes_iddeporte'] == 1):?>
        <th class="th-sm" colspan="<?=$cols?>">Ligas públicas de fútbol</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 2):?>
        <th class="th-sm" colspan="<?=$cols?>">Ligas públicas de baloncesto</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 3):?>
        <th class="th-sm" colspan="<?=$cols?>">Ligas públicas de tenis</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 4):?>
        <th class="th-sm" colspan="<?=$cols?>">Ligas públicas de natación</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 5):?>
        <th class="th-sm" colspan="<?=$cols?>">Ligas públicas de balonmano</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 6):?>
        <th class="th-sm" colspan="<?=$cols?>">Ligas públicas de esgrima</tr>
        <?php endif;?>
        <th class="th-sm" colspan="1">Nombre</th>
        <th class="th-sm" colspan="1">Descripcion</th>
        <?php if($liga['fechamod']!=null):?>
        <th class="th-sm" colspan="1">Última modificación</th>
        <?php endif;?>
        </tr>
    </thead>
    <tbody>
        <tr onclick="window.location = '<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
            <td colspan="1"><?=$liga['nombre']?></td>
            <td colspan="1"><?=$liga['descripcion']?></td>
            <?php if($liga['fechamod']!=null):?>
            <td colspan="1"><?=$liga['fechamod']?></td>
            <?php endif;?>
        </tr>
    </tbody>
    </table>
<?php endforeach;?>
</div><br/>
