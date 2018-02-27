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
	<title>CRUD</title>
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
		<div class="titulo"><h4>CRUD CLIENTES</h4></div>
		<div class="formulario">
			<!--MODAL-->
			<button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar Nuevo Cliente</button>
			<div id="modalfor" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <!--INICIO DEL CONTENIDO DEL FORMULARIO-->
			      <div class="modal-body">
			        <form id="cliente" name="formulario-cliente" action="#" method="POST">
			        	<div class="formulario-modal">
			        		<input id="rut" class="form-control form-control-sm" type="text" placeholder="RUT Cliente">
			        		<input id="nombre" class="form-control form-control-sm" type="text" placeholder="Nombre Cliente">
			        		<input id="ap" class="form-control form-control-sm" type="text" placeholder="Apellido Paterno Cliente">
			        		<input id="am" class="form-control form-control-sm" type="text" placeholder="Apellido Materno Cliente">
			        		<input id="fechaNac" class="form-control form-control-sm" type="date" placeholder="Fecha Nacimiento Cliente">
			        		<input id="domicilio" class="form-control form-control-sm" type="text" placeholder="Domicilio Cliente">
			        		<input id="telefono" class="form-control form-control-sm" type="text" placeholder="Teléfono Cliente">
			        		<?=$principal->selectEjecutivo()?>
			        		<?=$principal->selectSucursal()?>
			        		<div id="respuesta"></div>
			        		<div class="modal-footer">
						        <button id="guardar" type="button" class="btn btn-success">Guardar</button>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					      </div>
			        	</div>
			        </form>
			      </div>
			      <!--FIN DEL FORMULARIO-->
			    </div>
			  </div>
			</div>
			<!--FIN MODAL-->
			<div id="modal_actualizar"></div>
		</div>
		<div id="tabla"><?=$principal->clientesTabla()?></div>
	</div>
</body>
</html>