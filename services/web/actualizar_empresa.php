<?php

$rif = $_POST['rif'];
$rifnuevo = $_POST['rifnuevo'];
$nombre = $_POST['nombre'];
$telefono = $_POST['tlf'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$latitud_vi = $_POST['latitud_vi'];
$longitud_vi = $_POST['longitud_vi'];

if(isset($_POST['estatus'])){
    $estatus = $_POST['estatus'];
}else{
    $estatus[0] = 1;
}

    if($rifnuevo!='Rif' && $rifnuevo!=''){
        require_once('conexion.php');
        $sql = "UPDATE empresa "
             . "SET rif='".$rifnuevo."', nombre='".$nombre."', telefono='".$telefono."', "
             . "correo='".$correo."', direccion='".$direccion."', latitud='".$latitud."', longitud='".$longitud."', estatus=$estatus[0] "
             . "WHERE rif='".$rif."'";
        mysqli_query($conexion_bd, $sql);
        $sql1 = "UPDATE parada SET lat_d='".$latitud."', lng_d='".$longitud."' WHERE lat_d='".$latitud_vi."' AND lng_d='".$longitud_vi."'";
        mysqli_query($conexion_bd, $sql1);
        $sql2 = "UPDATE parada SET lat_o='".$latitud."', lng_o='".$longitud."' WHERE lat_o='".$latitud_vi."' AND lng_o='".$longitud_vi."'";
        mysqli_query($conexion_bd, $sql2);
        mysqli_close($conexion_bd);
        echo '<p><strong>Se actualizó el rif '.$rifnuevo.'</strong><p>';
    }else{
        echo '<p>Rellene los campos requeridos<p>';
    }