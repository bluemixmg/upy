<!DOCTYPE html>
<html>
<head>
<title>UPY | Registro Transportista</title>
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
<div class="container">
    <div class="contact">
	<div class="contact-top">
            <h2>Bienvenido a UPY</h2>
            <p style="text-align: center;">Gracias por estar interesado en trabajar con nosotros, 
                ingresa tus datos personales asi como los de tu vehiculo y nos pondremos en contacto contigo.</p>
        </div>
        <div class="contact-bottom text-center">
            <form class="form-inline" name="frmRegistro" method="POST">
                <label>Datos Personales</label>
                <input type="text" id="txtrif" name="txtrif" value="Numero de Identificacion" placeholder="" onfocus="if(this.value=='Numero de Identificacion') this.value='';" onblur="if (this.value == '') {this.value = 'Numero de Identificacion';}">
                <input type="text" id="txtnombre" name="txtnombre" value="Nombre" placeholder="" onfocus="if(this.value=='Nombre') this.value='';" onblur="if (this.value == '') {this.value = 'Nombre';}">
                <input type="text" id="txtapellido" name="txtapellido" value="Apellido" placeholder="" onfocus="if(this.value=='Apellido') this.value='';" onblur="if (this.value == '') {this.value = 'Apellido';}">
                <select style="width: 455px; float: none; margin: 10px auto;" id="sexo_remple" class="form-control">
                    <option selected="true" id="M" value="M">Masculino</option>
                    <option id="F" value="F">Femenino</option>
                </select>
                <textarea style="width: 455px;" id="txtdireccion" value="" onfocus="if(this.value=='Barquisimeto') this.value='';" onblur="if(this.value == '') {this.value = 'Barquisimeto';}" >Barquisimeto</textarea>
                <input type="text" id="txtcorreo" name="txtcorreo" value="Correo" placeholder="" onfocus="if(this.value=='Correo') this.value='';" onblur="if (this.value == '') {this.value = 'Correo';}">
                <input type="text" id="txttelefono" name="txttelefono" value="Tel&eacute;fono" onfocus="if(this.value=='Tel&eacute;fono') this.value='';" onblur="if (this.value == '') {this.value = 'Tel&eacute;fono';}">
            </form>
        </div>
        <form class="form-inline well text-center" style="width: 455px; float: none; margin: 10px auto;">
            <label>Datos del Vehiculo</label><br>
            <input class="form-control" type="text" id="txtplaca" value="Placa" onfocus="if(this.value=='Placa') this.value='';" onblur="if (this.value == '') {this.value = 'Placa';}">
            <input class="form-control" type="text" id="txtmarca" value="Marca" onfocus="if(this.value=='Marca') this.value='';" onblur="if (this.value == '') {this.value = 'Marca';}">
            <input class="form-control" type="text" id="txtmodelo" value="Modelo" onfocus="if(this.value=='Modelo') this.value='';" onblur="if (this.value == '') {this.value = 'Modelo';}">
            <?php
            require_once './conexion.php';
            $sql = "SELECT * FROM tipo_vehiculo ORDER BY nro_puestos ASC";
            $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
            if (pg_num_rows($consulta)>0){
                echo '<select id="tipo_ve" style="height: 32px;">';
                foreach ($consulta as $c){
                    echo '<option id="'.$c['id'].'" value="'.$c['id'].'">'.$c['nombre'].' ('.$c['nro_puestos'].') puestos</option>';
                }
                echo '</select>';
            }else{
                echo 'No hay tipos registrados';
            }
            $sql1 = 'SELECT * FROM condicion';
            $consulta1 = pg_fetch_all(pg_query($conexion_bd, $sql));
            if (pg_num_rows($consulta1)>0){
                echo '<i>Condiciones del Vehiculo: </i>';
                echo '<select id="cond_ve">';
                foreach ($consulta1 as $c1){
                    echo '<option id="'.$c1['id'].'" value="'.$c1['id'].'">'.$c1['descripcion'].'</option>';
                }
                echo '</select>';
            }else{
                echo 'No hay condiciones registradas';
            }
            pg_close($conexion_bd);
            ?>
        </form>
        <div class="text-center">
            <label><input type="checkbox" id="aceptar" value="1">Acuerdo que he leído y aceptado los <a href="terminos_de_uso.php" target="_blank">términos y condiciones</a></label>
        </div>
        <div class="contact-bottom text-center">
            <input type="submit" onclick="registrar();return false;" value="Registrar">
            <div id="result"></div>
        </div>
    </div>
</div>

<script>
    function registrar(){
        var rif = document.getElementById("txtrif").value;
        var nombre = document.getElementById("txtnombre").value;
        var apellido = document.getElementById("txtapellido").value;
        var sexo = document.getElementById("sexo_remple").value;
        var correo = document.getElementById("txtcorreo").value;
        var direccion = document.getElementById("txtdireccion").value;
        var tlf = document.getElementById("txttelefono").value;
        var placa = document.getElementById("txtplaca").value;
        var marca = document.getElementById("txtmarca").value;
        var modelo = document.getElementById("txtmodelo").value;
        var tipo = document.getElementById("tipo_ve").value;
        var cond = document.getElementById("cond_ve").value;
        var acep = $('input:checkbox:checked').val();
        xhttp = new XMLHttpRequest();
        var param = jQuery.param({
            rif:rif,
            nombre:nombre,
            apellido:apellido,
            sexo:sexo,
            correo:correo,
            direccion:direccion,
            tlf:tlf,
            placa:placa,
            marca:marca,
            modelo:modelo,
            tipo:tipo,
            cond:cond,
            acept:acep
        });
        xhttp.onreadystatechange = function(){
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("result").innerHTML = xhttp.responseText;
            }
        };
        xhttp.open("POST", "services/web/preregistro_chofer.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(param);
    }
</script>


<?php
    include ('./address.php');
    include ('./footer.php');
?>

</body>
</html>