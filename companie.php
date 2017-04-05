<?php
session_start();
if($_SESSION['success'] != 'yes'){
    header("Location:index.php");
}
?>
<html>
<head>
<meta charset="UTF-8">
<title>UPY3 | Panel de Control</title>
<link rel="icon" type="image/png" href="images/ic_launcher.png" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<!--Google Maps API-->
<link href="https://developers.google.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJSamIG6HU4kOCL6XMvyjzOVj4HCfPpyA"></script>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<?php
if($_SESSION['rol']==1){
?>
<script>
    var geocoder;
    var map;
    var mapOptions = {
        zoom: 14,
        //center: new google.maps.LatLng(10.09785571410395, -69.3480375455078),
        center: {lat: 10.09785571410395, lng: -69.3480375455078},
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
    var marker;
    function initialize() {
      geocoder = new google.maps.Geocoder();
      map = new google.maps.Map(document.getElementById('mapa_regemp'), mapOptions);
      codeAddress();
      google.maps.event.addListener(map, "idle", function()
        {
            google.maps.event.trigger(map, 'resize');
        });

        map.setZoom( map.getZoom() - 1 );
    map.setZoom( map.getZoom() + 1 );
    }
    function codeAddress() {
      var address = document.getElementById('txtdireccion').value;
      //var address = 'Barquisimeto';
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          if(marker)
            marker.setMap(null);
          marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location,
              draggable: true
          });
          google.maps.event.addListener(marker, "dragend", function() {
            document.getElementById('lat').value = marker.getPosition().lat();
            document.getElementById('lng').value = marker.getPosition().lng();
          });
          document.getElementById('lat').value = marker.getPosition().lat();
          document.getElementById('lng').value = marker.getPosition().lng();
        } else {
          alert('Geocode no pudo ejecutarse por el siguiente motivo: ' + status);
        }
      });
    }
