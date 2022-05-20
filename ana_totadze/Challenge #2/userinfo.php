<!--
    Split php and html
    Decomposed code
-->

<html>
    <head>
        <!-- link style here -->
        <link rel="stylesheet" href="./index.css">
    </head>
</html>

<?php

$userName = $_POST["username"];
$githubRegex = "/^[a-z\d](?:[a-z\d]|-(?=[a-z\d])){0,38}$/i";
$maxPerPage = 100;

$opts = [
    'http' => [
        'method' => 'GET',
        'header' => [
                'User-Agent: PHP'
        ]
    ]
];


if(preg_match($githubRegex, $userName)){
    $value = $_POST["submit"];
    if($value==="repositories"){
        showRepos($opts, $userName, $maxPerPage);
    } else {
        showFollowers($opts, $userName, $maxPerPage);
    }
} else {
    echo "Invalid username. Please, try again.";
}

# Reusable function
# One of the parameters - things - number of repos or followers
function getPageCount($things, $maxPerPage){
    $var = $things;
    $pageCount = 0;

    while($var >= 0){
        $pageCount++;
        $var -= $maxPerPage;
    }

    return $pageCount;
}

function showRepos($opts, $userName, $maxPerPage){
    $repositoryJSON = "https://api.github.com/users/$userName/repos?per_page=$maxPerPage";
    
    $userURL = "https://api.github.com/users/$userName";
    $json = file_get_contents($userURL, false, stream_context_create($opts));
    $obj = json_decode($json);

    # function that gets page nums:

    $repos = $obj->public_repos;
    $pageCount = getPageCount($repos, $maxPerPage);

    printRepos($pageCount, $repositoryJSON, $opts);
}

function printRepos($pageCount, $repositoryJSON, $opts){ ?>
    <ol>
        <?php for($page=1; $page <= $pageCount; $page++):
            $url = $repositoryJSON . "&page=" . $page;

            $json = file_get_contents($url, false, stream_context_create($opts));
            $obj = json_decode($json); ?>
        <?php for($i = 0; $i < count($obj); $i++):
                $repoName = $obj[$i]->full_name;
                $repoLink = "https://github.com/" . $repoName; ?>
            <div class='repo-container'>
                <li><h1><?php print $repoName ?></h1></li>
                <a href='$repoLink' target='_blank'><?php print $repoLink ?> </a>
            </div>
        <?php endfor;
    endfor; ?>
    </ol>
<?php } ?>

<?php
function showFollowers($opts, $userName, $maxPerPage){
        $followersJSON = "https://api.github.com/users/$userName/followers?per_page=$maxPerPage";

        $userURL = "https://api.github.com/users/$userName";
        $json = file_get_contents($userURL, false, stream_context_create($opts));
        $obj = json_decode($json);

        $followers = $obj->followers;
        $pageCount = getPageCount($followers, $maxPerPage);

        printFollowers($pageCount, $followersJSON, $opts);
}

function printFollowers($pageCount, $followersJSON, $opts){ ?>
    <ol>
        <?php 
        for($page = 1; $page <= $pageCount; $page++):
            $url = $followersJSON . "&page=" . $page;
        
            $json = file_get_contents($url, false, stream_context_create($opts));
            $obj = json_decode($json);
            for($i = 0; $i < count($obj); $i++):
                $follower = $obj[$i] -> login;
                $profileLink = $obj[$i]->html_url;
                $avatarURL = $obj[$i]->avatar_url; ?>
                
                <div class="followers-container">
                    <img class="select-image" src=<?php print $avatarURL ?>
                    <h1><h1><li><?php print $follower ?> </li></h1></h1>
                    <a href=<?php print $profileLink ?> target='_blank'><?php print $profileLink ?> </a>
                    <br>
                    <br>
                </div>
        <?php endfor;
        endfor; ?>
    </ol>
<?php } ?>