<?php

$n0mbr3 = $_POST['nombre'];
$ap3ll1d0 = $_POST['apellido'];
$t3xt0 = $_POST['texto'];
$mail = $_POST['email'];

if($n0mbr3!='Nombre' && $ap3ll1d0!='Apellido' && $mail!='Email' && $t3xt0!='Mensaje'){
    $para = 'ordep90s@gmail.com';
    $titulo = 'Mensaje de '.$n0mbr3.' '.$ap3ll1d0;
    $mensaje = $t3xt0;
    $cabeceras = 'From: '.$mail."\r\n" .
            'Reply-To: '.$mail;

    mail($para, $titulo, $mensaje, $cabeceras);

    echo 'Mensaje Enviado';
}else{
    echo 'Favor llene todos los campos';
}