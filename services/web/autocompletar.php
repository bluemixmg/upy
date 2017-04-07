<?php

function buscar($a){
    require('conexion.php');
    $con = new Conexion();
    $search = $a;
    $sql = "SELECT nombre FROM empresa WHERE rif LIKE '%".$search."%' OR nombre LIKE '%".$search."%' AND rif!='V-19850475-7'";
    $consulta = $con->consultar($sql);
    //while ($row = pg_fetch_array($consulta)) {
    foreach($consulta as $row) {
        $resultado[] = $row['nombre'];
    }
    return $resultado;
}

echo json_encode(buscar($_GET['term']));