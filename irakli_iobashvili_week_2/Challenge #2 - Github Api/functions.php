<?php

$headers = [
    'User-Agent: GitHub-username'
    ];

function getPages($username)
{
    global $headers;
    // Get how many public repositories user has
         $ch = curl_init("https://api.github.com/users/".$username);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $responseRepo = curl_exec($ch);
         curl_close($ch);
         $decoded = json_decode($responseRepo, true);
         // Number of public repositories
         $publicRepos = $decoded["public_repos"];
         $pages = ceil($publicRepos / 100);
         return $pages;
}

function getDecode($username, $type, $x)
{
    global $headers;
    $ch = curl_init("https://api.github.com/users/".$username."/".$type."?per_page=100&page=".$x."");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response, true);
    return $decoded;
  
}
