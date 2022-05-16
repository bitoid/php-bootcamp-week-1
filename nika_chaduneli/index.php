<?php
declare(strict_types=1);

require 'app.php';

$profile = displayProfile();
$firstname = $profile['firstname'];

$repos = [];
$followers = [];

if(! isset($profile['error']) && $firstname){
    if(isset($_POST['get_repos']) && $_POST['get_repos'] === 'on'){
        $repos = getGithubRepos($firstname);
    }

    if(isset($_POST['get_followers']) && $_POST['get_followers'] === 'on'){
        $followers = getGithubFollowers($firstname);
    }
}

require "view.php";
