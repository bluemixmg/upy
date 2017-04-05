<?php

function buscar($a){
    require('conexion.php');
    $con = new Conexion();
    $search = $a;
    $sql = "SELECT * FROM usuario WHERE usuario LIKE '%".$search."%' AND id_rol != 1";
    $consulta = $con->consultar($sql);
    //while ($row = pg_fetch_array($consulta)) {
    foreach($consulta as $row) {
        $resultado[] = $row['usuario'];
    }
    return $resultado;
}

echo json_encode(buscar($_GET['term']));