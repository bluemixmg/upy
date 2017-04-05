<?php
if(isset($_POST['fecha'])){
    if($_POST['fecha']!=''){
        $fecha = strtotime($_POST['fecha']);
        $fechaN = date('Y-m-d', $fecha);
    }else{
        $fechaN = '';
    }
}
if(isset($_POST['ids'])){
    $ids = $_POST['ids'];
}else{
    $ids = 0;
}

$rif = $_POST['rif'];
$nro_puestos = $_POST['asientos'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];

if($fechaN=="" || $ids==0){
    echo '<p>Faltan datos para generar la Orden</p>';
}else{
    //Guardamos los ids de las paradas seleccionadas
    include './conexion.php';
    $con = new Conexion();
    $paradas = [];
    $D = 0.009170;
    
    foreach ($ids as $i){
        $sql = "INSERT INTO parada_ruta (id_parada) VALUES ('$i')";
        $con->consultar( $sql);
    }
    //Se buscan las horas sin repetir de las paradas
    $sql_h = "SELECT DISTINCT parada.hora FROM parada_ruta INNER JOIN parada ON parada_ruta.id_parada = parada.id "
         . "INNER JOIN cliente ON parada.id_cliente = cliente.cedula "
         . "INNER JOIN empresa ON cliente.rif_empresa = empresa.rif WHERE empresa.rif ='".$rif."' AND parada_ruta.id_ruta IS NULL ORDER BY parada.hora ASC";
    $consulta = $con->consultar( $sql_h);

    //Se buscan las paradas que esten en una orden con una hora determinada
    $s = "o";
    While ($s != "fin"){
        foreach ($consulta as $c){
            if ($s == "o"){
                $sql1 = "SELECT parada.id, parada.lat_d, parada.lng_d FROM parada_ruta INNER JOIN parada ON "
                      . "parada_ruta.id_parada = parada.id INNER JOIN cliente ON parada.id_cliente=cliente.cedula "
                      . "INNER JOIN empresa ON cliente.rif_empresa=empresa.rif WHERE parada.lat_o=empresa.latitud "
                      . "AND parada.lng_o = empresa.longitud AND parada.hora = '".$c['hora']."' "
                      . "AND empresa.rif = '$rif' AND parada_ruta.estatus=1 AND parada_ruta.id_ruta IS NULL";
            }elseif ($s == "d"){
                $sql1 = "SELECT parada.id, parada.lat_o, parada.lng_o FROM parada_ruta INNER JOIN parada ON "
                  . "parada_ruta.id_parada = parada.id INNER JOIN cliente ON parada.id_cliente=cliente.cedula "
                  . "INNER JOIN empresa ON cliente.rif_empresa=empresa.rif WHERE parada.lat_d=empresa.latitud "
                  . "AND parada.lng_d = empresa.longitud AND parada.hora = '".$c['hora']."' "
                  . "AND empresa.rif = '$rif' AND parada_ruta.estatus=1 AND parada_ruta.id_ruta IS NULL";
            }
            $consulta1 = $con->consultar( $sql1);
            foreach ($consulta1 as $c1){
                $parada = new stdClass();
                if ($s == "o"){
                    $parada->lat = $c1['lat_d'];
                    $parada->lng = $c1['lng_d'];
                }elseif ($s == "d"){
                    $parada->lat = $c1['lat_o'];
                    $parada->lng = $c1['lng_o'];
                }
                
                $parada->id = $c1['id'];
                $paradas[] = $parada;
            }

            while(isset($paradas[0])){
                $B = [];
                $C = [];
                CalcularPreRuta($B,$C,$paradas);
                CalcularRuta($B,$C, $c['hora']);
                $paradas = array_slice($C,0);
            }

        }
        if($s == "o"){
            $s = "d";
        }elseif ($s == "d"){
            $s = "fin";
        }
    }

    
    
//    while(isset($paradas[0])){
//        $B = [];
//        $C = [];
//        CalcularPreRuta($B,$C,$paradas);
//        CalcularRuta($B,$C);
//        $paradas = array_slice($C,0);
//    }
    
    $con->cerrar_conexion();
    echo '<p>Orden de Servicio Generada</p>';
}

    function ValidarDistancia($o1,$d1,$D){
        $La = $o1->lat - $d1->lat;
        $Lo = $o1->lng - $d1->lng;
        
        if((abs($La)<=$D) && (abs($Lo)<=$D)){
            return 1;
        }else{
            return 0;
        }
    }

    function CalcularPreRuta(&$B,&$C,&$paradas){
        $origen = $paradas[0];
        $destino = $paradas;
        
        for($i=0;$i<count($destino);$i++){
            $status = ValidarDistancia($origen, $destino[$i], $GLOBALS['D']);
            if($status == 1){
                array_push($B, $destino[$i]);
            }elseif ($status == 0){
                array_push($C, $destino[$i]);
            }
        }
    }

    function CalcularRuta(&$B,&$C, $hora){
        
        for($k=0;$k<count($B);$k++){
            $origen2 = $B[$k];
            $destino2 = $C;
            
            for($l=0;$l<count($destino2);$l++){
                $estatus2 = ValidarDistancia($origen2, $destino2[$l], $GLOBALS['D']);
                if($estatus2==1){
                    array_push($B, $destino2[$l]);
                    for ($l2=0; $l2<count($C); $l2++){
                        if($destino2[$l]->id == $C[$l2]->id){
                            array_splice($C,$l2,1);
                        }
                    }
                }
            }
        }
        PicarRuta($B, $hora);
    }

    function PicarRuta(&$B, $hora){
        while (isset($B[0])){
//            echo '<br>Ruta Definitiva<br>';
            // INSERTAR RUTA NUEVA EN BD
            $con = new Conexion();
            $fecha = $GLOBALS['fechaN'];
            $sql_r = "INSERT INTO ruta (fecha) VALUES ('$fecha')";
            $con->consultar( $sql_r);
            $ruta = $con->insertar_id();
            //$ruta = pg_insert_id($conexion_bd);
            $nro_p_r = 0;
            for($m=0; $m < $GLOBALS['nro_puestos']; $m++){
                if(isset($B[$m])){
                        //Crea parada_ruta en BD
                        $sql_pr = "UPDATE parada_ruta SET id_ruta = '$ruta' WHERE id_parada = '".$B[$m]->id."' AND parada_ruta.id_ruta IS NULL";
                        $con->consultar($sql_pr);
                        $nro_p_r++;
//                        var_dump($B[$m]);
//                        echo 'Ruta Creada';
                }else{
                    break;
                }
            }
            array_splice($B, 0, $GLOBALS['nro_puestos']);
            
            // Insertar parada_ruta de Empresa
            $rif_e = $GLOBALS['rif'];
            $sql_pe = "SELECT id FROM parada WHERE id_cliente = '$rif_e' ";
            $consulta_pe = $con->consultar( $sql_pe);
            
            foreach ($consulta_pe as $c){
                $sql_pre = "INSERT INTO parada_ruta (id_ruta, id_parada) VALUES ('$ruta', '".$c['id']."')";
                $con->consultar( $sql_pre);
                break;
            }
            
            // reviso estado de la empresa
            $sql_p_r_total = "SELECT DISTINCT empresa.id_estado FROM ruta INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id INNER JOIN parada ON parada.id = parada_ruta.id_parada INNER JOIN cliente ON cliente.cedula = parada.id_cliente INNER JOIN empresa ON empresa.rif = cliente.rif_empresa WHERE ruta.id = '$ruta' ";
            $consulta_p_r_total = $con->consultar( $sql_p_r_total);
            foreach ($consulta_p_r_total as $cprt){
                $edo_empre = $cprt['id_estado'];
            }
            
            // Asignar Chofer
            AsignarChofer($nro_p_r, $hora, $GLOBALS['nro_puestos'], $ruta, $edo_empre);
        }
    }
    
    function AsignarChofer($n, $hora, $n_max, $ruta, $estado){
        $f = $GLOBALS['fechaN'];
        $con = new Conexion();
        $sql_c = "SELECT vehiculo.placa FROM vehiculo INNER JOIN chofer ON vehiculo.id_chofer = chofer.id_cedula INNER JOIN tipo_vehiculo ON vehiculo.id_tipo_vehiculo = tipo_vehiculo.id INNER JOIN disponibilidad ON chofer.id_usuario = disponibilidad.id_usuario INNER JOIN bloque ON disponibilidad.id_bloque = bloque.id WHERE tipo_vehiculo.nro_puestos >= '$n' AND tipo_vehiculo.nro_puestos <= '$n_max' AND disponibilidad.fecha = '$f' AND ('$hora' BETWEEN bloque.hora_inicio AND bloque.hora_fin) AND chofer.estatus != '0' AND chofer.estatus != '3' AND chofer.id_estado ='$estado' ";
        $consulta_c = $con->consultar( $sql_c);
        
        $r = 100000;
        $placa = "";
        if($con->num_filas($consulta_c) > 0){
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
                    if($con->num_filas($consulta_cr) > 0){
                        foreach ($consulta_cr as $cr){
                            if($cr['nro_r'] < $r){
                                $r = $cr['nro_r'];
                                $placa = $cr['placa'];
                            }
                        }
                    }
                }
            }
        }
        $sql_rc = "UPDATE ruta SET id_vehiculo = '$placa' WHERE id = '$ruta' ";
        $con->consultar($sql_rc);
        if($placa!=''){
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