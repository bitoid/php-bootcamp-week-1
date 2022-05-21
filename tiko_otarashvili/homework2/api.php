<?php
$username = $_POST["username"];
$curlUser = curl_init();
        curl_setopt_array($curlUser,[
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_URL => "https://api.github.com/users/{$username}",
          CURLOPT_USERAGENT => 'Github'
        ]);
$resp = curl_exec($curlUser);
$result = json_decode($resp, true);
$user_exist = in_array($username, $result);
?>