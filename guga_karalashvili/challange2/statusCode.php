<!--
    Get response status code for user exist or not
-->
<?php
$url = "https://api.github.com/users/$usrName";
file_get_contents($url, false, stream_context_create([
    'http'=>[
        'method'=>'GET',
        'header'=>[
            'User-Agent:PHP'
        ],
        'ignore_errors' => true
    ]
]));
$userExist = "HTTP/1.1 200 OK";
$responseCode = $http_response_header[0];
?>