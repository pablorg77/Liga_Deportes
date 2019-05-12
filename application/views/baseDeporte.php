<table class="table table-hover table-dark" style="margin: auto; width: 90%; text-align:center; margin-top: 30px" >
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Descripción</th>
      <th scope="col">Nº de jugadores</th>
    </tr>
  </thead>
  <tbody style="color:black">
    <?php foreach($deportes as $deporte): ?>
    <tr onclick="window.location = '<?= site_url('Sports/cargaDeporte/'.$deporte['iddeporte']);?>'">
        <td><?= $deporte['nombre'] ?></td>
        <td><?= $deporte['descripcion'] ?></td>
        <td><?= $deporte['nJugadores'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>