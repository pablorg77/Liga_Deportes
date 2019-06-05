<div style="margin:10%">
<h1><strong> Solicitudes a gestor </strong></h1>
<div class="fl_right">
<?php if($solicitudes[0]['borrado']=='N'):?>
<a href="<?=site_url('Principal/getSolicitudesGestionadas')?>">Solicitudes gestionadas</a>
<?php endif; if($solicitudes[0]['borrado']=='S'):?>
<a href="<?=site_url('Principal/getSolicitudes')?>">Solicitudes</a>
<?php endif;?>
</div>
<table id="tablasolicitudes" class="table table-bordered table-hover" cellspacing="0" width="100%">
<thead>
    <tr>
      <th class="th-sm">Usuario</th>
      <th class="th-sm">Datos</th>
      <?php if($solicitudes[0]['borrado']=='N'):?>
        <th class="th-sm">Acciones</th>
      <?php endif;?>
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
      <?php if($this->Usuario->isAdmin() && $solicitud['borrado'] == 'N'):?>
        <td><a href="<?=site_url('Principal/acceptSolicitud/'.$solicitud['idsolicitudes'])?>">Aceptar</a> | 
            <a href="<?=site_url('Principal/rejectSolicitud/'.$solicitud['idsolicitudes'])?>"> Denegar</a></td>
      <?php endif;?>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>
<style>
.dropdown ul {display:none}
.dropdown:hover ul {display:block;}
</style>