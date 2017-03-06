<?php
header('Content-Type: application/json');

require_once './conexion.php';

$id = $_POST['id'];
$respuestaJson = array();

function mostrar($conexion_bd,$id,$respuestaJson){
    if($id!=''){
        $sql = "SELECT cliente.nombre,cliente.apellido,ruta.aceptacion,parada_ruta.estatus,parada_ruta.id_ruta,parada_ruta.id_parada,parada.id_cliente,parada.lat_o,parada.lng_o,parada.lat_d,parada.lng_d "
             . "FROM parada_ruta INNER JOIN parada ON parada_ruta.id_parada=parada.id "
             . "INNER JOIN cliente ON parada.id_cliente=cliente.cedula "
             . "INNER JOIN ruta ON parada_ruta.id_ruta=ruta.id "
             . "WHERE parada_ruta.id_ruta='$id'";
        $consulta = mysqli_query($conexion_bd, $sql);
        if(mysqli_num_rows($consulta)>0){
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
                $aceptado = $c['aceptacion'];
            }
            // parada empresa
            $sql2 = "SELECT empresa.nombre,parada_ruta.estatus,parada_ruta.id_ruta,parada_ruta.id_parada,parada.id_cliente,parada.lat_o,parada.lng_o,parada.lat_d,parada.lng_d "
             . "FROM parada_ruta INNER JOIN parada ON parada_ruta.id_parada=parada.id "
             . "INNER JOIN empresa ON parada.id_cliente=empresa.rif "
             . "WHERE parada_ruta.id_ruta='$id'";
            $consulta2 = mysqli_query($conexion_bd, $sql2);
            foreach ($consulta2 as $c){
                $d2 = $c['id_cliente'];
                $s2 = $c['estatus'];
                $ids2 = $c['id_parada'];
                $n2 = $c['nombre'];
                $o2 = new stdClass();
                $o2->lat_o = $c['lat_o'];
                $o2->lng_o = $c['lng_o'];
                $o2->lat_d = $c['lat_d'];
                $o2->lng_d = $c['lng_d'];
                $p2 = $o2;
            }
            array_push($d, $d2);
            array_push($s, $s2);
            array_push($n, $n2);
            array_push($p, $p2);
            array_push($ids, $ids2);
            
            //Json
            $respuestaJson['cedulas'] = $d;
            $respuestaJson['estatus'] = $s;
            $respuestaJson['nombres'] = $n;
            $respuestaJson['paradas'] = $p;
            $respuestaJson['ids_parada'] = $ids;
            $respuestaJson['aceptacion'] = $aceptado;
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
mysqli_close($conexion_bd); //Cerramos la conexion a la base de datos