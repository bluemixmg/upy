<html>
	<head>
		<meta charset="UTF-8">
		<title>UPY3 | Panel de Control</title>
		<link rel="icon" type="image/png" href="images/ic_launcher.png" />
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all" />
		<link href="css/sweetalert.css" rel="stylesheet" type="text/css" media="all" />
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-2.2.3.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/sweetalert.min.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<!--Google Maps API-->
		<link href="https://developers.google.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">
		<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE4fAGTBDgY6vgq0E9qK38YuYdzbWrGY8&sensor=false&libraries=places"></script> -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMTKQ5URavAIb-eyoJMThd_W8PRHOewjc&sensor=false&libraries=places"></script>
		<script src="js/locationpicker.jquery.js"></script>
		<!-- Custom Theme files -->
		<!--timedropper jQuery plugin-->
		<script src="js/timedropper.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/timedropper.min.css">
		<!--theme-style-->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"/>
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<style type="text/css">
			.header{
			    background-size: 100%;
			    min-height: 320px;
			}
			.contact-bottom input[type="text"] ,.contact-bottom textarea{
			    width: 100%;
			    color: black;
			}
			.contact-bottom input[type="password"] ,.contact-bottom textarea{
			    width: 100%;
			}
			.suggest-element{
			margin-left:5px;
			margin-top:5px;
			width:350px;
			cursor:pointer;
			}
			#suggestions {
			width:350px;
			height:150px;
			overflow: auto;
			}
			#map * {
			    overflow:visible;
			}
		</style>
		<!--//theme-style-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Responsive web template, Service Logic, UPY, UPY3, Servicios de transporte, transporte, transporte de personal, transporte para
		estudiantes, transporte Venezuela, Caracas, Barquisimeto, Valencia, web design, Android" />
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="application/x-javascript"> 
			addEventListener("load", function() { 
				setTimeout(hideURLbar, 0);
			}, false); 
			function hideURLbar(){ 
				window.scrollTo(0,1); 
			} 
		</script>
		<script>
		    var geocoder1;
		    var map1;
		    var mapOptions1 = {
		        zoom: 14,
		        //center: new google.maps.LatLng(10.09785571410395, -69.3480375455078),
		        mapTypeId: google.maps.MapTypeId.ROADMAP
		      }
		    var marker1;
		    function initialize_emp() {
		        geocoder1 = new google.maps.Geocoder();
		        map1 = new google.maps.Map(document.getElementById('mapa_remple'), mapOptions1);
		        codeAddress_emp();
		        google.maps.event.addListener(map1, "idle", function()
		        {
		            google.maps.event.trigger(map1, 'resize');
		        });

		        map1.setZoom( map1.getZoom() - 1 );
		        map1.setZoom( map1.getZoom() + 1 );
		    }
		    function codeAddress_emp() {
		      var address1 = document.getElementById('direccion_remple').value;
		      geocoder1.geocode( { 'address': address1}, function(results1, status1) {
		        if (status1 == google.maps.GeocoderStatus.OK) {
		          map1.setCenter(results1[0].geometry.location);
		          if(marker1)
		            marker1.setMap(null);
		          marker1 = new google.maps.Marker({
		              map: map1,
		              position: results1[0].geometry.location,
		              draggable: true
		          });
		          google.maps.event.addListener(marker1, "dragend", function() {
		            document.getElementById('lat_emp').value = marker1.getPosition().lat();
		            document.getElementById('lng_emp').value = marker1.getPosition().lng();
		          });
		          document.getElementById('lat_emp').value = marker1.getPosition().lat();
		          document.getElementById('lng_emp').value = marker1.getPosition().lng();
		        } else {
		          alert('Geocode no pudo ejecutarse por el siguiente motivo: ' + status1);
		        }
		      });
		    }
		    function codeAddress_editar_empleado() {
		      geocoder1 = new google.maps.Geocoder();
		      map1 = new google.maps.Map(document.getElementById('mapa_editar_emple'), mapOptions1);
		      var address1 = document.getElementById('txtdireccion_eemple').value;
		      geocoder1.geocode( { 'address': address1}, function(results1, status1) {
		        if (status1 == google.maps.GeocoderStatus.OK) {
		          map1.setCenter(results1[0].geometry.location);
		          if(marker1)
		            marker1.setMap(null);
		          marker1 = new google.maps.Marker({
		              map: map1,
		              position: results1[0].geometry.location,
		              draggable: true
		          });
		          google.maps.event.addListener(marker1, "dragend", function() {
		            document.getElementById('lat_eemp').value = marker1.getPosition().lat();
		            document.getElementById('lng_eemp').value = marker1.getPosition().lng();
		          });
		          document.getElementById('lat_eemp').value = marker1.getPosition().lat();
		          document.getElementById('lng_eemp').value = marker1.getPosition().lng();
		        } else {
		          alert('Geocode no pudo ejecutarse por el siguiente motivo: ' + status1);
		        }
		      });
		    }
		</script>
		<script>
		    function iniciar_Mapas(){
		        <?php
		            echo 'initialize();';
		            echo 'initialize_emp();';	
		        ?>
		    }
		</script>
	</head>
	<body onload="iniciar_Mapas()">

	    <?php
	        include('navbar.php');
	    ?>
	    
	    <!--TABS-->
	    <div class="container">
	        <ul class="nav nav-tabs">           
	            <?php
	                echo '<li><a data-toggle="tab" href="#empre">Empresa</a></li>';
	                echo '<li><a data-toggle="tab" href="#empleados">Empleados</a></li>';
	                echo '<li><a data-toggle="tab" href="#tra">Orden de Servicio</a></li>';
	            ?>
	        </ul>
	    </div>
	    
	    <!--TABS'S CONTENT-->
	    <br>
	    <div class="tab-content">
	        
	        <!--EMPRESA-->
	        <div id="empre" class="tab-pane fade">
	            <div class="container">
	            	<div class="panel panel-primary">
					  <div class="panel-heading"><h3>Empresa: <i>Nombre de Empresa</i></h3></div>
					  <div class="panel-body">
					    <div> 
	                        <!--Menu Izquierdo-->
	                        <div class="col-md-3">
	                            <ul class="nav nav-pills nav-stacked">
	                                <li><a data-toggle="pill" href="#empresa_datos_basicos">Datos Básicos</a></li>
	                                <li><a data-toggle="pill" href="#empresa_ubicaciones">Ubicaciones</a></li>
	                            </ul>
	                        </div>
	                        <div class="col-md-9">
		                        <!--//Menu Izquierdo-->
		                        <div class="tab-content">
		                            <!--TAB DATOS BASICOS-->
		                            <div id="empresa_datos_basicos" class="tab-pane fade">
		                            	<div class="panel panel-info">
										  <!-- Default panel contents -->
										  <div class="panel-heading">Datos Básicos</div>
										  <div class="panel-body">
										    <form class="form-horizontal" id="form-datos-empresa">
											  <div class="form-group">
											    <label for="inputRif" class="col-sm-2 control-label">Rif</label>
											    <div class="col-sm-9">
											      <input class="form-control" id="inputRif" placeholder="Rif" value="J-21421023-3">
											    </div>
											  </div>
											  <div class="form-group">
											    <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>
											    <div class="col-sm-9">
											      <input class="form-control" id="inputNombre" placeholder="Nombre" value="Nombre de la Empresa">
											    </div>
											  </div>
											  <div class="form-group">
											    <label for="inputTelefono" class="col-sm-2 control-label">Teléfono</label>
											    <div class="col-sm-9">
											      <input type="tel" class="form-control" id="inputTelefono" placeholder="Teléfono" value="582512345434">
											    </div>
											  </div>
											  <div class="form-group">
											    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
											    <div class="col-sm-9">
											      <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="miempresa@miempresa.com">
											    </div>
											  </div>
											  <div class="form-group">
											    <div class="col-sm-offset-5 col-sm-2">
											      <button type="button" onclick="actualizarDatosEmpresa();" class="btn btn-primary">Actualizar</button>
											    </div>
											  </div>
											</form>
										  </div>
										</div>
		                            </div>
		                            
		                            
		                            <!--TAB UBICACIONES-->
		                            <div id="empresa_ubicaciones" class="tab-pane fade">
		                            	<div class="panel panel-info">
										  <!-- Default panel contents -->
										  <div class="panel-heading">Ubicaciones</div>
										  <div class="panel-body">
										  	<div class="container-fluid">
										  		<div class="col-sm-3">
										  			<div class="list-group" id="listado_ubicaciones">
													  <button onclick="actualizarMapa(this)" type="button" class="list-group-item active" data-lat="10.073107" data-lon="-69.293147" data-tel="0251-2515642" data-nom="Sambil"><span class="badge"><span class="glyphicon glyphicon-chevron-right"></span></span>Sambil</button>
													  <button onclick="actualizarMapa(this)" type="button" class="list-group-item" data-lat="10.079480" data-lon="-69.281268" data-tel="0251-2515523" data-nom="Las Trinitarias"><span class="badge"><span class="glyphicon glyphicon-chevron-right"></span></span>Las Trinitarias</button>
													  <button onclick="actualizarMapa(this)" type="button" class="list-group-item" data-lat="10.062538" data-lon="-69.364611" data-tel="0251-2456642" data-nom="Metrópolis"><span class="badge"><span class="glyphicon glyphicon-chevron-right"></span></span>Metrópolis</button>
													  <button onclick="registrarUbicacion(this)" type="button" class="list-group-item" data-lat="10.062538" data-lon="-69.364611" data-tel=""><span class="badge"><span class="glyphicon glyphicon-plus"></span></span>Agregar Ubicación</button>
													</div>
										  		</div>
										  		<div class="col-sm-9">
										  			<div class="input-group input-group-lg">
													  	<span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-home"></span></span>
													  	<input type="text" id="us2-nombre" class="form-control" placeholder="Nombre de la Sucursal" aria-describedby="sizing-addon3"/>												
													</div>
													<br>
										  			<div class="input-group input-group-lg">
													  	<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-earphone"></span></span>
													  	<input type="text" id="us2-telefono" class="form-control" placeholder="Teléfono" aria-describedby="sizing-addon2"/>												
													</div>
													<br>
										  			<div class="input-group input-group-lg">
													  	<span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-map-marker"></span></span>
													  	<input type="text" id="us2-address" class="form-control" placeholder="Username" aria-describedby="sizing-addon1"/>
														<input type="hidden" id="us2-lat"/>
														<input type="hidden" id="us2-lon"/>														
													</div>
													
													<div id="mapa-ubicaciones" style="height:400px; width: 100%;visibility: hidden;display:block;">
									  				
									  				</div>
													
										  			
										  			<div class="">
										  				<div style="text-align: center;">
										  					<button class="btn btn-primary" onclick="actualizarUbicacion();">Actualizar Ubicación</button>
										  					<button class="btn btn-danger" onclick="eliminarUbicacion();">Eliminar Ubicación</button>
										  				</div>
										  			</div>
										  			<script>
													    $('#mapa-ubicaciones').locationpicker({
													        location: {
													            latitude: 46.15242437752303,
													            longitude: 2.7470703125
													        },
													        radius: 100,
													        inputBinding: {
													            latitudeInput: $('#us2-lat'),
													            longitudeInput: $('#us2-lon'),
													            locationNameInput: $('#us2-address')
													        },	
													        enableAutocomplete: true,
													        markerInCenter: true,
													        addressFormat: 'street_name'
													    });
													</script>
										  		</div>
										  	</div>
										  </div>
										</div>

		                            </div>
		                        </div>	                        	
	                        </div>

	                	</div>
					  </div>
					</div>
	                
	                
	            </div>
	        </div>
	        <!--EMPLEADOS-->
	        <div id="empleados" class="tab-pane fade">
	            <div class="container">
	                <!--Menu Izquierdo-->
	                <div class="col-md-3">
	                    <ul class="nav nav-pills nav-stacked">
	                        <li><a data-toggle="pill" href="#registrar">Registrar</a></li>
	                        <li><a data-toggle="pill" href="#archivo">Subir archivo</a></li>
	                        <li><a data-toggle="pill" href="#editar">Editar</a></li>
	                        <li><a data-toggle="pill" href="#eliminar"></a></li>
	                    </ul>
	                </div>
	                <!--//Menu Izquierdo-->
	                <div class="tab-content">
	                    <!--TAB REGISTRAR-->
	                    <div id="registrar" class="tab-pane fade">
	                        <h3>Registrar</h3>
	                        <p>Ingresar Empleados</p>
	                        <div class="contact col-lg-6">
	                            <div class="contact-top">
	                                <div class="contact-bottom">
	                                    <form name="frmRegistro" method="POST">
	                                        <input type="hidden" value="<?php echo $_SESSION['rif'] ?>" id="rif_remple">
	                                        <input type="text" value="Cédula" id="cedula_remple" onfocus="if(this.value=='Cédula') this.value='';" onblur="if (this.value == '') {this.value = 'Cédula';}">
	                                        <input type="text" value="Nombre" id="nombre_remple" onfocus="if(this.value=='Nombre') this.value='';" onblur="if (this.value == '') {this.value = 'Nombre';}">	
	                                        <input type="text" value="Apellido" id="apellido_remple" onfocus="if(this.value=='Apellido') this.value='';" onblur="if (this.value == '') {this.value = 'Apellido';}">
	                                        <input type="text" value="Email" id="email_remple" onfocus="if(this.value=='Email') this.value='';" onblur="if (this.value == '') {this.value = 'Email';}">
	                                        <select id="sexo_remple" class="form-control">
	                                            <option selected="true" disabled="">Sexo:</option>
	                                            <option id="M" value="M">Masculino</option>
	                                            <option id="F" value="F">Femenino</option>
	                                        </select>
	                                        <input type="text" value="Teléfono" id="telefono_remple" onfocus="if(this.value=='Teléfono') this.value='';" onblur="if (this.value == '') {this.value = 'Teléfono';}">
	                                        <textarea id="direccion_remple" onfocus="if(this.value=='Direcci&oacute;n') this.value='';" onblur="if(this.value == '') {this.value = 'Direcci&oacute;n';}" >Barquisimeto</textarea>
	                                        <input type="submit" onclick="codeAddress_emp();return false;" value="Actualizar Mapa">
	                                        <div id="mapa_remple" style="height:600px; width:600px; top: 10px;"></div><br>
	                                        <input type="hidden" id="lat_emp" name="lat_emp">
	                                        <input type="hidden" id="lng_emp" name="lng_emp">
	                                        <h3 style="align-content: center;">Dirección y hora de transporte</h3><br>
	                                        <select id="origen" name="origen">
	                                            <option value="empresa">Empresa</option>
	                                            <option value="parada">Parada</option>
	                                        </select>
	                                        <select id="destino" name="destino">
	                                            <option value="empresa">Empresa</option>
	                                            <option value="parada" selected>Parada</option>
	                                        </select>
	                                        <input id="hora" name="hora" style="width: 70px;">
	                                        <input type="submit" value="Agregar" onclick="genera_tabla();return false;"><br><br>
	                                        <div id="tabla_rutas"></div><br><br>
	                                        <input type="submit" value="Registrar" onclick="registrar_empleado();return false;"><br>
	                                        <div id="registro_empleado"></div>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

	                    <script>
	                        $("#hora").timeDropper({
	                            format:'hh:mm a',
	                            meridians:true,
	                            mousewheel:true
	                        });
	                    </script>
	                    
	                   
	                    
	                    <!--TAB ARCHIVO-->
	                    <div id="archivo" class="tab-pane fade">
	                        <h3>Subir Archivo</h3>
	                        <p>Suba un archivo con el siguiente <a href="upy3.xlsx">esquema</a> con el formato .csv (Delimitado por comas)</p><br>
	                        <div class="input-group">
	                            <form name="frmArchivo" method="POST" enctype="multipart/form-data" >
	                                <input type="file" class="form-control" placeholder="Archivo.csv" id="file" name="file">
	                                <span class="input-group-btn">
	                                    <button class="btn btn-default" onclick="archivo();return false;">
	                                        <i style="color: #337ab7" class="glyphicon glyphicon-arrow-up"></i>
	                                    </button>
	                                </span>
	                            </form>
	                        </div>
	                        <div id="resultado_archivo"></div>
	                    </div>
	                    

	                    
	                    <!--TAB EDITAR-->
	                    <div id="editar" class="tab-pane fade">
	                        <h3>Editar</h3>
	                        <p>Editar características de un empleado</p>
	                        <div class="input-group">
	                            <form name="frmEditar" method="POST" style="width: 500px;">
	                                <input type="text" class="form-control" placeholder="Buscar" id="txteditar_empleado">
	                                <span class="input-group-btn">
	                                    <button class="btn btn-default" onclick="buscar_empleado();return false;">
	                                        <i style="color: #337ab7" class="glyphicon glyphicon-search"></i>
	                                    </button>
	                                </span>
	                            </form>
	                        </div>
	                        <div id="resultadoBusquedaEmpleado" class="contact contact-bottom col-lg-6"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        
	        <!--ORDEN DE SERVICIO-->
	        <div id="tra" class="tab-pane fade">
	            <div class="container">
	                <div class="tab-content">
	                    <div class="col-md-3">
	                        <ul class="nav nav-pills nav-stacked">
	                            <li><a data-toggle="pill" href="#eleccion">Generar Orden de Servicio</a></li>
	                            <li><a data-toggle="pill" href="#eliminar_orden">Eliminar Orden de Servicio</a></li>
	                        </ul>
	                    </div>
	                    <!--//MENÚ IZQUIERDO-->
	                    <div id="eleccion" class="tab-pane fade">
	                        <br>
	                        <p style="align-content: center;">Elija los empleados a ser transportados</p>
	                        <div class="contact col-lg-6">
	                            <div class="contact-top">
	                                <div class="contact-bottom">
	                                    <div class="panel-group" id="accordion">
	                                        <p>Elija la fecha a efectuar el servicio</p>
	                                        <input type="text" id="fecha_transporte" />
	                                        <select id="selectvehiculos" class="form-control">
	                                            <?php
	                                                require_once 'conexion.php';
	                                                $sql = 'SELECT * FROM tipo_vehiculo';
	                                                $consulta_nro_puestos = mysqli_query($conexion_bd, $sql);
	                                                foreach($consulta_nro_puestos as $c){
	                                                    $sql_n = "SELECT id_tipo_vehiculo FROM vehiculo WHERE id_tipo_vehiculo='".$c['id']."'";
	                                                    $consulta_existe = mysqli_query($conexion_bd, $sql_n);
	                                                    if(mysqli_num_rows($consulta_existe)>0){
	                                                        echo '<option id="'.$c['id'].'" value="'.$c['nro_puestos'].'">'.$c['nombre'].'</option>';
	                                                    }
	                                                }
	                                            ?>
	                                        </select>
	                                        <p>Leyenda</p>
	                                        <p>Inverso (I): Parada -> Empresa</p>
	                                        <p>Salida (S): Empresa -> Parada</p>
	                                        <br>
	                                        <?php
	                                        $sql = "SELECT * FROM cliente WHERE rif_empresa='".$_SESSION['rif']."' AND estatus=1 ORDER BY nombre";
	                                        $consulta = mysqli_query($conexion_bd, $sql);
	                                        if(mysqli_num_rows($consulta)>0){
	                                            echo '<table class="table" border="1">';
	                                                echo '<tr>';
	                                                echo '<td>Cédula</td>';
	                                                echo '<td>Nombre</td>';
	                                                echo '<td>Horarios</td>';
	                                                echo '</tr>';
	                                            foreach ($consulta as $c){
	                                                $sql = "SELECT id,lat_o,hora FROM parada WHERE id_cliente='".$c['cedula']."' ORDER BY hora ASC";
	                                                $consulta1 = mysqli_query($conexion_bd, $sql);
	                                                echo '<tr>'
	                                                . '<td>'.$c['cedula'].'</td>'
	                                                . '<td>'.utf8_encode($c['nombre']).' '.utf8_encode($c['apellido']).'</td>';
	                                                    if(mysqli_num_rows($consulta1)>0){
	                                                        echo '<td>';
	                                                        foreach ($consulta1 as $c1){
	                                                            $hora = strtotime($c1['hora']);
	                                                            $hora_nueva = date('h:i A', $hora);
	                                                            if($c1['lat_o']==$_SESSION['latitud']){
	                                                                echo '<label><input type="checkbox" id="'.$c1['id'].'" value="'.$c1['id'].'">S '.$hora_nueva.'</label>&nbsp;&nbsp;&nbsp;';
	                                                            }else{
	                                                                echo '<label><input type="checkbox" id="'.$c1['id'].'" value="'.$c1['id'].'">I '.$hora_nueva.'</label>&nbsp;&nbsp;&nbsp;';
	                                                            }
	                                                        }
	                                                        echo '</td>';
	                                                    }else{
	                                                        echo '<td>Este empleado no posee horarios</td>';
	                                                    }
	                                                echo '</tr>';
	                                            }
	                                            echo '</table>';
	                                            mysqli_close($conexion_bd);
	                                        }else{
	                                            echo '<i>No se han registrado usuarios</i>';
	                                        }
	                                        ?>
	                                    </div>
	                                    <input type="submit" value="Guardar" onclick="Guardar_transporte();return false;"><br>
	                                    <div id="resultado_eleccion"></div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div id="eliminar_orden" class="tab-pane fade">
	                        <div class="contact col-lg-6">
	                            <div class="contact-top">
	                                <div class="contact-bottom">
	                                    <p>Ingrese una fecha</p>
	                                    <input type="text" id="fecha_eliminar_orden" onchange="buscar_orden();">
	                                    <div id="buscar_eliminar_orden"></div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

	                </div>
	            </div>
	        </div>
	        
	    </div><!--//Tab Content-->

	    <?php
	        include('footer.php');
	    ?>
	</body>
</html>