<!--header-->
<?php
    $url=$_SERVER['REQUEST_URI'];
    $nuevo = explode('/', $url);
    $n = array_pop($nuevo);
?>
<header class="Header">
    <div class="container">
        <dir class="row">
            <div class="col-sm-24">
            <style type="text/css">
                .menu a {
    border-radius: 10px;
    padding: .3em .7em;
}
.boton {
    border-radius: 10px;
    padding: .5em 2em;
    text-transform: uppercase;
    box-shadow: inset 0 -.2em rgba(0,0,0,.3);
    display: inline-block;
}
.boton-sesion {
    background: #0059ba;
    color: #fff;
    box-shadow: inset 0 -.2em rgba(0,0,0,.3);
    letter-spacing: 1px;
}
a, a:hover, a:focus, a:active {
    text-decoration: none;
}
.menu {
    font-weight: 900;
    text-transform: uppercase;
}
.menu-principal, .info-top {
    float: right;
    text-align: right;
}
.info-top {
    margin: 1em 0 .5em 0;
    font-size: .8em;
}
.boton-sesion:hover {
    background: #cddc39;
    color: #000;
}
.menu a {
    border-radius: 10px;
    padding: .3em .7em;
}
            </style>
                <div class="menu info-top">
                    <?php
                    if($_SESSION['success'] == 'yes') {
                        echo '<a href="logout.php" class="boton boton-sesion">Cerrar sesión</a>';
                    } else {
                        echo '<a href="login.php" class="boton boton-sesion">Iniciar sesión</a>';
                    }
                    ?>
                </div>
                <figure class="logo">
                   <a href="index.php"><img src="http://upy3.com/wp-content/themes/upy3/img/logo-upy3.png" height="88" width="116"></a>
                </figure>
            </div>
        </dir>
    </div>

<!-- <div>
    <div class="container">
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
            <!--script-->
            <script>
                $("span.menu").click(function(){
                    $(".top-nav ul").slideToggle(500, function(){
                    });
                });
            </script>				
	</div>
    </div>
<!---->
</div>
</header>