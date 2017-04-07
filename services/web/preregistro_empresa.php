<?php

$rif = $_POST['rif'];
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$tlf = $_POST['tlf'];
$correo = $_POST['correo'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$acept = $_POST['acep'];

if($acept!=''){
    if($rif!='ID Empresa' && $nombre!='Nombre' && $tlf!='Tel&eacute;fono' && $correo!='Correo'){
        require_once './conexion.php';$con = new Conexion();
        $sql = "SELECT * FROM empresa WHERE rif='".$rif."'";
        $consulta = $con->consultar( $sql);
        if($con->num_filas($consulta)==0){
            $sql = "INSERT INTO empresa (rif,nombre,direccion,latitud,longitud,correo,telefono,estatus) "
                 . "VALUES ('$rif','$nombre','$direccion','$latitud','$longitud','$correo','$tlf','0')";
         $con->consultar( $sql);
            echo 'Empresa registrada, espere ser contactado a la brevedad posible';
        }else{
            echo '<p>Esta empresa ha sido registrada anteriormente</p>';
        }
        $con->cerrar_conexion();
    }else{
        echo '<p>Favor, complete los datos</p>';
    }
}else{
    echo '<p>Debe aceptar nuestros términos y condiciones</p>';
}