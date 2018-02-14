<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'../../controlador-principal/principalDAO.php';

$conexion       = new DBconexion();
$principal 		= new principal($conexion);

if(isset($_REQUEST['rut']) && isset($_REQUEST['nombre']) && isset($_REQUEST['aPaterno']) && isset($_REQUEST['aMaterno']) && isset($_REQUEST['fechaNac']) && isset($_REQUEST['domicilio']) && isset($_REQUEST['telefono']) && isset($_REQUEST['ejecutivo']) && isset($_REQUEST['sucursal'])){
    echo"Entro por acá";
    $rut            = $_REQUEST['rut'];
    $rut            = str_replace(".","",$rut);
    $rut            = str_replace("-","",$rut);
    $rut            = substr($rut,0,-1);
    $nombre         = $_REQUEST['nombre'];
    $ap             = $_REQUEST['aPaterno'];
    $am             = $_REQUEST['aMaterno'];
    $fechaNac       = $_REQUEST['fechaNac'];
    $domicilio      = $_REQUEST['domicilio'];
    $fono           = $_REQUEST['telefono'];
    $ejecutivo      = $_REQUEST['ejecutivo'];
    $sucursal       = $_REQUEST['sucursal'];
    $fechaRegistro  = date('Y-m-d h:i:s');
    
    $principal->agregaCliente($rut,$nombre,$ap,$am,$fechaNac,$domicilio,$fono,$ejecutivo,$sucursal,$fechaRegistro);
}else if(isset($_REQUEST['rutPersona'])){
    $rut = $_REQUEST['rutPersona'];

    $principal->eliminarCliente($rut);

}else if(isset($_REQUEST['ventanaRut'])){
    $rut = $_REQUEST['ventanaRut'];
    
    $principal->actualizar($rut);

}else{
    echo"No se pudo instanciar la grabación";
}

