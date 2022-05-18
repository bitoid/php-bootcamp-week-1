<?php
$repos_nested = [];
$repos = [];
for ($i = 1; $i <= $number_of_pages_repos; $i++) {
  // Using curl to fetch data about user's repos.
  // if there's more than one page to be fetched, we can do it like this :)
  $urlRepos = "https://api.github.com/users/".$username."/repos?per_page=100&page=".$i;
  $resource_user = curl_init($urlRepos);
  curl_setopt_array($resource_user, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
      'User-Agent: PHP',
      'Content-Type: application/json',
      'Authorization: token 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'],
  ]);
    $result = json_decode(curl_exec($resource_user));
    $repos_nested[] = $result;
    curl_close($resource_user);
}

// If the user does not exist, save error message
if (!$resource_user) {
  $errors[] = "Github user not found";
} else {
  $haveData = true;
}

// Unnest the repositories array, so that implementing pagination will be possible
for ($i = 0; $i < count($repos_nested); $i++) {
  for ($j = 0; $j < count($repos_nested[$i]); $j++) {
    $repos[] = $repos_nested[$i][$j];
  }
}
?>