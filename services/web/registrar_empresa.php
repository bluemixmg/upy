<?php

    $rif = $_POST['rif'];
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_MAGIC_QUOTES);
    $direccion = $_POST['direccion'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    //$estado = $_POST['estado'];
    
if($rif!='Rif' && $nombre!='Nombre' && $correo!='Correo'){
    require_once('conexion.php');
    $con = new Conexion();
    $sql = "SELECT * FROM empresa WHERE rif='$rif'";
    $consulta = $con->consultar( $sql);
        if($con->num_filas($consulta)==0){
            $sql = "INSERT INTO empresa (rif,nombre,id_estado,direccion,latitud,longitud,correo,telefono) "
                 . "VALUES ('$rif','$nombre','1','$direccion','$latitud','$longitud','$correo','$telefono')";
            $con->consultar( $sql);
            $pass = md5($rif);
            $sql = "INSERT INTO usuario (usuario,contrasena,id_rol,rif_empresa) VALUES('$correo','$pass',2,'$rif')";
            $con->consultar( $sql);
            $sql12 = "INSERT INTO parada (lat_o,lng_o,lat_d,lng_d,id_cliente,hora) VALUES "
                 . "('$latitud','$longitud','$latitud','$longitud','$rif',NULL)";
            $con->consultar( $sql12);
            $con->cerrar_conexion();
            echo 'Empresa registrada con éxito';
        }else{
            echo '<strong>Ya existe una empresa con ese número de registro</strong>';
        }
}else{
    echo 'Complete los datos';
}