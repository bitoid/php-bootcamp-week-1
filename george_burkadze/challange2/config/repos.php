<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $username = $_POST['username'];
    if (!empty($username))
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.github.com/users/" . $username . "/repos");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "George");
        $result = curl_exec($curl);
        curl_close($curl);
        $repos = json_decode($result);
    }
}
