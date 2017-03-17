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
    $mysql_config = $services_json["cleardb"][0]["credentials"];

    $db = $mysql_config["name"];
    $host = $mysql_config["hostname"];
    $port = $mysql_config["port"];
    $username = $mysql_config["username"];
    $password = $mysql_config["password"];

    $conn = mysql_connect($host . ':' . $port, $username, $password);
  
    if(! $conn ){
      die('Could not connect: ' . mysql_error());
    }

    mysql_select_db($db);
    return $conn;
  }
}
