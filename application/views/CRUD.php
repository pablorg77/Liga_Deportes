<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
</head>
<body>
<div>
    <a href='<?= site_url('Principal')?>'>Volver a página principal</a> 
    <p>Tipo 1: Administrador</p>
    <p>Tipo 2: Gestor</p>
    <p>Tipo 3: Usuario</p>
</div>
<div style='height:20px;'></div>
<div style="padding: 10px">
    <?php echo $output; ?>
</div>
<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</body>
</html>