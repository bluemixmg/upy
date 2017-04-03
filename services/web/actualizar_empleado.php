<?php
$cedula = $_POST['cedula'];
$cednueva = $_POST['cednueva'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$sexo = $_POST['sexo'];
$telefono = $_POST['tlf'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$latitud_emp = $_POST['latitud_emp'];
$longitud_emp = $_POST['longitud_emp'];
$paradas = json_decode($_POST['JSON'],TRUE);

if(isset($_POST['estatus'])){
    $estatus = $_POST['estatus'];
}else{
    $estatus[0] = 1;
}

if($cednueva!='Cédula' && $cednueva!='' && $nombre!='Nombre' && $apellido!='Apellido'){
    require_once('conexion.php');
    $sql = "UPDATE cliente "
         . "SET cedula='".$cednueva."', nombre='".utf8_decode($nombre)."', apellido='".utf8_decode($apellido)."', telefono='".$telefono."', correo='".$correo."', "
         . "sexo='".$sexo."',direccion='".$direccion."', latitud='".$latitud."', longitud='".$longitud."', estatus='".$estatus[0]."'"
         . "WHERE cedula='".$cedula."'";
        pg_query($conexion_bd, $sql);
    $sql = "DELETE FROM parada WHERE id_cliente='$cedula'";
    pg_query($conexion_bd, $sql);
    foreach ($paradas as $p){
        $tiempo = strtotime($p[2]);
        $hora_nueva = date('H:i:s', $tiempo);
        if(isset($p[3])){
            if($p[3]!=''){
                if ($p[0] == 'empresa' && $p[1] == 'parada'){
                    $sql = "INSERT INTO parada (id,lng_o,lat_o,lng_d,lat_d,hora,id_cliente) VALUES ('$p[3]','$longitud_emp','$latitud_emp','$longitud','$latitud','$hora_nueva','$cedula')";
                }elseif($p[0] == 'parada' && $p[1] == 'empresa'){
                    $sql = "INSERT INTO parada (id,lng_o,lat_o,lng_d,lat_d,hora,id_cliente) VALUES ('$p[3]','$longitud','$latitud','$longitud_emp','$latitud_emp','$hora_nueva','$cedula')";
                }
            }else{
                if ($p[0] == 'empresa' && $p[1] == 'parada'){
                    $sql = "INSERT INTO parada (lng_o,lat_o,lng_d,lat_d,hora,id_cliente) VALUES ('$longitud_emp','$latitud_emp','$longitud','$latitud','$hora_nueva','$cedula')";
                }elseif($p[0] == 'parada' && $p[1] == 'empresa'){
                    $sql = "INSERT INTO parada (lng_o,lat_o,lng_d,lat_d,hora,id_cliente) VALUES ('$longitud','$latitud','$longitud_emp','$latitud_emp','$hora_nueva','$cedula')";
                }
            }
        }
        pg_query($conexion_bd, $sql);
    }
    pg_close($conexion_bd);
    echo '<p>Se actualizó el empleado de cédula '.$cednueva.'<p> y nombre '.$nombre.' '.$apellido;
}else{
    echo '<p>Rellene los campos requeridos<p>';
}