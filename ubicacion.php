<!--Google Maps API-->
<link href="https://developers.google.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSWdB4sy4Q3_YKVoiqE259xFcCJ2NCPfU"></script>

<?php
include './conexion.php';
    $sql = "SELECT cliente.*,parada.* FROM cliente "
         . "INNER JOIN parada ON cliente.cedula=parada.id_cliente "
         . "WHERE rif_empresa='V-2525'";
    $con = pg_query($conexion_bd, $sql);
    if(pg_num_rows($con)>0){
        $i = 1;
        foreach ($con as $c){
            $lat = $c['latitud'];
            $lng = $c['longitud'];
            echo '<input type="hidden" id="lat'.$i.'" value="'.$lat.'" />';
            echo '<input type="hidden" id="lng'.$i.'" value="'.$lng.'" />';
            $i++;
        }
?>
<script>
    var mapChoferes;
    var bounds = new google.maps.LatLngBounds();
    <?php
    for ($i=1;$i<=pg_num_rows($con);$i++){
        echo "var lat$i = parseFloat(document.getElementById('lat$i').value);";
        echo "var lng$i = parseFloat(document.getElementById('lng$i').value);";
    }
    ?>
    function initMapChoferes() {
        mapChoferes = new google.maps.Map(document.getElementById('empleados'), {
        });
        <?php
        $i=1;
        foreach ($con as $c){
            $titulo = $c['id'].'--'.$c['cedula'].' '.$c['nombre'].' '.$c['apellido'].' '.$c['hora'];
            echo "var marker$i = new google.maps.Marker({"
               . 'position: {lat: lat'.$i.', lng: lng'.$i.'},'
               . "map: mapChoferes,"
               . "title: '$titulo' "
               . "});"
               . "bounds.extend(marker$i.position);";
            $i++;
        }
    }
        ?>
    mapChoferes.fitBounds(bounds);
    }
</script>
<input type="submit" onclick="initMapChoferes();return false" value="Mostrar">
<div id="empleados" style="height:600px; width:auto; top: 10px;"></div>