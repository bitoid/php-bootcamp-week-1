<?php

$headers = [
    "User-Agent: Example REST API Client"
];

$curl = curl_init("https://api.github.com/users/otarza/repos");

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// Responce body will be returnd as a string(containing json formated data)
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);

curl_close($curl);

// decoode responce data
$data = json_decode($response, true);


// for incrementing repository indexis
$i = 1;
