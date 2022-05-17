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
