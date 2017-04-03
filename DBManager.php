<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBManager
 *
 * @author jparedes
 */

/*Permite dividir un string en varios substrings con delimitadores múltiples*/
function multiexplode ($delimiters, $string) {
    
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

/*Clase de conexión a BD*/
class DBManager {
    function getConnection(){

    $services = getenv("VCAP_SERVICES");
    $services_json = json_decode($services,true);
    
    /*==============Obtener credenciales de servicio ClearDB==================*/
    
    //$mysql_config = $services_json["cleardb"][0]["credentials"];
    //$db = $mysql_config["name"];
    //$host = $mysql_config["hostname"];
    //$port = $mysql_config["port"];
    //$username = $mysql_config["username"];
    //$password = $mysql_config["password"];

    //$conn = mysqli_connect($host, $username, $password, $db, $port);
    
    //if(! $conn ){
      //die('No se puede conectar a BD: ' . mysqli_error($conn));
    //}
    
    /*========================================================================*/
    
    /*==============Obtener credenciales de servicio Elephant=================*/
    
    $pgsql_config = $services_json["elephantsql"][0]["credentials"];
    
    //Formato URI en credenciales: "postgres://user:password@host:port/dbname"
    $pg_credenciales = multiexplode(array(":","@","/"), substr($pgsql_config["uri"], 11));
    
    $user = $pg_credenciales[0];
    $password = $pg_credenciales[1];
    $host = $pg_credenciales[2];
    $port = $pg_credenciales[3];
    $dbname = $pg_credenciales[4];
    
    $dbConnectionString = "host=" . $host . " port=" . $port . " dbname=" . $dbname . " user=" . $user . " password=" . $password;
    
    $conn = pg_connect($dbConnectionString);
  
    if(! $conn ){
      die('No se puede conectar a BD: ' . pg_errormessage($conn));
    }
    
    /*========================================================================*/
    
    return $conn;
  }
}
