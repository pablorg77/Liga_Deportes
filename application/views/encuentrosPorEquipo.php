
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
        <?php if($encuentro['resultadoLocal']!=null || $encuentro['resultadoVisitante']!=null){?>
            <td><?= $encuentro['resultadoLocal'] ?> - <?= $encuentro['resultadoVisitante']?></td>
        <?php }else{?>
            <td></td>
        <?php }?>
        <?php if($encuentro['resultado']!=null){?>
            <td><?= $encuentro['resultado']?></td>
        <?php }else{?>
            <td></td>
        <?php }?>
            </tr>
    <?php endforeach;?>
  </tbody>
</table>