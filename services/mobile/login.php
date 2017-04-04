<?php
header('Content-Type: application/json');

require ('conexion.php');$con = new Conexion(); //Archivo para conectar a la base de datos

//Comprobamos que se han pasado parámetros por POST
if(isset($_POST['id']) && isset($_POST['pass'])){
$id = $_POST['id'];
$pass = md5($_POST['pass']);
}else{
    $id = "";
    $pass = "";
}
$respuestaJson = array();
//Definimos la funcion de busqueda del usuario
function mostrar($conexion_bd,$id,$pass,$respuestaJson){

    if($id!="" && $pass!=""){
    $sql = "SELECT * FROM usuario INNER JOIN chofer ON usuario.usuario = chofer.id_usuario WHERE usuario.usuario='$id' AND usuario.contrasena='$pass' AND usuario.id_rol=3 AND chofer.estatus != '0' AND chofer.estatus != '3'";
    //echo $sql;
    $consulta = $con->consultar( $sql);
        if($con->num_filas($consulta)>0){
            while($fila = pg_fetch_array($consulta)){
                if($fila['estatus'] != 0){
                    $respuestaJson['success'] = 1;
                    $respuestaJson['message'] = "EXITO";
                    $respuestaJson['idusuario'] = utf8_encode($fila['usuario']);
//                      $respuestaJson['nombre'] = utf8_encode($fila['nombre']);
//                      $respuestaJson['correo'] = utf8_encode($fila['correo']);
                }else{
                    $respuestaJson["success"] = 2;
                    $respuestaJson["message"] = "Usuario Inactivo";
                }
            }
        }else{
            $respuestaJson["success"] = 0;
            $respuestaJson["message"] = "Usuario o Contrasena Incorrecta";
        }
    }else{
        $respuestaJson["success"] = 0;
	$respuestaJson["message"] = "Faltan Datos";
        //return "Faltan Datos";
    }
    return $respuestaJson;
}

//Enviamos el resultado de la funcion "mostrar" a codificarse de tipo JSON
echo json_encode(mostrar($conexion_bd, $id, $pass, $respuestaJson));
//echo json_encode(mostrar($conexion_db,$id,$pass));
$con->cerrar_conexion(); //Cerramos la conexion a la base de datos