</script>
<?php
}
if(in_array(9, $_SESSION['permisos']) || in_array(10, $_SESSION['permisos']) || in_array(11, $_SESSION['permisos'])){
?>
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
<?php
}
?>
<script>
    function iniciar_Mapas(){
        <?php
        if ($_SESSION['rol']==1){
            echo 'initialize();';
        }if (in_array(9, $_SESSION['permisos']) || in_array(10, $_SESSION['permisos']) || in_array(11, $_SESSION['permisos'])){
            echo 'initialize_emp();';
        }
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
            <li class="active"><a data-toggle="tab" href="#inicio">Inicio</a></li>            
            <?php
            if(in_array(3, $_SESSION['permisos']) || in_array(4, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#empre">Empresa</a></li>';
            }
            if($_SESSION['rol']!=1){
                echo '<li><a data-toggle="tab" href="#empre">Empresa</a></li>';
            }
            if(in_array(5, $_SESSION['permisos']) || in_array(6, $_SESSION['permisos']) || in_array(7, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#choferes">Driver</a></li>';
            }
            if(in_array(8, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#cho">Ubicación<i class="glyphicon glyphicon-map-marker pull-right"></i></a></li>';
            }
            if(in_array(9, $_SESSION['permisos']) || in_array(10, $_SESSION['permisos']) || in_array(11, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#empleados">Empleados</a></li>';
            }
            if(in_array(12, $_SESSION['permisos']) || in_array(13, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#tra">Orden de Servicio</a></li>';
            }
            if(in_array(14, $_SESSION['permisos']) || in_array(15, $_SESSION['permisos']) || in_array(16, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#filtros">Control de Rutas</a></li>';
            }
            if(in_array(17, $_SESSION['permisos']) || in_array(18, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#difusion">Mensajería</a></li>';
            }
            if(in_array(19, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#incidencia">Incidencias</a></li>';
            }
            if(in_array(20, $_SESSION['permisos']) || in_array(21, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#costos">Costos y Precios</a></li>';
            }
            if(in_array(22, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#permisos">Permisos</a></li>';
            }
            if(in_array(23, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#usuarios">Usuarios</a></li>';
            }
            if(in_array(24, $_SESSION['permisos']) || in_array(25, $_SESSION['permisos']) || in_array(26, $_SESSION['permisos']) || in_array(27, $_SESSION['permisos']) || in_array(28, $_SESSION['permisos']) || in_array(29, $_SESSION['permisos'])){
                echo '<li><a data-toggle="tab" href="#reportes">Reportes</a></li>';
            }
            ?>
        </ul>
    </div>
    
    <!--TABS'S CONTENT-->
    <div class="tab-content">
        <!--INICIO-->
        <div id="inicio" class="tab-pane fade in active">
            <div class="container">
                <h3>Inicio</h3>
                <p>Bandeja de entrada</p>
            </div>
            <div class="container">
                <?php
                if (in_array(1, $_SESSION['permisos'])) {
                    echo '<h4 class="text-center"><strong>Empresas en lista de espera</strong></h4><br>';
                    require_once 'conexion.php';
                    $sql = "SELECT * FROM empresa WHERE estatus=0";
                    $con = new Conexion();
                    $consulta = $con->consultar($sql);
                    //echo "con->num_filas = " . $con->num_filas($consulta) . '<br>';
                    if($con->num_filas($consulta)!=0){
                        echo '<table class="table" border="1">';
                        echo '<tr bgcolor="#00bce4">'
                                . '<td><strong>ID</strong></td>'
                                . '<td><strong>Nombre</strong></td>'
                                . '<td><strong>Direccion</strong></td>'
                                . '<td><strong>Correo</strong></td>'
                                . '<td><strong>Telefono</strong></td>'
                                . '<td><strong>Accion</strong></td></tr>';
                        foreach ($consulta as $c){
                            echo '<tr id="'.$c['rif'].'">';
                            echo '<td>'.$c['rif'].'</td>';
                            echo '<td>'.$c['nombre'].'</td>';
                            echo '<td>'.$c['direccion'].'</td>';
                            echo '<td>'.$c['correo'].'</td>';
                            echo '<td>'.$c['telefono'].'</td>';
                            echo '<td><button type="submit" onclick="deleteRow_aceptado(this);return false;" value="Revisado"><img src="images/gc.png" alt="Revisado" width="17"></button>'
                            . '<button type="submit" onclick="deleteRow_rechazado(this);return false;" value="Rechazado"><img src="images/delete1.ico" alt="Rechazado" width="15"></button>'
                            . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    }else{
                        echo '<p class="text-center"><i>No hay empresas en cola</i></p>';
                    }
                ?>
                <div class="text-center" id="result_inicio"></div>
                
                <script>
                    function deleteRow_aceptado(i){
                        document.getElementById('result_inicio').innerHTML = '';
                        var tbl = i.parentNode.parentNode.parentNode;
                        var row = i.parentNode.parentNode.rowIndex;
                        tbl.deleteRow(row);
                        var id = i.parentNode.parentNode.id;
                        var tipo = 1;
                        
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            id:id,
                            tipo:tipo
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("result_inicio").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/validar_empresa.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                    
                    function deleteRow_rechazado(i){
                        document.getElementById('result_inicio').innerHTML = '';
                        var tbl = i.parentNode.parentNode.parentNode;
                        var row = i.parentNode.parentNode.rowIndex;
                        tbl.deleteRow(row);
                        var id = i.parentNode.parentNode.id;
                        var tipo = 2;
                        
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            id:id,
                            tipo:tipo
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("result_inicio").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/validar_empresa.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                </script>
                
                <?php
                }
                if(in_array(2, $_SESSION['permisos'])){
                    $sql1 = "SELECT * FROM chofer WHERE estatus=0";
                    $consulta1 = $con->consultar($sql1);
                    echo '<br><h4 class="text-center"><strong>Choferes en lista de espera</strong></h4><br>';
                    if($con->num_filas($consulta1)!=0){
                        echo '<table class="table" border="1" id="choferes_espera">';
                        echo '<tr bgcolor="#00bce4">'
                                . '<td><strong>ID</strong></td>'
                                . '<td><strong>Nombre</strong></td>'
                                . '<td><strong>Direccion</strong></td>'
                                . '<td><strong>Sexo</strong></td>'
                                . '<td><strong>Telefono</strong></td>'
                                . '<td><strong>Usuario</strong></td>'
                                . '<td><strong>Accion</strong></td></tr>';
                        foreach ($consulta1 as $c){
                            echo '<tr id="'.$c['id_cedula'].'">';
                            echo '<td>'.$c['id_cedula'].'</td>';
                            echo '<td>'.$c['nombre'].' '.$c['apellido'].'</td>';
                            echo '<td>'.$c['direccion'].'</td>';
                            echo '<td>'.$c['sexo'].'</td>';
                            echo '<td>'.$c['telefono'].'</td>';
                            echo '<td><input type="text" id="usuario_chofer"></td>';
                            echo '<td><button type="submit" onclick="deleteRow_chofer_aceptado(this);return false;" value="Revisado"><img src="images/gc.png" alt="Revisado" width="17"></button>'
                            . '<button type="submit" onclick="deleteRow_chofer_rechazado(this);return false;" value="Rechazado"><img src="images/delete1.ico" alt="Rechazado" width="15"></button>'
                            . '</td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                    }else{
                        echo '<p class="text-center"><i>No hay choferes en cola</i></p>';
                    }
                ?>
                <div class="text-center" id="result_inicio_conductor"></div>
                
                <script>
                    function deleteRow_chofer_aceptado(i){
                        document.getElementById('result_inicio_conductor').innerHTML = '';
                        var tbl = i.parentNode.parentNode.parentNode;
                        var row = i.parentNode.parentNode.rowIndex;
                        //tbl.deleteRow(row);
                        var id = i.parentNode.parentNode.id;
                        var tipo = 1;
                        var usuario = document.getElementById("choferes_espera").rows[row].cells[5].childNodes[0].value;
                        var rif_empresa = '<?php echo $_SESSION['rif']; ?>';
                        
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            id:id,
                            tipo:tipo,
                            usuario:usuario,
                            rif:rif_empresa
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("result_inicio_conductor").innerHTML = xhttp.responseText;
                                //tbl.deleteRow(row);
                            }
                        };
                        xhttp.open("POST", "services/web/validar_conductor.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                    
                    function deleteRow_chofer_rechazado(i){
                        document.getElementById('result_inicio_conductor').innerHTML = '';
                        var tbl = i.parentNode.parentNode.parentNode;
                        var row = i.parentNode.parentNode.rowIndex;
                        tbl.deleteRow(row);
                        var id = i.parentNode.parentNode.id;
                        var tipo = 2;
                        var usuario = '';
                        
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            id:id,
                            tipo:tipo,
                            usuario:usuario
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("result_inicio_conductor").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/validar_conductor.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                </script>
                
                <?php
                }
                ?>
            </div>
        </div>
        
        <!--EMPRESA-->
        <div id="empre" class="tab-pane fade">
            <div class="container">
                <h3>Empresa</h3>
                <p>Datos Básicos</p>
                <div>
                    <?php
                    //if(in_array(3, $_SESSION['permisos'])){
                    ?>    
                        <!--Menu Izquierdo-->
                        <div class="col-md-3">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a data-toggle="pill" href="#registrar_empre">Registrar</a></li>
                                <li><a data-toggle="pill" href="#editar_empre">Editar</a></li>
                                <li><a data-toggle="pill" href="#eliminar_empre"></a></li>
                            </ul>
                        </div>
                        <!--//Menu Izquierdo-->
                        <div class="tab-content">
                            <!--TAB REGISTRAR-->
                            <div id="registrar_empre" class="tab-pane fade">
                                <h3>Registrar</h3>
                                <p>Ingresar Empresa</p>
                                <div class="contact col-lg-6">
                                    <div class="contact-top">
                                        <div class="contact-bottom">
                                            <form name="frmRegistro" method="POST">
                                                <input type="text" id="txtrif" name="txtrif" value="Rif" placeholder="" onfocus="if(this.value=='Rif') this.value='';" onblur="if (this.value == '') {this.value = 'Rif';}">
                                                <input type="text" id="txtnombre" name="txtnombre" value="Nombre" placeholder="" onfocus="if(this.value=='Nombre') this.value='';" onblur="if (this.value == '') {this.value = 'Nombre';}">	
                                                <label>Use el formato calle,carrera,sector,ciudad,estado,país</label>
                                                <textarea placeholder="" id="txtdireccion" name="txtdireccion" value="" onfocus="if(this.value=='Direcci&oacute;n') this.value='';" onblur="if(this.value == '') {this.value = 'Barquisimeto';}" >Barquisimeto</textarea>
                                                <input type="submit" onclick="codeAddress();return false;" value="Actualizar Mapa">
                                                <div class="map" id="mapa_regemp" style="height:600px; width:600px; top: 10px;"></div><br><br>
                                                <input type="text" id="txtcorreo" name="txtcorreo" value="Correo" placeholder="" onfocus="if(this.value=='Correo') this.value='';" onblur="if (this.value == '') {this.value = 'Correo';}">
                                                <input type="text" id="txttelefono" name="txttelefono" value="Tel&eacute;fono" placeholder="" onfocus="if(this.value=='Tel&eacute;fono') this.value='';" onblur="if (this.value == '') {this.value = 'Tel&eacute;fono';}">
                                                <input type="hidden" id="lat" name="lat_empre" readonly="true">
                                                <input type="hidden" id="lng" name="lon_empre" readonly="true">
                                                <input type="submit" onclick="registrar();return false;" value="Registrar">
                                                <div id="registrado"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <script>
                                function registrar(){
                                    var txtrif = document.getElementById("txtrif").value;
                                    var txtnombre = document.getElementById("txtnombre").value;
                                    var txtdireccion = document.getElementById("txtdireccion").value;
                                    var txtlatitud = document.getElementById("lat").value;
                                    var txtlongitud = document.getElementById("lng").value;
                                    var txttelefono = document.getElementById("txttelefono").value;
                                    var txtcorreo = document.getElementById("txtcorreo").value;
                                    xhttp = new XMLHttpRequest();
                                    var param = jQuery.param({
                                        rif:txtrif,
                                        nombre:txtnombre,
                                        tlf:txttelefono,
                                        latitud:txtlatitud,
                                        longitud:txtlongitud,
                                        correo:txtcorreo,
                                        direccion:txtdireccion,
                                        telefono:txttelefono
                                    });
                                    xhttp.onreadystatechange = function(){
                                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                                            document.getElementById("registrado").innerHTML = xhttp.responseText;
                                        }
                                    };
                                    xhttp.open("POST", "services/web/registrar_empresa.php", true);
                                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhttp.send(param);
                                }
                            </script>
                            
                            <?php
                            //}
                            if(in_array(4, $_SESSION['permisos'])){
                            ?>
                            
                            <!--TAB EDITAR-->
                            <div id="editar_empre" class="tab-pane fade">
                                <h3>Editar</h3>
                                <p>Editar características de una empresa</p>
                                <div class="input-group">
                                    <form name="frmEditar" method="POST" style="width: 500px;">
                                        <input type="text" class="form-control" placeholder="Buscar" name="txteditar_empre" id="txteditar_empre">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" href="javascript:;" onclick="buscar();return false;">
                                            <i style="color: #337ab7" class="glyphicon glyphicon-search"></i>
                                        </button>
                                        </span>
                                    </form>
                                </div>
                                
                                <div id="resultadoBusqueda" class="contact contact-bottom col-lg-6"></div>
                                
                                <div id="autocompletar"></div>
                                
                                <!--Script de autocompletar-->
                                <script type="text/javascript">
                                $(document).ready(function(){
                                    $(txteditar_empre).autocomplete({
                                        source: 'services/web/autocompletar.php'
                                    });
                                });
                                </script>
                                
                                <script>
                                function buscar(){
                                    //obtenemos el texto introducido en el campo de búsqueda
                                    var consulta = document.getElementById("txteditar_empre").value;
                                    //hace la búsqueda
                                    $.ajax({
                                            type: "POST",
                                            url: "services/web/buscar_empresa.php",
                                            data: "b="+consulta,
                                            dataType: "html",
                                            beforeSend: function(){
                                                $("#resultadoBusqueda").html("Procesando, espere por favor...");
                                            },
                                            error: function(){
                                                alert("error petición ajax");
                                            },
                                            success: function(data){
                                                $("#resultadoBusqueda").empty();
                                                $("#resultadoBusqueda").append(data);
                                            }
                                      });
                                }
                                </script>

                            </div>
                            <!--TAB ELIMINAR-->
<!--                            <div id="eliminar_empre" class="tab-pane fade">
                                <h3>Eliminar</h3>
                                <p>Eliminar de Base de Datos empresa</p>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Buscar" name="txteliminar">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i style="color: #337ab7" class="glyphicon glyphicon-search"></i>
                                    </button>
                                    </span>
                                </div>
                            </div>-->
                        </div>
                            
        
                    <?php
                    }
                    if($_SESSION['rol']!=1){
                        echo $_SESSION['rif'].'<br>';
                        echo $_SESSION['nombre'].'<br>';
                        echo $_SESSION['direccion'].'<br>';
                        echo $_SESSION['correo'];
                    }
                    ?>
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
                    <?php
                    if(in_array(9, $_SESSION['permisos'])){
                    ?>
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
                    
                    <script>
                        function registrar_empleado(){
                            document.getElementById("registro_empleado").innerHTML = '';
                            var txtrif = document.getElementById("rif_remple").value;
                            var txtcedula = document.getElementById("cedula_remple").value;
                            var txtnombre = document.getElementById("nombre_remple").value;
                            var txtapellido = document.getElementById("apellido_remple").value;
                            var txtdireccion = document.getElementById("direccion_remple").value;
                            var txtsexo = document.getElementById("sexo_remple").value;
                            var txtlatitud = document.getElementById("lat_emp").value;
                            var txtlongitud = document.getElementById("lng_emp").value;
                            var txttelefono = document.getElementById("telefono_remple").value;
                            var txtcorreo = document.getElementById("email_remple").value;
                            var txtlatitud_emp = <?php echo "'".$_SESSION['latitud']."'"; ?>;
                            var txtlongitud_emp = <?php echo "'".$_SESSION['longitud']."'"; ?>;
                            var tabla = document.getElementById("tabla_generada");
                            var jObject = [];
                            for (var i=0;i<tabla.rows.length;i++)
                            {
                                // create array within the array - 2nd dimension
                                jObject[i] = [];
                                // columns within the row
                                for (var j = 0; j < 3; j++)
                                {
                                    jObject[i][j] = tabla.rows[i].cells[j].innerHTML;
                                }
                            }
                            var JSONObject = JSON.stringify(jObject);
                            xhttp = new XMLHttpRequest();
                            var param = jQuery.param({
                                rif:txtrif,
                                cedula:txtcedula,
                                nombre:txtnombre,
                                apellido:txtapellido,
                                correo:txtcorreo,
                                direccion:txtdireccion,
                                telefono:txttelefono,
                                sexo:txtsexo,
                                latitud:txtlatitud,
                                longitud:txtlongitud,
                                latitud_emp:txtlatitud_emp,
                                longitud_emp:txtlongitud_emp,
                                json:JSONObject
                            });
                            xhttp.onreadystatechange = function(){
                                if (xhttp.readyState == 4 && xhttp.status == 200) {
                                    document.getElementById("registro_empleado").innerHTML = xhttp.responseText;
                                }
                            };
                            xhttp.open("POST", "services/web/registrar_empleado.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send(param);
                        }
                    </script>
                    
                    <script>
                    function genera_tabla() {
                        var hora = document.getElementById("hora").value;
                        var origen = document.getElementById("origen").value;
                        var destino = document.getElementById("destino").value;
                        // Obtener la referencia del elemento body
                        //var body = document.getElementsByTagName("body")[0];
                        var body = document.getElementById("tabla_rutas");

                        // Crea un elemento <table> y un elemento <tbody>
                        if (!document.getElementById("tabla_generada")){
                            var tabla   = document.createElement("table");
                            var tblBody = document.createElement("tbody");
                            // appends <table> into <body>
                            body.appendChild(tabla);
                            // posiciona el <tbody> debajo del elemento <table>
                            tabla.appendChild(tblBody);
                            // modifica los atributos de la tabla;
                            tabla.setAttribute("border", "2");
                            tabla.setAttribute("align", "center");
                            tabla.setAttribute("class", "table");
                            tabla.setAttribute("bordercolor", "#7D3F98");
                            tabla.setAttribute("id", "tabla_generada");
                            tblBody.setAttribute("id", "tblbody");
                            //creamos el encabezado de las columnas
                            for (var h = 0; h < 1; h++) {
                                var fila = document.createElement("tr");
                                var encabezado1 = document.createElement("td");
                                var encabezado2 = document.createElement("td");
                                var encabezado3 = document.createElement("td");
                                var encabezado4 = document.createElement("td");
                                var titulo1 = document.createTextNode("Origen");
                                var titulo2 = document.createTextNode("Destino");
                                var titulo3 = document.createTextNode("Hora");
                                var titulo4 = document.createTextNode("Acción");
                                encabezado1.appendChild(titulo1);
                                encabezado2.appendChild(titulo2);
                                encabezado3.appendChild(titulo3);
                                encabezado4.appendChild(titulo4);
                                fila.appendChild(encabezado1);
                                fila.appendChild(encabezado2);
                                fila.appendChild(encabezado3);
                                fila.appendChild(encabezado4);
                                fila.setAttribute("align", "center");
                                fila.setAttribute("bgcolor", "#00bce4");
                                tblBody.appendChild(fila);
                            }
                        }

                        // Crea las celdas
                        for (var i = 0; i < 1; i++) {
                            // Crea una fila
                            var hilera = document.createElement("tr");
                            // Crea un elemento <td> y un nodo de texto
                            var celda = document.createElement("td");
                            var celda1 = document.createElement("td");
                            var celda2 = document.createElement("td");
                            var celda3 = document.createElement("td");
                            var texto = document.createTextNode(origen);
                            var texto1 = document.createTextNode(destino);
                            var texto2 = document.createTextNode(hora);
                            var boton = document.createElement("button");
                            var x = document.createElement("IMG");
                            x.setAttribute("src", "images/delete1.ico");
                            x.setAttribute("alt", "Eliminar");
                            x.setAttribute("width", "15");
                            x.setAttribute("width", "15");
                            boton.appendChild(x);
                            boton.type = "submit";
                            boton.setAttribute("onclick", "deleteRow(this);return false;");
                            boton.value = "Eliminar";
                            //Agrega el texto a la celda y la celda a lafila
                            celda.appendChild(texto);
                            celda1.appendChild(texto1);
                            celda2.appendChild(texto2);
                            celda3.appendChild(boton);
                            hilera.appendChild(celda);
                            hilera.appendChild(celda1);
                            hilera.appendChild(celda2);
                            hilera.appendChild(celda3);
                            hilera.setAttribute("align", "center");
                            // agrega la hilera al final de la tabla (al final del elemento tblbody)
                            var tablebody = document.getElementById("tblbody");
                            tablebody.appendChild(hilera);
                        }
                    }
                    </script>
                    
                    <script>
                        function deleteRow(r) {
                            var i = r.parentNode.parentNode.rowIndex;
                            document.getElementById("tabla_generada").deleteRow(i);
                        }
                    </script>
                    
                    <?php
                    }
                    if(in_array(10, $_SESSION['permisos'])){
                    ?>
                    
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
                    
                    <!--Función para enviar via AJAX los datos del archivo de los clientes-->
                    <script>
                    function archivo(){
                        document.getElementById("resultado_archivo").innerHTML = '';
                        var data = new FormData();
                        var rif = '<?php echo $_SESSION['rif']; ?>';
                        jQuery.each(jQuery('#file')[0].files, function(i, file) {
                            data.append('file-'+i, file);
                            data.append('rif', rif);
                        });
                        jQuery.ajax({
                        url: 'services/web/archivo_por_lote.php',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(data){
                            document.getElementById("resultado_archivo").innerHTML = data;
                        }
                    });
                    }
                    </script>
                    
                    <?php
                    }
                    if(in_array(11, $_SESSION['permisos'])){
                    ?>
                    
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
                    
                    <!--Script de autocompletar-->
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $(txteditar_empleado).autocomplete({
                                source: 'services/web/autocompletar_empleado.php?rif=<?php echo $_SESSION['rif']; ?>'
                            });
                        });
                    </script>
                    
                    <script>
                        function buscar_empleado(){
                            var nombre = document.getElementById("txteditar_empleado").value;
                            xhttp = new XMLHttpRequest();
                            var param = jQuery.param({
                                nombre:nombre
                            });
                            xhttp.onreadystatechange = function(){
                                if (xhttp.readyState == 4 && xhttp.status == 200) {
                                    document.getElementById("resultadoBusquedaEmpleado").innerHTML = xhttp.responseText;
                                }
                            };
                            xhttp.open("POST", "services/web/buscar_empleado.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send(param);
                        }
                    </script>
                    
                    <script>
                        function agregar_parada_editar_empleado(){
                            var select1 = document.getElementById("origen_editar").value;
                            var select2 = document.getElementById("destino_editar").value;
                            var hora = document.getElementById("hora_editar").value;
                            var ampm = document.getElementById("am_editar").value;
                            //Concatenamos las variables hora y ampm
                            var stringsToInsert = [hora, ampm], stringToInsert = stringsToInsert.join(' ');
                            // Obtener la referencia del elemento tabla
                            var tabla = document.getElementById("tabla_editar_empleado");
                            // Crea las celdas
                            for (var i = 0; i < 1; i++) {
                                // Crea una fila
                                var hilera = document.createElement("tr");
                                // Crea un elemento <td> y un nodo de texto
                                var celda = document.createElement("td");
                                var celda1 = document.createElement("td");
                                var celda2 = document.createElement("td");
                                var celda3 = document.createElement("td");
                                var texto = document.createTextNode(select1);
                                var texto1 = document.createTextNode(select2);
                                var texto2 = document.createTextNode(stringToInsert);
                                var boton = document.createElement("button");
                                var x = document.createElement("IMG");
                                x.setAttribute("src", "images/delete1.ico");
                                x.setAttribute("alt", "Eliminar");
                                x.setAttribute("width", "15");
                                x.setAttribute("width", "15");
                                boton.appendChild(x);
                                boton.type = "submit";
                                boton.setAttribute("onclick", "delete_row_editar_empleado(this);return false;");
                                boton.value = "Eliminar";
                                //Agrega el texto a la celda y la celda a la fila
                                celda.appendChild(texto);
                                celda1.appendChild(texto1);
                                celda2.appendChild(texto2);
                                celda3.appendChild(boton);
                                hilera.appendChild(celda);
                                hilera.appendChild(celda1);
                                hilera.appendChild(celda2);
                                hilera.appendChild(celda3);
                                hilera.setAttribute("align", "center");
                                hilera.setAttribute("height", "39px");
                                hilera.setAttribute("id", "");
                                tabla.appendChild(hilera);
                            }
                        }
                        
                        function delete_row_editar_empleado(r){
                            var i = r.parentNode.parentNode.rowIndex;
                            document.getElementById("tabla_editar_empleado").deleteRow(i);
                        }
                    </script>
                    
                    <script>
                    function actualizarEmpleado(){
                        document.getElementById("actualizar_empleado").innerHTML = '';
                        var estatus = $('input:checkbox[id^="habilitado_editar_empleado"]:checked').map(function(){return this.value}).get();
                        var txtcedula = document.getElementById("cedoculto_eemple").value;
                        var txtcedulanueva = document.getElementById("txtcedula_eemple").value;
                        var txtnombre = document.getElementById("txtnombre_eemple").value;
                        var txtapellido = document.getElementById("txtapellido_eemple").value;
                        var txtsexo = document.getElementById("combosexo_eemple").value;
                        var txttelefono = document.getElementById("txttelefono_eemple").value;
                        var txtcorreo = document.getElementById("txtcorreo_eemple").value;
                        var txtdireccion = document.getElementById("txtdireccion_eemple").value;
                        var txtlatitud_eemple = document.getElementById("lat_eemp").value;
                        var txtlongitud_eemple = document.getElementById("lng_eemp").value;
                        var latitud_emp = '<?php echo $_SESSION['latitud']; ?>';
                        var longitud_emp = '<?php echo $_SESSION['longitud']; ?>';
                        //Recolectamos la informacion de la tabla paradas
                        var tabla = document.getElementById("tabla_editar_empleado");
                        var jObject = [];
                        for (var i=0;i<tabla.rows.length;i++){
                            // create array within the array - 2nd dimension
                            jObject[i] = [];
                            // column id
                            jObject[i][j] = tabla.rows[i].id;
                            // columns within the row
                            for (var j = 0; j < 3; j++){
                                jObject[i][j] = tabla.rows[i].cells[j].innerHTML;
                            }
                        }
                        var JSONObject = JSON.stringify(jObject);
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            cedula:txtcedula,
                            cednueva:txtcedulanueva,
                            nombre:txtnombre,
                            apellido:txtapellido,
                            sexo:txtsexo,
                            tlf:txttelefono,
                            correo:txtcorreo,
                            direccion:txtdireccion,
                            latitud:txtlatitud_eemple,
                            longitud:txtlongitud_eemple,
                            latitud_emp:latitud_emp,
                            longitud_emp:longitud_emp,
                            estatus:estatus,
                            JSON:JSONObject
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("actualizar_empleado").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/actualizar_empleado.php", true); //abrimos la conexion, definimos tipo, url y AJAX=true
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //cabecera para el metodo POST
                        xhttp.send(param);
                    }
                    </script>
                    
                    <script>
                        var map_eempleado;
                        function initMap2() {
                            var lat2 = parseFloat(document.getElementById('lat_eemp').value);
                            var lon2 = parseFloat(document.getElementById('lng_eemp').value);
                            map_eempleado = new google.maps.Map(document.getElementById('mapa_editar_emple'), {
                                center: {lat: lat2, lng: lon2},
                                zoom: 15
                            });
                            var marker6 = new google.maps.Marker({
                                position: {lat: lat2, lng: lon2},
                                map: map_eempleado,
                                draggable: true
                              });
                            google.maps.event.addListener(marker6, "dragend", function() {
                            document.getElementById('lat_eemp').value = marker6.getPosition().lat();
                            document.getElementById('lng_eemp').value = marker6.getPosition().lng();
                          });
                          document.getElementById('lat_eemp').value = marker6.getPosition().lat();
                          document.getElementById('lng_eemp').value = marker6.getPosition().lng();
                        }
                    </script>
                    
                    <!--TAB ELIMINAR-->
<!--                    <div id="eliminar" class="tab-pane fade">
                        <h3>Eliminar</h3>
                        <p>Eliminar de Base de Datos empleados</p>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar" name="txteliminar">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i style="color: #337ab7" class="glyphicon glyphicon-search"></i>
                            </button>
                            </span>
                        </div>
                    </div>-->

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        
            <?php
            if(in_array(5, $_SESSION['permisos'])){
            ?>
        
        <div id="choferes" class="tab-pane fade">
            <div class="container">
                <!--Menu Izquierdo-->
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a data-toggle="pill" href="#registrar_chofer">Registrar</a></li>
                        <li><a data-toggle="pill" href="#archivo_chofer">Subir archivo</a></li>
                        <li><a data-toggle="pill" href="#editar_chofer">Editar</a></li>
                        <li><a data-toggle="pill" href="#eliminar_chofer"></a></li>
                    </ul>
                </div>
                <!--//Menu Izquierdo-->
                <div class="tab-content">
                    <!--TAB REGISTRAR CHOFER-->
                    <div id="registrar_chofer" class="tab-pane fade">
                        <h3>Registrar</h3>
                        <p>Ingresar Choferes</p>
                        <div class="contact col-lg-6">
                            <div class="contact-top">
                                <div class="contact-bottom">
                                    <p>Datos del chofer</p>
                                    <form name="frmRegistro" method="POST">
                                        <input type="hidden" value="<?php echo $_SESSION['rif'] ?>" id="rif_chofer">
                                        <input type="text" value="Cédula" id="cedula_chofer" onfocus="if(this.value=='Cédula') this.value='';" onblur="if (this.value == '') {this.value = 'Cédula';}">
                                        <input type="text" value="Nombre" id="nombre_chofer" onfocus="if(this.value=='Nombre') this.value='';" onblur="if (this.value == '') {this.value = 'Nombre';}">
                                        <input type="text" value="Apellido" id="apellido_chofer" onfocus="if(this.value=='Apellido') this.value='';" onblur="if (this.value == '') {this.value = 'Apellido';}">
                                        <select id="sexo_chofer" class="form-control">
                                            <option selected="true" disabled="">Sexo:</option>
                                            <option id="M" value="M">Masculino</option>
                                            <option id="F" value="F">Femenino</option>
                                        </select>
                                        <input type="text" value="Correo" id="correo_chofer" onfocus="if(this.value=='Correo') this.value='';" onblur="if (this.value == '') {this.value = 'Correo';}">
                                        <input type="text" value="Teléfono" id="telefono_chofer" onfocus="if(this.value=='Teléfono') this.value='';" onblur="if (this.value == '') {this.value = 'Teléfono';}">
                                        <input type="text" value="Usuario" id="usuario_chofer_registro" onfocus="if(this.value=='Usuario') this.value='';" onblur="if (this.value == '') {this.value = 'Usuario';}">
                                        <textarea id="direccion_chofer" onfocus="if(this.value=='Direcci&oacute;n') this.value='';" onblur="if(this.value == '') {this.value = 'Direcci&oacute;n';}" >Barquisimeto</textarea>
                                        <p>Datos del Vehiculo</p>
                                    </form>
                                    <form class="form-inline well text-center" style="width: 455px; float: none; margin: 10px auto;">
                                        <input class="form-control" type="text" id="txtplaca" value="Placa" onfocus="if(this.value=='Placa') this.value='';" onblur="if (this.value == '') {this.value = 'Placa';}">
                                        <input class="form-control" type="text" id="txtmarca" value="Marca" onfocus="if(this.value=='Marca') this.value='';" onblur="if (this.value == '') {this.value = 'Marca';}">
                                        <input class="form-control" type="text" id="txtmodelo" value="Modelo" onfocus="if(this.value=='Modelo') this.value='';" onblur="if (this.value == '') {this.value = 'Modelo';}">
                                        <i>Tipo: </i>
                                        <?php
                                        $sql = "SELECT * FROM tipo_vehiculo ORDER BY nro_puestos ASC";
                                        $consulta = $con->consultar($sql);
                                        if ($con->num_filas($consulta)>0){
                                            echo '<select id="tipo_ve" style="height: 32px;">';
                                            foreach ($consulta as $c){
                                                echo '<option id="'.$c['id'].'" value="'.$c['id'].'">'.$c['nombre'].' ('.$c['nro_puestos'].') puestos</option>';
                                            }
                                            echo '</select>';
                                        }else{
                                            echo 'No hay tipos registrados';
                                        }
                                        $sql1 = 'SELECT * FROM condicion';
                                        $consulta1 = $con->consultar($sql1);
                                        if ($con->num_filas($consulta1)>0){
                                            echo '<br><i>Condiciones del Vehiculo: </i>';
                                            echo '<select id="cond_ve">';
                                            foreach ($consulta1 as $c1){
                                                echo '<option id="'.$c1['id'].'" value="'.$c1['id'].'">'.$c1['descripcion'].'</option>';
                                            }
                                            echo '</select>';
                                        }else{
                                            echo 'No hay condiciones registradas';
                                        }
                                        $con->cerrar_conexion();
                                        ?>
                                    </form>
                                    <input type="submit" onclick="registrar_chofer();return false;" value="Registrar Chofer">
                                    <div id="registro_chofer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        function registrar_chofer(){
                            var cedula = document.getElementById("cedula_chofer").value;
                            var nombre = document.getElementById("nombre_chofer").value;
                            var apellido = document.getElementById("apellido_chofer").value;
                            var sexo = document.getElementById("sexo_chofer").value;
                            var correo = document.getElementById("correo_chofer").value;
                            var telefono = document.getElementById("telefono_chofer").value;
                            var usuario = document.getElementById("usuario_chofer_registro").value;
                            var direccion = document.getElementById("direccion_chofer").value;
                            var placa = document.getElementById("txtplaca").value;
                            var marca = document.getElementById("txtmarca").value;
                            var modelo = document.getElementById("txtmodelo").value;
                            var tipo = document.getElementById("tipo_ve").value;
                            var cond = document.getElementById("cond_ve").value;
                            var rif_empresa = '<?php echo $_SESSION['rif'] ?>';
                            xhttp = new XMLHttpRequest();
                            var param = jQuery.param({
                                cedula:cedula,
                                nombre:nombre,
                                apellido:apellido,
                                sexo:sexo,
                                correo:correo,
                                tlf:telefono,
                                usuario:usuario,
                                direccion:direccion,
                                placa:placa,
                                marca:marca,
                                modelo:modelo,
                                tipo:tipo,
                                cond:cond,
                                rif:rif_empresa
                            });
                            xhttp.onreadystatechange = function(){
                                if (xhttp.readyState == 4 && xhttp.status == 200) {
                                    document.getElementById("registro_chofer").innerHTML = xhttp.responseText;
                                }
                            };
                            xhttp.open("POST", "services/web/registrar_chofer.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send(param);
                        }
                    </script>
                    
                    <?php
                    }
                    if(in_array(6, $_SESSION['permisos'])){
                    ?>

                    <!--TAB ARCHIVO CHOFERES-->
                    <div id="archivo_chofer" class="tab-pane fade">
                        <h3>Subir Archivo</h3>
                        <p>Suba un archivo con el siguiente <a href="upy3_chofer.xlsx">esquema</a> con el formato .csv (Delimitado por comas)</p><br>
                        <div class="input-group">
                            <form name="frmArchivo" method="POST" enctype="multipart/form-data" >
                                <input type="file" class="form-control" placeholder="Archivo.csv" id="file" name="file">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" onclick="archivo_chofer();return false;">
                                        <i style="color: #337ab7" class="glyphicon glyphicon-arrow-up"></i>
                                    </button>
                                </span>
                            </form>
                        </div>
                        <div id="resultado_archivo"></div>
                    </div>

                    <script>
                    function archivo_chofer(){
                        document.getElementById("resultado_archivo").innerHTML = '';
                        var data = new FormData();
                        var rif = '<?php echo $_SESSION['rif']; ?>';
                        jQuery.each(jQuery('#file')[0].files, function(i, file) {
                            data.append('file-'+i, file);
                            data.append('rif', rif);
                        });
                        jQuery.ajax({
                        url: 'services/web/archivo_por_lote_chofer.php',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(data){
                            document.getElementById("resultado_archivo").innerHTML = data;
                        }
                        });
                    }
                    </script>
            
                    <?php
                    }
                    if(in_array(7, $_SESSION['permisos'])){
                    ?>

                <!--TAB EDITAR CHOFERES-->
                <div id="editar_chofer" class="tab-pane fade">
                    <h3>Editar</h3>
                    <p>Editar características de un chofer</p>
                    <div class="input-group">
                        <form name="frmEditar" method="POST" style="width: 500px;">
                            <input type="text" class="form-control" placeholder="Buscar" id="txteditar_chofer">
                            <span class="input-group-btn">
                                <button class="btn btn-default" onclick="buscar_chofer();return false;">
                                    <i style="color: #337ab7" class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </form>
                    </div>
                    <div id="resultadoBusquedaChofer" class="contact contact-bottom col-lg-6"></div>
                </div>

                <!--Script de autocompletar búsqueda de choferes-->
                <script type="text/javascript">
                    $(document).ready(function(){
                        $(txteditar_chofer).autocomplete({
                            source: 'services/web/autocompletar_chofer.php'
                        });
                    });
                </script>

                <script>
                    function buscar_chofer(){
                        var nombre = document.getElementById("txteditar_chofer").value;
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            nombre:nombre
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("resultadoBusquedaChofer").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/buscar_chofer.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                </script>
                
                <script>
                function actualizar_Chofer(){
                    document.getElementById("actualizar_chofer").innerHTML = '';
                    var estatus = $('input:checkbox[id^="habilitado_editar_chofer"]:checked').map(function(){return this.value}).get();
                    var txtcedula = document.getElementById("cedoculto_chofer").value;
                    var txtcedulanueva = document.getElementById("txtcedula_chofer_editar").value;
                    var txtnombre = document.getElementById("txtnombre_chofer_editar").value;
                    var txtapellido = document.getElementById("txtapellido_chofer_editar").value;
                    var txtsexo = document.getElementById("combosexo_chofer_editar").value;
                    var txtcorreo = document.getElementById("txtcorreo_chofer_editar").value;
                    var txttelefono = document.getElementById("txttelefono_chofer_editar").value;
                    var txtdireccion = document.getElementById("txtdireccion_chofer_editar").value;
                    var placa = document.getElementById("txtplaca_editar").value;
                    var placa_v = document.getElementById('placavieja').value;
                    var marca = document.getElementById("txtmarca_editar").value;
                    var modelo = document.getElementById("txtmodelo_editar").value;
                    var tipo_v = document.getElementById("tipo_ve_editar").value;
                    var cond = document.getElementById("cond_ve_editar").value;
                    xhttp = new XMLHttpRequest();
                    var param = jQuery.param({
                        cedula:txtcedula,
                        cednueva:txtcedulanueva,
                        nombre:txtnombre,
                        apellido:txtapellido,
                        sexo:txtsexo,
                        tlf:txttelefono,
                        correo:txtcorreo,
                        direccion:txtdireccion,
                        estatus:estatus,
                        placa:placa,
                        placa_vieja:placa_v,
                        marca:marca,
                        modelo:modelo,
                        tipo_v:tipo_v,
                        cond:cond
                    });
                    xhttp.onreadystatechange = function(){
                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                            document.getElementById("actualizar_chofer").innerHTML = xhttp.responseText;
                        }
                    };
                    xhttp.open("POST", "services/web/actualizar_chofer.php", true); //abrimos la conexion, definimos tipo, url y AJAX=true
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //cabecera para el metodo POST
                    xhttp.send(param);
                }
                </script>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>

        <?php
        if(in_array(8, $_SESSION['permisos'])){
        ?>
        <!--UBICACION-->
        <div id="cho" class="tab-pane fade" onload="initMapChoferes()">
            <div class="container">
                <h3>Control de Choferes</h3>
                <p>Ultima locacion de los conductores</p>
                <form>
                    <input type="submit" onclick="initMapChoferes();return false;" value="Cargar Mapa">
                </form>
            </div>
            <div class="container">
                <div id="mapa_choferes" style="height:600px; width:auto; top: 10px;"></div>
            </div>
        </div>
        
            <?php
            //include './conexion.php';
            $con = new Conexion();
            $sql = "SELECT chofer.*,vehiculo.modelo FROM chofer INNER JOIN vehiculo ON vehiculo.id_chofer = chofer.id_cedula WHERE estatus=1 AND latitud IS NOT NULL";
            $consulta = $con->consultar($sql);
            if($con->num_filas($consulta)>0){
                $i = 1;
                foreach ($consulta as $c){
                    $lat = $c['latitud'];
                    $lng = $c['longitud'];
                    echo '<input type="hidden" id="lat'.$i.'" value="'.$lat.'" />';
                    echo '<input type="hidden" id="lng'.$i.'" value="'.$lng.'" />';
                    $i++;
                }
            ?>

        <script>
            var mapChoferes;
            var bounds = new google.maps.LatLngBounds();
            <?php
            for ($i=1;$i<=$con->num_filas($consulta);$i++){
                echo "var lat$i = parseFloat(document.getElementById('lat$i').value);";
                echo "var lng$i = parseFloat(document.getElementById('lng$i').value);";
            }
            ?>
            function initMapChoferes() {
                mapChoferes = new google.maps.Map(document.getElementById('mapa_choferes'), {
                });
                <?php
                $i=1;
                foreach ($consulta as $c){
                    $titulo = $c['nombre'].' '.$c['apellido'].' '.$c['modelo'].' '.$c['telefono'];
                    echo "var marker$i = new google.maps.Marker({"
                       . 'position: {lat: lat'.$i.', lng: lng'.$i.'},'
                       . "map: mapChoferes,"
                       . "title: '$titulo' "
                       . "});"
                       . "bounds.extend(marker$i.position);";
                    $i++;
                }
                ?>
            mapChoferes.fitBounds(bounds);
            }
        </script>
        
        <?php
            }
        }
        
        if(in_array(14, $_SESSION['permisos']) || in_array(15, $_SESSION['permisos']) || in_array(16, $_SESSION['permisos'])){
        ?>
        
        <!--FILTROS DE RUTAS-->
        <div id="filtros" class="tab-pane fade">
            <div class="container">
                <div class="tab-content">
                <h3>Revisión y edición de rutas</h3>
                <p>Elija una ruta para ser visualizada o editada</p><br>
                Favor ingrese una fecha: 
                <input type="text" id="fecha_filtros">
                <!--<p>Elija un filtro</p>-->
                <div id="F" class="col-md-12">
                    <ul class="nav nav-pills">
                        <li onclick="Filtros(this.id)" id="estado"><a data-toggle="pill">Estados</a></li>
                        <li onclick="Filtros(this.id)" id="r"><a data-toggle="pill">Rutas</a></li>
                        <li onclick="Filtros(this.id)" id="c"><a data-toggle="pill">Conductores</a></li>
                        <li onclick="Filtros(this.id)" id="h"><a data-toggle="pill">Horas</a></li>
                        <li onclick="Filtros(this.id)" id="e"><a data-toggle="pill">Empresas</a></li>
                        <li onclick="Filtros(this.id)" id="n"><a data-toggle="pill">Sin Asignar</a></li>
                        <!--<li><a onclick="MostrarL1(this.id)" id="1" data-toggle="pill" href="#L1">Empresa</a></li>-->
                    </ul>
                </div>
                <div id="L1" class="col-md-2"></div>
                <div id="L2" class="col-md-2"></div>
                <div id="InfoM" class="col-md-8"></div>
                
                <script>
                    function Filtros(id){
                        var fecha = document.getElementById('fecha_filtros').value;
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            para:id,
                            fecha:fecha
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("InfoM").innerHTML = '';
                                document.getElementById("L2").innerHTML = '';
                                document.getElementById("L1").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/filtrar_rutas.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                </script>

                <script>
                    function Filtros2(id){
                        var fecha = document.getElementById('fecha_filtros').value;
                        var para = document.getElementById("parametro_buscar").value;
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            id:id,
                            para:para,
                            fecha:fecha
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("InfoM").innerHTML = '';
                                document.getElementById("L2").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/filtrar_rutas.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                </script>

                <script>
                    function Filtros3(id){
                        var fecha = document.getElementById('fecha_filtros').value;
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            id:id,
                            fecha:fecha
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("InfoM").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/filtrar_rutas.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                </script>
                
                <script>
                    function precio(){
                        var tipo = document.getElementById('tipo_ruta').value;
                        var chofer = document.getElementById('chofer').value;
                        if(document.getElementById("label_precio")){
                            var element = document.getElementById("label_costo");
                            element.parentNode.removeChild(element);
                            document.getElementById("h4_costo").remove();
                            var element = document.getElementById("label_precio");
                            element.parentNode.removeChild(element);
                            document.getElementById("h4_precio").remove();
                        }
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            tipo:tipo,
                            chofer:chofer
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("div_costo_precio").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/calcular_precio_ruta.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                </script>
                
                <script>
                    function deleteRowParadas(r) {
                        var i = r.parentNode.parentNode.rowIndex;
                        document.getElementById("empleados_filtro").deleteRow(i);
                    }
                </script>

                <script>
                    function agregar_parada(){
                        var id = document.getElementById("empleados_nuevos").value;
                        var select = document.getElementById("empleados_nuevos");
                        var nombre = select.options[select.selectedIndex].text;
                        // Obtener la referencia del elemento tabla
                        var tabla = document.getElementById("empleados_filtro");
                        // Crea las celdas
                        for (var i = 0; i < 1; i++) {
                            // Crea una fila
                            var hilera = document.createElement("tr");
                            // Crea un elemento <td> y un nodo de texto
                            var celda = document.createElement("td");
                            var celda1 = document.createElement("td");
                            var texto = document.createTextNode(nombre);
                            var boton = document.createElement("button");
                            var x = document.createElement("IMG");
                            x.setAttribute("src", "images/delete1.ico");
                            x.setAttribute("alt", "Eliminar");
                            x.setAttribute("width", "15");
                            x.setAttribute("width", "15");
                            boton.appendChild(x);
                            boton.type = "submit";
                            boton.setAttribute("onclick", "deleteRowParadas(this);return false;");
                            boton.value = "Eliminar";
                            //Agrega el texto a la celda y la celda a la fila
                            celda.appendChild(texto);
                            celda1.appendChild(boton);
                            hilera.appendChild(celda);
                            hilera.appendChild(celda1);
                            hilera.setAttribute("align", "center");
                            hilera.setAttribute("height", "39px");
                            hilera.setAttribute("id", id);
                            tabla.appendChild(hilera);
                        }
                    }
                </script>
                
                <script>
                function actualizar_ruta(){
                    if(confirm('Seguro desea editar esta ruta?')){
                        document.getElementById('dialog').innerHTML = '';
                        var rif_empresa = document.getElementById("rif_empresa_filtro").value;
                        var id_ruta = document.getElementById('id_ruta_filtro').value;
                        var estatus = document.getElementById('estatus_control_rutas').value;
                        var chofer = document.getElementById('chofer').value;
                        var tipo_ruta = document.getElementById('tipo_ruta').value;
                        <?php
                        if($_SESSION['rol']==1){
                            echo 'var costo = document.getElementById("label_costo").textContent;';
                            echo 'var precio = document.getElementById("label_precio").textContent;';
                        }elseif ($_SESSION['rol']==5) {
                            echo 'var costo = document.getElementById("label_costo").textContent;';
                            echo 'var precio = document.getElementById("label_precio").textContent;';
                        }
                        ?>
                        var tabla = document.getElementById("empleados_filtro");
                        var jObject = [];
                        for (var i=0;i<tabla.rows.length;i++){
                            // create array within the array - 2nd dimension
                            // No es necesario para este script
                            jObject[i] = [];
                            for (var j = 0; j < 1; j++){
                                jObject[i][j] = tabla.rows[i].id;
                            }
                        }
                        var JSONObject = JSON.stringify(jObject);
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            rif:rif_empresa,
                            id:id_ruta,
                            estatus:estatus,
                            chofer:chofer,
                            tipo_ruta:tipo_ruta,
                            costo:costo,
                            precio:precio,
                            json:JSONObject
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("dialog").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "services/web/actualizar_ruta.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                }
                </script>
                
                <script>
                    $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '<Ant',
                    nextText: 'Sig>',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                    weekHeader: 'Sm',
                    dateFormat: 'yy-mm-dd',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                    };
                    $.datepicker.setDefaults($.datepicker.regional['es']);
                $(function() {
                    $("#fecha_filtros").datepicker({
                        startDate: '-1d',
                        endDate: '+2m'
                    });
                });
                </script>
                </div>
            </div>
        </div>
        
            <?php
            }
            ?>
        
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
                    <?php
                    if(in_array(12, $_SESSION['permisos'])){
                    ?>
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
                                                $consulta_nro_puestos = $con->consultar($sql);
                                                foreach($consulta_nro_puestos as $c){
                                                    $sql_n = "SELECT id_tipo_vehiculo FROM vehiculo WHERE id_tipo_vehiculo='".$c['id']."'";
                                                    $consulta_existe = $con->consultar($sql_n);
                                                    if($con->num_filas($consulta_existe)>0){
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
                                        $consulta = $con->consultar($sql);
                                        if($con->num_filas($consulta)>0){
                                            echo '<table class="table" border="1">';
                                                echo '<tr>';
                                                echo '<td>Cédula</td>';
                                                echo '<td>Nombre</td>';
                                                echo '<td>Horarios</td>';
                                                echo '</tr>';
                                            foreach ($consulta as $c){
                                                $sql = "SELECT id,lat_o,hora FROM parada WHERE id_cliente='".$c['cedula']."' ORDER BY hora ASC";
                                                $consulta1 = $con->consultar($sql);
                                                echo '<tr>'
                                                . '<td>'.$c['cedula'].'</td>'
                                                . '<td>'.utf8_encode($c['nombre']).' '.utf8_encode($c['apellido']).'</td>';
                                                    if($con->num_filas($consulta1)>0){
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
                                            $con->cerrar_conexion();
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
                    
                    <script>
                    function Guardar_transporte(){
                        document.getElementById("resultado_eleccion").innerHTML = '';
                        var fecha = document.getElementById("fecha_transporte").value;
                        var asientos = document.getElementById("selectvehiculos").value;
                        var check = $('input[type=checkbox]:checked').map(function(){return this.value}).get();
                        var rif = <?php echo "'".$_SESSION['rif']."'"; ?>;
                        var latitud = <?php echo "'".$_SESSION['latitud']."'"; ?>;
                        var longitud = <?php echo "'".$_SESSION['longitud']."'"; ?>;
                        xhttp = new XMLHttpRequest();
                        var param = jQuery.param({
                            fecha:fecha,
                            asientos:asientos,
                            ids:check,
                            rif:rif,
                            latitud:latitud,
                            longitud:longitud
                        });
                        xhttp.onreadystatechange = function(){
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("resultado_eleccion").innerHTML = xhttp.responseText;
                                document.getElementById("fecha_transporte").value = '';
                            }
                        };
                        xhttp.open("POST", "services/web/armar_rutas.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send(param);
                    }
                    </script>
                    
                    <script>
                        $.datepicker.regional['es'] = {
                        closeText: 'Cerrar',
                        prevText: '<Ant',
                        nextText: 'Sig>',
                        currentText: 'Hoy',
                        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
                        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
                        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
                        weekHeader: 'Sm',
                        dateFormat: 'dd-mm-yy',
                        firstDay: 1,
                        isRTL: false,
                        showMonthAfterYear: false,
                        yearSuffix: ''
                        };
                        $.datepicker.setDefaults($.datepicker.regional['es']);
                    $(function() {
                        $("#fecha_transporte").datepicker({
                            startDate: '-1d',
                            endDate: '+2m'
                        });
                        $("#fecha_eliminar_orden").datepicker({
                            startDate: '-1d',
                            endDate: '+2m'
                        });

                    });
                    </script>
                    
                    <?php
                    }
                    if(in_array(13, $_SESSION['permisos'])){
                    ?>

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

                    <script>
                        function buscar_orden(){
                            var fecha = document.getElementById("fecha_eliminar_orden").value;
                            var rif = <?php echo "'".$_SESSION['rif']."'"; ?>;
                            var latitud = <?php echo "'".$_SESSION['latitud']."'"; ?>;
                            xhttp = new XMLHttpRequest();
                            var param = jQuery.param({
                                fecha:fecha,
                                rif:rif,
                                latitud:latitud
                            });
                            xhttp.onreadystatechange = function(){
                                if (xhttp.readyState == 4 && xhttp.status == 200) {
                                    document.getElementById("buscar_eliminar_orden").innerHTML = xhttp.responseText;
                                }
                            };
                            xhttp.open("POST", "services/web/buscar_orden.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send(param);
                        }
                        
                        function eliminar_orden(){
                            if(confirm('Seguro desea eliminar esta orden?')){
                                var fecha = document.getElementById("fecha_eliminar_orden").value;
                                var rif = <?php echo "'".$_SESSION['rif']."'"; ?>;
                                xhttp = new XMLHttpRequest();
                                var param = jQuery.param({
                                    fecha:fecha,
                                    rif:rif
                                });
                                xhttp.onreadystatechange = function(){
                                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                                        document.getElementById("buscar_eliminar_orden").innerHTML = xhttp.responseText;
                                    }
                                };
                                xhttp.open("POST", "services/web/eliminar_orden.php", true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhttp.send(param);
                            }
                        }
                    </script>
                    
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <?php
            if(in_array(19, $_SESSION['permisos'])){
        ?>
        <!--INCIDENCIAS-->
        <div id="incidencia" class="tab-pane fade">
            <div class="container">
                <br><br>
                <h3 style="text-align: center;"><strong>Incidencias</strong></h3>
                <div>
                    <div class="contact col-lg-12">
                        <div class="contact-top">
                            <div class="contact-bottom">
                                <form method="POST">
                                    <div id="registro_incidencia">
                                        <table class="table" border="1" id="tabla_incidencia">
                                            <tr>
                                                <td><strong>ID</strong></td>
                                                <td><strong>CONDUCTOR</strong></td>
                                                <td><strong>VEHICULO</strong></td>
                                                <td><strong>TIPO INCIDENCIA</strong></td>
                                                <td><strong>FECHA</strong></td>
                                                <td><strong>HORA</strong></td>
                                                <td><strong>TELEFONO DEL CHOFER</strong></td>
                                                <td><strong>ACCIÓN</strong></td>
                                            </tr>
                                            <?php
                                            //require_once './conexion.php';
                                            $con = new Conexion();
                                            $sql_incidencia = 'SELECT incidencia.*,chofer.id_usuario,chofer.nombre,chofer.apellido,chofer.telefono,vehiculo.modelo FROM incidencia '
                                                    . 'INNER JOIN chofer ON chofer.id_usuario = incidencia.id_usuario '
                                                    . 'INNER JOIN vehiculo ON chofer.id_cedula = vehiculo.id_chofer '
                                                    . 'WHERE revisado=0';
                                            $consulta_incidencia = $con->consultar($sql_incidencia);
                                            if($con->num_filas($consulta_incidencia)>0){
                                                foreach ($consulta_incidencia as $ci){
                                                    echo '<tr id="'.$ci['id'].'">';
                                                    echo '<td>'.$ci['id_usuario'].'</td>';
                                                    echo '<td>'.$ci['nombre'].' '.$ci['apellido'].'</td>';
                                                    echo '<td>'.$ci['modelo'].'</td>';
                                                    if($ci['id_tipo_incidencia']==1){
                                                        echo '<td>ACCIDENTADO</td>';
                                                    }elseif($ci['id_tipo_incidencia']==2){
                                                        echo '<td>RETRASO DEL CHOFER</td>';
                                                    }elseif($ci['id_tipo_incidencia']==3){
                                                        echo '<td>PASAJERO EXTRA<br>'.$ci['id_cliente'].'</td>';
                                                    }elseif($ci['id_tipo_incidencia']==4){
                                                        echo '<td>CONTACTAR OPERADORA</td>';
                                                    }elseif($ci['id_tipo_incidencia']==5){
                                                        $sql = "SELECT cliente.nombre,cliente.apellido,empresa.nombre as empresa FROM cliente "
                                                             . "INNER JOIN empresa ON empresa.rif = cliente.rif_empresa "
                                                             . "WHERE cliente.cedula='".$ci['id_cliente']."'";
                                                        $consulta_cliente = $con->consultar($sql);
                                                        foreach ($consulta_cliente as $cc){
                                                            echo '<td>PASAJERO AUSENTE<br>'.$cc['nombre'].' '.$cc['apellido'].'<br>'.$cc['empresa'].'</td>';
                                                        }
                                                    }elseif($ci['id_tipo_incidencia']==6){
                                                        $sql = "SELECT cliente.nombre,cliente.apellido,empresa.nombre as empresa FROM cliente "
                                                             . "INNER JOIN empresa ON empresa.rif = cliente.rif_empresa "
                                                             . "WHERE cliente.cedula='".$ci['id_cliente']."'";
                                                        $consulta_cliente = $con->consultar($sql);
                                                        foreach ($consulta_cliente as $cc){
                                                            echo '<td>RETRASO DEL PASAJERO<br>'.$cc['nombre'].' '.$cc['apellido'].'<br>'.$cc['empresa'].'</td>';
                                                        }
                                                    }
                                                    echo '<td>'.$ci['fecha'].'</td><td>'.date_format(new DateTime($ci['hora']), 'h:i:s a').'</td>';
                                                    echo '<td>'.$ci['telefono'].'</td>';
                                                    echo '<td><button type="submit" onclick="deleteRow_inc(this);return false;" value="Revisado"><img src="images/delete1.ico" alt="Revisado" width="15"></button></td>';
                                                    echo '</tr>';
                                                    echo '<input type="hidden" id="'.$ci['id'].'" value="'.$ci['id'].'">';
                                                }
                                            }else{
                                                echo '<tr><td colspan=8><i>No hay incidencias en este momento</i></td></tr>';
                                            }
                                            $con->cerrar_conexion();
                                            ?>
                                        </table>
                                        <div id="incidencia_post"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <script>
                        function deleteRow_inc(i) {
                            document.getElementById('incidencia_post').innerHTML= '';
                            var tbl = i.parentNode.parentNode.parentNode;
                            var row = i.parentNode.parentNode.rowIndex;
                            tbl.deleteRow(row);
                            var id = i.parentNode.parentNode.id;
                            
                            var id_inc = document.getElementById(id).value;
                            xhttp = new XMLHttpRequest();
                            var param = jQuery.param({
                                id:id_inc
                            });
                            xhttp.onreadystatechange = function(){
                                if (xhttp.readyState == 4 && xhttp.status == 200) {
                                    document.getElementById("incidencia_post").innerHTML = xhttp.responseText;
                                }
                            };
                            xhttp.open("POST", "services/web/revisar_incidencia.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send(param);
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            }
        ?>

        <!--MENSAJERIA-->
        <div id="difusion" class="tab-pane fade">
            <div class="container"><br>
                <h3>Mensajería</h3>
            </div>
            <div class="container">
            <div class="contact col-lg-6">
                <div class="contact-top">
                    <div class="contact-bottom">
        <?php
            if(in_array(17, $_SESSION['permisos'])){
        ?>
                        <form name="frmRegistro" method="POST">
                            <p>Mensajería Movil (APP)</p>
                            <input type="text" value="Título" id="titulo_difusion" onfocus="if(this.value=='Título') this.value='';" onblur="if (this.value == '') {this.value = 'Título';}">
                            <textarea id="texto_difusion" onfocus="if(this.value=='Texto') this.value='';" onblur="if(this.value == '') {this.value = 'Texto';}" >Texto</textarea>
                            <input type="submit" value="Enviar" onclick="difusion();return false;"><br>
                        </form>
                        <div id="resultado_difusion"></div>
                        
                        <script>
                        function difusion(){
                            document.getElementById('resultado_difusion').innerHTML = '';
                            var titulo = document.getElementById("titulo_difusion").value;
                            var texto = document.getElementById("texto_difusion").value;
                            xhttp = new XMLHttpRequest();
                            var param = jQuery.param({
                                titulo:titulo,
                                texto:texto
                            });
                            xhttp.onreadystatechange = function(){
                                if (xhttp.readyState == 4 && xhttp.status == 200) {
                                    document.getElementById("resultado_difusion").innerHTML = xhttp.responseText;
                                }
                            };
                            xhttp.open("POST", "services/web/push_android.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send(param);
                        }
                        </script>
                        
                        <?php
            }
            if(in_array(18, $_SESSION['permisos'])){
                        ?>
                        
                        <form name="frmRegistro" method="POST"  enctype="multipart/form-data">
                            <p>Mensajería WEB (Noticias)</p>
                            <input type="text" value="Título" id="titulo_difusion_web" onfocus="if(this.value=='Título') this.value='';" onblur="if (this.value == '') {this.value = 'Título';}">
                            <textarea id="texto_difusion_web" onfocus="if(this.value=='Texto') this.value='';" onblur="if(this.value == '') {this.value = 'Texto';}" >Texto</textarea>
                            <p>Ancho mínimo recomendado: 1140px </p>
                            <input type="file" class="form-control" id="file_noticias"><br>
                            <input type="submit" value="Enviar" onclick="difu_web();return false;"><br>
                        </form>
                        <div id="resultado_difusion_web"></div>
        
        <script>
            function difu_web(){
                document.getElementById("resultado_difusion_web").innerHTML = '';
                var data = new FormData();
                var tituloweb = document.getElementById("titulo_difusion_web").value;
                var textoweb = document.getElementById("texto_difusion_web").value;
                jQuery.each(jQuery('#file_noticias')[0].files, function(i, file) {
                    data.append('file-'+i, file);
                });
                data.append('titulo', tituloweb);
                data.append('texto', textoweb);
                jQuery.ajax({
                url: 'services/web/difusion_web.php',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    document.getElementById("resultado_difusion_web").innerHTML = data;
                }
                });
            }
        </script>
        <?php
            }
        ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <!--COSTOS-->
        <div id="costos" class="tab-pane fade">
            <div class="container"><br>
                <h3>Cree, edite o elimine costos y precios</h3>
            </div>
            <div class="container">
            <div class="container contact col-lg-12">
                <div class="contact-top">
                    <div class="contact-bottom">
                        <?php
                        if(in_array(20, $_SESSION['permisos'])){
                        ?>
                        <form name="frmCostos" method="POST">
                            <h4><strong>Costos por Tipo de Ruta</strong></h4><br>
                            <table class="table" id="tabla_costo_ruta" border="1">
                                <tr>
                                    <td><strong>Nombre</strong></td>
                                    <td><strong>Costo</strong></td>
                                    <td><strong>Precio</strong></td>
                                    <td><strong>Acción</strong></td>
                                </tr>
                                <?php
                                //include './conexion.php';
                                $con = new Conexion();
                                
                                $sql_tipo = "SELECT * FROM tipo_ruta WHERE estatus=1";
                                $consulta_rutas = $con->consultar($sql_tipo);
                                
                                if($con->num_filas($consulta_rutas)==0){
                                    echo '<tr colspan="3"><i>No existen costos por ruta</i></tr>';
                                }else{
                                    foreach ($consulta_rutas as $cr){
                                        echo '<tr id="'.$cr['id'].'">';
                                        echo '<td><input type="text" id="desc_costo_ruta" value="'.$cr['descripcion'].'"></td>';
                                        echo '<td><input type="text" id="costo_costo_ruta" value="'.$cr['costo'].'"></td>';
                                        echo '<td><input type="text" id="precio_costo_ruta" value="'.$cr['precio'].'"></td>';
                                        echo '<td>'
                                            . '<button type="submit" onClick="guardar_costo_ruta(this);return false;"><img src="images/gc.png" alt="Guardar" heigth="25" width="15"></button>'
                                            . '<button type="submit" onClick="eliminar_costo_ruta(this);return false;"><img src="images/delete1.ico" alt="Eliminar" width="15"></button>'
                                            . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                $con->cerrar_conexion();
                                ?>
                            </table>
                            <input type="submit" value="Agregar Tipo de Ruta" onclick="agregar_costo_ruta();return false;"><br><br>
                            <div id="resultado_costos_ruta"></div><br><br>
                            
                            <script>
                            function agregar_costo_ruta(){
                                // Obtener la referencia del elemento tabla
                                var tabla = document.getElementById("tabla_costo_ruta");
                                // Crea las celdas
                                for (var i = 0; i < 1; i++) {
                                    // Crea una fila
                                    var hilera = document.createElement("tr");
                                    // Crea un elemento <td> y un nodo de texto
                                    var celda = document.createElement("td");
                                    var celda1 = document.createElement("td");
                                    var celda2 = document.createElement("td");
                                    var celda3 = document.createElement("td");
                                    var input = document.createElement("input");
                                    var input1 = document.createElement("input");
                                    var input2 = document.createElement("input");
                                    var boton = document.createElement("button");
                                    var boton1 = document.createElement("button");
                                    var x = document.createElement("IMG");
                                    var x1 = document.createElement("IMG");
                                    x.setAttribute("src", "images/delete1.ico");
                                    x.setAttribute("alt", "Eliminar");
                                    x.setAttribute("width", "15");
                                    x1.setAttribute("src", "images/gc.png");
                                    x1.setAttribute("alt", "Guardar");
                                    x1.setAttribute("width", "15");
                                    boton.appendChild(x);
                                    boton.type = "submit";
                                    boton.setAttribute("onclick", "eliminar_costo_ruta(this);return false;");
                                    boton.value = "Eliminar";
                                    boton1.appendChild(x1);
                                    boton1.type = "submit";
                                    boton1.setAttribute("onclick", "guardar_costo_ruta(this);return false;");
                                    boton1.value = "Guardar";
                                    //Agrega el texto a la celda y la celda a la fila
                                    celda.appendChild(input);
                                    celda1.appendChild(input1);
                                    celda2.appendChild(input2);
                                    celda3.appendChild(boton1)
                                    celda3.appendChild(boton);
                                    hilera.appendChild(celda);
                                    hilera.appendChild(celda1);
                                    hilera.appendChild(celda2);
                                    hilera.appendChild(celda3);
                                    hilera.setAttribute("align", "center");
                                    hilera.setAttribute("height", "39px");
                                    tabla.appendChild(hilera);
                                }
                            }

                            function guardar_costo_ruta(i){
                                document.getElementById('resultado_costos_ruta').innerHTML = '';
                                var id = i.parentNode.parentNode.id;
                                var row = i.parentNode.parentNode.rowIndex;
                                var nombre = document.getElementById("tabla_costo_ruta").rows[row].cells[0].childNodes[0].value;
                                var costo = document.getElementById("tabla_costo_ruta").rows[row].cells[1].childNodes[0].value;
                                var precio = document.getElementById("tabla_costo_ruta").rows[row].cells[2].childNodes[0].value;
                                var tipo = 11;

                                xhttp = new XMLHttpRequest();
                                var param = jQuery.param({
                                    id:id,
                                    tipo:tipo,
                                    nombre:nombre,
                                    costo_ruta:costo,
                                    precio_ruta:precio
                                });
                                xhttp.onreadystatechange = function(){
                                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                                        document.getElementById("resultado_costos_ruta").innerHTML = xhttp.responseText;
                                    }
                                };
                                xhttp.open("POST", "services/web/guardar_costo.php", true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhttp.send(param);
                            }

                            function eliminar_costo_ruta(i){
                                document.getElementById('resultado_costos_ruta').innerHTML = '';
                                var tbl = i.parentNode.parentNode.parentNode;
                                var row = i.parentNode.parentNode.rowIndex;
                                tbl.deleteRow(row);
                                var id = i.parentNode.parentNode.id;
                                var tipo = 12;

                                xhttp = new XMLHttpRequest();
                                var param = jQuery.param({
                                    id:id,
                                    tipo:tipo
                                });
                                xhttp.onreadystatechange = function(){
                                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                                        document.getElementById("resultado_costos_ruta").innerHTML = xhttp.responseText;
                                    }
                                };
                                xhttp.open("POST", "services/web/guardar_costo.php", true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhttp.send(param);
                            }
                            </script>
                            
                        <?php
                        }
                        if(in_array(21, $_SESSION['permisos'])){
                        ?>
                            
                            <h4><strong>Costos por Tipo de Vehículo</strong></h4><br>
                            <table class="table" id="tabla_costo_vehiculo" border="1">
                                <tr>
                                    <td><strong>Tipo de Vehículo</strong></td>
                                    <td><strong>Número de puestos</strong></td>
                                    <td><strong>Costo</strong></td>
                                    <td><strong>Precio</strong></td>
                                    <td><strong>Acción</strong></td>
                                </tr>
                                <?php
                                //include './conexion.php';
                                $con = new Conexion();
                                
                                $sql_vehiculo = "SELECT * FROM tipo_vehiculo WHERE estatus=1";
                                $consulta_vehiculo = $con->consultar($sql_vehiculo);
                                
                                if($con->num_filas($consulta_vehiculo)==0){
                                    echo '<tr colspan="4"><i>No existen costos por vehículo</i></tr>';
                                }else{
                                    foreach ($consulta_vehiculo as $cv){
                                        echo '<tr id="'.$cv['id'].'">';
                                        echo '<td><input type="text" id="nombre_costo_vehiculo" value="'.$cv['nombre'].'"></td>';
                                        echo '<td><input type="text" id="puestos_costo_vehiculo" value="'.$cv['nro_puestos'].'"></td>';
                                        echo '<td><input type="text" id="costo_costo_vehiculo" value="'.$cv['costo'].'"></td>';
                                        echo '<td><input type="text" id="precio_costo_vehiculo" value="'.$cv['precio'].'"></td>';
                                        echo '<td>'
                                            . '<button type="submit" onClick="guardar_costo_vehiculo(this);return false;"><img src="images/gc.png" alt="Guardar" heigth="25" width="15"></button>'
                                            . '<button type="submit" onClick="eliminar_costo_vehiculo(this);return false;"><img src="images/delete1.ico" alt="Eliminar" width="15"></button>'
                                            . '</td>';
                                        echo '</tr>';
                                    }
                                }
                                $con->cerrar_conexion();
                                ?>
                            </table>
                            <input type="submit" value="Agregar Tipo de Vehiculo" onclick="agregar_costo_vehiculo();return false;"><br>
                            <div id="resultado_costos_vehiculo"></div>
                        </form>
                        
                        <script>
                            function agregar_costo_vehiculo(){
                                 // Obtener la referencia del elemento tabla
                                var tabla = document.getElementById("tabla_costo_vehiculo");
                                // Crea las celdas
                                for (var i = 0; i < 1; i++) {
                                    // Crea una fila
                                    var hilera = document.createElement("tr");
                                    // Crea un elemento <td> y un nodo de texto
                                    var celda = document.createElement("td");
                                    var celda1 = document.createElement("td");
                                    var celda2 = document.createElement("td");
                                    var celda3 = document.createElement("td");
                                    var celda4 = document.createElement("td");
                                    var input = document.createElement("input");
                                    var input1 = document.createElement("input");
                                    var input2 = document.createElement("input");
                                    var input3 = document.createElement("input");
                                    var boton = document.createElement("button");
                                    var boton1 = document.createElement("button");
                                    var x = document.createElement("IMG");
                                    var x1 = document.createElement("IMG");
                                    x.setAttribute("src", "images/delete1.ico");
                                    x.setAttribute("alt", "Eliminar");
                                    x.setAttribute("width", "15");
                                    x1.setAttribute("src", "images/gc.png");
                                    x1.setAttribute("alt", "Guardar");
                                    x1.setAttribute("width", "15");
                                    boton.appendChild(x);
                                    boton.type = "submit";
                                    boton.setAttribute("onclick", "eliminar_costo_vehiculo(this);return false;");
                                    boton.value = "Eliminar";
                                    boton1.appendChild(x1);
                                    boton1.type = "submit";
                                    boton1.setAttribute("onclick", "guardar_costo_vehiculo(this);return false;");
                                    boton1.value = "Guardar";
                                    //Agrega el texto a la celda y la celda a la fila
                                    celda.appendChild(input);
                                    celda1.appendChild(input1);
                                    celda2.appendChild(input2);
                                    celda3.appendChild(input3);
                                    celda4.appendChild(boton1);
                                    celda4.appendChild(boton);
                                    hilera.appendChild(celda);
                                    hilera.appendChild(celda1);
                                    hilera.appendChild(celda2);
                                    hilera.appendChild(celda3);
                                    hilera.appendChild(celda4);
                                    hilera.setAttribute("align", "center");
                                    hilera.setAttribute("height", "39px");
                                    tabla.appendChild(hilera);
                                }
                            }
                            function guardar_costo_vehiculo(i){
                                document.getElementById('resultado_costos_vehiculo').innerHTML = '';
                                var row = i.parentNode.parentNode.rowIndex;
                                var nombre = document.getElementById("tabla_costo_vehiculo").rows[row].cells[0].childNodes[0].value;
                                var nro_puestos = document.getElementById("tabla_costo_vehiculo").rows[row].cells[1].childNodes[0].value;
                                var costo = document.getElementById("tabla_costo_vehiculo").rows[row].cells[2].childNodes[0].value;
                                var precio = document.getElementById("tabla_costo_vehiculo").rows[row].cells[3].childNodes[0].value;
                                var id = i.parentNode.parentNode.id;
                                var tipo = 21;

                                xhttp = new XMLHttpRequest();
                                var param = jQuery.param({
                                    id:id,
                                    tipo:tipo,
                                    nombre:nombre,
                                    nro_puestos:nro_puestos,
                                    costo_ruta:costo,
                                    precio_ruta:precio
                                });
                                xhttp.onreadystatechange = function(){
                                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                                        document.getElementById("resultado_costos_vehiculo").innerHTML = xhttp.responseText;
                                    }
                                };
                                xhttp.open("POST", "services/web/guardar_costo.php", true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhttp.send(param);
                            }

                            function eliminar_costo_vehiculo(i){
                                document.getElementById('resultado_costos_vehiculo').innerHTML = '';
                                var tbl = i.parentNode.parentNode.parentNode;
                                var row = i.parentNode.parentNode.rowIndex;
                                tbl.deleteRow(row);
                                var id = i.parentNode.parentNode.id;
                                var tipo = 22;

                                xhttp = new XMLHttpRequest();
                                var param = jQuery.param({
                                    id:id,
                                    tipo:tipo
                                });
                                xhttp.onreadystatechange = function(){
                                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                                        document.getElementById("resultado_costos_vehiculo").innerHTML = xhttp.responseText;
                                    }
                                };
                                xhttp.open("POST", "services/web/guardar_costo.php", true);
                                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xhttp.send(param);
                            }
                        </script>
                        
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <?php
        if(in_array(22, $_SESSION['permisos'])){
        ?>
        <!--PERMISOS-->
        <div id="permisos" class="tab-pane fade">
            <div class="container">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a data-toggle="pill" href="#editar_permisos_rol">Permisos Por Rol</a></li>
                    </ul>
                </div>
                <div class="col-md-9 tab-pane fade" id="editar_permisos_rol">
                    <h3>Editar Permisos</h3>
                    <p>Haga click en un rol y defina los permisos para el uso de UPY3</p>
                    <ul class="nav nav-pills">
                        <?php
                        //include './conexion.php';
                        $con = new Conexion();
                        $sql_roles = "SELECT * FROM rol";
                        $consulta = $con->consultar($sql_roles);
                        foreach ($consulta as $c){
                            if($c['id']!=1 && $c['id']!=3){
                                echo '<li onclick="buscar_rol(this.id)" id="'.$c['id'].'"><a data-toggle="pill">'.$c['nombre'].'</a></li>';
                            }
                        }
                        ?>
                    </ul>
                    <br><br>
                    <div id="permisos_por_rol"></div>
                </div>
            </div>
        </div>
        
        <script>
            function buscar_rol(r){
                xhttp = new XMLHttpRequest();
                var param = jQuery.param({
                    id:r
                });
                xhttp.onreadystatechange = function(){
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("permisos_por_rol").innerHTML = xhttp.responseText;
                    }
                };
                xhttp.open("POST", "services/web/buscar_permisos_por_rol.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(param);
            }
            
            function actualizar_permisos_por_rol(){
                var id = document.getElementById("id_rol_editado").value;
                var permisos = $('input:checkbox[id^="lista_de_permisos"]:checked').map(function(){return this.value}).get();
                xhttp = new XMLHttpRequest();
                var param = jQuery.param({
                    id:id,
                    permisos:permisos
                });
                xhttp.onreadystatechange = function(){
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("resultado_actualizar_permisos").innerHTML = xhttp.responseText;
                    }
                };
                xhttp.open("POST", "services/web/actualizar_permisos_por_rol.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(param);
            }
        </script>
        
        <?php
        }
        if(in_array(23, $_SESSION['permisos'])){
        ?>

        <div id="usuarios" class="tab-pane fade">
            <div class="container">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a data-toggle="pill" href="#crear_usuarios">Creación de Usuarios</a></li>
                        <li><a data-toggle="pill" href="#editar_usuarios">Edición de Usuarios</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="col-md-9 tab-pane fade" id="crear_usuarios">
                        <br><br>
                        <h4>Creación de Usuarios</h4>
                        <p>Cree un nombre de usuario, elija la compañía y elija su rol</p><br>
                        <form class="contact-bottom text-center">
                            <input type="text" placeholder="Usuario" id="id_usuario">
                            <input type="password" placeholder="Password" id="pass_usuario">
                            <p class="text-left">Empresa:</p>
                            <?php
                            //include './conexion.php';
                            $con = new Conexion();
                            $sql = "SELECT rif,nombre FROM empresa";
                            $consulta = $con->consultar($sql);
                            echo '<select class="form-control" id="select_crear_usuario">';
                            foreach ($consulta as $c){
                                if ($c['rif']!='V-19850475-'){
                                    echo '<option value="'.$c['rif'].'">'.$c['nombre'].'</option>';
                                }
                            }
                            echo '</select>';
                            $sql = "SELECT * FROM rol";
                            $consulta = $con->consultar($sql);
                            echo '<p class="text-left">Rol:</p>';
                            echo '<select class="form-control" id="select_crear_usuario_rol">';
                            foreach ($consulta as $c){
                                if ($c['id']!=1){
                                    echo '<option value="'.$c['id'].'">'.$c['nombre'].'</option>';
                                }
                            }
                            echo '</select><br><br>';
                            $con->cerrar_conexion();
                            ?>
                            <input type="submit" value="Crear" id="crear_usuario" onclick="crear_usuario_script();return false;">
                            <div id="resultado_crear_usuarios"></div>
                        </form>
                    </div>
                    <div class="col-md-9 tab-pane fade" id="editar_usuarios">
                        <br><br>
                        <h4>Editar Usuarios</h4>
                        <p>Escriba un nombre de usuario, marque la sugerencia y haga click en la lupa</p><br>
                        <form style="width: 500px;">
                            <input type="text" class="form-control" placeholder="Buscar" id="txteditar_usuario">
                            <span class="input-group-btn">
                            <button class="btn btn-default" href="javascript:;" onclick="buscar_usuario();return false;">
                                <i style="color: #337ab7" class="glyphicon glyphicon-search"></i>
                            </button>
                            </span>
                        </form>
                        <div id="resultado_busqueda_usuario"></div>
                    </div>
                    <div id="autocompletar_usuario"></div>
                </div>
            </div>
        </div>
        
        <script>
        function crear_usuario_script(){
            document.getElementById("resultado_crear_usuarios").innerHTML = '';
            var id_usuario = document.getElementById("id_usuario").value;
            var pass = document.getElementById("pass_usuario").value;
            var rif = document.getElementById("select_crear_usuario").value;
            var rol = document.getElementById("select_crear_usuario_rol").value;
            xhttp = new XMLHttpRequest();
            var param = jQuery.param({
                id:id_usuario,
                pass:pass,
                rif:rif,
                rol:rol,
                tipo:1
            });
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("resultado_crear_usuarios").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "services/web/crear_editar_usuario.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(param);
        }
        
        function buscar_usuario(){
            var id_usuario = document.getElementById("txteditar_usuario").value;
            xhttp = new XMLHttpRequest();
            var param = jQuery.param({
                id:id_usuario
            });
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("resultado_busqueda_usuario").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "services/web/buscar_usuario.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(param);
        }
        
        function editar_usuario_script(){
            document.getElementById("resultado_editar_usuarios").innerHTML = '';
            var id_usuario_viejo = document.getElementById("id_usuario_editar_viejo").value;
            var id_usuario = document.getElementById("id_usuario_editar").value;
            var pass = document.getElementById("pass_usuario_editar").value;
            var rif = document.getElementById("select_empresa_editar_usuario").value;
            var rol = document.getElementById("select_rol_editar_usuario").value;
            xhttp = new XMLHttpRequest();
            var param = jQuery.param({
                id_viejo:id_usuario_viejo,
                id:id_usuario,
                pass:pass,
                rif:rif,
                rol:rol,
                tipo:2
            });
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("resultado_editar_usuarios").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "services/web/crear_editar_usuario.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(param);
        }
        
        $(document).ready(function(){
            $(txteditar_usuario).autocomplete({
                source: 'services/web/autocompletar_usuario.php'
            });
        });
        </script>
        
        <?php
        }
        ?>

        <!--REPORTES-->
        <div id="reportes" class="tab-pane fade">
            <div class="container">
                <h3>REPORTES</h3>
                <p>Seleccione el reporte a visualizar</p>
            </div>
            <div class="container">
                <p>Fecha de Inicio</p>
                <input type="text" id="fecha_inicio_reporte">
                <p>Fecha Fin</p>
                <input type="text" id="fecha_fin_reporte"><br><br>
                <?php
                //include './conexion.php';
                $con = new Conexion();
                if(in_array(26, $_SESSION['permisos']) || in_array(27, $_SESSION['permisos'])){
                    $sql = "SELECT rif,nombre FROM empresa";
                    $consulta = $con->consultar($sql);
                    echo '<select id="select_reporte_empresa">';
                    foreach ($consulta as $c){
                        if ($c['rif']!=$_SESSION['rif'] && $c['rif']!='V-19850475-7'){
                            echo '<option value="'.$c['rif'].'">'.$c['nombre'].'</option>';
                        }
                    }
                    echo '</select><br><br>';
                }
                if(in_array(28, $_SESSION['permisos'])){
                    $sql = "SELECT * FROM chofer";
                    $consulta = $con->consultar($sql);
                    echo '<select id="select_reporte_chofer">';
                    foreach ($consulta as $c){
                        echo '<option value="'.$c['id_cedula'].'">'.$c['id_cedula'].' - '.$c['nombre'].' '.$c['apellido'].'</option>';
                    }
                    echo '</select><br><br>';
                }
                if(in_array(24, $_SESSION['permisos'])){
                    echo '<a onclick="reporte_incidencias();return false;" target="_blank">Reporte de Incidencias</a><br>';
                }
                if(in_array(25, $_SESSION['permisos'])){
                    echo '<a onclick="reporte_disponibilidad();return false;" target="_blank">Reporte de Disponibilidad</a><br>';
                }
                if(in_array(26, $_SESSION['permisos'])){
                    echo '<a onclick="reporte_incidencias_por_empresa();return false;" target="_blank">Reporte de Incidencias Por Empresa</a><br>';
                }
                if(in_array(27, $_SESSION['permisos'])){
                    echo '<a onclick="reporte_rutas_por_empresa();return false;" target="_blank">Reporte de Rutas Por Empresa</a><br>';
                }
                if(in_array(28, $_SESSION['permisos'])){
                    echo '<a onclick="reporte_chofer_costos();return false;" target="_blank">Reporte de Costos por Chofer</a><br>';
                }
                if(in_array(29, $_SESSION['permisos'])){
                    echo '<a onclick="reporte_rutas_de_la_empresa();return false;" target="_blank">Reporte de Rutas</a><br>';
                }
                if(in_array(30, $_SESSION['permisos'])){
                    echo '<a onclick="reporte_incidencias_de_la_empresa();return false;" target="_blank">Reporte de Incidencias</a><br>';
                }
                ?>
                <br>
                <div id="resultado_reportes"></div>
            </div>
        </div>
        
        <script>
            function reporte_incidencias(){
                var fecha_inicio = document.getElementById("fecha_inicio_reporte").value;
                var fecha_fin = document.getElementById("fecha_fin_reporte").value;
                if(fecha_inicio!='' && fecha_fin!=''){
                    var win = window.open('reports/reporte_incidencias.php?ini='+fecha_inicio+'&fin='+fecha_fin, '_blank');
                    win.focus();
                }else{
                    alert("Ingrese las fechas solicitadas");
                }
            }
            
            function reporte_disponibilidad(){
                var fecha_inicio = document.getElementById("fecha_inicio_reporte").value;
                var fecha_fin = document.getElementById("fecha_fin_reporte").value;
                if(fecha_inicio!='' && fecha_fin!=''){
                    var win = window.open('reports/reporte_disponibilidad.php?ini='+fecha_inicio+'&fin='+fecha_fin, '_blank');
                    win.focus();
                }else{
                    alert("Ingrese las fechas solicitadas");
                }
            }
            
            function reporte_incidencias_por_empresa(){
                var fecha_inicio = document.getElementById("fecha_inicio_reporte").value;
                var fecha_fin = document.getElementById("fecha_fin_reporte").value;
                var rif = document.getElementById("select_reporte_empresa").value;
                if(fecha_inicio!='' && fecha_fin!=''){
                    var win = window.open('reports/reporte_incidencias_por_empresa.php?ini='+fecha_inicio+'&fin='+fecha_fin+'&rif='+rif, '_blank');
                    win.focus();
                }else{
                    alert("Ingrese las fechas solicitadas");
                }
            }
            
            function reporte_rutas_por_empresa(){
                var fecha_inicio = document.getElementById("fecha_inicio_reporte").value;
                var fecha_fin = document.getElementById("fecha_fin_reporte").value;
                var rif = document.getElementById("select_reporte_empresa").value;
                if(fecha_inicio!='' && fecha_fin!=''){
                    var win = window.open('reports/reporte_rutas_por_empresa.php?ini='+fecha_inicio+'&fin='+fecha_fin+'&rif='+rif, '_blank');
                    win.focus();
                }else{
                    alert("Ingrese las fechas solicitadas");
                }
            }
            
            function reporte_rutas_de_la_empresa(){
                var fecha_inicio = document.getElementById("fecha_inicio_reporte").value;
                var fecha_fin = document.getElementById("fecha_fin_reporte").value;
                var rif = '<?php echo $_SESSION['rif']; ?>';
                if(fecha_inicio!='' && fecha_fin!=''){
                    var win = window.open('reports/reporte_rutas_de_la_empresa.php?ini='+fecha_inicio+'&fin='+fecha_fin+'&rif='+rif, '_blank');
                    win.focus();
                }else{
                    alert("Ingrese las fechas solicitadas");
                }
            }
            
            function reporte_incidencias_de_la_empresa(){
                var fecha_inicio = document.getElementById("fecha_inicio_reporte").value;
                var fecha_fin = document.getElementById("fecha_fin_reporte").value;
                var rif = '<?php echo $_SESSION['rif']; ?>';
                if(fecha_inicio!='' && fecha_fin!=''){
                    var win = window.open('reports/reporte_incidencias_de_la_empresa.php?ini='+fecha_inicio+'&fin='+fecha_fin+'&rif='+rif, '_blank');
                    win.focus();
                }else{
                    alert("Ingrese las fechas solicitadas");
                }
            }
            
            function reporte_chofer_costos(){
                var fecha_inicio = document.getElementById("fecha_inicio_reporte").value;
                var fecha_fin = document.getElementById("fecha_fin_reporte").value;
                var cedula = document.getElementById("select_reporte_chofer").value;
                if(fecha_inicio!='' && fecha_fin!=''){
                    var win = window.open('reports/reporte_chofer_costos.php?ini='+fecha_inicio+'&fin='+fecha_fin+'&cedula='+cedula, '_blank');
                    win.focus();
                }else{
                    alert("Ingrese las fechas solicitadas");
                }
            }
        </script>
        
        <script>
            $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: '<Ant',
            nextText: 'Sig>',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);
            $(function() {
                $("#fecha_inicio_reporte").datepicker({
                    startDate: '-1d',
                    endDate: '+2m'
                });
                $("#fecha_fin_reporte").datepicker({
                    startDate: '-1d',
                    endDate: '+2m'
                });
            });
        </script>
        
    </div><!--//Tab Content-->

    <?php
        include('footer.php');
    ?>
</body>
</html>