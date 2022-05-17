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
