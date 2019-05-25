<div class="form-group col-md-12 col-xs-12" style="margin:5%; position:center">
  <?php $ci=get_instance();
  if($this->Usuario->isGestor() || $this->Usuario->isAdmin()):?>
    <h3><li><a href="<?= site_url('Ligas/addLiga')?>">Crear liga</a></li></h3><br/>
  <?php endif;?>
      <form method="post" action="<?=site_url('Ligas/getLigas')?>">
      <div class="row">
        <div class="col-md-5 col-xs-12">
          <select class="form-control" id="selectDeporte" onchange="this.form.submit()"
                  name="selectDeporte" style="width:300px">
              <option value=""> -- Escoja un deporte -- </option>
              <?php foreach($deportes as $deporte):?>
                  <option value="<?=$deporte['iddeporte']?>" 
                  <?= (set_value('selectDeporte') == $deporte['iddeporte']) ? 'selected' : ''?>>
                  <?=$deporte['nombre']?></option>
              <?php endforeach;?>
          </select>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-5 col-xs-12">
            <select class="form-control" id="selectLiga" onchange="this.form.submit()"
                  name="selectLiga" style="width:300px">
              <option value=""> -- Escoja una liga -- </option>
              <?php foreach($ligas as $liga):?>
                  <option value="<?=$liga['idliga']?>"
                  <?= (set_value('selectLiga') == $liga['idliga']) ? 'selected' : ''?>>
                  <?=$liga['nombre']?></option>
              <?php endforeach;?>
          </select>
          </div>
          </div>
      </form>
</div>
<div style="margin:5%">
<table id="tablaEncuentros" class="table table-bordered table-hover" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Fecha</th>
      <th class="th-sm">Local</th>
      <th class="th-sm">Visitante</th>
      <th class="th-sm">Resultados</th>
      <th class="th-sm">Ganador</th>
      <th class="th-sm">Lugar</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($encuentros as $encuentro):?>
    <tr>
      <td><?=$encuentro['fecha']?></td>
      <td><?=$encuentro['local']?></td>
      <td><?=$encuentro['visitante']?></td>
      <?php if($encuentro['resultadoLocal']!=null && $encuentro['resultadoVisitante']!=null){?>
        <td><?= $encuentro['resultadoLocal'] ?> - <?= $encuentro['resultadoVisitante']?></td>
    <?php }else{?>
        <td></td>
    <?php }?>
        <td><?= $encuentro['resultado']?></td>
        <td><?= $encuentro['lugar']?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>

<script>
$(document).ready(function () {
$('#tablaEncuentros').DataTable();
$('#top').css("background-color","darkcyan");
$('#top').css("color","black");
});
</script>