
<div id="muestra"></div>


<script>
    var arreglo = [];
    for(i = 0; i < 4 ;i++){
        var objeto = {id: i, latitud: Math.random(), longitud: Math.random()};
        arreglo.push(objeto);
    }
    
    document.getElementById("muestra").innerHTML = 'Cantidad de objetos: '+ arreglo.length +'<br>';
    arreglo.forEach(alert(objeto.latitud));
</script>
