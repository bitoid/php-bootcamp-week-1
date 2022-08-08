<?php require "resource.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Challenge 2</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>

    <form action="index.php" method="POST">
    <div class="input-group has-validation">
        <span class="input-group-text">Git</span>
        <div class="form-floating is-invalid">
            <input type="search" name="username" class="form-control is-invalid" placeholder="Username" required >
            <label for="username">Username</label>

        </div>
    </div>
    <div class="form-floating">
        <select class="form-select" name="select" require>
            <option value="Repos">Repos</option>
            <option value="Followers">Followers</option>
            <option value="Both">Both</option>
        </select><br>
        <label for="select">Choose One</label>
    </div>
    <button class="btn btn-outline-secondary" type="submit" name="submit">S e a r c h</button>
    
    </form>
    
   <?php if($info == 'Repos' || $info == 'Both'): ?>
    <ul>
        <?php foreach($user_repos as $i => $repo): ?>
            <li>
                
                <img src="<?= $repo->owner->avatar_url?>" style="width: 60px">
                <?= $repo->name?>
                <a href="<?= $repo->html_url?>">
                </a>
                
            </li>

        <?php endforeach ?>
    </ul>
    <?php endif; ?>

    <?php if($info == 'Followers' || $info == 'Both'): ?>
    <ul>
        <?php foreach($user_followers as $k => $follower): ?>
            <li>
                <img src="<?= $follower->avatar_url ?>" style="width:60px;">
                <?= $follower->login ?>
                <a href="<?= $follower->html_url ?>" >
                 </a>
                
            </li>

        <?php endforeach ?>
    </ul>
    <?php endif; ?>
    
    
</body>
</html>