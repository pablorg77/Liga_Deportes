<div style="margin-top: 5%; margin-left:5%;">
  <?php if(isset($equipo)):?>
    <h2> Encuentros de <strong><?= $equipo->nombre ?></strong></h2>
  <?php endif; if(isset($liga)):?>
    <h2> Encuentros de <strong><?= $liga->nombre ?></strong></h2>
  <?php endif;?>
</div>
<table class="table table-hover table-dark" style="margin: auto; width: 90%; text-align:center; color:black; margin-top: 30px">
<div class="fl_right" style="margin-right:5%"><?= (isset($liga) && $liga->fechamod!=null) ? "Última modificación:". $liga->fechamod : ""?></div>
  <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col">Local</th>
      <th scope="col">Visitante</th>
      <th scope="col">Resultados</th>
      <th scope="col">Ganador</th>
      <th scope="col">Lugar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($encuentros as $encuentro): ?>
            <tr>
            <td><?= $encuentro['fecha']?></td>
            <td><?= $encuentro['local']?></td>
            <td><?= $encuentro['visitante']?></td>
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