<?php

function get_api_data(string $url, string $user_agent, /* array $http_header */) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);

    $result = curl_exec($ch);

    if ($result === false) {
        echo 'Error'. curl_error($ch);
    } else {
        return $result;
    }
}