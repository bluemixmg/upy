<?php 

// Parametros a configurar para la conexion de la base de datos 

$hotsbd = "us-cdbr-iron-east-03.cleardb.net";    // sera el valor de nuestra BD 
$basededatos = "ad_cf9caa47af41265";    // sera el valor de nuestra BD 

$usuariobd = "b74e1e2c618ed4";    // sera el valor de nuestra BD 
$clavebd = "96c9ba72";    // sera el valor de nuestra BD 

// Fin de los parametros a configurar para la conexion de la base de datos 

$conexion_bd = mysqli_connect("$hotsbd","$usuariobd","$clavebd","$basededatos")
    or die ("Conexión denegada, el Servidor de Base de datos que solicitas no puede ser localizado"); 
    $db = mysqli_select_db($conexion_bd,"$basededatos")
    or die ("La Base de Datos <b>$basededatos</b> no puede ser localizada");