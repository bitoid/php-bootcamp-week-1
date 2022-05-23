<?php

function checkUser($user) {
    $url = "https://api.github.com/search/users?q=$user";
    $param = [
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: PHP'
            ]
        ]
    ];

    $json = file_get_contents($url, false, stream_context_create($param));
    $data = json_decode($json, true);


    if ($data['total_count'] == 0) {
        return "User Does not exist!";
    }
}

?>