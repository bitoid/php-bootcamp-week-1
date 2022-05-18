<?php
$haveData = false;
$haveDataFollowers = false;
$errors = [];

function get_followers_and_repos($url, $username) {
  $url_user = $url . $username;
  $resource = curl_init($url_user);
  curl_setopt_array($resource, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
      'User-Agent: PHP',
      'Content-Type: application/json',
      'Authorization: token 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'
      ],
  ]);
  $result = json_decode(curl_exec($resource), true);
  curl_close($resource);
  return $result;
}

function calculate_pages($info) {
  return ceil($info / 100);
}

if ($_POST["username"]) {
  $username = $_POST["username"];
  
  // Get data about the number of repos and followers the user has
  $data = get_followers_and_repos("https://api.github.com/users/", $username);
  // Calculate how many pages of followers and repos there are
  // to find out how many times we have to call github api
  $number_of_pages_followers = calculate_pages($data["followers"]);
  $number_of_pages_repos = calculate_pages($data["public_repos"]);

  // Get data about the User's repositories and put them into the array
  require 'getRepos.php';

  // Get data about the user's followers
  require 'getFollowers.php';
} 

?>
