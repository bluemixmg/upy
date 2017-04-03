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
class DBManager {
    function getConnection(){

    $services = getenv("VCAP_SERVICES");
    $services_json = json_decode($services,true);
    //$mysql_config = $services_json["cleardb"][0]["credentials"];
    $pgsql_config = $services_json["elephantsql"][0]["credentials"];

    //$db = $mysql_config["name"];
    $db = $pgsql_config["name"];
    //$host = $mysql_config["hostname"];
    $host = $pgsql_config["hostname"];
    //$port = $mysql_config["port"];
    $port = $pgsql_config["port"];
    //$username = $mysql_config["username"];
    $username = $pgsql_config["username"];
    //$password = $mysql_config["password"];
    $password = $pgsql_config["password"];

    //Solo para pgsql:
    $dbConnectionString = "host=" . $host . " port=" . $port . " dbname=" . $db . " user=" . $username . " password=" . $password;
    
    //$conn = mysqli_connect($host, $username, $password, $db, $port);
    $conn = pg_connect($dbConnectionString);
  
    if(! $conn ){
      die('No se puede conectar a BD: ' . pg_errormessage($conn));
    }

    //mysql_select_db($db);
    return $conn;
  }
}
