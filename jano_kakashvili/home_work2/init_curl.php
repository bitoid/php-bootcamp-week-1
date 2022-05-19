<?php

$headers = [
    "User-Agent: Example REST API Client",
    "Authorization: token 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"
];

// creates curl session
$curl = curl_init();


curl_setopt_array($curl, [
    CURLOPT_HTTPHEADER => $headers,
    // Responce body will be returnd as a string(containing json formated data)
    CURLOPT_RETURNTRANSFER => true
]);


return $curl;
