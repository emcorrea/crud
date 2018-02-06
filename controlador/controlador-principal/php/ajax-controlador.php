<?php

include_once __DIR__.'/../../modelo/conexion.php';
include_once __DIR__.'../principalDAO.php';

$conexion       = new DBconexion();
$principal 		= new agregaCliente($conexion);

