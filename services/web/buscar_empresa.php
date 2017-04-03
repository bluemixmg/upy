<?php

$buscar = filter_var($_POST['b'], FILTER_SANITIZE_MAGIC_QUOTES);
       
    if(!empty($buscar)) {
        buscar($buscar);
    }

    function buscar($b) {
        require('conexion.php');
        $sql = "SELECT * FROM empresa WHERE rif='$b' OR nombre='$b' AND estatus=1";
        $consultar = pg_query($conexion_bd, $sql);
        
        if(pg_num_rows($consultar) == 0){
            echo "No se han encontrado resultados para '<b>".$b."</b>'.";
        }else{
            while($row=pg_fetch_array($consultar)){
                $rif = $row['rif'];
                $nombre = $row['nombre'];
                $telefono = $row['telefono'];
                $direccion = $row['direccion'];
                $correo = $row['correo'];
                $lat = $row['latitud'];
                $lon = $row['longitud'];
                $estatus = $row['estatus'];
                ?>
                <form name="frmActualizar" method="POST">
                    <div style="text-align: right">
                        <?php
                        if($estatus==1){
                            echo '<label><input type="checkbox" id="habilitado_editar_empresa" value="0" style="align">Inhabilitado</label><br>';
                        }else{
                            echo '<label><input type="checkbox" id="habilitado_editar_empresa" value="0" style="align" checked>Inhabilitado</label><br>';
                        }
                        ?>
                    </div>
                    <input type="hidden" id="rifoculto_eemp" name="rifoculto" value="<?php echo $rif; ?>">
                    Rif: <input type="text" id="txtrif_eemp" name="txtrif" value="<?php echo $rif; ?>">
                    Nombre: <input type="text" id="txtnombre_eemp" name="txtnombre" value="<?php echo $nombre; ?>"><br>
                    Direccion:<textarea id="txtdireccion_eemp" name="txtdireccion"><?php echo $direccion; ?></textarea><br>
                    <input class="text-center" id="btn_cargarMapaEmpresa" type="submit" onclick="initMap5();return false;" value="Cargar Mapa">
                    <div  id="mapa_edit_empresa" style="height:600px; width:600px; top: 10px;"></div><br><br>
                    Correo: <input type="text" id="txtcorreo_eemp" name="txtcorreo" value="<?php echo $correo; ?>"><br>
                    Telefono:<input type="text" id="txttelefono_eemp" name="txttelefono" value="<?php echo $telefono; ?>"><br>
                    <input type="hidden" id="lat_edit_empresa" name="lat_edit_empre" value="<?php echo floatval($lat); ?>">
                    <input type="hidden" id="lng_edit_empresa" name="lon_edit_empre" value="<?php echo floatval($lon); ?>">
                    <input type="hidden" id="lat_edit_empresa_viejo" value="<?php echo $lat; ?>">
                    <input type="hidden" id="lng_edit_empresa_viejo" value="<?php echo $lon; ?>">
                    <input class="text-center" type="submit" onclick="actualizar();return false;" value="Actualizar Datos">
                    <br>
                    <div class="text-center" id="actualizar"></div>
                </form>
 

                <script>
                    function actualizar(){
                        var estatus = $('input:checkbox[id^="habilitado_editar_empresa"]:checked').map(function(){return this.value}).get();
                        var txtrif = document.getElementById("rifoculto_eemp").value;
                        var txtrifnuevo = document.getElementById("txtrif_eemp").value;
                        var txtnombre = document.getElementById("txtnombre_eemp").value;
                        var txttelefono = document.getElementById("txttelefono_eemp").value;
                        var txtcorreo = document.getElementById("txtcorreo_eemp").value;
                        var txtdireccion = document.getElementById("txtdireccion_eemp").value;
                        var txtlatitud = document.getElementById("lat_edit_empresa").value;
                        var txtlongitud = document.getElementById("lng_edit_empresa").value;
                        var txtlatitud_vi = document.getElementById("lat_edit_empresa_viejo").value;
                        var txtlongitud_vi = document.getElementById("lng_edit_empresa_viejo").value;
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            rif:txtrif,
                            rifnuevo:txtrifnuevo,
                            nombre:txtnombre,
                            tlf:txttelefono,
                            correo:txtcorreo,
                            direccion:txtdireccion,
                            latitud:txtlatitud,
                            longitud:txtlongitud,
                            latitud_vi:txtlatitud_vi,
                            longitud_vi:txtlongitud_vi,
                            estatus:estatus
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("actualizar").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/actualizar_empresa.php", true); //abrimos la conexion, definimos tipo, url y AJAX=true
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //cabecera para el metodo POST
                        xhttp.send(param);
                    }
                </script>
                
                <script>
                    var map5;
                    var lat1 = parseFloat(document.getElementById('lat_edit_empresa').value);
                    var lon1 = parseFloat(document.getElementById('lng_edit_empresa').value);
                    function initMap5() {
                        map5 = new google.maps.Map(document.getElementById('mapa_edit_empresa'), {
                            center: {lat: lat1, lng: lon1},
                            zoom: 15
                        });
                        var marker = new google.maps.Marker({
                            position: {lat: lat1, lng: lon1},
                            map: map5,
                            draggable: true
                          });
                        google.maps.event.addListener(marker, "dragend", function() {
                        document.getElementById('lat_edit_empresa').value = marker.getPosition().lat();
                        document.getElementById('lng_edit_empresa').value = marker.getPosition().lng();
                      });
                      document.getElementById('lat_edit_empresa').value = marker.getPosition().lat();
                      document.getElementById('lng_edit_empresa').value = marker.getPosition().lng();
                    }
                </script>
                <?php
            }
        }
    }
