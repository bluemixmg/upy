<?php
header('Content-Type: application/json');

require ('conexion.php'); //Archivo para conectar a la base de datos

//Comprobamos que se han pasado parámetros por POST
if(isset($_POST['ruta']) && isset($_POST['usuario']) && isset($_POST['resp'])){
$ruta = $_POST['ruta'];
$usuario = $_POST['usuario'];
$resp = $_POST['resp'];
}else{
    $ruta = "";
    $usuario = "";
    $resp = "";
}
$respuestaJson = array();
//Definimos la funcion de busqueda del usuario
function procesar($conexion_bd,$ruta,$usuario,$resp,$respuestaJson){
    $con = new Conexion();
    if($ruta!="" && $usuario!="" && $resp!=""){
        date_default_timezone_set("America/Caracas");
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
//        $sql = "INSERT INTO incidencia (id_tipo_incidencia,id_usuario,fecha,hora,id_cliente) VALUES ('$id_inc','$id','$fecha','$hora','$id_cliente')";
//        if($con->consultar( $sql)){
//        $respuestaJson['success'] = 1;
//        $respuestaJson['message'] = "Incidencia Notificada";
//        
        //// evaluar resp
        if ($resp == "0"){
            // ruta rechazada
            /// Borrar Chofer
            $sql_ruta_q = "UPDATE ruta SET id_vehiculo = '' WHERE id = '$ruta'";
            $con->consultar($sql_ruta_q);
                     
            ////// guardar rechazo de ruta
            // buscar placa del vehiculo del chofer que rechazo
            $placa = "";
            $sql_p = "SELECT vehiculo.placa FROM chofer INNER JOIN vehiculo ON chofer.id_cedula = vehiculo.id_chofer WHERE chofer.id_usuario='$usuario'";
            $consulta_p = $con->consultar( $sql_p);
            if($con->num_filas($consulta_p)>0){
                foreach ($consulta_p as $cp){
                    $placa = $cp['placa'];
                }
                // insertar rechazo
                $sql_rr = "INSERT INTO ruta_rechazada (id_ruta, id_placa, fecha, hora) VALUES ('$ruta','$placa','$fecha','$hora')";
                $con->consultar( $sql_rr);
                
                $sql_crr = "SELECT id_placa FROM ruta_rechazada WHERE id_ruta='$ruta'";
                $consulta_r = $con->consultar( $sql_crr);
                if($con->num_filas($consulta_r)>0){
                    foreach ($consulta_r as $cr){
                        $choferes[] = $cr['id_placa'];
                    }    
                }
                
                //contar paradas originales menos la de la empresa
                $sql_p_r_total = "SELECT COUNT(parada_ruta.id) as n, parada.hora, ruta.fecha, empresa.id_estado FROM ruta INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id INNER JOIN parada ON parada.id = parada_ruta.id_parada INNER JOIN cliente ON cliente.cedula = parada.id_cliente INNER JOIN empresa ON empresa.rif = cliente.rif_empresa WHERE ruta.id = '$ruta' ";
                $consulta_p_r_total = $con->consultar( $sql_p_r_total);
                foreach ($consulta_p_r_total as $cprt){
                    $nro = $cprt['n'];
                    $hora_ruta = $cprt['hora'];
                    $fecha_ruta = $cprt['fecha'];
                    $edo_empre = $cprt['id_estado'];
                }

                // asignar chofer
                AsignarChofer($nro, $hora_ruta, $ruta, $fecha_ruta, $choferes, $edo_empre);
                $respuestaJson['success'] = 1;
                $respuestaJson['message'] = "Ruta Reasignada";
            }  
        }elseif ($resp == "1") {
            // aceptar ruta
            $sql_ruta = "UPDATE ruta SET aceptacion = '1' WHERE id = '$ruta'";
            if($con->consultar($sql_ruta)){
                $respuestaJson['success'] = 1;
                $respuestaJson['message'] = "Ruta Aceptada";
            }
        }// fin de resp
    }else{
        $respuestaJson["success"] = 0;
	$respuestaJson["message"] = "Faltan Datos";
    }
    return $respuestaJson;
}


