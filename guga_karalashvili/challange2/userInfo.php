<!--
    Get info about Github User
-->
<?php
$url = "https://api.github.com/users/$usrName";
$resource = curl_init($url);
curl_setopt_array($resource, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => 'PHP'
]);
$result = curl_exec($resource);
$reposArray = json_decode($result, false);
$reposNum = $reposArray->public_repos;
$followersNum = $reposArray->followers;
$userLogin = $reposArray->login;
$userUrl = $reposArray->html_url;
$userAvat = $reposArray->avatar_url;
?>