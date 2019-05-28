<div style="margin-top: 5%; margin-left:15%;">
    <h3><strong>¡Bienvenido <?=$this->session->userdata('user')->nombre?> 
        <?=$this->session->userdata('user')->apellidos?>, ¿qué desea hacer?: </strong></h3><br/>
    <li><a href="<?= site_url('Ligas/getLigas')?>">Consultar ligas</a></li><br/>
    <li><a href="<?= site_url('Principal/solicitud')?>">Solicitud para gestor de liga</a></li><br/>
    <li><a href="<?= site_url('Principal')?>">Página principal</a></li>
</div>