<!DOCTYPE html>
<html>
<head>
<title>UPY | Contacto</title>
<link rel="icon" type="image/png" href="images/ic_launcher.png" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet"><!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
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
    margin: 0;
    padding: 0;
}
#map {
    width: auto;
    height: 400px;
}
.header{
    background-size: 100%;
    min-height: 150px;
}
.top-grid {
    text-align: center;
    border:none;
    padding:0;
    min-height: 280px;
    background: rgba(0, 188, 228, 0.44);
    padding: 2em 1.5em 1.5em;
    position: relative;
}
.top-grid:before{
    border-right: 0px solid rgba(0, 0, 0, 0);
    border-bottom: 0px;
    border-left: 76px solid rgba(60, 128, 168, 0);
    top: 0%;
    left: 0%;
    transform: none;
}
div.container::after{
    min-height: 40px;
}
</style>
</head>
<body>
<!--header-->
<?php
    include ('navbar.php');
?>
<!--contact-->
<div class="container">
    <div class="contact">
	<div class="contact-top">
            <h2>Contáctanos</h2>
            <p>Para nosotros tu opinión es muy importante, te invitamos a que expreses tus observaciones o inquietudes a trav&eacute;s del siguiente formulario para realizar las mejoras pertinentes. </p>
        </div>
        <!--MAP-->
        <div id="map"></div>
        <div class="contact-bottom">
            <form name="frmContacto" method="POST">
                <input type="text" id="nombre" value="Nombre" placeholder="" onfocus="if(this.value=='Nombre') this.value='';" onblur="if (this.value == '') {this.value = 'Nombre';}">
                <input type="text" id="apellido" value="Apellido" placeholder="" onfocus="if(this.value=='Apellido') this.value='';" onblur="if (this.value == '') {this.value = 'Apellido';}">
                <input type="text" id="email" value="Email" placeholder="" onfocus="if(this.value=='Email') this.value='';" onblur="if (this.value == '') {this.value = 'Email';}">
                <textarea placeholder="" id="texto" value="Mensaje" onfocus="if(this.value=='Mensaje') this.value='';" onblur="if(this.value == '') {this.value = 'Mensaje';}" >Mensaje</textarea>
                <input type="submit" value="Enviar" onclick="enviar_mail();return false;">
                <div id="email_result"></div>
            </form>
        </div>
        
        <br><br>

        <div class="col-md-6">
            <div class="top-grid">
                <div class="caption">
                    <form class="contact-bottom" action="registro_empresa.php" method="POST">
                        <h1 style="color: white;">Si estas interesado en contratar nuestros servicios para tu empresa regístrate</h1><br>
                        <input type="submit" value="Aquí">
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="top-grid">
                <div class="caption">
                    <form class="contact-bottom" action="registro_transporte.php" method="POST">
                        <h2 style="color: white;">Si posees un vehiculo en buen estado, tus papeles actualizados y deseas trabajar con nosotros puedes registrarte</h2>
                        <br>
                        <input type="submit" value="Aquí">
                        <br><br>
                        <h2 style="color: white;">y te contactaremos lo mas pronto posible.</h2>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

    <?php
        include('address.php');
        include('footer.php');
    ?>

    <script>
        function enviar_mail(){
            var nombre = document.getElementById("nombre").value;
            var apellido = document.getElementById("apellido").value;
            var email = document.getElementById("email").value;
            var texto = document.getElementById("texto").value;
            xhttp = new XMLHttpRequest();
            var param = jQuery.param({
                nombre:nombre,
                apellido:apellido,
                email:email,
                texto:texto
            });
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("email_result").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "services/web/enviar_mail.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(param);
        }
    </script>

    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 10.071935, lng: -69.317689},
                zoom: 18
            });
            var marker = new google.maps.Marker({
                position: {lat: 10.071935, lng: -69.317689},
                map: map,
                draggable: false,
                animation: google.maps.Animation.DROP,
                title: 'Logic Service'
              });
        function toggleBounce() {
            if (marker.getAnimation() !== null) {
              marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSWdB4sy4Q3_YKVoiqE259xFcCJ2NCPfU&callback=initMap" async defer></script>

</body>
</html>