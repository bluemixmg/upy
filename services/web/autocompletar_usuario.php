<?php

function buscar($a){
    require('conexion.php');
    $search = $a;
    $sql = "SELECT * FROM usuario WHERE usuario LIKE '%".$search."%' AND id_rol != 1";
    $consulta = pg_query($conexion_bd,$sql);
    while ($row = pg_fetch_array($consulta)) {
        $resultado[] = $row['usuario'];
    }
    return $resultado;
}

echo json_encode(buscar($_GET['term']));