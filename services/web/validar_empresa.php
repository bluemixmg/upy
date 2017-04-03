<?php

require_once './conexion.php';
$id = $_POST['id'];
$tipo = $_POST['tipo'];

if($tipo==1){
    $sql = "SELECT rif,correo FROM empresa WHERE rif='$id'";
    $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
    foreach ($consulta as $c){
        $pass = md5($c['rif']);
        $user = $c['correo'];
        $sql = "INSERT INTO usuario (usuario,contrasena,id_rol,rif_empresa) "
             . "VALUES ('$user','$pass','2','$user')";
        pg_fetch_all(pg_query($conexion_bd, $sql));
        $sql = "UPDATE empresa SET estatus=1 WHERE rif='".$c['rif']."'";
        pg_fetch_all(pg_query($conexion_bd, $sql));
    }
    echo '</p>Empresa Admitida, usuario creado</p>';
}elseif($tipo==2){
    $sql = "UPDATE empresa SET estatus=3 WHERE rif='$id'";
    pg_fetch_all(pg_query($conexion_bd, $sql));
    echo 'Empresa Rechazada';
}

pg_close($conexion_bd);