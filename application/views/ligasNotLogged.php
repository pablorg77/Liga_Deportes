<div style="margin:5%">
<?php foreach($ligas as $liga):?>
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
        <?php if($liga['deportes_iddeporte'] == 1):?>
        <th class="th-sm" colspan="2">Ligas publicas de fútbol</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 2):?>
        <th class="th-sm" colspan="2">Ligas publicas de baloncesto</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 3):?>
        <th class="th-sm" colspan="2">Ligas publicas de tenis</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 4):?>
        <th class="th-sm" colspan="2">Ligas publicas de natación</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 5):?>
        <th class="th-sm" colspan="2">Ligas publicas de balonmano</tr>
        <?php endif; if($liga['deportes_iddeporte'] == 6):?>
        <th class="th-sm" colspan="2">Ligas publicas de esgrima</tr>
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
<?php endforeach;?>
</div><br/>

