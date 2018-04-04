<?php
	include_once'../modelo/conexion.php';
	include_once'../controlador/controlador-principal/principalDAO.php';
	$conexion 	= new DBconexion();
	$principal 	= new principal($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD - Actualizar Registros</title>
	<script src="JavaScript/jquery-3.2.1.js" type="text/javascript" charset="utf-8"></script>
	<script src="JavaScript/formato_rut.js" type="text/javascript" charset="utf-8"></script>
	<script src="JavaScript/js-generales.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="estilos/estilos-principal.css">
	<link rel="stylesheet" href="estilos/bootstrap-4.0.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<script src="estilos/bootstrap-4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="contenedor">
		<div class="titulo"><h4>Actualizar</h4></div><br>
		<div class="formulario">
			<?=$principal->actualizar($_GET['rut'])?>
		</div>
	</div>
</body>
</html>