<?php 
require 'DBManager.php';
?>
<?php

    $dbm = new DBManager();
    $conexion_bd = $dbm->getConnection();
    //$db = mysql_select_db($conn,"$basededatos")
    //or die ("La Base de Datos <b>$basededatos</b> no puede ser localizada");
// Parametros a configurar para la conexion de la base de datos 

//$hotsbd = "ecuador.ferozo.com";    // sera el valor de nuestra BD 
//$basededatos = "ev000477_upy";    // sera el valor de nuestra BD 

//$usuariobd = "ev000477_upy";    // sera el valor de nuestra BD 
//$clavebd = "ZAgu22zofu";    // sera el valor de nuestra BD 
//$port = "2092";

// Fin de los parametros a configurar para la conexion de la base de datos 

//$conexion_bd = mysqli_connect("$hotsbd","$usuariobd","$clavebd","$basededatos", $port)
    //or die ("Conexión denegada, el Servidor de Base de datos que solicitas no puede ser localizado"); 
    //$db = mysqli_select_db($conexion_bd,"$basededatos")
    //or die ("La Base de Datos <b>$basededatos</b> no puede ser localizada");
