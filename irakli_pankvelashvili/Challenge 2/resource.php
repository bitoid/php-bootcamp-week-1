<?php
 if(isset($_POST['submit'])){
    $info=$_POST['select'];
    $user_name=$_POST['username'];
    $followers_url="https://api.github.com/users/$user_name/followers?per_page=100&page=1";
    $repos_url="https://api.github.com/users/$user_name/repos?per_page=100&page=1";
    
    


function curl ($url)
{
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Test');
$result=curl_exec($ch);
return $json=json_decode($result);

}

if($info == "Followers"){
    $user_followers=curl($followers_url);
}else if($info == "Repos"){
    $user_repos=curl($repos_url);
}else{
    $user_followers=curl($followers_url);
    $user_repos=curl($repos_url);
};
}


?>


