<!doctype HTML>
<html>
    <head>
    <link rel="stylesheet" href="style/style.css">
    </head>
    <body>

<?php 

// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'
  )
);

$context = stream_context_create($opts);

$opts2 = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'
    )
  );
  
  $context2 = stream_context_create($opts2);

$repos = "";
$followers = "";
?>

<form class="form" action="" method="POST">
    <input class="formInput" type="text" name="name" placeholder="Type GitHub Username"/><br/>
    <input class="formInput" type="submit" name="submit" value="Search">
</form>


<?php

if(isset($_POST['submit'])){
    $repos = file_get_contents('https://api.github.com/users/'.$_POST['name'].'/repos', false, $context);
    $followers = file_get_contents('https://api.github.com/users/'.$_POST['name'].'/followers', false, $context2);
    
    if(!($repos && $followers)){
        echo "<h3 class='errorText'>Requested user do not exist or request limit is out. Please check spelling or try again in an hour. Bellow is example user 'OtarZa'. Have a nice day.</h3>";
        
        $repos = file_get_contents('tmp/tmpRepos.txt');
        $followers = file_get_contents('tmp/tmpFollowers.txt');
    } 
    
    
    
    echo '<div class="content">';
    //echo out list of repositories with loop
    $repoArr = json_decode($repos,true);
    echo '<ul class="list">';
    echo '<h5>Repositories</h5>';
    foreach($repoArr as $key => $value){
    echo '<li>' . $key . ' ' . $value['name'] . '</li>';
    }
    echo '</ul>';
    
    //echo out list of followers with loop
    $followersArr = json_decode($followers,true);
    echo '<ul class="list">';
    echo '<h5>Followers</h5>';
    foreach($followersArr as $key => $value){
    echo '<li>' . $key . ' ' . $value['login'] . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    
    
}
?>

    </body>
</html>
