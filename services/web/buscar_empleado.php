<?php

$n = $_POST['nombre'];

if(!empty($n)){
    buscar_empleado($n);
}

function buscar_empleado($nombre){
    require ('conexion.php');$con = new Conexion();
    $sql = "SELECT * FROM cliente WHERE cedula='$nombre' OR nombre='$nombre' OR apellido='$nombre'";
    $consultar = $con->consultar( $sql);

    if($con->num_filas($consultar) == 0){
        echo "No se han encontrado resultados para '<b>".$nombre."</b>'.";
    }else{
        while($row= pg_fetch_array($consultar)){
            $cedula = $row['cedula'];
            $nombre = $row['nombre'];
            $apellido = $row['apellido'];
            $email = $row['correo'];
            $sexo = $row['sexo'];
            $telefono = $row['telefono'];
            $direccion = $row['direccion'];
            $latitud = $row['latitud'];
            $longitud = $row['longitud'];
            $estatus = $row['estatus'];
            $empresa = $row['rif_empresa'];
            ?>
            <form name="frmActualizarEmpleado" method="POST">
                <input type="hidden" id="cedoculto_eemple" name="cedoculto" value="<?php echo $cedula; ?>">
                <div style="text-align: right">
                    <?php
                    if($estatus==1){
                        echo '<label><input type="checkbox" id="habilitado_editar_empleado" value="0" style="align">Inhabilitado</label><br>';
                    }else{
                        echo '<label><input type="checkbox" id="habilitado_editar_empleado" value="0" style="align" checked>Inhabilitado</label><br>';
                    }
                    ?>
                </div>
                Cédula: <input type="text" id="txtcedula_eemple" name="txtcedula_emple" value="<?php echo $cedula; ?>"><br>
                Nombre: <input type="text" id="txtnombre_eemple" name="txtnombre_emple" value="<?php echo utf8_encode($nombre); ?>"><br>
                Apellido: <input type="text" id="txtapellido_eemple" name="txtapellido_emple" value="<?php echo utf8_encode($apellido); ?>"><br>
                Email: <input type="text" id="txtcorreo_eemple" name="txtcorreo_emple" value="<?php echo $email; ?>"><br>
                Sexo: <?php
                        echo '<select id="combosexo_eemple" class="form-control">';
                        if($sexo=='M'){
                            echo '<option id="M" value="M" selected>Masculino</option>
                                <option id="F" value="F">Femenino</option>';
                        }else{
                            echo '<option id="F" value="F" selected>Femenino</option>
                                <option id="M" value="M">Masculino</option>';
                        }
                        echo '</select>';
                ?><br>
                Telefono:<input type="text" id="txttelefono_eemple" name="txttelefono_emple" value="<?php echo $telefono; ?>"><br>
                Direccion:<textarea id="txtdireccion_eemple" name="txtdireccion_emple"><?php echo $direccion; ?></textarea><br>
                <div class="contact-top">
                <input id="btn_cargarMapa_emp" type="submit" onclick="initMap2();return false;" value="Cargar Mapa"><p><strong>Por favor, cargue el mapa</strong></p>
                <input type="submit" onclick="codeAddress_editar_empleado();return false;" value="Actualizar Mapa">
                <div  id="mapa_editar_emple" style="height:600px; width:600px; top: 10px;"></div><br><br>
                <input type="hidden" id="lat_eemp" name="lat_eemp" value="<?php echo floatval($latitud); ?>">
                <input type="hidden" id="lng_eemp" name="lng_eemp" value="<?php echo floatval($longitud); ?>">
                
                <table class="table" id="tabla_editar_empleado" border="1">
                    <tr>
                        <td>Origen</td>
                        <td>Destino</td>
                        <td>Hora</td>
                        <td>Accion</td>
                    </tr>
                    <?php
                        $sql = "SELECT id,lat_o,hora FROM parada WHERE id_cliente='$cedula'";
                        $consulta_paradas = $con->consultar( $sql);
                        if($con->num_filas($consulta_paradas)>0){
                            $sql_empresa = "SELECT latitud FROM empresa WHERE rif='$empresa'";
                            $consulta_empresa = $con->consultar( $sql_empresa);
                            foreach ($consulta_empresa as $ce){
                                $lat_empresa = $ce['latitud'];
                            }

                            foreach ($consulta_paradas as $cp){
                                echo '<tr id="'.$cp['id'].'">';
                                
                                if($lat_empresa == $cp['lat_o']){
                                    echo '<td>empresa</td>';
                                    echo '<td>parada</td>';
                                }else{
                                    echo '<td>parada</td>';
                                    echo '<td>empresa</td>';
                                }
                                echo '<td>'.$cp['hora'].'</td>';
                                echo '<td><button type="submit" onclick="delete_row_editar_empleado(this);return false;" value="Eliminar"><img src="images/delete1.ico" alt="Eliminar" width="15"></button></td>';
                                echo '</tr>';
                            }
                        }else{
                            echo 'No hay paradas asignadas';
                        }
                    ?>
                </table>
                <br>
                
                
                    <h3 style="align-content: center;">Dirección y hora de transporte</h3><br>
                    <select id="origen_editar" name="origen_editar">
                        <option value="empresa">Empresa</option>
                        <option value="parada">Parada</option>
                    </select>
                    <select id="destino_editar" name="destino_editar">
                        <option value="empresa">Empresa</option>
                        <option value="parada" selected>Parada</option>
                    </select>
                    <input id="hora_editar" name="hora" style="width: 80px;">
                    <select id="am_editar" name="am_editar">
                        <option value="am">a.m.</option>
                        <option value="pm" selected>p.m.</option>
                    </select><br><br>

                    <input type="submit" onclick="agregar_parada_editar_empleado();return false;" value="Agregar Parada"> &nbsp;&nbsp;&nbsp;
                    <input type="submit" onclick="actualizarEmpleado();return false;" value="Actualizar Datos">
                    <br>
                    <div id="actualizar_empleado"></div>
                </div>
            </form>

            <?php
        }
    }
}