<?php

$cedula = filter_var($_POST['cedula'], FILTER_SANITIZE_NUMBER_INT);
$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
$apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
$sexo = filter_var($_POST['sexo'],FILTER_SANITIZE_SPECIAL_CHARS);
$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
$tlf = filter_var($_POST['tlf'], FILTER_SANITIZE_NUMBER_INT);
$usuario = $_POST['usuario'];
$direccion = $_POST['direccion'];
$placa = $_POST['placa'];
$modelo = $_POST['modelo'];
$marca = $_POST['marca'];
$tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_NUMBER_INT);
$cond = filter_var($_POST['cond'], FILTER_SANITIZE_NUMBER_INT);
$rif = $_POST['rif'];

if($cedula!='Cédula' && $nombre!='Nombre' && $apellido!='Apellido' && $correo!='Correo' && $tlf!='Teléfono' && $placa!='Placa' && $usuario!='Usuario'){
    
    require_once './conexion.php';
    
    $sql = "SELECT id_cedula FROM chofer WHERE id_cedula='$cedula'";
    $consulta_chofer = mysqli_query($conexion_bd, $sql);
    if(mysqli_num_rows($consulta_chofer)==0){
        $sql = "SELECT placa FROM vehiculo WHERE placa='$placa'";
        $consulta_placa = mysqli_query($conexion_bd, $sql);
        if(mysqli_num_rows($consulta_placa)==0){
            $sql = "INSERT INTO chofer (id_cedula,nombre,apellido,sexo,correo,direccion,telefono,id_usuario,estatus) VALUES ('$cedula','$nombre','$apellido','$sexo','$correo','$direccion','$tlf','$usuario','1')";
            mysqli_query($conexion_bd, $sql);
            
            $sql1 = "INSERT INTO vehiculo (placa,marca,modelo,id_tipo_vehiculo,id_condicion,id_chofer) VALUES ('$placa','$marca','$modelo','$tipo','$cond','$cedula')";
            mysqli_query($conexion_bd, $sql1);
            
            $pass = md5($cedula);
            $sql2 = "INSERT INTO usuario (usuario,contrasena,id_rol,rif_empresa) VALUES ('$usuario','$pass',3,'$rif')";
            mysqli_query($conexion_bd, $sql2);
            echo '<p>Chofer registrado con éxito</p>';
        }else{
            echo '<p>La placa ingresada ya se encuentra registrada</p>';
        }
    }else{
        echo '<p>El ID de chofer ya se encuentra registrado</p>';
    }
    mysqli_close($conexion_bd);
}else{
    echo '<p>Favor, debe llenar todos los datos</p>';
}