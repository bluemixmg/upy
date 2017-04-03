<?php
session_start();
$tipo = filter_var($_POST['tipo'],FILTER_SANITIZE_NUMBER_INT);
$chofer = $_POST['chofer'];

if($chofer!='' && $tipo!=''){
    require_once './conexion.php';
    $sql = "SELECT tipo_vehiculo.id,tipo_vehiculo.costo,tipo_vehiculo.precio,vehiculo.id_chofer,vehiculo.id_tipo_vehiculo,chofer.id_cedula FROM chofer "
         . "INNER JOIN vehiculo ON chofer.id_cedula=vehiculo.id_chofer "
         . "INNER JOIN tipo_vehiculo ON tipo_vehiculo.id=vehiculo.id_tipo_vehiculo "
         . "WHERE chofer.id_cedula='$chofer'";
    $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
    foreach ($consulta as $c1){
        $costo_tipo_vehiculo = $c1['costo'];
        $precio_tipo_vehiculo = $c1['precio'];
    }
        
    if(in_array(16, $_SESSION['permisos'])){
        if($tipo==1){
            echo '<h4 id="h4_costo"><strong>Costo de la Ruta: </strong></h4>';
            echo '<label id="label_costo">0</label><br>';
            echo '<h4 id="h4_precio"><strong>Precio de la Ruta: </strong></h4>';
            echo '<label id="label_precio">0</label>';
        }else{
            $sql = "SELECT costo,precio FROM tipo_ruta WHERE id='$tipo'";
            $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
            foreach ($consulta as $c){
                $costo_tipo_ruta = $c['costo'];
                $precio_tipo_ruta = $c['precio'];
            }
            echo '<h4 id="h4_costo"><strong>Costo de la Ruta: </strong></h4>';
            echo '<label id="label_costo">'.$costo_tipo_ruta * $costo_tipo_vehiculo.'</label><br>';
            echo '<h4 id="h4_precio"><strong>Precio de la Ruta: </strong></h4>';
            echo '<label id="label_precio">'.$precio_tipo_ruta * $precio_tipo_vehiculo.'</label>';
        }
    }elseif(in_array(15, $_SESSION['permisos'])){
         if($tipo==1){
            echo '<h4 id="h4_costo" hidden><strong>Costo de la Ruta: </strong></h4>';
            echo '<label id="label_costo" hidden>0</label><br>';
            echo '<h4 id="h4_precio" hidden><strong>Precio de la Ruta: </strong></h4>';
            echo '<label id="label_precio" hidden>0</label>';
        }else{
            $sql = "SELECT costo,precio FROM tipo_ruta WHERE id='$tipo'";
            $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
            foreach ($consulta as $c){
                $costo_tipo_ruta = $c['costo'];
                $precio_tipo_ruta = $c['precio'];
            }
            echo '<h4 id="h4_costo" hidden><strong>Costo de la Ruta: </strong></h4>';
            echo '<label id="label_costo" hidden>'.$costo_tipo_ruta * $costo_tipo_vehiculo.'</label><br>';
            echo '<h4 id="h4_precio" hidden><strong>Precio de la Ruta: </strong></h4>';
            echo '<label id="label_precio" hidden>'.$precio_tipo_ruta * $precio_tipo_vehiculo.'</label>';
        }
    }
    pg_close($conexion_bd);
}