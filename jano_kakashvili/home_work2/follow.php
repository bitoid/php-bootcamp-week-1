<?php
require './index.php';

$curl = require "./init_curl.php";

// get username
session_start();
$user_name = $_SESSION['USERNAME'];

curl_setopt($curl, CURLOPT_URL, "https://api.github.com/users/$user_name/followers");

$response = curl_exec($curl);

curl_close($curl);

// decoode responce data
$data = json_decode($response, true);

// if data == 0 there is no followers to display
if (count($data) == 0) { 
    print "The is no followers to display";
}else {
    print "";
}

// for incrementing repository indexis
$i = 1;
