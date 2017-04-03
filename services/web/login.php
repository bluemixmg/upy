<?php
header('Content-Type: application/json');

require ('conexion.php'); //Archivo para conectar a la base de datos

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

    if($id!="" || $pass!=""){
    $sql = "SELECT usuario.usuario AS usu, empresa.estatus AS es_em, usuario.estatus AS es_us FROM usuario INNER JOIN empresa ON usuario.usuario=empresa.id_usuario"
            . " WHERE usuario.usuario='$id' AND usuario.contrasena='$pass' AND usuario.id_rol=3";
    
    $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
        if(pg_num_rows($consulta)>0){
            while($fila = pg_fetch_array($consulta)){
                if($fila['es_em'] == 1){
                    if($fila['es_us'] == 1){
                        $respuestaJson['success'] = 1;
                        $respuestaJson['message'] = "EXITO";
                        $respuestaJson['idusuario'] = utf8_encode($fila['usu']);
//                      $respuestaJson['nombre'] = utf8_encode($fila['nombre']);
//                      $respuestaJson['correo'] = utf8_encode($fila['correo']);
                    }else{
                        $respuestaJson["success"] = 2;
                        $respuestaJson["message"] = "Usuario Inactivo";
                    }
                }else{
                    $respuestaJson["success"] = 2;
                    $respuestaJson["message"] = "Empresa Inactiva";
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
pg_close($conexion_bd); //Cerramos la conexion a la base de datos