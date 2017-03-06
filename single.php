<!DOCTYPE html>
<html>
<head>
<title>UPY3 | Noticia</title>
<link rel="icon" type="image/png" href="images/ic_launcher.png" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
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
<?php
    include ('navbar.php');
    require_once './conexion.php';
    
    if(isset($_GET['id'])){
        $sql = "SELECT * FROM noticia WHERE id='".$_GET['id']."'";
        $consulta = mysqli_query($conexion_bd, $sql);
        if (mysqli_num_rows($consulta)>0){
            foreach ($consulta as $c){
                echo '<!--blog-->
                <div class="single">
                    <div class="container">
                        <div class="single-grid">
                            <img class="img-responsive text-center" style="width: 1140px;" src="'.$c['ruta_imagen'].'"/>
                            <div class="lone-line">
                                <h2>'.$c['titulo'].'</h2>
                                <ul class="grid-blog">
                                    <li><span><i class="glyphicon glyphicon-calendar"> </i>'.$c['fecha'].'</span></li>
                                </ul>
                                <p>'.$c['texto'].'</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--//blog-->';
            }
        }else{
            echo 'Noticia no encontrada';
        }
        mysqli_close($conexion_bd);
    }
?>

    <?php
        include('address.php');
        include('footer.php');
    ?>
</body>
</html>