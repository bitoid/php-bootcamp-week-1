<?php

$opts = array(
  'http' => array(
    'method' => "GET",
    'header' => 'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'
  )
  );

$context_repos = stream_context_create($opts);

$opts2 = array(
  'http' => array(
    'method' => "GET",
    'header' => 'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'
  )
);

$context_followers = stream_context_create($opts2);

$repos = "";
$followers = "";
?>