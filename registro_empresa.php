<!DOCTYPE html>
<html>
<head>
<title>UPY | Registro Empresas</title>
<link rel="icon" type="image/png" href="images/ic_launcher.png" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Responsive web template, Service Logic, UPY, UPY3, Servicios de transporte, transporte, transporte de personal, transporte para
      estudiantes, transporte Venezuela, Caracas, Barquisimeto, Valencia, web design, Android" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <style>
    html, body {
        height: 100%;
        margin: auto;
        padding: 0;
    }
    #map {
        width: auto;
        height: 400px;
        margin: auto;
    }
    .header{
        background-size: 100%;
        min-height: 150px;
    }
    .contact-bottom input[type="text"] ,.contact-bottom textarea{
        margin: 10px auto;
        float: none;
    }
    </style>
</head>
<body>
<!--header-->
<?php
    include ('navbar.php');
?>
<!--Registro Empresa-->
<div class="container text-center">
    <div class="contact">
	<div class="contact-top">
            <h2>Bienvenido a UPY</h2>
            <p>Gracias por estar interesado en adquirir nuestros servicios, introduce los datos de tu empresa
            y nos pondremos en contacto contigo.</p>
        </div>
        <div class="contact-bottom">
            <form name="frmRegistro" method="POST">
                <input type="text" id="txtrif" name="txtrif" value="ID Empresa" placeholder="" onfocus="if(this.value=='ID Empresa') this.value='';" onblur="if (this.value == '') {this.value = 'ID Empresa';}">
                <input type="text" id="txtnombre" name="txtnombre" value="Nombre" placeholder="" onfocus="if(this.value=='Nombre') this.value='';" onblur="if (this.value == '') {this.value = 'Nombre';}">
                <textarea id="txtdireccion" onfocus="if(this.value=='Barquisimeto') this.value='';" onblur="if(this.value == '') {this.value = 'Barquisimeto';}" >Barquisimeto</textarea>
                <label>Por favor, ubica tu empresa en el mapa arrastrando el puntero</label>
                <div class="map" id="mapa_regemp" style="height:600px; width: auto; top: 10px;"></div><br><br>
                <input type="text" id="txtcorreo" name="txtcorreo" value="Correo" placeholder="" onfocus="if(this.value=='Correo') this.value='';" onblur="if (this.value == '') {this.value = 'Correo';}">
                <input type="text" id="txttelefono" name="txttelefono" value="Tel&eacute;fono" placeholder="" onfocus="if(this.value=='Tel&eacute;fono') this.value='';" onblur="if (this.value == '') {this.value = 'Tel&eacute;fono';}">
                <input type="hidden" id="lat" name="lat_empre">
                <input type="hidden" id="lng" name="lon_empre">
                <div class="text-center">
                    <label><input type="checkbox" id="aceptar" value="1">Acuerdo que he leído y aceptado los <a href="terminos_de_uso.php" target="_blank">términos y condiciones</a></label>
                </div><br>
                <input type="submit" onclick="registrar();return false;" value="Registrar">
                <div id="result"></div>
            </form>
        </div>
    </div>
</div>

<script>
    function registrar(){
        var rif = document.getElementById("txtrif").value;
        var nombre = document.getElementById("txtnombre").value;
        var direccion = document.getElementById("txtdireccion").value;
        var tlf = document.getElementById("txttelefono").value;
        var correo = document.getElementById("txtcorreo").value;
        var latitud = document.getElementById("lat").value;
        var longitud = document.getElementById("lng").value;
        var acep = $('input:checkbox:checked').val();
        xhttp = new XMLHttpRequest();
        var param = jQuery.param({
            rif:rif,
            nombre:nombre,
            direccion:direccion,
            tlf:tlf,
            correo:correo,
            latitud:latitud,
            longitud:longitud,
            acep:acep
        });
        xhttp.onreadystatechange = function(){
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("result").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("POST", "services/web/preregistro_empresa.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(param);
    }
</script>

    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('mapa_regemp'), {
                center: {lat: 10.071935, lng: -69.317689},
                zoom: 13
            });
            var marker = new google.maps.Marker({
                position: {lat: 10.071935, lng: -69.317689},
                map: map,
                draggable: true
              });
            google.maps.event.addListener(marker, "dragend", function() {
            document.getElementById('lat').value = marker.getPosition().lat();
            document.getElementById('lng').value = marker.getPosition().lng();
          });
          document.getElementById('lat').value = marker.getPosition().lat();
          document.getElementById('lng').value = marker.getPosition().lng();
        }
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSWdB4sy4Q3_YKVoiqE259xFcCJ2NCPfU&callback=initMap" async defer></script>

<?php
    include ('./address.php');
    include ('./footer.php');
?>

</body>
</html>