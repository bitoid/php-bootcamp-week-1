<html>
    <head>
    <title>second task</title>
    <link rel="stylesheet" href="styles.css">
    </head>

        
        <div>
            <h3>Enter username</h3>
            <form action="/index.php" method="POST">
                <input type="text" id="user_n" name="username" placeholder="username">
                <input type="submit" value="Submit" name="Submited">
            </form>
        </div>


    <?php
        
        $userName = $_POST['username'];
        $headers = [
            "User-Agent: Example REST API Client"
        ];
    
        $url_repos = "https://api.github.com/users/$userName/repos?per_page=100";
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
            
                
                $fullName = $repo["full_name"];
                $repoLink = $repo["html_url"];
                $description = $repo["description"];
    ?>
                <div class = "inside-loop">
    <?php
                    echo "<a class = \"text\" href=\"$repoLink\">$fullName</a>";
                
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

            $url_followers = "https://api.github.com/users/$userName/followers?per_page=100";
            
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
                    $profileLink = $repo["html_url"];
                    $imgSource = $repo["avatar_url"];
                    $displayImg = "<img src=\"$imgSource\" alt=\"Github Avatar\"/>"; 
            

                    echo "<figure><a href=\"$profileLink\" target=\"_blank\">$displayImg</a><figcaption>$name</figcaption></figure>"; 
                    echo "<br>";
                    echo "<br>";

                }
            
            }

    ?>
        </div>

</html>