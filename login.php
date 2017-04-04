<?php
session_start();
$url=$_SERVER['REQUEST_URI'];
$nuevo = explode('/', $url);
$n = array_pop($nuevo);
if(isset($_SESSION['success'])){
    if($_SESSION['success']=='yes'){
        header("Location: companie.php");
    }
}
if(strpos($n, 'no')){
    echo '<script> alert("ID o Password incorrecto"); </script>';
}
?>
<!DOCTYPE html>
<html>
<head>
<title>UPY3 | Login</title>
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
/*    left: 0%;
    top: 0;
    position: relative*/
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
    <?php
            $sql = "SELECT usuario.usuario,usuario.id_rol,empresa.* FROM usuario "
            . "INNER JOIN empresa ON empresa.rif = usuario.rif_empresa "
            . "WHERE usuario.usuario='".$login_usuario."' AND usuario.contrasena='".$login_pass."' AND empresa.estatus=1";
            $consulta = $con->consultar( $sql);
            if ($con->num_filas($consulta) > 0){
                foreach($consulta as $ss){
                ?>
                <script type="text/javascript">
                    console.log("<?php echo 'usuario = ' . $ss['usuario']?>");
                    console.log("<?php echo 'rif = ' . $ss['rif']?>");
                    console.log("<?php echo 'nombre = ' . $ss['nombre']?>");
                    console.log("<?php echo 'correo = ' . $ss['correo']?>");
                    console.log("<?php echo 'telefono = ' . $ss['telefono']?>");
                    console.log("<?php echo 'direccion = ' . $ss['direccion']?>");
                    console.log("<?php echo 'estatus = ' . $ss['estatus']?>");
                    console.log("<?php echo 'rol = ' . $ss['rol']?>");
                </script>
                <?php
                }
            }
        ?>
    <?php
    if(isset($_POST['success']) && $_POST['success']=='no'){

    }else{
    
    if(isset($_POST['txtid'])){
        $login_pass = md5($_POST['txtpass']);
        $login_usuario = $_POST['txtid'];
        ?>
    <script type="text/javascript">
        console.log("<?php echo "login_pass = $login_pass"?>");
        console.log("<?php echo "login_usuario = $login_usuario"?>");
    </script>
        <?php
        include("conexion.php");
        ?>
        <script type="text/javascript">
            console.log("<?php echo "_POST['txtid'] = " . $_POST['txtid']?>");
        </script>
        <?php
        if($_POST['txtid']!='op1'){
            ?>
            <script type="text/javascript">
                console.log("Pasó el primer if");
            </script>
        <?php
            $sql = "SELECT usuario.usuario,usuario.id_rol,empresa.* FROM usuario "
            . "INNER JOIN empresa ON empresa.rif = usuario.rif_empresa "
            . "WHERE usuario.usuario='".$login_usuario."' AND usuario.contrasena='".$login_pass."' AND empresa.estatus=1";
            $consulta = $con->consultar( $sql);
        ?>
            <script type="text/javascript">
                console.log("<?php echo '$con->num_filas($consulta) = ' . $con->num_filas($consulta)?>");
            </script>
        <?php
            if ($con->num_filas($consulta) > 0){
                ?>
                <script type="text/javascript">
                    console.log("Pasó el segundo if");
                </script>
                <?php
                $_SESSION['success'] = yes;
                ?>
                <script type="text/javascript">
                    console.log("<?php echo '$_SESSION["success"] = ' . $_SESSION["success"]?>");
                </script>
                <?php
                foreach($consulta as $ss){
                $_SESSION['usuario'] = $ss['usuario'];
                $_SESSION['rif'] = $ss['rif'];
                $_SESSION['nombre'] = $ss['nombre'];
                $_SESSION['correo'] = $ss['correo'];
                $_SESSION['telefono'] = $ss['telefono'];
                $_SESSION['direccion'] = $ss['direccion'];
                $_SESSION['latitud'] = $ss['latitud'];
                $_SESSION['longitud'] = $ss['longitud'];
                $_SESSION['estatus'] = $ss['estatus'];
                $_SESSION['rol'] = $ss['id_rol'];
                $sql = "SELECT id_permiso FROM permiso_rol WHERE id_rol=".$ss['id_rol'];
                $consulta1 = $con->consultar( $sql);
                $permisos[] = array();
                foreach ($consulta1 as $c1){
                    $permisos[] = $c1['id_permiso'];
                }
                $_SESSION['permisos'] = $permisos;
                //header("Location: http://www.upy3.com/upyweb/companie.php");
                header("Location: companie.php");
                }
            } else {
                header("Location:login.php?success=no");
            }
        }else{
            $sql = "SELECT usuario.usuario,usuario.id_rol,empresa.* FROM usuario "
                . "INNER JOIN empresa ON empresa.rif = usuario.rif_empresa "
                . "WHERE usuario.usuario='".$login_usuario."' AND usuario.contrasena='".$login_pass."' AND empresa.rif='J-406819212'";
             $consulta = $con->consultar( $sql);
             ?>
                <script type="text/javascript">
                    console.log("<?php echo '$con->num_filas($consulta) 2 = ' . $con->num_filas($consulta)?>");
                </script>
                <?php
            if ($con->num_filas($consulta) > 0){
                $_SESSION['success'] = yes;
                foreach($consulta as $ss){
                $_SESSION['usuario'] = $ss['usuario'];
                $_SESSION['rol'] = $ss['id_rol'];
		//if ($_SERVER['HTTP_HOST'] == "upy.com"){
                if ($_SERVER['HTTP_HOST'] == "mybluemix.net"){
                    //$url = "http://www." . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    $url = "http://upy." . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];                    
   			header("Location: $url");
		} 
                header("Location: companie.php");
                }
            } else {
                header("Location:login.php?success=no");
            }
        }
        $con->cerrar_conexion();
    }
    }
    ?>

    <div class="contact">
        <div class="contact-bottom">
            <form class="form-inline" role="form" method="POST" action="login.php">
                <h4 style="color: white">Ingresar</h4>
                <div class="form-group">
                    <input type="text" value="ID" name="txtid" onfocus="if(this.value=='ID') this.value='';" onblur="if (this.value == '') {this.value = 'ID';}">
                </div>
                <br>
                <div class="form-group">
                    <input type="password" value="Pass" name="txtpass" onfocus="if(this.value=='Pass') this.value='';" onblur="if (this.value == '') {this.value = 'Pass';}">
                </div>
                <br>
                <button type="submit" class="btn btn-default">Enviar</button><br><br>
                <a href="reset_pass.php">Olvide mi contrasena</a>
            </form>
        </div>
    </div>
    
    <?php
    include './address.php';
    include './footer.php';
    ?>
    
</body>
</html>