<?php

require_once './conexion.php';

//Comprobamos que se han pasado parámetros por POST
if(isset($_POST['id']) && isset($_POST['latitud']) && isset($_POST['latitud'])){
$id = $_POST['id'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
}else{
    $id = "";
    $latitud = "";
    $longitud = "";
}
$respuestaJson = array();

function actualizar($conexion_bd,$id,$latitud,$longitud){

    if($id!="" && $latitud!="" && $longitud!=""){
        $sql = "UPDATE chofer SET latitud='$latitud', longitud='$longitud' WHERE id_usuario='$id'";
        mysqli_query($conexion_bd, $sql);
        $respuestaJson['success'] = 1;
    }
    return $respuestaJson;
}

echo json_encode(actualizar($conexion_bd,$id,$latitud,$longitud));
mysqli_close($conexion_bd); //Cerramos la conexion a la base de datos