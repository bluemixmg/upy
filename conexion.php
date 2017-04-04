<?php

/**
 * Description of Conexion
 *
 * @author jparedes
 */

/*Permite dividir un string en varios substrings con delimitadores múltiples*/
function multiexplode ($delimiters, $string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

/*Clase de conexión a BD*/
class Conexion {
    
    private $gestorBD;
    private $conexion;
    
    public function __construct() {
        $this->conexion = $this->getConnection();
    }
    
    private function getConnection(){

        $services = getenv("VCAP_SERVICES");
        if($services) {
            //Entrará aquí si encuentra al menos un servicio en Bluemix
            $services_json = json_decode($services,true);
            
            /*Conectar con servicio ClearDB (MySQL) de Bluemix*/
            //return $this->conectarClearDB($services_json);
            
            /*Conectar con servicio Elephant (PostgreSQL) de Bluemix*/
            return $this->conectarElephant($services_json);
        }
        else {
            //Entrará aquí si se ejecuta la app en localhost o fuera de Bluemix
            
            //$this->gestorBD = 'mysql'; //Si la BD es MySQL
            $this->gestorBD = 'pgsql'; //Si la BD es PostgreSQL
            
            //Colocar credenciales para ejecutar en localhost o fuera de Bluemix
            $user = "postgres";
            $password = "postgres";
            $host = "localhost";
            $port = "5432";
            $dbname = "upy";
            
            return $this->conectar($this->gestorBD, $dbname, $host, $port, $user, $password);
        }
    }
  
    private function conectarClearDB($json) {
        
        $this->gestorBD = 'mysql';
        
        $credenciales = $json["cleardb"][0]["credentials"];
        $dbname = $credenciales["name"];
        $host = $credenciales["hostname"];
        $port = $credenciales["port"];
        $user = $credenciales["username"];
        $password = $credenciales["password"];
        
        return $this->conectar($dbname, $host, $port, $user, $password);
    }
    
    private function conectarElephant($json) {
        
        $this->gestorBD = 'pgsql';
        
        $pgsql_config = $json["elephantsql"][0]["credentials"];
        
      //Formato URI de credenciales: "postgres://user:password@host:port/dbname"
        $pg_credenciales = multiexplode(array(":","@","/"),
                            substr($pgsql_config["uri"], 11));
        
        $user = $pg_credenciales[0];
        $password = $pg_credenciales[1];
        $host = $pg_credenciales[2];
        $port = $pg_credenciales[3];
        $dbname = $pg_credenciales[4];
        
        return $this->conectar($this->gestorBD, $dbname, $host, $port, $user, $password);
    }
  
    private function conectar($gestorBD, $dbname, $host, $port, $user, $password) {
        
        if($gestorBD == 'mysql') {
            $conn = mysqli_connect($host, $user, $password, $dbname, $port);
            
            if(mysqli_connect_errno($conn)){
                die('No se puede conectar a BD: ' . mysqli_connect_error($conn));
            }
        }
        elseif($gestorBD == 'pgsql') {
            $connString = "host=" . $host . " port=" . $port . " dbname=" 
                        . $dbname . " user=" . $user . " password=" . $password;
            $conn = pg_connect($connString);
        
            if(! $conn ){
                die('No se puede conectar a BD: ' . pg_errormessage($conn));
            }
        }
        return $conn;
    }
    
    public function insertar_id() {
        if($this->gestorBD == 'mysql') {
            $result = mysqli_insert_id($this->conexion);
            return $result;
        }
        elseif($this->gestorBD == 'pgsql') {
            $result = pg_insert($this->conexion);
            $arr = pg_fetch_all($result);
            return $arr;
        }
        die("Hubo un problema con el insert");
    }
    
    public function consultar($sql) {
        if($this->gestorBD == 'mysql') {
            $result = mysqli_query($this->conexion, $sql);
            return $result;
        }
        elseif($this->gestorBD == 'pgsql') {
            //echo "this->conexion = " .$this->conexion . '<br>';
            //echo "sql = $sql <br>";
            $result = pg_query($this->conexion, $sql);
            //echo "result = " .$result . '<br>';
            $arr = pg_fetch_all($result);
            //echo "arr = " .$arr . '<br>';
            return $arr;
        }
        die("Hubo un problema con la consulta");
    }
  
    public function num_filas($resultado) {
        if($this->gestorBD == 'mysql') {
            return mysqli_num_rows($resultado);
        }
        elseif($this->gestorBD == 'pgsql') {
            return count($resultado);
        }
        die("Hubo un problema con la consulta");
    }
  
    public function cerrar_conexion() {
        if($this->gestorBD == 'mysql') {
            mysqli_close($this->conexion);
            return true;
        }
        elseif($this->gestorBD == 'pgsql') {
            pg_close($this->conexion);
            return true;
        }
        die("Hubo un problema al cerrar la conexión");
    }
    
}
