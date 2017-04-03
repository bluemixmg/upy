<?php

$id = $_POST['id'];
if(isset($_POST['permisos'])){
    $permisos = $_POST['permisos'];
}else{
    $permisos[] = 0;
}

require_once './conexion.php';

$sql = "DELETE FROM permiso_rol WHERE id_rol=$id";
//pg_fetch_all(pg_query($conexion_bd, $sql));

foreach ($permisos as $p){
    $sql = "INSERT INTO permiso_rol (id_rol,id_permiso) VALUES ($id,$p)";
//    pg_fetch_all(pg_query($conexion_bd, $sql));
}

pg_close($conexion_bd);

echo '<p>Permisos Actualizados con Éxito</p>';