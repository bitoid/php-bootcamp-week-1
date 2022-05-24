<?php

    $repo_Name = '';
    $repositories = '';
    $followers = '';
    $repo_Err = '';
    $response = [];
    $response2 = [];

    $repos = curl_init();
    $flwrs = curl_init();
    $i = true;
    $pg_Num = 1;
    
    
    if(isset($_POST['submit'])) {
        $repo_Name = $_POST['repoName'];
        
        
        if(!empty($_POST['repos'])) {
            $repositories = $_POST['repos'];
        }
        if(!empty($_POST['followers'])) {
            $followers = $_POST['followers'];
        }

        if(empty($repo_Name)) {
            $repo_Err = "It's empty string, please fill valid repository name";
        }
        
    }

    if(empty($repositories) && empty($followers) && empty($repo_Name)) {
        $repo_Err = "Invalid options, please select correct options";

    }
    if(empty($repositories) || empty($followers) && empty($repo_Name)) {
        $repo_Err = "Invalid options, please select correct options";

    }



    
    $count_Repos = 0;
    $repos_Result = [];

    if($repositories == 'on' && !empty($repo_Name)) {

    
        while($i) {
            curl_setopt_array($repos, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://api.github.com/users/$repo_Name/repos?per_page=100&page=$pg_Num",
            CURLOPT_USERAGENT => 'GitHub API in Curl'
            ]);
    
            $response = json_decode(curl_exec($repos));

            $count_Repos += count($response);
    
    
            if(empty($response)) {
                $i = false;
                break;
            }
    
            $repos_Result = array_merge($repos_Result, $response);
            $pg_Num++;
    
        }
    
    }

    $count_Flwrs = 0;
    $flwrs_Result = [];
    $pg_Num = 1;

    if($followers == 'on' && !empty($repo_Name)) {

    
        while($i = true) {
            curl_setopt_array($flwrs, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "https://api.github.com/users/$repo_Name/followers?per_page=100&page=$pg_Num",
            CURLOPT_USERAGENT => 'GitHub API in Curl'
            ]);

            $response2 = json_decode(curl_exec($flwrs));
            $count_Flwrs += count($response2);



            if(empty($response2)) {
                $i = false;
                break;
            }

            $flwrs_Result = array_merge($flwrs_Result, $response2);
            $pg_Num++;

        }

    }

    
    
?>