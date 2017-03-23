<?php

$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

require_once './conexion.php';

$sql = "SELECT id_permiso FROM permiso_rol WHERE id_rol=$id";
$consulta = mysqli_query($conexion_bd, $sql);

if(mysqli_num_rows($consulta)>0){
    foreach ($consulta as $c){
        $permisos[] = $c['id_permiso'];
    }
}else{
    $permisos[] = 0;
}

$sql = "SELECT * FROM permiso";
$consulta = mysqli_query($conexion_bd, $sql);
foreach ($consulta as $c){
    if(in_array($c['id'], $permisos)){
        echo '<label><input type="checkbox" id="lista_de_permisos'.$c['id'].'" value="'.$c['id'].'" checked>'.utf8_encode($c['nombre']).'</label><br>';
    }else{
        echo '<label><input type="checkbox" id="lista_de_permisos'.$c['id'].'" value="'.$c['id'].'">'.utf8_encode($c['nombre']).'</label><br>';
    }
}

echo '<input hidden id="id_rol_editado" value="'.$id.'">';
echo '<form class="contact-bottom text-center">';
echo '<input type="submit" onClick="actualizar_permisos_por_rol();return false;" value="Guardar Cambios">';
echo '<div id="resultado_actualizar_permisos"></div>';
echo '</form>';

mysqli_close($conexion_bd);