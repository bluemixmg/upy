<?php

require_once './conexion.php';$con = new Conexion();
$id = $_POST['id'];
$tipo = $_POST['tipo'];
$user = $_POST['usuario'];
$rif = $_POST['rif'];

if($tipo==1){
    if($user!=''){
        $sql = "SELECT usuario FROM usuario WHERE usuario='$user'";
        $consulta = $con->consultar( $sql);
        if($con->num_filas($consulta)==0){
            $pass = md5($id);
            $sql = "INSERT INTO usuario (usuario,contrasena,id_rol,rif_empresa) VALUES ('$user','$pass',3,'$rif')";
            $con->consultar( $sql);
        
            $sql = "UPDATE chofer SET id_usuario='".$user."',estatus=1 WHERE id_cedula='$id'";
            $con->consultar( $sql);
            echo '</p>Conductor admitido, usuario creado con éxito</p>';
        }else{
            echo '</p>El usuario <strong>'.$user.'</strong> ya existe, favor ingrese otro.</p>';
        }
    }else{
        echo '<p><strong>Por favor, ingrese un nombre de usuario</strong></p>';
    }
}elseif($tipo==2){
    $sql = "UPDATE chofer SET estatus=3 WHERE id_cedula='$id'";
    $con->consultar( $sql);
    echo 'Conductor Rechazado';
}

$con->cerrar_conexion();