<?php

define('API_BASE_URL', 'https://api.github.com/users/');
define('USER_AGENT', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
define('PER_PAGE', 20);

$meta_info = [
    'code' => null,
    'repos_count' => null,
    'followers_count' => null,
];


function my_curl ($url) {

    $CURL_DATA = [];
    
    $handle = curl_init();
    
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_USERAGENT, USER_AGENT);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_HEADER, false);
    
    $response = curl_exec($handle);
    $httpcode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    curl_close($handle);

    $CURL_DATA["response"] = json_decode($response);
    $CURL_DATA["code"] = $httpcode;


    return $CURL_DATA;
}

function get_basic_info(string $username): void {
    global $meta_info;
    $url = API_BASE_URL . $username;


    $data = my_curl($url);
    $response = $data['response'];

    $meta_info['code'] = $data['code'];

    $meta_info['repos_count'] = $response->public_repos;
    $meta_info['followers_count'] = $response->followers;

}


function check_user_existence(): bool {
    global $meta_info;

    $code = $meta_info['code'];
    
    return $code === 200;
}


function fetch_data(string $username, string $key) {
    global $meta_info;
    
    $max = $meta_info[ $key . '_count' ];
    $range = ceil($max / PER_PAGE);

    $result = [];

    for ($i = 1; $i <= $range; $i++) {
        $url = API_BASE_URL . $username . "/". $key ."?per_page=". PER_PAGE . "&page=" . $i;
        $data = my_curl($url);
        $response = $data['response'];

        $result[] = $response;
    }

    return array_merge(...$result);
}



?>