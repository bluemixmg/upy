<?php
header('Content-Type: application/json');

require_once './conexion.php';

$id = $_POST['id'];
$fecha = $_POST['fecha'];
$estatus = $_POST['estatus'];
$respuestaJson = array();

function mostrar($conexion_bd,$id,$fecha,$estatus,$respuestaJson){
    if($id!='' && $fecha!='' && $estatus!=''){
        $sql = "SELECT DISTINCT DATE_FORMAT(parada.hora,'%h:%i %p') AS hor,ruta.id,ruta.estatus,empresa.nombre FROM chofer "
            . "INNER JOIN vehiculo ON chofer.id_cedula=vehiculo.id_chofer "
            . "INNER JOIN ruta ON vehiculo.placa=ruta.id_vehiculo "
            . "INNER JOIN parada_ruta ON ruta.id=parada_ruta.id_ruta "
            . "INNER JOIN parada ON parada_ruta.id_parada=parada.id "
            . "INNER JOIN cliente ON parada.id_cliente=cliente.cedula "
            . "INNER JOIN empresa ON cliente.rif_empresa=empresa.rif "
            . "WHERE ruta.fecha='$fecha' ";
        if($estatus==0 || $estatus==2){
            $sql.= "AND (ruta.estatus='0' OR ruta.estatus='2') AND chofer.id_usuario='$id' ORDER BY parada.hora ASC";
        }elseif($estatus==1){
            $sql.= "AND ruta.estatus='1' AND chofer.id_usuario='$id' ORDER BY parada.hora ASC";
        }
        $consulta = mysqli_query($conexion_bd, $sql);
        if(mysqli_num_rows($consulta)>0){
            $respuestaJson['success'] = 1;
            foreach ($consulta as $c){
                $d[] = $c['id'].' - '.$c['nombre'].' - '.$c['hor'];
            }
            $respuestaJson['data'] = $d;
        }else {
            $respuestaJson['success'] = 0;
            $respuestaJson['message'] = "No hay datos para mostrar en la fecha seleccionada";
        }
    }else{
        $respuestaJson['success'] = 0;
        $respuestaJson['message'] = "Fatan datos";
    }
    return $respuestaJson;
}

//Enviamos el resultado de la funcion "mostrar" a codificarse de tipo JSON
echo json_encode(mostrar($conexion_bd, $id, $fecha, $estatus,$respuestaJson));
//echo json_encode(mostrar($conexion_db,$id,$pass));
mysqli_close($conexion_bd); //Cerramos la conexion a la base de datos