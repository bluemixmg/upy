<?php
header('Content-Type: application/json');

require ('conexion.php'); //Archivo para conectar a la base de datos

//Comprobamos que se han pasado parámetros por POST
if(isset($_POST['id_u']) && isset($_POST['fecha'])){
$id_u = $_POST['id_u'];
$fecha = md5($_POST['fecha']);
}else{
    $id_u = "";
    $fecha = "";
}
$respuestaJson = array();
//Definimos la funcion de busqueda del usuario
function mostrar($conexion_bd,$id_u,$fecha,$respuestaJson){

    if($id_u!="" && $fecha!=""){
    $sql = "SELECT * FROM disponibilidad WHERE id_usuario='$id_u' AND fecha='$fecha'";
    $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
        if(pg_num_rows($consulta)>0){
            $respuestaJson['success'] = 1;
            $respuestaJson['message'] = "EXITO";
        }else{
            $respuestaJson["success"] = 0;
            $respuestaJson["message"] = "Disponibidad no asignada";
        }
    }else{
        $respuestaJson["success"] = 0;
	$respuestaJson["message"] = "Faltan Datos";
    }
    return $respuestaJson;
}

//Enviamos el resultado de la funcion "mostrar" a codificarse de tipo JSON
echo json_encode(mostrar($conexion_bd, $id_u, $fecha, $respuestaJson));
//echo json_encode(mostrar($conexion_db,$id,$pass));
pg_close($conexion_bd); //Cerramos la conexion a la base de datos