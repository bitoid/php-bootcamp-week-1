<?php
$followers_nested = [];
for ($i = 0; $i < $number_of_pages_followers; $i++) {
  $url_followers = "https://api.github.com/users/{$username}/followers?per_page=100&page=$i";
  $resource2 = curl_init($url_followers);
  curl_setopt_array($resource2, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
    'User-Agent: PHP',
    'Content-Type: application/json'],
  ]);
  $result_followers = json_decode(curl_exec($resource2));
  $followers_nested[] = $result_followers;
}

$followers = unnest_array($followers_nested);

if ($followers !== ['']) {
  $haveDataFollowers = true;
};
?>