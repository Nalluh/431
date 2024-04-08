<?php
// write some PHP code that creates some type of output. 
// Use the output on your HTML page using fetch() with JavaScript. 

// In PHP you can output HTML/TEXT or you can output JSON using json_encode() on a PHP variable
// Use exit() or echo() to output your data. 

// api endpoints
// https://www.weatherapi.com/api-explorer.aspx
                

$city = 'Fullerton';
$API = "http://api.weatherapi.com/v1/current.json?key={$apiKey}&q={$city}&aqi=no";

$response = file_get_contents( $API ); 

if (!$response) {
    echo "Error";
}

$data = json_decode($response, true);

$temperature = $data['current']['temp_f']; 
$condition = $data['current']['condition']['text'];
$imageUrl = $data['current']['condition']['icon'];


$json =  json_encode(array('city' => $city, 'temperature' => $temperature, 'condition' => $condition, 'imageUrl' => $imageUrl));

header( 'Content-Type: application/json; charset-utf-8');
exit($json);
