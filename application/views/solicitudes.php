<div style="margin:10%">
<h1><strong> Solicitudes a gestor </strong></h1>
<table id="tablasolicitudes" class="table table-bordered table-hover" cellspacing="0" width="100%">
<thead>
    <tr>
      <th class="th-sm">Usuario</th>
      <th class="th-sm">Datos</th>
      <th class="th-sm">Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($solicitudes as $solicitud):?>
    <tr>
      <td><?=$solicitud['nombre']?></td>
        <td class="dropdown">
            <li><a href="#">Datos adicionales</a>
                <ul>
                    <li><a>TLF: <?=$solicitud['telefono']?></a></li>
                    <li><a>DNI: <?=$solicitud['dni']?></a></li>
                    <li><a>Residencia: <?=$solicitud['residencia']?></a></li>
                </ul>
            </li>
        </td>
      <?php if($this->Usuario->isAdmin()){?>
        <td><a href="<?=site_url('Principal/acceptSolicitud/'.$solicitud['idsolicitudes'])?>">Aceptar</a> | 
            <a href="<?=site_url('Principal/rejectSolicitud/'.$solicitud['idsolicitudes'])?>"> Denegar</a></td>
    <?php }else{?>
        <td></td>
    <?php }?>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>
<style>
.dropdown ul {display:none}
.dropdown:hover ul {display:block;}
</style>