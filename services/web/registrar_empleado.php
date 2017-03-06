<?php

$json = json_decode($_POST['json'],true);
$rif = $_POST['rif'];
$cedula = filter_var($_POST['cedula'], FILTER_SANITIZE_NUMBER_INT);
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$sexo = $_POST['sexo'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$latitud_emp = $_POST['latitud_emp'];
$longitud_emp = $_POST['longitud_emp'];

if($rif!='' && $cedula!='Cédula' && $nombre!='Nombre' && $correo!='Correo'){
    include ('conexion.php');
    $sql = "SELECT * FROM cliente WHERE cedula='$cedula'";
    $consulta = mysqli_query($conexion_bd, $sql);
        if(mysqli_num_rows($consulta)==0){
            $sql = "INSERT INTO cliente (cedula,rif_empresa,nombre,apellido,sexo,direccion,correo,telefono,latitud,longitud) "
                 . "VALUES ('$cedula','$rif','".utf8_decode($nombre)."','".utf8_decode($apellido)."','$sexo','$direccion','$correo','$telefono','$latitud','$longitud')";
            mysqli_query($conexion_bd, $sql);
            foreach ($json as $j){
                $tiempo = strtotime($j[2]);
                $hora_nueva = date('H:i:s', $tiempo);
                if ($j[0] == 'empresa' && $j[1] == 'parada'){
                    $sql1 = "INSERT INTO parada (lng_d,lat_d,lng_o,lat_o,hora,id_cliente) VALUES ('$longitud_emp','$latitud_emp','$longitud','$latitud','$hora_nueva','$cedula')";
                    mysqli_query($conexion_bd, $sql1);
                }elseif($j[0] == 'parada' && $j[1] == 'empresa'){
                    $sql2 = "INSERT INTO parada (lng_d,lat_d,lng_o,lat_o,hora,id_cliente) VALUES ('$longitud','$latitud','$longitud_emp','$latitud_emp','$hora_nueva','$cedula')";
                    mysqli_query($conexion_bd, $sql2);
                }
            }
            echo '<p>Empleado registrado exitosamente</p>';
        }else{
            echo 'El empleado ya ha sido registrado anteriormente';
        }
    mysqli_close($conexion_bd);
}else{
    echo 'Favor ingrese todos los datos';
}