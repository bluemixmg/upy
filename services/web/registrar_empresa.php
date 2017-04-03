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
    $sql = "SELECT * FROM empresa WHERE rif='$rif'";
    $consulta = pg_query($conexion_bd, $sql);
        if(pg_num_rows($consulta)==0){
            $sql = "INSERT INTO empresa (rif,nombre,id_estado,direccion,latitud,longitud,correo,telefono) "
                 . "VALUES ('$rif','$nombre','1','$direccion','$latitud','$longitud','$correo','$telefono')";
            pg_query($conexion_bd, $sql);
            $pass = md5($rif);
            $sql = "INSERT INTO usuario (usuario,contrasena,id_rol,rif_empresa) VALUES('$correo','$pass',2,'$rif')";
            pg_query($conexion_bd, $sql);
            $sql12 = "INSERT INTO parada (lat_o,lng_o,lat_d,lng_d,id_cliente,hora) VALUES "
                 . "('$latitud','$longitud','$latitud','$longitud','$rif','NULL')";
            pg_query($conexion_bd, $sql12);
            pg_close($conexion_bd);
            echo 'Empresa registrada con éxito';
        }else{
            echo '<strong>Ya existe una empresa con ese número de registro</strong>';
        }
}else{
    echo 'Complete los datos';
}