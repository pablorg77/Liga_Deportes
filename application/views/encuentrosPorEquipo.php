<div style="margin-top: 5%; margin-left:5%;">
  <?php if(isset($equipo)):?>
    <h2> Encuentros de <strong><?= $equipo?></strong></h2>
  <?php endif; if(isset($liga)):?>
    <h2> Encuentros de <strong><?= $liga->nombre?></strong></h2>
  <?php endif;?>
</div>
<table class="table table-hover table-dark" style="margin: auto; width: 90%; text-align:center; color:black; margin-top: 30px">
  <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col">Local</th>
      <th scope="col">Visitante</th>
      <th scope="col">Resultados</th>
      <th scope="col">Ganador</th>
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
            </tr>
    <?php endforeach;?>
  </tbody>
</table>