<?php

require_once 'conexion.php';

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
    require('conexion.php');
    $con = new Conexion();
    if($id!="" && $latitud!="" && $longitud!=""){
        $sql = "UPDATE chofer SET latitud='$latitud', longitud='$longitud' WHERE id_usuario='$id'";
        $con->consultar( $sql);
        $respuestaJson['success'] = 1;
    }
    return $respuestaJson;
}
$con = new Conexion();
echo json_encode(actualizar($con->getConexion(),$id,$latitud,$longitud));
$con->cerrar_conexion(); //Cerramos la conexion a la base de datos