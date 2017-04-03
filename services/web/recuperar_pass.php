<?php

$correo = filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL);

if($correo!=''){
    include './conexion.php';
    $sql = "SELECT rif,nombre FROM empresa WHERE correo='$correo'";
    $consulta = pg_query($conexion_bd, $sql);
    pg_close($conexion_bd);

    $para = $correo;
    $titulo = 'Mensaje Automático de UPY';
    foreach ($consulta as $c){
        $mensaje = "Usuario ".$c['nombre']."\n\nEste es un mensaje automático de la plataforma UPY con información privada de su cuenta. "
                . "\n\nContraseña: ".$c['rif']."";
    }
    $cabeceras = 'From: \r\n';
    mail($para, $titulo, $mensaje, $cabeceras);
    
    echo '<p>Su contraseña ha sido enviada al correo especificado</p>';
}else{
    echo '<p>Ingrese un correo válido</p>';
}