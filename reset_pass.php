<!DOCTYPE html>
<html>
<head>
<title>UPY3 | Recuperar Password</title>
<link rel="icon" type="image/png" href="images/ic_launcher.png" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<style type="text/css">
.header{
    background-size: 100%;
    min-height: 480px;
    }
form {
    position:absolute;
    left: 50%;
    top: 25%;
}
.contact-bottom input[type="text"] ,.contact-bottom textarea{
	width: 100%;
}
.contact-bottom input[type="password"] ,.contact-bottom textarea{
	width: 100%;
}
#resultado_reset{
    position: absolute;
}
</style>
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Responsive web template, Service Logic, UPY, UPY3, Servicios de transporte, transporte, transporte de personal, transporte para
estudiantes, transporte Venezuela, Caracas, Barquisimeto, Valencia, web design, Android" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>
<body>

    <?php
        include ('navbar.php');
    ?>

    <div class="contact">
        <div class="contact-bottom">
            <form class="form-inline">
                <h4 style="color: white">Ingrese su Correo</h4>
                <input type="text" id="txtid" name="txtid">
                <!--<input type="submit" onclick="r();return false;" value="Enviar"><br><br>-->
                <input type="submit" onclick="r()" value="Enviar"><br><br>
                <div style="height: 200px;width: 300px;color: white;" id="resultado_reset"></div>
            </form>
        </div>
    </div>
    
    <script>
        function r(){
            var correo = document.getElementById("txtid").value;
            xhttp = new XMLHttpRequest();
            var param = jQuery.param({
                correo:correo
            });
            xhttp.onreadystatechange = function(){
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("resultado_reset").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "services/web/recuperar_pass.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(param);
        }
    </script>
    
    <?php
    include './address.php';
    include './footer.php';
    ?>
    
</body>
</html>