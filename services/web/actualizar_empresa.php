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
        require_once('conexion.php');$con = new Conexion();
        $sql = "UPDATE empresa "
             . "SET rif='".$rifnuevo."', nombre='".$nombre."', telefono='".$telefono."', "
             . "correo='".$correo."', direccion='".$direccion."', latitud='".$latitud."', longitud='".$longitud."', estatus=$estatus[0] "
             . "WHERE rif='".$rif."'";
        $con->consultar( $sql);
        $sql1 = "UPDATE parada SET lat_d='".$latitud."', lng_d='".$longitud."' WHERE lat_d='".$latitud_vi."' AND lng_d='".$longitud_vi."'";
        $con->consultar( $sql1);
        $sql2 = "UPDATE parada SET lat_o='".$latitud."', lng_o='".$longitud."' WHERE lat_o='".$latitud_vi."' AND lng_o='".$longitud_vi."'";
        $con->consultar( $sql2);
        $con->cerrar_conexion();
        echo '<p><strong>Se actualizó el rif '.$rifnuevo.'</strong><p>';
    }else{
        echo '<p>Rellene los campos requeridos<p>';
    }