<?php
/*CRUD - CREATE,READ,UPDATE,DELETE*/
include __DIR__.'/../../modelo/conexion.php';

class funcionesGenerales{
	private $conexion;
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

	//CREATE
	function grabar($conexion,$nombreTabla,$cantidadCampos,$campos,$valores){
		$_values 	= array();
		$values_ 	= "";
		$array		= "";

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

			if($cantidadCampos == $i+1){
				$array 	= $array."':".$datosCampos[$i]."'=>".$datosValores[$i];
			}else{
				$array 	= $array."':".$datosCampos[$i]."'=>".$datosValores[$i].",";
			}
			
		}
		echo$sql."<br>";
		echo$array;
		$resultado=$conexion->prepare($sql);
		$resultado->execute(array($array));
		
	}

	//READ
	function leer(){

	}

	//UPDATE
	function actualizar(){

	}

	//DELETE
	function eliminar(){

	}
}

$conexion = new DBconexion();
$funciones = new funcionesGenerales($conexion);
$funciones->grabar($conexion,"EJECUTIVO",2,"rutEjecutivo,nombreEjecutivo","17562105,'LUIS SOCALO ALVEAR'");

/*
$valores = "Hola,como,estas";
$datos = explode(",",$valores);
echo$datos[0]."<br>";
echo$datos[1]."<br>";
echo$datos[2]."<br>";
*/

?>