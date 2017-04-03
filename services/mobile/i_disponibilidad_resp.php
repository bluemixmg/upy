<?php
header('Content-Type: application/json');

require ('conexion.php'); //Archivo para conectar a la base de datos

//Comprobamos que se han pasado parámetros por POST
if(isset($_POST['id_usuario']) && isset($_POST['id_bloque']) && isset($_POST['fecha'])){
    $id_u = $_POST['id_usuario'];
    $id_bloque = json_decode($_POST['id_bloque'], true);
    $fecha = $_POST['fecha'];
}else{
    $id_u = "";
    $id_bloque = "";
    $fecha = "";
}

$respuestaJson = array();
//Definimos la funcion de busqueda del usuario
function mostrar($conexion_bd,$id_u,$id_bloque,$fecha,$respuestaJson){

    if($id_u!="" && $fecha!=""){
        foreach ($id_bloque['id_bloq'] as $i){
            $sql = "INSERT INTO disponibilidad (id_usuario,id_bloque,fecha) VALUES ('$id_u','".$i['id_b']."','$fecha')";
            pg_fetch_all(pg_query($conexion_bd, $sql));
            $respuestaJson['success'] = 1;
        }
    }else{
        $respuestaJson["success"] = 0;
    }
    return $respuestaJson;
}

//Enviamos el resultado de la funcion "mostrar" a codificarse de tipo JSON
echo json_encode(mostrar($conexion_bd, $id_u, $id_bloque, $fecha,$respuestaJson));
//echo json_encode(mostrar($conexion_db,$id,$pass));
pg_close($conexion_bd); //Cerramos la conexion a la base de datos