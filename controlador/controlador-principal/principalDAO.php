<?php
//include __DIR__.'/../../modelo/conexion.php';
include __DIR__.'/interfaz-DAO.php';

class principal implements interfazPrincipalDAO{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

	function selectEjecutivo($rut){
	    try {
			$conexion = new DBconexion();

			$sql=$conexion->prepare
				("
					SELECT 
						* 
					FROM 
						CLIENTE cli JOIN EJECUTIVO eje
						ON(cli.ejecutivo = eje.rutEjecutivo) 
					WHERE 
						rutPersona = ?
				");
			$sql->execute(array($rut));
			if($sql->rowCount()>0)
			{
				$fila = $sql->fetch();
				$ejecutivo 		= $fila['ejecutivo'];
				$nomEjecutivo 	= $fila['nombreEjecutivo'];

				$sql=$conexion->prepare("SELECT * FROM EJECUTIVO WHERE rutEjecutivo != ? AND activo = ?");
				$sql->execute(array($ejecutivo,1));
				?>
				<select name="ejecutivo" id="ejecutivo" class="form-control form-control-sm">
					<option value="<?=$ejecutivo?>"><?=$nomEjecutivo?></option>
				<?php
				while($resultado = $sql->fetch()){
					?>
					<option value='<?=$resultado['rutEjecutivo']?>'><?=$resultado['nombreEjecutivo']?></option>
					<?php
				}
				?>
				</select>
				<?php
			}else{
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
			}	
    	} catch (Exception $e) {
    		echo"No se pudo intanciar el metodo, error: ".$e;
    	}

	}

	function selectSucursal($rut){
		try {
			$conexion = new DBconexion();

			$sql=$conexion->prepare
				("
					SELECT 
						* 
					FROM 
						CLIENTE cli JOIN SUCURSAL sucu
						ON(cli.sucursal = sucu.codigoSucursal) 
					WHERE 
						rutPersona = ?
				");
			$sql->execute(array($rut));
			if($sql->rowCount()>0)
			{
				$fila = $sql->fetch();
				$sucursal 		= $fila['sucursal'];
				$nomEjecutivo 	= $fila['descripcion'];

				$sql=$conexion->prepare("SELECT * FROM SUCURSAL WHERE codigoSucursal != ? AND activo = ?");
				$sql->execute(array($sucursal,1));
				?>
				<select name="sucursal" id="sucursal" class="form-control form-control-sm">
					<option value="<?=$sucursal?>"><?=$nomEjecutivo?></option>
				<?php
				while($resultado = $sql->fetch()){
					?>
					<option value='<?=$resultado['codigoSucursal']?>'><?=$resultado['descripcion']?></option>
					<?php
				}
				?>
				</select>
				<?php
			}else{
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
			}	
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
    			<table class="table table-sm">
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
    					<td><?=$fila->nombre?> <?=$fila->apellidoPaterno?> <?=$fila->apellidoMaterno?></td>
    					<td><?=$fila->fechaNacimiento?></td>
    					<td><?=$fila->domicilio?></td>
    					<td><?=$fila->telefono?></td>
    					<td><?=$fila->nombreEjecutivo?></td>
    					<td><?=$fila->descripcion?></td>
    					<td>
                            
                            <button type="button" class="btn btn-outline-info btn-sm" value="<?=$fila->rut?>" onclick="ventanaActualizar(this.value)">Actualizar</button> 
                            <button type="button" class="btn btn-outline-danger btn-sm" id="eliminar" value="<?=$fila->rut?>" onclick="eliminar(this.value)">Eliminar</button>
                        </td>
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

    function eliminarCliente($rut){
        try {
            include __DIR__.'../../funciones-generales/funciones.php';
            $conexion   = new DBconexion();
            eliminar($conexion,"PERSONA","rut",$rut);
            eliminar($conexion,"CLIENTE","rutPersona",$rut);
        } catch (Exception $e) {
            echo"No se pudo ejecutar la funcion Eliminar: Error ".$e;
        }
    }

    function actualizar($rut){
        try {
            $conexion   = new DBconexion();
            $principal  = new principal($conexion);
            $sql = $conexion->prepare("SELECT * FROM PERSONA WHERE rut = ?");
            $sql->execute(array($rut));
            $fila = $sql->fetch();
        ?>
            <form id="cliente" name="formulario-cliente" action="#" method="POST">
                <div class="formulario-modal">
                    <input id="rut" class="form-control form-control-sm" type="text" value="<?=$rut?>">
                    <input id="nombre" class="form-control form-control-sm" type="text" value="<?=$fila['nombre']?>">
                    <input id="ap" class="form-control form-control-sm" type="text" value="<?=$fila['apellidoPaterno']?>">
                    <input id="am" class="form-control form-control-sm" type="text" value="<?=$fila['apellidoMaterno']?>">
                    <input id="fechaNac" class="form-control form-control-sm" type="date" value="<?=$fila['fechaNacimiento']?>">
                    <input id="domicilio" class="form-control form-control-sm" type="text" value="<?=$fila['domicilio']?>">
                    <input id="telefono" class="form-control form-control-sm" type="text" value="<?=$fila['telefono']?>">
                    <?=$principal->selectEjecutivo($rut)?>
                    <?=$principal->selectSucursal($rut)?>
                    <div class="btns-actualizar">
                        <button id="actualizar" type="button" class="btn btn-info btn-sm">Actualizar</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="window.close()">Cerrar</button>
                    </div>
                </div>
            </form>
        <?php
        } catch (Exception $e) {
            
        }
    }
	
}



?>