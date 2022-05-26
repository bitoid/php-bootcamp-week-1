<?php
$repos_nested = [];
for ($i = 1; $i <= $number_of_pages_repos; $i++) {
  // Using curl to fetch data about user's repos.
  // if there's more than one page to be fetched, we can do it like this :)
  $urlRepos = "https://api.github.com/users/".$username."/repos?per_page=100&page=".$i;
  $resource_user = curl_init($urlRepos);
  curl_setopt_array($resource_user, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
      'User-Agent: PHP',
      'Content-Type: application/json'],
  ]);
    $result = json_decode(curl_exec($resource_user));
    $repos_nested[] = $result;
    curl_close($resource_user);
}

$repos = unnest_array($repos_nested);

// If the user does not exist, save error message
if (!$resource_user) {
  $errors[] = "Github user not found";
} else {
  $haveData = true;
}
?>