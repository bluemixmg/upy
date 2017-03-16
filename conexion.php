<?php 

// Parametros a configurar para la conexion de la base de datos 

$hotsbd = "localhost";    // sera el valor de nuestra BD 
$basededatos = "ev000477_upy";    // sera el valor de nuestra BD 

$usuariobd = "ev000477_upy";    // sera el valor de nuestra BD 
$clavebd = "ZAgu22zofu";    // sera el valor de nuestra BD 

// Fin de los parametros a configurar para la conexion de la base de datos 

//$conexion_bd = mysqli_connect("$hotsbd","$usuariobd","$clavebd","$basededatos")
$conexion_bd = mysqli_connect("$hotsbd","$usuariobd","$clavebd");
    //or die ("Conexión denegada, el Servidor de Base de datos que solicitas no puede ser localizado"); 

if ($conexion_bd->connect_error) {
    die("Connection failed: " . $conexion_bd->connect_error);
} 
    $db = mysqli_select_db($conexion_bd,"$basededatos")
    or die ("La Base de Datos <b>$basededatos</b> no puede ser localizada");