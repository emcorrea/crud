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
	function actualizar($conexion,$tabla,$cantidadSet,$camposSet,$valoresSet,$cantidadWhere,$camposWhere,$valoresWhere){
		//Prepara los campos del SET
		$_camposSet = array();
		$generalCamposSet = "";
		$n = 0;

		for($i=0;$cantidadSet>$i;$i++){
			$n++;
			$datoSet = explode(",",$camposSet);
			if($cantidadSet==$n){
				$_camposSet[$i] = $datoSet[$i]." = ? ";
			}else{
				$_camposSet[$i] = $datoSet[$i]." = ? , ";
			}

			$generalCamposSet = $generalCamposSet.$_camposSet[$i];
		}

		//Prepara los valores del SET
		$_valoresSet = array();

		for($i=0;$cantidadSet>$i;$i++){
			$datoSet = explode(",",$valoresSet);
			$_valoresSet[$i] = $datoSet[$i]; 
		}

		//Prepara los campos del WHERE
		$_camposWhere = array();
		$generalesCamposWhere = "";
		$n = 0;

		for($i=0;$cantidadWhere>$i;$i++){
			$n++;
			$datoSet = explode(",",$camposWhere);
			if($cantidadWhere==$n){
				$_camposWhere[$i] = $datoSet[$i]." = ? ";
			}else{
				$_camposWhere[$i] = $datoSet[$i]." = ? , ";
			}

			$generalesCamposWhere = $generalesCamposWhere.$_camposWhere[$i];
		}

		//Prepara los valores del WHERE
		$_valoresWhere = array();

		for($i=0;$cantidadWhere>$i;$i++){
			$datoSet = explode(",",$valoresWhere);
			$_valoresWhere[$i] = $datoSet[$i]; 
		}

		//Prepara los valores para el array
		$sumaFor = $cantidadSet+$cantidadWhere;

		for($i=0;$sumaFor;$i++){

		}


		//print_r($_camposSet);
		//print_r($_valoresSet);
		//print_r($_camposWhere);
		//print_r($_valoresWhere);

		$sqlUpdate = $conexion->prepare("UPDATE $tabla SET $generalCamposSet WHERE $generalesCamposWhere");
		$sqlUpdate->execute($_valoresSet,$_valoresWhere);
	}

	//DELETE
	function eliminar($conexion,$tabla,$campo,$valor){
		$sql="DELETE FROM $tabla WHERE $campo = ?";
		$resultado=$conexion->prepare($sql);
		$resultado->execute(array($valor));

	}

	

?>