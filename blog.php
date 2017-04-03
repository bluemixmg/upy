<!DOCTYPE html>
<html>
<head>
<title>UPY3 | Blog</title>
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
<meta name="keywords" content="Responsive web template, Service Logic, UPY, UPY3, Servicios de transporte, transporte, transporte de personal, transporte para
      estudiantes, transporte Venezuela, Caracas, Barquisimeto, Valencia, web design, Android" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<style>
.header{
    background-size: 100%;
    min-height: 150px;
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
    <div class="blog">
        <div class="top-blog">
            <h2>Blog</h2>
            <p>Noticias relacionadas con nuestros servicios UPY, al alcance de tu mano.</p>
	</div>
	<div class="blog-head">
            
                <?php
                require_once './conexion.php';
                $sql = 'SELECT * FROM noticia ORDER BY fecha DESC';
                
                $consulta = pg_fetch_all(pg_query($conexion_bd, $sql));
                if(pg_num_rows($consulta)>0){
                    $i = 0;
                    foreach ($consulta as $c){
                        if($i == 0 || $i == 2 || $i == 4){
                    echo '<div class="col-md-4 blog-bottom">
                        <div class="blog-top">
                            <a href="single.php?id='.$c['id'].'">
                            <img class="img-responsive" src="'.$c['ruta_imagen'].'" />
                            </a>
                            <div class="blog-grid">
                                <h3><a href="single.php?id='.$c['id'].'">'.$c['titulo'].'</a></h3>
                                <ul class="grid-blog">
                                    <li><span><i class="glyphicon glyphicon-calendar"> </i>'.$c['fecha'].'</span></li>
                                </ul>
                                <p>'.substr(strip_tags($c['texto']), 0, 35).'...</p>
                                <a href="single.php?id='.$c['id'].'" class="hvr-icon-wobble-horizontal">Leer más</a>
                            </div>						
                        </div></div>';
                        }else{
                            echo '<div class="col-md-4 blog-top">
                                    <a href="single.php?id='.$c['id'].'">
                                    <img class="img-responsive" src="'.$c['ruta_imagen'].'" />
                                    </a>
                                    <div class="blog-grid">
                                        <h3><a href="single.php?id='.$c['id'].'">'.$c['titulo'].'</a></h3>
                                        <ul class="grid-blog">
                                            <li><span><i class="glyphicon glyphicon-calendar"> </i>'.$c['fecha'].'</span></li>
                                        </ul>
                                        <p>'.substr(strip_tags($c['texto']), 0, 35).'...</p>
                                        <a href="single.php?id='.$c['id'].'" class="hvr-icon-wobble-horizontal">Leer más</a>
                                    </div>						
                                </div>';
                        }
                        $i++;
                    }
                    pg_close($conexion_bd);
                }else{
                    echo "<p>Disculpe, no hay noticias en este momento<p>";
                }
                ?>
            
            <div class="clearfix"></div>
	</div>
    </div>
</div>

    <?php
        include('address.php');
        include('footer.php');
    ?>
</body>
</html>