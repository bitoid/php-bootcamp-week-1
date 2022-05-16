<?php
function getNum($input){
  $headers = [
    "User-Agent: api test",
    "Authorization: token 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"
  ];
  $ch = curl_init("https://api.github.com/users/".$username);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $responseRepo = curl_exec($ch);
  curl_close($ch);
  $decoded = json_decode($responseRepo, true);
  // Number of public repositories
  $publicRepos = $decoded[$input];
  $pages = ceil($publicRepos / 100);
  return $pages;
}
?>