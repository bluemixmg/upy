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
            pg_query($conexion_bd, $sql);
            
            $sql = "UPDATE chofer SET estatus = 1 WHERE id_usuario='$id_u' estatus != '0' AND estatus != '3'";
            pg_query($conexion_bd, $sql);
            $respuestaJson['success'] = 1;
        }
        
        ////// buscar rutas sin chofer asignado y asignarlas
        // placa, cantidad max de puestos y estado del chofer
        $sql_p = "SELECT vehiculo.placa, tipo_vehiculo.nro_puestos, chofer.id_estado FROM chofer INNER JOIN vehiculo ON chofer.id_cedula = vehiculo.id_chofer INNER JOIN tipo_vehiculo ON vehiculo.id_tipo_vehiculo = tipo_vehiculo.id WHERE chofer.id_usuario='$id_u' AND chofer.estatus = '1'";
        $consulta_p = pg_query($conexion_bd, $sql_p);
        if(pg_num_rows($consulta_p)>0){
            foreach ($consulta_p as $cp){
                $placa = $cp['placa'];
                $puestos = $cp['nro_puestos'];
                $edo_chofer = $cp['id_estado'];
            }
            // buscar el rango de horas de la disponibilidad del chofer
            $sql_d = "SELECT bloque.hora_inicio, bloque.hora_fin FROM disponibilidad INNER JOIN bloque ON disponibilidad.id_bloque = bloque.id WHERE disponibilidad.id_usuario='$id_u' AND disponibilidad.fecha = '$fecha'";
            $consulta_d = pg_query($conexion_bd, $sql_d);
            if(pg_num_rows($consulta_d)>0){
                foreach ($consulta_d as $cd){
                    $h_inicio = $cd['hora_inicio'];
                    $h_fin = $cd['hora_fin'];
                    // nro de paradas de la ruta, hora e id de rutas no asignadas y que estan en el rango de horas
                    $sql_r = "SELECT ruta.id, parada.hora FROM ruta INNER JOIN parada_ruta ON ruta.id = parada_ruta.id_ruta INNER JOIN parada ON parada.id = parada_ruta.id_parada INNER JOIN cliente ON cliente.cedula = parada.id_cliente INNER JOIN empresa ON empresa.rif = cliente.rif_empresa WHERE (parada.hora BETWEEN '$h_inicio' AND '$h_fin') AND ruta.fecha = '$fecha' AND ruta.id_vehiculo='' AND empresa.id_estado = '$edo_chofer' ORDER BY parada.hora ASC";
                    $consulta_r = pg_query($conexion_bd, $sql_r);
                    if(pg_num_rows($consulta_r)>0){
                        foreach ($consulta_r as $cr){
                            $ruta = $cr['id'];
                            $hora = $cr['hora'];
                            // contar las paradas de esa ruta
                            $sql_p_r_total = "SELECT COUNT(parada_ruta.id) as n FROM ruta INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id WHERE ruta.id = '$ruta' ";
                            $consulta_p_r_total = pg_query($conexion_bd, $sql_p_r_total);
                            foreach ($consulta_p_r_total as $cprt){
                                $p_r = $cprt['n'] - 1;
                            }
                            
                            $time = strtotime($hora);
                            $ini_Time = date("H:i:s", strtotime('-30 minutes', $time));
                            // buscar si el chofer esta ocupado en esa hora de la ruta
                            $sql_co = "SELECT ruta.id FROM ruta INNER JOIN parada_ruta ON ruta.id = parada_ruta.id_ruta INNER JOIN parada ON parada.id = parada_ruta.id_parada WHERE (parada.hora BETWEEN '$ini_Time' AND '$hora') AND ruta.id_vehiculo = '$placa' ";
                            $consulta_co = pg_query($conexion_bd, $sql_co);

                            if(pg_num_rows($consulta_co) == 0){
                                if ( $p_r <= $puestos){
                                     /// Actualizo placa en ruta (asigno chofer)
                                    $sql_final = "UPDATE ruta SET id_vehiculo = '$placa' WHERE id = '$ruta'";
                                    pg_query($conexion_bd,$sql_final);
                                }
                            }
                        }
                    }
                }
            }
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