<?php
$followers_nested = [];
$followers = [];
for ($i = 0; $i < $number_of_pages_followers; $i++) {
  $url_followers = "https://api.github.com/users/{$username}/followers?per_page=100&page=$i";
  $resource2 = curl_init($url_followers);
  curl_setopt_array($resource2, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
    'User-Agent: PHP',
    'Content-Type: application/json',
    'Authorization: token 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'],
  ]);
  $result_followers = json_decode(curl_exec($resource2));
  $followers_nested[] = $result_followers;
}

for ($i = 0; $i < count($followers_nested); $i++) {
  for ($j = 0; $j < count($followers_nested[$i]); $j++) {
    $followers[] = $followers_nested[$i][$j];
  }
}

if ($followers !== ['']) {
  $haveDataFollowers = true;
};
?>