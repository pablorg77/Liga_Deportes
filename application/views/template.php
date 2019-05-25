<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="description" content="Liga de deportes">
    <meta name="author" content="Pablo Rodriguez Gonzalez">
    <?php header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
      header("Allow: GET, POST, OPTIONS, PUT, DELETE");
      $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {die();}?>
  
    <title>Liga de deportes</title>

    <link href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?=base_url();?>assets/css/layout.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/mystyle.css" rel="stylesheet">
    <script src="<?=base_url();?>assets/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="<?=base_url();?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="<?=base_url();?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    

    <?php 
      $ci=get_instance();
      $deportes = $ci->Deportes->getDeportes();
      $categorias = $ci->Deportes->getCategorias();
    ?>
</head>
<body id="top">
<div id="topbar" class="clear form-horizontal">
<div class="row">
  <div class="col-xs-12 col-md-5" id="options1">
      <ul class="nospace">
        <div class="col-xs-3">
        <li><a href="<?=site_url('Principal');?>">Página principal</a></li>
        <li><a href="<?=site_url('Ligas/getLigasPublicas');?>">Ligas públicas</a></li>
        <?php if ($ci->Usuario->isLogged()):?>
        <li><a href="<?=site_url('Ligas');?>">Mis ligas</a></li>
        <?php endif;?>
        <?php if (! $ci->Usuario->isLogged()):?>
        <li><a href="<?=site_url('Principal/register');?>">Registrarse</a></li>
        <?php endif;?>
      </ul><br/>
    </div>
    <?php if (! $ci->Usuario->isLogged()){?>
      <div class="form-group col-md-7">
        <form method="post" action="<?=site_url('Login')?>">
          <div class="row" style="margin-left:2%;">
            <div class="col-xs-5 col-md-4" style="margin:1%">
              <input type="text" name="usuario" id="usuario" placeholder="Usuario"/>
            </div>
            <div class="col-xs-6 col-md-6" style="margin:1%">
              <input type="password" name="pass" id="pass" placeholder="Contraseña"/>
              <button class="fa fa-envelope-o" type="submit" value="submit"></button>
            </div>
          </div>
        </form>
      </div>
    <?php }else{?>
    <div class="col-md-4"></div>
    <div class="col-xs-12 col-md-2" id="options3">
      | <li><a href="<?=site_url('Login/logOut')?>"> Cerrar sesión </a> </li> | 
    </div>
    <?php }?>
  </div>
</div>
<div class="wrapper row1">
  <header id="header" class="clear"> 
    <div id="logo" class="fl_left col-xs-12">
      <h2>¡Siga los encuentros de su equipo!</h2>
    </div>
    <nav id="mainav" class="fl_right">
    <div class="row col-xs-12">
      <ul class="clear">
        <li><a class="drop" href="">Sitios</a>
          <ul>
            <li><a href="<?= site_url('Sports'); ?>">Deportes</a></li>
            <li><a href="<?= site_url('Ligas'); ?>">Ligas</a></li>
          </ul>
        </li>
        <li><a class="drop" href="">Categorías</a>
          <ul>
          <li><a class="drop" href=""><?=$categorias[0]['nombre']?></a>
              <ul>
              <?php foreach($deportes as $deporte):
                if($deporte['categorias_idcategorias']=="1"):?>
                <li><a href="<?=site_url('Sports/cargaDeporte/'.$deporte["iddeporte"]);?>"><?=$deporte['nombre']?></a></li>
                <?php endif; endforeach;?>
              </ul>
            </li>
            <li><a class="drop" href=""><?=$categorias[1]['nombre']?></a>
              <ul>
              <?php foreach($deportes as $deporte):
                if($deporte['categorias_idcategorias']=="2"):?>
                <li><a href="<?=site_url('Sports/cargaDeporte/'.$deporte["iddeporte"]);?>"><?=$deporte['nombre']?></a></li>
                <?php endif; endforeach;?>
              </ul>
            </li>
          </ul>
        </li>
        <?php if ($ci->Usuario->isGestor()):?>
            <li><a href="<?= site_url('Ligas')?>">Administrar ligas</a></li>
        <?php endif;?>
        <?php if ($ci->Usuario->isAdmin()):?>
            <li><a href="<?= site_url('Ligas')?>">Administrar ligas</a></li>
            <li><a href="#">Solicitudes</a></li>
        </div>
       <?php endif;?>
      </ul>
      </div>
    </nav>
  </header>
</div>

<?=$body?>
</div>
</body>

<div class="wrapper row4" style="margin-top: 50px;">
<footer id="footer" class="clear"> 
  <div class="row col-md-12 col-xs-12">
    <div class="col-xs-12 col-md-4" style="margin-bottom:5%">
      <h6 class="title">Datos de contacto</h6>
      <address class="btmspace-30">
      Liga de deportes<br>
      Pablo Rodríguez González<br>
      IES La Marisma<br>
      Huelva
      </address>
      <ul class="nospace">
        <li>- Horario atención al cliente: </li>
        <li class="btmspace-10"><span class="fa fa-clock-o"></span> Lun. - Vier.: 10:00 - 19:00</li>
        <li><span class="fa fa-envelope-o"></span> parogon@hotmail.es</li>
      </ul>
    </div>
    <div class="col-xs-12 col-md-4">
      <h6 class="title">Búsqueda rápida</h6>
      <ul class="nospace linklist">
      <?php foreach($deportes as $deporte):?>
        <li><a href="<?=site_url('Sports/cargaDeporte/'.$deporte["iddeporte"]);?>">Equipos de <?=$deporte['nombre']?></a></li>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
  </footer>
  <div class="wrapper row6 col-xs-12">
  <div id="copyright" class="clear"> 
    <p class="fl_left">&copy; 2019 - Liga de deportes varios | <a href="#top"><strong>Volver arriba</strong></a></p>
  </div>
</div>
</div>

</html>