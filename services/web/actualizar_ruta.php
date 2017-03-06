<?php
$rif = $_POST['rif'];
$id_ruta = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$estatus = $_POST['estatus'];
$chofer = $_POST['chofer'];
$tipo_ruta = $_POST['tipo_ruta'];
$costo = filter_var($_POST['costo'], FILTER_SANITIZE_NUMBER_FLOAT);
$precio = filter_var($_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT);
$json = json_decode($_POST['json'],true);

if($id_ruta!='' && $estatus!='' && $chofer!=''){
    require_once './conexion.php';
    $sql = "DELETE FROM parada_ruta WHERE id_ruta='$id_ruta'";//Borramos en parada_ruta las paradas asignadas
    $consulta = mysqli_query($conexion_bd, $sql);

    foreach ($json as $j){
        $sql = "INSERT INTO parada_ruta (id_ruta,id_parada) VALUES ('$id_ruta','$j[0]')";
        mysqli_query($conexion_bd, $sql);
    }
    $sql = "SELECT vehiculo.placa, vehiculo.id_chofer, chofer.id_cedula, chofer.id_usuario FROM chofer 
        INNER JOIN vehiculo ON vehiculo.id_chofer = chofer.id_cedula
        WHERE chofer.id_cedula = '$chofer'";
    $placa = mysqli_query($conexion_bd, $sql);
    
    $sql = "SELECT id FROM parada WHERE id_cliente='$rif'";
    $parada_empresa = mysqli_query($conexion_bd, $sql);
    
    foreach ($parada_empresa as $p){
        $sql = "INSERT INTO parada_ruta (id_ruta,id_parada) VALUES ('$id_ruta','".$p['id']."')";
        mysqli_query($conexion_bd, $sql);
    }
    
    $sql = "SELECT chofer.id_usuario FROM ruta INNER JOIN vehiculo ON ruta.id_vehiculo=vehiculo.placa INNER JOIN chofer ON chofer.id_cedula=vehiculo.id_chofer WHERE ruta.id='$id_ruta'";
    $chofer_viejo = mysqli_query($conexion_bd, $sql);
    
    if (mysqli_num_rows($chofer_viejo)>0){
        foreach ($chofer_viejo as $cv){
            $usuario_viejo = $cv['id_usuario'];
        }
    }else{
        $usuario_viejo = '';
    }
    
    foreach ($placa as $c){
        $sql = "UPDATE ruta SET estatus='".$estatus."',id_tipo_ruta='".$tipo_ruta."',id_vehiculo='".$c['placa']."',costo='".$costo."',precio='".$precio."' WHERE id='".$id_ruta."'";
        mysqli_query($conexion_bd, $sql);
        $usuario_nuevo = $c['id_usuario'];
    }
    
    echo 'Parada actualizada';
    mysqli_close($conexion_bd);
    
    $MY_API_KEY="AIzaSyClESwq7mvo76CoqqqkO1Lfef5UA_5xU1Y";

    $data = array(
        "to" => "/topics/upy",
        "time_to_life" => 172800,
        "data" => array(
            "title" => 'Sus Rutas han sufrido cambios',
            "body" => 'Actualice sus rutas',
            "icon" => "app",
            "usuario_viejo" => $usuario_viejo,
            "usuario_nuevo" => $usuario_nuevo
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