<?php
header('Content-Type: application/json');

require ('conexion.php');$con = new Conexion(); //Archivo para conectar a la base de datos

//Comprobamos que se han pasado parámetros por POST
if(isset($_POST['cedula_usuario']) && isset($_POST['rif_empresa'])){
$cedula_usuario = $_POST['cedula_usuario'];
$rif_empresa = $_POST['rif_empresa'];
$id_chofer = $_POST['id_chofer'];
}else{
    $cedula_usuario = "";
    $rif_empresa = "";
    $id_chofer = "";
}
$respuestaJson = array();
//Definimos la funcion de busqueda del usuario
function mostrar($conexion_bd,$cedula_usuario,$rif_empresa,$id_chofer,$respuestaJson){

    if($cedula_usuario!="" && $rif_empresa!=""){
        $sql = "SELECT cliente.nombre,empresa.nombre "
             . "FROM cliente INNER JOIN empresa ON cliente.rif_empresa=empresa.rif "
             . "WHERE cliente.cedula='$cedula_usuario' AND empresa.rif='$rif_empresa'";
        $consulta = $con->consultar( $sql);
        
        if($con->num_filas($consulta)>0){
            $respuestaJson['success'] = 1;
            $respuestaJson['message'] = "Pasajero Aceptado";

        }else{
            $respuestaJson['success'] = 2;
            $respuestaJson['message'] = "Cedula no registrada";
        }
        
        date_default_timezone_set("America/Caracas");
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $sql = "INSERT INTO incidencia (id_tipo_incidencia,id_usuario,fecha,hora,id_cliente) VALUES ('3','$id_chofer','$fecha','$hora','$cedula_usuario')";
        $con->consultar( $sql);
        
    }else{
        $respuestaJson["success"] = 0;
	$respuestaJson["message"] = "Faltan Datos";
    }
    return $respuestaJson;
}

//Enviamos el resultado de la funcion "mostrar" a codificarse de tipo JSON
echo json_encode(mostrar($conexion_bd, $cedula_usuario,$rif_empresa,$id_chofer,$respuestaJson));
$con->cerrar_conexion(); //Cerramos la conexion a la base de datos