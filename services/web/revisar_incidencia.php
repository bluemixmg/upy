<?php

$id = $_POST['id'];

if($id != NULL){
    require_once './conexion.php';
    $sql = "UPDATE incidencia SET revisado=1 WHERE id='".$id."'";
    mysqli_query($conexion_bd, $sql);
    mysqli_close($conexion_bd);
    echo '<strong>Incidencia Verificada</strong>';
}