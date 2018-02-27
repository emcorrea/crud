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
                            
                            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" value="<?=$fila->rut?>" onclick="modal(this.value)">Actualizar</button> 
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
        $conexion   = new DBconexion();
        $principal  = new principal($conexion);
        $sql=$conexion->prepare
        ("
            SELECT 
                * 
            FROM
                PERSONA per JOIN CLIENTE cli
                ON(per.rut=cli.rutPersona)
            WHERE
                per.rut = ?
        ");
        $sql->execute(array($rut));
        $fila = $sql->fetch();
        //VARIABLES
        $rut        = $fila['rut'];
        $nombre     = $fila['nombre'];
        $ap         = $fila['apellidoPaterno'];
        $am         = $fila['apellidoMaterno'];
        $fechaNac   = $fila['fechaNacimiento'];
        $domicilio  = $fila['domicilio'];
        $fono       = $fila['telefono'];
        $ejecutivo  = $fila['ejecutivo'];
        $sucursal   = $fila['sucursal'];

        ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input id="rut" class="form-control form-control-sm" type="text" value="<?=$rut?>" placeholder="RUT Cliente">
                        <input id="nombre" class="form-control form-control-sm" type="text" value="<?=$nombre?>" placeholder="Nombre Cliente">
                        <input id="ap" class="form-control form-control-sm" type="text" value="<?=$ap?>" placeholder="Apellido Paterno Cliente">
                        <input id="am" class="form-control form-control-sm" type="text" value="<?=$am?>" placeholder="Apellido Materno Cliente">
                        <input id="fechaNac" class="form-control form-control-sm" type="date" value="<?=$fechaNac?>" placeholder="Fecha Nacimiento Cliente">
                        <input id="domicilio" class="form-control form-control-sm" type="text" value="<?=$domicilio?>" placeholder="Domicilio Cliente">
                        <input id="telefono" class="form-control form-control-sm" type="text" value="<?=$fono?>" placeholder="Teléfono Cliente">
                        <?=$principal->selectEjecutivo()?>
                        <?=$principal->selectSucursal()?>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Actualizar</button>
                </div>
                </div>
            </div>
        </div>
        <?php
    }
	
}



?>