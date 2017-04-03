<?php

if($_POST['fecha']!=''){
    require_once './conexion.php';
    $rif = $_POST['rif'];
    $fecha = date_format(new DateTime($_POST['fecha']), 'Y-m-d');
    $sql = "SELECT ruta.id,parada.lat_o,parada.hora,cliente.cedula,cliente.nombre,cliente.apellido FROM ruta "
         . "INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id "
         . "INNER JOIN parada ON parada.id = parada_ruta.id_parada "
         . "INNER JOIN cliente ON parada.id_cliente = cliente.cedula "
         . "WHERE cliente.rif_empresa = '$rif' AND ruta.fecha='$fecha' AND ruta.estatus=0 ORDER BY ruta.id";
    $consulta = pg_query($conexion_bd, $sql);
    pg_close($conexion_bd);
    if(pg_num_rows($consulta)>0){
        echo '<p>Leyenda</p>
                <p>Inverso (I): Parada -> Empresa</p>
                <p>Salida (S): Empresa -> Parada</p>
                <br>';
        echo '<table class="table" id="tabla_eliminar_orden" border="1">';
        echo '<tr>';
        echo '<td>RUTA</td><td>HORA</td><td>ORIENTACION</td><td>EMPLEADO</td>';
        echo '</tr>';
        foreach ($consulta as $c){
            echo '<tr>';
            echo '<td>'.$c['id'].'</td>';
            echo '<td>'.date_format(new DateTime($c['hora']), 'h:i a').'</td>';
            if($c['lat_o'] == $_POST['latitud']){
                echo '<td>Salida</td>';
            }else{
                echo '<td>Inverso</td>';
            }
            echo '<td>'.$c['nombre'].' '.$c['apellido'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<input type="submit" onclick="eliminar_orden();return false;" value="Eliminar Orden">';
    }else{
        echo '<p>No existen Ordenes de Servicio en la fecha indicada</p>';
    }
}