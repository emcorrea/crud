<?php
require"../../modelo/conexion.php";
require"funciones.php";
$conexion = new DBconexion();

actualizar($conexion,"PERSONA",3,"nombre,apellidoPaterno,apellidoMaterno","Emilio Andres,Correa,Soto",1,"rut","16885063");
?>