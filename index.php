<!DOCTYPE html>
<html>
<head>
<title>Bienvenidos a UPY</title>
<link rel="icon" type="image/png" href="images/ic_launcher.png" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet"><!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Responsive web template, Service Logic, UPY, UPY3, Servicios de transporte, transporte, transporte de personal, transporte para estudiantes, transporte Venezuela, Caracas, Barquisimeto, Valencia, web design, Android" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<style>
    .header{
        background-size: 100%;
    }
</style>
</head>
<body>

<?php
    include ('navbar.php');
?>
<div class="container">
<div class="row"><!--content-top-->
    <div class="col-xs-4 text-center">
    <img src="images/logoupy3-03.png" class="img-responsive center-block" alt=""/><hr>
    <p class="text-justify">Lo hacemos por ti, realizamos los traslados diarios, tanto locales como nacionales del personal de tu Empresa Industria y Comercio poniendo a disposición una flota de conductores y vehículos con un compromiso de garantía y seguridad de servicio al mejor costo.</p>
    <hr>
    </div>
        <div class="col-xs-4 text-center">
    <img src="images/logoupy3-01.png" class="img-responsive center-block" alt=""/><hr>
    <p class="text-justify">Acompañanos. Si cuentas con un vehículo reciente y en buenas condiciones puedes asociarte con nosotros y así obtener buenos ingresos en tus ratos libres.</p><hr>
    </div>
        <div class="col-xs-4 text-center">
    <img src="images/logoupy3-06.png" class="img-responsive center-block" alt=""/><hr>
    <p class="text-justify">Tu terminal virtual. Podemos llevarte a cualquier destino del territorio nacional en unidades recientes y con capacidad de cuatro o doce personas desde tu casa u oficina.</p><hr>
    </div>
    <div class="col-xs-12 clearfix"></div>
     <div class="col-xs-4 text-center">
    <img src="images/logoupy3-05.png" class="img-responsive center-block" alt=""/><hr>
    <p class="text-justify">Tu futuro en buenas manos. Si quieres llegar tu o los tuyos al centro de estudios y/o retornar a casa con seguridad ponemos a disposición un conductor para que puedas hacerlo y así solo te preocupes por estudiar.</p><hr>
    </div>
        <div class="col-xs-4 text-center">
    <img src="images/logoupy3-02.png" class="img-responsive center-block" alt=""/><hr>
    <p class="text-justify">
    <p>Lo entregamos por ti. Llevamos tu mercancía o encomienda a donde necesites con un personal comprometido en llegar a tiempo cuidando tus bienes.</p><hr>
    </div>
        <div class="col-xs-4 text-center">
    <img src="images/logoupy3-08.png" class="img-responsive center-block" alt=""/><hr>
    <p class="text-justify">A donde quieras.  Si nos necesitas solo por momentos también queremos estar contigo para que llegues a tu destino, con un servicio diferenciado y responsable</p><hr>
    </div>
    </div><!-- fin content-top-->
</div>
<div class="content">        
    <div class="container">
	<!--cpntent-mid-->
	<div class="content-middle">
            <div class="col-md-5 content-mid">
                <a href="typo.php"><img class="img-responsive" src="images/hr.png" alt=""></a>
            </div>
            <div class="col-md-7 content-mid1 small">
                <h3 style="text-align: justify;color: white;">Dedicados al transporte de personal</h3>
		<p style="text-align: justify;">UPY3 busca el desarrollo sostenible en el aspecto social y económico de los países a través de sus servicios de transporte de personal, 
                   posicionándonos como una empresa líder en el mercado con nuestra logística.</p>
                <a href="typo.php"><i class="glyphicon glyphicon-circle-arrow-right"> </i></a>
            </div>
            <div class="clearfix"> </div>
	</div>
	<!--//content-mid-->
	<!--content-left-->
        <?php
        require_once 'conexion.php';
        $con = new Conexion();
        $sql = 'SELECT * FROM noticia ORDER BY fecha DESC LIMIT 3';
                $consulta = $con->consultar($sql);
                if($con->num_filas($consulta) > 0){
                    echo '<div class="content-left">';
                    foreach ($consulta as $c){
                        echo '<div class="col-md-4 content-left-top">
                                <a href="single.php?id='.$c['id'].'"><img class="img-responsive" src="'.$c['ruta_imagen'].'" style="max-width: 350px;max-height: 196px;"></a>
                                <div class=" content-left-bottom">
                                    <h4><i class="glyphicon glyphicon-ok"></i><a href="single.php?id='.$c['id'].'">'.$c['titulo'].'</a></h4>
                                    <p>'.substr(strip_tags($c['texto']), 0, 60).'...</p>
                                </div>
                            </div>';
                    }
                    echo '</div>';
                }else{
                }
        ?>
    </div>
    <br><br>
    <!--content-right-->
    <div class="content-right">
        <div class="col-md-6 content-right-top">
            <h3>Cartelera Informativa</h3>
            <ul>
                <?php
                $sql = 'SELECT id,titulo FROM noticia ORDER BY fecha DESC LIMIT 8';
                $consulta = $con->consultar($sql);
                if($con->num_filas($consulta)>0){
                    foreach ($consulta as $c){
                    echo '<li><a href="single.php?id='.$c['id'].'"><i class="glyphicon glyphicon-info-sign"></i>  '.$c['titulo'].'</a></li>';
                    }
                }
                $con->cerrar_conexion();
                ?>
            </ul>
	</div>
	<div class="col-md-6 content-right-top col1">
	</div>
	<div class="clearfix"> </div>
    </div>
    <!--//content-right-->
    <br><br><br>
</div>
    <?php
        include('address.php');
        include('footer.php');
    ?>
</body>
</html>