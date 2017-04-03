<?php

//verificamos que si se haya enviado un post.
if(isset($_FILES['file-0'])){
    //obtenemos el nombre del archivo.
    $fname = $_FILES['file-0']['name'];
 
    echo 'Cargando archivo: '.$fname.' <br>';
    $chk_ext = explode(".",$fname);
 
    //verificamos que el archivo tenga la extensión correcta para procesar la información
    if(strtolower(end($chk_ext)) == "csv"){
        //Establecemos la conexión con nuestro servidor
        require_once './conexion.php';
 
        //si es correcto, entonces damos permisos de lectura para subir
        $filename = $_FILES['file-0']['tmp_name'];
        $handle = fopen($filename, "r");
        require_once './conexion.php';
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
            
            foreach ($data as $d){
                $columna[] = explode(";", $d);
                foreach ($columna as $c){
                    if($c[0]=='cedula'){
                        //Si cedula=cedula no lo insertamos
                    }else{
                        //comprobamos que no exista la misma cedula
                        $sql = "SELECT cedula FROM cliente WHERE cedula='$c[0]'";
                        $consulta = pg_query($conexion_bd, $sql);
                        if(pg_num_rows($consulta)==0){
                            //Insertamos los datos con sus valores
                            $sql = "INSERT INTO chofer (id_cedula,nombre,apellido,sexo,correo,direccion,telefono,estatus) VALUES ('$c[0]','$c[1]','$c[2]','$c[3]','$c[4]','$c[5]','$c[6]','0')";
                            pg_query($conexion_bd,$sql);
                        }else{
                            
                        }
                    }
                }
            }
        }
        //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
        fclose($handle);
        echo "Carga de Empleados Exitosa";
    }else{
        echo 'Formato de archivo incorrecto.';
    }
}else{
    echo 'Favor, elige un archivo.';
}