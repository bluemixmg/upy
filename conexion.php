<?php 
//require 'DBManager.php';
?>
<?php

    $dbm = new DBManager();
    $conexion_bd = $dbm->getConnection();
    //$db = mysql_select_db($conn,"$basededatos")
    //or die ("La Base de Datos <b>$basededatos</b> no puede ser localizada");
//// Parametros a configurar para la conexion de la base de datos 

//$hotsbd = "us-cdbr-iron-east-03.cleardb.net";    // sera el valor de nuestra BD 
//$basededatos = "ad_cf9caa47af41265";    // sera el valor de nuestra BD 

//$usuariobd = "b74e1e2c618ed4";    // sera el valor de nuestra BD 
//$clavebd = "96c9ba72";    // sera el valor de nuestra BD 

//// Fin de los parametros a configurar para la conexion de la base de datos 
//echo 'Voy a tratar de conectarme';
////$conexion_bd = mysqli_connect("$hotsbd","$usuariobd","$clavebd","$basededatos")
//$conexion_bd = new mysqli("$hotsbd","$usuariobd","$clavebd","$basededatos");
//if($conexion_bd->connect_error) {
//    die ("Conexión denegada, el Servidor de Base de datos que solicitas no puede ser localizado"); 
//}
//echo 'Conectado exitosamente';
    //$db = mysqli_select_db($conexion_bd,"$basededatos")
    //or die ("La Base de Datos <b>$basededatos</b> no puede ser localizada");
