<?php

$id = $_POST['id'];
$tipo = $_POST['tipo'];
if(isset($_POST['nombre'])){
    $nombre_ruta = $_POST['nombre'];
}else{
    $nombre_ruta = '';
}
if(isset($_POST['costo_ruta'])){
    $costo_ruta = $_POST['costo_ruta'];
}else{
    $costo_ruta = '';
}
if(isset($_POST['precio_ruta'])){
    $precio_ruta = $_POST['precio_ruta'];
}else{
    $precio_ruta = '';
}
if(isset($_POST['nro_puestos'])){
    $puestos = $_POST['nro_puestos'];
}else{
    $puestos = '';
}

require_once './conexion.php';

if($id=='' && $nombre_ruta!='' && $costo_ruta!='' && $precio_ruta!='' && $tipo==11){
    $sql = "INSERT INTO tipo_ruta (descripcion,costo,precio) VALUES ('$nombre_ruta','$costo_ruta','$precio_ruta')";
    pg_fetch_all(pg_query($conexion_bd, $sql));
    echo 'Tipo de Ruta Guardado con Exito';
}

if($id!='' && $nombre_ruta!='' && $costo_ruta!='' && $precio_ruta!='' && $tipo==11){
    $sql = "UPDATE tipo_ruta SET descripcion='$nombre_ruta',costo='$costo_ruta',precio='$precio_ruta' WHERE id='$id'";
    pg_fetch_all(pg_query($conexion_bd, $sql));
    echo 'Tipo de Ruta Actualizado con Exito';
}

if($id!='' && $tipo==12){
    $sql = "UPDATE tipo_ruta SET estatus=0 WHERE id='$id'";
    pg_fetch_all(pg_query($conexion_bd, $sql));
    echo 'Tipo de Ruta eliminado';
}

if($id=='' && $tipo==21){
    if($puestos!='' && $costo_ruta!='' && $precio_ruta!='' && $nombre_ruta!=''){
    $sql = "INSERT INTO tipo_vehiculo (nombre,nro_puestos,costo,precio) VALUES ('$nombre_ruta','$puestos','$costo_ruta','$precio_ruta')";
    pg_fetch_all(pg_query($conexion_bd, $sql));
    echo 'Tipo de Vehiculo Guardado con Exito';
    }else{
        echo 'Faltan datos';
    }
}

if($id!='' && $tipo==21){
    if($nombre_ruta!='' && $puestos!='' && $costo_ruta!='' && $precio_ruta!=''){
        $sql = "UPDATE tipo_vehiculo SET nombre='$nombre_ruta',nro_puestos='$puestos',costo='$costo_ruta',precio='$precio_ruta' WHERE id='$id'";
        pg_fetch_all(pg_query($conexion_bd, $sql));
        echo 'Tipo de Vehiculo Actualizado';
    }else{
        echo 'Faltan Datos';
    }
}

if($id!='' && $tipo==22){
    $sql = "UPDATE tipo_vehiculo SET estatus=0 WHERE id='$id'";
    pg_fetch_all(pg_query($conexion_bd, $sql));
    echo 'Tipo de Vehiculo eliminado';
}
pg_close($conexion_bd);