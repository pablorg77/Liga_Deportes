<?= form_open('Login/register'); ?>
<div style="margin-left: 15%; margin-top: 5%; width: 40%; float: left">
    <form id="register" method="post" style="display: block;">
    <div class="form-group">
        <label for="email">Correo electrónico: </label>
        <input type="email" class="form-control" id="email" value="<?=set_value('email')?>"
            name="email" aria-describedby="emailHelp" placeholder="Introduzca correo">
        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo con nadie. </small>
        <?= form_error('email');?>
    </div>
    <div class="form-group">
        <label for="user">Usuario: </label>
        <input type="text" class="form-control" id="user" name="user" placeholder="Usuario">
        <?= form_error('user');?>
    </div>
    <div class="form-group">
        <label for="pass">Contraseña: </label>
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Longitud mínima de 6 caracteres">
        <?= form_error('pass');?>
    </div>
    <div class="form-group">
        <label for="nombre">Nombre: </label>
        <input type="text" class="form-control" id="nombre" value="<?=set_value('nombre')?>"
                name="nombre" placeholder="Nombre">
        <?= form_error('nombre');?>
    </div>
    <div class="form-group">
        <label for="apellidos">Apellidos: </label>
        <input type="text" class="form-control" id="apellidos" value="<?=set_value('apellidos')?>"
                name="apellidos" placeholder="Apellidos">
        <?= form_error('apellidos');?>
    </div>
    <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
</div>