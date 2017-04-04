<?php

function buscar_emp($a){
    require('conexion.php');$con = new Conexion();
    $search = $a;
    $sql = "SELECT cedula,nombre FROM cliente "
            . "WHERE (cedula LIKE '%".$search."%' OR nombre LIKE '%".$search."%' OR apellido LIKE "
            . "'%".$search."%') AND rif_empresa='".$_GET['rif']."' ORDER BY nombre ASC";
    $consulta = $con->consultar($sql);
    while ($row = pg_fetch_array($consulta)) {
        $resultado[] = $row['nombre'];
    }
    return $resultado;
}

echo json_encode(buscar_emp($_GET['term']));