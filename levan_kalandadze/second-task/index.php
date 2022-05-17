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
        
        if($_POST['username']){
            $resource  = curl_init();
            curl_setopt($resource, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($resource, CURLOPT_URL, $url_repos);
            curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($resource);
            curl_close($resource);

            $data = json_decode($result, true);

    ?>
        <div class = "outside-loop">

    <?php
        
            
            foreach ($data as $repo) {
            
                
                $full_name = $repo["full_name"];
                $repo_link = $repo["html_url"];
                $description = $repo["description"];
    ?>
                <div class = "inside-loop">
    <?php
                    echo "<a class = \"text\" href=\"$repo_link\">$full_name</a>";
                
                    echo "<p class = \"text\">Description: </p>";
                
                    echo "<p class = \"text\">$description</p>";
                    echo "<br>";

    ?>
                </div>
    <?php
            
            }
        }
    ?>
        </div>

        <div class = "second-loop">

    <?php

            $url_followers = "https://api.github.com/users/$user_name/followers?per_page=100";
            
            if($_POST['username']){
                $resource  = curl_init();
                curl_setopt($resource, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($resource, CURLOPT_URL, $url_followers);
                curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($resource);
                curl_close($resource);

                $data = json_decode($result, true);
        
                foreach ($data as $repo) {
            
                    $name = $repo["login"];
                    $profile_link = $repo["html_url"];
                    $img_source = $repo["avatar_url"];
                    $display_img = "<img src=\"$img_source\" alt=\"Github Avatar\"/>"; 
            
                    echo "<figure><a href=\"$profile_link\" target=\"_blank\">$display_img</a><figcaption>$name</figcaption></figure>"; 
                    echo "<br>";
                    echo "<br>";

                }
            
            }

    ?>
        </div>

</html>