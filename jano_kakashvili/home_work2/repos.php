<?php
$show = 'hidden';

if (!empty($_POST['username'])) {
    $show = 'visible';
    $user_name = $_POST['username'];

    $curl = require "./init_curl.php";

    curl_setopt($curl, CURLOPT_URL, "https://api.github.com/users/$user_name/repos");

    $response = curl_exec($curl);

    curl_close($curl);

    // decode responce data
    $data = json_decode($response, true);


    // for incrementing repository indexis
    $i = 1;

    // store username for followers page
    session_start();
    $_SESSION['USERNAME'] = $user_name;
}
