<?php
// require './index.php';

$curl = require "./init_curl.php";

// get username
session_start();
$user_name = $_SESSION['USERNAME'];

curl_setopt($curl, CURLOPT_URL, "https://api.github.com/users/$user_name/followers");

$response = curl_exec($curl);

curl_close($curl);

// decoode responce data
$data = json_decode($response, true);

// for incrementing repository indexis
$i = 1;

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
