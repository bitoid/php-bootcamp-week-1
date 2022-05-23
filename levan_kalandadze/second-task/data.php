<?php
    $user_name = $_POST['username'];
    $url_repos = "https://api.github.com/users/$user_name/repos?per_page=100";
    $url_followers = "https://api.github.com/users/$user_name/followers?per_page=100";

    function get_data($url){
        $headers = [
            "User-Agent: REST API Client"
        ];

        $resource  = curl_init();
        curl_setopt($resource, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($resource, CURLOPT_URL, $url);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($resource);
        curl_close($resource);

        return json_decode($result, true);
    }

    $repos_data = get_data($url_repos);
    $followers_data = get_data($url_followers);
?>