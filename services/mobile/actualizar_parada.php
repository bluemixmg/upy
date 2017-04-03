<?php
header('Content-Type: application/json');

require_once ('conexion.php'); //Archivo para conectar a la base de datos

//Comprobamos que se han pasado parámetros por POST
if(isset($_POST['id_parada']) && isset($_POST['id_ruta']) && isset($_POST['id_usuario'])){
$id_parada = $_POST['id_parada'];
$id_ruta = $_POST['id_ruta'];
$id_usuario = $_POST['id_usuario'];
}else{
    $id_parada = "";
    $id_ruta = "";
    $id_usuario = "";
}
$respuestaJson = array();

function actualizar($conexion_bd,$id_parada,$id_ruta,$id_usuario,$respuestaJson){

    if($id_parada!="" && $id_ruta!="" && $id_usuario!=""){
        $sql = "UPDATE parada_ruta SET estatus=0 WHERE id_ruta='$id_ruta' AND id_parada='$id_parada'";
        if(pg_query($conexion_bd, $sql)){
            $respuestaJson['success'] = 1;
            $respuestaJson['message'] = "Parada Cumplida";
            $sql1 = "SELECT DISTINCT estatus FROM parada_ruta WHERE id_ruta='$id_ruta'";
            $consulta = pg_query($conexion_bd, $sql1);
            if(pg_num_rows($consulta)==1){
                $sql = "UPDATE ruta SET estatus=1 WHERE id='$id_ruta'";
                pg_query($conexion_bd, $sql);
                $MY_API_KEY="AIzaSyClESwq7mvo76CoqqqkO1Lfef5UA_5xU1Y";
                $data = array(
                    "to" => "/topics/upy",
                    "time_to_life" => 172800,
                    "data" => array(
                        "title" => "Rutas",
                        "body" => "Sus rutas se han actualizado",
                        "icon" => "app",
                        "id_usuario" => $id_usuario
                        )
                );
                $header = array(
                    "Authorization: key=".$MY_API_KEY,
                    "Content-type: application/json"
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                $result = curl_exec($ch);
                curl_close($ch);
            }else{
                $sql = "UPDATE ruta SET estatus=2 WHERE id='$id_ruta'";
                pg_query($conexion_bd, $sql);
            }
        }else{
            $respuestaJson['success'] = 0;
            $respuestaJson['message'] = "Fallo en la conexion con el servidor";
        }
    }else{
        $respuestaJson["success"] = 0;
	$respuestaJson["message"] = "Faltan Datos";
    }
    return $respuestaJson;
}

//Enviamos el resultado de la funcion "mostrar" a codificarse de tipo JSON
echo json_encode(actualizar($conexion_bd, $id_parada, $id_ruta, $id_usuario, $respuestaJson));
pg_close($conexion_bd); //Cerramos la conexion a la base de datos