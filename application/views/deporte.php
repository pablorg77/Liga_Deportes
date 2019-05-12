<div style="padding:20px; color:red; text-align:center"><h1><strong>¡ <?= $deporte->descripcion ?> !</strong></h1></div>

<table class="table table-sm table-hover" style="margin: auto; width: 90%; text-align:center;">
  <thead>
  <tr><th colspan="3">Equipos</th></tr>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Descripción</th>
      <th scope="col">Capitán</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($equipos as $equipo): ?>
        <tr onclick="window.location = '<?= site_url('Plays/getEncuentrosPorEquipo/'.$equipo['nombre']);?>'">
        <td><?= $equipo['nombre']?></td>
        <td><?= $equipo['descripcion']?></td>
        <td><?= $equipo['capitan']?></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<br/><br/><br/>
