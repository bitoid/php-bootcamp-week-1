<?php 
$page = 1;
$per_page = 100;
$OPTION_REPOSITORIES = 'repositories';
$OPTION_FOLLOWERS = 'followers';
$OPTION_BOTH = 'both';
$url_user = "https://api.github.com/users/$user_name";

function get_info($url){
    $resource = curl_init($url);
    curl_setopt_array($resource, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'PHP',
    ]);
    $result = curl_exec($resource);
    $info = json_decode($result, false);
    $http_code = curl_getinfo($resource, CURLINFO_HTTP_CODE);
    if($http_code == 200){
        return $info;
    }else {
        return;
    }
}

function fetch_data($page_quantity, $option){
    global $OPTION_REPOSITORIES;
    global $OPTION_FOLLOWERS;
    global $user_name;
    global $per_page;
    $full_data_array=[];
    $url = '';
    for($page = 1 ; $page <= $page_quantity; $page++){
        if($option === $OPTION_REPOSITORIES){
            $url = "https://api.github.com/users/$user_name/repos?per_page=$per_page&page=$page";
        }
        if($option === $OPTION_FOLLOWERS){
            $url = "https://api.github.com/users/$user_name/followers?per_page=$per_page&page=$page";
        }
        if(!empty(get_info($url))){
            $data_array= get_info($url);
            array_push($full_data_array, ...$data_array);
        }
    }
    return $full_data_array;
}
?>