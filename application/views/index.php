<?php 
$ci=get_instance();
$ci->load->Model('Usuario');?>
<div class="wrapper row2 bgded" style="background-image:url('<?=base_url();?>assets/images/bckgrnd.jpg')">
  <div class="overlay row"> 
    <div id="intro">
      <div class="col-md-12 col-xs-12"><p class="nospace font-x2">¡Sea notificado de cuando juegan sus equipos!</p></div>
      <ul class="nospace">
      <div class="row">
      <?php if ($ci->Usuario->isLogged()){ ?>
        <div class="col-md-2 col-xs-0"></div>
        <div class="col-md-4 col-xs-12"><li><a href="<?=site_url('Principal/selectEquipo')?>">Indique el equipo</a></li></div><br/>
      <?php if(! $ci->Usuario->isGestor()){ ?>
        <div class="col-md-4 col-xs-12"><li><a href="<?=site_url('Principal/solicitud')?>">Solicitud para gestor.</a></li></div><br/>
      <?php } else{?>
        <div class="col-md-4 col-xs-12"><li><a href="#">Solicitud para gestor.</a></li></div><br/>
      <?php }} if (! $ci->Usuario->isLogged()){?>
        <div class="col-md-12 col-xs-12"><p style="color:red"> Regístrese para recibir noticias y gestionar sus ligas</p></div><br/>
        <div class="col-md-2 col-xs-0"></div>
        <div class="col-md-4 col-xs-12"><li><a href="#">Indique el equipo</a></li></div><br/>
        <div class="col-md-4 col-xs-12"><li><a href="#">Solicitud para gestor.</a></li></div><br/>
      <?php }?> 
      </div> 
      </ul>
      
    </div>
  </div>
</div>