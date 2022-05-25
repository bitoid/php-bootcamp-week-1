<?php require_once 'data.php' ?>

<html>
    <head>
        <title>second task</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div>
            <h3>Enter username</h3>
            <form action="/index.php" method="POST">
                <input type="text" id="user_n" name="username" placeholder="username" required><br>

                
                <input type="radio" id="repos" name="data" value="repositories" required>
                <laberl for="repos">Repositories</label>
                <input type="radio" id="followers" name="data" value="followers">
                <laberl for="followers">Followers</label>
                <input type="radio" id="both" name="data" value="both">
                <laberl for="followers">Both</label><br>

                <input type="submit" value="Submit">
            </form>
        </div>
     
        <?php if($_POST['username'] && isset($_POST['data'])): ?>
            <?php if($_POST['data'] == 'repositories' || $_POST['data'] == 'both'): ?>
                <div class = "outside-loop">
                    <ol>
                        <?php foreach ($repos_data as $repo): ?>
                                <div class = "inside-loop">     
                                    <li>
                                        <a class = "text" href= <?php $repo["html_url"] ?> > <?php echo $repo["full_name"] ?> </a>
                                        <p class = "text">Description: </p>
                                        <p class = "text"> <?php $repo["description"] ?> </p>
                                        <br>
                                    </li>
                                </div>
                        <?php endforeach ?>
                    </ol>     
                </div> 
            <?php endif ?>
    
            <div class = "second-loop">
                <?php if($_POST['data'] == 'followers' || $_POST['data'] == 'both'): ?>
                    <ol>
                        <?php foreach ($followers_data as $follower): ?>
                            <li>
                                <figure>
                                    <a href= <?php $follower["html_url"] ?> target="_blank"><img
                                    src= <?php echo $follower["avatar_url"] ?> alt="Github Avatar"/></a>
                                    <figcaption><?php echo $follower["login"] ?> </figcaption>
                                </figure> 
                                <br>
                                <br>
                            </li>
                        <?php endforeach ?>
                    </ol> 
                <?php endif ?>
        <?php endif ?>
        </div>
    </body>
</html>