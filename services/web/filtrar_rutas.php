<?php
session_start();
if(isset($_POST['id'])){
    $id = $_POST['id'];// id del chofer/empresa/ruta/hora
}else{
    $id = '';
}
if(isset($_POST['para'])){
    $para = $_POST['para'];
}else{
    $para = '';
}
if(isset($_POST['fecha'])){
    $fecha = $_POST['fecha'];
}else{
    $fecha = '';
}

    if((!empty($para)) and (!empty($fecha))) {
        filtros($id, $para, $fecha);
    } else if ((!empty($id)) and (empty($para))){
        rutas ($id);
        // ruta.id, empresa.rif, empresa.nombre, vehiculo.placa, tipo_vehiculo.nombre, chofer.id_cedula, chofer.nombre, chofer.apellido 
    }else {
         echo "No se han encontrado resultados";
    }

    function filtros($id, $para, $fecha) {
        require_once './conexion.php';
        if ($para == "estado"){
            $sql = "SELECT id,nombre_estado as texto FROM estado WHERE id_pais=17 ORDER BY nombre_estado";
            $p = 'r_estado';
            $f = 'L1';
        }else if ($para == "r"){
            $sql = "SELECT ruta.id as id, CONCAT ('RUTA ', ruta.id) as texto FROM ruta WHERE fecha = '$fecha' ORDER BY ruta.id";
            $p = '';
            $f = 'L2';
        }else if ($para == "c"){
            $sql = "SELECT chofer.id_cedula as id, CONCAT (chofer.nombre, ' ',  chofer.apellido) as texto FROM chofer WHERE estatus=1";
            $p = 'rc';
            $f = 'L1';
        }else if ($para == "h"){
            $sql = "SELECT DISTINCT parada.hora as id, parada.hora as texto FROM parada INNER JOIN parada_ruta ON parada.id = parada_ruta.id_parada INNER JOIN ruta ON parada_ruta.id_ruta = ruta.id WHERE ruta.fecha = '$fecha' AND parada.hora IS NOT NULL";
            $p = 'rh';
            $f = 'L1';
        }else if ($para == "e"){
            $sql = "SELECT empresa.rif as id, empresa.nombre as texto FROM empresa WHERE estatus=1 ORDER BY empresa.nombre ASC";
            $p = 're';
            $f = 'L1';
        }else if ($para == "n"){
            $sql = "SELECT ruta.id as id, CONCAT ('RUTA ', ruta.id) as texto FROM ruta WHERE fecha = '$fecha' AND id_vehiculo='' ORDER BY ruta.id";
            $p = '';
            $f = 'L2';
        }else if ($para == "rc"){
            $sql = "SELECT ruta.id as id, CONCAT ('RUTA ', ruta.id) as texto FROM chofer INNER JOIN vehiculo ON chofer.id_cedula = vehiculo.id_chofer INNER JOIN ruta ON vehiculo.placa = ruta.id_vehiculo WHERE chofer.id_cedula= '$id' AND ruta.fecha = '$fecha' ORDER BY ruta.id ASC";
            $p = '';
            $f = 'L2';
        }else if ($para == "rh"){
            $sql = "SELECT DISTINCT ruta.id, CONCAT ('RUTA ', ruta.id) as texto FROM ruta INNER JOIN parada_ruta ON ruta.id = parada_ruta.id_ruta INNER JOIN parada ON parada.id = parada_ruta.id_parada WHERE parada.hora = '$id' AND ruta.fecha = '$fecha' ORDER BY ruta.id ASC";
            $p = '';
            $f = 'L2';
        }else if ($para == "re"){
            $sql = "SELECT DISTINCT ruta.id, CONCAT ('RUTA ', ruta.id) as texto FROM ruta INNER JOIN parada_ruta ON ruta.id = parada_ruta.id_ruta INNER JOIN parada ON parada_ruta.id_parada = parada.id INNER JOIN cliente ON parada.id_cliente = cliente.cedula INNER JOIN empresa ON cliente.rif_empresa = empresa.rif WHERE empresa.rif = '$id' AND ruta.fecha = '$fecha' ORDER BY ruta.id ASC";
            $p = '';
            $f = 'L2';
        }else if ($para == "r_estado"){
            $sql = "SELECT DISTINCT ruta.id, CONCAT ('RUTA ', ruta.id) as texto FROM ruta INNER JOIN parada_ruta ON ruta.id = parada_ruta.id_ruta INNER JOIN parada ON parada_ruta.id_parada = parada.id INNER JOIN cliente ON parada.id_cliente = cliente.cedula INNER JOIN empresa ON cliente.rif_empresa = empresa.rif WHERE empresa.id_estado='$id' AND ruta.fecha = '$fecha' ORDER BY ruta.id ASC";
            $p = '';
            $f = 'L2';
        }
        $consultar = mysqli_query($conexion_bd, $sql);
        
        if(mysqli_num_rows($consultar) == 0){
            echo "No se han encontrado resultados para '<b>".$id."</b>'.";
        }else{
            foreach($consultar as $c){
                $id = $c['id'];
                $texto = $c['texto'];
                if($f=='L1'){
                    echo '<li type="circle" onclick="Filtros2(this.id);return false;" id="'.$id.'"><a data-toggle="pill">'.utf8_encode($texto).'</a></li>';
                    echo '<input type="hidden" id="parametro_buscar" value="'.$p.'">';
                }elseif($f=='L2'){
                    echo '<li type="circle" onclick="Filtros3(this.id);return false;" id="'.$id.'"><a data-toggle="pill">'.$texto.'</a></li>';
                    echo '<input type="hidden" id="parametro_buscar" value="'.$p.'">';
                }
            }

            ?>
<!--        SCRIPT PARA EL MAPA
            <script>
                var map5;
                var lat1 = parseFloat(document.getElementById('').value);
                var lon1 = parseFloat(document.getElementById('').value);
                function initMapFiltros() {
                    map5 = new google.maps.Map(document.getElementById(''), {
                        center: {lat: lat1, lng: lon1},
                        zoom: 15
                    });
                    var marker = new google.maps.Marker({
                        position: {lat: lat1, lng: lon1},
                        map: map5,
                        draggable: true
                      });
                    google.maps.event.addListener(marker, "dragend", function() {
                    document.getElementById('').value = marker.getPosition().lat();
                    document.getElementById('').value = marker.getPosition().lng();
                  });
                  document.getElementById('').value = marker.getPosition().lat();
                  document.getElementById('').value = marker.getPosition().lng();
                }
            </script>
            -->
            <?php
        }
        mysqli_close($conexion_bd);
    }
    
    function estatus($i){
        if($i == 0){
            return "No Realizada";
        }elseif($i == 1){
            return "Realizada";
        }elseif($i == 2){
            return "En Proceso";
        }
    }
    
    function tipo_ruta($t){
        if($t == 1 || $t==''){
            return "Ninguna";
        }elseif($t == 2){
            return "Urbana";
        }elseif($t == 3){
            return "Intraurbana";
        }
    }
    
    function rutas($id){
        require_once './conexion.php';
        //ruta.id, ruta.id_vehiculo, ruta.fecha, ruta.estatus, parada.hora, empresa.rif, empresa.nombre, chofer.id_cedula, chofer.nombre, chofer.apellido
        //cliente.cedula, cliente.nombre, cliente.apellido
        $sql = "SELECT DISTINCT CONCAT ('RUTA ', ruta.id) as ruta, ruta.id_vehiculo, ruta.fecha, "
                . "ruta.id_tipo_ruta, ruta.costo, ruta.precio,ruta.estatus, parada.hora, empresa.rif, "
                . "empresa.nombre as empresa_nombre, empresa.direccion FROM ruta "
                . "INNER JOIN parada_ruta ON ruta.id = parada_ruta.id_ruta "
                . "INNER JOIN parada ON parada_ruta.id_parada = parada.id "
                . "INNER JOIN cliente ON parada.id_cliente = cliente.cedula "
                . "INNER JOIN empresa ON cliente.rif_empresa = empresa.rif WHERE ruta.id = $id";
        $consultar_r = mysqli_query($conexion_bd, $sql);
        
        $sql2 = "SELECT DISTINCT parada.id as parada, CONCAT (cliente.cedula, ' - ', cliente.nombre, ' ', cliente.apellido, ' - ', cliente.direccion) as cliente FROM ruta INNER JOIN parada_ruta ON ruta.id = parada_ruta.id_ruta INNER JOIN parada ON parada_ruta.id_parada = parada.id INNER JOIN cliente ON parada.id_cliente = cliente.cedula WHERE ruta.id = $id";
        $consultar_cli = mysqli_query($conexion_bd, $sql2);
        
        if(mysqli_num_rows($consultar_r) == 0){
            echo "No se han encontrado resultados para la RUTA '<b>".$id."</b>'.";
        }else{
            foreach($consultar_r as $c){
                $ruta = $c['ruta'];
                $fecha = $c['fecha'];
                $hora = $c['hora'];
                $hora_formateada = date_format(new DateTime($hora), 'h:i a');
                $estatus = $c['estatus'];
                $rif = $c['rif'];
                $empresa = $c['empresa_nombre'];
                $empresa_dir = $c['direccion'];
                $placa = $c['id_vehiculo'];
                //$id_chofer = $c['id_cedula'];
                //$chofer = $c['chofer'];
                $id_tipo_ruta = $c['id_tipo_ruta'];
                $costo = $c['costo'];
                $precio = $c['precio'];

                echo '<input type="hidden" id="id_ruta_filtro" value="'.$ruta.'">';
                echo '<h3><strong>'.$ruta.'</strong></h3><br>';
                echo '<h4><strong>Empresa: </strong>'.$rif." <strong>/</strong> ".$empresa.'</h4>';
                echo '<p><b>Dirección: </b>'.$empresa_dir.' </p><br>';
                echo '<h4><strong>Fecha: </strong>'.$fecha."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."<strong>Hora: </strong>".$hora_formateada.'</h4><br>';
                echo '<h4><strong>Estatus: </strong></h4>';
                echo '<select style="width: 150px; float: none; margin: 10px auto;" id="estatus_control_rutas" class="form-control">';
                for ($i=0; $i<3; $i++){
                    if ($i == $estatus){
                        $texto = estatus($i);
                        echo '<option selected="true" id="'.$i.'" value="'.$i.'">'.$texto.'</option>';
                    }else {
                        $texto = estatus($i);
                        echo '<option id="'.$i.'" value="'.$i.'">'.$texto.'</option>';
                    }
                }
                echo '</select>';

                $sql3 = "SELECT chofer.id_cedula FROM ruta "
                      . "INNER JOIN vehiculo ON ruta.id_vehiculo = vehiculo.placa "
                      . "INNER JOIN chofer ON vehiculo.id_chofer = chofer.id_cedula "
                      . "WHERE ruta.id=$id";
                $consultar_chofer = mysqli_query($conexion_bd, $sql3);
                if(mysqli_num_rows($consultar_chofer)>0){
                    foreach($consultar_chofer as $chofer){
                        $id_chofer = $chofer['id_cedula'];
                    }
                }else{
                    $id_chofer = '';
                }
                
                $sql4 = "SELECT id_cedula, CONCAT (nombre, ' ',  apellido) as chofer FROM chofer WHERE estatus = 1";
                $consultar_ch = mysqli_query($conexion_bd, $sql4);
                echo '<h4><strong>Conductor: </strong></h4>';
                echo '<select style="width: 350px; float: none; margin: 10px auto;" id="chofer" class="form-control">';
                if($id_chofer == ''){
                    echo '<option id="" value="" selected="true">No hay chofer asignado</option>';
                }
                if(mysqli_num_rows($consultar_ch)>0){
                    foreach($consultar_ch as $cch){
                        if ($id_chofer == $cch['id_cedula']){
                            echo '<option selected="true" id="'.$cch['id_cedula'].'" value="'.$cch['id_cedula'].'">'.$cch['chofer'].'</option>';
                        }
                        else{
                            echo '<option id="'.$cch['id_cedula'].'" value="'.$cch['id_cedula'].'">'.$cch['chofer'].'</option>';
                        }
                    }
                }else{
                    echo '<option id="" value="">No hay choferes registrados</option>';
                }
                echo '</select>';
                
                if(in_array(15, $_SESSION['permisos']) || in_array(16, $_SESSION['permisos'])){
                echo '<h4><strong>Tipo de ruta: </strong></h4>';
                echo '<select style="width: 150px; float: none; margin: 10px auto;" id="tipo_ruta" class="form-control" onchange="precio();return null;">';
                for ($t=1; $t<4; $t++){
                    if ($t == $id_tipo_ruta){
                        $texto = tipo_ruta($t);
                        echo '<option selected="true" id="'.$t.'" value="'.$t.'">'.$texto.'</option>';
                    }else{
                        $texto = tipo_ruta($t);
                        echo '<option id="'.$t.'" value="'.$t.'">'.$texto.'</option>';
                    }
                }
                echo '</select>';
                }else{
                    echo '<input hidden id="tipo_ruta" value="'.$id_tipo_ruta.'">';
                }
            }
            
            echo '<div id="div_costo_precio"></div>';
            
            if(in_array(16, $_SESSION['permisos'])){
                echo '<h4 id="h4_costo"><strong>Costo de la Ruta: </strong></h4>';
                echo '<label id="label_costo">'.$costo.'</label><br>';
                echo '<h4 id="h4_precio"><strong>Precio de la Ruta: </strong></h4>';
                echo '<label id="label_precio">'.$precio.'</label><br>';
            }elseif(in_array(14, $_SESSION['permisos']) || in_array(15, $_SESSION['permisos'])){
                echo '<h4 id="h4_costo" hidden><strong>Costo de la Ruta: </strong></h4>';
                echo '<label id="label_costo" hidden>'.$costo.'</label><br>';
                echo '<h4 id="h4_precio" hidden><strong>Precio de la Ruta: </strong></h4>';
                echo '<label id="label_precio" hidden>'.$precio.'</label><br>';
            }
            
            echo '<br><h4><strong>Empleados en Ruta</strong></h4>';
            echo '<table class="table" border="1" id="empleados_filtro">';
            if(mysqli_num_rows($consultar_cli)>0){
                foreach($consultar_cli as $cc){
                    $id = $cc['parada'];
                    $texto = $cc['cliente'];

                    echo '<tr id="'.$id.'">';
                    echo '<td>'.$texto.'</td>';
                    echo '<td><button type="submit" id="aaa" onClick="deleteRowParadas(this);return false;" value="parada"><img src="images/delete1.ico" alt="Revisado" width="15"></button></td>';
                    echo '</tr>';
                }
                echo '</table>';
            }else{
                echo '</table>';
                echo 'No hay paradas asignadas a esta ruta';
            }
            
            $sql_empleados = "SELECT cliente.cedula,cliente.nombre,cliente.apellido,parada.id FROM cliente INNER JOIN parada ON cliente.cedula = parada.id_cliente WHERE cliente.rif_empresa =  '$rif' AND parada.hora =  '$hora' ORDER BY cliente.cedula ASC";
            $select_empleados = mysqli_query($conexion_bd, $sql_empleados);
            echo '<form class="contact-bottom text-center">';
            echo '<select id="empleados_nuevos" style="width: 350px; margin: 10px auto;" class="form-control">';
            foreach ($select_empleados as $s){
                echo '<option value="'.$s['id'].'">'.$s['cedula'].' - '.$s['nombre'].' '.$s['apellido'].'</option>';
            }
            echo '</select>';
            
            echo '<input type="hidden" id="rif_empresa_filtro" value="'.$rif.'">';
            echo '<input type="submit" onClick="agregar_parada();return false;" value="Agregar Parada">&nbsp&nbsp&nbsp&nbsp';
            echo '<input type="submit" onClick="actualizar_ruta();return false;" value="Guardar Cambios">';
            echo '<div id="dialog"></div></form>';
        }
        mysqli_close($conexion_bd);
    }