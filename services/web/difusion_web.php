<?php

$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
date_default_timezone_set("America/Caracas");
$fecha = date('Y-m-d');

if($titulo!='Título' && $texto!='Texto'){
    if(isset($_FILES['file-0'])){
        //obtenemos el nombre del archivo.
        $fname = $_FILES['file-0']['name'];
        $chk_ext = explode(".",$fname);
        //verificamos que el archivo tenga la extensión correcta para procesar la información
        if(strtolower(end($chk_ext)) == "png" || strtolower(end($chk_ext)) == "jpg"){
            // Muevo la imagen desde su ubicación temporal al directorio definitivo
            move_uploaded_file($_FILES['file-0']['tmp_name'], '../.../../../images/noticias/'.$fname);
            $ruta = 'images/noticias/'.$fname;
        }else{
            echo '<p>Formato de imagen no admitido</p>';
            return 0;
        }
    }else{
        $ruta = 'images/noticias/1.jpg';
    }

    require_once ('conexion.php');$con = new Conexion();
    $sql = "INSERT INTO noticia (titulo,texto,ruta_imagen,fecha) VALUES ('$titulo','$texto','$ruta','$fecha')";
    $con->consultar( $sql);
    echo 'Informacion registrada exitosamente';
    $con->cerrar_conexion();
}else{
    echo 'Favor ingrese todos los datos';
}