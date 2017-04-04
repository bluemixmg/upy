<?php

$id = filter_var($_POST['rif'], FILTER_SANITIZE_NUMBER_INT);
$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
$apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
$sexo = $_POST['sexo'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$tlf = filter_var($_POST['tlf'], FILTER_SANITIZE_NUMBER_INT);
$placa = $_POST['placa'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$tipo_v = $_POST['tipo'];
$cond = filter_var($_POST['cond'], FILTER_SANITIZE_NUMBER_INT);
$acept = $_POST['acept'];

if($acept!=''){
    if($id!='' && $nombre!='Nombre' && $apellido!='Apellido' && $tlf!='' && $placa!='Placa' 
        && $marca!='Marca' && $modelo!='Modelo' && $correo!='Correo'){
        require_once './conexion.php';$con = new Conexion();
        
        $sql = "SELECT id_cedula FROM chofer WHERE id_cedula='".$id."'";
        $consulta = $con->consultar( $sql);
        
        if($con->num_filas($consulta)==0){
            $sql = "SELECT placa FROM vehiculo WHERE placa='".$placa."'";
            $consulta1 = $con->consultar( $sql);
            if($con->num_filas($consulta1)==0){
                $nombre1 = utf8_decode($nombre);
                $apellido1 = utf8_decode($apellido);
                $sql_chofer = "INSERT INTO chofer (id_cedula,nombre,apellido,sexo,correo,direccion,telefono,estatus) "
                     . "VALUES ('$id','$nombre1','$apellido1','$sexo','$correo','$direccion','$tlf','0')";
                $con->consultar( $sql_chofer);
                $sql1 = "INSERT INTO vehiculo (placa,marca,modelo,id_tipo_vehiculo,id_condicion,id_chofer) "
                      . "VALUES ('$placa','$marca','$modelo','$tipo_v','$cond','$id')";
                $con->consultar( $sql1);
                echo '<p>Registro exitoso, espere ser contactado</p>';
            }else{
                echo '<p>El número de placa ya se encuentra registrado</p>';
            }
        }else{
            echo '<p>El número de identificación ya se ha registrado anteriormente</p>';
        }
        $con->cerrar_conexion();
    }else{
        echo '<p>Favor ingrese todos los datos</p>';
    }
}else{
    echo '<p>Debes aceptar nuestros términos y condiciones</p>';
}