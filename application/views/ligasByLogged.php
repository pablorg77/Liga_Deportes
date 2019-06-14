<div style="margin:5%">
<?php foreach($deportes as $deporte):?>
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
        <tr>
        <th class="th-sm" colspan="4">Ligas de <?=$deporte['nombre']?></tr>
        <th class="th-sm" colspan="1">Nombre</th>
        <th class="th-sm" colspan="1">Descripcion</th>
        <th class="th-sm" colspan="1">Última modificación</th>
        <th class="th-sm" colspan="1">Acciones</tr>
        </tr>
    </thead>
    <tbody>
    <?php foreach($ligas as $liga):
            if($liga['deportes_iddeporte'] == $deporte['iddeporte']):?>
        <tr>
            <td colspan="1" onclick="window.location ='<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
            <?=$liga['nombre']?></td>
            <td colspan="1" onclick="window.location ='<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
            <?=$liga['descripcion']?></td>
            <?php if($liga['fechamod']!=null):?>
                <td colspan="1" onclick="window.location ='<?= site_url('Plays/getEncuentrosPorLiga/'.$liga['idliga']);?>'">
                <?=$liga['fechamod']?></td>
            <?php endif; if($liga['fechamod'] == null):?>
                <td colspan="1"></td>
            <?php endif;?>
            <?php if($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin()):?>
                <td class="th-sm" colspan="1"><button type="button" class="btn-success"
                onclick="window.location = '<?= site_url('Ligas/modifyLiga/'.$liga['idliga']);?>'">Modificar</button> | 
                <button type="button" class="btn-secondary"
                onclick="window.location = '<?= site_url('Ligas/setEncuentros/'.$liga['idliga']);?>'">Encuentros</button> |
                <button type="button" class="openModal btn-danger">Borrar</button></td>
            <?php endif; if(! ($this->Leagues->isGestorAllowed($liga['idliga']) || $this->Usuario->isAdmin())):?>
                <td class="th-sm" colspan="1"></td>
            <?php endif;?>
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
        </tr> 
        <?php endif; endforeach;?>
    </tbody>
    </table>

    
<?php endforeach;?>
</div><br/>

<script>
$('.openModal').on('click',function(){
    $('.modal-body').load('content.html',function(){
        $('#myModal').modal({show:true});
    });
});
</script>