<?php 
    $url = 'https://api.github.com/search/users?q=' . $_GET['user'] . '';
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
        return "NOTVALIDATED";
    } else {
        return "VALIDATED";
    }

?>