<!DOCTYPE html>
<html>
  <head>
    <title>Dividir Rutas</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
        width: 50%;
      }
#right-panel {
  font-family: 'Roboto','sans-serif';
  line-height: 30px;
  padding-left: 10px;
}

#right-panel select, #right-panel input {
  font-size: 15px;
}

#right-panel select {
  width: 100%;
}

#right-panel i {
  font-size: 12px;
}

    </style>
    <style>
      #right-panel {
        float: right;
        width: 48%;
        padding-left: 2%;
      }
      #output {
        font-size: 11px;
      }
    </style>
  </head>
  <body>
    <div id="right-panel">
      <div id="inputs">
        <pre>
<!--var origin1 = {lat: 55.930, lng: -3.118};-->
var parada 0 = 'Carrera 19 con calle 20 // 10.066600, -69.311052';
var parada 1 = 'Carrera 19 con calle 27 // 10.066029, -69.317918';
var parada 2 = 'Carrera 19 con calle 30 // 10.065713, -69.321234';
var parada 3 = 'Carrera 19 con calle 31 // 10.065576, -69.322275';
var parada 4 = 'Carrera 19 con calle 41 // 10.064868, -69.332016';
var parada 5 = 'Carrera 19 con calle 41 // 10.064815, -69.332295';
var parada 6 = 'Carrera 19 con calle 49 // 10.064329, -69.339645';
var parada 7 = 'Carrera 19 con calle 51 // 10.064118, -69.341726';
var parada 8 = 'Carrera 19 con calle 60 // 10.063241, -69.353785';
var parada 9 = 'Carrera 18 con calle 61 // 10.062142, -69.354655';
        </pre>
      </div>
      <div>
        <strong>Resultados</strong>
      </div>
      <div id="output"></div>
    </div>
    <div id="nueva"></div>
    <script>
    //var paradas = ['10.066600, -69.311052', '10.066029, -69.317918', '10.065713, -69.321234', '10.065576, -69.322275', '10.064868, -69.332016', '10.064815, -69.332295', '10.064329, -69.339645', '10.064118, -69.341726', '10.063241, -69.353785', '10.062142, -69.354655'];
  
  var paradas = [{lat: 10.066600, lng: -69.311052}, {lat: 10.066029, lng: -69.317918}, {lat: 10.065713, lng: -69.321234}, {lat: 10.065576, lng: -69.322275}, {lat: 10.064868, lng: -69.332016}, {lat: 10.064815, lng: -69.332295}, {lat: 10.064329, lng: -69.339645}, {lat: 10.064118, lng: -69.341726}, {lat: 10.063241, lng: -69.353785}, {lat: 10.062142, lng: -69.354655}];

  var A = paradas.slice();
  var D = 0.009170;//1650;
  var nro_puestos = 4; // recibido por parametro
  
function DividirRutas() {

    while (paradas[0] != null) {

        var B = [];
        var C = [];

        CalcularPreRuta(B, C);
        CalcularRuta(B, C);

        paradas = C.slice();
        
    }// fin while
}


function ValidarDistancia(o1,d1){
    
    var La = o1["lat"] - d1["lat"];
    var Lo = o1["lng"] - d1["lng"];
    
    if ((Math.abs(La) <= D) && (Math.abs(Lo) <= D)){
        return 1;
    }else{
        return 0;
    }
    
}

function CalcularPreRuta (B, C){
        document.getElementById('output').innerHTML += 'PRE - RUTA '  + '<br>';
        var origen = paradas[0];
        var destino = paradas;
        var status;
        
        for (var i = 0; i < destino.length; i ++){
            
            status = ValidarDistancia(origen, destino[i]);

            if (status == 1){
                B.push(destino[i]);
            } else{
                C.push(destino[i]);
            }

        }
        for (var x =0; x < B.length; x++){
                document.getElementById('output').innerHTML += 'B ' + B[x].lat + " " + B[x].lng + '<br>';
        }
        for (var y =0; y < C.length; y++){
                document.getElementById('output').innerHTML += 'C ' + C[y].lat + " " + C[y].lng + '<br>';
        }
        
}

function CalcularRuta (B, C){

    document.getElementById('output').innerHTML += 'RUTA '  + '<br>';
    for (var k = 0; k < B.length; k++){
        var origen2 = B[k];
        var destino2 = C;
        var status2;

        for (var l = 0; l < destino2.length; l++){

            status2 = ValidarDistancia(origen2, destino2[l]);
            if (status2 == 1){
                B.push(destino2[l]);
                C.splice(l,1);
            }// se actualiza B y C solo si elemento de C cumple con la distancia

        }// se recorre C

    }// se recorre B  y se CREA una RUTA
    
    for (var x =0; x < B.length; x++){
                document.getElementById('output').innerHTML += 'B ' + B[x].lat + " " + B[x].lng + '<br>';
    }
    for (var y =0; y < C.length; y++){
                document.getElementById('output').innerHTML += 'C ' + C[y].lat + " " + C[y].lng + '<br>';
    }
    PicarRuta(B);
}

function PicarRuta(B){
    while (B[0] != null) {
        
        // CREAR RUTA en bd
        document.getElementById('output').innerHTML += 'RUTA DEFINITIVA '  + '<br>';
        for (var m = 0; m < nro_puestos; m++){
            if (B[m] != null){
                // CREA parada_ruta en bd
                document.getElementById('output').innerHTML += 'B ' + B[m].lat + " " + B[m].lng + '<br>';
            }else {
                break;
            }
            
        }
        B.splice(0,nro_puestos);
    }
}
    </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSWdB4sy4Q3_YKVoiqE259xFcCJ2NCPfU&signed_in=true&callback=DividirRutas"
        async defer></script>
  </body>
</html>