<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="description" content="Liga de deportes">
    <meta name="author" content="Pablo Rodriguez Gonzalez">
    <?header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
      header("Allow: GET, POST, OPTIONS, PUT, DELETE");
      $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
          die();}?>
  
    <title>Liga de deportes</title>

    <link href="<?=base_url();?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?=base_url();?>/assets/css/layout.css" rel="stylesheet">
    <script src="<?=base_url();?>/assets/jquery/jquery.min.js"></script>
    <script src="<?=base_url();?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php 
      $ci=get_instance();
      $ci->load->Model('Deportes');
      $ci->load->Model('Usuario');
      $deportes = $ci->Deportes->getDeportes();
      $categorias = $ci->Deportes->getCategorias();
    ?>
</head>
<body id="top">
<div class="wrapper row0">
  <div id="topbar" class="clear"> 
    <div class="fl_left">
      <ul class="nospace">
      <li><a href="<?=site_url('Principal');?>">Página principal</a></li>
        <li><a href="<?=site_url('Plays');?>">Jugados</a></li>
        <li><a href="#">Por jugar</a></li>
        <li><a href="#">Actuales</a></li>
      </ul>
    </div>
    <div class="fl_right">
      <form class="clear" method="post" action="#">
        <li> | <a href="<?= site_url('Principal/register');?>">¿No está aún registrado? </a></li>
          <input type="text" name="usuario" id="usuario" placeholder="Usuario"/>
          <input type="password" name="password" id="password" placeholder="Contraseña"/>
          <button class="fa fa-envelope-o" type="submit" value="submit"></button>
      </form>
    </div>
  </div>
</div>
<div class="wrapper row1">
  <header id="header" class="clear"> 
    <div id="logo" class="fl_left">
      <h2>¡Siga los encuentros de su equipo!</h2>
    </div>
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li><a class="drop" href="">Sitios</a>
          <ul>
            <li><a href="<?= site_url('Sports'); ?>">Deportes</a></li>
            <li><a href="pages/full-width.html">Ligas</a></li>
            <li><a href="pages/sidebar-left.html">Equipos</a></li>
          </ul>
        </li>
        <li><a class="drop" href="">Categorías</a>
          <ul>
          <li><a class="drop" href="#"><?=$categorias[0]['nombre']?></a>
              <ul>
              <?php foreach($deportes as $deporte):
                if($deporte['categorias_idcategorias']=="1"):?>
                <li><a href="<?=site_url('Sports/cargaDeporte/'.$deporte["iddeporte"]);?>"><?=$deporte['nombre']?></a></li>
                <?php endif; endforeach;?>
              </ul>
            </li>
            <li><a class="drop" href="#"><?=$categorias[1]['nombre']?></a>
              <ul>
              <?php foreach($deportes as $deporte):
                if($deporte['categorias_idcategorias']=="2"):?>
                <li><a href="<?=site_url('Sports/cargaDeporte/'.$deporte["iddeporte"]);?>"><?=$deporte['nombre']?></a></li>
                <?php endif; endforeach;?>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="#">Administrar ligas</a></li>
        <li><a href="#">Solicitudes</a></li>
      </ul>
    </nav>
  </header>
</div>

<?=$body?>

</body>

<div class="wrapper row4" style="margin-top: 50px;">
<footer id="footer" class="clear"> 
    <div class="one_quarter first">
      <h6 class="title">Datos de contacto</h6>
      <address class="btmspace-30">
      Liga de deportes<br>
      Pablo Rodríguez González<br>
      IES La Marisma<br>
      Huelva
      </address>
      <ul class="nospace">
        <li class="">- Horario atención al cliente: </li>
        <li class="btmspace-10"><span class="fa fa-clock-o"></span> Lun. - Vier.: 10:00 - 19:00</li>
        <li><span class="fa fa-envelope-o"></span> parogon@hotmail.es</li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="title">Búsqueda rápida</h6>
      <ul class="nospace linklist">
      <?php foreach($deportes as $deporte):?>
        <li><a href="<?=site_url('Sports/cargaDeporte/'.$deporte["iddeporte"]);?>">Ligas de <?=$deporte['nombre']?></a></li>
        <?php endforeach;?>
      </ul>
    </div>
  </footer>
  <div class="wrapper row6">
  <div id="copyright" class="clear"> 
    <p class="fl_left">&copy; 2019 - Liga de deportes varios | <a href="#top"><strong>Volver arriba</strong></a></p>
  </div>
</div>
</div>
</html>