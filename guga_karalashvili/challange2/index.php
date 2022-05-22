<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Bitoid Technologies: W 1- Chall 2</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <?php $user_name=''; ?>
    <h1>Github Info Fetcher</h1>
    <form action="./index.php" method="post">
        <div class="form-group">
            <input type="text" name="user_name" placeholder="Please Enter Github username" value="<?php echo $user_name ?>" class="form-control" id="formGroupExampleInput" required>
        </div>
        <select name="takeOption" id="" class="custom-select custom-select-sm mb-3">
            <option value="" disabled selected>Choose Option</option>
            <option value="repositories">Repositories</option>
            <option value="followers">Followers</option>
            <option value="both">Both</option>
        </select>
        <input type="submit" name="submit" class="btn btn-primary mb-2 submit">
    </form>
    <?php if($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <?php
        $user_name = $_POST['user_name'];
        require './functions.php';
        $user = get_info($url_user);
        ?>
        <?php if(!empty($user)): ?>
            <?php $all_page = ceil($user->public_repos/$per_page);
            $all_foll_page = ceil($user->followers/$per_page); ?>

            <div class="user">
                <a href=<?php echo $user->html_url;?> target="_blank"><img src=<?php echo $user->avatar_url;?>></a>
                <h2><?php echo $user->login; ?></h2>
                <p><span>Followers : <?php echo $user->followers;?></span><span>Repositories : <?php echo $user->public_repos;?></span></p>
                <h2>Welcome to my github &#10084</h2>
            </div>
            <?php if(isset($_POST['takeOption'])) : ?>
                <?php $option = $_POST['takeOption']; ?>
                <?php  if($option == $OPTION_REPOSITORIES) : ?>
                    <?php  if($user->public_repos != 0) : ?>
                        <section id = "container">
                            <h3>My Repositories</h3>
                            <div class="grid-template">
                                <?php $user_repos= fetch_data($all_page, $OPTION_REPOSITORIES); ?>
                                <?php foreach($user_repos as $repos): ?>
                                    <div class="style">
                                        <a href="<?php echo $repos->html_url;?>" target="_blank"><?php echo $repos->name;?></a>
                                        <p><?php echo $repos->description;?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php else : ?>
                        <p class="userError">There is no repositories &#128533</p>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if($option == $OPTION_FOLLOWERS) : ?>
                    <?php if($user->followers != 0) : ?>
                        <section id = "container">
                            <h3>My Followers</h3>
                            <div class="grid-template">
                                <?php $user_followers= fetch_data($all_foll_page, $OPTION_FOLLOWERS);?>
                                <?php foreach($user_followers as $followers) : ?>
                                    <div class="style">
                                        <a href="<?php echo $followers->html_url;?>" target="_blank"><img src="<?php echo $followers->avatar_url;?>" width="100px"></a><!--
                                        --><h3><?php echo $followers->login;?></h3>
                                    </div>
                                <?php endforeach; ?>
                            </div>  
                        </section> 
                    <?php else : ?> 
                        <p class="userError">There is no followers &#128532</p>
                    <?php endif; ?> 
                <?php endif; ?>
                <?php if($option == $OPTION_BOTH) : ?>
                    <?php  if($user->public_repos != 0) : ?>
                        <section id = "container">
                            <h3>My Repositories</h3>
                            <div class="grid-template">
                                <?php $user_repos= fetch_data($all_page, $OPTION_REPOSITORIES); ?>
                                <?php foreach($user_repos as $repos): ?>
                                    <div class="style">
                                        <a href="<?php echo $repos->html_url;?>" target="_blank"><?php echo $repos->name;?></a>
                                        <p><?php echo $repos->description;?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php else : ?>
                        <p class="userError">There is no repositories &#128533</p>
                    <?php endif; ?>
                    <?php if($user->followers != 0) : ?>
                        <section id = "container">
                            <h3>My Followers</h3>
                            <div class="grid-template">
                                <?php $user_followers= fetch_data($all_foll_page, $OPTION_FOLLOWERS);?>
                                <?php foreach($user_followers as $followers) : ?>
                                    <div class="style">
                                        <a href="<?php echo $followers->html_url;?>" target="_blank"><img src="<?php echo $followers->avatar_url;?>" width="100px"></a><!--
                                        --><h3><?php echo $followers->login;?></h3>
                                    </div>
                                <?php endforeach; ?>
                            </div>  
                        </section> 
                    <?php else : ?> 
                        <p class="userError">There is no followers &#128532</p>
                    <?php endif; ?>
                <?php endif; ?>          
            <?php else : ?>
                <p class="userError">Please choose an option</p>
            <?php endif; ?>
        <?php else : ?>
            <p class="userError"><?php echo $user_name; ?> not found !!!</p>
        <?php endif; ?>
    <?php endif; ?>
    
</body>
</html>