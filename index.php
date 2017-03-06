<!DOCTYPE html>
<html>
<head>
<title>Bienvenidos a UPY</title>
<link rel="icon" type="image/png" href="images/ic_launcher.png" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Responsive web template, Service Logic, UPY, UPY3, Servicios de transporte, transporte, transporte de personal, transporte para
estudiantes, transporte Venezuela, Caracas, Barquisimeto, Valencia, web design, Android" />
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
<div class="content">
    <div class="container">
        <!--content-top-->
	<div class="content-top">
            <div class="content-top1">
                <div class=" col-md-4 grid-top">
                    <div class="top-grid">
                        <i class="glyphicon glyphicon-check"></i>
			<div class="caption">
                            <h3>Transporte de Altura</h3>
                            <p>Revolucionamos el transporte en Venezuela para garantizar el mayor nivel de calidad al personal en su movilización diaria</p>
			</div>
                    </div>
		</div>
                <div class=" col-md-4 grid-top">
                    <div class="top-grid top">
                        <i class="glyphicon glyphicon-time home1 "></i>
                        <div class="caption">
                            <h3>Compromiso</h3>
                            <p>Brindar un servicio que ayude a las empresas a movilizar su recurso humano de forma segura, puntual y eficiente</p>
                        </div>
                    </div>
                </div>
                <div class=" col-md-4 grid-top">
                    <div class="top-grid">
                        <i class="glyphicon glyphicon-edit "></i>
                        <div class="caption">
                            <h3>Nuestra Meta</h3>
                            <p>Ser la empresa de transporte de recurso humano modelo en Venezuela</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
	</div>
	<!--//content-top-->
	<!--cpntent-mid-->
	<div class="content-middle">
            <div class="col-md-7 content-mid">
                <a href="typo.php"><img class="img-responsive" src="images/hr.png" alt=""></a>
            </div>
            <div class="col-md-5 content-mid1">
		<i class="glyphicon glyphicon-filter"> </i>
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
        require_once './conexion.php';
        $sql = 'SELECT * FROM noticia ORDER BY fecha DESC LIMIT 3';
                $consulta = mysqli_query($conexion_bd, $sql);
                if(@mysqli_num_rows($consulta)>0){
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
                $consulta = mysqli_query($conexion_bd, $sql);
                if(@mysqli_num_rows($consulta)>0){
                    foreach ($consulta as $c){
                    echo '<li><a href="single.php?id='.$c['id'].'"><i class="glyphicon glyphicon-info-sign"></i>  '.$c['titulo'].'</a></li>';
                    }
                }
                mysqli_close($conexion_bd);
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