<?php

$rif = $_POST['rif'];
$fecha = date_format(new DateTime($_POST['fecha']), 'Y-m-d');

require_once './conexion.php';$con = new Conexion();

$sql = "SELECT ruta.id FROM ruta "
         . "INNER JOIN parada_ruta ON parada_ruta.id_ruta = ruta.id "
         . "INNER JOIN parada ON parada.id = parada_ruta.id_parada "
         . "INNER JOIN cliente ON parada.id_cliente = cliente.cedula "
         . "WHERE cliente.rif_empresa = '$rif' AND ruta.fecha='$fecha' AND ruta.estatus=0";
$id_rutas = $con->consultar( $sql);

if($con->num_filas($id_rutas)>0){
    foreach ($id_rutas as $i){
        $sql = "DELETE FROM parada_ruta WHERE id_ruta='".$i['id']."'";
        $con->consultar( $sql);
        $sql1 = "DELETE FROM ruta WHERE id='".$i['id']."'";
        $con->consultar( $sql1);
    }
    echo '<p>Orden de Servicio Eliminada</p>';
}else{
    echo '<p>Hubo un problema eliminando la orden</p>';
}