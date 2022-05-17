<?php 

function fetch_user_repo($user){
    $api_url = 'https://api.github.com/users/' . $user .'/repos';

    $opts = [
        'http' => [
                'method' => 'GET',
                'header' => [
                        'User-Agent: PHP'
                ]
        ]
    ];

    $context = stream_context_create($opts);
    $content = file_get_contents($api_url, false, $context);
    $response_json = json_decode($content);
    return $response_json;
}

function fetch_user_followers($user){
    $api_url = 'https://api.github.com/users/' .$user .'/followers';

    $opts = [
        'http' => [
                'method' => 'GET',
                'header' => [
                        'User-Agent: PHP'
                ]
        ]
    ];

    $context = stream_context_create($opts);
    $content = file_get_contents($api_url, false, $context);
    $response_json = json_decode($content);
    return $response_json;
}

