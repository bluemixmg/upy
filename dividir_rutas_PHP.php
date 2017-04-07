<?php
//$parada = new stdClass();
//$parada->lat = "10.07910713590509";
//$parada->lng = "-69.31393728119696";
//$parada1 = new stdClass();
//$parada1->lat = "10.076667674142774";
//$parada1->lng = "-69.32089157862032";
//$parada2 = new stdClass();
//$parada2->lat = "10.03240025887612";
//$parada2->lng = "-69.23551746057376";
//$parada3 = new stdClass();
//$parada3->lat = "10.065627476015194";
//$parada3->lng = "-69.30912271601522";
$parada = new stdClass();
$parada->lat = "10.076667674142774";
$parada->lng = "-69.32089157862032";
$parada->id = "16";
$parada1 = new stdClass();
$parada1->lat = "10.07910713590509";
$parada1->lng = "-69.31393728119696";
$parada1->id = "18";
$parada2 = new stdClass();
$parada2->lat = "10.065627476015194";
$parada2->lng = "-69.30912271601522";
$parada2->id = "20";
$parada3 = new stdClass();
$parada3->lat = "10.067108371317737";
$parada3->lng = "-69.30555738968218";
$parada3->id = "22";
//$parada4 = new stdClass();
//$parada4->lat = "10.064118";
//$parada4->lng = "-69.341726";
//$parada4->id = "04";
//$parada5 = new stdClass();
//$parada5->lat = "10.062142";
//$parada5->lng = "-69.354655";
//$parada5->id = "05";
//$parada6 = new stdClass();
//$parada6->lat = "10.065576";
//$parada6->lng = "-69.322275";
//$parada6->id = "06";
//$parada7 = new stdClass();
//$parada7->lat = "10.064815";
//$parada7->lng = "-69.332295";
//$parada7->id = "07";
//$parada8 = new stdClass();
//$parada8->lat = "10.064329";
//$parada8->lng = "-69.339645";
//$parada8->id = "08";
//$parada9 = new stdClass();
//$parada9->lat = "10.063241";
//$parada9->lng = "-69.353785";
//$parada9->id = "09";

$paradas[] = $parada;
$paradas[] = $parada1;
$paradas[] = $parada2;
$paradas[] = $parada3;
//$paradas[] = $parada4;
//$paradas[] = $parada5;
//$paradas[] = $parada6;
//$paradas[] = $parada7;
//$paradas[] = $parada8;
//$paradas[] = $parada9;

//$A = array_slice($paradas,0);
$nro_puestos = 4;
$D = 0.009170;

    while(isset($paradas[0])){
        $B = [];
        $C = [];
        CalcularPreRuta($B,$C,$paradas);
        CalcularRuta($B,$C);
        $paradas = array_slice($C,0);

    }

    function ValidarDistancia($o1,$d1,$D){
        $La = $o1->lat - $d1->lat;
        $Lo = $o1->lng - $d1->lng;
        
        if((abs($La)<=$D) && (abs($Lo)<=$D)){
            return 1;
        }else{
            return 0;
        }
    }

    function CalcularPreRuta(&$B,&$C,&$paradas){
        $origen = $paradas[0];
        $destino = $paradas;
        
        for($i=0;$i<count($destino);$i++){
            $status = ValidarDistancia($origen, $destino[$i], $GLOBALS['D']);
            if($status == 1){
                array_push($B, $destino[$i]);
            }else{
                array_push($C, $destino[$i]);
            }
        }
    }

    function CalcularRuta(&$B,&$C){
               
        for($k=0;$k<count($B);$k++){
            $origen2 = $B[$k];
            $destino2 = $C;
            
            for($l=0;$l<count($destino2);$l++){
                $estatus2 = ValidarDistancia($origen2, $destino2[$l], $GLOBALS['D']);
                if($estatus2==1){
                    array_push($B, $destino2[$l]);
                    for ($l2=0; $l2<count($C); $l2++){
                        if($destino2[$l]->id == $C[$l2]->id){
                            array_splice($C,$l2,1);
                        }
                    }
                }
            }
        }
        PicarRuta($B);
        //$GLOBALS['paradas'] = array_slice($C,0);
    }

    function PicarRuta(&$B){
        while (isset($B[0])){
            echo '<br>Ruta Definitiva<br>';
            // INSERTAR RUTA NUEVA EN BD
            for($m=0; $m < $GLOBALS['nro_puestos']; $m++){
                if(isset($B[$m])){
                        //Crea parada_ruta en BD
                        //require_once('conexion.php');
                        //$con = new Conexion();
                        //$sql = "INSERT INTO parada_ruta ";
                        //$con->consultar($sql);
                        var_dump($B[$m]);
//                            echo 'Ruta Creada';
                }else{
                    break;
                }
            }
            array_splice($B, 0, $GLOBALS['nro_puestos']);
        }
    }