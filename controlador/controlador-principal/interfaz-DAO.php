<?php
	
	interface interfazPrincipalDAO{
		function selectEjecutivo();
		function selectSucursal();
        function agregaCliente($rut,$nombre,$ap,$am,$fechaNac,$domicilio,$fono,$ejecutivo,$sucursal,$fechaRegistro);
        function clientesTabla();
        function eliminarCliente($rut);
        function actualizar($rut);
	}

?>