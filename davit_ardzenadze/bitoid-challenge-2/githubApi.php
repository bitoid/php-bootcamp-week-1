<?php 

$response = isset($_POST['submit']);

if($response) {
    $name = $_POST['name'];
    $userInfo = $_POST['githubApi'];

    $folowersUrl = "https://api.github.com/users/$name/followers?per_page=100&page=1";
    $repoUrl = "https://api.github.com/users/$name/repos?per_page=100&page=1";

    function apiHandle($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Test');
        $result = curl_exec($ch);
        return $dateArray = json_decode($result);
    }
        

    if($userInfo == "followers") {
        $userfolowers = apiHandle($folowersUrl);
    } else if ($userInfo == "repositories") {
        $userRepos = apiHandle($repoUrl);
    } else {
        $userfolowers = apiHandle($folowersUrl);
        $userRepos = apiHandle($repoUrl);
    };      
}




