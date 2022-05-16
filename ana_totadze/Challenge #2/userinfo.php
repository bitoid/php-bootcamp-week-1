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

if(preg_match($githubRegex, $userName)){
    $repositoryJSON = "https://api.github.com/users/$userName/repos?per_page=$maxPerPage";
    $followersJSON = "https://api.github.com/users/$userName/followers?per_page=$maxPerPage";
    
    $value = $_POST["submit"];
    
    $opts = [
        'http' => [
                'method' => 'GET',
                'header' => [
                        'User-Agent: PHP'
                ]
        ]
    ];

    if($value==="repositories"){
        $userURL = "https://api.github.com/users/$userName";
        $json = file_get_contents($userURL, false, stream_context_create($opts));
        $obj = json_decode($json);

        # function that gets page nums:

        $repos = $obj->public_repos;
        $var = $repos;
        $pageCount = 0;

        while($var >= 0){
            $pageCount++;
            $var -= $maxPerPage;
        }

        echo "<ol>";
         for($page=1; $page <= $pageCount; $page++){
                 $url = $repositoryJSON . "&page=" . $page;

                $json = file_get_contents($url, false, stream_context_create($opts));
                $obj = json_decode($json);
                for($i = 0; $i < count($obj); $i++){
                    $repoName = $obj[$i]->full_name;
                    $repoLink = "https://github.com/" . $repoName;
                    echo "<div class='repo-container'>";
                    echo "<li><h1>" . $repoName . "</h1></li>";
                    echo "<a href='$repoLink' target='_blank'>$repoLink</a>";
                    echo "</div>";
                }
             }
            echo "</ol>";
    } else {

        $userURL = "https://api.github.com/users/$userName";
        $json = file_get_contents($userURL, false, stream_context_create($opts));
        $obj = json_decode($json);
        $followers = $obj->followers;
        $var = $followers;
        $pageCount = 0;

        while($var >= 0){
            $pageCount++;
            $var -= $maxPerPage;
        }

            echo "<ol>";
                for($page = 1; $page <= $pageCount; $page++){
                    $url = $followersJSON . "&page=" . $page;

                    $opts = [
                        'http' => [
                            'method' => 'GET',
                            'header' => [
                                    'User-Agent: PHP'
                            ]
                        ]
                    ];
            
                    $json = file_get_contents($url, false, stream_context_create($opts));
                    $obj = json_decode($json);
                    for($i = 0; $i < count($obj); $i++){
                        $follower = $obj[$i] -> login;
                        $profileLink = $obj[$i]->html_url;
                        $avatarURL = $obj[$i]->avatar_url;
                        $constructImage = "<img class='select-image' src='$avatarURL'>";
                        echo "<div class='followers-container'>";
                            echo $constructImage . "<li><h1>";
                            echo $follower . "</h1></li>";
                            echo "<br>";
                            echo "<a href='$profileLink' target='_blank'>$profileLink</a>";
                        echo "</div>";
                        echo "<br>";
                    }
                }
            echo "</ol>";
    }
} else {
    echo "Invalid username. Please, try again.";
}