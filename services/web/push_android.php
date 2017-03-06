<?php

$MY_API_KEY="AIzaSyClESwq7mvo76CoqqqkO1Lfef5UA_5xU1Y";

$messageTitle = $_POST['titulo'];
$messageBody = $_POST['texto'];

$data = array(
    "to" => "/topics/upy",
    "time_to_life" => 172800,
    "data" => array(
        "title" => $messageTitle,
        "body" => $messageBody,
        "icon" => "app"
        )
);

//Nombres de los iconos
//app
//ok
//error
//pregunta
//alert

$header = array(
    "Authorization: key=".$MY_API_KEY,
    "Content-type: application/json"
);

$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);
curl_close($ch);
echo '<p>El mensaje se ha enviado con el número: '.$result.'</p>';