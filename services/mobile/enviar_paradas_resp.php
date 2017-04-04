<?php
header('Content-Type: application/json');

require_once './conexion.php';$con = new Conexion();

$id = $_POST['id'];
$respuestaJson = array();

function mostrar($conexion_bd,$id,$respuestaJson){
    if($id!=''){
        $sql = "SELECT cliente.nombre,cliente.apellido,parada_ruta.estatus,parada_ruta.id_ruta,parada_ruta.id_parada,parada.id_cliente,parada.lat_o,parada.lng_o,parada.lat_d,parada.lng_d "
             . "FROM parada_ruta INNER JOIN parada ON parada_ruta.id_parada=parada.id "
             . "INNER JOIN cliente ON parada.id_cliente=cliente.cedula "
             . "WHERE parada_ruta.id_ruta='$id'";
        $consulta = $con->consultar( $sql);
        if($con->num_filas($consulta)>0){
            $respuestaJson['success'] = 1;
            foreach ($consulta as $c){
                $d[] = $c['id_cliente'];
                $s[] = $c['estatus'];
                $ids[] = $c['id_parada'];
                $n[] = $c['nombre']." ".$c['apellido'];
                $o = new stdClass();
                $o->lat_o = $c['lat_o'];
                $o->lng_o = $c['lng_o'];
                $o->lat_d = $c['lat_d'];
                $o->lng_d = $c['lng_d'];
                $p[] = $o;
            }
            $respuestaJson['cedulas'] = $d;
            $respuestaJson['estatus'] = $s;
            $respuestaJson['nombres'] = $n;
            $respuestaJson['paradas'] = $p;
            $respuestaJson['ids_parada'] = $ids;
        }else {
            $respuestaJson['success'] = 0;
            $respuestaJson['message'] = "No hay datos para mostrar";
        }
    }else{
        $respuestaJson['success'] = 0;
        $respuestaJson['message'] = "Fatan datos";
    }
    return $respuestaJson;
}

//Enviamos el resultado de la funcion "mostrar" a codificarse de tipo JSON
echo json_encode(mostrar($conexion_bd, $id,$respuestaJson));
//echo json_encode(mostrar($conexion_db,$id,$pass));
$con->cerrar_conexion(); //Cerramos la conexion a la base de datos