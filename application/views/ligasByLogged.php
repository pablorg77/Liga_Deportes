<?php if(! $this->Usuario->isGestor()):?>
<div style="margin:5%">
<?php foreach($ligas as $liga):?>
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
<?php endforeach;?>
</div><br/>
<?php endif;?>
<?php if($this->Usuario->isGestor() || $this->Usuario->isAdmin()):?>
<div style="margin:5%">
<?php foreach($ligas as $liga):?>
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
        <?php if($liga['deportes_iddeporte'] == 1):
            $cols = 2;
            if($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin()):
                $cols = 3;?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de fútbol</tr>
        <?php endif; endif; if($liga['deportes_iddeporte'] == 2):
            $cols = 2;
            if($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin()):
                $cols = 3;?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de baloncesto</tr>
        <?php endif; endif; if($liga['deportes_iddeporte'] == 3):
            $cols = 2;
            if($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin()):
                $cols = 3;?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de tenis</tr>
        <?php endif; endif; if($liga['deportes_iddeporte'] == 4):
            $cols = 2;
            if($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin()):
                $cols = 3;?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de natación</tr>
        <?php endif; endif; if($liga['deportes_iddeporte'] == 5):
            $cols = 2;
            if($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin()):
                $cols = 3;?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de balonmano</tr>
        <?php endif; endif; if($liga['deportes_iddeporte'] == 6):
            $cols = 2;
            if($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin()):
                $cols = 3;?>
            <th class="th-sm" colspan="<?=$cols?>">Ligas de esgrima</tr>
        <?php endif; endif;?>
        <th class="th-sm" colspan="1">Nombre</th>
        <th class="th-sm" colspan="1">Descripcion</th>
        <?php if($this->Leagues->isGestorAllowed($liga['idliga'])):?>
            <th class="th-sm" colspan="1">Acciones</tr>
        <?php endif;?>
        </tr>
    </thead>
    <tbody>
        <tr onclick="window.location = '<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
            <td colspan="1"><?=$liga['nombre']?></td>
            <td colspan="1"><?=$liga['descripcion']?></td>
            <?php if($this->Leagues->isGestorAllowed($liga['idliga'])):?>
                <td class="th-sm" colspan="1"><a href="">Modificar</a> | <a href="">Borrar</a></td>
            <?php endif;?>
        </tr>
    </tbody>
    </table>
<?php endforeach;?>
</div><br/>
<?php endif;?>

