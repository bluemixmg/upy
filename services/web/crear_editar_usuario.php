<?php

if($_POST['tipo']==1){
    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $rif = $_POST['rif'];
    $rol = $_POST['rol'];
    if($id!='' && $pass!=''){
        require_once './conexion.php';
        $sql = "SELECT * FROM usuario WHERE usuario='$id'";
        $consulta = pg_query($conexion_bd, $sql);
        
        if(pg_num_rows($consulta)==0){
            $pass1 = md5($pass);
            $sql = "INSERT INTO usuario (usuario,contrasena,id_rol,rif_empresa) VALUES ('$id','$pass1','$rol','$rif')";
            pg_query($conexion_bd, $sql);
            pg_close($conexion_bd);
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
        require_once './conexion.php';
        $sql = "UPDATE usuario SET usuario='".$id."', contrasena='".$pass."', id_rol=".$rol.", rif_empresa='".$rif."' WHERE usuario='".$id_viejo."'";
        pg_query($conexion_bd, $sql);
        pg_close($conexion_bd);
        echo '<p>Usuario editado con éxito</p>';
    }else{
        echo '<p>Faltan datos</p>';
    }
}