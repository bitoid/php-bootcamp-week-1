<?php

$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['name'];
}



$follower_url = "https://api.github.com/users/". "$username" ."/followers?page=1&per_page=100";

$headers = [
    "User-Agent: Bitoid",
];

$sh = curl_init($follower_url);

curl_setopt($sh, CURLOPT_HTTPHEADER, $headers);

curl_setopt($sh, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($sh);

curl_close($sh);


$value = json_decode($result, true);