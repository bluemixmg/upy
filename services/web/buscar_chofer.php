<?php

$cedula = filter_var($_POST['nombre'], FILTER_SANITIZE_NUMBER_INT);

if(!empty($cedula)){
    buscar_chofer($cedula);
}

function buscar_chofer($cedula){
    require ('conexion.php');
    $sql = "SELECT chofer.*,vehiculo.* FROM chofer "
         . "INNER JOIN vehiculo ON vehiculo.id_chofer = chofer.id_cedula "
         . "WHERE chofer.id_cedula='$cedula'";
    $consultar = pg_fetch_all(pg_query($conexion_bd, $sql));

    if(pg_num_rows($consultar) == 0){
        echo "No se han encontrado resultados para '<b>".$nombre."</b>'.";
    }else{
        while($row= pg_fetch_array($consultar)){
            //Chofer
            $cedula = $row['id_cedula'];
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $sexo = $row['sexo'];
            $telefono = $row['telefono'];
            $correo = $row['correo'];
            $direccion = $row['direccion'];
            $estatus = $row['estatus'];
            //Vehiculo
            $placa = $row['placa'];
            $marca = $row['marca'];
            $modelo = $row['modelo'];
            $tipo_vehiculo = $row['id_tipo_vehiculo'];
            $condicion = $row['id_condicion'];
            ?>
            <form name="frmActualizarEmpleado" method="POST">
                <input type="hidden" id="cedoculto_chofer" value="<?php echo $cedula; ?>">
                <div style="text-align: right">
                    <?php
                    if($estatus==1){
                        echo '<label><input type="checkbox" id="habilitado_editar_chofer" value="3" style="align">Inhabilitado</label><br>';
                    }else{
                        echo '<label><input type="checkbox" id="habilitado_editar_chofer" value="3" style="align" checked>Inhabilitado</label><br>';
                    }
                    ?>
                </div>
                Cédula: <input type="text" id="txtcedula_chofer_editar" name="txtcedula_chofer" value="<?php echo $cedula; ?>"><br>
                Nombre: <input type="text" id="txtnombre_chofer_editar" name="txtnombre_chofer" value="<?php echo utf8_encode($nombre); ?>"><br>
                Apellido: <input type="text" id="txtapellido_chofer_editar" name="txtapellido_chofer" value="<?php echo utf8_encode($apellido); ?>"><br>
                Sexo: <?php
                        echo '<select id="combosexo_chofer_editar" class="form-control">';
                        if($sexo=='M'){
                            echo '<option id="M" value="M" selected>Masculino</option>
                                <option id="F" value="F">Femenino</option>';
                        }else{
                            echo '<option id="F" value="F" selected>Femenino</option>
                                <option id="M" value="M">Masculino</option>';
                        }
                        echo '</select>';
                ?><br>
                Telefono:<input type="text" id="txttelefono_chofer_editar" value="<?php echo $telefono; ?>"><br>
                Correo:<input type="text" id="txtcorreo_chofer_editar" value="<?php echo $correo; ?>"><br>
                Direccion:<textarea id="txtdireccion_chofer_editar"><?php echo $direccion; ?></textarea><br>
                
                Datos del Vehiculo<br><br>
                
                <input type="hidden" id="placavieja" value="<?php echo $placa; ?>">
                Placa: <input type="text" id="txtplaca_editar" value="<?php echo $placa; ?>"><br>
                Marca: <input type="text" id="txtmarca_editar" value="<?php echo $marca; ?>"><br>
                Modelo: <input type="text" id="txtmodelo_editar" value="<?php echo $modelo; ?>"><br>
                <div class="contact-top">
                <i>Tipo:</i>
                <?php
                $sql = "SELECT * FROM tipo_vehiculo ORDER BY nro_puestos ASC";
                $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
                if (pg_num_rows($consulta)>0){
                    echo '<select id="tipo_ve_editar" style="height: 32px;">';
                    foreach ($consulta as $c){
                        if($tipo_vehiculo == $c['id']){
                        echo '<option id="'.$c['id'].'" value="'.$c['id'].'" selected>'.$c['nombre'].' ('.$c['nro_puestos'].') puestos</option>';
                        }else{
                        echo '<option id="'.$c['id'].'" value="'.$c['id'].'">'.$c['nombre'].' ('.$c['nro_puestos'].') puestos</option>';
                        }
                    }
                    echo '</select>';
                }else{
                    echo 'No hay tipos registrados';
                }
                $sql1 = 'SELECT * FROM condicion';
                $consulta1 = pg_fetch_all(pg_query($conexion_bd, $sql1));
                if (pg_num_rows($consulta1)>0){
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Condiciones del Vehiculo: </i>';
                    echo '<select id="cond_ve_editar">';
                    foreach ($consulta1 as $c1){
                        if($condicion == $c1['id']){
                            echo '<option id="'.$c1['id'].'" value="'.$c1['id'].'" selected>'.$c1['descripcion'].'</option>';
                        }else{
                            echo '<option id="'.$c1['id'].'" value="'.$c1['id'].'">'.$c1['descripcion'].'</option>';
                        }
                    }
                    echo '</select>';
                }else{
                    echo 'No hay condiciones registradas';
                }
                ?>
                <br>
                </div>
                <div class="contact-top">
                    <input type="submit" onclick="actualizar_Chofer();return false;" value="Actualizar Datos">
                    <div id="actualizar_chofer"></div>
                </div>
            </form>

            <?php
        }
    }
    pg_close($conexion_bd);
}