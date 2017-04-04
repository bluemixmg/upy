<?php

$id = $_POST['id'];

if($id != NULL){
    require_once './conexion.php';$con = new Conexion();
    $sql = "UPDATE incidencia SET revisado=1 WHERE id='".$id."'";
    $con->consultar( $sql);
    $con->cerrar_conexion();
    echo '<strong>Incidencia Verificada</strong>';
}