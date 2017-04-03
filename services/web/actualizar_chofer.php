<?php

$cedula = $_POST['cedula'];
$cednueva = filter_var($_POST['cednueva'], FILTER_SANITIZE_NUMBER_INT);
$nombre = utf8_decode($_POST['nombre']);
$apellido = utf8_decode($_POST['apellido']);
$sexo = $_POST['sexo'];
$telefono = $_POST['tlf'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$placa = $_POST['placa'];
$plava_v = $_POST['placa_vieja'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$tipo = $_POST['tipo_v'];
$cond = $_POST['cond'];
if(isset($_POST['estatus'])){
    $estatus = $_POST['estatus'];
}else{
    $estatus[0] = 1;
}

    if($cednueva!='Cédula' && $cednueva!='' && $nombre!='Nombre' && $placa!=''){
        require_once('conexion.php');
        $sql = "UPDATE chofer SET id_cedula='$cednueva', nombre='$nombre', apellido='$apellido',sexo='$sexo', "
             . "telefono='$telefono', correo='$correo', direccion='$direccion', estatus='$estatus[0]' "
             . "WHERE id_cedula='$cedula'";
        pg_query($conexion_bd, $sql);
        $sql = "UPDATE vehiculo SET placa='$placa', marca='$marca', modelo='$modelo', id_tipo_vehiculo='$tipo', "
             . "id_condicion='$cond',id_chofer='$cednueva' WHERE id_chofer='$cedula'";
        pg_query($conexion_bd, $sql);
        $sql = "UPDATE ruta SET id_vehiculo='$placa' WHERE id_vehiculo='$plava_v'";
        pg_query($conexion_bd, $sql);
        pg_close($conexion_bd);
        echo '<p>Se actualizó el chofer de cédula '.$cednueva.'<p> y nombre '.$nombre.' '.$apellido;
    }else{
        echo '<p>Rellene los campos requeridos<p>';
    }