
<?php 
$ci=get_instance();
$ci->load->Model('Usuario');?>
<div class="wrapper row2 bgded" style="background-image:url('<?=base_url();?>assets/images/bckgrnd.jpg')">
  <div class="overlay"> 
    <div id="intro">
      <p class="nospace font-x2">¡Sea notificado de cuando juegan sus equipos!</p>
      <p class="nospace btmspace-50">Puede indicar uno o varios equipos a los que pertenezca y ser notificado al instante en su correo, solo ha de estar registrado.
      Puede convertirse también en administrador enviando una solicitud.</p>
      <ul class="nospace">
      <?php if ($ci->Usuario->isLogged()){?>
        <li><a href="#">Indique el equipo</a></li>
        <li><a href="#">Solicitud para gestor.</a></li>
      <?php } if (! $ci->Usuario->isLogged()){?>
        <p style="color:red"> Regístrese para recibir noticias y gestionar sus ligas</p>
        <li><a href="#">Indique el equipo</a></li>
        <li><a href="#">Solicitud para gestor.</a></li>
      <?php }?>  
      </ul>
    </div>
  </div>
</div>