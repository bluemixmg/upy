<?php
header('Content-Type: application/json');

require ('conexion.php');$con = new Conexion(); //Archivo para conectar a la base de datos

//Comprobamos que se han pasado parámetros por POST
if(isset($_POST['id']) && isset($_POST['id_inc'])){
$id = $_POST['id'];
$id_inc = $_POST['id_inc'];
    if(isset($_POST['cedula'])){
        $id_cliente = $_POST['cedula'];
    }else{
        $id_cliente = '';
    }
}else{
    $id = "";
    $id_inc = "";
}
$respuestaJson = array();
//Definimos la funcion de busqueda del usuario
function mostrar($conexion_bd,$id,$id_inc,$id_cliente,$respuestaJson){

    if($id!="" && $id_inc!=""){
        date_default_timezone_set("America/Caracas");
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $sql = "INSERT INTO incidencia (id_tipo_incidencia,id_usuario,fecha,hora,id_cliente) VALUES ('$id_inc','$id','$fecha','$hora','$id_cliente')";
        if($con->consultar( $sql)){
        $respuestaJson['success'] = 1;
        $respuestaJson['message'] = "Incidencia Notificada";
        
        //// validar si Incidencia es Accidentado!!! y reaordenar rutas
        if ($id_inc == "1"){
            
            /// Actualizar Chofer a Inactivo 
            $sql_ruta_nueva = "UPDATE chofer SET estatus = '2' WHERE id_usuario = '$id'";
            $con->consultar($sql_ruta_nueva);
            
            $sql_d = "DELETE FROM disponibilidad WHERE id_usuario = '$id' AND fecha = '$fecha'";
            $con->consultar( $sql_d);
            
            ////// buscar las rutas en proceso = estatus 2
            // buscar placa del vehiculo del chofer
            $sql_p = "SELECT vehiculo.placa FROM chofer INNER JOIN vehiculo ON chofer.id_cedula = vehiculo.id_chofer WHERE chofer.id_usuario='$id'";
            $consulta_p = $con->consultar( $sql_p);
            if($con->num_filas($consulta_p)>0){
                foreach ($consulta_p as $cp){
                    $placa = $cp['placa'];
                }
                // buscar las rutas en proceso que concuerden con la placa
                $sql_r = "SELECT id FROM ruta WHERE id_vehiculo = '$placa' AND estatus = '2' "; 
                $consulta_r = $con->consultar( $sql_r);
                if($con->num_filas($consulta_r)>0){
                    foreach ($consulta_r as $cr){
                        $ruta = $cr['id'];
                        // finalizo la ruta
                        $sql_ruta = "UPDATE ruta SET estatus = '1' WHERE id = '$ruta'";
                        $con->consultar($sql_ruta);
                        
                        ///revisar si la parada empresa esta pendiente
                        $parada_empresa_pendiente = 0;
                        $sql_empre = "SELECT parada.id FROM parada_ruta INNER JOIN parada ON parada_ruta.id_parada = parada.id INNER JOIN empresa ON parada.id_cliente = empresa.rif WHERE parada_ruta.id_ruta = '$ruta' AND parada_ruta.estatus = '1' "; 
                        $consulta_empre = $con->consultar( $sql_empre);
                        if($con->num_filas($consulta_empre)>0){
                            //contar paradas originales
                            $sql_p_r_total = "SELECT COUNT(parada_ruta.id) as n FROM ruta INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id WHERE ruta.id = '$ruta' ";
                            $consulta_p_r_total = $con->consultar( $sql_p_r_total);
                            foreach ($consulta_p_r_total as $cprt){
                                $nro_total = $cprt['n'] - 1;
                                $parada_empresa_pendiente = 1;
                            }
                        }
                        
                        // creo nueva ruta
                        $sql_rn = "INSERT INTO ruta (fecha) VALUES ('$fecha')";
                        $con->consultar( $sql_rn);
                        $ruta_nueva = pg_insert_id($conexion_bd);
                        
                        // asigno a parada_ruta pendientes la nueva ruta
                        $sql_pr = "SELECT id FROM parada_ruta WHERE id_ruta = '$ruta' AND estatus = '1' "; 
                        $consulta_pr = $con->consultar( $sql_pr);
                        
                        $nro = 0;
                        if($con->num_filas($consulta_pr)>0){
                            foreach ($consulta_pr as $pr){
                                $p_r = $pr['id'];
                                $nro++;
                                // actualizar con la ruta nueva
                                $sql_ruta_nueva = "UPDATE parada_ruta SET id_ruta = '$ruta_nueva' WHERE id = '$p_r'";
                                $con->consultar($sql_ruta_nueva);
                            }
                        }
                        
                        // asignar chofer dependiendo si va o viene de la empresa
                        if ($parada_empresa_pendiente == '1'){
                            // duplico las parada_ruta en la ruta nueva con estatus 0 de realizadas
                            $sql_pr_r = "SELECT id_parada FROM parada_ruta WHERE id_ruta = '$ruta' AND estatus = '0' "; 
                            $consulta_pr_r = $con->consultar( $sql_pr_r);

                            if($con->num_filas($consulta_pr_r)>0){
                                foreach ($consulta_pr_r as $prr){
                                    $parada_r = $prr['id_parada'];
                                    $sql_prr = "INSERT INTO parada_ruta (id_ruta,id_parada,estatus) VALUES ('$ruta_nueva','$parada_r','0')";
                                    $con->consultar( $sql_prr);
                                }
                            }
                            
                            AsignarChofer($nro_total, $hora, $ruta_nueva, $fecha);
                        }else{
                            AsignarChofer($nro, $hora, $ruta_nueva, $fecha);
                        }
                                                
                    }// por cada ruta en proceso
                }//fin de las rutas en proceso
                
                ////// buscar las rutas no realizada (pendientes) = estatus 0//////////////////////////////////////////////
                // buscar las rutas pendientes que concuerden con la placa

                $sql_r2 = "SELECT DISTINCT ruta.id FROM ruta INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id INNER JOIN parada ON parada.id = parada_ruta.id_parada WHERE ruta.fecha = '$fecha' AND parada.hora >= '$hora' AND ruta.id_vehiculo = '$placa' AND ruta.estatus = '0' ORDER BY parada.hora ASC"; 
                $consulta_r2 = $con->consultar( $sql_r2);
                if($con->num_filas($consulta_r2)>0){
                    foreach ($consulta_r2 as $cr2){
                        $ruta = $cr2['id'];
                                  
                        $sql_p_r2 = "SELECT COUNT(parada_ruta.id) as n, parada.hora, empresa.id_estado FROM ruta INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id INNER JOIN parada ON parada.id = parada_ruta.id_parada INNER JOIN cliente ON cliente.cedula = parada.id_cliente INNER JOIN empresa ON empresa.rif = cliente.rif_empresa WHERE ruta.id = '$ruta' AND parada.hora IS NOT NULL";
                        $consulta_p_r2 = $con->consultar( $sql_p_r2);
                        foreach ($consulta_p_r2 as $cpr2){
                            
                            $nro_p = $cpr2['n'];
                            $hora_p = $cpr2['hora'];
                            $edo_empre = $cprt['id_estado'];
                        }
                        AsignarChofer($nro_p, $hora_p, $ruta, $fecha, $edo_empre);
                        
                        
                    }// por cada ruta no realizadas
                }// fin de las rutas no realizadas
            }  
        }// fin de incidencia Accidentado
        
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


function AsignarChofer($n, $hora, $ruta, $f, $estado){
        include './conexion.php';$con = new Conexion();
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
                        $r = $cr['nro_r'];
                        $placa = $cr['placa'];
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
    include './conexion.php';$con = new Conexion();
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

function Mensaje2($placa, $texto){
    include './conexion.php';$con = new Conexion();
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
            "title" => $texto,
            "body" => $texto,
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
echo json_encode(mostrar($conexion_bd, $id, $id_inc, $id_cliente, $respuestaJson));
//echo json_encode(mostrar($conexion_db,$id,$pass));
$con->cerrar_conexion(); //Cerramos la conexion a la base de datos