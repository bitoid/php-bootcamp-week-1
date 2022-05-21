<html>
    <head>
    <title>second task</title>
    <link rel="stylesheet" href="styles.css">
    </head>
    
        <div>
            <h3>Enter username</h3>
            <form action="/index.php" method="POST">
                <input type="text" id="user_n" name="username" placeholder="username" required>
                <input type="submit" value="Submit">
            </form>
        </div>


    <?php
        $user_name = $_POST['username'];
        $headers = [
            "User-Agent: REST API Client"
        ];
    
        $url_repos = "https://api.github.com/users/$user_name/repos?per_page=100";
    ?>
        
        <?php if($_POST['username']): ?>
            <?php
                $resource  = curl_init();
                curl_setopt($resource, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($resource, CURLOPT_URL, $url_repos);
                curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($resource);
                curl_close($resource);

                $data = json_decode($result, true);
            ?>

            <div class = "outside-loop">

                <?php foreach ($data as $repo): ?>
                    
                        <?php
                            $full_name = $repo["full_name"];
                            $repo_link = $repo["html_url"];
                            $description = $repo["description"];
                        ?>

                        <div class = "inside-loop">
            
                            <a class = "text" href= <?php $repo_link ?> > <?php echo $full_name ?> </a>
                        
                            <p class = "text">Description: </p>
                        
                            <p class = "text"> <?php $description ?> </p>
                            <br>

                        </div>
                        
                <?php endforeach ?>
    
                
            </div> 

        <?php endif ?>
    
       

        <div class = "second-loop">

   

            <?php $url_followers = "https://api.github.com/users/$user_name/followers?per_page=100"; ?>
            
            <?php if($_POST['username']): ?>
                <?php
                    $resource  = curl_init();
                    curl_setopt($resource, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($resource, CURLOPT_URL, $url_followers);
                    curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
                    $result = curl_exec($resource);
                    curl_close($resource);
                    $data = json_decode($result, true);
                ?>
    
                <?php foreach ($data as $repo): ?>
                    <?php
                        $name = $repo["login"];
                        $profile_link = $repo["html_url"];
                        $img_source = $repo["avatar_url"];
                    ?>
                    <figure>
                        <a href= <?php $profile_link ?> target="_blank"><img src= <?php echo $img_source ?>alt="Github Avatar"/></a>
                        <figcaption><?php echo $name ?> </figcaption>
                    </figure> 
                    <br>
                    <br>

                <?php endforeach ?>
                
            <?php endif ?>
    
        </div>

</html>