function AsignarChofer($n, $hora, $ruta, $f, $choferes, $estado){
        $con = new Conexion();
        $sql_c = "SELECT vehiculo.placa FROM vehiculo INNER JOIN chofer ON vehiculo.id_chofer = chofer.id_cedula INNER JOIN tipo_vehiculo ON vehiculo.id_tipo_vehiculo = tipo_vehiculo.id INNER JOIN disponibilidad ON chofer.id_usuario = disponibilidad.id_usuario INNER JOIN bloque ON disponibilidad.id_bloque = bloque.id WHERE tipo_vehiculo.nro_puestos >= '$n' AND disponibilidad.fecha = '$f' AND ('$hora' BETWEEN bloque.hora_inicio AND bloque.hora_fin) AND chofer.estatus != '0' AND chofer.estatus != '3' AND chofer.id_estado ='$estado' ";
        $consulta_c = $con->consultar( $sql_c);
        
        $r = 100000;
        $placa = "";
        foreach ($consulta_c as $c){
            
            $time = strtotime($hora);
            $ini_Time = date("H:i:s", strtotime('-30 minutes', $time));
            
            $sql_co = "SELECT DISTINCT vehiculo.placa, vehiculo.id_chofer FROM vehiculo INNER JOIN chofer ON vehiculo.id_chofer = chofer.id_cedula INNER JOIN ruta ON ruta.id_vehiculo = vehiculo.placa INNER JOIN parada_ruta ON ruta.id = parada_ruta.id_ruta INNER JOIN parada ON parada.id = parada_ruta.id_parada WHERE ruta.fecha = '$f' AND (parada.hora BETWEEN '$ini_Time' AND '$hora') AND ruta.id_vehiculo = '".$c['placa']."'";
            $consulta_co = $con->consultar( $sql_co);
            
            if($con->num_filas($consulta_co) == 0){
                $placa_f = $c['placa'];
            }else{
                $placa_f = "";
            }
            if (!empty($placa_f)){
            
                $sql_cr = "SELECT COUNT(ruta.id_vehiculo) as nro_r, vehiculo.placa FROM ruta INNER JOIN vehiculo ON ruta.id_vehiculo = vehiculo.placa WHERE ruta.fecha = '$f' AND vehiculo.placa = '$placa_f' ";
                $consulta_cr = $con->consultar( $sql_cr);
                foreach ($consulta_cr as $cr){
                    if($cr['nro_r'] < $r){
                        $ex = 0;
                        foreach ($choferes as $cho){
                            if($cr['placa'] == $cho){
                                $ex = 1;
                            }
                        }
                        if($ex == '0'){
                            $r = $cr['nro_r'];
                            $placa = $cr['placa'];
                        }
                    }
                }
            }
        }
        $sql_rc = "UPDATE ruta SET id_vehiculo = '$placa' WHERE id = '$ruta' ";
        $con->consultar($sql_rc);
        if($placa != ""){
            Mensaje($placa);
        }
        
        
}

function Mensaje($placa){
    $con = new Conexion();
    $sql_cho = "SELECT chofer.id_usuario FROM vehiculo INNER JOIN chofer ON vehiculo.id_chofer = chofer.id_cedula WHERE vehiculo.placa = '$placa'";
    $consulta_cho = $con->consultar( $sql_cho);
    foreach ($consulta_cho as $cho){
        $id_usuario = $cho['id_usuario'];
    }
    
    $MY_API_KEY="AIzaSyClESwq7mvo76CoqqqkO1Lfef5UA_5xU1Y";

    $data = array(
        "to" => "/topics/upy",
        "time_to_life" => 172800,
        "data" => array(
            "title" => 'Sus Rutas han sufrido cambios',
            "body" => 'Actualice sus rutas',
            "icon" => "app",
            "usuario_nuevo" => $id_usuario,
            "usuario_viejo" => '00000'
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
    curl_exec($ch);
    curl_close($ch);
}

//Enviamos el resultado de la funcion "mostrar" a codificarse de tipo JSON
echo json_encode(procesar($conexion_bd, $ruta, $usuario, $resp, $respuestaJson));
//echo json_encode(mostrar($conexion_db,$id,$pass));
$con->cerrar_conexion(); //Cerramos la conexion a la base de datos