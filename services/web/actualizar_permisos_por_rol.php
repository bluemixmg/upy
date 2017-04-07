<?php

$id = $_POST['id'];
if(isset($_POST['permisos'])){
    $permisos = $_POST['permisos'];
}else{
    $permisos[] = 0;
}

require_once './conexion.php';$con = new Conexion();

$sql = "DELETE FROM permiso_rol WHERE id_rol=$id";
//$con->consultar( $sql);

foreach ($permisos as $p){
    $sql = "INSERT INTO permiso_rol (id_rol,id_permiso) VALUES ($id,$p)";
//    $con->consultar( $sql);
}

$con->cerrar_conexion();

echo '<p>Permisos Actualizados con Éxito</p>';