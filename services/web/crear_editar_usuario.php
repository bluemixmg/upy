<?php
require_once './conexion.php';
if($_POST['tipo']==1){
    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $rif = $_POST['rif'];
    $rol = $_POST['rol'];
    if($id!='' && $pass!=''){
        
        $con = new Conexion();
        $sql = "SELECT * FROM usuario WHERE usuario='$id'";
        $consulta = $con->consultar( $sql);
        
        if($con->num_filas($consulta)==0){
            $pass1 = md5($pass);
            $sql = "INSERT INTO usuario (usuario,contrasena,id_rol,rif_empresa) VALUES ('$id','$pass1','$rol','$rif')";
            $con->consultar( $sql);
            $con->cerrar_conexion();
            echo '<p>Usuario creado con éxito</p>';
        }else{
            echo '<p>ID de usuario en uso</p>';
        }
    }else{
        echo '<p>Faltan datos</p>';
    }
}elseif($_POST['tipo']==2){
    $id_viejo = $_POST['id_viejo'];
    $id = $_POST['id'];
    if(strlen($_POST['pass'])==32){
        $pass = $_POST['pass'];
    }else{
        $pass = md5($_POST['pass']);
    }
    $rif = $_POST['rif'];
    $rol = $_POST['rol'];
    if($id!='' && $pass!=''){
        $con = new Conexion();
        $sql = "UPDATE usuario SET usuario='".$id."', contrasena='".$pass."', id_rol=".$rol.", rif_empresa='".$rif."' WHERE usuario='".$id_viejo."'";
        $con->consultar( $sql);
        $con->cerrar_conexion();
        echo '<p>Usuario editado con éxito</p>';
    }else{
        echo '<p>Faltan datos</p>';
    }
}