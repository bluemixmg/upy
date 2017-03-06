<?php

function buscar($a){
    require('conexion.php');
    $search = $a;
    $sql = "SELECT nombre FROM empresa WHERE rif LIKE '%".$search."%' OR nombre LIKE '%".$search."%' AND rif!='V-19850475-7'";
    $consulta = mysqli_query($conexion_bd,$sql);
    while ($row = mysqli_fetch_array($consulta)) {
        $resultado[] = $row['nombre'];
    }
    return $resultado;
}

echo json_encode(buscar($_GET['term']));