<?php

function buscar($a){
    require('conexion.php');
    $search = $a;
    $sql = "SELECT id_cedula,nombre FROM chofer WHERE id_cedula LIKE '%".$search."%' OR nombre LIKE '%".$search."%' OR apellido LIKE '%".$search."%'";
    $consulta = mysqli_query($conexion_bd,$sql);
    while ($row = mysqli_fetch_array($consulta)) {
        $resultado[] = utf8_encode($row['id_cedula']).' '.utf8_encode($row['nombre']);
    }
    return $resultado;
}

echo json_encode(buscar($_GET['term']));