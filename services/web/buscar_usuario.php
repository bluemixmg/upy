<?php

$id = $_POST['id'];

if($id!=''){
    require_once './conexion.php';
    $sql = "SELECT * FROM usuario WHERE usuario='$id'";
    $consulta_usuario = mysqli_query($conexion_bd, $sql);
    foreach ($consulta_usuario as $cu){
        ?>
        <form class="contact-bottom text-center col-md-8">
            <input type="hidden" id="id_usuario_editar_viejo" value="<?php echo $cu['usuario']; ?>">
            <input type="text" placeholder="Usuario" id="id_usuario_editar" value="<?php echo $cu['usuario']; ?>">
            <input type="password" placeholder="Password" id="pass_usuario_editar" value="<?php echo $cu['contrasena']; ?>">
            <p class="text-left">Empresa:</p>
            <?php
            $sql = "SELECT rif,nombre FROM empresa";
            $consulta = mysqli_query($conexion_bd, $sql);
            echo '<select class="form-control" id="select_empresa_editar_usuario">';
            foreach ($consulta as $c){
                if ($c['rif']!='V-19850475-'){
                    if ($cu['rif_empresa']==$c['rif']){
                        echo '<option value="'.$c['rif'].'" selected>'.$c['nombre'].'</option>';
                    }else{
                        echo '<option value="'.$c['rif'].'">'.$c['nombre'].'</option>';
                    }
                }
            }
            echo '</select>';
            $sql = "SELECT * FROM rol";
            $consulta = mysqli_query($conexion_bd, $sql);
            echo '<p class="text-left">Rol:</p>';
            echo '<select class="form-control" id="select_rol_editar_usuario">';
            foreach ($consulta as $c){
                if ($c['id']!=1){
                    if($cu['id_rol']==$c['id']){
                        echo '<option value="'.$c['id'].'" selected>'.$c['nombre'].'</option>';
                    }else{
                        echo '<option value="'.$c['id'].'">'.$c['nombre'].'</option>';
                    }
                }
            }
            echo '</select><br><br>';
            ?>
            <input type="submit" value="Editar" id="editar_usuario" onclick="editar_usuario_script();return false;">
            <div id="resultado_editar_usuarios"></div>
        </form>
        <?php
    }
    mysqli_close($conexion_bd);
}else{
    echo 'Favor ingrese un ID de usuario válido';
}