<!--header-->
<?php
    $url=$_SERVER['REQUEST_URI'];
    $nuevo = explode('/', $url);
    $n = array_pop($nuevo);
?>
<div class="header">
    <div class="container">
        <div class="logo">
            <h1><a href="index.php">
                U P Y 3
		</a></h1>
	</div>
	<div class="top-nav">
            <span class="menu"><img src="images/menu.png" alt=""> </span>
                <ul>
                    <?php
                    if ($n==''){
                        echo '<li class="active"><a href="index.php">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='index.php'){
                        echo '<li class="active"><a href="index.php">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='services.php'){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li class="active"><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='blog.php'){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li class="active"><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='typo.php'){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li class="active"><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='mail.php'){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li class="active"><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='single.php'){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='login.php' || $n=='login.php?success=no'){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li class="active"><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if(strpos($n, 'id')){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='registro_empresa.php'){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='registro_transporte.php'){
                        echo '<li><a href="index.php" class="hvr-sweep-to-bottom">Inicio</a></li>
                            <li><a href="services.php" class="hvr-sweep-to-bottom">Servicios</a></li>
                            <li><a href="blog.php" class="hvr-sweep-to-bottom">Blog</a></li>
                            <li><a href="typo.php" class="hvr-sweep-to-bottom">Nosotros</a></li>
                            <li><a href="mail.php" class="hvr-sweep-to-bottom">Cont&aacute;ctanos</a></li>
                            <li><a href="login.php" class="hvr-sweep-to-bottom">Ingresar</a></li>';
                    }
                    if ($n=='companie.php'){
                        echo '<li><a href="logout.php" class="hvr-sweep-to-bottom">Cerrar Sesi&oacute;n</a></li>';
                    }
                    ?>
		</ul>
            <div class="clearfix"> </div>
            <!--script-->
            <script>
                $("span.menu").click(function(){
                    $(".top-nav ul").slideToggle(500, function(){
                    });
                });
            </script>				
	</div>
	<div class="clearfix"> </div>
    </div>
<!---->
</div>