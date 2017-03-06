<?php 

// Parametros a configurar para la conexion de la base de datos 

$hotsbd = "localhost";    // sera el valor de nuestra BD 
$basededatos = "bd_upy";    // sera el valor de nuestra BD 

$usuariobd = "root";    // sera el valor de nuestra BD 
$clavebd = "";    // sera el valor de nuestra BD 

// Fin de los parametros a configurar para la conexion de la base de datos 

$conexion_bd = mysqli_connect("$hotsbd","$usuariobd","$clavebd","$basededatos")
    or die ("Conexión denegada, el Servidor de Base de datos que solicitas no puede ser localizado"); 
    $db = mysqli_select_db($conexion_bd,"$basededatos")
    or die ("La Base de Datos <b>$basededatos</b> no puede ser localizada");