<?php
//include __DIR__.'/../../modelo/conexion.php';
include __DIR__.'/interfaz-DAO.php';
include __DIR__.'/funciones-generales/funciones.php';

class principal implements interfazPrincipalDAO{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

	function selectEjecutivo(){
	    try {
			$conexion = new DBconexion();

			$sql=$conexion->query("SELECT * FROM EJECUTIVO WHERE activo = 1");
			?>
			<select name="ejecutivo" id="ejecutivo" class="form-control form-control-sm">
				<option value="0">Seleccione ejecutivo</option>
			<?php
			while($resultado = $sql->fetch()){
				?>
				<option value='<?=$resultado['rutEjecutivo']?>'><?=$resultado['nombreEjecutivo']?></option>
				<?php
			}
			?>
			</select>
			<?php	
    	} catch (Exception $e) {
    		echo"No se pudo intanciar el metodo, error: ".$e;
    	}

	}

	function selectSucursal(){
		try {
			$conexion = new DBconexion();

			$sql=$conexion->query("SELECT * FROM SUCURSAL WHERE activo = 1");
			?>
			<select name="sucursal" id="sucursal" class="form-control form-control-sm">
				<option value="0">Seleccione sucursal</option>
			<?php
			while($resultado = $sql->fetch()){
				?>
				<option value='<?=$resultado['codigoSucursal']?>'><?=$resultado['descripcion']?></option>
				<?php
			}
			?>
			</select>
			<?php	
    	} catch (Exception $e) {
    		echo"No se pudo intanciar el metodo, error: ".$e;
    	}
	}
    
    function agregaCliente($rut,$nombre,$ap,$am,$fechaNac,$domicilio,$fono,$ejecutivo,$sucursal,$fechaRegistro){
        try{
            $conexion   = new DBconexion();
            $funciones  = new funcionesGenerales($conexion);
            $funciones->grabar($conexion,"PERSONA",7,"rut,nombre,apellidoPaterno,apellidoMaterno,fechaNacimiento,telefono,domicilio","$rut,$nombre,$ap,$am,$fechaNac,$domicilio,$fono,$ejecutivo,$sucursal");
            $funciones->grabar($conexion,"CLIENTE",4,"rutCliente,ejecutivo,sucursal,fechaRegistro","$rut,$ejecutivo,$sucursal,$fechaRegistro");
            
        }catch(Exception $e){
            echo"No se pudo ejecutar la funcion grabar: Error ".$e;
        }
    }
	
}



?>