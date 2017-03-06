<?php

$id = $_POST['id'];
if(isset($_POST['permisos'])){
    $permisos = $_POST['permisos'];
}else{
    $permisos[] = 0;
}

require_once './conexion.php';

$sql = "DELETE FROM permiso_rol WHERE id_rol='$id'";
//mysqli_query($conexion_bd, $sql);

foreach ($permisos as $p){
    $sql = "INSERT INTO permiso_rol (id_rol,id_permiso) VALUES ('$id','$p')";
//    mysqli_query($conexion_bd, $sql);
}

mysqli_close($conexion_bd);

echo '<p>Permisos Actualizados con Éxito</p>';