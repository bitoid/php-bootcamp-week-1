<?php

    require_once('requests.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BitCamp Challenge2</title>
    <link rel="stylesheet" href="css/main.css"/>
</head>
<body>
    <form action="" method="post" class="repos-form">
        <input type="text" name="repoName" placeholder="Enter repository name">
        <div class="contentOption">
            <input type="checkbox" name="followers" id="followers">
            <label for="followers">Followers</label>
            <input type="checkbox" name="repos" id="repos">
            <label for="repos">Repositories</label>
        </div>
        <button type="submit" name="submit">Search</button>
    </form>

    <p class="error"><?php echo $repo_Err; ?></p>
<?php
    if($repositories == 'on' && !empty($repo_Name)) {
    
?>

    <h2 class="repoFound">
        <?php echo $repo_Name;?> has 
        <?php echo $count_Repos;?> public repositories
    </h2>
    
    <ul class="repoList">
<?php

    foreach($repos_Result as $repo) {
?>
    <li class="repoItem">
    
        <a href="<?php echo $repo -> html_url;?>"><?php echo $repo -> name; ?></a>
    </li>
<?php
    }
?>

    </ul>
<?php
            
    }
    if($followers == 'on' && !empty($repo_Name)) {
?>

    <h2 class="repoFound">
        Here is <?php echo $repo_Name;?>'s  
        <?php echo $count_Flwrs;?> followers
    </h2>

    <ul class="flwerList">


<?php
    foreach($flwrs_Result as $follower) {
?>

    <li class="flwerProfile">
    
        <a href="<?php echo $follower -> html_url;?>">
            <img src="<?php echo $follower -> avatar_url;?>" alt="Follower image"/> 
        </a>
        <span><?php echo $follower -> login; ?></span>
    </li>
<?php
    }
    }
?>

    </ul>

<?php
    curl_close($flwrs);

    curl_close($repos);

?>

</body>
</html>
