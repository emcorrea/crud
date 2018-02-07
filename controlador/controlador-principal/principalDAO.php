<?php
//include __DIR__.'/../../modelo/conexion.php';
include __DIR__.'/interfaz-DAO.php';
<<<<<<< HEAD
include __DIR__.'funciones-generales/funciones.php';
=======
>>>>>>> 1d47b6df7f4c04fbd4898385a64bb3df91f31798

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
        	include __DIR__.'/funciones-generales/funciones.php';
            $conexion   = new DBconexion();
            $funciones  = new funcionesGenerales($conexion);
            $funciones->grabar($conexion,"PERSONA",7,"rut,nombre,apellidoPaterno,apellidoMaterno,fechaNacimiento,domicilio,telefono","$rut,$nombre,$ap,$am,$fechaNac,$domicilio,$fono");
            $funciones->grabar($conexion,"CLIENTE",4,"rutPersona,ejecutivo,sucursal,fechaInscripcion","$rut,$ejecutivo,$sucursal,$fechaRegistro");
            
        }catch(Exception $e){
            echo"No se pudo ejecutar la funcion grabar: Error ".$e;
        }
    }
	
}



?>