<?php

require_once './conexion.php';
$id = $_POST['id'];
$tipo = $_POST['tipo'];

if($tipo==1){
    $sql = "SELECT rif,correo FROM empresa WHERE rif='$id'";
    $consulta = mysqli_query($conexion_bd, $sql);
    foreach ($consulta as $c){
        $pass = md5($c['rif']);
        $user = $c['correo'];
        $sql = "INSERT INTO usuario (usuario,contrasena,id_rol,rif_empresa) "
             . "VALUES ('$user','$pass','2','$user')";
        mysqli_query($conexion_bd, $sql);
        $sql = "UPDATE empresa SET estatus=1 WHERE rif='".$c['rif']."'";
        mysqli_query($conexion_bd, $sql);
    }
    echo '</p>Empresa Admitida, usuario creado</p>';
}elseif($tipo==2){
    $sql = "UPDATE empresa SET estatus=3 WHERE rif='$id'";
    mysqli_query($conexion_bd, $sql);
    echo 'Empresa Rechazada';
}

mysqli_close($conexion_bd);