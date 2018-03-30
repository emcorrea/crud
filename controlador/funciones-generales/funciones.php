<?php
/*CRUD - CREATE,READ,UPDATE,DELETE*/
//include __DIR__.'/../../modelo/conexion.php';

	//CREATE
	function grabar($conexion,$nombreTabla,$cantidadCampos,$campos,$valores){
		$_values 	= array();
		$values_ 	= "";
		$_arreglo   = array();

		//Guarda los datos de los campo para el value en un arreglo
		for($i=0; $cantidadCampos > $i; $i++){
			$datos = explode(",",$campos);
			$_values[$i] = ":".$datos[$i];
		}

		//Prepara la sentencia insert
		for($i=0; $cantidadCampos > $i; $i++){
			if($cantidadCampos == $i+1){
				$values_ = $values_.$_values[$i];
			}else{
				$values_ = $values_.$_values[$i].",";
			}	
			$sql="INSERT INTO $nombreTabla ($campos) VALUES ($values_)";
		}

		//Prepara el array para el execute
		for($i=0; $cantidadCampos > $i; $i++){
			$datosCampos 	= explode(",",$campos);
			$datosValores 	= explode(",",$valores);

			$_arreglo[$datosCampos[$i]]=$datosValores[$i];
			
		}
        
		$resultado=$conexion->prepare($sql);
		$resultado->execute($_arreglo);
	}

	//READ
	function leer(){

	}

	//UPDATE
	function actualizar(){

	}

	//DELETE
	function eliminar($conexion,$tabla,$campo,$valor){
		$sql="DELETE FROM $tabla WHERE $campo = ?";
		$resultado=$conexion->prepare($sql);
		$resultado->execute(array($valor));

	}


?>