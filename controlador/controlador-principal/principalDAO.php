<?php
//include __DIR__.'/../../modelo/conexion.php';
include __DIR__.'/interfaz-DAO.php';

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
        	include __DIR__.'../../funciones-generales/funciones.php';
            $conexion   = new DBconexion();
          
            grabar($conexion,"PERSONA",7,"rut,nombre,apellidoPaterno,apellidoMaterno,fechaNacimiento,domicilio,telefono","$rut,$nombre,$ap,$am,$fechaNac,$domicilio,$fono");
            grabar($conexion,"CLIENTE",4,"rutPersona,ejecutivo,sucursal,fechaInscripcion","$rut,$ejecutivo,$sucursal,$fechaRegistro");
            
        }catch(Exception $e){
            echo"No se pudo ejecutar la funcion grabar: Error ".$e;
        }
    }

    function clientesTabla(){
    	try {
    		$conexion   = new DBconexion();
    		$sql = $conexion->query("  
				SELECT 
					* 
				FROM
					PERSONA p JOIN CLIENTE cli 
					ON(p.rut=cli.rutPersona)
					JOIN EJECUTIVO ej
					ON(cli.ejecutivo = ej.rutEjecutivo)
					JOIN SUCURSAL suc
					ON(cli.sucursal = suc.codigoSucursal)");

    		if($sql->rowCount()>0){
    			$n=0;
    			?>
    			<table>
    				<tr>
    					<th>N°</th>
    					<th>RUT</th>
    					<th>Nombre</th>
    					<th>Fecha Nacimiento</th>
    					<th>Domicilio</th>
    					<th>Telefono</th>
    					<th>Ejecutivo</th>
    					<th>Sucursal</th>
    					<th>Acción</th>
    				</tr>
    			<?php
    			foreach ($sql->fetchAll(PDO::FETCH_OBJ) as $fila) {
    				$n++;
    				?>
    				<tr>
    					<td><?=$n?></td>
    					<td><?=$fila->rut?></td>
    					<td><?=$fila->nombre?></td>
    					<td><?=$fila->fechaNacimiento?></td>
    					<td><?=$fila->domicilio?></td>
    					<td><?=$fila->telefono?></td>
    					<td><?=$fila->nombreEjecutivo?></td>
    					<td><?=$fila->descripcion?></td>
    					<td>-*-</td>
    				<?php
    			}
    			?>
    				</tr>
    			</table>
    			<?php
    		}

    		
    		
    		
    	} catch (Exception $e) {
    		echo"No se pudo instanciar la funcion ClienteTabla: Error ".$e;
    	}
    }
	
}



?>