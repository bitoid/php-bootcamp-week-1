<?php

function getData($user, $type){

    $page = 1;
    $count = 1;
    $data = [];
    while($count == 1){

        $url = "https://api.github.com/users/{$user}/{$type}?page={$page}";
        $curl = curl_init();
        curl_setopt_array($curl,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Github API in CURL'
        ]);
        $response = curl_exec($curl);
        $api_data = json_decode($response, true);
        curl_close($curl);
        if(sizeof($api_data) == 0){
            $count = 0;
        }else{
            array_push($data, ...$api_data);
            $page += 1;
        }
    }
    return $data;

}


?>