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
        require_once './conexion.php';
        $sql = "SELECT * FROM empresa WHERE rif='".$rif."'";
        $consulta = pg_query($conexion_bd, $sql);
        if(pg_num_rows($consulta)==0){
            $sql = "INSERT INTO empresa (rif,nombre,direccion,latitud,longitud,correo,telefono,estatus) "
                 . "VALUES ('$rif','$nombre','$direccion','$latitud','$longitud','$correo','$tlf','0')";
         pg_query($conexion_bd, $sql);
            echo 'Empresa registrada, espere ser contactado a la brevedad posible';
        }else{
            echo '<p>Esta empresa ha sido registrada anteriormente</p>';
        }
        pg_close($conexion_bd);
    }else{
        echo '<p>Favor, complete los datos</p>';
    }
}else{
    echo '<p>Debe aceptar nuestros términos y condiciones</p>';
}